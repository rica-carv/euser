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





//FAILSAFE DO GET....
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
e107::css('euser', 'euser.css'); // always load style.css last.

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

//require_once(e_LANGUAGEDIR."/".e_LANGUAGE."/lan_user.php");

define("e_PAGETITLE", TITLE_PROFILE_1);

$euser_pref = e107::getPlugPref('euser');

$WYSIWYG = $euser_pref['wysiwyg'];
if ($_GET['page'] == comments) {
$e_wysiwyg = "user_comment";
}
if ($_GET['page'] == images) {
$e_wysiwyg = "user_picture_comment";
}
if ($_GET['page'] == videos) {
$e_wysiwyg = "user_video_comment";
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
e107::getTemplate('euser', 'icons');

//var_dump ("sadklasdlçjksakldj");
// Passar para usar a msg?       echo $msg->render();

if (!e107::isInstalled('euser')) {
	$ns->tablerender(IMAGE_alert,IMAGE_bigalert.PROFILE_2a);
	require_once(FOOTERF);
	exit;
}
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
		$ns->tablerender(IMAGE_alert,PROFILE_2a);
		require_once(FOOTERF);
		exit;
}

//var_dump ($sql);
//$sql=e107::getDb();

//if (isset($_GET['id'])) {
$qs = explode(".", e_QUERY);
//var_dump ($qs);
//	if ($_GET['id'] != USERID && !check_class($euser_pref['allowguests'])) {
if ($qs[0] == 'id' && isset($qs[1])) {

	$id = intval($qs[1]);

// Início do isto veio do user.php do core
/*
if ($id == 0)
	{
		$text = "<div style='text-align:center'>".LAN_USER_49." ".SITENAME."</div>";
		$ns->tablerender(LAN_ERROR, $text);
		require_once(FOOTERF);
		exit;
	}

	$ret = e107::getEvent()->trigger("showuser", $id);
	$ret2 = e107::getEvent()->trigger('user_profile_display',$id);
	if (!empty($ret) || !empty($ret2))
	{
		$text = "<div style='text-align:center'>".$ret."</div>";
		$ns->tablerender(LAN_ERROR, $text);
		require_once(FOOTERF);
		exit;
	}
*/

//include_once(__DIR__.'/../../user.php');
/* Não funciona...
ob_start();
require(__DIR__.'/../../user.php');
ob_end_clean();

echo "<hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>";
*/
//+++++++++++++ Cópia das linhas 182 a 230 do user.php****************

if (isset($id))
{
	$user_exists = $sql->count("user","(*)", "WHERE user_id = ".$id."");
	if($id == 0 || $user_exists == false)
	{
		$text = "<div style='text-align:center'>".LAN_USER_49." ".SITENAME."</div>";
		$ns->tablerender(LAN_ERROR, $text);
		require_once(FOOTERF);
		exit;
	}

	$loop_uid = $id;

	$ret = e107::getEvent()->trigger("showuser", $id);
	$ret2 = e107::getEvent()->trigger('user_profile_display',$id);

	if (!empty($ret) || !empty($ret2))
	{
		$text = "<div style='text-align:center'>".$ret."</div>";
		$ns->tablerender(LAN_ERROR, $text);
		require_once(FOOTERF);
		exit;
	}

	if(vartrue($pref['profile_comments']))
	{
		require_once(e_HANDLER."comment_class.php");
		$comment_edit_query = 'comment.user.'.$id;
	}

	if (isset($_POST['commentsubmit']) && $pref['profile_comments'])
	{
		$cobj = new comment;
		$cobj->enter_comment($_POST['author_name'], $_POST['comment'], 'profile', $id, null, $_POST['subject']);
	}
/*
	if($text = renderuser($id))
	{
		$ns->tablerender(LAN_USER_50, e107::getMessage()->render(). $text, 'user');
	}
	else
	{
		$text = "<div style='text-align:center'>".LAN_USER_51."</div>";
		$ns->tablerender(LAN_ERROR,  e107::getMessage()->render().$text);
	}
	unset($text);
	require_once(FOOTERF);
	exit;
*/
}

//+++++++++++++ FIM DA Cópia das linhas ****************

$full_perms = getperms("0") || check_class(varset($pref['memberlist_access'], 253));		// Controls display of info from other users
// Fim do isto veio do user.php do core

//	if ($id != USERID && !check_class($euser_pref['allowguests'])) {
// Uso o pref do core, o original, var $pref...
//	if ($id != USERID && !check_class(varset($pref['memberlist_access'], 253))) {
// Uso o pref do plugin em lugar do do core, é menos confuso...
	if ($id != USERID && !check_class($euser_pref['memberlist_access'])) {
//		$ns->tablerender(IMAGE_alert,PROFILE_2);
		$ns->tablerender(IMAGE_alert,IMAGE_bigalert.PROFILE_2);
		require_once(FOOTERF);
		exit;
	}
//	$id = intval($_GET['id']);

/*
	$sql -> db_Select("user", "*", "user_id=".$id."");
	$found = $sql->db_rows();
	if (!$found) {
		$ns->tablerender(IMAGE_alert,PROFILE_2a);
		require_once(FOOTERF);
		exit;
	}
	$user = $sql -> db_Fetch();
*/
//$user = get_user_data($id);
$user = e107::user($id);
	if (!$user) {
		$ns->tablerender(IMAGE_alert,IMAGE_bigalert.PROFILE_2a);
		require_once(FOOTERF);
		exit;
	}

e107::coreLan('user');
$euser_template = e107::getTemplate('euser');
  
//var_dump ($user);
$user_sc = e107::getScBatch('user', 'euser', 'user');
$user_sc->setVars($user);
$curVal['euser_data'] = $euser_data; 
$curVal['euser_pref'] = $euser_pref;
$user_sc->addVars($curVal);
//echo "<pre>"; var_dump ($user_sc); echo "</pre>";
//	$username = $_GET['usrname'];
/*
	// ONLINE NOW
	$sql-> db_Select("user","user_name","user_id = '$id'");
	while($row = $sql -> db_Fetch()) {
		$user_name = $row['user_name'];
	}

	$on_name = "".$id.".".$user_name."";
	$check = $sql-> db_Count("online","(*)","WHERE online_user_id='".$on_name."'");
	if( $check > 0 ) {
		$online = "<img src='images/online.gif' title='".PROFILE_96."' style='vertical-align: bottom;' />";
		$onlinetextleft = "Online";
		$onlinetext = PROFILE_96;
	} else {
		$online = "<img src='images/noonline.png' title='".PROFILE_97."' style='vertical-align: bottom;' />";
		$onlinetextleft = "";
		$onlinetext = PROFILE_97;
	}
	unset($check,$on_name);
*/
// ##########################################################################################
// Não sei por que faz o GET AVATAR, se lá em baixo o vai buscar de novo........
// ##########################################################################################
/*
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
	if ($user['user_image'] == "") {
		$user_image = "".e_PLUGIN."euser/images/noavatar.png";
//		$avatar .= "<img src='".$user_image."' border='1' ".$avwidth." ".$avheight."  alt='' />";
	} else {
//		$user_image = $user['user_image'];
		require_once(e_HANDLER."avatar_handler.php");
		$user_image = avatar($user_image);
//		$avatar .= "<img src='".$user_image."' border='1' ".$avwidth." ".$avheight." alt='' />";
	}
//		$avatar .= "<img src='".$user_image."' border='1' ".$avwidth." ".$avheight."  alt='' />";
		$avatar .= $user_image;
var_dump ($user_image);
*/
	//GET PROFIL_IMAGE
// ##########################################################################################
// USO A PREDEFINIÇÃO DO E107, AO IR BUSCAR O SHORTCODE DO AVATAR....
// ##########################################################################################
/*
	if ($euser_pref['imagewidth'] == '') {
// OLD		$imagewidth = "width = '200'";
	$imagewidth = "";
	} else {
		$imagewidth = "width='".$euser_pref['imagewidth']."' ";
	}
	if ($euser_pref['imageheight'] == '') {
		$imageheight = "";
	} else {
		$imageheight = "height='".$euser_pref['imageheight']."' ";
	}
// ##########################################################################################
// Há aqui vars que depois são logo redefinidas ($user_image)....
// ##########################################################################################
	if ($user['user_image'] == "") {
		$user_image = "".e_PLUGIN."euser/images/noavatar.png";
// sem border, pf....		$profil_image .= "<img src='".$user_image."' border='1' ".$avwidth." ".$avheight."  alt='' />";
		$profil_image .= "<img src='".$user_image."' ".$avwidth." ".$avheight."  alt='' />";
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
// Sem border, pf		$profil_image .= "<img src='".$user_image."' border='1' ".$imagewidth." ".$imageheight." alt='' />";
//		$profil_image .= "<img src='".$user_image."' ".$imagewidth." ".$imageheight." alt='' />";
		$profil_image .= $user_image;
// ##########################################################################################
// Tenho de meter estas vars num estilo....
// ##########################################################################################
//    "' ".$imagewidth." ".$imageheight." alt='' />";
	}
*/

//	$username = $user['user_name'];
//	$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."euser_com WHERE com_to='".$id."' AND com_type='prof'");
//	$comnumrows = $sql->db_Rows();
//	$sql->select("euser_com", "com_id", "com_to='".$id."' AND com_type='prof'");
//	$comnumrows = $sql->fetch();

  $user_sc->wrapper('euser/main');
//  $user_sc->wrapper('euser');

// Isto tem de ser carregado primeiro que o sc
//  e107::coreLan('user');
//  $euser_template = e107::getTemplate('euser');
//    e107::getTemplate('euser');

/*
	$EXTENDED_CATEGORY_START = "<tr><td colspan='2' class='forumheader' style='text-align:left'>{EXTENDED_NAME}</td></tr>";
	$EXTENDED_CATEGORY_TABLE = "
		<tr><td class='forumheader3'>{EXTENDED_ICON}&nbsp;{EXTENDED_NAME}</td><td class='forumheader3'>{EXTENDED_VALUE}</td></tr>
		";
	$EXTENDED_END = "";
	$sc_style['USER_COMMENTS_LINK']['pre'] = "<tr><td colspan='2' class='forumheader3' style='text-align:left'>";
	$sc_style['USER_COMMENTS_LINK']['post'] = "</td></tr>";
	$sc_style['USER_FORUM_LINK']['pre'] = "<tr><td colspan='2' class='forumheader3' style='text-align:left'>";
	$sc_style['USER_FORUM_LINK']['post'] = "</td></tr>";
*///	$sc_style['USER_UPDATE_LINK']['pre'] = "<tr><td colspan='2' class='forumheader3' style='text-align:center'>";
//	$sc_style['USER_UPDATE_LINK']['post'] = "</td></tr>";
//var_dump ($EXTENDED_CATEGORY_START);

/*
	if ($euser_pref['bgimage'] == 'Yes') {
		$sql->mySQLresult = @mysql_query("SELECT user_background FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
		$bg = $sql->db_Fetch();
		if ($bg['user_background'] != '') {
			if (eregi('http', $bg['user_background'])) {
			$text .= "<body background='".$bg['user_background']."'>";
			} else {
			$text .= "<body bgcolor='".$bg['user_background']."'>";
			}
		}
	}
*/

// ONLINE NOW
// PARA REMODELAR, ACHO QUE HÁ AQUI VARIÁVEIS DESNECESSÁRIAS
//		$user_name = $user['user_name'];
	$username = $user['user_name'];

//	$on_name = "".$id.".".$user_name."";
//	$on_name = "".$id.".".$username."";
//	$check = $sql-> db_Count("online","(*)","WHERE online_user_id='".$on_name."'");

	// MENU
//  $caption =	"<img src='images/".(( $check > 0 )?"online.gif":"noonline.png")."' title='".(( $check > 0 )?PROFILE_96:PROFILE_97)."' style='vertical-align: bottom;' />&nbsp;".((constant("e_LANGUAGE")=='Portuguese')?PROFILE_162."<b> {$username}</b>":"<b>{$username}</b> ".PROFILE_162);
 
// LAN's, shortcodes e companhia v2.0
//include_lan(e_LANGUAGEDIR.e_LANGUAGE.'/lan_user.php');
//--	e107::getScBatch('user')->setVars($user);
//	global $sc_style, $user_sc;
//global $user_sc, $euser_pref, $user;
//require_once(e_HANDLER."form_handler.php");
//VAR_DUMP (e_LANGUAGEDIR.e_LANGUAGE.'/lan_user.php');
// Depois quero meter o nome do utilizador ás cores, como no user.php normal...
//define("e_PAGETITLE", $tp->parseTemplate(LAN_USER_50." {USER_NAME}", TRUE, $user_sc));
//define("e_PAGETITLE", LAN_USER_50." {USER_NAME}");
//  $caption =	"<img src='images/".(( $check > 0 )?"online.gif":"noonline.png")."' title='".(( $check > 0 )?PROFILE_96:PROFILE_97)."' style='vertical-align: bottom;' />&nbsp;".LAN_USER_50."&nbsp;{USER_ID} : {USER_NAME} : {USER_LOGINNAME}{USER_JUMP_LINK=prev}{USER_JUMP_LINK=next}";
//  var_dump (defined("IMAGE_online"));
//  $caption =	"---------<img src='images/".(( $check > 0 )?IMAGE_online:IMAGE_offline)."' title='".(( $check > 0 )?PROFILE_96:PROFILE_97)."' style='vertical-align: bottom;' />&nbsp;".LAN_USER_50."&nbsp;{USER_ID} : {USER_NAME} : {USER_LOGINNAME}{USER_JUMP_LINK=prev}{USER_JUMP_LINK=next}";
//-----  $caption =	(( $check > 0 )?IMAGE_online:IMAGE_offline)."&nbsp;".LAN_EUSER_0013."&nbsp;{USER_ID} : {USER_NAME} : {USER_LOGINNAME}{USER_JUMP_LINK=prev}{USER_JUMP_LINK=next}";
//  $caption =	"{EUSER_ONLINE}&nbsp;".LAN_EUSER_0013."&nbsp;{USER_ID} : {USER_NAME} : {USER_LOGINNAME}{USER_JUMP_LINK=prev}{USER_JUMP_LINK=next}";
//var_dump ($euser_template['caption']);
//	unset($check,$on_name);

// ##########################################################################################
// Hipótese de ligar caso o virtual paginate não esteja on....
// ##########################################################################################
/*
	$text .="<div class='main_caption'><b>{$username} ".PROFILE_162."</div></b>";
	$text .= "<div style='text-align:center'>";
	$text .= "<table style='width:100%' class='fborder'>";
	$text .= "<tr>";
	$text .= "<td colspan='2' style='text-align:center'>";
	$text .= "| <a href='euser.php?id=".$id."'>".PROFILE_11."</a> | ";
	if ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "") {
		$text .= "<a href='euser.php?id=".$id."&page=friends'>" .PROFILE_13."</a> | ";
	}
	if ($euser_pref['pics'] == "ON" || $euser_pref['pics'] == "") {
		$text .= "<a href='euser.php?id=".$id."&page=images'>" .PROFILE_14."</a> | ";
	}
	if ($euser_pref['videos'] == "ON" || $euser_pref['videos'] == "") {
		$text .= "<a href='euser.php?id=".$id."&page=videos'>" .PROFILE_113."</a> | ";
	}
	if ($euser_pref['commentson'] == "ON" || $euser_pref['commentson'] == "") {
		$text .= "<a href='euser.php?id=".$id."&page=comments'>".PROFILE_15."</a> | ";
	}
*/

// Links redundantes, também estão na tabela ao lado do avatar....
/*
	$text .= "<table class='tblheader'>";
	$text .= "<tr>";
	$text .= "<td colspan='2' style='text-align:center'>";
	// USER COMMENTS?
	if ((($euser_pref['commentson'] == "ON" || $euser_pref['commentson'] == "") || ($euser_pref['pics'] == "ON" || $euser_pref['pics'] == "")|| ($euser_pref['videos'] == "ON" || $euser_pref['videos'] == "")) && $id == USERID) {
			$sql->mySQLresult = @mysql_query("SELECT com_id, com_date FROM ".MPREFIX."euser_com WHERE com_by='".$id."' ");
			$comment_all = $sql->db_Rows();
			if ($comment_all > 0) {
				$text .= "<a href='".e_PLUGIN."euser/lastcomments.php?page=comments'>".PROFILE_336."</a> | ";
			}
	}

*/
/* para quê ir sempre ao sql se já temos isso na info???
	if (!$sql -> db_Select("user", "user_id user_comments", "user_id='".$id."' AND user_forums='0' ")) {
		$text .= "<a href='../../userposts.php?0.forums.".$id."'>".PROFILE_213."</a> | ";
	}
*/
//var_dump ($user);
/*
	if ($user['user_forums']!=0) {
		$text .= "<a href='../../userposts.php?0.forums.".$id."'>".PROFILE_213."</a> | ";
	}
*/
/* para quê ir sempre ao sql se já temos isso na info???
	if (!$sql -> db_Select("user", "user_id user_comments", "user_id='".$id."' AND user_comments='0' ")) {
		$text .= "<a href='../../userposts.php?0.comments.".$id."'>".PROFILE_214."</a> | ";
	}
*/
/*	if ($user['user_comments']!=0) {
		$text .= "<a href='../../userposts.php?0.comments.".$id."'>".PROFILE_214."</a> | ";
	}
	if ($sql -> db_Select("macgurublog_main", "*", "blog_uid='".$id."' AND blog_enable='1' ")) {
		$text .= "<a href='../macgurublog_menu/macgurublog.php?uid=".$id."'>".PROFILE_215."</a> | ";
	}
	if ($euser_pref['userjournals_active'] == "1") {
		$text .= "<a href='../userjournals_menu/userjournals.php?blogger.".$id."'>".PROFILE_216."</a> | ";
	}
	$text .= "</td>";
	$text .= "</tr>";
	$text .= "<tr>
		<td colspan='2'><br></td>
		</tr>";
*/
/*
	$text .= "<tr>
		<td colspan='2' class='fcaption' style='text-align:center'>".PROFILE_12." {USER_LOGINNAME}</td>
		</tr>";
*/
//	$text .= "</table>";

/*
  			if (USERID == $id && ADMIN) {
//				$text .= "{USER_UPDATE_LINK}";
        $profil_image_start = "<a href='".e_HTTP."usersettings.php' title='".LAN_USER_38."'>";
			} else {
				if (USERID == $id) {
////					$text .= "<tr><td colspan='2' style='width:100%' class='forumheader'><center><a href='".e_BASE."usersettings.php'>".PROFILE_360."</a></center></td></tr>";
					$profil_image_start = "<a href='".e_BASE."usersettings.php' title='".PROFILE_360."'>";
				} elseif (ADMIN && getperms("4")) {
////					$text .= "<tr><td colspan='2' style='width:100%' class='forumheader'><center><a href='euser_settings.php?uid=".$id."'>".PROFILE_29."</a></center></td></tr>";
					$profil_image_start = "<a href='euser_settings.php?page=settings&uid=".$id."' title='".PROFILE_29."'>";
				}
			}
$profil_image_end = "</a>";
  $text .="<table style='text-align:center;width:98%'>";
	$text .= "<td style='text-align:center;width:30%;padding-right:0.5%' >";
			$text .=  "<b class='mediumtext' >".$profil_image_start.PROFILE_12.$profil_image_end."</b><br/>";
*/


//	$text .= "<table class='fborder' style='margin-right:0; width: 100%'>";

/*
	if ($euser_pref['user_warn_support'] == "Yes" AND $sql->db_Select("user_extended", "*", "user_extended_id='$id' AND user_warn!='null' AND user_warn!=''")) {
		$profil_image_rowspan = 9;
	} else {
		$profil_image_rowspan = 8;
	}
*/
//		$profil_image_rowspan = 1;
/*
		$profil_image_rowspan = 6;
	$text .= "<TR>
		<td rowspan = $profil_image_rowspan width='30%' class='forumheader3'><center>{$profil_image}<br>";
*/
//var_dump ($profil_image);
//	$text .= "<TR><td rowspan = $profil_image_rowspan class='forumheader3'><div style='text-align: center; vertical-align: middle; min-width: $euser_pref[im_width]px;'>{$profil_image_start}{$profil_image}{$profil_image_end}<br>";

//	$sc_style['USER_PICTURE']['pre'] = $profil_image_start;
//	$sc_style['USER_PICTURE']['post'] = $profil_image_end;
//		require_once(e_PLUGIN."euser/euser_shortcodes.php");
//		require(e_PLUGIN."euser/user_avatar.php");
//var_dump ($user_sc);
// Pronto, resolvo o problema do PROFIL_IMAGE assim.........
/*$doc = DOMDocument::loadHTML($tp->parseTemplate("{USER_AVATAR=$id}", TRUE, $user_sc));
//$image = $doc->getElementsByTagName('img');
foreach($doc->getElementsByTagName('img') as $image){
//    foreach(array('width', 'height') as $attribute_to_remove){
        if($image->hasAttribute('title')){
            $image->removeAttribute('title');
        }
//    }
}
//echo $doc->saveHTML();
  $text .= "<TR><td rowspan = $profil_image_rowspan class='forumheader3'><div style='text-align: center; vertical-align: middle; min-width: $euser_pref[im_width]px;'>{$profil_image_start}".$doc->saveHTML()."{$profil_image_end}<br>";
*/

//  $text .= "<TR><td rowspan = $profil_image_rowspan class='forumheader3'><div style='text-align: center; vertical-align: middle; min-width: $euser_pref[im_width]px;'>{$profil_image_start}{USER_PICTURE}{$profil_image_end}<br>";
//			$text .= "<b class='mediumtext' >$profil_image_start{USER_PICTURE}$profil_image_end</b><br/>";

//    $text .= "<td {$span} class='forumheader3 center middle' style='width:20%'>{USER_PICTURE}</td>
//";

//	$text .= "{USER_RATING}<br/><br/>";
//	if ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "") {

// O FRIENDDB é preciso lá mais para a frente....
/*
	if ($euser_pref['friends']) {
		if ($euser_pref['user_tracking'] == "session") {
			$ulang = $_SESSION['e107language_'.$euser_pref['cookie_name']];
		} else {
			$ulang = $_COOKIE['e107language_'.$euser_pref['cookie_name']];
		}
		if ($euser_pref['user_tracking'] == "session") {
			$ulang = $_SESSION['e107_language'];
		} else {
			$ulang = $_COOKIE['e107_language'];
		}
		$sql->mySQLresult = @mysql_query("SELECT user_friends, user_friends_request FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
		$settings = $sql->db_Fetch();
		$friendb = explode("|", $settings['user_friends']);
		$friendb1 = explode("|", $settings['user_friends_request']);
		if (USER && $id != USERID && !in_array(USERID, $friendb) && !in_array(USERID, $friendb1)) {
			$text .= "<a href='euser.php?id=".$id."&add' style=\"text-decoration: none;\" title='".PROFILE_16."'><img src='images/buttons/".e_LANGUAGE."_addfriend.png' border='0'></a>";
		}
	}
*/
//	$text .= "</center></td></TR>";
//	$text .= "</div></td></TR>";
/*	$text .= "<TR>
		<td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".$online."&nbsp; $onlinetextleft</span><span style='float:right; text-align:right'>$onlinetext</span></td>
		</TR>";
*/
//	$text .= "<TR>
//		<td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>{USER_REALNAME_ICON}&nbsp; ".PROFILE_350."</span><span style='float:right; text-align:right'>{USER_REALNAME}</span></td>
//		</TR>";
// Shortcodes conforme o user_template.php
//var_dump (deftrue('BOOTSTRAP'));

//var_dump (deftrue('BOOTSTRAP'));
/*
  $text .= "<tr>
	<td {$main_colspan} class='forumheader3'>
		<div class='f-left'>{USER_ICON=realname} ".LAN_USER_63."</div>
		<div class='f-right right'>{USER_REALNAME}</div>
	</td>
</tr>
";
*/
//	$text .= "<TR>
//		<td  {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>{USER_EMAIL_ICON}&nbsp; ".PROFILE_351."</span><span style='float:right; text-align:right'>{USER_EMAIL_LINK}</span></td>
//		</TR>";

/*
  $text .= "<tr>
	<td  {$main_colspan} class='forumheader3'>
		<div class='f-left'>{USER_ICON=email} ".LAN_USER_60."</div>
		<div class='f-right right'>{USER_EMAIL}</div>
	</td>
</tr>";
    
  $text .= "<tr>
	<td  {$main_colspan} class='forumheader3'>
		<div class='f-left'>{USER_ICON=level} ".LAN_USER_54.":</div>
		<div class='f-right right'>{USER_LEVEL}</div>
	</td>
</tr>";
*/
//	$text .= "<TR>
//		<td  {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_352.":</span><span style='float:right; text-align:right'>{USER_LEVEL}</span></td>
//		</TR>";
/*
	$text .= "<TR>
		<td  {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_353.":&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_LASTVISIT}</span></td>
		</TR>";
	if ($euser_pref['user_warn_support'] == "Yes" AND $sql->db_Select("user_extended", "*", "user_extended_id='$id' AND user_warn!='null' AND user_warn!=''")) {
	$text .= "<TR>
		<td  {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_311.":&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_WARN}</span></td>
		</TR>";
	}
	$text .= "<TR>
		<td  {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_354.":&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_JOIN}</td>
		</TR>";
*/
//	$text .= "<TR>
//		<td  {$main_colspan} colspan=2 style='width:100%' class='forumheader3'><span style='float:left'><img src='images/registration.png'>&nbsp;".PROFILE_354.":&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_JOIN}</td>
//		</TR>";

//	$text .= "<TR>
//		<td  {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_138.":</span><span style='float:right; text-align:right' ><a href='".e_PLUGIN."pm/pm.php?send.$id'><img src='".e_PLUGIN."pm/images/pm.png' title='".PROFILE_138."' alt='' border='0'></a></span></td>
//		</TR></td></TR>";

/*
$sc_style['USER_SENDPM']['pre'] = "<tr><td class='forumheader3'><div class='f-left'>".LAN_USER_62.":</div><div class='f-right'>";
$sc_style['USER_SENDPM']['post'] = "</div></td></tr>";
$sc_style['USER_RATING']['pre'] = "<tr><td class='forumheader3'><div class='f-left'>".LAN_RATING."</div><div class='f-right'>";
$sc_style['USER_RATING']['post'] = "</div></td></tr>";

$sc_style['USER_SIGNATURE']['pre'] = "<tr><td class='forumheader3 left'>";
$sc_style['USER_SIGNATURE']['post'] = "</td></tr>";


  $text .= "{USER_SENDPM}
{USER_RATING}
{USER_SIGNATURE}
{USER_EXTENDED_ALL}";
  $text .= "</td></TR>";
*/
/* Mais uma vez, vamos ao sql... Porquê?
	$sql_signo = new db;
	$signo = $sql_signo->db_Count("user","(*)","where user_id = '$id' && user_signature !='' LIMIT 1");
	if ($signo == 1) {
*/
//	if ($user['user_signature']!='') {
/*
	$text .= "<TR>
		<td colspan='2'  style='width:100%' class='forumheader3'><center>{USER_SIGNATURE}</center></td>
		</tr>";
*/
//	$text .= "<TR>
//		<td colspan='3'  style='width:100%' class='forumheader3'><center>{USER_SIGNATURE}</center></td>
//		</tr>";
//	}
//	$text .= "</table></div><table></table>";
//	$text .= "</table></td>";
//	$text .= "<td style='text-align:center;width:45%;padding-left:0.5%' >";
//
//*********************************************************
//*********************************************************
//*********************************************************
//*********************************************************
//*********************************************************
// DAQUI PARA BAIXO REVER TUDO, ESTÁ UMA CONFUSÃO PEGADA...............................................................................................
//*********************************************************
//*********************************************************
//*********************************************************
//*********************************************************
//*********************************************************

function euser_tablerender($text, $notexit = null) {
// Futuro??? function euser_tablerender($text, &$caption, &$user_sc, &$text_js, $notexit = null) {
//extract($GLOBALS); 
//global $tp, $caption, $user_sc, $textjs, $ns;
	global $tp, $euser_template, $user_sc, $textjs, $ns, $euser_pref;
//var_dump ($user_sc);
//var_dump ($this->euser_template['caption']);
/*
echo "<hr>TEXT tbl: ";
echo htmlentities($text);
echo "<hr><hr>";
*/
// ISTO TAMBÉM ESTÁ NO EUSERSETTINGS. FAZER UM TRAIT?
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
// mudar para usar msg...       echo $msg->render();

	include_once(e_PLUGIN . "euser/includes/euser_trait.php");
	$adminwarn = (new class { use Euser_admin_info; })::adminwarn($euser_pref);

//	$adminwarn = $this->adminwarn($euser_pref);

	$display = $adminwarn.$tp->parseTemplate($text, TRUE, $user_sc);

//				$tdisplay = $tp->parseTemplate($caption, TRUE, $user_sc);
	$user_sc->wrapper('euser/caption');
	$cdisplay = $tp->parseTemplate($euser_template['caption'], TRUE, $user_sc);

    $display .= $textjs;

	$ns->tablerender($cdisplay,$display);

    if (is_null($notexit)){
				require_once(FOOTERF);
				exit;
    }
}


function euser_onlyfriends($text_friends, $tdinline = null) {
//extract($GLOBALS); 
global $text, $friendb, $euser_pref, $username;
//echo "<hr>TEXTFRIENDS: ";
//print_r($text_friends);
  If (count($text_friends)>1){
					//----------- Only friends
			if (((!in_array(USERID, $friendb)) && ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "")) || !USER) {
/*
echo "<hr>TEXT1: ";
echo htmlentities($text);
echo "<hr><hr>";
*/
        $text .= ( $text_friends[0]!='' ? $username.$text_friends[0]."</td></tr>" : "" );
        $text .= "</table>";
        euser_tablerender($text, $tdinline);
			} else if ($euser_pref['friends'] != "ON") {
/*
echo "<hr>TEXT2: ";
echo htmlentities($text);
echo "<hr><hr>";
*/
        $text .= ($text_friends[1]!=''?$username.$text_friends[1]."</td></tr>":"");
        $text .= "</table>";
        euser_tablerender($text, $tdinline);
			}
	} else {
/*
echo "<hr>TEXT3: ";
echo htmlentities($text);
echo "<hr><hr>";
*/
					//----------- Only friends
					if (!in_array(USERID, $friendb) || !USER) {
        $text .= $username.$text_friends[0]."</td></tr></table>";
        euser_tablerender($text, $tdinline);
		}
  }
}


	// Check member settings - NO Admin & NO Friends
	if (!USERID == ADMIN || !USER) {
		$sql->mySQLresult = @mysql_query("SELECT user_friends, user_settings FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
		$settings = $sql->db_Fetch();
		$break = explode("|",$settings['user_settings']);
		$friendb = explode("|", $settings['user_friends']);
}


		if ((!USER && $break[0] == 1) || ($break[0] == 1 && $id != USERID && !isset($_GET['add']))) {
/*
			//----------- Only friends
			if (((!in_array(USERID, $friendb)) && ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "")) || !USER) {
				$text .= "<br/>".$username." ".PROFILE_104;
				$display = $tp->parseTemplate($text, TRUE, $user_sc);
				$ns->tablerender("",$display);
				require_once(FOOTERF);
				exit;
			} else if ($euser_pref['friends'] != "ON") {
				$text .= "<br/>".$username." ".PROFILE_104a;
				$display = $tp->parseTemplate($text, TRUE, $user_sc);
				$ns->tablerender("",$display);
				require_once(FOOTERF);
				exit;
			}
		}
*/
    euser_onlyfriends(array(PROFILE_104,PROFILE_104a));
	}

	if(!isset($_GET['add'])) {
/*
		if ($_GET['page'] == "") {
			$text .= "<br/><table width='100%' class='fborder'>";
			$text .= "<TR><td style='width:25%'></td></TR>";
			$text .= "{USER_EXTENDED_ALL}";
			$text .= "</table>";
			$text .= "<br/><table width='100%' class='fborder'>";
*/
//			$text .= "<b class='mediumtext' >".rtrim(rtrim(PROFILE_390), ":")."</b><br/>";
//--			$text .= "<b class='mediumtext' >".LAN_USER_64."</b><br/>";
//--			$text .= "<table width='100%' class='fborder' style='margin-left:0'>";
/*
			$text .= "<tr><td {$main_colspan} style='width:100%' class='forumheader'><span style='float:left'></span></td></tr>";
			$text .= "<TR><td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_356."&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_CHATPOSTS} ( {USER_CHATPER}% )</td></TR>";
			$text .= "<TR><td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_357."&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_COMMENTPOSTS} ( {USER_COMMENTPER}% )</td></TR>";
			$text .= "<TR><td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_358."&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_FORUMPOSTS} ( {USER_FORUMPER}% )</td></TR>";
*/

//	$text .= "<TR>
//		<td  {$main_colspan} colspan=2 style='width:100%' class='forumheader3'><span style='float:left'><img src='images/registration.png'>&nbsp;".PROFILE_354.":&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_JOIN}</td>
//		</TR>";
/*
  $text .= "<TR>
	<td colspan=2 class='forumheader3'><span style='float:left'><img src='images/registration.png'>&nbsp;".LAN_USER_59.":&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_JOIN}<br />{USER_DAYSREGGED}</span></td>
		</TR>";
			$text .= "<TR><td {$main_colspan} class='forumheader3'><span style='float:left'><img src='images/access.png'>&nbsp;".LAN_USER_66.":&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_VISITS}</td></TR>";

    	$text .= "<TR>
		<td  {$main_colspan} colspan=2 style='width:100%' class='forumheader3'><span style='float:left'><img src='images/lastseen.png'>&nbsp;".PROFILE_353.":&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_LASTVISIT}</span></td>
		</TR>";
*/
//// TENHO DE ARRANJAR UM ARRAY E FAZER ISTO COM UM ARRAY....

/*
	if ($euser_pref['user_warn_support'] == "Yes" AND $sql->db_Select("user_extended", "*", "user_extended_id='$id' AND user_warn!='null' AND user_warn!=''")) {
	$text .= "<TR>
		<td  {$main_colspan} colspan=2 style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_311.":&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_WARN}</span></td>
		</TR>";
	}
*/
// Prefiro não usar nada, também quero mostrar os 0...
//if(getcachedvars('total_chatposts'))
//{
// Alterado para usar o LAN de origem do user.php
// 			$text .= "<TR><td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'><img src='images/chat.png'>&nbsp;".LAN_USER_67.":&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_CHATPOSTS} ( {USER_CHATPER}% )</td></TR>";
//}

// Prefiro não usar nada, também quero mostrar os 0...
//if(getcachedvars('total_commentposts'))
//{
// Alterado para usar o LAN de origem do user.php
//			$text .= "<TR><td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'><img src='images/comment.png'>&nbsp;".LAN_USER_68.":&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_COMMENTPOSTS} ( {USER_COMMENTPER}% )</td></TR>";
//}
      
// Prefiro não usar nada, também quero mostrar os 0...
//	if ($user['user_forums']!=0) {
//if(getcachedvars('total_forumposts'))
//{
// Alterado para usar o LAN de origem do user.php
//			$text .= "<TR><td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'><img src='images/forumposts.png'>&nbsp;".LAN_USER_69.":&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_FORUMPOSTS} ( {USER_FORUMPER}% )</td></TR>";
//}

//************************************************************************
//FALTA O NUMERO DE CLASSIFICADOS
//************************************************************************

/*
if(($totalnews = $sql->db_Count("news","(*)"))>0)
{
      $usernews = $sql->db_Count("news","(*)","where news_author=".$id);
			$text .= "<TR><td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'><img src='images/news.png'>&nbsp;".PROFILE_38."&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{$usernews} ( ".(($usernews!=0)?round(($usernews/$totalnews)*100,2):"0")."% )</td></TR>";
}
*/      
/*
if(($totaluploads = $sql->db_Count("download","(*)"))>0)
{
//      $useruploads = $sql->db_Count("download","(*)","where download_author='".$user_name."'");
      $useruploads = $sql->db_Count("download","(*)","where download_author='".$username."'");
			$text .= "<TR><td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'><img src='images/fileshare.png'>&nbsp;".PROFILE_35."&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{$useruploads} ( ".(($useruploads!=0)?round(($useruploads/$totaluploads)*100,2):"0")."% )</td></TR>";
}

if(($totaldownloads = $sql->db_Count("download_requests","(*)"))>0)
{
      $userdownloads = $sql->db_Count("download_requests","(*)","where download_request_userid=".$id);
			$text .= "<TR><td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'><img src='images/download.png'>&nbsp;".PROFILE_27."&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_DOWNLOADS} ( ".(($userdownloads!=0)?round(($userdownloads/$totaldownloads)*100,2):"0")."% )</td></TR>";
}

if(($totallinks = $sql->db_Count("links_page","(*)"))>0)
{
      $userlinks = $sql->db_Count("links_page","(*)","where link_author=".$id);
			$text .= "<TR><td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'><img src='images/links.png'>&nbsp;".PROFILE_37."&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{$userlinks} ( ".(($userlinks!=0)?round(($userlinks/$totallinks)*100,2):"0")."% )</td></TR>";
}
*/
//			$text .= "<TR><td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_359."&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_VISITS}</td></TR>";
//			$text .= "<TR><td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'><img src='images/access.png'>&nbsp;".PROFILE_359."&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_VISITS}</td></TR>";
//    	$text .= "<TR>
//		<td  {$main_colspan} colspan=2 style='width:100%' class='forumheader3'><span style='float:left'><img src='images/lastseen.png'>&nbsp;".PROFILE_353.":&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_LASTVISIT}</span></td>
//		</TR>";

			// CHECK TO SEE IF USING GOLD SYSTEM  // A ALTERAR QUANDO PUDER....
			if (function_exists('gold')) {
				$text .= "<tr><td {$main_colspan} style='width:100%' class='forumheader'><span style='float:left'>Kredit rendszer</span></td></tr>";
				$text .= "<TR><td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_218."<br><a href='".e_BASE.e_PLUGIN."gold_system/donate.php?{USER_NAME}'><i>".PROFILE_217."</i></a>&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_GOLD}</td></TR>";
				$text .= "<TR><td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_28."&nbsp;".$euser_pref['gold_currency_name']."&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_SPENT}</td></TR>";
			}

			// Profil zene
