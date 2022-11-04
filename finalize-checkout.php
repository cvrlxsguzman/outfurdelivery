<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header('Location: sign-in.php');
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
        <title>Out Fur Delivery | Checkout</title>
    </head>
    <body>

<?php
include "header.php";
?>

<?php
require_once "connect-db.php";
$orderId = $userId = "";

$orderId = $_SESSION['orderNum'];
$userId = $_SESSION['userId'];

$sql = "SELECT * from orders INNER JOIN shipping ON orders.shipmentId = shipping.shippingId WHERE orders.orderId = '$orderId'";
$sql2 = "SELECT * FROM `order-items` INNER JOIN products ON `order-items`.`productId` = products.productId INNER JOIN `product-images` ON `products`.`productId` = `product-images`.`productId` WHERE `order-items`.`orderId` = '$orderId'";
$sql3 = "SELECT * FROM `order-subscription-box` INNER JOIN `subscription-boxes` ON `order-subscription-box`.`subscriptionId` = `subscription-boxes`.`subscriptionBoxId` INNER JOIN `subscription-images` ON `subscription-boxes`.`subscriptionBoxId` = `subscription-images`.`subscriptionBoxId` WHERE `order-subscription-box`.`orderId` = '$orderId'";
$statement1 = $db->prepare($sql);
$statement2 = $db->prepare($sql2);
$statement3 = $db->prepare($sql3);

if ($statement1->execute() && $statement2->execute() && $statement3->execute()) {
    $order = $statement1->fetchAll();
    $statement1->closeCursor();
    $orderItems = $statement2->fetchAll();
    $statement2->closeCursor();
    $orderBoxes = $statement3->fetchAll();
    $statement3->closeCursor();
} else {
    echo '<h3>Error Loading Order</h3>';
}
?>


<div class="container shadow-lg p-0">
    <h1 class="productsH1 w-75 m-auto p-5">Thank you for your order!</h1>
    <div class="m-auto w-25">
        <button class="print btn btn-dark text-light p-3 mt-3 mb-3 w-100 rounded-pill" onclick="window.print()">Print this page</button>
    </div>
    <div class="shadow p-5 mb-1 ml-5 mr-5">
        <h3 class="productsH1 w-75 m-auto pb-3">ORDER DETAILS</h3>
        <?php
        foreach ($order as $o):
            $date = date_create($o["orderDate"]);
            $formatedDate = date_format($date, "M d, Y")
            ?>
            <p>TOTAL: <b>$<?php echo $o["cartTotal"] + $o["taxAmount"] + $o["shippingCost"]; ?></b></p>
            <p>ORDER NUMBER: <b><?php echo $o["orderId"]; ?></b></p>
            <p>ORDER DATE: <b><?php echo $formatedDate ?></b></p>
            <p>SHIPPING: <b><?php echo $o["shippingName"];?></b></p>
            <p>EST. DELIVERY: <b><?php echo $o["shippingTime"] ?></b></p>
        <?php
        endforeach;
        ?>
    </div>
    <div class="shadow p-5 mb-1 ml-5 mr-5">
        <h3 class="productsH1 w-75 m-auto pb-3">CUSTOMER DETAILS</h3>
        <?php
        foreach ($order as $o):
            $date = date_create($o["orderDate"]);
            $formatedDate = date_format($date, "M d, Y")
            ?>
            <p>NAME: <b><?php echo $o["name"]; ?></b></p>
            <p>EMAIL: <b><?php echo $o["email"]; ?></b></p>
            <p>PHONE: <b><?php echo $o["phone"]; ?></b></p>
            <p>ADDRESS: <b><?php echo $o["streetAddress"]; ?></b></p>
            <p>CITY: <b><?php echo $o["city"]; ?></b></p>
            <p>STATE: <b><?php echo $o["state"]; ?></b></p>
            <p>ZIP: <b><?php echo $o["zip"]; ?></b></p>
            <p>CARD NAME: <b><?php echo $o["cardName"];?></b></p>
            <p>CARD NUMBER: <b><?php echo $o["cardNumber"] ?></b></p>
            <p>CARD EXP: <b><?php echo $o["expirationDate"]; ?></b></p>
        <?php
        endforeach;
        ?>
    </div>
    <div class="shadow p-5 mb-1 ml-5 mr-5">
        <h3 class="productsH1 w-75 m-auto pb-3">ORDER ITEMS</h3>
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
            foreach ($orderBoxes as $s):
                ?>
                <div class="col">
                    <div class="card border-0">
                        <div class="card-img">
                            <img src="images/pawPackages/<?php echo $s["subscriptionImageLink"] ?>" class="img-fluid">
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
</div>


<?php
include "footer.php";
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </body>
</html>
