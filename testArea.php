<?php
    if(!empty($_POST)){
        if(isset($_POST["dummyTransaction"])){
            //ask for details
            
            //create dummy transaction
        }
        if(isset($_POST["dummyUser"])){
            //ask for details?
            //create dummy user
        }
        if(isset($_POST["addSaldo"])){
            //ask for amount
            //add saldo
        }
        if(isset($_POST["removeSaldo"])){
            //ask for amount
            //remove saldo
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