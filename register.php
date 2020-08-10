<?php
    include_once("classes/User.php");
    include_once("classes/Transaction.php");
    include_once("classes/Db.php");

    session_start();
    $result = "";
    if(!empty($_POST)){
        $user = new User();
        try{
            $user->setEmail($_POST["email"]);
            $user->setPassword($_POST["password"]);
            $user->setName($_POST["name"]);
            $user->setVerified(false);
            $result = $user->saveNewUser();
        }catch(Exception $e){
            $result = $e->getMessage();
        }

        $test = $user->getUser($_POST["email"]);
        var_dump($test);
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
                <?php echo $result; ?>
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