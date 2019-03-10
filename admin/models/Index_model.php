<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class Index_model extends MY_Model
{
    
    public function __construct ()
    {
    	parent::__construct();
    }
    
    public function index(){
    	return $this->db->select()->from('admin')->get()->row_array();
    }



    public function update_password(){
        $user_info = $this->session->userdata('user_info');
        if($user_info['pwd'] != sha1($this->input->post('old_pass'))) {
            return -1;
        }
        $res = $this->db->where('id',$user_info['id'])->update('admin',array('pwd'=>sha1($this->input->post('password'))));
        if($res){
            return 1;
        }else{
            return -1;
        }
    }


 
}