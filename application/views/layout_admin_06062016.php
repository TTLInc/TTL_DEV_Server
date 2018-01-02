<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>Admin</title> 
<script src="<?php echo base_url('js/jquery.1.7.2.min.js');?>"></script>
<script src="<?php echo base_url('js/jquery.placeholder.js');?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js"></script>
<script src="<?php echo base_url('js/adminLeftSection.js');?>"></script>


<link rel="stylesheet" href="https://code.jquery.com/ui/1.8.23/themes/base/jquery-ui.css" type="text/css" />
<!--links file -->
<?php if( isset($links) ):?>
	<?php foreach($links as $v):$str = '';?>
		<?php foreach($v as $kk=>$vv){
			$str .= " {$kk}='{$vv}' ";
		}?>
		<link rel="stylesheet" <?php echo $str;?> type="text/css" />
	<?php endforeach;?>
<?php endif;?>
<!-- links file end-->

<!-- script file -->
<?php if( isset($javascripts) ):?>
	<?php foreach($javascripts as $v):$str = '';?>
		<?php foreach($v as $kk=>$vv){
			$str .= " {$kk}='{$vv}' ";
		}?>
		<script <?php echo $str;?> type="text/javascript" ></script>
	<?php endforeach;?>
<?php endif;?>
<!-- script file end-->

<!-- scripts -->
<?php if( isset($scripts) ):?>
	<?php foreach($scripts as $v):?>
		<script>
			<?php echo $v;?>
		</script>
	<?php endforeach;?>
<?php endif;?>
<!-- scripts end-->

<!-- scripts -->
<?php if( isset($styles) ):?>
	<?php foreach($styles as $v):?>
		<script>
			<?php echo $v;?>
		</script>
	<?php endforeach;?>
<?php endif;?>
<!-- scripts end-->
<!-- <link rel="stylesheet" href="<?php echo base_url('css/main.css');?>" type="text/css" />-->
<link rel="stylesheet" href="<?php echo base_url('css/admin.css');?>" type="text/css" />

<script>
$(function(){
	$('input[placeholder]').placeholder();
});
</script>

</head> 
 
