<?php
    include_once("Db.php");

    class User{
        private $email;
        private $password;
        private $name;
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
        public function getVerified(){
            return $this->verified;
        }
        public function setEmail($email){
            if(strpos($email, "@student.thomasmore.be")){
                $this->email = $email;
                return $this;
            }
            return "invalid email";
        }
        public function setPassword($password){
            if(strlen($password) >= 5){
                $this->email = $password;
                return $this;
            }
            return "invalid password";
        }
        public function setName($name){
            $this->email = $name;
            return $this;
        }
        public function setVerified($verified){
            $this->email = $verified;
            return $this;
        }

        public function saveNewUser(){
            $conn =  Db::getConnection();
            //check if email is already in use first
            $stmnt = $conn->prepare("select email from users where email = :email");
            $stmnt->bindValue(":email", $this->getEmail());
            $stmnt->execute();
            $result =$stmnt->fetch(PDO::FETCH_ASSOC);

            if(!$result){
                $statement = $conn->prepare("INSERT INTO users (email, password, name, verified) VALUES (:email, :password, :name, :verified)");
                $statement->execute();
                return "Register succesfull";
            }else{
                return "Invalid email";
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