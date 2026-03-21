<?php
if (!defined('e107_INIT')){exit;}

//e107::css('philcat','philcat.css');

///////----------------require_once(e_PLUGIN."philcat/phil_trait.php");
include_once(e_PLUGIN . "euser/includes/euser_trait.php");    

class Euser {
	use Euser_admin_info;
    protected $sql;
    protected $tp;
    protected $ns;
//    protected $euser_template;
    protected $user_sc;
    protected $pref;
    protected $euser_pref;

	    public function __construct()
    {
//        $this->msg = e107::getMessage();
	    $this->ns = e107::getRender();
	    $this->tp = e107::getParser();
        $this->sql = e107::getDb();
    
//        $this->philcat = $philcat;
//        $this->pref = e107::getPlugPref("philcat");

        // Perform required validation during object creation
/*
        if (!$this->hasRequiredPermissions()) {
            throw new Exception(LAN_NO_PERMISSIONS);
        }
*/
//        $this->validatePermissions();

        // Additional constructor logic...
//		$this->euser_template = e107::getTemplate('euser');
		$this->user_sc = e107::getScBatch('user', 'euser', 'user');
//		$this->user_sc->wrapper('euser/main');
        $this->pref = e107::pref('user');
        $this->euser_pref = e107::pref('euser');
	    }

function render_user($id) {  

		// Começo do que veio do user.php do core
//+++++++++++++ Cópia das linhas 182 a 230 do user.php****************
//-----if (isset($id))
//-----{
//	$user_exists = $this->sql->count("user","(*)", "WHERE user_id = ".$id."");
//	var_dump($this->user_sc->getVars());
	$user = e107::user($id);
//	var_dump($user);
	if (!$user) {
/*		$this->ns->tablerender(IMAGE_alert,IMAGE_bigalert.PROFILE_2a);
		require_once(FOOTERF);
		exit;
	}

	if($id == 0 || $this->sql->count("user","(*)", "WHERE user_id = ".$id."") == false)
	{
*/		$text = "<div style='text-align:center'>".LAN_USER_49." ".SITENAME."</div>";
		$this->ns->tablerender(LAN_ERROR, $text);
		require_once(FOOTERF);
		exit;
	}

//	$loop_uid = $id;

	$ret = e107::getEvent()->trigger("showuser", $id);
	$ret2 = e107::getEvent()->trigger('user_profile_display',$id);

	if (!empty($ret) || !empty($ret2))
	{
		$text = "<div style='text-align:center'>".$ret."</div>";
		$this->ns->tablerender(LAN_ERROR, $text);
		require_once(FOOTERF);
		exit;
	}

	if(vartrue($this->pref['profile_comments']))
	{
		require_once(e_HANDLER."comment_class.php");
		$comment_edit_query = 'comment.user.'.$id;
	}

	if (isset($_POST['commentsubmit']) && $this->pref['profile_comments'])
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
//----}

//+++++++++++++ FIM DA Cópia das linhas ****************
// ########### ALL OK, START RENDER ###############
//$full_perms = getperms("0") || check_class(varset($pref['memberlist_access'], 253));		// Controls display of info from other users
// Fim do isto veio do user.php do core

//	if ($id != USERID && !check_class($euser_pref['allowguests'])) {
// Uso o pref do core, o original, var $pref...
//	if ($id != USERID && !check_class(varset($pref['memberlist_access'], 253))) {
// Uso o pref do plugin em lugar do do core, é menos confuso...
/*
    $msg = e107::getMessage();
	if ($id != USERID && !check_class($euser_pref['memberlist_access'])) {
//		$ns->tablerender(IMAGE_alert,PROFILE_2);
//		$ns->tablerender(IMAGE_alert,IMAGE_bigalert.PROFILE_2);
        $msg->addWarning(PROFILE_2);
		echo $msg->render();
		require_once(FOOTERF);
		exit;
	}
	*/
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
/*
$user = e107::user($id);
	if (!$user) {
		$this->ns->tablerender(IMAGE_alert,IMAGE_bigalert.PROFILE_2a);
		require_once(FOOTERF);
		exit;
	}
*/
$euser_template = e107::getTemplate('euser');
e107::coreLan('user');
//$euser_template = e107::getTemplate('euser');
//var_dump ($user);
//$this->user_sc = e107::getScBatch('user', 'euser', 'user');
$this->user_sc->setVars($user);
//$curVal['euser_data'] = $euser_data; 
//$curVal['euser_pref'] = $euser_pref;
//$curVal['euser_pref'] = e107::getPlugPref('euser');
$curVal['euser_data'] = $this->sql->retrieve("euser", "*", "euser_id='".$id."' ");
$curVal['euser_template'] = $euser_template;
$this->user_sc->addVars($curVal);

$this->user_sc->wrapper('euser/main');

//-----$username = $user['user_name'];
/*---
	// Check member settings - NO Admin & NO Friends
	if (!USERID == ADMIN || !USER) {
//		$sql->mySQLresult = @mysql_query("SELECT user_friends, user_settings FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
		$settings = $this->sql->retrieve("euser", "euser_friends, euser_settings", "euser_id='".$id."'");
//		$settings = $sql->fetch();
		$break = explode("|",$settings['euser_settings']);
//		$friendb = explode("|", $settings['user_friends']);
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
/*-----
    	$this->euser_onlyfriends(array(PROFILE_104,PROFILE_104a));
	}
----*/
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
/*-------------
			// CHECK TO SEE IF USING GOLD SYSTEM  // A ALTERAR QUANDO PUDER....
			if (function_exists('gold')) {
				$text .= "<tr><td {$main_colspan} style='width:100%' class='forumheader'><span style='float:left'>Kredit rendszer</span></td></tr>";
				$text .= "<TR><td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_218."<br><a href='".e_BASE.e_PLUGIN."gold_system/donate.php?{USER_NAME}'><i>".PROFILE_217."</i></a>&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_GOLD}</td></TR>";
				$text .= "<TR><td {$main_colspan} style='width:100%' class='forumheader3'><span style='float:left'>".PROFILE_28."&nbsp;".$this->euser_pref['gold_currency_name']."&nbsp;&nbsp;</span><span style='float:right; text-align:right'>{USER_SPENT}</td></TR>";
			}
-----------*/
			// Profil zene
/*--
			if ($mp3['user_mp3'] != "" && $euser_pref['mp3_sys'] == "ON" && !isset($_GET['page'])) {
			$sql->mySQLresult = @mysql_query("SELECT user_mp3 FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
			$mp3 = $sql->db_Fetch();
//			if ($mp3['user_mp3'] != "" && $euser_pref['mp3_sys'] == "ON" && !isset($_GET['page'])) {
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
		$text .=$this->tp->parseTemplate($euser_template['main'], TRUE, $this->user_sc);;
	}

	// Coisas a fazer depois de ter feiot o output...
	if (!isset($_GET['page'])) {
		// Update profile views and last visitors
//		if (USERID != $id && $euser_pref['stats'] == "ON" && mysql_query("SELECT user_lastviewed FROM ".MPREFIX."euser LIMIT 0") && USER) {
//var_dump (USERID != $id);
//var_dump ($this->euser_pref);
//var_dump ($sql->select("euser", "user_lastviewed", "LIMIT 0"));
//var_dump (USER);
		if (USERID != $id && $this->euser_pref['stats'] && USER) {
//			$sql->mySQLresult = @mysql_query("SELECT user_lastviewed FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
			$getdata = $this->sql->retrieve("euser", "euser_lastviewed", "euser_id='".$id."'");
//			$getdata = $sql->db_Fetch();
//			$getdata = $this->sql->rows();
/*
			echo "<pre>";
			var_dump ($getdata);
			echo "</pre>";
*/
			$data = $getdata?unserialize($getdata):null;
			$newarray = Array();
			$count = 1;
			array_push($newarray, USERID."|".time());
/*
			echo "<pre>";
			var_dump ($data);
			var_dump ($newarray);
			echo "</pre>";
*/
			foreach ($data as $d) {
				$break = explode("|", $d);
				if ($count != 10 && USERID != $break[0]) {
					array_push($newarray, $d);
					$count++;
				}
			}
/*
			echo "<pre>";
			var_dump ($array);
			var_dump ($newarray);
			echo "</pre>";
*/
			$array = serialize($newarray);
/*
			echo "<pre>";
			var_dump ($array);
			var_dump ($getdata);
			echo "</pre>";
*/
//			$sql -> db_Update("euser", "user_lastviewed='".$array."', user_totalviews=user_totalviews + 1 WHERE user_id='".$id."' ");
			if ($getdata) {
				$this->sql->update("euser", "euser_lastviewed='".$array."', euser_totalviews=euser_totalviews + 1 WHERE euser_id='".$id."'");
//				var_dump ("fasdfasdfsd");
			} else {
				$this->sql->insert("euser", array('euser_lastviewed'=>$array, 'euser_totalviews'=>'1', 'euser_id'=>$id));
//				var_dump ("4545115151");

			}
		}



// Este if todo é do add friend, por isso tem de passar para o user_friend.....
				/*------------------
		if (isset($_GET['add'])) {
			$this->sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
			$list = $this->sql->db_Fetch();
			$friend = explode("|", $list['user_friends']);
			$megjelolt = explode("|", $list['user_friends_request']);

			$this->sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."euser WHERE user_id='".USERID."' ");
			$te_list = $this->sql->db_Fetch();
			$megjeloltek = explode("|", $te_list['user_friends_request']);

/*
			$sql->mySQLresult = @mysql_query("SELECT user_id, user_name FROM ".MPREFIX."user WHERE user_id='".$id."' ");
			$ures = $sql->db_Fetch();
			$uresek = ($ures['user_name']);
*/
			/*-----------------
	$this->sql-> db_Select("user","user_name","user_id = '$id'");
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
				$this->sql->mySQLresult = @mysql_query("SELECT user_id, user_friends FROM ".MPREFIX."euser WHERE user_id='".USERID."' ");
				$yourows = $this->sql->db_Rows();
				$you = $this->sql->db_Fetch();
				$this->sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
				$themrows = $this->sql->db_Rows();
				$them = $this->sql->db_Fetch();
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

					$this->sql->mySQLresult = @mysql_query("SELECT user_settings FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
					$settings = $this->sql->db_Fetch();
					$break = explode("|",$settings['user_settings']);
					if ($this->euser_pref['friend_req_sendpm'] == 'Yes') {
						if ($break[5] == 1 || !$settings[0] || $this->euser_pref['friend_req_sendpm_all'] == 'on') {
							$userfrom = get_user_data(USERID);
							$userfrom = $userfrom['user_name'];
							$msg = "<a href=\'".e_PLUGIN."euser/euser.php?id=".USERID."\'>".$userfrom."</a>".PROFILE_209."<br><br><a href=\'".e_PLUGIN."euser/euser_settings.php?page=friends&acceptadd=".USERID."\'>".PROFILE_210."</a> | <a href=\'".e_PLUGIN."euser/euser_settings.php?page=friends&rejectadd=".USERID."\'>".PROFILE_211."</a>";
							$size = strlen($msg);
							$sendpm = mysql_query("INSERT INTO ".MPREFIX."private_msg (pm_id, pm_from, pm_to, pm_sent, pm_read, pm_subject, pm_text, pm_sent_del, pm_read_del, pm_attachments, pm_option, pm_size) VALUES('', '".USERID."', '".$id."', '".intval(time())."', '0', '".PROFILE_212."', '".$msg."', '1', '0', '', '', '".intval($size)."' ) ");
						}
					} else {
						if ($break[5] == 1 && $this->euser_pref['friend_req_sendpm_all'] != 'on') {
							$userfrom = get_user_data(USERID);
							$userfrom = $userfrom['user_name'];
							$msg = "<a href=\'".e_PLUGIN."euser/euser.php?id=".USERID."\'>".$userfrom."</a>".PROFILE_209."<br><br><a href=\'".e_PLUGIN."euser/euser_settings.php?page=friends&acceptadd=".USERID."\'>".PROFILE_210."</a> | <a href=\'".e_PLUGIN."euser/euser_settings.php?page=friends&rejectadd=".USERID."\'>".PROFILE_211."</a>";
							$size = strlen($msg);
							$sendpm = mysql_query("INSERT INTO ".MPREFIX."private_msg (pm_id, pm_from, pm_to, pm_sent, pm_read, pm_subject, pm_text, pm_sent_del, pm_read_del, pm_attachments, pm_option, pm_size) VALUES('', '".USERID."', '".$id."', '".intval(time())."', '0', '".PROFILE_212."', '".$msg."', '1', '0', '', '', '".intval($size)."' ) ");
						}
					}
					//EMAIL TO USER
					if ($this->euser_pref['friend_req_sendemail'] == 'Yes') {
						if ($break[11] == 1 || !$settings[0] || $this->euser_pref['friend_req_sendemail_all'] == 'on') {
							$this->sql->mySQLresult = @mysql_query("SELECT user_email FROM ".MPREFIX."user WHERE user_id='".$id."' ");
							$useremail = $this->sql->db_Fetch();
							$useremail = $useremail['user_email'];
							$userfrom = get_user_data(USERID);
							$userfrom = $userfrom['user_name'];
							$oldal_url = SITEURL.$PLUGINS_DIRECTORY."euser/euser_settings.php?page=friends";
							$email_msg = "<b>".PROFILE_209b.$username."!</b><br><br>".$userfrom.PROFILE_209a.PROFILE_209c.SITENAME.PROFILE_209d."<br><br>".PROFILE_209e."<a href=".$oldal_url.">link</a>";
							require_once(e_HANDLER . "mail.php");
							sendemail($useremail, PROFILE_212, $email_msg, $username, SITEADMINEMAIL, SITENAME);
						}
					} else {
						if ($break[11] == 1 && $this->euser_pref['friend_req_sendemail_all'] != 'on') {
							$this->sql->mySQLresult = @mysql_query("SELECT user_email FROM ".MPREFIX."user WHERE user_id='".$id."' ");
							$useremail = $this->sql->db_Fetch();
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
			--------------*/
//			$sql->mySQLresult = @mysql_query("SELECT user_id, user_custompage, user_simple FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
//$rows = $sql->db_Rows();
//$profile = $sql->db_Fetch();
//			$sql->mySQLresult = @mysql_query("SELECT user_id, user_custompage, user_simple FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
//			$rows = $sql->db_Rows();
/*----

//// REMODELAR POR CAUSA DO EXTENDED USER SETTINGS DO CORE
			$profile = $this->sql->retrieve("euser", "euser_id, euser_custompage, euser_simple", "euser_id='".$id."'");
			$custompage = $profile['euser_custompage'];
//			$info = unserialize($custompage);
			$html .= $this->tp->toHTML($custompage, true);
			$break = explode("[||]", $html);
//---------------		}
----*/
	}

		// Isto é preciso por causa da quantidade de tabs horizontais....
		e107::js('euser','dist/jquery.scrolling-tabs.js', 'jquery');
		e107::css('euser','dist/jquery.scrolling-tabs.css', 'jquery');
		e107::js('footer-inline',"$('.userprofile.nav-tabs').scrollingTabs();");

