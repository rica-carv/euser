<?php
if (!defined('e107_INIT') || !e107::isInstalled('euser')) { exit; }
// ######### PARA TEMPLATIZAR!!!!!!!!!!

//echo "<hr>AQUI";

//var_dump (!defined('e107_INIT') || ((!check_class($orderclass)) && !e107::isInstalled('euser')));

//var_dump ($orderclass);
/*
		$ordersql=new db;
//		$script="SELECT * FROM ".MPREFIX."euser_cache Where type='order' and cache='currentlyonline.php' ORDER BY type_order";

//    echo "--SCRIPT 1:".$script;
    
$ordersql->db_Select_gen("SELECT * FROM ".MPREFIX."euser_cache Where type='order' and cache='friends.php' ORDER BY type_order");
		
//    echo "--ONLINE INFO ORDER:".$onlineinfoorder;

$orderrow = $ordersql->db_Fetch();
//		 $orderhide=$orderrow['cache_hide'];
//		 $orderclass=$orderrow['cache_userclass'];
if (!check_class($orderrow['cache_userclass'])) { exit; }
*/
global $euser_pref, $tp, $sql;

// ###########################################
// Provavelmente há aqui coisas duplicadas, que eu juntei dois scripts num só.
// Verificar depois...
// ###########################################
//var_dump (OIM_TYPE);

    if (defined('UPROF')){
//var_dump ("Olá");
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
				if ($euser_pref['frcol'] == '') {
					$frcolumn = '6';
				} elseif ($euser_pref['frcol'] > '8') {
					$frcolumn = '8';
				} else {
					$frcolumn = $euser_pref['frcol'];
				}

// Depois tenho de usar o gettemplate, novo na v2
if(!defined('IMAGE_new'))
{
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
}

				$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
				$list = $sql->db_Fetch();
				$friend = explode("|", $list['user_friends']);
				$num = count($friend) - 2;
//				$num = count($friend);
//					$text = "<table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><span class='fa-friendsstack fa-2x'>".$tp->toGlyph('user').$tp->toGlyph('user').$tp->toGlyph('user')."</span>&nbsp;<i>";
//					$caption = "<span class='fa-friendsstack fa-2x'>".$tp->toGlyph('user').$tp->toGlyph('user').$tp->toGlyph('user')."</span>&nbsp;<i>";
					$caption = IMAGE_friends."<i>";
				if ($list['user_friends'] == '' or $list['user_friends'] == '|') {
//					$text .= "<br><table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/friends.png'>&nbsp;<i>".PROFILE_30."</i></td></tr></table>";
//					$text .= "<table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/friends.png' style='vertical-align:middle'>&nbsp;<i>".PROFILE_30."</i></td></tr></table>";
//					$text .= PROFILE_30."</i></td></tr></table>";
					$caption .= PROFILE_30."</i>";
				} else {
/*					$text .= "<br><table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/friends.png'>&nbsp;<i>".$num." " .PROFILE_31." </i></td></tr></table>";
					$text .= "<table width='100%'>";
*/
//					$text .= "<table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/friends.png' style='vertical-align:middle'>&nbsp;<i>".$num." " .PROFILE_31." </i></td></tr><tr>";
//					$text .= $num." " .PROFILE_31." </i></td></tr><tr>";
					$caption .= $num." " .PROFILE_31." </i>";
//					$text .= "<td><table width='100%'>";
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
//  return $text;
} else {
//if((check_class($orderclass)) && (isset($euser_pref['plug_installed']['euser'])))
//{
//e107::lan('euser',false, true);
/*
if(file_exists(e_PLUGIN."euser/languages/".e_LANGUAGE.".php")){
	require_once(e_PLUGIN."euser/languages/".e_LANGUAGE.".php");
} else {
	require_once(e_PLUGIN."euser/languages/English.php");
}
*/
/*
//   // here is a much more elegant method to check if a table exists ( no error generate)

if( mysql_num_rows( mysql_query("SHOW TABLES LIKE '".$table."'")))
{
 //...
}
*/

$friendtext="";
$friendonline=0;
$user_id=$_POST['id'];

//My Friends Array
//		$sql->mySQLresult = @mysql_query("SELECT user_friends, user_friends_request FROM ".MPREFIX."euser WHERE user_id='".$user_id."' ");
//		$sql->mySQLresult = @mysql_query("SELECT user_friends, user_friends_request FROM ".MPREFIX."euser WHERE user_id='".USERID."' ");
		$sql->select("euser", "user_friends, user_friends_request", "user_id='".USERID."'");

/*
echo "<hr>";
echo "SELECT user_friends, user_friends_request FROM ".MPREFIX."euser WHERE user_id='".USERID."' ";
echo "<hr>";
*/
//		$settings = $sql->db_Fetch();
		$settings = $sql->fetch();
		$friendb = explode("|", $settings['user_friends']);
		$friendb1 = explode("|", $settings['user_friends_request']);

/*
echo "FRIENDB:";
echo displayArrayContentFunction($friendb);
echo "<hr>FRIENDB1:";
echo displayArrayContentFunction($friendb1);
*/

//End My Friends Array

// INICIO DA LISTA DE AMIGOS

    array_pop($friendb);
    $friendb = array_reverse($friendb);
    array_pop($friendb);
    $friendb = array_reverse($friendb);
    $numamigos = count($friendb); 

		$sql2=new db;
		
//		$query="SELECT ".MPREFIX."user.user_login,".MPREFIX."user.user_name,".MPREFIX."user.user_id,".MPREFIX."user.user_currentvisit FROM ".MPREFIX."euser_friends left join ".MPREFIX."user ON ".MPREFIX."user.user_id=".MPREFIX."euser_friends.amigo_amigo  WHERE ".MPREFIX."euser_friends.amigo_user='".USERID."'";
		$query="SELECT user_login, user_name, user_id, user_currentvisit FROM ".MPREFIX."user WHERE ".MPREFIX."user.user_id IN (".implode(',',$friendb).")";
		
/*
echo "<hr>";
echo $query;
*/

		$sql2->db_Select_gen($query);
				while ($row = $sql2->db_Fetch()) {
//			$amigo=true;
			extract($row);
			$gen = new convert;
			$datestamp = $gen->convert_date($user_currentvisit);
			
			$sql3=new db;
			$sql3 -> db_Select("online", "*", "online_user_id='".$user_id.".".$user_name."' ");


			if ($row3 = $sql3 -> db_Fetch()){$friendonline++;}
} 

// OUTPUT START
if ($friendonline!=0){$friendtext="<img src='".e_PLUGIN."euser/images/fonline.gif' style='vertical-align:middle; border:0;'  alt='".AMIGO_22."' />";}

//var_dump (OIM_TYPE);
//var_dump ($orderhide);
// O tipo de menu passa a ser definido no próprio template... isto tem de sair daqui, para um shortcode, por exemplo... ou com uma constante definida no próprio template...
    if ($euser_pref['loginmenutype']==0){
//---->      $text .= "<a id='friend-title' title='".AMIGO_TITULO."&nbsp;(".$numamigos.")'><img src='".e_PLUGIN."euser/images/members_friend".($euser_pref['loginmenutype']==0?"_24":"").".png' style='border:0; vertical-align: middle'/>&nbsp;".AMIGO_TITULO."&nbsp;(".$numamigos.")</a>";
//      $text .= "<a ".($numamigos>0?"id='friend-title' ":"")."title='".AMIGO_TITULO."&nbsp;(".$numamigos.")'><img src='".e_PLUGIN."euser/images/members_friend".($euser_pref['loginmenutype']==0?"":"_24").".png' style='border:0; vertical-align: middle'/>&nbsp;".AMIGO_TITULO."&nbsp;(".$numamigos.")</a>";
/// PORQUÊ UM TAG A AQUI????

      $caption .= "<a ".($numamigos>0?"id='friend-title' ":"")."title='".AMIGO_TITULO."&nbsp;(".$numamigos.")'><span class='fa-friendsstack ".($euser_pref['loginmenutype']==0?"":"fa-2x")."'>".$tp->toGlyph('user').$tp->toGlyph('user').$tp->toGlyph('user')."</span>&nbsp;".AMIGO_TITULO."&nbsp;(".$numamigos.")</a>";
    } else {

//    if ($orderhide == 1)
    if ($orderrow['cache_hide'] == 1)
    {
        $text .= "<div id='friend-title' style='cursor:hand; text-align:left; font-size: ".$onlineinfomenufsize."px; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".AMIGO_TITULO."'>".$friendtext."&nbsp;".AMIGO_TITULO."&nbsp;($numamigos)</div>";
		$text .= "<div id='friend' class='switchgroup1' style='display:none; margin-left:5px; width:100%'>";
    } else {
             $text .= "<div class='smallblacktext' style='font-size: ".$onlineinfomenufsize."px; font-weight:bold; margin-left:5px; margin-top:10px; width:".$onlineinfomenuwidth."'>".$friendtext."&nbsp;".AMIGO_TITULO."&nbsp;($numamigos)</div><div style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'>";
    }
////_    }

//	$amigo=false;

	if(isset($_POST['addbuddy']))
// USO DO ANOTHER PROFILES - USA O SCRIPT ORIGINAL DO ANOTHER PROFILES
{
//		if (isset($_GET['add'])) {
			$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."euser WHERE user_id='".$user_id."' ");

			$list = $sql->db_Fetch();
			$friend = explode("|", $list['user_friends']);
			$megjelolt = explode("|", $list['user_friends_request']);

			$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."euser WHERE user_id='".USERID."' ");
			$te_list = $sql->db_Fetch();
			$megjeloltek = explode("|", $te_list['user_friends_request']);

/*
			$sql->mySQLresult = @mysql_query("SELECT user_id, user_name FROM ".MPREFIX."user WHERE user_id='".$user_id."' ");
			$ures = $sql->db_Fetch();
			$uresek = ($ures['user_name']);
*/

	$sql-> db_Select("user","user_name","user_id = '$user_id'");
	while($row = $sql -> db_Fetch()) {
		$uresek = $row['user_name'];
	}

/*
echo "----------SQL: >  ";
echo $sql;
echo "-------------------URES: >  ";
echo $ures['user_id'];
echo "-----------------------------------------------ID: >  ";
echo $user_id ;

$arr = array("foo" => "bar", 12 => true);
echo "----------ARR (TESTE): >  ";
echo displayArrayContentFunction($arr);
*/


	       $error_icon = "<img src='".e_PLUGIN."euser/images/error.png' style='vertical-align:middle' width='15' height='15' alt='IMPORTANT!' title='IMPORTANT!' />&nbsp;&nbsp;";

			// Saját magad nem:
			if (USERID == $user_id) {
  			$text .= $error_icon.PROFILE_100."<p/>";
				//Csak tagok
			} elseif (!USER) {
				$text .= $error_icon.PROFILE_161."<p/>";
				//Már barátod
			} elseif (in_array(USERID, $friend)) {
				$text .= $error_icon.PROFILE_140."<p/>";
				//Már megjelölted
			} elseif (in_array(USERID, $megjelolt)) {
				$text .= $error_icon.PROFILE_140a."<p/>";
				//Már megjelölt
			} elseif (in_array($user_id, $megjeloltek)) {
				$text .= $error_icon.PROFILE_140b."<p/>";
				// Trükközés:
			} elseif ($uresek == '') {
				$text .= $error_icon.PROFILE_140c."<p/>";
			} else {
				$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends FROM ".MPREFIX."euser WHERE user_id='".USERID."' ");
				$yourows = $sql->db_Rows();
				$you = $sql->db_Fetch();
				$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."euser WHERE user_id='".$user_id."' ");
				$themrows = $sql->db_Rows();
				$them = $sql->db_Fetch();
/*				if ($_POST['add_no']) {
					header("Location: euser.php?id=".$user_id."");
				} else
*/        
        if ($_POST['add_yes']) {
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
						$sql -> db_Update("euser", "user_friends_request='".$request."' WHERE user_id='".$user_id."' ");
					} else {
						$sql -> db_Insert("euser", "'".$user_id."', '', '', '', '".$request."', '', '', '', '0', '0', ''  ");
					}

					$sql->mySQLresult = @mysql_query("SELECT user_settings FROM ".MPREFIX."euser WHERE user_id='".$user_id."' ");
					$settings = $sql->db_Fetch();
					$break = explode("|",$settings['user_settings']);
					if ($euser_pref['fr_req_sendpm'] == 'Yes') {
						if ($break[5] == 1 || !$settings[0] || $euser_pref['fr_req_sendpm_all'] == 'on') {
							$userfrom = get_user_data(USERID);
							$userfrom = $userfrom['user_name'];
							$msg = "<a href=\'".e_PLUGIN."euser/euser.php?id=".USERID."\'>".$userfrom."</a>".PROFILE_209."<br><br><a href=\'".e_PLUGIN."euser/euser_settings.php?page=friends&acceptadd=".USERID."\'>".PROFILE_210."</a> | <a href=\'".e_PLUGIN."euser/euser_settings.php?page=friends&rejectadd=".USERID."\'>".PROFILE_211."</a>";
							$size = strlen($msg);
							$sendpm = mysql_query("INSERT INTO ".MPREFIX."private_msg (pm_id, pm_from, pm_to, pm_sent, pm_read, pm_subject, pm_text, pm_sent_del, pm_read_del, pm_attachments, pm_option, pm_size) VALUES('', '".USERID."', '".$user_id."', '".intval(time())."', '0', '".PROFILE_212."', '".$msg."', '1', '0', '', '', '".intval($size)."' ) ");
						}
					} else {
						if ($break[5] == 1 && $euser_pref['fr_req_sendpm_all'] != 'on') {
							$userfrom = get_user_data(USERID);
							$userfrom = $userfrom['user_name'];
							$msg = "<a href=\'".e_PLUGIN."euser/euser.php?id=".USERID."\'>".$userfrom."</a>".PROFILE_209."<br><br><a href=\'".e_PLUGIN."euser/euser_settings.php?page=friends&acceptadd=".USERID."\'>".PROFILE_210."</a> | <a href=\'".e_PLUGIN."euser/euser_settings.php?page=friends&rejectadd=".USERID."\'>".PROFILE_211."</a>";
							$size = strlen($msg);
							$sendpm = mysql_query("INSERT INTO ".MPREFIX."private_msg (pm_id, pm_from, pm_to, pm_sent, pm_read, pm_subject, pm_text, pm_sent_del, pm_read_del, pm_attachments, pm_option, pm_size) VALUES('', '".USERID."', '".$user_id."', '".intval(time())."', '0', '".PROFILE_212."', '".$msg."', '1', '0', '', '', '".intval($size)."' ) ");
						}
					}
					//EMAIL TO USER
					if ($euser_pref['fr_req_sendemail'] == 'Yes') {
						if ($break[11] == 1 || !$settings[0] || $euser_pref['fr_req_sendemail_all'] == 'on') {
							$sql->mySQLresult = @mysql_query("SELECT user_email FROM ".MPREFIX."user WHERE user_id='".$user_id."' ");
							$useremail = $sql->db_Fetch();
							$useremail = $useremail['user_email'];
							$userfrom = get_user_data(USERID);
							$userfrom = $userfrom['user_name'];
							$oldal_url = SITEURL.$PLUGINS_DIRECTORY."euser/euser_settings.php?page=friends";
//							$email_msg = "<b>".PROFILE_209b.$username."!</b><br><br>".$userfrom.PROFILE_209a.PROFILE_209c.SITENAME.PROFILE_209d."<br><br>".PROFILE_209e."<a href=".$oldal_url.">link</a>";
							$email_msg = "<b>".PROFILE_209b.$uresek."!</b><br><br>".$userfrom.PROFILE_209a.PROFILE_209c.SITENAME.PROFILE_209d."<br><br>".PROFILE_209e."<a href=".$oldal_url.">link</a>";
							require_once(e_HANDLER . "mail.php");
//							sendemail($useremail, PROFILE_212, $email_msg, $username, SITEADMINEMAIL, SITENAME);
							sendemail($useremail, PROFILE_212, $email_msg, $uresek, SITEADMINEMAIL, SITENAME);
						}
					} else {
						if ($break[11] == 1 && $euser_pref['fr_req_sendemail_all'] != 'on') {
							$sql->mySQLresult = @mysql_query("SELECT user_email FROM ".MPREFIX."user WHERE user_id='".$user_id."' ");
							$useremail = $sql->db_Fetch();
							$useremail = $useremail['user_email'];
							$userfrom = get_user_data(USERID);
							$userfrom = $userfrom['user_name'];
							$oldal_url = SITEURL.$PLUGINS_DIRECTORY."euser/euser_settings.php?page=friends";
//							$email_msg = "<b>".PROFILE_209b.$username."!</b><br><br>".$userfrom.PROFILE_209a.PROFILE_209c.SITENAME.PROFILE_209d."<br><br>".PROFILE_209e."<a href=".$oldal_url.">link</a>";
							$email_msg = "<b>".PROFILE_209b.$uresek."!</b><br><br>".$userfrom.PROFILE_209a.PROFILE_209c.SITENAME.PROFILE_209d."<br><br>".PROFILE_209e."<a href=".$oldal_url.">link</a>";
							require_once(e_HANDLER . "mail.php");
//							sendemail($useremail, PROFILE_212, $email_msg, $username, SITEADMINEMAIL, SITENAME);
							sendemail($useremail, PROFILE_212, $email_msg, $uresek, SITEADMINEMAIL, SITENAME);
						}
					}
//					$text .= "<br/>".PROFILE_40." ".$username." ".PROFILE_41."";
					$text .= PROFILE_40." ".$uresek." ".PROFILE_41."<p/>";
				} else {
//					$text .= "<br/><center><b>".PROFILE_42." ".$username." ".PROFILE_43."</b><br/><br/><form method='post'><input class='button' type='submit' name='add_yes' value='".PROFILE_44."' />&nbsp;<input class='button' type='submit' name='add_no' value='".PROFILE_45."' /></form></center>";
					$text .= "<br/><center><b>".PROFILE_42." ".$uresek." ".PROFILE_43."</b><br/><br/><form method='post'><input class='button' type='submit' name='add_yes' value='".PROFILE_44."' />&nbsp;<input class='button' type='submit' name='add_no' value='".PROFILE_45."' /></form></center>";
				}
			}
