<?php
// ISTO DEPOIS PRECISA DE SER REESCRITO, MAS POR AGORA FICA ASSIM.....
/*
+---------------------------------------------------------------+
| Another Profiles Plugin v0.9.8 Spt(2.0)
| Copyright � 2008 Istvan Csonka
| http://freedigital.hu
| support@freedigital.hu
|
|        For the e107 website system
|        �Steve Dunstan
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
//	$this->var['euser_pref'] = e107::getPlugPref('euser'); // JÁ ESTÁ APANHADO NO FICHEIRO QUE INCLUI ESTE, MAS NÃO NO SHORTCODE

//	var_dump ($this->var['euser_pref']);
//	var_dump ($this->var['euser_pref']);	
	//	var_dump(e_PAGE);
//var_dump(strpos(e_PAGE, "euser_settings")!==false);
//var_dump(e_PAGE=="euser_settings.php");

	if (!$this->var['euser_pref']['friends']) { return null;}

				$sql = e107::getDb();
				$sql->select("euser", "user_id, user_friends, user_friends_request","user_id='{$this->var['user_id']}'");
				$udata = $sql->fetch();

//				global $udata;
//				var_dump ($this->var['user_id']);				
//				$udata = $this->euser_data;
//				$udata = $udata;
        
				$friend = explode("|", $udata['user_friends']);
//				$numfriends = count($friend) - 2;
				$numfriends = count($friend) - 1;
//        var_dump(count($friend));
//var_dump($numfriends);
//var_dump(e_PAGE);
//var_dump(strpos( e_PAGE, "euser_settings")===false);
//var_dump($numfriends==0 && e_PAGE!="euser_settings.php");
if ($numfriends==0 && e_PAGE!="euser_settings.php") { return;}

		        global $euser_template;
//        var_dump ($this->template['friends_caption']);
$euser_template = e107::getTemplate('euser');
//var_dump ($numfriends);				
//var_dump($udata['user_friends'] == '' || $udata['user_friends'] == '|');
	//var_dump ($euser_template['friends_caption']);				
//$this->wrapper('euser/main');
//var_dump ($this);

//$this->tp = e107::getParser();
				if (isset($parm['caption'])){
//					$euser_template['friends_caption'] = $this->tp->lanVars($euser_template['friends_caption'], array('x'=>($numfriends>0?$numfriends:NULL)));
//					return $this->tp->parseTemplate($euser_template['friends_caption'], TRUE, $this);
//var_dump($numfriends);
//var_dump ((strpos( e_PAGE, "settings")));
//var_dump ((strpos( e_PAGE, "settings")!==false));
					return $this->tp->parseTemplate(
						'<div data-bs-original-title="'.PROFILE_60.':&nbsp;'.PROFILE_171.'" title="'.PROFILE_60.'&nbsp;'.PROFILE_171.'">'.
						$this->tp->simpleParse($euser_template['friends_caption'], array('count'=>($numfriends>0?$numfriends:((strpos( e_PAGE, "settings")!==false)?$numfriends:NULL)))).'</div>',
						TRUE, $this)
						;
/////////////////////$this->addVars(array('count'=>($numfriends>0?$numfriends:((strpos( e_PAGE, "settings")!==false)?$numfriends:NULL))));
//var_dump ($this->eVars);
//$this->eVar = array('count'=>($numfriends>0?$numfriends:((strpos( e_PAGE, "settings")!==false)?$numfriends:NULL)));
//////////////////					return $this->tp->parseTemplate($euser_template['friends_caption'], TRUE, $this);
//					return $this->tp->parseTemplate($euser_template['friends_caption'], TRUE, $this);
				}
//				if (strpos( e_PAGE, "euser_settings")!==false) {
//	var_dump(e_PAGE=="euser_settings.php");
		if (e_PAGE=="euser_settings.php") {
	// SE FOR A PÁGINA DE EDIÇÃO, EXIBIR ISTO
		// ISTO ESTÁ REPETIDO EM BAIXO, VERIFICAR PARA QUE SERVE... VVVVVV
//		var_dump($this->var['euser_pref']['friends']);
//		if ($this->var['euser_pref']['friends'] == "ON" || $this->var['euser_pref']['friends'] == "") {
		if ($this->var['euser_pref']['frcol'] == '') {
			$frcolumn = '6';
		} elseif ($this->var['euser_pref']['frcol'] > '8') {
			$frcolumn = '8';
		} elseif ($this->var['euser_pref']['frcol'] < '2') {
			$frcolumn = '2';
		} else {
			$frcolumn = $this->var['euser_pref']['frcol'];
		}
//			$text .= "<table width='100%'><tr><td class='forumheader'><img src='images/friends.png'>".PROFILE_60."</td></tr></table>";
//  $text .= "<table width='100%'><tr><td class='forumheader'><img src='images/friends.png'><span style='text-align:center;width: 100%;position: absolute;line-height: 1.25em;'><b><u>".PROFILE_60."</u></b><br>".PROFILE_171."</span></td></tr></table>";
//			$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."euser WHERE user_id='".$this->var['user_id']."' ");
//			$udata = $sql->fetch();
/*
		$sql->select("euser", "user_id, user_friends, user_friends_request", "user_id='{$this->var['user_id']}'");
		$udata = $sql->fetch();
*/
		if (isset($_GET['acceptadd'])) {
//				$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."euser WHERE user_id='".intval($_GET['acceptadd'])."' ");
//				$friend = $sql->fetch();
			$sql2->select("euser", "user_id, user_friends, user_friends_request", "user_id='".intval($_GET['acceptadd'])."' ");
			$friend = $sql2->fetch();
			$check = explode("|", $friend['user_friends']);

//				$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."euser WHERE user_id='".$this->var['user_id']."' ");
//				$te_list = $sql->fetch();
//			$sql->select("euser", "user_id, user_friends, user_friends_request", "user_id='{$this->var['user_id']}'");
//			$te_list = $sql->fetch();
//			$megjeloltek = explode("|", $te_list['user_friends_request']);
//			$megjeloltek = explode("|", $udata['user_friends_request']);

			if (in_array($this->var['user_id'], $check)) {
				$text .= "<br/>".PROFILE_160."<br/>";
//			} elseif (!in_array($_GET['acceptadd'], $megjeloltek)) {
			} elseif (!in_array($_GET['acceptadd'], explode("|", $udata['user_friends_request']))) {
				$text .= "<br/>".PROFILE_160a."<br/>";
			} else {
				$newrequests = str_replace("|".$_GET['acceptadd']."|" , "|", $udata['user_friends_request']);
				if ($udata['user_friends'] == '') {
					$newlist = "|".$_GET['acceptadd']."|";
				} else {
					$newlist = "".$udata['user_friends']."".$_GET['acceptadd']."|";
				}
				if ($friend['user_friends'] == '') {
					$newfriend = "|".$this->var['user_id']."|";
				} else {
					$newfriend = "".$friend['user_friends']."".$this->var['user_id']."|";
				}
//					$sql -> db_Update("euser", "user_friends='".$newlist."' WHERE user_id='".$this->var['user_id']."' ");
//					$sql -> db_Update("euser", "user_friends_request='".$newrequests."' WHERE user_id='".$this->var['user_id']."' ");
//					$sql -> db_Update("euser", "user_friends='".$newfriend."' WHERE user_id='".intval($_GET['acceptadd'])."' ");
				$sql -> update("euser", "user_friends='".$newlist."' WHERE user_id='{$this->var['user_id']}' ");
				$sql -> update("euser", "user_friends_request='".$newrequests."' WHERE user_id='{$this->var['user_id']}' ");
				$sql -> update("euser", "user_friends='".$newfriend."' WHERE user_id='".intval($_GET['acceptadd'])."' ");
				header("Location: euser_settings.php?page=friends".$this->var['user_id']."");
			}

		} elseif (isset($_GET['rejectadd'])) {
//				$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."euser WHERE user_id='".intval($_GET['rejectadd'])."' ");
//				$friend = $sql->fetch();
			$sql2->select("euser", "user_id, user_friends, user_friends_request", "user_id='".intval($_GET['rejectadd'])."' ");
			$friend = $sql2->fetch();
			$newrequests = str_replace("|".intval($_GET['rejectadd'])."|" , "|", $udata['user_friends_request']);
//				$sql -> db_Update("euser", "user_friends_request='".$newrequests."' WHERE user_id='".$this->var['user_id']."' ");
			$sql -> update("euser", "user_friends_request='".$newrequests."' WHERE user_id='{$this->var['user_id']}'");
			header("Location: euser_settings.php?page=friends".$this->var['user_id']."");
		}
		$friend = explode("|", $udata['user_friends']);
		if ($udata['user_friends_request'] == '' or $udata['user_friends_request'] == '|') {
			// DO NOTHING
		} else {
			if ($frcolumn > '6') {	$frcolumn_1 = '5';
			} elseif ($frcolumn > '2') {	$frcolumn_1 = '4';
			} else {	$frcolumn_1 = '3';
			}
			$frcolumn_2 = $frcolumn_1 * 2 - 2;
			$requests = explode("|", $udata['user_friends_request']);
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
					$text .= "</a></td><td class='forumheader3'>".$online." <b>".$frname['user_name']."</b><br/><br/><a href='euser_settings.php?page=friends".$this->var['user_id']."&acceptadd=".$req."'>".PROFILE_66."</a> | <a href='euser_settings.php?page=friends".$uid."&rejectadd=".$req."'>".PROFILE_67."</a></td>";
					$column++;
					if ($column == $frcolumn_1) {
						$text .= "</tr>";
						$column = 1;
					}
				}
			}
			$text .= "</table><br/>";
		}
		if ($udata['user_friends'] == '' or $udata['user_friends'] == '|') {
//			$text .= "<br/><i>".PROFILE_30b."";
			$text .= "<div class='card'>
			<div class='card-body alert alert-info mb-0 text-center'><i>".PROFILE_30b."</i>
			</div></div>";

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
				$text .= "<br/></a><input type='hidden' name='uid' value='".$this->var['user_id']."'><input type='checkbox' name='box[]' value='".$fr."'> ".$name['user_name']." ".$online."</td>";
				$column++;
				if ($column == $frcolumn + 1) {
					$text .= "</tr>";
					$column = 1;
				}
			}
			if ($this->var['euser_pref']['buttontype'] == "Yes") {
				$text .= "</table><br><input type='image' name='submit_delete' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_delete_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_delete.gif\"'  src='images/buttons/".e_LANGUAGE."_delete.gif' ></form>";
			} else {
				$text .= "</table><input type='submit' name='submit_delete' value='".PROFILE_187."' class='button'></form>";
			}
		}

		$friend = "|";
