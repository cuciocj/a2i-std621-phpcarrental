<?php
    include_once 'user.php';

    class Feedback {

        private $user;
        private $title;
        private $message;
        private $type;
        private $dateReceived;

        public function getUser() {
            return $this->user;
        }

        public function setUser($user) {
            $this->user = $user;
        }

        public function getTitle() {
            return $this->title;
        }

        public function setTitle($title) {
            $this->title = $title;
        }

        public function getMessage() {
            return $this->message;
        }

        public function setMessage($message) {
            $this->message = $message;
        }

        public function getType() {
            return $this->type;
        }

        public function setType($type) {
            $this->type = $type;
        }

        public function getDateReceived() {
            return $this->dateReceived;
        }

        public function setDateReceived($dateReceived) {
            $this->dateReceived = $dateReceived;
        }
    }

?>