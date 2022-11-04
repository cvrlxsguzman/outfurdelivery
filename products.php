<?php
session_start()
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
    <title>Out Fur Delivery | Products</title>
</head>
<body>

<?php
include "header.php";
?>


<div class="container shadow-lg">
    <div class="row">
        <div class="col-md-12">
            <p class="p-3 pb-0"><a href="index.php" class="text-dark">Home</a> > <a href="products.php" class="text-dark">Products</a></p>
        </div>
    </div>
    <h1 class="productsH1 w-75 m-auto p-5">Brand Name Products</h1>
    <div class="homeBanner">
        <div class="row shadow-lg">
            <img src="images/banners/catanddogfoodbanner.jpg" alt="Home Dog Banner" class="img-fluid m-auto">
        </div>
    </div>
</div>

<!--<div class="container shadow-lg p-0">-->
<!--    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">-->
<!--        <ol class="carousel-indicators">-->
<!--            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>-->
<!--            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>-->
<!--            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>-->
<!--        </ol>-->
<!--        <div class="carousel-inner">-->
<!--            <div class="carousel-item active">-->
<!--                <img class="d-block w-100" src="images/dog-home-temp.jpg" alt="First slide">-->
<!--                <div class="carousel-caption d-none d-md-block">-->
<!--                    <h5>Description</h5>-->
<!--                    <p>...</p>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="carousel-item">-->
<!--                <img class="d-block w-100" src="images/dog-home-temp.jpg" alt="Second slide">-->
<!--                <div class="carousel-caption d-none d-md-block">-->
<!--                    <h5>Description</h5>-->
<!--                    <p>...</p>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="carousel-item">-->
<!--                <img class="d-block w-100" src="images/dog-home-temp.jpg" alt="Third slide">-->
<!--                <div class="carousel-caption d-none d-md-block">-->
<!--                    <h5>Description</h5>-->
<!--                    <p>...</p>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">-->
<!--            <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
<!--            <span class="sr-only">Previous</span>-->
<!--        </a>-->
<!--        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">-->
<!--            <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
<!--            <span class="sr-only">Next</span>-->
<!--        </a>-->
<!--    </div>-->
<!--</div>-->


<?php
require_once "connect-db.php";
?>


<div class="container p-0 pos-f-t">
    <nav class="navbar navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-light p-4">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset>
                    <legend>Sort By</legend>
                    <label>Price:<br>
                        <input type="radio" name="priceSort" value="highToLow" id="highToLow">
                        <label for="highToLow">High to Low</label>
                        <input type="radio" name="priceSort" value="lowToHigh" id="lowToHigh">
                        <label for="lowToHigh">Low to High</label>
                    </label>
                    <input type="submit" name="sort" value="Apply" class="btn btn-dark btn-block">
                </fieldset>
            </form>
        </div>
    </div>
</div>


<?php
if (!isset($_POST["sort"])) {
    $sql = "SELECT * from inventory INNER JOIN products on inventory.productId = products.productId where status = 'available' and stock > 0";
}
else if (isset($_POST["sort"])) {
    $sort = $_POST["priceSort"];

    if ($sort == "highToLow") {
        $sql = "SELECT * from inventory INNER JOIN products on inventory.productId = products.productId where status = 'available' and stock > 0 ORDER BY products.productPrice DESC";
    }
    if ($sort == "lowToHigh") {
        $sql = "SELECT * from inventory INNER JOIN products on inventory.productId = products.productId where status = 'available' and stock > 0 ORDER BY products.productPrice ASC";
    }
}

$statement = $db->prepare($sql);

if ($statement->execute()) {
    $products = $statement->fetchAll();
    $statement->closeCursor();
    $array = array();
} else {
    echo "<h2>Error Loading Products</h2>";
}
?>


