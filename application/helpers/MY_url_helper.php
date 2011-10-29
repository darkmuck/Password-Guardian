<?php

function css_url()
{
	// Returns the CSS path of the current theme
	$CI = &get_instance();
	return base_url().'themes/'.$CI->config->item('config_theme').'/css';
}

function js_url()
{
	// Returns the JavaScript path
	$CI = &get_instance();
	return base_url().'themes/'.$CI->config->item('config_theme').'/js';
}

function image_url()
{
	// Returns the image path
	$CI = &get_instance();
	return base_url().'themes/'.$CI->config->item('config_theme').'/images';
}

function action_url()
{
	// Returns the AJAX actions path
	return base_url().'actions/';
}

/* End of file MY_url_helper.php */
/* Location: ./application/helpers/MY_url_helper.php */
