<?php
    include_once("classes/User.php");
    include_once("classes/Transaction.php");
    include_once("classes/Db.php");

    if(!empty($_POST)){
        if(strpos($_POST["email"], "@student.thomasmore.be")){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select saldo from users where email = :email");
            $statement->bindValue(":email", $_POST["email"]);

            $statement->execute();

            $result = $statement->fetch(PDO::FETCH_ASSOC);

            echo $result["saldo"];
        }
    }
?>