/*--
			if ($mp3['user_mp3'] != "" && $euser_pref['mp3enabled'] == "ON" && !isset($_GET['page'])) {
			$sql->mySQLresult = @mysql_query("SELECT user_mp3 FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
			$mp3 = $sql->db_Fetch();
//			if ($mp3['user_mp3'] != "" && $euser_pref['mp3enabled'] == "ON" && !isset($_GET['page'])) {
				$type = substr(strrchr($mp3['user_mp3'], '.'), 1);
				if(strpos($mp3['user_mp3'], "http://") === false && strpos($row['user_mp3'], "https://") === false && strpos($row['user_mp3'], "ftp://") === false) {
					$mp3file = "usermp3/".$id.".".$type;
					$mp3display = str_replace("_", " ", $mp3['user_mp3']);
				} else {
					$mp3file = $mp3['user_mp3'];
					$mp3break = explode("/", $mp3['user_mp3']);
					$mp3display = str_replace("_", " ", end($mp3break));
				}
				// Zene lejatszasa
/*
				if (!USERID == ADMIN || !USER) {
					$sql->mySQLresult = @mysql_query("SELECT user_friends, user_settings FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
					$settings = $sql->db_Fetch();
					$break = explode("|",$settings['user_settings']);
					$friendb = explode("|", $settings['user_friends']);
*/
/*--
					if ((!USER && $break[10] == 1) || ($break[10] == 1 && $id != USERID && !isset($_GET['add']))) {
						//----------- Only friends
    euser_onlyfriends(array('',''));
/*
						if (((!in_array(USERID, $friendb)) && ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "")) || !USER) {
							$text .= "</table>";
							$display = $tp->parseTemplate($text, TRUE, $user_sc);
							$ns->tablerender("",$display);
							require_once(FOOTERF);
							exit;
						} else if ($euser_pref['friends'] != "ON") {
							$text .= "</table>";
							$display = $tp->parseTemplate($text, TRUE, $user_sc);
							$ns->tablerender("",$display);
							require_once(FOOTERF);
							exit;
						}
*/
/*--
					}
//				}
				if ($euser_pref['mp3_autoplay'] == "Yes") {
					$profile_mp3_autoplay = "&autoplay=1";
				}
				if ($euser_pref['mp3_loop'] == "Yes") {
					$profile_mp3_loop = "&loop=1";
				}
				if ($euser_pref['mp3_volume']) {
					$profile_mp3_volume = $euser_pref['mp3_volume'];
					if ($profile_mp3_volume > 200) $profile_mp3_volume = 200;
					$profile_mp3_volume = "&volume=".$profile_mp3_volume."";
				}
				$text .= "<tr><td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_416.":&nbsp;&nbsp;</span><span style='float:right; text-align:right'>
					<object type='application/x-shockwave-flash' data='player_mp3_maxi.swf' width='150' height='16'>
					<param name='wmode' value='transparent' />
					<param name='movie' value='player_mp3_maxi.swf' />
					<param name='FlashVars' value='mp3=".$mp3file.$profile_mp3_autoplay.$profile_mp3_loop.$profile_mp3_volume."' />
					</object></span></td></tr>";
			}
--*/
			// Profil Szerkesztő link
