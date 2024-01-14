<?php
session_start();

include('./table_columns.php');

$table_name = $_SESSION['table'];
$columns = $table_columns_map[$table_name];

$db_arr = [];
$user = $_SESSION['user'];

foreach($columns as $column) {
    if (in_array($column, ['created_at', 'updated_at'])) {
        $value = date('Y-m-d H:i:s');
    } elseif ($column == 'created_by') {
        $value = $user['id'];
    } else {
        $value = isset($_POST[$column]) ? $_POST[$column] : '';
    }

    if ($column == 'password' && !empty($_POST['password'])) {
        $value = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }

    $db_arr[$column] = $value;
}

$columns[] = 'quantity';
$db_arr['quantity'] = isset($_POST['quantity']) ? $_POST['quantity'] : '';

$table_prop = implode(", ", array_keys($db_arr));
$table_place = ':' . implode(", :", array_keys($db_arr));

try {
    $insert = "INSERT INTO $table_name($table_prop) VALUES ($table_place)";

    include('./connection.php');

    $stmt = $conn->prepare($insert);
    $stmt->execute($db_arr);

    $response = [
        'success' => true,
        'message' => 'Pomyślnie dodano do bazy.'
    ];
} catch (PDOException $e) {
    $response = [
        'success' => false,
        'message' => $e->getMessage()
    ];
}

$_SESSION['response'] = $response;

header('location: ./' . $_SESSION['redirect_to']);
?>
