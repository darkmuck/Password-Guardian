<?php $this->load->view('common/header'); ?>
<?php $this->load->view('common/navigation');?>
	<div id="content">
		
		
		
		<?php
					
		//Show any messages
		if($this->session->flashdata('message'))
		{
			echo '<div class="message">'.$this->session->flashdata('message').'</div>';
		}
		?>
		
		<p>
			<a href="<?php echo site_url().'manager/passwords/add/'; ?>">Add New Password</a>
		</p>
		
		<?php
		if (isset($passwords))
		{
			echo '<table><th>Website</th><th class="w150">Category</th><th class="w230 center">Action</th>';
			
			$mark = array('odd','even');
			$i = 0;
			foreach ($passwords as $pass)
			{
				echo '<tr class="'.$mark[$i].'"><td>'.$pass->Location.'</td><td>'.$pass->CategoryName.'</td><td class="center"><a class="wide" href="'.site_url().'manager/passwords/show/'.$pass->ID.'">Show Details</a> <a class="wide" href="'.site_url().'manager/passwords/delete/'.$pass->ID.'">Delete</a></td></tr>';
				$i = 1 - $i;
			}
			
			
			echo '</table>';
		}
		?>
		
	</div>
<?php $this->load->view('common/footer');?>

