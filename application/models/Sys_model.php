<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class Sys_model extends MY_Model
{

    public function __construct ()
    {
    	parent::__construct();
    }

    public function get_uid_byopenid($openid){
        $result = $this->db->select('*')->from('users')->where("openid",$openid)->get()->row_array();
        if($result){
            $this->session->set_userdata('uid', $result['id']);
        }else{
            $this->session->unset_userdata('uid');
        }
        return 1;
    }

    public function check_company_ns(){
        $today = date('Y-m-d',time());
        $this->db->select();
        $this->db->from('term4company');
        $this->db->where(array('begin_date <='=>$today,'end_date >='=>$today));
        $res_check_ = $this->db->get()->row_array();
        if($res_check_){
            return 1;
        }else{
            return -1;
        }
    }

    public function check_agent_ns(){
        $today = date('Y-m-d',time());
        $this->db->select();
        $this->db->from('term4agent');
        $this->db->where(array('begin_date <='=>$today,'end_date >='=>$today));
        $res_check_ = $this->db->get()->row_array();
        if($res_check_){
            return 1;
        }else{
            return -1;
        }
    }

    public function get_himg(){
        $this->db->select('a.*')->from('hear_img a');
        //$this->db->where('a.id',$id);
        return $this->db->get()->row_array();
    }
}