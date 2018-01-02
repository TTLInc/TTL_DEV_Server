<?php
if(!isset($_SESSION)) 
{
    session_start();
} ?>
<div class="baseBox baseBoxBg clearfix">
	<div class="content_main fr">
        <div class="main_inner">
           <?php echo profile_menu($linkType,'');?>
                <div style="font-size: 16px;margin: 50px;text-align: center;">
                <h1>transaction Successful</h1>
				</div>
        </div>
    </div>
    	<?php include dirname(__FILE__).'/leftSide.php';?>
</div>
<script type="text/javascript" src="js/jquery.js"></script>

	
 