<div class="container shadow-lg">
    <div class="products p-3">
        <?php
        foreach ($products as $p) {
                $productId = "";
                $productId = $p["productId"];
                array_push($array, $productId);
            $sql2 = "Select * from `product-images` where imageStatus = 1 and  `product-images`.productId = '$productId'";
            $statement2 = $db->prepare($sql2);
            if ($statement2->execute()) {
                $productImages = $statement2->fetchAll();
                $statement2->closeCursor();
            } else {
                echo "<h3>Error Loading Images</h3>";
            }

            $sql4 = "select * from `products` where productId = '$productId'";
            $statement4 = $db->prepare($sql4);
            if ($statement4->execute()) {
                $keypoints = $statement4->fetchAll();
                $statement4->closeCursor();
            } else {
                echo "<h3>Error Loading Key Points</h3>";
            }

            if ($p["productAttributeId"] != 0) {
                $sql3 = "select * from `product-attributes` where productId = '$productId'";
                $statement3 = $db->prepare($sql3);
                if ($statement3->execute()) {
                    $productAttribute = $statement3->fetchAll();
                    $statement3->closeCursor();
                } else {
                    echo "<h3>Error Loading Attributes</h3>";
                }
                ?>
                <?php
                $tmp = array_count_values($array);
                $cnt = $tmp[$productId];
                if ($cnt < 2) { ?>
                    <div class="productItem float-left p-3">
                        <a href="product-details.php?=<?php echo $p["productId"]; ?>" class="text-dark">
                            <div class="card">
                                <div class="card-img">
                                    <?php
                                    foreach ($productImages as $pi): ?>
                                        <img src="<?php echo "productImages/" . $pi["imageLink"]; ?>" class="img-fluid">
                                    <?php
                                    endforeach;
                                    ?>
                                </div>
                                <div class="card-header">
                                    <h2><?php echo $p["productName"]; ?></h2>
                                </div>
                                <div class="card-body">
                                    <h4>$<?php echo $p["productPrice"]; ?></h4>
                                    <p>Verities:
                                        <?php
                                        foreach ($productAttribute as $pa): ?>
                                    <p><?php echo $pa["value"]; ?></p>
                                    <?php
                                    endforeach;
                                    ?>
                                    </p>
                                    <p>Description: <?php echo $p["productDescription"]; ?></p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                }
                ?>

                    <?php
            } else { ?>
                <div class="productItem float-left p-3">
                    <a href="product-details.php?=<?php echo $p["productId"]; ?>" class="text-dark">
<!--                        data-toggle="modal" data-target=".bd-example-modal-lg" data-name="prod">-->
                        <div class="card border-0">
                            <div class="card-img">
                                <?php
                                foreach ($productImages as $pi): ?>
                                    <img src="<?php echo "productImages/" . $pi["imageLink"]; ?>" class="img-fluid">
                                <?php
                                endforeach;
                                ?>
                            </div>
                            <div class="card-header rounded-pill">
                                <h2><?php echo $p["productName"]; ?></h2>
                            </div>
                            <div class="card-body">
                                <h4>$<?php echo $p["productPrice"]; ?></h4>
                                <h5>For: <?php echo $p["petType"]; ?>s</h5>
                                <h5>Weight (lb): <?php echo $p["productWeight"]; ?></h5>
                                <?php
                                foreach ($keypoints as $kp): ?>
<!--                                <p>• --><?php //echo $kp["keyPoint"]; ?><!--</p>-->
                                <p>• <?php echo $kp["productDescription"]; ?></p>
                                <?php
                                endforeach;
                                ?>
<!--                                <p>Description: --><?php //echo $p["productDescription"]; ?><!--</p>-->
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            }
                ?>
        <?php
        }
        ?>
    </div>

<!--    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">-->
<!--        <div class="modal-dialog modal-lg">-->
<!--            <div class="modal-content">-->
<!--                ...-->
<!--            </div>-->
<!--            <h1 id="name" type="text"></h1>-->
<!--        </div>-->
<!--    </div>-->

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


<!--<script>-->
<!--    $('#myModal').on('shown.bs.modal', function () {-->
<!--        var name = $(this).data('name');-->
<!---->
<!--        $('#name').val(name);-->
<!--        $('#myInput').trigger('focus')-->
<!--    })-->
<!--</script>-->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>
