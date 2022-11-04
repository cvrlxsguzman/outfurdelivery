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
        <title>Out Fur Delivery | About Us</title>
    </head>
    <body>

<?php
include "header.php";
?>


<div class="container shadow-lg p-0">
    <div class="homeBanner">
        <img src="images/banners/secondBanner.jpg" alt="Home Dog Banner" class="img-fluid m-auto">
    </div>

    <div class="homePlan p-5">
        <h1>Out Fur Delivery</h1>

        <h3 class="pt-5">Out Fur Delivery started in small town Wisconsin with big ambitions and a love for pets. We want to see every pet live their healthiest life. By providing healthy products shipped right to your door and subscription options available you can spend more time loving on your fur baby. Sourcing only the healthiest, most wholesome, sustainable, grain-free foods.

            We have selected the best most trusted brands for your pet. Compared to other companies we care about your fur babies whether they’re cats, dogs, or some of each. By offering Paw Packages (our subscription boxes) for cats, dogs, or a combination. This selection will provide a convenient and premium experience for you and your pet. You can put worry out of your mind with our pet food delivery services. Let us make sure your fur baby doesn’t miss a meal so you can focus on what’s important. Lastly, it’s important you feel good about supporting Out Fur Delivery since our products are sustainably sourced, environmentally friendly, and made in the U.S.A. </h3>
    </div>

    <div class="homeWhyBuy p-5">
        <div class="row pb-5">
            <h1 class="w-100 m-auto">Why Buy From Out Fur Delivery</h1>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-transparent border-0">
                    <div class="card-img">
                        <img src="images/homeIcons/Asset%2031natural.png" class="w-50">
                    </div>
                    <div class="card-body">
                        <h3>All Out Fur Delivery Products are 100% organic and safe for your pet</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-transparent border-0">
                    <div class="card-img">
                        <img src="images/homeIcons/Asset%2034delivery.png" class="w-50">
                    </div>
                    <div class="card-body">
                        <h3>All Out Fur Delivery Products are thoughtfully assembled and delivered to your door with a stamp of approval from our staff</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-transparent border-0">
                    <div class="card-img">
                        <img src="images/homeIcons/Asset%2033paw.png" class="w-50">
                    </div>
                    <div class="card-body">
                        <h3>All Products are pet approved and made with care at Out Fur Delivery</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="homePlan p-5">
        <h1>FAQ</h1>

        <h3 class="pt-5">Q-What are the benefits of cats eating grain-free foods?</h3>
        <h3 class="pt-3">A-Grain-free foods contain more proteins, less carbs, and in addition are great for cats with food sensitivities.</h3>

        <h3 class="pt-5">Q-What are the benefits of dogs eating grain-free foods?</h3>
        <h3 class="pt-3">A-Grain-free foods contain high protein which is essential for active dogs. In addition, grain-free diets help dogs maintain a healthy weight and its aligned to their natural diet. Also great for diabetic dogs because there is less carbs.</h3>

        <h3 class="pt-5">Q-What is a Paw Package?</h3>
        <h3 class="pt-3">A-A purrfectly crafted pet filled package from Out Fur Delivery.</h3>

        <h3 class="pt-5">Q-What is the cancellation policy?</h3>
        <h3 class="pt-3">A-Cancel before the first of the next month  to avoid getting charged. No cancellation fee.</h3>

        <h3 class="pt-5">Q-Where is my box?</h3>
        <h3 class="pt-3">A-You will receive an email with tracking when your box is shipped. Boxes are shipped on the 10th of every month. If you don’t get an email contact us and we will look into it.</h3>
    </div>

</div>


<?php
include "footer.php";
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </body>
</html>