//		}


////if (isset($euser_pref['plug_installed']['euser']))
//
/*		if (!$sql -> db_Select("euser_friends", "*", "amigo_user='".USERID."' AND amigo_amigo='".$_POST['buddy']."'"))
		{
			if ($sql -> db_Insert("euser_friends", "0, '".USERID."', '".$_POST['buddy']."' "))
			
			{
        $text.="<div>Amigo adicionado</div>";
			}else
			{
			$text.= "<div style='text-align:center;font-weight:bold;padding: 5px 5px 5px 5px;'><img src='".e_PLUGIN."euser/images/error.png' style='vertical-align:middle' width='15' height='15' alt='IMPORTANT!' title='IMPORTANT!' />&nbsp;&nbsp;".AMIGO_8."</div>";

			}
		}else
		{
		$text.= "<div style='text-align:center;font-weight:bold;padding: 5px 5px 5px 5px;'><img src='".e_PLUGIN."euser/images/error.png' style='vertical-align:middle' width='15' height='15' alt='IMPORTANT!' title='IMPORTANT!' />&nbsp;&nbsp;".AMIGO_5."</div>";

		}
*/		
	}



	if(isset($_GET['remove']))
	{
		if ($sql -> db_Select("euser_friends", "*", "amigo_user='".USERID."' AND amigo_amigo='$_GET[remove]' ")){
			if ($sql -> db_Delete("euser_friends", "amigo_user='".USERID."' AND amigo_amigo='$_GET[remove]' ")) {

			}else
			{
				$text.= "<div style='text-align:center;font-weight:bold;padding: 5px 5px 5px 5px;'><img src='".e_PLUGIN."euser/images/error.png' style='vertical-align:middle' width='15' height='15' alt='IMPORTANT!' title='IMPORTANT!' />&nbsp;&nbsp;".AMIGO_6."</div>";

			}
	  	}else{
			$text.= "<div style='text-align:center;font-weight:bold;padding: 5px 5px 5px 5px;'><img src='".e_PLUGIN."euser/images/error.png' style='vertical-align:middle' width='15' height='15' alt='IMPORTANT!' title='IMPORTANT!' />&nbsp;&nbsp;".AMIGO_7."</div>";

	  	}
	}
	// To create a list of users to choose


