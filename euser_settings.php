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
//Modified & updated to v2.x by rica-carv

if (!defined('e107_INIT'))
{
	require_once(__DIR__.'/../../class2.php');
}

//print(ob_get_level());

//require_once(__DIR__.'/../../usersettings.php');
// INJECTO AQUI O USERSETTINGS DO CORE
$content = file_get_contents(__DIR__.'/../../usersettings.php');
//echo "<pre>";
//var_dump($content);
//echo "<hr>";
// Order of replacement
//$str     = "Line 1\nLine 2\rLine 3\r\nLine 4\n";
$order = array('require_once (\'class2.php\');','$us = new usersettings_front;','require_once(HEADERF);','$us->init();','require_once (FOOTERF);','action=\'".$formTarget."\'','action="\'.$target.\'"');
$replace = "";
// Processes \r\n's first so they aren't converted twice.
$content = str_replace($order, $replace, $content);
/*
$order = array('getScBatch(\'usersettings\')',
'getCoreTemplate(\'usersettings\',\'\', true, true);',
'(\'usersettings',
'CoreTemplate',
'$caption = (isset($USERSETTINGS_EDIT_CAPTION)) ? $USERSETTINGS_EDIT_CAPTION : LAN_USET_39',
'$this->renderForm($changedUserData);',
'private $template =',
'private $sc =',
'= LAN_USET_39',
'$text = \'<form');
$replace = array('getScBatch(\'user_settings\', \'euser\', \'user_settings\')',
'getTemplate(\'euser\', \'euser_settings\');',
'(\'euser_settings',
'Template',
'$caption = (USERID?e107::getParser()->simpleParse($USERSETTINGS_EDIT_CAPTION, array_change_key_case(e107::user(USERID), CASE_UPPER)):LAN_EUSER_101);',
'return $this->renderForm($changedUserData);',
'protected $template =',
'protected $sc =',
'= $template[\'edit_caption\']',
'$text =$this->euser_init($curVal).\'<form');
*/
$order = array('getScBatch(\'usersettings\')',
'getCoreTemplate(\'usersettings\',\'\', true, true);',
'(\'usersettings',
'CoreTemplate',
'$caption = (isset($USERSETTINGS_EDIT_CAPTION)) ? $USERSETTINGS_EDIT_CAPTION : LAN_USET_39',
'private $template =',
'private $sc =',
'= LAN_USET_39',
'$text = \'<form',
'if ($dataToSave)',
'if (FALSE === $sql->update(\'user\', $changedData))'
);
$replace = array('getScBatch(\'user_settings\', \'euser\', \'user_settings\')',
'getTemplate(\'euser\', \'euser_settings\');',
'(\'euser_settings',
'Template',
'$caption = (USERID?e107::getParser()->simpleParse($USERSETTINGS_EDIT_CAPTION, array_change_key_case(e107::user(USERID), CASE_UPPER)):LAN_EUSER_101);',
'protected $template =',
'protected $sc =',
'= $template[\'edit_caption\']',
'$text =$this->euser_init($curVal).\'<form',
'$promptPassword=$this->euser_check(); if ($dataToSave)',
'$this->euser_save(); if (FALSE === $sql->update(\'user\', $changedData))'
);
$content = str_replace($order, $replace, $content);

//e107::getTemplate('euser_settings');

//file_put_contents(e_PLUGIN.'/euser/includes/usersettings_class.php', $contentnew);
//require_once(e_PLUGIN.'/euser/includes/usersettings_class.php');
/*
echo "<pre>";
print_r($content);
echo "</pre>";
*/

		eval('?>'.$content.'?><?php');
//$us = new usersettings_front;
include_once(e_PLUGIN . "euser/includes/euser_trait.php");

