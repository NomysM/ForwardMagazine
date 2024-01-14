<?php
session_start();
if (!isset($_SESSION['user'])) header('location: index.php');
$user = $_SESSION['user'];

require_once('./vendor/autoload.php');
require_once('./connection.php');
require_once('./vendor/tecnickcom/tcpdf/tcpdf.php');

function getTableData($table_name) {
    global $conn;

    if ($table_name === 'users') {
        $stmt = $conn->prepare("SELECT first_name, last_name, email, created_at, updated_at FROM $table_name ORDER BY created_at DESC");
    } elseif ($table_name === 'products') {
        $stmt = $conn->prepare("SELECT product_name, description, quantity, created_at, updated_at FROM $table_name ORDER BY created_at DESC");
    } elseif ($table_name === 'orders') {
        $stmt = $conn->prepare("SELECT products.product_name, orders.quantity, orders.created_at, users.email 
                                FROM orders 
                                JOIN products ON orders.product_id = products.id 
                                JOIN users ON orders.created_by = users.id 
                                ORDER BY users.email, orders.created_at DESC");
    } else {
        $stmt = $conn->prepare("SELECT * FROM $table_name ORDER BY created_at DESC");
    }

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
}

function generatePDF($table_name, $header) {
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    $pdf->AddPage();

    $pdf->SetFont('dejavusans', '', 10);

    $data = getTableData($table_name);

    $content = '<h1 class="section_header"><i class="fa fa-plus"></i> ' . $header . '</h1>';
    $content .= '<div class="section_content"><div class="users"><table style="border-collapse: collapse;">';

    $content .= '<thead><tr><th style="border-bottom: 1px solid #000;">#</th>';

    $columnLabels = [];

    foreach ($data[0] as $key => $value) {
        $columnLabels[$key] = getLabelForColumn($key);
        $content .= '<th style="border-bottom: 1px solid #000; padding: 8px;">' . $columnLabels[$key] . '</th>';
    }

    $content .= '</tr></thead><tbody>';

    foreach ($data as $index => $row) {
        $content .= '<tr style="border: 1px solid #000;">';
        $content .= '<td style="border-bottom: 1px solid #000; padding: 8px;">' . ($index + 1) . '</td>';

        // Dodaje dane do tabeli
        foreach ($row as $key => $value) {
            $content .= '<td style="border-bottom: 1px solid #000; padding: 8px;">' . $value . '</td>';
        }

        $content .= '</tr>';
    }

    $content .= '</tbody></table></div></div>';

    $pdf->writeHTML($content, true, false, true, false, '');

    // Zapisz PDF do pliku, dałem bez D ze względu, że wpierw możemy zobaczyć jak wygląda nasz pdf i nie każdy potrzebuje od razu pobierać pdf
    $pdf->Output($table_name . '_view.pdf');
    exit();
}

function getLabelForColumn($columnName) {
    $columnLabels = [
        'first_name' => 'Imię',
        'last_name' => 'Nazwisko',
        'email' => 'Email',
        'product_name' => 'Nazwa Produktu',
        'description' => 'Opis',
        'quantity' => 'Ilość',
        'created_at' => 'Data Utworzenia',
        'updated_at' => 'Data Aktualizacji',
    ];

    return isset($columnLabels[$columnName]) ? $columnLabels[$columnName] : $columnName;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['generate_product_pdf'])) {
        generatePDF('products', 'Produkty');
    }

    if (isset($_POST['generate_user_pdf'])) {
        generatePDF('users', 'Konta');
    }

    if (isset($_POST['generate_order_pdf'])) {
        generatePDF('orders', 'Zamówienia');
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <script src="https://use.fontawesome.com/0c7a3095b5.js"></script>
    <title>Raport - ForwardMagazine</title>
</head>
<body>
    <div id="dashboardMainContainer">
        <?php include('./sidebar.php') ?>
        <div class="dashboard_content_container" id="dashboard_content_container">
            <?php include('./topnav.php') ?>
            <div class="dashboard_content">
                <div class="dashboard_content_main">
                    <h1 class="section_header"><i class="fa fa-plus"></i> Raporty</h1>
                    <form method="post" class="raportForm">
                        <button type="submit" name="generate_product_pdf" class="raportFormButton">Produkty</button>
                        <button type="submit" name="generate_user_pdf" class="raportFormButton">Konta</button>
                        <button type="submit" name="generate_order_pdf" class="raportFormButton">Zamówienia</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/script.js"></script>
</body>
</html>
