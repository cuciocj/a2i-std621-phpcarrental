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
        if($rentDao->insert($rent)) {
            // TODO: send acknowledgement receipt email
            echo 'success';
        } else {
            echo 'fail';
        }
    } else if ($_POST['mode'] == 'trx') {

        if(!isset($_POST['status']) && !isset($_POST['data'])) {
            echo 'no status and data';
        } else {
            $status = $_POST['status'];
            $data = $_POST['data'];
            $msg = $_POST['msg'];
            
            $rent = new Rent();
            $rent->setUser($data['user']['id']);

            $rentDao = new RentDao();
            $success = $rentDao->delete($rent);

            if($status == "approve") {
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

                echo '$senderEmail';

                $senderEmail = 'cuciocj@gmail.com';
                $header = 'From: ' . $senderEmail;
                $recipient = '' . $data['user']['email'] . '';
                $subject = 'Booking Successful';
                $body = 'Hi ' . $data['user']['username'] . ', ' . "\r\n" . "\r\n" 
                    . ' Your rental request for ' . $data['vehicle']['name'] .' from ' . $data['startDate'] 
                    . ' to ' . $data['endDate'] . ' has been accepted.' . "\r\n"
                    . 'You can pay for the booking via 3 options: Cash, debit or credit card (Visa, Mastercard, AMEX)' . "\r\n" .  "\r\n"
                    . 'Thank you,' . "\r\n"
                    . 'CAR RENTAL SYSTEM';

                if (mail($recipient, $subject, $body, $header)) {
                    echo "email successful";
                } else {
                    echo "email not successful";
                }

            } else if($status == "reject") {
                $senderEmail = 'cuciocj@gmail.com';
                $header = 'From: ' . $senderEmail;
                $recipient = '' . $data['user']['email'] . '';
                $subject = 'Booking Rejected';
                $body = 'Hi ' . $data['user']['username'] . ', ' . "\r\n" . "\r\n" 
                        . ' We are sorry to inform you that your rental request was rejected.' . "\r\n" .
                        (strlen($msg) > 0 ? $msg : '')
                        . 'Regards,' . "\r\n"
                        . 'Awesome Rental Car Team';

                if (mail($recipient, $subject, $body, $header)) {
                    echo "email successful";
                } else {
                    echo "email not successful";
                }


            }
        }
    }
    
}

?>