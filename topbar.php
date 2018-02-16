<!-- BEGIN TOPBAR -->
<div class="topbar">
    <div class="header-left">
        <div class="topnav">
            <a class="menutoggle" href="#" data-toggle="sidebar-collapsed"><span class="menu__handle"><span>Menu</span></span></a>
        </div>
    </div>
    <div class="header-right">
        <ul class="header-menu nav navbar-nav">
            <?php
            if (!$_SESSION['is_logged_admin']) {
                ?>
                <li>
                    <a class="btn-primary" href="index.php?menu=login">Login / Register</a>
                </li>
                <?php
            } else {
                ?>
                <!-- BEGIN USER DROPDOWN -->
                <li class="dropdown" id="user-header">
                    <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img src="./assets/global/images/avatars/user1.png" alt="user image">
                        <span class="username"><?php echo $_SESSION['nama_user'] ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="index.php?menu=profile"><i class="icon-user"></i><span>My Profile</span></a>
                        </li>
                        <li>
                            <a href="index.php?menu=logout"><i class="icon-logout"></i><span>Logout</span></a>
                        </li>
                    </ul>
                </li>
                <!-- END USER DROPDOWN -->
                <?php
            }
            ?>
        </ul>
    </div>
    <!-- header-right -->
</div>
<!-- END TOPBAR -->