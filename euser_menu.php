<?php
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

// Euser Menu para o perfil do utilizador!!!!!!!!!!!


if (!defined('e107_INIT')) { exit; }
if ($euser_pref['plug_installed']['euser']) {
	if(file_exists(e_PLUGIN."euser/languages/".e_LANGUAGE.".php")){
		require_once(e_PLUGIN."euser/languages/".e_LANGUAGE.".php");
	} else {
		require_once(e_PLUGIN."euser/languages/English.php");
	}
  if (USER) {
	$sql->mySQLresult = @mysql_query("SELECT user_lastvisit FROM ".MPREFIX."user WHERE user_id='".USERID."' ");
	$lastvisit = $sql->db_Fetch();

	// NEW FRIENDS?
	if ($euser_pref['friends'] == "ON" || $euser_pref['friends'] == "") {
		$sql->mySQLresult = @mysql_query("SELECT user_friends_request FROM ".MPREFIX."euser WHERE user_id='".USERID."' ");
		$friends = $sql->db_Fetch();
		$requests = explode("|", $friends['user_friends_request']);
		if ($friends['user_friends_request'] == "") {
			$num = 0;
		} else {
			$num = count($requests) - 2;
		}
		if ($num > 0) {
			$tex .= "<a href='".e_PLUGIN."euser/euser.php?id=".USERID."&page=friends'><img src='".e_PLUGIN."euser/images/pm_old.png' border='0' alt='' width='16' height='16' title=".PROFILE_323." /></a>&nbsp;<a href='".e_PLUGIN."euser/euser_settings.php?page=friends'><b>".$num."</b> ".($num == 1 ? MENU_PROFILE_1 : MENU_PROFILE_1a)."</a><br/>";
		} else {
			$sql->mySQLresult = @mysql_query("SELECT user_friends FROM ".MPREFIX."euser WHERE user_id='".USERID."' ");
			$friends = $sql->db_Fetch();
			$requests = explode("|", $friends['user_friends']);
			if ($friends['user_friends'] == "") {
				$num = 0;
			} else {
				$num = count($requests) - 2;
			}
			if ($num > 0) {
				$tex .= "<a href='".e_PLUGIN."euser/euser.php?id=".USERID."&page=friends'><img src='".e_PLUGIN."euser/images/pm_old.png' border='0' alt='' width='16' height='16' title=".PROFILE_323." /></a>&nbsp;".$num.PROFILE_324."<br/>";
			} else {
				$tex .= "<img src='".e_PLUGIN."euser/images/pm_old.png' border='0' alt='' width='16' height='16' />&nbsp;".PROFILE_325."<br/>";
			}
		}
	}

	// NEW COMMENTS?
	if ($euser_pref['commentson'] == "ON" || $euser_pref['commentson'] == "") {
		$sql->mySQLresult = @mysql_query("SELECT com_id, com_date FROM ".MPREFIX."euser_com WHERE com_to='".USERID."' AND com_date > ".$lastvisit['user_lastvisit']." AND com_type='prof'");
		$comment = $sql->db_Rows();
		if ($comment > 0) {
			$tex .= "<a href='".e_PLUGIN."euser/euser.php?id=".USERID."&page=comments'><img src='".e_PLUGIN."euser/images/post1.png' border='0' alt='' width='16' height='16' title=".PROFILE_319." /></a>&nbsp;<a href='".e_PLUGIN."euser/euser_settings.php?page=comments'><b>".$comment."</b> ".($comment == 1 ? MENU_PROFILE_2 : MENU_PROFILE_2a)."</a><br/>";
		} else {
			$sql->mySQLresult = @mysql_query("SELECT com_id, com_date FROM ".MPREFIX."euser_com WHERE com_to='".USERID."' AND com_type='prof'");
			$comment_all = $sql->db_Rows();
			if ($comment_all > 0) {
				$tex .= "<a href='".e_PLUGIN."euser/euser.php?id=".USERID."&page=comments'><img src='".e_PLUGIN."euser/images/post1.png' border='0' alt='' width='16' height='16' title=".PROFILE_319." /></a>&nbsp;".$comment_all.PROFILE_313."<br/>";
			} else {
				$tex .= "<img src='".e_PLUGIN."euser/images/post1.png' border='0' alt='' width='16' height='16' />&nbsp;".PROFILE_314."<br/>";
			}
		}
	}

	// NEW PICS?
	if ($euser_pref['pics'] == "ON" || $euser_pref['pics'] == "") {
		$sql->mySQLresult = @mysql_query("SELECT com_id, com_date FROM ".MPREFIX."euser_com WHERE com_to='".USERID."' AND com_date > ".$lastvisit['user_lastvisit']." AND com_type='pics'");
		$piccomment = $sql->db_Rows();
		if ($piccomment > 0) {
			$tex .= "<a href='".e_PLUGIN."euser/euser.php?id=".USERID."&page=images'><img src='".e_PLUGIN."euser/images/pict.png' border='0' alt='' width='16' height='16' title=".PROFILE_320." /></a>&nbsp;<a href='".e_PLUGIN."euser/euser_settings.php?page=images'><b>".$piccomment."</b> ".($piccomment == 1 ? MENU_PROFILE_3 : MENU_PROFILE_3a)."</a><br/>";
		} else {
			$sql->mySQLresult = @mysql_query("SELECT com_id, com_date FROM ".MPREFIX."euser_com WHERE com_to='".USERID."' AND com_type='pics'");
			$piccomment_all = $sql->db_Rows();
			if ($piccomment_all > 0) {
				$tex .= "<a href='".e_PLUGIN."euser/euser.php?id=".USERID."&page=images'><img src='".e_PLUGIN."euser/images/pict.png' border='0' alt='' width='16' height='16' title=".PROFILE_320." /></a>&nbsp;".$piccomment_all.PROFILE_313a."<br/>";
			} else {
				$tex .= "<img src='".e_PLUGIN."euser/images/pict.png' border='0' alt='' width='16' height='16' />&nbsp;".PROFILE_314a."<br/>";
			}
		}
	}

		// NEW VIDEOS?
	if ($euser_pref['videos'] == "ON" || $euser_pref['videos'] == "") {
		$sql->mySQLresult = @mysql_query("SELECT com_id, com_date FROM ".MPREFIX."euser_com WHERE com_to='".USERID."' AND com_date > ".$lastvisit['user_lastvisit']." AND com_type='vids'");
		$vidcomment = $sql->db_Rows();

		if ($vidcomment > 0) {
			$tex .= "<a href='".e_PLUGIN."euser/euser.php?id=".USERID."&page=videos'><img src='".e_PLUGIN."euser/images/vid.png' border='0' alt='' width='16' height='16' title=".PROFILE_321." /></a>&nbsp;<a href='".e_PLUGIN."euser/euser_settings.php?page=videos'><b>".$vidcomment."</b> ".MENU_PROFILE_4."</a><br/>";
		} else {
			$sql->mySQLresult = @mysql_query("SELECT com_id, com_date FROM ".MPREFIX."euser_com WHERE com_to='".USERID."' AND com_type='vids'");
			$vidcomment_all = $sql->db_Rows();
			if ($vidcomment_all > 0) {
				$tex .= "<a href='".e_PLUGIN."euser/euser.php?id=".USERID."&page=videos'><img src='".e_PLUGIN."euser/images/vid.png' border='0' alt='' width='16' height='16' title=".PROFILE_321." /></a>&nbsp;".$vidcomment_all.PROFILE_313b."<br/>";
			} else {
				$tex .= "<img src='".e_PLUGIN."euser/images/vid.png' border='0' alt='' width='16' height='16' />&nbsp;".PROFILE_314b."<br/>";
			}
		}
	}

		// NEW PRIVATE MESSAGE?
	$sql->mySQLresult = @mysql_query("SELECT pm_read, pm_read_del FROM ".MPREFIX."private_msg WHERE pm_to='".USERID."' AND pm_read='0' AND pm_read_del='0' ");
	$pmrows = $sql->db_Rows();

	if ($pmrows > 0) {
		$tex .="<a href='".e_PLUGIN."pm/pm.php?inbox'><img src='".e_PLUGIN."pm/images/pm.png' border='0' alt='' width='16' height='16' title=".PROFILE_322." /></a>&nbsp;<a href='".e_PLUGIN."pm/pm.php?inbox'><b>".$pmrows."</b> ".($pmrows == 1 ? "".PROFILE_235."" : "".PROFILE_235."")."</a>";
	} else {
		$tex .="<a href='".e_PLUGIN."pm/pm.php?inbox'><img src='".e_PLUGIN."pm/images/pm.png' border='0' alt='' width='16' height='16' /></a>&nbsp;".PROFILE_326."";
	}


	$ns -> tablerender("".MENU_PROFILE_5."", $tex);
  }
}
?>
