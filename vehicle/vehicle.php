<?php

    class Vehicle {

        public $id;
        public $name;
        public $body;
        public $color;
        public $transmission;
        public $image;
        public $price;
        public $isReserved;

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getName() {
            return $this->name;
        }

        public function setName($name) {
            $this->name = $name;
        }

        public function getBody() {
            return $this->body;
        }

        public function setBody($body) {
            $this->body = $body;
        }

        public function getColor() {
            return $this->color;
        }

        public function setColor($color) {
            $this->color = $color;
        }

        public function getTransmission() {
            return $this->transmission;
        }

        public function setTransmission($transmission) {
            $this->transmission = $transmission;
        }

        public function getImage() {
            return $this->image;
        }

        public function setImage($image) {
            $this->image = $image;
        }

        public function getPrice() {
            return $this->price;
        }

        public function setPrice($price) {
            $this->price = $price;
        }

        public function isReserved() {
            return $this->isReserved;
        }

        public function setReserved($isReserved) {
            $this->isReserved = $isReserved;
        }
    }

?>