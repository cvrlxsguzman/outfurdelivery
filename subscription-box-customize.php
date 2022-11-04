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
        <title>Out Fur Delivery | Paw Package Customize</title>
    </head>
    <body>

<?php
include "header.php";
?>


<?php
require_once "connect-db.php";
//$boxType = $name = $boxId = "";
$imageLink = "";
$boxId = "";
$boxId = substr($link, strpos($link, "=") + 1);
$boxType = substr($link, strpos($link, "=") + 1);

$sql = "SELECT * from `subscription-boxes` where subscriptionBoxId = '$boxId'";
$sql2 = "SELECT * from `subscription-box-contents` INNER JOIN products ON `subscription-box-contents`.`productId` = products.productId INNER JOIN `product-images` ON products.productId = `product-images`.`productId` WHERE `subscription-box-contents`.`subscriptionBoxId` = '$boxId'";
$sql3 = "SELECT * from `inhouse-products` WHERE subscriptionBoxId = '$boxId'";
$statement = $db->prepare($sql);
$statement2 = $db->prepare($sql2);
$statement3 = $db->prepare($sql3);

if ($statement->execute() && $statement2->execute() && $statement3->execute()) {
    $box = $statement->fetchAll();
    $statement->closeCursor();
    $products = $statement2->fetchAll();
    $statement2->closeCursor();
    $inhouseProducts = $statement3->fetchAll();
    $statement3->closeCursor();
} else {
    echo "<h3>Error Loading Subscription Box</h3>";
}

foreach ($box as $b):
    if ($b["subscriptionBoxName"] == "Sampler Paw Package") {
        $imageLink = "tier-box-basic-2.png";
    } else if ($b["subscriptionBoxName"] == "Playful Paw Package") {
        $imageLink = "tier-box-premium-2.png";
    } else if ($b["subscriptionBoxName"] == "Premium Paw Package") {
        $imageLink = "tier-box-professional-2.png";
    }
endforeach;

