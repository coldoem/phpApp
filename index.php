<?php
    include_once("classes/User.php");
    include_once("classes/Transaction.php");
    //check if logged in through session
    session_start();
    if(!isset($_SESSION["user"])){
        header("Location: login.php");
    }
    //set this user
    $user = new User();
    $user->getUser($_SESSION["user"]);
    $currentSaldo = $user->getSaldo();

    $recentTransactions = $user->getRecentTransactions();

    if(!empty($_POST)){
        $cleared = true;
        if(empty($_POST["searchBar"])){
            $cleared = false;
        }
        if(empty($_POST["details"])){
            $cleared = false;
        }
        if($cleared){
            $transaction = new Transaction();
            $transaction->setFromUser($user->getName());
            $transaction->setToUser($_POST["searchBar"]);
            $transaction->setAmount($_POST["amount"]);
            $transaction->setDetails($_POST["details"]);
            $transactionResult = $transaction->performTransaction();
            var_dump($transactionResult);
        }
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
                //ajax for updating current saldo
                function updateSaldo(){
                    $("#currentSaldo").load("updateSaldo.php", {"email" : "<?Php echo $user->getEmail(); ?>"});
                }
                setInterval(updateSaldo, 10000);
                //ajax for finding transaction target
                $("#searchBar").keyup(function(){
                    var input = $(this).val();
                    $("#ajaxResponseHolder li").remove();

                    if(input != "" && input.length > 2){
                        $.post("formAjax.php", {input : input}, function(result){
                            $("#ajaxResponseHolder li").remove();

                            $("#ajaxResponseHolder").append("<li>" + result + "</li>");
                            
                            $(result).each(function(index, value){
                                $("#ajaxResponseHolder").append("<li>" + value + "</li>");
                            });
                            $("#ajaxResponseHolder li").click(function(){
                                $("#ajaxResponseHolder li").remove();
                                $(".secondForm").toggleClass("secondForm");
                            });
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
            <h1 id="currentSaldo"><?php echo $currentSaldo; ?></h1>
            <!-- ?user information? -->
        </div>
        <div class="main">
            <!-- Transaction button / options -->
            <h2>Make new Transaction:</h2>
            <form autocomplete="off" action="" method="post" class="transactionForm">
                <label for="searchBar">Find user:</label>
                <input type="text" id="searchBar" name="searchBar" placeholder="example person">
                <ul id="ajaxResponseHolder"></ul>
                <div class="transactionForm secondForm">
                    <label for="amount">Amount:</label>
                    <input type="number" min="<?php if($currentSaldo > 0){ echo "1";} else{ echo "0";}  ?>" 
                    max="<?php echo $currentSaldo ?>" name="amount" id="amount" 
                    value="<?php if($currentSaldo > 0){ echo "1";} else{ echo "0";}  ?>">
                    <br>
                    <label for="details">Add a reason:</label>
                    <input type="text" name="details" id="details" placeholder="For the lovely bottle of Wine.">
                    <br>
                    <input type="submit" value="Send">
                </div>
            </form>
            <div class="transactionResponse"><?php if(isset($result)){ echo $result; } ?></div>
            <!-- List of of previous Transactions -->
            <div class="transactionFeed">
                <?php foreach($recentTransactions as $transaction) : ?>
                <div class="transactionFeedItem">
                    <p><?php 
                        echo $transaction["fromUser"] . " has send " . $transaction["amount"] . 
                        " to " . $transaction["toUser"]  . " on " . $transaction["date"];
                    ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </body>
</html>