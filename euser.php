<?php
/*
+---------------------------------------------------------------+
| Another Profiles Plugin v0.9.8 Spt(2.0)
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

// ############################
// ####    PARA FAZER..... ####
// ############################
/*
- Alterar o GET para o id normal do user.php standard, para tentar usar as funções de base em lugar de reinventar a roda....
- O avatar é para esquecer, por enquanto tem de ficar com o str_replace....
*/
// ############################
// ####    PARA FAZER..... ####
// ############################

//if (!defined('e107_INIT')) { exit; }  // Isto não funciona, não sei porquê....
//var_dump('e107_INIT');
if (!defined('e107_INIT'))
{
	require_once(__DIR__.'/../../class2.php');
}
// If not a valid call to the script then leave it
if (!defined('e107_INIT')) { exit;}

e107::getTemplate('euser', 'icons');
//var_dump ("sadklasdlçjksakldj");
// Passar para usar a msg?       echo $msg->render();

if (!e107::isInstalled('euser')) {
	$ns->tablerender(IMAGE_alert,IMAGE_bigalert.PROFILE_2a);
	require_once(FOOTERF);
	exit;
}

//FAILSAFE DO GET....
/*
function checkget($string)
{
	switch ($string) {
    	case comments;
    	case friends;
    	case images;
    	case videos;
        	return $string;
//        	break;
    	default;
        	return NULL;
//        break;
	}
}
*/
//echo "<hr>";
//echo filter_input(INPUT_GET, 'page', FILTER_CALLBACK, array("options"=>"checkget"));
//echo "<hr>";
// Para quê reinventar a roda e transformar isto para um $_GET?????
// Talvez usar um $_POST??? O $_GET[page] é usado, mas pode ser alterado..
$_GET['page'] = filter_input(INPUT_GET, 'page', FILTER_CALLBACK, array("options"=>"checkget"));

//		require_once(e_PLUGIN."euser/euser_shortcodes.php");
//$user_sc = e107::getScBatch('euser', 'euser');
//var_dump ($user_sc);
//$user_sc->wrapper('euser/view');
//e107_0.8 compatible
/*if(file_exists(e_FILE."shortcode/batch/user_shortcodes.php")){
	require_once(e_FILE."shortcode/batch/user_shortcodes.php");
} else {
	require_once(e_CORE."shortcodes/batch/user_shortcodes.php");
}
*/

/*
if(file_exists(e_PLUGIN."euser/languages/".e_LANGUAGE.".php")){
	require_once(e_PLUGIN."euser/languages/".e_LANGUAGE.".php");
} else {
	require_once(e_PLUGIN."euser/languages/English.php");
}
*/
e107::lan('euser',"front", true);
e107::lan('core',"usersettings");
//e107::css('euser', 'euser.css'); // always load style.css last.

/*
require_once(e_PLUGIN."euser/languages/".
(
(file_exists(e_PLUGIN."euser/languages/".e_LANGUAGE.".php"))
?
e_LANGUAGE
:
"English"
)
.".php");
*/
// ISTO É PRECISO POR CAUSA DO SERVIDOR LIVE
if(!defined('USER_WIDTH'))  define('USER_WIDTH','col-md-3');
if(!defined('USER_VALUE'))  define('USER_VALUE','col-md-9');
//require_once(e_LANGUAGEDIR."/".e_LANGUAGE."/lan_user.php");

//define("e_PAGETITLE", TITLE_PROFILE_1);

//$euser_pref = e107::getPlugPref('euser');

//$WYSIWYG = $euser_pref['wysiwyg'];
/*
if ($_GET['page'] == comments) {
$e_wysiwyg = "user_comment";
}
if ($_GET['page'] == images) {
$e_wysiwyg = "user_picture_comment";
}
if ($_GET['page'] == videos) {
$e_wysiwyg = "user_video_comment";
}
*/
if ($_GET['page'] == 'comments') {
	$e_wysiwyg = "user_comment";
	}
	if ($_GET['page'] == 'images') {
	$e_wysiwyg = "user_picture_comment";
	}
	if ($_GET['page'] == 'video_sys') {
	$e_wysiwyg = "user_video_comment";
	}
//define("e_PAGETITLE", TITLE_PROFILE_1);
$qs = explode(".", e_QUERY);
$id = intval($qs[1]??0);
if ($qs[0] == 'id' && isset($qs[1])) {
//	define("e_PAGETITLE", LAN_EUSER_11);
	e107::title(LAN_EUSER_11);
//    $front->render_user($id);
} else {
//	define("e_PAGETITLE", LAN_EUSER_500);
	e107::title(LAN_EUSER_500);
//    $front->render_list();
}
require_once(HEADERF);