//if ($boxType == "13Cat") {
//    $sql = "SELECT * from `subscription-boxes` WHERE subscriptionBoxName = 'Sampler Paw Package' and subscriptionBoxDuration = 3 and subscriptionBoxPetType = 'Cat'";
//    $imageLink = "tier-box-basic.png";
//} else if ($boxType == "13Dog") {
//    $sql = "SELECT * from `subscription-boxes` WHERE subscriptionBoxName = 'Sampler Paw Package' and subscriptionBoxDuration = 3 and subscriptionBoxPetType = 'Dog'";
//    $imageLink = "tier-box-basic.png";
//} else if ($boxType == "16Cat") {
//    $sql = "SELECT * from `subscription-boxes` WHERE subscriptionBoxName = 'Sampler Paw Package' and subscriptionBoxDuration = 6 and subscriptionBoxPetType = 'Cat'";
//    $imageLink = "tier-box-basic-2.png";
//} else if ($boxType == "16Dog") {
//    $sql = "SELECT * from `subscription-boxes` WHERE subscriptionBoxName = 'Sampler Paw Package' and subscriptionBoxDuration = 6 and subscriptionBoxPetType = 'Dog'";
//    $imageLink = "tier-box-basic-2.png";
//} else if ($boxType == "112Cat") {
//    $sql = "SELECT * from `subscription-boxes` WHERE subscriptionBoxName = 'Sampler Paw Package' and subscriptionBoxDuration = 12 and subscriptionBoxPetType = 'Cat'";
//    $imageLink = "tier-box-basic-2.png";
//} else if ($boxType == "112Dog") {
//    $sql = "SELECT * from `subscription-boxes` WHERE subscriptionBoxName = 'Sampler Paw Package' and subscriptionBoxDuration = 12 and subscriptionBoxPetType = 'Dog'";
//    $imageLink = "tier-box-basic-2.png";
//} else if ($boxType == "23Cat") {
//    $sql = "SELECT * from `subscription-boxes` WHERE subscriptionBoxName = 'Playful Paw Package' and subscriptionBoxDuration = 3 and subscriptionBoxPetType = 'Cat'";
//    $imageLink = "tier-box-premium.png";
//} else if ($boxType == "23Dog") {
//    $sql = "SELECT * from `subscription-boxes` WHERE subscriptionBoxName = 'Playful Paw Package' and subscriptionBoxDuration = 3 and subscriptionBoxPetType = 'Dog'";
//    $imageLink = "tier-box-premium.png";
//} else if ($boxType == "26Cat") {
//    $sql = "SELECT * from `subscription-boxes` WHERE subscriptionBoxName = 'Playful Paw Package' and subscriptionBoxDuration = 6 and subscriptionBoxPetType = 'Cat'";
//    $imageLink = "tier-box-premium-2.png";
//} else if ($boxType == "26Dog") {
//    $sql = "SELECT * from `subscription-boxes` WHERE subscriptionBoxName = 'Playful Paw Package' and subscriptionBoxDuration = 6 and subscriptionBoxPetType = 'Dog'";
//    $imageLink = "tier-box-premium-2.png";
//} else if ($boxType == "212Cat") {
//    $sql = "SELECT * from `subscription-boxes` WHERE subscriptionBoxName = 'Playful Paw Package' and subscriptionBoxDuration = 6 and subscriptionBoxPetType = 'Cat'";
//    $imageLink = "tier-box-premium-2.png";
//} else if ($boxType == "212Dog") {
//    $sql = "SELECT * from `subscription-boxes` WHERE subscriptionBoxName = 'Playful Paw Package' and subscriptionBoxDuration = 6 and subscriptionBoxPetType = 'Dog'";
//    $imageLink = "tier-box-premium-2.png";
//} else if ($boxType == "33Cat") {
//    $sql = "SELECT * from `subscription-boxes` WHERE subscriptionBoxName = 'Premium Paw Package' and subscriptionBoxDuration = 3 and subscriptionBoxPetType = 'Cat'";
//    $imageLink = "tier-box-professional.png";
//} else if ($boxType == "33Dog") {
//    $sql = "SELECT * from `subscription-boxes` WHERE subscriptionBoxName = 'Premium Paw Package' and subscriptionBoxDuration = 3 and subscriptionBoxPetType = 'Dog'";
//    $imageLink = "tier-box-professional.png";
//} else if ($boxType == "36Cat") {
//    $sql = "SELECT * from `subscription-boxes` WHERE subscriptionBoxName = 'Premium Paw Package' and subscriptionBoxDuration = 6 and subscriptionBoxPetType = 'Cat'";
//    $imageLink = "tier-box-professional-2.png";
//} else if ($boxType == "36Dog") {
//    $sql = "SELECT * from `subscription-boxes` WHERE subscriptionBoxName = 'Premium Paw Package' and subscriptionBoxDuration = 6 and subscriptionBoxPetType = 'Dog'";
//    $imageLink = "tier-box-professional-2.png";
//} else if ($boxType == "312Cat") {
//    $sql = "SELECT * from `subscription-boxes` WHERE subscriptionBoxName = 'Premium Paw Package' and subscriptionBoxDuration = 12 and subscriptionBoxPetType = 'Cat'";
//    $imageLink = "tier-box-professional-2.png";
//} else if ($boxType == "312Dog") {
//    $sql = "SELECT * from `subscription-boxes` WHERE subscriptionBoxName = 'Premium Paw Package' and subscriptionBoxDuration = 12 and subscriptionBoxPetType = 'Dog'";
//    $imageLink = "tier-box-professional-2.png";
//}
//$statement = $db->prepare($sql);
//
//if ($statement->execute()) {
//    $box = $statement->fetchAll();
//    $statement->closeCursor();
////    $_SESSION["orderNum"] = uniqid();
//} else {
//    echo "<h3>Error Loading Subscription Box</h3>";
//}
//
//?>

