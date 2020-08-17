<?php
    include_once("classes/User.php");
    include_once("classes/Transaction.php");
    //check if user is logged in
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
    <title>Transaction Details</title>
</head>
<body>
    
</body>
</html>