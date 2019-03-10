<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class Index_model extends MY_Model
{
    public function __construct ()
    {
        parent::__construct();
    }

    public function main(){

    }

    public function login(){
        $this->db->select()->from('company_pending')->where(array(
            'username'=>$this->input->post('username'),
            'password'=>sha1($this->input->post('password'))
        ));
        $res = $this->db->get()->row_array();
        if(!$res)
            return -1;
        if($res['flag'] !=2 || $res['status']==-1)
            return -2;
        $data['company_info'] = $res;
        $this->session->unset_userdata('agent_id');
        $this->session->unset_userdata('agent_info');
        $this->session->set_userdata($data);
        $this->session->set_userdata(array('company_id'=>$res['id']));
        return 1;
    }

    public function login_agent(){
        $this->db->select()->from('agent')->where(array(
            'job_code'=>$this->input->post('username'),
            'pwd'=>sha1($this->input->post('password'))
        ));
        $res = $this->db->get()->row_array();
        if(!$res)
            return -1;
        if($res['flag'] !=2)
            return -2;
        $data['agent_info'] = $res;
        $this->session->unset_userdata('company_id');
        $this->session->unset_userdata('company_info');
        $this->session->set_userdata($data);
        $this->session->set_userdata(array('agent_id'=>$res['id']));
        return 1;
    }
}