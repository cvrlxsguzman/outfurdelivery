<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Carlos Guzman cvrlxsguzman.com">
    <meta name="description" content="eCommerce Site for pet subscription boxes">
    <meta name="keywords" content="pet, ecommerce, pet food, dog, cat">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js"></script>
    <link rel="stylesheet" href="stylesheet.css" type="text/css">
    <title>Out Fur Delivery | Admin</title>
</head>
<body>

<div class="container  mb-3">
    <header>
        <h1>Out Fur Delivery</h1>
    </header>

    <nav>
        <a href="index.php" class="btn btn-dark">Home</a>
        <a href="admin-inventory.php" class="btn btn-dark">Inventory</a>
    </nav>
</div>

<?php
$error = $categoriesCheckbox = "";
require_once "connect-db.php";
$sql = "select * from categories";
$statement = $db->prepare($sql);

if ($statement->execute()) {
    $categories = $statement->fetchAll();
    $statement->closeCursor();
} else {
    $error = "Error Loading Categories";
}

$sql2 = "select * from products";
$statement2 = $db->prepare($sql2);

if ($statement2->execute()) {
    $products = $statement2->fetchAll();
    $statement2->closeCursor();
} else {
    $error = "Error Loading Products";
}

?>

<div class="container">
    <div class="row">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Products</h3>
                </div>
                <div class="card-body">
                    <form class="form m-3" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <fieldset>
                            <legend>Add Products</legend>
                            <label>Product Name: <input type="text" name="productName" required></label><br><br>
                            <label>SKU: <input type="text" name="sku" required></label><br><br>
                            <label>Product Categories:<br>
                                <?php
                                foreach ($categories as $c) { ?>
                                    <input type="checkbox" id="<?php echo $c["name"] . "Category"; ?>" name="categories[]" value="<?php echo $c["categoryId"]; ?>">
                                    <label for="<?php echo $c["name"] . "Category" ?>"><?php echo $c["name"]; ?></label>
                                    <?php
                                }
                                ?>
                            </label><br><br>
                            <label>Pet Type:
                                <input type="radio" name="productPetType" value="cat" id="productCat" required>
                                <label for="productCat">Cat</label>
                                <input type="radio" name="productPetType" value="dog" id="productDog" required>
                                <label for="productDog">Dog</label>
                            </label><br><br>
                            <label>Tier Level:
                                <input type="radio" name="productTierLevel" value="1" id="productLevel1" required>
                                <label for="productLevel1">1</label>
                                <input type="radio" name="productTierLevel" value="2" id="productLevel2" required>
                                <label for="productLevel2">2</label>
                                <input type="radio" name="productTierLevel" value="3" id="productLevel3" required>
                                <label for="productLevel3">3</label>
                                <input type="radio" name="productTierLevel" value="4" id="productLevel4" required>
                                <label for="productLevel4">4</label>
                                <input type="radio" name="productTierLevel" value="5" id="productLevel5" required>
                                <label for="productLevel5">5</label>
                            </label><br><br>
                            <label>Product Description: <textarea type="text" name="productDescription" required></textarea></label><br><br>
                            <label>Product Weight (lb): <input type="tel" name="productWeight" required></label><br><br>
                            <label>Product Price: <input type="tel" name="productPrice" required></label><br><br>
                            <label>Thumbnail: <input type="file" name="file" required></label><br><br>
                            <label>Inventory (If NO attributes): <input type="tel" name="inventory"></label><br><br>
                            <input type="submit" name="addProduct" class="btn btn-dark btn-block">
                        </fieldset>
                    </form><br>

                    <?php
                    $productName = $sku = $productCategories = $petType = $tierLevel = $productionDescription = $thumbnail = $productWeight = $productPrice = $success = $inventory = "";
                    if (isset($_POST["addProduct"])) {
                        $productName = $_POST["productName"];
                        $sku = $_POST["sku"];
                        $productCategories = $_POST["categories"];
                        $petType = $_POST["productPetType"];
                        $tierLevel = $_POST["productTierLevel"];
                        $productionDescription = $_POST["productDescription"];
                        $productWeight = $_POST["productWeight"];
                        $productPrice = $_POST["productPrice"];

                        $sql3 = "insert into products (productName, sku, petType, tierLevel, productDescription, productWeight, productPrice) values (:productName, :sku, :petType, :tierLevel, :productDescription, :productWeight, :productPrice)";

                        $statement3 = $db->prepare($sql3);

                        $statement3->bindValue(':productName', $productName);
                        $statement3->bindValue(':sku', $sku);
                        $statement3->bindValue(':petType', $petType);
                        $statement3->bindValue(':tierLevel', $tierLevel);
                        $statement3->bindValue(':productDescription', $productionDescription);
                        $statement3->bindValue(':productWeight', $productWeight);
                        $statement3->bindValue(':productPrice', $productPrice);

                        if ($statement3->execute()) {
                            $statement3->closeCursor();
                            echo "<h3>Successfully Added to Products</h3>";

                            $sql4 = "select productId from products where sku = '$sku'";

                            $statement4 = $db->prepare($sql4);

                            if ($statement4->execute()) {
                                $productId = $statement4->fetchAll();
                                $statement4->closeCursor();
                            } else {
                                echo "<h3>Error Adding Image to Product Images</h3>";
                            }

                            foreach ($productId as $p) {
                                $productIdNum = $p["productId"];

                                foreach ($productCategories as $pc) {
                                    $sql6 = "insert into `product-categories` (productId, categoryId) values ('$productIdNum', '$pc')";
                                    $statement6 = $db->prepare($sql6);
                                    if ($statement6->execute()) {
                                        $statement6->closeCursor();
                                    } else {
                                        echo "<h3>Error Adding Categories</h3>";
                                    }
                                }

                                $dbConnect = mysqli_connect("localhost", "root", "", "outfurdelivery");
                                $imageStatus = 1;

                                $name = uniqid() . $_FILES['file']['name'];
                                $target_dir = "productImages/";
                                $target_file = $target_dir . basename($_FILES["file"]["name"]);

                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                                $extensions_arr = array("jpg","jpeg","png");

                                if (in_array($imageFileType, $extensions_arr)) {
                                    $sql5 = "insert into `product-images` (productId, imageLink, imageStatus) values ('$productIdNum', '$name', :imageStatus)";

                                    $statement5 = $db->prepare($sql5);
                                    $statement5->bindValue(':imageStatus', $imageStatus);

                                    if ($statement5->execute() && move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name)) {
                                        $statement5->closeCursor();
                                    } else {
                                        echo "<h3>Could Not Upload</h3>";
                                    }
                                }

                                if (isset($_POST["inventory"])) {
                                    $status = "not available";
                                    $inventory = $_POST["inventory"];

                                    $sql7 = "insert into inventory (productId, stock, status) values ('$productIdNum', '$inventory', '$status')";
                                    $statement7 = $db->prepare($sql7);
                                    if ($statement7->execute()) {
                                        $statement7->closeCursor();
                                    } else {
                                        echo "<h3>Error Adding to Inventory</h3>";
                                    }
                                }
                            }
                        } else {
                            echo "<h3>Error. Couldn't add Product</h3>";
                        }
                        }
                    ?>

                    <form class="form m-3" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <fieldset>
                            <legend>Add Product Attributes</legend>
                            <label for="products">Choose Product</label>
                            <select name="products" id="products">
                                <?php
                                foreach ($products as $p) { ?>
                                    <option value="<?php echo $p["productId"];?>"><?php echo $p["productName"];?></option>
                                    <?php
                                }
                                ?>
                            </select><br><br>
                            <label>Attribute:
                                <input type="radio" name="productAttribute" value="color" id="colorAttribute" required>
                                <label for="colorAttribute">Color</label>
                                <input type="radio" name="productAttribute" value="size" id="sizeAttribute" required>
                                <label for="sizeAttribute">Size</label>
                            </label><br><br>
                            <label>Value: <input type="text" name="productAttributeValue" required></label><br><br>
                            <input type="submit" name="addProductAttribute" class="btn btn-dark btn-block">
                        </fieldset>
                    </form><br>

                    <?php
                    $productAttributeId = $productAttribute = $productAttributeValue = "";
                    if (isset($_POST["addProductAttribute"])) {
                        $productAttributeId = $_POST["products"];
                        $productAttribute = $_POST["productAttribute"];
                        $productAttributeValue = $_POST["productAttributeValue"];

                        $sql8 = "insert into `product-attributes` (productId, attribute, value) values ('$productAttributeId', '$productAttribute', '$productAttributeValue')";
                        $statement8 = $db->prepare($sql8);
                        if ($statement8->execute()) {
                            $statement8->closeCursor();
                            echo "<h3>Successfully Added Attribute</h3>";
                        } else {
                            echo "<h3>Error Adding Attribute</h3>";
                        }
                    }
                    ?>


                    <form class="form m-3" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <fieldset>
                            <legend>Add Product Key Points</legend>
                            <label for="products">Choose Product</label>
                            <select name="productId" id="productId">
                                <?php
                                foreach ($products as $p) { ?>
                                    <option value="<?php echo $p["productId"];?>"><?php echo $p["productName"];?></option>
                                    <?php
                                }
                                ?>
                            </select><br><br>
                            <label>Key Point: <input type="text" name="productKeyPoint" required></label><br><br>
                            <input type="submit" name="addProductKeyPoint" class="btn btn-dark btn-block">
                        </fieldset>
                    </form>

                    <?php
                    $productId = $productKeyPoint = "";
                    if (isset($_POST["addProductKeyPoint"])) {
                        $productId = $_POST["productId"];
                        $productKeyPoint = $_POST["productKeyPoint"];

                        $sql8 = "insert into `product-key-points` (productId, keyPoint) values ('$productId', '$productKeyPoint')";
                        $statement8 = $db->prepare($sql8);
                        if ($statement8->execute()) {
                            $statement8->closeCursor();
                            echo "<h3>Successfully Added Key Point</h3>";
                        } else {
                            echo "<h3>Error Adding Key Point</h3>";
                        }
                    }
                    ?>

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Inventory</h3>
                </div>
                <div class="card-body">
                    <form class="form m-3" method="post" enctype="multipart/form-data" action="admin-inventory.php">
                        <fieldset>
                            <legend>Add Product to Inventory</legend>
                            <label for="productInventory">Choose Product</label>
                            <select name="productInventoryId" id="productInventory" onchange="getAttributes();">
                                <?php
                                foreach ($products as $p) { ?>
                                    <option value="<?php echo $p["productId"];?>"><?php echo $p["productName"] . " SKU: " . $p["sku"];?></option>
                                    <?php
                                }
                                ?>
                            </select><br><br>
                            <input type="submit" name="addInventory" class="btn btn-dark btn-block">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <div class="row mt-5">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Subscription Boxes</h3>
                </div>
                <div class="card-body">
                    <form class="form m-3" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <fieldset>
                            <legend>Add Subscription Boxes</legend>
                            <label>Subscription SKU: <input type="text" name="subscriptionSku" required></label><br><br>
                            <label>Subscription Name: <input type="text" name="subscriptionName" required></label><br><br>
                            <label>Subscription Description: <textarea type="text" name="subscriptionDescription" required></textarea> </label><br><br>
