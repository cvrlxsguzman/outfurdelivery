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
        <title>Out Fur Delivery | Checkout</title>
    </head>
    <body>

<?php
include "header.php";
?>


<?php
$con=mysqli_connect("localhost","root","","outfurdelivery");
require_once "connect-db.php";
$orderId = "";
$userId = $_SESSION["userId"];
if (isset($_SESSION['orderNum'])) {
    $orderId = $_SESSION['orderNum'];
}

$sql = "Select * from `order-items` inner join products on `order-items`.productId = products.productId INNER JOIN `product-images` ON products.productId = `product-images`.`productId` where `order-items`.orderId = '$orderId'";
$sql2 = "Select * from `order-subscription-box` inner join `subscription-boxes` on `order-subscription-box`.subscriptionId = `subscription-boxes`.subscriptionBoxId where `order-subscription-box`.orderId = '$orderId'";
$sql3 = "select * from users where userId = '$userId'";
$statement = $db->prepare($sql);
$statement2 = $db->prepare($sql2);
$statement3 = $db->prepare($sql3);

if ($statement->execute() && $statement2->execute() && $statement3->execute()) {
    $orderProducts = $statement->fetchAll();
    $statement->closeCursor();
    $orderBoxes = $statement2->fetchAll();
    $statement2->closeCursor();
    $user = $statement3->fetchAll();
    $statement3->closeCursor();
} else {
    echo "<h3>Error Loading Cart Contents</h3>";
}

$result1 = mysqli_query($con, $sql);
$result2 = mysqli_query($con, $sql2);

$prodCount = mysqli_num_rows($result1);
$boxCount = mysqli_num_rows($result2);

if ($prodCount < 1 && $boxCount < 1) { ?>

    <div class="homePlan container shadow-lg p-0">
        <h1 class="productsH1 w-75 m-auto p-5">Checkout</h1>
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
        <h1 class="productsH1 w-75 m-auto p-5">Checkout</h1>
        <div class="row p-5">
            <div class="col-md-6 p-0">
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
                            <h5>Quantity: <?php echo $ob["quantity"]; ?></h5>
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
                            <h5>Quantity: <?php echo $op["quantity"]; ?></h5>
                        </div>
                    </div>
                <?php
                endforeach;
                ?>
            </div>

            <?php
            foreach ($user as $u): ?>
            <div class="col-md-6 pl-5">
                <div class="customer card">
                    <div class="card-body">
                        <h1 class="productsH1 w-100 m-auto pb-3">Customer Information</h1>
                        <form class="form" method="post" action="cart-actions.php">
                            <input name="email" type="email" value="<?php echo $u["email"]; ?>" placeholder="E-Mail" class="form-control rounded-pill mb-3" required>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <input name="firstName" type="text" value="<?php echo $u["firstName"]; ?>"  placeholder="First Name" class="form-control rounded-pill" required>
                                </div>
                                <div class="col-md-6">
                                    <input name="lastName" type="text" value="<?php echo $u["lastName"]; ?>"  placeholder="Last Name" class="form-control rounded-pill" required>
                                </div>
                            </div>
                            <input name="phone" type="tel" value="<?php echo $u["phone"]; ?>"  placeholder="Phone" class="form-control rounded-pill mb-3" required>
                            <input name="address" type="text" placeholder="Address" class="form-control rounded-pill mb-3" required>
                            <input name="apt" type="text" placeholder="Apt. Suite, ect." class="form-control rounded-pill mb-3">
                            <input name="city" type="text" placeholder="City" class="form-control rounded-pill mb-3" required>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <input name="state" type="text" placeholder="State Abv" class="form-control rounded-pill" required>
                                </div>
                                <div class="col-md-6">
                                    <input name="zip" type="tel" placeholder="Zip Code" class="form-control rounded-pill" required>
                                </div>
                            </div>

                            <h1 class="productsH1 w-100 m-auto pb-3">Card Information</h1>
                            <input name="cardName" type="text" placeholder="Name" class="form-control rounded-pill mb-3" required>
                            <input name="cardNumber" type="tel" placeholder="Credit/Debit Card Number" class="form-control rounded-pill mb-3" required>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <input name="cardCVV" type="tel" placeholder="CVV" class="form-control rounded-pill" required>
                                </div>
                                <div class="col-md-6">
                                    <input name="cardExp" type="text" placeholder="Exp Date MM/YY" class="form-control rounded-pill" required>
                                </div>
                            </div>

                            <select name="shipping" class="form-control" id="shipping" required>
                                <option value="1" selected>
                                    <h3>Standard Shipping - $0.00</h3>
                                    <p>5-10 Business Days</p>
                                </option>
                                <option value="2">
                                    <h3>Priority Shipping - $10.00</h3>
                                    <p>2-5 Business Days</p>
                                </option>
                                <option value="3">
                                    <h3>Express Shipping - $20.00</h3>
                                    <p>1-2 Days</p>
                                </option>
                            </select>


                            <h4>Sub-total: $<?php echo number_format($_SESSION['cartTotal'], 2) ?></h4>
                            <h4>Tax: $<?php echo number_format($_SESSION['cartTotal'] * .05, 2)?></h4>
                            <h4>Total Excluding Shipping: $<?php echo number_format(($_SESSION['cartTotal'] * .05) + $_SESSION['cartTotal'], 2)?></h4>


                            <input type="hidden" name="whatToDo" value="checkout">
                            <input type="submit" value="Checkout" class="btn text-light p-3 mt-3 mb-3 w-100 rounded-pill">
                        </form>
                    </div>
                </div>
            </div>
                <?php
            endforeach;
                ?>
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