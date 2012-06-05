<p id="input" style="display:none;">
		<img src="<? base_url(); ?>media/img/brock.jpg" /><br/>
		hey brockie, can you shorten this link for me?
		<input type="text" name="url" id="url" />
		<input type="submit" value="shorten" id="submit"/>
</p>

<p id="loader">
	<img src="<? base_url(); ?>media/img/ajax-loader.gif"/>
</p>

<p id="output" style="display:none;">
		<img src="<? base_url(); ?>media/img/other_brock.jpg" /><br/>
		sure thing other brockie! here you go <span id="short_url"></span>, would you like another?<br/>
		<a href="<? base_url() ?>">yes</a> / <a href="#" onclick="no();">no</a>
</p>



<script>
$(document).ready(function() {

	//initally show the input box
	$('#input').show();
	$('#loader').hide();
	$('#output').hide();
	
	
	//override the submission
	$('#submit').click(function(){
		
		//make an ajax request to submit the form, showing the loader and unclickable div
		$('#loader').show();
		$('#input').hide();
		
		//the url we want to shorten
		var url = $('#url').val();

		//get to work        
		$.post("/main/new_link", { "url" : url }, function(data){ 
			$('#loader').hide();
			
			if(data.response == "success")
			{
				$('#short_url').html("<b>" + data.short_url + "<b>");
			}
			else
			{
				alert(data.error_message);
			}
			$('#output').show();
			
		}, "json"); 
    }); 
});

function no()
{
	alert("all good. come back whenever you need a url shortened.");
	return false;
}
</script>
