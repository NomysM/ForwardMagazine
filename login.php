<?php
    session_start();

    if(isset($_SESSION['user'])) header('location: panel.php');
    $error_message = '';

    if($_POST){
        include('connection.php');
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :username");
        $stmt->bindParam(':username', $username);

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $user = $stmt->fetch();

        if($user && password_verify($password, $user['password'])){
            $_SESSION['user'] = $user;
            header('Location: panel.php');
        } else {
            $error_message = "Błędnie wprowadzony login lub hasło użytkownika";
        }
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ForwardMagazine</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <?php
        if(!empty($error_message)){ ?>
    <div id="errorMessage">
        <p>Error: <?= $error_message ?></p>
    </div>
    <?php } ?>
    <div class="container">
        <div class="loginHeader">
            <h1>ForwardMagazine</h1>
        </div>
        <div class="loginBody">
            <form action="login.php" method="POST">
                <div class="loginInputContainer">
                    <label for="">Login</label>
                    <input type="text" name="username" placeholder="Nazwa Użytkownika" />
                </div>
                <div class="loginInputContainer">
                    <input type="password" name="password" placeholder="Hasło"/>
                </div>
                <div class="loginButtonContainer">
                    <button name="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>