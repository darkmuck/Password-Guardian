<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function loggedIn()
{
	$CI = &get_instance();
	return $CI->session->userdata('UID') ? true : false;

} // End of function loggedIn

function logout()
{
	$CI = &get_instance();
	$CI->session->unset_userdata('UID');
	
} // End of function logout

/* End of file session_helper.php */
/* Location: ./application/helpers/session_helper.php */

