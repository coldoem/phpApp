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
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        if(!$result){
            echo "no users found";
        }else{
            foreach($result as $option){
                echo $option["name"];
            }
        }
    }else{
        header("Location: index.php");
    }
?>