<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manager extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		// Load libraries
		$this->load->library('session');
		
		// Load models
		$this->load->model('settings_model');
		$this->load->model('password_model');
		$this->load->model('categories_model');
		
		// Load helpers
		$this->load->helper('url');
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
		redirect ('/manager/passwords');

	} // End of function index
	
	function passwords()
	{
		// Load libraries
		$this->load->library('encrypt');
		$this->load->library('form_validation');
		$sublink = $this->uri->segment(3,0);
		
		if ($sublink == '')
		{
			$this->outputData['passwords'] = $this->password_model->getAllPasswords();
			
			if (!$this->outputData['passwords']) // There are no passwords
				unset($this->outputData['passwords']);
			
			$this->outputData['page_title'] = 'Passwords';
			$this->load->view('passwords',$this->outputData);
		}
		elseif ($sublink == 'add')
		{
			if ($this->input->post('act')=='new')
			{
				////////////////////////////////////////////////////////////////////
				$this->form_validation->set_rules('sitename', 'Site Name', 'required');
				$this->form_validation->set_rules('username', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|matches[password2]');
				$this->form_validation->set_rules('password2', 'Repeat Password', 'required|min_length[5]');
				$this->form_validation->set_rules('master', 'Master Password', 'required|callback__masterCheck');
				
				
				if (!$this->form_validation->run())
				{
					$this->outputData['categories'] = $this->categories_model->getAllCategories();
					$this->outputData['page_title'] = 'Add New Password';
					$this->load->view('newpassword',$this->outputData);
				}
				else
				{
					// All checks out, prepare the password
					// Function preparePassword() is in helpers/encryption_helper.php
					$sitename = $this->input->post('sitename');
					$username = $this->encrypt->encode($this->input->post('username'),$this->settings_model->generateMasterKey(preparePassword($this->input->post('master')).$this->config->item('password_salt')));
					$password = $this->encrypt->encode($this->input->post('password'),$this->settings_model->generateMasterKey(preparePassword($this->input->post('master')).$this->config->item('password_salt')));
					$category = $this->input->post('category');
					
					$this->password_model->addPassword($sitename,$username,$password,$category);
					
					
					redirect('/manager/passwords/');
				}
				
			}
			else
			{
				$this->outputData['categories'] = $this->categories_model->getAllCategories();
				$this->outputData['page_title'] = 'Add New Password';
				$this->load->view('newpassword',$this->outputData);
			}

		}
		elseif ($sublink == 'show')
		{
			// Show the decoded password
			$id = $this->uri->segment(4,0);
			
			// Check if this is a valid ID
			if (!$this->password_model->passwordExists($id))
				redirect('/manager/passwords/');
			
			$this->form_validation->set_rules('master', 'Master Password', 'required|callback__masterCheck');
			
			
			if (!$this->form_validation->run())
			{
				$this->outputData['page_title'] = 'Show Details';
				$this->load->view('showdetails',$this->outputData);
			}
			else
			{
				$pass = $this->password_model->getPassword($id);
				
				$username = $this->encrypt->decode($pass->Username,$this->settings_model->generateMasterKey($this->settings_model->getMasterPassword().$this->config->item('password_salt')));
				$password = $this->encrypt->decode($pass->Password,$this->settings_model->generateMasterKey($this->settings_model->getMasterPassword().$this->config->item('password_salt')));
				
				
				$details = array(
					'username'=>$username,
					'password'=>$password,
					'location'=>$pass->Location,
					'category'=>$pass->CategoryName
				);
				
				$this->outputData['details'] = $details;
				$this->outputData['page_title'] = 'Show Details';
				$this->load->view('showdetails',$this->outputData);
				
			}			
			
		}
		
	} // End of function passwords
	
	function settings()
	{	
		// Load libraries
		$this->load->library('encrypt');
		$this->load->library('form_validation');
		
		// Load helpers
		$this->load->helper('encryption_helper');
		
		
		// See which form is submitted
		
		if ($this->input->post('login'))
		{
			// Login update form
		
			$this->form_validation->set_rules('pass_old', 'Old Password', 'required');
			$this->form_validation->set_rules('pass_new', 'New Password', 'required|min_length[5]|matches[pass_new2]');
			$this->form_validation->set_rules('pass_new2', 'New Password (again)', 'required|min_length[5]');
			
			if (!$this->form_validation->run())
			{
				$this->outputData['page_title'] = 'Settings';
				$this->load->view('settings',$this->outputData);
			}
			else
			{
				// Let's check if the old password matches up
				if ($this->settings_model->getPassword() == preparePassword($this->input->post('pass_old')))
				{
				
					// All looks good, lets update the data
					$this->settings_model->setPassword($this->input->post('pass_new'));
					
					$flashdata = array('message'=>'Password updated.');
					$this->session->set_flashdata($flashdata);
					redirect('/manager/settings/');
					
				}
				else
				{
					// Old password didn't match
					$flashdata = array('message'=>'Old password did not match the database.');
					$this->session->set_flashdata($flashdata);
					redirect('/manager/settings/');
					
				}
			}
			
		}
		elseif ($this->input->post('master'))
		{
			// Master password form
			
			$this->form_validation->set_rules('master_old', 'Old Password', 'required');
			$this->form_validation->set_rules('master_new', 'New Password', 'required|min_length[5]|matches[master_new2]');
			$this->form_validation->set_rules('master_new2', 'New Password (again)', 'required|min_length[5]');
			
			if (!$this->form_validation->run())
			{
				$this->outputData['page_title'] = 'Settings';
				$this->load->view('settings',$this->outputData);
			}
			else
			{
				// Let's check if the old password matches up
				//
				// To do this, we get the sha1 sum'ed master password from the db,
				// Then get the old master password the user entered and sha1 sum it (with salt),
				// And finally, compare these
				if (preparePassword($this->input->post('master_old')) == $this->settings_model->getMasterPassword())
				{
				
					// First we need to decode and reencode ALL the passwords, so the new master password will be
					// able to unlock them.
					
					$passwords = $this->password_model->getAllPasswords();
					
					$master_old = $this->settings_model->getMasterPassword();
					$master_new = $this->input->post('master_new');
					foreach ($passwords as $p)
					{
						// Decode ...
						$username = $this->encrypt->decode($p->Username,$this->settings_model->generateMasterKey($master_old.$this->config->item('password_salt')));
						$password = $this->encrypt->decode($p->Password,$this->settings_model->generateMasterKey($master_old.$this->config->item('password_salt')));
						
						// ... and re-encode!
						$username = $this->encrypt->encode($username,$this->settings_model->generateMasterKey(preparePassword($master_new.$this->config->item('password_salt'))));
						$password = $this->encrypt->encode($password,$this->settings_model->generateMasterKey(preparePassword($master_new.$this->config->item('password_salt'))));
						
						$data = array(
							'Username' => $username,
							'Password' => $password,
							'Location' => $p->Location,
							'BelongsToCategory' => $p->BelongsToCategory
						);
						
						$this->password_model->updatePassword($p->ID,$data);
					}
					
					// All looks good, lets update the master password
					$this->settings_model->setMasterPassword($this->input->post('master_new'));
					
					$flashdata = array('message'=>'Master password updated.');
					$this->session->set_flashdata($flashdata);
					redirect('/manager/settings/');
					
				}
				else
				{
					// Old password didn't match
					$flashdata = array('message'=>'Old password did not match the database.');
					$this->session->set_flashdata($flashdata);
					redirect('/manager/settings/');
					
				}
			}
			
		}
		else
		{
			// Nothing has been submitted
			$this->outputData['page_title'] = 'Settings';
			$this->load->view('settings',$this->outputData);
		}
		
		
	} // End of function settings
	
	function categories ()
	{
		// Load models
		$this->load->model('categories_model');
		
		// Load libraries
		$this->load->library('form_validation');
		
		$sublink = $this->uri->segment(3,0);
		
		if ($sublink == '')
		{
			$this->outputData['allCategories'] = $this->categories_model->getAllCategories();
			if (empty($this->outputData['allCategories']))
				unset($this->outputData['allCategories']);
			
			$this->outputData['page_title'] = 'Categories';
			$this->load->view('categories',$this->outputData);
		}
		elseif ($sublink == 'add')
		{
			$this->form_validation->set_rules('categoryname', 'Category name', 'trim|required|xss_clean');
			
			if (!$this->form_validation->run())
			{
				$this->outputData['page_title'] = 'New Category';
				$this->load->view('category_new',$this->outputData);
			}
			else
			{
				// Category is valid, add it to the db
				$this->categories_model->addCategory($this->input->post('categoryname'));
				$flashdata = array('message'=>'Category created.');
				$this->session->set_flashdata($flashdata);
				redirect('/manager/categories/');
			}
			
		}
		elseif ($sublink == 'edit')
		{
			$id = $this->uri->segment(4,0);
			
			// Check if there is such an id
			if (empty($this->categories_model->getCategory($id)->ID))
				redirect('/manager/categories');
			
			$this->form_validation->set_rules('categoryname', 'Category name', 'trim|required|xss_clean');
			
			if (!$this->form_validation->run())
			{
				$this->outputData['category'] = $this->categories_model->getCategory($id);
				$this->outputData['page_title'] = 'Edit Category';
				$this->load->view('category_edit',$this->outputData);
			}
			else
			{
				// Category is valid, update it
				$this->categories_model->updateCategory($this->input->post('categoryid'),$this->input->post('categoryname'));
				$flashdata = array('message'=>'Category updated.');
				$this->session->set_flashdata($flashdata);
				redirect('/manager/categories/');
			}
		}
		elseif ($sublink == 'delete')
		{
			
		}
		else
		{
			redirect ('/manager/categories/');
		}
		
	} // End of function categories
	
	function _masterCheck ($pass)
	{
		// Check if the master password is entered correctly
		$master = $this->settings_model->getMasterPassword();
		
		if (sha1($pass)==$master)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('_masterCheck','Wrong master password.');
			return false;
		}
		
	} // End of function _masterCheck
	
}

/* End of file manager.php */
/* Location: ./application/controllers/manager.php */
