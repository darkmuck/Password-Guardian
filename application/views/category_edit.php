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
		<form action="<?php echo site_url().'manager/categories/edit/'.$category->ID.'/'; ?>" method="post" class="centered">
		<fieldset>
			<legend>Edit Category</legend>
			<label for="category_name">Name</label>
			<input type="text" name="categoryname" id="category_name" value="<?php echo $category->Name; ?>" />
		</fieldset>
		<fieldset>
			<input type="hidden" name="categoryid" value="<?php echo $category->ID; ?>" />
			<input type="submit" value="Submit" />
		</fieldset>
		</form>
		
		
		
	</div>
<?php $this->load->view('footer');?>

