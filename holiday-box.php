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
        <title>Out Fur Delivery | Past Boxes | Holiday Boxes 2020</title>
    </head>
    <body>

<?php
include "header.php";
?>


<div class="container shadow-lg p-0">
    <div class="homePlan p-5">
        <h1 class="productsH1 w-75 m-auto pb-2">Holiday Paw Packages 2020</h1>
        <p>Order the limited edition 2020 holiday Halloween box and holiday box</p>
    </div>
    <div class="row">
        <div class="col-md-4 pl-5 pr-5 pb-3">
            <img src="images/pastBoxes/tier-box-special-holiday-2.png" class="img-fluid">
        </div>
        <div class="col-md-4 pl-5 pr-5 pb-3">
            <img src="images/pastBoxes/tier-box-special-holiday-3.png" class="img-fluid">
        </div>
        <div class="col-md-4 pl-5 pr-5 pb-3">
            <img src="images/pastBoxes/tier-box-special-holiday-4.png" class="img-fluid">
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


