<?php
    include_once("classes/User.php");
    include_once("classes/Transaction.php");
    include_once("classes/Db.php");

    session_start();
    if(!empty($_POST)){
        $user = new User();
        try{
            $email = $_POST["email"];
            $password = $_POST["password"];
            $name = $_POST["name"];
            if(!$user->emailCheck($email)){
                $result = $user->saveNewUser($email, $password, $name);
            }else{
                $result = "invalid email";
            }
        }catch(Exception $e){
            $result = "error: " . $e->getMessage();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>Register</title>
    </head>
    <body>
        <div class="main">
            <div class="resultView">
                <?php if(isset($result)){
                    echo($result);
                } ?>
            </div>
            <form action="" method="post">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" placeholder="example@student.thomasmore.be">
                <label for="password">Password:</label>
                <input type="text" id="password" name="password" placeholder="********">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Bob Bobinson">
                <input type="submit" value="Register">
            </form>
        </div>
    </body>
</html>