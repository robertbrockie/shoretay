<div id="input" style="display:none;">
		<p class="ballon">
			hey brockie, can you shorten this link for me?<br/>
			<input type="text" name="url" id="url" />
		</p>
		<img src="<? base_url(); ?>media/img/brock.jpg" />
</div>

<div id="loader">
	<img src="<? base_url(); ?>media/img/ajax-loader.gif"/>
</div>

<div id="output" style="display:none;">
		<p class="ballon">
			sure thing other brockie! here you go<br/>
			<span id="short_url"></span><br/>
			would you like another?<br/><br/>
			<span class="button"><a href="<? base_url() ?>">yes</a></span> / <span class="button"><a href="#" onclick="no();">no</a></span>
		</p>
		<img src="<? base_url(); ?>media/img/other_brock.jpg" />
</div>

<script>
$(document).ready(function() {

	//initally show the input box
	$('#input').show();
	$('#loader').hide();
	$('#output').hide();
	    
	//if we hit enter click the button
	$("#url").keyup(function(event)
	{
		if(event.keyCode == 13)
		{
			//make an ajax request to submit the form, showing the loader and unclickable div
			$('#loader').show();
			$('#input').hide();
		
			//the url we want to shorten
			var url = $('#url').val();

			//get to work        
			$.post("/main/new_link", { "url" : url }, function(data){ 			
				if(data.response == "success")
				{
					$('#loader').hide();
					$('#short_url').html("<b><a href='" + data.short_url + "' target='_blank'>" + data.short_url + "</a><b>");
					$('#output').show();
				}
				else
				{
					$('#output').hide();
					alert(data.error_message);
					$('#loader').hide();
					$('#input').show();

				}
			
			}, "json");
		}
	});

});

function no()
{
	alert("all good. come back whenever you need a url shortened.");
	return false;
}
</script>
