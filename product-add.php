<?php
session_start();
if (!isset($_SESSION['user'])) header('location: index.php');
$_SESSION['table']  = 'products';
$_SESSION['redirect_to'] = 'product-add.php';
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
    <title>Dodawanie produktu - ForwardMagazine</title>
</head>
<body>
    <div id="dashboardMainContainer">
    <?php include('./sidebar.php') ?>
        <div class="dashboard_content_container" id="dashboard_content_container">
        <?php include('./topnav.php') ?>
            <div class="dashboard_content">
                <div class="dashboard_content_main">
                    <h1 class="section_header"><i class="fa fa-plus"></i> Dodaj Produkt</h1>
                    <div id="addAppInputCont">
                        <form onsubmit="return validateForm()" action="./add.php" class="addApp"  id="productAddApp" method="POST">
                            <div class="addAppInputCont">
                                <label for="product_name">Nazwa Produktu</label>
                                <input type="text" class="addAppInput" placeholder="Nazwa Produktu" id="product_name"  name="product_name" required/>
                            </div>
                            <div class="addAppInputCont">
                                <label for="description">Opis</label>
                                <textarea class="addAppInput product_text_input" id="description" name="description" required></textarea>
                            </div>
                            <div class="addAppInputCont">
                                <label for="quantity">Ilość</label>
                                <input type="number" class="addAppInput" placeholder="Ilość" id="quantity" name="quantity" required/>
                            </div>
                            <button type="submit"  class="btn-submit">Dodaj produkt</button>
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
            var productNameInput = document.getElementById("product_name");
            var productNameValue = productNameInput.value;

            var quantityInput = document.getElementById("quantity");
            var quantityValue = quantityInput.value;

            if (productNameValue.trim() === "") {
                alert("Proszę podać nazwę produktu.");
                return false;
            }

            if (quantityValue <= 0) {
                alert("Proszę podać poprawną ilość produktu.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
