<?php $this->load->view('header'); ?>

	<div id="content">
		<?php
					
		//Show any messages
		if($this->session->flashdata('message'))
		{
			echo '<div class="message">'.$this->session->flashdata('message').'</div>';
		}
		?>
		
			<div id="login">
				<form action="" method="post">
					<fieldset class="login">
						<label for="username">Username</label>
						<input type="text" name="username" id="username" />
					</fieldset>
					<fieldset class="login">
						<label for="password">Password</label>
						<input type="password" name="password" id="password" />
					</fieldset>
					<fieldset class="submit">
						<input type="submit" name="submit" value="Login" />
					</fieldset>
				</form>
			</div>
	</div>
<?php $this->load->view('footer');?>

