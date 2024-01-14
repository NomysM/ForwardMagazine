<?php
    session_start();
    if(!isset($_SESSION['user'])) header('location: index.php');
    $_SESSION['table']  = 'users';
    $user  = $_SESSION['user'];

    $users = include('./display-users.php');

    if (isset($_GET['delete_user_id'])) {
        $deleteUserId = $_GET['delete_user_id'];
    
        include('./connection.php');
    
        try {
            $stmt = $conn->prepare("DELETE FROM users WHERE id = :deleteUserId");
            $stmt->bindParam(':deleteUserId', $deleteUserId, PDO::PARAM_INT);
            
            $stmt->execute();
    
            header('location: panel.php');
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
    <title>Użytkownicy - ForwardMagazine</title>
</head>
<body>
    <div id="dashboardMainContainer">
    <?php  include('./sidebar.php') ?>
        <div class="dashboard_content_container" id="dashboard_content_container">
        <?php  include('./topnav.php')  ?>
            <div class="dashboard_content">
                <div class="dashboard_content_main">
                    <h1 class="section_header"><i class="fa fa-plus"></i> Konta</h1>
                    <div class="section_content">
                        <div class="users">
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Imie</th>
                                        <th>Nazwisko</th>
                                        <th>Email</th>
                                        <th>Stworzone</th>
                                        <th>Zaktualizowane</th>
                                        <th>Usuń</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($users as $index => $user){ 
                                    ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= $user['first_name'] ?></td>
                                        <td><?= $user['last_name'] ?></td>
                                        <td><?= $user['email'] ?></td>
                                        <td><?= date('F d,Y', strtotime($user['created_at']))?></td>
                                        <td><?= date('F d,Y', strtotime($user['updated_at'])) ?></td>
                                        <td><a href="?delete_user_id=<?= $user['id'] ?>" onclick="return confirm('Czy na pewno chcesz usunąć tego użytkownika?')"><i class="fa fa-trash"></i> Usuń</a></td>
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