<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Contact_form extends My_Controller {

	public function __construct() {
    parent::__construct();
    $this->load->model('Main_model');
    $this->load->model('Cv_maker_model');
  }

  public function contact_form() {
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->helper('string');
    $this->load->library('email');
    $this->load->library('c_agent');  
    $email = $this->input->post('contact-email', true);
    $name = $this->input->post('contact-name', true);
    $message = $this->input->post('contact-message', true);
    $subject = $this->input->post('contact-subject', true);
    $username = $this->input->post('contact-username', true);

    $this->form_validation->set_rules('contact-message', 'Message', 'required');
    $this->form_validation->set_rules('contact-subject', 'Subject', 'required');
    $this->form_validation->set_rules('contact-name', 'Your Name', 'required');
    $this->form_validation->set_rules('contact-email', 'Your Email', 'email|required');
	  if ($this->form_validation->run() === FALSE)
	    {   
        $data = array(
          "feedback"=>[
            "a"=>"Oh oh, that does not look like a name to me, wanna try again?"
          ],
          "nextUrl"=>"get_name");   
         echo json_encode($data);
	    }
    	else {
        $bodymsg = '';
         ### Include Form Fields into Body Message
      $bodymsg .= isset($name) ? "Contact Name: $name<br><br>" : '';
      $bodymsg .= isset($subject) ? "Contact Subject: $subject<br><br>" : '';
      $bodymsg .= isset($email) ? "Contact Email: $email<br><br>" : '';
      $bodymsg .= isset($message) ? "Message: $message<br><br>" : '';
      $bodymsg .= $_SERVER['HTTP_REFERER'] ? '<br>---<br><br>This email was sent from : ' . $_SERVER['HTTP_REFERER'] : ''; 

      $ua = $this->agent->platform();
      $data = array('c_email' => $email, 'c_name'=> $name, 'c_ua' => $ua,'c_subject'=>$subject, 'c_msg'=>$bodymsg);
      $q = $this->db->insert('contact_form', $data);
        if($q) {
          $this->email->from($site_email, 'Contact Form from'.$site_name);
          $this->email->to($site_email);
          $this->email->cc($email);
          // $this->email->bcc('them@their-example.com');
          $this->email->subject('Contact email from '.$site_name.' - '. $subject);
          $this->email->message($bodymsg);
          $this->email->set_mailtype('html');
          $this->email->send();
          
      }   
    } 

          }
	    }