//--        $this->euser_tablerender($text, 0);
//------		$notexit = 0;
//		$display = $tp->parseTemplate($text, TRUE, $user_sc);
//		$ns->tablerender("",$display);
//--}

//--private function euser_tablerender($text, $notexit = null) {
// Futuro??? function euser_tablerender($text, &$caption, &$user_sc, &$text_js, $notexit = null) {
//extract($GLOBALS); 
//global $tp, $caption, $user_sc, $textjs, $ns;
//	global $tp, $euser_template, $user_sc, $textjs, $ns, $euser_pref;
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
	$sections .= $euser_pref['image_sys']?LAN_EUSER_140.", ":null;
	$sections .= $euser_pref['video_sys']?LAN_EUSER_150:null;
	$adminwarn = "<div class='alert alert-warning'>".$tp->lanVars($tp->toHTML(LAN_EUSER_6, true), array('x'=>$sections)).'</div>';
}
*/
// mudar para usar msg...       echo $msg->render();

//	include_once(e_PLUGIN . "euser/includes/euser_trait.php");
//	use Euser_admin_info;
//	$adminwarn = (new class { use Euser_admin_info; })->adminwarn($euser_pref);
	$adminwarn = $this->adminwarn($this->euser_pref);

	$display = $adminwarn.$this->tp->parseTemplate($text, TRUE, $this->user_sc);

