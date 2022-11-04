<?php
session_start();
$link = $_SERVER['REQUEST_URI'];
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
    <title>Out Fur Delivery | Products Details | </title>
</head>
<body>

<?php
include "header.php";
?>


<?php
require_once "connect-db.php";
$productId = "";
$productId = substr($link, strpos($link, "=") + 1);

$sql = "SELECT * from products WHERE products.productId = '$productId'";
$sql2 = "SELECT * from `product-images` WHERE `product-images`.productId = '$productId'";
$sql3 = "SELECT * from `product-categories` WHERE `product-categories`.productId = '$productId'";
$sql4 = "SELECT * from `product-key-points` WHERE `product-key-points`.productId = '$productId'";
//$sql4 = "SELECT * from `product-attributes` WHERE `product-attributes`.productId = '$productId'";
//$sql5 = "SELECT * from inventory WHERE inventory.productId = '$productId'";
//$sql4 = "SELECT * from inventory INNER JOIN `product-attributes` ON inventory.productAttributeId = `product-attributes`.productAttributeId WHERE inventory.productId = '$productId' AND stock > 0";
$statement = $db->prepare($sql);
$statement2 = $db->prepare($sql2);
$statement3 = $db->prepare($sql3);
$statement4 = $db->prepare($sql4);
//$statement4 = $db->prepare($sql4);
//$statement5 = $db->prepare($sql5);

if ($statement->execute() && $statement2->execute() && $statement3->execute() && $statement4->execute()) {
    $product = $statement->fetchAll();
    $statement->closeCursor();
    $productImages = $statement2->fetchAll();
    $statement2->closeCursor();
    $productCategories = $statement3->fetchAll();
    $statement3->closeCursor();
    $keyPoints = $statement4->fetchAll();
    $statement4->closeCursor();
//    $productAttributes = $statement4->fetchAll();
//    $statement4->closeCursor();
//    $inventory = $statement5->fetchAll();
//    $statement5->closeCursor();
} else {
    echo "<h3>Error Loading Product</h3>";
}
?>
<?php
foreach ($product as $p): ?>
<div class="container shadow-lg p-0">
    <div class="row">
        <div class="col-md-12">
            <p class="p-3"><a href="index.php" class="text-dark">Home</a> > <a href="products.php" class="text-dark">Products</a> > <?php echo $p["productName"]; ?></p>
        </div>
    </div>
</div>
<?php
endforeach;
?>

<div class="cart container shadow-lg p-0">
    <div class="row">
        <div class="col-md-7">
            <?php
            foreach ($productImages as $pi): ?>
            <img src="productImages/<?php echo $pi["imageLink"] ?>" class="img-fluid p-5">
            <?php
            endforeach;
            ?>
        </div>
        <div class="col-md-5 p-5">
            <?php
            foreach ($product as $p): ?>
            <h2><?php echo $p["productName"]; ?></h2>
            <h2 class="font-weight-bold">$<?php echo $p["productPrice"]; ?></h2>
            <?php
            endforeach;
            ?>
            <h6 class="font-weight-light">Free Shipping & Returns</h6><br>
            <?php
            foreach ($keyPoints as $kp): ?>
                <p>• <?php echo $kp["keyPoint"]; ?></p>
            <?php
            endforeach;
            ?>


            <form method="post" action="cart-actions.php">
<!--                <label>Color:-->
<!--                    <select name="color">-->
<!--                        --><?php
//                        foreach ($productAttributes as $pa):
//                            if ($pa["attribute"] == "color") { ?>
<!--                                <option value="--><?php //echo $pa["value"]; ?><!--">--><?php //echo $pa["value"]; ?><!--</option>-->
<!--                        --><?php
//                            }
//                        endforeach;
//                        ?>
<!---->
<!--                    </select>-->
<!--                </label><br><br>-->
<!--                <label>Size:-->
<!--                    <select name="size">-->
<!--                        --><?php
//                        foreach ($productAttributes as $pa):
//                            if ($pa["attribute"] == "size") { ?>
<!--                                <option value="--><?php //echo $pa["value"]; ?><!--">--><?php //echo $pa["value"]; ?><!--</option>-->
<!--                        --><?php
//                            }
//                        endforeach;
//                        ?>
<!---->
<!--                    </select>-->
<!--                </label><br><br>-->
                <?php
                foreach ($product as $p): ?>
                <input type="hidden" name="itemPrice" value="<?php $p["productPrice"]; ?>">
                <?php
                endforeach;
                ?>



                <?php
                if (isset($_SESSION["logged_in"])) {
                    foreach ($product as $p): ?>
                    <label>Enter Quantity: <input type="tel" name="quantity" required></label><br><br>
                    <input type="hidden" name="itemPrice" value="<?php echo $p["productPrice"]; ?>">
                    <input type="hidden" name="productId" value="<?php echo $productId; ?>">
                    <input type="hidden" name="whatToDo" value="addToCart">
                    <input type="submit" value="Add To Cart" class="btn text-light p-3 rounded-pill">
                        <?php
                    endforeach;
                } else { ?>
                    <a href="sign-in.php" class="btn text-light p-3 rounded-pill">Click Here to Login</a>
                <?php
                }
                ?>

            </form>
