<?php
    include_once("classes/User.php");
    include_once("classes/Transaction.php");

    session_start();
    if(!isset($_SESSION["user"])){
        header("Location: login.php");
    }

    $user = new User();
    $user->getUser($_SESSION["user"]);
    $currentSaldo = $user->getSaldo();

    $recentTransactions = $user->getRecentTransactions();

    $validTarget = false;

    /*if(!empty($_POST["amount"])){
        if(!empty($_POST["details"])){
            $fromUser = $user->getEmail();
            $recipient = new User();
            
        }else{
            $detailsMessage = true;
        }
    }*/

    if(!empty($_POST)){
        $input = $_POST["searchBar"];

        $conn = Db::getConnection();
        $statement = $conn->prepare("select name from users where name like :input");

        $statement->bindValue(":input", $input);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        
        var_dump($result);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>Home</title>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery.session@1.0.0/jquery.session.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#searchBar").keyup(function(){
                    var input = $(this).val();

                    if(input != ""){
                        $.post("transactionPage.php", {input : input}, function(result){
                            $("#ajaxResponseHolder").html(result);
                        });
                    }
                });
            });
        </script>
    </head>
    <body>
        <a href="logout.php" class="logout"><div>Log Out</div></a>
        <div class="top">
            <!-- current saldo -->
            <h2>Current Saldo:</h2>
            <h1><?php echo $currentSaldo; ?></h1>
            <!-- ?user information? -->
        </div>
        <div class="main">
            <!-- Transaction button / options -->
            <h2>Make new Transaction:</h2>
            <form action="" method="post" class="transactionForm">
                <label for="searchBar">Find user:</label>
                <input type="text" id="searchBar" name="searchBar" placeholder="example person">
                <input type="submit" value="Select">
            </form>
            <h4 id="ajaxResponseHolder"></h4>
            <?php if(!empty($_POST) && $validTarget) : ?>
                <form action="" method="post" class="transactionForm">
                    <label for="amount">Amount:</label>
                    <input type="number" min="1" name="amount" value="1">
                    <br>
                    <label for="details">Add a reason:</label>
                    <input type="text" name="details" placeholder="For the lovely bottle of Wine.">
                    <br>
                    <input type="submit" value="Send">
                </form>
            <?php endif; ?>
            <!-- List of of previous Transactions -->
            <div class="transactionFeed">
                <?php foreach($recentTransactions as $transaction) : ?>
                <div class="transactionFeedItem">
                    <p><?php //placeholder example?>Will Smith heeft u 10 tokens gestuurd op: 7 augustus 2020</p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </body>
</html>