//			$text .= "</td></tr></table>";
/*
			if (USERID == $id && ADMIN) {
				$text .= "{USER_UPDATE_LINK}";
			} else {
				if (USERID == $id) {
					$text .= "<tr><td colspan='2' style='width:100%' class='forumheader'><center><a href='".e_BASE."usersettings.php'>".PROFILE_360."</a></center></td></tr>";
				} elseif (ADMIN && getperms("4")) {
					$text .= "<tr><td colspan='2' style='width:100%' class='forumheader'><center><a href='euser_settings.php?uid=".$id."'>".PROFILE_29."</a></center></td></tr>";
				}
			}
			$text .= "</td></tr></table>";
		}
*/

  $text .=$tp->parseTemplate($euser_template['main'], TRUE, $user_sc);;

	}
//--	$text .= "</td></tr></table><p>";







// START OF PAGINATION. DEPRECATED, will use bootstrap tabs...
/*--
        $text .="<script type='text/javascript' src='".e_PLUGIN_ABS."euser/virtualpaginate.js'>

/***********************************************
* Virtual Pagination script- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/
/*--
</script>
<style type='text/css'>
/*write out CSS for class \".hidepeice\" that hides pieces of contents within pages*/
/*--
.hidepiece{display:none}
@media print{.hidepiece{display:block !important;}}

/*Sample CSS used for the Virtual Pagination Demos. Modify/ remove as desired*/
/*--

.paginationstyle{ /*Style for demo pagination divs*/
/*--
width: 250px;
text-align: center;
/*
padding: 2px 0;
margin: 10px 0;
*/
/*--
margin-bottom: 10px;
}

.paginationstyle select{ /*Style for demo pagination divs select menu*/
/*--
border: 1px solid navy;
margin: 0 15px;
}

.paginationstyle a{ /*Pagination links style*/
/*--
text-decoration: none;
padding: 0 5px;        
border: 1px solid transparent;
/*
padding: 0 5px;        
border: 1px solid black;
color: navy;
background-color: white;
*/
/*--
}

.paginationstyle a:hover, .paginationstyle a.selected{
color: #000;
background-color: #FF9900;
}
/*
.paginationstyle a.selected{
font-weight: 900;
}
*/
/*--
.paginationstyle a.disabled, .paginationstyle a.disabled:hover{ /*Style for 'disabled' previous or next link*/
/*
background-color: white;
*/
/*--
cursor: default;
color: #929292;
border-color: transparent;
}

.paginationstyle a.imglinks{ /*Pagination Image links style (class='imglinks') */
/*--
border: 0;
padding: 0;
}

.paginationstyle a.imglinks img{
vertical-align: bottom;
border: 0;
}

.paginationstyle a.imglinks a:hover{
background: none;
}

.paginationstyle .flatview a:hover, .paginationstyle .flatview a.selected{ /*Pagination div 'flatview' links style*/
/*--
color: black;
background-color: #FF9900;
border: 1px solid #FF9900;
/*
color: #000;
background-color: yellow;
*/
/*--
}

/*
.paginationstyle .flatview a.selected{ /*Pagination div 'flatview' links style*/
/*--
font-weight: 900;
}
*/
/*--

</style>

<!-- Pagination DIV for Demo 4 -->
<div id='galleryalt' class='paginationstyle' style='text-align: center;width:auto'>";
*/
// MENU OPTIONAL CASO O JAVASCRIPT ESTEJA DESLIGADO
/*--
  $text .= "<noscript>";
//	$text .= "| <a href='euser.php?id=".$id."'>".PROFILE_11."</a> | ";
	$text .= "<span class='flatview'>";
	if ($euser_pref['commentson'] == "ON" || $euser_pref['commentson'] == "") {
		$text .= "<a href='euser.php?id=".$id."&page=comments' ".(($_GET['page'] == comments)?"class='selected'":"")."><img style=\"vertical-align:middle\" src=\"images/comments_small.png\"> ".PROFILE_15."</a>&nbsp;";
	}
	if ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "") {
		$text .= "<a href='euser.php?id=".$id."&page=friends' ".(($_GET['page'] == friends)?"class='selected'":"")."><img style=\"vertical-align:middle\" src=\"images/group.png\"> " .PROFILE_13."</a>&nbsp;";
	}
	if ($euser_pref['pics'] == "ON" || $euser_pref['pics'] == "") {
		$text .= "<a href='euser.php?id=".$id."&page=images' ".(($_GET['page'] == images)?"class='selected'":"")."><img style=\"vertical-align:middle\" src=\"images/images_small.png\">" .PROFILE_14."</a>&nbsp;";
	}
	if ($euser_pref['videos'] == "ON" || $euser_pref['videos'] == "") {
		$text .= "<a href='euser.php?id=".$id."&page=videos' ".(($_GET['page'] == videos)?"class='selected'":"")."><img style=\"vertical-align:middle\" src=\"images/film.png\">" .PROFILE_113."</a>&nbsp;";
	}
	$text .= "</span>";
  $text .= "</noscript>";

$text .="
<script type='text/javascript' >
document.write(\"<a href='#' rel='previous'><</a><span class='flatview'></span><a href='#' rel='next'>></a>\");
</script>
</div>

<!-- Virtual Pagination Demo 4  -->                                                   
<div style='text-align: center;width:100%'>";
--*/
//var_dump ($_GET);
//var_dump (isset($_GET['page']));
//var_dump (!$_GET['page']);
//	if (isset($_GET['page'])) {
//	if (!$_GET['page']) {
//var_dump ($_GET['page']);
//		if ($_GET['page'] == friends) {

// ##########################################################################################
// ESTES IFS TODOS SÃO UNS SÉRIOS CANDIDATOS A UM ARRAY.....
// Mantive o Get[page] antigo para compatibilidade....
// Tenho de arranjar uma forma de ligar ou desligar o virtual paginate nas preferências do plugin...
// ##########################################################################################
//		} elseif ($_GET['page'] == comments) {


// #####COMENTÁRIOS#####
// FIQUEI NOS COMENTÁRIOS!!!!!!!!
//----    if (($_GET['page'] == comments) || (!$_GET['page'])){
			// Check member settings - NO Admin & NO Friends
//----			if (!USERID == ADMIN || !USER) {
/*
				$sql->mySQLresult = @mysql_query("SELECT user_friends, user_settings FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
				$settings = $sql->db_Fetch();
				$break = explode("|",$settings['user_settings']);
				$friendb = explode("|", $settings['user_friends']);
*/
//----				if ((!USER && $break[9] == 1) || ($break[9] == 1 && $id != USERID && !isset($_GET['add']))) {
					//----------- Only friends
//----    euser_onlyfriends(array(PROFILE_253,PROFILE_253a));
/*
					if (((!in_array(USERID, $friendb)) && ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "")) || !USER) {
						$text .= "<br/>".$username." ".PROFILE_253;
						$display = $tp->parseTemplate($text, TRUE, $user_sc);
						$ns->tablerender("",$display);
						require_once(FOOTERF);
						exit;
					} else if ($euser_pref['friends'] != "ON") {
						$text .= "<br/>".$username." ".PROFILE_253a;
						$display = $tp->parseTemplate($text, TRUE, $user_sc);
						$ns->tablerender("",$display);
						require_once(FOOTERF);
						exit;
					}
*/
//----				}
//----			}
//			if ($euser_pref['commentson'] == "ON" || $euser_pref['commentson'] == "") {
//----			if ($euser_pref['commentson']) {
//--$text .= "<div class='virtualpage4".(($_GET['page']==comments)?"":" hidepiece")."'>";

// Carrego o ficheiro para no futuro ter uma hipótese de reoordenar como eu quiser isto...
//----          require_once("includes/comments.php");
/*
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
				if(isset($_GET['comment_order'])) {
					if($_GET['comment_order'] == "ASC" || $_GET['comment_order'] == "DESC") {
						$comment_order = $_GET['comment_order'];
					}
				}
				if (!$comment_order == ASC || !$comment_order == DESC) {
					$comment_order = "DESC";
				}
				$sql->mySQLresult = @mysql_query("SELECT com_id, com_message, com_date, com_by FROM ".MPREFIX."euser_com WHERE com_to='".$id."' AND com_type='prof' ORDER BY com_date $comment_order LIMIT $offset,$rowsPerPage");
				$comm = $sql->db_Rows();
				$maxPage = ceil($comnumrows/$rowsPerPage);
				$self = $_SERVER['PHP_SELF'];
				$nav  = '';
				for($page = 1; $page <= $maxPage; $page++) {
					if ($page == $pageNum) {
						$nav .= "";
					} else {
						$nav .= " <a href=\"$self?id=".$id."&page=comments&comment_order=".$comment_order."&pgnum=".$page."\">$page</a> ";
					}
				}
				if ($pageNum > 1) {
					$page  = $pageNum - 1;
					$prev  = " <a href=\"$self?id=".$id."&page=comments&comment_order=".$comment_order."&pgnum=".$page."\">".PROFILE_204."</a> ";
					$first = " <a href=\"$self?id=".$id."&page=comments&comment_order=".$comment_order."&pgnum=".$page."\">".PROFILE_205."</a> ";
				} else {
					$prev  = ''; // we're on page one, don't print previous link
					$first = '&nbsp;'; // nor the first page link
				}
				if ($pageNum < $maxPage) {
					$page = $pageNum + 1;
					$next = " <a href=\"$self?id=".$id."&page=comments&comment_order=".$comment_order."&pgnum=".$page."\">".PROFILE_202."</a> ";
					$last = " <a href=\"$self?id=".$id."&page=comments&comment_order=".$comment_order."&pgnum=".$page."\">".PROFILE_203."</a> ";
				} else {
					$next = ''; // we're on the last page, don't print next link
					$last = '&nbsp;'; // nor the last page link
				}
					if ($euser_pref['maxpcomment'] != '') {
						$maxpcomment = $euser_pref['maxpcomment'];
					} else {
						$maxpcomment = 100;
					}
				if ($comm == 0) {
//					$text .= "<br><table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/comments.png'><i>".PROFILE_32."</i></td></tr></table>";
					$text .= "<table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/comments.png' style='vertical-align:middle'>&nbsp;<i>".PROFILE_32."</i></td></tr>";
				} else {
					$text .= "<br><table width='100%' class='fborder'>

						<tr>
							<td style='width:20%; text-align:left' class='forumheader' colspan='2'><img src='images/comments.png'><i>".PROFILE_36a." (".$comnumrows."):</i></td>";
							if ($comment_order == DESC) {
							$text .= "<td style='width:80%; text-align:right' class='forumheader' colspan='2'>".PROFILE_256."&nbsp;&nbsp;<a href=\"$self?id=".$id."&page=comments&comment_order=ASC\"><img src='images/order_down.png' title='".PROFILE_310."'></a></td>";
							} else {
							$text .= "<td style='width:80%; text-align:right' class='forumheader' colspan='2'>".PROFILE_256."&nbsp;&nbsp;<a href=\"$self?id=".$id."&page=comments&comment_order=DESC\"><img src='images/order_up.png' title='".PROFILE_309."'></a></td>";
							}
							$text .= "</tr>
					</table>";


					$text .= "<br/>";					//Profil hozzászólások listája indul
					for ($i = 0; $i < $comm; $i++) {
						$com = $sql->db_Fetch();
						$from = mysql_query("SELECT * FROM ".MPREFIX."user WHERE user_id=".$com['com_by']." ");
						$from = mysql_fetch_assoc($from);
						$date = date("Y-m-j. H:i", $com['com_date']);
						$comid = $com['com_id'];
						$user_name = $from['user_name'];
						$on_name = "".$com['com_by'].".".$user_name."";
						$checkonline = mysql_query("SELECT * FROM ".MPREFIX."online WHERE online_user_id='".$on_name."'");
						$checkonline = mysql_num_rows($checkonline);
						//e107_0.8 compatible
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
						$fromext = mysql_query("SELECT * FROM ".MPREFIX."user_extended WHERE user_extended_id=".$com['com_by']." ");
						$fromext = mysql_fetch_assoc($fromext);

						if( $checkonline > 0 ) {
							$online = "<img src='images/online.gif' title='".PROFILE_96."' style='vertical-align: middle;' />";
						} else {
							$online = "";
						}
						unset($checkonline,$on_name);

						$text .= "<br><table width='100%' class='fborder'>
						<tr>
							<td style='width:20%; text-align:left' class='fcaption'>".PROFILE_268."".$from['user_name']."</td>
							<td style='width:60%; text-align:left' class='fcaption'>".PROFILE_269."</td>
							<td style='width:20%; text-align:right' class='fcaption'>id: #".$comid."</td>
						</tr>
							<td class='forumheader'>&nbsp;".$online."&nbsp;&nbsp;<a href='euser.php?id=".$com['com_by']."'><b>".$from['user_name']."</b></a></td>
							<td class='forumheader' style='vertical-align: middle;' /><img src='images/post.png'>&nbsp;".$date."</td>
							<td class='forumheader' style='vertical-align: middle; text-align:right' /><a href='".e_PLUGIN."pm/pm.php?send.".$com['com_by']."'><img src='".e_PLUGIN."/pm/images/pm.png' title='".PROFILE_138."'></a></td></tr>
						<tr>
							<td class='forumheader3' style='vertical-align: top; width='20%;' />";

						$text .= "<br><table width='100%' class='fborder'>
						<tr>
							<td style='width:20%; text-align:left' class='fcaption'>".PROFILE_268."".$from['user_name']."</td>
							<td style='width:60%; text-align:left' class='fcaption'>".PROFILE_269."</td>
							<td style='width:20%; text-align:right' class='fcaption'>id: #".$comid."</td>
						</tr>
  							<td class='forumheader'>&nbsp;<img src='images/".(( $check > 0 )?"green":"gray").".png' title='".(( $check > 0 )?PROFILE_96:PROFILE_97)."' style='vertical-align: bottom;' />&nbsp;&nbsp;<a href='euser.php?id=".$com['com_by']."'><b>".$from['user_name']."</b></a></td>
							<td class='forumheader' style='vertical-align: middle;' /><img src='images/post.png'>&nbsp;".$date."</td>
							<td class='forumheader' style='vertical-align: middle; text-align:right' /><a href='".e_PLUGIN."pm/pm.php?send.".$com['com_by']."'><img src='".e_PLUGIN."/pm/images/pm.png' title='".PROFILE_138."'></a></td></tr>
						<tr>
							<td class='forumheader3' style='vertical-align: top; width='20%;' />";
						unset($checkonline,$on_name);

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
						$text .= "<td class='forumheader3' colspan='2' style='vertical-align: top;'>".$message."<hr width='80%' align='left' size='1' noshade ='noshade'>$from_signature</td></tr>";
						$text .= "<tr><td class='forumheader'><div class='smallblacktext'><a href='".e_SELF."?".e_QUERY."#header' onclick=\"window.scrollTo(0,0);\">".PROFILE_271."</a></div></td>";
						if (USER) {
							if ($comnumrows < $maxpcomment) {
								$text .= "<td colspan='2'  class='forumheader' style='vertical-align: middle; text-align:right' /><div class='smallblacktext'>| <a href='".e_SELF."?".e_QUERY."#newprofilecomment'>".PROFILE_414."</a> | <a href='".e_SELF."?".e_QUERY."&vtoname=".$from['user_name']."&vtodate=".$date."&vtoid=".$comid."#newprofilecomment'>".PROFILE_415."</a> |</td></div></tr></table><br/><br/>";
							} else {
								$text .= "<td colspan='2'  class='forumheader'></td></tr></table><br/><br/>";
							}
						} else {
							$text .= "<td colspan='2'  class='forumheader'></td></tr></table><br/><br/>";
						}
					}
				}
        if (($prev.$nav.$next)!='') {
				$text .= "<br/><center>".$prev.$nav.$next."</center><br/><br/>";
        }

          $text .="<tr><td>";
				// Hozzászólások listázásának vége
				if (USER) {

					if ($comnumrows < $maxpcomment) {
						if (isset($_GET['vtoname']) && isset($_GET['vtodate']) && isset($_GET['vtoid'])) {
							$vtoname = $_GET['vtoname'];
							$vtodate = $_GET['vtodate'];
							$vtoid = $_GET['vtoid'];
							$vtomessage = "[blockquote]".PROFILE_279."".$vtoname." #".$vtoid."".PROFILE_280."[/blockquote]";
						}
						$cbox .= "<a name='newprofilecomment'></a>";
//						$text .= "<form method='post' action='formhandler.php'><table width='100%'><tr><td class='forumheader' style='vertical-align: middle;' /><img src='images/post1.png'>&nbsp;&nbsp;<b>".PROFILE_33."</b></td>";
						$cbox .= "<form method='post' action='formhandler.php' style='margin:5px' ><table width='100%'><tr><td style='vertical-align: middle;text-align:left' />";

								if ($euser_pref['buttontype'] == "Yes") {
									$cboxbut = "<input type='image' name='post_comment' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_comment_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_comment.gif\"' src='images/buttons/".e_LANGUAGE."_comment.gif' title='".PROFILE_208."' >";
								} else {
//									$cboxbut= "<input type='submit' name='post_comment' value='".PROFILE_208."' class='button'>";
									$cboxbut = "<button style='height:25px;vertical-align:middle;' class='button' type='submit' value='submit' title='".PROFILE_208."' name='post_comment'><img style='vertical-align:middle;' src='images/post1.png'>&nbsp;&nbsp;<b>".PROFILE_33."</b></button>";
                }


//<button onclick="location.href='http://cat-philataelia.site90.net/e107_plugins/links_page/links.php?submit'" style="height:25px;vertical-align:middle;" class="button" type="submit" value="submit" name="post_comment"><img src='images/post1.png'>&nbsp;&nbsp;<b>".PROFILE_33."</b></button>




                
						if ($break[1] == 1 && $id != USERID) {
							if ((!in_array(USERID, $friendb)) && ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "")) {
								$cbox .= "<tr><td>".$username." ".PROFILE_105."</td></tr></form>";
							} else if ($euser_pref['friends'] != "ON") {
								$cbox .= "<tr><td>".$username." ".PROFILE_105a."</td></tr></form>";
							} else {
//								$text .= $cbox;
//								$text .= "<br/><input type='hidden' name='id' value='".$id."'>";
								$cbox .= "<input type='hidden' name='id' value='".$id."'>";

								if ($euser_pref['buttontype'] == "Yes") {
									$cbox .= "<input type='image' name='post_comment' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_comment_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_comment.gif\"' src='images/buttons/".e_LANGUAGE."_comment.gif' >";
								} else {
									$cbox .= "<input type='submit' name='post_comment' value='".PROFILE_208."' class='button'>";
								}

                $cbox .=$cboxbut;
							}
						} else {
//							$text .= $cbox;
//							$text .= "<br/><input type='hidden' name='id' value='".$id."'>";
							$cbox .= "<input type='hidden' name='id' value='".$id."'>";

							if ($euser_pref['buttontype'] == "Yes") {
								$cbox .= "<input type='image' name='post_comment' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_comment_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_comment.gif\"' src='images/buttons/".e_LANGUAGE."_comment.gif' >";
							} else {
								$cbox .= "<input type='submit' name='post_comment' value='".PROFILE_208."' class='button'>";
								
							}

                $cbox .=$cboxbut;

						}
          $cbox .="</td>";

						if (!e_WYSIWYG) {
							require_once(e_HANDLER."ren_help.php");
						}
//						$cbox = "<tr><td><textarea class='e-wysiwyg tbox' id='data' name='user_comment' cols='50' rows='10' style='width:100%' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this)'>$vtomessage</textarea></td></tr><tr><td>";
							$cbox .= "<td style='text-align:right'>".
						if (!e_WYSIWYG) {
							$cbox .= display_help("helpb", "body");
						}
//						$cbox .= "</td></tr>";
						$cbox .="</td></tr><tr><td colspan=2 style='text-align:center' >";
						$cbox .= "<textarea class='e-wysiwyg tbox' id='data' name='user_comment' cols='50' rows='5' style='width:100%' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this)'>$vtomessage</textarea>";


						// Check member settings
						if ($break[1] == 1 && $id != USERID) {
							if ((!in_array(USERID, $friendb)) && ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "")) {
								$text .= "<tr><td>".$username." ".PROFILE_105."</td></tr></form>";
							} else if ($euser_pref['friends'] != "ON") {
								$text .= "<tr><td>".$username." ".PROFILE_105a."</td></tr></form>";
							} else {
								$text .= $cbox;
								$text .= "</td></tr><tr><td><br/><br/><input type='hidden' name='id' value='".$id."'>";
								if ($euser_pref['buttontype'] == "Yes") {
									$text .= "<input type='image' name='post_comment' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_comment_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_comment.gif\"' src='images/buttons/".e_LANGUAGE."_comment.gif' >";
								} else {
									$text .= "<input type='submit' name='post_comment' value='".PROFILE_208."' class='button'>";
								}
							}
						} else {
							$text .= $cbox;
							$text .= "</td></tr><tr><td><br/><br/><input type='hidden' name='id' value='".$id."'>";
							if ($euser_pref['buttontype'] == "Yes") {
								$text .= "<input type='image' name='post_comment' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_comment_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_comment.gif\"' src='images/buttons/".e_LANGUAGE."_comment.gif' >";
							} else {
								$text .= "<input type='submit' name='post_comment' value='".PROFILE_208."' class='button'>";
							}
						}

						$cbox .= "</td></tr>";

					} else {
						$cbox .= "<table width='100%'><tr><td><div class='forumheader'>".PROFILE_237." ($maxpcomment".PROFILE_236.").</div>";
//						$text .= "<table width='100%'><tr><td><div class='forumheader'>".PROFILE_237." ($maxpcomment".PROFILE_236.").</div>";
					}
//					$text .= "</td></tr></table></form>";
					$cbox .= "</td></tr></table></form>";
				}
//			}

						$text .= $cbox;
					$text .= "</td></tr></table>";
*/
//$text .= "</div>";
//----			}
//----    }

