<?php
session_start();

if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)) {
    header("location: login.php");
    exit;
}

include_once '../commons/db.php';
include_once '../transaction/transaction.php';
include_once 'rent.php';
include_once 'rentDao.php';
include_once '../transaction/transactionDao.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if($_POST['mode'] == 'add') {
        $rent = new Rent();
        $rent->setVehicle(trim($_POST["vehicle_id"]));
        $rent->setUser(trim($_POST["customer_id"]));
        $rent->setStartDate(trim($_POST["start_date"]));
        $rent->setEndDate(trim($_POST["end_date"]));
    
        $rentDao = new RentDao();
        $success = $rentDao->insert($rent);
    
        if($success) {
            // TODO: send acknowledgement receipt email
            echo 'success';
        } else {
            echo 'fail';
        }
    } else if ($_POST['mode'] == 'trx') {
        $status;

        if(!isset($_POST['status']) && !isset($_POST['data'])) {
            
        } else {
            $status = $_POST['status'];
            $data = $_POST['data'];
            $msg = $_POST['msg'];
            
            $rent = new Rent();
            $rent->setUser($data['user']['id']);

            $rentDao = new RentDao();
            $success = $rentDao->delete($rent);

            if($success) {
                $transaction = new Transaction();
                $transaction->setUser($data['user']['id']);
                $transaction->setVehicle($data['vehicle']['id']);
                $transaction->setStartDate($data['startDate']);
                $transaction->setEndDate($data['endDate']);
                $transaction->setApprovingOfficer($_SESSION['session_userid']);
                
                $transactionDao = new TransactionDao();
                $success = $transactionDao->insert($transaction);

                if($success) {
                    echo 'success rent and transaction process';
                }
            }
        }
    }
    
}

?>