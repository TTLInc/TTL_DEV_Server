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
$arrVal 	= $this->lookup_model->getValue('429', $multi_lang);
$lSAVE   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('412', $multi_lang);
$lCANCEL   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('413', $multi_lang);
$lCATEGORY   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('416', $multi_lang);
$lCREATE_MESSAGE   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('512', $multi_lang);
$lTOPIC_ERROR   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('515', $multi_lang);
$lLOGIN_TO_REPLY_THREAD   = @$arrVal[$multi_lang];


//--R&D@Oct-29-2013

$this->layout->appendFile('css',"css/terms.css");?>
<?php $this->layout->appendFile('css',"css/forum.css");?>
<div class="terms">
			<div class="faqs-ttl content" style="font-size:12px;"><h2><a href="<?php echo base_url('/forum/');?>"><?php echo $lFORUM;?></a></h2></div>
		<div class="terms_mid" id="terms_mid">
			<?php if ($notice = $this->session->flashdata('notification')):?>
			<p class="notice"><?=$notice;?></p>
			<?php endif;?>
			
			<!--<?php echo $lMESSAGE;?> : <?php echo $title;?><br/>-->
			

			<!--<div class="meta">
			<strong><?php echo $lTOPIC." :"; ?> </strong> <?php echo anchor('forum/topic/' . $topic['tid'], strip_tags($topic['title'])) ?><br />
			</div>-->
			<div class="meta frm-msg">

				<p><label><strong><?php echo $lTHREAD." :"; ?> </strong></label> 
                <span><?php echo strip_tags($messages['0']['title']) ?></span>
                </p>
                <p>
				<label><strong><?php echo " Author :"; ?> </strong></label> 
				<span><?php echo strip_tags($messages['0']['username']) ?></span>
                </p>
                <p>
				<label><strong><?php echo " Last Reply :"; ?> </strong></label>
                <span>
				<?php 
				//echo count($messages);
				$total = count($messages);
				$last  = $total - 1;
				echo strip_tags($messages[$last]['message']) 
				
				?>
                </span>
				</p>
			</div>

			
			<?php $i = 0; foreach ($messages as $row): $i++;?>
			<?php if ($i % 2 == 0) {$color = '#C0C0C0';}else{  $color = 'white';}?>
			<!--
			<table width="100%" class="forum-message" style="background:<?php echo $color;?>">
			<tbody>
			<tr>
			<td valign="top" class="message-header">
			<a name="<?php echo $row['mid'] ?>"> </a><?php echo $row['username'] ?> - <?php echo date( 'M d, Y | h:i a ' , outTime($row['date']) ); ?>
			<div style="float: right">
			</div>
			</td>
			</tr>
			<tr>
			<td valign="top" class="message-body">
			<?php echo nl2br(strip_tags($row['message'])) ?>
			</td>
			</tr>
			</tbody>
			</table>
			<br/>
			-->

<?php endforeach; ?> 

				
				
				
				
				
				
				
				
				
				
				
				
				
				<?php if($this->session->userdata('username') != "") : ?>
				
					<form class="edit form1" id="message-reply" method="post" action="<?php echo site_url('forum/message/save') ?>" style="width:850px;" onsubmit="return validateMessage();">
						<input type='hidden' name='pid' value="<?php echo $messages['0']['mid'] ?>" />
						<input type='hidden' name='tid' value="<?php echo $topic['tid'] ?>" />
					
							<div class="input nobottomborder frm-msg">
								<div class="inputtext"><?php echo $lREPLY_THREAD;?></div>
								<div class="inputcontent">
								<textarea id= "title" name="message" class="bbcode input-textarea" rows="10" cols="68" style="height: 100px;width:300px;"></textarea>
					<p id="titleError" style="padding:10px 0px;color:red;display:none;"> <?php echo $lTOPIC_ERROR;?> </p> <br />

								</div>
							</div>
							<!--
							<label for="notify"><?php echo $lNOTIFY." :" ?>
							<input type="checkbox" name="notify" value="Y" /> </label><br />
							-->
                            <div class="button-msg">
							<input type="submit" name="submit" value="<?php echo $lSAVE;?>" class="blu-btn" style="cursor:pointer;" />
							
							
							<?php if(isset($_GET['search'])) { ?>
							<a href="javascript:void(0)" class="blu-btn" style="height:28.5px;" onclick="history.go(-2)"><?php echo $lCANCEL;?></a>
							<?php }else{?>
							<a href="<?php echo base_url('/forum/topic/'.$topic['tid']);?>" class="blu-btn" style="height:28.5px;"><?php echo $lCANCEL;?></a>
							<?php } ?>
							
							</div>
							
							
							
							<?php //echo anchor('forum/message/reply/' . $messages['0']['mid'] , $lREPLY_THREAD) ?>

					</form>
					
					<?php else: ?>
					
					<p><?php echo $lLOGIN_TO_REPLY_THREAD;?></p>
					
					
					<?php endif;?>
					
					
					
					
					
					
					
					
					
			</div>

   <script type="text/javascript">
    /*
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
	*/
	function validateMessage(){
		if($( '#title' ).val() == ""){
		
		$( '#titleError' ).css('display','block');
			return false;
		}else{
		$( '#titleError' ).css('display','none');
			return true;
		}		
	}
    </script>
			