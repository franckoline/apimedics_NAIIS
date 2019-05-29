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

  public function list_symptoms() {

    // # Form our options
    // $opts = array('http' =>
    //     array(
    //         'method'  => 'POST',
    //         'header'  => 'Content-type: application/x-www-form-urlencoded',
    //         'content' => $postString
    //     )
    // );
    // # Create the context
    // $context = stream_context_create($opts);
    // # Get the response (you can use this for GET)
    // $result = file_get_contents('/api/update', false, $context);


        echo "<script> 
        var token = '';
        var symptoms ={};
        var uri = 'https://sandbox-authservice.priaid.ch/login';
        var secret_key = 'e5T7Nzw6YEq24Fgd3';
        var computedHash = CryptoJS.HmacMD5(uri, secret_key);
        var computedHashString = computedHash.toString(CryptoJS.enc.Base64);
        $.ajax({
         url:uri,
         type:'POST',
         headers: {
            'Authorization': 'Bearer olatunbozadeniyi@gmail.com:' + computedHashString
            }, 
             success: function(rsp){
             token = rsp.Token;
        
        var year_of_birth = $('#year_of_birth').val();
        var gender = $('#gender').val();
        var symptom_id = $('#symptoms').val();
        var lang = 'en-gb';
        var data = {'token': token,'language': lang};

        e.preventDefault();
          $.ajax({
             url:'https://sandbox-healthservice.priaid.ch/symptoms',
             type:'GET',
             data: data, 
             success: function(data){
                 if(data==''){ 
                  symptoms = data;
                }
              },
             failure: function(data){
               symptoms = data;
             }
           });
              
        }
        }); 
      </script>";
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



}
?>
