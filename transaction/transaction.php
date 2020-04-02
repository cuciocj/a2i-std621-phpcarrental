<?php

    class Transaction {
        
        public $id;
        public $user;
        public $startDate;
        public $endDate;
        public $approvingOfficer;
        public $vehicle;

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getUser() {
            return $this->user;
        }

        public function setUser($user) {
            $this->user = $user;
        }

        public function getStartDate() {
            return $this->startDate;
        }

        public function setStartDate($startDate) {
            $this->startDate = $startDate;
        }

        public function getEndDate() {
            return $this->endDate;
        }

        public function setEndDate($endDate) {
            $this->endDate = $endDate;
        }

        public function getApprovingOfficer() {
            return $this->approvingOfficer;
        }

        public function setApprovingOfficer($approvingOfficer) {
            $this->approvingOfficer = $approvingOfficer;
        }

        public function getVehicle() {
            return $this->vehicle;
        }

        public function setVehicle($vehicle) {
            $this->vehicle = $vehicle;
        }
    }

?>