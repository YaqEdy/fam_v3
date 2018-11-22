<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Mailer{
	var $obj_mailer;
	function __construct(){
		//include 'PHPMailer-master/PHPMailerAutoload.php';
        include 'phpmailer/PHPMailerAutoload.php';
		$this->obj_mailer = new PHPMailer();
	}

	function kirimEmail($param=array()){
        
          
           //$count = $count($param);
           //echo $count; die();
		/*
		 *  0 = recipient, 1 = subject, 2 = message, 3 = attachement
		 *  0 = recipient, 1 = recipient, 2 = subject, 3 = message, 4 = attachement
		 */
		$this->obj_mailer->isSMTP();                                      // Set mailer to use SMTP
		//$this->obj_mailer->Host = '192.168.11.159';  // Specify main and backup SMTP servers
                $this->obj_mailer->Host = 'smtp.gmail.com';
		$this->obj_mailer->SMTPAuth = true;                               // Enable SMTP authentication
		$this->obj_mailer->Username = 'afrizal@mitrateknomadani.com';//askes@pnm-mpm.id';                 // SMTP username
		$this->obj_mailer->Password = 'kurniawan27';//askesmpm123';                            // SMTP password
		$this->obj_mailer->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$this->obj_mailer->Port = '587';                                    // TCP port to connect to

		$this->obj_mailer->From = 'afrizal@mitrateknomadani.com';//askes@pnm-mpm.id';
		$this->obj_mailer->FromName = 'PT MPM';
		$this->obj_mailer->addAddress($param[0]);     // Add a recipient addAddress($param[0])
//		$this->obj_mailer->addAddress($param[1]);     // Add a recipient
//		$this->obj_mailer->addReplyTo('anggasap@mitrateknomadani.com', 'PT MTM');
//		$this->obj_mailer->addCC('afrizal@mitrateknomadani.com');
		/*
		$this->obj_mailer->addCC('dinar@pnm.co.id');
		$this->obj_mailer->addCC('lucky@pnm.co.id');
		$this->obj_mailer->addCC('kemas@pnm.co.id');
                $this->obj_mailer->addCC('kindaris@pnm.co.id');
                $this->obj_mailer->addCC('dida@pnm.co.id');
		*/
		$this->obj_mailer->WordWrap = 250;                    // Set word wrap to 50 characters
//		if(array_key_exists(4, $param)){
//			//$this->obj_mailer->addAttachment($param[4]);         // Add attachments
//                    $this->obj_mailer->AddStringAttachment($param[4], 'LaporanPPK.pdf', $encoding = 'base64', $type = 'application/pdf');
//
//		}
		$this->obj_mailer->isHTML(true);                     // Set email format to HTML

		$this->obj_mailer->Subject = $param[2];
		$this->obj_mailer->Body    = $param[3];
                
		// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$this->obj_mailer->send()) {
		    $ret = array(0, $this->obj_mailer->ErrorInfo);
                    //$this->obj_mailer->clearAddresses(); 
		} else {
		    $ret = array(1,'Sukses');
		}
		return $ret;
                
        unset($param);
	} 
      
}