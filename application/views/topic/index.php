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

//$arrVal 	= $this->lookup_model->getValue('404', $multi_lang);
$arrVal 	= $this->lookup_model->getValue('78', $multi_lang);
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

$arrVal 	= $this->lookup_model->getValue('411', $multi_lang);
$lSAVE   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('412', $multi_lang);
$lCANCEL   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('413', $multi_lang);
$lCATEGORY   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('416', $multi_lang);
$lCREATE_MESSAGE   = @$arrVal[$multi_lang];

//--R&D@Oct-29-2013






$this->layout->appendFile('css',"css/terms.css");?>
<?php $this->layout->appendFile('css',"css/forum.css");?>
<div class="terms">
			<div class="faqs-ttl content" style="font-size:12px;"><h2><a href="<?php echo base_url('/forum/');?>"><?php echo $lFORUM;?></a></h2></div>
	<div class="terms_mid" id="terms_mid">
		<h3 style="font-size:15px;color:#0D5782"><?php echo $lTHREAD.": ".$title;?></h3>
		<?php if ($notice = $this->session->flashdata('notification')):?>
		<p class="notice"><?php echo $notice;?></p>
		<?php endif;?>
		
		<?php if($messages) :
		$ij = 0; foreach ($messages as $row):
		if ($ij < 1): ?>
		<div class="adminbox">
			
			<?php if(!isset($_GET['search'])) { ?>
			<a id="backToThread" style="margin-bottom:5px;float:right;margin-right:25px;" class="blu-btn" href="javascript:void(0)" onclick="javascript:document.getElementById('bckThread').submit();"><?php echo 'Back';?></a>
			<form id="bckThread" name="bckThread" method="POST" action="<?php echo base_url('forum/');?>">
			<?php if($category == "General Discussion - Questions and help"){$catThread = 'G';}else{$catThread = 'T';}?>
			<input type="hidden" name="tCat" value="<?php echo $catThread;?>">
			</form>
			<?php }else{?>
				<a id="backToThread" style="margin-bottom:5px;float:right;margin-right:25px;" class="blu-btn" href="javascript:void(0)" onclick="history.back(-1)"><?php echo 'Back';?></a>
			<?php } ?>
		</div>
		<?php else: 
		endif;
		$ij++; 
		endforeach; 
		endif ?>
		
		
		
		
		
		<?php if($messages) :
		$i = 0; foreach ($messages as $row):
		if ($i < 1): ?>
		<div class="adminbox">
		
			<?php if(isset($_GET['search'])) { ?>
			<a style="margin-bottom:5px;float:right;margin-right:25px;" class="blu-btn" href="<?php echo base_url('forum/message/' . $row['mid'].'?search=true');?>"><?php echo $lREPLY_THREAD;?></a>
			<?php }else{?>
			<a style="margin-bottom:5px;float:right;margin-right:25px;" class="blu-btn" href="<?php echo base_url('forum/message/' . $row['mid']);?>"><?php echo $lREPLY_THREAD;?></a>
		    <?php } ?>
		
		
		</div>
		
		<?php else: 

		endif;
		$i++; 
		endforeach; 
		endif ?>
		

		
		<?php //echo '<pre>';print_r($messages);exit;?>
		
		<!--<div class="adminbox">
			<a style="margin-bottom:5px;float:right;margin-right:25px;" class="blu-btn" href="<?php echo base_url('forum/message/new/'.$topic['tid']);?>"><?php echo $lREPLY_THREAD;?></a>
		</div>-->
		
		
		<table class="forum-list" width="100%">
			<thead>
				<tr>
					<th width="40%"><?php echo $lMESSAGE; ?></th>
					<th width="10%"><?php echo $lAUTHOR; ?></th>
					<!--<th width="10%"><?php echo $lREPLIES ; ?></th>-->
					<th width="30%"><?php echo $lLAST_ENTRY; ?></th>
				</tr>
			</thead>
			
			<?php if($messages) :?>
			<tbody>
			<?php $i = 0; foreach ($messages as $row): ?>
			<?php if ($i % 2 != 0): $rowClass = 'odd'; else: $rowClass = 'even'; endif;?>
				<tr class="<?php echo $rowClass?>">
					<td valign="top" style="padding-right:5px;"><?php echo strip_tags($row['message']); ?></td>
					<td valign="top"><?php echo $row['username'] ?></td>
					<!--<td valign="top"><?php echo $row['replies'] ?></td>-->
								<td valign="top">
								<?php if($row['last_mid']){
									//echo  $lON." ".$row['last_date']." <br/> ".$lBY."&nbsp;" . $row['last_username'];
									echo  $lON." ".date( 'M d, Y | h:i a ' , outTime($row['date']) );
								}?></td>
				<?php $i++; endforeach; ?> 
			</tbody>
			<?php endif ?>
			
		</table>
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
	setInterval(function(){ updateUserActivityStatus();},2000);
    </script>