//        $text .= "<div id='newamigo-title' style='cursor:hand; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".AMIGO_21."'>&nbsp;".AMIGO_21."</div>";
        $text .= "<div id='newamigo-title' style='cursor:hand; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".PROFILE_42a."'>&nbsp;".MENU_PROFILE_1a."&nbsp;".AMIGO_PROFILE_4.":</div>";
//		$text .= "<div id='newamigo' class='switchgroup1' style='display:none; margin-left:20px;'>";

// USO DO ANOTHER PROFILES - USA O SCRIPT ORIGINAL DO ANOTHER PROFILES

//		$text.="<form action='".e_SELF."' method='post' id='buddygeraffel'><select class='tbox' name='buddy' size='1' width='10'>";
//////		$text .= "<a href='".e_PLUGIN."euser/euser.php?id=".$user_id."&add' style=\"text-decoration: none;\" title='".PROFILE_16."'><img src='".e_PLUGIN."images/buttons/".e_LANGUAGE."_addfriend.png' border='0'></a>";
		
    $text.="<form action='".e_SELF."' method='post' id='buddygeraffel'>";

$text.="<input type='hidden' name='addbuddy' value=''>";
    $text.="<select class='tbox' name='id' size='1' width='10'>";



		$sql -> db_Select("user", "user_login,user_name,user_id","user_name Like '%' ORDER BY user_name ");
		while ($row = $sql -> db_Fetch())
		{
			extract($row);
			if ($user_id<>USERID ) {
				$text.="<option value='".$user_id."'>".($euser_pref['realname']==1 && $user_login <> "" ? $user_login : $user_name)."</option>";
			}
		}

