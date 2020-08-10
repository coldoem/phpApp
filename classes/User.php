<?php
    include_once("Db.php");

    class User{
        private $email;
        private $password;
        private $name;
        private $saldo;
        private $verified;

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
        public function getVerified(){
            return $this->verified;
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
            $this->email = $name;
            return $this;
        }
        public function setSaldo($saldo){
            $this->saldo = $saldo;
            return $this;
        }
        public function setVerified($verified){
            $this->email = $verified;
            return $this;
        }

        public function getUser($email){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from users where email = :email");
            $statement->bindValue(":email", $email);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function saveNewUser(){
            $conn =  Db::getConnection();
            //check if email is already in use first
            $stmnt = $conn->prepare("select email from users where email = :email");
            $stmnt->bindValue(":email", $this->getEmail());
            $stmnt->execute();
            $result =$stmnt->fetch(PDO::FETCH_ASSOC);

            if(!$result){
                $statement = $conn->prepare("INSERT INTO users (email, password, name, saldo, verified) VALUES (:email, :password, :name, :saldo, :verified)");
                $statement->bindValue(":email", $this->getEmail());
                $statement->bindValue(":password", $this->getPassword());
                $statement->bindValue(":name", $this->getName());
                $statement->bindValue(":saldo", $this->getSaldo());
                $statement->bindValue(":verified", false);
                
                $statement->execute();
                return "Register succesfull";
            }else{
                throw new exception ("email already in use");
            }            
        }

        public function canLogin($email, $password){
            $conn =  Db::getConnection();
            $statement = $conn->prepare("select * FROM users where email = :email");
            $statement->bindValue(":email", $email);
            $statement->execute();

            $checkingUser = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            if(password_verify($password, $checkingUser["password"])){
                return true;
            }else{
                return false;
            }
        }
    }
?>