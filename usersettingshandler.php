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

// ##########################################################################################
// ESTE FICHEIRO USA CÓDIGO QUE TAMBÉM ESTÁ NO euser_settings.php, PRINCIPALMENTE O MENU COMPLETO, POR ISSO É CANDIDATO A IR LÁ PARA DENTRO OU FAZER-SE UMA CLASS............
// ##########################################################################################



*/
if(!defined("e107_INIT")) {
	require_once("../../class2.php");
}
require_once(e_LANGUAGEDIR."/".e_LANGUAGE."/lan_usersettings.php");
if(file_exists(e_PLUGIN."euser/languages/".e_LANGUAGE.".php")){
	require_once(e_PLUGIN."euser/languages/".e_LANGUAGE.".php");
} else {
	require_once(e_PLUGIN."euser/languages/English.php");
}

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

define("e_PAGETITLE", TITLE_PROFILE_2);

// DISPLAY MENU
if (USER) {
	if (isset($_GET['uid'])) {
		$id = intval($_GET['uid']);
	} else {
		$id = USERID;
	}
	$sql -> db_Select("user", "*", "user_id=".$id."");
	$user = $sql -> db_Fetch();
	$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
	$friends = $sql->db_Fetch();

	// NEW COMMENTS
	$sql->mySQLresult = @mysql_query("SELECT user_lastvisit FROM ".MPREFIX."user WHERE user_id='".$id."' ");
	$lastvisit = $sql->db_Fetch();

	$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."euser_com WHERE com_date > '".$lastvisit['user_lastvisit']."' AND com_to='".$id."' AND com_type='prof' ");
	$comnumrows = $sql->db_Rows();

	// NEW PIC COMMENTS
	$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."euser_com WHERE com_date > '".$lastvisit['user_lastvisit']."' AND com_to='".$id."' AND com_type='pics' ");
	$picnumrows = $sql->db_Rows();

	// NEW VID COMMENTS
	$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."euser_com WHERE com_date > '".$lastvisit['user_lastvisit']."' AND com_to='".$id."' AND com_type='vids' ");
	$vidnumrows = $sql->db_Rows();

	if ($friends['user_friends_request'] == "") {
		$count = 0;
	} else {
		$break = explode("|", $friends['user_friends_request']);
		$count = count($break) - 2;
	}
}

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
$sql->mySQLresult = @mysql_query("SELECT user_display FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
$display = $sql->db_Fetch();

if ($display['user_display'] == '') {
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
	if (file_exists("userimages/".$id."/".$display['user_display']."")) {
		$avatar .= "<img src='userimages/".$id."/".$display['user_display']."' border='1' width='".$avwidth."' height='".$avheight."' alt='' />";
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

// END OF

if (isset($_GET['uid']) && ADMIN) {
	$luid = "&uid=".$_GET['uid']."";
}
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

$top .="<div class='main_caption'><b>".PROFILE_46."</div></b><br/><br/>";
$top .="<table style='width:100%' class='fborder'>";
$top .="<tr><td colspan='3' class='fcaption' style='text-align:center'> ".$id."".PROFILE_169."".$username_nav."</td></tr>";
$top .="<tr><td rowspan=$image_rowspan width='30%' class='forumheader3'><center>{$profil_image}<br>".$username_nav."</center></td></tr>";

// Hozzaferesi beallitasok
$top .="<tr><td {$main_colspan} width='20%' class='forumheader3'>";
	$top .= "<img src ='images/key.png' style='border: 0px solid black; width: 16px; height: 16px; margin-right: 3px' alt = ''><a href='euser_settings.php?page=settings".$luid."'>".PROFILE_141."</a><br/>";
	$top .= "</td><td class='forumheader3'>".PROFILE_170."</td></tr>";
// Barátok
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
	$sql->mySQLresult = @mysql_query("SELECT user_id, user_custompage, user_background, user_simple, user_mp3 FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
	$rows = $sql->db_Rows();
	$profile = $sql->db_Fetch();
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
//$top .= "<table width='100%'><tr><td class='forumheader'><img src='images/settings.png'>&nbsp;".PROFILE_59."</td></tr></table><br />";
$top .= "<table width='100%'><tr><td class='forumheader'><img src='images/settings.png'><span style='text-align:center;width: 100%;position: absolute;line-height: 1.25em;'><b><u>".PROFILE_59."</u></b><br>".PROFILE_185."</span></td></tr></table>";

// END OF DISPLAY MENU
// Usersettings PHP
// ##########################################################################################
// SINCERAMENTE, NÃO SEI QUE ESTUPIDEZ É ESTE, DE IR ABRIR UM ZIP COM OS SETTINGS TODOS QUE ESTÃO PARA TRÁS.....
// QUAL É O PROBLEMA DE CARREGAR O FICHEIRO DIRECTO DO CORE????
// ##########################################################################################
/*
include(e_ADMIN."ver.php");
if (!file_exists("usersettings_".$e107info['e107_version'].".php")) {
	$archiveName = "euser/usersettings.zip";
	require_once(e_HANDLER."pclzip.lib.php");
	$archive = new PclZip(e_PLUGIN.$archiveName);
	if ($e107info['e107_version'] == '0.8.0 (cvs)') {
		$pclzip_file_list[0] = "useredit_0.8.0.php";
		$pclzip_file_list[1] = "usersettings_0.8.0.php";
	} else {
		$pclzip_file_list[0] = "usersettings_".$e107info['e107_version'].".php";
	}
	$unarc = ($fileList = $archive -> extract(PCLZIP_OPT_BY_NAME, $pclzip_file_list, PCLZIP_OPT_PATH, e_PLUGIN."euser", PCLZIP_OPT_SET_CHMOD, 0644));
}

//var_dump($e107info['e107_version']);

if ($e107info['e107_version'] == '0.7.11') {
require_once("usersettings_0.7.11.php");
} else if ($e107info['e107_version'] == '0.7.12') {
require_once("usersettings_0.7.12.php");
} else if ($e107info['e107_version'] == '0.7.13') {
require_once("usersettings_0.7.13.php");
} else if ($e107info['e107_version'] == '0.7.14') {
require_once("usersettings_0.7.14.php");
} else if ($e107info['e107_version'] == '0.7.15') {
require_once("usersettings_0.7.15.php");
} else if ($e107info['e107_version'] == '0.7.16') {
require_once("usersettings_0.7.16.php");
} else if ($e107info['e107_version'] == '0.7.17') {
require_once("usersettings_0.7.17.php");
} else if ($e107info['e107_version'] == '0.7.18') {
require_once("usersettings_0.7.18.php");
} else if ($e107info['e107_version'] == '0.7.19') {
require_once("usersettings_0.7.19.php");
} else if ($e107info['e107_version'] == '0.7.20') {
require_once("usersettings_0.7.20.php");
} else if ($e107info['e107_version'] == '0.7.21') {
require_once("usersettings_0.7.21.php");
} else if ($e107info['e107_version'] == '0.7.22') {
require_once("usersettings_0.7.22.php");
} else if ($e107info['e107_version'] == '0.7.23') {
require_once("usersettings_0.7.23.php");
} else if ($e107info['e107_version'] == '0.7.24') {
require_once("usersettings_0.7.24.php");
} else if ($e107info['e107_version'] == '0.7.25') {
require_once("usersettings_0.7.25.php");
} else if ($e107info['e107_version'] == '0.7.26') {
require_once("usersettings_0.7.26.php");
} else if ($e107info['e107_version'] == '1.0.0') {
require_once("usersettings_1.0.0.php");
} else if ($e107info['e107_version'] == '1.0.1') {
require_once("usersettings_1.0.1.php");
} else if ($e107info['e107_version'] == '1.0.2') {
require_once("usersettings_1.0.2.php");
} else if ($e107info['e107_version'] == '0.8.0 (cvs)') {
	if (isset($_GET['uid'])) {
		if (ADMIN) {
			$edited_uid = intval($_GET['uid']);
			header("Location: useredit_0.8.0.php?".$edited_uid."");
		} else {
			header('location:'.e_BASE.'index.php');
		}
	} else {
		require_once("usersettings_0.8.0.php");
	}
}
*/
//$override->override_function('tablerender', 'yourplugin_tablerender', 1);
//function yourplugin_tablerender(){
//   echo "tablerender overridden";
//    return false;
//}
/*
function callback($buffer)
{
  return (str_replace("require_once ('class2.php');", "", $buffer));
}
ob_start("callback");
		require (e_BASE."usersettings.php");
ob_end_clean();
*/


  function processContent($pText){
    $phptext = str_replace("<?php","",$pText);
    $phptext = str_replace("require_once ('class2.php');","",$phptext);
    $phptext = str_replace("require_once (HEADERF);","",$phptext);
    $phptext = str_replace("require_once (FOOTERF);","",$phptext);
    $phptext = str_replace("\$ns->tablerender(\$caption, \$text);","",$phptext);
    $phptext = str_replace("?\>","",$phptext);
    return $phptext;
  }
  $output = file_get_contents(e_BASE."usersettings.php");
  $output = processContent($output);

//var_dump ($output);
//eval($output);
//var_dump ($text);
// Usersettings PHP END

require_once(HEADERF);
if (isset($_GET['uid'])) {
	$title = ADMIN_PROFILE_15;
} else {
	$title = "";
}
eval($output);
//var_dump ($text);
$ns->tablerender($title, $top.$text);
require_once(FOOTERF);
?>
