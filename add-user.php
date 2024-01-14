<?php
session_start();
if (!isset($_SESSION['user'])) header('location: index.php');
$_SESSION['table']  = 'users';
$_SESSION['redirect_to'] = 'add-user.php';
$user  = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <script src="https://use.fontawesome.com/0c7a3095b5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/validator/13.5.0/validator.min.js"></script>
    <title>Dodawanie użytkownika - ForwardMagazine</title>
</head>
<body>
    <div id="dashboardMainContainer">
    <?php include('./sidebar.php') ?>
        <div class="dashboard_content_container" id="dashboard_content_container">
        <?php include('./topnav.php') ?>
            <div class="dashboard_content">
                <div class="dashboard_content_main">
                    <h1 class="section_header"><i class="fa fa-plus"></i> Dodaj użytkownika</h1>
                    <div id="addAppInputCont">
                    <form onsubmit="return validateForm()" action="./add.php" class="addApp"  id="userAddApp" method="POST">
                            <div class="addAppInputCont">
                                <label for="">Imie</label>
                                <input type="text" class="addAppInput" id="first_name"  name="first_name" required/>
                            </div>
                            <div class="addAppInputCont">
                                <label for="">Nazwisko</label>
                                <input type="text" class="addAppInput" id="last_name"  name="last_name" required/>
                            </div>
                            <div class="addAppInputCont">
                                <label for="">Email</label>
                                <input type="text" class="addAppInput" id="email"  name="email" placeholder="przykladowy@exmaple.com" required/>
                            </div>
                            <div class="addAppInputCont">
                                <label for="">Hasło</label>
                                <input type="password" class="addAppInput" id="password"  name="password" required/>
                            </div>
                            <button type="submit"  class="btn-submit">Dodaj użytkownika</button>
                    </form>
                    <?php
                        if(isset($_SESSION['response'])){
                            $response_message = $_SESSION['response']['message'];
                            $is_success = $_SESSION['response']['success'];
                    ?>
                        <div class="responseMessage">
                            <p class="responseMessage <?= $is_success ? 'responseMessage__success' : 'responseMessage__error' ?>">
                            <?php echo $response_message ?>
                            </p>
                        </div>
                    <?php unset($_SESSION['response']); } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/script.js"></script>
    <script>
        function validateForm() {
            var emailInput = document.getElementById("email");
            var emailValue = emailInput.value;

            if (!validator.isEmail(emailValue)) {
                alert("Proszę podać poprawny adres email.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
