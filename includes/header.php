<link rel="stylesheet" type="text/css" href="css/nav.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/nav.js"> </script>
<script src="js/popper.min.js"></script>
<header>
        

    <nav class="menu_open navbar_nav">
        <ul class="menu_open navbar_ul">
            <li class="menu_li">
                <a class="navbar-brand" href="index.php">
                    <img id="brand-image" alt="Website Logo" src="images/logo.png" width="100px" height="80px">
                </a>
            </li>

            <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) { ?>
                <?php if ($_SESSION["session_role"] == 1) {    // admin ?>
                    <li class="menu_li">
                        <a class="menu_a" href="user_list.php">Users</a>
                    </li>
                    <li class="menu_li">
                        <a class="menu_a" href="car_list.php">Cars</a>
                    </li>
                    <li class="menu_li">
                        <a class="menu_a" href="rent_request.php">Rent Requests</a>
                    </li>
                    <li class="menu_li">
                        <a class="menu_a" href="profile.php">Profile</a>
                    </li>
                    <li class="menu_li">
                        <a class="menu_a" href="logout.php">Logout</a>
                    </li>
                <?php } else if ($_SESSION["session_role"] == 2) { // staff ?>
                    <li class="menu_li">
                        <a class="menu_a" href="car_list.php">Cars</a>
                    </li>
                    <li class="menu_li">
                        <a class="menu_a" href="rent_request.php">Rent Requests</a>
                    </li>
                    <li class="menu_li">
                        <a class="menu_a" href="profile.php">Profile</a>
                    </li>
                    <li class="menu_li">
                        <a class="menu_a" href="logout.php">Logout</a>
                    </li>
                <?php } else {  // user/customer ?>
                    <li class="menu_li">
                        <a class="menu_a" href="index.php">Home</a>
                    </li>
                    <li class="menu_li">
                        <a class="menu_a" href="profile.php">Profile</a>
                    </li>
                    <li class="menu_li">
                        <a class="menu_a" href="logout.php">Logout</a>
                    </li>
                <?php } ?>

            <?php } else { ?>

                <li class="menu_li">
                    <a class="menu_a" href="index.php">Home</a>
                </li>
                <li class="menu_li">
                    <a class="menu_a" href="login.php">Login</a>
                </li>
                <li class="menu_li">
                    <a class="menu_a" href="register.php">Register</a>
                </li>

            <?php } ?>

        </ul>
    </nav>
</header>