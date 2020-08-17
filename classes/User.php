<?php
    include_once("Db.php");

    class User{
        private $email;
        private $password;
        private $name;
        private $saldo;

        public function getEmail(){
            return $this->email;
        }
        public function getPassword(){
            return $this->password;
        }
        public function getName(){
            return $this->name;
        }
        public function getSaldo(){
            return $this->saldo;
        }
        public function setEmail($email){
            if(strpos($email, "@student.thomasmore.be")){
                $this->email = $email;
                return $this;
            }
            throw new exception ("invalid email");
        }
        public function setPassword($password){
            if(strlen($password) >= 5){
                $this->email = $password;
                return $this;
            }
            throw new exception ("invalid password");
        }
        public function setName($name){
            $this->name = $name;
            return $this;
        }
        public function setSaldo($saldo){
            $this->saldo = $saldo;
            return $this;
        }

        public function getUserFromName($name){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from users where name = :name");
            $statement->bindValue(":name", $name);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            
            $this->setName($result["name"]);
            $this->setSaldo($result["saldo"]);
            $this->setEmail($result["email"]);
        }

        public function getUser($email){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from users where email = :email");
            $statement->bindValue(":email", $email);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setName($result["name"]);
            $this->setSaldo($result["saldo"]);
            $this->setEmail($result["email"]);
        }

        public function saveNewUser($gEmail, $gPassword, $gName){
            $conn =  Db::getConnection();
            $statement = $conn->prepare("INSERT INTO users(`email`, `password`, `name`, 'saldo') VALUES (:email, :password, :name, :saldo)");
                
            //$this->getMail() not working, same with others so using a shitty fix

            if(strpos($gEmail, "@student.thomasmore.be")){
                $email = $gEmail;
            }else{
                throw new exception ("invalid email");
            }

            if(strlen($gPassword) >= 5){
                $password = password_hash($gPassword, PASSWORD_DEFAULT, ["cost" => 12]);
            }else{
                throw new exception ("invalid password");
            }

            $name = $gName;
            $saldo = 10;

            $statement->bindValue(":email", $email);
            $statement->bindValue(":password", $password);
            $statement->bindValue(":name", $name);
            $statement->bindValue(":saldo", $saldo);

            $result = $statement->execute();
            return $result;
        }

        public function emailCheck($email){
            $conn =  Db::getConnection();
            $stmnt = $conn->prepare("select email from users where email = :email");

            $stmnt->bindValue(":email", $email);
            $stmnt->execute();
            $result =$stmnt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        public function canLogin($email, $password){
            $conn =  Db::getConnection();
            $statement = $conn->prepare("select * FROM users where email = :email");
            $statement->bindValue(":email", $email);
            $statement->execute();

            $checkingUser = $statement->fetch(PDO::FETCH_ASSOC);

            if(password_verify($password, $checkingUser["password"])){
                return true;
            }else{
                return false;
            }
        }

        public function getRecentTransactions(){
            //fetch all transactions with this user
            $conn = Db::getConnection();
            $statement = $conn->prepare(
            "select * from transactions where fromUser = :thisUser OR toUser = :thisUser order by date desc");
            $thisUser = $this->getName();
            $statement->bindValue(":thisUser", $thisUser);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }
    }
?>