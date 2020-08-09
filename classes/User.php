<?php
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
    }
?>