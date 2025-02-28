<?php
// ISTO DEPOIS PRECISA DE SER REESCRITO, MAS POR AGORA FICA ASSIM.....
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

//$this->var['euser_pref'] = e107::getPlugPref('euser');

if (!$this->var['euser_pref']['videos']) { return;}

//----if (!defined('e107_INIT')) { exit; }
require_once("handlers/video_handler.php");
//$text .= "<br/>";

if (isset($_GET['vid'])) {
$sql->mySQLresult = @mysql_query("SELECT vid_name, vid_desc, vid_embed FROM ".MPREFIX."euser_vids WHERE vid_id='".intval($_GET['vid'])."'");
$vid = $sql->db_Fetch();
$text .= "<table width='100%' class='fborder'><tr><td class='forumheader'><img src='images/videos.png'><i>".PROFILE_164."</i></td></tr></table>";
$text .= "<a href='euser.php?id=".$this->var['user_id']."&page=videos'>".PROFILE_206."</a><br/><br/>";
$video = $tp -> toHTML($vid['vid_embed'], true);
$desc = $tp -> toHTML($vid['vid_desc'], true);
$name = $tp -> toHTML($vid['vid_name'], true);
$vidpic = str_replace("<", "", $vid['vid_embed']);
$break = explode("/", $vidpic);
if (!$break[2] == "www.youtube.com") {
	$embed_db = explode(" ", $video);
	$video = $embed_db[1];
	$share_site = $embed_db[0];
	$vid_embed_code = vid_url($share_site,$video);
	$video = $vid_embed_code;
}

$text .= '<center><b>'.$name.'</b><br/><br/>'.$video.'<br/><br/>'.$desc.'</center><br/><br/><br/>';

//------------------------------------------
// Videó hozzászólások listázása
$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."euser_com WHERE com_to='".$this->var['user_id']."' AND com_type='vids' AND com_extra='".intval($_GET['vid'])."'");
$vidnumrows = $sql->db_Rows();

