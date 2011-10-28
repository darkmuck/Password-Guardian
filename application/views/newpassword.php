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
		<form action="<?php echo site_url().'manager/passwords/add/'; ?>" method="post" class="centered">
		<fieldset>
			<legend>New Password</legend>
			<label for="sitename">Site Name</label>
			<input type="text" name="sitename" id="sitename" value="<?php echo set_value('sitename'); ?>" />
			
			<label for="username">Username</label>
			<input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>" />
			
			<label for="password">Password</label>
			<input type="password" name="password" id="password" value="<?php echo set_value('password'); ?>" />
			
			<label for="password2">Repeat Password</label>
			<input type="password" name="password2" id="password2" value="<?php echo set_value('password2'); ?>" />
			
			<label for="master">Master Password</label>
			<input type="password" name="master" id="master" value="<?php echo set_value('master'); ?>" />
			
			<label for="category">Category</label>
			<select name="category">
			<?php
				foreach ($categories as $category)
				{
					echo '<option value="'.$category->ID.'">'.$category->Name.'</option>'."\n";
				}
			
			?>
			</select>
		</fieldset>
		
		<fieldset>
			<input type="hidden" name="act" value="new" />
			<input type="submit" value="Submit" />
		</fieldset>
		</form>
		
		
	</div>
<?php $this->load->view('footer');?>

