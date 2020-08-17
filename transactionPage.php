<?php
    include_once("classes/User.php");
    include_once("classes/Transaction.php");
    include_once("classes/Db.php");

    if(!empty($_POST)){
        $input = $_POST["input"];

        $conn = Db::getConnection();
        $statement = $conn->prepare("select name from users where name like :input");
        $statement->bindValue(":input", $input);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $result;
    }else{
        header("Location: index.php");
    }
?>