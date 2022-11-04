<?php
session_start();
if ($_SESSION["logged_in"] != "true") {
    header('Location: sign-in.php');
} else {
    require_once "connect-db.php";
    $userId = $_SESSION["userId"];
    $date = "";

    $sql = "select * from users where userId = '$userId'";
    $sql2 = "select * from orders where userId = '$userId'";
    $statement = $db->prepare($sql);
    $statement2 = $db->prepare($sql2);

    if ($statement->execute() && $statement2->execute()) {
        $user = $statement->fetchAll();
        $statement->closeCursor();
        $orders = $statement2->fetchAll();
        $statement2->closeCursor();
    } else {
        echo "<h3>Error Loading User Account</h3>";
    }
}
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Carlos Guzman">
        <meta name="description" content="eCommerce Site for pet subscription boxes">
        <meta name="keywords" content="pet, ecommerce, pet food, dog, cat">
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-MCWZF70B26"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-MCWZF70B26');
        </script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="icon" href="images/homeIcons/Asset%2033paw.png">
        <link href="https://fonts.googleapis.com/css2?family=Crimson+Text&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="css" type="text/css">
        <script src="js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link rel="stylesheet" href="stylesheet.css" type="text/css">
        <title>Out Fur Delivery | Account</title>
    </head>
    <body>

<?php
include "header.php";
?>