//		$text.="</select>&nbsp;<input class='button' type='submit' name='add_yes' value='".AMIGO_13."' title='".AMIGO_11."'></form>";
		$text.="</select>&nbsp;<input class='button' type='submit' name='add_yes' value='".PROFILE_71."' title='".PROFILE_42a."'></form>";

//		$text.="<hr>";
////////////////////////////////////////////////////////////// FIM DO USO DO ANOTHER PROFILES

//		$text.="</div>";


// INICIO DA LISTA DE PEDIDOS DE AMIZADE ENVIADOS

//		$query="SELECT ".MPREFIX."user.user_login,".MPREFIX."user.user_name,".MPREFIX."user.user_id,".MPREFIX."user.user_currentvisit FROM ".MPREFIX."euser_friends left join ".MPREFIX."user ON ".MPREFIX."user.user_id=".MPREFIX."euser_friends.amigo_amigo  WHERE ".MPREFIX."euser_friends.amigo_user='".USERID."'";
		$query="SELECT user_login, user_name, ".MPREFIX."user.user_id, user_currentvisit FROM ".MPREFIX."user LEFT JOIN ".MPREFIX."euser ON ".MPREFIX."user.user_id = ".MPREFIX."euser.user_id WHERE user_friends_request like '%|".USERID."|%' ";    


