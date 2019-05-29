<?php
defined('BASEPATH') or die('Direct access to script is not allowed');

class Admin extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('grocery_CRUD');
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

	public function add_behaviour() {
		$this->form_validation->set_rules('inmate_no', 'Inmate Number', 'required');
		$this->form_validation->set_rules('honesty', 'Honesty', 'required');
		$this->form_validation->set_rules('humility', 'Humility', 'required');
		$this->form_validation->set_rules('integrity', 'Integrity', 'required');
		$this->form_validation->set_rules('change', 'Change Rate', 'required');
		$this->form_validation->set_rules('obedience', 'Obedience', 'required');

		if ($this->form_validation->run()) {

				if($this->admin_model->add_behaviour()) {
					$this->session->set_flashdata('success_msg', 'Added Behaviour Successfully');
					redirect(site_url('admin/inmates-behaviour'));
				} else {
					$this->session->set_flashdata('error', 'Behaviour could not be added');
					redirect(site_url('admin/inmates-behaviour'));

				}
		}
		$this->admin_header('Add Behaviour');

		$this->load->view('admin/add_behaviour');
		$this->admin_footer();

	}


	public function pardoned() {
		// $this->admin_restricted();
		$this->admin_header('Dashboard');
		$data['duser'] = 'Admin';//$this->dashboard_model->get_details($this->_user)->name;
		$data['pardoned'] = $this->db->count_all('zones');
		$this->load->view('admin/pardoned', $data);
		$this->admin_footer();
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


	public function inmates() {
		$crud = new grocery_CRUD();

			$crud->set_theme('tablestrap');
			$crud->set_table('inmates');
			$crud->display_as('name','Full Name');
			$crud->unset_columns('exit_date', 'status');
			$crud->display_as('start_date','Date Inprisoned ');
			$crud->columns(['name', 'zone', 'crime', 'start_date']);
			$crud->callback_column('status', array($this, '_callback_check_status'));
			$crud->set_subject('Inmates');

			$crud->required_fields('name','start_date', 'zone', 'crime');

			$output = $crud->render();

		$this->_grocery_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
		$this->admin_header('Manage Inmates', (array)$output);

			$this->load->view('admin/all_inmates.php',(array)$output);
		$this->admin_footer();

		}
		function _callback_check_status($value, $row){
			if($row->status==1){return "Pardoned";} else {return "Not Pardoned";}

		}


	public function zones() {
		$crud = new grocery_CRUD();

			$crud->set_theme('tablestrap');
			$crud->set_table('zones');
			$crud->display_as('z_name','Zone Name');
			$crud->display_as('z_code','Zone Code');
			$crud->columns('z_name', 'z_code');
			$crud->set_subject('Reformation Center');

			$crud->required_fields('name','start_date', 'zone', 'crime');

			$output = $crud->render();

		$this->_grocery_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
		$this->admin_header('Manage Zones', (array)$output);

			$this->load->view('admin/zones.php',(array)$output);
		$this->admin_footer();

	}
		
	public function reports(){
		$data['pardoned'] = $this->admin_model->pardoned_inmates();
		$data['inmates'] = $this->admin_model->all_inmates();
		$this->admin_header('Reports');
		$this->load->view('admin/reports', $data);
		$this->admin_footer();
	}

	public function pardoned_inmates(){
		$data['pardoned'] = $this->admin_model->list_pardoned_inmates();
		$this->admin_header('Reports');
		$this->load->view('admin/pardoned', $data);
		$this->admin_footer();
	}



	public function behaviour(){
	$this->admin_header('Inamte Behaviour');
		$this->load->view('admin/add_behaviour');
		$this->admin_footer();


	}
	public function announcement() {
		$this->admin_restricted();
		$this->admin_header('Announcement');
		$this->form_validation->set_rules('announcement', 'Announcement', 'required|trim');
		if($this->form_validation->run()) {
			$this->admin_model->update_announcement();
			$this->session->set_flashdata('msg', 'Success');
		}
		$g = $this->db->get('annoucement')->row();
		$data['announcement'] = $g->message;
		$this->load->view('admin/layout/admin_sidebar', $data);		
		$this->load->view('admin/announcement', $data);
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

	public function block($id) {
		$this->db->query("UPDATE users SET is_blocked='true' WHERE id='$id'");
		$this->session->set_flashdata('success_msg', 'User has been blocked');
		redirect(site_url('admin/all_users'));
	}

	public function unblock($id) {
		$this->db->query("UPDATE users SET is_blocked='false' WHERE id='$id'");
		$this->session->set_flashdata('success_msg', 'User has been unblocked');
		redirect(site_url('admin/all_users'));
	}

	public function delete($id) {
		$this->db->query("DELETE FROM users WHERE id='$id'");
		$this->session->set_flashdata('success_msg', 'User has been deleted');
		redirect(site_url('admin/all_users'));
	}

	public function all_donations() {
		$this->admin_restricted();
		$this->admin_header('All Donations');
		$data['donations'] = $this->db->get('bonus')->result_array();
		$this->load->view('admin/layout/admin_sidebar', $data);
		$this->load->view('admin/all_donations', $data);
		$this->admin_footer();
	}

	public function all_withdrawals() {
		$this->admin_restricted();
		$this->admin_header('All Donations');
		$data['donations'] = $this->db->get('ghelp')->result_array();
		$this->load->view('admin/layout/admin_sidebar', $data);
		$this->load->view('admin/all_withdrawals', $data);
		$this->admin_footer();
	}

	public function approve($id) {
		$this->db->query("UPDATE ghelp SET status='completed' WHERE id='$id'");
		$this->session->set_flashdata('success_msg', 'Withdrawal has been Completed');
		redirect(site_url('admin/all_withdrawals'));
	}

	public function disapprove($id) {
		$this->db->query("UPDATE donations SET status='cancelled' WHERE id='$id'");
		$this->session->set_flashdata('success_msg', 'Donation has been disapproved');
		redirect(site_url('admin/all_donations'));
	}

	public function change_pass() {
		$this->admin_restricted();
		$this->admin_header('Change Details');
		$this->form_validation->set_rules('email', 'Email', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if ( $this->form_validation->run() ) {
			$email = $this->input->post('email', true);
			$pass = $this->input->post('password', true);
			$hash = hash('ripemd128', $pass);
			$this->db->query("UPDATE admin SET email='$email', password='$hash' WHERE id='1'");
			$this->session->set_flashdata('success_msg', 'Password has been changed');
		}
		$this->load->view('admin/change_pass');
		$this->admin_footer();
	}
/** switch user eligibility */
public function switcheligible($id) {
		$this->db->query("UPDATE  users SET eligible='true' WHERE id='$id'");
		$this->session->set_flashdata('success_msg', 'User user eligibility has been switched');
		redirect(site_url('admin/all_users'));
	}

public function support() {
		if($this->session->userdata('admin_logged')){
			$this->admin_header('Contact Support | '.$this->site_name);
		}else{$this->header0('Contact Support | '.$this->site_name);}
		
		$data['site_name'] = $this->site_name;

		$this->form_validation->set_rules('category', 'Category', 'required');
		$this->form_validation->set_rules('subject', 'Suject', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		if ($this->form_validation->run()) {

			if ($this->core_model->sendSupport()) {
		$this->session->set_flashdata("_msg","Sent!! Wait for a reply shortly"); 
			}else {
				$this->session->set_flashdata("_msg","Error in sending Support."); 
			}
		}

		$this->load->view('admin/support');
		$this->admin_footer();
	}

public function support_reply() {
		$this->admin_header('Support replies| '.$this->site_name);
		$data['site_name'] = $this->site_name;
		$id = $this->uri->segment(3);
		$user_email = $this->uri->segment(4);
		$data['replies'] =  $this->admin_model->get_support_reply($id);
		$data['replyid']=$id;
		$data['user_email'] = $user_email;
		$this->form_validation->set_rules('message', 'Message', 'required');
		if ($this->form_validation->run()) {

			if ($this->admin_model->send_support_reply()) {
		$this->session->set_flashdata("_msg","Reply Sent!! Wait for a reply shortly"); 
		redirect(site_url('support'));
			}else {
				$this->session->set_flashdata("_msg","Error in sending Support message."); 
			}
		}

		$this->load->view('admin/s_reply',$data);
		$this->admin_footer();
	}



}
?>
