<?php
    include_once("classes/User.php");
    include_once("classes/Transaction.php");

    session_start();
    if(!isset($_SESSION["user"])){
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>Home</title>
    </head>
    <body>
        <div class="top">
            <!-- current saldo -->
            <!-- ?user information? -->
        </div>
        <div class="main">
            <!-- Transaction button / options -->
            <!-- List of of previous Transactions -->
        </div>
    </body>
</html>