<?php

class MailerDao {

    private $table = "mailer";

    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function getCredentials() {
        $sql = "select * from " . $this->table . " limit 1;";
        $con = $this->db->getConnection();
        if($result = $con->query($sql)) {
            if($row = $result->fetch_array()) {
                $mailer = new Mailer();
                $mailer->host = $row['host'];
                $mailer->username = $row['username'];
                $mailer->password = $row['password'];
                $mailer->port = $row['port'];
                $mailer->mask = $row['maskname'];
            }
        } else {
            echo "MailerDao getCredentials(): couldn't execute sql: " . $sql . " error: " . $con->error;
        }
        $con->close();
        return $mailer;
    }
}

?>