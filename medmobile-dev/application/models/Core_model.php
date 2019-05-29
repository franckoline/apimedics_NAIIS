<?php
defined('BASEPATH') or exit('Direct access to script is not allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Core_model extends CI_Model {
  public function __construct() {
    parent::__construct();
    $this->load->database();
    
  }


 
  public function login() {
    $email = $this->input->post('email', true);
    $password = hash('ripemd128', $this->input->post('password', true));

    $query = $this->db->get_where('users', array('email' => $email, 'password' => $password, 'is_blocked' => 'false'));

    $result = $query->result();

    if($result) {
    return  true;} 
    else { return false;}
  }

}
 ?>
