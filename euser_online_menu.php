<?php
// ###########################################################################################
// PREFIRO USAR UMA CÓPIA DO ONLINE MENU PORQUE NÃO TENHO GARANTIAS DE ESTAR NO CORE...
// ###########################################################################################
/*
 * e107 website system
 *
 * Copyright (C) 2008-2009 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * e107 Main
 *
 * $Source: /cvs_backup/e107_0.8/e107_plugins/online/online_menu.php,v $
 * $Revision$
 * $Date$
 * $Author$
*/

if (!defined('e107_INIT')) { exit; }

//global $pref;
//global $menu_pref;
// Defaults to global pref if no parm from menu pref
//if (!$parm) {$parm = e107::getPlugPref('euser');}
// Forces retrieval of menu pref if no parm from menu pref
//    var_dump ($parm);
// Tirar caso aprovem o issue... os parms só vem por defeito das prefs em último caso...
if (!$parm) {$parm = e107::getPlugPref('euser');}

$tp = e107::getParser();

//e107::lan('euser', 'online_menu', true);
e107::lan('euser', 'front', true);
//include_lan(e_PLUGIN.'euser/languages/'.e_LANGUAGE.'/'.e_LANGUAGE.'_front.php');


//$core_online_menu = str_replace(array("\e107::getRender()->tablerender(\$caption, \$text, 'online_extended');","<?php","?\>"), "", file_get_contents(e_PLUGIN."online/online_menu.php"));

/*
$mes = e107::getMessage();
$mes->addDebug("-vvvvvvvv-");
$mes->addDebug($core_login_menu);
$mes->addDebug("-^^^^^^^^-");
*/

//ob_start();
//eval ($core_online_menu);

//e107::getOnline()->goOnline();
	$sc = e107::getScBatch('online', 'euser');

//  Não vale a pena, o único parm aqui é o do menu caption...
//  $sc->setVars($parm);

//--require_once(e_PLUGIN.'euser/online_shortcodes.php');
//--$mode = empty($menu_pref['online_show_memberlist_extended']) ? 'default' : 'extended';
//--$sc = new online_shortcodes;
$sc->wrapper('online_menu');

if(deftrue('BOOTSTRAP'))
{
	$template = e107::getTemplate('euser', 'online_menu');
}
/*--
else
{

		// legacy default ------------------------

		global $sc_style;

		$sc_style['ONLINE_GUESTS']['pre'] = "<li>".LAN_EUSER_101;
		$sc_style['ONLINE_GUESTS']['post'] = "</li>";

		$sc_style['ONLINE_MEMBERS']['pre'] = "<li>".LAN_EUSER_102;
		$sc_style['ONLINE_MEMBERS']['post'] = "</li>";

		$sc_style['ONLINE_MEMBERS_LIST']['pre'] = "<ul>";
		$sc_style['ONLINE_MEMBERS_LIST']['post'] = "</ul>";

		$sc_style['ONLINE_MEMBERS_LIST_EXTENDED']['pre'] = "<ul class='unstyled list-unstyled'>";
		$sc_style['ONLINE_MEMBERS_LIST_EXTENDED']['post'] = "</ul>";

		$sc_style['ONLINE_ONPAGE']['pre'] = "<li>".LAN_EUSER_103;
		$sc_style['ONLINE_ONPAGE']['post'] = "</li>";

		$sc_style['ONLINE_MEMBER_TOTAL']['pre'] = "<li>".LAN_EUSER_102;
		$sc_style['ONLINE_MEMBER_TOTAL']['post'] = "</li>";

		$sc_style['ONLINE_MEMBER_NEWEST']['pre'] = "<li>".LAN_EUSER_106;
		$sc_style['ONLINE_MEMBER_NEWEST']['post'] = "</li>";

		$sc_style['ONLINE_MOST']['pre'] = LAN_EUSER_108;
		$sc_style['ONLINE_MOST']['post'] = "<br />";

		$sc_style['ONLINE_MOST_MEMBERS']['pre'] = LAN_EUSER_102;
		$sc_style['ONLINE_MOST_MEMBERS']['post'] = "";

		$sc_style['ONLINE_MOST_GUESTS']['pre'] = "".LAN_EUSER_101;
		$sc_style['ONLINE_MOST_GUESTS']['post'] = ", ";

		$sc_style['ONLINE_MOST_DATESTAMP']['pre'] = "".LAN_EUSER_109;
		$sc_style['ONLINE_MOST_DATESTAMP']['post'] = "";

		$template['enabled'] = "

		<ul class='online-menu'>
		{ONLINE_GUESTS}
		{ONLINE_MEMBERS}
		{ONLINE_MEMBERS_LIST_EXTENDED}
		{ONLINE_ONPAGE}
		{ONLINE_MEMBER_TOTAL}
		{ONLINE_MEMBER_NEWEST}
		<li>
		{ONLINE_MOST}
		<small class='text-muted muted'>
		{ONLINE_MOST_GUESTS}
		{ONLINE_MOST_MEMBERS}
		{ONLINE_MOST_DATESTAMP}
		</small>
		</li>
		</ul>
		";

		//##### ONLINE TRACKING DISABLED ----------------------------------------------
		$template['disabled'] = "{ONLINE_TRACKING_DISABLED}";

		//##### ONLINE MEMBER LIST EXTENDED -------------------------------------------
		$template['online_members_list_extended'] = "{SETIMAGE: w=40}<li class='media'><span class='media-object pull-left'>{ONLINE_MEMBER_IMAGE=avatar}</span><span class='media-body'>{ONLINE_MEMBER_USER} ".LAN_EUSER_107." {ONLINE_MEMBER_PAGE}</span></li>";





	if (is_readable(THEME.'templates/online/online_menu_template.php'))
	{
		require(THEME.'templates/online/online_menu_template.php');
	}
	elseif (is_readable(THEME.'online_menu_template.php'))
	{
		require(THEME.'online_menu_template.php');
	}
	else
	{
		require(e_PLUGIN.'online/templates/online_menu_template.php');
	}


}

--*/


//$sc->memberTemplate = $template['online_members_list_extended'];
//$sc->newestTemplate = $template['online_member_newest'];

//if(!defined('e_TRACKING_DISABLED') && varsettrue($pref['track_online']))
if(!defined('e_TRACKING_DISABLED'))
{
	$text = $tp->parseTemplate($template['enabled'], TRUE, $sc);
}
else
{
	if (ADMIN)
	{
		$text = $tp->parseTemplate($template['disabled'], TRUE, $sc);
	}
	else
	{
		return;
	}
}

$img = (is_readable(THEME.'images/online_menu.png') ? "<img src='".THEME_ABS."images/online_menu.png' alt='' />" : '');

//$caption = $img.' '.vartrue($menu_pref['online_caption'], LAN_EUSER_104);
//var_dump ($parm);
//var_dump ($parm['online_caption']);
//$caption = $img.' '.vartrue($parm['online_caption'], LAN_EUSER_104);
$caption = $img.' '.($parm['online_caption']?:LAN_EUSER_104);

/*--
if (getperms('1')) 
{
	$path = e_PLUGIN_ABS."online/config.php?iframe=1";
	$caption .= "<a class='e-modal pull-right' href='".$path."' title='Configure'><i class='glyphicon glyphicon-cog'></i></a>";
}
*/
$ns->tablerender($caption, $text, 'euser_online_menu');

?>