// #####AMIGOS#####
//---    if (($_GET['page'] == friends) || (!$_GET['page'])){
			// Check member settings - NO Admin & NO Friends
//---			if (!USERID == ADMIN || !USER) {
/*
				$sql->mySQLresult = @mysql_query("SELECT user_friends, user_settings FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
				$settings = $sql->db_Fetch();
				$break = explode("|",$settings['user_settings']);
				$friendb = explode("|", $settings['user_friends']);
*/
//---				if ((!USER && $break[6] == 1) || ($break[6] == 1 && $id != USERID && !isset($_GET['add']))) {
					//----------- Only friends
/*
					if (!in_array(USERID, $friendb) || !USER) {
						$text .= "<br/>".$username." ".PROFILE_252;
						$display = $tp->parseTemplate($text, TRUE, $user_sc);
						$ns->tablerender("",$display);
						require_once(FOOTERF);
						exit;
					}
*/
    //---euser_onlyfriends(array(PROFILE_252));			
//---				}
//---			}

//			var_dump ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "");

//---			if ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "") {

//---$text .= "<div class='virtualpage4".(($_GET['page'] == friends)?"":" hidepiece")."'>";
// Carrego o ficheiro para no futuro ter uma hipótese de reoordenar como eu quiser isto...
//var_dump ("Inicio");
//---define(UPROF, "");
//---				require_once("includes/friends.php");
//var_dump ("Fim");
//---$text .="</div>";

/*
				if ($euser_pref['frcol'] == '') {
					$frcolumn = '6';
				} elseif ($euser_pref['frcol'] > '8') {
					$frcolumn = '8';
				} else {
					$frcolumn = $euser_pref['frcol'];
				}

				$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
				$list = $sql->db_Fetch();
				$friend = explode("|", $list['user_friends']);
				$num = count($friend) - 2;
				if ($list['user_friends'] == '' or $list['user_friends'] == '|') {
					$text .= "<br><table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/friends.png'>&nbsp;<i>".PROFILE_30."</i></td></tr></table>";
				} else {
					$text .= "<br><table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/friends.png'>&nbsp;<i>".$num." " .PROFILE_31." </i></td></tr></table>";
					$text .= "<table width='100%'>";
					$column = 1;
					foreach ($friend as $fr) {
						if ($column==1) {
						$text .="<tr>";
						}
						if ($fr == '') {
						// DO NOTHING
						} else {
							$sql->mySQLresult = @mysql_query("SELECT user_name, user_image FROM ".MPREFIX."user WHERE user_id='".$fr."' ");
							$fname = $sql->db_Fetch();
							$user_name = $fname['user_name'];
							$frnames[] = $user_name;
							array_multisort ($frnames, SORT_ASC);
						}
					}
					foreach ($frnames as $frname) {
						$sql->mySQLresult = @mysql_query("SELECT user_id, user_name, user_image FROM ".MPREFIX."user WHERE user_name='".$frname."' ");
						$name = $sql->db_Fetch();
						$user_name = $name['user_name'];
						$fr = $name['user_id'];
						$on_name = "".$fr.".".$user_name."";
						$check = $sql-> db_Count("online","(*)","WHERE online_user_id='".$on_name."'");
						if( $check > 0 ) {
							$online = "<img src='images/online.gif' title='".PROFILE_96."' style='vertical-align: top;' />";
						} else {
							$online = "";
						}
						unset($check,$on_name);
						$text .= "<td class='forumheader3' width = '10%'><div align='center'><a href='euser.php?id=".$fr."'>";
						if($name[user_image] == "") {
							$text .= "<img src='".e_PLUGIN."euser/images/noavatar.png' border='1' width='64' alt='' />";
						}else{
							$user_image = $name[user_image];
							require_once(e_HANDLER."avatar_handler.php");
							$user_image = avatar($user_image);
							$text .= "<img src='".$user_image."' border='1' width='64' alt='' />";
						}
						$text .= "<br/></a>".$online." ".$name['user_name']."</div></td>";
						$column++;
						if ($column == $frcolumn + 1) {
							$text .= "</tr>";
							$column = 1;
						}
					}
					$text .= "</table>";
					$text .= "<br/><table width='100%' ><tr><td class='forumheader' colspan='3' ><div class='smallblacktext'><a href='".e_SELF."?".e_QUERY."#top' onclick=\"window.scrollTo(0,0);\">".PROFILE_271."</a></div></td></tr></table>";
				}
*/
//---			}
//---}


			// Images
//		} elseif ($_GET['page'] == images) {
// #####IMAGENS#####
//--    if (($_GET['page'] == images) || (!$_GET['page'])){
			// Check member settings - NO Admin & NO Friends
//--			if (!USERID == ADMIN || !USER) {
/*
				$sql->mySQLresult = @mysql_query("SELECT user_friends, user_settings FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
				$settings = $sql->db_Fetch();
				$break = explode("|",$settings['user_settings']);
				$friendb = explode("|", $settings['user_friends']);
*/
//--				if ((!USER && $break[8] == 1) || ($break[8] == 1 && $id != USERID && !isset($_GET[//--'add']))) {
					//----------- Only friends
//--    euser_onlyfriends(array(PROFILE_250,PROFILE_250a));
/*
					if (((!in_array(USERID, $friendb)) && ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "")) || !USER) {
						$text .= "<br/>".$username." ".PROFILE_250;
						$display = $tp->parseTemplate($text, TRUE, $user_sc);
						$ns->tablerender("",$display);
						require_once(FOOTERF);
						exit;
					} else	if ($euser_pref['friends'] != "ON") {
						$text .= "<br/>".$username." ".PROFILE_250a;
						$display = $tp->parseTemplate($text, TRUE, $user_sc);
						$ns->tablerender("",$display);
						require_once(FOOTERF);
						exit;
					}
*/
//--				}
//--			}
//--			if ($euser_pref['pics'] == "ON" || $euser_pref['pics'] == "") {
//--$text.="<div class='virtualpage4".(($_GET['page'] == images)?"":" hidepiece")."'>";
// Carrego o ficheiro para no futuro ter uma hipótese de reoordenar como eu quiser isto...
//--				require_once("includes/images.php");
//--$text .= "</div>";

/*
				$picdir = "userimages/".$id."/";
				$picthumbdir = "userimages/".$id."/thumbs";

				function countpicFiles($strDirName) {
					if ($hndDir = opendir($strDirName)){
						$intCount = 0;
						while (false !== ($strFilename = readdir($hndDir))){
							if ($strFilename != "." && $strFilename != ".."){
								$intCount++;
							}
						}
						closedir($hndDir);
					} else {
						$intCount = -1;
					}
					return $intCount;
				}

				$kepekszama = countpicFiles($picdir);
				if(file_exists($picthumbdir)){
					if ($kepekszama < 3) {
						$text .= "<br><table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/images.png'><i>".PROFILE_163."</i></td></tr></table>";
					} else {
						$text .= "<br><table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/images.png'><i>".PROFILE_14a."</i></td></tr></table><br>";
					}
				}
				if(!file_exists($picthumbdir)){
					if ($kepekszama < 2) {
						$text .= "<br><table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/images.png'><i>".PROFILE_163."</i></td></tr></table>";
					} else {
						$text .= "<br><table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/images.png'><i>".PROFILE_14a."</i></td></tr></table><br>";
					}
				}
				if (isset($_GET['album']) && isset($_GET['pic'])) {
					if ($_GET['album'] != "root") {
						$dir = "userimages/".$id."/".$_GET['album']."/";
					} else {
						$dir = "userimages/".$id."/";
					}
//MOD_20120418
//								$dirHandle = opendir($dir);
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
$np =0;
foreach($file_list as $one_file) {
 $file = $one_file['name'];
 if (!is_dir($dir.$file)){
  if ($file != "." && $file != ".." && $file != "Thumbs.db" && $file != "only_friends" && $file != "thumbs" && substr(strrchr($file, '.'), 1) != "txt" && substr(strrchr($file, '.'), 1) != "htm" ) {
   if ($np == 1) {
     $next_pic = $file;
     break;
   }
   if ($file == $_GET['pic']) $np = 1;
   if (!$np ==1) $prev_pic = $file;
  }
 }
}



					$aof = 0;
					if (file_exists($dir."/only_friends")) $aof = 1;
					if ((in_array(USERID, $friendb) && ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "") && USER) || !file_exists("".$dir."/only_friends") || $id == USERID || (ADMIN && getperms("4"))) {
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
*/
/*
						if ($_GET['album'] != "root") {
							$text .= "<a href='euser.php?id=".$id."&page=".$_GET['page']."'><< ".PROFILE_34."</a><br/><a href='euser.php?id=".$id."&page=".$_GET['page']."&album=".$_GET['album']."'><< ".PROFILE_34a." \"".str_replace("_", " ", $_GET['album'])."\"</a><br/><br/>";
						} else {
							$text .= "<a href='euser.php?id=".$id."&page=".$_GET['page']."'><< ".PROFILE_34."</a><br/><br/>";
						}
*/
/*
						$kepmeret = getimagesize("".$dir.$_GET['pic']."");
						$kep_sz = $kepmeret[0]+30;
						$kep_m = $kepmeret[1]+30;
						if ($euser_pref['picviewsize'] == '') {
							$picviewsize = '600';
						} else {
							$picviewsize = $euser_pref['picviewsize'];
						}

if ($prev_pic) {
$prev .= "<a href='euser.php?id=".$id."&page=".$_GET['page']."&album=".$_GET['album']."&pic=".$prev_pic."'><img style='border: 0px solid ; width: 32px; height: 32px;' alt='prev' title='".PROFILE_426."' src='images/prev.png'></a>";
}
if ($next_pic) {
$next .= "<a href='euser.php?id=".$id."&page=".$_GET['page']."&album=".$_GET['album']."&pic=".$next_pic."'><img style='border: 0px solid ; width: 32px; height: 32px;' alt='next' title='".PROFILE_427."' src='images/next.png'></a>";
}

if ($_GET['album'] != "root") {
$up_pic .= "<a href='euser.php?id=".$id."&page=".$_GET['page']."&album=".$_GET['album']."'><img style='border: 0px solid ; width: 32px; height: 32px;' alt='next' title='".PROFILE_34a." ".$_GET['album']."' src='images/up.png'></a>";
} else {
$up_pic .= "<a href='euser.php?id=".$id."&page=".$_GET['page']."'><img style='border: 0px solid ; width: 32px; height: 32px;' alt='next' title='".PROFILE_34."' src='images/up.png'></a>";
}

$text .= '<table style="text-align: left; width: 100%; margin-left: auto; margin-right: auto;" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td colspan="3" rowspan="1" style="vertical-align: top;"><br>
';




						if ($euser_pref['lightview'] == 'Yes' && $euser_pref['cl_widget_ver'] != ''){
							if ($kep_sz<$picviewsize+31) {
								$text .= "<center><img src='".$dir.$_GET['pic']."'><br>".str_replace("_", " ", $picname)."</center><br/><br/>";
							} else {
								$text .= "<center><a href='".$dir.$_GET['pic']."' class=\"lightview\" title='".$username.": ::".str_replace("_", " ", $picname)."'><img src='".$dir.$_GET['pic']."' width='$picviewsize'></a><br/>".str_replace("_", " ", $picname)."a</center>";
							}
						} else if ($euser_pref['lightwindowbox'] == 'Yes' && (file_exists(e_PLUGIN."lightwindow/js/lightwindow.js"))){
							if ($kep_sz<$picviewsize+31) {
								$text .= "<center><img src='".$dir.$_GET['pic']."'><br>".str_replace("_", " ", $picname)."</center><br/><br/>";
							} else {
								$text .= "<center><a href='".$dir.$_GET['pic']."' class=\"lightwindow\" title='".$_GET['pic']."'><img src='".$dir.$_GET['pic']."' width='$picviewsize'></a><br/>".str_replace("_", " ", $picname)."</center>";
							}
						} else if ($euser_pref['lightbox'] == 'Yes' && $euser_pref['lightb_enabled'] == '1'){
							if ($kep_sz<$picviewsize+31) {
								$text .= "<center><img src='".$dir.$_GET['pic']."'><br>".str_replace("_", " ", $picname)."</center><br/><br/>";
							} else {
								$text .= "<center><a href='".$dir.$_GET['pic']."' rel=\"lightbox[roadtrip]\" title='".$_GET['pic']."'><img src='".$dir.$_GET['pic']."' width='$picviewsize'></a><br/>".str_replace("_", " ", $picname)."</center>";
							}
						} else if ($euser_pref['clearbox'] == 'Yes'){
							echo '
								<script language="JavaScript" src="clearbox/js/clearbox.js" type="text/javascript" charset="iso-8859-2"></script>
								<link rel="stylesheet" href="clearbox/css/clearbox.css" rel="stylesheet" type="text/css"/>
							';





if ($kep_sz<$picviewsize+31) {
//	$text .= "<center><img src='".$dir.$_GET['pic']."'><br>".str_replace("_", " ", $picname)."</center><br/><br/>";
	$text .= "<center><a href='".$dir.$_GET['pic']."' rel=\"clearbox[gallery=gallery]\" title='".$_GET['pic']."'><img src='".$dir.$_GET['pic']."'></a><br/>".str_replace("_", " ", $picname)."</center>";

} else {
	$text .= "<center><a href='".$dir.$_GET['pic']."' rel=\"clearbox[gallery=gallery]\" title='".$_GET['pic']."'><img src='".$dir.$_GET['pic']."' width='$picviewsize'></a><br/>".str_replace("_", " ", $picname)."</center>";
}
foreach($file_list as $one_file) {
 $file = $one_file['name'];
 if (!is_dir($dir.$file)){
  if ($file != "." && $file != $_GET['pic'] && $file != ".." && $file != "Thumbs.db" && $file != "only_friends" && $file != "thumbs" && substr(strrchr($file, '.'), 1) != "txt" && substr(strrchr($file, '.'), 1) != "htm" ) {
//	$text .= '<a href="'.$dir.$file.'" rel="clearbox[gallery=gallery]"><img src="'.$dir.$file.'"></a>';
 if (is_file($dir."thumbs/".$file)) {
	$text .= '<a href="'.$dir.$file.'" rel="clearbox[gallery=gallery]" tnhref="'.$dir."thumbs/".$file.'"></a>';
} else {
	$text .= '<a href="'.$dir.$file.'" rel="clearbox[gallery=gallery]" tnhref="'.$dir.$file.'"></a>';
}
  }
 }
}


 

*/
/*
							if ($kep_sz<$picviewsize+31) {
								$text .= "<center><img src='".$dir.$_GET['pic']."'><br>".str_replace("_", " ", $picname)."</center><br/><br/>";
							} else {
								$text .= "<center><a href='".$dir.$_GET['pic']."' rel=\"clearbox\" title='".$_GET['pic']."'><img src='".$dir.$_GET['pic']."' width='$picviewsize'></a><br/>".str_replace("_", " ", $picname)."</center>";
							}
*/
/*
						} else {
							if ($kep_sz<$picviewsize+31) {
								$text .= "<center><img src='".$dir.$_GET['pic']."'><br>".str_replace("_", " ", $picname)."</center><br/><br/>";
							} else {
								$text .= "<center><a href='#' title='".PROFILE_167."' onClick=\"window.open('".$dir.$_GET['pic']."','','menubar=no,titlebar=no,resizable=no,scrollbars=yes,width=$kep_sz,height=$kep_m')\"><img src='".$dir.$_GET['pic']."' width='$picviewsize'></a><br/>".str_replace("_", " ", $picname)."</center>";
							}
						}

$text .= '</td>
</tr>
<tr>
<td style="vertical-align: top; text-align: center; width: 10%;">'.$prev.'<br>
</td>
<td style="vertical-align: top; text-align: center; width: 10%;"><br/><br/>'.$up_pic.'
</td>
<td style="vertical-align: top; text-align: center; width: 10%;">'.$next.'<br>
</td>
</tr>
</tbody>
</table>';







						$sql->mySQLresult = @mysql_query("SELECT com_id, com_message, com_date, com_by FROM ".MPREFIX."euser_com WHERE com_to='".$id."' AND com_type='pics' AND com_extra='".mysql_real_escape_string($_GET['album'])."/".mysql_real_escape_string($_GET['pic'])."' ORDER BY com_date DESC");
						$piccomm = $sql->db_Rows();
						// Kép hozzászólások listázása
						$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."euser_com WHERE com_to='".$id."' AND com_extra='".mysql_real_escape_string($_GET['album'])."/".mysql_real_escape_string($_GET['pic'])."'");
						$picnumrows = $sql->db_Rows();
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
						if(isset($_GET['comment_order'])) {
							if($_GET['comment_order'] == "ASC" || $_GET['comment_order'] == "DESC") {
								$comment_order = $_GET['comment_order'];
							}
						}
						if (!$comment_order == ASC || !$comment_order == DESC) {
							$comment_order = "DESC";
						}
						$sql->mySQLresult = @mysql_query("SELECT com_id, com_message, com_date, com_by FROM ".MPREFIX."euser_com WHERE com_to='".$id."' AND com_type='pics' AND com_extra='".mysql_real_escape_string($_GET['album'])."/".mysql_real_escape_string($_GET['pic'])."' ORDER BY com_date $comment_order LIMIT $offset,$rowsPerPage");
						$piccomm = $sql->db_Rows();
						$maxPage = ceil($picnumrows/$rowsPerPage);
						$self = $_SERVER['PHP_SELF'];
						$nav  = '';
						for($page = 1; $page <= $maxPage; $page++) {
							if ($page == $pageNum) {
								$nav .= ""; // no need to create a link to current page
							} else {
								$nav .= " <a href=\"$self?id=".$id."&page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&comment_order=".$comment_order."&pgnum=".$page."\">$page</a> ";
							}
						}
						if ($pageNum > 1) {
							$page  = $pageNum - 1;
							$prev  = " <a href=\"$self?id=".$id."&page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&comment_order=".$comment_order."&pgnum=".$page."\">".PROFILE_204."</a> ";
							$first = " <a href=\"$self?id=".$id."&page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&comment_order=".$comment_order."&pgnum=".$page."\">".PROFILE_205."</a> ";
						} else {
							$prev  = ''; // we're on page one, don't print previous link
							$first = '&nbsp;'; // nor the first page link
						}
						if ($pageNum < $maxPage) {
							$page = $pageNum + 1;
							$next = " <a href=\"$self?id=".$id."&page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&comment_order=".$comment_order."&pgnum=".$page."\">".PROFILE_202."</a> ";
							$last = " <a href=\"$self?id=".$id."&page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&comment_order=".$comment_order."&pgnum=".$page."\">".PROFILE_203."</a> ";
						} else {
							$next = ''; // we're on the last page, don't print next link
							$last = '&nbsp;'; // nor the last page link
						}
						// END OF MULTIPAGES
	
						if ($euser_pref['maxpiccomment'] != '') {
							$maxpiccomment = $euser_pref['maxpiccomment'];
						} else {
							$maxpiccomment = 50;
						}
						if ($piccomm == 0) {
							$text .= "<br/><br/><i>".PROFILE_36."</i>";
						} else {
						$text .= "<br><table width='100%' class='fborder'>
								<tr>
									<td style='width:20%; text-align:left' class='forumheader' colspan='2'><img src='images/comments.png'><i>".PROFILE_36a." (".$picnumrows."):</i></td>";
									if ($comment_order == DESC) {
										$text .= "<td style='width:80%; text-align:right' class='forumheader' colspan='2'>".PROFILE_256."&nbsp;&nbsp;<a href=\"$self?id=".$id."&page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&comment_order=ASC\"><img src='images/order_down.png' title='".PROFILE_310."'></a></td>";
									} else {
										$text .= "<td style='width:80%; text-align:right' class='forumheader' colspan='2'>".PROFILE_256."&nbsp;&nbsp;<a href=\"$self?id=".$id."&page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&comment_order=DESC\"><img src='images/order_up.png' title='".PROFILE_309."'></a></td>";
									}
									$text .= "</tr>
							</table>";
							$text .= "<br/>";
							// Kép hozzászólások indul
							for ($i = 0; $i < $piccomm; $i++) {
								$com = $sql->db_Fetch();
								$from = mysql_query("SELECT * FROM ".MPREFIX."user WHERE user_id=".$com['com_by']." ");
								$from = mysql_fetch_assoc($from);
								$date = date("Y-m-j. H:i", $com['com_date']);
								$comid = $com['com_id'];
								$user_name = $from['user_name'];
								$on_name = "".$com['com_by'].".".$user_name."";
								$checkonline = mysql_query("SELECT * FROM ".MPREFIX."online WHERE online_user_id='".$on_name."'");
								$checkonline = mysql_num_rows($checkonline);
								//e107_0.8 compatible
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
								$fromext = mysql_query("SELECT * FROM ".MPREFIX."user_extended WHERE user_extended_id=".$com['com_by']." ");
								$fromext = mysql_fetch_assoc($fromext);
								if( $checkonline > 0 ) {
									$online = "<img src='images/online.gif' title='".PROFILE_96."' style='vertical-align: middle;' />";
								} else {
									$online = "";
								}
								unset($checkonline,$on_name);
								$text .= "<br><table width='100%' class='fborder'>
								<tr>
									<td style='width:20%; text-align:left' class='fcaption'>".PROFILE_268."".$from['user_name']."</td>
									<td style='width:60%; text-align:left' class='fcaption'>".PROFILE_269."</td>
									<td style='width:20%; text-align:right' class='fcaption'>id: #".$comid."</td>
								</tr>
									<td class='forumheader'>&nbsp;".$online."&nbsp;&nbsp;<a href='euser.php?id=".$com['com_by']."'><b>".$from['user_name']."</b></a></td>
									<td class='forumheader' style='vertical-align: middle;' /><img src='images/post.png'>&nbsp;".$date."</td>
									<td class='forumheader' style='vertical-align: middle; text-align:right' /><a href='".e_PLUGIN."pm/pm.php?send.".$com['com_by']."'><img src='".e_PLUGIN."/pm/images/pm.png' title='".PROFILE_138."'></a></td></tr>
								<tr>
									<td class='forumheader3' style='vertical-align: top; width='20%;' />";
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
								$text .= "<td class='forumheader3' colspan='2' style='vertical-align: top;'>".$message."<hr width='80%' align='left' size='1' noshade ='noshade'>$from_signature</td></tr>";
								$text .= "<tr><td class='forumheader'><div class='smallblacktext'><a href='".e_SELF."?".e_QUERY."#header' onclick=\"window.scrollTo(0,0);\">".PROFILE_271."</a></div></td>";
								if (USER) {
									if ($picnumrows < $maxpiccomment) {
										$text .= "<td colspan='2'  class='forumheader' style='vertical-align: middle; text-align:right' /><div class='smallblacktext'>| <a href='".e_SELF."?".e_QUERY."#newprofilecomment'>".PROFILE_414."</a> | <a href='".e_SELF."?".e_QUERY."&vtoname=".$from['user_name']."&vtodate=".$date."&vtoid=".$comid."#newprofilecomment'>".PROFILE_415."</a> |</td></div></tr></table><br/><br/>";
									} else {
										$text .= "<td colspan='2'  class='forumheader'></td></tr></table><br/><br/>";
									}
								} else {
									$text .= "<td colspan='2'  class='forumheader'></td></tr></table><br/><br/>";
								}
							}
						}
						$text .= "<br/><center>".$prev.$nav.$next."</center><br/><br/>";
						// Kép hozzászólások listázásának vége
						if (USER) {
							if ($picnumrows < $maxpiccomment) {
								if (isset($_GET['vtoname']) && isset($_GET['vtodate']) && isset($_GET['vtoid'])) {
									$vtoname = $_GET['vtoname'];
									$vtodate = $_GET['vtodate'];
									$vtoid = $_GET['vtoid'];
									$vtomessage = "[blockquote]".PROFILE_279."".$vtoname." #".$vtoid."".PROFILE_280."[/blockquote]";
								}
								$text .= "<a name='newprofilecomment'></a>";
								$text .= "<form method='post' action='formhandler.php'><table width='100%'><tr><td class='forumheader' style='vertical-align: middle;' /><img src='images/post1.png'>&nbsp;&nbsp;<b>".PROFILE_33."</b></td>";
								if (!e_WYSIWYG) {
									require_once(e_HANDLER."ren_help.php");
								}
								$cpbox = "<tr><td><input type='hidden' name='album' value='".$_GET['album']."'><textarea class='e-wysiwyg tbox' id='data' name='user_picture_comment' cols='50' rows='10' style='width:100%' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this)'>$vtomessage</textarea></td></tr><tr><td>";
								if (!e_WYSIWYG) {
									$cpbox .= display_help("helpb", "body");
								}
								$cpbox .= "</td></tr>";
								// Check member settings
								if ($break[2] == 1 && $id != USERID) {
									if ((!in_array(USERID, $friendb)) && ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "")) {
										$text .= "<tr><td>".$username." ".PROFILE_107b."</td></tr></table></form>";
									} else if ($euser_pref['friends'] != "ON") {
										$text .= "<tr><td>".$username." ".PROFILE_107c."</td></tr></table></form>";
									} else {
										$text .= $cpbox;
										///comment küldése
										$text .= "</td></tr><tr><td><br/><br/><input type='hidden' name='id' value='".$id."'><input type='hidden' name='pic' value='".$_GET['pic']."'><input type='hidden' name='picfull' value='".$_GET['album']."/".$_GET['pic']."'><input type='hidden' name='picname' value='".$picname[0]."'><input type='hidden' name='txtfile' value='".$data."'>";
										if ($euser_pref['buttontype'] == "Yes") {
											$text .= "<input type='image' name='post_comment' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_comment_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_comment.gif\"' src='images/buttons/".e_LANGUAGE."_comment.gif' >";
										} else {
										$text .= "<input type='submit' name='post_comment' value='".PROFILE_208."' class='button'>";
										}
									}
								} else {
									$text .= $cpbox;
									///comment küldése
									$text .= "</td></tr><tr><td><br/><br/><input type='hidden' name='id' value='".$id."'><input type='hidden' name='pic' value='".$_GET['pic']."'><input type='hidden' name='picfull' value='".$_GET['album']."/".$_GET['pic']."'><input type='hidden' name='picname' value='".$picname[0]."'><input type='hidden' name='txtfile' value='".$data."'>";
									if ($euser_pref['buttontype'] == "Yes") {
										$text .= "<input type='image' name='post_comment' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_comment_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_comment.gif\"' src='images/buttons/".e_LANGUAGE."_comment.gif' >";
									} else {
										$text .= "<input type='submit' name='post_comment' value='".PROFILE_208."' class='button'>";
									}
								}
							} else {
								$text .= "<table width='100%'><tr><td><div class='forumheader'>".PROFILE_238." ($maxpiccomment".PROFILE_236.").</div>";
							}
								$text .= "</td></tr></table></form>";
						}
					}
				} elseif (isset($_GET['album']) && !isset($_GET['pic'])) {
					$text .= "<a href='euser.php?id=".$id."&page=".$_GET['page']."'><< ".PROFILE_34."</a><br/>";
					$dir = "userimages/".$id."/".$_GET['album']."/";
					if ((in_array(USERID, $friendb) && ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "") && USER) || !file_exists("".$dir."/only_friends") || $id == USERID || (ADMIN && getperms("4"))) {
						if (file_exists($dir)) {
							// IF glob has been disabled by your host then uncomment the above function and comment out the next 2 lines.
							$empty = (count(glob("$dir/*")) === 0) ? 'TRUE' : 'FALSE';
							if ($empty == "TRUE") {
*/
								// Comment out until here - when uncommenting above, just remove the /* and */ from function to if.
