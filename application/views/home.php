<?php $this->load->view('common/header'); ?>

	<div id="content">
		<?php
		
		//Show any messages
		if($this->session->flashdata('message'))
		{
			echo '<div class="message">'.$this->session->flashdata('message').'</div>';
		}
		?>
		
		<div class="frm-wrp">
			<form action="" method="post">
				<fieldset>
					<div class="form-level">
						<div class="inputs">
							<label for="username">Username</label>
							<input type="text" name="username" id="username" />
						</div>
					</div>
				</fieldset>
				<fieldset>
					<div class="form-level">
						<div class="inputs">
							<label for="password">Password</label>
							<input type="password" name="password" id="password" />
						</div>
					</div>
				</fieldset>
				<fieldset class="submit">
					<input type="submit" name="submit" value="Login" />
				</fieldset>
			</form>
		</div>
	</div>
<?php $this->load->view('common/footer');?>

