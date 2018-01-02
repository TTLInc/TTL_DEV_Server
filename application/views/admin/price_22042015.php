<?php $this->layout->setLayoutData('content_for_layout_title','Static Article Change');?>

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
	<p class="ft_title"><?php echo $config['VEE_PRICE_PERCENT']['desc'];?></p>
    <p class="setft">
    	<input type="text" name="config[0][value]" id="title" value="<?php echo $config['VEE_PRICE_PERCENT']['value'];?>"  class="adm_box1" />
    	<input type="hidden" name="config[0][key]" id="title" value="VEE_PRICE_PERCENT"  class="adm_box1" />
   		<input type="hidden" name="config[0][id]" id="title" value="<?php echo $config['VEE_PRICE_PERCENT']['id'];?>"  class="adm_box1" />
   	</p>
    <p class="ft_title"><?php echo $config['LES_PRICE_PERCENT']['desc'];?></p>
    <p class="setft">
    	<input type="text" name="config[1][value]" id="title" value="<?php echo $config['LES_PRICE_PERCENT']['value'];?>"  class="adm_box1" />
    	<input type="hidden" name="config[1][key]" id="title" value="LES_PRICE_PERCENT"  class="adm_box1" />
   		<input type="hidden" name="config[1][id]" id="title" value="<?php echo $config['LES_PRICE_PERCENT']['id'];?>"  class="adm_box1" />
   	</p>
   	<p class="ft_title"><?php echo $config['MON_PRICE']['desc'];?></p>
    <p class="setft">
    	<input type="text" name="config[2][value]" id="title" value="<?php echo $config['MON_PRICE']['value'];?>"  class="adm_box1" />
    	<input type="hidden" name="config[2][key]" id="title" value="MON_PRICE"  class="adm_box1" />
   		<input type="hidden" name="config[2][id]" id="title" value="<?php echo $config['MON_PRICE']['id'];?>"  class="adm_box1" />
   	</p>

	
	<!--R&D@Oct-09-2013 : Currency to TTL credit Conversion-->
   	<p class="ft_title"><?php echo $config['USD_TO_TTL']['desc'];?></p>
    <p class="setft">
    	<input type="text" name="config[3][value]" id="title" value="<?php echo $config['USD_TO_TTL']['value'];?>"  class="adm_box1" />
    	<input type="hidden" name="config[3][key]" id="title" value="USD_TO_TTL"  class="adm_box1" />
   		<input type="hidden" name="config[3][id]" id="title" value="<?php echo $config['USD_TO_TTL']['id'];?>"  class="adm_box1" />
   	</p>

   	<p class="ft_title"><?php echo $config['RBM_TO_TTL']['desc'];?></p>
    <p class="setft">
    	<input type="text" name="config[4][value]" id="title" value="<?php echo $config['RBM_TO_TTL']['value'];?>"  class="adm_box1" />
    	<input type="hidden" name="config[4][key]" id="title" value="RBM_TO_TTL"  class="adm_box1" />
   		<input type="hidden" name="config[4][id]" id="title" value="<?php echo $config['RBM_TO_TTL']['id'];?>"  class="adm_box1" />
   	</p>
	<!--R&D@Oct-09-2013 : Currency to TTL credit Conversion-->
	
	<p class="ft_title"><?php echo $config['Affiliate_pay_percentage']['desc'];?></p>
    <p class="setft">
    	<input type="text" name="config[5][value]" id="title" value="<?php echo $config['Affiliate_pay_percentage']['value'];?>"  class="adm_box1" />
    	<input type="hidden" name="config[5][key]" id="title" value="Affiliate_pay_percentage"  class="adm_box1" />
   		<input type="hidden" name="config[5][id]" id="title" value="<?php echo $config['Affiliate_pay_percentage']['id'];?>"  class="adm_box1" />
   	</p>
	
	
	<p class="ft_title"><?php echo $config['Member_pay_percentage']['desc'];?></p>
    <p class="setft">
    	<input type="text" name="config[6][value]" id="title" value="<?php echo $config['Member_pay_percentage']['value'];?>"  class="adm_box1" />
    	<input type="hidden" name="config[6][key]" id="title" value="Member_pay_percentage"  class="adm_box1" />
   		<input type="hidden" name="config[6][id]" id="title" value="<?php echo $config['Member_pay_percentage']['id'];?>"  class="adm_box1" />
   	</p>
	
	<p class="ft_title"><?php echo $config['School_pay_percentage']['desc'];?></p>
    <p class="setft">
    	<input type="text" name="config[7][value]" id="title" value="<?php echo $config['School_pay_percentage']['value'];?>"  class="adm_box1" />
    	<input type="hidden" name="config[7][key]" id="title" value="School_pay_percentage"  class="adm_box1" />
   		<input type="hidden" name="config[7][id]" id="title" value="<?php echo $config['School_pay_percentage']['id'];?>"  class="adm_box1" />
   	</p>

    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a></p>
</form>


<script type="text/javascript">
function checkform(){
	$('#articleform').submit();
}
setTimeout('showmenu("price",0)',1000);
</script>
</body>
</html>