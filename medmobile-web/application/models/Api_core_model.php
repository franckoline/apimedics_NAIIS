<?php
  
if (isset($_SERVER['HTTP_ORIGIN'])) {

        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");

        header('Access-Control-Allow-Credentials: true');

        header('Access-Control-Max-Age: 86400');    // cache for 1 day

    }

    // Access-Control headers are received during OPTIONS requests

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))

            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");        

       if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))

            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);

    }

defined('BASEPATH') or exit('Direct access to script is not allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Api_core_model extends CI_Model {
  public function __construct() {
    parent::__construct();
    $this->load->database();
    
  }

 public function get_details($email) {
    return $this->db->get_where('users', array('email' => $email))->row();
  }
 

public function login($email, $password) {

    $query = $this->db->get_where('users', array('email' => $email, 'password' => $password, 'is_blocked' => 'false'));

    $result = $query->result();

    if($result) {
      return  true;} 
    else { return false;}
}

public function reset() {
    $code = $this->input->post('code', true);
    $password = hash('ripemd128', $this->input->post('password', true));
    $email_query = $this->db->query("SELECT * FROM reset_codes WHERE code='$code'");
    $email_result = $email_query->row_array();
    $email = $email_result['user'];
    
    $query = $this->db->query("UPDATE users SET password='$password' WHERE email='$email'");
    if($query) {
      $this->db->query("UPDATE reset_codes SET status='1' WHERE code='$code'");
      return true;} 
      else {return false;}
}


  public function change_password() {
    $password1 = $this->input->post('password1', true);
    $password2 = $this->input->post('password2', true);
    $password = hash('ripemd128', $this->input->post('password', true));
    $email_query = $this->db->query("SELECT * FROM users WHERE password='$password'");
    $email_result = $email_query->row_array();
    $email = $email_result['email'];
    
    $query = $this->db->query("UPDATE users SET password='$password1' WHERE email='$email'");
    if($query) {
      return true;} 
      else {return false;}
  }

  public function verify_code() {
   $code = $this->input->post('code', true);
    $password = hash('ripemd128', $this->input->post('password', true));
    $drow = $this->db->get_where('users', array('verify' => $code))->row(); 
    if ($drow) { 
    $user_id = $drow->id;
    $referer = $drow->referer; 
    $rrow = $this->db->get_where('users', array('email' => $referer))->row(); 
    $referer_id = $rrow->id; 


    $query = $this->db->query("UPDATE users SET verify='8' WHERE verify='$code'");
    if($query) {
     //  $data = array('user_id' => $user_id, 'amount'=>'62.5', 'remark' =>'Signup Bonus', 'status'=>'1');
     // $query2= $this->db->insert('earnings', $data);
     // $data2 = array('user_id' => $referer_id, 'amount'=>'10.', 'remark' =>'Referer Bonus', 'status'=>'1');
     // $query3= $this->db->insert('earnings', $data2);
      return true;} 
      else {return false;}
    } 
      else {return false;}
  }

  public function get_support_cat() {
    $query = $this->db->get('supportcat');
   return  $query->result_array();
     
  } 


}
 ?>