// MULTIPAGES INFO
if ($this->var['euser_pref']['apcomments'] != '') {
	$rowsPerPage = $this->var['euser_pref']['apcomments'];
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
$sql->mySQLresult = @mysql_query("SELECT com_id, com_message, com_date, com_by FROM ".MPREFIX."euser_com WHERE com_to='".$this->var['user_id']."' AND com_type='vids' AND com_extra='".intval($_GET['vid'])."' ORDER BY com_date $comment_order LIMIT $offset,$rowsPerPage");
$vidcomm = $sql->db_Rows();

$maxPage = ceil($vidnumrows/$rowsPerPage);
$self = $_SERVER['PHP_SELF'];
$nav  = '';
for($page = 1; $page <= $maxPage; $page++) {
	if ($page == $pageNum) {
	// $nav .= " $page "; // no need to create a link to current page
		$nav .= ""; // no need to create a link to current page
   	} else {
     		$nav .= " <a href=\"$self?id=".$this->var['user_id']."&page=videos&vid=".$_GET['vid']."&comment_order=".$comment_order."&pgnum=".$page."\">$page</a> ";
	}
}
if ($pageNum > 1) {
	$page  = $pageNum - 1;
   	$prev  = " <a href=\"$self?id=".$this->var['user_id']."&page=videos&vid=".$_GET['vid']."&comment_order=".$comment_order."&pgnum=".$page."\">".PROFILE_204."</a> ";

	$first = " <a href=\"$self?id=".$this->var['user_id']."&page=videos&vid=".$_GET['vid']."&comment_order=".$comment_order."&pgnum=".$page."\">".PROFILE_205."</a> ";
} else {
	$prev  = ''; // we're on page one, don't print previous link
	$first = '&nbsp;'; // nor the first page link
}

if ($pageNum < $maxPage) {
	$page = $pageNum + 1;
	$next = " <a href=\"$self?id=".$this->var['user_id']."&page=videos&vid=".$_GET['vid']."&comment_order=".$comment_order."&pgnum=".$page."\">".PROFILE_202."</a> ";

	$last = " <a href=\"$self?id=".$this->var['user_id']."&page=videos&vid=".$_GET['vid']."&comment_order=".$comment_order."&pgnum=".$page."\">".PROFILE_203."</a> ";
} else {
	$next = ''; // we're on the last page, don't print next link
	$last = '&nbsp;'; // nor the last page link
}
// END OF MULTIPAGES
//------------------------------------------
		if ($this->var['euser_pref']['maxvidcomment'] != '') {
			$maxvidcomment = $this->var['euser_pref']['maxvidcomment'];
		} else {
			$maxvidcomment = 50;
		}
		if ($vidcomm == 0) {
		$text .= "<br/><br/><i>".PROFILE_117."</i>";
		} else {
		$text .= "<br><table width='100%' class='fborder'>
			<tr>
				<td style='width:20%; text-align:left' class='forumheader' colspan='2'><img src='images/comments.png'><i>".PROFILE_36a." (".$vidnumrows."):</i></td>";
				if ($comment_order == DESC) {
					$text .= "<td style='width:80%; text-align:right' class='forumheader' colspan='2'>".PROFILE_256."&nbsp;&nbsp;<a href=\"$self?id=".$this->var['user_id']."&page=videos&vid=".$_GET['vid']."&comment_order=ASC\"><img src='images/order_down.png' title='".PROFILE_310."'></a></td>";
				} else {
					$text .= "<td style='width:80%; text-align:right' class='forumheader' colspan='2'>".PROFILE_256."&nbsp;&nbsp;<a href=\"$self?id=".$this->var['user_id']."&page=videos&vid=".$_GET['vid']."&comment_order=DESC\"><img src='images/order_up.png' title='".PROFILE_309."'></a></td>";
				}
				$text .= "</tr>
		</table>";
		$text .= "<br/>";
		//videó hozzászólások indul
		for ($i = 0; $i < $vidcomm; $i++) {
			$com = $sql->db_Fetch();

			$from = mysql_query("SELECT * FROM ".MPREFIX."user WHERE user_id=".$com['com_by']." ");
			$from = mysql_fetch_assoc($from);
			$date = date("Y-m-j H:i", $com['com_date']);
			$comid = $com['com_id'];
			$user_name = $from['user_name'];
			$on_name = "".$com['com_by'].".".$user_name."";
			$checkonline = mysql_query("SELECT * FROM ".MPREFIX."online WHERE online_user_id='".$on_name."'");
			$checkonline = mysql_num_rows($checkonline);
			//e107_0.8 compatible
			if(file_exists(e_HANDLER."level_handler.php")){
				require_once(e_HANDLER."level_handler.php");
				$ldata = get_level($from['user_id'], $from['user_forums'], $from['user_comments'], $from['user_chats'], $from['user_visits'], $from['user_join'], $from['user_admin'], $from['user_perms'], $this->var['euser_pref']);
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
			if ($this->var['euser_pref']['user_warn_support'] == "Yes" AND $fromext['user_warn'] !='null' AND $fromext['user_warn'] !='') {
				$text .= "<br/><img src=\"".THEME_ABS."images/warn/".$fromext['user_warn'].".png\">";
			}
			$text .= "<br/>$from_level<br/><div class='smallblacktext'>".PROFILE_270."$from_join<br/>".PROFILE_272.$fromext['user_location']."</div></td>";
			$message = $tp -> toHTML($com['com_message'], true, 'parse_sc, constants');
			$text .= "<td class='forumheader3' colspan='2' style='vertical-align: top;'>".$message."<hr width='80%' align='left' size='1' noshade ='noshade'>$from_signature</td></tr>";
			$text .= "<tr><td class='forumheader'><div class='smallblacktext'><a href='".e_SELF."?".e_QUERY."#header' onclick=\"window.scrollTo(0,0);\">".PROFILE_271."</a></div></td>";
			if (USER) {
				if ($vidnumrows < $maxvidcomment) {
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
	if (USER) {
	if ($vidnumrows < $maxvidcomment) {
		if (isset($_GET['vtoname']) && isset($_GET['vtodate']) && isset($_GET['vtoid'])) {
			$vtoname = $_GET['vtoname'];
			$vtodate = $_GET['vtodate'];
			$vtoid = $_GET['vtoid'];
			$vtomessage = "[blockquote]".PROFILE_279."".$vtoname." #".$vtoid."".PROFILE_280."[/blockquote]";
		}
		$text .= "<a name='newprofilecomment'></a>";
		$text .= "<br/><br/><form method='post' action='formhandler.php'><table width='100%'><tr><td class='forumheader' style='vertical-align: middle;' /><img src='images/post1.png'>&nbsp;&nbsp;<b>".PROFILE_33."</b></td>";
		if (!e_WYSIWYG) {
			require_once(e_HANDLER."ren_help.php");
		}
		$cpbox = "<tr><td><textarea class='e-wysiwyg tbox' id='data' name='user_video_comment' cols='50' rows='10' style='width:100%' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this)'>$vtomessage</textarea></td></tr><tr><td>";
		if (!e_WYSIWYG) {
			$cpbox .= display_help("helpb", "body");
		}
		$cpbox .= "</td></tr>";
		// Check member settings
		if ($break[4] == 1 && $this->var['user_id'] != USERID) {
			if ((!in_array(USERID, $friendb)) && ($this->var['euser_pref']['friends'] == "ON" || $this->var['euser_pref']['friends'] == "")) {
				$text .= "<tr><td>".$username." ".PROFILE_107a."</td></tr></table></form>";
			} else if ($this->var['euser_pref']['friends'] != "ON") {
				$text .= "<tr><td>".$username." ".PROFILE_107d."</td></tr></table></form>";
			} else {
				$text .= $cpbox;
			$text .= "</td></tr><tr><td><br/><br/>
				<input type='hidden' name='id' value='".$this->var['user_id']."'>
				<input type='hidden' name='vid' value='".$_GET['vid']."'>";
				if ($this->var['euser_pref']['buttontype'] == "Yes") {
					$text .= "<input type='image' name='post_comment' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_comment_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_comment.gif\"' src='images/buttons/".e_LANGUAGE."_comment.gif' >";
					} else {
				$text .= "<input type='submit' name='post_comment' value='".PROFILE_208."' class='button'>";
				}
			$text .= "</td></tr></table></form>";
			}
		} else {
			$text .= $cpbox;
			$text .= "</td></tr><tr><td><br/><br/>
				<input type='hidden' name='id' value='".$this->var['user_id']."'>
				<input type='hidden' name='vid' value='".$_GET['vid']."'>";
				if ($this->var['euser_pref']['buttontype'] == "Yes") {
					$text .= "<input type='image' name='post_comment' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_comment_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_comment.gif\"' src='images/buttons/".e_LANGUAGE."_comment.gif' >";
					} else {
				$text .= "<input type='submit' name='post_comment' value='".PROFILE_208."' class='button'>";
				}
			$text .= "</td></tr></table></form>";
		}
		} else {
			$text .= "<div class='forumheader'>".PROFILE_239." ($maxvidcomment".PROFILE_236.").</div>";
		}
	}

} else {

/*
	$sql->mySQLresult = @mysql_query("SELECT vid_id, vid_name, vid_desc, vid_embed FROM ".MPREFIX."euser_vids WHERE vid_uid='".$this->var['user_id']."' ORDER BY vid_added DESC");
	$vids = $sql->db_Rows();
*/
	$this->sql->select("euser_vids", "vid_id, vid_name, vid_desc, vid_embed", "vid_uid='".$this->var['user_id']."' ORDER BY vid_added DESC");
	$vids = $this->sql->row;

//	if ($vids==0 && (strpos( e_PAGE, "euser_settings")===false)) { return;}
	if ($vids==0 && e_PAGE!="euser_settings.php") { return;}
//        global $euser_template;
//        var_dump ((int) $vids);
//		var_dump(array('count'=>($vids>0?$vids:((strpos( e_PAGE, "euser_settings")!==false)?(int)$vids:NULL))));
//        var_dump ($euser_template);
$euser_template = e107::getTemplate('euser');
//        $euser_template['videos_caption'] = $this->tp->lanVars($euser_template['videos_caption'], array('count'=>($vids>0?$vids:NULL)));
/*        
                if (isset($parm['caption'])){
					return $this->tp->parseTemplate($this->tp->simpleParse($euser_template['videos_caption'], array('count'=>($vids>0?$vids:((strpos( e_PAGE, "euser_settings")!==false)?(int)$vids:NULL)))), TRUE, $this);
				}
*/
                if (isset($parm['caption'])){
					return $this->tp->parseTemplate($this->tp->simpleParse($euser_template['videos_caption'], array('count'=>($vids>0?$vids:(e_PAGE=="euser_settings.php"?(int)$vids:NULL)))), TRUE, $this);
				}

	if ($vids == 0) {
//--		$text .= "<table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/videos.png'><i>".PROFILE_118."</i></td></tr></table>";
          $text .=$this->tp->parseTemplate($euser_template['videos_no'], TRUE, $this);


	} else {
		$text .= "<table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/videos.png'><i>".PROFILE_164."</i></td></tr></table>";
		$text .= "<br><table width='100%'><tr>";
		$count = 1;
		for ($i = 0; $i < $vids; $i++) {
			$vid = $sql->db_Fetch();
			$heading = $tp -> toHTML($vid['vid_name'], true);
			$desc = $tp -> toHTML($vid['vid_desc'], true);
			$vidpic = str_replace("<", "", $vid['vid_embed']);

			if (!$break_a[2] == "www.youtube.com") {
				$embed_db = explode(" ", $vid['vid_embed']);
				$video_code = $embed_db[1];
				$share_site = $embed_db[0];
			}

			$break = explode("/", $vidpic);
			$break2 = explode("&", $break[4]);
			$text .= "<td width='33%'><center><a href='euser.php?id=".$this->var['user_id']."&page=videos&vid=".$vid['vid_id']."' style=\"text-decoration: none;\">";
			if ($break[2] == "www.youtube.com") {
				$text .= "<img src='http://img.youtube.com/vi/".$break2[0]."/default.jpg' width='145' height='100'>";
			} else if($video_code != "") {
				$pic_url = pic_url($share_site, $video_code);
				$text .= "<img src='$pic_url' width='145' height='100'>";
			} else {
				$text .= "<img src='images/nopreview.png' width='145' height='100'>";
			}
			$text .= "<br/>".$heading."</a><br/>".$desc."<br/>";
			$query = mysql_query("SELECT com_id FROM ".MPREFIX."euser_com WHERE com_type='vids' AND com_extra='".$vid['vid_id']."' ");
			$vid_all = mysql_num_rows($query);
			if ($vid_all > 0) {
				$text .= "".$vid_all." ".($vid_all == 1 ? PROFILE_315 : PROFILE_315)."</center></td>";
			} else {
				$text .= "</center></td>";
			}
			if ($count == 3) {
				$text .= "</tr><tr><td><br/><br/></td></tr>";
				$count = 1;
			} else {
				$count++;
			}

		}
		$text .= "</table>";
				$text .= "<br/><table width='100%' ><tr><td class='forumheader' colspan='3' ><div class='smallblacktext'><a href='".e_SELF."?".e_QUERY."#top' onclick=\"window.scrollTo(0,0);\">".PROFILE_271."</a></div></td></tr></table>";

	}
}
return $text;