// Não funciona, por enquanto... e107::getTemplate('euser', 'icons');
/*
	if (file_exists(THEME.'templates/icons_template.php')) // Preferred v2.x location.
	{
		require_once(THEME.'templates/icons_template.php');
	}
	elseif (file_exists(THEME.'euser/icons_template.php'))
	{
		require_once(THEME.'euser/icons_template.php');
	}
	elseif (file_exists(THEME.'icons_template.php'))
	{
		require_once(THEME.'icons_template.php');
	}
	else
	{
		require_once(e_PLUGIN.'euser/templates/icons_template.php');
	}
*/
// Global porquê???
//global $user_sc, $euser_pref;
//var_dump ($euser_pref);
//$euser_pref = e107::getPlugPref('euser');

//IMAGE_alert = "<img src='images/alert.png' title='!' />";
//IMAGE_alert = "<img src='images/alert.png' title='!' style='vertical-align: middle;' />"."&nbsp;".ADMIN_PROFILE_10;
//IMAGE_bigalert = "<img src='images/alert_big.png' title='!' style='vertical-align: middle;' />"."&nbsp;";

/*
if (!$euser_pref['plug_installed']['euser']) {
	$ns->tablerender(IMAGE_alert,PROFILE_2a);
	require_once(FOOTERF);
	exit;
}
*/
//var_dump ($_GET['id']);
//$sql_codes = array(SELECT,INSERT,INTO,WHERE,DISTINCT,UPDATE,DELETE,TRUNCATE,TABLE,ORDER,JOIN,UNION,CONCAT,FROM,LIKE);
$sql_codes = array("SELECT","INSERT","INTO","WHERE","DISTINCT","UPDATE","DELETE","TRUNCATE","TABLE","ORDER","JOIN","UNION","CONCAT","FROM","LIKE");
$sql_codes_count = 0;
foreach($sql_codes as $sql_code) {
	if (preg_match("/".$sql_code."/i", e_QUERY)) {
		$sql_codes_count++;
	}
	if (preg_match("/".$sql_code."/i", preg_replace("'([\S,\d]{2})'e", "chr(hexdec('\\1'))", e_QUERY))) {
		$sql_codes_count++;
	}
}

if ($sql_codes_count >= 2) {
		$ns->tablerender(IMAGE_alert,PROFILE_2a);
		require_once(FOOTERF);
		exit;
}

//var_dump ($sql);
//$sql=e107::getDb();

//if (isset($_GET['id'])) {


		$msg = e107::getMessage();
// Uso o pref do core, o original, var $pref...
//	if ($id != USERID && !check_class(varset($pref['memberlist_access'], 253))) {
// Uso o pref do plugin em lugar do do core, é menos confuso...
	if (($id != USERID && !check_class($euser_pref['memberlist_access'])) || (!($qs[0] == 'id' && $id == USERID) && !(getperms("0") || check_class(varset($pref['memberlist_access'], 253))))) {
//		$ns->tablerender(IMAGE_alert,PROFILE_2);
//		$ns->tablerender(IMAGE_alert,IMAGE_bigalert.PROFILE_2);
    e107::lan('core', 'membersonly');
    $sc = e107::getScBatch('membersonly');
//    e107::getParser()->parseTemplate(        "{MEMBERSONLY_RESTRICTED_AREA} {LAN=LAN_NO_PERMISSIONS} {MEMBERSONLY_LOGIN}														{MEMBERSONLY_SIGNUP}", true, $sc);
	$msg = e107::getMessage();
//    $mes->addWarning(LAN_MEMBERS_1."<br>".LAN_NO_PERMISSIONS."<br>".LAN_MEMBERS_2."<br>".LAN_MEMBERS_3);
    $msg->addWarning(e107::getParser()->parseTemplate(        "{MEMBERSONLY_RESTRICTED_AREA}<br>{LAN=LAN_NO_PERMISSIONS}<br>{MEMBERSONLY_LOGIN}			{MEMBERSONLY_SIGNUP}", true, $sc));
///		$msg->addWarning(PROFILE_2);
		echo $msg->render();
		require_once(FOOTERF);
		exit;
	}
	require_once(e_PLUGIN . "euser/includes/euser_class.php");
    $front = new Euser();
//var_dump ($qs);
//	if ($_GET['id'] != USERID && !check_class($euser_pref['allowguests'])) {
if ($qs[0] == 'id' && isset($qs[1])) {
//	define("e_PAGETITLE", LAN_EUSER_11);
//	e107::title(LAN_EUSER_11);
    $front->render_user($id);
} else {
//	define("e_PAGETITLE", LAN_EUSER_500);
//	e107::title(LAN_EUSER_500);
    $front->render_list();
}
require_once(FOOTERF);
