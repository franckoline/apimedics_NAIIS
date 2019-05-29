<?php
defined('BASEPATH') or die('Direct access is not allowed');

class My_Controller extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->helper('url');
    $this->load->database();
    $this->site_name = 'Bosun Medical Diagnosis';
    $this->site_email = 'info@bounmedics.ng';
	  $this->user_email = $this->session->email;
    $this->load->library('user_agent');
    $this->load->library('twig');
    $this->twig->addGlobal('sitename', 'Bosun Medical Diagnosis');    
    $this->twig->addGlobal('tokenId', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im9sYXR1bmJvemFkZW5peWlAZ21haWwuY29tIiwicm9sZSI6IlVzZXIiLCJodHRwOi8vc2NoZW1hcy54bWxzb2FwLm9yZy93cy8yMDA1LzA1L2lkZW50aXR5L2NsYWltcy9zaWQiOiI1MTQ4IiwiaHR0cDovL3NjaGVtYXMubWljcm9zb2Z0LmNvbS93cy8yMDA4LzA2L2lkZW50aXR5L2NsYWltcy92ZXJzaW9uIjoiMjAwIiwiaHR0cDovL2V4YW1wbGUub3JnL2NsYWltcy9saW1pdCI6Ijk5OTk5OTk5OSIsImh0dHA6Ly9leGFtcGxlLm9yZy9jbGFpbXMvbWVtYmVyc2hpcCI6IlByZW1pdW0iLCJodHRwOi8vZXhhbXBsZS5vcmcvY2xhaW1zL2xhbmd1YWdlIjoiZW4tZ2IiLCJodHRwOi8vc2NoZW1hcy5taWNyb3NvZnQuY29tL3dzLzIwMDgvMDYvaWRlbnRpdHkvY2xhaW1zL2V4cGlyYXRpb24iOiIyMDk5LTEyLTMxIiwiaHR0cDovL2V4YW1wbGUub3JnL2NsYWltcy9tZW1iZXJzaGlwc3RhcnQiOiIyMDE5LTA1LTIzIiwiaXNzIjoiaHR0cHM6Ly9zYW5kYm94LWF1dGhzZXJ2aWNlLnByaWFpZC5jaCIsImF1ZCI6Imh0dHBzOi8vaGVhbHRoc2VydmljZS5wcmlhaWQuY2giLCJleHAiOjE1NTg3OTgyNDgsIm5iZiI6MTU1ODc5MTA0OH0.2iFGBQFGjY5r97rxCHvyIKwDtVJLQEqDzCZgWROjqZg');
  }

  public function is_restricted() {
     if ($this->session->loggedin) {
      return true;
    } else {
            $this->session->set_userdata('page_url',  current_url());
      redirect(site_url('home'));
    }
  }

  public function is_authed() {
    if ($this->session->loggedin) {
       redirect(site_url('dashboard'));
    } else {
     return true;
    }
  }

  public function admin_restricted(){
   if ($this->session->admin_logged) {
      return true;
    } else {
            $this->session->set_userdata('page_url',  current_url());
      redirect(site_url('index'));
    }
  }


  public function header($title) {
    $data['site_name'] = $this->site_name;
        $data['langi'] = $this->agent->languages();

    $data['title'] = $title;
    return $this->load->view('header', $data);
  }

  public function header2($title) {
    $duser = $this->db->get_where('users', array('u_email'=>$this->user_email))->row();
    $data['duser'] = $duser;
    $data['site_name'] = $this->site_name;
    $data['title'] = $title;
    return $this->load->view('user/header', $data);
  }

  public function footer($data = NULL) {
    $data['site_name'] = $this->site_name;
    return $this->load->view('footer', $data);
  }

  public function admin_header($title) {
    $data['site_name'] = $this->site_name;
    $data['title'] = $title;
    // $duser = $this->db->get_where('admin', array('uname'=>$this->session->admin_uname))->row();
    $duser = $this->db->get_where('admin', array('uname'=>' 
hq/2019/timchosen'))->row();
    $data['duser'] = $duser;
    // $data['sup_msg'] = $this->db->get_where('support_replies', array('reciever_email' =>$this->user, 'read_status' => '0'))->num_rows();

    return $this->twig->display('admin/header', $data);
    
  }

  public function admin_footer($data = NULL) {
      $data['site_name'] = $this->site_name;
      return $this->load->view('admin/footer', $data);
    }
} 

?>
