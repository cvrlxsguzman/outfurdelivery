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
        <title>Out Fur Delivery | Paw Package Options</title>
    </head>
    <body>

<?php
include "header.php";
?>


<?php
require_once "connect-db.php";
$boxType = "";
//    = $name = $imageLink = $title = $price = $duration = "";
$boxType = substr($link, strpos($link, "=") + 1);

if ($boxType == 1) {
    $sql = "SELECT * from `subscription-boxes` WHERE subscriptionBoxName = 'Sampler Paw Package' and subscriptionBoxPetType = 'Cat'";
    $sql2 = "SELECT * from `subscription-boxes` WHERE subscriptionBoxName = 'Sampler Paw Package' and subscriptionBoxPetType = 'Dog'";
    $imageLink = "tier-box-basic.png";
} else if ($boxType == 2) {
    $sql = "SELECT * from `subscription-boxes` WHERE subscriptionBoxName = 'Playful Paw Package' and subscriptionBoxPetType = 'Cat'";
    $sql2 = "SELECT * from `subscription-boxes` WHERE subscriptionBoxName = 'Playful Paw Package' and subscriptionBoxPetType = 'Dog'";
    $imageLink = "tier-box-premium.png";
} else if ($boxType == 3) {
    $sql = "SELECT * from `subscription-boxes` WHERE subscriptionBoxName = 'Premium Paw Package' and subscriptionBoxPetType = 'Cat'";
    $sql2 = "SELECT * from `subscription-boxes` WHERE subscriptionBoxName = 'Premium Paw Package' and subscriptionBoxPetType = 'Dog'";
    $imageLink = "tier-box-professional.png";
}
$statement = $db->prepare($sql);
$statement2 = $db->prepare($sql2);

if ($statement->execute() && $statement2->execute()) {
    $catBox = $statement->fetchAll();
    $statement->closeCursor();
    $dogBox = $statement2->fetchAll();
    $statement2->closeCursor();
} else {
    echo "<h3>Error Loading Packages</h3>";
}

?>

<div class="container shadow-lg p-0">
<!--    <h1 class="productsH1 w-75 m-auto p-5">--><?php //echo $name?><!--</h1>-->
<!--        <div class="homePlan row w-100 m-auto">-->
<!--        --><?php
//        foreach ($packages as $p): ?>
<!--            <div class="col-lg-4  pb-3">-->
<!--                <div class="card shadow-lg">-->
<!--                    <div class="card-img">-->
<!--                        <img src="images/pawPackages/--><?php //echo $imageLink?><!--" class="img-fluid">-->
<!--                    </div>-->
<!--                    <div class="card-header-pills p-3">-->
<!--                        <h2 class="text-dark">--><?php //echo $name?><!--</h2>-->
<!--                    </div>-->
<!--                    <div class="card-body">-->
<!--                        <h4 class="text-dark">$--><?php //echo $p["subscriptionPrice"]; ?><!--</h4>-->
<!--                        <p class="text-dark">--><?php //echo $p["duration"]; ?><!-- Month(s)</p>-->
<!--                        <a href="subscription-box-customize.php?=--><?php //echo $boxType . $p["duration"]; ?><!--" class="btn text-light p-3 rounded-pill">Purchase Plan</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        --><?php
//        endforeach;
//        ?>
<!--        </div>-->

    <div class="homePlan">
        <?php
        foreach ($catBox as $cb): ?>
        <h1 class="productsH1 w-75 m-auto p-5"><?php echo $cb["subscriptionBoxName"]; ?></h1>
        <h2 class="p-3"><?php echo $cb["subscriptionBoxDescription"]; ?></h2>
        <div class="homePlan row p-5">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-img">
                        <img src="images/pawPackages/<?php echo $imageLink?>" class="img-fluid">
                    </div>
                    <div class="card-header-pills p-3">
                        <h2 class="text-dark"><?php echo $cb["subscriptionBoxName"]; ?></h2>
                    </div>
                    <div class="card-body">
                        <h3>For <?php echo $cb["subscriptionBoxPetType"]; ?>s</h3>
                        <h4 class="text-dark">$<?php echo $cb["subscriptionBoxPrice"]; ?></h4>
                        <p class="text-dark"><?php echo $cb["subscriptionBoxDuration"]; ?> Month(s)</p>
                        <?php
                        if (isset($_SESSION["logged_in"])) { ?>
                        <a href="subscription-box-customize.php?=<?php echo $cb["subscriptionBoxId"]; ?>" class="btn text-light p-3 rounded-pill">Purchase Plan</a>
                            <?php
                        } else { ?>
                            <a href="sign-in.php" class="btn text-light p-3 rounded-pill">Click Here to Login</a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php
        endforeach;
        foreach ($dogBox as $db): ?>
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-img">
                        <img src="images/pawPackages/<?php echo $imageLink?>" class="img-fluid">
                    </div>
                    <div class="card-header-pills p-3">
                        <h2 class="text-dark"><?php echo $db["subscriptionBoxName"]; ?></h2>
                    </div>
                    <div class="card-body">
                        <h3>For <?php echo $db["subscriptionBoxPetType"]; ?>s</h3>
                        <h4 class="text-dark">$<?php echo $db["subscriptionBoxPrice"]; ?></h4>
                        <p class="text-dark"><?php echo $db["subscriptionBoxDuration"]; ?> Month(s)</p>
                        <?php
                        if (isset($_SESSION["logged_in"])) { ?>
                        <a href="subscription-box-customize.php?=<?php echo $db["subscriptionBoxId"]; ?>" class="btn text-light p-3 rounded-pill">Purchase Plan</a>
                            <?php
                        } else { ?>
                            <a href="sign-in.php" class="btn text-light p-3 rounded-pill">Click Here to Login</a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
            endforeach;
        ?>
        </div>
    </div>


    <div class="homeBanner p-0">
        <img src="images/banners/catanddogfoodbanner.jpg" alt="Home Dog Banner" class="img-fluid m-auto">
    </div>
</div>


<?php
include "footer.php";
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </body>
</html>