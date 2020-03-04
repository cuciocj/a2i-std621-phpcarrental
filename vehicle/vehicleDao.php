<?php

    class VehicleDao {

        private $table = "vehicles";

        private $db;

        public function __construct() {
            $this->db = new DB();
        }

        public function list() {
            $sql = "select * from " . $this->table . ";";
            $vehicles = array();

            $con = $this->db->getConnection();

            if($result = $con->query($sql)) {
                if($result->num_rows > 0) {
                    while ($row = $result->fetch_array()) {
                        $vehicle = new Vehicle();
                        $vehicle->id = $row['id'];
                        $vehicle->name = $row['name'];
                        $vehicle->body = $row['body'];
                        $vehicle->color = $row['color'];
                        $vehicle->transmission = $row['transmission'];
                        $vehicle->image = $row['image'];
                        $vehicle->price = $row['price'];
                        $vehicle->isReserved = $row['is_reserved'];
                        array_push($vehicles, $vehicle);
                    }
                }
            } else {
                echo "couldn't execute sql: " . $sql . " error: " . $con->error;
            }
            $con->close();

            return $vehicles;
        }

        // TODO
        public function updateReserve($vehicle, $is_reserved) {
            $sql = "update " . $this->table
                . ' set is_reserved = ? where id = ?';
        }
    }
?>