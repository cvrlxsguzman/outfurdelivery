<?php
$link = mysqli_connect("localhost", "root", "", "outfurdelivery");

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if(isset($_REQUEST["term"])){
    $sql = "SELECT * FROM users WHERE firstName LIKE ? or lastName LIKE ? or email like ? LIMIT 10";

    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "sss", $param_term, $param_term2, $param_term3);

        $param_term = $_REQUEST["term"] . '%';
        $param_term2 = $_REQUEST["term"] . '%';
        $param_term3 = $_REQUEST["term"] . '%';

        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    ?>

                    <div class="searchResults">
                        <a href="profile.php">
                            <img src="images/profileIcon.png">
                            <p><?php echo $row["firstName"] . " " . $row["lastName"]; ?></p>
                            <p><?php echo "@" . $row["email"]; ?></p>
                        </a>
                    </div>

                    <?php
                }
            } else{
                echo "<p>No matches found</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($link);
?>