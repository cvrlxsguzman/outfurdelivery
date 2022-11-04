<div class="container p-0">
    <footer class="footer p-5">
        <div class="footerNav w-50">
            <?php
            if (isset($_SESSION["logged_in"])  && isset($_SESSION["admin_logged_in"])) {
                if ($_SESSION["logged_in"] == true && $_SESSION["admin_logged_in"] == true) { ?>
                    <a href="../admin-add.php" class="btn btn-dark">Admin</a>
            <?php
                }
            }
            ?>
            <a href="../account.php" class="btn btn-link text-dark">Manage Account</a>
            <a href="../contactUs.php" class="btn btn-link text-dark">Contact Us</a>
            <a href="../faq.php" class="btn btn-link text-dark">FAQ</a>
            <a href="../aboutUs.php" class="btn btn-link text-dark">About Us</a>
            <p class="p-3">All Rights Reserved 2020 © Out Fur Delivery</p>
        </div>
        <div class="footerLinks w-50">

        </div>

    </footer>
</div>