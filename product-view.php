<?php
session_start();
if (!isset($_SESSION['user'])) header('location: index.php');

$_SESSION['table']  = 'products';
$user  = $_SESSION['user'];

$products = include('./show-products.php');

if (isset($_GET['delete_product_id'])) {
    $deleteProductId = $_GET['delete_product_id'];

    include('./connection.php');

    try {
        $stmt = $conn->prepare("DELETE FROM products WHERE id = :deleteProductId");
        $stmt->bindParam(':deleteProductId', $deleteProductId, PDO::PARAM_INT);
        
        $stmt->execute();

        header('location: product-view.php');
        exit();
    } catch (PDOException $e) {
        echo "Błąd: " . $e->getMessage();
    }
}

if (isset($_POST['update_quantity'])) {
    $productId = $_POST['product_id'];
    $newQuantity = $_POST['new_quantity'];

    include('./connection.php');

    try {
        $stmt = $conn->prepare("UPDATE products SET quantity = :newQuantity WHERE id = :productId");
        $stmt->bindParam(':newQuantity', $newQuantity, PDO::PARAM_INT);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        
        $stmt->execute();

        header('location: product-view.php');
        exit();
    } catch (PDOException $e) {
        echo "Błąd: " . $e->getMessage();
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
    <title>Produkty - ForwardMagazine</title>
</head>
<body>
    <div id="dashboardMainContainer">
    <?php  include('./sidebar.php') ?>
        <div class="dashboard_content_container" id="dashboard_content_container">
        <?php  include('./topnav.php')  ?>
            <div class="dashboard_content">
                <div class="dashboard_content_main">
                    <h1 class="section_header"><i class="fa fa-plus"></i> Produkty</h1>
                    <div class="section_content">
                        <div class="users">
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nazwa Produktu</th>
                                        <th>Opis</th>
                                        <th>Ilość</th>
                                        <th>Dodane przez</th>
                                        <th>Stworzone</th>
                                        <th>Zaktualizowane</th>
                                        <th>Usuń</th>
                                        <th>Aktualizuj Ilość</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($products as $index => $product){ 
                                    ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= $product['product_name'] ?></td>
                                        <td><?= $product['description'] ?></td>
                                        <td><?= $product['quantity'] ?></td>
                                        <td><?= $product['created_by'] ?></td>
                                        <td><?= date('F d,Y', strtotime($product['created_at']))?></td>
                                        <td><?= date('F d,Y', strtotime($product['updated_at'])) ?></td>
                                        <td><a href="?delete_product_id=<?= $product['id'] ?>" onclick="return confirm('Czy na pewno chcesz usunąć ten produkt?')"><i class="fa fa-trash"></i>  Usuń</a></td>
                                        <td>
                                            <form class="update-form" method="post" action="product-view.php">
                                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                                <input type="number" name="new_quantity" value="<?= $product['quantity'] ?>" min="0" required>
                                                <button type="submit" name="update_quantity">Aktualizuj</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/script.js"></script>
</body>
</html>
