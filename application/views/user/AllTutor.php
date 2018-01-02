<?php
$multi_lang = 'en';
if(!isset($_SESSION)) {
     session_start();
}
if(isset($_SESSION['multi_lang']))
{
	$multi_lang = $_SESSION['multi_lang'];
}
else
{
	$multi_lang = 'en';	
}
$this->load->model(array('lookup_model'));
$arrVal 	= $this->lookup_model->getValue('95', $multi_lang);
$lcumulative	= $arrVal[$multi_lang];
$arrVal 	 = $this->lookup_model->getValue('96', $multi_lang);
$lcurrentbalance = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('97', $multi_lang);
$lconductpayment = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('98', $multi_lang);
$lfuturedduration = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('99', $multi_lang);
$lmonth = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('337', $multi_lang);
$lmonths = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('100', $multi_lang);
$lpremiummembership	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('101', $multi_lang);
$lamount	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('109', $multi_lang);
$lpaymentoption	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('102', $multi_lang);
$lpaypalrecurring = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('103', $multi_lang);
$lpaypalmajorcards = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('252', $multi_lang);
$lpaypalemail = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('253', $multi_lang);
$lgetpaidpaypal = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('135', $multi_lang);
$lsave = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('320', $multi_lang);
$upgradeaccounttext = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('321', $multi_lang);
$credittext = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('322', $multi_lang);
$freetext = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('334', $multi_lang);
$getpaidtext = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('335', $multi_lang);
$totalearnings = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('336', $multi_lang);
$selectpaidtext = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('35', $multi_lang);
$emailtext = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('338', $multi_lang);
$upgradepopuptext = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('340', $multi_lang);
$upgradestudentpopuptext = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('339', $multi_lang);
$lrecommends = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('341', $multi_lang);
$lloadaccount = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('376', $multi_lang);
$lbuynow = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('903', $multi_lang);
$adtutor = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('904', $multi_lang);
$searchby= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('412', $multi_lang);
$cancel= $arrVal[$multi_lang];

?>
<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery.poshytip.min.js");?>
<?php $this->layout->appendFile('css',"css/cupertino/theme.css");?>
<?php $this->layout->appendFile('css',"css/search.css");?>

<div class="baseBox baseBoxBg clearfix">
    	
    <div class="content_main fr">
    	<div class="main_inner">
		
            <?php 
			if($profile['roleId'] == 4)
			{
			echo organization_menu($linkType,'account');
			}else
			{
			echo profile_menu($linkType,'account');
			}
			?>
            <!--/student_prof-->
            <div id="student_prof_Wp">
            	
                <div class="mod">
					<?php if($profile['roleId'] == 4){ ?>
                    
                        <div class="content tle"><h2><?php echo $adtutor; ?></h2></div>
                    
					<?php } ?>
					<?php
						if($payment_account_rec != ''){
					?>
                    <div class="bd">
                      <div class="load-acc">
						  <div style="float:left;">
						  <input type="text" style="width:300px;height:28px;margin-right:20px;" placeholder="   <?php echo "  ".$searchby. "   ";?> "  onkeyup="getall(this.value);" id="searchTxt1">
						  </div> 
						<a style="float:left;margin:0px" class="cancelbtn" href="<?php echo base_url('user/account') ?>"><?php echo $cancel; ?></a>
						<div id="dynamic" style="width:100%;float:left;clear:both;">
						</div>
					<!--	<div class="fr pt20"><div class="v_ajax_page"><a class="first" href="#">&lt;&lt;</a><a class="prev" href="#">&lt;</a><span class="current">1</span><a href="#">2</a><a href="#">3</a><a href="#">4</a><a class="next" href="#">&gt;</a><a class="last" href="#">&gt;&gt;</a></div></div>-->
						</div>
                    </div>
					<?php
					}else{ echo "<font size='3px'>Must first enter PayPal email account to receive payment for future sessions.</font>";}
					?>
                </div>
			
                
        </div>
    </div>
    </div>
    <!--/content_main-->
	<?php include dirname(__FILE__).'/leftSide.php';?>
</div>

<script>
function getall(cnt)
{
 
var pattern = cnt;


			pattern ='sdata='+pattern;
$.ajax({
					  type:'POST',
					 dataType: 'html',
					  url:'<?php echo base_url('user/getAjaxsdata');?>',
					  data:pattern,
					  success:function(msg){
					  if (String == msg.constructor)
					{
						var result;
						
						eval('result = ' + msg);
					} else {
						var result = msg;
					}
					$('#dynamic').empty();
					
					//alert(result.length);
					
					for (var i = 0;  i < (result.length); i++)
					{
					 
					var a ="<?php echo base_url('/uploads/images/thumb/');?>";
					var dimage="<?php echo base_url('images/header.jpg');?>";
					var uid=result[i]['uid'];
					var sid=result[i]['school_id'];
					var img;
					var name=result[i]['firstName']+ '  '+result[i]['lastName'];
					if(result[i]['pic']=='')
					{
					  img=dimage;
					}
					else
					{
					img=a+"/"+result[i]['pic'];
					}
					var b="<?php echo base_url('/user/profile/uid/');?>";
					var user=b+'/'+result[i]['uid'];
					
					
					$("#dynamic").append('<ul style="width:25%;max-height:205px;display:inline;clear:none;margin-bottom:20px;"><li style="border:0px;"><p class="credit"><a href='+user+'><span class="tut-img" style="min-height:65px;"><img width="50px;" height="50px;" src='+img+'><h4>'+name+'</h4></span></a></p><p class="by-btn"><a  style="cursor:pointer;" id="'+uid+'" onclick="AddTutor('+uid+','+sid+')">Add</a></p></li></ul>');
					
					}
										
					
					  } 
				});
}
window.onload = function() {
 
  var a='a';
  //getall(a);
};

function AddTutor(id,oid){

	var cupdate = id;
    var orgid=oid;

	cupdate ='uid='+cupdate;
	$.ajax({
		  type:'POST',
		  data:cupdate,
		  url:'<?php echo base_url('user/addTutor/');?>',
		  success:function(msg){
		  
		  if (String == msg.constructor) {
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
		  if(json.success){					  
			alert('Tutor added successfully');
			window.location.href = '<?php echo Base_url("user/account");?>';
			}
		  else
		  {
		  alert('Problem with adding tutor');
		  }
		  
		  } 
	});
}

		
</script>
<style>
.cancelbtn{background: url(<?php echo base_url(); ?>images/main/details_btn.png) no-repeat 0 0;border:0 none;color: #FFFFFF;cursor: pointer;float:left;font-size: 14px;font-weight: bold; font-style:normal; height: 40px !important;line-height: 30px !important;outline:0 none;text-align: center;text-decoration: none;width:115px;margin-right:0px; border-radius:0px;margin-left:682px;margin-top:-32px;}
</style>