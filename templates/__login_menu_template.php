<?php

//ECHO "aquiiiiiiiiiiiiiiiiii";
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
*/
$sc_style['LM_SIGNUP_LINK']['pre'] = "<br />";
$sc_style['LM_SIGNUP_LINK']['post'] = "";

$sc_style['LM_FPW_LINK']['pre'] = "<br />";
$sc_style['LM_FPW_LINK']['post'] = "";

$sc_style['LM_RESEND_LINK']['pre'] = "<br />";
$sc_style['LM_RESEND_LINK']['post'] = "";

$sc_style['ELM_COLOURKEY']['pre'] = "</div><div class='panel-footer'>";
$sc_style['ELM_COLOURKEY']['post'] = "</div><div>";
/*
$sc_style['LM_REMEMBERME']['pre'] = "<br />";
$sc_style['LM_REMEMBERME']['post'] = "";
*/

// Aqui vai ser usado o do core por defeito, logo vai desaparecer....
if (!isset($EUSER_LOGIN_MENU_FORM)){
// Template v2.x
	$EUSER_LOGIN_MENU_FORM['head'] = LAN_LOGINMENU_5." ---- ".EUSER_LOGIN_MENU_L46;
	$EUSER_LOGIN_MENU_FORM = "{EMBEDMENU:path=login_menu&menu=login}{ELM_COLOURKEY}";
/*
	$EUSER_LOGIN_MENU_FORM = "{ELM_CORELOGINMENU}
	<div style='text-align: center'><table><tr><td>".
    LOGIN_MENU_L1."
</td><td style='border: transparent 3px solid;'>\n
	{LM_USERNAME_INPUT}
</td></tr><tr><td>".
	LOGIN_MENU_L2."
</td><td  style='border: transparent 3px solid;'>\n
    {LM_PASSWORD_INPUT}
</td></tr></table>
{LM_IMAGECODE}
<CENTER>
{LM_REMEMBERME}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
{LM_LOGINBUTTON}
</CENTER>
".(LOGINMESSAGE ? "{LM_FPW_LINK}{LM_RESEND_LINK}<br/>":"")."
	<br/>Ainda não é membro? {LM_SIGNUP_LINK} É gratuito!
	</div>
	";
*/
}





