<?php

    class Rent {
        
        private $user;
        private $startDate;
        private $endDate;
        private $vehicle;

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

        public function getVehicle() {
            return $this->vehicle;
        }

        public function setVehicle($vehicle) {
            $this->vehicle = $vehicle;
        }

    }

?>
