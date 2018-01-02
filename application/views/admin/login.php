<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<!-- saved from url=(0045)http://vanguardclients.com/1800company/admin/ -->
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE>Administrator Control Panel :: Login Page</TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK rel="stylesheet" type="text/css" href="<?php echo base_url("css/admin_login.css")?>">
<SCRIPT language=javascript src="<?php echo base_url("js/jquery.1.7.2.min.js")?>"></SCRIPT>
<SCRIPT language=javascript src="<?php echo base_url("js/adminLoginValidationSettings.js")?>"></SCRIPT>
<META name="GENERATOR" content="MSHTML 8.00.7601.17720">
</HEAD>
<BODY>
<DIV id="login-contant">
	<DIV class="logo-top">
		<A	href="<?php echo base_url('admin');?>">
		<IMG alt=""	src="<?php echo base_url('images/logo.png')?>"></A>
	</DIV>
	<DIV class="contant">
		<DIV class="contant-left">Welcome to your Administration System, PleaseLog In:</DIV>
		<DIV class="contant-right">
			<FORM id="frm" method="post" name="frm" action="" onsubmit="return checkLogin();">
			<?php if(isset($errormsg) && $errormsg): ?>
			<span><?php echo $errormsg; ?></span>
			<?php endif;?>
			<TABLE border=0 cellSpacing=0 cellPadding=0 width=500>
				<TBODY>
					<TR>
						<TD class="User-name">Username</TD>
						<TD><INPUT id="username" class="log-in-password-box" type="text" name="username"></TD>
					</TR>
					<TR>
						<TD class="User-name">Password</TD>
						<TD><INPUT id="password" class="log-in-password-box" type="password" name="password"></TD>
					</TR>
					<TR>
						<TD>&nbsp;</TD>
						<TD>
						<DIV class="log-in-butten"><INPUT id="btn_submit" class="submitbutton" value="log in" type="submit" name="btn_submit"></DIV>
						</TD>
					</TR>
					
				</TBODY>
			</TABLE>
			</FORM>
		</DIV>
		<DIV class="cl"></DIV>
	</DIV>
</DIV>
</BODY>
</HTML>
