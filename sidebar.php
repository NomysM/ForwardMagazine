<div class="dashboard_sidebar" id="dashboard_sidebar">
            <h3 class="dashboard_logo" id="dashboard_logo" id="forwardmagazine">FM</h3>
            <div class="dashboard_sidebar_user">
                <div class="dashboard_sidebar_logo"></div>
                    <span class style="color: #fff;"><?= $user['first_name'] . ' ' . $user['last_name']?></span>
                    <hr style="color:yellow; width:100%">
                </div>
            <div class="dashboard_sidebar_menus">
                <ul class="dashboard_menu_lists">
                    <li>
                        <a href="./panel.php" class="menuActive"><i class="fa fa-dashboard"></i> <span class="menuText">Panel</span></a>
                    </li>
                    <li>
                    <a href="javascript:void(0);" class="liMainLink"><i class="fa fa-archive"></i> <span class="menuText">Produkt</span><i class="fa fa-angle-up mainMenuIconArrow"></i></a>
                            <ul class="downMenus" id="user">
                                <a href="./product-add.php" class="downMenusLink"><i class="fa fa-circle-o"></i> Dodaj produkt</a>
                                <a href="./product-view.php" class="downMenusLink"><i class="fa fa-circle-o"></i> Produkty</a>
                            </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="liMainLink"><i class="fa fa-user"></i> <span class="menuText">Zarządzanie Kontami</span><i class="fa fa-angle-up mainMenuIconArrow"></i></a>
                            <ul class="downMenus" id="user2">
                                <a href="./add-user.php" class="downMenusLink"><i class="fa fa-circle-o"></i> Dodaj konto</a>
                                <a href="./show-users.php" class="downMenusLink"><i class="fa fa-circle-o"></i> Konta</a>
                            </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="liMainLink"><i class="fa fa-truck"></i> <span class="menuText">Zamówienia</span><i class="fa fa-angle-up mainMenuIconArrow"></i></a>
                            <ul class="downMenus" id="user2">
                                <a href="./order.php" class="downMenusLink"><i class="fa fa-circle-o"></i> Utwórz zamówienie</a>
                                <a href="./order-view.php" class="downMenusLink"><i class="fa fa-circle-o"></i> Zamówienia</a>
                            </ul>
                    </li>
                    <li>
                        <a href="./report.php" class="menuActive"><i class="fa fa-file-pdf-o"></i> <span class="menuText">Raport</span></a>
                    </li>
                </ul>
            </div>
        </div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var mainLinks = document.querySelectorAll('.liMainLink');
    var submenus = document.querySelectorAll('.downMenus');

    for (var i = 0; i < mainLinks.length; i++) {
        mainLinks[i].addEventListener('click', function () {
            var currentSubMenu = this.nextElementSibling;

            for (var j = 0; j < submenus.length; j++) {
                if (submenus[j] !== currentSubMenu) {
                    submenus[j].style.display = 'none';
                }
            }

            if (currentSubMenu.style.display === 'none') {
                currentSubMenu.style.display = 'block';
            } else {
                currentSubMenu.style.display = 'none';
            }
        });
    }
});


</script>