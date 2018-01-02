<?php $this->layout->appendFile('css',"css/terms.css");?>
<div class="terms">
    <div class="faqs-ttl" id="imLink">Instant Messaging</div>
	
	<div class="terms_top" id="imButton" style="float:left;height:auto">
	<input class="blue-btn" id="addIm" type="button" name="addIm" value="Send a message"><br/>
	
		<div class="imForm" style="display:none;">
			<form action="im/im_add" method="POST" name="imAddForm" id="imAddForm">
					<label id="successText" style="color:green;font-size:12px;display:none;"></label>
			<textarea  id="que" name="que" rows="5" cols="50" onblur="if (this.value=='') this.value = 'Enter your question'" onfocus="if (this.value=='Enter your question') this.value = ''">Enter your question</textarea><br/>
					<label id="searchQText" style="color:red;font-size:12px;display:none;">Please enter your message.</label>

			<input class="blue-btn" type="submit" value="Submit" name="newIm" id="newIm"><br/>
			</form>
		</div>
	</div>
	<br />

	<div class="terms_mid" id="terms_mid">

	<?php
	if($ims){
		$count = 1;
		foreach($ims as $im){   ?>
		<h1 style="height:auto;"><?php echo $count; ?>.&nbsp;&nbsp;<?php echo $im['que']; ?></h1>
		<p><?php echo $im['ans']; ?></p>
		<hr/>
		<?php  $count++;} 
	}else{
		echo '<h1>No Records Found. </h1>';
	}
	?>
	</div>
</div>
   <script type="text/javascript">
	$('#addIm').click(function(){
		$myele = $('.imForm');
		if($myele.is(':visible')){
			$('.imForm').slideUp();
			if($('#que').val() != 'Enter your question'){$('#que').val('');}
			$('#imButton').css('height,0px');
			
		}else{
			$('.imForm').slideDown();
			//$('#que').focus();
			if($('#que').val() != 'Enter your question'){$('#que').val('');}
			$('#imButton').css('height,300px');
		}
		return false;
	});


$( "#imAddForm" ).submit(function( event ) {
	event.preventDefault();
	var $form = $( this ),
	term = $('#que').val(),
		url = $form.attr( "action" );
		
		if(term != ""  && term != 'Enter your question'){
			$( '#searchQText' ).css('display','none');
			var posting = $.post( url, { que: term } );
			posting.done(function( data ) {
				if (String == data.constructor) {
					eval ('var json = ' + data);
				} else {
					var json = data;
				}
				if(json.succrmsg != ""){
					$( '#successText' ).css('display','block');
					$( '#successText' ).html(json.succrmsg);
				if($('#que').val() != 'Enter your question'){$('#que').val('Enter your question');}
				//$('#que').focus();
				}
			});
		}else{
			document.getElementById("que").focus();
			$( '#searchQText' ).css('display','block');
		}
});

    function updateUserActivityStatus(){
		var dataString = '';
				$.ajax({
					type	: "POST",
					url 	: "<?php echo base_url('/support/getuserpdatectivitytatus');?>",
					data	: dataString,
					cache	: false,
					success: function(html){ 
					//alert(html)
					if(html == "TRUE"){
						$('#imLink').html('Instant Messaging('+html+')');
					}else{
						$('#imLink').html('Instant Messaging('+html+')');
					}
					
					}
				});
	}
	setInterval(function(){ updateUserActivityStatus();},2000);
    </script>
	<!--JavaScripts to detect user's activity status: Ends-->

