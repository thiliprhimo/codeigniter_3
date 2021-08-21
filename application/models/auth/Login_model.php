<?php
class Login_model extends CI_Model{
    function __construct(){
        $this->loginTable = "users";
    }

    function verify_login($loginData){
        extract($loginData);

        $query = $this->db->where([
            'email'=>$username
        ])
        ->get($this->loginTable);

        if ($query->num_rows() < 1){
            return array('error'=>true, 'message'=>'Invalid Username!');
        }

        $userData = $query->row_array();
        if (md5($password) != $userData['password']){
            return array('error'=>true, 'message'=>'Invalid password!');
        }

        if (!$userData['active']){
            return array('error'=>true, 'message'=>'Your account is inactive!');
        }

        $this->session->set_userdata([
            'is_user_logged_in' => true
        ]);

        return array('error'=>false, 'redirect'=>base_url('user/dashboard'));
    }
}