<!--            <script>-->
<!--                $('#myModal').on('shown.bs.modal', function () {-->
<!--                    $('#myInput').trigger('focus')-->
<!--                })-->
<!--            </script>-->



<!--            TEST AREA                                   -->
<!--            <form method="post" action="--><?php //echo $_SERVER['PHP_SELF']; ?><!--">-->
<!--                --><?php
//                if (isset($_SESSION["logged_in"])) {
//                    foreach ($product as $p): ?>
<!--                        <label>Enter Quantity: <input type="tel" name="quantity" required></label><br><br>-->
<!--                        <input type="hidden" name="itemPrice" value="--><?php //echo $p["productPrice"]; ?><!--">-->
<!--                        <input type="hidden" name="productId" value="--><?php //echo $productId; ?><!--">-->
<!--                        <input type="hidden" name="whatToDo" value="addToCart">-->
<!--                        <input type="submit" value="Add To Cart" class="btn text-light p-3 rounded-pill">-->
<!--                    --><?php
//                    endforeach;
//                } else { ?>
<!--                    <a href="sign-in.php" class="btn text-light p-3 rounded-pill">Click Here to Login</a>-->
<!--                    --><?php
//                }
//                ?>
<!---->
<!--            </form>-->
<!---->
<!--            --><?php
//            if (isset($_POST["whatToDo"])) {
//                $userId = $_SESSION["userId"];
//                $orderId = $_SESSION['orderNum'];
//                $productId = $_POST["productId"];
//                $quantity = $_POST["quantity"];
//                $itemPrice = $_POST["itemPrice"];
//                $total = $itemPrice * $quantity;
//
//                $sql = "insert into `order-items` (orderId, userId, productId, quantity, total) values ('$orderId', '$userId', '$productId', '$quantity', '$total')";
//                $statement = $db->prepare($sql);
//
//
//                if ($statement->execute()) {
//                    $itemDetails = $statement->fetchAll();
//                    $statement->closeCursor();
//                    $_SESSION['cartTotal'] += $total; ?>
<!--                    <script type="text/javascript">-->
<!---->
<!--                            $('#myModal').modal('show');-->
<!--                    </script>-->
<!--                    <!-- Modal -->
<!--                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
<!--                        <div class="modal-dialog" role="document">-->
<!--                            <div class="modal-content">-->
<!--                                <div class="modal-header">-->
<!--                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>-->
<!--                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                                        <span aria-hidden="true">&times;</span>-->
<!--                                    </button>-->
<!--                                </div>-->
<!--                                <div class="modal-body">-->
<!--                                    ...-->
<!--                                </div>-->
<!--                                <div class="modal-footer">-->
<!--                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
<!--                                    <button type="button" class="btn btn-primary">Save changes</button>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    --><?php
//                } else {
//                    echo "<h3>Error Adding to Cart</h3>";
//                }
//            }
//            ?>
<!---->
<!---->
<!--            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">-->
<!--                Launch demo modal-->
<!--            </button>-->
<!---->
<!---->
<!---->
<!--            END TEST AREA                               -->


        </div>
    </div>

    <div class="row">
        <div class="w-75 m-auto p-5">
            <h3>About This Item</h3>
            <p><?php echo $p["productDescription"]; ?></p>
        </div>
    </div>
</div>

<div class="container shadow-lg">
    <div class="homeBanner">
        <div class="row shadow-lg">
            <img src="images/banners/cat-and-dog.jpg" alt="Home Dog Banner" class="img-fluid m-auto">
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

