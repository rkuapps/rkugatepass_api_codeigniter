<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class PhpMailerLib 
{
	function __construct($config = array())
	{
		
	}

	public function load()
    {
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';       
        $mail = new PHPMailer();
        return $mail;
    }
}

