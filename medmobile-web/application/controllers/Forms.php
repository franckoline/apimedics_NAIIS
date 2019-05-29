<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Forms extends My_Controller {

	public function __construct() {
    parent::__construct();
    $this->load->model('Main_model');
  }

 

  public function register() {
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->helper('string');
    $this->load->library('email');
    $this->load->library('user_agent');  
    $referrer = $this->input->post('referrer', true);
    $email = $this->input->post('email', true);
    $name = $this->input->post('name', true);
    $pswd = $this->input->post('upswd', true);
    $cpswd = $this->input->post('upswd', true);
    $honeypot = $this->input->post('username', true);
    $site_email = $this->site_email;
    $site_name = $this->site_name;
    $msg_success = "Your registeration was <strong>successful</strong> You will be redirected shortly.";


    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('upswd', 'required');
    $this->form_validation->set_rules('ucpswd', 'Name', 'required');
    $this->form_validation->set_rules('referrer', 'Referrer', 'valid_email');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]', array(
                'is_unique'     => 'This %s is already registered, please login instead.'
        ));


    if ($this->form_validation->run() ){
      if ($pswd === $cpswd) {
        $ref =NULL;
        if($referrer !=''){
         $rf = $this->db->get_where('users', array('email'=>$referrer))->row();
         $ref = $rf->sn;
        }
        $ukey = random_string('alnum', 4).substr(time(), 4);
        $ua = $this->agent->platform();
        $data = array('email' => $email, 'name'=> $name, 'ua' => $ua,'pswd'=>hash('ripemd128', $pswd), 'key'=>$ukey, 'referrer'=>$ref);
        $q = $this->db->insert('users', $data);


          if($q) {            
            $response = array ('result' => "success", 'message' =>$msg_success );
            $session_data = array('email' => $email, 'loggedin' => TRUE, 'name' => $name);
            $this->session->set_userdata($session_data);
            // redirect(site_url('dashboard'));
            echo json_encode($response);

          } else {
            $response = array ('result' => "error", 'message' => 'Unfortunately we could not add you to our database, please try again');
            echo json_encode($response);    

          }
          }      

        else {
          echo json_encode(array ('result' => "error", 'message' => " <strong>Passwords do not Match</strong>!"));
        }
        
        } else {
          echo json_encode(array ('result' => "error", 'message' => validation_errors()));
        }
  } 


  public function add_user() {
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->helper('string');
    $this->load->library('email');
    $name =   $this->input->post('name', true);
    $yob =    $this->input->post('yob', true);
    $gender = $this->input->post('gender', true);
    $email =  $this->input->post('email', true);
    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('yob', 'Year of Birth', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]', array(
                'is_unique'     => 'This %s is already registered!'
    ));
    $this->form_validation->set_error_delimiters('', '<br>');


    if ($this->form_validation->run()){
      $data = array('email' => $email, 'name'=> $name, 'yob' => $yob,'gender'=>$gender);
      $q = $this->db->insert('users', $data);


        if($q) {            
          echo 'success';

        } else {
          echo  'Unfortunately we could not add you to our database, please try again';
        }
    }      

    else {
      echo validation_errors();
    }
  } 

  public function add_report() {
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->helper('string');
    $this->load->library('email');
    $issue_id = $this->input->post('issue_id', true);
    $pat_id =   $this->input->post('pat_id', true);
    $issue_name = $this->input->post('issue_name', true);
    $icd_name = $this->input->post('icd_name', true);
    $prof_name = $this->input->post('prof_name', true);
    $symptom_id =    $this->input->post('symptom_id', true);
    $result =  $this->input->post('result', true);
    $data = array('issue_id'=>$issue_id, 'pat_id'=>$pat_id, 'issue_name'=>$issue_name, 'icd_name'=>$icd_name, 'prof_name'=>$prof_name,'symptom_id'=>$symptom_id, 'diagnosis_result'=>$result);
      $q = $this->db->insert('results', $data);
        if($q) {            
          echo 'success';

        } else {
          echo  '<p><br><br>Unfortunately we could not add you to our database, please try again</p>';
        }
    }      



  public function login() {
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('upswd', 'Password', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

    if ($this->form_validation->run() ){
        if($this->Main_model->login()) {
          echo "success";         
        } else {
          echo '<strong>Wrong Login details</strong>, please try again';
        }
     
    } else { echo validation_errors();}
  }



  
 
}