/*
								$text .= "<br/><i>".PROFILE_123."</i>";
							} else {
								$column = 1;
								if ($euser_pref['piccol']) {
									$profile_piccol = $euser_pref['piccol'];
								} else {
									$profile_piccol = 3;
								}
								$profile_piccol_p = intval(100/$profile_piccol);
								$text .= "<br/><table width='100%'>";
//MOD_20120418
//								$dirHandle = opendir($dir);
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
//								while ($file = readdir($dirHandle)) {

foreach($file_list as $one_file) {
$file = $one_file['name'];
		// Get the file size.
		$fs = $one_file['size'];
		
if (e_LANGUAGE == "English") {
		$ft = date ('F j, Y  H:i', $one_file['mtime']);
} else {
		$ft = date("Y. m. j. H:i", $one_file['mtime']);
}

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
										if ($column==1) {
											$text .="<tr>";
										}
										//Album pictures:
										if (file_exists($dir."/thumbs/".$file)) {
											$text .= "<td width='".$profile_piccol_p."%'><center><a href='euser.php?id=".$id."&page=".$_GET['page']."&album=".$_GET['album']."&pic=".$file."'><img src='".$dir."thumbs/".$file."'></a><br/>".str_replace("_", " ", $newname)."<br/>".$ft."<br/>(".$fs."kB)";
											$query = mysql_query("SELECT com_id FROM ".MPREFIX."euser_com WHERE com_type='pics' AND com_extra='".mysql_real_escape_string($_GET['album'])."/".mysql_real_escape_string($file)."' ");
											$pic_all = mysql_num_rows($query);
											if ($pic_all > 0) {
												$text .= "<br/>".$pic_all." ".($pic_all == 1 ? PROFILE_315 : PROFILE_315)."</center></td>";
											} else {
												$text .= "</center></td>";
											}
										} else {
											$text .= "<td width='".$profile_piccol_p."%'><center><a href='euser.php?id=".$id."&page=".$_GET['page']."&album=".$_GET['album']."&pic=".$file."'><img src='".$dir.$file."' width='100'></a><br/>".str_replace("_", " ", $newname)."<br/>".$ft."<br/>(".$fs."kB)";
											$query = mysql_query("SELECT com_id FROM ".MPREFIX."euser_com WHERE com_type='pics' AND com_extra='".mysql_real_escape_string($_GET['album'])."/".mysql_real_escape_string($file)."' ");
											$pic_all = mysql_num_rows($query);
											if ($pic_all > 0) {
												$text .= "<br/>".$pic_all." ".($pic_all == 1 ? PROFILE_315 : PROFILE_315)."</center></td>";
											} else {
												$text .= "</center></td>";
											}
										}
										$column++;
										if ($column == $profile_piccol + 1) {
											$text .= "</tr><tr><td><br/></td></tr>";
											$column = 1;
										}
									}
								}
//								closedir($dirHandle);
}
								$text .= "</table>";
							$text .= "<br/><table width='100%' ><tr><td class='forumheader' colspan='3' ><div class='smallblacktext'><a href='".e_SELF."?".e_QUERY."#top' onclick=\"window.scrollTo(0,0);\">".PROFILE_271."</a></div></td></tr></table>";
							}
						} else {
							$text .= "<i>".PROFILE_123."</i>";
						}
					}

				} else {
					$dir = "userimages/".$id."/";
//MOD_20120418
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

//					}

					$text .= "<table width='100%'><tr>"; // <br/><br/>
//					if ($handle = opendir($dir)) {
						$col = 0;
						$piccol = 0;
						if ($euser_pref['piccol']) {
							$profile_piccol = $euser_pref['piccol'];
						} else {
							$profile_piccol = 3;
						}
						$profile_piccol_p = intval(100/$profile_piccol);
//						while (false !== ($file = readdir($handle))) {

foreach($file_list as $one_file) {
$file = $one_file['name'];
		// Get the file size.
		$fs = $one_file['size'];
		
		// Get the file's modification date.
if (e_LANGUAGE == "English") {
		$ft = date ('F j, Y  H:i', $one_file['mtime']);
} else {
		$ft = date("Y. m. j. H:i", $one_file['mtime']);
}

							if ($file != "." && $file != ".." && $file != "Thumbs.db" && $file != "thumbs" && substr(strrchr($file, '.'), 1) != "txt" && substr(strrchr($file, '.'), 1) != "htm" ) {
								if (substr(strrchr($file, '.'), 1) != "") {
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
										$pic .= "<td width='".$profile_piccol_p."%'><center><a href='euser.php?id=".$id."&page=images&album=root&pic=".$file."'><img src='".$dir."thumbs/".$file."'></a><br/>".str_replace("_", " ", $newname)."<br/>".$ft."<br/>(".$fs."kB)";
										$query = mysql_query("SELECT com_id FROM ".MPREFIX."euser_com WHERE com_type='pics' AND com_extra='root/".mysql_real_escape_string($file)."' ");
										$pic_all = mysql_num_rows($query);
										if ($pic_all > 0) {
											$pic .= "<br/>".$pic_all." ".($pic_all == 1 ? PROFILE_315 : PROFILE_315)."</center></td>";
										} else {
											$pic .= "</center></td>";
										}
									} else {
										$pic .= "<td width='".$profile_piccol_p."%'><center><a href='euser.php?id=".$id."&page=images&album=root&pic=".$file."'><img src='".$dir.$file."' width='100'></a><br/>".str_replace("_", " ", $newname)."<br/>".$ft."<br/>(".$fs."kB)";
										$query = mysql_query("SELECT com_id FROM ".MPREFIX."euser_com WHERE com_type='pics' AND com_extra='root/".mysql_real_escape_string($file)."' ");
										$pic_all = mysql_num_rows($query);
										if ($pic_all > 0) {
											$pic .= "<br/>".$pic_all." ".($pic_all == 1 ? PROFILE_315 : PROFILE_315)."</center></td>";
										} else {
											$pic .= "</center></td>";
										}
									}
									$piccol++;
									if ($piccol == $profile_piccol) {
										$pic .= "</tr><tr><td><br/></td></tr><tr>";
										$piccol = 0;
									}
								} else {
									$count = 0;
									$firstimage="";
									if ($subhandle = opendir($dir.$file)) {
										$aof = 0;
										while (false !== ($subfile = readdir($subhandle))) {
											if ($subfile=="only_friends") $aof = 1;
											if ($subfile != "only_friends" && $subfile != "." && $subfile != ".." && $subfile != "Thumbs.db" && $subfile != "thumbs"  && $subfile != "index.htm" ) {
												if ($firstimage == "") {
													$firstimage = $subfile;
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
									//Albums:
									if ((in_array(USERID, $friendb) && ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "") && USER) || $aof != 1 || $id == USERID || (ADMIN && getperms("4"))) {
										if ($count == 0) {
											$text .="<td width='".$profile_piccol_p."%'><center><a href='euser.php?id=".$id."&page=images&album=".$file."'  style=\"text-decoration: none;\"><img src='images/folder.png' width='64' style='padding:5px;border-style:outset;border-width:1px'><br/>".str_replace("_", " ", $file)."</a><br/><br/>".$count." ".($count == 1 ? PROFILE_134 : PROFILE_135)."<br/><br/></center></td>";
										} else {
											$text .="<td width='".$profile_piccol_p."%'><center><a href='euser.php?id=".$id."&page=images&album=".$file."'  style=\"text-decoration: none;\"><img ".$imageurl." style='padding:5px;border-style:outset;border-width:3px'><br/>".str_replace("_", " ", $file)."</a><br/><br/>".$count." ".($count == 1 ? PROFILE_134 : PROFILE_135)."<br/><br/></center></td>";
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
//						closedir($handle);
					}
					$text .= "</tr><tr>".$pic."</tr></table>";

					if ($kepekszama > 2) {
						$text .= "<br/><table width='100%' ><tr><td class='forumheader' colspan='3' ><div class='smallblacktext'><a href='".e_SELF."?".e_QUERY."#top' onclick=\"window.scrollTo(0,0);\">".PROFILE_271."</a></div></td></tr></table>";
					}
				}
*/
//--			}
//--		}

//		} elseif ($_GET['page'] == videos) {
// #####VIDEOS#####
//--    if (($_GET['page'] == videos) || (!$_GET['page'])){
			// Check member settings - NO Admin & NO Friends
//--			if (!USERID == ADMIN || !USER) {
/*
				$sql->mySQLresult = @mysql_query("SELECT user_friends, user_settings FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
				$settings = $sql->db_Fetch();
				$break = explode("|",$settings['user_settings']);
				$friendb = explode("|", $settings['user_friends']);
*/
//--				if ((!USER && $break[7] == 1) || ($break[7] == 1 && $id != USERID && !isset($_GET['add']))) {
					//----------- Only friends
//--    euser_onlyfriends(array(PROFILE_251,PROFILE_251a));			

