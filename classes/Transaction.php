<?php
    include_once("Db.php");

    class Transaction{
        private $fromUser;
        private $toUser;
        private $amount;
        private $date;
        private $details;

        public function getFromUser(){
            return $this->fromUser;
        }
        public function getToUser(){
            return $this->toUser;
        }
        public function getAmount(){
            return $this->amount;
        }
        public function getDate(){
            return $this->date;
        }
        public function getDetails(){
            return $this->details;
        }
        public function setFromUser($fromUser){
            $this->fromUser = $fromUser;
            return $this;
        }
        public function setToUser($toUser){
            $this->toUser = $toUser;
            return $this;
        }
        public function setAmount($amount){
            $this->amount = $amount;
            return $this;
        }
        public function setDate($date){
            $this->date = $date;
            return $this;
        }
        public function setDetails($details){
            $this->details = $details;
            return $this;
        }

        public function newTransaction(){
            $conn = Db::getConnection();
            $statement = $conn->prepare("insert into transactions (fromUser, toUser, amount, details) VALUES (:fromUser, :toUser, :amount, :details)");

            $fromUser = $this->getFromUser();
            $toUser = $this->getToUser();
            $amount = $this->getAmount();
            $details = $this->getDetails();

            $statement->bindValue(":fromUser", $fromUser);
            $statement->bindValue(":toUser", $toUser);
            $statement->bindValue(":amount", $amount);
            $statement->bindValue(":details", $details);

            $result = $statement->execute();
            return $result;
        }
    }
?>