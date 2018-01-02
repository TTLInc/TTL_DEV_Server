<?php 
//echo date("Y-m-d H:i:s", time());exit;
//date( 'M d, Y | h:i a ' , outTime($message['createAt']) )
//--R&D@Oct-29-2013
$multi_lang = 'en';
if(!isset($_SESSION)) {session_start();}
if(isset($_SESSION['multi_lang'])){$multi_lang = $_SESSION['multi_lang'];}else{$multi_lang = 'en';	}
$this->load->model(array('lookup_model'));
$arrVal 	= $this->lookup_model->getValue('389', $multi_lang);
$lENTER_KEYWORD   = @$arrVal[$multi_lang];
$lENTER_KEYWORD   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('418', $multi_lang);
$lNO_RECORDS   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('387', $multi_lang);
$lFORUM   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('391', $multi_lang);
$lFORUM_HEAD   = @$arrVal[$multi_lang];

//$arrVal 	= $this->lookup_model->getValue('392', $multi_lang);
$arrVal 	= $this->lookup_model->getValue('513', $multi_lang);
$lADD_AN_ASSUE   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('390', $multi_lang);
$lSEARCH   = @$arrVal[$multi_lang];


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

$arrVal 	= $this->lookup_model->getValue('411', $multi_lang);
$lSAVE   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('412', $multi_lang);
$lCANCEL   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('413', $multi_lang);
$lCATEGORY   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('658', $multi_lang);
$lTTL_OFFICIAL   = @$arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('659', $multi_lang);
$lTTL_GENERAL   = @$arrVal[$multi_lang];


//--R&D@Oct-29-2013




