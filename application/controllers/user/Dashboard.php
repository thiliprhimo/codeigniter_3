<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Dashboard extends CI_Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        $data['title'] = "Dashboard - ".APPNAME;
        $this->load->view('static_template/header', $data);
        $this->load->view('user/dashboard', $data);
        $this->load->view('static_template/footer', $data);
    }

    function logout(){        
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}