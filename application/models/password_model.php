<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Password_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    } // End of constructor
    
    function addPassword($name,$username,$password,$category)
    {
		$data = array (
			'Location'=>$name,
			'Username'=>$username,
			'Password'=>$password,
			'BelongsToCategory'=>$category);
		$this->db->insert('passwords',$data);
	} // End of function addPasword
	
	function getAllPasswords()
	{
		$this->db->from('passwords');
		$this->db->select('passwords.*, categories.Name as CategoryName');
		$this->db->join('categories','categories.id = passwords.BelongsToCategory');
		
		$pass = $this->db->get();
		
		if ($pass->num_rows()<1)
		{
			return false;
		}
		return $pass->result();
	} // End of function getAllPasswords
    
    function getPassword($id,$masterkey)
    {
		$this->db->where(array('passwords.ID'=>$id));
		$this->db->select('passwords.*, categories.Name as CategoryName');
		$this->db->join('categories','categories.id = passwords.BelongsToCategory');
		$this->db->from('passwords');
		
		$pass = $this->db->get()->row();
		
		$username = $this->encrypt->decode($pass->Username,$masterkey);
		$password = $this->encrypt->decode($pass->Password,$masterkey);
		
		return array($username, $password, $pass->Location, $pass->CategoryName);
		
	} // End of function getPassword
	
	function passwordExists($id)
	{
		$this->db->from('passwords');
		$pass = $this->db->where(array('ID'=>$id))->get();
		
		if ($pass->num_rows()<1)
			return false;
		
		return true;
		
	} // End of function passwordExists
	
	function updatePassword($id,$data)
	{
		$this->db->where(array('ID'=>$id));
		$this->db->update('passwords',$data);
		
	} // End of function updatePassword
    
} // End of class Password_model
