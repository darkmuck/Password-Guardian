<?php $this->load->view('common/header'); ?>

	<div id="content">
		This page doesn't exist. Try going to the <a href="<?php echo site_url(); ?>">main page</a><?php
		if (isset($_SERVER['HTTP_REFERER']))
			echo ', or return to the <a href="'.$_SERVER['HTTP_REFERER'].'">previous page</a>';
		echo '.';
		?>
		
	</div>
<?php $this->load->view('common/footer');?>
