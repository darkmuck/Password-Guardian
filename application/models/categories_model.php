<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Categories_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    } // End of constructor
    
    function getAllCategories()
    {
		return $this->db->from('categories')->get()->result();
		
	} // End of function getAllCategories
    
    function addCategory($cat)
    {
		$this->db->insert('categories',array('Name'=>$cat));
		
	} // End of function addCategory
	
	function getCategory($id)
	{
		return $this->db->from('categories')->where(array('ID'=>$id))->get()->row();
		
	} // End of function getCategory
	
	function updateCategory($id,$cat)
	{
		$this->db->where('ID',$id)->update('categories',array('Name'=>$cat));
		
	} // End of function updateCategory
	
} // End of class Categories_model