//			$query = "SELECT user_id, user_friends_request FROM ".MPREFIX."euser WHERE user_friends_request like '%|".$this->var['user_id']."|%' ";
//			$result = mysql_query($query);
//			while($noticia = mysql_fetch_array($result)) {
		$sql->select("euser", "user_id, user_friends_request", "user_friends_request like '%|{$this->var['user_id']}|%' ");
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
					$text .= "<br/></a><input type='hidden' name='uid' value='".$this->var['user_id']."'><input type='checkbox' name='boxfr[]' value='".$fr."'> ".$name['user_name']." ".$online."</td>";
					$column++;
					if ($column == $frcolumn + 1) {
						$text .= "</tr>";
						$column = 1;
					}
				}
			}
			if ($this->var['euser_pref']['buttontype'] == "Yes") {
				$text .= "</table><br><input type='image' name='submit_delete' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_delete_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_delete.gif\"'  src='images/buttons/".e_LANGUAGE."_delete.gif' ></form>";
			} else {
				$text .= "</table><input type='submit' name='submit_delete' value='".PROFILE_188."' class='button'></form>";
			}
		}
//	}






//				$numfriends = count($friend);
			}	
			
			if ($udata['user_friends'] == '' || $udata['user_friends'] == '|') {
					// EXIBIÇÃO SE NÃO HOUVER AMIGOS
//					$text .= "<br><table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/friends.png'>&nbsp;<i>".PROFILE_30."</i></td></tr></table>";
          $start = $this->tp->parseTemplate($euser_template['friends_no'], TRUE, $this);
//					$text .= "<table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/friends.png' style='vertical-align:middle'>&nbsp;<i>".PROFILE_30."</i></td></tr></table>";
				
//var_dump ($text);

} else {  
// EXIBIÇÃO NO PERFIL NORMAL, EXIBIDO POR DEFEITO
//PARA REMODELAR E VERIFICAR DAQUI PARA BAIXO.....
	if ($this->var['euser_pref']['frcol'] == '') {
		$frcolumn = '6';
	} elseif ($this->var['euser_pref']['frcol'] > '8') {
		$frcolumn = '8';
	} else {
		$frcolumn = $this->var['euser_pref']['frcol'];
	}

/*					$text .= "<br><table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/friends.png'>&nbsp;<i>".$numfriends." " .PROFILE_31." </i></td></tr></table>";
					$text .= "<table width='100%'>";
*/
//$euser_template = e107::getTemplate('euser', 'euser_settings');

$text = "<table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/friends.png' style='vertical-align:middle'>&nbsp;<i>".$numfriends." " .PROFILE_31." </i></td></tr><tr>";
					$text .= "<td><table width='100%'>";
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
/*
						if( $check > 0 ) {
							$online = "<img src='images/online.gif' title='".PROFILE_96."' style='vertical-align: top;' />";
						} else {
							$online = "";
						}
*/
$online = "<img src='images/".(( $check > 0 )?"green_good":"gray_neutral").".png' title='".(( $check > 0 )?PROFILE_96:PROFILE_97)."' style='vertical-align: bottom;' />";



						unset($check,$on_name);
						$text .= "<td class='forumheader3' width = '10%'><div align='center'><a href='euser.php?id=".$fr."'>";
						if($name[user_image] == "") {
							$text .= "<img src='".e_PLUGIN."euser/images/noavatar.png' width='64' alt='' />";
						}else{
							$user_image = $name[user_image];
							require_once(e_HANDLER."avatar_handler.php");
							$user_image = avatar($user_image);
							$text .= "<img src='".$user_image."' width='64' alt='' />";
						}
						$text .= "<br/></a>".$online." ".$name['user_name']."</div></td>";
						$column++;
						if ($column == $frcolumn + 1) {
							$text .= "</tr>";
							$column = 1;
						}
					}
					$text .= "</table></td></tr></table>";
//					$text .= "<br/><table width='100%' ><tr><td class='forumheader' colspan='3' ><div class='smallblacktext'><a href='".e_SELF."?".e_QUERY."#top' onclick=\"window.scrollTo(0,0);\">".PROFILE_271."</a></div></td></tr></table>";
				}

return $start.$text;