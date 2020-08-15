<?php
    include_once("classes/User.php");
    include_once("classes/Transaction.php");

    session_start();

    if(!empty($_POST)){
        $user = new User;
        $email = $_POST["email"];
        $password = $_POST["password"];

        if($user->canLogin($email, $password)){
            $_SESSION["user"] = $email;
            header("Location: index.php");
        }else{
            $response = "invalid credentials";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/ihateCashedCSS.css">
        <title>Log In</title>
    </head>
    <body>
        <?php if(isset($response)){
            echo $response;
        } ?>
        <div class="main">
            <!-- Log in form -->
            <form action="" method="post" class="loginForm">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" placeholder="example@student.thomasmore.be">
                <br>
                <label for="password">Password:</label>
                <input type="text" id="password" name="password" placeholder="********">
                <br>
                <input type="submit" value="Log In">
            </form>
            <h4>Don't have an account yet?</h4>
            <p><a href="register.php">Register here</a></p>
        </div>
    </body>
</html>