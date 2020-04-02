<?php 
    
    class User {

        public $id;
        public $username;
        public $password;
        public $name;
        public $email;
        public $dateJoined;
        public $role;
        public $isEnabled;

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getUsername() {
            return $this->username;
        }

        public function setUsername($username) {
            $this->username = $username;
        }

        public function getPassword() {
            return $this->password;
        }

        public function setPassword($password) {
            $this->password = $password;
        }

        public function getName() {
            return $this->name;
        }

        public function setName($name) {
            $this->name = $name;
        }
        
        public function getEmail() {
            return $this->email;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function getDateJoined() {
            return $this->dateJoined;
        }

        public function setDateJoined($dateJoined) {
            $this->dateJoined = $dateJoined;
        }

        public function getRole() {
            return $this->role;
        }

        public function setRole($role) {
            $this->role = $role;
        }

        public function isEnabled() {
            return $this->isEnabled;
        }

        public function setEnabled($isEnabled) {
            $this->isEnabled = $isEnabled;
        }
    }

?>