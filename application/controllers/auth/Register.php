<?php
defined('BASEPATH') OR exit("No direct script access allowed");

class Register extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('auth/Register_model');
    }

    function index(){
        $data['title'] = 'Registration - '.APPNAME;
        $this->load->view('static_template/header', $data);
        $this->load->view('auth/register', $data);
        $this->load->view('static_template/footer', $data);
    }

    function store(){
        $postData = $this->input->post();

        $isRegistered = $this->Register_model->register($postData);
        if($isRegistered['error'] == true){
            echo json_encode($isRegistered); exit;
        }

        $userEmail = $postData['email'];
        $confirmationCode = urlencode($userEmail);

        $this->load->config('email');
        $this->load->library('email');

        $from = $this->config->item('smtp_user');
        $to = $userEmail;
        $subject = "Registration : Email - confirmation";
        $confirmationURL = base_url("auth/register/confirmation/".$confirmationCode);
        $message = '<a href="'.$confirmationURL.'">Click here</a> to confirm your Email ID';

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->reply_to($from, "Rhimo");
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            $this->session->set_flashdata("register_success", "Kindly confirm your registration by clicking the link sent to your Email ID.");
        } else {
            $isRegistered = array('error'=>true, 'message'=>$this->email->print_debugger());
        } 
        echo json_encode($isRegistered);      
    }

    function confirmation($confirmationCode){
        $decodeEmail = urldecode($confirmationCode);
        $activation = $this->Register_model->activation($decodeEmail);
        if($activation['error'] == true){
            exit($activation['message']);
        }
        $this->session->set_flashdata('confirmation_success', "Account Activated successfully!");
        redirect('auth/login');
    }
}