//				$tdisplay = $tp->parseTemplate($caption, TRUE, $user_sc);
	$this->user_sc->wrapper('euser/caption');
	$cdisplay = $this->tp->parseTemplate($euser_template['caption'], TRUE, $this->user_sc);

//    $display .= $textjs;

	$this->ns->tablerender($cdisplay,$display);
/*----
    if (is_null($notexit)){
				require_once(FOOTERF);
				exit;
    }
				---*/
}

// ISto depois tamém tem de passar para o user_friends....
/*------
private function euser_onlyfriends($text_friends, $tdinline = null) {
//extract($GLOBALS); 
global $text, $friendb, $euser_pref, $username;
//echo "<hr>TEXTFRIENDS: ";
//print_r($text_friends);
  If (count($text_friends)>1){
					//----------- Only friends
			if (((!in_array(USERID, $friendb)) && ($this->euser_pref['friends'] == "ON" || $this->euser_pref['friends'] == "")) || !USER) {
/*
echo "<hr>TEXT1: ";
echo htmlentities($text);
echo "<hr><hr>";
*/
/*------
        $text .= ( $text_friends[0]!='' ? $username.$text_friends[0]."</td></tr>" : "" );
        $text .= "</table>";
        euser_tablerender($text, $tdinline);
			} else if ($this->euser_pref['friends'] != "ON") {
/*
echo "<hr>TEXT2: ";
echo htmlentities($text);
echo "<hr><hr>";
*/
/*------
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
/*------
					if (!in_array(USERID, $friendb) || !USER) {
        $text .= $username.$text_friends[0]."</td></tr></table>";
        euser_tablerender($text, $tdinline);
		}
  }
}
----*/