/*
					if (((!in_array(USERID, $friendb)) && ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "")) || !USER) {
						$text .= "<br/>".$username." ".PROFILE_251;
						$display = $tp->parseTemplate($text, TRUE, $user_sc);
						$ns->tablerender("",$display);
						require_once(FOOTERF);
						exit;
					} else if ($euser_pref['friends'] != "ON") {
						$text .= "<br/>".$username." ".PROFILE_251a;
						$display = $tp->parseTemplate($text, TRUE, $user_sc);
						$ns->tablerender("",$display);
						require_once(FOOTERF);
						exit;
					}
*/
//--				}
//--			}
//--			if ($euser_pref['videos'] == "ON" || $euser_pref['videos'] == "") {
//--$text .="<div class='virtualpage4".(($_GET['page'] == videos)?"":" hidepiece")."'>";
//--				require_once("includes/videos.php");
//--$text .="</div>";
//--			}
//--}
/*
$text .="</div>";

$textjs = "<!-- Initialize Demo 4 -->
<script type='text/javascript'>
var gallery4=new virtualpaginate({
	piececlass: 'virtualpage4',
	piececontainer: 'div',
	pieces_per_page: 1,
	defaultpage: 0,
	wraparound: false,
	persist: true
})

//gallery4.buildpagination(['galleryalt'], ['castle', 'park', 'harvest'])

gallery4.buildpagination(['galleryalt'], [".(($euser_pref['commentson'] == "ON" || $euser_pref['commentson'] == "")? "'<img style=\"vertical-align:middle\" src=\"images/comments_small.png\"> ".PROFILE_15."'":"")." ".(($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "")? ", '<img style=\"vertical-align:middle\" src=\"images/group.png\"> ".PROFILE_13."'":"")." ".(($euser_pref['pics'] == "ON" || $euser_pref['pics'] == "")?", '<img style=\"vertical-align:middle\" src=\"images/images_small.png\"> ".PROFILE_14."'":"")." ".	(($euser_pref['videos'] == "ON" || $euser_pref['videos'] == "")?", '<img style=\"vertical-align:middle\" src=\"images/film.png\"> ".PROFILE_113."'":"")."])

</script>
";
*/
// END OF PAGINATION



		//MINDENNEK VÉGE


//	} else {
// Isto é preciso por causa da quantidade de tabs horizontais....
e107::js('euser','dist/jquery.scrolling-tabs.js', 'jquery');
e107::css('euser','dist/jquery.scrolling-tabs.css', 'jquery');
e107::js('footer-inline',"$('.userprofile.nav-tabs').scrollingTabs();");

/////// FIQUEI AQUI!!!!!!!!
	if (!isset($_GET['page'])) {
		// Update profile views and last visitors
//		if (USERID != $id && $euser_pref['stats'] == "ON" && mysql_query("SELECT user_lastviewed FROM ".MPREFIX."euser LIMIT 0") && USER) {
//var_dump (USERID != $id);
//var_dump ($euser_pref['stats']);
//var_dump ($sql->select("euser", "user_lastviewed", "LIMIT 0"));
//var_dump (USER);
		if (USERID != $id && $euser_pref['stats'] && USER) {
//			$sql->mySQLresult = @mysql_query("SELECT user_lastviewed FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
			$sql->select("euser", "user_lastviewed", "user_id='".$id."' ");
//			$getdata = $sql->db_Fetch();
			$getdata = $sql->rows();
			$data = unserialize($getdata['user_lastviewed']);
			$newarray = Array();
			$count = 1;
			array_push($newarray, USERID."|".time());
			foreach ($data as $d) {
				$break = explode("|", $d);
				if ($count != 10 && USERID != $break[0]) {
					array_push($newarray, $d);
					$count++;
				}
			}
			$array = serialize($newarray);
//var_dump ($array);
//			$sql -> db_Update("euser", "user_lastviewed='".$array."', user_totalviews=user_totalviews + 1 WHERE user_id='".$id."' ");
$getdata?$sql->update("euser", "user_lastviewed='".$array."', user_totalviews=user_totalviews + 1 WHERE user_id='".$id."' "):
			$sql->insert("euser", array('user_lastviewed'=>$array, 'user_totalviews'=>'1', 'user_id'=>$id));
		}
		if (isset($_GET['add'])) {
			$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
			$list = $sql->db_Fetch();
			$friend = explode("|", $list['user_friends']);
			$megjelolt = explode("|", $list['user_friends_request']);

			$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."euser WHERE user_id='".USERID."' ");
			$te_list = $sql->db_Fetch();
			$megjeloltek = explode("|", $te_list['user_friends_request']);

/*
			$sql->mySQLresult = @mysql_query("SELECT user_id, user_name FROM ".MPREFIX."user WHERE user_id='".$id."' ");
			$ures = $sql->db_Fetch();
			$uresek = ($ures['user_name']);
*/

	$sql-> db_Select("user","user_name","user_id = '$id'");
	while($row = $sql -> db_Fetch()) {
		$uresek = $row['user_name'];
	}

			// Saját magad nem:
			if (USERID == $id) {
				$text .= "<br/>".PROFILE_100;
				//Csak tagok
			} elseif (!USER) {
				$text .= "<br/>".PROFILE_161;
				//Már barátod
			} elseif (in_array(USERID, $friend)) {
				$text .= "<br/>".PROFILE_140;
				//Már megjelölted
			} elseif (in_array(USERID, $megjelolt)) {
				$text .= "<br/>".PROFILE_140a;
				//Már megjelölt
			} elseif (in_array($id, $megjeloltek)) {
				$text .= "<br/>".PROFILE_140b;
				// Trükközés:
			} elseif ($uresek == '') {
				$text .= "<br/>".PROFILE_140c;
			} else {
				$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends FROM ".MPREFIX."euser WHERE user_id='".USERID."' ");
				$yourows = $sql->db_Rows();
				$you = $sql->db_Fetch();
				$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
				$themrows = $sql->db_Rows();
				$them = $sql->db_Fetch();
				if ($_POST['add_no']) {
					header("Location: euser.php?id=".$id."");
				} elseif ($_POST['add_yes']) {
					if ($them['user_friends_request'] != '') {
						$new = "".USERID."|";
						$request = $them['user_friends_request'].$new;
					} else {
						$request = "|".USERID."|";
					}
					if ($yourows != 0) {
					// DO NOTHING
					} else {
						$sql -> db_Insert("euser", "'".USERID."', '', '', '', '', '', '', '', '0', '0', ''  ");
					}
						if ($themrows != 0) {
						$sql -> db_Update("euser", "user_friends_request='".$request."' WHERE user_id='".$id."' ");
					} else {
						$sql -> db_Insert("euser", "'".$id."', '', '', '', '".$request."', '', '', '', '0', '0', ''  ");
					}

					$sql->mySQLresult = @mysql_query("SELECT user_settings FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
					$settings = $sql->db_Fetch();
					$break = explode("|",$settings['user_settings']);
					if ($euser_pref['fr_req_sendpm'] == 'Yes') {
						if ($break[5] == 1 || !$settings[0] || $euser_pref['fr_req_sendpm_all'] == 'on') {
							$userfrom = get_user_data(USERID);
							$userfrom = $userfrom['user_name'];
							$msg = "<a href=\'".e_PLUGIN."euser/euser.php?id=".USERID."\'>".$userfrom."</a>".PROFILE_209."<br><br><a href=\'".e_PLUGIN."euser/euser_settings.php?page=friends&acceptadd=".USERID."\'>".PROFILE_210."</a> | <a href=\'".e_PLUGIN."euser/euser_settings.php?page=friends&rejectadd=".USERID."\'>".PROFILE_211."</a>";
							$size = strlen($msg);
							$sendpm = mysql_query("INSERT INTO ".MPREFIX."private_msg (pm_id, pm_from, pm_to, pm_sent, pm_read, pm_subject, pm_text, pm_sent_del, pm_read_del, pm_attachments, pm_option, pm_size) VALUES('', '".USERID."', '".$id."', '".intval(time())."', '0', '".PROFILE_212."', '".$msg."', '1', '0', '', '', '".intval($size)."' ) ");
						}
					} else {
						if ($break[5] == 1 && $euser_pref['fr_req_sendpm_all'] != 'on') {
							$userfrom = get_user_data(USERID);
							$userfrom = $userfrom['user_name'];
							$msg = "<a href=\'".e_PLUGIN."euser/euser.php?id=".USERID."\'>".$userfrom."</a>".PROFILE_209."<br><br><a href=\'".e_PLUGIN."euser/euser_settings.php?page=friends&acceptadd=".USERID."\'>".PROFILE_210."</a> | <a href=\'".e_PLUGIN."euser/euser_settings.php?page=friends&rejectadd=".USERID."\'>".PROFILE_211."</a>";
							$size = strlen($msg);
							$sendpm = mysql_query("INSERT INTO ".MPREFIX."private_msg (pm_id, pm_from, pm_to, pm_sent, pm_read, pm_subject, pm_text, pm_sent_del, pm_read_del, pm_attachments, pm_option, pm_size) VALUES('', '".USERID."', '".$id."', '".intval(time())."', '0', '".PROFILE_212."', '".$msg."', '1', '0', '', '', '".intval($size)."' ) ");
						}
					}
					//EMAIL TO USER
					if ($euser_pref['fr_req_sendemail'] == 'Yes') {
						if ($break[11] == 1 || !$settings[0] || $euser_pref['fr_req_sendemail_all'] == 'on') {
							$sql->mySQLresult = @mysql_query("SELECT user_email FROM ".MPREFIX."user WHERE user_id='".$id."' ");
							$useremail = $sql->db_Fetch();
							$useremail = $useremail['user_email'];
							$userfrom = get_user_data(USERID);
							$userfrom = $userfrom['user_name'];
							$oldal_url = SITEURL.$PLUGINS_DIRECTORY."euser/euser_settings.php?page=friends";
							$email_msg = "<b>".PROFILE_209b.$username."!</b><br><br>".$userfrom.PROFILE_209a.PROFILE_209c.SITENAME.PROFILE_209d."<br><br>".PROFILE_209e."<a href=".$oldal_url.">link</a>";
							require_once(e_HANDLER . "mail.php");
							sendemail($useremail, PROFILE_212, $email_msg, $username, SITEADMINEMAIL, SITENAME);
						}
					} else {
						if ($break[11] == 1 && $euser_pref['fr_req_sendemail_all'] != 'on') {
							$sql->mySQLresult = @mysql_query("SELECT user_email FROM ".MPREFIX."user WHERE user_id='".$id."' ");
							$useremail = $sql->db_Fetch();
							$useremail = $useremail['user_email'];
							$userfrom = get_user_data(USERID);
							$userfrom = $userfrom['user_name'];
							$oldal_url = SITEURL.$PLUGINS_DIRECTORY."euser/euser_settings.php?page=friends";
							$email_msg = "<b>".PROFILE_209b.$username."!</b><br><br>".$userfrom.PROFILE_209a.PROFILE_209c.SITENAME.PROFILE_209d."<br><br>".PROFILE_209e."<a href=".$oldal_url.">link</a>";
							require_once(e_HANDLER . "mail.php");
							sendemail($useremail, PROFILE_212, $email_msg, $username, SITEADMINEMAIL, SITENAME);
						}
					}
					$text .= "<br/>".PROFILE_40." ".$username." ".PROFILE_41."";
				} else {
//					$text .= "<br/><center><b>".PROFILE_42." ".$username." ".PROFILE_43."</b><br/><br/><form method='post'><input class='button' type='submit' name='add_yes' value='".PROFILE_44."' />&nbsp;<input class='button' type='submit' name='add_no' value='".PROFILE_45."' /></form></center>";
					$text = "<br/><center><b>".PROFILE_42." ".$username." ".PROFILE_43."</b><br/><br/><form method='post'><input class='button' type='submit' name='add_yes' value='".PROFILE_44."' />&nbsp;<input class='button' type='submit' name='add_no' value='".PROFILE_45."' /></form></center><br/>";
				}
			}
		} else {
//			$sql->mySQLresult = @mysql_query("SELECT user_id, user_custompage, user_simple FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
//$rows = $sql->db_Rows();
//$profile = $sql->db_Fetch();
//			$sql->mySQLresult = @mysql_query("SELECT user_id, user_custompage, user_simple FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
//			$rows = $sql->db_Rows();
			$profile = $sql->retrieve("euser", "user_id, user_custompage, user_simple", "user_id='".$id."'");
			$custompage = $profile['user_custompage'];
			$info = unserialize($custompage);
			$html .= $tp -> toHTML($custompage, true);
			$break = explode("[||]", $html);
		}
	}
        euser_tablerender($text."</div>", 0);
