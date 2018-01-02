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

$arrVal 	= $this->lookup_model->getValue('838', $multi_lang);
$advertise	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('313', $multi_lang);
$dwnld	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('839', $multi_lang);
$select	= $arrVal[$multi_lang];

?>
<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery.poshytip.min.js");?>
<?php $this->layout->appendFile('css',"css/cupertino/theme.css");?>
<?php $this->layout->appendFile('css',"css/search.css");?>

<div class="baseBox baseBoxBg clearfix">
    	
    <div class="content_main fr">
    	<div class="main_inner">
		
			<?php 
			
			if($this->session->userdata['roleId'] == 4)
			{
			echo organization_menu($linkType,'ad_prof',$profile['uid']);
			}
			else
			{
			echo Affiliate_menu($linkType,'ad_prof',$profile['uid']);
			}
			?>
            
            
            <div id="student_prof_Wp">
            	
                <div class="mod">
					<div class="content tle"><h2><?php echo $advertise;?></h2> <div style="float: right; margin-top: -40px;">
					 <span style="font-size:12px; margin-right:10px;">Languages</span> <select name="lang" id="position" onchange="getall(this.value);">
	<option value="">All</option>
	<option value="1">English</option>
	<option value="3">CN Simplified</option>
	<option value="6">CN Traditional</option>
	<option value="4">Japanese</option>
	<option value="2">Korean</option>
	<option value="5">Portuguese</option>
	<option value="7">Spanish</option>
	</select> 
					  </div></div>
                    <div class="bd">
                       
                      <div class="load-acc">
					   
					
                     
					  <div id="dynamic" style="width:100%;float:left;clear:both;">
					
						</div>
					
                      </div>

						
                     
                    </div>
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
					  url:'<?php echo base_url('user/getAllAdd');?>',
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
					
					if(result.length > 0)
					{
					 var tst='dd';				
					$("#dynamic").append('<span style="float: left; margin-left: -31px; font-size: 12px; clear: both; width: 100%;"><p class="by-btn" style="float:left;"><a  style="cursor:pointer;font-size:14px;font-weight:bold;" id="" onclick="test();"><?php echo $dwnld;?></a></p> <b style="float: left; margin-top: 11px; margin-left: 10px;"><?php echo $select; ?> </b></span>');		
					}
				 //$("#dynamic").append('<p class="by-btn"><a  style="cursor:pointer;" id="" onclick="test();">Download</a></p>');
					for (var i = 0;  i < (result.length); i++)
					{
					 
					var a ="<?php echo base_url('/uploads/images/ad/');?>";
					var dimage="<?php echo base_url('images/header.jpg');?>";
					var uid=result[i]['id'];
					
					var name=result[i]['title'];
					var img;
					
					if(result[i]['source']=='')
					{
					  img=dimage;
					}
					else
					{
					img=a+"/"+result[i]['source'];
					}
					var url= '<?php echo base_url();?>'+'//timthumb.php?src=';
					//$("#dynamic").append('<ul style="width:25%;max-height:205px;display:inline;clear:none;margin-bottom:20px;"><li style="border:0px;"><p class="credit"><a><span class="tut-img"><img width="100px;" height="100px;" src='+img+'><h4></h4></span></a></p></li></ul>');
					$("#dynamic").append('<ul style="width:25%;max-height:205px;display:inline;clear:none;margin-bottom:20px;"><li style="border:0px;"><p class="credit"><input type="checkbox" name="ids[]" value="'+uid+'">&nbsp;&nbsp;<a href="#"><span class="tut-img"><img src='+url+img+'&amp;h=100px;&amp;w=auto&amp;zc=0"><h4>'+name+'</h4></span></a></p></li></ul>');
					//$("#dynamic").append('<ul style="width:25%;max-height:205px;display:inline;clear:none;margin-bottom:20px;"><li style="border:0px;"><p class="credit"><input type="checkbox" name="ids[]" value="'+uid+'">&nbsp;&nbsp;<a href="#"><span class="tut-img"><img src='+img+'><h4>'+name+'</h4></span></a></p></li></ul>');
					}
                				
					
					  } 
				});
}
window.onload = function() {
 
  var a='';
  getall(a);
};
function test()
{
	var _checked = $("input[name='ids[]']:checked");
	if(_checked.size()>0){
			var _checkedVal = [];
			_checked.each(function(k,v){			   
				_checkedVal.push($(this).val());
				var a=_checkedVal[k];				
				var url="<?php echo base_url('user/download/')?>"+"/"+a;
					window.open(
					  url,
					  '_blank'
					);
			})
			//alert(_checkedVal);
			//String[] values = _checkedVal.split(",");
			//var myArray = _checkedVal.split(','); 
			//del(_checkedVal)
		
		}
		else{
			alert('Must check one image.');
			return;
		}
}
function download(url){


var url="<?php echo base_url('user/download/')?>"+"/"+url;
window.open(
  url,
  '_blank' 
);
	/*var cupdate = url;
    

			cupdate ='uid='+cupdate;
				$.ajax({
					  type:'POST',
					  data:cupdate,
					  url:'<?php echo base_url('user/download/');?>',
					 success:function(msg){
					  
					  if (String == msg.constructor) {
			eval ('var json = ' + msg);
		} else {
			var json = msg;
		}
					 
					  
					  } 
				});
				return false;*/
}

		
</script>
<style>
.cancelbtn{background: url(<?php echo base_url(); ?>images/main/details_btn.png) no-repeat 0 0;border:0 none;color: #FFFFFF;cursor: pointer;float:left;font-size: 14px;font-weight: bold; font-style:normal; height: 40px !important;line-height: 30px !important;outline:0 none;text-align: center;text-decoration: none;width:115px;margin-right:0px; border-radius:0px;margin-left:682px;margin-top:-32px;}
</style>