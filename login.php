<?php
    include_once("classes/User.php");
    include_once("classes/Transaction.php");

    session_start();

    if(!empty($_POST)){
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Log In</title>
</head>
<body>
    <div class="main">
        <!-- Log in form -->
        <form action="" method="post">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" placeholder="example@student.thomasmore.be">
            <label for="password">Password:</label>
            <input type="text" id="password" name="password" placeholder="********">
            <input type="submit" value="Log In">
        </form>
    </div>
</body>
</html>