// SELECT user_login, user_name, e107_user.user_id, user_currentvisit FROM e107_user LEFT JOIN e107_euser ON e107_user.user_id = e107_euser.user_id WHERE user_friends_request like '%|1|%'

//			$query = "SELECT user_id, user_friends_request FROM ".MPREFIX."euser WHERE user_friends_request like '%|".USERID."|%' ";

//echo "<hr>";
//echo $query;
		
		$sql2->db_Select_gen($query);

/*
echo "<hr>SQL2:";
echo displayArrayContentFunction($sql2);
echo "<hr>MYSQLROWS:";
echo $sql2rows = $sql2->db_Rows();
*/
    $numamienv = $sql2->db_Rows();
    
        $text .= "<div id='myfriendreqs-title' style='cursor:hand; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".PROFILE_31b."'>&nbsp;".MENU_PROFILE_1." ".AMIGO_PROFILE_1." (".$numamienv."), ".AMIGO_PROFILE_4.":</div>";
		$text .= "<div id='myfriendreqs' class='switchgroup1' style='display:none'>";

				while ($row = $sql2->db_Fetch()) {

// HIPÓTESE PARA DESLIGAR A LISTA DE TODO
/*
        $text .= "<div id='myfriendreq-title' style='cursor:hand; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".PROFILE_31b."'>&nbsp;".PROFILE_31b."</div>";
		$text .= "<div id='myfriendreq' class='switchgroup1' style='display:none'>";
*/
//			$amigo=true;
			extract($row);
			$gen = new convert;
			$datestamp = $gen->convert_date($user_currentvisit);

			$sql3=new db;
			$sql3 -> db_Select("online", "*", "online_user_id='".$user_id.".".$user_name."' ");


			if ($row3 = $sql3 -> db_Fetch()){

				$text .="<img src='".e_PLUGIN."euser/images/online_mini.png' alt='".AMIGO_14."' />";
			} else {

				$text .="<img src='".e_PLUGIN."euser/images/offline_mini.png' alt='".AMIGO_15."' />";
			}


			$text.="&nbsp;<a title='".AMIGO_18." ".$datestamp."' href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".($euser_pref['realname']==1 && $user_login <> "" ? $user_login : $user_name)."</a>&nbsp;
			<a href='".e_PLUGIN."pm/pm.php?send.$user_id'><img src='".e_PLUGIN."euser/images/icon_pm.png' height='16px' alt='".AMIGO_16."' title='".AMIGO_16."' border='0' id='im' /></a>&nbsp;
			<a href='".e_SELF."?remove=$user_id'><img src='".e_PLUGIN."euser/images/delete.png' alt='".AMIGO_17."' title='".AMIGO_17."' border='0' id='im' /></a><br />";

		}
	
