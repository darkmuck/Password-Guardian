<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		// Load helpers
		$this->load->helper('url');
		$this->load->helper('session_helper');
		
		// Load libraries
		$this->load->library('session');
		
		// Load models
		$this->load->model('settings_model');
	}

	private $outputData = array();
	
	function index()
	{
		// Load libraries
		$this->load->library('form_validation');
		

		
		// Get the login status
		$this->outputData['logged_in'] = loggedIn();
		
		if (!$this->outputData['logged_in'])
		{
			if (!empty($_POST))
			{ // See if form is submitted
		
				//Check incoming variables
				$this->form_validation->set_rules('username','Username','trim|required|xss_clean');
				$this->form_validation->set_rules('password','Password','trim|required|xss_clean');
				
				if ($this->form_validation->run())
				{ // Passed all validations
					
					$username = $this->input->post('username');
					$password = $this->input->post('password');
					
					if (!$this->settings_model->login($username,$password))
					{ // Invalid username or password
						
						$flashdata = array('message'=>'Invalid username or password.');
						$this->session->set_flashdata($flashdata);
						redirect('/');
					
					}
					else
					{ 
						// Successfully logged in, set the session and redirect
						$this->session->set_userdata(array('UID'=>sha1($username)));
						redirect('/');
						
					}
				}
				else
				{ // Failed form validation
				
					$flashdata = array('message'=>'Invalid username or password.');
					$this->session->set_flashdata($flashdata);
					redirect('/');
				}
			}
			else
			{
				// Load the view
				$this->load->view('home',$this->outputData);
			}
		}
		else
		{ // We are logged in
			redirect('/manager');
		}
		
		
		
	} // End of function index
	
	function logout()
	{
		logout();
		redirect('/');
		
	} // End of function logout
	
	function error404()
	{
		$this->outputData['page_title'] = 'Page Not Found';
		
		$this->load->view('error404',$this->outputData);
		
	} // End of function error404
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
