<?php
    include_once("classes/User.php");
    include_once("classes/Transaction.php");
    include_once("classes/Db.php");

    session_start();
    if(!isset($_SESSION["user"])){
        header("Location: login.php");
    }
    //set this user
    $user = new User();
    $user->getUser($_SESSION["user"]);
    $currentSaldo = $user->getSaldo();

    if(!empty($_POST)){
        if($_POST["type"] == "transaction"){
            $transaction = new Transaction();
            $transaction->setFromUser($_POST["from"]);
            $transaction->setToUser($_POST["to"]);
            $transaction->setAmount($_POST["amount"]);
            $transaction->setDetails($_POST["details"]);

            $success = $transaction->newTransaction();

            var_dump($success);
        }else{
            $previousSaldo = $user->getSaldo();
            
            if($_POST["subtract"]){
                $saldo = $previousSaldo - $amount;
            }else{
                $saldo = $previousSaldo + $amount;
            }
            $conn = Db::getConnection();
            $statement = $conn->prepare("update users set saldo = :amount where email = :email");
            $statement->bindValue(":amount", $saldo);
            $statement->bindValue(":email", $_SESSION["user"]);
            $statement->execute();

        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>test area</title>
</head>
<body>
    <form action="" method="post">
        <label for="from">From:</label>
        <input type="text" name="from" id="from" placeholder="from">
        <br>
        <label for="to">To:</label>
        <input type="text" name="to" id="to" placeholder="from">
        <br>
        <label for="amount">Amount:</label>
        <input type="number" name="amount" id="amount" value="1">
        <br>
        <label for="details">Details:</label>
        <input type="text" name="details" id="details" placeholder="details">
        <br>
        <input type="hidden" name="type" value="transaction">
        <input type="submit" value="Execute">
    </form>
    <form action="" method="post">
        <label for="from">For:</label>
        <input type="text" name="for" id="for" placeholder="for">
        <br>
        <label for="amount">Amount:</label>
        <input type="number" name="amount" id="amount">
        <br>
        <label for="subtract">Subtract:</label>
        <input type="checkbox" name="sub" id="sub">
        <br>
        <input type="hidden" name="type" value="add">
        <input type="submit" value="Execute">
    </form>
</body>
</html>