// HIPÓTESE PARA DESLIGAR A LISTA DE TODO
/*
	if ($amigo) {
    $text .= "</div>";
	}
*/

	// Warning if the list is empty
//	if (!$amigo) {
	if ($numamienv == 0) {
		$text.=AMIGO_PROFILE_3.AMIGO_PROFILE_1."<br />";
	}
$text .= "</div>";

// INICIO DA LISTA DE PEDIDOS DE AMIZADE RECEBIDOS
    array_pop($friendb1);
    $friendb1 = array_reverse($friendb1);
    array_pop($friendb1);
    $friendb1 = array_reverse($friendb1);
    $numamirec = count($friendb1);

        $text .= "<div id='myfriendreqr-title' style='cursor:hand; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;".(($numamirec == 0)?"":"background-color:yellow")
."' title='".PROFILE_31b."'>&nbsp;".MENU_PROFILE_1." ".AMIGO_PROFILE_2." (".$numamirec."), ".AMIGO_PROFILE_5.":</div>";
		$text .= "<div id='myfriendreqr' class='switchgroup1' style='display:none'>";

//		$query="SELECT ".MPREFIX."user.user_login,".MPREFIX."user.user_name,".MPREFIX."user.user_id,".MPREFIX."user.user_currentvisit FROM ".MPREFIX."euser_friends left join ".MPREFIX."user ON ".MPREFIX."user.user_id=".MPREFIX."euser_friends.amigo_amigo  WHERE ".MPREFIX."euser_friends.amigo_user='".USERID."'";
//echo "<hr>FRIENDB1: ";
//echo displayArrayContentFunction($friendb1);

