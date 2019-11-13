<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin');
        $this->load->model('user_model');
    
        
    }

	public function index()
	{
		
			if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true)
			{
			    redirect(base_url('index.php/login/home'));

			}else{

	            $this->form_validation->set_rules('username', 'Username', 'required');
	            $this->form_validation->set_rules('password', 'Password', 'required');

	            $this->form_validation->set_message('required', '<div class="alert alert-danger" style="margin-top: 3px">
	                <div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> incorrecte</div></div>');

				if ($this->form_validation->run() == TRUE) {

	            $username = $this->input->post("username", TRUE);
	            $password = $this->input->post('password', TRUE);
	            //$password = MD5($this->input->post('password', TRUE));
	            
	            echo 'Username: '.$username. ' Password: '.$password;
	            $checking = $this->admin->check_login('users', array('username' => $username), array('password' => $password));
	            echo json_encode($checking);
	            if ($checking != FALSE) {
	                foreach ($checking as $apps) {

	                    $session_data = array(
	                        'user_id'   => $apps->id_user,
	                        'user_name' => $apps->username,
	                        'user_pass' => $apps->password,
	                        'logged_in' => true
	                    );
	                    $this->session->set_userdata($session_data);
	                    redirect(base_url('index.php/login/home'));
	                }
	            }else{

	            	$data['error'] = '<div class="alert alert-danger" style="margin-top: 3px">
	                	<div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> username or password incorrect!</div></div>';
	            	$this->load->view('login', $data);
	            }

	        }else{
	            $this->load->view('login');
	        }
		}
	}
	
	public function home()
	{
		$data['data'] = $this->form->get_data_query('SELECT * FROM articles,magasins WHERE qte_min_art>qte_mag AND id_art=id_art_mag ORDER BY article_art ASC');
		$this->load->view("include/header");	
		$this->load->view("dashboard",$data);
		$this->load->view("include/footer");
	}
	
	public function register() { 
		$data = new stdClass();
		 
		$this->load->helper('form');
		$this->load->library('form_validation');
		 
		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[users.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
		
		if ($this->form_validation->run() === false) {
			 
			$this->load->view('include/header');
			$this->load->view('user/register/register', $data);
			$this->load->view('include/footer');
			
		} else { 
			$username = $this->input->post('username');
			$email    = $this->input->post('email');
			$password = $this->input->post('password');
			
			if ($this->user_model->create_user($username, $email, $password)) {
				redirect(base_url());
			} else { 
				$data->error = 'There was a problem creating your new account. Please try again.';
				 
				$this->load->view('include/header');
				$this->load->view('user/register/register', $data);
				$this->load->view('include/footer'); 
			} 
		} 
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}
