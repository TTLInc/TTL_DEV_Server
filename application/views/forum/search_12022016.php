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
		<h3><?php echo $title;?></h3>
		<div class="terms_mid"  style="margin:-31px 0px 11px -29px !important;"><h1><?php echo $lFORUM_HEAD;?></h1></div>
		
		<div class="adminbox">
		<a style="margin-bottom:5px;" class="blu-btn" href="<?php echo base_url('/forum/topic/add');?>"><?php echo $lADD_AN_ASSUE;?></a>
			
			
			<form style="width:600px;float:right;margin-right:200px;" id="search" name="search" method="post" action="<?php echo site_url('forum/message/search') ?>">
				<label for="tosearch"><?php echo $lSEARCH; ?></label>
				<input type="text" name="tosearch" id="tosearch" class="input-text" placeholder="<?php echo $lENTER_KEYWORD;?>"/>
				<label for="infield"><?php echo $lIN." :"; ?></label>
				<select name="infield" id="infield" class="input-select">
				<option value=""><?php echo $lEVERY_WHERE; ?></option>
				<option value="title"><?php echo $lTITLE; ?></option>
				<!--<option value="message"><?php echo $lMESSAGE; ?></option>-->
				<option value="username"><?php echo $lAUTHOR; ?></option>
				</select><br />
					
				<!--<label for="exactsearch"><?php echo "Exact search"; ?></label>
				<input type="checkbox" name="exactsearch" id="exactsearch" value="on" />--><br /> 
				<input type="submit" name="submit" value="<?php echo $lSEARCH;?>" class="blu-btn" />
				<a href="<?php echo base_url('forum');?>" class="blu-btn"><?php echo $lCANCEL;?></a>
			</form>
			
			
		</div>
		</div>
</div>