<?php
session_start();
if (!isset($_SESSION['user'])) header('location: index.php');
$user = $_SESSION['user'];

include('./table_columns.php');
$table_name = 'orders';
$columns = $table_columns_map[$table_name];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderDetails = isset($_POST['order_details']) ? $_POST['order_details'] : [];

    if (empty($orderDetails)) {
        $_SESSION['response'] = [
            'success' => false,
            'message' => 'Proszę wybrać produkty i podać ilości.'
        ];
    } else {
        try {
            include('./connection.php');

            $stmt = $conn->prepare("INSERT INTO $table_name (product_id, quantity, created_by, created_at, updated_at) VALUES (:product_id, :quantity, :created_by, :created_at, :updated_at)");

            $created_at = $updated_at = date('Y-m-d H:i:s');
            $created_by = $user['id'];

            foreach ($orderDetails as $orderDetail) {
                $product_id = $orderDetail['product_id'];
                $quantity = $orderDetail['quantity'];

                $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
                $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                $stmt->bindParam(':created_by', $created_by, PDO::PARAM_INT);
                $stmt->bindParam(':created_at', $created_at);
                $stmt->bindParam(':updated_at', $updated_at);

                $stmt->execute();
            }

            $_SESSION['response'] = [
                'success' => true,
                'message' => 'Pomyślnie dodano zamówienie do bazy.'
            ];
        } catch (PDOException $e) {
            $_SESSION['response'] = [
                'success' => false,
                'message' => 'Błąd podczas dodawania zamówienia: ' . $e->getMessage()
            ];
        }
    }

    header('location: ./' . $_SESSION['redirect_to']);
    exit();
}

$products = include('./show-products.php');
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <script src="https://use.fontawesome.com/0c7a3095b5.js"></script>
    <title>Dodawanie zamówienia - ForwardMagazine</title>
</head>
<body>
    <div id="dashboardMainContainer">
        <?php include('./sidebar.php') ?>
        <div class="dashboard_content_container" id="dashboard_content_container">
            <?php include('./topnav.php') ?>
            <div class="dashboard_content">
                <div class="dashboard_content_main">
                    <h1 class="section_header"><i class="fa fa-plus"></i> Dodaj zamówienie</h1>
                    <div id="addAppInputCont">
                        <form action="./order.php" method="POST" class="orderForm">
                            <div class="addAppInputCont">
                                <label for="order_details">Dodaj produkty i ilości:</label>
                                <div id="order_details">
                                    <?php if (is_array($products) && count($products) > 0) : ?>
                                        <div class="order_detail">
                                            <select name="order_details[0][product_id]" required>
                                                <?php foreach ($products as $product) : ?>
                                                    <option value="<?= $product['id'] ?>"><?= $product['product_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <input type="number" name="order_details[0][quantity]" placeholder="Ilość" required>
                                        </div>
                                    <?php else : ?>
                                        <p>Brak dostępnych produktów do wyboru.</p>
                                    <?php endif; ?>
                                </div>
                                <button type="button" class="btn-submit-next" onclick="addOrderDetail() ">Dodaj kolejny produkt</button>
                                <button type="submit" class="btn-submit">Dodaj zamówienie</button>
                            </div>
                        </form>
                        <?php
                        if (isset($_SESSION['response'])) {
                            $response_message = $_SESSION['response']['message'];
                            $is_success = $_SESSION['response']['success'];
                            ?>
                            <div class="responseMessage">
                                <p class="responseMessage <?= $is_success ? 'responseMessage__success' : 'responseMessage__error' ?>">
                                    <?php echo $response_message ?>
                                </p>
                            </div>
                        <?php unset($_SESSION['response']);
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/script.js"></script>
    <script>
        function addOrderDetail() {
            var orderDetailsContainer = document.getElementById('order_details');
            var orderDetailIndex = orderDetailsContainer.children.length;

            var orderDetail = document.createElement('div');
            orderDetail.className = 'order_detail';

            var productSelect = document.createElement('select');
            productSelect.name = 'order_details[' + orderDetailIndex + '][product_id]';
            productSelect.required = true;

            <?php if (is_array($products) && count($products) > 0) : ?>
                <?php foreach ($products as $product) : ?>
                    var option = document.createElement('option');
                    option.value = '<?= $product['id'] ?>';
                    option.text = '<?= $product['product_name'] ?>';
                    productSelect.appendChild(option);
                <?php endforeach; ?>
            <?php endif; ?>

            var quantityInput = document.createElement('input');
            quantityInput.type = 'number';
            quantityInput.name = 'order_details[' + orderDetailIndex + '][quantity]';
            quantityInput.placeholder = 'Ilość';
            quantityInput.required = true;

            orderDetail.appendChild(productSelect);
            orderDetail.appendChild(quantityInput);

            orderDetailsContainer.appendChild(orderDetail);
        }
    </script>
</body>
</html>