<body> 
	<div class="adm_left"> 
		<h1><a href="#" title="www.talklist.com"><span>www.talklist.com</span></a></h1> 
		<div class="profile_links">Hello,<a href="#"><?php echo $login;?></a>, <br><br><a href="<?php echo Base_url("");?>">View the Site</a> | <a href="<?php echo Base_url("admin/logout");?>">Sign Out</a>
		</div> 
		
		
		
		<ul class="adm_main_nav">
		<?php if($this->session->userdata('roleId')==1001) {?>
		
			
			<li id="Sessionmenu">
				<p><a style='cursor:pointer'>Schedule Group Session</a></p>
				<ul style="display:none;">
					<li><a href="<?php echo base_url('admin/CreateSession');?>">Create New</a></li> 
					<li><a href="<?php echo base_url('admin/ListSession');?>">List All</a></li>    
				</ul>
			</li>
		
		<?php } else { ?>
			<li id="usermenu">
				<p><a style='cursor:pointer'>Accounts</a></p>
				<ul style="display:none;">
					<li></li>
					<li></li>
					<li><a href="<?php echo base_url('admin/user');?>">All Users</a></li> 
					<li><a href="<?php echo base_url('admin/newtutorlist');?>">Suggested Tutors</a></li>
					<li><a href="<?php echo base_url('admin/newinterviewerlist');?>">Interviewers</a></li>
				</ul>
			</li>
			<li id="financial">
				<p><a style='cursor:pointer'>Financial</a></p>
				<ul style="display:none;">
					<li id="spayments"><a  href="<?php echo base_url('admin/Affi_payment');?>"style='cursor:pointer'>Affiliate Payments</a></li>	
					<li id="ssummary"><a  href="<?php echo base_url('admin/a_summary');?>"style='cursor:pointer'>Affiliate Summary</a></li>	
					<li id="attempted"><a  href="<?php echo base_url('admin/Attempted_Session');?>"style='cursor:pointer'> Attempted Sessions</a></li>
					<li id="mcash"><a  href="<?php echo base_url('admin/cash');?>"style='cursor:pointer'>Cash</a></li>
					<li id="dresolution"><a  href="<?php echo base_url('admin/disputeResolution');?>"style='cursor:pointer'>Credit Status</a></li>
					<li id="mpayments"><a  href="<?php echo base_url('admin/Memberpay');?>"style='cursor:pointer'>Members Payments</a></li>
					<li><a href="<?php echo base_url('admin/Price');?>">Price</a></li>
					<li id="referralpayment"><a  href="<?php echo base_url('admin/referralpayment');?>"style='cursor:pointer'>Referral Payments</a></li>
					<li id="spayments11"><a  href="<?php echo base_url('admin/schoolsummary');?>"style='cursor:pointer'>School Summary</a></li>
					<li id="spayments22"><a  href="<?php echo base_url('admin/schoolpayment');?>"style='cursor:pointer'>School Payments</a></li>
					<li id="mvideopayment"><a  href="<?php echo base_url('admin/disputeVideoResolution');?>"style='cursor:pointer'>Video Payments</a></li>
				</ul>
			</li>
			<li id="pcontent">
				<p><a style='cursor:pointer'>Platform Content</a></p>
				<ul style="display:none;">
					<li></li> 
					<li></li>
					<li></li>
					<li></li> 					
					<li></li>
					<li><a href="<?php echo base_url('admin/banner_list');?>">Banners</a></li>   
					<li><a href="<?php echo base_url('admin/home_banner_list');?>">Banner Home</a></li>
					<li><a href="<?php echo base_url('admin/listcategories');?>">Categories</a></li>   
					<li><a href="<?php echo base_url('admin/article_edit/id/3');?>">Contact Us</a></li>
					<li><a href="<?php echo base_url('admin/advertise_list');?>">Container Advertisement</a></li> 
					<li><a href="<?php echo base_url('admin/contests');?>">Contests</a></li>  
					<li><a href="<?php echo base_url('admin/dashboardmessages');?>">Dashboard Messages</a></li>
					<li><a href="<?php echo base_url('admin/guide');?>">Guide Categories</a></li>
					<li><a href="<?php echo base_url('admin/languageAndCulture');?>">Language and Culture</a></li>
					<li><a href="<?php echo base_url('admin/messaging_newsletter');?>">Message Templates</a></li>	
					<li><a href="<?php echo base_url('admin/messaging');?>">Messaging System</a></li>
					<li><a href="<?php echo base_url('admin/notifications');?>">Notifications</a></li>
					<li><a href="<?php echo base_url('admin/LanguageApp');?>">Other Favorites</a></li>
					
					
					<li><a href="<?php echo base_url('admin/article_edit/id/1');?>">Privacy Policy</a></li> 
					<li><a href="<?php echo base_url('admin/tresources');?>">Support Resources</a></li>
					<li><a href="<?php echo base_url('admin/article_edit/id/6');?>">Site Map</a></li>
					
					<li></li>
					<li><a href="<?php echo base_url('admin/article_edit/id/2');?>">Terms of Use</a></li>
					<li><a href="<?php echo base_url('admin/ListTestScenario');?>">Tutor Guides</a></li>
					<li><a href="<?php echo base_url('admin/testimonials');?>">Testimonials</a></li>
				</ul>
			</li>
			
			
		 	<li id="psettings">
				<p><a style='cursor:pointer'>Platform Settings</a></p>
				<ul style="display:none;">
					<li></li> 
					<li></li>
					<li></li> 
					<li></li>
					<li></li>
					<li></li> 
					<li><a href="<?php echo base_url('admin/settings');?>">Banned Words</a></li>
					<li><a href="<?php echo base_url('admin/Country');?>">Country</a></li>  
					
					<li><a href="<?php echo base_url('admin/faq');?>">FAQs</a></li>
					<li><a href="<?php echo base_url('admin/forum');?>">Forum</a></li>
					
					<li><a href="<?php echo base_url('admin/langs');?>">Languages</a></li>  
					<li><a href="<?php echo base_url('admin/chatmessages');?>">Live Chat</a></li>
					
					<li><a href="<?php echo base_url('admin/location');?>">Locations</a></li>  
					<li><a href="<?php echo base_url('admin/metatag');?>">Meta Tag</a></li>  
					<li><a href="<?php echo base_url('admin/multi_lang');?>">Multilanguage</a></li>
					<li><a href="<?php echo base_url('admin/quotes');?>">Quotes</a></li>
					<li id="reviews"><a  href="<?php echo base_url('admin/reviews');?>"style='cursor:pointer'>User Reviews </a></li>					
					<li><a href="<?php echo base_url('admin/video_control');?>">Video Control</a></li>
				</ul>
			</li>
		 
			 
		 
				<li id="Schools">
				<p><a style='cursor:pointer'>Schools</a></p>
				<ul style="display:none;">
				<li><a  href="<?php echo base_url('admin/SchoolUsers');?>"style='cursor:pointer'>School Accounts</a></li>
					<li></li> 
					
					<?php if($this->session->userdata('roleId')==1002)
			{?>
				<li><a href="<?php echo base_url('admin/school_add');?>">Add schools</a></li>
				<li><a href="<?php echo base_url('admin/manageschool');?>">Manage schools</a></li>
				  
			<?php }?>
					 <li><a href="<?php echo base_url('admin/schoolAdd');?>">School Ad Samples</a></li>  
					 <li id="s_summary"><a style='cursor:pointer' href="<?php echo base_url('admin/s_summary');?>">School Summary</a></li>
					 <li id="s_layout"><a style='cursor:pointer' href="<?php echo base_url('admin/school_Layout');?>">Tutor Organization </a></li>
				</ul>
			</li>
	 
		 
			
			<?php }?>	
		</ul> 
	</div>
