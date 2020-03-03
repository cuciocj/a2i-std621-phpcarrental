<?php
    include_once './commons/db.php';
    include_once 'user.php';

    class UserDao {

        private $table = "users";

        private $db;

        public function __construct() {
            $this->db = new DB();
        }

        public function find($user) {
            $sql = "select * from " . $this->table . " where username = ? and password = ?;";

            $con = $this->db->getConnection();

            $stmt = $con->prepare($sql);
            $stmt->bind_param("ss", $p_username, $p_password);

            $p_username = $user->getUsername();
            $p_password = $user->getPassword();

            if($stmt->execute()) {
                $result = $stmt->get_result();
                if($result->num_rows > 0) {
                    if($row = $result->fetch_array()) {
                        $user = new User();
                        $user->setId($row['id']);
                        $user->setUsername($row['username']);
                        $user->setPassword($row['password']);
                        $user->setName($row['name']);
                        $user->setEmail($row['email']);
                        $user->setDateJoined($row['date_joined']);
                        $user->setRole($row['role_id']);
                    }
                } else {
                    //echo "cannot find user [" . $user->getUsername() . "]";
                    $user = new User();
                }

                $stmt->close();
            } else {
                //echo "couldn't execute sql: " . $sql . " error: " . $con->error;
                $user = new User();
            }
            $con->close();

            return $user;
        }
    }

    // $user = new User();
    // $user->setUsername("qweasd");
    // $user->setPassword("qwe123");
    // $userDao = new UserDao();
    // $user = $userDao->find($user);

    // echo $user->getId() . "|" . $user->getUsername() . "|" . $user->getPassword() . "|"
    //     . $user->getName() . "|" . $user->getEmail() . "|" . $user->getDateJoined() . "|" . $user->getRole();
    
?>