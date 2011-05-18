<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'themes/'.$this->config->item('config_theme').'/css/' ?>screen.css" />
<title><?php if(isset($page_title)) {echo $page_title.' / ';}?><?php echo $this->config->item('site_title');?></title>
<?php
if (isset($extraHeaders))
	echo $extraHeaders."\n";
?>
</head>
<body>

	<div id="header"><?php echo $this->config->item('site_title'); ?></div>
	<div id="wrapper">