$this->layout->appendFile('css',"css/terms.css");?>
<?php $this->layout->appendFile('css',"css/forum.css");?>
	<div class="terms">
			<div class="faqs-ttl content" style="font-size:12px;"><h2><a href="<?php echo base_url('/forum/');?>"><?php echo $lFORUM;?></a></h2></div>
			<div class="terms_mid cclicktimeslot"  style="margin:-31px 0px 11px -29px ;color:#3399CC;"><h1><?php echo $lFORUM_HEAD;?></h1></div>
			
			<div class="adminbox">
			<a class="blu-btn" href="<?php echo base_url('/forum/topic/add');?>"><?php echo $lADD_AN_ASSUE;?></a>
				<!--SEARCH FORM-->
				<form id="search" name="search" method="post" action="<?php echo site_url('forum/message/search') ?>" style="float:right;margin-right:400px;">
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
				</form><br/>
				<!--SEARCH FORM-->
			</div>
			
			<div class="terms_mid" id="terms_mid">
				<?php if ($notice = $this->session->flashdata('notification')):?>
				<p class="notice"><?=$notice;?></p>
				<?php endif;?>

				
				<div class="adminbox">
					<div id="topicHeader" style="display:none;">
						<table class="forum-list" width="100%">
							<thead>
								<tr>
									<th width="30%"><?php echo $lTITLE; ?></th>
									<!--<th width="10%"><?php echo $lTAGS; ?></th>-->
									<!--<th width="35%"><?php echo $lDESCRIPTION; ?></th>-->
									<th width="10%"><?php echo $lREPLIES; ?></th>
									<th width="25%"><?php echo $lUPDATED; ?></th>
								</tr>
							</thead>
						</table>
					</div>
					<!--TheTalkList-->
					<div>
						<p style="font-size:18px;color:#0D5782;padding-left:0px;margin-top:5px;cursor:pointer;" id="ShowofficialIssues"><?php echo $lTTL_OFFICIAL;?></p>		
						<?php
						if(isset($_POST['tCat']) && $_POST['tCat'] == 'T'){
						$dis = 'block';
						}else{
						$dis = 'none';
						}
						?>
						<div id="topicHeaderT" style="display:<?php echo $dis;?>;">
							<table class="forum-list" width="100%">
								<thead>
									<tr>
										<th width="30%"><?php echo $lTITLE; ?></th>
										<!--<th width="10%"><?php echo $lTAGS; ?></th>-->
										<!--<th width="35%"><?php echo $lDESCRIPTION; ?></th>-->
										<th width="10%"><?php echo $lREPLIES; ?></th>
										<th width="25%"><?php echo $lUPDATED; ?></th>
									</tr>
								</thead>
							</table>
						</div>
						<table class="forum-list" width="100%" id="officialIssues" style="display:<?php echo $dis;?>;">
							<?php if($rowsTTL) :?>
							<tbody>
								<?php $i= 0; foreach ($rowsTTL as $row): ?>
								<?php if ($i % 2 != 0): $rowClass = 'odd'; else: $rowClass = 'even'; endif;?>
								<?php if($row['tags'] == "") {$row['tags'] = "---";}?>
								<tr class="<?php echo $rowClass?>">
									<td width="30%" valign="top"><h3>
									<?php echo anchor('forum/topic/' . $row['tid'], strip_tags($row['title'])) ?></h3></td>
									<!--<td width="10%" valign="top"><?php echo $row['tags'] ?></td>-->
									<!--<td width="35%" valign="top"><?php echo $row['description'] ?></td>-->
									<td width="10%" valign="top"><?php echo $row['messages'] ?></td>
									<td width="25%" valign="top"><?php if($row['last_mid']){echo  $lON." ".date( 'M d, Y | h:i a ' , outTime($row['last_date']) );}?></td>
								</tr>
								<?php $i++; endforeach; ?> 
							</tbody>
							<?php endif ?>
						</table>
					</div>
					<!--TheTalkList-->
				</div>
					

					<!--General Membership-->
					<div style="margin-top:30px;">
						<p style="font-size:18px;color:#0D5782;padding-left:0px;margin-top:5px;cursor:pointer;" id="showgeneralIssues"><?php echo $lTTL_GENERAL;?></p>
						<?php
						if(isset($_POST['tCat']) && $_POST['tCat'] == 'G'){
						$disG = 'block';
						}else{
						$disG = 'none';
						}
						?>
						<div id="topicHeaderG" style="display:<?php echo $disG;?>;">
							<table class="forum-list" width="100%">
								<thead>
									<tr>
										<th width="30%"><?php echo $lTITLE; ?></th>
										<!--<th width="10%"><?php echo $lTAGS; ?></th>-->
										<!--<th width="35%"><?php echo $lDESCRIPTION; ?></th>-->
										<th width="10%"><?php echo $lREPLIES; ?></th>
										<th width="25%"><?php echo $lUPDATED; ?></th>
									</tr>
								</thead>
							</table>
						</div>
						<table class="forum-list" width="100%" id="generalIssues" style="display:<?php echo $disG;?>;">
							<?php if($rowsGENERAL) :?>
							<tbody>
							<?php $i= 0; foreach ($rowsGENERAL as $row): ?>
							<?php if ($i % 2 != 0): $rowClass = 'odd'; else: $rowClass = 'even'; endif;?>
							<?php if($row['tags'] == "") {$row['tags'] = "---";}?>
							<tr class="<?php echo $rowClass?>">
							<td width="46%" valign="top"><h3>
							<?php echo anchor('forum/topic/' . $row['tid'], strip_tags($row['title'])) ?>
							</h3></td>
							<!--<td width="10%" valign="top"><?php echo $row['tags'] ?></td>-->
							<!--<td width="35%" valign="top"><?php echo $row['description'] ?></td>-->
							<td width="16%" valign="top"><?php echo $row['messages'] ?></td>
							<td width="500px" valign="top"><?php if($row['last_mid']){echo  $lON." ".date( 'M d, Y | h:i a ' , outTime($row['last_date']) );}?></td>							
							</tr>
							<?php $i++; endforeach; ?> 
							</tbody>
							<?php endif ?>
						</table>
					</div>

				</div>
			</div>
			
			
			<script type="text/javascript">
			$( '#ShowofficialIssues' ).click(function(){
			
				//$( '#officialIssues' ).css('disaplay','block');
				$( '#officialIssues' ).toggle();
				//$( '#officialIssues' ).slideDown();
				//$( '#topicHeaderT' ).css('display','block');
				$( '#topicHeaderT' ).toggle();
				$( '#topicHeaderG' ).css('display','none');
				$( '#generalIssues' ).css('display','none');
		
			});
			
			$( '#showgeneralIssues' ).click(function(){
				$( '#officialIssues' ).css('display','none');
				$( '#topicHeaaderG' ).slideDown();
				//$( '#generalIssues' ).css('display','block');
				$( '#generalIssues' ).toggle();
				$( '#topicHeaderT' ).css('display','none');
				//$( '#topicHeaderG' ).css('display','block');
				$( '#topicHeaderG' ).toggle();
			
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
			</script>
			
			
			
			
			
			
			