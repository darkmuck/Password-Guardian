<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Password extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		// Load libraries
		$this->load->library('session');
		
		// Load helpers
		$this->load->helper('session_helper');
        $this->load->helper('encryption_helper');
		
		// Get the login status
		$this->outputData['logged_in'] = loggedIn();
		
		if (!$this->outputData['logged_in'])
		{
			redirect('/');
		}
	}

	private $outputData = array();
	
	function index()
	{
		// Just go to passwords
		redirect ('/');

	} // End of function index
	
	function generate()
	{
		echo randomPassword();
		exit;
	}
	
	
}

/* End of file manager.php */
/* Location: ./application/controllers/manager.php */
