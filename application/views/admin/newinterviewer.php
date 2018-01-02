<?php $this->layout->setLayoutData('content_for_layout_title','Add Interviewer');?>
<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery.poshytip.min.js");?>
<?php $this->layout->appendFile('css',"css/cupertino/theme.css");?>
<?php $this->layout->appendFile('css',"css/search.css");?>

<div class="baseBox baseBoxBg clearfix">
    	
    <div class="content_main fr">
    	<div class="main_inner">
		
           
            <!--/student_prof-->
            <div id="student_prof_Wp">
            	
                <div class="mod">
				 
               
                    <div class="bd">
                       
                      <div class="load-acc">
					  <div style="float:left;">
					  <input type="text" style="width:300px;height:28px;margin-right:20px;" placeholder="Search by name or Email"  onkeyup="getall(this.value);" id="searchTxt1">
					  </div> 
					
                     
					  <div id="dynamic" style="margin-top:25px;width:100%;float:left;clear:both;"></div>
						<p class="setft">
							<a href="javascript:void(0)" onclick="cancelInfo();" class="button">Cancel</a>
						</p>
                      </div>

						
                     
                    </div>
                </div>
                
        </div>
    </div>
    </div>
    <!--/content_main-->
 </div>

<script>
function cancelInfo(){
	 window.location.href="<?php echo base_url('admin/newinterviewerlist');?>";
	}
function getall(cnt)
{
 
var pattern = cnt;


			pattern ='sdata='+pattern;
$.ajax({
					  type:'POST',
					 dataType: 'html',
					  url:'<?php echo base_url('admin/GetNewinterviewersAdmin');?>',
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
					var name=result[i]['firstName']+ '  '+result[i]['lastName'];
					if(result[i]['pic']=='')
					{
					  img=dimage;
					}
					else
					{
					img=a+"/"+result[i]['pic'];
					}
					var user="javascript:void(0)" ;
					$("#dynamic").append('<ul style="width:25%;max-height:205px;display:inline;clear:none;margin-bottom:20px;"><li style="border:0px;"><p class="credit"><a href='+user+'><span class="tut-img" style="min-height:65px;"><img width="50px;" height="50px;" src='+img+'><h4>'+name+'</h4></span></a></p><p class="by-btn"><a  style="cursor:pointer;" id="'+uid+'" onclick="AddTutor('+uid+')">Add</a></p></li></ul>');
					
					}
										
					
					  } 
				});
}
window.onload = function() {
 
  var a='a';
  //getall(a);
};

function AddTutor(id){
//alert(id);return false;
	var cupdate = id;
    cupdate ='uid='+cupdate;
	$.ajax({
		  type:'POST',
		  data:cupdate,
		  url:'<?php echo base_url('admin/AddnewInterviewer/');?>',
		  success:function(msg){
		  
		  if (String == msg.constructor) {
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
		  if(json.success){					  
			alert('Interviewer is added.');
			window.location.href = '<?php echo Base_url("admin/addinterviewer");?>';
			}
		  else
		  {
		  alert('Problem with adding tutor');
		  }
		  
		  } 
	});
}

		
</script>
<script type="text/javascript">
setTimeout('showmenu("usermenu",4)',1000);
</script>
<style>

#dynamic .tut-img {
    max-height: 150px;
    min-height: 150px;
    overflow: hidden;
    width: 164px;
}
.load-acc ul li p.credit span {
    color: #0f93dd;
    display: block;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 24pt;
    line-height: 35px;
    margin-bottom: 0;
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
.cancelbtn{background: url(<?php echo base_url(); ?>images/main/details_btn.png) no-repeat 0 0;border:0 none;color: #FFFFFF;cursor: pointer;float:left;font-size: 14px;font-weight: bold; font-style:normal; height: 40px !important;line-height: 30px !important;outline:0 none;text-align: center;text-decoration: none;width:115px;margin-right:0px; border-radius:0px;margin-left:682px;margin-top:-32px;}
</style>