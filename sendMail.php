<?php
require_once 'PHPMailer/PHPMailerAutoload.php';

function sendEmail($recipient, $name) {
    $base_url = "http://localhost/ta_survey/";
    $mail_body = "
   <p>Hi ".$name.",</p>
   <p>Please Open this link to verified your email address - ".$base_url."index.php?menu=activation&email=".$recipient."
   <p>Best Regards,<br />Firza P.</p>
   ";
    $mail = new PHPMailer;
    $mail->IsSMTP();        //Sets Mailer to send message using SMTP
    $mail->Host = 'smtp.gmail.com';  //Sets the SMTP hosts of your Email hosting, this for Godaddy
    $mail->Port = 587;        //Sets the default SMTP server port
    $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
    $mail->Username = 'tugasakhirsurvey@gmail.com';     //Sets SMTP username
    $mail->Password = 'Firza123';     //Sets SMTP password
    $mail->SMTPSecure = 'tls';       //Sets connection prefix. Options are "", "ssl" or "tls"
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->setFrom('tugasakhirsurvey@gmail.com', 'TA Survey');
    $mail->AddAddress($recipient, $name);  //Adds a "To" address
    $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
    $mail->IsHTML(true);       //Sets message type to HTML
    $mail->Subject = 'Email Verification';   //Sets the Subject of the message
    $mail->Body = $mail_body;       //An HTML or plain text message body
    return $mail->Send();
}