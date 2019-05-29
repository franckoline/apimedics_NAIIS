<?php
defined('BASEPATH') or die();

class Admin_model extends CI_Model {

      public function __construct() {
        parent::__construct();
        $this->load->database();
      }



  public function login() {
    $uname = $this->input->post('uname', true);
    $pswd = hash('ripemd128', $this->input->post('pswd', true));
    //hash password
   // $hash = hash('ripemd128', $password);

    $query = $this->db->get_where('admin', array('uname' => $uname, 'pswd' => $password))->num_rows();

    if($query > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function all_inmates() {

    $query = $this->db->get('users')->num_rows();

      if($query) {
        return $query;
      } else {
        return false;
      }
  }
  public function list_users() {

    $query = $this->db->get('users')->result();

    if($query) {
      return $query;
    } else {
      return false;
    }
  }

  public function user_details() {
    $uid = $this->uri->segment(3);

    $query = $this->db->get_where('users', array('id'=>$uid))->row();
      if($query) {
        return $query;
      } else {
        return false;
      }
  }

  public function pardoned_inmates() {

    $query = $this->db->get('pardons')->num_rows();

      if($query) {
        return $query;
      } else {
        return false;
      }
  }

  public function update_announcement() {
    $annoucement = $this->input->post('announcement', true);
    return $this->db->query("UPDATE annoucement SET message='$annoucement' WHERE id='1'");
  }


}
?>
