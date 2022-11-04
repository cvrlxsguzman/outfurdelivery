<?php
session_start();
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
        <title>Out Fur Delivery | Cart</title>
    </head>
    <body>

<?php
include "header.php";
?>

<?php
$con=mysqli_connect("localhost","root","","outfurdelivery");
require_once "connect-db.php";
$orderId = "";
if (isset($_SESSION['orderNum'])) {
    $orderId = $_SESSION['orderNum'];
}

$sql = "Select * from `order-items` inner join products on `order-items`.productId = products.productId INNER JOIN `product-images` ON products.productId = `product-images`.`productId` where `order-items`.orderId = '$orderId'";
$sql2 = "Select * from `order-subscription-box` inner join `subscription-boxes` on `order-subscription-box`.subscriptionId = `subscription-boxes`.subscriptionBoxId where `order-subscription-box`.orderId = '$orderId'";
$statement = $db->prepare($sql);
$statement2 = $db->prepare($sql2);

if ($statement->execute() && $statement2->execute()) {
    $orderProducts = $statement->fetchAll();
    $statement->closeCursor();
    $orderBoxes = $statement2->fetchAll();
    $statement2->closeCursor();
} else {
    echo "<h3>Error Loading Cart Contents</h3>";
}

$result1 = mysqli_query($con, $sql);
$result2 = mysqli_query($con, $sql2);

$prodCount = mysqli_num_rows($result1);
$boxCount = mysqli_num_rows($result2);

if ($prodCount < 1 && $boxCount < 1) { ?>

<div class="homePlan container shadow-lg p-0">
    <h1 class="productsH1 w-75 m-auto p-5">Shopping Cart</h1>
    <img src="icons/Blue%20Icons/cart.png" class="img-fluid "><br>

    <?php
    if (isset($_SESSION["logged_in"])) { ?>
        <a href="products.php" class="btn text-light p-3 m-3 rounded-pill">Add to Cart</a>
        <?php
    } else { ?>
        <a href="sign-in.php" class="btn text-light p-3 m-3 rounded-pill">Click Here to Login</a>
        <?php
    }
    ?>

</div>

<?php
} else { ?>

<div class="homePlan container shadow-lg p-0">
    <h1 class="productsH1 w-75 m-auto p-5">Shopping Cart</h1>
    <div class="row p-5">
        <div class="col-md-8 p-0">
            <?php
            foreach ($orderBoxes as  $ob):
                if ($ob["subscriptionBoxName"] == "Sampler Paw Package") {
                    $imageLink = "tier-box-basic-2.png";
                } else if ($ob["subscriptionBoxName"] == "Playful Paw Package") {
                    $imageLink = "tier-box-premium-2.png";
                } else if ($ob["subscriptionBoxName"] == "Premium Paw Package") {
                    $imageLink = "tier-box-professional-2.png";
                }
                ?>
            <div class="row pb-3">
                <div class="col-sm-5">
                    <img src="images/pawPackages/<?php echo $imageLink?>" class="img-fluid">
                </div>
                <div class="col-sm-7">
                    <h2 class="p-3"><?php echo $ob["subscriptionBoxName"]; ?></h2>
                    <h5>$<?php echo $ob["subscriptionBoxPrice"]; ?></h5>
                        <form class="form pb-2" method="post" action="cart-actions.php">

                            <h5 class="">Quantity:<select name="quantity">
                                    <option value="<?php echo $ob["quantity"]; ?>" selected><?php echo $ob["quantity"]; ?></option>
                                    <option value=""></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </h5>


                            <input type="hidden" name="boxPrice" value="<?php echo $ob["subscriptionBoxPrice"]; ?>">
                            <input type="hidden" name="boxId" value="<?php echo $ob["orderSubscriptionBoxId"]; ?>">
                            <input type="hidden" name="whatToDo" value="updateBoxCart">
                            <input type="submit" value="Update" class="btn text-light p-1 rounded-pill">

                        </form>
                        <form class="form pb-2" method="post" action="cart-actions.php">
                            <input type="hidden" name="boxPrice" value="<?php echo $ob["subscriptionBoxPrice"]; ?>">
                            <input type="hidden" name="boxId" value="<?php echo $ob["orderSubscriptionBoxId"]; ?>">
                            <input type="hidden" name="whatToDo" value="removeBoxCart">
                            <input type="submit" value="Remove" class="btn text-light p-1 rounded-pill">
                        </form>
<!--                    <h4>--><?php //echo $ob["subscriptionBoxDescription"]; ?><!--</h4>-->
                </div>
            </div>
            <?php
            endforeach;
            ?>

            <?php
            foreach ($orderProducts as  $op): ?>
                <div class="row pb-3">
                    <div class="col-sm-5">
                        <img src="productImages/<?php echo $op["imageLink"]; ?>" class="img-fluid">
                    </div>
                    <div class="col-sm-7">
                        <h2 class="p-3"><?php echo $op["productName"]; ?></h2>
                        <h5>$<?php echo $op["productPrice"]; ?></h5>
                        <form class="form pb-2" method="post" action="cart-actions.php">
                            <h5 class="">Quantity:
                                <select name="quantity">
                                    <option value="<?php echo $op["quantity"]; ?>" selected><?php echo $op["quantity"]; ?></option>
                                    <option value=""></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </h5>
                            <input type="hidden" name="itemPrice" value="<?php echo $op["productPrice"]; ?>">
                            <input type="hidden" name="itemId" value="<?php echo $op["orderItemId"]; ?>">
                            <input type="hidden" name="whatToDo" value="updateProdCart">
                            <input type="submit" value="Update" class="btn text-light p-1 rounded-pill">
                        </form>
                        <form class="form pb-2" method="post" action="cart-actions.php">
                            <input type="hidden" name="itemPrice" value="<?php echo $op["productPrice"]; ?>">
                            <input type="hidden" name="itemId" value="<?php echo $op["orderItemId"]; ?>">
                            <input type="hidden" name="whatToDo" value="removeProdCart">
                            <input type="submit" value="Remove" class="btn text-light p-1 rounded-pill">
                        </form>
<!--                        <h4>--><?php //echo $op["productDescription"]; ?><!--</h4>-->
                    </div>
                </div>
            <?php
            endforeach;
            ?>
        </div>

        <div class="col-md-4 p-5">
            <a href="products.php" class="btn text-light p-3 m-3 rounded-pill">Continue Shopping</a>
            <div class="card">
                <div class="card-header-pills">
                    <h2>Order Summary</h2>
                </div>
                <div class="card-body">
                    <?php
                    foreach ($orderBoxes as $ob): ?>
                    <h6><?php echo $ob["subscriptionBoxName"]; ?></h6>
                    <h6>Quantity: <?php echo $ob["quantity"]; ?></h6>
                    <h6 class="pb-3">Total Price: $<?php echo $ob["total"]; ?></h6>
                    <?php
                    endforeach;
                    ?>
                    <?php
                    foreach ($orderProducts as $op): ?>
                        <h6><?php echo $op["productName"]; ?></h6>
                        <h6>Quantity: <?php echo $op["quantity"]; ?></h6>
                        <h6 class="pb-3">Total Price: $<?php echo $op["total"]; ?></h6>
                    <?php
                    endforeach;
                    $num = $_SESSION['cartTotal'];
                    $formattedNum = number_format($num, 2);
                    ?>
                    <h2>Total: $<?php echo $formattedNum?></h2>
                </div>
                <a href="checkout.php" class="btn text-light p-3 m-3 rounded-pill">Check Out</a>
            </div>
        </div>
    </div>

</div>

<?php
}
?>


<?php
include "footer.php";
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </body>
</html>

