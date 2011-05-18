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
		
		if (!isset($details))
		{
			// Show unlock form
		?>
		<form action="" method="post" class="centered">
		<fieldset>
			<legend>Unlock Details</legend>
			<label for="master">Master Password</label>
			<input type="text" name="master" id="master" />
		</fieldset>
		<fieldset>
			<input type="submit" value="Submit" />
		</fieldset>
		</form>
		
		<?php
		
		}
		else
		{
			echo '<table><th>Website</th><th>Username</th><th>Password</th><th>Category</th>';
			echo '<tr><td>'.$details['location'].'</td><td>'.$details['username'].'</td><td>'.$details['password'].'</td><td>'.$details['category'].'</td></tr>';
			echo '</table>';
			
			echo '<p><a href="'.site_url('/manager/passwords/').'">Go Back</a></p>';
		}
		?>
		
	</div>
<?php $this->load->view('footer');?>

