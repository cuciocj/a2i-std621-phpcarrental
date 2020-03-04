<?php

    class RentDao {
        
        private $table = "rent_requests";

        private $db;

        public function __construct() {
            $this->db = new DB();
        }

        public function insert($rent) {
            $flag = false;

            $sql = "insert into " . $this->table
                . '(user_id, start_date, end_date, vehicle_id) values'
                . '(?, ?, ?, ?);';

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