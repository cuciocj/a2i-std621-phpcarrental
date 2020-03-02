<?php
    include_once './commons/db.php';
    include_once 'vehicle.php';

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
                        $vehicle = new Vehicle(
                            $row['id'],
                            $row['name'],
                            $row['body'],
                            $row['color'],
                            $row['transmission'],
                            $row['image'],
                            $row['price']
                        );

                        array_push($vehicles, $vehicle);
                    }
                }
            } else {
                echo "couldn't execute sql: " . $sql . " error: " . $con->error;
            }
            $con->close();

            return $vehicles;
        }
    }
?>