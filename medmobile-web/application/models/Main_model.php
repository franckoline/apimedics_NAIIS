<?php
defined('BASEPATH') or die('');
date_default_timezone_set('Africa/Lagos');

use Embed\Embed;

class Main_model extends CI_Model {
  public function __construct(){
    parent::__construct();
     $this->load->helper('date');
     $this->load->library('session');
       $this->load->database();
  }


 
  public function login() {
    $this->load->library('user_agent');  
    $email = $this->input->post('email', true);
    $password = hash('ripemd128', $this->input->post('upswd', true));

    $query = $this->db->get_where('users', array('u_email' => $email, 'u_pswd' => $password, 'is_blocked' => 'false'));

    $result = $query->result();

      if($result) {
        $ip = $this->input->ip_address();
        $ua = $this->agent->platform();
            $data = array('last_login' => date('Y-m-d h:m:s'), 'last_login_ip'=> $ip, 'last_login_device' => $ua);
            $where = array("u_email"=>$email);
            $loginUpdate = $this->db->update('users', $data, $where);
             $session_data = array('email' => $email, 'loggedin' => TRUE);
            $this->session->set_userdata($session_data);

        return  true;
      } 
      else { return false;}
    }

    function user_details(){
      
      return $this->db->get_where('users', array('u_email'=>$this->user_email))->row();
    }

}