<?php
foreach ($user as $u): ?>
<div class="homePlan container shadow-lg p-0 overflow-hidden">
    <h1 class="productsH1 w-75 m-auto p-5">My Account</h1>

    <div class="row p-5">
        <div class="col-md-3">
            <h3 class="productsH1 w-100 m-auto p-5 shadow"><p>Hi,</p> <?php echo $u["firstName"] . " " . $u["lastName"]; ?></h3>
            <form method="post" action="account-actions.php" class="form">
                <input type="hidden" name="whatToDo" value="overview">
                <input type="submit" value="Overview" class="w-100 bg-light p-3 shadow border-0 mt-1">
            </form>
            <form method="post" action="account-actions.php" class="form">
                <input type="hidden" name="whatToDo" value="myOrders">
                <input type="submit" value="My Orders" class="w-100 bg-light p-3 shadow border-0 mt-1">
            </form>
            <form method="post" action="account-actions.php" class="form">
                <input type="hidden" name="whatToDo" value="myInfo">
                <input type="submit" value="My Information" class="w-100 bg-light p-3 shadow border-0 mt-1">
            </form>
            <form method="post" action="account-actions.php" class="form">
                <input type="hidden" name="whatToDo" value="myAddresses">
                <input type="submit" value="My Addresses" class="w-100 bg-light p-3 shadow border-0 mt-1">
            </form>
            <form method="post" action="account-actions.php" class="form">
                <input type="hidden" name="whatToDo" value="myPayments">
                <input type="submit" value="Payment Methods" class="w-100 bg-light p-3 shadow border-0 mt-1">
            </form>
            <form method="post" action="account-actions.php" class="form">
                <input type="hidden" name="whatToDo" value="logout">
                <input type="submit" value="Logout" class="w-100 bg-light p-3 shadow border-0 mt-1">
            </form>

        </div>
        <div class="col-md-9">
            <?php
            $orderOrder = $orderInformation = $orderAddress = $orderPayment = $orderView = "";
            $orderOrder = $_SESSION['orderOrder'];
            $orderInformation = $_SESSION['orderInformation'];
            $orderAddress = $_SESSION['orderAddress'];
            $orderPayment = $_SESSION['orderPayment'];
            $orderView = $_SESSION['orderView'];

            if ($orderOrder == false && $orderInformation == false && $orderAddress == false && $orderPayment == false && $orderView == false) { ?>
                <img src="images/banners/dog%20banner.jpg" class="img-fluid">
                <?php
            }

            if ($orderOrder == true) { ?>
                <h3 class="productsH1 w-100 m-auto p-5 shadow">Past Orders</h3>
                <?php
                foreach ($orders as $o):
                    $orderId = $o["orderId"];
                    $sql3 = "select * from `order-items` where orderId = '$orderId'";
                    $statement3 = $db->prepare($sql3);

                    if ($statement3->execute()) {
                        $orderItems = $statement3->fetchAll();
                        $statement3->closeCursor();
                    } else {
                        echo  "<h3>Error Loading Order Items</h3>";
                    }

                    $date = date_create($o["orderDate"]);
                    $formatedDate = date_format($date, "M d, Y")
                    ?>
                    <div class="w-100 m-auto p-5 mt-1 shadow">
                        <div class="row">
                            <div class="col-sm-4">
                                <h6>ESTIMATED DELIVERY</h6>
                                <?php if ($o["shipmentType"] == "Standard") {echo "<p>5-10 Days</p>";} else if($o["shipmentType"] == "Priority"){echo "<p>2-5 Days</p>";} else if($o["shipmentType"] == "Express"){echo "<p>1-2 Days</p>";} ?>
                            </div>
                            <div class="col-sm-4">
                                <h6>ORDER NO.</h6>
                                <p><?php echo $o["orderId"]; ?></p>
                            </div>
                            <div class="col-sm-4">
                                <h6>SHIPPED DATE</h6>
                                <p><?php echo $formatedDate?></p>
                            </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-12">
                               <form method="post" action="account-actions.php" class="form">
                                   <input type="hidden" name="orderId" value="<?php echo $orderId?>">
                                   <input type="hidden" name="whatToDo" value="viewOrder">
                                   <input type="submit" value="VIEW ORDER" class="w-100 text-light p-3 shadow border-0 mt-1" style="background-color: rgb(87,106,124)">
                               </form>
                           </div>
                        </div>
                    </div>
                <?php
                endforeach;
            }

            if ($orderView == true) { ?>
                <h3 class="productsH1 w-100 m-auto p-5 shadow">ORDER DETAILS</h3>

                <?php
                foreach ($orders as $o):
                    $orderId = $o["orderId"];
                    $sql3 = "select * from `order-items` where orderId = '$orderId'";
                    $statement3 = $db->prepare($sql3);

                    if ($statement3->execute()) {
                        $orderItems = $statement3->fetchAll();
                        $statement3->closeCursor();
                    } else {
                        echo  "<h3>Error Loading Order Items</h3>";
                    }

                    $date = date_create($o["orderDate"]);
                    $formatedDate = date_format($date, "M d, Y")
                    ?>

                <div class="w-100 p-3 mt-3 shadow">
                    <h5 class="pb-2 border-bottom">Your order has been sent. We hope you love it!</h5>
                    <div class="row">
                        <div class="col-sm-4">
                            <h6>ORDER NO.</h6>
                        </div>
                        <div class="col-sm-4">
                            <p><?php echo $orderId; ?></p>
                        </div>
                        <div class="col-sm-4"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <h6>ORDER DATE</h6>
                        </div>
                        <div class="col-sm-4">
                            <p><?php echo $formatedDate?></p>
                        </div>
                        <div class="col-sm-4"></div>
                    </div>
                </div>

            <div class="w-100 p-3 mt-3 shadow">
                <h5 class="pb-2 border-bottom">DELIVERY DETAILS</h5>
                <div class="row">
                    <div class="col-md-4">
                        <h6 class=" pb-2">DELIVERY ADDRESS:</h6>
                        <p class=""><?php echo $o["name"]; ?><br>
                            <?php echo $o["streetAddress"]; ?><br>
                            <?php echo $o["city"] . ", " . $o["state"]; ?><br>
                            <?php echo $o["zip"]; ?><br>
                            <?php echo $o["phone"]; ?></p><br>

                        <h6 class="pb-2">DELIVERY METHOD:</h6>
                        <p class=""><?php echo $o["shipmentType"]; ?></p><br>

                        <h6 class="pb-2">SUBSCRIPTION EMAIL ADDRESS:</h6>
                        <p class=""><?php echo $o["email"]; ?></p><br>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                </div>
            </div>

                    <?php
                $sql4 = "SELECT * FROM `order-items` INNER JOIN products ON `order-items`.`productId` = products.productId INNER JOIN `product-images` ON products.productId = `product-images`.`productId` where orderId = '$orderId'";
                $sql5 = "SELECT * from `order-subscription-box` INNER JOIN `subscription-boxes` ON `order-subscription-box`.`subscriptionId` = `subscription-boxes`.`subscriptionBoxId` where orderId = '$orderId'";
                $statement4 = $db->prepare($sql4);
                $statement5 = $db->prepare($sql5);

                if ($statement4->execute() && $statement5->execute()) {
                    $orderItems = $statement4->fetchAll();
                    $statement4->closeCursor();
                    $subscription = $statement5->fetchAll();
                    $statement5->closeCursor();
                } else {
                    echo "<h3>Error Loading Item Details</h3>";
                }
                    ?>

            <div class="w-100 p-3 mt-3 shadow">
                <h5 class="pb-2 border-bottom">ORDER ITEMS</h5>
                <div class="row row-cols-1 row-cols-2 row-cols-3">
                    <?php
                    foreach ($orderItems as $oi): ?>
                    <div class="col">
                        <div class="card border-0">
                            <div class="card-img">
                                <img src="productImages/<?php echo $oi["imageLink"]; ?>" class="img-fluid">
                            </div>
                            <div class="card-body">
                                <p><?php echo $oi["productName"]; ?></p>
                                <h6 class="border-bottom">Quantity: <?php echo $oi["quantity"]; ?></h6>
                                <h6 class="border-bottom">Price: $<?php echo $oi["productPrice"]; ?></h6>
                                <h6 class="border-bottom">Total: $<?php echo $oi["total"]; ?></h6>
                            </div>
                        </div>
                    </div>
                    <?php
                    endforeach;
                    foreach ($subscription as $s):
                        if ($s["subscriptionBoxName"] == "Sampler Paw Package") {
                            $imageLink = "tier-box-basic-2.png";
                        } else if ($s["subscriptionBoxName"] == "Playful Paw Package") {
                            $imageLink = "tier-box-premium-2.png";
                        } else if ($s["subscriptionBoxName"] == "Premium Paw Package") {
                            $imageLink = "tier-box-professional-2.png";
                        }
                        ?>
                        <div class="col">
                            <div class="card border-0">
                                <div class="card-img">
                                    <img src="images/pawPackages/<?php echo $imageLink ?>" class="img-fluid">
                                </div>
                                <div class="card-body">
                                    <p><?php echo $s["subscriptionBoxName"]; ?></p>
                                    <h6 class="border-bottom">Quantity: <?php echo $s["quantity"]; ?></h6>
                                    <h6 class="border-bottom">Price: $<?php echo $s["subscriptionBoxPrice"]; ?></h6>
                                    <h6 class="border-bottom">Total: $<?php echo $s["total"]; ?></h6>
                                </div>
                            </div>
                        </div>
                        <?php
                    endforeach;
                        ?>
                </div>
            </div>

            <div class="w-100 p-3 mt-3 shadow">
                <h5 class="pb-2 border-bottom">ORDER TOTAL</h5>
                <div class="row">
                    <div class="col-sm-4">
                        <h5>TOTAL:</h5>
                    </div>
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-4">
                        <h5>$<?php echo $o["cartTotal"]; ?></h5>
                    </div>
                </div>
            </div>
            <?php
                endforeach;
            }



            if ($orderInformation == true) { ?>
            <h3 class="productsH1 w-100 m-auto p-5 shadow">My Information</h3>
                <?php
                $userId = $_SESSION['userId'];

                $sql = "select * from users where userID = '$userId'";
                $statement = $db->prepare($sql);

                if ($statement->execute()) {
                    $userInfo = $statement->fetchAll();
                    $statement->closeCursor();
                } else {
                    echo "<h3>Error Loading User Information</h3>";
                }
                ?>
            <?php
            }



            if ($orderAddress == true) { ?>
            <h3 class="productsH1 w-100 m-auto p-5 shadow">My Addresses</h3>
            <?php
            }



            if ($orderPayment == true) { ?>
            <h3 class="productsH1 w-100 m-auto p-5 shadow">My Payment Methods</h3>
            <?php
            }
            ?>


        </div>
    </div>

</div>
<?php
endforeach;
?>


<?php
include "footer.php";
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </body>
</html>