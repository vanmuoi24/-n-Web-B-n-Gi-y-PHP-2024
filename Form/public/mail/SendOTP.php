<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/POP3.php';
require 'PHPMailer/src/OAuthTokenProvider.php';
require 'PHPMailer/src/DSNConfigurator.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

        function sendMail($otp,$emailTo){
            $result = 0;
            $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 0;                     
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'ngkietbaby19@gmail.com';                     
        $mail->Password   = 'nfho gniu ufjy umzg';                               
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
        $mail->Port       = 465;                                    

        $mail->setFrom('ngkietbaby19@gmail.com', 'SGUSHOES');

        $mail->addAddress($emailTo, 'Customer'); 

        //Content
        $mail->isHTML(true);                                
        $mail->Subject = 'YOUR OPT CODE';
        $mail->Body    = "OTP code: <strong>$otp</strong>";

        if($mail->send())
            $result =1 ;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    return $result;
        }
?>