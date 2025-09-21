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
if (!defined('e107_INIT')) { exit; }
include_once(e_HANDLER.'shortcode_handler.php');
$ml_shortcodes = $tp -> e_sc -> parse_scbatch(__FILE__);

/*

SC_BEGIN USER_VISITS
global $user;
return $user['user_visits'];
SC_END

SC_BEGIN USER_EMAIL
global $user,$tp;
return ($user['user_hideemail'] && !ADMIN) ? "<i>".PROFILE_219."</i>" : $tp->toHTML($user['user_email'],"no_replace");
SC_END

SC_BEGIN USER_JOIN
global $user;
return date("Y.m.d. H:i", $user['user_join']);
SC_END

SC_BEGIN USER_JOIN_SORT
global $user;
return date("Y.m.d.", $user['user_join']);
SC_END

SC_BEGIN USER_LEVEL
global $user, $euser_pref;
//e107_0.8 compatible
if(file_exists(e_HANDLER."level_handler.php")){
require_once(e_HANDLER."level_handler.php");
$ldata = get_level($user['user_id'], $user['user_forums'], $user['user_comments'], $user['user_chats'], $user['user_visits'], $user['user_join'], $user['user_admin'], $user['user_perms'], $euser_pref);

if (strstr($ldata[0], "IMAGE_rank_main_admin_image")) {
	return PROFILE_361;
}
else if(strstr($ldata[0], "IMAGE")) {
	return PROFILE_362;
}
else
{
	return $USER_LEVEL = $ldata[1];
}
}
SC_END

SC_BEGIN USER_LASTVISIT
global $user;
$gen = new convert;
return date("Y.m.d. H:i", $user['user_currentvisit']);
SC_END

SC_BEGIN USER_LASTVISIT_SORT
global $user;
$gen = new convert;
return date("Y.m.d.", $user['user_currentvisit']);
SC_END

SC_BEGIN USER_ICON
if(defined("USER_ICON"))
{
	return USER_ICON;
}
if(file_exists(THEME."generic/user.png"))
{
	return "<img src='".THEME_ABS."generic/user.png' alt='' style='border:0px;vertical-align:middle;' /> ";
}
return "<img src='".e_IMAGE_ABS."user_icons/user_".IMODE.".png' alt='' style='border:0px;vertical-align:middle;' /> ";
SC_END

SC_BEGIN USER_AVATAR_NOTIP
global $user;
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

if(defined("USER_AVATAR"))
{
	return USER_AVATAR;
}
if ($user['user_image'] == "")
{
return "<img src='".e_PLUGIN."euser/images/noavatar.png' border='1' ".$avwidth." ".$avheight."  alt='' />"; 
}
else
{
$user_image = $user['user_image'];
require_once(e_HANDLER."avatar_handler.php");
$user_image = avatar($user_image);
return "<img src='".$user_image."' border='1' ".$avwidth." ".$avheight." alt='' />";
}
SC_END

SC_BEGIN USER_AVATAR
global $user;
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

if(defined("USER_AVATAR"))
{
	return USER_AVATAR;
}
if ($user['user_image'] == "")
{
return "
<div id='tip".$user[user_id]."'>
	<img src='".e_PLUGIN."euser/images/noavatar.png' border='1' ".$avwidth." ".$avheight."  alt='' />
</div>
<script type='text/javascript' language='javascript'>
	new Tip('tip".$user[user_id]."', '<br/><br/><img src=\"".e_PLUGIN."euser/images/noavatar.png\" alt=\"\"/><br/>".$user[user_id].PROFILE_169a."<br/><br/><br/><br/>".PROFILE_386.$user['user_comments']."<br/>".PROFILE_389.$user['user_forums']."<br/>".PROFILE_392.$user['user_chats']."<br/><br/>', {
	  title: '".$user[user_name]."',
	  className: 'default1'
	});
</script>
";
}
else
{
$user_image = $user['user_image'];
require_once(e_HANDLER."avatar_handler.php");
$user_image = avatar($user_image);
return "
<div id='tip".$user[user_id]."'>
	<img src='".$user_image."' border='1' ".$avwidth." ".$avheight." alt='' />
</div>
<script type='text/javascript' language='javascript'>
	new Tip('tip".$user[user_id]."', '<br/><br/><img src=\"$user_image\" alt=\"\"/><br/>".$user[user_id].PROFILE_169a."<br/><br/><br/><br/>".PROFILE_386.$user['user_comments']."<br/>".PROFILE_389.$user['user_forums']."<br/>".PROFILE_392.$user['user_chats']."<br/><br/>', {
	  title: '".$user[user_name]."',
	  className: 'default1'
	});
</script>
";
}
SC_END

SC_BEGIN USER_ONLINE
global $sql, $user;
$id = $user[user_id];
$name = $user[user_name];
$sql_online = new db;
$online = $sql_online->db_Count("online","(*)","where online_user_id = '$id.$name' LIMIT 1");
if ($online == 1) {
return "<img src='".e_PLUGIN."euser/images/online.gif' border='1' alt='' />";
}
SC_END

SC_BEGIN USER_COMMENTS
global $sql, $user;
$id = $user[user_id];
$sql_comments = new db;
$comments = $sql_comments->db_Count("euser_com","(*)","where com_to = '$id' AND com_type = 'prof'  LIMIT 1");
if ($comments > 0 AND $euser_pref['memberlist_comment_info'] != "OFF" AND ($euser_pref['commentson'] == "ON" || $euser_pref['commentson'] == "") AND ($euser_pref['member_info'] == "Yes" || $euser_pref['member_info'] == "")) {
return "<a href='euser.php?id=".$id."&page=comments'><img src='".e_PLUGIN."euser/images/post1.png' border='0' alt='' width='16' title='".PROFILE_316." (".$comments.")' /></a>&nbsp;";
}
SC_END

SC_BEGIN USER_PIC
global $sql, $user;
$id = $user[user_id];
$picdir = "userimages/".$id."/";
	if ($hndDir = opendir($picdir)){
		$intCount = 0;
		while (false !== ($strFilename = readdir($hndDir))){
			if ($strFilename != "." && $strFilename != ".." && $strFilename != "index.htm" && $strFilename != "thumbs"){
				$intCount++;
			}
		}
		closedir($hndDir);
	} else {
		$intCount = -1;
}
$kepekszama = $intCount;
if ($kepekszama > 0 AND $euser_pref['memberlist_pic_info'] != "OFF" AND ($euser_pref['pics'] == "ON" || $euser_pref['pics'] == "") AND ($euser_pref['member_info'] == "Yes" || $euser_pref['member_info'] == "")) {
return "<a href='euser.php?id=".$id."&page=images'><img src='".e_PLUGIN."euser/images/pict.png' border='0' alt='' width='16' title='".PROFILE_317." (".$kepekszama.")' /></a>&nbsp;";
}
SC_END

SC_BEGIN USER_VID
global $sql, $user;
$id = $user[user_id];
$sql_vid = new db;
$vid = $sql_vid->db_Count("euser_vids","(*)","where vid_uid = '$id' LIMIT 1");
if ($vid > 0 AND $euser_pref['memberlist_vid_info'] != "OFF" AND ($euser_pref['videos'] == "ON" || $euser_pref['videos'] == "") AND ($euser_pref['member_info'] == "Yes" || $euser_pref['member_info'] == "")) {
return "<a href='euser.php?id=".$id."&page=videos'><img src='".e_PLUGIN."euser/images/vid.png' border='0' alt='' width='16' title='".PROFILE_113." (".$vid.")' /></a>&nbsp;";
}
SC_END

SC_BEGIN USER_FORUMS
global $sql, $user;
$id = $user[user_id];
$sql_forums = new db;
$forums = $user[user_forums];
if ($forums > 0 AND $euser_pref['memberlist_forum_info'] != "OFF" AND ($euser_pref['member_info'] == "Yes" || $euser_pref['member_info'] == "")) {
	if (USER || check_class($euser_pref['memberlist_access'])) {
		return "<a href='../../userposts.php?0.forums.".$id."'><img src='".e_PLUGIN."euser/images/forum.png' border='0' alt='' width='16' title='".PROFILE_363." (".$forums.")' /></a>&nbsp;";
	} else {
		return "<a href='euser.php?id=".$id."'><img src='".e_PLUGIN."euser/images/forum.png' border='0' alt='' width='16' title='".PROFILE_363." (".$forums.")' /></a>&nbsp;";
	}
}
SC_END

SC_BEGIN USER_COMMENTS_1
global $sql, $user;
$id = $user[user_id];
$sql_comments_1 = new db;
$comments_1 = $user[user_comments];
if ($comments_1 > 0 AND $euser_pref['memberlist_comment_1_info'] != "OFF" AND ($euser_pref['member_info'] == "Yes" || $euser_pref['member_info'] == "")) {
	if (USER || check_class($euser_pref['memberlist_access'])) {
		return "<a href='../../userposts.php?0.comments.".$id."'><img src='".e_PLUGIN."euser/images/quote.png' border='0' alt='' width='16' title='".PROFILE_364." (".$comments_1.")' /></a>&nbsp;";
	} else {
		return "<a href='euser.php?id=".$id."'><img src='".e_PLUGIN."euser/images/quote.png' border='0' alt='' width='16' title='".PROFILE_364." (".$comments_1.")' /></a>&nbsp;";
	}
}
SC_END

SC_BEGIN USER_MP3
global $sql, $user;
$id = $user[user_id];
$sql_mp3 = new db;
$mp3 = $sql_mp3->db_Count("euser","(*)","where user_id = '$id' AND user_mp3 !='' LIMIT 1");
if ($mp3 > 0 AND $euser_pref['memberlist_mp3_info'] != "OFF" AND $euser_pref['mp3enabled'] == "ON" AND ($euser_pref['member_info'] == "Yes" || $euser_pref['member_info'] == "")) {
return "<a href='euser.php?id=".$id."'><img src='".e_PLUGIN."euser/images/mp3.png' border='0' alt='' width='16' title=".PROFILE_318." /></a>";
}
SC_END

SC_BEGIN USER_WARN
global $sql, $user;
if($euser_pref['user_warn_support'] == "Yes") {
$warnuser = $user[user_id];
$user_warn = "";
$warn = new db;
$warn->db_Select("user_extended", "*", "user_extended_id='$warnuser' AND user_warn!='null' AND user_warn!='' LIMIT 1");
while($row=$warn->db_Fetch()){
$user_warn .= "<img src=\"".THEME_ABS."images/warn/".$row['user_warn'].".png\" align='right'><br />";
}
return $user_warn;
}
SC_END

SC_BEGIN USER_SET_FRIEND_PIC
if (($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "") && $euser_pref['memberlist_addtofriend'] == "Yes") {
global $sql, $user;
$id = $user[user_id];
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
	$friends_pic_db = new db;
	$friends_pic_db->db_Select("euser", "*", "user_id='$id' LIMIT 1");
	$friends_pic = $friends_pic_db->db_Fetch();
	$friendb = explode("|", $friends_pic['user_friends']);
	$friendb1 = explode("|", $friends_pic['user_friends_request']);
	if (USER && $id != USERID) {
		if ($euser_pref['memberlist_bcard'] == "line" || $euser_pref['memberlist_bcard'] == "" ) {
			$fr_img = e_PLUGIN."euser/images/pm_small.png";
			if (in_array(USERID, $friendb)) $fr_img = e_PLUGIN."euser/images/friend.png";
			if (in_array(USERID, $friendb1)) $fr_img = e_PLUGIN."euser/images/fr_checked.png";
		} else {
			$fr_img = "buttons/".e_LANGUAGE."_addfriend.png";
			if(in_array(USERID, $friendb)) $fr_img = "friend.png";
			if(in_array(USERID, $friendb1)) $fr_img = "fr_checked.png";
			$fr_img = e_PLUGIN."euser/images/".$fr_img."";
		}
	$frimage = "<a href='euser.php?id=".$id."&add' style=\"text-decoration: none;\" title='".PROFILE_16."'><img src='".$fr_img."' style='height:16px; padding-left: 2px; padding-right: 4px;' align='right' border='0' alt='' /></a>";
	if(in_array(USERID, $friendb)) {
		$frimage = "<a href='euser.php?id=".$id."' style=\"text-decoration: none;\" title='".PROFILE_424."'><img src='".$fr_img."' style='height:16px; padding-left: 2px; padding-right: 4px;' align='right' border='0' alt='' /></a>";
	}
	if(in_array(USERID, $friendb1)) {
		$frimage = "<a href='euser_settings.php?page=friends' style=\"text-decoration: none;\" title='".PROFILE_425."'><img src='".$fr_img."' style='height:16px; padding-left: 2px; padding-right: 4px;' align='right' border='0' alt='' /></a>";
	}
	}
}
return $frimage;
SC_END

SC_BEGIN USER_ICON_LINK
global $user;
if(defined("USER_ICON"))
{
	$icon = USER_ICON;
}
else if(file_exists(THEME."generic/user.png"))
{
	$icon = "<img src='".THEME_ABS."generic/user.png' alt='' style='border:0px;vertical-align:middle;' /> ";
}
else
{
	$icon = "<img src='".e_IMAGE_ABS."user_icons/user_".IMODE.".png' alt='' style='border:0px;vertical-align:middle;' /> ";
}
return "<a href='".e_BASE."user.php?id.{$user['user_id']}'>{$icon}</a>";
SC_END

SC_BEGIN USER_ID
global $user;
return $user['user_id'];
SC_END

SC_BEGIN USER_NAME
global $user;
return $user['user_name'];
SC_END

SC_BEGIN USER_IP_ADDRESS
global $user;
if(ADMIN && getperms("4")) {
return $user['user_ip'];
}
SC_END

SC_BEGIN USER_TIMEZONE
global $user;
if(ADMIN && getperms("4")) {
return $user['user_timezone'];
}
SC_END

SC_BEGIN USER_REAL_NAME
global $user;
return $user['user_login'];
SC_END

SC_BEGIN USER_NAME_LINK
global $user;
return "<a href='".e_BASE."user.php?id.{$user['user_id']}'>".$user['user_name']."</a>";
SC_END

SC_BEGIN USER_LOGINNAME
global $user;
if(ADMIN && getperms("4")) {
return $user['user_loginname'];
}
SC_END

SC_BEGIN USER_LIST
global $sql, $user;
$euser_memberlist = new db;
$euser_memberlist->db_Select("euser_memberlist", "*");
$row = $euser_memberlist->db_Fetch();
$columns_settings = $row['memberlist_columns'];
$memberlist_extended_column = new db;
if($memberlist_extended_column->db_Select("user_extended_struct", "*", "user_extended_struct_type != 0 AND user_extended_struct_text != '_system_'")) {
	while($row = $memberlist_extended_column->db_Fetch()) {
		$pmatch = "/\|c_".$row['user_extended_struct_id']."\|/";
		if (preg_match($pmatch, $columns_settings)) {
			$struct_id = $row['user_extended_struct_id'];
			$struct_name = $row['user_extended_struct_name'];
			$struct_name = "user_".$struct_name."";
			$memberlist_extended_cell = new db;
			$memberlist_extended_cell->db_Select("user_extended_struct", "*", "user_extended_struct_type != 0 AND user_extended_struct_text != '_system_'");
			while($row = $memberlist_extended_cell->db_Fetch()) {
				$pmatch = "/\|c_".$row['user_extended_struct_id']."\|/";
				if (preg_match($pmatch, $columns_settings)) {
				$memberlist_extended_cell = new db;
				$memberlist_extended_cell->db_Select("user_extended", "*", "user_extended_id  = ".$user['user_id']." LIMIT 1");
				$row = $memberlist_extended_cell->db_Fetch();
				$userdata=$row[$struct_name];
				}
			}
			if ($euser_pref['memberlist_bcard'] == "line" || $euser_pref['memberlist_bcard'] == "" ) {
				$userlist = "".$userlist."<td class='forumheader3' style='width:20%'>".$userdata.$i."</td>";
			} else {
				$userlist = "".$userlist."".$userdata.$i."<br/>";
			}
		}
	}
}
return $userlist;
SC_END

SC_BEGIN USER_RATING_TOP
global $euser_pref, $user;
if($euser_pref['rate'])
{
	include_once(e_HANDLER."rate_class.php");
	$rater = new rater;
	$barl = (file_exists(THEME."images/barl.png") ? THEME."images/barl.png" : e_PLUGIN."poll/images/barl.png");
	$barr = (file_exists(THEME."images/barr.png") ? THEME."images/barr.png" : e_PLUGIN."poll/images/barr.png");
	$bar = (file_exists(THEME."images/bar.png") ? THEME."images/bar.png" : e_PLUGIN."poll/images/bar.png");
	$ret = "<span>";
	if($rating = $rater->getrating('user', $user['user_id'])) {
		$ret .= "<div style='background-image: url($bar); width: ".(floor($rating[1]*10) != 100 ? floor($rating[1]*10) : 98)."%; height: 14px; float: left;'>";
	}
	$ret .= "</div></span><br/><br/>";
	$ret .= "<div style='text-align:left'>".PROFILE_381.$rating[1]."/10</div>";
	return $ret;
}
return "";
SC_END

SC_BEGIN USER_PROFILE_TOP
global $sql, $user, $profile_top_number, $profile_top;
$profile_top = new db;
$profile_top->db_Select("euser", "*", "user_id = ".$user['user_id']." LIMIT 1");
$row = $profile_top->db_Fetch();
$profile_top=$row['user_totalviews'];
$barl = (file_exists(THEME."images/barl.png") ? THEME."images/barl.png" : e_PLUGIN."poll/images/barl.png");
$barr = (file_exists(THEME."images/barr.png") ? THEME."images/barr.png" : e_PLUGIN."poll/images/barr.png");
$bar = (file_exists(THEME."images/bar.png") ? THEME."images/bar.png" : e_PLUGIN."poll/images/bar.png");
if ($profile_top_number) {
	$profile_top_pic = $profile_top/$profile_top_number*100;
} else {
	$profile_top_pic =100;
}
$ret = "<span>";
$ret .= "<div style='background-image: url($bar); width: ".(floor($profile_top_pic) != 100 ? floor($profile_top_pic) : 98)."%; height: 14px; float: left;'>";
$ret .= "</div></span><br/><br/>";
$ret .= "<div style='text-align:left'>".PROFILE_382.$profile_top."x</div>";
return $ret;
SC_END

SC_BEGIN USER_FORUMS_TOP
global $sql, $user, $forums_top_number, $forums_top;
$forums_top = new db;
$forums_top=$user[user_forums];
$barl = (file_exists(THEME."images/barl.png") ? THEME."images/barl.png" : e_PLUGIN."poll/images/barl.png");
$barr = (file_exists(THEME."images/barr.png") ? THEME."images/barr.png" : e_PLUGIN."poll/images/barr.png");
$bar = (file_exists(THEME."images/bar.png") ? THEME."images/bar.png" : e_PLUGIN."poll/images/bar.png");
if ($forums_top_number) {
	$forums_top_pic = $forums_top/$forums_top_number*100;
} else {
	$forums_top_pic =100;
}
$ret = "<span>";
$ret .= "<div style='background-image: url($bar); width: ".(floor($forums_top_pic) != 100 ? floor($forums_top_pic) : 98)."%; height: 14px; float: left;'>";
$ret .= "</div></span><br/><br/>";
$ret .= "<div style='text-align:left'>".PROFILE_389.$forums_top."</div>";
return $ret;
SC_END

SC_BEGIN USER_LEVEL_TOP
global $sql, $user, $level_top_number, $level_top;
$level_top = new db;
$level_top=ceil((($user[user_forums] * 5) + ($user[user_comments] * 5) + ($user[user_chats] * 2) + $user[user_visits])/4);
$barl = (file_exists(THEME."images/barl.png") ? THEME."images/barl.png" : e_PLUGIN."poll/images/barl.png");
$barr = (file_exists(THEME."images/barr.png") ? THEME."images/barr.png" : e_PLUGIN."poll/images/barr.png");
$bar = (file_exists(THEME."images/bar.png") ? THEME."images/bar.png" : e_PLUGIN."poll/images/bar.png");
if ($level_top_number) {
	$level_top_pic = $level_top/$level_top_number*100;
} else {
	$level_top_pic =100;
}
$ret = "<span>";
$ret .= "<div style='background-image: url($bar); width: ".(floor($level_top_pic) != 100 ? floor($level_top_pic) : 98)."%; height: 14px; float: left;'>";
$ret .= "</div></span><br/><br/>";
$ret .= "<div style='text-align:left'>".PROFILE_390.ceil($level_top_pic)."%</div>";
return $ret;
SC_END

SC_BEGIN USER_COMMENTS_TOP
global $sql, $user, $comments_top_number, $comments_top;
$comments_top = new db;
$comments_top=$user[user_comments];
$barl = (file_exists(THEME."images/barl.png") ? THEME."images/barl.png" : e_PLUGIN."poll/images/barl.png");
$barr = (file_exists(THEME."images/barr.png") ? THEME."images/barr.png" : e_PLUGIN."poll/images/barr.png");
$bar = (file_exists(THEME."images/bar.png") ? THEME."images/bar.png" : e_PLUGIN."poll/images/bar.png");
if ($comments_top_number) {
	$comments_top_pic = $comments_top/$comments_top_number*100;
} else {
	$comments_top_pic =100;
}
$ret = "<span>";
$ret .= "<div style='background-image: url($bar); width: ".(floor($comments_top_pic) != 100 ? floor($comments_top_pic) : 98)."%; height: 14px; float: left;'>";
$ret .= "</div></span><br/><br/>";
$ret .= "<div style='text-align:left'>".PROFILE_386.$comments_top."</div>";
return $ret;
SC_END

SC_BEGIN USER_CHATBOX_TOP
global $sql, $user, $chatbox_top_number, $chatbox_top;
$chatbox_top = new db;
$chatbox_top=$user[user_chats];
$barl = (file_exists(THEME."images/barl.png") ? THEME."images/barl.png" : e_PLUGIN."poll/images/barl.png");
$barr = (file_exists(THEME."images/barr.png") ? THEME."images/barr.png" : e_PLUGIN."poll/images/barr.png");
$bar = (file_exists(THEME."images/bar.png") ? THEME."images/bar.png" : e_PLUGIN."poll/images/bar.png");
if ($chatbox_top_number) {
	$chatbox_top_pic = $chatbox_top/$chatbox_top_number*100;
} else {
	$chatbox_top_pic =100;
}
$ret = "<span>";
$ret .= "<div style='background-image: url($bar); width: ".(floor($chatbox_top_pic) != 100 ? floor($chatbox_top_pic) : 98)."%; height: 14px; float: left;'>";
$ret .= "</div></span><br/><br/>";
$ret .= "<div style='text-align:left'>".PROFILE_392.$chatbox_top."</div>";
return $ret;
SC_END

SC_BEGIN USER_FRIENDS_TOP
global $sql, $user, $friends_top_number, $friends_top;
$friends_top = new db;
$friends_top->db_Select("euser", "*", "user_id = ".$user['user_id']." LIMIT 1");
$row = $friends_top->db_Fetch();
$friends_top = substr_count($row['user_friends'], '|')-1;
if($friends_top < 1) $friends_top = 0;
$barl = (file_exists(THEME."images/barl.png") ? THEME."images/barl.png" : e_PLUGIN."poll/images/barl.png");
$barr = (file_exists(THEME."images/barr.png") ? THEME."images/barr.png" : e_PLUGIN."poll/images/barr.png");
$bar = (file_exists(THEME."images/bar.png") ? THEME."images/bar.png" : e_PLUGIN."poll/images/bar.png");
if ($friends_top_number) {
	$friends_top_pic = $friends_top/$friends_top_number*100;
} else {
	$friends_top_pic =100;
}
$ret = "<span>";
$ret .= "<div style='background-image: url($bar); width: ".(floor($friends_top_pic) != 100 ? floor($friends_top_pic) : 98)."%; height: 14px; float: left;'>";
$ret .= "</div></span><br/><br/>";
$ret .= "<div style='text-align:left'>".PROFILE_383.$friends_top."</div>";
return $ret;
SC_END

*/
?>
