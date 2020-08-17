<?php
    include_once("classes/User.php");
    include_once("classes/Transaction.php");
    if(!empty($_POST)){
        if(!empty($_POST)){
            $transaction = new Transaction();
            $transaction->setFromUser($_POST["from"]);
            $transaction->setToUser($_POST["to"]);
            $transaction->setAmount($_POST["amount"]);
            $transaction->setDetails($_POST["details"]);

            $success = $transaction->newTransaction();

            var_dump($success);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test area</title>
</head>
<body>
    <form action="" method="post">
        <label for="transaction">From:</label>
        <input type="text" name="from" id="from" placeholder="from">
        <br>
        <label for="transaction">To:</label>
        <input type="text" name="to" id="to" placeholder="from">
        <br>
        <label for="transaction">Amount:</label>
        <input type="number" name="amount" id="amount" value="1">
        <br>
        <label for="transaction">Details:</label>
        <input type="text" name="details" id="details" placeholder="details">
        <br>
        <input type="submit" value="Execute">
    </form>
</body>
</html>