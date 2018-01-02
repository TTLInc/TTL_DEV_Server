<?php header('Cache-Control: max-age=900');?>
<?php 
//--R&D@Oct-29-2013
$multi_lang = 'en';
if(!isset($_SESSION)) {session_start();}
if(isset($_SESSION['multi_lang'])){$multi_lang = $_SESSION['multi_lang'];}else{$multi_lang = 'en';	}
$this->load->model(array('lookup_model'));
$arrVal 	= $this->lookup_model->getValue('386', $multi_lang);
$lSUPPORT   = @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('389', $multi_lang);
$lENTER_KEYWORD   = @$arrVal[$multi_lang];

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

//$arrVal 	= $this->lookup_model->getValue('392', $multi_lang);
$arrVal 	= $this->lookup_model->getValue('513', $multi_lang);
$lADD_AN_ASSUE   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('393', $multi_lang);
$lIN   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('394', $multi_lang);
$lEVERY_WHERE   = @$arrVal[$multi_lang];

//$arrVal 	= $this->lookup_model->getValue('395', $multi_lang);
$arrVal 	= $this->lookup_model->getValue('514', $multi_lang);
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

$arrVal 	= $this->lookup_model->getValue('401', $multi_lang);
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

$arrVal 	= $this->lookup_model->getValue('658', $multi_lang);
$lTTL_OFFICIAL   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('659', $multi_lang);
$lTTL_GENERAL   = @$arrVal[$multi_lang];


//--R&D@Oct-29-2013

$this->layout->appendFile('css',"css/terms.css");?>
<?php $this->layout->appendFile('css',"css/forum.css");?>

	<div class="terms">
		<!--<div class="terms_top"><?php echo $title; ?></div>-->	
			<div class="faqs-ttl content" style="font-size:12px;"><h2><a href="<?php echo base_url('/forum/');?>"><?php echo $lFORUM;?></a></h2></div>
		<div class="terms_mid" id="terms_mid" style="margin-top:5px;">
		
		<?php if ($notice = $this->session->flashdata('notification')):?>
		<p class="notice"><?php echo $notice;?></p>
		<?php endif;?>

		<div class="terms_mid"  style="margin:-31px 0px 11px -29px !important;"><h1><?php echo $lFORUM_HEAD;?></h1></div>
		<div class="adminbox">
			<a style="margin-bottom:10px;" class="blu-btn" href="<?php echo base_url('/forum/topic/add');?>"><?php echo $lADD_AN_ASSUE;?></a>
			<form style="width:600px;float:right;margin-right:200px;" id="search" name="search" method="post" action="<?php echo site_url('forum/message/search') ?>">
				<label for="tosearch"><?php echo $lSEARCH; ?></label>
				<input type="text" name="tosearch" id="tosearch" class="input-text" placeholder="<?php echo $lENTER_KEYWORD;?>"/>
				<label for="infield"><?php echo $lIN.":"; ?></label>
				<select name="infield" id="infield" class="input-select">
					<option value=""><?php echo $lEVERY_WHERE; ?></option>
					<option value="title"><?php echo $lTITLE; ?></option>
					<!--<option value="message"><?php echo $lMESSAGE; ?></option>-->
					<option value="username"><?php echo $lAUTHOR; ?></option>
				</select>
				<!--<label for="exactsearch"><?php echo "Exact search"; ?></label>
				<input type="checkbox" name="exactsearch" id="exactsearch" value="on" />-->
				<input type="submit" name="submit" value="<?php echo $lSEARCH;?>" class="blu-btn" />
			</form>
			<br/>
		</div>

		<?php if($rows){ ?>
			<form id="searchResults" name="searchResults" action="<?php echo base_url('/forum/topic');?>" method="POST">
			<input type="hidden" name="isSearch" value="Y">
			</form>
		<?php } ?>



		<p id="ShowofficialIssues" class="form-tab1" style="font-size:18px;color:#0D5782;padding-left:0px;margin-top:5px;cursor:pointer;"><?php echo $lTTL_OFFICIAL;?></p>
