<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* IMPORTANT NOTE : Don't forget to enable "Less secure apps" in your gmail acccount */

$config = array(
    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
    'smtp_host' => 'smtp.gmail.com', 
    'smtp_port' => 587, //465,
    'smtp_user' => '', //Enter your email ID
    'smtp_pass' => '', // Enter your password
    'smtp_crypto' => 'tls', //can be 'ssl' or 'tls' for example
    'mailtype' => 'html', //'text', //plaintext 'text' mails or 'html'
    'smtp_timeout' => '4', //in seconds
    'charset' => 'utf-8', //'iso-8859-1',
    'wordwrap' => TRUE
);