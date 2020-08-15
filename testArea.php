<?php
    if(!empty($_POST)){

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
        <input type="checkbox" name="dummyTransaction" value="createDummyTransaction">
        <br>
        <label for="dummyTransaction">Create Dummy User:</label>
        <input type="checkbox" name="dummyUser" value="createDummyUser">
        <br>
        <label for="dummyTransaction">Add Saldo:</label>
        <input type="checkbox" name="addSaldo" value="addSaldo">
        <br>
        <label for="dummyTransaction">Remove Saldo:</label>
        <input type="checkbox" name="removeSaldo" value="removeSaldo">
        <br>
        <input type="submit" value="Execute">
    </form>
</body>
</html>