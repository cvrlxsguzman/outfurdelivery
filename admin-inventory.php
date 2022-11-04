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
    <title>Out Fur Delivery | Admin Inventory</title>
</head>
<body>

<div class="container mb-3">
    <header>
        <h1>Out Fur Delivery</h1>
    </header>

    <nav>
        <a href="index.php" class="btn btn-dark">Home</a>
        <a href="admin-add.php" class="btn btn-dark">Admin</a>
        <a href="admin-inventory.php" class="btn btn-dark">Inventory</a>
    </nav>
</div>

<?php
require_once("connect-db.php");
if (isset($_POST["addInventory"])) {
    $inventoryProductId = "";
    $inventoryProductId = $_POST["productInventoryId"];

    $sql = "SELECT * from products INNER JOIN `product-attributes` on products.productId = `product-attributes`.`productId` where products.productId = '$inventoryProductId'";
    $statement = $db->prepare($sql);

    if ($statement->execute()) {
        $inventoryProducts = $statement->fetchAll();
        $statement->closeCursor();
    } else {
        echo "<h3>Error Loading Categories</h3>";
    } ?>

    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>Attribute ID</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product SKU</th>
                <th>Attribute</th>
                <th>Value</th>
            </tr>
            </thead>
            <?php
            foreach ($inventoryProducts as $ip): ?>
            <tr>
                <td><?php echo $ip["productAttributeId"]; ?></td>
                <td><?php echo $ip["productId"]; ?></td>
                <td><?php echo $ip["productName"]; ?></td>
                <td><?php echo $ip["sku"]; ?></td>
                <td><?php echo $ip["attribute"]; ?></td>
                <td><?php echo $ip["value"]; ?></td>
            </tr>
            <?php
            endforeach;
            ?>
        </table>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label>Attribute ID: <input type="tel" name="attributeId"></label><br>
            <label>Product ID: <input type="tel" name="productId"></label><br>
            <label>Add to Inventory: <input type="tel" name="productInventory"></label><br>
            <input type="submit" name="addToInventory" class="btn btn-dark btn-block">
        </form>
    </div>
<?php
} else {
    $sql = "select * from inventory inner JOIN products on inventory.productId = products.productId";
    $statement = $db->prepare($sql);

    $sql2 = "select * from `product-attributes`";
    $statement2 = $db->prepare($sql2);

    if ($statement->execute() && $statement2->execute()) {
        $inventoryProductsEdit = $statement->fetchAll();
        $statement->closeCursor();
        $inventoryAttributes = $statement2->fetchAll();
        $statement2->closeCursor();
    } else {
        echo "<h3>Error Loading Inventory</h3>";
    }


    ?>

    <div class="container">
        <h2>Product Inventory</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Inventory ID</th>
                <th>Product ID</th>
                <th>Attribute ID</th>
                <th>SKU</th>
                <th>Product Name</th>
                <th>Pet type</th>
                <th>Tier Level</th>
                <th>Product Description</th>
                <th>Weight</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Status</th>
            </tr>
            </thead>
            <?php
            foreach ($inventoryProductsEdit as $ipe): ?>
            <tr>
                <td><?php echo $ipe["inventoryId"]; ?></td>
                <td><?php echo $ipe["productId"]; ?></td>
                <td><?php echo $ipe["productAttributeId"]; ?></td>
                <td><?php echo $ipe["sku"]; ?></td>
                <td><?php echo $ipe["productName"]; ?></td>
                <td><?php echo $ipe["petType"]; ?></td>
                <td><?php echo $ipe["tierLevel"]; ?></td>
                <td><?php echo $ipe["productDescription"]; ?></td>
                <td><?php echo $ipe["productWeight"]; ?></td>
                <td><?php echo $ipe["productPrice"]; ?></td>
                <td><?php echo $ipe["stock"]; ?></td>
                <td><?php echo $ipe["status"]; ?></td>
            </tr>
            <?php
            endforeach;
            ?>
        </table><br>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h3>Edit Inventory</h3>
            <label>Inventory ID: <input type="tel" name="inventoryId" required></label><br>
<!--            <label>Product Name: <input type="text" name="productName" required></label><br>-->
<!--            <label>Tier Level:-->
<!--                <select name="tierLevel" required>-->
<!--                    <option value="1">1</option>-->
<!--                    <option value="2">2</option>-->
<!--                    <option value="3">3</option>-->
<!--                </select>-->
<!--            </label><br>-->
            <label>Stock: <input type="tel" name="stock" required></label><br>
            <label>
                <select name="status" required>
                    <option value="available">Available</option>
                    <option value="not available">Not Available</option>
                </select>
            </label><br>
            <input type="submit" name="editInventory" class="btn btn-dark">
        </form><br>

        <?php
        if (isset($_POST["editInventory"])) {
            $inventoryId = $inventoryStatus = $inventoryStock = "";
            $inventoryId = $_POST["inventoryId"];
            $inventoryStock = $_POST["stock"];
            $inventoryStatus = $_POST["status"];

            $sql = "update inventory set stock = '$inventoryStock', status = '$inventoryStatus' where inventoryId = '$inventoryId'";
            $statement = $db->prepare($sql);

            if ($statement->execute()) {
                $statement->closeCursor();
                echo "<h3>Successfully Updated Inventory</h3>";
            } else {
                echo "<h3>Error Updating Inventory</h3>";
            }
        }
        ?>

        <h2>Product Attributes</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Attribute ID</th>
                <th>Product ID</th>
                <th>Attribute</th>
                <th>Value</th>
            </tr>
            <?php
            foreach ($inventoryAttributes as $ia): ?>
            <tr>
                <td><?php echo $ia["productAttributeId"]; ?></td>
                <td><?php echo $ia["productId"]; ?></td>
                <td><?php echo $ia["attribute"]; ?></td>
                <td><?php echo $ia["value"]; ?></td>
            </tr>
            <?php
            endforeach;
            ?>
            </thead>
        </table><br>


        <?php
        $sql= "select * from subscriptions";
        $statement = $db->prepare($sql);

        if ($statement->execute()) {
            $subscriptionBoxes = $statement->fetchAll();
            $statement->closeCursor();
        } else {
            echo "<h3>Error Loading Subscription Boxes</h3>";
        }
        ?>

        <h2>Subscription Boxes</h2>
        <table class="table">
            <tr>
                <thead>
                <th>Subscription ID</th>
                <th>Subscription Box SKU</th>
                <th>Box Name</th>
                <th>Description</th>
                <th>Pet Type</th>
                <th>Duration</th>
                <th>Tier 1 Amount</th>
                <th>Tier 2 Amount</th>
                <th>Tier 3 Amount</th>
                <th>Price</th>
                <th>Active</th>
                </thead>
            </tr>
            <?php
            foreach ($subscriptionBoxes as $sb): ?>
            <tr>
                <td><?php echo $sb["subscriptionId"]; ?></td>
                <td><?php echo $sb["subscriptionBoxSku"]; ?></td>
                <td><?php echo $sb["name"]; ?></td>
                <td><?php echo $sb["subscriptionDescription"]; ?></td>
                <td><?php echo $sb["petType"]; ?></td>
                <td><?php echo $sb["duration"]; ?></td>
                <td><?php echo $sb["tierOneAmount"]; ?></td>
                <td><?php echo $sb["tierTwoAmount"]; ?></td>
                <td><?php echo $sb["tierThreeAmount"]; ?></td>
                <td><?php echo $sb["subscriptionPrice"]; ?></td>
                <td><?php echo $sb["isActive"]; ?></td>
            </tr>
            <?php
            endforeach;
            ?>
        </table><br>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h3>Edit Subscription Boxes</h3>
            <label>Subscription ID: <input type="tel" name="subscriptionId" required></label><br>
            <label>Box Name: <input type="text" name="boxName" required></label><br>
            <label>Description: <textarea name="description" required></textarea> </label><br>
            <label>Pet Type:
                <select name="petType" required>
                    <option value="" selected></option>
                    <option value="Cat">Cat</option>
                    <option value="Dog">Dog</option>
                </select>
            </label><br>
            <label>Duration: <input type="text" name="duration" required> </label><br>
            <label>Tier 1 Amount:
                <select name="tierOneAmount" required>
                    <option value="" selected></option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </label><br>
            <label>Tier 2 Amount:
                <select name="tierTwoAmount" required>
                    <option value="" selected></option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </label><br>
            <label>Tier 3 Amount:
                <select name="tierThreeAmount" required>
                    <option value="" selected></option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </label><br>
            <label>Price: <input type="tel" name="price" required></label><br>
            <label>Is Active:
                <select name="active" required>
                    <option value="" selected></option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </label><br>
            <input type="submit" name="editSubscription" class="btn btn-dark">
        </form><br>

        <?php
        if (isset($_POST["editSubscription"])) {
            $subscriptionId = $boxName = $description = $petType = $duration = $tierOneAmount = $tierTwoAmount = $tierThreeAmount = $price = $active = "";
            $subscriptionId = $_POST["subscriptionId"];
            $boxName = $_POST["boxName"];
            $description = $_POST["description"];
            $petType = $_POST["petType"];
            $duration = $_POST["duration"];
            $tierOneAmount = $_POST["tierOneAmount"];
            $tierTwoAmount = $_POST["tierTwoAmount"];
            $tierThreeAmount = $_POST["tierThreeAmount"];
            $price = $_POST["price"];
            $active = $_POST["active"];

            $sql = "update subscriptions set name = '$boxName', subscriptionDescription = '$description', petType = '$petType', duration = '$duration', tierOneAmount = '$tierOneAmount', tierTwoAmount = '$tierTwoAmount', tierThreeAmount = '$tierThreeAmount', subscriptionPrice = '$price', isActive = '$active' where subscriptionId = '$subscriptionId'";
            $statement = $db->prepare($sql);

            if ($statement->execute()) {
                $statement->closeCursor();
                echo "<h3>Successfully Updated Subscription Box</h3>";
            } else {
                echo "<h3>Error Updating Subscription Box</h3>";
            }
        }
        ?>


        <?php
        $sql= "select * from products";
        $statement = $db->prepare($sql);

        if ($statement->execute()) {
            $products = $statement->fetchAll();
            $statement->closeCursor();
        } else {
            echo "<h3>Error Loading Products</h3>";
        }
        ?>

        <h2>Products</h2>
        <table class="table">
            <tr>
                <thead>
                <th>Product ID</th>
                <th>Name</th>
                <th>SKU</th>
                <th>Pet Type</th>
                <th>Tier Level</th>
                <th>Description</th>
                <th>Weight</th>
                <th>Price</th>
                </thead>
            </tr>
            <?php
            foreach ($products as $p): ?>
            <tr>
                <td><?php echo $p["productId"]; ?></td>
                <td><?php echo $p["productName"]; ?></td>
                <td><?php echo $p["sku"]; ?></td>
                <td><?php echo $p["petType"]; ?></td>
                <td><?php echo $p["tierLevel"]; ?></td>
                <td><?php echo $p["productDescription"]; ?></td>
                <td><?php echo $p["productWeight"]; ?></td>
                <td><?php echo $p["productPrice"]; ?></td>
            </tr>
            <?php
            endforeach;
            ?>
        </table><br>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h3>Edit Products</h3>
            <label>Product ID: <input type="tel" name="productId" required></label><br>
            <label>Name: <input type="text" name="productName" required></label><br>
            <label>SKU: <input type="text" name="sku" required></label><br>
            <label>Pet Type:
                <select name="petType" required>
                    <option value="" selected></option>
                    <option value="Cat">Cat</option>
                    <option value="Dog">Dog</option>
                </select>
            </label><br>
            <label>Tier Level:
                <select name="tierLevel" required>
                    <option value="" selected></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </label><br>
            <label>Description: <textarea name="description" required></textarea> </label><br>
            <label>Weight: <input type="tel" name="weight" required></label><br>
            <label>Price: <input type="tel" name="price" required></label><br>
            <input type="submit" name="editProduct" class="btn btn-dark">
        </form><br>

        <?php
        if (isset($_POST["editProduct"])) {
            $productId = $productName = $sku  = $petType = $tierLevel = $description = $weight = $price = "";
            $productId = $_POST["productId"];
            $productName = $_POST["productName"];
            $sku = $_POST["sku"];
            $petType = $_POST["petType"];
            $tierLevel = $_POST["tierLevel"];
            $description = $_POST["description"];
            $weight = $_POST["weight"];
            $price = $_POST["price"];

            $sql = "update products set productName = '$productName', sku = '$sku', petType = '$petType', tierLevel = '$tierLevel', productDescription = '$description', productWeight = '$weight', productPrice = '$price' where productId = '$productId'";
            $statement = $db->prepare($sql);

            if ($statement->execute()) {
                $statement->closeCursor();
                echo "<h3>Successfully Updated Product</h3>";
            } else {
                echo "<h3>Error Updating Product</h3>";
            }
        }
        ?>


        <?php
        $sql= "SELECT * FROM `product-categories` INNER JOIN products ON `product-categories`.`productId` = products.productId INNER JOIN categories ON `product-categories`.`categoryId` = categories.categoryId ORDER BY products.productId ASC";
        $statement = $db->prepare($sql);

        if ($statement->execute()) {
            $productCategories = $statement->fetchAll();
            $statement->closeCursor();
        } else {
            echo "<h3>Error Loading Product Categories</h3>";
        }
        ?>


        <h2>Product Categories</h2>
        <table class="table">
            <tr>
                <thead>
                <th>Product Category ID</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>SKU</th>
                <th>Category Name</th>
                </thead>
            </tr>
            <?php
            foreach ($productCategories as $pc): ?>
                <tr>
                    <td><?php echo $pc["productCategoryId"]; ?></td>
                    <td><?php echo $pc["productId"]; ?></td>
                    <td><?php echo $pc["productName"]; ?></td>
                    <td><?php echo $pc["sku"]; ?></td>
                    <td><?php echo $pc["name"]; ?></td>
                </tr>
            <?php
            endforeach;
            ?>
        </table><br>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h3>Remove Product Categories</h3>
            <label>Product Category ID: <input type="tel" name="productCategoryId" required></label><br>
            <input type="submit" name="deleteCategory" class="btn btn-dark">
        </form><br>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h3>Remove Product Categories</h3>
            <label>Product Category ID: <input type="tel" name="productCategoryId" required></label><br>
            <input type="submit" name="deleteCategory" class="btn btn-dark">
        </form><br>

        <?php
        if (isset($_POST["deleteCategory"])) {
            $productCategoryId = "";
            $productCategoryId = $_POST["productCategoryId"];

            $sql = "DELETE FROM `product-categories` WHERE `product-categories`.`productCategoryId` = '$productCategoryId'";
            $statement = $db->prepare($sql);

            if ($statement->execute()) {
                $statement->closeCursor();
                echo "<h3>Successfully Removed Category</h3>";
            } else {
                echo "<h3>Error Removing Category</h3>";
            }
        }
        ?>

    </div>

<?php
}
?>

<div class="container">
    <?php
    $status = "";
    if (isset($_POST["addToInventory"])) {
        $status = "not available";
        $inventory = $_POST["productInventory"];
        $attribute = $_POST["attributeId"];
        $productIdNum = $_POST["productId"];

        $sql = "insert into inventory (productAttributeId, productId, stock, status) values ('$attribute', '$productIdNum', '$inventory', '$status')";
        $statement = $db->prepare($sql);

        if ($statement->execute()) {
            $statement->closeCursor();
            echo "<h3>Successfully Added to Inventory</h3>";
        } else {
            echo "<h3>Error Adding to Inventory</h3>";
        }
    }
    ?>

</div>

</body>
</html>