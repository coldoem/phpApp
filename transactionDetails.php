<?php
    include_once("classes/User.php");
    include_once("classes/Transaction.php");
    include_once("classes/Db.php");
    //check if user is logged in
    session_start();
    if(!isset($_SESSION["user"])){
        header("Location: login.php");
    }
    //return user if there is no valid transaction selected
    if(empty($_GET)){
        header("Location: index.php");
    }

    $conn = Db::getConnection();
    $statement = $conn->prepare("select * from transactions where id = :id");
    $statement->bindValue(":id", $_GET["transaction"]);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Transaction Details</title>
</head>
<body>
    <div class="main">
        <a class="return" href="index.php">Go back</a>
        <h1><?php echo $result["fromUser"]; ?> Has send <?php echo $result["amount"]; ?> coins to <?php echo $result["toUser"]; ?></h1>
        <h3>This transaction occured on: <?php echo $result["date"]; ?></h3>
        <h2>The reason given for this transaction: <?php echo $result["details"]; ?></h2>
    </div>
</body>
</html>