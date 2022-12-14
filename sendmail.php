<?php

$to = " amersyed4242@gmail.com";
$subject = "Simple Email Test via PHP";
$body = "Hi, This is test email send by Syed Amer";
$headers = "From: syedtest1212@gmail.com";

if(mail($to, $subject, $body, $headers)){
    echo "Email successfully sent to " . $to;
} else{
    echo "Email sending failed...";
}

// mail($to, $subject, $body, $headers);
// echo "Mail Sent.";


?>