//		$display = $tp->parseTemplate($text, TRUE, $user_sc);
//		$ns->tablerender("",$display);
} else {
// Para quê chamar o memberlist.php, se não é chamado por mais nada???
	require_once("memberlist.php");
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
//if (!defined('e107_INIT')) { exit; }
require_once(e_PLUGIN."euser/memberlist_template.php");
require_once(e_PLUGIN."euser/memberlist_shortcodes.php");
/*
if(file_exists(e_PLUGIN."euser/languages/".e_LANGUAGE.".php")) {
	require_once(e_PLUGIN."euser/languages/".e_LANGUAGE.".php");
} else {
	require_once(e_PLUGIN."euser/languages/English.php");
}
*/
//IMAGE_alert = "<img src='images/alert.png' title='!' />";

// Uso o pref do core, o original, var $pref...
//	if (!check_class(varset($pref['memberlist_access'], 253))) {
// Uso o pref do plugin em lugar do do core, é menos confuso...
	if (!check_class($euser_pref['memberlist_access'])) {
//if (!check_class($euser_pref['memberlist_accept'])) {
	$ns->tablerender(IMAGE_alert,PROFILE_2b);
	require_once(FOOTERF);
	exit;
}

if (!$euser_pref['plug_installed']['euser']) {
	$ns->tablerender(IMAGE_alert,PROFILE_2a);
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
		$ns->tablerender(IMAGE_alert,PROFILE_2a);
		require_once(FOOTERF);
		exit;
}

$usrname  = $_GET['usrname'];
$email    = $_GET['email'];
$sort     = $_GET['sort'];
$realname = $_GET['realname'];
$loginname = $_GET['loginname'];
$groupname = $_GET['groupname'];

if(ADMIN && getperms("4")) {
	$ip_address = $_GET['ip_address'];
	$loginname = $_GET['loginname'];
} else {
	$ip_address = "";
	$loginname = "";
}

$sql->db_Select("euser_memberlist", "*");
$row = $sql->db_Fetch();
$search_settings = $row['memberlist_search'];
$columns_settings = $row['memberlist_columns'];

if($sql->db_Select("user_extended_struct", "*", "user_extended_struct_type != 0 AND user_extended_struct_text != '_system_'")) {
	while($row = $sql->db_Fetch()) {
		$search_value["".$row['user_extended_struct_id'].""] = $_GET["".$row['user_extended_struct_id'].""];
		if ($_GET["".$row['user_extended_struct_id'].""]) {
			$search_string = "".$search_string." AND user_".$row['user_extended_struct_name']." LIKE '%".$_GET["".$row['user_extended_struct_id'].""]."%'";
		}
	}
}

if ($euser_pref['memberlist_direction'] == '') {
	$profile_memberlist_direction = "user_name";
} else {
	$profile_memberlist_direction = $euser_pref['memberlist_direction'];
}

if ($euser_pref['memberlist_order'] == '') {
	$profile_memberlist_order = "ASC";
} else {
	$profile_memberlist_order = $euser_pref['memberlist_order'];
}

if ($_GET['mutat'] == "") $mutat = '30';
if (!$_GET['mutat'] == "") $mutat = intval($_GET['mutat']);
if (!$_POST['mutat'] == "") $mutat  = intval($_POST["mutat"]);

if ($_GET['direction'] == "") $direction = $profile_memberlist_direction;
if (!$_GET['direction'] == "") $direction = $_GET['direction'];
if (!$_POST['direction'] == "") $direction  = $_POST["direction"];

if ($_GET['sorrend'] == "") $sorrend = $profile_memberlist_order;
if (!$_GET['sorrend'] == "") $sorrend = $_GET['sorrend'];
if (!$_POST['sorrend'] == "") $sorrend  = $_POST["sorrend"];

if ($_GET['szures'] == "") $szures = 'all';
if (!$_GET['szures'] == "") $szures = $_GET['szures'];
if (!$_POST['szures'] == "") $szures  = $_POST["szures"];

if ($_GET['adv_spage'] == "") $adv_spage = "";
if ($_GET['adv_spage'] == "ON") $adv_spage = $_GET["adv_spage"];
if ($_POST['adv_spage'] == "ON") $adv_spage = $_POST["adv_spage"];

require_once(HEADERF);
//RATE
if ($szures != "rate_forums" && $szures != "rate_comments" && $szures != "rate_chatbox" && $szures != "rate_user" && $szures != "rate_friends" && $szures != "rate_profiles" && $szures != "rate_level") {
//RATE
	if ($adv_spage == "ON") {
	require_once(e_LANGUAGEDIR.e_LANGUAGE."/lan_user_extended.php");
		// Search form
		$text = "<div style='text-align:center'>
			<form action='".e_SELF."' method='get'>
			<table style='width:100%' class='fborder'>
			<tr>
			<td style='vertical-align:top;' colspan='2' class='fcaption'>".PROFILE_3a."</td>
			</tr>";
		// USERNAME
		if (preg_match("/\|username\|/", $search_settings)) {
		$text .="
			<tr>
			<td width='50%' class='forumheader3' style='vertical-align:top; text-align:left;'>".PROFILE_4."</td>
			<td width='50%' class='forumheader3' style='vertical-align:top; text-align:center;'>
			<input class='tbox' style='width:220px;' type='text' name='usrname' value='".$usrname."' /></td>
			</tr>";
		}
		// REALNAME
		if (preg_match("/\|realname\|/", $search_settings)) {
		$text .="
			<tr>
			<td width='50%' class='forumheader3' style='vertical-align:top; text-align:left;'>".PROFILE_372."</td>
			<td class='forumheader3' style='vertical-align:top; text-align:center;'>
			<input class='tbox' style='width:220px;' type='text' name='realname' value='".$realname."' /></td>
			</tr>";
		}
		// LOGINNAME
		if (preg_match("/\|loginname\|/", $search_settings) && (ADMIN && getperms("4"))) {
		$text .="
			<tr>
			<td width='50%' class='forumheader3' style='vertical-align:top; text-align:left;'>".PROFILE_373."</td>
			<td class='forumheader3' style='vertical-align:top; text-align:center;'>
			<input class='tbox' style='width:220px;' type='text' name='loginname' value='".$loginname."' /></td>
			</tr>";
		}
		// EMAIL
		if (preg_match("/\|email\|/", $search_settings)) {
		$text .="
			<tr>
			<td width='50%' class='forumheader3' style='vertical-align:top; text-align:left;'>".PROFILE_5.":</td>
			<td class='forumheader3' style='vertical-align:top; text-align:center;'>
			<input class='tbox' style='width:220px;' type='text' name='email' value='".$email."' /></td>
			</tr>";
		}
		if($sql->db_Select("user_extended_struct", "*", "user_extended_struct_type != 0 AND user_extended_struct_text != '_system_'")) {
			while($row = $sql->db_Fetch()) {
				$pmatch = "/\|s_".$row['user_extended_struct_id']."\|/";
				$row_user_extended_struct_id = $row['user_extended_struct_id'];
				$row_user_extended_struct_name = "user_".$row['user_extended_struct_name']."";
				if (preg_match($pmatch, $search_settings)) {
					$user_extended_struct_text = ($tp->toHtml($row['user_extended_struct_text'],FALSE,"defs"))."";
					if ( $row['user_extended_struct_type'] != 2 && $row['user_extended_struct_type'] != 3 && $row['user_extended_struct_type'] != 4) {
						$text .= "
						<tr>
						<td width='50%' class='forumheader3' style='vertical-align:top; text-align:left;'>".$user_extended_struct_text.":</td>
						<td class='forumheader3' style='vertical-align:top; text-align:center;'>
						<input class='tbox' style='width:220px;' type='text' name='".$row['user_extended_struct_id']."' value='".$search_value["".$row['user_extended_struct_id'].""]."' /></td>
						</tr>";
					}
					if ($row['user_extended_struct_type'] == 2 || $row['user_extended_struct_type'] == 3) {
						$ext_stuct_db = explode(",", $row['user_extended_struct_values']);
						$text .= "
							<tr>
							<td width='50%' class='forumheader3' style='vertical-align:top; text-align:left;'>".$user_extended_struct_text.":</td>
							<td class='forumheader3' style='vertical-align:top; text-align:center;'>
							<select name='".$row['user_extended_struct_id']."' class='tbox' style='width:225px'>
							<option value='' selected='selected'></option>";
						foreach ($ext_stuct_db as $ext_stuct_db_item) {
							$user_extended_have_db = new db;
							$user_extended_have = $user_extended_have_db->db_Count("user_extended", "(*)", "where ".$row_user_extended_struct_name." = '$ext_stuct_db_item' LIMIT 1");
							if($user_extended_have > 0) {
								$text .= "".
								($search_value["".$row['user_extended_struct_id'].""]  == $ext_stuct_db_item ? "<option value='".$ext_stuct_db_item."' selected='selected'>".$ext_stuct_db_item."</option>" : "<option value='".$ext_stuct_db_item."'>".$ext_stuct_db_item."</option>")."";
							}
						}
						$text .= "
						</select></td>
						</tr>";
					}
					if ($row['user_extended_struct_type'] == 4) {
						$ext_stuct_db = explode(",", $row['user_extended_struct_values']);
						$text .= "
							<tr>
							<td width='50%' class='forumheader3' style='vertical-align:top; text-align:left;'>".$user_extended_struct_text.":</td>
							<td class='forumheader3' style='vertical-align:top; text-align:center;'>
							<select name='".$row['user_extended_struct_id']."' class='tbox' style='width:225px' >
							<option value='' selected='selected'></option>";
						$ext_sruct_table_type = new db;
						$ext_sruct_table_type->db_Select("".$ext_stuct_db[0]."", "*", "".$ext_stuct_db[1]."!='' ORDER BY ".$ext_stuct_db[3]."");
						while($row = $ext_sruct_table_type->db_Fetch()) {
							$ext_stuct_db_item = $row[$ext_stuct_db[1]];
							$ext_stuct_db_item_2 = $row[$ext_stuct_db[2]];
							$user_extended_have_db1 = new db;
							$user_extended_have1 = $user_extended_have_db1->db_Count("user_extended", "(*)", "where ".$row_user_extended_struct_name." = '$ext_stuct_db_item' LIMIT 1");
							if($user_extended_have1 > 0) {
								$text .= "".
								($search_value["".$row_user_extended_struct_id.""]  == $ext_stuct_db_item ? "<option value='".$ext_stuct_db_item."' selected='selected'>".$ext_stuct_db_item_2."</option>" : "<option value='".$ext_stuct_db_item."'>".$ext_stuct_db_item_2."</option>")."";
							}
						}
						$text .= "
						</select></td>
						</tr>";
					}
				}
			}
		}
		// IP ADDRESS
		if (preg_match("/\|ip_address\|/", $search_settings) && (ADMIN && getperms("4"))) {
		$text .="
			<tr>
			<td width='50%' class='forumheader3' style='vertical-align:top; text-align:left;'>".PROFILE_374."</td>
			<td class='forumheader3' style='vertical-align:top; text-align:center;'>
			<input class='tbox' style='width:220px;' type='text' name='ip_address' value='".$ip_address."' /></td>
			</tr>";
		}
		if (preg_match("/\|groupname\|/", $search_settings) && USER) {
		require_once(e_HANDLER."userclass_class.php");
		$text .="
			<tr>
			<td width='50%' class='forumheader3' style='vertical-align:top; text-align:left;'>".PROFILE_418."</td>
			<td class='forumheader3' style='vertical-align:top; text-align:center;'>
			".r_userclass('groupname',$groupname,"off","public,admin,classes")."</td>
			</tr>";
		}
		$text .="
			<td class='fcaption' style='vertical-align:top; text-align:center;' colspan='2'>
			<input class='button' type='submit' value='".PROFILE_220."' />
			<input type='hidden' name='direction' value='".$direction."'>
			<input type='hidden' name='adv_spage' value='ON'>
			<input type='hidden' name='mutat' value='".$mutat."'>
			<input type='hidden' name='szures' value='".$szures."'>
			</td>
			</tr>
			</table></form></div>";
	} else {
		// Search form
		$text = "<div style='text-align:center'>
			<form action='".e_SELF."' method='get'>
			<table style='width:100%' class='fborder'>
			<tr>
			<td style='vertical-align:top;' colspan='2' class='fcaption'>".PROFILE_3."</td>
			</tr>";
		// USERNAME
		$text .="
			<tr>
			<td width='50%' class='forumheader3' style='vertical-align:top; text-align:left;'>".PROFILE_4."</td>
			<td width='50%' class='forumheader3' style='vertical-align:top; text-align:center;'>
			<input class='tbox' style='width:220px;' type='text' name='usrname' value='".$usrname."' /></td>
			</tr>";
		// EMAIL
		$text .="
			<tr>
			<td width='50%' class='forumheader3' style='vertical-align:top; text-align:left;'>".PROFILE_5."</td>
			<td class='forumheader3' style='vertical-align:top; text-align:center;'>
			<input class='tbox' style='width:220px;' type='text' name='email' value='".$email."' /></td>
			</tr>
			<tr>";
		$search_colspan = " colspan='2'";
		
		if ($euser_pref['member_ext_search'] == "Yes") {
			$search_colspan = "";
			$text .="
				<td class='fcaption' style='vertical-align:top; text-align:left;'>
				<input class='button'  type='button' value='".PROFILE_371."' onclick = \"location.href='".e_SELF."?".e_QUERY."&adv_spage=ON'\">
				</td>";
		}
		$text .="
			<td style='text-align:center'; ".$search_colspan." class='fcaption'>
			<input class='button' type='submit' value='".PROFILE_220."' />
			<input type='hidden' name='direction' value='".$direction."'>
			<input type='hidden' name='mutat' value='".$mutat."'>
			<input type='hidden' name='szures' value='".$szures."'>
			</td>
			</tr>
			</table></form></div>";
	}
	
	// Paraser - Part 1
	if($sort=="") {
		$records = $mutat;
		$from = 0;
	} else {
		$qs = explode(".", $sort);
		$from = intval($qs[0]);
		$records = intval($qs[1]);
	}
	// Get variables
	$pusr  = ('1'  ? 'usrname='.$usrname.'&':'');
	$prealname  = ('1'  ? 'realname='.$realname.'&':'');
	$ploginname  = ('1'  ? 'loginname='.$loginname.'&':'');
	$pemail  = ('1'  ? 'email='.$email.'&':'');
	$pgroupname  = ('1'  ? 'groupname='.$groupname.'&':'');
	$pip_address  = ('1'  ? 'ip_address='.$ip_address.'&':'');
	$pmutat = ('1'  ? 'mutat='.$mutat.'&':'');
	$pdirection = ('1'  ? 'direction='.$direction.'&':'');
	$psorrend = ('1'  ? 'sorrend='.$sorrend.'&':'');
	$pszures = ('1'  ? 'szures='.$szures.'&':'');
	$psort = 'sort=[FROM].'.$records;
	$padv_spage = ('1'  ? 'adv_spage='.$adv_spage.'&':'');
	$parase = $pusr.$prealname.$ploginname.$pemail.$pgroupname.$ip_address.$pmutat.$pdirection.$psorrend.$pszures.$padv_spage.$psort;
	
	// Search query parts
	$qusrname = "";
	if($usrname && $usrname!=="") {
		$qusrname =" AND user_name LIKE '%".$tp->toDB($usrname)."%'";
	}
	if($realname && $realname!=="") {
		$qrealname =" AND user_login LIKE '%".$tp->toDB($realname)."%'";
	}
	if($loginname && $loginname!=="") {
		$qloginname =" AND user_loginname LIKE '%".$tp->toDB($loginname)."%'";
	}
	if($email && $email!=="") {
		$qemail =" AND user_email LIKE '%".$tp->toDB($email)."%'";
	}
	if($ip_address && $ip_address!=="") {
		$qip_address =" AND user_ip LIKE '%".$tp->toDB($ip_address)."%'";
	}
	if($groupname== "254") {
		$qgroupname =" AND user_admin = 1";
	}
	elseif($groupname && $groupname!== "253") {
		$qgroupname =" AND user_class = ".$tp->toDB($groupname)."";
	}
	$search_string = $qusrname.$qrealname.$qloginname.$qemail.$qgroupname.$qip_address.$search_string;
// RATE
}
if (($szures == "rate_forums" && $euser_pref['top_forums'] != "ON") || ($szures == "rate_comments" && $euser_pref['top_comments'] != "ON") || ($szures == "rate_chatbox" && $euser_pref['top_chatbox'] != "ON") || ($szures == "rate_user" && $euser_pref['top_rate'] != "ON") || ($szures == "rate_friends" && $euser_pref['top_friends'] != "ON") || ($szures == "rate_profiles" && $euser_pref['top_profile'] != "ON") || ($szures == "rate_level" && $euser_pref['top_level'] != "ON")) {
		$ns->tablerender(IMAGE_alert,PROFILE_2a);
		require_once(FOOTERF);
		exit;
}

//RATE
$sql_codes = array(SELECT,INSERT,INTO,WHERE,DISTINCT,UPDATE,DELETE,TRUNCATE,TABLE,ORDER,JOIN,UNION,CONCAT,FROM);

$count = 0;
foreach($sql_codes as $sql_code) {
	if (preg_match("/".$sql_code."/i", $search_string)) {
		echo $sql_code;
		echo ", ";
echo "<br/>";
		$count++;
	}
}
if ($count >= 2) {
		$ns->tablerender(IMAGE_alert,PROFILE_2a);
		require_once(FOOTERF);
		exit;
}

//RATE
if ($szures != "rate_forums" && $szures != "rate_comments" && $szures != "rate_chatbox" && $szures != "rate_user" && $szures != "rate_friends" && $szures != "rate_profiles" && $szures != "rate_level") {
//RATE

	// Search query
	// ALL
	if ($szures == "all") {
		$qry_rows ="
			SELECT u.*, ue.*
			FROM #user AS u
			LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
			WHERE user_ban = '0' ".$search_string."
			ORDER by $direction $sorrend";
		$sql->db_Select_gen($qry_rows);
		$found = $sql->db_rows();
	}
	// Search query
	// PIC LIMIT
	if ($szures == "pic") {
		$qry_rows ="
			SELECT u.*, ue.*
			FROM #user AS u
			LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
			WHERE user_ban = '0' ".$search_string."
			ORDER by $direction $sorrend";
		$sql->db_Select_gen($qry_rows);
		if($sql->db_rows() > 0) {
			$picuser_id ="|";
			while($row=$sql->db_Fetch()) {
				$picdir = "userimages/".$row[user_id]."/";
				if ($hndDir = opendir($picdir)){
					$intCount = 0;
					while (false !== ($strFilename = readdir($hndDir))){
						if ($strFilename != "." && $strFilename != ".." && $strFilename != "index.htm" && $strFilename != "thumbs"){
							$intCount++;
							$picuser_id = "".$picuser_id."".$row[user_id]."|";
						}
						if ($intCount > 0) break;
					}
					closedir($hndDir);
				} else {
					$intCount = -1;
				}
			}
		}
		$picuser_id = explode("|", $picuser_id);
		global $picuser_id;
		$found = count($picuser_id) - 2;
	}
	// Search query
	// COMMENT LIMIT
	if ($szures == "comm") {
		$qry_rows ="
			SELECT u.*, ue.*, ap.*
			FROM #user AS u
			LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
			LEFT JOIN #euser_com AS ap ON ap.com_to=u.user_id
			WHERE user_ban = '0' AND com_type = 'prof' GROUP BY u.user_id ".$search_string."
			ORDER by $direction $sorrend";
		$sql->db_Select_gen($qry_rows);
		$found = $sql->db_rows();
	}
	// Search query
	// VIDEO LIMIT
	if ($szures == "vid") {
		$qry_rows ="
			SELECT u.*, ue.*, ap.*
			FROM #user AS u
			LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
			LEFT JOIN #euser_vids AS ap ON ap.vid_uid=u.user_id
			WHERE user_ban = '0' AND vid_id != '' GROUP BY u.user_id ".$search_string."
			ORDER by $direction $sorrend";
		$sql->db_Select_gen($qry_rows);
		$found = $sql->db_rows();
	}
	// Search query
	// AUDIO LIMIT
	if ($szures == "mp3") {
		$qry_rows ="
			SELECT u.*, ue.*, ap.*
			FROM #user AS u
			LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
			LEFT JOIN #euser AS ap ON ap.user_id=u.user_id
			WHERE user_ban = '0' AND user_mp3 != '' GROUP BY u.user_id ".$search_string."
			ORDER by $direction $sorrend";
		$sql->db_Select_gen($qry_rows);
		$found = $sql->db_rows();
	}
	
	// FORUM LIMIT
	if ($szures == "forum") {
		$qry_rows ="
			SELECT u.*, ue.*
			FROM #user AS u
			LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
			WHERE user_ban = '0' AND user_forums != '0' ".$search_string."
			ORDER by $direction $sorrend";
		$sql->db_Select_gen($qry_rows);
		$found = $sql->db_rows();
	}
	
	//COMMENT_1 LIMIT
	if ($szures == "comment_1") {
		$qry_rows ="
			SELECT u.*, ue.*
			FROM #user AS u
			LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
			WHERE user_ban = '0' AND user_comments != '0' ".$search_string."
			ORDER by $direction $sorrend";
		$sql->db_Select_gen($qry_rows);
		$found = $sql->db_rows();
	}
	
	// ALL
	if ($szures == "all") {
		$qry ="
			SELECT u.*, ue.*
			FROM #user AS u
			LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
			WHERE user_ban = '0' ".$search_string."
			ORDER by $direction $sorrend
			LIMIT $from,$records";
	}
	// COMMENT LIMIT
	if ($szures == "comm") {
		$qry ="
			SELECT u.*, ue.*, ap.*
			FROM #user AS u
			LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
			LEFT JOIN #euser_com AS ap ON ap.com_to=u.user_id
			WHERE user_ban = '0' AND com_type = 'prof' GROUP BY u.user_id ".$search_string."
			ORDER by $direction $sorrend
			LIMIT $from,$records";
	}
	// PIC LIMIT
	if ($szures == "pic") {
		if ($picuser_id[1] != '') {
			$i=$from + 1;
			$picuser_string = "user_id='".$picuser_id[$i]."'";
			while ($i <= $from + $records -1) {
				if ($picuser_id[$i+1] =="") {
					break;
				}
				$picuser_string = "".$picuser_string." or user_id='".$picuser_id[$i+1]."'";
				$i++;
			}
			$qry ="
				SELECT u.*, ue.*
				FROM #user AS u
				LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
				WHERE user_ban = '0' AND $picuser_string ".$search_string."
				ORDER by $direction $sorrend";
		}
	}
	// VIDEO LIMIT
	if ($szures == "vid") {
		$qry ="
			SELECT u.*, ue.*, ap.*
			FROM #user AS u
			LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
			LEFT JOIN #euser_vids AS ap ON ap.vid_uid=u.user_id
			WHERE user_ban = '0' AND vid_id != '' GROUP BY u.user_id ".$search_string."
			ORDER by $direction $sorrend
			LIMIT $from,$records";
	}
	
	// AUDIO LIMIT
	if ($szures == "mp3") {
		$qry ="
			SELECT u.*, ue.*, ap.*
			FROM #user AS u
			LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
			RIGHT JOIN #euser AS ap ON ap.user_id=u.user_id
			WHERE user_ban = '0' AND user_mp3 != '' ".$search_string."
			ORDER by $direction $sorrend
			LIMIT $from,$records";
	}
	
	// FORUM LIMIT
	if ($szures == "forum") {
		$qry ="
			SELECT u.*, ue.*
			FROM #user AS u
			LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
			WHERE user_ban = '0' AND user_forums != '0' ".$search_string."
			ORDER by $direction $sorrend
			LIMIT $from,$records";
	}
	
	//COMMENT_1 LIMIT
	if ($szures == "comment_1") {
		$qry ="
			SELECT u.*, ue.*
			FROM #user AS u
			LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
			WHERE user_ban = '0' AND user_comments != '0' ".$search_string."
			ORDER by $direction $sorrend
			LIMIT $from,$records";
	}
//RATE
}
//RATE
$top_x = $euser_pref['top_x'];
if ($euser_pref['top_noadmin'] == "No") {
	$profile_top_noadmin = "AND user_admin !=1";
}
if ($top_x < 1 || $top_x > 200) $top_x = 20;
if ($szures == "rate_forums") {
	$qry ="
		SELECT u.*, ue.*
		FROM #user AS u
		LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
		WHERE user_ban = '0' AND user_forums >= '1' ".$profile_top_noadmin."
		ORDER by user_forums DESC, user_visits DESC
		LIMIT $top_x";
}

if ($szures == "rate_level") {
	$qry ="
		SELECT u.*, ue.*
		FROM #user AS u
		LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
		WHERE user_ban = '0' ".$profile_top_noadmin."
		ORDER by ((user_forums * 5) + (user_comments * 5) + (user_chats * 2) + user_visits)/4 DESC, user_visits DESC
		LIMIT $top_x";
}

if ($szures == "rate_comments") {
	$qry ="
		SELECT u.*, ue.*
		FROM #user AS u
		LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
		WHERE user_ban = '0' AND user_comments >= '1' ".$profile_top_noadmin."
		ORDER by user_comments DESC, user_visits DESC
		LIMIT $top_x";
}

if ($szures == "rate_chatbox") {
	$qry ="
		SELECT u.*, ue.*
		FROM #user AS u
		LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
		WHERE user_ban = '0' AND user_chats >= '1' ".$profile_top_noadmin."
		ORDER by user_chats DESC, user_visits DESC
		LIMIT $top_x";
}

if ($szures == "rate_profiles") {
	$qry ="
		SELECT u.*, ap.*
		FROM #user AS u
		LEFT JOIN #euser AS ap ON ap.user_id=u.user_id
		LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
		WHERE user_ban = '0' AND user_totalviews >= '1' ".$profile_top_noadmin."
		ORDER by user_totalviews DESC, user_visits DESC
		LIMIT $top_x";
}

if ($szures == "rate_user") {
	$qry ="
		SELECT u.*, ra.*
		FROM #user AS u
		LEFT JOIN #rate AS ra ON ra.rate_itemid=u.user_id
		LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
		WHERE user_ban = '0' AND rate_table >= 'user' ".$profile_top_noadmin."
		ORDER by rate_rating/rate_votes DESC, user_visits DESC
		LIMIT $top_x";
}

if ($szures == "rate_friends") {
	$qry ="
		SELECT u.*, ap.*
		FROM #user AS u
		LEFT JOIN #euser AS ap ON ap.user_id=u.user_id
		LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
		WHERE user_ban = '0' AND user_friends != '' AND user_friends !='|' ".$profile_top_noadmin."
		ORDER by CHAR_LENGTH(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(user_friends, '0', ''), '1', ''), '2', ''), '3', ''), '4', ''), '5', ''), '6', ''), '7', ''), '8', ''), '9', '')) DESC, user_visits DESC
		LIMIT $top_x";
}

$sql->db_Select_gen($qry);

