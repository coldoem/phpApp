<?php
    if(!empty($_POST)){
        if(isset($_POST["dummyTransaction"])){
            //ask for details?
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
        <label for="dummyTransaction">Create Dummy Transaction:</label>
        <input type="checkbox" name="dummyTransaction" value="1">
        <br>
        <label for="dummyTransaction">Create Dummy User:</label>
        <input type="checkbox" name="dummyUser" value="1">
        <br>
        <label for="dummyTransaction">Add Saldo:</label>
        <input type="checkbox" name="addSaldo" value="1">
        <br>
        <label for="dummyTransaction">Remove Saldo:</label>
        <input type="checkbox" name="removeSaldo" value="1">
        <br>
        <input type="submit" value="Execute">
    </form>
</body>
</html>