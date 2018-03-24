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
				if ($this->euser_pref['frcol'] == '') {
					$frcolumn = '6';
				} elseif ($this->euser_pref['frcol'] > '8') {
					$frcolumn = '8';
				} else {
					$frcolumn = $this->euser_pref['frcol'];
				}

/*
				$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."euser WHERE user_id='".$this->var['user_id']."' ");
				$list = $sql->db_Fetch();
*/
        $list = $this->euser_data;
        
				$friend = explode("|", $list['user_friends']);
//				$num = count($friend) - 2;
				$num = count($friend) - 1;
//        var_dump(count($friend));
//var_dump(($num?:NULL));

        global $euser_template;
//        var_dump ($euser_template);
        $euser_template['friends_caption'] = $this->tp->lanVars($euser_template['friends_caption'], array('x'=>($num>0?$num:NULL)));
        
                if (isset($parm['caption'])){return $this->tp->parseTemplate($euser_template['friends_caption'], TRUE, $this);}



//				$num = count($friend);
				if ($list['user_friends'] == '' or $list['user_friends'] == '|') {
//					$text .= "<br><table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/friends.png'>&nbsp;<i>".PROFILE_30."</i></td></tr></table>";
          $text .=$this->tp->parseTemplate($euser_template['friends_no'], TRUE, $user_sc);;
//					$text .= "<table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/friends.png' style='vertical-align:middle'>&nbsp;<i>".PROFILE_30."</i></td></tr></table>";
				} else {
/*					$text .= "<br><table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/friends.png'>&nbsp;<i>".$num." " .PROFILE_31." </i></td></tr></table>";
					$text .= "<table width='100%'>";
*/
					$text .= "<table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/friends.png' style='vertical-align:middle'>&nbsp;<i>".$num." " .PROFILE_31." </i></td></tr><tr>";
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
return $text;
?>
