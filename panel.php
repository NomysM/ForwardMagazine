<?php
    session_start();
    if(!isset($_SESSION['user'])) header('location: index.php');
    $user  = $_SESSION['user'];

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <script src="https://use.fontawesome.com/0c7a3095b5.js"></script>
    <title>Panel Sterowania - ForwardMagazine</title>
    <style>
        body {
            overflow-y: hidden;
        }
    </style>
</head>
<body>
    <div id="dashboardMainContainer">
    <?php  include('./sidebar.php') ?>
        <div class="dashboard_content_container" id="dashboard_content_container">
            <?php  include('./topnav.php')  ?> 
            <div class="dashboard_content">
                <div class="dashboard_content_main">
                    <div class="wallpaper">
                        <h1>ForwardMagazine</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/script.js"></script>
</body>
</html>