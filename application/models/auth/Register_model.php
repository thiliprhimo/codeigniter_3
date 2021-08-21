<?php

class Register_model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->registerTable = "users";
    }

    function register($arrayData){
        extract($arrayData);

        $isNewEmail = $this->emailExistsOrNot($email);
        if (!$isNewEmail){
            return array('error'=>true, 'message'=>'Email already exists!');
        }
        $arrayData['password'] = md5($password);
        $register = $this->db->insert($this->registerTable, $arrayData);        
        if(!$register){
            return array('error'=>true, 'message'=>"Failed to register new user!");
        }

        return array('error'=>false, 'redirect'=>base_url('auth/login/'));
    }

    function emailExistsOrNot($email){
        $query = $this->db->where(['email'=>$email])
        ->select('email')
        ->get($this->registerTable);
        return ($query->num_rows() == 0) ? true : false;
    }

    function activation($email){
        $check = $this->db->get_where($this->registerTable, ['email'=>$email, 'active'=>1]);
        if ($check->num_rows() > 0){
            return array('error'=>true, 'message'=>"Account activated already, you can proceed to login!");
        }

        $query = $this->db->set(['active'=>1])
        ->where(['email'=>$email])
        ->update($this->registerTable);
        if(!$query){
            return array('error'=>true, 'message'=>"Email confirmation failed. Kindly, try after sometime.");
        }
        
        return array('error'=>false, 'message'=>"Account activated successfully!");
    }
}