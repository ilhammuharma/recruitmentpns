<?
$mail = new PHPMailer;

$mail->isSMTP();                                   // Set mailer to use SMTP
$mail->Host = 'mail.pns.co.id';                    // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                            // Enable SMTP authentication
$mail->Username = 'administrator@pns.co.id';          // SMTP username
$mail->Password = 'adminjkt'; // SMTP password
$mail->SMTPSecure = 'ssl';                         // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                 // TCP port to connect to

$mail->setFrom('administrator@pns.co.id', 'PNS Administrator');
$mail->addReplyTo('noreply@pns.co.id', 'noreply@pns.co.id');
?>