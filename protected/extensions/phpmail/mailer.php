<?php

/**
 * PhpMailer class file.
 *
 * @version alpha 2 (2010-6-3 16:42)
 * @author jerry2801 <jerry2801@gmail.com>
 * @required PHPMailer v5.1
 *
 * A typical usage of JPhpMailer is as follows:
 * <pre>
 * Yii::import('ext.phpmailer.JPhpMailer');
 * $mail=new JPhpMailer;
 * $mail->IsSMTP();
 * $mail->Host='smpt.163.com';
 * $mail->SMTPAuth=true;
 * $mail->Username='yourname@yourdomain';
 * $mail->Password='yourpassword';
 * $mail->SetFrom('name@yourdomain.com','First Last');
 * $mail->Subject='PHPMailer Test Subject via smtp, basic with authentication';
 * $mail->AltBody='To view the message, please use an HTML compatible email viewer!';
 * $mail->MsgHTML('<h1>JUST A TEST!</h1>');
 * $mail->AddAddress('whoto@otherdomain.com','John Doe');
 * $mail->Send();
 * </pre>
 */

$path = dirname( __FILE__ );
require_once $path.'/class.phpmailer.php';

class Mailer extends PHPMailer
{
    /**
    * Init method for the application component mode.
    */
   public function init() {
        $this->Mailer = "smtp";
        $this->Host = Yii::app()->settings->get("mail","server");
        $this->Username = Yii::app()->settings->get("mail","user");
        $this->Password = Yii::app()->settings->get("mail","password");
        $this->Port = Yii::app()->settings->get("mail","port");
   }

}