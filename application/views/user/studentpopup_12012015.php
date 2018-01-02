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

 $arrVal 	= $this->lookup_model->getValue('1173', $multi_lang);	$ThanksForCmp 	= $arrVal[$multi_lang];
?>
 <!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-T8WV8L"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-T8WV8L');</script>
<!-- End Google Tag Manager -->
 <script>
 $( window ).load(function() {
var a="<?php echo $this->session->userdata('sturegister')?>";
if(a=="yes")
{ 

	$('#dialog3').dialog({
					modal:true,
					width:'430px'
			});
	
 } else
 {
	window.location.href = "<?php echo base_url('user/dashboard')?>";
 }
});
	function chkRedirect()
{

<?php $this->session->set_userdata('sturegister','no'); ?>
window.location.href = "<?php echo base_url('search/search')?>";
}
</script> 	
			<div id="dialog3" title="Registration Success" style="display:None;background-color: white;">
<?php echo $ThanksForCmp;?> </br><br/>
			 
			<div class="thanks" ><a onclick="chkRedirect();"   style="color:white;cursor:pointer" id="firstok" >OK</a></div>
		</div>
<div style="height:350px;">

</div>

 <style>
.thanks{background: url("<?php echo base_url();?>images/test-vs-btn.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: medium none;
    box-shadow: none !important;
    color: #ffffff;
    cursor: pointer;
    font-size: 14px;
    height: 34px;
    line-height: 32px;
    margin-top: 4px !important;
    outline: medium none;
    text-align: center;
    text-decoration: none;
    width: 110px;}
</style> 
		
 

		
 	