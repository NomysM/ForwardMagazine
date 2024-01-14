<?php
session_start();
if (!isset($_SESSION['user'])) header('location: index.php');

include('./connection.php');

$user = $_SESSION['user'];

if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    $deleteStmt = $conn->prepare("DELETE FROM orders WHERE id = :delete_id");
    $deleteStmt->bindParam(':delete_id', $deleteId, PDO::PARAM_INT);

    $deleteStmt->execute();

    header('location: ./order-view.php');
    exit();
}

$stmt = $conn->prepare("SELECT orders.*, products.product_name, users.email FROM orders 
                        JOIN products ON orders.product_id = products.id 
                        JOIN users ON orders.created_by = users.id 
                        ORDER BY users.email, orders.created_at DESC");
$stmt->execute();

$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <script src="https://use.fontawesome.com/0c7a3095b5.js"></script>
    <title>Zamówienia - ForwardMagazine</title>
</head>

<body>
    <div id="dashboardMainContainer">
        <?php include('./sidebar.php') ?>
        <div class="dashboard_content_container" id="dashboard_content_container">
            <?php include('./topnav.php') ?>
            <div class="dashboard_content">
                <div class="dashboard_content_main">
                    <h1 class="section_header"><i class="fa fa-plus"></i> Zamówienia</h1>
                    <div class="section_content">
                        <?php
                        $currentUser = null;
                        $orderNumber = 1;
                        foreach ($orders as $order) :
                            if ($currentUser !== $order['email']) {
                                if ($currentUser !== null) {
                                    echo '</tbody></table>';
                                }
                                echo '<h2>' . $order['email'] . '</h2>';
                                $currentUser = $order['email'];
                                $orderNumber = 1;
                        ?>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Numer zamówienia</th>
                                            <th>Nazwa Produktu</th>
                                            <th>Ilość</th>
                                            <th>Data zamówienia</th>
                                            <th>Akcje</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            <?php
                            }
                            ?>
                            <tr>
                                <td><?= $orderNumber++ ?></td>
                                <td><?= isset($order['product_name']) ? $order['product_name'] : 'Brak nazwy produktu' ?></td>
                                <td><?= $order['quantity'] ?></td>
                                <td><?= date('F d,Y H:i:s', strtotime($order['created_at'])) ?></td>
                                <td>
                                    <a href="?delete_id=<?= $order['id'] ?>" onclick="return confirm('Czy na pewno chcesz usunąć to zamówienie?')"><i class="fa fa-trash"></i> Usuń</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/script.js"></script>
</body>

</html>
