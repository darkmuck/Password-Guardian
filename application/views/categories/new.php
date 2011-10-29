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
			<form action="<?php echo site_url().'manager/categories/add'; ?>" method="post" class="centered">
			<fieldset>
				<legend>New Category</legend>
				
				<div class="form-level">
					<div class="inputs">
						<label for="category_name">Name</label>
						<input type="text" name="categoryname" id="category_name" />
					</div>
					<div class="actions">
					</div>
				</div>
			</fieldset>
			
			<fieldset class="submit">
				<input type="submit" value="Submit" />
			</fieldset>
			</form>
		</div>
		
		
	</div>
<?php $this->load->view('footer');?>

