<?php
    include_once("classes/User.php");
    include_once("classes/Transaction.php");

    session_start();
    if(!isset($_SESSION["user"])){
        header("Location: login.php");
    }

    $user = new User();
    $user->getUser($_SESSION["user"]);
    $currentSaldo = $user->getSaldo();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>Home</title>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery.session@1.0.0/jquery.session.min.js"></script>
    </head>
    <body>
        <div class="logout">
            <a href="logout.php"><button>Log Out</button></a>
        </div>
        <div class="top">
            <!-- current saldo -->
            <h2>Current Saldo:</h2>
            <h1><?php echo $currentSaldo; ?></h1>
            <!-- ?user information? -->
        </div>
        <div class="main">
            <!-- Transaction button / options -->
            <form action="" method="post">
                <label for="searchBar">Find user:</label>
                <input type="text" id="searchBar" name="searchBar" placeholder="example person">
                <input type="submit" value="Search">
            </form>
            <!-- List of of previous Transactions -->
            <?php //transaction feed foreach start ?>
            <div class="transactionFeedItem">
                <p><?php //placeholder example?>Will Smith heeft u 10 tokens gestuurd op: 7 augustus 2020</p>
            </div>
            <?php //endforeach ?>
        </div>
    </body>
</html>