//RATE
if ($szures != "rate_forums" && $szures != "rate_comments" && $szures != "rate_chatbox" && $szures != "rate_user" && $szures != "rate_friends" && $szures != "rate_profiles" && $szures != "rate_level") {
//RATE
	if($sql->db_rows()==0) {
		$results = "
		<table style='width:100%' class='fborder'>
		<tr>
		<td class='forumheader3' style='text-align:center'><b>".PROFILE_6."</b></td>
		</tr>
		</table>";
	} else {
		$results = "";
	}
	
	if($found==0) {
		$found ='0';
	}
	if(e_QUERY=="") {
		$text .= "<br/><div style='text-align:center;'>".PROFILE_7." ".$found."</div><br/>";
	} else {
		$text .= "<br/><div style='text-align:center;'>".PROFILE_8." ".$found."</div><br/>";
	}
	$text .= "<div style='text-align:center'>
		<form method='post' action='".e_SELF."?".e_QUERY."'>
		<table class='fborder' width = '100%'>
		<tr>
		<td colspan='7' style='text-align:center' class='forumheader'>";
	if (check_class($euser_pref['top_class'])) {
		if ($euser_pref['top_level'] == "ON") {
			$top_link = "rate_level";
		}else if ($euser_pref['top_forums'] == "ON") {
			$top_link = "rate_forums";
		}else if ($euser_pref['top_comments'] == "ON") {
			$top_link = "rate_comments";
		}else if ($euser_pref['top_chatbox'] == "ON") {
			$top_link = "rate_chatbox";
		}else if ($euser_pref['top_rate'] == "ON") {
			$top_link = "rate_user";
		}else if ($euser_pref['top_profile'] == "ON") {
			$top_link = "rate_profiles";
		}else if ($euser_pref['top_friends'] == "ON") {
			$top_link = "rate_friends";
		}else {
			$top_link = "";
		}
		if ($top_link != "") {
			$text .= "<div style='text-align:left;'><a href='euser.php?szures=".$top_link."'><img src='".e_PLUGIN."euser/images/friends.png' style='border: 0px solid black; width: 24px; height: 24px; float: left;' title='".PROFILE_384."' /></a></div>";
		}
	}
		if ($sort == "") {
		$text .= "<span class='defaulttext'>".PROFILE_266."</span>
		<select name='mutat' class='tbox'>".
			($mutat  == "10" ? "<option value='10' selected='selected'>10</option>" : "<option value='10'>10</option>").
			($mutat  == "30" ? "<option value='30' selected='selected'>30</option>" : "<option value='30'>30</option>").
			($mutat  == "50" ? "<option value='50' selected='selected'>50</option>" : "<option value='50'>50</option>").
			($mutat  == "70" ? "<option value='70' selected='selected'>70</option>" : "<option value='70'>70</option>")."
		</select>
		&nbsp;";
		}
		if (check_class($euser_pref['memberlist_filter']) && (($euser_pref['commentson'] == "ON") || ($euser_pref['pics'] == "ON") || ($euser_pref['videos'] == "ON") || ($euser_pref['mp3enabled'] == "ON")) ) {
			if ($sort == "") {
				$text .= "&nbsp;&nbsp;
				<span class='defaulttext'>".PROFILE_339."</span>
				<select name='szures' class='tbox'>".
					($szures == "all" ? "<option value='all' selected='selected'>".PROFILE_340."</option>" : "<option value='all'>".PROFILE_340."</option>")."";
					$text .= ($szures == "forum" ? "<option value='forum' selected='selected'>".PROFILE_365."</option>" : "<option value='forum'>".PROFILE_365."</option>")."";
					$text .= ($szures == "comment_1" ? "<option value='comment_1' selected='selected'>".PROFILE_366."</option>" : "<option value='comment_1'>".PROFILE_366."</option>")."";
					if ($euser_pref['commentson'] == "ON") {
						$text .= ($szures == "comm" ? "<option value='comm' selected='selected'>".PROFILE_341."</option>" : "<option value='comm'>".PROFILE_341."</option>")."";
					}
					if ($euser_pref['pics'] == "ON") {
						$text .= ($szures == "pic" ? "<option value='pic' selected='selected'>".PROFILE_342."</option>" : "<option value='pic'>".PROFILE_342."</option>")."";
					}
					if ($euser_pref['videos'] == "ON") {
						$text .= ($szures == "vid" ? "<option value='vid' selected='selected'>".PROFILE_343."</option>" : "<option value='vid'>".PROFILE_343."</option>")."";
					}
					if ($euser_pref['mp3enabled'] == "ON") {
						$text .= ($szures == "mp3" ? "<option value='mp3' selected='selected'>".PROFILE_344."</option>" : "<option value='mp3'>".PROFILE_344."</option>")."";
					}
				$text .= "</select>&nbsp;";
			}
		}
		if ($sort == "") {
			$text .= "<input type='hidden' name='direction' value='".$direction."'><input class='button' type='submit' value='".PROFILE_265."' />";
		} else {
			$text .= "<input class='button'  type='button' value='".PROFILE_375."' onclick = \"location.href='".e_SELF."'\">";
		}
			$text .= "</td></tr></table></form>";

		if ($euser_pref['memberlist_bcard'] == "line" || $euser_pref['memberlist_bcard'] == "" ) {
			$text .= "<table style='width:100%' class='fborder'><tr>";
			if ($euser_pref['memberlist_class']) {
				$profile_memberlist_class = $euser_pref['memberlist_class'];
			} else {
				$profile_memberlist_class = "button";
			}
			if ($euser_pref['memberlist_color_up']) {
				$up_pic =" style='color: #".$euser_pref['memberlist_color_up']."'";
			}
			if ($euser_pref['memberlist_color_down']) {
				$down_pic =" style='color: #".$euser_pref['memberlist_color_down']."'";
			}
			if ($euser_pref['memberlist_column_avatar'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><center><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_id'>";
				if ($sorrend == "ASC" && $direction == "user_id") {	$ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_id") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
				$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_4a."' /></center></form></td>";
			}
			if ($euser_pref['memberlist_column_online'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_name'>";
				if ($sorrend == "ASC" && $direction == "user_name") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_name") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_4."' /></form></td>";
			}
			if ($euser_pref['memberlist_column_realname'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_login'>";
				if ($sorrend == "ASC" && $direction == "user_login") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_login") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_367."' /></form></td>";
			}
			if ($euser_pref['memberlist_column_loginname'] != "OFF" && (ADMIN && getperms("4"))) {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_loginname'>";
				if ($sorrend == "ASC" && $direction == "user_loginname") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_loginname") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_370."' /></form></td>";
			}
			if ($euser_pref['memberlist_column_email'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_email'>";
				if ($sorrend == "ASC" && $direction == "user_email") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_email") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_5."' /></form></td>";
			}
			if ($euser_pref['memberlist_column_join'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_join'>";
				if ($sorrend == "ASC" && $direction == "user_join") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_join") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_9."' /></form></td>";
			}
			if ($euser_pref['memberlist_column_lastvisit'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_currentvisit'>";
				if ($sorrend == "ASC" && $direction == "user_currentvisit") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_currentvisit") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_9a."' /></form></td>";
			}
			if ($euser_pref['memberlist_column_visits'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_visits'>";
				if ($sorrend == "ASC" && $direction == "user_visits") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_visits") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_9b."' /></form></td>";
			}
			if ($euser_pref['memberlist_column_timezone'] != "OFF" && (ADMIN && getperms("4"))) {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_timezone'>";
				if ($sorrend == "ASC" && $direction == "user_timezone") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_timezone") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_368."' /></form></td>";
			}
			if ($euser_pref['memberlist_column_userip'] != "OFF" && (ADMIN && getperms("4"))) {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_ip'>";
				if ($sorrend == "ASC" && $direction == "user_ip") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_ip") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_369."' /></form></td>";
			}
			$memberlist_extended_column = new db;
			if($memberlist_extended_column->db_Select("user_extended_struct", "*", "user_extended_struct_type != 0 AND user_extended_struct_text != '_system_'")) {
				require_once(e_LANGUAGEDIR.e_LANGUAGE."/lan_user_extended.php");
				while($row = $memberlist_extended_column->db_Fetch()) {
					$user_extended_struct_text = ($tp->toHtml($row['user_extended_struct_text'],FALSE,"defs"))."";
					$user_extended_struct_name = $row['user_extended_struct_name'];
					$pmatch = "/\|c_".$row['user_extended_struct_id']."\|/";
					if (preg_match($pmatch, $columns_settings)) {
						$ord = "";
						$ord_color = "";
						$text .= "
						<td class='fcaption' style='width:20%'><form method='post' action='".e_SELF."?".e_QUERY."'>
						<input type='hidden' name='direction' value='user_".$user_extended_struct_name."'>";
						if ($sorrend == "ASC" && $direction == "user_".$user_extended_struct_name."") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_".$user_extended_struct_name."") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
						$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".$user_extended_struct_text."' />
						</form></td>";
					}
				}
			}
			$text .= "</form></tr>";
			while($row=$sql->db_Fetch()) {
				$text .= renderuser($row, "short");
			}
		} else {
			$text .= "<table style='width:100%' class='fborder'><tr>";
			if ($euser_pref['memberlist_class']) {
				$profile_memberlist_class = $euser_pref['memberlist_class'];
			} else {
				$profile_memberlist_class = "button";
			}
			if ($euser_pref['memberlist_color_up']) {
				$up_pic =" style='color: #".$euser_pref['memberlist_color_up']."'";
			}
			if ($euser_pref['memberlist_color_down']) {
				$down_pic =" style='color: #".$euser_pref['memberlist_color_down']."'";
			}
			if ($euser_pref['memberlist_column_online'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_name'>";
				if ($sorrend == "ASC" && $direction == "user_name") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_name") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_4."' /></form></td>";
			}
			if ($euser_pref['memberlist_column_realname'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_login'>";
				if ($sorrend == "ASC" && $direction == "user_login") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_login") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_367."' /></form></td>";
			}
			if ($euser_pref['memberlist_column_loginname'] != "OFF" && (ADMIN && getperms("4"))) {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_loginname'>";
				if ($sorrend == "ASC" && $direction == "user_loginname") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_loginname") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_370."' /></form></td>";
			}
			if ($euser_pref['memberlist_column_email'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_email'>";
				if ($sorrend == "ASC" && $direction == "user_email") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_email") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_5."' /></form></td>";
			}
			if ($euser_pref['memberlist_column_join'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_join'>";
				if ($sorrend == "ASC" && $direction == "user_join") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_join") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_9."' /></form></td>";
			}
			if ($euser_pref['memberlist_column_lastvisit'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_currentvisit'>";
				if ($sorrend == "ASC" && $direction == "user_currentvisit") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_currentvisit") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_9a."' /></form></td>";
			}
			if ($euser_pref['memberlist_column_visits'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_visits'>";
				if ($sorrend == "ASC" && $direction == "user_visits") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_visits") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_9b."' /></form></td>";
			}
			if ($euser_pref['memberlist_column_timezone'] != "OFF" && (ADMIN && getperms("4"))) {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_timezone'>";
				if ($sorrend == "ASC" && $direction == "user_timezone") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_timezone") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_368."' /></form></td>";
			}
			if ($euser_pref['memberlist_column_userip'] != "OFF" && (ADMIN && getperms("4"))) {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_ip'>";
				if ($sorrend == "ASC" && $direction == "user_ip") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_ip") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_369."' /></form></td>";
			}
			$memberlist_extended_column = new db;
			if($memberlist_extended_column->db_Select("user_extended_struct", "*", "user_extended_struct_type != 0 AND user_extended_struct_text != '_system_'")) {
				require_once(e_LANGUAGEDIR.e_LANGUAGE."/lan_user_extended.php");
				while($row = $memberlist_extended_column->db_Fetch()) {
					$user_extended_struct_text = ($tp->toHtml($row['user_extended_struct_text'],FALSE,"defs"))."";
					$user_extended_struct_name = $row['user_extended_struct_name'];
					$pmatch = "/\|c_".$row['user_extended_struct_id']."\|/";
					if (preg_match($pmatch, $columns_settings)) {
						$ord = "";
						$ord_color = "";
						$text .= "
						<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
						<input type='hidden' name='direction' value='user_".$user_extended_struct_name."'>";
						if ($sorrend == "ASC" && $direction == "user_".$user_extended_struct_name."") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_".$user_extended_struct_name."") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
						$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".$user_extended_struct_text."' />
						</form></td>";
					}
				}
			}
			$text .= "</form></tr></table>";
			$euser_pref['bcard_css'] == "" ? $bcard_css = "lite" : $bcard_css = $euser_pref['bcard_css'];
			$euser_pref['bcard_css'] == "auto" ? $bcard_css = IMODE : $bcard_css = $bcard_css;
			if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) {
				echo "<link href='css/card_".$bcard_css."_ie.css' rel='stylesheet' type='text/css'>";
			} else {
				echo "<link href='css/card_".$bcard_css.".css' rel='stylesheet' type='text/css'>";
			}
			$text .= "<table id='card_table'><tr>";
			if ($euser_pref['bcard_column'] == '') {
				$userlist_column = '3';
			} elseif ($euser_pref['bcard_column'] > '8') {
				$userlist_column = '8';
			} else {
				$userlist_column = $euser_pref['bcard_column'];
			}
			$userlist_num=1;
			$text .= "<tr>";
			while($row=$sql->db_Fetch()) {
				$text .= renderuser($row, "short");
				$userlist_num++;
				if ($userlist_num == $userlist_column +1) {
					$text .= "</tr>";
					$userlist_num = 1;
				}
			}
			$text .= "</td></tr>";
		}
	$text .= "</table>\n</div>";
	$text .= $results;
	$ns->tablerender("".PROFILE_10."", $text);
//RATE
} else {
if (!check_class($euser_pref['top_class'])) {
	$ns->tablerender(IMAGE_alert,PROFILE_385);
	require_once(FOOTERF);
	exit;
}
//RATE

	if($sql->db_rows()==0) {
		$results = "
		<table style='width:100%' class='fborder'>
		<tr>
		<td class='forumheader3' style='text-align:center'><b>".PROFILE_6."</b></td>
		</tr>
		</table>";
	} else {
		$results = "";
	}
	if($euser_pref['stats'] =="ON" && $euser_pref['top_level'] == "ON"){
		if ($szures == "rate_level") {
			$text .= "<img src='images/green.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		} else {
			$text .= "<img src='images/gray.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		}
		$text .= "<a href='".e_PLUGIN."euser/euser.php?szures=rate_level'>".PROFILE_391."</a><br/>";
	}
	if($euser_pref['top_forums'] == "ON"){
		if ($szures == "rate_forums") {
			$text .= "<img src='images/green.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		} else {
			$text .= "<img src='images/gray.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		}
		$text .= "<a href='".e_PLUGIN."euser/euser.php?szures=rate_forums'>".PROFILE_388."</a><br/>";
	}
	if(!$euser_pref['comments_disabled'] && $euser_pref['top_comments'] == "ON"){
		if ($szures == "rate_comments") {
			$text .= "<img src='images/green.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		} else {
			$text .= "<img src='images/gray.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		}
		$text .= "<a href='".e_PLUGIN."euser/euser.php?szures=rate_comments'>".PROFILE_387."</a><br/>";
	}
	if($euser_pref['top_chatbox'] == "ON"){
		if ($szures == "rate_chatbox") {
			$text .= "<img src='images/green.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		} else {
			$text .= "<img src='images/gray.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		}
		$text .= "<a href='".e_PLUGIN."euser/euser.php?szures=rate_chatbox'>".PROFILE_393."</a><br/>";
	}
	if($euser_pref['rate'] && $euser_pref['top_rate'] == "ON"){
		if ($szures == "rate_user") {
			$text .= "<img src='images/green.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		} else {
			$text .= "<img src='images/gray.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		}
		$text .= "<a href='".e_PLUGIN."euser/euser.php?szures=rate_user'>".PROFILE_377."</a><br/>";
	}
	if($euser_pref['stats'] =="ON" && $euser_pref['top_profile'] == "ON"){
		if ($szures == "rate_profiles") {
			$text .= "<img src='images/green.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		} else {
			$text .= "<img src='images/gray.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		}
		$text .= "<a href='".e_PLUGIN."euser/euser.php?szures=rate_profiles'>".PROFILE_378."</a><br/>";
	}
	if ($euser_pref['friends'] == "ON" && $euser_pref['top_friends'] == "ON") {
		if ($szures == "rate_friends") {
			$text .= "<img src='images/green.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		} else {
			$text .= "<img src='images/gray.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		}
		$text .= "<a href='".e_PLUGIN."euser/euser.php?szures=rate_friends'>".PROFILE_379."</a><br/>";
	}
	$text .= "<br/><br/><table width='100%'><tr>";
	$text .= "<td colspan= 3 class='forumheader'>".PROFILE_380.$euser_pref['top_x']."</td>";
	$text .= "</tr>";
	if ($euser_pref['memberlist_bcard'] == "line" || $euser_pref['memberlist_bcard'] == "" ) {
		while($row=$sql->db_Fetch()) {
			$text .= renderuser($row, "short");
		}
	} else {
			$euser_pref['bcard_css'] == "" ? $bcard_css = "lite" : $bcard_css = $euser_pref['bcard_css'];
			$euser_pref['bcard_css'] == "auto" ? $bcard_css = IMODE : $bcard_css = $bcard_css;
			if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) {
				echo "<link href='css/card_".$bcard_css."_ie.css' rel='stylesheet' type='text/css'>";
			} else {
				echo "<link href='css/card_".$bcard_css.".css' rel='stylesheet' type='text/css'>";
			}
			$text .= "<table id='card_table'><tr>";
			if ($euser_pref['top_bcard_column'] == '') {
				$userlist_top_column = '1';
			} elseif ($euser_pref['top_bcard_column'] > '8') {
				$userlist_top_column = '8';
			} else {
				$userlist_top_column = $euser_pref['top_bcard_column'];
			}
			$userlist_num=1;
			$text .= "<tr>";
			while($row=$sql->db_Fetch()) {
				$text .= renderuser($row, "short");
				$userlist_num++;
				if ($userlist_num == $userlist_top_column +1) {
					$text .= "</tr>";
					$userlist_num = 1;
				}
			}
			$text .= "</td></tr>";
	}
	$text .= "</table>\n";
	$text .= $results;
	$ns->tablerender("".PROFILE_376."", $text);
//RATE
}
//RATE

// Paraser - Part 2


if($found > $mutat) {
	$parms = $found.",".$records.",".$from.",".e_SELF.'?'.$parase;
	echo "<div class='nextprev'>&nbsp;".$tp->parseTemplate("{NEXTPREV={$parms}}")."</div>";
}
//
function renderuser($uid) {
	global $sql, $tp, $ml_shortcodes;
	global $ML_SHORT_TEMPLATE;
	global $ML_TOPLIST_USER;
	global $ML_TOPLIST_FORUMS;
	global $ML_TOPLIST_LEVEL;
	global $ML_TOPLIST_COMMENTS;
	global $ML_TOPLIST_CHATBOX;
	global $ML_TOPLIST_FRIENDS;
	global $ML_TOPLIST_PROFILES;
	global $user;
	global $szures;
	global $comments_top;
	global $chatbox_top;
	global $forums_top;
	global $level_top;
	global $profile_top;
	global $friends_top;
	global $comments_top_number;
	global $chatbox_top_number;
	global $forums_top_number;
	global $level_top_number;
	global $profile_top_number;
	global $friends_top_number;
	if(is_array($uid)) {
		$user = $uid;
	} else {
		if(!$user = get_user_data($uid)) {
			return FALSE;
		}
	}

	if($comments_top > $comments_top_number) $comments_top_number = $comments_top;
	if($chatbox_top > $chatbox_top_number) $chatbox_top_number = $chatbox_top;
	if($forums_top > $forums_top_number) $forums_top_number = $forums_top;
	if($level_top > $level_top_number) $level_top_number = $level_top;
	if($profile_top > $profile_top_number) $profile_top_number = $profile_top;
	if($friends_top > $friends_top_number) $friends_top_number = $friends_top;

	//RATE
	if ($szures == "rate_user") {
		return $tp->parseTemplate($ML_TOPLIST_USER, FALSE, $ml_shortcodes);
	} else if ($szures == "rate_forums") {
		return $tp->parseTemplate($ML_TOPLIST_FORUMS, FALSE, $ml_shortcodes);
	} else if ($szures == "rate_level") {
		return $tp->parseTemplate($ML_TOPLIST_LEVEL, FALSE, $ml_shortcodes);
	} else if ($szures == "rate_comments") {
		return $tp->parseTemplate($ML_TOPLIST_COMMENTS, FALSE, $ml_shortcodes);
	} else if ($szures == "rate_chatbox") {
		return $tp->parseTemplate($ML_TOPLIST_CHATBOX, FALSE, $ml_shortcodes);
	} else if ($szures == "rate_friends") {
		return $tp->parseTemplate($ML_TOPLIST_FRIENDS, FALSE, $ml_shortcodes);
	} else if ($szures == "rate_profiles") {
		return $tp->parseTemplate($ML_TOPLIST_PROFILES, FALSE, $ml_shortcodes);
	} else {
		return $tp->parseTemplate($ML_SHORT_TEMPLATE, FALSE, $ml_shortcodes);
	}
}
//require_once(FOOTERF);



}
require_once(FOOTERF);