/// FIQUEI AQUI....
function render_list(){
// É chamado quando não id nem numero, e dá uma lista de todos os membros....
// Código para rever, dá erros...
//////////////////////	require_once("memberlist.php");
//global $sql, $tp, $ns;
//require_once (e_BASE."user.php");
////var_dump("jtiorweujdlskagjfklsgjlksdfjglkj");
// Cópia das lihas 144 a 180 do user.php, com alterações customizadas....
// Por isso não incluo o user.php, para não dar conflitos.
$qs = explode(".", e_QUERY);
//$self_page =($qs[0] == 'id' && intval($qs[1]) == USERID);

if (isset($_POST['records']))
{
	$users['records'] = intval($_POST['records']);
	$users['order'] = ($_POST['order'] == 'ASC' ? 'ASC' : 'DESC');
	$users['from'] = 0;
}
else if(!e_QUERY)
{
	$users['records'] = 20;
	$users['from'] = 0;
	$users['order'] = "DESC";
}
else
{
	if ($qs[0] == "self")
	{
		$id = USERID;
	}
	else
	{
		if ($qs[0] == "id")
		{
			$id = intval($qs[1]);
		}
		else
		{
			$qs = explode(".", e_QUERY);
			$users['from'] = intval($qs[0]);
			$users['records'] = intval($qs[1]);
			$users['order'] = ($qs[2] == 'ASC' ? 'ASC' : 'DESC');
		}
	}
}
if (vartrue($users['records']) > 50)
{
	$users['records'] = 50;
}

// LIsta por defeito normal....
// Cópia das lihas 212 a 236 do user.php, com alterações customizadas....
	// --------------------- List Users ------------------------  //TODO Put all of this into a class.
	$query = "SELECT u.*, ue.* FROM `#user` AS u LEFT JOIN `#user_extended` AS ue ON u.user_id = ue.user_extended_id WHERE u.user_ban = 0 ORDER BY u.user_id ".$users['order']." LIMIT ".intval($users['from']).",".intval($users['records']);

//	var_dump ($query);
	if (!$data = $this->sql->retrieve($query,true))
	// if (!$sql->select("user", "*", "user_ban = 0 ORDER BY user_id $order LIMIT $from,$records"))
	{
		echo "<div style='text-align:center'><b>".LAN_USER_53."</b></div>";
		return;
	}
//	else
//	{
/*
    e107::getMessage()->addDebug( "Loading v2.x user template");
    $USER_TEMPLATE              = e107::getCoreTemplate('user');
	$USER_FULL_TEMPLATE         = $USER_TEMPLATE['view'];
	$USER_SHORT_TEMPLATE_START  = $USER_TEMPLATE['list']['start'] ;
	$USER_SHORT_TEMPLATE        = $USER_TEMPLATE['list']['item'] ;
	$USER_SHORT_TEMPLATE_END    = $USER_TEMPLATE['list']['end'];
*/
//		define ('EUSER_TOTAL',$users['total']);

//		define ('EUSER_RECORDS',$records);
//		define ('EUSER_FROM',$from);
//		define ('EUSER_ORDER',$order);

//		$users['records'] =$records;
//		$users['from'] =$from;
//		$users['order']=$order;

		$euser_list_tmplt = e107::getTemplate('euser', 'euser_list');
		$users['total'] = $this->sql->count("user","(*)", "WHERE user_ban = 0");
//	Não posso usar isto senão não consigo meter o page_nav onde eu quiser... Uso constantes...
		$this->user_sc->setVars($users);
//		define ('EUSER_TOTAL',$this->sql->count("user","(*)", "WHERE user_ban = 0"));
	
	// $userList = $sql->db_getList();
//		$sc = e107::getScBatch('user');
//		$text = $this->tp->parseTemplate($USER_SHORT_TEMPLATE_START, TRUE, $sc);
		$this->user_sc->wrapper('user/list');
		$caption = $this->tp->parseTemplate($euser_list_tmplt['caption'], TRUE, $this->user_sc);
		$text = $this->tp->parseTemplate($euser_list_tmplt['start'], TRUE, $this->user_sc);
		$text_end = $this->tp->parseTemplate($euser_list_tmplt['end'], TRUE, $this->user_sc);

		foreach ($data as $row)
		{
//			$loop_uid = $row['user_id'];

		//	$text .= renderuser($row, "short");
//			$sc->setVars($row);
//			$sc->wrapper('user/list');
			$this->user_sc->setVars($row);
//			$this->user_sc->wrapper('user/list');

//			$text .= $this->tp->parseTemplate($USER_SHORT_TEMPLATE, TRUE, $sc);
			$text .= $this->tp->parseTemplate($euser_list_tmplt['default']['item'], TRUE, $this->user_sc);
		}

//		$text .= $this->tp->parseTemplate($USER_SHORT_TEMPLATE_END, TRUE, $sc);
//	}
		
//		$parms = 'tmpl_prefix=default&total='.$users['total'].'&amount='.$records.'&current='.$from.'&url='.e_SELF.'?--FROM--.'.$records.'.'.$order; // .'&url='.$url;
//return e107::getParser()->parseTemplate("{NEXTPREV={$parms}}");
//----		$text .= $this->tp->parseTemplate("{NEXTPREV={$parms}}");

		$this->ns->tablerender($caption, $text.$text_end, 'user-list');
//	$parms = $users['total'].",".$records.",".$from.",".e_SELF.'?[FROM].'.$records.".".$order;
		return;
	// FIm da cópia das linhas do user.php
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
	if (!check_class($this->euser_pref['memberlist_access'])) {
//if (!check_class($euser_pref['memberlist_accept'])) {
	$ns->tablerender(IMAGE_alert,PROFILE_2b);
	require_once(FOOTERF);
	exit;
}

if (!$this->euser_pref['plug_installed']['euser']) {
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

if ($this->euser_pref['memberlist_direction'] == '') {
	$profile_memberlist_direction = "user_name";
} else {
	$profile_memberlist_direction = $this->euser_pref['memberlist_direction'];
}

if ($this->euser_pref['memberlist_order'] == '') {
	$profile_memberlist_order = "ASC";
} else {
	$profile_memberlist_order = $this->euser_pref['memberlist_order'];
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
		
		if ($this->euser_pref['member_ext_search'] == "Yes") {
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
if (($szures == "rate_forums" && $this->euser_pref['top_forums'] != "ON") || ($szures == "rate_comments" && $this->euser_pref['top_comments'] != "ON") || ($szures == "rate_chatbox" && $this->euser_pref['top_chatbox'] != "ON") || ($szures == "rate_user" && $this->euser_pref['top_rate'] != "ON") || ($szures == "rate_friends" && $this->euser_pref['top_friends'] != "ON") || ($szures == "rate_profiles" && $this->euser_pref['top_profile'] != "ON") || ($szures == "rate_level" && $this->euser_pref['top_level'] != "ON")) {
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
$top_x = $this->euser_pref['top_x'];
if ($this->euser_pref['top_noadmin'] == "No") {
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
	if (check_class($this->euser_pref['top_class'])) {
		if ($this->euser_pref['top_level'] == "ON") {
			$top_link = "rate_level";
		}else if ($this->euser_pref['top_forums'] == "ON") {
			$top_link = "rate_forums";
		}else if ($this->euser_pref['top_comments'] == "ON") {
			$top_link = "rate_comments";
		}else if ($this->euser_pref['top_chatbox'] == "ON") {
			$top_link = "rate_chatbox";
		}else if ($this->euser_pref['top_rate'] == "ON") {
			$top_link = "rate_user";
		}else if ($this->euser_pref['top_profile'] == "ON") {
			$top_link = "rate_profiles";
		}else if ($this->euser_pref['top_friends'] == "ON") {
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
		if (check_class($this->euser_pref['memberlist_filter']) && (($this->euser_pref['commentson'] == "ON") || ($this->euser_pref['image_sys'] == "ON") || ($this->euser_pref['video_sys'] == "ON") || ($this->euser_pref['mp3_sys'] == "ON")) ) {
			if ($sort == "") {
				$text .= "&nbsp;&nbsp;
				<span class='defaulttext'>".PROFILE_339."</span>
				<select name='szures' class='tbox'>".
					($szures == "all" ? "<option value='all' selected='selected'>".PROFILE_340."</option>" : "<option value='all'>".PROFILE_340."</option>")."";
					$text .= ($szures == "forum" ? "<option value='forum' selected='selected'>".PROFILE_365."</option>" : "<option value='forum'>".PROFILE_365."</option>")."";
					$text .= ($szures == "comment_1" ? "<option value='comment_1' selected='selected'>".PROFILE_366."</option>" : "<option value='comment_1'>".PROFILE_366."</option>")."";
					if ($this->euser_pref['commentson'] == "ON") {
						$text .= ($szures == "comm" ? "<option value='comm' selected='selected'>".PROFILE_341."</option>" : "<option value='comm'>".PROFILE_341."</option>")."";
					}
					if ($this->euser_pref['image_sys'] == "ON") {
						$text .= ($szures == "pic" ? "<option value='pic' selected='selected'>".PROFILE_342."</option>" : "<option value='pic'>".PROFILE_342."</option>")."";
					}
					if ($this->euser_pref['video_sys'] == "ON") {
						$text .= ($szures == "vid" ? "<option value='vid' selected='selected'>".PROFILE_343."</option>" : "<option value='vid'>".PROFILE_343."</option>")."";
					}
					if ($this->euser_pref['mp3_sys'] == "ON") {
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

		if ($this->euser_pref['memberlist_bcard'] == "line" || $this->euser_pref['memberlist_bcard'] == "" ) {
			$text .= "<table style='width:100%' class='fborder'><tr>";
			if ($this->euser_pref['memberlist_class']) {
				$profile_memberlist_class = $this->euser_pref['memberlist_class'];
			} else {
				$profile_memberlist_class = "button";
			}
			if ($this->euser_pref['memberlist_color_up']) {
				$up_pic =" style='color: #".$this->euser_pref['memberlist_color_up']."'";
			}
			if ($this->euser_pref['memberlist_color_down']) {
				$down_pic =" style='color: #".$this->euser_pref['memberlist_color_down']."'";
			}
			if ($this->euser_pref['memberlist_column_avatar'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><center><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_id'>";
				if ($sorrend == "ASC" && $direction == "user_id") {	$ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_id") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
				$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_4a."' /></center></form></td>";
			}
			if ($this->euser_pref['memberlist_column_online'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_name'>";
				if ($sorrend == "ASC" && $direction == "user_name") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_name") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_4."' /></form></td>";
			}
			if ($this->euser_pref['memberlist_column_realname'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_login'>";
				if ($sorrend == "ASC" && $direction == "user_login") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_login") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_367."' /></form></td>";
			}
			if ($this->euser_pref['memberlist_column_loginname'] != "OFF" && (ADMIN && getperms("4"))) {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_loginname'>";
				if ($sorrend == "ASC" && $direction == "user_loginname") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_loginname") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_370."' /></form></td>";
			}
			if ($this->euser_pref['memberlist_column_email'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_email'>";
				if ($sorrend == "ASC" && $direction == "user_email") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_email") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_5."' /></form></td>";
			}
			if ($this->euser_pref['memberlist_column_join'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_join'>";
				if ($sorrend == "ASC" && $direction == "user_join") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_join") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_9."' /></form></td>";
			}
			if ($this->euser_pref['memberlist_column_lastvisit'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_currentvisit'>";
				if ($sorrend == "ASC" && $direction == "user_currentvisit") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_currentvisit") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_9a."' /></form></td>";
			}
			if ($this->euser_pref['memberlist_column_visits'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_visits'>";
				if ($sorrend == "ASC" && $direction == "user_visits") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_visits") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_9b."' /></form></td>";
			}
			if ($this->euser_pref['memberlist_column_timezone'] != "OFF" && (ADMIN && getperms("4"))) {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_timezone'>";
				if ($sorrend == "ASC" && $direction == "user_timezone") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_timezone") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_368."' /></form></td>";
			}
			if ($this->euser_pref['memberlist_column_userip'] != "OFF" && (ADMIN && getperms("4"))) {
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
			if ($this->euser_pref['memberlist_class']) {
				$profile_memberlist_class = $this->euser_pref['memberlist_class'];
			} else {
				$profile_memberlist_class = "button";
			}
			if ($this->euser_pref['memberlist_color_up']) {
				$up_pic =" style='color: #".$this->euser_pref['memberlist_color_up']."'";
			}
			if ($this->euser_pref['memberlist_color_down']) {
				$down_pic =" style='color: #".$this->euser_pref['memberlist_color_down']."'";
			}
			if ($this->euser_pref['memberlist_column_online'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_name'>";
				if ($sorrend == "ASC" && $direction == "user_name") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_name") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_4."' /></form></td>";
			}
			if ($this->euser_pref['memberlist_column_realname'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_login'>";
				if ($sorrend == "ASC" && $direction == "user_login") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_login") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_367."' /></form></td>";
			}
			if ($this->euser_pref['memberlist_column_loginname'] != "OFF" && (ADMIN && getperms("4"))) {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_loginname'>";
				if ($sorrend == "ASC" && $direction == "user_loginname") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_loginname") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_370."' /></form></td>";
			}
			if ($this->euser_pref['memberlist_column_email'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_email'>";
				if ($sorrend == "ASC" && $direction == "user_email") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_email") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_5."' /></form></td>";
			}
			if ($this->euser_pref['memberlist_column_join'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_join'>";
				if ($sorrend == "ASC" && $direction == "user_join") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_join") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_9."' /></form></td>";
			}
			if ($this->euser_pref['memberlist_column_lastvisit'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_currentvisit'>";
				if ($sorrend == "ASC" && $direction == "user_currentvisit") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_currentvisit") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_9a."' /></form></td>";
			}
			if ($this->euser_pref['memberlist_column_visits'] != "OFF") {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_visits'>";
				if ($sorrend == "ASC" && $direction == "user_visits") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_visits") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_9b."' /></form></td>";
			}
			if ($this->euser_pref['memberlist_column_timezone'] != "OFF" && (ADMIN && getperms("4"))) {
				$ord = "";
				$ord_color = "";
				$text .= "<td class='fcaption' style='width:2%'><form method='post' action='".e_SELF."?".e_QUERY."'>
					<input type='hidden' name='direction' value='user_timezone'>";
				if ($sorrend == "ASC" && $direction == "user_timezone") { $ord = "DESC"; $ord_color = $up_pic;} else if ($sorrend == "DESC" && $direction == "user_timezone") {	$ord = "ASC"; $ord_color = $down_pic;} else {	$ord = $sorrend;	}
					$text .= "<input type='hidden' name='sorrend' value='".$ord."'><input type='hidden' name='mutat' value='".$mutat."'><input type='hidden' name='szures' value='".$szures."'><input class='".$profile_memberlist_class."' type='submit' '".$ord_color."' value='".PROFILE_368."' /></form></td>";
			}
			if ($this->euser_pref['memberlist_column_userip'] != "OFF" && (ADMIN && getperms("4"))) {
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
			$this->euser_pref['bcard_css'] == "" ? $bcard_css = "lite" : $bcard_css = $this->euser_pref['bcard_css'];
			$this->euser_pref['bcard_css'] == "auto" ? $bcard_css = IMODE : $bcard_css = $bcard_css;
			if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) {
				echo "<link href='css/card_".$bcard_css."_ie.css' rel='stylesheet' type='text/css'>";
			} else {
				echo "<link href='css/card_".$bcard_css.".css' rel='stylesheet' type='text/css'>";
			}
			$text .= "<table id='card_table'><tr>";
			if ($this->euser_pref['bcard_column'] == '') {
				$userlist_column = '3';
			} elseif ($this->euser_pref['bcard_column'] > '8') {
				$userlist_column = '8';
			} else {
				$userlist_column = $this->euser_pref['bcard_column'];
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
if (!check_class($this->euser_pref['top_class'])) {
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
	if($this->euser_pref['stats'] =="ON" && $this->euser_pref['top_level'] == "ON"){
		if ($szures == "rate_level") {
			$text .= "<img src='images/green.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		} else {
			$text .= "<img src='images/gray.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		}
		$text .= "<a href='".e_PLUGIN."euser/euser.php?szures=rate_level'>".PROFILE_391."</a><br/>";
	}
	if($this->euser_pref['top_forums'] == "ON"){
		if ($szures == "rate_forums") {
			$text .= "<img src='images/green.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		} else {
			$text .= "<img src='images/gray.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		}
		$text .= "<a href='".e_PLUGIN."euser/euser.php?szures=rate_forums'>".PROFILE_388."</a><br/>";
	}
	if(!$this->euser_pref['comments_disabled'] && $this->euser_pref['top_comments'] == "ON"){
		if ($szures == "rate_comments") {
			$text .= "<img src='images/green.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		} else {
			$text .= "<img src='images/gray.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		}
		$text .= "<a href='".e_PLUGIN."euser/euser.php?szures=rate_comments'>".PROFILE_387."</a><br/>";
	}
	if($this->euser_pref['top_chatbox'] == "ON"){
		if ($szures == "rate_chatbox") {
			$text .= "<img src='images/green.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		} else {
			$text .= "<img src='images/gray.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		}
		$text .= "<a href='".e_PLUGIN."euser/euser.php?szures=rate_chatbox'>".PROFILE_393."</a><br/>";
	}
	if($this->euser_pref['rate'] && $this->euser_pref['top_rate'] == "ON"){
		if ($szures == "rate_user") {
			$text .= "<img src='images/green.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		} else {
			$text .= "<img src='images/gray.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		}
		$text .= "<a href='".e_PLUGIN."euser/euser.php?szures=rate_user'>".PROFILE_377."</a><br/>";
	}
	if($this->euser_pref['stats'] =="ON" && $this->euser_pref['top_profile'] == "ON"){
		if ($szures == "rate_profiles") {
			$text .= "<img src='images/green.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		} else {
			$text .= "<img src='images/gray.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		}
		$text .= "<a href='".e_PLUGIN."euser/euser.php?szures=rate_profiles'>".PROFILE_378."</a><br/>";
	}
	if ($this->euser_pref['friends'] == "ON" && $this->euser_pref['top_friends'] == "ON") {
		if ($szures == "rate_friends") {
			$text .= "<img src='images/green.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		} else {
			$text .= "<img src='images/gray.png' style=' width: 8px; height: 8px; float: left; margin-right: 10px' />";
		}
		$text .= "<a href='".e_PLUGIN."euser/euser.php?szures=rate_friends'>".PROFILE_379."</a><br/>";
	}
	$text .= "<br/><br/><table width='100%'><tr>";
	$text .= "<td colspan= 3 class='forumheader'>".PROFILE_380.$this->euser_pref['top_x']."</td>";
	$text .= "</tr>";
	if ($this->euser_pref['memberlist_bcard'] == "line" || $this->euser_pref['memberlist_bcard'] == "" ) {
		while($row=$sql->db_Fetch()) {
			$text .= renderuser($row, "short");
		}
	} else {
			$this->euser_pref['bcard_css'] == "" ? $bcard_css = "lite" : $bcard_css = $this->euser_pref['bcard_css'];
			$this->euser_pref['bcard_css'] == "auto" ? $bcard_css = IMODE : $bcard_css = $bcard_css;
			if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) {
				echo "<link href='css/card_".$bcard_css."_ie.css' rel='stylesheet' type='text/css'>";
			} else {
				echo "<link href='css/card_".$bcard_css.".css' rel='stylesheet' type='text/css'>";
			}
			$text .= "<table id='card_table'><tr>";
			if ($this->euser_pref['top_bcard_column'] == '') {
				$userlist_top_column = '1';
			} elseif ($this->euser_pref['top_bcard_column'] > '8') {
				$userlist_top_column = '8';
			} else {
				$userlist_top_column = $this->euser_pref['top_bcard_column'];
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
}