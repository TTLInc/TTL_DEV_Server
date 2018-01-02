<?php 
	$arrVal 	= $this->lookup_model->getValue('544', $multi_lang);		$lSPEAK_EN_LIKE_NATIVE   	= $arrVal[$multi_lang];
	$arrVal 	= $this->lookup_model->getValue('549', $multi_lang);		$lCONNNECT_WITH_US  		= $arrVal[$multi_lang];
	$arrVal = $this->lookup_model->getValue('290', $multi_lang);
	$lcopyright = $arrVal[$multi_lang];
	$arrVal = $this->lookup_model->getValue('291', $multi_lang);
	$lallrightreserve = $arrVal[$multi_lang];
	$arrVal 	= $this->lookup_model->getValue('37', $multi_lang);
	$privacy_policy = $arrVal[$multi_lang];
	$arrVal 	= $this->lookup_model->getValue('133', $multi_lang);
	$terms		= $arrVal[$multi_lang];
	$arrVal 	= $this->lookup_model->getValue('10', $multi_lang);
	$contact	= $arrVal[$multi_lang];
	$arrVal 	= $this->lookup_model->getValue('17', $multi_lang);
	$about		= $arrVal[$multi_lang];
	$arrVal 	= $this->lookup_model->getValue('157', $multi_lang);
	$site		= $arrVal[$multi_lang];
	$arrVal 	= $this->lookup_model->getValue('816', $multi_lang);	$affiliate   		= $arrVal[$multi_lang];

?>

<div class="footer_main_wrapper">
	<div class="container">
		<div class="footer_inner_main01 cf">
			<div class="footer_inner_left01"><?php echo $lSPEAK_EN_LIKE_NATIVE;?></div>
			<div class="footer_inner_right01">
				<span><?php echo $lCONNNECT_WITH_US;?> :</span>
				<a href="https://www.linkedin.com/company/3126401?trk=tyah" class="ftr_social_icon03"></a>
				<a href="https://www.facebook.com/TheTalkList" class="ftr_social_icon01"></a>
				<a href="https://twitter.com/thetalklist" class="ftr_social_icon02"></a>
				
				<a href="https://www.youtube.com/user/TheTalkList" class="ftr_social_icon04"></a>
				<a href="<?php echo base_url('blog'); ?>" class="ftr_social_icon05"></a>
			</div>
		</div>
		
		<div class="footer_links">
			<span><?php echo $lcopyright;?><?php echo date("Y") ?> &copy; TheTalkList. &nbsp; <?php echo $lallrightreserve;?> </span>   
			<a href="<?php echo Base_Url('article/privacy');?>"><?php echo $privacy_policy;?></a>  
			<a href="<?php echo Base_Url('article/terms');?>"><?php echo $terms;?></a>    
			<a href="<?php echo Base_Url('article/contact');?>"><?php echo $contact;?></a> 
			<a href="<?php echo Base_Url('article/about');?>"><?php echo $about;?></a> 
			<a href="<?php echo Base_Url('affiliate/index');?>"><?php echo $affiliate;?></a> 
			<a href="<?php echo Base_Url('article/site_map');?>"><?php echo $site;?></a> 
		</div>
	</div>
</div>