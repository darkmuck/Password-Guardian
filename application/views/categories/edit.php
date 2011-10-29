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
			<form action="<?php echo site_url().'manager/categories/edit/'.$category->ID.'/'; ?>" method="post" class="centered">
			<fieldset>
				<legend>Edit Category</legend>
				
				<div class="form-level">
					<div class="inputs">
						<label for="category_name">Name</label>
						<input type="text" name="categoryname" id="category_name" value="<?php echo $category->Name; ?>" />
					</div>
					<div class="actions">
					</div>
				</div>
			</fieldset>
			
			<fieldset class="submit">
				<input type="hidden" name="categoryid" value="<?php echo $category->ID; ?>" />
				<input type="submit" value="Submit" />
			</fieldset>
			</form>
		</div>
		
		
	</div>
<?php $this->load->view('footer');?>

