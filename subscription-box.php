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
    <title>Out Fur Delivery | Paw Packages</title>
</head>
<body>

<?php
include "header.php";
?>

<div class="container shadow-lg p-0">

    <div class="homePlan p-5">
        <h1 class="productsH1 w-75 m-auto p-5">Paw Packages</h1>

        <h2 class="p-3">Our Paw Packages are thoughtfully assembled with your furry friend in mind. Your pet will love our products which are all made right here in the U.S.A. Nothing says WOOF like patriotism. Our treats are the cat’s meow with all natural 100% grain-free ingredients. Your cats will purr-fer the brands you find in our boxes. </h2>
        <h4 class="homePlan">• 100% grain free</h4>
        <h4 class="homePlan">• Eco-friendly</h4>
        <h4 class="homePlan">• Sustainably sourced</h4>
        <h4 class="homePlan">• Crafted with love</h4>
        <h4 class="homePlan pb-3">• Durable toys that hold with even the most playful of pets </h4>

        <div class="row w-100 m-auto">
            <div class="col-lg-4  pb-3">
                <div class="card shadow-lg">
                    <div class="card-img">
                        <img src="images/pawPackages/tier-box-basic-2.png" class="img-fluid">
                    </div>
                    <div class="card-header-pills p-3">
                        <h2 class="text-dark">Sampler Paw Package</h2>
                        <h4>3 Months</h4>
                        <h4>$10</h4>
                        <p>• 3 Food Samples</p>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_SESSION["logged_in"])) { ?>
                        <a href="subscription-box-details.php?=1" class="btn text-light p-3 rounded-pill">Browse Plan</a>
                        <?php
                        } else { ?>
                            <a href="sign-in.php" class="btn text-light p-3 rounded-pill">Click Here to Login</a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 pb-3">
                <div class="card shadow-lg">
                    <div class="card-img">
                        <img src="images/pawPackages/tier-box-premium-2.png" class="img-fluid">
                    </div>
                    <div class="card-header-pills p-3">
                        <h2 class="text-dark">Playful Paw Package</h2>
                        <h4>6 Months</h4>
                        <h4>$20</h4>
                        <p>• 4 Playful Tier Out Fur Delivery Toys</p>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_SESSION["logged_in"])) { ?>
                        <a href="subscription-box-details.php?=2" class="btn text-light p-3 rounded-pill">Browse Plan</a>
                            <?php
                        } else { ?>
                            <a href="sign-in.php" class="btn text-light p-3 rounded-pill">Click Here to Login</a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 pb-3">
                <div class="card shadow-lg">
                    <div class="card-img">
                        <img src="images/pawPackages/tier-box-professional-2.png" class="img-fluid">
                    </div>
                    <div class="card-header-pills p-3">
                        <h2 class="text-dark">Premium Paw Package</h2>
                        <h4>12 Months</h4>
                        <h5>$50</h5>
                        <p>• 4 Premium Tier Out Fur Delivery Toys</p>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_SESSION["logged_in"])) { ?>
                        <a href="subscription-box-details.php?=3" class="btn text-light p-3 rounded-pill">Browse Plan</a>
                            <?php
                        } else { ?>
                            <a href="sign-in.php" class="btn text-light p-3 rounded-pill">Click Here to Login</a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="homeBanner p-0">
        <img src="images/banners/catanddogfoodbanner.jpg" alt="Home Dog Banner" class="img-fluid m-auto">
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

    <div class="w-50 m-auto p-5">
        <h1 class="pb-2">Reviews from Customers</h1>
        <div class="card border-top-0 border-right-0 border-left-0">
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p>Got my first Paw Package and I am obsessed! I love the packaging and variety of products in the box. Received a 20% off coupon for my next order and will be checking out their food delivery service. My dog enjoyed the treats and loves the chewer toy he got. Every time I see him, he is playing with his new toys/</p>
                    <footer class="blockquote-footer text-right">Melissa S.</footer>
                </blockquote>
            </div>
        </div>
        <div class="card border-top-0 border-right-0 border-left-0">
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p>I heard of Paw Package from my neighbor so I decided I would check it out for my cat. I am SO happy I did. I signed up for the Playful Paw Package and was so happy with the selection of products. My cat has been more playful than ever. I also enjoy the fact that the treats are grain-free and healthy.</p>
                    <footer class="blockquote-footer text-right">Jennifer H.</footer>
                </blockquote>
            </div>
        </div>
        <div class="card border-top-0 border-right-0 border-left-0">
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p>WOW I am so happy my friend told me about Out Fur Delivery! I am so happy they offer subscription boxes for both cats and dogs. I was previously signed up for subscription box through Bark Box and was sad they did not offer anything for cats. Now my cat does not have to be left out. Excited to get the upcoming Christmas box to see the cute- themed goodies!</p>
                    <footer class="blockquote-footer text-right">Chris B.</footer>
                </blockquote>
            </div>
        </div>
    </div>

</div>



<div class="container shadow-lg">
    <div class="homeBanner">
        <div class="row shadow-lg">
            <img src="images/banners/dogandcatlayingdown.png" alt="Home Dog Banner" class="img-fluid m-auto">
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
