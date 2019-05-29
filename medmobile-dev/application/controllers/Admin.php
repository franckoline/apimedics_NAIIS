<?php
defined('BASEPATH') or die('Direct access to script is not allowed');

class Admin extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
	}


	public function _grocery_output($output = null)
	{

	}


	public function index() {
		$this->form_validation->set_rules('uname', 'Login Code', 'required');
		$this->form_validation->set_rules('pswd', 'Password', 'required');

		if ($this->form_validation->run()) {

				if($this->admin_model->login()) {
					$data = array('admin_email' => $this->input->post('uname', true), 'admin_logged' => true);
					$this->session->set_userdata($data);
					redirect(site_url('dashboard'));
				} else {
					$this->session->set_flashdata('error_msg', 'Incorrect Email or Password');
					redirect(site_url('index'));

				}
		}

		$this->load->view('admin/login');

	}


	public function dashboard() {
		// $this->admin_restricted();
		$this->admin_header('Dashboard');
		$data['duser'] = 'Admin';//$this->dashboard_model->get_details($this->_user)->name;
		$data['total_users'] = $this->db->count_all('inmates');
		$data['total_pardons'] = $this->db->count_all('pardons');
		$data['total_centers'] = $this->db->count_all('zones');
		$this->load->view('admin/dashboard', $data);
		$this->admin_footer();
	}

	public function add_user() {
		$this->admin_restricted();
		$this->admin_header('Add User');
		$this->form_validation->set_rules('name', 'Fullname', 'required');
		$this->form_validation->set_rules('number', 'Phone Number', 'required');
		$this->form_validation->set_rules('location', 'Location', 'required');
		$this->form_validation->set_rules('bundle', 'Bundle', 'required');
		$this->form_validation->set_rules('bank_details', 'Bank Details', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if($this->form_validation->run()) {
			$this->load->model('core_model');
			$this->core_model->register();
			$this->session->set_flashdata('msg', 'Success');
		}
		$g = $this->db->get('annoucement')->row();
		$data['announcement'] = $g->message;
		$this->load->view('admin/add_user', $data);
		$this->admin_footer();
	}

	public function all_users() {
		$this->admin_restricted();
		$this->admin_header('All User');
		$data['users'] = $this->db->get('users')->result_array();
		$this->load->view('admin/layout/admin_sidebar', $data);
		$this->load->view('admin/all_users', $data);
		$this->admin_footer();
	}

	public function edit($id) {

		$this->admin_restricted();
		$this->admin_header('Edit User');
		$this->form_validation->set_rules('name', 'Fullname', 'required');
		$this->form_validation->set_rules('number', 'Phone Number', 'required');
		//$this->form_validation->set_rules('location', 'Location', 'required');
		//$this->form_validation->set_rules('bundle', 'Bundle', 'required');
		//$this->form_validation->set_rules('bank_details', 'Bank Details', 'required');
		$passQ = $this->db->get_where('users', array('id' => $id))->row_array();
		$pass = $passQ['password'];
		if($this->form_validation->run()) {
			$this->admin_model->edit($id, $pass);
			$this->session->set_flashdata('msg', 'Success');
		}
		$data['p'] = $this->db->get_where('users', array('id' => $id))->row_array();
		$data['id'] = $id;
		$this->load->view('admin/layout/admin_sidebar', $data);
		$this->load->view('admin/edit', $data);
		$this->admin_footer();

}



}
?>
