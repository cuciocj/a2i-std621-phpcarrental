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
                echo "vehicleDao: couldn't execute sql: " . $sql . " error: " . $con->error;
            }
            $con->close();

            return $vehicles;
        }

        public function create($vehicle) {
            $flag = false;

            $sql = "insert into " . $this->table . " (name, body, color, transmission, image, price)"
                . " values (?, ?, ?, ?, ?, ?);";

            $con = $this->db->getConnection();
            $stmt = $con->prepare($sql);
            $stmt->bind_param("sssssi",
                $p_name,
                $p_body,
                $p_color,
                $p_transmission,
                $p_image,
                $p_price
            );

            $p_name = $vehicle->getName();
            $p_body = $vehicle->getBody();
            $p_color = $vehicle->getColor();
            $p_transmission = $vehicle->getTransmission();
            $p_image = $vehicle->getImage();
            $p_price = $vehicle->getPrice();

            if($stmt->execute()) {
                $flag = true;
            }

            $stmt->close();
            $con->close();
            return $flag;
        }

        public function update($vehicle) {
            $flag = false;

            $sql = "update " . $this->table
                . " set name = ?, body = ?, color = ?, transmission = ?,"
                . " image = ?, price = ?, is_reserved = ? where id = ?;";

            $con = $this->db->getConnection();
            $stmt = $con->prepare($sql);
            $stmt->bind_param("sssssiii",
                $p_name,
                $p_body,
                $p_color,
                $p_transmission,
                $p_image,
                $p_price,
                $p_isReserved,
                $p_id
            );

            $p_name = $vehicle->getName();
            $p_body = $vehicle->getBody();
            $p_color = $vehicle->getColor();
            $p_transmission = $vehicle->getTransmission();
            $p_image = $vehicle->getImage();
            $p_price = $vehicle->getPrice();
            $p_isReserved = $vehicle->isReserved();
            $p_id = $vehicle->getId();

            if($stmt->execute()) {
                $flag = true;
            }

            $stmt->close();
            $con->close();
            return $flag;
        }

        public function delete($vehicle) {
            $flag = false;

            $sql = "delete from " . $this->table
                . " where id = ?;";
            
            $con = $this->db->getConnection();
            $stmt = $con->prepare($sql);
            $stmt->bind_param("i", $p_id);

            $p_id = $vehicle->getId();
            
            if($stmt->execute()) {
                $flag = true;
            }

            $stmt->close();
            $con->close();
            return $flag;
        }
    }
?>