//echo "<hr>FRIENDB1: ";
//echo displayArrayContentFunction($friendb1);

//echo "<hr>";
//echo displayArrayContentFunction($friendb);

		$query="SELECT user_login, user_name, user_id, user_currentvisit FROM ".MPREFIX."user WHERE ".MPREFIX."user.user_id IN (".implode(',',$friendb1).")";

//		$query="SELECT user_login, user_name, ".MPREFIX."user.user_id, user_currentvisit FROM ".MPREFIX."user LEFT JOIN ".MPREFIX."euser ON ".MPREFIX."user.user_id = ".MPREFIX."euser.user_id WHERE user_friends_request like '%|".USERID."|%' ";    


// SELECT user_login, user_name, e107_user.user_id, user_currentvisit FROM e107_user LEFT JOIN e107_euser ON e107_user.user_id = e107_euser.user_id WHERE user_friends_request like '%|1|%'

//			$query = "SELECT user_id, user_friends_request FROM ".MPREFIX."euser WHERE user_friends_request like '%|".USERID."|%' ";

//echo "<hr>RECEBIDOS: ";
//echo $query;
		
		$sql2->db_Select_gen($query);
				while ($row = $sql2->db_Fetch()) {

// HIPÓTESE PARA DESLIGAR A LISTA DE TODO
/*
        $text .= "<div id='myfriendreq-title' style='cursor:hand; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".PROFILE_31b."'>&nbsp;".PROFILE_31b."</div>";
		$text .= "<div id='myfriendreq' class='switchgroup1' style='display:none'>";
*/
//			$amigo=true;
			extract($row);
			$gen = new convert;
			$datestamp = $gen->convert_date($user_currentvisit);

			$sql3=new db;
			$sql3 -> db_Select("online", "*", "online_user_id='".$user_id.".".$user_name."' ");


			if ($row3 = $sql3 -> db_Fetch()){

				$text .="<img src='".e_PLUGIN."euser/images/online_mini.png' alt='".AMIGO_14."' />";
			} else {

				$text .="<img src='".e_PLUGIN."euser/images/offline_mini.png' alt='".AMIGO_15."' />";
			}


			$text.="&nbsp;<a title='".AMIGO_18." ".$datestamp."' href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".($euser_pref['realname']==1 && $user_login <> "" ? $user_login : $user_name)."</a>&nbsp;
			<a href='".e_PLUGIN."pm/pm.php?send.$user_id'><img src='".e_PLUGIN."euser/images/icon_pm.png' height='16px' alt='".AMIGO_16."' title='".AMIGO_16."' border='0' id='im' /></a>&nbsp;
			<a href='".e_SELF."?remove=$user_id'><img src='".e_PLUGIN."euser/images/delete.png' alt='".AMIGO_17."' title='".AMIGO_17."' border='0' id='im' /></a><br />";

		}
	
// HIPÓTESE PARA DESLIGAR A LISTA DE TODO
/*
	if ($amigo) {
    $text .= "</div>";
	}
*/

	// Warning if the list is empty
//	if (!$amigo) {
	if ($numamirec == 0) {
		$text.=AMIGO_PROFILE_3.AMIGO_PROFILE_2."<br />";
	}
$text .= "</div>";

// INICIO DA LISTA DE AMIGOS

/*
    array_pop($friendb);
    $friendb = array_reverse($friendb);
    array_pop($friendb);
    $friendb = array_reverse($friendb);
    $numamigos = count($friendb); 
*/
        $text .= "<div id='myfriend-title' style='cursor:hand; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".AMIGO_23."'>&nbsp;".AMIGO_23." (".$numamigos.")</div>";
		$text .= "<div id='myfriend' class='switchgroup1' style='display:none'>";




