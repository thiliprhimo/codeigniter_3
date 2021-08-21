<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EmailController extends CI_Controller {

    public function __construct() {
        parent:: __construct();

        $this->load->helper('url');
    }

    public function index() {
        $this->load->view('email/contact');
    }

    function send() {
        $this->load->config('email');
        $this->load->library('email');
        
        $postData = $this->input->post();

        $from = $this->config->item('smtp_user');
        $to = $postData['to'];
        $subject = $postData['subject'];
        $message = "<table><tr><td>".$postData['message']."</td></tr></table>";

        if(isset($postData['carbon_copy']) && !empty($postData['carbon_copy'])){
            $this->email->cc($postData['carbon_copy']);
        }
        if(isset($postData['blind_carbon_copy']) && !empty($postData['blind_carbon_copy'])){
            $this->email->bcc($postData['blind_carbon_copy']);
        }

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->reply_to($from, "Rhimo");
        $this->email->to($to);
        // $this->email->attach($to);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            echo 'Your Email has been sent successfully.';
        } else {
            show_error($this->email->print_debugger());
        }
    }
}