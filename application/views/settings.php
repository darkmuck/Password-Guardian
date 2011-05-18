<?php $this->load->view('header'); ?>
<?php $this->load->view('navigation');?>
	<div id="content">
		<?php
					
		//Show any messages
		if($this->session->flashdata('message'))
		{
			echo '<div class="message">'.$this->session->flashdata('message').'</div>';
		}
		
		if (validation_errors())
			echo '<div class="message">'.validation_errors().'</div>';
		?>
		<form action="<?php echo site_url().'manager/settings/'; ?>" method="post" class="left">
		<fieldset>
			<legend>Update Master Password</legend>
			<p>Warning: Changing the master password requires re-encoding ALL passwords in the system. This can take some time. Do NOT close/refresh the page!</p>
			<label for="master_old">Old Password</label>
			<input type="password" name="master_old" id="master_old" />
		</fieldset>
		<fieldset>
			<label for="master_new">New Password</label>
			<input type="password" name="master_new" id="master_new" />
		</fieldset>
		<fieldset>
			<label for="master_new2">New Password (again)</label>
			<input type="password" name="master_new2" id="master_new2" />
		</fieldset>
		<fieldset>
			<input type="hidden" name="master" value="master" />
			<input type="submit" value="Update" />
		</fieldset>
		</form>
		
		<form action="<?php echo site_url().'manager/settings/'; ?>" method="post" class="right">
		<fieldset>
			<legend>Update Login Details</legend>
			<label for="pass_old">Old Password</label>
			<input type="password" name="pass_old" id="pass_old" />
		</fieldset>
		<fieldset>
			<label for="pass_new">New Password</label>
			<input type="password" name="pass_new" id="pass_new" />
		</fieldset>
		<fieldset>
			<label for="pass_new2">New Password (again)</label>
			<input type="password" name="pass_new2" id="pass_new2" />
		</fieldset>
		<fieldset>
			<input type="hidden" name="login" value="login" />
			<input type="submit" value="Update" />
		</fieldset>
		</form>
		
	</div>
<?php $this->load->view('footer');?>

