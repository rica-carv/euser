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
/*
$sc_style['LM_SIGNUP_LINK']['pre'] = "<br />";
$sc_style['LM_SIGNUP_LINK']['post'] = "";

$sc_style['LM_FPW_LINK']['pre'] = "<br />";
$sc_style['LM_FPW_LINK']['post'] = "";

$sc_style['LM_RESEND_LINK']['pre'] = "<br />";
$sc_style['LM_RESEND_LINK']['post'] = "";

$sc_style['ELM_COLOURKEY']['pre'] = "</div><div class='panel-footer'>";
$sc_style['ELM_COLOURKEY']['post'] = "</div><div>";
*/
/*
$SC_WRAPPER['LM_SIGNUP_LINK']= "<br>{---}";
$SC_WRAPPER['LM_FPW_LINK']= "<br>{---}";
$SC_WRAPPER['LM_RESEND_LINK']= "<br>{---}";
*/
$DASHBOARD_MENU_WRAPPER['form']['EAM_COLOURKEY']=$DASHBOARD_MENU_WRAPPER['logged']['EAM_COLOURKEY']= "</div><div class='panel-footer'>{---}</div><div>";
/*
$DASHBOARD_MENU_TEMPLATE['form']['ELM_COLOURKEY']=$DASHBOARD_MENU_TEMPLATE['logged']['ELM_COLOURKEY']= "</div><div class='panel-footer'>{---}</div><div>";
*/

/*
$sc_style['LM_REMEMBERME']['pre'] = "<br />";
$sc_style['LM_REMEMBERME']['post'] = "";
*/

// Aqui vai ser usado o do core por defeito, logo vai desaparecer....
//---if (!isset($EUSER_DASHBOARD_MENU_FORM)){
// Template v2.x
//---	$EUSER_DASHBOARD_MENU_FORM_HEAD = LAN_LOGINMENU_5." ".EUSER_LOGIN_MENU_L46;
//---		$EUSER_DASHBOARD_MENU_FORM = "{EMBEDMENU:path=login_menu&menu=login}{ELM_COLOURKEY}";
	$DASHBOARD_MENU_TEMPLATE['form_head'] = LAN_EUSER_005." ".LAN_EUSER_0046;
	$DASHBOARD_MENU_TEMPLATE['form'] = "{EMBEDMENU:path=login_menu&name=login}{EAM_COLOURKEY}";
/*
	$EUSER_DASHBOARD_MENU_FORM = "{ELM_CORELOGINMENU}
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
//---}





/*
if (!isset($EUSER_DASHBOARD_MENU_LOGGED)){
    $sc_style['LM_ADMINLINK']['pre'] = "";
	$sc_style['LM_ADMINLINK']['post'] = "&nbsp;";

	$EUSER_DASHBOARD_MENU_LOGGED = "
		{LM_AVATAR}<hr>{LM_COREHTML}<br>
    {LM_MAINTENANCE}
		{LM_ADMINLINK_BULLET} {LM_ADMINLINK} <BR>
		{LM_BULLET} {LM_USERSETTINGS}<BR>
		{LM_BULLET}	{LM_PROFILE}<br><br>
		{LM_BULLET} {LM_LOGOUT}
</td></tr></table>
	";
}

if (!isset($EUSER_DASHBOARD_MENU_MESSAGE)){
	$EUSER_DASHBOARD_MENU_MESSAGE = "{LM_MESSAGE}";
}
*/
// Cópia do login_menu_template.php
//---if (!isset($EUSER_DASHBOARD_MENU_LOGGED))
//---{
// New Template for v2. Bullets via CSS etc. Login-Menu Stats may require work. 
/*
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
*/

$DASHBOARD_MENU_WRAPPER['logged']['LM_MAINTENANCE']= "<li class='login-menu-maintenance'>{---}</li>";
$DASHBOARD_MENU_WRAPPER['logged']['LM_ADMINLINK']= "<li class='login-menu-admin'>{---}</li>";
$DASHBOARD_MENU_WRAPPER['logged']['LM_USERSETTINGS']= "<li class='login-menu-usersettings'>{---}</li>";
$DASHBOARD_MENU_WRAPPER['logged']['LM_PROFILE']= "<li class='login-menu-profile'>{---}</li>";
$DASHBOARD_MENU_WRAPPER['logged']['LM_EXTERNAL_LINKS']= "<li class='login-menu-external'>{---}</li>";
//$DASHBOARD_MENU_WRAPPER['logged']['LM_STATS']= "<li class='nav-header login-menu-stats smalltext'>".LAN_LOGINMENU_25.":</li><li>{---}</li>";
$DASHBOARD_MENU_WRAPPER['logged']['LM_LISTNEW_LINK']= "<li class='login-menu-listnew'>{---}</li>";
$DASHBOARD_MENU_WRAPPER['logged']['LM_ADMIN_CONFIGURE']= "<li class='login-menu-admin-config'>{---}</li>";
$DASHBOARD_MENU_WRAPPER['logged']['LM_LOGOUT']= "<li class='login-menu-logout'>{---}</li>";
	
