<?php
defined('BASEPATH') OR exit("No direct script access allowed");

class Login extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("auth/Login_model");
        
        if($this->session->userdata('is_user_logged_in') == true){
            redirect('user/dashboard');
        }
    }

    function index(){
        $data['title'] = "Login - ".APPNAME;
        $this->load->view('static_template/header', $data);
        $this->load->view("auth/login", $data);
        $this->load->view('static_template/footer', $data);
    }

    function verify(){
        $postData = $this->input->post();
        foreach($postData as $key=> $value){
            if(empty($value)){
                echo json_encode(['error'=>true, 'message'=>ucfirst($key)." can't be empty!"]);
                exit;
            }
        }
        $isLoginValid = $this->Login_model->verify_login($postData);        
        echo json_encode($isLoginValid);
    }         
}