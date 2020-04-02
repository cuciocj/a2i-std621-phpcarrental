<?php
session_start();

if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)) {
    header("location: login.php");
    exit;
}

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';
include_once '../commons/db.php';
include_once '../commons/emailsender.php';
include_once '../transaction/transaction.php';
include_once '../transaction/transactionDao.php';
require_once '../mailer/Mailer.php';
require_once '../mailer/mailerDao.php';
require_once '../user/user.php';
require_once '../user/userDao.php';
include_once 'rent.php';
include_once 'rentDao.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if($_POST['mode'] == 'add') {
        $rent = new Rent();
        $rent->setVehicle(trim($_POST["vehicle_id"]));
        $rent->setUser(trim($_POST["customer_id"]));
        $rent->setStartDate(trim($_POST["start_date"]));
        $rent->setEndDate(trim($_POST["end_date"]));
    
        $rentDao = new RentDao();
        if($rentDao->insert($rent)) {
            $user = new User();
            $userDao = new UserDao();
            $user = $userDao->findById($rent->getUser());

            $emailsender = new EmailSender();
            $is_success = $emailsender->send(
                $user->getEmail(), 
                $user->getUsername(),
                'Rent a Car - Confirmation',
                'Hello ' . $user->getUsername() . ',<br><br>
                    This is to confirm your car booking in Rent a Car system starting ' 
                        . $rent->getStartDate() . ' until ' . $rent->getEndDate() . '.<br>
                        Confirmation might take to 3-5 minutes<br><br>
                        Regards,<br>
                        Rent A Car'
            );
                
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

                $recipient = $data['user']['email'];
                $subject = 'Booking Successful';
                $body = 'Hi ' . $data['user']['username'] . ',
                    <br><br>
                    Congratulations! Your rental request for '. $data['vehicle']['name'] . ' 
                    from ' . $data['startDate'] . ' until ' .  $data['endDate'] . ' has been accepted.
                    <br><br>
                    You can pay for the booking via: Visa, Mastercard, AMEX.
                    <br><br>
                    PS: ' . $_POST['msg'] . '
                    <br><br>
                    Thank you,
                    RENT A CAR SYSTEM';

                $emailSender = new EmailSender();
                $emailSender->send($recipient,
                        $data['user']['username'],
                        $subject,
                        $body
                );

                $transactionDao = new TransactionDao();
                $transactionDao->delete($data['user']['id']);

            } else if($status == "reject") {

                $recipient = $data['user']['email'];
                $subject = 'Booking Rejected';
                $body = 'Hi ' . $data['user']['username'] . ',
                <br><br>
                We are sorry to inform you that your rental request was rejected.

                PS: ' . $_POST['msg'] . '

                Thank you,
                RENT A CAR SYSTEM';

                $emailSender = new EmailSender();
                $emailSender->send($recipient,
                        $data['user']['username'],
                        $subject,
                        $body
                );


            }
        }
    }
    
}

?>