<div class="frm-cnt1">
		<table class="forum-list" width="100%" >
			<thead>
				<tr>
					<th width="30%"><?php echo $lTITLE;?></th>
					<th width="15%"><?php echo $lAUTHOR; ?></th>
					<!--<th width="40%"><?php echo $lMESSAGE; ?></th>-->
					<th width="15%"><?php echo $lLAST_ENTRY; ?></th>
				</tr>
			</thead>
			<tbody>
			<?php if($rows) :?>
			<?php $i=0;foreach ($rows as $row): ?>
				<?php if($row['category'] == "TheTalklist - Official announcements"){ ?>
				<?php if ($i % 2 != 0): $rowClass = 'odd'; else: $rowClass = 'even'; endif;?>
				<tr class="<?php echo $rowClass;?>">
					<td valign="top"><h3><?php echo anchor('forum/topic/' . $row['tid'].'?search=true', strip_tags($row['title'])) ?></h3></td>
					<td valign="top"><?php echo $row['username'] ?></td>
					<!--<td valign="top"><?php echo $row['message'] ?></td>-->
					
					<!--<td valign="top"><?php echo $row['replies'] ?></td>-->
						<td valign="top"><?php if($row['last_mid']){echo  $lON." ".date( 'M d, Y | h:i a ' , outTime($row['last_date']) );}?></td>
				</tr>
				<?php $i++;} ?>
			<?php endforeach; ?> 
			<?php else:  ?>
			<tr><td colspan="4" style="text-align:center;color:#133E5F;font-size:20px;margin-top:20px;"><?php echo $lNO_RECORDS;?></td></tr>
			<?php endif ?>
			</tbody>
		</table>
</div>

		<p id="showgeneralIssues" class="form-tab2" style="font-size:18px;color:#0D5782;padding-left:0px;margin-top:5px;cursor:pointer;"><?php echo $lTTL_GENERAL;?></p>				
		<table class="forum-list frm-cnt2" width="100%">
			<thead>
				<tr>
					<th width="30%"><?php echo $lTITLE;?></th>
					<th width="15%"><?php echo $lAUTHOR; ?></th>
					<!--<th width="40%"><?php echo $lMESSAGE; ?></th>-->
					<th width="15%"><?php echo $lLAST_ENTRY; ?></th>
				</tr>
			</thead>
			<tbody>
			<?php if($rows) :?>
			<?php $j=0;foreach ($rows as $row): ?>
				<?php if($row['category'] == "General Discussion - Questions and help"){ ?>
				<?php if ($j % 2 != 0): $rowClass = 'odd'; else: $rowClass = 'even'; endif;?>

				<tr class="<?php echo $rowClass;?>">
					<td valign="top"><h3><?php echo anchor('forum/topic/' . $row['tid'].'?search=true', strip_tags($row['title'])) ?></h3></td>
					<td valign="top"><?php echo $row['username'] ?></td>
					<!--<td valign="top"><?php echo $row['message'] ?></td>-->
					
					<!--<td valign="top"><?php echo $row['replies'] ?></td>-->
						<td valign="top"><?php if($row['last_mid']){echo  $lON." ".date( 'M d, Y | h:i a ' , outTime($row['last_date']) );}?></td>
				</tr>
				<?php $j++;} ?>
			<?php endforeach; ?> 
			<?php else:  ?>
				<tr><td colspan="4" style="text-align:center;color:#133E5F;font-size:20px;margin-top:20px;"><?php echo $lNO_RECORDS;?></td></tr>
			<?php endif ?>
			</tbody>
		</table>
		<?php echo $pager ?>
		</div>
	</div>

<script type="text/javascript">

$( ".form-tab1" ).click(function() {
    $( ".frm-cnt1" ).toggle();
});



	$( '#ShowofficialIssues' ).click(function(){
		$( '#officialIssues' ).css('disaplay','block');
		//$( '#officialIssues' ).toggle();
		$( '#officialIssues' ).slideDown();
		$( '#topicHeaderT' ).css('display','block');
		$( '#topicHeaderG' ).css('display','none');
		$( '#generalIssues' ).css('display','none');
	});
			
	$( '#showgeneralIssues' ).click(function(){
		$( '#officialIssues' ).css('display','none');
		$( '#topicHeaaderG' ).slideDown();
		$( '#generalIssues' ).css('display','block');
		$( '#topicHeaderT' ).css('display','none');
		$( '#topicHeaderG' ).css('display','block');
	
	});
	$( '#ShowofficialIssues' ).hover(function(){
		$( '#ShowofficialIssues' ).css('color','#FFA500');
	});
	$( '#showgeneralIssues' ).hover(function(){
		$( '#showgeneralIssues' ).css('color','#FFA500');
	});
	$( '#ShowofficialIssues' ).mouseout(function(){
		$( '#ShowofficialIssues' ).css('color','#3399CC');
	});
	$( '#showgeneralIssues' ).mouseout(function(){
		$( '#showgeneralIssues' ).css('color','#3399CC');
	});
	$( '.forum-list a' ).click(function(){
		$( '#searchResults' ).submit();
	});
</script>