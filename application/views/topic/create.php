<?php 
//--R&D@Oct-29-2013
$multi_lang = 'en';
if(!isset($_SESSION)) {session_start();}
if(isset($_SESSION['multi_lang'])){$multi_lang = $_SESSION['multi_lang'];}else{$multi_lang = 'en';	}
$this->load->model(array('lookup_model'));
$arrVal 	= $this->lookup_model->getValue('386', $multi_lang);
$lSUPPORT   = @$arrVal[$multi_lang];


$arrVal 	= $this->lookup_model->getValue('418', $multi_lang);
$lNO_RECORDS   = @$arrVal[$multi_lang];


$arrVal 	= $this->lookup_model->getValue('387', $multi_lang);
$lFORUM   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('388', $multi_lang);
$lTUTOR_RESOURCES   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('414', $multi_lang);
$lFAQ   = @$arrVal[$multi_lang];


$arrVal 	= $this->lookup_model->getValue('389', $multi_lang);
$lENTER_KEYWORD   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('390', $multi_lang);
$lSEARCH   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('391', $multi_lang);
$lFORUM_HEAD   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('392', $multi_lang);
$lADD_AN_ASSUE   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('393', $multi_lang);
$lIN   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('394', $multi_lang);
$lEVERY_WHERE   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('395', $multi_lang);
$lTITLE   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('396', $multi_lang);
$lMESSAGE   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('397', $multi_lang);
$lAUTHOR   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('398', $multi_lang);
$lTAGS   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('399', $multi_lang);
$lDESCRIPTION   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('400', $multi_lang);
$lREPLIES   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('401', $multi_lang);
$lUPDATED   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('402', $multi_lang);
$lON   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('403', $multi_lang);
$lBY   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('404', $multi_lang);
$lLAST_ENTRY   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('405', $multi_lang);
$lTOPIC   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('406', $multi_lang);
$lTHREAD   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('407', $multi_lang);
$lQUOTE   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('408', $multi_lang);
$lBACK_TO_TOP   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('409', $multi_lang);
$lNOTIFY   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('410', $multi_lang);
$lREPLY_THREAD   = @$arrVal[$multi_lang];

//$arrVal 	= $this->lookup_model->getValue('411', $multi_lang);
$arrVal 	= $this->lookup_model->getValue('187', $multi_lang);
$lSAVE   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('412', $multi_lang);
$lCANCEL   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('413', $multi_lang);
$lCATEGORY   = @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('416', $multi_lang);
$lCREATE_MESSAGE   = @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('419', $multi_lang);
$lCREATE_TOPIC   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('512', $multi_lang);
$lTOPIC_ERROR   = @$arrVal[$multi_lang];


$arrVal 	= $this->lookup_model->getValue('658', $multi_lang);
$lTTL_OFFICIAL   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('659', $multi_lang);
$lTTL_GENERAL   = @$arrVal[$multi_lang];


//--R&D@Oct-29-2013





$this->layout->appendFile('css',"css/terms.css");?>
<?php $this->layout->appendFile('css',"css/forum.css");?>
<div class="terms">
	<!--
	<div class="terms_top">
	
	<ul class="c3e6f8b" id="nav" style="top:180px;float:left;left:15%;">
	<li><a href="<?php echo base_url('/support/faqs');?>">FAQs</a></li>
	<li class="nav_sel"><a id="imLink" href="<?php echo base_url('/forum');?>">Instant Messaging</a></li>
	<li><a href="<?php echo base_url('/support/resources');?>"><?php if($this->session->userdata['roleId'] == 0){ echo 'Student ';}else { echo 'Tutor ';}?> Resources</a></li>
	</ul>
	
	</div>
	-->
			<div class="faqs-ttl content" style="font-size:12px;"><h2><a href="<?php echo base_url('/forum/');?>"><?php echo $lFORUM;?></a></h2></div>
	<div class="terms_mid" id="terms_mid">
	<div class="formtitle"><?php echo $lCREATE_TOPIC;?></div>
		<?php if ($notice = $this->session->flashdata('notification')):?>
		<p class="notice"><?=$notice;?></p>
		<?php endif;?>

		<form class="edit form1" id="topic_create" method="post" action="<?php echo site_url('forum/topic/save') ?>" style="width:850px;" onsubmit="return validateTopic();">
			<input type='hidden' name='tid' value="<?php echo $topic['tid'] ?>" />
				<div class="input nobottomborder" style="width:650px;">
					<div class="inputtext"><?php echo $lCATEGORY;?></div>
					<div class="inputcontent" style="width:415px;">
						<select name="category" id="category" style="width:360px;">
						<option value="TheTalklist - Official announcements"><?php echo $lTTL_OFFICIAL;?></option>
						<option value="General Discussion - Questions and help"><?php echo $lTTL_GENERAL;?></option>
						</select>
					</div>
				</div>
				
				<div class="input nobottomborder" style="width:650px;" >
					<div class="inputtext"><?php echo $lTITLE;?></div>
					<div class="inputcontent" style="width:415px;">
						<input type="text" name="title" id="title" value="<?php echo $topic['title'] ?>" class="input-text" style="width:350px;"/> <br />
					<p id="titleError" style="padding:10px 0px;color:red;display:none;"> <?php echo $lTOPIC_ERROR;?> </p> <br />
					</div>
				</div>

				
				
				
				
				
				<div class="input nobottomborder" style="width:850px;">
					<div class="inputtext"><?php echo $lDESCRIPTION;?></div>
					<div class="inputcontent">
						<textarea name="description" class="textarea" style="height: 100px;width:680px;"><?php echo $topic['description'] ?></textarea><br />
					</div>
				</div>				
				
			<input class="blu-btn" type="submit" name="submit" value="<?php echo $lSAVE;?>" style="cursor:pointer;margin-left:15px;" />
			<a class="blu-btn"href="<?php echo site_url( $this->session->userdata("last_uri")."/forum" )?>" style="height:28.5px"><?php echo $lCANCEL;?></a>
		</form>
	</div>
</div>
   <script type="text/javascript">
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
	
	function validateTopic(){
		if($( '#title' ).val() == ""){
		
		$( '#titleError' ).css('display','block');
			return false;
		}else{
		$( '#titleError' ).css('display','none');
			return true;
		}		
	}
	
	
	
	
	
	
	
	setInterval(function(){ updateUserActivityStatus();},2000);
    </script>