<!--                            <label>Pet Type:-->
<!--                                <input type="radio" name="subscriptionPetType" value="Cat" id="subscriptionCat" required>-->
<!--                                <label for="subscriptionCat">Cat</label>-->
<!--                                <input type="radio" name="subscriptionPetType" value="Dog" id="subscriptionDog" required>-->
<!--                                <label for="subscriptionDog">Dog</label>-->
<!--                            </label><br><br>-->
                            <label>Duration (Months): <input type="tel" name="duration" required></label><br><br>
                            <label>Tier 1 Amount: <input type="tel" name="tierOneAmount" required></label><br><br>
                            <label>Tier 2 Amount: <input type="tel" name="tierTwoAmount" required></label><br><br>
                            <label>Tier 3 Amount: <input type="tel" name="tierThreeAmount" required></label><br><br>
                            <label>Tier 4 Amount: <input type="tel" name="tierFourAmount" required></label><br><br>
                            <label>Tier 5 Amount: <input type="tel" name="tierFiveAmount" required></label><br><br>
                            <label>Thumbnail: <input type="file" name="file" required></label><br><br>
                            <label>Subscription Price: <input type="tel" name="subscriptionPrice"></label><br><br>
                            <label>Is Active:
                                <input type="radio" name="subscriptionIsActive" value="yes" id="isActiveYes" required>
                                <label for="isActiveYes">Yes</label>
                                <input type="radio" name="subscriptionIsActive" value="no" id="isActiveNo" required>
                                <label for="isActiveNo">No</label>
                            </label><br><br>
                            <input type="submit" name="addSubscriptionBox" class="btn btn-dark btn-block">
                        </fieldset>
                    </form>
                    <?php
                    if (isset($_POST["addSubscriptionBox"])) {
                        $subscriptionName = $subscriptionDescription = $subscriptionPetType = $duration = $tierOneAmount = $tierTwoAmount = $tierThreeAmount = $tierFourAmount = $tierFiveAmount = $subscriptionPrice = $subscriptionIsActive = $subscriptionSku = "";
                        $subscriptionSku = $_POST["subscriptionSku"];
                        $subscriptionName = $_POST["subscriptionName"];
                        $subscriptionDescription = $_POST["subscriptionDescription"];
//                        $subscriptionPetType = $_POST["subscriptionPetType"];
                        $duration = $_POST["duration"];
                        $tierOneAmount = $_POST["tierOneAmount"];
                        $tierTwoAmount = $_POST["tierTwoAmount"];
                        $tierThreeAmount = $_POST["tierThreeAmount"];
                        $tierFourAmount = $_POST["tierFourAmount"];
                        $tierFiveAmount = $_POST["tierFiveAmount"];
                        $subscriptionPrice = $_POST["subscriptionPrice"];
                        $subscriptionIsActive = $_POST["subscriptionIsActive"];

                        $sql9 = "insert into subscriptions (subscriptionBoxSku, name, subscriptionDescription, duration, tierOneAmount, tierTwoAmount, tierThreeAmount, tierFourAmount, tierFiveAmount, subscriptionPrice, isActive) values ('$subscriptionSku', '$subscriptionName', '$subscriptionDescription', '$duration', '$tierOneAmount', '$tierTwoAmount', '$tierThreeAmount', '$tierFourAmount', '$tierFiveAmount', '$subscriptionPrice', '$subscriptionIsActive')";
                        $statement9 = $db->prepare($sql9);

                        if ($statement9->execute()) {
                            $statement9->closeCursor();
                            echo "<h3>Successfully Added Subscription Box</h3>";

                            $sql = "select subscriptionId from subscriptions where subscriptionBoxSku = '$subscriptionSku'";
                            $statement = $db->prepare($sql);

                            if ($statement->execute()) {
                                $subscriptionBoxSku = $statement->fetchAll();
                                $statement->closeCursor();
                            } else {
                                echo "<h3>Error Retrieving Subscription ID</h3>";
                            }

                            foreach ($subscriptionBoxSku as $sbs) {
                                $subscriptionBoxIdNum = $sbs["subscriptionId"];

                                $dbConnect = mysqli_connect("localhost", "root", "", "outfurdelivery");

                                $name = uniqid() . $_FILES['file']['name'];
                                $target_dir = "subscriptionBoxImages/";
                                $target_file = $target_dir . basename($_FILES["file"]["name"]);

                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                                $extensions_arr = array("jpg","jpeg","png");

                                if (in_array($imageFileType, $extensions_arr)) {
                                    $sql = "insert into `subscription-images` (subscriptionBoxId, subscriptionImageLink) values ('$subscriptionBoxIdNum', '$name')";
                                    $statement = $db->prepare($sql);

                                    if ($statement->execute() && move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name)) {
                                        $statement->closeCursor();
                                    } else {
                                        echo "<h3>Could Not Upload Subscription Box Image</h3>";
                                    }
                                }
                            }

                        } else {
                            echo "<h3>Error Adding Subscription Box</h3>";
                        }

                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Deals</h3>
                </div>
                <div class="card-body">
                    <form class="form m-3" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <fieldset>
                            <legend>Add Deals</legend>
                            <label>Deal Name: <input type="text" name="dealName" required></label><br><br>
                            <label>Deal Code: <input type="text" name="code" required></label><br><br>
                            <label>Deal Description: <textarea type="text" name="dealDescription" required></textarea> </label><br><br>
                            <label>Discount (%): <input type="tel" name="dealDiscount" required></label><br><br>
                            <label>Start Date: <input type="date" name="activeDate" required></label><br><br>
                            <label>End Date: <input type="date" name="expirationDate" required></label><br><br>
                            <input type="submit" name="addDeal" class="btn btn-dark btn-block">
                        </fieldset>
                    </form>

                    <?php
                    if (isset($_POST["addDeal"])) {
                        $dealName = $code = $dealDescription = $dealDiscount = $activeDate = $expirationDate = "";
                        $dealName = $_POST["dealName"];
                        $code = $_POST["code"];
                        $dealDescription = $_POST["dealDescription"];
                        $dealDiscount = $_POST["dealDiscount"];
                        $activeDate = $_POST["activeDate"];
                        $expirationDate = $_POST["expirationDate"];

                        $formatActiveDate = date_format(date_create($activeDate), "Y/m/d");
                        $formatExpirationDate = date_format(date_create($expirationDate), "Y/m/d");

                        $sql10 = "insert into deals (dealName, code, description, discount, activeDate, expirationDate) values ('$dealName', '$code', '$dealDescription', '$dealDiscount', '$formatActiveDate', '$formatExpirationDate')";
                        $statement10 = $db->prepare($sql10);

                        if ($statement10->execute()) {
                            $statement10->closeCursor();
                            echo "<h3>Successfully Added Deal</h3>";
                        } else {
                            echo "<h3>Error Adding Deal</h3>";
                        }
                    }
                    ?>

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Categories</h3>
                </div>
                <div class="card-body">
                    <form class="form m-3" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <fieldset>
                            <legend>Add Categories</legend>
                            <label>Category Name: <input type="text" name="categoryName" required></label><br><br>
                            <input type="submit" name="addCategory" class="btn btn-dark btn-block">
                        </fieldset>
                    </form>

                    <?php
                    if (isset($_POST["addCategory"])) {
                        $categoryName = "";
                        $categoryName = $_POST["categoryName"];

                        $sql11 = "insert into categories (name) values ('$categoryName')";
                        $statement11 = $db->prepare($sql11);

                        if ($statement11->execute()) {
                            $statement11->closeCursor();
                            echo "<h3>Successfully Added Category</h3>";
                        } else {
                            echo "<h3>Error Adding Category</h3>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>