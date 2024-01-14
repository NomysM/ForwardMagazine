<?php
include('./connection.php');

$table_name = 'products';
$columns = '*';

try {
    $stmt = $conn->prepare("SELECT $columns FROM $table_name ORDER BY created_at DESC");
    $stmt->execute();

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $products;
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
