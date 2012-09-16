var jVal;

$(document).ready(function(){

	var usernamepattern = new RegExp("[@(),;:<>[]");
	var emailpattern = new RegExp("^[_A-Za-z0-9-]+(\\.[_A-Za-z0-9-]+)*@[A-Za-z0-9]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$");
	
	jVal = {
	
		'username' : function() {

			$('#errorwrapper').append('<div id="usernameinfo" class="info"></div>');
			
			var info = $('#usernameinfo');
			var ele = $('#username');
			
			if((ele.val().length < 3) && (ele.val().length != 0)){
				info.removeClass('correct').addClass('error').html('&larr; at least 3 characters').show();
				return false;
			}
			else if(ele.val().length == 0){
				info.removeClass('correct').removeClass('error').removeClass('normal').html('@derpymail.co.uk').show();
				return false;
			}
			else if(usernamepattern.test(ele.val())){
				info.removeClass('correct').addClass('error').html('&larr; Not valid email name').show();
				return false;
			}
			info.removeClass('error').addClass('correct').html('@derpymail.co.uk').show();
			return true;
		}

		,'bmail' : function() {
		
			$('#errorwrapper').append('<div id="bmailinfo" class="info"></div>');
			
			var info = $('#bmailinfo');
			var ele = $('#bmail');
			
			console.log(ele.val());

			if(ele.val().length < 5){
				info.removeClass('correct').addClass('error').html('&larr; at least 5 characters').show();
				return false;
			}
			else if(!emailpattern.test(ele.val())){
				info.removeClass('correct').addClass('error').html('&larr; Not valid email adress').show();
				return false;
			}
			info.removeClass('error').addClass('correct').html('&radic;').show();
			return true;
		}
		
		,'squestion' : function() {
		
			$('#errorwrapper').append('<div id="squestioninfo" class="info"></div>');
			
			var info = $('#squestioninfo');
			var ele = $('#squestion');
			
			if(ele.val().length < 4){
				info.removeClass('correct').addClass('error').html('&larr; at least 4 characters').show();
				return false;
			}
			info.removeClass('error').addClass('correct').html('&radic;').show();
			return true;
		}
		
		,'sanswer' : function() {
		
			$('#errorwrapper').append('<div id="sanswerinfo" class="info"></div>');
			
			var info = $('#sanswerinfo');
			var ele = $('#sanswer');
			
			if(ele.val().length < 4){
				info.removeClass('correct').addClass('error').html('&larr; at least 4 characters').show();
				return false;
			}
			info.removeClass('error').addClass('correct').html('&radic;').show();
			return true;
		}
		
		,'password' : function() {
		
			$('#errorwrapper').append('<div id="passwordinfo" class="info"></div>');
			
			var info = $('#passwordinfo');
			var ele = $('#password');
			
			if(ele.val().length < 5){
				info.removeClass('correct').addClass('error').html('&larr; at least 5 characters').show();
				return false;
			}
			else if(ele.val() == "password"){
				info.removeClass('correct').addClass('error').html('&larr; too easy to guess').show();
				return false;
			}
			info.removeClass('error').addClass('correct').html('&radic;').show();
			return true;
		}
		
		,'repassword' : function() {
		
			$('#errorwrapper').append('<div id="repasswordinfo" class="info"></div>');
			
			var info = $('#repasswordinfo');
			var ele = $('#repassword');
			
			if(ele.val() != $('#password').val()){
				info.removeClass('correct').addClass('error').html('&larr; passwords don\'t match').show();
				return false;
			}
			else if(ele.val() == ""){
				info.removeClass('correct').addClass('error').html('&larr; Password is blank').show();
				return false;
			}
			else if(ele.val().length < 5){
				info.removeClass('correct').addClass('error').html('&larr; at least 5 characters').show();
				return false;
			}
			info.removeClass('error').addClass('correct').html('&radic;').show();
			return true;
		}
		
		,'terms' : function() {
		
			$('#errorwrapper').append('<div id="termsinfo" class="info"></div>');
			
			var info = $('#termsinfo');
			var ele = $('#terms');

			if(!ele.is(':checked')){
				info.removeClass('correct').addClass('error').html('&larr; You need to agree to the terms to register to this site').show();
				return false;
			}
			info.removeClass('error').addClass('correct').html('&radic;').show();
			return true;
		}

		,'check' : function (){
			if(jVal.username() & jVal.bmail() & jVal.squestion() & jVal.sanswer() & jVal.password() & jVal.repassword() & jVal.terms())
				return true;
			return false;
		}

	}

	$('#username').change(jVal.username);
	$('#bmail').change(jVal.bmail);
	$('#squestion').change(jVal.squestion);
	$('#sanswer').change(jVal.sanswer);
	$('#password').change(jVal.password);
	$('#repassword').change(jVal.repassword);
	$('#terms').change(jVal.terms);
});
