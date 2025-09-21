<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Steve Dunstan 2001-2002
|     Copyright (C) 2008-2010 e107 Inc (e107.org)
|
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/login_menu/login_menu_template.php $
|     $Revision: 11678 $
|     $Id: login_menu_template.php 11678 2010-08-22 00:43:45Z e107coders $
|     $Author: e107coders $
+----------------------------------------------------------------------------+

############# PARCIALMENTE Actualizado para E107 V2.0
*/
$sc_style['LM_SIGNUP_LINK']['pre'] = "<br />";
$sc_style['LM_SIGNUP_LINK']['post'] = "";
$sc_style['LM_FPW_LINK']['pre'] = "<br />";
$sc_style['LM_FPW_LINK']['post'] = "";
$sc_style['LM_RESEND_LINK']['pre'] = "<br />";
$sc_style['LM_RESEND_LINK']['post'] = "";
/*
$sc_style['LM_REMEMBERME']['pre'] = "<br />";
$sc_style['LM_REMEMBERME']['post'] = "";
*/
if (!isset($EUSER_LOGIN_MENU_FORM)){
	$EUSER_LOGIN_MENU_FORM = "<div style='text-align: center' id='login_oim'><table><tr><td width=65%>{LM_USERNAME_INPUT}<br>{LM_PASSWORD_INPUT}<br>{LM_IMAGECODE}<p>{LM_LOGINBUTTON}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{LM_REMEMBERME}</td><td><center>".(LOGINMESSAGE!= 'LOGINMESSAGE' ? "{LM_FPW_LINK}<hr>{LM_RESEND_LINK}<br/>":"Ainda não é membro?{LM_SIGNUP_LINK}<br>É gratuito!")."</td></tr></table></div>";
}
if (!isset($EUSER_LOGIN_MENU_LOGGED)){
    $sc_style['LM_ADMINLINK']['pre'] = "";
	$sc_style['LM_ADMINLINK']['post'] = "&nbsp;";
	$EUSER_LOGIN_MENU_LOGGED = "
		{LM_MAINTENANCE}
		{LM_ADMINLINK_BULLET} {LM_ADMINLINK} <BR>
		{LM_BULLET} {LM_USERSETTINGS}<BR>
		{LM_BULLET}	{LM_PROFILE}<br><br>
		{LM_BULLET} {LM_LOGOUT}
</td></tr></table>
	";
}
if (!isset($EUSER_LOGIN_MENU_MESSAGE)){
$sc_style['LM_MESSAGE']['pre'] = "<div id='warningoverlay'><a class='warning' href='#warningoverlay'><div id=warning>";
	$EUSER_LOGIN_MENU_MESSAGE = "{LM_MESSAGE}";
//	$EUSER_LOGIN_MENU_MESSAGE = "<div id='warningoverlay'><a class='warning' href='#warningoverlay'>{LM_MESSAGE}</a></div>";
$sc_style['LM_MESSAGE']['post'] = "</div></a></div>";
}
?>