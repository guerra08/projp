<?php
//Include das classes via autoload
include_once 'autoload.php';

include_once "class.phpmailer.php";


/**
 * Description of Email
 *
 * @author Mauri
 */
class Email {
    
    
    public function enviar($from,$fromName,$subject,$body,$to,$toName){
        try {
            
        
            $mail             = new PHPMailer();

            //$body             = file_get_contents('contents.html');

            $mail->IsSMTP(); // telling the class to use SMTP
            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
            $mail->Host       = Config::EMAIL_HOST;      // sets GMAIL as the SMTP server
            $mail->Port       = Config::EMAIL_PORT;                   // set the SMTP port for the GMAIL server
            $mail->Username   = Config::EMAIL_USERNAME;  // GMAIL username
            $mail->Password   = Config::EMAIL_PASSWORD;            // GMAIL password

            $mail->SetFrom($from, $fromName);
            //$mail->AddReplyTo('mcrosito@gmail.com', 'Mauricio Rosito');

            $mail->Subject    = $subject;

            $mail->AltBody    = "Para ver esta mensagem, por favor, use um visualizador de e-mail compatível com HTML!"; // optional, comment out and test
            $mail->MsgHTML($body);


            $mail->AddAddress($to, $toName);

            $mail->Send();
        } catch (Exception $e) {
            $logger = new Logger($e->getMessage());    
        }
    }
}
