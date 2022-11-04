<div class="container shadow-lg p-3 sticky-top bg-light">
    <header>
        <div class="searchbar">
            <input type="text" name="searchbar" placeholder="Search" class="search_input">
            <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
        </div>

        <img src="../images/logo-04.png" class="">

        <nav class="w-75 m-auto pt-3">
            <a href="../index.php" class="btn btn-light">Home</a>
            <a href="../products.php" class="btn btn-light">Products</a>
            <a href="../products/subscription-box.php" class="btn btn-light">Subscription Boxes</a>
            <a href="../aboutus.php" class="btn btn-light">About Us</a>
            <div class="dropdown show float-right">
                <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Account
                </a>

                <div class="dropdown-menu shadow-lg" aria-labelledby="dropdownMenuLink">
                    <?php
                    if (isset($_SESSION["logged_in"])) {
                        if ($_SESSION["logged_in"] == true) { ?>
                            <a class="dropdown-item" href="../logout.php">Logout</a>
                            <?php
                        }
                    } else { ?>
                        <a class="dropdown-item" href="../sign-in.php">Sign In</a>
                        <?php
                    }
                    ?>
                    <a class="dropdown-item" href="#">Account</a>
                    <a class="dropdown-item" href="#">My Orders</a>
                </div>
            </div>
        </nav>

    </header>
</div>