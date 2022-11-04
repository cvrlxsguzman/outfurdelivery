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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css" type="text/css">
    <script src="js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet.css" type="text/css">
    <title>Out Fur Delivery | Create Account</title>
</head>
<body>

<?php
include "header.php";
?>

<div class="container shadow-lg p-5">
    <ul class="nav nav-pills mb-3 nav-justified w-75 m-auto" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active text-dark" id="pills-signIn-tab" data-toggle="pill" href="#pills-signIn" role="tab" aria-controls="pills-signIn" aria-selected="true">Sign In</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" id="pills-createAccount-tab" data-toggle="pill" href="#pills-createAccount" role="tab" aria-controls="pills-createAccount" aria-selected="false">Create Account</a>
        </li>
    </ul>

    <div class="signIn tab-content w-75 m-auto" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-signIn" role="tabpanel" aria-labelledby="pills-signIn-tab">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="w-75 m-auto">
                <h3 class="p-3">Sign In</h3>
                <label class="w-100">
                    <input class="w-100" type="text" name="signInEmail" placeholder="Email" required autocomplete="on" />
                </label>
                <label class="w-100">
                    <input class="w-100" type="password" name="signInPassword" placeholder="Password" required autocomplete="on" />
                </label>
                <input type="submit" name="signIn" value="Sign In" class="btn btn-dark btn-block">
            </form>

            <?php
            require_once "connect-db.php";

            if (isset($_POST["signIn"])) {
                $signInEmail = $signInPassword = "";
                $signInEmail = $_POST["signInEmail"];
                $signInPassword = $_POST["signInPassword"];

                $sql = "select * from users where email = '$signInEmail'";
                $statement = $db->prepare($sql);

                if ($statement->execute()) {
                    $userEmail = $statement->fetchAll();
                    $statement->closeCursor();
                    if ($userEmail) {
                        foreach ($userEmail as $ue):
                            $validPassword = password_verify($signInPassword, $ue["password"]);

                        if ($signInEmail == "admin@outfurdelivery.com" && $validPassword) {
                            $_SESSION["admin_logged_in"] = true;
                        }

                        if ($validPassword) {
                            $_SESSION["logged_in"] = true;
                            $_SESSION["email"] = $ue["email"];
                            $_SESSION["userId"] = $ue["userId"];
                            $_SESSION['orderNum'] = uniqid();
                            $_SESSION['cartTotal'] = 0;
                            $_SESSION['checkedOut'];

                            $_SESSION['orderOrder'] = false;
                            $_SESSION['orderInformation'] = false;
                            $_SESSION['orderAddress'] = false;
                            $_SESSION['orderPayment'] = false;
                            $_SESSION['orderView'] = false;
                            $_SESSION['orderViewId'] = "";
                            ?>
                            <script>
                                window.location = 'index.php';
                            </script>
                            <?php
                            header('Location: index.php');
                        }
                        endforeach;
                        echo "<h3>Password is Incorrect</h3>";
                    }
                } else {
                    echo "<h3>Invalid Email</h3>";
                }
            }
            ?>

        </div>

        <div class="tab-pane fade" id="pills-createAccount" role="tabpanel" aria-labelledby="pills-createAccount-tab">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="w-75 m-auto">
                <h3 class="p-3">Create Account</h3>
                <div class="row">
                    <div class="col-sm-6">
                        <label class="w-100">
                            <input class="w-100" type="text" name="firstName" placeholder="First Name" required autocomplete="on" />
                        </label>
                    </div>
                    <div class="col-sm-6">
                        <label class="w-100">
                            <input class="w-100" type="text" name="lastName" placeholder="Last Name" required autocomplete="on" />
                        </label>
                    </div>
                </div>
                <label class="w-100">
                    <input class="w-100" type="email" name="email" placeholder="Email" required autocomplete="on" />
                </label>
                <label class="w-100">
                    <input class="w-100" type="password" name="password" placeholder="Password" required autocomplete="on" />
                </label>
                <label class="w-100">
                    <input class="w-100" type="tel" name="phone" placeholder="Phone" required autocomplete="on" />
                </label>
                <label class="w-100">
                    <input class="w-100" type="date" name="birthday" placeholder="Birthday" required autocomplete="on" />
                </label>
                <input type="submit" name="createAccount" value="Create Account" class="btn btn-dark btn-block">
            </form>

            <?php
            require_once "connect-db.php";
            if (isset($_POST["createAccount"])) {
                $firstName = $lastName = $email = $password = $phone = $birthday = $formatBirthday = $emailCheck = $emailTaken = "";
                $firstName = $_POST["firstName"];
                $lastName = $_POST["lastName"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $phone = $_POST["phone"];
                $birthday = $_POST["birthday"];
                $formatBirthday = date_format(date_create($birthday), "Y/m/d");
                $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

                $dbConnect = mysqli_connect("localhost", "root", "", "outfurdelivery");

                $emailTaken = false;

                $emailCheck = mysqli_query($dbConnect,"SELECT email FROM users WHERE email = '$email'");

                if (mysqli_num_rows($emailCheck) >= 1) {
                    echo "<h3>Email: " . $email . " is already taken</h3>";
                    $emailTaken = true;
                }

                if (!$emailTaken) {
                    $sql = "insert into users (firstName, lastName, email, password, phone, birthday) values ('$firstName', '$lastName', '$email', '$passwordHashed', '$phone', '$formatBirthday')";
                    $statement = $db->prepare($sql);

                    if ($statement->execute()) {
                        $statement->closeCursor();
                        echo "<h3>Successfully Created Account!</h3>";
                    } else {
                        echo "<h3>Error Creating Account. Try Again.</h3>";
                    }
                }
            }
            ?>

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