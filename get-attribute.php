<?php
require_once "connect-db.php";
$db_handle = new DBController();
if (!empty($_GET['productId']))