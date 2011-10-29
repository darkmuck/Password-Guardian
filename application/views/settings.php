<?php $this->load->view('common/header'); ?>
<?php $this->load->view('common/navigation');?>
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
		<div class="frm-wrp left">
			<form action="<?php echo site_url().'manager/settings/'; ?>" method="post" class="left">
			<fieldset>
				<legend>Update Master Password</legend>
				<p>Warning: Changing the master password requires re-encoding ALL passwords in the system. This can take some time. Do NOT close/refresh the page!</p>
				<div class="form-level">
					<div class="inputs">
						<label for="master_old">Old Password</label>
						<input type="password" name="master_old" id="master_old" />
					</div>
				</div>
			</fieldset>
			<fieldset>
				<div class="form-level">
					<div class="inputs">
						<label for="master_new">New Password</label>
						<input type="password" name="master_new" id="master_new" />
					</div>
				</div>
			</fieldset>
			<fieldset>
				<div class="form-level">
					<div class="inputs">
						<label for="master_new2">New Password (again)</label>
						<input type="password" name="master_new2" id="master_new2" />
					</div>
				</div>
			</fieldset>
			
			<fieldset class="submit">
				<input type="hidden" name="master" value="master" />
				<input type="submit" value="Update" />
			</fieldset>
			</form>
		</div>
		
		<div class="frm-wrp right">
			<form action="<?php echo site_url().'manager/settings/'; ?>" method="post" class="right">
			<fieldset>
				<legend>Update Login Details</legend>
				<div class="form-level">
					<div class="inputs">
						<label for="pass_old">Old Password</label>
						<input type="password" name="pass_old" id="pass_old" />
					</div>
				</div>
			</fieldset>
			<fieldset>
				<div class="form-level">
					<div class="inputs">
						<label for="pass_new">New Password</label>
						<input type="password" name="pass_new" id="pass_new" />
					</div>
				</div>
			</fieldset>
			<fieldset>
				<div class="form-level">
					<div class="inputs">
						<label for="pass_new2">New Password (again)</label>
						<input type="password" name="pass_new2" id="pass_new2" />
					</div>
				</div>
			</fieldset>
			
			<fieldset class="submit">
				<input type="hidden" name="login" value="login" />
				<input type="submit" value="Update" />
			</fieldset>
			</form>
		</div>
	</div>
<?php $this->load->view('common/footer');?>

