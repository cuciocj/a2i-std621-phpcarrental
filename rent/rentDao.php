<?php

    class RentDao {
        
        private $table = "rent_requests";

        private $db;

        public function __construct() {
            $this->db = new DB();
        }

        public function list() {
            $sql = "select u.id u_id, u.username, u.name u_name, u.email," 
                . " v.id v_id, v.name v_name, v.image, r.start_date, r.end_date"
                . " from rent_requests r"
                . " join users u on r.user_id = u.id"
                . " join vehicles v on r.vehicle_id = v.id;";

                $con = $this->db->getConnection();
                $list = array();

                if($result = $con->query($sql)) {
                    if($result->num_rows > 0) {
                        while ($row = $result->fetch_array()) {
                            $user = new User();
                            $user->setId($row['u_id']);
                            $user->setUsername($row['username']);
                            $user->setName($row['u_name']);
                            $user->setEmail($row['email']);

                            $vehicle = new Vehicle();
                            $vehicle->setId($row['v_id']);
                            $vehicle->setName($row['v_name']);
                            $vehicle->setImage($row['image']);
                            
                            $rent = new Rent();
                            $rent->setStartDate($row['start_date']);
                            $rent->setEndDate($row['end_date']);
                            $rent->setUser($user);
                            $rent->setVehicle($vehicle);

                            array_push($list, $rent);
                        }
                    }
                } else {
                    echo "rentDao: couldn't execute sql: " . $sql . " error: " . $con->error;
                }
                $con->close();

            return $list;
        }

        public function insert($rent) {
            $flag = false;

            $sql = "insert into " . $this->table
                . "(user_id, start_date, end_date, vehicle_id) values"
                . "(?, ?, ?, ?);";

            $con = $this->db->getConnection();
            $stmt = $con->prepare($sql);
            $stmt->bind_param("issi", $p_userId, $p_startDate, $p_endDate, $p_vehicleId);

            $p_userId = $rent->getUser();
            $p_startDate = $rent->getStartDate();
            $p_endDate = $rent->getEndDate();
            $p_vehicleId = $rent->getVehicle();

            if($stmt->execute() === true) {
               $flag = true;
            }

            $stmt->close();
            $con->close();
            return $flag;
        }
        
    }

?>