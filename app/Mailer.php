<?php
/**
 * Created by Jay from Trio Design (jay@tgitriodesign.com).
 * Date: 5/5/13
 * Time: 2:18 PM
 * Description: Email sender of this application.
 */
namespace App;
class Mailer
{
	private $_mail = null;
	public $errors = array();

	public function __construct($options = array()) {
		$this->initMail();
	}

	// to: array of recipients (recipient could be array('email@address.com', 'name') or 'email@address.com'
	// isHtml: boolean
	// subject: string
	// message: string
	// altMessage: string
	public function send($options = array()) {
		if (empty($this->_mail)) {
			$this->initMail();
		}
		if (!empty($options['to'])) {
			foreach($options['to'] as $recipient) {
				if (is_array($recipient)) {
					$this->_mail->AddAddress($recipient[0], $recipient[1]);
				}
				else {
					$this->_mail->AddAddress($recipient);
				}
			}
		}

		//set attachments
		if(!empty($options["attachments"])){
			foreach($options["attachments"] as $attachment){
				$this->_mail->AddAttachment($attachment["filePath"], $attachment["fileName"]);
			}
		}

		$this->_mail->IsHTML($options['isHtml']);                                  // Set email format to HTML

		$this->_mail->Subject = $options['subject'];
		$this->_mail->Body    = $options['message'];

		if (!empty($options['altMessage'])) {
			$this->_mail->AltBody = $options['altMessage'];
		}
		if(!$this->_mail->Send()) {
			$this->errorLog('Message could not be sent.');
			$this->errorLog('Mailer Error: ' . $this->_mail->ErrorInfo);
			$this->_mail = null;
			return false;
		}
		else {
			$this->_mail = null;
			return true;
		}
	}

	public function errorLog($message = '') {
		$this->errors[] = $message;
		// errorLog("Mailing error: " . $message);
	}

	private function initMail() {
		require_once BASE_PATH.'library'.DS.'PHPMailer'.DS.'class.phpmailer.php';

		$this->_mail = new \PHPMailer;

		$this->_mail->IsSMTP();                                      // Set mailer to use SMTP
		$this->_mail->Host = app()->config('smtpHost');  // Specify main and backup server
		$this->_mail->SMTPAuth = true;                               // Enable SMTP authentication
		$this->_mail->Username = app()->config('smtpUsername');                            // SMTP username
		$this->_mail->Password = app()->decrypt(app()->config('smtpPassword'));                           // SMTP password
		$this->_mail->SMTPSecure = app()->config('smtpSecurity');                            // Enable encryption, 'ssl' also accepted
		$this->_mail->Port = app()->config("smtpPort");

		$this->_mail->From = app()->config('senderEmail');
		$this->_mail->FromName = app()->config('senderName');
		$this->_mail->AddReplyTo(app()->config('replyToEmail'), app()->config('replyToName'));

		$this->_mail->WordWrap = 100;
//		$this->_mail->SMTPDebug = 1; // for debugging
	}
}
