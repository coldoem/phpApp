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
            $this->email = $email;
            return $this;
        }
        public function setPassword($password){
            $this->email = $password;
            return $this;
        }
        public function setName($name){
            $this->email = $name;
            return $this;
        }
        public function setVerified($verified){
            $this->email = $verified;
            return $this;
        }

        public function canLogin($email, $password){
            $conn =  Db::getConnection();
            $statement = $conn->prepare("select * FROM users where email VALUES :email");
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