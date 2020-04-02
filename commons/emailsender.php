<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './PHPMailer/Exception.php';
require './PHPMailer/PHPMailer.php';
require './PHPMailer/SMTP.php';


class EmailSender {

    private $credentials;

    function __construct() {
        $mailerDao = new MailerDao();
        $this->credentials = $mailerDao->getCredentials();
    }

    public function send($recipient_mail, $recipient_name, $subject, $body) {
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output; for testing purposes
            $mail->isSMTP();
            $mail->SMTPAuth   = true;
            $mail->Host       = $this->credentials->host;
            $mail->Username   = $this->credentials->username;
            $mail->Password   = $this->credentials->password;
            $mail->Port       = $this->credentials->port;
            $mail->SMTPSecure='tls';
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            //Recipient
            $mail->setFrom($this->credentials->username, $this->credentials->mask);
            $mail->addAddress($recipient_mail, $recipient_name);
            
            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            return $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }

        return false;
    }
}

?>