//		$query="SELECT ".MPREFIX."user.user_login,".MPREFIX."user.user_name,".MPREFIX."user.user_id,".MPREFIX."user.user_currentvisit FROM ".MPREFIX."euser_friends left join ".MPREFIX."user ON ".MPREFIX."user.user_id=".MPREFIX."euser_friends.amigo_amigo  WHERE ".MPREFIX."euser_friends.amigo_user='".USERID."'";
//echo displayArrayContentFunction($friendb);

//echo "<hr>";
//echo displayArrayContentFunction($friendb);

		$query="SELECT user_login, user_name, user_id, user_currentvisit FROM ".MPREFIX."user WHERE ".MPREFIX."user.user_id IN (".implode(',',$friendb).")";

/*
echo "<hr>";
echo implode(',',$friendb);
echo "<hr>";
echo $query;
*/
		
		$sql2->db_Select_gen($query);
				while ($row = $sql2->db_Fetch()) {
//			$amigo=true;
			extract($row);
			$gen = new convert;
			$datestamp = $gen->convert_date($user_currentvisit);

			$sql3=new db;
			$sql3 -> db_Select("online", "*", "online_user_id='".$user_id.".".$user_name."' ");


			if ($row3 = $sql3 -> db_Fetch()){

				$text .="<img src='".e_PLUGIN."euser/images/online_mini.png' alt='".AMIGO_14."' />";
			} else {

				$text .="<img src='".e_PLUGIN."euser/images/offline_mini.png' alt='".AMIGO_15."' />";
			}


			$text.="&nbsp;<a title='".AMIGO_18." ".$datestamp."' href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".($euser_pref['realname']==1 && $user_login <> "" ? $user_login : $user_name)."</a>&nbsp;
			<a href='".e_PLUGIN."pm/pm.php?send.$user_id'><img src='".e_PLUGIN."euser/images/icon_pm.png' height='16px' alt='".AMIGO_16."' title='".AMIGO_16."' border='0' id='im' /></a>&nbsp;
			<a href='".e_SELF."?remove=$user_id'><img src='".e_PLUGIN."euser/images/delete.png' alt='".AMIGO_17."' title='".AMIGO_17."' border='0' id='im' /></a><br />";

		}
	

	// Warning if the list is empty
//	if (!$amigo) {
	if ($numamigos == 0) {
		$text.=AMIGO_1."<br />";
	}
$text .= "<br /></div>";

// INICIO DA LISTA DE QUEM SOU AMIGO
// LISTA DESNECESSÁRIA PORQUE O ANOTHER PROFILES COLOCA LOGO AMBOS OS UTILIZADORES COMO AMIGOS, LOGO SÓ DUPLICAVA INFORMAÇÃO...
/*
        $text .= "<div id='friendof-title' style='cursor:hand; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".AMIGO_24."'>&nbsp;".AMIGO_24."</div>";
		$text .= "<div id='friendof' class='switchgroup1' style='display:none'>";



		$query="SELECT ".MPREFIX."user.user_login,".MPREFIX."user.user_name,".MPREFIX."user.user_id,".MPREFIX."user.user_currentvisit FROM ".MPREFIX."euser_friends left join ".MPREFIX."user ON ".MPREFIX."user.user_id=".MPREFIX."euser_friends.amigo_user  WHERE ".MPREFIX."euser_friends.amigo_amigo='".USERID."'";
		
		$sql2->db_Select_gen($query);
				while ($row = $sql2->db_Fetch()) {

			$amigo=true;
			extract($row);
			$gen = new convert;
			$datestamp = $gen->convert_date($user_currentvisit);
			$sql3=new db;
			$sql3 -> db_Select("online", "*", "online_user_id='".$user_id.".".$user_name."' ");







			if ($row3 = $sql3 -> db_Fetch()){

				$text .="<img src='".e_PLUGIN."euser/images/online_mini.png' alt='".AMIGO_14."' />";
			} else {

				$text .="<img src='".e_PLUGIN."euser/images/offline_mini.png' alt='".AMIGO_15."' />";
			}


			$text.="&nbsp;<a title='".AMIGO_18." ".$datestamp."' href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".($euser_pref['realname']==1 && $user_login <> "" ? $user_login : $user_name)."</a>&nbsp;
			<a href='".e_PLUGIN."pm/pm.php?send.$user_id'><img src='".e_PLUGIN."euser/images/icon_pm.png' height='16px' alt='".AMIGO_16."' title='".AMIGO_16."' border='0' id='im' /></a><br />";

		}
	

	// Warning if the list is empty
	if (!$amigo) {

		$text.=AMIGO_1."<br />";
	}
$text .= "</div>";
*/


        $text .= "</div>";
}
}
	$ns->tablerender($caption, $text, 'euser_friends_menu');
?>