class euser_settings_front extends usersettings_front{
//class euser_settings_front{
	use Euser_admin_info, Euser_info;
//	public $euser_template;
	public $sql;
	public $euser_data;
	public $changedEUSERData;
	function __construct(){
		parent::__construct(); // this line calls the parent (a) constructor
//		$this->eustemplate = e107::getTemplate('euser', 'euser_settings');
		$this->sql = e107::getDb();
//		$sql->select("euser", "(*)", "user_id='{$id}'");
		$this->euser_data = $this->sql->retrieve("euser", "*", "user_id='".USERID."'");
/*
echo "<pre>";
var_dump($this->euser_data);
echo "</pre>";
*/
	//		$this->euser = $this->sql -> retrieve("user", "(*)", "user_id={$id}");
	}

	
	function euser_init(&$curVal){
//		$this->init();
/*
echo "EUSER_SETTINGS<pre>";
var_dump ($_POST);
var_dump ($allData);
var_dump ($changedUserData);
var_dump ($triggerData);
echo "</pre>";
*/
//var_dump ($_POST);
//var_dump ($_GET);
//global $curVal;
//var_dump($curVal);
//$curVal['user_name'] = $curVal['user_loginname'] = "djkfaslkfjlaksdjfklsjal";
//var_dump($curVal);
$pref               = e107::getPref();
$tp                 = e107::getParser();
$ue                 = e107::getUserExt();
$mes                = e107::getMessage();
$sql                = e107::getDb();
$ns                 = e107::getRender();
$userMethods        = e107::getUserSession();

//$text = "»»»»»»»»»".$this->template['main']."««««««««";

//$this->template = e107::getTemplate('euser', 'euser_settings');
//$euser_template = e107::getTemplate('euser');
//$text = $euser_template['main'];
//$text = $this->template['edit'];
/*
echo "<pre>";
var_dump($us);
echo "</pre>";
*/
//$eus = new euser_settings_front;
///$tmpl = e107::getTemplate('euser', 'euser_settings');
/*
echo "<pre>";
var_dump($tmpl);
echo "</pre>";
*/

//$text = $tmpl['main'];
//$text .= $us->euser_init();


//e107_0.8 compatible
/*
if(file_exists(e_FILE."shortcode/batch/euser_sc.php")){
	require_once(e_FILE."shortcode/batch/euser_sc.php");
} else {
	require_once(e_CORE."shortcodes/batch/euser_sc.php");
}
*/
//$sc = e107::getScBatch('user', 'euser', 'user');

/*
if(file_exists(e_FILE."shortcode/batch/usersettings_shortcodes.php")){
	require_once(e_FILE."shortcode/batch/usersettings_shortcodes.php");
} else {
	require_once(e_CORE."shortcodes/batch/usersettings_shortcodes.php");
}
*/
//$sc_us = e107::getScBatch('user_settings', 'euser', 'user_settings');
//e107::getScBatch('usersettings');
//
/*
if(file_exists(e_PLUGIN."euser/languages/".e_LANGUAGE.".php")){
	require_once(e_PLUGIN."euser/languages/".e_LANGUAGE.".php");
}
else{
	require_once(e_PLUGIN."euser/languages/English.php");
}
*/
e107::lan('euser',"front", true);
e107::lan('core',"user");
e107::lan('core',"usersettings");
e107::css('euser', 'euser.css'); // always load style.css last.
//require_once(e_LANGUAGEDIR.e_LANGUAGE."/lan_usersettings.php");

require_once(e_HANDLER."ren_help.php");
define("e_PAGETITLE", TITLE_PROFILE_2);
//require_once(HEADERF);

//$alert_icon = "<img src='images/alert.png' title='!' />";

//if (!$euser_pref['plug_installed']['euser']) {
if (!e107::isInstalled('euser')) {
	$ns->tablerender(LAN_ERROR,"<div style='text-align:center'><div class='alert alert-dangere alert-block' style='text-align:center'>".PROFILE_2a."</div></div>");
	require_once(FOOTERF);
	exit;
}

$sql_codes = array(SELECT,INSERT,INTO,WHERE,DISTINCT,UPDATE,DELETE,TRUNCATE,TABLE,ORDER,JOIN,UNION,CONCAT,FROM,LIKE);
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
		$ns->tablerender(LAN_ERROR,"<div style='text-align:center'><div class='alert alert-dangere alert-block' style='text-align:center'>".PROFILE_2a."</div></div>");
		require_once(FOOTERF);
		exit;
}

// Isto nunca acontece porque o usersettings.php já resolveu se não for user...
/*
if (!USER) {
	$ns->tablerender(LAN_ERROR,"<div style='text-align:center'><div class='alert alert-dangere alert-block' style='text-align:center'>".PROFILE_186."</div></div>");
	require_once(FOOTERF);
	exit;
}
*/
//$qs = explode(".", e_QUERY);  // NÃO É USADO, NÃO SEI PORQUE ESTÁ AQUI....
//var_dump ($qs);
//	if ($_GET['id'] != USERID && !check_class($euser_pref['allowguests'])) {
//if ($qs[0] == 'id' && isset($qs[1])) {

//	$id = intval($qs[1]);
	
//if (isset($_GET['uid'])) {
/*----- NÃO VOU USAR, ISTO VAI PARA O BACKEND ADMIN DO SITE...
if ($qs[0] == 'id' && isset($qs[1])) {
		// ADMIN IS EDITING THEIR PROFILE
//	$id = intval($_GET['uid']);
	$this->id = intval($qs[1]);
	$luid = "&id.".$this->id."";
	if (!ADMIN || !getperms("4")) {
		header("location:".e_BASE."index.php");
		exit() ;
	}
} else {
---*/
	// SEMPRE POR DEFEITO, OUTROS USERS SE FOREM EDITADOS PELO ADMIN SÃO NO BACKOFFICE
	$id = USERID;
//---}
//$sql -> Select("user", "*", "user_id=".$id."");
//$user = $sql -> fetch();
//$sql -> Select("user", "(*)", "user_id={$id}");
//$user = $sql -> Fetch();
//global $eusersettings_sc, $euser_pref;

//$eusersettings_sc = e107::getScBatch('user', 'euser', 'user');
//$eusersettings_sc = e107::getScBatch('user_settings', 'euser', 'user_settings');

$euser_pref = e107::getPlugPref('euser');
//var_dump ($eusersettings_sc);
/*
echo "<pre>";
var_dump ($euser_pref);
echo "</pre>";
*/
$user = $sql -> retrieve("user", "(*)", "user_id={$id}");
$userlastvisit = $user['user_lastvisit'];
// GET AVATAR
/*
if ($euser_pref['avatarwidth'] == '') {
	$avwidth = "width='100'";
} else {
	$avwidth = "width='".$euser_pref['avatarwidth']."' ";
}
if ($euser_pref['avatarheight'] == '') {
	$avheight = '';
} else {
	$avheight = "height='".$euser_pref['avatarheight']."' ";
}
if($user['user_image'] == "") {
	$user_image = "".e_PLUGIN."euser/images/noavatar.png";
	$avatar .= "<img src='".$user_image."' border='1' ".$avwidth." ".$avheight."  alt='' />";
} else {
	$user_image = $user['user_image'];
	require_once(e_HANDLER."avatar_handler.php");
//	$user_image = avatar($user_image);
	$user_image = e107::getParser()->toAvatar($user_image);
	$avatar .= "<img src='".$user_image."' border='1' ".$avwidth." ".$avheight." alt='' />";
}
*/
//	$avatar = e107::getParser()->toAvatar($user_image);

//GET PROFIL_IMAGE
// ##########################################################################################
// USO A PREDEFINIÇÃO DO E107, AO IR BUSCAR O SHORTCODE DO AVATAR....
// ##########################################################################################
/*if ($euser_pref['imagewidth'] == '') {
// OLD	$imagewidth = "width = '200'";
  $imagewidth = "";
} else {
	$imagewidth = "width='".$euser_pref['imagewidth']."' ";
}
if ($euser_pref['imageheight'] == '') {
	$imageheight = "";
} else {
	$imageheight = "height='".$euser_pref['imageheight']."' ";
}
if ($user['user_image'] == "") {
	$user_image = "".e_PLUGIN."euser/images/noavatar.png";
	$profil_image .= "<img src='".$user_image."' border='1' ".$avwidth." ".$avheight."  alt='' />";
} else {
	$user_image = str_replace("/thumbs/", "/", $user['user_image']);
	$euser_link = "".SITEURL.e_PLUGIN."euser/";
	$euser_link = str_replace("../../", "", $euser_link);
	$user_image1 = str_replace("$euser_link", "./", $user_image);
	$kepmeret = getimagesize($user_image1);
	$profilkep_sz = $kepmeret[0];
	$profilkep_m = $kepmeret[1];

	if ($profilkep_sz <= $euser_pref['imagewidth'] && $euser_pref['imagewidth'] != "" && $profilkep_sz != "") {
		$imagewidth = $profilkep_sz;
	}
	if ($profilkep_m <= $euser_pref['imageheight'] && $euser_pref['imageheight'] != "" && $profilkep_m != "") {
		$imageheight = $profilkep_m;
	}

	require_once(e_HANDLER."avatar_handler.php");
	$user_image = avatar($user_image);
	if ($user_image != str_replace("/thumbs/", "/", $user['user_image'])) {
		$imagewidth = $avwidth;
		$imageheight = $avheight;
	}
	$profil_image .= "<img src='".$user_image."' border='1' ".$imagewidth." ".$imageheight." alt='' />";
}
*/
// **************************** O QUE É ISTO ? ***********************************
// Pronto, resolvo o problema do PROFIL_IMAGE assim.........
/*
$doc = DOMDocument::loadHTML($tp->parseTemplate("»»»{USER_AVATAR=$id}«««", TRUE, $eusersettings_sc));
//$image = $doc->getElementsByTagName('img');
foreach($doc->getElementsByTagName('img') as $image){
//    foreach(array('width', 'height') as $attribute_to_remove){
        if($image->hasAttribute('title')){
            $image->removeAttribute('title');
        }
//    }
}
*/
//----	$avatar = $tp->toAvatar($user_image);

//  $profil_image .= $doc->saveHTML();

/*
$text .= "<script language=\"JavaScript\" type=\"text/javascript\">
obj.style.display=\"block\";
function doMenu(item) {
	obj=document.getElementById(item);
	col=document.getElementById(\"x\" + item);
	if (obj.style.display==\"none\") {
		obj.style.display=\"block\";
	} else {
	obj.style.display=\"none\";
	}
}
</script>";
*/
// ISTO SERÁ PARA K?
e107::js('footer-inline',"
obj.style.display=\"block\";
function doMenu(item) {
	obj=document.getElementById(item);
	col=document.getElementById(\"x\" + item);
	if (obj.style.display==\"none\") {
		obj.style.display=\"block\";
	} else {
	obj.style.display=\"none\";
	}
}
");

//$username = $user['user_name'];
//if (USER) {
//	$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
//	$friends = $sql->fetch();
//---	$sql->select("euser", "(*)", "user_id='{$id}'");
//---	$this->euser_data = $sql->fetch();
//var_dump ($this->euser_data);
//	var_dump($id);
//	var_dump($this->euser_data);
	// NEW COMMENTS
//	$sql->mySQLresult = @mysql_query("SELECT user_lastvisit FROM ".MPREFIX."user WHERE user_id='".$id."' ");
//	$lastvisit = $sql->fetch();
//	$sql->select("user", "user_lastvisit", "user_id='{$id}' ");
//	$lastvisit = $sql->fetch();
//	$lastvisit = $user['user_lastvisit'];
//	$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."euser_com WHERE com_date > '".$lastvisit['user_lastvisit']."' AND com_to='".$id."' AND com_type='prof' ");
//	$comnumrows = $sql->rows();
$sql->select("euser_com", "com_id", "com_date > '{$user['user_lastvisit']}' AND com_to='{$id}' AND com_type='prof'");
//$sql->select("euser_com", "com_id", "com_date > '{$lastvisit['user_lastvisit']}' AND com_to='{$id}' AND com_type='prof'");
	$comnumrows = $sql->rows();
	// NEW PIC COMMENTS
//	$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."euser_com WHERE com_date > '".$lastvisit['user_lastvisit']."' AND com_to='".$id."' AND com_type='pics' ");
//	$picnumrows = $sql->rows();
$sql->select("euser_com", "com_id", "com_date > '{$user['user_lastvisit']}' AND com_to='{$id}' AND com_type='pics'");
//$sql->select("euser_com", "com_id", "com_date > '{$lastvisit['user_lastvisit']}' AND com_to='{$id}' AND com_type='pics'");
$picnumrows = $sql->rows();
	// NEW VID COMMENTS
//	$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."euser_com WHERE com_date > '".$lastvisit['user_lastvisit']."' AND com_to='".$id."' AND com_type='vids' ");
	//$vidnumrows = $sql->rows();
	$sql->select("euser_com", "com_id", "com_date > '{$user['user_lastvisit']}' AND com_to='{$id}' AND com_type='vids'");
//	$sql->select("euser_com", "com_id", "com_date > '{$lastvisit['user_lastvisit']}' AND com_to='{$id}' AND com_type='vids'");
	$vidnumrows = $sql->rows();
//var_dump ($this->euser_data);
	if ($this->euser_data['user_friends_request'] == "") {
		$count = 0;
	} else {
		$break = explode("|", $this->euser_data['user_friends_request']);
		$count = count($break) - 2;
	}
//}
//var_dump($this->euser_data);
// MAX_PIC_FILESIZE // Passou para dentro do shortcode...
if (intval(ini_get('post_max_size')) >= intval(ini_get('upload_max_filesize'))) {
	$post_max_info = intval(ini_get('upload_max_filesize'));
} else {
	$post_max_info = intval(ini_get('post_max_size'));
}
$maxkepmeret = $euser_pref['indmaxuploadsize']/1024;
if ($maxkepmeret >= $post_max_info) {
	$maxkepmeret = $post_max_info;
}
$maxkepmeret_kb = $maxkepmeret * 1024;
// MAX_MP3_FILESIZE
/*
$maxmp3meret = $euser_pref['mp3size']/1024;
if ($maxmp3meret >= $post_max_info) {
	$maxmp3meret = $post_max_info;
}
$maxmp3meret_kb = $maxmp3meret * 1024;  // É definido aqui mas nunca é usado... Deixei por causa das cócegas....
*/
// NAVIGATION // Acho que já não preciso disto... Acho....
$image_rowspan = 8;
if ($euser_pref['friends'] != "ON") {$image_rowspan --;}
if ($euser_pref['pics'] != "ON") {$image_rowspan --;}
if ($euser_pref['videos'] != "ON") {$image_rowspan --;}
if ($euser_pref['mp3enabled'] != "ON") {$image_rowspan --;}
if ($euser_pref['commentson'] != "ON") {$image_rowspan --;}

//include_lan(e_LANGUAGEDIR.e_LANGUAGE.'/lan_user.php');
///////////////////e107::lan('user',"front", true);
//  $caption =	PROFILE_46.strtolower(LAN_USER_50)."&nbsp;{USER_ID} : {USER_NAME} : {USER_LOGINNAME}";

//$text .="<div class='main_caption'><b>".PROFILE_46."</div></b><br/>";
//$text .="<table style='width:100%' class='fborder'>";
//$text .="<tr><td colspan='3'><br></td></tr>";
//$text .="<tr><td colspan='3' class='fcaption' style='text-align:center'> {USER_ID}".PROFILE_169."{USER_NAME}</td></tr>";
//$text .="<tr><td rowspan=$image_rowspan width='30%' class='forumheader3'><center>{$profil_image}<br>".$username."</center></td></tr>";
//$text .="<tr><td rowspan=$image_rowspan class='forumheader3'><center>{$profil_image}<br>".$username."</center></td></tr>";
//$text .="<tr><td rowspan=$image_rowspan class='forumheader3'><center>{$doc->saveHTML()}<br>{USER_NAME}</center></td></tr>";
////----$text .="<tr><td rowspan=$image_rowspan class='forumheader3'><center>{$avatar}<br>{USER_NAME}</center></td></tr>";
// ##########################################################################################
// POSSIVELMENTE DEPOIS TENHO DE ARRANJAR FORMA DE OU ISTO ESTAR AQUI, OU FAZER UM MENU LATERAL... POR DECIDIR........
// ##########################################################################################
//User settings
/*-----
$text .="<tr><td {$main_colspan} width='20%' class='forumheader3'>";
	$text .= "USERSETTINGS<img src ='images/key.png' style='border: 0px solid black; width: 16px; height: 16px; float: left; margin-right: 3px' alt = ''><a href='euser_settings.php?page=settings".$luid."'>".PROFILE_141."</a><br/>";
	$text .= "</td><td class='forumheader3'>".PROFILE_170."</td></tr>";
----*/
// Friends
if ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "") {
	$text .="<tr><td {$main_colspan} width='20%' class='forumheader3'>";
	$newfriends = $count." ".($count == 1 ? PROFILE_65 : PROFILE_65a);
	$text .= "<img src ='images/fr.png' style='border: 0px solid black; width: 16px; height: 16px; float: left; margin-right: 3px' alt = ''><a href='euser_settings.php?page=friends".$luid."'>".PROFILE_60."</a>";
	$text .= "</td><td class='forumheader3'>".PROFILE_171."</td></tr>";
}

// Pics
if ($euser_pref['pics'] == "ON" || $euser_pref['pics'] == "") {
	$kvota = $euser_pref['maxuploadsize']/1024;
	$post_max_resolution = round(intval(ini_get('memory_limit')) / 1.65 / 3);
	if ($euser_pref['maxpicnumber'] == '') {
		$maxpicnumber = '10';
	} else {
		$maxpicnumber = $euser_pref['maxpicnumber'];
	}
	if ($euser_pref['maxalbumnumber'] == '') {
		$maxalbumnumber = '6';
	} else {
		$maxalbumnumber = $euser_pref['maxalbumnumber'];
	}
	$text .="<tr><td {$main_colspan} width='20%' class='forumheader3'>";
	$newpiccoms = $picnumrows." ".($picnumrows == 1 ? PROFILE_120 : PROFILE_120a)."";
	$text .= "<img src ='images/pict.png' style='border: 0px solid black; width: 16px; height: 16px; float: left; margin-right: 3px' alt = ''><a href='euser_settings.php?page=images".$luid."'>".PROFILE_61."</a><br>";
	$text .= "</td><td class='forumheader3'>".PROFILE_173."".sprintf("%01.1f", $kvota)."".PROFILE_174."$maxalbumnumber".PROFILE_174a."$maxpicnumber".PROFILE_174b." ".sprintf("%01.1f", $maxkepmeret)."".PROFILE_175."</span></td></tr>";
}
// Videos
$maxvideok = $euser_pref['maxnovids'];
if ($euser_pref['videos'] == "ON" || $euser_pref['videos'] == "") {
	$text .="<tr><td {$main_colspan} width='20%' class='forumheader3'>";
	$newvidcoms = $vidnumrows." ".($picnumrows == 1 ? PROFILE_121 : PROFILE_121a)."";
	$text .= "<img src ='images/vid.png' style='border: 0px solid black; width: 16px; height: 16px; float: left; margin-right: 3px' alt = ''><a href='euser_settings.php?page=videos".$luid."'>".PROFILE_165."</a><br>";
	if ($maxvideok > 0) {
		$text .= "</td><td class='forumheader3'>".PROFILE_177."$maxvideok".PROFILE_178."</span></td></tr>";
	} else {
		$text .= "</td><td class='forumheader3'>".PROFILE_177a."</span></td></tr>";
	}
}
/*
// MP3
if ($euser_pref['mp3enabled'] == "ON" || $euser_pref['mp3enabled'] == "") {
//	$sql->mySQLresult = @mysql_query("SELECT user_id, user_custompage, user_background, user_simple, user_mp3 FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
//	$rows = $sql->rows();
//	$profile = $sql->fetch();
	$sql->select("euser", "user_id, user_custompage, user_background, user_simple, user_mp3", "user_id='{$id}'");
	$rows = $sql->rows();
	$profile = $sql->fetch();
	if ($profile['user_mp3'] == "") {
		$mp3file = "<i>".PROFILE_278."</i>";
	} else {
		if(strpos($profile['user_mp3'], "http://") === false) {
		$mp3file = $profile['user_mp3'];
		} else {
			$mp3break = explode("/", $profile['user_mp3']);
			$mp3file = end($mp3break);
		}
	}
	$currentmp3 = " ".PROFILE_158." ".str_replace("_", " ", $mp3file);
	$text .="<tr><td {$main_colspan} width='20%' class='forumheader3'>";
	$text .= "<img src ='images/mp3.png' style='border: 0px solid black; width: 16px; height: 16px; float: left; margin-right: 3px' alt = ''><a href='euser_settings.php?page=mp3".$luid."'>".PROFILE_166."</a><br>";
	$text .= "</td><td class='forumheader3'>".PROFILE_180."".sprintf("%01.1f", $maxmp3meret)."".PROFILE_181."$currentmp3</span></td></tr>";
}
*/
// Profil hozzászólások
if ($euser_pref['commentson'] == "ON" || $euser_pref['commentson'] == "") {
	$text .="<tr><td {$main_colspan} width='20%' class='forumheader3'>";
	$newcoms = $comnumrows." ".($comnumrows == 1 ? PROFILE_64 : PROFILE_64a)."";
	$text .= "<img src ='images/comnt.png' style='border: 0px solid black; width: 16px; height: 16px; float: left; margin-right: 3px' alt = ''><a href='euser_settings.php?page=comments".$luid."'>".PROFILE_62."</a><br>";
	$text .= "</td><td class='forumheader3'>".PROFILE_183."</td></tr>";
}
/*
$text .="<tr><td {$main_colspan} width='20%' class='forumheader3'>";
$text .= "<img src ='images/reg.png' style='border: 0px solid black; width: 16px; height: 16px; float: left; margin-right: 3px' alt = ''><a href='usersettingshandler.php?".$luid."'>".PROFILE_59."</a>";
*/









// ##########################################################################################
// ESTE FICHEIRO USA CÓDIGO QUE TAMBÉM ESTÁ NO euser_settings.php, PRINCIPALMENTE O MENU COMPLETO, POR ISSO É CANDIDATO A IR LÁ PARA DENTRO OU FAZER-SE UMA CLASS............
// ##########################################################################################
/*
if(!defined("e107_INIT")) {
	require_once("../../class2.php");
}
*/
/*
require_once(e_LANGUAGEDIR."/".e_LANGUAGE."/lan_usersettings.php");
if(file_exists(e_PLUGIN."euser/languages/".e_LANGUAGE.".php")){
	require_once(e_PLUGIN."euser/languages/".e_LANGUAGE.".php");
} else {
	require_once(e_PLUGIN."euser/languages/English.php");
}
*/
/*
$alert_icon = "<img src='images/alert.png' title='!' />";

if (!$euser_pref['plug_installed']['euser']) {
	$ns->tablerender($alert_icon,PROFILE_2a);
	require_once(FOOTERF);
	exit;
}

$sql_codes = array(SELECT,INSERT,INTO,WHERE,DISTINCT,UPDATE,DELETE,TRUNCATE,TABLE,ORDER,JOIN,UNION,CONCAT,FROM,LIKE);
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
	$ns->tablerender($alert_icon,"Internal error");
	exit;
}
*/
//define("e_PAGETITLE", TITLE_PROFILE_2);

// DISPLAY MENU
//if (USER) {
	if (isset($_GET['uid'])) {
		$id = intval($_GET['uid']);
	} else {
		$id = USERID;
	}
//	$sql -> Select("user", "*", "user_id=".$id."");
//	$user = $sql -> fetch();
/*---
	$sql->select("euser", "user_id, user_friends, user_friends_request","user_id='{$id}'");
	$friends = $sql->fetch();

	// NEW COMMENTS
	$sql->select("user","user_lastvisit", "user_id='{$id}'");
	$lastvisit = $sql->fetch();

	$sql->select("euser_com", "com_id","com_date > '{$lastvisit['user_lastvisit']}' AND com_to='{$id}' AND com_type='prof'");
	$comnumrows = $sql->rows();

	// NEW PIC COMMENTS
	$sql->select("euser_com", "com_id", "com_date > '{$lastvisit['user_lastvisit']}' AND com_to='{$id}' AND com_type='pics'");
	$picnumrows = $sql->rows();

	// NEW VID COMMENTS
	$sql->select("euser_com", "com_id", "com_date > '{$lastvisit['user_lastvisit']}' AND com_to='{$id}' AND com_type='vids'");
	$vidnumrows = $sql->rows();

	if ($friends['user_friends_request'] == "") {
		$count = 0;
	} else {
		$break = explode("|", $friends['user_friends_request']);
		$count = count($break) - 2;
	}
*/	
//}
/*---
// GET AVATAR
if ($euser_pref['avatarwidth'] == '') {
	$avwidth = "";
} else {
	$avwidth = "width='".$euser_pref['avatarwidth']."' ";
}

if ($euser_pref['avatarheight'] == '') {
	$avheight = '';
} else {
	$avheight = "height='".$euser_pref['avatarheight']."' ";
}
*/
//$sql->select("euser", "user_display","user_id='{$id}'");

//$display = $sql->fetch();

if ($this->euser_data['user_display'] == '') {
	if($user['user_image'] == "") {
	$user_image = "".e_PLUGIN."euser/images/noavatar.png";
	$avatar .= "<img src='".$user_image."' border='1' ".$avwidth." ".$avheight."  alt='' />";
	}else{
	$user_image = $user['user_image'];
	require_once(e_HANDLER."avatar_handler.php");
	$user_image = avatar($user_image);
	$avatar .= "<img src='".$user_image."' border='1' ".$avwidth." ".$avheight." alt='' />";
	}
} else {
	if (file_exists("userimages/".$id."/".$this->euser_data['user_display']."")) {
		$avatar .= "<img src='userimages/".$id."/".$this->euser_data['user_display']."' border='1' width='".$avwidth."' height='".$avheight."' alt='' />";
	} else {
		if($user['user_image'] == "") {
			$user_image = "".e_PLUGIN."euser/images/noavatar.png";
			$avatar .= "<img src='".$user_image."' border='1' width='".$avwidth."' height='".$avheight."'  alt='' />";
		}else{
			$user_image = $user['user_image'];
			require_once(e_HANDLER."avatar_handler.php");
			$user_image = avatar($user_image);
			$avatar .= "<img src='".$user_image."' border='1' width='".$avwidth."' height='".$avheight."' alt='' />";
		}
	}
}
/*
//GET PROFIL_IMAGE
if ($euser_pref['imagewidth'] == '') {
	$imagewidth = "width = '200'";
} else {
	$imagewidth = "width='".$euser_pref['imagewidth']."' ";
}
if ($euser_pref['imageheight'] == '') {
	$imageheight = "";
} else {
	$imageheight = "height='".$euser_pref['imageheight']."' ";
}
if ($user['user_image'] == "") {
	$user_image = "".e_PLUGIN."euser/images/noavatar.png";
	$profil_image .= "<img src='".$user_image."' border='1' ".$avwidth." ".$avheight."  alt='' />";
} else {
	$user_image = str_replace("/thumbs/", "/", $user['user_image']);
	$euser_link = "".SITEURL.e_PLUGIN."euser/";
	$euser_link = str_replace("../../", "", $euser_link);
	$user_image1 = str_replace("$euser_link", "./", $user_image);
	$kepmeret = getimagesize($user_image1);
	$profilkep_sz = $kepmeret[0];
	$profilkep_m = $kepmeret[1];

	if ($profilkep_sz <= $euser_pref['imagewidth'] && $euser_pref['imagewidth'] != "" && $profilkep_sz != "") {
		$imagewidth = $profilkep_sz;
	}
	if ($profilkep_m <= $euser_pref['imageheight'] && $euser_pref['imageheight'] != "" && $profilkep_m != "") {
		$imageheight = $profilkep_m;
	}
	require_once(e_HANDLER."avatar_handler.php");
	$user_image = avatar($user_image);
	if ($user_image != str_replace("/thumbs/", "/", $user['user_image'])) {
		$imagewidth = $avwidth;
		$imageheight = $avheight;
	}
	$profil_image .= "<img src='".$user_image."' border='1' ".$imagewidth." ".$imageheight." alt='' />";
}
*/
// END OF

if (isset($_GET['uid']) && ADMIN) {
	$luid = "&uid=".$_GET['uid']."";
}
/*
// MAX_PIC_FILESIZE
if (intval(ini_get('post_max_size')) >= intval(ini_get('upload_max_filesize'))) {
	$post_max_info = intval(ini_get('upload_max_filesize'));
} else {
	$post_max_info = intval(ini_get('post_max_size'));
}
$maxkepmeret = $euser_pref['indmaxuploadsize']/1024;
if ($maxkepmeret >= $post_max_info) {
	$maxkepmeret = $post_max_info;
}
$maxkepmeret_kb = $maxkepmeret * 1024;
// MAX_MP3_FILESIZE
$maxmp3meret = $euser_pref['mp3size']/1024;
if ($maxmp3meret >= $post_max_info) {
	$maxmp3meret = $post_max_info;
}
$maxmp3meret_kb = $maxmp3meret * 1024;
// NAVIGATION
$username_nav = $user['user_name'];
$image_rowspan = 8;
if ($euser_pref['friends'] != "ON") {$image_rowspan --;}
if ($euser_pref['pics'] != "ON") {$image_rowspan --;}
if ($euser_pref['videos'] != "ON") {$image_rowspan --;}
if ($euser_pref['mp3enabled'] != "ON") {$image_rowspan --;}
if ($euser_pref['commentson'] != "ON") {$image_rowspan --;}
*/
/*
$top .="<div class='main_caption'><b>".PROFILE_46."</div></b><br/><br/>";
$top .="<table style='width:100%' class='fborder'>";
$top .="<tr><td colspan='3' class='fcaption' style='text-align:center'> ".$id."".PROFILE_169."".$username_nav."</td></tr>";
$top .="<tr><td rowspan=$image_rowspan width='30%' class='forumheader3'><center>{$profil_image}<br>".$username_nav."</center></td></tr>";
*/
// Hozzaferesi beallitasok
/*
$top .="<tr><td {$main_colspan} width='20%' class='forumheader3'>";
	$top .= "<img src ='images/key.png' style='border: 0px solid black; width: 16px; height: 16px; margin-right: 3px' alt = ''><a href='euser_settings.php?page=settings".$luid."'>".PROFILE_141."</a><br/>";
	$top .= "</td><td class='forumheader3'>".PROFILE_170."</td></tr>";
	*/
// Barátok
/*
if ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "") {
	$top .="<tr><td {$main_colspan} width='20%' class='forumheader3'>";
	$newfriends = $count." ".($count == 1 ? PROFILE_65 : PROFILE_65a);
	$top .= "<img src ='images/fr.png' style='border: 0px solid black; width: 16px; height: 16px; margin-right: 3px' alt = ''><a href='euser_settings.php?page=friends".$luid."'>".PROFILE_60."</a>";
	$top .= "</td><td class='forumheader3'>".PROFILE_171."</td></tr>";
}

// Képek
if ($euser_pref['pics'] == "ON" || $euser_pref['pics'] == "") {
	$kvota = $euser_pref['maxuploadsize']/1024;
	$post_max_resolution = round(intval(ini_get('memory_limit')) / 1.65 / 3);
	if ($euser_pref['maxpicnumber'] == '') {
		$maxpicnumber = '10';
	} else {
		$maxpicnumber = $euser_pref['maxpicnumber'];
	}
	if ($euser_pref['maxalbumnumber'] == '') {
		$maxalbumnumber = '6';
	} else {
		$maxalbumnumber = $euser_pref['maxalbumnumber'];
	}
	$top .="<tr><td {$main_colspan} width='20%' class='forumheader3'>";
	$newpiccoms = $picnumrows." ".($picnumrows == 1 ? PROFILE_120 : PROFILE_120a)."";
	$top .= "<img src ='images/pict.png' style='border: 0px solid black; width: 16px; height: 16px; margin-right: 3px' alt = ''><a href='euser_settings.php?page=images".$luid."'>".PROFILE_61."</a><br>";
	$top .= "</td><td class='forumheader3'>".PROFILE_173."".sprintf("%01.1f", $kvota)."".PROFILE_174."$maxalbumnumber".PROFILE_174a."$maxpicnumber".PROFILE_174b." ".sprintf("%01.1f", $maxkepmeret)."".PROFILE_175."</span></td></tr>";
}

// Videok
if ($euser_pref['videos'] == "ON" || $euser_pref['videos'] == "") {
	$maxvideok = $euser_pref['maxnovids'];
	$top .="<tr><td {$main_colspan} width='20%' class='forumheader3'>";
	$newvidcoms = $vidnumrows." ".($vidnumrows == 1 ? PROFILE_121 : PROFILE_121a)."";
	$top .= "<img src ='images/vid.png' style='border: 0px solid black; width: 16px; height: 16px; margin-right: 3px' alt = ''><a href='euser_settings.php?page=videos".$luid."'>".PROFILE_165."</a><br>";
	$top .= "</td><td class='forumheader3'>".PROFILE_177."$maxvideok".PROFILE_178."</span></td></tr>";
}

// MP3
if ($euser_pref['mp3enabled'] == "ON" || $euser_pref['mp3enabled'] == "") {
	$sql->select("euser","user_id, user_custompage, user_background, user_simple, user_mp3","user_id='{$id}'");
	$rows = $sql->rows();
	$profile = $sql->fetch();
	if ($profile['user_mp3'] == "") {
		$mp3file = "<i>".PROFILE_278."</i>";
	} else {
		if(strpos($profile['user_mp3'], "http://") === false) {
		$mp3file = $profile['user_mp3'];
		} else {
			$mp3break = explode("/", $profile['user_mp3']);
			$mp3file = end($mp3break);
		}
	}
	$currentmp3 = " ".PROFILE_158." ".str_replace("_", " ", $mp3file);
	$top .="<tr><td {$main_colspan} width='20%' class='forumheader3'>";
	$top .= "<img src ='images/mp3.png' style='border: 0px solid black; width: 16px; height: 16px; margin-right: 3px' alt = ''><a href='euser_settings.php?page=mp3".$luid."'>".PROFILE_166."</a><br>";
	$top .= "</td><td class='forumheader3'>".PROFILE_180."".sprintf("%01.1f", $maxmp3meret)."".PROFILE_181."$currentmp3</span></td></tr>";
}

// Profil hozzászólások
if ($euser_pref['commentson'] == "ON" || $euser_pref['commentson'] == "") {
	$top .="<tr><td {$main_colspan} width='20%' class='forumheader3'>";
	$newcoms = $comnumrows." ".($comnumrows == 1 ? PROFILE_64 : PROFILE_64a)."";
	$top .= "<img src ='images/comnt.png' style='border: 0px solid black; width: 16px; height: 16px; margin-right: 3px' alt = ''><a href='euser_settings.php?page=comments".$luid."'>".PROFILE_62."</a><br>";
	$top .= "</td><td class='forumheader3'>".PROFILE_183."</td></tr>";
}

//Reg settings
$top .="<tr><td {$main_colspan} width='20%' class='forumheader3'>";
$top .= "<img src ='images/reg.png' style='border: 0px solid black; width: 16px; height: 16px; margin-right: 3px' alt = ''><a href='usersettingshandler.php?".$luid."'>".PROFILE_59."</a>";

$top .= "</td><td class='forumheader3'>".PROFILE_185."</span></td></tr>";

$top .="<tr><td colspan='3' class='forumheader' style='text-align:center'>";

if ($euser_pref['commentson'] == "ON" || $euser_pref['commentson'] == "") {
	if (!$comnumrows==0) {
	$top .=" | <b><a href='euser_settings.php?page=comments".$luid."'> $newcoms</a></b>";
	} else {
		$top .=" | <a href='euser_settings.php?page=comments".$luid."'> $newcoms</a>";
	}
}
if ($euser_pref['pics'] == "ON" || $euser_pref['pics'] == "") {
	if (!$picnumrows==0) {
	$top .=" | <b><a href='euser_settings.php?page=images".$luid."'>$newpiccoms</a></b>";
	} else {
		$top .=" | <a href='euser_settings.php?page=images".$luid."'>$newpiccoms</a>";
	}
}
if ($euser_pref['videos'] == "ON" || $euser_pref['videos'] == "") {
	if (!$vidnumrows==0) {
	$top .=" | <b><a href='euser_settings.php?page=videos".$luid."'>$newvidcoms</a></b>";
	} else {
		$top .=" | <a href='euser_settings.php?page=videos".$luid."'>$newvidcoms</a>";
	}
}
if ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "") {
	if (!$count==0) {
	$top .=" | <b><a href='euser_settings.php?page=friends".$luid."'> $newfriends</a></b> |</td></tr>";
	} else {
		$top .=" | <a href='euser_settings.php?page=friends".$luid."'> $newfriends</a> |</td></tr>";
	}
}
$top .="</table>";
*/
//$top .= "<table width='100%'><tr><td class='forumheader'><img src='images/settings.png'>&nbsp;".PROFILE_59."</td></tr></table><br />";
/*
$top .= "<table width='100%'><tr><td class='forumheader'><img src='images/settings.png'><span style='text-align:center;width: 100%;position: absolute;line-height: 1.25em;'><b><u>".PROFILE_59."</u></b><br>".PROFILE_185."</span></td></tr></table>";
*/
//$text = $text.$top;













//$text .= "</td><td class='forumheader3'>".PROFILE_185."</span></td></tr>";
/*-----MENU ANTIGO----
$text .="<tr><td colspan='3' class='forumheader' style='text-align:center'>";
if (($euser_pref['commentson'] == "ON" || $euser_pref['commentson'] == "") || ($euser_pref['pics'] == "ON" || $euser_pref['pics'] == "") || ($euser_pref['videos'] == "ON" || $euser_pref['videos'] == "") || ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "")) {
$text .="| ";
}
if ($euser_pref['commentson'] == "ON" || $euser_pref['commentson'] == "") {
	if (!$comnumrows==0) {
		$text .="<b><a href='euser_settings.php?page=comments".$luid."'> $newcoms</a></b> | ";
	} else {
		$text .="<a href='euser_settings.php?page=comments".$luid."'> $newcoms</a> | ";
	}
}
if ($euser_pref['pics'] == "ON" || $euser_pref['pics'] == "") {
	if (!$picnumrows==0) {
		$text .="<b><a href='euser_settings.php?page=images".$luid."'>$newpiccoms</a></b> | ";
	} else {
		$text .="<a href='euser_settings.php?page=images".$luid."'>$newpiccoms</a> | ";
	}
}
if ($euser_pref['videos'] == "ON" || $euser_pref['videos'] == "") {
	if (!$vidnumrows==0) {
		$text .="<b><a href='euser_settings.php?page=videos".$luid."'>$newvidcoms</a></b> | ";
	} else {
		$text .="<a href='euser_settings.php?page=videos".$luid."'>$newvidcoms</a> | ";
	}
}
if ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "") {
	if (!$count==0) {
		$text .="<b><a href='euser_settings.php?page=friends".$luid."'> $newfriends</a></b> |</td></tr>";
	} else {
		$text .="<a href='euser_settings.php?page=friends".$luid."'> $newfriends</a> |</td></tr>";
	}
}
$text .="</table>";
-------------FIM-MENU-ANTIGO-----*/

//if (isset($_GET['page'])) {
	//if ($_GET['page'] == "friends") {
/*
		if ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "") {
			if ($euser_pref['frcol'] == '') {
				$frcolumn = '6';
			} elseif ($euser_pref['frcol'] > '8') {
				$frcolumn = '8';
			} elseif ($euser_pref['frcol'] < '2') {
				$frcolumn = '2';
			} else {
				$frcolumn = $euser_pref['frcol'];
			}
//			$text .= "<table width='100%'><tr><td class='forumheader'><img src='images/friends.png'>".PROFILE_60."</td></tr></table>";
      $text .= "<table width='100%'><tr><td class='forumheader'><img src='images/friends.png'><span style='text-align:center;width: 100%;position: absolute;line-height: 1.25em;'><b><u>".PROFILE_60."</u></b><br>".PROFILE_171."</span></td></tr></table>";
//			$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
//			$list = $sql->fetch();
			$sql->select("euser", "user_id, user_friends, user_friends_request", "user_id='{$id}'");
			$list = $sql->fetch();
			if (isset($_GET['acceptadd'])) {
//				$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."euser WHERE user_id='".intval($_GET['acceptadd'])."' ");
//				$friend = $sql->fetch();
				$sql->select("euser", "user_id, user_friends, user_friends_request", "user_id='".intval($_GET['acceptadd'])."' ");
				$friend = $sql->fetch();
				$check = explode("|", $friend['user_friends']);

//				$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
//				$te_list = $sql->fetch();
				$sql->select("euser", "user_id, user_friends, user_friends_request", "user_id='{$id}'");
				$te_list = $sql->fetch();
				$megjeloltek = explode("|", $te_list['user_friends_request']);

				if (in_array($id, $check)) {
					$text .= "<br/>".PROFILE_160."<br/>";
				} elseif (!in_array($_GET['acceptadd'], $megjeloltek)) {
					$text .= "<br/>".PROFILE_160a."<br/>";
				} else {
					$newrequests = str_replace("|".$_GET['acceptadd']."|" , "|", $list['user_friends_request']);
					if ($list['user_friends'] == '') {
						$newlist = "|".$_GET['acceptadd']."|";
					} else {
						$newlist = "".$list['user_friends']."".$_GET['acceptadd']."|";
					}
					if ($friend['user_friends'] == '') {
						$newfriend = "|".$id."|";
					} else {
						$newfriend = "".$friend['user_friends']."".$id."|";
					}
//					$sql -> db_Update("euser", "user_friends='".$newlist."' WHERE user_id='".$id."' ");
//					$sql -> db_Update("euser", "user_friends_request='".$newrequests."' WHERE user_id='".$id."' ");
//					$sql -> db_Update("euser", "user_friends='".$newfriend."' WHERE user_id='".intval($_GET['acceptadd'])."' ");
					$sql -> update("euser", "user_friends='".$newlist."' WHERE user_id='{$id}' ");
					$sql -> update("euser", "user_friends_request='".$newrequests."' WHERE user_id='{$id}' ");
					$sql -> update("euser", "user_friends='".$newfriend."' WHERE user_id='".intval($_GET['acceptadd'])."' ");
					header("Location: euser_settings.php?page=friends".$luid."");
				}

			} elseif (isset($_GET['rejectadd'])) {
//				$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."euser WHERE user_id='".intval($_GET['rejectadd'])."' ");
//				$friend = $sql->fetch();
				$sql->select("euser", "user_id, user_friends, user_friends_request", "user_id='".intval($_GET['rejectadd'])."' ");
				$friend = $sql->fetch();
				$newrequests = str_replace("|".intval($_GET['rejectadd'])."|" , "|", $list['user_friends_request']);
//				$sql -> db_Update("euser", "user_friends_request='".$newrequests."' WHERE user_id='".$id."' ");
				$sql -> update("euser", "user_friends_request='".$newrequests."' WHERE user_id='{$id}'");
				header("Location: euser_settings.php?page=friends".$luid."");
			}
			$friend = explode("|", $list['user_friends']);
			if ($list['user_friends_request'] == '' or $list['user_friends_request'] == '|') {
				// DO NOTHING
			} else {
				if ($frcolumn > '6') {	$frcolumn_1 = '5';
				} elseif ($frcolumn > '2') {	$frcolumn_1 = '4';
				} else {	$frcolumn_1 = '3';
				}
				$frcolumn_2 = $frcolumn_1 * 2 - 2;
				$requests = explode("|", $list['user_friends_request']);
				$text .= "<br/><table width='100%' class='fborder'><tr><td class='forumheader' colspan=$frcolumn_2>".PROFILE_65b."</td></tr>";
				$column = 1;
				foreach ($requests as $req) {
					if ($column==1) {
						$text .="<tr>";
					}
					if ($req == '') {
						// DO NOTHING
			  		} else {
//						$sql->mySQLresult = @mysql_query("SELECT user_name, user_image FROM ".MPREFIX."user WHERE user_id='".$req."' ");
//						$frname = $sql->fetch();
						$sql->select("user", "user_name, user_image", "user_id='{$req}' ");
						$frname = $sql->fetch();
						$user_name = $frname['user_name'];
						$on_name = "".$req.".".$user_name."";
//						$check = $sql-> db_Count("online","(*)","WHERE online_user_id='".$on_name."'");
						$check = $sql-> count("online","(*)","WHERE online_user_id='{$on_name}'");
						if( $check > 0 ) {
							$online = "<img src='images/online.gif' title='".PROFILE_96."' style='vertical-align: top;' />";
						} else {
							$online = "";
						}
						unset($check,$on_name);
						$text .= "<td class='forumheader3' width='10%'><a href='euser.php?id=".$req."'>";
						if($frname[user_image] == "") {
							$text .= "<img src='".e_PLUGIN."euser/images/noavatar.png' border='1' width='64'  alt='' />";
						}else{
							$user_image = $frname[user_image];
							require_once(e_HANDLER."avatar_handler.php");
							$user_image = avatar($user_image);
							$text .= "<img src='".$user_image."' border='1' width='64' alt='' />";
						}
						$text .= "</a></td><td class='forumheader3'>".$online." <b>".$frname['user_name']."</b><br/><br/><a href='euser_settings.php?page=friends".$luid."&acceptadd=".$req."'>".PROFILE_66."</a> | <a href='euser_settings.php?page=friends".$uid."&rejectadd=".$req."'>".PROFILE_67."</a></td>";
						$column++;
						if ($column == $frcolumn_1) {
							$text .= "</tr>";
							$column = 1;
						}
					}
				}
				$text .= "</table><br/>";
			}
			if ($list['user_friends'] == '' or $list['user_friends'] == '|') {
				$text .= "<br/><i>".PROFILE_30b."";
			} else {
				$column=1;
				$text .= "<br/><form action='formhandler.php' method='post'><table width='100%'><tr><td class='forumheader' colspan=$frcolumn>".PROFILE_31a."</td></tr>";
				if ($column==1) {
					$text .="<tr>";
				}
				foreach ($friend as $fr) {
					if ($fr == '') {
					// DO NOTHING
					} else {
//						$sql->mySQLresult = @mysql_query("SELECT user_name, user_image FROM ".MPREFIX."user WHERE user_id='".$fr."' ");
//						$fname = $sql->fetch();
						$sql->select("user", "user_name, user_image", "user_id='{$fr}'");
						$fname = $sql->fetch();
						$user_name = $fname['user_name'];
						$frnames[] = $user_name;
						array_multisort ($frnames, SORT_ASC);
					}
				}
				foreach ($frnames as $frname) {
//					$sql->mySQLresult = @mysql_query("SELECT user_id, user_name, user_image FROM ".MPREFIX."user WHERE user_name='".$frname."' ");
//					$name = $sql->fetch();
					$sql->select("user", "user_id, user_name, user_image", "user_name='{$frname}'");
					$name = $sql->fetch();
					$user_name = $name['user_name'];
					$fr = $name['user_id'];
					$on_name = "".$fr.".".$user_name."";
//					$check = $sql-> db_Count("online","(*)","WHERE online_user_id='".$on_name."'");
					$check = $sql-> count("online","(*)","WHERE online_user_id='{$on_name}'");
					if( $check > 0 ) {
						$online = "<img src='images/online.gif' title='".PROFILE_96."' style='vertical-align: top;' />";
					} else {
						$online = "";
					}
					unset($check,$on_name);
					$text .= "<td class='forumheader3' width = '10%'><a href='euser.php?id=".$fr."'>";
					if($name[user_image] == "") {
						$text .= "<img src='".e_PLUGIN."euser/images/noavatar.png' border='1' width='64' alt='' />";
					}else{
						$user_image = $name[user_image];
						require_once(e_HANDLER."avatar_handler.php");
						$user_image = avatar($user_image);
						$text .= "<img src='".$user_image."' border='1' width='64' alt='' />";
					}
					$text .= "<br/></a><input type='hidden' name='uid' value='".$id."'><input type='checkbox' name='box[]' value='".$fr."'> ".$name['user_name']." ".$online."</td>";
					$column++;
					if ($column == $frcolumn + 1) {
						$text .= "</tr>";
						$column = 1;
					}
				}
				if ($euser_pref['buttontype'] == "Yes") {
					$text .= "</table><br><input type='image' name='submit_delete' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_delete_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_delete.gif\"'  src='images/buttons/".e_LANGUAGE."_delete.gif' ></form>";
				} else {
					$text .= "</table><input type='submit' name='submit_delete' value='".PROFILE_187."' class='button'></form>";
				}
			}

			$friend = "|";
//			$query = "SELECT user_id, user_friends_request FROM ".MPREFIX."euser WHERE user_friends_request like '%|".$id."|%' ";
//			$result = mysql_query($query);
//			while($noticia = mysql_fetch_array($result)) {
			$sql->select("euser", "user_id, user_friends_request", "user_friends_request like '%|{$id}|%' ");
			while($noticia = $sql->fetch()) {
//				$friend = $friend.$noticia["user_id"]."|";
				$friend[] = $noticia["user_id"];
			}
//			$friend = explode("|", $friend);
			if ($friend[1] == '') {
			} else {
				$column=1;
				$text .= "<br/><form action='formhandler.php' method='post'><table width='100%'><tr><td class='forumheader' colspan=$frcolumn>".PROFILE_31b."</td></tr>";
				if ($column==1) {
					$text .="<tr>";
				}
				foreach ($friend as $fr) {
					if ($fr == '') {
					} else {
//						$sql->mySQLresult = @mysql_query("SELECT user_name, user_image FROM ".MPREFIX."user WHERE user_id='".$fr."' ");
//						$name = $sql->fetch();
						$sql->select("user", "user_name, user_image", "user_id='{$fr}'");
						$name = $sql->fetch();
						$user_name = $name['user_name'];
						$on_name = "".$fr.".".$user_name."";
//						$check = $sql-> db_Count("online","(*)","WHERE online_user_id='".$on_name."'");
						$check = $sql-> count("online","(*)","WHERE online_user_id='{$on_name}'");
						if( $check > 0 ) {
							$online = "<img src='images/online.gif' title='".PROFILE_96."' style='vertical-align: top;' />";
						} else {
							$online = "";
						}
						unset($check,$on_name);
						$text .= "<td class='forumheader3' width='10%'><a href='euser.php?id=".$fr."'>";
						if($name[user_image] == "") {
							$text .= "<img src='".e_PLUGIN."euser/images/noavatar.png' border='1' width='64' alt='' />";
						}else{
							$user_image = $name[user_image];
							require_once(e_HANDLER."avatar_handler.php");
//							$user_image = avatar($user_image);
							$user_image = e107::getParser()->toAvatar($user_image);
							$text .= "<img src='".$user_image."' border='1' width='64' alt='' />";
						}
						$text .= "<br/></a><input type='hidden' name='uid' value='".$id."'><input type='checkbox' name='boxfr[]' value='".$fr."'> ".$name['user_name']." ".$online."</td>";
						$column++;
						if ($column == $frcolumn + 1) {
							$text .= "</tr>";
							$column = 1;
						}
					}
				}
				if ($euser_pref['buttontype'] == "Yes") {
					$text .= "</table><br><input type='image' name='submit_delete' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_delete_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_delete.gif\"'  src='images/buttons/".e_LANGUAGE."_delete.gif' ></form>";
				} else {
					$text .= "</table><input type='submit' name='submit_delete' value='".PROFILE_188."' class='button'></form>";
				}
			}
		}
*/
//	} elseif ($_GET['page'] == "settings") {
//		$text .= "<table width='100%'><tr><td class='forumheader'><img src='images/settings.png'>&nbsp;".PROFILE_141a."</td></tr></table>";
//		$text .= "<table width='100%'><tr><td class='forumheader'><img src='images/settings.png'><span style='text-align:center;width: 100%;position: absolute;line-height: 1.25em;'><b><u>".PROFILE_141a."</u></b><br>".PROFILE_170."</span></td></tr></table>";
//		$sql->mySQLresult = @mysql_query("SELECT user_settings FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
//		$settings = $sql->fetch();
//		$sql->select("euser", "user_settings", "user_id='{$id}'");
//		$settings = $sql->fetch();
//var_dump($this->euser_data);

// SACAGEM DOS PREFS DO USER -  VOU ALTERAR
		$break = explode("|",$this->euser_data['user_settings']);
		if ($break[0] == 1) {
			$infovis = "checked='yes'";
		}
		if ($break[1] == 1) {
			$prcom = "checked='yes'";
		}
		if ($break[2] == 1) {
			$primgcom = "checked='yes'";
		}
		if ($break[3] == 1) {
			$forumadd = "checked='yes'";
		}
		if ($break[4] == 1) {
			$prvidcom = "checked='yes'";
		}
		if ($euser_pref['fr_req_sendpm'] == 'Yes') {
			if ($break[5] == 1 || !$this->euser_data[0]) {
				$pmfriend = "checked='yes'";
			}
		} else {
			if ($break[5] == 1) {
				$pmfriend = "checked='yes'";
			}
		}
		if ($break[6] == 1) {
			$friendvis = "checked='yes'";
		}
		if ($break[7] == 1) {
			$prvidvis = "checked='yes'";
		}
		if ($break[8] == 1) {
			$primgvis = "checked='yes'";
		}
		if ($break[9] == 1) {
			$prcommvis = "checked='yes'";
		}
		if ($break[10] == 1) {
			$prmp3vis = "checked='yes'";
		}
		if ($euser_pref['fr_req_sendemail'] == 'Yes') {
			if ($break[11] == 1 || !$this->euser_data[0]) {
				$emfriend = "checked='yes'";
			}
		} else {
			if ($break[11] == 1) {
				$emfriend = "checked='yes'";
			}
		}
		// Beállítások
		/*
		$text .= "»»»»»»»»»<table style='width:100%'>";
		$text .= "<form method='POST' action='formhandler.php'>";
		$text .= "<tr>";
		$text .= "<td class='forumheader3' style='vertical-align: top;'>";
		*/
//var_dump($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "");
//echo "<pre>";
//var_dump($euser_pref);
//echo "</pre>";
/*			if ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "") {
			$text .= "<br/><div class='forumheader3'><img src ='images/key.png' style='border: 0px solid black; width: 24px; height: 24px; margin-right: 3px' alt = ''><b>".PROFILE_190."</b></div>";
			$text .= "<input type='checkbox' name='infovis' ".$infovis."> ".PROFILE_102."<br/>";
			if ($euser_pref['commentson'] == "ON" || $euser_pref['commentson'] == "") {
				$text .= "<input type='checkbox' name='prcommvis' ".$prcommvis."> ".PROFILE_254."<br/>";
				$text .= "<input type='checkbox' name='prcom' ".$prcom."> ".PROFILE_103."<br/>";
			}
			if ($euser_pref['pics'] == "ON" || $euser_pref['pics'] == "") {
				$text .= "<input type='checkbox' name='primgvis' ".$primgvis."> ".PROFILE_247."<br/>";
				$text .= "<input type='checkbox' name='primgcom' ".$primgcom."> ".PROFILE_106."<br/>";
			}
			if ($euser_pref['videos'] == "ON" || $euser_pref['videos'] == "") {
				$text .= "<input type='checkbox' name='prvidvis' ".$prvidvis."> ".PROFILE_248."<br/>";
				$text .= "<input type='checkbox' name='prvidcom' ".$prvidcom."> ".PROFILE_116."<br/>";
			}
			$text .= "<input type='checkbox' name='friendvis' ".$friendvis."> ".PROFILE_249."<br/>";
			if ($euser_pref['mp3enabled'] == "ON" || $euser_pref['mp3enabled'] == "") {
				$text .= "<input type='checkbox' name='prmp3vis' ".$prmp3vis."> ".PROFILE_255."<br/>";
			}
		} else {
			$text .= "<br/><div class='forumheader3'><img src ='images/key.png' style='border: 0px solid black; width: 24px; height: 24px; margin-right: 3px' alt = ''><b>".PROFILE_190."</b></div>";
			$text .= "<input type='checkbox' name='infovis' ".$infovis."> ".PROFILE_102a."<br/>";
			if ($euser_pref['commentson'] == "ON" || $euser_pref['commentson'] == "") {
				$text .= "<input type='checkbox' name='prcommvis' ".$prcommvis."> ".PROFILE_254a."<br/>";
				$text .= "<input type='checkbox' name='prcom' ".$prcom."> ".PROFILE_103a."<br/>";
			}
			if ($euser_pref['pics'] == "ON" || $euser_pref['pics'] == "") {
				$text .= "<input type='checkbox' name='primgvis' ".$primgvis."> ".PROFILE_247a."<br/>";
				$text .= "<input type='checkbox' name='primgcom' ".$primgcom."> ".PROFILE_106a."<br/>";
			}
			if ($euser_pref['videos'] == "ON" || $euser_pref['videos'] == "") {
				$text .= "<input type='checkbox' name='prvidvis' ".$prvidvis."> ".PROFILE_248a."<br/>";
				$text .= "<input type='checkbox' name='prvidcom' ".$prvidcom."> ".PROFILE_116a."<br/>";
			}
			if ($euser_pref['mp3enabled'] == "ON" || $euser_pref['mp3enabled'] == "") {
				$text .= "<input type='checkbox' name='prmp3vis' ".$prmp3vis."> ".PROFILE_255a."<br/>";
			}
		}
*/
/*
		if ($euser_pref['friends']) {
			$text .= "<br/><div class='forumheader3'><img src ='images/key.png' style='border: 0px solid black; width: 24px; height: 24px; margin-right: 3px' alt = ''><b>".PROFILE_190."</b></div>";
			$text .= "<input type='checkbox' name='infovis' ".$infovis."> ".PROFILE_102."<br/>";
			if ($euser_pref['commentson']) {
				$text .= "<input type='checkbox' name='prcommvis' ".$prcommvis."> ".PROFILE_254."<br/>";
				$text .= "<input type='checkbox' name='prcom' ".$prcom."> ".PROFILE_103."<br/>";
			}
			if ($euser_pref['pics']) {
				$text .= "<input type='checkbox' name='primgvis' ".$primgvis."> ".PROFILE_247."<br/>";
				$text .= "<input type='checkbox' name='primgcom' ".$primgcom."> ".PROFILE_106."<br/>";
			}
			if ($euser_pref['videos']) {
				$text .= "<input type='checkbox' name='prvidvis' ".$prvidvis."> ".PROFILE_248."<br/>";
				$text .= "<input type='checkbox' name='prvidcom' ".$prvidcom."> ".PROFILE_116."<br/>";
			}
			$text .= "<input type='checkbox' name='friendvis' ".$friendvis."> ".PROFILE_249."<br/>";
			if ($euser_pref['mp3enabled']) {
				$text .= "<input type='checkbox' name='prmp3vis' ".$prmp3vis."> ".PROFILE_255."<br/>";
			}
		} else {
			$text .= "<br/><div class='forumheader3'><img src ='images/key.png' style='border: 0px solid black; width: 24px; height: 24px; margin-right: 3px' alt = ''><b>".PROFILE_190."</b></div>";
			$text .= "<input type='checkbox' name='infovis' ".$infovis."> ".PROFILE_102a."<br/>";
			if ($euser_pref['commentson']) {
				$text .= "<input type='checkbox' name='prcommvis' ".$prcommvis."> ".PROFILE_254a."<br/>";
				$text .= "<input type='checkbox' name='prcom' ".$prcom."> ".PROFILE_103a."<br/>";
			}
			if ($euser_pref['pics']) {
				$text .= "<input type='checkbox' name='primgvis' ".$primgvis."> ".PROFILE_247a."<br/>";
				$text .= "<input type='checkbox' name='primgcom' ".$primgcom."> ".PROFILE_106a."<br/>";
			}
			if ($euser_pref['videos']) {
				$text .= "<input type='checkbox' name='prvidvis' ".$prvidvis."> ".PROFILE_248a."<br/>";
				$text .= "<input type='checkbox' name='prvidcom' ".$prvidcom."> ".PROFILE_116a."<br/>";
			}
			if ($euser_pref['mp3enabled']) {
				$text .= "<input type='checkbox' name='prmp3vis' ".$prmp3vis."> ".PROFILE_255a."<br/>";
			}
		}
		$text .= "</td>";
		*/
		// Profil statisztika
//		$text .= "<td class='forumheader3' style='vertical-align: top;'>";
//		if ($euser_pref['stats'] == "ON" || $euser_pref['stats'] == "") {
/*
			if ($euser_pref['stats']) {
			$text .= "<br/><div class='forumheader3'><img src ='images/stat.png' style='border: 0px solid black; width: 24px; height: 24px; margin-right: 3px' alt = ''><b>".PROFILE_148."</b></div><br/>";
//			$sql->mySQLresult = @mysql_query("SELECT user_lastviewed, user_totalviews FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
//			$getdata = $sql->fetch();
//			$sql->select("euser", "user_lastviewed, user_totalviews","user_id='{$id}'");
//			$this->euser_data = $sql->fetch();
			$data = unserialize($this->euser_data['user_lastviewed']);
			$total = count($data);
			$place = 1;
			$text .= "<b>".PROFILE_142."</b><br/>";
			if ($total == 0 || $data == "") {
				$text .= "<i>".PROFILE_143."</i>";
			} else {
				foreach ($data as $d) {
				$spldata = explode("|", $d);
//				$userdata = get_user_data($spldata[0]);
				$userdata = e107::user($spldata[0]);
				$text .= $place.". ".PROFILE_412.": <a href='".e_BASE."user.php?id.".$userdata['user_id']."'>".$userdata['user_name']."</a> ".PROFILE_413.": ".date("Y/m/d. H:i", $spldata[1])."<br/>";
				$place++;
				}
			}
			if (!$this->euser_data['user_totalviews'] == 0) {
				$text .= "<br/>".PROFILE_144." ".($this->euser_data['user_totalviews'] == 1 ? $this->euser_data['user_totalviews']." ".PROFILE_146." ".PROFILE_147 : $this->euser_data['user_totalviews']."".PROFILE_145." ".PROFILE_147a)."";
			}
		} else {
			$text .= "<i>".PROFILE_148a."</i>";
		}
*/
/*
		$text .= "</td>";
		$text .= "</tr>";
		$text .= "<tr>";
		$text .= "<td class='forumheader3' style='vertical-align: top;'>";
		$text .= "<br/><div class='forumheader3'><img src ='images/otherset.png' style='border: 0px solid black; width: 24px; height: 24px; margin-right: 3px' alt = ''><b>".PROFILE_189."</b></div>";
		if ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "") {
			if ($euser_pref['fr_req_sendpm_all'] != 'on') {
				$text .= "<input type='checkbox' name='pmfriend' ".$pmfriend."> ".PROFILE_122."<br/>";
			}
			if ($euser_pref['fr_req_sendemail_all'] != 'on') {
				$text .= "<input type='checkbox' name='emfriend' ".$emfriend."> ".PROFILE_122a."<br/>";
			}
			$text .= "<input type='checkbox' name='showfrbut' ".$forumadd."> ".PROFILE_111."<br/>";
		}
*/
//		$text .= "<input type='checkbox' name='setavatar' unchecked ".$setavatar."> ".PROFILE_110."<br/>";

//// #### ADDED THEME CHANGER --- NÃO USO, É ESTÚPIDO.... OS TEMAS SÃO GERIDO NO BACKEND
/*
if ((USER == TRUE) && check_class(varset($euser_pref['allow_theme_select'],FALSE)))
{
	$allThemes = TRUE;
	if (isset($euser_pref['allowed_themes']))
	{
		$allThemes = FALSE;
		$themeList = explode(',',$euser_pref['allowed_themes']);
	}
	$handle = opendir(e_THEME);
	while ($file = readdir($handle)) 
	{
		if ($file != "." && $file != ".." && $file != "templates" && $file != "" && $file != "CVS") 
		{
			if (is_readable(e_THEME.$file."/theme.php") && is_readable(e_THEME.$file."/style.css") && ($allThemes || in_Array($file, $themeList))) 
			{
				$themelist[] = $file;
				$themecount[$file] = 0;
			}
		}
	}
	closedir($handle);

	if (count($themelist))
	{
		$defaulttheme = $euser_pref['sitetheme'];
		$count = 0;

//		$totalct = $sql->Select("user", "user_prefs", "user_prefs REGEXP('sitetheme') ");
 
//		while ($row = $sql->fetch()) 
		$totalct = $sql->select("user", "user_prefs", "user_prefs REGEXP('sitetheme')");
 
		while ($row = $sql->fetch()) 
		{
			$up = unserialize($row['user_prefs']);
			if (isset($themecount[$up['sitetheme']])) { $themecount[$up['sitetheme']]++; }
		}
 
//		$defaultusers = $sql->db_Count("user") - $totalct;
		$defaultusers = $sql->count("user") - $totalct;
		$themecount[$defaulttheme] += $defaultusers;
	 
/*
		$text .= "<form method='post' action='".e_SELF."'>
			<div style='text-align:center'>
			<select name='sitetheme' class='tbox' style='width: 95%;'>";
*/
/*
		$text .= LAN_UMENU_THEME_1.": <select name='sitetheme' class='tbox'>";

		$counter = 0;

		while (isset($themelist[$counter]) && $themelist[$counter]) 
		{
			$text .= "<option value='".$themelist[$counter]."' ";
			if (($themelist[$counter] == USERTHEME) || (USERTHEME == FALSE && $themelist[$counter] == $defaulttheme)) 
			{
				$text .= "selected='selected'";
			}
			$text .= ">".($themelist[$counter] == $defaulttheme ? "[ ".$themelist[$counter]." ]" : $themelist[$counter]).' ('.LAN_UMENU_THEME_3.' '.$themecount[$themelist[$counter]].")</option>\n";
			$counter++;
		}

/*
		$text .= "</select>
			<br /><br />
			<input class='button' type='submit' name='settheme' value='".LAN_UMENU_THEME_1."' />
			</div></form>";
*/
/*
		$text .= "</select>";
		$text .="	<input type='hidden' name='settheme' value='1' />";

//		$ns->tablerender(LAN_UMENU_THEME_2, $text, 'usertheme');
	}
}
*/
//// #### END THEME CHANGER
/*
		$text .= "</td>";
		$text .= "<td class='forumheader3' style='vertical-align: top;'>";
		if ($euser_pref['unreg'] == "Yes") {
			$text .= "<br/><div class='forumheader3'><img src ='images/unreg.png' style='border: 0px solid black; width: 24px; height: 24px; margin-right: 3px' alt = ''><b>".PROFILE_281."</b></div>";
			$text .= "<input type='checkbox' name='unreg' unchecked ".$unreg."> ".PROFILE_282."<br/>";
		} else {
			$text .= "<br/><div class='forumheader3'><img src ='images/blank.png' style='border: 0px solid black; width: 24px; height: 24px; margin-right: 3px' alt = ''></div>";
			$text .= "<br/><center><img src ='images/logo.png' style='border: 0px solid black; alt = ''></center>";
			}
*/			
//			VAR_DUMP($id);
//		$text .= "<br/><input type='hidden' name='update_settings' value='".$id."'>";
/*
		$text .= "</td>";
		$text .= "</tr>";
		$text .= "<tr>";
		$text .= "<td colspan = 2 class='forumheader3'>";
		if ($euser_pref['buttontype'] == "Yes") {
			$text .= "<input type='image' name='update'  onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_update_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_update.gif\"' src='images/buttons/".e_LANGUAGE."_update.gif' >";
		} else {
			$text .= "<input type='submit' name='update' value='".PROFILE_191."' class='button'>";
		}
		$text .= "</td>";
		$text .= "</tr></form></table>";
*/
//	} elseif ($_GET['page'] == "videos") {
	if ($_GET['page'] == "videos") {
		//#################################### VER E TIRAR DAQUI
if ($euser_pref['videos'] == "ON" || $euser_pref['videos'] == "") {
			require_once("editvideos.php");
		}
//#################################### VER E TIRAR DAQUI
//} elseif ($_GET['page'] == "mp3") {
//#################################### VER E TIRAR DAQUI
//		require_once("editmp3.php");
//#################################### VER E TIRAR DAQUI
	} elseif ($_GET['page'] == "comments") {
		if ($euser_pref['commentson'] == "ON" || $euser_pref['commentson'] == "") {
//			$text .= "<table width='100%'><tr><td class='forumheader'><img src='images/comments.png'>&nbsp;".PROFILE_62."</td></tr></table>";
      $text .= "<table width='100%'><tr><td class='forumheader'><img src='images/comments.png'><span style='text-align:center;width: 100%;position: absolute;line-height: 1.25em;'><b><u>".PROFILE_62."</u></b><br>";
      $text .= PROFILE_183."</span></td></tr></table>";
			// MULTIPAGES INFO
			$text .= "</center>";
			// Profil hozzászólások listázása
//			$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."euser_com WHERE com_to='".$id."' AND com_type='prof'");
//			$comnumrows = $sql->rows();
			$sql->select("euser_com", "com_id", "com_to='{$id}' AND com_type='prof'");
//			$comnumrows = $sql->rows();
			$comnumrows = $sql->rows();
			// MULTIPAGES INFO
			if ($euser_pref['apcomments'] != '') {
				$rowsPerPage = $euser_pref['apcomments'];
			} else {
				$rowsPerPage = 5;
			}
			$pageNum = 1;
			if(isset($_GET['pgnum'])) {
				$pageNum = intval($_GET['pgnum']);
			}
			$offset = ($pageNum - 1) * $rowsPerPage;
//			$sql->mySQLresult = @mysql_query("SELECT com_id, com_message, com_date, com_by FROM ".MPREFIX."euser_com WHERE com_to='".$id."' AND com_type='prof' ORDER BY com_date DESC LIMIT $offset,$rowsPerPage");
//			$comm = $sql->rows();
			$sql->select("euser_com", "com_id, com_message, com_date, com_by", "com_to='{$id}' AND com_type='prof' ORDER BY com_date DESC LIMIT {$offset},{$rowsPerPage}");
			$comm = $sql->rows();
			$maxPage = ceil($comnumrows/$rowsPerPage);
			$self = $_SERVER['PHP_SELF'];
			$nav  = '';
			for($page = 1; $page <= $maxPage; $page++) {
				if ($page == $pageNum) {
					 $nav .= "";
				} else {
					$nav .= " <a href=\"$self?id=".$id."&page=comments&pgnum=".$page."\">$page</a> ";
				}
			}
			if ($pageNum > 1) {
				$page  = $pageNum - 1;
				$prev  = " <a href=\"$self?id=".$id."&page=comments&pgnum=".$page."\">".PROFILE_204."</a> ";
				$first = " <a href=\"$self?id=".$id."&page=comments&pgnum=".$page."\">".PROFILE_205."</a> ";
			} else {
				$prev  = '';
				$first = '&nbsp;';
			}
			if ($pageNum < $maxPage) {
				$page = $pageNum + 1;
				$next = " <a href=\"$self?id=".$id."&page=comments&pgnum=".$page."\">".PROFILE_202."</a> ";
				$last = " <a href=\"$self?id=".$id."&page=comments&pgnum=".$page."\">".PROFILE_203."</a> ";
			} else {
				$next = ''; // we're on the last page, don't print next link
				$last = '&nbsp;'; // nor the last page link
			}
			// END OF MULTIPAGES
			if ($comm == 0) {
				$text .= "<br/><i>".PROFILE_68."</i>";
			} else {
				$text .= "<br/><form action='formhandler.php' method='post'>";
				$text .= "<table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><i>".PROFILE_62." (".$comnumrows."):</i></td></tr></table>";
				//Profil hozzászólások listája indul
				for ($i = 0; $i < $comm; $i++) {
//				$com = $sql->fetch();
					$com = $sql->fetch();
//				$from = mysql_query("SELECT * FROM ".MPREFIX."user WHERE user_id=".$com['com_by']." ");
//				$from = mysql_fetch_assoc($from);
				$from = $sql->select("user", "(*)", "user_id={$com['com_by']}");
				$comid = $com['com_id'];
				$user_name = $from['user_name'];
				$on_name = "".$com['com_by'].".".$user_name."";
//				$checkonline = mysql_query("SELECT * FROM ".MPREFIX."online WHERE online_user_id='".$on_name."'");
//				$checkonline = mysql_num_rows($checkonline);
				$checkonline = $sql->count("online", "(*)", "online_user_id='{$on_name}'");
				//e107_0.8 compatible
				// level_handler não existe...
				if(file_exists(e_HANDLER."level_handler.php")){
					require_once(e_HANDLER."level_handler.php");
					$ldata = get_level($from['user_id'], $from['user_forums'], $from['user_comments'], $from['user_chats'], $from['user_visits'], $from['user_join'], $from['user_admin'], $from['user_perms'], $euser_pref);
				} else {
					//
				}
				if (strstr($ldata[0], "IMAGE_rank_main_admin_image")) {
					$from_level = "".PROFILE_276."<br/>$ldata[1]";
				}
				else if(strstr($ldata[0], "IMAGE")) {
					$from_level = "".PROFILE_277."<br/>$ldata[1]<br/>";
				} else {
					$from_level = $ldata[1];
				}
				$gen = new convert;
				$from_join = $gen->convert_date($from['user_join'], "forum");
				$from_signature = $from['user_signature'] ? $tp->toHTML($from['user_signature'], TRUE) : "";
//				$fromext = mysql_query("SELECT * FROM ".MPREFIX."user_extended WHERE user_extended_id=".$com['com_by']." ");
//				$fromext = mysql_fetch_assoc($fromext);
				$fromext = $sql->select("user_extended", "(*)", "user_extended_id={$com['com_by']}");
				if( $checkonline > 0 ) {
					$online = "<img src='images/online.gif' title='".PROFILE_96."' style='vertical-align: middle;' />";
				} else {
					$online = "";
				}
				unset($checkonline,$on_name);
				$date = date("Y.m.d.   H:i", $com['com_date']);
				if ($com['com_date'] >= $userlastvisit) {
					$newcom = "<font color='#FF0000'>".PROFILE_200."</font>";
				} else {
					$newcom = "";
				}
				$text .= "<br><table width='100%' class='fborder'>
					<tr>
						<td style='width:20%; text-align:left' class='fcaption'>".PROFILE_268."".$from['user_name']."</td>
						<td style='width:60%; text-align:left' class='fcaption'>".PROFILE_269."</td>
						<td style='width:20%; text-align:right' class='fcaption'>id: #".$comid."</td>
					</tr>
					<td class='forumheader'> ".$newcom."<br>&nbsp;<input type='checkbox' name='cbox[]' value='".$com['com_id']."'>&nbsp;".$online."&nbsp;&nbsp;<a href='euser.php?id=".$com['com_by']."'><b>".$from['user_name']."</b></a></td>
					<td class='forumheader' style='vertical-align: middle;' /><img src='images/post.png'>&nbsp;".$date."</td>
					<td class='forumheader' style='vertical-align: middle; text-align:right' /><a href='".e_PLUGIN."pm/pm.php?send.".$com['com_by']."'><img src='".e_PLUGIN."/pm/images/pm.png' title='".PROFILE_138."'></a></td></tr>
					<tr><td class='forumheader3' style='vertical-align: top; width='20%;' />";
				// GET COMMENTERS AVATAR
				if($from[user_image] == "") {
					$av = "".e_PLUGIN."euser/images/noavatar.png";
					$text .= "".$from['user_customtitle']."<br/><br/><a href='euser.php?id=".$com['com_by']."'><img src='".$av."' border='1' ".$avwidth." ".$avheight."  alt='' /></a>";
				} else {
					$av = $from[user_image];
					require_once(e_HANDLER."avatar_handler.php");
					$av = avatar($av);
					$text .= "".$from['user_customtitle']."<br/><br/><a href='euser.php?id=".$com['com_by']."'><img src='".$av."' border='1' ".$avwidth." ".$avheight."  alt='' /></a>";
				}
				if ($euser_pref['user_warn_support'] == "Yes" AND $fromext['user_warn'] !='null' AND $fromext['user_warn'] !='') {
					$text .= "<br/><img src=\"".THEME_ABS."images/warn/".$fromext['user_warn'].".png\">";
				}
				$text .= "<br/>$from_level<br/><div class='smallblacktext'>".PROFILE_270."$from_join<br/>".PROFILE_272.$fromext['user_location']."</div></td>";
				$message = $tp -> toHTML($com['com_message'], true, 'parse_sc, constants');
				$text .= "<td class='forumheader3' colspan='2' style='vertical-align: top;'>".$message."<hr width='80%' align='left' size='1' noshade ='noshade'>$from_signature</td></tr>
				<tr><td class='forumheader'><div class='smallblacktext'><a href='".e_SELF."?".e_QUERY."#top' onclick=\"window.scrollTo(0,0);\">".PROFILE_271."</a></div></td><td class='forumheader' colspan='2'><div align='right' class='smallblacktext'><a href='euser.php?id=".$com['com_by']."&page=comments'>".PROFILE_137a."".$from['user_name']."".PROFILE_137b."</a>";

				$splitfr = explode("|", $this->euser_data['user_friends']);
				if ($euser_pref['friends'] == "ON" && !in_array($com['com_by'], $splitfr)) {
					$text .= " | <a href='euser.php?id=".$com['com_by']."&add'>".PROFILE_139."</a>";
				}
				$text .= "</div></td></tr></table><br/><br/>";
			}
		}
		// Profil hozzászólások
		$text .= "<table width='100%'><tr><td><input type='hidden' name='uid' value='".$id."'>";
		if (!$comnumrows==0) {
			if ($euser_pref['buttontype'] == "Yes") {
				$text .= "<input type='image' name='comment_delete' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_delete_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_delete.gif\"' src='images/buttons/".e_LANGUAGE."_delete.gif' >";
			} else {
				$text .= "<input type='submit' name='comment_delete' value='".PROFILE_192."' class='button'>";
			}
		}
		$text .= "</form></td><td><div align='right'>".$prev.$nav.$next."</div></td></tr></table>";
		}
	} elseif ($_GET['page'] == "images") {
		if ($euser_pref['pics'] == "ON" || $euser_pref['pics'] == "") {
//			$text .= "<table width='100%'><tr><td class='forumheader'><img src='images/images.png'>".PROFILE_61."</td></tr></table>";
      $text .= "<table width='100%'><tr><td class='forumheader'><img src='images/images.png'><span style='text-align:center;width: 100%;position: absolute;line-height: 1.25em;'><b><u>".PROFILE_61."</u></b><br>".PROFILE_173."".sprintf("%01.1f", $kvota)."".PROFILE_174."$maxalbumnumber".PROFILE_174a."$maxpicnumber".PROFILE_174b." ".sprintf("%01.1f", $maxkepmeret)."".PROFILE_175."</span></td></tr></table>";
			// IMAGE GALLERY FUNCTIONS
			define ("MAX_SIZE","100");
			if ($euser_pref['im_width'] != "") {
				define ("WIDTH", $euser_pref['im_width']);
			} else {
				define ("WIDTH","100");
			}
			if ($euser_pref['im_height'] != "") {
				define ("HEIGHT", $euser_pref['im_height']);
			} else {
				define ("HEIGHT","150");
			}
			function getExtension($str) {
				$i = strrpos($str,".");
				if (!$i) { return ""; }
				$l = strlen($str) - $i;
				$ext = substr($str,$i+1,$l);
				return $ext;
			}
			if ($euser_pref['imagick_support'] == "Yes" && extension_loaded('imagick')) {
				define ("IMAGICK", "1");
			}
			// THUMBNAIL GENERATION
			function make_thumb($img_name,$filename,$new_w,$new_h){
				$gd_kepmeret = getimagesize($img_name);
				$gd_kep_res = $gd_kepmeret[0] * $gd_kepmeret[1];
				if ($gd_kepmeret[0] > WIDTH || $gd_kepmeret[1] > HEIGHT) {
				// IMAGICK
					if (IMAGICK == 1) {
						$im_picture = new Imagick($img_name);
						$imfit = (($new_w/$gd_kepmeret[0])<($new_h/$gd_kepmeret[1])) ?true:false;
						if ($im_picture->getNumberImages() > 1) {
							foreach($im_picture as $frame){
								if($imfit){
									$im_frame_w = $frame->getimagewidth()*($new_w/$gd_kepmeret[0]);
									$image_page = $frame->getimagepage();
									$x = $image_page['x']*($new_w/$gd_kepmeret[0]);
									$y = $image_page['y']*($new_w/$gd_kepmeret[0]);
									$frame->thumbnailImage($im_frame_w, 0, false);
									$frame->setimagepage($new_w,$image_page['height']*($new_w/$gd_kepmeret[0]),$x,$y);
								}else{
									$im_frame_h = $frame->getimageheight()*($new_h/$gd_kepmeret[1]);
									$image_page = $frame->getimagepage();
									$x = $image_page['x']*($new_h/$gd_kepmeret[1]);
									$y = $image_page['y']*($new_h/$gd_kepmeret[1]);
									$frame->thumbnailImage(0, $im_frame_h, false);
									$frame->setimagepage($image_page['width']*($new_h/$gd_kepmeret[1]),$new_h,$x,$y);
								}
							}
							$im_picture->writeImages($filename, true);
						}else{
							if($imfit){
								$im_picture->thumbnailImage($new_w, 0, false);
							}else{
								$im_picture->thumbnailImage(0, $new_h, false);
							}
							$im_picture->writeImage($filename);
						}
						imagedestroy($im_picture);
					// GD
					}else {
						$gd_resolution = round(ini_get('memory_limit') / 1.8 / 3 * 1024000);
						if (extension_loaded('gd') && function_exists('gd_info') && $gd_kep_res <= $gd_resolution) {
							$ext=getExtension($img_name);
							if(!strcmp("jpg",$ext) || !strcmp("jpeg",$ext))
								$src_img = imagecreatefromjpeg($img_name);
							if(!strcmp("png",$ext))
								$src_img=imagecreatefrompng($img_name);
							if(!strcmp("gif",$ext))
								$src_img=imagecreatefromgif($img_name);
								$old_x=imageSX($src_img);
								$old_y=imageSY($src_img);
								$ratio1=$old_x/$new_w;
								$ratio2=$old_y/$new_h;
							if($ratio1>$ratio2) {
								$thumb_w=$new_w;
								$thumb_h=$old_y/$ratio1;
							} else {
								$thumb_h=$new_h;
								$thumb_w=$old_x/$ratio2;
							}
							$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
							if(strcmp("png",$ext) || strcmp("gif",$ext)){
								imagealphablending($dst_img, false);
								imagesavealpha($dst_img,true);
								$transparent = imagecolorallocatealpha($dst_img, 255, 255, 255, 127);
								imagefilledrectangle($dst_img, 0, 0, $thumb_w, $thumb_h, $transparent);
								imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
							}
							if($ext = "gif" || $ext = "GIF") {
								if(function_exists('imagegif')) {
									imagegif($dst_img,$filename);
								}
							}
							if($ext = "png" || $ext = "PNG") {
								if(function_exists('imagepng')) {
									imagepng($dst_img,$filename);
								}
							} else {
								if(function_exists('imagejpeg')) {
									imagejpeg($dst_img,$filename);
								}
							}
							imagedestroy($dst_img);
							imagedestroy($src_img);
						}
					}
				} else {
					if (!copy($img_name, $filename)) {
						echo "failed to copy $filename...\n";
					}
				}
			}
			// END OF THUMBNAIL GENERATION
			// GET DIRECTORY SIZE
			function getDirectorySize($path) {
				$totalsize = 0;
				$totalcount = 0;
				$dircount = 0;
				if ($handle = opendir ($path)) {
					while (false !== ($file = readdir($handle))) {
						$nextpath = $path . '/' . $file;
						if ($file != '.' && $file != '..' && !is_link ($nextpath)) {
							if (is_dir ($nextpath)) {
								$dircount++;
								$result = getDirectorySize($nextpath);
								$totalsize += $result['size'];
								$totalcount += $result['count'];
								$dircount += $result['dircount'];
							} elseif (is_file ($nextpath)) {
								$totalsize += filesize ($nextpath);
								$totalcount++;
							}
						}
					}
				}
				closedir ($handle);
				$total['size'] = $totalsize;
				$total['count'] = $totalcount;
				$total['dircount'] = $dircount;
				return $total;
			}
			function sizeFormat($size) {
				$size=round($size/1024,0);
				return $size."";
			}
			// END OF IMAGE GALLERY FUNCTIONS
			if (isset($_GET['album']) && isset($_GET['pic'])) {
				if ($_GET['album'] != "root") {
					$dir = "userimages/".$id."/".$_GET['album']."/";
				} else {
					$dir = "userimages/".$id."/";
				}
				$text .= "<br/><br/><a href='euser_settings.php?page=images".$luid."'><< ".PROFILE_69."</a><br/>";
				if ($_GET['album'] != "root") {
					$text .= "<a href='euser_settings.php?page=".$_GET['page']."".$luid."&album=".$_GET['album']."'><< ".PROFILE_34a." \"".str_replace("_"," ", $_GET['album'])."\"</a><br/><br/>";
				} else {
					$text .= "<br/>";
				}
				if (isset($_GET['setasdp'])) {
					$albumneve = $_GET['album'];
					if ($_GET['album'] == "root") {
						$albumneve = "";
					}
					$k_nev = "userimages/".$id."/".$albumneve."/thumbs/";
					if (is_dir($k_nev)) {
						if ($k_azon = opendir($k_nev)) {
							while (($fajl = readdir($k_azon)) !== false) {
								if ($fajl == $_GET['pic']){ 
									$darab = 1;
								}
        						}
        						closedir($k_azon);
    						}
					}
					if (extension_loaded('gd') && function_exists('gd_info') && $darab !=0) {
						if ($_GET['album'] != "root") {
							$pic = $_GET['album']."/thumbs/".$_GET['pic'];
						} else {
							$pic = "thumbs/".$_GET['pic'];
						}
					} else {
						if ($_GET['album'] != "root") {
							$pic = $_GET['album']."/".$_GET['pic'];
						} else {
							$pic = $_GET['pic'];
						}
					}
//					$sql -> db_Update("user", "user_image='".SITEURLBASE.e_PLUGIN_ABS."euser/userimages/".$id."/".mysql_real_escape_string($pic)."' WHERE user_id='".$id."' ");
					$sql -> update("user", "user_image='".SITEURLBASE.e_PLUGIN_ABS."euser/userimages/".$id."/".mysql_real_escape_string($pic)."' WHERE user_id='".$id."' ");
					if ($_GET['album'] != "root") {
						header("Location: euser_settings.php?page=images".$luid."&album=".mysql_real_escape_string($_GET['album'])."");
					} else {
						header("Location: euser_settings.php?page=images".$luid."");
					}
				}
				$split = explode(".", $_GET['pic']);
				$counter=0;
				foreach($split as $string) {
					$counter++;
					if ($string == '') {
						$split_id = $split[$counter];
						$id = $split_id;
						$lnk=true;
						break;
					}
				}
				$kiterjesztes = $split[$counter - 1];
				$picname = str_replace(".".$split[$counter - 1]."", "", $_GET['pic']);
				$myFile = $dir.$picname.".txt";
				// Kép megjelenítése
				$kepmeret = getimagesize("".$dir.$_GET['pic']."");
				$kep_sz = $kepmeret[0]+30;
				$kep_m = $kepmeret[1]+30;
				if ($euser_pref['picviewsize'] == '') {
					$picviewsize = '600';
				} else {
					$picviewsize = $euser_pref['picviewsize'];
				}
				if ($kep_sz<$picviewsize+31) {
					$text .= "<center><img src='".$dir.$_GET['pic']."'><br>".str_replace("_", " ", $picname)."<br/><br/><br/><a href=\"javascript:doMenu('renameimage');\" id='xrenameimage'>[".PROFILE_133."]</a>";
				} else if ($euser_pref['lightview'] == 'Yes' && $euser_pref['cl_widget_ver'] != '') {
					$text .= "<center><a href='".$dir.$_GET['pic']."' class=\"lightview\" title='".str_replace("_", " ", $picname)."'><img src='".$dir.$_GET['pic']."' width='$picviewsize'></a><br>".str_replace("_", " ", $picname)."<br/><br/><br/><a href=\"javascript:doMenu('renameimage');\" id='xrenameimage'>[".PROFILE_133."]</a>";
				} else if ($euser_pref['lightwindowbox'] == 'Yes' && (file_exists(e_PLUGIN."lightwindow/js/lightwindow.js"))) {
					$text .= "<center><a href='".$dir.$_GET['pic']."' class=\"lightwindow\" title='".$_GET['pic']."'><img src='".$dir.$_GET['pic']."' width='$picviewsize'></a><br>".str_replace("_", " ", $picname)."<br/><br/><br/><a href=\"javascript:doMenu('renameimage');\" id='xrenameimage'>[".PROFILE_133."]</a>";
				} else if ($euser_pref['lightbox'] == 'Yes' && $euser_pref['lightb_enabled'] == '1'){
					$text .= "<center><a href='".$dir.$_GET['pic']."' rel=\"lightbox[roadtrip]\" title='".$_GET['pic']."'><img src='".$dir.$_GET['pic']."' width='$picviewsize'></a><br>".str_replace("_", " ", $picname)."<br/><br/><br/><a href=\"javascript:doMenu('renameimage');\" id='xrenameimage'>[".PROFILE_133."]</a>";

				} else if ($euser_pref['clearbox'] == 'Yes'){
					echo '
						<script language="JavaScript" src="clearbox/js/clearbox.js" type="text/javascript" charset="iso-8859-2"></script>
						<link rel="stylesheet" href="clearbox/css/clearbox.css" rel="stylesheet" type="text/css"/>
					';
					$text .= "<center><a href='".$dir.$_GET['pic']."' rel=\"clearbox\" title='".$_GET['pic']."'><img src='".$dir.$_GET['pic']."' width='$picviewsize'></a><br/>".str_replace("_", " ", $picname)."<br/><br/><br/><a href=\"javascript:doMenu('renameimage');\" id='xrenameimage'>[".PROFILE_133."]</a>";
				} else {
					$text .= "<center><a href='#' title='".PROFILE_167."' onClick=\"window.open('".$dir.$_GET['pic']."','','menubar=no,titlebar=no,resizable=no,scrollbars=yes,width=$kep_sz,height=$kep_m')\"><img src='".$dir.$_GET['pic']."' width='$picviewsize'></a><br>".str_replace("_", " ", $picname)."<br/><br/><br/><a href=\"javascript:doMenu('renameimage');\" id='xrenameimage'>[".PROFILE_133."]</a>";
				}
				if (isset($_GET['renameerror'])) {
					if ($euser_pref['accents'] == "Yes") {
						$text .= "<br/><br/>".PROFILE_125d;
					} else {
						$text .= "<br/><br/>".PROFILE_125b;
					}
				}
				$text .= "<br/><br/><div id='renameimage' style='display:none'><form enctype='multipart/form-data' method='POST' action='formhandler.php'>
				".PROFILE_131." <input name='newname' class='tbox' type='text' value='".str_replace("_", " ", $picname)."'>
				<input name='origname' type='hidden' value='".$_GET['pic']."'><input type='hidden' name='album' value='".$_GET['album']."'><input name='uid' type='hidden' value='".$id."'><input type='submit' value='".PROFILE_132."' name='renameimage' class='button'>
				</form></div>";
				$text .= "</center>";
				// Kép hozzászólások listázása
//				$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."euser_com WHERE com_to='".$id."' AND com_extra='".mysql_real_escape_string($_GET['album'])."/".mysql_real_escape_string($_GET['pic'])."'");
//				$picnumrows = $sql->rows();
				$sql->select("euser_com", "com_id", "com_to='{$id}' AND com_extra='{$_GET['album']}/{$_GET['pic']}'");
				$picnumrows = $sql->rows();
				if ($euser_pref['apcomments'] != '') {
					$rowsPerPage = $euser_pref['apcomments'];
				} else {
					$rowsPerPage = 5;
				}
				$pageNum = 1;
				if(isset($_GET['pgnum'])) {
					$pageNum = intval($_GET['pgnum']);
				}
				$offset = ($pageNum - 1) * $rowsPerPage;
//				$sql->mySQLresult = @mysql_query("SELECT com_id, com_message, com_date, com_by FROM ".MPREFIX."euser_com WHERE com_to='".$id."' AND com_type='pics' AND com_extra='".mysql_real_escape_string($_GET['album'])."/".mysql_real_escape_string($_GET['pic'])."' ORDER BY com_date DESC LIMIT $offset,$rowsPerPage");
//				$comm = $sql->rows();
				$sql->select("euser_com", "com_id, com_message, com_date, com_by", "com_to='{$id}' AND com_type='pics' AND com_extra='{$_GET['album']}/{$_GET['pic']}' ORDER BY com_date DESC LIMIT {$offset},{$rowsPerPage}");
				$comm = $sql->rows();
				$maxPage = ceil($picnumrows/$rowsPerPage);
				$self = $_SERVER['PHP_SELF'];
				$nav  = '';
				for($page = 1; $page <= $maxPage; $page++) {
					if ($page == $pageNum) {
					 $nav .= "";
					} else {
						$nav .= " <a href=\"$self?page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&pgnum=".$page."\">$page</a> ";
					}
				}
				if ($pageNum > 1) {
					$page  = $pageNum - 1;
					$prev  = " <a href=\"$self?page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&pgnum=".$page."\">".PROFILE_204."</a> ";
					$first = " <a href=\"$self?page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&pgnum=".$page."\">".PROFILE_205."</a> ";
				} else {
					$prev  = ''; // we're on page one, don't print previous link
					$first = '&nbsp;'; // nor the first page link
				}
				if ($pageNum < $maxPage) {
					$page = $pageNum + 1;
					$next = " <a href=\"$self?page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&pgnum=".$page."\">".PROFILE_202."</a> ";
					$last = " <a href=\"$self?page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&pgnum=".$page."\">".PROFILE_203."</a> ";
				} else {
					$next = ''; // we're on the last page, don't print next link
					$last = '&nbsp;'; // nor the last page link
				}
				// END OF MULTIPAGES
				if ($comm == 0) {
					$text .= "<br/><i>".PROFILE_68."</i>";
				} else {
					$text .= "<br/><form action='formhandler.php' method='post'>";
					$text .= "<br><table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><i>".PROFILE_36a." (".$picnumrows."):</i></td></tr></table>";
					//Kép hozzászólások listája indul
					for ($i = 0; $i < $comm; $i++) {
//						$com = $sql->fetch();
//						$from = mysql_query("SELECT * FROM ".MPREFIX."user WHERE user_id=".$com['com_by']." ");
//						$from = mysql_fetch_assoc($from);
						$com = $sql->fetch();
						$from = $sql->select("user", "(*)", "user_id={$com['com_by']}");
						$comid = $com['com_id'];
						$user_name = $from['user_name'];
						$on_name = "".$com['com_by'].".".$user_name."";
//						$checkonline = mysql_query("SELECT * FROM ".MPREFIX."online WHERE online_user_id='".$on_name."'");
//						$checkonline = mysql_num_rows($checkonline);
						$checkonline = $sql->count("online", "(*)", "online_user_id='{$on_name}'");
				//e107_0.8 compatible
				if(file_exists(e_HANDLER."level_handler.php")){
					require_once(e_HANDLER."level_handler.php");
				$ldata = get_level($from['user_id'], $from['user_forums'], $from['user_comments'], $from['user_chats'], $from['user_visits'], $from['user_join'], $from['user_admin'], $from['user_perms'], $euser_pref);
				} else {
					//
				}				if (strstr($ldata[0], "IMAGE_rank_main_admin_image")) {
					$from_level = "".PROFILE_276."<br/>$ldata[1]";
				}
				else if(strstr($ldata[0], "IMAGE")) {
					$from_level = "".PROFILE_277."<br/>$ldata[1]<br/>";
				} else {
					$from_level = $ldata[1];
				}
				$gen = new convert;
				$from_join = $gen->convert_date($from['user_join'], "forum");
				$from_signature = $from['user_signature'] ? $tp->toHTML($from['user_signature'], TRUE) : "";
//				$fromext = mysql_query("SELECT * FROM ".MPREFIX."user_extended WHERE user_extended_id=".$com['com_by']." ");
//				$fromext = mysql_fetch_assoc($fromext);
				$fromext = $sql->select("user_extended", "(*)", "user_extended_id={$com['com_by']}");
				if( $checkonline > 0 ) {
					$online = "<img src='images/online.gif' title='".PROFILE_96."' style='vertical-align: middle;' />";
				} else {
					$online = "";
				}
				unset($checkonline,$on_name);
				$date = date("Y.m.d.   H:i", $com['com_date']);
				if ($com['com_date'] >= $userlastvisit) {
					$newcom = "<font color='#FF0000'>".PROFILE_200."</font>";
				} else {
					$newcom = "";
				}
				$text .= "<br><table width='100%' class='fborder'>
					<tr>
						<td style='width:20%; text-align:left' class='fcaption'>".PROFILE_268."".$from['user_name']."</td>
						<td style='width:60%; text-align:left' class='fcaption'>".PROFILE_269."</td>
						<td style='width:20%; text-align:right' class='fcaption'>id: #".$comid."</td>
					</tr>
					<td class='forumheader'> ".$newcom."<br>&nbsp;<input type='checkbox' name='combox[]' value='".$com['com_id']."'><input type='hidden' name='album' value='".$_GET['album']."'>&nbsp;".$online."&nbsp;&nbsp;<a href='euser.php?id=".$com['com_by']."'><b>".$from['user_name']."</b></a></td>
					<td class='forumheader' style='vertical-align: middle;' /><img src='images/post.png'>&nbsp;".$date."</td>
					<td class='forumheader' style='vertical-align: middle; text-align:right' /><a href='".e_PLUGIN."pm/pm.php?send.".$com['com_by']."'><img src='".e_PLUGIN."/pm/images/pm.png'title='".PROFILE_138."'></a></td></tr>
					<tr><td class='forumheader3' style='vertical-align: top; width='20%;' />";
				// GET COMMENTERS AVATAR
				if($from[user_image] == "") {
					$av = "".e_PLUGIN."euser/images/noavatar.png";
					$text .= "".$from['user_customtitle']."<br/><br/><a href='euser.php?id=".$com['com_by']."'><img src='".$av."' border='1' ".$avwidth." ".$avheight."  alt='' /></a>";
				} else {
					$av = $from[user_image];
					require_once(e_HANDLER."avatar_handler.php");
					$av = avatar($av);
					$text .= "".$from['user_customtitle']."<br/><br/><a href='euser.php?id=".$com['com_by']."'><img src='".$av."' border='1' ".$avwidth." ".$avheight."  alt='' /></a>";
				}
				if ($euser_pref['user_warn_support'] == "Yes" AND $fromext['user_warn'] !='null' AND $fromext['user_warn'] !='') {
					$text .= "<br/><img src=\"".THEME_ABS."images/warn/".$fromext['user_warn'].".png\">";
				}
				$text .= "<br/>$from_level<br/><div class='smallblacktext'>".PROFILE_270."$from_join<br/>".PROFILE_272.$fromext['user_location']."</div></td>";
				$message = $tp -> toHTML($com['com_message'], true,  'parse_sc, constants');
				$text .= "<td class='forumheader3' colspan='2' style='vertical-align: top;'>".$message."<hr width='80%' align='left' size='1' noshade ='noshade'>$from_signature</td></tr>
				<tr><td class='forumheader'><div class='smallblacktext'><a href='".e_SELF."?".e_QUERY."#top' onclick=\"window.scrollTo(0,0);\">".PROFILE_271."</a></div></td><td class='forumheader' colspan='2'><div align='right' class='smallblacktext'><a href='euser.php?id=".$com['com_by']."&page=comments'>".PROFILE_137a."".$from['user_name']."".PROFILE_137b."</a>";
				if ($euser_pref['friends'] == "ON") {
					$text .= " | <a href='euser.php?id=".$com['com_by']."&add'>".PROFILE_139."</a>";
				}
				$text .= "</div></td></tr>";
				$text .= "</table><br/><br/>";
			}
			// Hozzászólások listázásának vége
			$text .= "<table width='100%'><tr><td><input type='hidden' name='uid' value='".$id."'><input type='hidden' name='image' value='".$_GET['pic']."'>";
			if ($euser_pref['buttontype'] == "Yes") {
				$text .= "<input type='image' name='comment_delete' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_delete_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_delete.gif\"' src='images/buttons/".e_LANGUAGE."_delete.gif' >";
			} else {
				$text .= "<input type='submit' name='comment_delete' value='".PROFILE_192."' class='button'>";
			}
				$text .= "</form></td><td><div align='right'>".$prev.$nav.$next."</div></td></tr></table>";
				}
			} elseif (isset($_GET['album']) && !isset($_GET['pic'])) {
				if ($euser_pref['piccol']) {
					$profile_piccol = $euser_pref['piccol'];
				} else {
					$profile_piccol = 3;
				}
				$profile_piccol_p = intval(100/$profile_piccol);
				$text .= "<br/><br/><a href='euser_settings.php?page=".$_GET['page']."".$luid."'><< ".PROFILE_69."</a> | <a href=\"javascript:doMenu('renamealbum');\" id='xrenamealbum'>".PROFILE_129."</a> | <a href=\"javascript:doMenu('upload');\" id='xupload'>".PROFILE_130."</a>";
				$text .= "<br/><br/>";
				$path = "userimages/".$id."/";
				$ar=getDirectorySize($path);
				$totalsize = sizeFormat($ar['size']);
				if ($euser_pref['maxuploadsize'] == '') {
					$upsize = '1024';
				} else {
					$upsize = $euser_pref['maxuploadsize'];
				}
				if ($totalsize >= ($upsize - 200) ) {
					$text .= "".PROFILE_243."<span style='color:red'>$totalsize ".PROFILE_244."</span>";
				} else {
					$text .= "".PROFILE_243." $totalsize ".PROFILE_244."";
				}
				$root_path = "userimages/".$id."/";
				$target_path = "userimages/".$id."/".$_GET['album']."/";
				$path = $root_path;
				$ar=getDirectorySize($path);
				$totalsize = sizeFormat($ar['size']);
				if ($euser_pref['maxpicnumber'] == '') {
					$maxpicnumber = '10';
				} else {
					$maxpicnumber = $euser_pref['maxpicnumber'];
				}
				$path = "userimages/".$id."/".$_GET['album']."/";
				$album_kepekszama = count(glob($path . '*.*'));
				if ($totalsize > $upsize) {
					$text .= "<div id='upload' style='display:none'><br/>".PROFILE_70."$kvota".PROFILE_70a."</div>";
				} else if ($album_kepekszama > $maxpicnumber) {
					$text .= "<div id='upload' style='display:none'><br/>".PROFILE_245."$maxpicnumber".PROFILE_246."</div>";
				} else {
					$text .= "<div id='upload' style='display:none'><br/><form enctype='multipart/form-data' method='POST'>
					".PROFILE_126." <input name='file_userfile[]' class='tbox' type='file'>
					<input type='submit' value='".PROFILE_71."' name='submitupload' class='button'>
					</form></div>";
				}
				$text .= "<div id='renamealbum' style='display:none'><br/><form enctype='multipart/form-data' method='POST' action='formhandler.php'>
				".PROFILE_131." <input name='newname' class='tbox' type='text' value='".str_replace("_", " ", $_GET['album'])."'>
				<input name='origname' type='hidden' value='".$_GET['album']."'><input name='uid' type='hidden' value='".$id."'><input type='submit' value='".PROFILE_132."' name='renamealbum' class='button'>
				</form></div>";
				$text .= "<br/><hr>";
				if (isset($_GET['renameerror'])) {
					if ($euser_pref['accents'] == "Yes") {
						$text .= "<br/>".PROFILE_125c."<br/>";
					} else {
						$text .= "<br/>".PROFILE_125a."<br/>";
					}
				}
				if (isset($_POST['submitupload'])) {
					require_once(e_HANDLER."upload_handler.php");
					$uploaded = file_upload("userimages/".$id."/".$_GET['album']."/", "unique");
					$file = $uploaded[0]['name'];
					$filetype = $uploaded[0]['type'];
					$filesize = $uploaded[0]['size'];
					$newname="userimages/".$id."/".$_GET['album']."/".$file;
					$thumb_name = "userimages/".$id."/".$_GET['album']."/thumbs/".$file;
					$thumb = make_thumb($newname,$thumb_name,WIDTH,HEIGHT);
					if ((($filetype == "image/gif") || ($filetype == "image/jpeg") || ($filetype == "image/png") || ($filetype == "image/pjpeg") || ($filetype == "image/x-png") || ($filetype == ""))  && (($filesize * 0.0009765625) < $maxkepmeret_kb) && $file != "" && $euser_pref['upload_enabled'] && !preg_match("/\.\./", $file)) {
						new_user_row($id);
//						$sql -> db_Update("euser", "user_lastupdated='".time()."' WHERE user_id='".$id."' ");
//						$sql -> db_Update("euser", "user_custompage='upload_album_image' WHERE user_id='".$id."' ");
						$sql -> update("euser", "user_lastupdated='".time()."' WHERE user_id='{$id}'");
						$sql -> update("euser", "user_custompage='upload_album_image' WHERE user_id='{$id}'");
						header("Location: euser_settings.php?page=images".$luid."&album=".$_GET['album']."&uploaded=".$file."");
					} else {
					unlink("userimages/".$id."/".$_GET['album']."/".$file."");
					unlink("userimages/".$id."/".$_GET['album']."/thumbs/".$file."");
					header("Location: euser_settings.php?page=images".$luid."&album=".$_GET['album']."&failed=true");
					}
				}
				if (isset($_GET['failed'])) {
					$text .= "<br/>".PROFILE_136." ".$maxkepmeret_kb." kB.";
				}
				$text .= "<br/>";
				if (isset($_GET['uploaded'])) {
					$text .= "<b>".PROFILE_74.":</b> ".PROFILE_75." ".$_GET['uploaded']." ".PROFILE_76.".<br/><br/>";
				}
				if (isset($_GET['del'])) {
					$text .= "<b>".PROFILE_74.":</b> ".PROFILE_77.".<br/><br/>";
				}

				// GALLERY
				$dir = "userimages/".$id."/".$_GET['album']."/";
				if ($handle = opendir($dir)) {
					$filenames = array();
					while (false !== ($filename = readdir($handle))) {
						$file_list[] = array('name' => $filename, 'size' => filesize($dir."/".$filename), 'mtime' => filemtime($dir."/".$filename));
					}
if ($euser_pref['userpic_order'] == 'ASC' || $euser_pref['userpic_order'] == '') {
						usort($file_list, create_function('$a, $b', "return strcmp(\$a['mtime'], \$b['mtime']);"));
} else {
						usort($file_list, create_function('$b, $a', "return strcmp(\$a['mtime'], \$b['mtime']);"));
}
					closedir($handle);
				}
				$text .= "<table width='100%' class='fborder'><tr><td class='forumheader'><i>".$_GET['album']."".PROFILE_275."</i></td></tr></table>";
				$text .= "<br/><form action='formhandler.php' method='post'><table width='100%'>";
				$column = 1;
				foreach($file_list as $one_file) {
					$file = $one_file['name'];
					$pos = strrpos($file, '.');
					$str = substr($file, $pos, strlen($file));
					$filetypes = ".jpg|.gif|.png|.jpeg|.JPG|.GIF|.PNG|.JPEG";
					$filetypes = explode("|", $filetypes);
					if(!is_dir($file) && in_array($str, $filetypes)) {
						$split = explode(".", $file);
						$counter=0;
						foreach($split as $string) {
							$counter++;
							if ($string == '') {
								$split_id = $split[$counter];
								$id = $split_id;
								$lnk=true;
								break;
							}
						}
						$kiterjesztes = $split[$counter - 1];
						$name = str_replace(".".$split[$counter - 1]."", "", $file);
						$newname = wordwrap($name, 17, "<br />\n");
//						$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."euser_com WHERE com_to='".$id."' AND com_type='pics' AND com_extra='".mysql_real_escape_string($_GET['album'])."/".mysql_real_escape_string($file)."' AND com_date > '".$userlastvisit."' ");
//						$piccomm = $sql->rows();
						$sql->select("euser_com", "com_id", "com_to='{$id}' AND com_type='pics' AND com_extra='{$_GET['album']}/{$file}' AND com_date > '{$userlastvisit}'");
						$piccomm = $sql->rows();
						if ($piccomm > 0) {
							$newpiccom = "<br/><font color='#FF0000'> ".$piccomm." ".($piccomm == 1 ? MENU_PROFILE_2 : MENU_PROFILE_2a)."</font>";
						} else {
							$newpiccom = "";
//							$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."euser_com WHERE com_to='".$id."' AND com_type='pics' AND com_extra='".mysql_real_escape_string($_GET['album'])."/".mysql_real_escape_string($file)."' ");
//							$piccomm_all = $sql->rows();
							$sql->select("euser_com", "com_id", "com_to='{$id}' AND com_type='pics' AND com_extra='{$_GET['album']}/{$file}'");
							$piccomm_all = $sql->rows();
							if ($piccomm_all > 0) {
								$newpiccom = "<br/>".$piccomm_all." ".($piccomm_all == 1 ? PROFILE_315 : PROFILE_315)."";
							} else {
								$newpiccom = "";
							}
						}
						if ($column==1) { $text .="<tr>"; }
						//Album pictures
						if (file_exists($dir."thumbs/".$file)) {
							$text .= "<td width='".$profile_piccol_p."%'><center><a href='euser_settings.php?page=images".$luid."&album=".$_GET['album']."&pic=".$file."'><img src='".$dir."thumbs/".$file."'></a><br/><input type='hidden' name='uid' value='".$id."'><input type='hidden' name='album' value='".$_GET['album']."'><input type='checkbox' name='chbox[]' value='".$_GET['album']."/".$file."'>".str_replace("_", " ", $newname).$newpiccom."<br/><a href='euser_settings.php?page=images".$luid."&album=".$_GET['album']."&pic=".$file."&setasdp'>".PROFILE_108."</a></center></td>";
						} else {
							$text .= "<td width='".$profile_piccol_p."%'><center><a href='euser_settings.php?page=images".$luid."&album=".$_GET['album']."&pic=".$file."'><img src='".$dir.$file."' width='100' ></a><br/><input type='hidden' name='uid' value='".$id."'><input type='hidden' name='album' value='".$_GET['album']."'><input type='checkbox' name='chbox[]' value='".$_GET['album']."/".$file."'>".str_replace("_", " ", $newname).$newpiccom."<br/><a href='euser_settings.php?page=images".$luid."&album=".$_GET['album']."&pic=".$file."&setasdp'>".PROFILE_108."</a></center></td>";
						}
						$column++;
						if ($column == $profile_piccol+1) {
							$text .= "</tr><tr><td><br/></td></tr>";
							$column = 1;
						}
					}
				}
				$text .= "</table><br/><br/><input type='hidden' name='delimages'>";
				if ($euser_pref['buttontype'] == "Yes") {
					$text .= "<input type='image' name='submit_delete' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_delete_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_delete.gif\"'  src='images/buttons/".e_LANGUAGE."_delete.gif' >";
				} else {
					$text .= "<input type='submit' name='submit_delete' value='".PROFILE_193."' class='button'>";
				}
				$text .= "</form>";
			} else {
				if ($euser_pref['piccol']) {
					$profile_piccol = $euser_pref['piccol'];
				} else {
					$profile_piccol = 3;
				}
				$profile_piccol_p = intval(100/$profile_piccol);
				$dir = "userimages/".$id."";
				if (is_dir('$dir')) {
					$ans = "yes";
					chmod($dir, 0755);
				} else {
					mkdir($dir, 0755);
					mkdir($dir."/thumbs", 0755);
					chmod($dir, 0755);
					chmod($dir."/thumbs", 0755);
					fopen($dir."/index.htm",'a');
					fopen($dir."/thumbs/index.htm",'a');
				}
				$dir = "userimages/".$id."/";
				if ($handle = opendir($dir)) {
					$filenames = array();
					while (false !== ($filename = readdir($handle))) {
						$file_list[] = array('name' => $filename, 'size' => filesize($dir."/".$filename), 'mtime' => filemtime($dir."/".$filename));
					}
if ($euser_pref['userpic_order'] == 'ASC' || $euser_pref['userpic_order'] == '') {
						usort($file_list, create_function('$a, $b', "return strcmp(\$a['mtime'], \$b['mtime']);"));
} else {
						usort($file_list, create_function('$b, $a', "return strcmp(\$a['mtime'], \$b['mtime']);"));
}
					closedir($handle);
				}
				$text .= "<br/><a href=\"javascript:doMenu('album');\" id='xalbum'>".PROFILE_194."</a> | <a href=\"javascript:doMenu('upload');\" id='xupload'>".PROFILE_195."</a>";
				if ($euser_pref['maxalbumnumber'] == '') {
					$maxalbumnumber = '6';
				} else {
					$maxalbumnumber = $euser_pref['maxalbumnumber'];
				}
				$dir_path="userimages/".$id."/";
				$dir_kezelo=@opendir($dir_path)or die("Unable to open $dir_path");
				$dir_counter = 0;
				while($dir_num = readdir($dir_kezelo)) {
					if($dir_num == "." || $dir_num == ".." || $dir_num == "thumbs" )
					continue;
					if(is_dir($dir_path."/".$dir_num)) {
						$dir_counter = $dir_counter + 1;
					}
				}
				$path = "userimages/".$id."/";
				$ar=getDirectorySize($path);
				$totalsize = sizeFormat($ar['size']);
				if ($euser_pref['maxuploadsize'] == '') {
					$upsize = '1024';
				} else {
					$upsize = $euser_pref['maxuploadsize'];
				}
				$text .= "<br/><br/>";
				if ($dir_counter >= ($maxalbumnumber - 1) ) {
					$text .= "".PROFILE_242."<span style='color:red'>$dir_counter ".PROFILE_236.". </span>";
				} else {
					$text .= "".PROFILE_242." $dir_counter ".PROFILE_236.". ";
				}
				if ($totalsize >= ($upsize - 200) ) {
					$text .= "".PROFILE_243."<span style='color:red'>$totalsize ".PROFILE_244."</span>";
				} else {
					$text .= "".PROFILE_243." $totalsize ".PROFILE_244."";
				}
				if ($dir_counter > ($maxalbumnumber - 1) ) {
					$text .= "<div id='album' style='display:none'><br/>".PROFILE_241."(".$dir_counter."".PROFILE_236.").</div>";
				} else {
					$text .= "<div id='album' style='display: none'><br/><form method='POST' action='formhandler.php'>".PROFILE_124." <input type='hidden' name='id' value='".$id."'><input type='text' name='newalbum'> <input type='submit' class='button' value='".PROFILE_196."'></form></div>";
				}
				if ($euser_pref['maxpicnumber'] == '') {
					$maxpicnumber = '10';
				} else {
					$maxpicnumber = $euser_pref['maxpicnumber'];
				}
				$path = "userimages/".$id."/";
				$album_kepekszama = count(glob($path . '*.*'));
				if ($totalsize > $upsize) {
					$text .= "<div id='upload' style='display:none'><br/>".PROFILE_70."$kvota".PROFILE_70a."</div>";
				} else if ($album_kepekszama > $maxpicnumber) {
					$text .= "<div id='upload' style='display:none'><br/>".PROFILE_245."$maxpicnumber".PROFILE_246."</div>";
				} else {
					$text .= "<div id='upload' style='display: none'><br/><form enctype='multipart/form-data' method='POST' >
					".PROFILE_126." <input name='file_userfile[]' type='file'>
					<input type='submit' value='".PROFILE_71."' name='submitupload' class='button'>
					</form></div>";
				}
				$text .= "<br/><hr>";
				if (isset($_POST['submitupload'])) {
					require_once(e_HANDLER."upload_handler.php");
					$uploaded = file_upload("userimages/".$id."/", "unique");
					$file = $uploaded[0]['name'];
					$filetype = $uploaded[0]['type'];
					$filesize = $uploaded[0]['size'];
					$newname="userimages/".$id."/".$file;
					$thumb_name = "userimages/".$id."/thumbs/".$file;
					$thumb = make_thumb($newname,$thumb_name,WIDTH,HEIGHT);
					echo $uploaded[0]['extension'];
					if ((($filetype == "image/gif") || ($filetype == "image/jpeg") || ($filetype == "image/png") || ($filetype == "image/pjpeg") || ($filetype == "image/x-png") || ($filetype == ""))  && (($filesize * 0.0009765625) < $maxkepmeret_kb) && $file != "" && $euser_pref['upload_enabled'] && !preg_match("/\.\./", $file)) {
						new_user_row($id);
						$sql -> db_Update("euser", "user_lastupdated='".time()."' WHERE user_id='".$id."' ");
						$sql -> db_Update("euser", "user_custompage='upload_image' WHERE user_id='".$id."' ");
						header("Location: euser_settings.php?page=images".$luid."&uploaded=".$file."");
					} else {
						unlink("userimages/".$id."/".$file."");
						unlink("userimages/".$id."/thumbs/".$file."");
						header("Location: euser_settings.php?page=images".$luid."&failed=true");
					}
				}
				if (isset($_GET['failed'])) {
					$text .= "".PROFILE_136." ".$maxkepmeret_kb." kB.";
				}
				$text .= "<br/>";
				if (isset($_GET['uploaded'])) {
					$text .= "<b>".PROFILE_74.":</b> ".PROFILE_75." ".$_GET['uploaded']." ".PROFILE_76."<br/><br/>";
				}
				if (isset($_GET['del'])) {
					$text .= "<b>".PROFILE_74.":</b> ".PROFILE_77.".<br/><br/>";
				}
				if (isset($_GET['error'])) {
					if ($euser_pref['accents'] == "Yes") {
						$text .= "".PROFILE_125c."<br/><br/>";
					} else {
						$text .= "".PROFILE_125a."<br/><br/>";
					}
				}
				if ($totalsize > 0 || $dir_counter > 0){
					$text .= "<table width='100%' class='fborder'><tr><td class='forumheader'><i>".PROFILE_274."</i></td></tr></table>";
					$text .= "<br/><br/><form method='post' action='formhandler.php'><table width='100%'><tr>";
					if ($handle = opendir($dir)) {
						$col = 0;
						$piccol = 0;
						foreach($file_list as $one_file) {
							$file = $one_file['name'];
							if ($file != "." && $file != ".." && $file != "Thumbs.db"  && $file != "thumbs"  && substr(strrchr($file, '.'), 1) != "txt"  && substr(strrchr($file, '.'), 1) != "htm" ) {
								if (substr(strrchr($file, '.'), 1) != "") {
//									$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."euser_com WHERE com_to='".$id."' AND com_type='pics' AND com_extra='root/".mysql_real_escape_string($file)."' AND com_date > '".$userlastvisit."' ");
//									$piccomm = $sql->rows();
									$sql->select("euser_com", "com_id", "com_to='{$id}' AND com_type='pics' AND com_extra='root/{$file}' AND com_date > '{$userlastvisit}'");
									$piccomm = $sql->rows();
									if ($piccomm > 0) {
										$newpiccom = "<br/><font color='#FF0000'> ".$piccomm." ".($piccomm == 1 ? MENU_PROFILE_2 : MENU_PROFILE_2a)."</font>";
									} else {
										$newpiccom = "";
//										$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."euser_com WHERE com_to='".$id."' AND com_type='pics' AND com_extra='root/".mysql_real_escape_string($file)."' ");
//										$piccomm_all = $sql->rows();
										$sql->select("euser_com", "com_id", "com_to='{$id}' AND com_type='pics' AND com_extra='root/{$file}'");
										$piccomm_all = $sql->rows();
										if ($piccomm_all > 0) {
											$newpiccom = "<br/>".$piccomm_all." ".($piccomm_all == 1 ? PROFILE_315 : PROFILE_315)."";
										} else {
											$newpiccom = "";
										}
									}
									$split = explode(".", $file);
									$counter=0;
									foreach($split as $string) {
										$counter++;
										if ($string == '') {
											$split_id = $split[$counter];
											$id = $split_id;
											$lnk=true;
											break;
										}
									}
									$kiterjesztes = $split[$counter - 1];
									$name = str_replace(".".$split[$counter - 1]."", "", $file);
									$newname = wordwrap($name, 17, "<br />\n");
									//Pictures:
									if (file_exists($dir."thumbs/".$file)) {
										$pic .= "<td width='".$profile_piccol_p."%'><center><a href='euser_settings.php?page=images".$luid."&album=root&pic=".$file."'><img src='".$dir."thumbs/".$file."'></a><br/><input type='hidden' name='uid' value='".$id."'><input type='checkbox' name='delrootpic[]' value='".$file."'> ".str_replace("_", " ", $newname).$newpiccom."<br/><a href='euser_settings.php?page=images".$luid."&album=root&pic=".$file."&setasdp'>".PROFILE_108."</a></center></td>";
									} else {
										$pic .= "<td width='".$profile_piccol_p."%'><center><a href='euser_settings.php?page=images".$luid."&album=root&pic=".$file."'><img src='".$dir.$file."' width='100' ></a><br/><input type='hidden' name='uid' value='".$id."'><input type='checkbox' name='delrootpic[]' value='".$file."'> ".str_replace("_", " ", $newname).$newpiccom."<br/><a href='euser_settings.php?page=images".$luid."&album=root&pic=".$file."&setasdp'>".PROFILE_108."</a></center></td>";
									}
									$piccol++;
									if ($piccol == $profile_piccol) {
										$pic .= "</tr><tr><td><br/></td></tr><tr>";
										$piccol = 0;
									}
								} else {

									if (isset($_GET['setasonlyfriends']) && $euser_pref['private_albums'] == "Yes") {
										$albumneve = $_GET['priv_album'];
										$only_friends_file = "userimages/".$id."/".$albumneve."/only_friends";
										if(!file_exists($only_friends_file)) {
											$fh = fopen($only_friends_file,'a') or die("can't open file: ".$only_friends_file);
											$only_friends_file_data = "Please don't remove this file";
											fwrite($fh, $only_friends_file_data);
											fclose($fh);
										}
									}
									if (isset($_GET['setasnofriends'])) {
										$albumneve = $_GET['priv_album'];
										$only_friends_file = "userimages/".$id."/".$albumneve."/only_friends";
										if (file_exists($only_friends_file)) {
											unlink($only_friends_file);
										}
									}
									$count = 0;
									$firstimage="";
									$newcomcount = 0;
									if ($subhandle = opendir($dir.$file)) {
										$aof = 0;
										while (false !== ($subfile = readdir($subhandle))) {
										if ($subfile=="only_friends") $aof = 1;
											if ($subfile != "only_friends" && $subfile != "." && $subfile != ".." && $subfile != "Thumbs.db" && $subfile != "thumbs"  && $subfile != "index.htm" ) {
												if ($firstimage == "") {
													$firstimage = $subfile;
												}
//												$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."euser_com WHERE com_to='".$id."' AND com_type='pics' AND com_extra='".mysql_real_escape_string($file)."/".mysql_real_escape_string($subfile)."' AND com_date > '".$userlastvisit."' ");
//												$piccomm = $sql->rows();
												$sql->select("euser_com", "com_id", "com_to='{$id}' AND com_type='pics' AND com_extra='{$file}"/"{$subfile}' AND com_date > '{$userlastvisit}'");
												$piccomm = $sql->rows();
												if ($piccomm > 0) {
													$newcomcount = $newcomcount + $piccomm;
												} else {
//													$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."euser_com WHERE com_to='".$id."' AND com_type='pics' AND com_extra='".mysql_real_escape_string($file)."/".mysql_real_escape_string($subfile)."' ");
//													$piccomm_all = $sql->rows();
													$sql->select("euser_com", "com_id", "com_to='{$id}' AND com_type='pics' AND com_extra='{$file}/{$subfile}'");
													$piccomm_all = $sql->rows();
													if ($piccomm_all > 0) {
													$newcomcount_all = $newcomcount_all + $piccomm_all;
													}
												}
												$count = $count + 1;
											}
										}
									}
									if (file_exists($dir.$file."/thumbs/".$firstimage)) {
										$imageurl = "src='userimages/".$id."/".$file."/thumbs/".$firstimage."' ";
									} else {
										$imageurl = "src='userimages/".$id."/".$file."/".$firstimage."' width='100' ";
									}
									if ($newcomcount > 0) {
										$newpiccom = "<br/><font color='#FF0000'> ".$newcomcount." ".($newcomcount == 1 ? MENU_PROFILE_2 : MENU_PROFILE_2a)."</font>";
									} else {
										$newpiccom = "";
										if ($newcomcount_all > 0) {
											$newpiccom = "".$newcomcount_all." ".($newcomcount_all == 1 ? PROFILE_315 : PROFILE_315)."";
										} else {
											$newpiccom = "";
										}
									}
									if (($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "") && $euser_pref['private_albums'] == "Yes") {
										$priv_alb = PROFILE_419;
									} else if ($euser_pref['private_albums'] == "Yes") {
										$priv_alb = PROFILE_421;
									}
									if ($count == 0) {
										//Empty albums:
										$text .= "<td width='".$profile_piccol_p."%'><center><a href='euser_settings.php?page=images&album=".$file.$luid."'><img src='images/folder.png' width='64' height='64' style='padding:2px;".($aof == 1 ? "color:red;" : "color:green;")."border-style:outset;border-width:1px'></a><br/><input type='hidden' name='uid' value='".$id."'><input type='checkbox' name='delal[]' value='".$file."'> <b>".str_replace("_", " ", $file)."</b><br/>".$count." ".($count == 1 ? PROFILE_134 : PROFILE_135).$newpiccom."<br/>
										".($aof == 1 ? "<a href='euser_settings.php?page=images".$luid."&priv_album=".$file.$luid."&setasnofriends'>".PROFILE_420."</a>" : "<a href='euser_settings.php?page=images".$luid."&priv_album=".$file.$luid."&setasonlyfriends'>".$priv_alb."</a>")."<br/><br/></center></td>";
									} else {
										//Albums:
										if ($count > 0) {
											$text .= "<td width='".$profile_piccol_p."%'><center><a href='euser_settings.php?page=images&album=".$file.$luid."'><img ".$imageurl." style='padding:2px;".($aof == 1 ? "color:red;" : "color:green;")."border-style:outset;border-width:2px'></a><br/><input type='hidden' name='uid' value='".$id."'><b>".str_replace("_", " ", $file)."</b><br/>".$count." ".($count == 1 ? PROFILE_134 : PROFILE_135).$newpiccom."<br/>
											".($aof == 1 ? "<a href='euser_settings.php?page=images".$luid."&priv_album=".$file.$luid."&setasnofriends'>".PROFILE_420."</a>" : "<a href='euser_settings.php?page=images".$luid."&priv_album=".$file.$luid."&setasonlyfriends'>".$priv_alb."</a>")."<br/><br/></center></td>";
										} else {
											$text .= "<td width='".$profile_piccol_p."%'><center><a href='euser_settings.php?page=images&album=".$file.$luid."'><img ".$imageurl." style='padding:2px;".($aof == 1 ? "color:red;" : "color:green;")."border-style:outset;border-width:3px'></a><br/><input type='hidden' name='uid' value='".$id."'><input type='checkbox' name='delal[]' value='".$file."'> <b>".str_replace("_", " ", $file)."</b><br/>".$count." ".($count == 1 ? PROFILE_134 : PROFILE_135).$newpiccom."<br/>
											".($aof == 1 ? "<a href='euser_settings.php?page=images".$luid."&priv_album=".$file.$luid."&setasnofriends'>".PROFILE_420."</a>" : "<a href='euser_settings.php?page=images".$luid."&priv_album=".$file.$luid."&setasonlyfriends'>".$priv_alb."</a>")."<br/><br/></center></td>";
										}
									}
									$col++;
									if ($col == $profile_piccol) {
										$text .= "</tr><tr><td><br/></td></tr><tr>";
										$col = 0;
									}
								}
							}
						}
					}
					$text .= "</tr><tr>".$pic."</tr></table><br/><br/><input type='hidden' name='delalbum'>";
					$text .= "<hr>";
					if ($euser_pref['buttontype'] == "Yes") {
						$text .= "<input type='image' name='submit_delete' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_delete_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_delete.gif\"' src='images/buttons/".e_LANGUAGE."_delete.gif' >";
					} else {
						$text .= "<input type='submit' name='submit_delete' value='".PROFILE_197."' class='button'>";
					}
					$text .= "</form>";
				}
			}
		}
	}
		// MINDENNEK VÉGE
//} else {
// Que raio é isto? Não faz nada...
/*
	if ($euser_pref['custdisplay'] == 'Advanced Version') {
	} elseif ($euser_pref['custdisplay'] == 'Both Versions') {
	}
}
*/
//$text .= $tmpl['main'];
//$text .= $eus->euser_init();

//$eusersettings_sc->wrapper('euser_settings/edit');
//$this->sc->wrapper('euser_settings/edit');
// ISTO TAMBÉM ESTÁ NO EUSER. FAZER UM TRAIT?
/*
if(ADMIN)
{
//	var_dump($euser_pref['friends']);
	$sections = $euser_pref['friends']?LAN_EUSER_130.", ":null;
	$sections .= $euser_pref['pics']?LAN_EUSER_140.", ":null;
	$sections .= $euser_pref['videos']?LAN_EUSER_150:null;
	$adminwarn = "<div class='alert alert-warning'>".$tp->lanVars($tp->toHTML(LAN_EUSER_6, true), array('x'=>$sections)).'</div>';
}
*/
$adminwarn = $this->adminwarn($euser_pref);
// Tenho de usar o hidden que vem do core
//$text .= "<input type='hidden' name='update_settings' value='".$id."'>";

$display = $adminwarn.$tp->parseTemplate($text, TRUE, $this->sc);

if (isset($_GET['mp3done'])) {
	$ns->tablerender("",PROFILE_156);
} elseif (isset($_GET['mp3failed'])) {
	$ns->tablerender("",PROFILE_157);
}

if (isset($_GET['first'])) {
	$ns->tablerender(PROFILE_127.SITENAME.PROFILE_201,PROFILE_128);
	// Este select já está no $this->euser_data...
	$sql -> Select("euser", "(*)", "user_id='".USERID."'");
	$count = $sql -> rows();
	if ($count == 0) {
		$sql -> db_Insert("euser", "'".USERID."', '', '', '', '', '', '', '', '', '', ''");
	}
}



// ##########################################################################################
// Que raio de definição do title é esta????....
// ##########################################################################################
/*
if (isset($_GET['uid'])) {
	$title = ADMIN_PROFILE_15;
} else {
	$title = "";
}
*/
/*
function new_user_row($member_id) {
	global $sql;
	// Isto também é igual ao um que está mais acima... e no $this->euser_data
	$sql -> Select("euser", "(*)", "user_id='".$member_id."'");
	$count = $sql -> rows();
	if ($count == 0) {
	return	$sql -> db_Insert("euser", "'".$member_id."', '', '', '', '', '', '', '', '', '', ''");
	}
}
*/
//var_dump ($this->euser_data['user_settings']);
$curVal['euser_data'] = $this->euser_data; 
$curVal['euser_pref'] = $euser_pref;
//$this->sc->setVars($curVal);

//$ns->tablerender(e107::getParser()->simpleParse($this->template['caption']??PROFILE_46.strtolower(LAN_USER_50)."&nbsp;{USER_ID} : {USER_NAME} : {USER_LOGINNAME}", array_change_key_case(e107::user($id), CASE_UPPER)),$display);
return $display;
}


//function euser_check (&$userMethods, &$udata){
function euser_check (){
		// Now validate everything - just check everything that's been entered
//--			$allData = validatorClass::validateFields($_POST,$userMethods->userVettingInfo, TRUE);		// Do basic validation
//--			validatorClass::dbValidateArray($allData, $userMethods->userVettingInfo, 'user', $inp);		// Do basic DB-related checks
//--			$userMethods->userValidation($allData);														// Do user-specific DB checks
	// Process POST
//	var_dump($flags);
//	var_dump($this->flags);
/*
echo "<pre>POST:";
var_dump($_POST['showfrbut']);
var_dump($_POST);
echo "</pre>";
*/
	if ($_POST){
//	$prompt = true;
	foreach (array('showfrbut', 'pmfriend', 'emfriend') as $val){
		$_POST[$val]?$_POST['eprefs'][]='+'.$this->flags[$val]:null;
		$prompt = isset($_POST[$val]);
		//		var_dump($_POST[$val]);
		unset($_POST[$val]);
	}
	$eData['user_settings'] = array_sum($_POST['eprefs']);
	in_array('none', $_POST['mp3'])?null:$eData['user_mp3'] = $_POST['mp3']['remote'];
//	var_dump($_POST['mp3']);
//	var_dump(array_search('none', $_POST['mp3']));
//	var_dump(in_array('nonedsadsd', $_POST['mp3']));
	/*
	$_POST['showfrbut']?$_POST['eprefs'][]='+'.$flags['showfrbut']:null;
	$_POST['pmfriend']?$_POST['eprefs'][]='+'.$flags['pmfriend']:null;
	$_POST['emfriend']?$_POST['eprefs'][]='+'.$flags['emfriend']:null;
	unset($_POST['showfrbut']);
	unset($_POST['pmfriend']);
	unset($_POST['emfriend']);
*/
/*
echo "<pre>";
var_dump($udata);
echo "</pre>";
echo "<pre>";
var_dump($this->euser_data);
echo "</pre>";
*/
/*
	var_dump($prompt);
	echo "<pre>POST:";
	var_dump($_POST['showfrbut']);
	var_dump($_POST);
	echo "</pre>";
	echo "<pre>EDATA:";
	var_dump($eData);
	echo "</pre>";
	echo "<pre>EUSERDATA:";
	var_dump($this->euser_data);
	echo "</pre>";
*/
	// Setup validation strings
//	$userMethods->userVettingInfo['user_settings'] = array('niceName'=> LAN_EUSER_102, 'fieldType' => 'string', 'vetMethod' => '0', 'vetParam' => '', 'srcName' => 'eprefs', 'dataType' => '1');
//	$userMethods->userVettingInfo['mp3_embed'] = array('niceName'=> LAN_EUSER_103, 'fieldType' => 'string', 'vetMethod' => '0', 'vetParam' => '', 'srcName' => 'mp3');	// mp3			
//	var_dump ($userMethods->userVettingInfo);
//exit;
// Tenho de depois por aqui o proprio validate meu
//----$euserVals = $ue->sanitizeAll($eu_settings);
//----$euserVals = $ue->userExtendedValidateAll($euserVals, varset($_POST['hide'],TRUE));		// Validate the extended user fields

$this->changedEUSERData['data'] = validatorClass::findChanges($eData, $this->euser_data,FALSE);
$this->changedEUSERData['WHERE'] = 'user_id='.USERID;
/*
echo "<pre>CHANGEDEUSERDATA:";
var_dump ($this->changedEUSERData['data']);
echo "</pre>";
var_dump ($this->changedEUSERData['data'] && $prompt);
*/
return $this->changedEUSERData['data'] && $prompt;
	}

}	

function euser_save (){
	// Now validate everything - just check everything that's been entered
//--			$allData = validatorClass::validateFields($_POST,$userMethods->userVettingInfo, TRUE);		// Do basic validation
//--			validatorClass::dbValidateArray($allData, $userMethods->userVettingInfo, 'user', $inp);		// Do basic DB-related checks
//--			$userMethods->userValidation($allData);														// Do user-specific DB checks
/*
echo "<pre>CHANGEDEUSERDATA:";
var_dump ($this->changedEUSERData);
echo "</pre>";
*/
//	$eData['user_settings'] = array_sum(explode(',', $datatosave['data']['user_settings']));
//	$eData['WHERE'] = $datatosave['WHERE'];
//	var_dump ($eData);
//	var_dump($update = $this->sql->update('euser', $this->changedEUSERData));
	$update = $this->sql->update('euser', $this->changedEUSERData);
		if (FALSE === $update || $update === 0) {
			$this->sql->insert('euser', USERID.", '', '', '', '', ".$this->changedEUSERData['data']['user_settings'].", 1, '', 0, 0, ''");
	}
//exit;
/*
$changedUserData = e107::unserialize($new_data);
$changedUserData = e107::getParser()->filter($changedUserData, 'str');
*/
$this->euser_data = $this->sql->retrieve("euser", "*", "user_id='".USERID."'");
//var_dump($this->euser_data);

}	

/*
function render_caption(){
//	var_dump ($info);
//	$caption = $this->template['caption']??PROFILE_46.strtolower(LAN_USER_50)."&nbsp;{USER_ID} : {USER_NAME} : {USER_LOGINNAME}";
////////////////////	$user_data = e107::user($_GET['uid']);
/*
	echo "<pre>";
	var_dump ($this->template);
	echo "</pre>";
*/
/*
	return (USERID?e107::getParser()->simpleParse($this->template['edit_caption'], array_change_key_case(e107::user(USERID), CASE_UPPER)):LAN_EUSER_101);
//	$caption = (isset($USERSETTINGS_EDIT_CAPTION)) ? $USERSETTINGS_EDIT_CAPTION : LAN_USET_39;
	//$eusersettings_sc->setVars($user_data);
//	return e107::getParser()->simpleParse($this->template['edit_caption'], array_change_key_case(e107::user($_GET['uid']??USERID), CASE_UPPER));
//	return LAN_USET_39;
//	return e107::getParser()->simpleParse($this->template['edit_caption'], array_change_key_case(e107::user(USERID), CASE_UPPER));
}
*/
}

$eus = new euser_settings_front;
//var_dump ($eus);

require_once(HEADERF);
$eus->init();
//$eus->euser_init();
require_once(FOOTERF);