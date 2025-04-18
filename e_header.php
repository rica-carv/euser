<?php
//var_dump ($eMenuActive);
//echo "----------------------";

if (!defined('e107_INIT')) { exit; }

// A porcaria do emenuactive não funciona....
//global $eMenuActive;
//var_dump ($eMenuActive['chatbox_menu']);
//e107::getMessage()->addError(var_dump ($eMenuActive), 'default', true);

//if(USER_AREA && e107::getMenu()->isLoaded('login'))
//{
//	e107::css('news','news_carousel.css');
//}

///////$lan_file = e_PLUGIN.'euser/languages/'.e_LANGUAGE.'.php';
///////include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.'euser/languages/English.php');
//include_once(e_PLUGIN."euser/functions.php");
include_once(e_PLUGIN.'euser/euser_class.php');

$euser_pref = e107::getPlugPref('euser');

if (e_PAGE == "forum_viewtopic.php") {
	echo "<!-- OIM forum view -->";
	if (file_exists(THEME.'forum_viewtopic_template.php'))
	{
	require_once(THEME."forum_viewtopic_template.php");
	}else{
	require_once(e_PLUGIN."forum/templates/forum_viewtopic_template.php");
	}
	

	
	$FORUMTHREADSTYLE=str_replace('{POSTER}','{OIM_POSTER}',$FORUMTHREADSTYLE);	
	$FORUMREPLYSTYLE=str_replace('{POSTER}','{OIM_POSTER}',$FORUMREPLYSTYLE);
	
//	$FORUMEND=str_replace('{FORUMJUMP}','{FORUMJUMP}'.colourkey(0).'<br />',$FORUMEND);
	$FORUMEND=str_replace('{FORUMJUMP}','{FORUMJUMP}{ELM_COLOURKEY}<br />',$FORUMEND);

	
	}
	

if (e_PAGE == "user.php") {
	echo "<!-- OIM  user view -->";
	//$USER_FULL_TEMPLATE
	$USER_FULL_TEMPLATE=str_replace('{USER_NAME}','{OIM_USER_NAME}',$USER_FULL_TEMPLATE);	
	
}

/*
+---------------------------------------------------------------+
| Another Profiles Plugin v0.9.6
| Copyright © 2008 Istvan Csonka
| http://freedigital.hu
| support@freedigital.hu
|
|        For the e107 website system
|        ©Steve Dunstan
|        http://e107.org
|        jalist@e107.org
|
| (The original program is Alternate Profiles v2.0
| boreded.co.uk)
|
| Another Profiles Plugin comes with
| ABSOLUTELY NO WARRANTY
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (e107::isInstalled('euser')) {
  if (($euser_pref['redirect_usersettings'] && e_PAGE == "forum_viewtopic.php") && ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "")) {
	require_once(e_PLUGIN."forum/templates/forum_viewtopic_template.php");
	if(file_exists(e_PLUGIN."euser/languages/".e_LANGUAGE.".php")){
		require_once(e_PLUGIN."euser/languages/".e_LANGUAGE.".php");
	} else {
		require_once(e_PLUGIN."euser/languages/English.php");
	}
	$forum_old = "{PRIVMESSAGE}";
	$forum_new = "{PRIVMESSAGE} {FORUMADD}";
	$FORUMTHREADSTYLE = str_replace($forum_old, $forum_new, $FORUMTHREADSTYLE);
	$FORUMREPLYSTYLE = str_replace($forum_old, $forum_new, $FORUMREPLYSTYLE);
  }
}
