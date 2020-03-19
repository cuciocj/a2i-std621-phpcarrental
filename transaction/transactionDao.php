<?php

    class TransactionDao {

        private $table = "transactions";

        private $db;

        public function __construct() {
            $this->db = new DB();
        }

        public function insert($transaction) {
            $flag = false;
            $sql = "insert into " . $this->table 
                    . " (user_id, vehicle_id, start_date, end_date, approving_officer)"
                    . " values (?, ?, ?, ?, ?);";

            $con = $this->db->getConnection();
            $stmt = $con->prepare($sql);
            $stmt->bind_param("iissi", $p_userid, $p_vehicleid, $p_startdate, $p_enddate, $p_officer);
            $p_userid = $transaction->getUser();
            $p_vehicleid = $transaction->getVehicle();
            $p_startdate = $transaction->getStartDate();
            $p_enddate = $transaction->getEndDate();
            $p_officer = $transaction->getApprovingOfficer();

            if($stmt->execute()) {
                $flag = true;
            } else {
                echo "error sql:" . $con->error;
            }

            $stmt->close();
            $con->close();
            return $flag;
        }

        public function getNonZeroNumberOfTransactionsPerCar() {
            $sql = "select v.name, count(vehicle_id) as total_count 
                    from transactions t
                    join vehicles v on v.id = t.vehicle_id 
                    group by vehicle_id	
                    order by total_count desc";

            $con = $this->db->getConnection();
            $result = $con->query($sql);
            $con->close();

            return $result;
        }
    }

?>