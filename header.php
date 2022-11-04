<head>

    <style type="text/css">
        .searchBar{
            position: relative;
            display: inline-block;
        }
        .searchResults img {
            max-width: 25%;
            float: left;
            margin: 0 2px 2px;
        }
        .searchResults {
            width: 100%;
            background-color: white;
            clear: both;
        }
        .searchResults a {
            padding: 0 0 4px;
            width: 100%;
        }
        .searchBar input[type="text"]{
            padding: 5px 10px;
            border: 1px solid #CCCCCC;
        }
        .result{
            position: relative;
            z-index: 2;
            top: 100%;
            left: 0;
        }
        .searchBar input[type="text"], .result{
            width: 100%;
            box-sizing: border-box;
        }
        /* Formatting result items */
        .result p{
            margin: 0;
            padding: 7px 10px;
            border-top: none;
            cursor: pointer;
            background-color: white;
            width: 100%;
        }
        .result p:hover{
            background: #f2f2f2;
        }
    </style>


    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.searchBar input[type="text"]').on("keyup input", function(){
                /* Get input value on change */
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if(inputVal.length){
                    $.get("backend-search.php", {term: inputVal}).done(function(data){
                        // Display the returned data in browser
                        resultDropdown.html(data);
                    });
                } else{
                    resultDropdown.empty();
                }
            });

            // Set search input value on click of result item
            $(document).on("click", ".result p", function(){
                $(this).parents(".searchBar").find('input[type="text"]').val($(this).text());
                $(this).parent(".result").empty();
            });
        });
    </script>
</head>

<div class="container shadow-lg p-3 sticky-top bg-light">
    <header>
<!--        <div class="searchBar">-->
<!--            <input type="text" placeholder="Search..">-->
<!--            <div class="result"></div>-->
<!--        </div>-->
        <div class="searchbar">
            <input type="text" placeholder="Search" class="search_input">
            <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
            <div class="result"></div>
        </div>

        <a href="cart.php" ><img src="icons/Blue%20Icons/cart.png" class="cart img-fluid float-right h-25 w-auto p-3"></a>

        <img src="images/logo-04.png" class="">
<!--        <a href="cart.php" ><img src="icons/Blue%20Icons/cart.png" class="img-fluid float-right h-25 w-auto p-1"></a>-->
        <nav class="w-75 m-auto pt-3 navbar">
            <a href="index.php" class="btn btn-light">Home</a>
            <a href="products.php" class="btn btn-light">Products</a>
            <div class="dropdown show bg-white">
                <a class="btn btn-light dropdown-toggle bg-light border-0" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Subscription Boxes
                </a>
                <div class="dropdown-menu shadow-lg" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item bg-light" href="subscription-box.php">Current Paw Packages</a>
                    <a class="dropdown-item bg-light" href="past-boxes.php">Past Paw Packages</a>
                </div>
            </div>
<!--            <a href="subscription-box.php" class="btn btn-light">Subscription Boxes</a>-->
            <a href="aboutus.php" class="btn btn-light">About Us</a>


            <div class="dropdown show float-right">
                <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Account
                </a>

                <div class="dropdown-menu shadow-lg" aria-labelledby="dropdownMenuLink">
                    <?php
                    if (isset($_SESSION["logged_in"])) {
                        if ($_SESSION["logged_in"] == true) { ?>
                            <a class="dropdown-item bg-danger text-light" href="logout.php">Logout</a>
                            <?php
                        }
                    } else { ?>
                        <a class="dropdown-item" href="sign-in.php">Sign In</a>
                        <?php
                    }
                    ?>
                    <a class="dropdown-item" href="account.php">Account</a>
                    <a class="dropdown-item" href="#">My Orders</a>
                </div>
            </div>
        </nav>

    </header>
</div>