/*
if (!isset($EUSER_LOGIN_MENU_LOGGED)){
    $sc_style['LM_ADMINLINK']['pre'] = "";
	$sc_style['LM_ADMINLINK']['post'] = "&nbsp;";

	$EUSER_LOGIN_MENU_LOGGED = "
		{LM_AVATAR}<hr>{LM_COREHTML}<br>
    {LM_MAINTENANCE}
		{LM_ADMINLINK_BULLET} {LM_ADMINLINK} <BR>
		{LM_BULLET} {LM_USERSETTINGS}<BR>
		{LM_BULLET}	{LM_PROFILE}<br><br>
		{LM_BULLET} {LM_LOGOUT}
</td></tr></table>
	";
}

if (!isset($EUSER_LOGIN_MENU_MESSAGE)){
	$EUSER_LOGIN_MENU_MESSAGE = "{LM_MESSAGE}";
}
*/
// Cópia do login_menu_template.php
if (!isset($EUSER_LOGIN_MENU_LOGGED))
{
// New Template for v2. Bullets via CSS etc. Login-Menu Stats may require work. 
    $sc_style['LM_MAINTENANCE']['pre'] = '<li class="login-menu-maintenance">';
	$sc_style['LM_MAINTENANCE']['post'] = '</li>';
    $sc_style['LM_ADMINLINK']['pre'] = '<li class="login-menu-admin">';
	$sc_style['LM_ADMINLINK']['post'] = '</li>';
    $sc_style['LM_USERSETTINGS']['pre'] = '<li class="login-menu-usersettings">';
	$sc_style['LM_USERSETTINGS']['post'] = '</li>';
    $sc_style['LM_PROFILE']['pre'] = '<li class="login-menu-profile">';
	$sc_style['LM_PROFILE']['post'] = '</li>';
    $sc_style['LM_EXTERNAL_LINKS']['pre'] = '<li class="login-menu-external">';
	$sc_style['LM_EXTERNAL_LINKS']['post'] = '</li>';
    $sc_style['LM_STATS']['pre'] = '<li class="nav-header login-menu-stats smalltext">'.LAN_LOGINMENU_25.':</li><li>';
	$sc_style['LM_STATS']['post'] = '</li>';
    $sc_style['LM_LISTNEW_LINK']['pre'] = '<li class="login-menu-listnew">';
	$sc_style['LM_LISTNEW_LINK']['post'] = '</li>';
    $sc_style['LM_ADMIN_CONFIGURE']['pre'] = '<li class="login-menu-admin-config">';
	$sc_style['LM_ADMIN_CONFIGURE']['post'] = '</li>';
	
    $sc_style['LM_LOGOUT']['pre'] = '<li class="login-menu-logout">';
	$sc_style['LM_LOGOUT']['post'] = '</li>';
	
//Aqui uso os shortcodes misturados do plugin e do login_menu do core...
// Template v1.4 (por defeito?)
/*
	$EUSER_LOGIN_MENU_LOGGED = '
	<ul class="login-menu-logged nav nav-list">
		{SETIMAGE: w=50}{ELM_AVATAR}<hr>
    {LM_MAINTENANCE}
		{LM_ADMINLINK}
		{LM_USERSETTINGS}
		{LM_PROFILE}
		{LM_ADMIN_CONFIGURE}
		{LM_EXTERNAL_LINKS}
		{LM_LOGOUT}
		{LM_LISTNEW_LINK}
	</ul>
    <hr>{ELM_PM}</hr>
    <hr>{ELM_ONLINE}</hr>
    <hr>{ELM_FC}</hr>
    <hr>{ELM_FRIENDS}</hr>
    <hr>{ELM_EXTRAINFO}</hr>
    <hr>{ELM_TMEMBERS}</hr>
    {ELM_COLOURKEY}
';
*/
// Template v2.x
	$EUSER_LOGIN_MENU_LOGGED['head'] = "{SETIMAGE: w=20}{ELM_AVATAR} ".LAN_LOGINMENU_5.' '.USERNAME." <a class='e-modal pull-right' href='{LM_LOGOUT_HREF}' title='".LAN_LOGOUT."'><i class='glyphicon glyphicon-log-out'></i></a>";
	$EUSER_LOGIN_MENU_LOGGED = '
	<ul class="login-menu-logged nav nav-list">
    {LM_MAINTENANCE}
		{LM_ADMINLINK}
		{LM_USERSETTINGS}
		{LM_PROFILE}
		{LM_ADMIN_CONFIGURE}
		{LM_EXTERNAL_LINKS}
		{LM_LISTNEW_LINK}
	</ul>
    <hr>{ELM_PM}</hr>
    <div style="height: 50%; overflow-y: hidden; overflow: auto;">
    {EMBEDMENU:menu=euser_online&caption=smallblacktext}
    <hr>{EMBEDMENU:menu=euser_fc&caption=smallblacktext}
    <hr>{EMBEDMENU:menu=euser_friends&caption=smallblacktext}
    <hr>{EMBEDMENU:menu=euser_lastcomments&caption=smallblacktext}
    <hr>{EMBEDMENU:menu=euser_extrainfo&caption=smallblacktext}
    <hr>{EMBEDMENU:menu=euser_tmembers&caption=smallblacktext}
    </div>
    {ELM_COLOURKEY}';
}

if ( ! isset($EUSER_LOGIN_MENU_EXTERNAL_LINK))
{
	$EUSER_LOGIN_MENU_EXTERNAL_LINK = '
		{LM_BULLET} {LM_EXTERNAL_LINK}<br />
	';
}

//var_dump (">>>>>>>>>>>>>".isset($EUSER_LOGIN_MENU_STATS)."<<<<<<<<<<<<");
if ( ! isset($EUSER_LOGIN_MENU_STATS))
{
/*    $sc_style['LM_NEW_NEWS']['pre'] = '';
	$sc_style['LM_NEW_NEWS']['post'] = '<br />';
    $sc_style['LM_NEW_COMMENTS']['pre'] = '';
	$sc_style['LM_NEW_COMMENTS']['post'] = '<br />';
    $sc_style['LM_NEW_CHAT']['pre'] = '';
	$sc_style['LM_NEW_CHAT']['post'] = '<br />';
    $sc_style['LM_NEW_FORUM']['pre'] = '';
	$sc_style['LM_NEW_FORUM']['post'] = '<br />';
    $sc_style['LM_NEW_USERS']['pre'] = '';
	$sc_style['LM_NEW_USERS']['post'] = '<br />';
*/
//	$EUSER_LOGIN_MENU_STATS = $LOGIN_MENU_STATS;
  //'
        $EUSER_LOGIN_MENU_STATS = '{LM_STATS}';
//    ';
/*
        {LM_NEW_NEWS}
        {LM_NEW_COMMENTS}
        {LM_NEW_USERS}
        {LM_PLUGIN_STATS}
*/
//var_dump ($EUSER_LOGIN_MENU_STATS);
}
//var_dump (">>>>>>>>>>>>>".$EUSER_LOGIN_MENU_STATS."<<<<<<<<<<<<");
$LM_STATITEM_SEPARATOR = '<br />';
if (!isset($EUSER_LOGIN_MENU_STATITEM))
{
	$EUSER_LOGIN_MENU_STATITEM = '
        {LM_STAT_NEW} {LM_STAT_LABEL}{LM_STAT_EMPTY}
    ';
}
?>