<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "connect-db.php";
    $userId = $_SESSION["userId"];
    $whatToDo = $_POST['whatToDo'];

    if ($whatToDo == 'overview') {
        $_SESSION['orderOrder'] = false;
        $_SESSION['orderInformation'] = false;
        $_SESSION['orderAddress'] = false;
        $_SESSION['orderPayment'] = false;
        $_SESSION['orderView'] = false;
        header('Location: account.php');
    }

    if ($whatToDo == 'myOrders') {
        $_SESSION['orderOrder'] = true;
        $_SESSION['orderInformation'] = false;
        $_SESSION['orderAddress'] = false;
        $_SESSION['orderPayment'] = false;
        $_SESSION['orderView'] = false;
        header('Location: account.php');
    }

    if ($whatToDo == 'myInfo') {
        $_SESSION['orderOrder'] = false;
        $_SESSION['orderInformation'] = true;
        $_SESSION['orderAddress'] = false;
        $_SESSION['orderPayment'] = false;
        $_SESSION['orderView'] = false;
        header('Location: account.php');
    }

    if ($whatToDo == 'myAddresses') {
        $_SESSION['orderOrder'] = false;
        $_SESSION['orderInformation'] = false;
        $_SESSION['orderAddress'] = true;
        $_SESSION['orderPayment'] = false;
        $_SESSION['orderView'] = false;
        header('Location: account.php');
    }

    if ($whatToDo == 'myPayments') {
        $_SESSION['orderOrder'] = false;
        $_SESSION['orderInformation'] = false;
        $_SESSION['orderAddress'] = false;
        $_SESSION['orderPayment'] = true;
        $_SESSION['orderView'] = false;
        header('Location: account.php');
    }

    if ($whatToDo == 'logout') {
        header('Location: logout.php');
    }

    if ($whatToDo == 'viewOrder') {
        $_SESSION['orderOrder'] = false;
        $_SESSION['orderInformation'] = false;
        $_SESSION['orderAddress'] = false;
        $_SESSION['orderPayment'] = false;
        $_SESSION['orderView'] = true;
        $_SESSION['orderViewId'] = $_POST['orderId'];
        header('Location: account.php');
    }
}