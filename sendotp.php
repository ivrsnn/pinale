<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

class SendOTPToGmail
{
    function sendOtp($receiver, $otp)
    {
        $text_line1 = '<p>Reset password using this otp:</p><br><br>';

        $bodyText = $text_line1 . '<p>' . $otp . '</p>';
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'Iversoncastro0115@gmail.com';                     //SMTP username
        $mail->Password = 'qazk rani dzhn lqdf';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port = 465;                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('Iversoncastro0115@gmail.com', 'CK Handmade Flowers');
        $mail->addAddress($receiver);     //Add a recipient

        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'RESET PASSWORD OTP';
        $mail->Body = $bodyText;
        $mail->AltBody = $bodyText;

        try {
            $mail->send();
            return array(
                "error" => false
            );
        } catch (Exception $e) {
            // An error occurred, return false and log the error if needed
            $errorMessage = "Email sending failed: " . $mail->ErrorInfo;

            return array(
                "error" => true,
                "message" => $errorMessage
            );
        }
    }
}
?>