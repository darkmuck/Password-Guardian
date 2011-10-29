<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="<?php echo css_url(); ?>/screen.css" />
<link rel="stylesheet" type="text/css" href="<?php echo css_url(); ?>/jquery-ui/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="<?php echo js_url(); ?>/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="<?php echo js_url(); ?>/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript">
var actionurl = '<?php echo action_url(); ?>';
</script>
<title><?php if(isset($page_title)) {echo $page_title.' / ';}?><?php echo $this->config->item('site_title');?></title>
<?php
if (isset($extraHeaders))
	echo $extraHeaders."\n";
?>
</head>
<body>

	<div id="header"><?php echo $this->config->item('site_title'); ?></div>
	<div id="wrapper">
