<?php $this->layout->setLayoutData('content_for_layout_title','Edit Multilingual');?>
<?php $slangId = $selectedLang['id']; ?>

<?php if(@$errormsg):?>
 <div class="notice_4" id="errormsg">
	<span class="notice_icon"></span> 
	<a class="close" href="javascript:void(0);" onclick="$('#errormsg').hide()">
		<img src="<?php echo base_url('images/cross_grey_small.png');?>" />
	</a>
	<p><?php echo $errormsg; ?></p>
</div>
<?php endif;?>

<form method="post" action="" name="articleform" id="articleform" enctype="multipart/form-data">
       <input type="hidden" name="id" id="id" value="<?php echo $lookup['id'];?>"  class="adm_box1" />
	<p class="ft_title">Name</p>
        <p class="setft"> <input type="text" name="name" id="name" value="<?php echo $lookup['name'];?>" class="adm_box1" style="width:33%" /></p>
<!--WDC COMMIT START 07-24-2013-->    
    <?php
    if($lookup['id'] == '188' || $lookup['id'] == '36' || $lookup['id'] == '22' || $lookup['id'] == '16')
    {
    ?>
<!--WDC COMMIT END 07-24-2013-->
    <p class="ft_title">English</p>
    <p class="setft"><?php echo $ckEditor->editor('en',$lookup['en']);?></p>
    
	<p class="ft_title"><?php echo $selectedLang['value']; ?></p>
    <p class="setft"><?php echo $ckEditor->editor($slangId,$lookup[$slangId]);?></p>
	<!--
    <p class="ft_title">Korean</p>
    <p class="setft"><?php echo $ckEditor->editor('kr',$lookup['kr']);?></p>
    
    <p class="ft_title">Chinese</p> 
    <p class="setft"><?php echo $ckEditor->editor('ch',$lookup['ch']);?></p>
    
    <p class="ft_title">Japanese</p>
    <p class="setft"><?php echo $ckEditor->editor('jp',$lookup['jp']);?></p>
	
    <p class="ft_title">Portuguese</p>
    <p class="setft"><?php echo $ckEditor->editor('pt',$lookup['pt']);?></p>
	
    <p class="ft_title">Chinese (Tradisional)</p>
    <p class="setft"><?php echo $ckEditor->editor('tw',$lookup['tw']);?></p>
	
    <p class="ft_title">Spanish</p>
    <p class="setft"><?php echo $ckEditor->editor('es',$lookup['es']);?></p>
	-->
	
    <!--WDC COMMIT START 07-24-2013-->
    <?php
    }
    else
    {
    ?>
    
    <p class="ft_title">English</p>
    <p class="setft"><textarea name="en" id="en" rows="5" cols="40" style="resize:none;"><?php echo $lookup['en'];?></textarea></p>
   
	<p class="ft_title"><?php echo $selectedLang['value']; ?></p>
    <p class="setft"><textarea name="<?php echo $slangId; ?>" id="<?php echo $slangId; ?>" rows="5" cols="40" style="resize:none;"><?php echo $lookup[$slangId];?></textarea></p>
    
    <!--
    <p class="ft_title">Korean</p>
    <p class="setft"><textarea name="kr" id="kr" rows="5" cols="40" style="resize:none;"><?php echo $lookup['kr'];?></textarea></p>
    
    <p class="ft_title">Chinese</p> 
    <p class="setft"><textarea name="ch" id="ch" rows="5" cols="40" style="resize:none;"><?php echo $lookup['ch'];?></textarea></p>
    
    <p class="ft_title">Japanese</p>
    <p class="setft"><textarea name="jp" id="jp" rows="5" cols="40" style="resize:none;"><?php echo $lookup['jp'];?></textarea></p>
	
    <p class="ft_title">Portuguese</p>
    <p class="setft"><textarea name="pt" id="pt" rows="5" cols="40" style="resize:none;"><?php echo $lookup['pt'];?></textarea></p>

    <p class="ft_title">Chinese (Tradisional)</p>
    <p class="setft"><textarea name="tw" id="tw" rows="5" cols="40" style="resize:none;"><?php echo $lookup['tw'];?></textarea></p>

    <p class="ft_title">Spanish</p>
    <p class="setft"><textarea name="es" id="es" rows="5" cols="40" style="resize:none;"><?php echo $lookup['es'];?></textarea></p>
	-->
	
	
	
	
    <?php
    }
    ?>
<!--WDC COMMIT START 07-24-2013-->
    <p class="setft">
       <a href="javascript:void(0)" onclick="checkform()" class="button">submit</a>&nbsp;
       <a href="javascript:void(0)" onclick="cancelform()" class="button">cancel</a>
    </p>
    
</form>


<script type="text/javascript">
function checkform(){
	$('#articleform').submit();
}

function cancelform(){
       window.location.href = '<?php echo $this->session->userdata('mlback');?>';
}
setTimeout('showmenu("langs",1)',1000);
</script>
</body>
</html>