<div class="adm_right"> 
	<div class="adm_main"> 
		<div class="adm_article">
		
			<div class="admin_wel"> 
				<h4>Welcome <?php echo $login;?></h4> 
				<?php if($this->uri->segment(2) == 'Affi_payment' || $this->uri->segment(2) == 'a_summary' || $this->uri->segment(2) == 's_summary'  || $this->uri->segment(2) == 'schoolpayment'  || $this->uri->segment(2) == 'referralpayment' || $this->uri->segment(2) == 'Memberpay' ||  $this->uri->segment(2) == 'ListTestScenario'){?>
				<?php }else { ?>
				<p>What would you like to do?</p> 
				<?php }?>
			</div>
			<div class="main_box"> 
				<div class="main_box_top"><s></s> 
				<h3><?php echo @$content_for_layout_title;?></h3> 
				<i> </i> 
				<ul class="main_box_tabs"><li><?php echo @$content_for_layout_links;?></li></ul> 
			</div> 
		 
			<div class="data_content" id="data_content"> 
				<?php echo $content_for_layout;?>
			</div> 
		 
			<div class="main_box_bottom"><s></s> <i></i></div> 
	 
		</div> 
	 
	 
		<div class="copyright">© Copyright 2013</a> | <a href="#">Top</a></div> 
		</div> 
	</div> 
</div> 
<script type="text/javascript"> 
var leftMenuIndex = 0;
leftMenuIndex=0;setTimeout('showmenu("videomenu",leftMenuIndex)',1000);
  $(".check-all").click(function() {
    $("input[name='ids[]']").attr('checked', this.checked);
  });
  $('#apply').click(function(){
  	 if($("input[name='ids[]']:checked").size()>0)
  	 	$('#categoriesForm').submit();
  });
</script> 



	<!--Form to update user's activity status : Starts-->
	<form name="userIdleStatus" id="userIdleStatus" method="post" action="admin/userpdatectivitytatus">
	<input type="hidden" id="userIdleStatusValue" value="" name="userIdleStatusValue">
	</form>
	<!--Form to update user's activity status : Starts-->
	<!--JavaScripts to detect user's activity status : Starts-->
	<script type="text/javascript" src="http://yui.yahooapis.com/combo?3.0.0/build/yui/yui-min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('js/idle/idle-timer.js');?>"></script>
    <script type="text/javascript">
    function updateUserActivityStatus(status){
		//alert(status);
		$('input[name=userIdleStatusValue]').val(status);
		var dataString = 'status='+status;
				$.ajax({
					type	: "POST",
					url 	: "userpdatectivitytatus",
					data	: dataString,
					cache	: false,
					success: function(html){}
				});
	}
	YUI().use("*", function(Y){
		var loginTech = '<?php echo $login;?>';
		if(loginTech == "technicalsupport"){
			Y.IdleTimer.subscribe("idle", function(){
				//Y.get("#status").set("innerHTML", "User is idle :(").set("style.backgroundColor", "silver");
				updateUserActivityStatus('Offline');
				//alert('idle');
			});  
			Y.IdleTimer.subscribe("active", function(){
				 //Y.get("#status").set("innerHTML", "User is active :D").set("style.backgroundColor", "yellow");
				//alert('active');
				updateUserActivityStatus('Online');
			});
			Y.IdleTimer.start(10000);
		}else{
			updateUserActivityStatus('Offline');
		}
    });
	//$(window).unload( function () { updateUserActivityStatus('Offline'); } );
	//window.onbeforeunload = function() { updateUserActivityStatus('Offline');}
    </script>
	
	<!--JavaScripts to detect user's activity status: Ends-->
<style>
 
 .guide{ background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
    display: block;
    height: 33px;
    line-height: 33px;
    padding-right: 15px;
    text-align: right;
	color:white;
	cursor:pointer;
}
</style>

</body> 
</html> 
 
 
 
 