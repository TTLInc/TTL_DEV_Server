<?php $this->layout->setLayoutData('content_for_layout_title','Newsletter Templates');?>

<?php if(@$errormsg):?>
 <div class="notice_4" id="errormsg">
	<span class="notice_icon"></span> 
	<a class="close" href="javascript:void(0);" onclick="$('#errormsg').hide()">
		<img src="<?php echo base_url('images/cross_grey_small.png');?>" />
	</a>
	<p><?php echo $errormsg; ?></p>
</div>
<?php endif;?>
<form method="post" action="" name="articleform" id="articleform" >  
	<p style="color:green;font-size:14px;">use <span style="color:black;">{$name}</span> for put user firstname and lastname in your template.</p>
	
	</br>
	<p style="color:green;font-size:14px;">use <span style="color:black;">{$affiliatelink}</span> for put user affiliatelink in your template.</p>
	</br>
	<p style="color:green;font-size:14px;">use <span style="color:black;">{$date}</span> for date-time.</p>
	</br>
	<p class="ft_title">If Tutor doesn't have open calendar sessions for last 2 weeks, send weekly email reminder.</p>
    <p class="setft">
    	<textarea name="n1" id="n1" cols="80" rows="5"><?php echo @$newsletter['n1']; ?></textarea>
    	
   	</p>
    <!--<p class="ft_title">If Potential Tutor took first test but has not taken retest., send weekly email reminder.</p>
    <p class="setft">
    	<textarea name="n2" id="n2" cols="80" rows="5"><?php echo @$newsletter['n2']; ?></textarea>
    	
   	</p>-->
   	<p class="ft_title"> If New student has registered but not taken a group session.</p>
    <p class="setft">
    	<textarea name="n3" id="n3" cols="80" rows="5"><?php echo @$newsletter['n3']; ?></textarea>
    </p>
	<p class="ft_title">If student has taken free group session but has not loaded their account with credits, send weekly email reminder.</p>
    <p class="setft">
    	<textarea name="n4" id="n4" cols="80" rows="5"><?php echo @$newsletter['n4']; ?></textarea>
    </p>
	<p class="ft_title">If Student has not booked a session for last 2 weeks, send weekly email reminder</p>
    <p class="setft">
    	<textarea name="n5" id="n5" cols="80" rows="5"><?php echo @$newsletter['n5']; ?></textarea>
    </p>
	<p class="ft_title">Send affiliate text message. Affiliate # will be generated using member # as reference </p>
    <p class="setft">
    	<textarea name="n6" id="n6" cols="80" rows="5"><?php echo @$newsletter['n6']; ?></textarea>
    </p>	
	<p class="ft_title">If New student has registered but not taken a free session.</p>
    <p class="setft">
    	<textarea name="n7" id="n7" cols="80" rows="5"><?php echo @$newsletter['n7']; ?></textarea>
    </p>
	<!--<p class="ft_title">Tutors whose Gold membership is expiring in 3 days</p>
    <p class="setft">
    	<textarea name="n8" id="n8" cols="80" rows="5"><?php echo @$newsletter['n8']; ?></textarea>
    </p>-->
	<p class="ft_title">Message every week when tutor has incomplete profile</p>
    <p class="setft">
    	<textarea name="n9" id="n9" cols="80" rows="5"><?php echo @$newsletter['n9']; ?></textarea>
    </p>
	<p class="ft_title">Student message for Request Session Timeout</p>
    <p class="setft">
    	<textarea name="n10" id="n10" cols="80" rows="5"><?php echo @$newsletter['n10']; ?></textarea>
    </p>
	<p class="ft_title">Tutor message for Request Session Timeout</p>
    <p class="setft">
    	<textarea name="n11" id="n11" cols="80" rows="5"><?php echo @$newsletter['n11']; ?></textarea>
    </p>
	<p class="ft_title">Accounts created but not validated</p>
    <p class="setft">
    	<textarea name="n12" id="n12" cols="80" rows="5"><?php echo @$newsletter['n12']; ?></textarea>
    </p>
	<input type="hidden" name="id" id="id" value="<?php echo @$newsletter['id']; ?>" />
    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">update</a></p>
</form>
<script type="text/javascript">
function checkform(){
	$('#articleform').submit();
}
setTimeout('showmenu("pcontent",9)',1000);
</script>
</body>
</html>