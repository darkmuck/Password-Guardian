<div id="footer">
		<p>&copy; 2010 - 2011 <strong><?php echo $this->config->item('site_title'); ?></strong></p>
</div>

</div><!--wrapper -->

<script type="text/javascript">
$(document).ready(function() {
	$('#gen_pass').click(function() {
		generatePassword();
		return false;
	});
});

function generatePassword()
{
	$.ajax(
	{
		type: "POST",
		url: actionurl+"password/generate",
		data: "",
		success: function(response)
		{
			$('<div></div>').html('Copy &amp; paste this: '+response).dialog({title: 'Generated Password', modal:true });
			
		}
	});
};
</script>
</body>
</html>
