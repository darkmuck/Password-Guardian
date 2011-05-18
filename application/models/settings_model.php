<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Settings_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        
        // Load the encryption helper
        $this->load->helper('encryption_helper');
        
    } // End of constructor
    
    function generateMasterKey($pass)
    {
		// Returns binary!
		// function generateKey is in helpers/encryption_helper.php
		return generateKey($pass);
		
	} // End of function generateMasterKey
	
	
	function getMasterPassword()
	{
		return $this->db->from('settings')->where(array('Key'=>'MasterPassword'))->get()->row()->Value;
		
	} // End of function getMasterPassword
	
	
	function setMasterPassword($pass)
	{
		// function preparePassword is in helpers/encryption_helper.php
		$this->db->where(array('Key'=>'MasterPassword'))->update('settings',array('Value'=>preparePassword($pass)));
		
	} // End of function setMasterPassword
	
	function getPassword()
	{
		return $this->db->from('settings')->where(array('Key'=>'UserPassword'))->get()->row()->Value;
		
	} // End of function getPassword
	
	function setPassword($pass)
	{
		// function preparePassword is in helpers/encryption_helper.php
		$this->db->where(array('Key'=>'UserPassword'))->update('settings',array('Value'=>preparePassword($pass)));
		
	} // End of function setPassword
	
	function login($username,$password)
	{
		$db_username = $this->db->from('settings')->where(array('Key'=>'UserName'))->get()->row()->Value;
		$db_password = $this->db->from('settings')->where(array('Key'=>'UserPassword'))->get()->row()->Value;
		
		
		if($username == $db_username)
		{
			// function preparePassword is in helpers/encryption_helper.php
			if (preparePassword($password) == $db_password)
			{
				return true;
			}
		}
		
		return false;
		
	} // End of function login
	
    
    
} // End of class Settings_model
