$(document).ready(function(){
	var derpyMath;
	var animCanRun = true;
	var value;
	
	derpyMath = {
		'onChange' : function() {
			if($("#amount").val() == "0"){
				$('#otherammount').remove();
				derpyMath.remove();
				$('#derpymath').append('<img src="/images/sadderpy.png" id="sadderpy" />');
			}
			else if($("#amount").val() == "other"){
				derpyMath.remove();
				$('#ammountinput').append('<input type="input" id="otherammount" />');
				$("#otherammount").change(function(){
					if($("#otherammount").val() > 0){
						value = $("#otherammount").val();
						derpyMath.animation();
					}
				});
			}
			else{
				$('#otherammount').remove();
				value = $('#amount').val();
				derpyMath.animation();
			}
		}
		,'animation' : function() {
			if(!animCanRun)
				return;
			animCanRun = false;
			derpyMath.remove();
			$('#donate').append("<input type=\"hidden\" id=\"totalamount\" name=\"amount\" value=" + value + ">");
			$('#derpymath').append('<section id="derpytitle" class="derpytext"></section>');
			$('#derpytitle').hide().text('DerpyMath').fadeIn('slow', function(){
				$('#derpymath').append('<span id="derpyspan" class="derpytext"></span>');
				$('#derpyspan').append('<img id="muffin" src="/images/muffin.png" />');
				$('#muffin').hide().fadeIn('slow', function(){
					$('#derpyspan').append('<span id="plus" class="mathtext">+</span>');
					$('#plus').hide().fadeIn('slow', function(){
						$('#derpyspan').append('<img id="nomderpy" src="/images/nom.gif" />');
						$('#nomderpy').hide().fadeIn('slow', function(){
							$('#derpyspan').append('<span id="equals" class="mathtext">=</span>');
							$('#equals').hide().fadeIn('slow', function(){
								$('#derpyspan').append('<img id="happyderpy" src="/images/happyderpy.png" />');
								$('#happyderpy').hide().fadeIn('slow', function(){
									$('#donateform').append('<div id="button" class="rounded_corner">Donate!</div>');
									$('#button').hide().fadeIn('slow');
									$('#button').click(function(){$('#donate').submit();});
								});
							});
						});
					});
				});
			});
			window.setTimeout(function() { animCanRun = true }, 800);
		}
		,'remove' : function() {
			$('#derpytitle').remove();
			$('#derpyspan').remove();
			$('#button').remove();
			$('#sadderpy').remove();
			$('#totalamount').remove();
		}
		
	};
	$("#amount").change(derpyMath.onChange);
});