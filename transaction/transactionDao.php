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

        public function delete($transaction) {
            $flag = false;

            $sql = "delete from " . $this->table
                . " where user_id = ?;";
            
            $con = $this->db->getConnection();
            $stmt = $con->prepare($sql);
            $stmt->bind_param("i", $p_id);

            $p_id = $transaction->getId();
            
            if($stmt->execute()) {
                $flag = true;
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

        public function getNumberOfTransactionsPerUser() {
            $sql = "select 
                        u.name,
                        count(user_id) as count_per_user
                    from transactions t 
                        join users u on t.user_id = u.id
                    group by user_id
                    order by count_per_user desc";

            $con = $this->db->getConnection();
            $result = $con->query($sql);
            $con->close();

            return $result;
        }
    }

?>