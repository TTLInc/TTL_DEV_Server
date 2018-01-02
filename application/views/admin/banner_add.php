<?php $this->layout->setLayoutData('content_for_layout_title','Add index banner');?>
<?php if(@$errormsg):?>
 <div class="notice_4" id="errormsg">
	<span class="notice_icon"></span> 
	<a class="close" href="javascript:void(0);" onclick="$('#errormsg').hide()">
		<img src="<?php echo base_url('images/cross_grey_small.png');?>" />
	</a>
	<p><?php echo $errormsg; ?></p>
</div>
<?php endif;?>
<form method="post" action="" name="addbannerform" id="addbannerform" enctype="multipart/form-data">
    
    <p class="ft_title">Pic</p>
    <p class="setft"><input type="file" name="pic" id="pic" value=""  class="adm_box1" /></p>
	
	
	<p class="ft_title">Title</p>
    <p class="setft"><input type="text" name="title" id="title" value=""  class="adm_box1" /></p>
	
	
	<p class="ft_title">Select School</p>
    <p class="setft">
	<input type="hidden" name="school_id" id="school_id">
	<input autocomplete="off" type="text"   class="adm_box1"  onkeyup="getall(this.value);" id="school" name="school">
	</p>
    
    <div id="dynamic" style="margin-bottom:10px;width:100%;float:left;clear:both;">
					
						</div>
    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a></p>
</form>
<script>
function getall(cnt)
{
 
var pattern = cnt;


			pattern ='sdata='+pattern;
$.ajax({
					  type:'POST',
					 dataType: 'html',
					  url:'<?php echo base_url('admin/GetSchoolList');?>',
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
					
					for (var i = 0;  i < (result.length); i++)
					{
					 
					var a ="<?php echo base_url('/uploads/images/thumb/');?>";
					var dimage="<?php echo base_url('images/header.jpg');?>";
					var uid=result[i]['uid'];
					var img;
					var name=result[i]['firstName']+result[i]['lastName'];
					var fname=result[i]['firstName'];
					if(result[i]['pic']=='')
					{
					  img=dimage;
					}
					else
					{
					img=a+"/"+result[i]['pic'];
					}
					var user="javascript:void(0)" ;
					$("#dynamic").append('<ul style="width:25%;max-height:205px;display:inline;clear:none;margin-bottom:20px;"><li class="myown"    value='+fname+' style="border:0px;"><p class="credit"><a href='+user+'><span class="tut-img" style="min-height:65px;"><img width="50px;" height="50px;" src='+img+'><h4>'+name+'</h4></span></a></p><p class="by-btn"><a  style="cursor:pointer;" id="'+uid+'" onclick="AddSchool(\'' + uid + '\',\'' + name + '\')">Add</a></p></li></ul>');
					
					}
										
					
					  } 
				});
}
</script>

<script type="text/javascript">
function AddSchool(id,name){
 
$('#school').val(name);
$('#school_id').val(id);
$('#dynamic').empty();
 
}
function checkform(){
	$('#addbannerform').submit();
}
setTimeout('showmenu("pcontent",5)',1000);
</script>

	
		<style>
	.myown {
    border: 1px solid #ececec;
    display: inline;
    float: left;
    height: 155px;
    text-align: center;
    width: 164px;
}
		.credit
		{
			color: #666666;
    display: block;
    float: left;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 10pt;
    margin: 22px 0 10px;
    text-transform: uppercase;
    width: 100%;
		}
		.by-btn
{
  background: url("<?php echo base_url();?>images/by-btn-bg.jpg") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
    color: #fff;
    display: inline-block;
    height: 28px;
    line-height: 26px;
    text-align: center;
    width: 74px;
	
}

</style>
</body>
</html>