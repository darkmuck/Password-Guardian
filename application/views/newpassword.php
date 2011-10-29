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
		<div class="frm-wrp">
		<form action="<?php echo site_url().'manager/passwords/add/'; ?>" method="post" class="centered">
		<fieldset>
			<legend>New Password</legend>
			
				<div class="form-level">
					<div class="inputs">
						<label for="sitename">Site Name</label>
						<input type="text" name="sitename" id="sitename" value="<?php echo set_value('sitename'); ?>" />
					</div>
					<div class="actions">
					</div>
				</div>
				
				<div class="form-level">
					<div class="inputs">
						<label for="username">Username</label>
						<input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>" />
					</div>
					<div class="actions">
					</div>
				</div>
				
				<div class="form-level">
					<div class="inputs">
						<label for="password">Password</label>
						<input type="password" name="password" id="password" />
					</div>
					<div class="actions">
						
					</div>
				</div>
				
				<div class="form-level">
					<div class="inputs">
						<label for="password2">Repeat Password</label>
						<input type="password" name="password2" id="password2" />
					</div>
					<div class="actions">
					</div>
				</div>
				
				<div class="form-level">
					<div class="inputs">
						<label for="master">Master Password</label>
						<input type="password" name="master" id="master" />
					</div>
					<div class="actions">
					</div>
				</div>
				
				<div class="form-level">
					<div class="inputs">
						<label for="category">Category</label>
						<select name="category">
						<?php
							foreach ($categories as $category)
							{
								echo '<option value="'.$category->ID.'">'.$category->Name.'</option>'."\n";
							}
						
						?>
						</select>
					</div>
					<div class="actions">
					</div>
				</div>
			
		</fieldset>
		
		<fieldset class="submit">
			<input type="hidden" name="act" value="new" />
			<input type="submit" value="Submit" />
		</fieldset>
		</form>
		</div>
		
	</div>

<?php $this->load->view('footer');?>

