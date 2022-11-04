<div class="container p-0">
    <footer class="footer p-5">
        <div class="row">
            <div class="col-sm-6">
                <?php
                if (isset($_SESSION["logged_in"])  && isset($_SESSION["admin_logged_in"])) {
                    if ($_SESSION["logged_in"] == true && $_SESSION["admin_logged_in"] == true) { ?>
                        <a href="admin-add.php" class="btn btn-dark">Admin</a>
                        <?php
                    }
                }
                ?>
                <a href="#" class="btn btn-link text-dark">Manage Account</a>
                <a href="aboutus.php" class="btn btn-link text-dark">Contact Us</a>
                <a href="aboutus.php" class="btn btn-link text-dark">FAQ</a>
                <a href="aboutus.php" class="btn btn-link text-dark">About Us</a>
                <p class="p-3">All Rights Reserved 2020 © Out Fur Delivery</p>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-3">

                    </div><div class="col-sm-3">
                        <a href="http://www.facebook.com"><img src="images/social/facebookicon-04.png" class="img-fluid"></a>
                    </div>
                    <div class="col-sm-3">
                        <a href="https://www.instagram.com/outfurdelivery/"><img src="images/social/instagramicon-04.png" class="img-fluid"></a>
                    </div>
                    <div class="col-sm-3">
                        <a href="http://www.twitter.com"><img src="images/social/twittericon-04.png" class="img-fluid"></a>
                    </div>
                </div>

            </div>
        </div>

    </footer>
</div>