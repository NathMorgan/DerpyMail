$(document).ready(function(){	
	var jVal;
	var remember = false;
	
	clientSelect = {
		'client':function(selection){
			clienttype = $('img',selection).attr("alt");
			if(remember)
				$.cookie("Derpymailclient", clienttype,{expires: 360});
			else
				$.cookie("Derpymailclient", clienttype);
			window.location = 'http://derpymail.co.uk/' + clienttype;
		}
	}
	
	$('.mailbox').click(function(){
		clientSelect.client($(this));
	});
	
	$('#remember').change(function(){
		if(remember)
			remember = false;
		else
			remember = true;
	});
});