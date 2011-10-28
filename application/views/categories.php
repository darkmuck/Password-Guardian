<?php $this->load->view('header'); ?>
<?php $this->load->view('navigation');?>
	<div id="content">
		
		
		<?php
		//Show any messages
		if($this->session->flashdata('message'))
		{
			echo '<div class="message">'.$this->session->flashdata('message').'</div>';
		}
		?>
		
		
		
		<?php
			if (isset($allCategories))
			{
				$mark = array('odd','even');
				$i = 0;
				echo '<table><th>Category Name (<a class="whitelink" href="'.site_url().'manager/categories/add">Add New Category</a>)</th><th class="center">Edit</th><th class="center">Delete</th>';
				foreach ($allCategories as $category)
				{
					echo '<tr class="'.$mark[$i].'"><td class="full leftmost">'.$category->Name.'</td><td><a href="'.site_url().'manager/categories/edit/'.$category->ID.'">Edit</a></td><td class="rightmost"><a href="'.site_url().'manager/categories/delete/'.$category->ID.'">Delete</a></td></tr>';
					
					$i = 1 - $i;
				}
				echo '</table>';
			}
			else
			{
				echo '<p><a href="'.site_url().'manager/categories/add">Add New Category</a></p>';
			}
		?>
		
	</div>
<?php $this->load->view('footer');?>

