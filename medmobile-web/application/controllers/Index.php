<?php

defined('BASEPATH') OR exit('No direct script access allowed');
// use \Dompdf\Dompdf;
// use \Dompdf\Dompdf;
// require_once APPPATH.'/vendor/dompdf/dompdf';
class Index extends My_Controller {
	public function __construct() {
    parent::__construct();
    $this->load->model('Main_model');
    $this->load->model('Admin_model');
    $this->load->library('twig');
    $this->load->helper('url');
  }

	public function home() {
    $this->admin_header($this->site_name." | Online Diagnosis System");
    $this->load->view('admin/dashboard');
    $this->load->view('admin/footer');
  }
  
  public function users() {
    $data['pardoned'] = $this->Admin_model->list_users(); 
    $data['title'] =    $this->site_name." | List all users";
    $this->twig->display('admin/users', $data);
  }

  public function symptoms_manager() {
    $data['symptoms'] = $this->Admin_model->list_symptoms(); 
    $data['title'] =    $this->site_name." | Symptoms Manager";
    $this->twig->display('admin/symptoms_manager', $data);
  }
  public function add_user() {
    $data['title'] =    $this->site_name." | Add new Patients";
    $this->twig->display('admin/add-users', $data);
  }

  public function diagnose() {
    $data['title'] =    $this->site_name." | Diagnsose User Patient";
    $data['user'] = $this->Admin_model->user_details(); 
    $this->twig->display('admin/diagnose', $data);
  }
   
}

?>