<div class="container shadow-lg p-0">
<!--    <h1 class="productsH1 w-75 m-auto p-5">--><?php //echo $name?><!--</h1>-->
<!--    <div class="homePlan row w-100 m-auto">-->
<!--        --><?php
//        foreach ($box as $b):
//        $tierOne = $tierTwo = $tierThree = $tierFour = $tierFive = "";
//        $tierOne = $b["tierOneAmount"];
//        $tierTwo = $b["tierTwoAmount"];
//        $tierThree = $b["tierThreeAmount"];
//        $tierFour = $b["tierFourAmount"];
//        $tierFive = $b["tierFiveAmount"];
//
//        if ($tierOne > 0) {
//            $sql2 = "select * from inventory inner JOIN products on inventory.productId = products.productId INNER JOIN `product-images` ON inventory.productId = `product-images`.`productId`  WHERE products.tierLevel = 1 AND inventory.stock > 0";
//            $statement2 = $db->prepare($sql2);
//            if ($statement2->execute()) {
//                $tierOneItems = $statement2->fetchAll();
//                $statement2->closeCursor();
//            } else {
//                echo "<h3>Error Loading Tier One Items</h3>";
//            }
//        }
//        if ($tierTwo > 0) {
//            $sql3 = "select * from inventory inner JOIN products on inventory.productId = products.productId INNER JOIN `product-images` ON inventory.productId = `product-images`.`productId`  WHERE products.tierLevel = 2 AND inventory.stock > 0";
//            $statement3 = $db->prepare($sql3);
//            if ($statement3->execute()) {
//                $tierTwoItems = $statement3->fetchAll();
//                $statement3->closeCursor();
//            } else {
//                echo "<h3>Error Loading Tier Two Items</h3>";
//            }
//        }
//        if ($tierThree > 0) {
//            $sql4 = "select * from inventory inner JOIN products on inventory.productId = products.productId INNER JOIN `product-images` ON inventory.productId = `product-images`.`productId`  WHERE products.tierLevel = 3 AND inventory.stock > 0";
//            $statement4 = $db->prepare($sql4);
//            if ($statement4->execute()) {
//                $tierThreeItems = $statement4->fetchAll();
//                $statement4->closeCursor();
//            } else {
//                echo "<h3>Error Loading Tier Three Items</h3>";
//            }
//        }
//        if ($tierFour > 0) {
//            $sql5 = "select * from inventory inner JOIN products on inventory.productId = products.productId INNER JOIN `product-images` ON inventory.productId = `product-images`.`productId`  WHERE products.tierLevel = 4 AND inventory.stock > 0";
//            $statement5 = $db->prepare($sql5);
//            if ($statement5->execute()) {
//                $tierFourItems = $statement5->fetchAll();
//                $statement5->closeCursor();
//            } else {
//                echo "<h3>Error Loading Tier Four Items</h3>";
//            }
//        }
//        if ($tierFive > 0) {
//            $sql6 = "select * from inventory inner JOIN products on inventory.productId = products.productId INNER JOIN `product-images` ON inventory.productId = `product-images`.`productId`  WHERE products.tierLevel = 5 AND inventory.stock > 0";
//            $statement6 = $db->prepare($sql6);
//            if ($statement6->execute()) {
//                $tierFiveItems = $statement6->fetchAll();
//                $statement6->closeCursor();
//            } else {
//                echo "<h3>Error Loading Tier Five Items</h3>";
//            }
//        }
//        ?>
<!---->
<!--            <div class="col-lg-4  pb-3">-->
<!--                <div class="card shadow-lg">-->
<!--                    <div class="card-img">-->
<!--                        <img src="images/pawPackages/--><?php //echo $imageLink?><!--" class="img-fluid">-->
<!--                    </div>-->
<!--                    <div class="card-header-pills p-3">-->
<!--                        <h2 class="text-dark">--><?php //echo $name?><!--</h2>-->
<!--                    </div>-->
<!--                    <div class="card-body">-->
<!--                        <h4 class="text-dark">$--><?php //echo $b["subscriptionPrice"]; ?><!--</h4>-->
<!--                        <p class="text-dark">--><?php //echo $b["duration"]; ?><!-- Month(s)</p>-->
<!--                        <a href="subscription-box-customize.php?=--><?php //echo $boxType . $p["duration"]; ?><!--" class="btn text-light p-3 rounded-pill">Purchase Plan</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        <div class="col-md-8">-->
<!--            <form method="post" action="cart-actions.php" class="form m-3">-->
<!---->
<!--                --><?php
//                if (isset($tierOneItems)) { ?>
<!--                    <h2>Select --><?php //echo $tierOne?><!-- Item(s)</h2>-->
<!--                    --><?php
//                    foreach ($tierOneItems as $tonei): ?>
<!--                        <div class="row">-->
<!--                            <div class="col-md-4">-->
<!--                                <img src="productImages/--><?php //echo $tonei["imageLink"]; ?><!--" class="img-fluid">-->
<!--                            </div>-->
<!--                            <div class="col-md-8">-->
<!--                                <h3>--><?php //echo $tonei["productName"]; ?><!--</h3>-->
<!--                                <h4>Weight (lb): --><?php //echo $tonei["productWeight"]; ?><!--</h4>-->
<!--                                <input type="checkbox" name="tierLevelOne[]" value="--><?php //echo $tonei["productId"]; ?><!--">-->
<!--                            </div>-->
<!--                        </div><br>-->
<!--                    --><?php
//                    endforeach;
//                }
//                ?>
<!---->
<!--                --><?php
//                if (isset($tierTwoItems)) { ?>
<!--                    <h2>Select --><?php //echo $tierTwo?><!-- Item(s)</h2>-->
<!--                    --><?php
//                    foreach ($tierTwoItems as $ttwoi): ?>
<!--                        <div class="row">-->
<!--                            <div class="col-md-4">-->
<!--                                <img src="productImages/--><?php //echo $ttwoi["imageLink"]; ?><!--" class="img-fluid">-->
<!--                            </div>-->
<!--                            <div class="col-md-8">-->
<!--                                <h3>--><?php //echo $ttwoi["productName"]; ?><!--</h3>-->
<!--                                <h4>Weight (lb): --><?php //echo $ttwoi["productWeight"]; ?><!--</h4>-->
<!--                                <input type="checkbox" name="tierLevelTwo[]" value="--><?php //echo $ttwoi["productId"]; ?><!--">-->
<!--                            </div>-->
<!--                        </div><br>-->
<!--                    --><?php
//                    endforeach;
//                }
//                ?>
<!---->
<!--                --><?php
//                if (isset($tierThreeItems)) { ?>
<!--                    <h2>Select --><?php //echo $tierThree?><!-- Item(s)</h2>-->
<!--                    --><?php
//                    foreach ($tierThreeItems as $tthreei): ?>
<!--                        <div class="row">-->
<!--                            <div class="col-md-4">-->
<!--                                <img src="productImages/--><?php //echo $tthreei["imageLink"]; ?><!--" class="img-fluid">-->
<!--                            </div>-->
<!--                            <div class="col-md-8">-->
<!--                                <h3>--><?php //echo $tthreei["productName"]; ?><!--</h3>-->
<!--                                <h4>Weight (lb): --><?php //echo $tthreei["productWeight"]; ?><!--</h4>-->
<!--                                <input type="checkbox" name="tierLevelThree[]" value="--><?php //echo $tthreei["productId"]; ?><!--">-->
<!--                            </div>-->
<!--                        </div><br>-->
<!--                    --><?php
//                    endforeach;
//                }
//                ?>
<!---->
<!--                --><?php
//                if (isset($tierFourItems)) { ?>
<!--                    <h2>Select --><?php //echo $tierFour?><!-- Item(s)</h2>-->
<!--                    --><?php
//                    foreach ($tierFourItems as $tfouri): ?>
<!--                        <div class="row">-->
<!--                            <div class="col-md-4">-->
<!--                                <img src="productImages/--><?php //echo $tfouri["imageLink"]; ?><!--" class="img-fluid">-->
<!--                            </div>-->
<!--                            <div class="col-md-8">-->
<!--                                <h3>--><?php //echo $tfouri["productName"]; ?><!--</h3>-->
<!--                                <h4>Weight (lb): --><?php //echo $tfouri["productWeight"]; ?><!--</h4>-->
<!--                                <input type="checkbox" name="tierLevelFour[]" value="--><?php //echo $tfouri["productId"]; ?><!--">-->
<!--                            </div>-->
<!--                        </div><br>-->
<!--                    --><?php
//                    endforeach;
//                }
//                ?>
<!---->
<!--                --><?php
//                if (isset($tierFiveItems)) { ?>
<!--                    <h2>Select --><?php //echo $tierFive?><!-- Item(s)</h2>-->
<!--                    --><?php
//                    foreach ($tierFiveItems as $tfivei): ?>
<!--                        <div class="row">-->
<!--                            <div class="col-md-4">-->
<!--                                <img src="productImages/--><?php //echo $tfivei["imageLink"]; ?><!--" class="img-fluid">-->
<!--                            </div>-->
<!--                            <div class="col-md-8">-->
<!--                                <h3>--><?php //echo $tfivei["productName"]; ?><!--</h3>-->
<!--                                <h4>Weight (lb): --><?php //echo $tfivei["productWeight"]; ?><!--</h4>-->
<!--                                <input type="checkbox" name="tierLevelFive[]" value="--><?php //echo $tfivei["productId"]; ?><!--">-->
<!--                            </div>-->
<!--                        </div><br>-->
<!--                    --><?php
//                    endforeach;
//                }
//                ?>
<!---->
<!--                <br>-->
<!--                <input type="hidden" name="subscriptionBoxId" value="--><?php //echo $boxId?><!--">-->
<!--                <input type="submit" name="addSubscriptionBox" class="btn btn-dark btn-block">-->
<!--            </form>-->
<!---->
<!--        </div>-->
<!--        --><?php
//        endforeach;
//        ?>
<!--    </div>-->

    <?php
    foreach ($box as $b): ?>

    <div class="row">
        <div class="col-md-12">
            <p class="p-3"><a href="index.php" class="text-dark">Home</a> > <a href="subscription-box.php" class="text-dark">Subscription Boxes</a> > <?php echo $b["subscriptionBoxName"]; ?></p>
        </div>
    </div>

    <h1 class="productsH1 w-75 m-auto p-5"><?php echo $b["subscriptionBoxName"]; ?> for <?php echo $b["subscriptionBoxPetType"]; ?>s</h1>
    <div class="homePlan row w-100 m-auto p-5">
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-img">
                    <img src="images/pawPackages/<?php echo $imageLink?>" class="img-fluid">
                </div>
                <div class="card-header-pills p-3">
                    <h2 class="text-dark"><?php echo $b["subscriptionBoxName"]; ?></h2>
                </div>
                <div class="card-body">
                    <h3>For <?php echo $b["subscriptionBoxPetType"]; ?>s</h3>
                    <h4 class="text-dark">$<?php echo $b["subscriptionBoxPrice"]; ?></h4>
                    <p class="text-dark"><?php echo $b["subscriptionBoxDuration"]; ?> Month(s)</p>
