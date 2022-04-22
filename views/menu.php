<?php

    $pageIndex = '';
    $pageAddUser = '';

    if (basename($_SERVER['PHP_SELF'], '.php') == "index") {
        $pageIndex = 'active';
    }else{
        $pageAddUser = 'active';
    }

?>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.php" class="app-brand-link">
            <img src="../assets/img/admin-page/logo.png" alt="Home Image" width="75%" height="75%"/>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        <li class="menu-item <?php echo $pageIndex; ?>">
            <a href="index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">User Management</span>
        </li>

        <li class="menu-item <?php echo $pageAddUser; ?>">
            <a href="add_user.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-folder-plus"></i>
                <div data-i18n="Analytics">Add New User</div>
            </a>
        </li>

    </ul>
</aside>
