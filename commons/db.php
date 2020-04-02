<?php
    class DB {

        public function getConnection() {
            $mysqli = mysqli_connect('localhost', 'root', 'root', 'rentacarsystem');
            $sql_msg = "";

            if($mysqli === false) {
                die("ERROR: couldn't connect " . $mysqli->connect_error);
            }

            return $mysqli;
        }

    }
?>