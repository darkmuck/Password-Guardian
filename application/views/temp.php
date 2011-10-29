<?php $this->load->view('common/header'); ?>
<?php $this->load->view('common/navigation');?>
	<div id="content">
		
		
		
		<?php
					
		//Show any messages
		if($this->session->flashdata('message'))
		{
			echo '<div class="message">'.$this->session->flashdata('message').'</div>';
		}
		
		
		echo $x=$this->settings_model->getMasterKey();
		echo '<br/>'.$aaa;
		echo '<br/>'.$this->encrypt->decode($x,$aaa);
		
		echo '<form action ="'.site_url().'manager/settings/" method="post"><input type="text" name="password" /><input type="submit" value="Update Key" /></form>';
		
		?>
		
	</div>
<?php $this->load->view('common/footer');?>

