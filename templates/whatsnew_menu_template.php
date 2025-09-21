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
//var_dump (">>>>>>>>>>>>>".isset($EUSER_ALL_MENU_STATS)."<<<<<<<<<<<<");
//var_dump (">>>>>>>>>>>>WHATSNEW<<<<<<<<<<<");
/*
    $sc_style['LM_NEW_NEWS']['pre'] = '<li class="nav-header login-menu-stats smalltext">'.LAN_LOGINMENU_25.':</li><li>';
	$sc_style['LM_STATS']['post'] = '</li>';
*/
//$EXTRAINFO_MENU_TEMPLATE['core'] = '<ul class="login-menu-logged nav nav-list"><li class="nav-header login-menu-stats smalltext">'.LAN_LOGINMENU_25.':</li><li>{LM_NEW_NEWS}{LM_NEW_COMMENTS}{LM_NEW_USERS}{LM_PLUGIN_STATS}</li></ul>';

$WHATSNEW_MENU_WRAPPER['main']['EWNM_ADMIN'] = "<a class='login_menu_link admin' id='login_menu_link_admin' href='".e_ADMIN_ABS."admin.php'><b>".ADMINAREA."</b></a>{---}"; 

/////////////////////// ADMIN ICON "<a class='login_menu_link admin' id='login_menu_link_admin' href='".e_ADMIN_ABS."admin.php' data-toggle='tooltip' title='".ADMINAREA."'><span class='glyphicon glyphicon-wrench'></span></a>"; 

$WHATSNEW_MENU_TEMPLATE['main'] = '{EWNM_ADMIN}<ol class="login-menu-logged nav nav-list">{EWNM_UPDATED}</ol>{EWNM_BIRTHDAY}{EWNM_LASTVISITORS}';

/*
$WHATSNEW_MENU_TEMPLATE['login_menu'] = '<li class="nav-header login-menu-stats smalltext"><b>'.LAN_LOGINMENU_25.':</b></li><li>
        {LM_NEW_NEWS}<br>
        {LM_NEW_COMMENTS}<br>
        {LM_NEW_USERS}<br>
        {LM_PLUGIN_STATS}</li>
';
*/

$WHATSNEW_MENU_TEMPLATE['section_head'] = '<div class="smallblacktext"><a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{HEAD_ID}" aria-expanded="true" aria-controls="collapse{HEAD_ID}"><b>{HEAD}</b></a></div><div id="collapse{HEAD_ID}" class="collapse" role="tabpanel" aria-labelledby="headingOne">';

$WHATSNEW_MENU_TEMPLATE['section_line'] = '<div>{LINE_START}<span class="badge">{LINE_END}</span></div>';

$WHATSNEW_MENU_TEMPLATE['section_end'] = '</div>';

/*
$WHATSNEW_MENU_TEMPLATE['stat_head'] = '<div class="smallblacktext"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{HEAD_ID}" aria-expanded="true" aria-controls="collapse{HEAD_ID}"><b>{HEAD}</b></a></div><div id="collapse{HEAD_ID}" class="collapse in" role="tabpanel" aria-labelledby="headingOne">';

$WHATSNEW_MENU_TEMPLATE['stat_line'] = '<div>{LINE_START}<span class="badge">{LINE_END}</span></div>';

$WHATSNEW_MENU_TEMPLATE['stat_end'] = '</div>';

if ( !isset($EUSER_EXTRAINFO_MENU_STATS))
{
    $sc_style['LM_NEW_NEWS']['pre'] = '';
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
//	$EUSER_ALL_MENU_STATS = $LOGIN_MENU_STATS;
  //'

//    ';

//$EUSER_EXTRAINFO_MENU_STATS = '{LM_NEW_NEWS}{LM_NEW_COMMENTS}{LM_NEW_USERS}{LM_PLUGIN_STATS}';

//var_dump ($EUSER_ALL_MENU_STATS);
//}
//var_dump (">>>>>>>>>>>>>".$EUSER_ALL_MENU_STATS."<<<<<<<<<<<<");
/*
$LM_STATITEM_SEPARATOR = '<br />';
if (!isset($LOGIN_MENU_STATITEM))
{
	$LOGIN_MENU_STATITEM = '
        {LM_STAT_NEW} {LM_STAT_LABEL}{LM_STAT_EMPTY}
    ';

}
*/
?>