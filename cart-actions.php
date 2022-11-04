<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "connect-db.php";
    $userId = $_SESSION["userId"];
    $whatToDo = $_POST['whatToDo'];

    if ($whatToDo == 'addToCart') {
        $orderId = $_SESSION['orderNum'];
        $productId = $_POST["productId"];
        $quantity = $_POST["quantity"];
        $itemPrice = $_POST["itemPrice"];
        $total = $itemPrice * $quantity;

        $sql = "insert into `order-items` (orderId, userId, productId, quantity, total) values ('$orderId', '$userId', '$productId', '$quantity', '$total')";
        $statement = $db->prepare($sql);


        if ($statement->execute()) {
            $itemDetails = $statement->fetchAll();
            $statement->closeCursor();
            $_SESSION['cartTotal'] += $total;
            header('Location: cart.php');
        } else {
            echo "<h3>Error Adding to Cart</h3>";
        }
    }

    if ($whatToDo == 'addBoxToCart') {
        $orderId = $_SESSION['orderNum'];
        $subscriptionId = $_POST["boxId"];
        $quantity = $_POST["quantity"];
        $itemPrice = $_POST["boxPrice"];
        $total = $itemPrice * $quantity;

        $sql = "insert into `order-subscription-box` (orderId, userId, subscriptionId, quantity, total) values ('$orderId', '$userId', '$subscriptionId', '$quantity', '$total')";
        $statement = $db->prepare($sql);

        if ($statement->execute()) {
            $itemDetails = $statement->fetchAll();
            $statement->closeCursor();
            $_SESSION['cartTotal'] += $total;
            header('Location: cart.php');
        } else {
            echo "<h3>Error Adding to Cart</h3>";
        }
    }

    if($whatToDo == 'updateBoxCart') {
        $boxId = $_POST["boxId"];
        $orderId = $_SESSION['orderNum'];
        $quantity = $_POST["quantity"];
        $itemPrice = $_POST["boxPrice"];
        $total = $quantity * $itemPrice;

        $sql2 = "select * from `order-subscription-box` where orderSubscriptionBoxId = '$boxId'";
        $statement2 = $db->prepare($sql2);

        if ($statement2->execute()) {
            $boxContents = $statement2->fetchAll();
            $statement2->closeCursor();
        }

        foreach ($boxContents as $bc):
        $_SESSION['cartTotal'] -= $bc["total"];
        endforeach;

        $sql = "update `order-subscription-box` set quantity = '$quantity', total = '$total' where orderSubscriptionBoxId = '$boxId'";
        $statement = $db->prepare($sql);

        if ($statement->execute()) {
            $statement->closeCursor();
            $_SESSION['cartTotal'] += $total;
            header('Location: cart.php');
        }
    }

    if($whatToDo == 'updateProdCart') {
        $itemId = $_POST["itemId"];
        $orderId = $_SESSION['orderNum'];
        $quantity = $_POST["quantity"];
        $itemPrice = $_POST["itemPrice"];
        $total = $quantity * $itemPrice;

        $sql2 = "select * from `order-items` where orderItemId = '$itemId'";
        $statement2 = $db->prepare($sql2);

        if ($statement2->execute()) {
            $itemContents = $statement2->fetchAll();
            $statement2->closeCursor();
        }

        foreach ($itemContents as $ic):
            $_SESSION['cartTotal'] -= $ic["total"];
        endforeach;

        $sql = "update `order-items` set quantity = '$quantity', total = '$total' where orderItemId = '$itemId'";
        $statement = $db->prepare($sql);

        if ($statement->execute()) {
            $statement->closeCursor();
            $_SESSION['cartTotal'] += $total;
            header('Location: cart.php');
        }
    }

    if ($whatToDo == 'removeBoxCart') {
        $boxId = $_POST["boxId"];

        $sql2 = "select * from `order-subscription-box` where orderSubscriptionBoxId = '$boxId'";
        $statement2 = $db->prepare($sql2);

        if ($statement2->execute()) {
            $boxContents = $statement2->fetchAll();
            $statement2->closeCursor();
        }

        foreach ($boxContents as $bc):
            $_SESSION['cartTotal'] -= $bc["total"];
        endforeach;

        $sql = "delete from `order-subscription-box` where `order-subscription-box`.orderSubscriptionBoxId = '$boxId'";
        $statement = $db->prepare($sql);

        if ($statement->execute()) {
            $statement->closeCursor();
            header('Location: cart.php');
        }
    }

    if ($whatToDo == 'removeProdCart') {
        $itemId = $_POST["itemId"];

        $sql2 = "select * from `order-items` where orderItemId = '$itemId'";
        $statement2 = $db->prepare($sql2);

        if ($statement2->execute()) {
            $itemContents = $statement2->fetchAll();
            $statement2->closeCursor();
        }

        foreach ($itemContents as $ic):
            $_SESSION['cartTotal'] -= $ic["total"];
        endforeach;

        $sql = "delete from `order-items` where `order-items`.orderItemId = '$itemId'";
        $statement = $db->prepare($sql);

        if ($statement->execute()) {
            $statement->closeCursor();
            header('Location: cart.php');
        }
    }

    if ($whatToDo == 'checkout') {
        $orderId = $_SESSION['orderNum'];
        $userId = $_SESSION["userId"];
        $cartTotal = $_SESSION['cartTotal'];
        $taxAmount = $_SESSION['cartTotal'] * .05;
        $name = $_POST["firstName"] . " " . $_POST["lastName"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $cardName = $_POST["cardName"];
        $cardNumber = $_POST["cardNumber"];
        $expirationDate = $_POST["cardExp"];
        $CVV = $_POST["cardCVV"];
        $streetAddress = $_POST["address"] . " " . $_POST["apt"];
        $city = $_POST["city"];
        $state = $_POST["state"];
        $zip = $_POST["zip"];
        $shipmentId = $_POST["shipping"];
        $shipmentCost = 0;

//        if ($shipmentType == "Standard") {
//            $shipmentCost = 0;
//        } else if ($shipmentType == "Priority") {
//            $shipmentCost = 10;
//            $cartTotal += 10;
//        } else if ($shipmentType == "Express") {
//            $shipmentCost = 20;
//            $cartTotal += 20;
//        }

        $sql = "insert into orders (orderId, userId, cartTotal, taxAmount, name, email, phone, cardName, cardNumber, expirationDate, CCV, streetAddress, city, state, zip, shipmentId) values ('$orderId', '$userId', '$cartTotal', '$taxAmount', '$name', '$email', '$phone', '$cardName', '$cardNumber', '$expirationDate', '$CVV', '$streetAddress', '$city', '$state', '$zip', '$shipmentId')";
        $statement = $db->prepare($sql);

        if ($statement->execute()) {
            $statement->closeCursor();
            $_SESSION['checkOut'] = true;
            header('Location: finalize-checkout.php');
        } else {
            echo '<h3>Error checking out</h3>';
        }

    }
}