<!--                    <a href="subscription-box-customize.php?=--><?php //echo $cb["subscriptionBoxId"]; ?><!--" class="btn text-light p-3 rounded-pill">Purchase Plan</a>-->
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="p-3"><?php echo $b["subscriptionBoxDescription"]; ?></h2>
                    <form class="form" method="post" action="cart-actions.php">
                        <?php
                        if (isset($_SESSION["logged_in"])) {
                            foreach ($box as $b): ?>
                                <label>Enter Quantity: <input type="tel" name="quantity" required></label><br><br>
                                <input type="hidden" name="boxPrice" value="<?php echo $b["subscriptionBoxPrice"]; ?>">
                                <input type="hidden" name="boxId" value="<?php echo $boxId; ?>">
                                <input type="hidden" name="whatToDo" value="addBoxToCart">
                                <input type="submit" value="Add To Cart" class="btn text-light p-3 rounded-pill">
                            <?php
                            endforeach;
                        } else { ?>
                            <a href="sign-in.php" class="btn text-light p-3 rounded-pill">Click Here to Login</a>
                            <?php
                        }
                        ?>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <?php
    endforeach;
    ?>


    <h1 class="productsH1 w-75 m-auto p-5">Contents</h1>
        <div class="homePlan row w-100 m-auto p-5">
            <?php
            if ($boxId == 1 || $boxId == 2) {
                foreach ($products as $p): ?>
                    <div class="col-md-4">
                        <a href="product-details.php?=<?php echo $p["productId"]; ?>" class="text-dark">
                            <div class="card shadow-lg p-1">
                                <div class="card-img">
                                    <img src="productImages/<?php echo $p["imageLink"]; ?>" class="img-fluid">
                                </div>
                                <div class="card-header-pills p-3">
                                    <h2 class="text-dark"><?php echo $p["productName"]; ?></h2>
                                </div>
                                <div class="card-body">
                                    <p class="text-dark"><?php echo $p["productDescription"]; ?></p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php
                endforeach;
            } else {
                foreach ($inhouseProducts as $ip): ?>
                    <div class="col-md-3">
                        <div class="card shadow-lg p-1">
                            <div class="card-img">
                                <img src="images/inHouseProducts/<?php echo $ip["imageLink"]; ?>" class="img-fluid">
                            </div>
                            <div class="card-header-pills p-3">
                                <h2 class="text-dark"><?php echo $ip["inhouseProductName"]; ?></h2>
                            </div>
                        </div>
                    </div>
            <?php
                endforeach;
            }
            ?>
        </div>



</div>


<?php
include "footer.php";
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </body>
</html>