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
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setName($result["name"]);
            $this->setSaldo($result["saldo"]);
            $this->setEmail($result["email"]);
        }

        public function saveNewUser($gEmail, $gPassword, $gName){
            /* pdo not working
            try{
                $conn =  Db::getConnection();
                $statement = $conn->prepare("INSERT INTO users(`email`, `password`, `name`, `verified`) VALUES (:email, :password, :name, :verified)");
                
                $email = $this->getEmail();
                $password = $this->getPassword();
                $name = $this->getName();
                $verified = $this->getVerified();

                $statement->bindParam(":email", $email);
                $statement->bindParam(":password", $password);
                $statement->bindParam(":name", $name);
                $statement->bindParam(":verified", $verified);

                $result = $statement->execute();
                if(!$result){
                    return $conn->errorInfo();
                } else{
                    return $result;
                }
            } catch(PDOException $e){
                return $e;
            }
            */
            $conn = new mysqli("localhost", "root", "root", "herexamen");

            $query = "INSERT INTO users (email, password, name, saldo) VALUES 
            (?, ?, ?, ?)";

            $statement = $conn->prepare($query);
            $statement->bind_param("sssi", $email, $password, $name, $saldo);

            if(strpos($gEmail, "@student.thomasmore.be")){
                $email = $gEmail;
            }else{
                throw new exception ("invalid email");
            }

            if(strlen($gPassword) >= 5){
                $password = $gPassword;
            }else{
                throw new exception ("invalid password");
            }

            $name = $gName;
            $saldo = 10;

            if($statement->execute()){
                return "succes";
            }else{
                return "error:" . mysqli_error($conn);
            }

            mysqli_close($conn);
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
            /* for later
            if(password_verify($password, $checkingUser["password"])){
                return true;
            }else{
                return false;
            }
            */
            if($checkingUser["password"] == $password){
                return true;
            }else{
                return false;
            }
        }
    }
?>