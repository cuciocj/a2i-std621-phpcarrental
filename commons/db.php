<?php
    class DB {

        public function getConnection() {
            $mysqli = mysqli_connect('localhost', 'aspire2', 'aspire2', 'rentacarsystem');
            $sql_msg = "";

            if($mysqli === false) {
                die("ERROR: couldn't connect " . $mysqli->connect_error);
            }

            return $mysqli;
        }

    }
?>