//Aqui uso os shortcodes misturados do plugin e do login_menu do core...
// Template v1.4 (por defeito?)
/*
	$EUSER_DASHBOARD_MENU_LOGGED = '
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
/*
	$EUSER_DASHBOARD_MENU_LOGGED_HEAD = "<a href='{LM_PROFILE_HREF}' title='".USERNAME.' - '.EUSER_LOGIN_MENU_L13."'>{SETIMAGE: w=20}{ELM_AVATAR} ".LAN_LOGINMENU_5.' '.USERNAME."</a> <a class='pull-right' href='{LM_LOGOUT_HREF}' title='".LAN_LOGOUT."'>".IMAGE_logout."</a>";
	$EUSER_DASHBOARD_MENU_LOGGED = '
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
    {EMBEDMENU:menu=online&caption=smallblacktext}
    <hr>{EMBEDMENU:menu=fc&caption=smallblacktext}
    <hr>{EMBEDMENU:menu=friends&caption=smallblacktext}
    <hr>{EMBEDMENU:menu=lastcomments&caption=smallblacktext}
    <hr>{EMBEDMENU:menu=extrainfo&caption=bg-info}
    <hr>{EMBEDMENU:menu=tmembers&caption=smallblacktext}
    </div>
    {ELM_COLOURKEY}';
*/
$DASHBOARD_MENU_WRAPPER['logged']['EAM_AVATAR']= "<a href='{LM_PROFILE_HREF}' title='".USERNAME.' - '.LAN_EUSER_0013."'>{---} ".LAN_LOGINMENU_5.' '.USERNAME."</a>";
$DASHBOARD_MENU_WRAPPER['logged']['LM_LOGOUT_HREF']= "<a class='pull-right' href='{---}' title='".LAN_LOGOUT."'>".IMAGE_logout."</a>";

//  $DASHBOARD_MENU_TEMPLATE['logged']['head'] = "<a href='{LM_PROFILE_HREF}' title='".USERNAME.' - '.LAN_EUSER_0013."'>{SETIMAGE: w=20}{ELM_AVATAR} ".LAN_LOGINMENU_5.' '.USERNAME."</a> <a class='pull-right' href='{LM_LOGOUT_HREF}' title='".LAN_LOGOUT."'>".IMAGE_logout."</a>";

/////////////////////// ICON USERSETTINGS "<a href='{LM_USERSETTINGS_HREF}' data-toggle='tooltip' title='".LAN_SETTINGS."'><span class='glyphicon glyphicon-cog'></span></a>";

  $DASHBOARD_MENU_TEMPLATE['logged']['head'] = "{SETIMAGE: w=20}{EAM_AVATAR} {LM_LOGOUT_HREF}";
	$DASHBOARD_MENU_TEMPLATE['logged']['body'] = "
	<ul class='login-menu-logged nav nav-list'>
    {LM_MAINTENANCE}
		{LM_USERSETTINGS} 
		{LM_PROFILE}
		{LM_ADMIN_CONFIGURE}
		{LM_EXTERNAL_LINKS}
		{LM_LISTNEW_LINK}
	</ul>
    <div style='height: 50%; overflow-y: hidden; overflow: auto;'>
    <hr>{EUSER_EMBEDMENU:name=pm&caption=lead}
    <hr>{EUSER_EMBEDMENU:name=online&caption=lead}
    <hr>{EUSER_EMBEDMENU:name=fc&caption=smallblacktext}
    <hr>{EUSER_EMBEDMENU:name=friends&caption=smallblacktext}
    <hr>{EUSER_EMBEDMENU:name=lastcomments&caption=smallblacktext}
    <hr>{EUSER_EMBEDMENU:name=whatsnew&caption=lead}
    <hr>{EUSER_EMBEDMENU:name=stats&caption=lead}
    <hr>{EUSER_EMBEDMENU:name=tmembers&caption=smallblacktext}
    </div>
    {EUSER_COLOURKEY}";


//$SC_WRAPPER['ELM_ADMIN_ICON'] = "<div class='btn-group btn-group-xs'><a class='login_menu_link admin btn btn-primary' id='login_menu_link_admin' href='{LM_ADMINLINK}'>{---}'<span class='badge'>{ELM_ADMIN_COUNT}</span></a></div>";
//---}
/*****************************************
            ICONIZED MICRO MENU
            
            Tem de se embede o menu porque senão não há valores no contador....
*****************************************
$SC_WRAPPER['LM_ADMINLINK']= "";

	$DASHBOARD_MENU_TEMPLATE['logged'] = '{EMBEDMENU:menu=extrainfo&caption=bg-info}
    {ELM_ADMIN_ICON}';    
    
    ou
    
	$DASHBOARD_MENU_TEMPLATE['logged'] = '{EMBEDMENU:menu=extrainfo&caption=bg-info}
        <div class='btn-group btn-group-xs'><a class='login_menu_link admin btn btn-primary' id='login_menu_link_admin' href='{LM_ADMINLINK=href}'>".IMAGE_admin."<span class='badge'>{ELM_ADMIN_COUNT}</span></a></div>';



Falta criar estes shortcodes:
Mensagens recebidas (com indicador numérico + link)
Mensagens enviadas (com indicador numérico + link)
Criar Mensagen (link)

Novidades no site (com indicador numérico + link)

Total utilizadores (com indicador numérico + link)
Último utilizador registado (link)
Meus amigos (com indicador numérico + link)
Actualmente online (com indicador numérico + link)
******************************************/
//---if ( ! isset($EUSER_DASHBOARD_MENU_EXTERNAL_LINK))
//---{
/*
	$EUSER_DASHBOARD_MENU_EXTERNAL_LINK = '
		{LM_BULLET} {LM_EXTERNAL_LINK}<br />
	';
*/
	$DASHBOARD_MENU_TEMPLATE['external_link'] = '
		{LM_BULLET} {LM_EXTERNAL_LINK}<br />
	';
//---}
?>