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

if (!$this->var['euser_pref']['pics']) { return null;}
//return null;
//global $euser_template;

				$picdir = "userimages/".$this->var['user_id']."/";
				$picthumbdir = "userimages/".$this->var['user_id']."/thumbs";

if(!function_exists("countpicFiles")) {
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
}

//				$numpicfiles = countpicFiles($picdir);
				$numpicfiles = countpicFiles($picdir) -2;
//				if ($numpicfiles<1 && (strpos( e_PAGE, "euser_settings")===false)) { return;}
				if ($numpicfiles<1 && e_PAGE!="euser_settings.php") { return;}
				$euser_template = e107::getTemplate('euser');

				//$euser_template['images_caption'] = $this->tp->simpleParse($euser_template['images_caption'], array('COUNT'=>($numpicfiles>0?$numpicfiles:NULL)));
//				var_dump($numpicfiles);
				//var_dump($parm);
/*
				if (isset($parm['caption'])){
					return $this->tp->parseTemplate($this->tp->simpleParse($euser_template['images_caption'], array('count'=>($numpicfiles>0?$numpicfiles:((strpos( e_PAGE, "euser_settings")!==false)?$numpicfiles:NULL)))), TRUE, $this);
				}
*/
				if (isset($parm['caption'])){
					return $this->tp->parseTemplate($this->tp->simpleParse($euser_template['images_caption'], array('count'=>($numpicfiles>0?$numpicfiles:(e_PAGE=="euser_settings.php"?$numpicfiles:NULL)))), TRUE, $this);
				}

//          var_dump (file_exists($picthumbdir));
//          var_dump (($numpicfiles<3?PROFILE_163:$numpicfiles."&nbsp;".PROFILE_14a));
				if(file_exists($picthumbdir)){
/*
					if ($numpicfiles < 3) {
						$text .= "<br><table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/images.png'><i>".PROFILE_163."</i></td></tr></table>";
					} else {
						$text .= "<br><table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/images.png'><i>".PROFILE_14a."</i></td></tr></table><br>";
					}
*/
//--						$text .= "<table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/images.png' style='vertical-align:middle'>&nbsp;<i>".(($numpicfiles < 3)?PROFILE_163:$numpicfiles."&nbsp;".PROFILE_14a)."</i></td></tr><tr><td>";
//--        $text .= (($numpicfiles < 3)?"":"<p/>");
						$txt .= IMAGE_images."&nbsp;".($numpicfiles<3?PROFILE_163:$numpicfiles."&nbsp;".PROFILE_14a);

				}

				if(!file_exists($picthumbdir)){
/*
					if ($numpicfiles < 2) {
						$text .= "<br><table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/images.png'><i>".PROFILE_163."</i></td></tr></table>";
					} else {
						$text .= "<br><table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/images.png'><i>".PROFILE_14a."</i></td></tr></table><br>";
					}
*/
//--						$text .= "<table width='100%' class='fborder'><tr><td class='forumheader' colspan='4'><img src='images/images.png'><i>".(($numpicfiles < 2)?PROFILE_163:PROFILE_14a)."</i></td></tr></table>".(($numpicfiles < 3)?"":"<br>");
						$txt .= IMAGE_images."&nbsp;".(($numpicfiles < 2)?PROFILE_163:PROFILE_14a)."<br>".(($numpicfiles < 3)?"":"<br>");
					
				}
				$text = $this->tp->parseTemplate($this->tp->simpleParse($euser_template['images_no'], array('txt'=>$txt)), TRUE, $this);

//PARA REMODELAR E VERIFICAR DAQUI PARA BAIXO.....
				if (isset($_GET['album']) && isset($_GET['pic'])) {
					if ($_GET['album'] != "root") {
						$dir = "userimages/".$this->var['user_id']."/".$_GET['album']."/";
					} else {
						$dir = "userimages/".$this->var['user_id']."/";
					}

//MOD_20120418
//								$dirHandle = opendir($dir);
					if ($handle = opendir($dir)) {
						$filenames = array();
						while (false !== ($filename = readdir($handle))) {
							$file_list[] = array('name' => $filename, 'size' => filesize($dir."/".$filename), 'mtime' => filemtime($dir."/".$filename));
						}
if ($this->var['euser_pref']['userpic_order'] == 'ASC' || $this->var['euser_pref']['userpic_order'] == '') {
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
					if ((in_array(USERID, $friendb) && ($this->var['euser_pref']['friends'] == "ON" || $this->var['euser_pref']['friends'] == "") && USER) || !file_exists("".$dir."/only_friends") || $this->var['user_id'] == USERID || (ADMIN && getperms("4"))) {
						$split = explode(".", $_GET['pic']);
						$counter=0;
						foreach($split as $string) {
							$counter++;
							if ($string == '') {
								$split_id = $split[$counter];
								$this->var['user_id'] = $split_id;
								$lnk=true;
								break;
							}
						}
						$kiterjesztes = $split[$counter - 1];
						$picname = str_replace(".".$split[$counter - 1]."", "", $_GET['pic']);
						$myFile = $dir.$picname.".txt";
//            $text .= "<p/>";
						if ($_GET['album'] != "root") {
//							$text .= "<a href='euser.php?id=".$this->var['user_id']."&page=".$_GET['page']."'><< ".PROFILE_34."</a><br/><a href='euser.php?id=".$this->var['user_id']."&page=".$_GET['page']."&album=".$_GET['album']."'><< ".PROFILE_34a." \"".str_replace("_", " ", $_GET['album'])."\"</a><br/><br/>";
							$text .= "<a href='euser.php?id=".$this->var['user_id']."&page=".$_GET['page']."'><< ".PROFILE_34."</a><br/><a href='euser.php?id=".$this->var['user_id']."&page=".$_GET['page']."&album=".$_GET['album']."'><< ".PROFILE_34a." \"".str_replace("_", " ", $_GET['album'])."\"</a><br/>";
						} else {
//							$text .= "<a href='euser.php?id=".$this->var['user_id']."&page=".$_GET['page']."'><< ".PROFILE_34."</a><br/><br/>";
							$text .= "<a href='euser.php?id=".$this->var['user_id']."&page=".$_GET['page']."'><< ".PROFILE_34."</a><br/>";
						}
						$kepmeret = getimagesize("".$dir.$_GET['pic']."");
						$kep_sz = $kepmeret[0]+30;
						$kep_m = $kepmeret[1]+30;
						if ($this->var['euser_pref']['picviewsize'] == '') {
							$picviewsize = '600';
						} else {
							$picviewsize = $this->var['euser_pref']['picviewsize'];
						}

if ($prev_pic) {
$prev .= "<a href='euser.php?id=".$this->var['user_id']."&page=".$_GET['page']."&album=".$_GET['album']."&pic=".$prev_pic."'><img style='border: 0px solid ; width: 32px; height: 32px;' alt='prev' title='".PROFILE_426."' src='images/prev.png'></a>";
}
if ($next_pic) {
$next .= "<a href='euser.php?id=".$this->var['user_id']."&page=".$_GET['page']."&album=".$_GET['album']."&pic=".$next_pic."'><img style='border: 0px solid ; width: 32px; height: 32px;' alt='next' title='".PROFILE_427."' src='images/next.png'></a>";
}

if ($_GET['album'] != "root") {
$up_pic .= "<a href='euser.php?id=".$this->var['user_id']."&page=".$_GET['page']."&album=".$_GET['album']."'><img style='border: 0px solid ; width: 32px; height: 32px;' alt='next' title='".PROFILE_34a." ".$_GET['album']."' src='images/up.png'></a>";
} else {
$up_pic .= "<a href='euser.php?id=".$this->var['user_id']."&page=".$_GET['page']."'><img style='border: 0px solid ; width: 32px; height: 32px;' alt='next' title='".PROFILE_34."' src='images/up.png'></a>";
}

$text .= '<table style="text-align: left; width: 100%; margin-left: auto; margin-right: auto;" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td colspan="3" rowspan="1" style="vertical-align: top;"><br>
';



						if ($this->var['euser_pref']['lightview'] == 'Yes' && $this->var['euser_pref']['cl_widget_ver'] != ''){
							if ($kep_sz<$picviewsize+31) {
//								$text .= "<center><img src='".$dir.$_GET['pic']."'><br>".str_replace("_", " ", $picname)."</center><br/><br/>";
								$text .= "<center><img src='".$dir.$_GET['pic']."'><br>".str_replace("_", " ", $picname)."</center><br/>";
							} else {
								$text .= "<center><a href='".$dir.$_GET['pic']."' class=\"lightview\" title='".$username.": ::".str_replace("_", " ", $picname)."'><img src='".$dir.$_GET['pic']."' width='$picviewsize'></a><br/>".str_replace("_", " ", $picname)."a</center>";
							}
						} else if ($this->var['euser_pref']['lightwindowbox'] == 'Yes' && (file_exists(e_PLUGIN."lightwindow/js/lightwindow.js"))){
							if ($kep_sz<$picviewsize+31) {
//								$text .= "<center><img src='".$dir.$_GET['pic']."'><br>".str_replace("_", " ", $picname)."</center><br/><br/>";
								$text .= "<center><img src='".$dir.$_GET['pic']."'><br>".str_replace("_", " ", $picname)."</center><br/>";
							} else {
								$text .= "<center><a href='".$dir.$_GET['pic']."' class=\"lightwindow\" title='".$_GET['pic']."'><img src='".$dir.$_GET['pic']."' width='$picviewsize'></a><br/>".str_replace("_", " ", $picname)."</center>";
							}
						} else if ($this->var['euser_pref']['lightbox'] == 'Yes' && $this->var['euser_pref']['lightb_enabled'] == '1'){
							if ($kep_sz<$picviewsize+31) {
//								$text .= "<center><img src='".$dir.$_GET['pic']."'><br>".str_replace("_", " ", $picname)."</center><br/><br/>";
								$text .= "<center><img src='".$dir.$_GET['pic']."'><br>".str_replace("_", " ", $picname)."</center><br/>";
							} else {
								$text .= "<center><a href='".$dir.$_GET['pic']."' rel=\"lightbox[roadtrip]\" title='".$_GET['pic']."'><img src='".$dir.$_GET['pic']."' width='$picviewsize'></a><br/>".str_replace("_", " ", $picname)."</center>";
							}
						} else if ($this->var['euser_pref']['clearbox'] == 'Yes'){
							echo '
								<script language="JavaScript" src="clearbox/js/clearbox.js" type="text/javascript" charset="iso-8859-2"></script>
								<link rel="stylesheet" href="clearbox/css/clearbox.css" rel="stylesheet" type="text/css"/>
							';
							if ($kep_sz<$picviewsize+31) {
//								$text .= "<center><img src='".$dir.$_GET['pic']."'><br>".str_replace("_", " ", $picname)."</center><br/><br/>";
								$text .= "<center><img src='".$dir.$_GET['pic']."'><br>".str_replace("_", " ", $picname)."</center><br/>";
							} else {
								$text .= "<center><a href='".$dir.$_GET['pic']."' rel=\"clearbox\" title='".$_GET['pic']."'><img src='".$dir.$_GET['pic']."' width='$picviewsize'></a><br/>".str_replace("_", " ", $picname)."</center>";
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


 
						} else {
							if ($kep_sz<$picviewsize+31) {
//								$text .= "<center><img src='".$dir.$_GET['pic']."'><br>".str_replace("_", " ", $picname)."</center><br/><br/>";
								$text .= "<center><img src='".$dir.$_GET['pic']."'><br>".str_replace("_", " ", $picname)."</center><br/>";
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






						$sql->mySQLresult = @mysql_query("SELECT com_id, com_message, com_date, com_by FROM ".MPREFIX."euser_com WHERE com_to='".$this->var['user_id']."' AND com_type='pics' AND com_extra='".mysql_real_escape_string($_GET['album'])."/".mysql_real_escape_string($_GET['pic'])."' ORDER BY com_date DESC");
						$piccomm = $sql->db_Rows();
						// Kép hozzászólások listázása
						$sql->mySQLresult = @mysql_query("SELECT com_id FROM ".MPREFIX."euser_com WHERE com_to='".$this->var['user_id']."' AND com_extra='".mysql_real_escape_string($_GET['album'])."/".mysql_real_escape_string($_GET['pic'])."'");
						$picnumrows = $sql->db_Rows();
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
						$sql->mySQLresult = @mysql_query("SELECT com_id, com_message, com_date, com_by FROM ".MPREFIX."euser_com WHERE com_to='".$this->var['user_id']."' AND com_type='pics' AND com_extra='".mysql_real_escape_string($_GET['album'])."/".mysql_real_escape_string($_GET['pic'])."' ORDER BY com_date $comment_order LIMIT $offset,$rowsPerPage");
						$piccomm = $sql->db_Rows();
						$maxPage = ceil($picnumrows/$rowsPerPage);
						$self = $_SERVER['PHP_SELF'];
						$nav  = '';
						for($page = 1; $page <= $maxPage; $page++) {
							if ($page == $pageNum) {
								$nav .= ""; // no need to create a link to current page
							} else {
								$nav .= " <a href=\"$self?id=".$this->var['user_id']."&page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&comment_order=".$comment_order."&pgnum=".$page."\">$page</a> ";
							}
						}
						if ($pageNum > 1) {
							$page  = $pageNum - 1;
							$prev  = " <a href=\"$self?id=".$this->var['user_id']."&page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&comment_order=".$comment_order."&pgnum=".$page."\">".PROFILE_204."</a> ";
							$first = " <a href=\"$self?id=".$this->var['user_id']."&page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&comment_order=".$comment_order."&pgnum=".$page."\">".PROFILE_205."</a> ";
						} else {
							$prev  = ''; // we're on page one, don't print previous link
							$first = '&nbsp;'; // nor the first page link
						}
						if ($pageNum < $maxPage) {
							$page = $pageNum + 1;
							$next = " <a href=\"$self?id=".$this->var['user_id']."&page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&comment_order=".$comment_order."&pgnum=".$page."\">".PROFILE_202."</a> ";
							$last = " <a href=\"$self?id=".$this->var['user_id']."&page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&comment_order=".$comment_order."&pgnum=".$page."\">".PROFILE_203."</a> ";
						} else {
							$next = ''; // we're on the last page, don't print next link
							$last = '&nbsp;'; // nor the last page link
						}
						// END OF MULTIPAGES
	
						if ($this->var['euser_pref']['maxpiccomment'] != '') {
							$maxpiccomment = $this->var['euser_pref']['maxpiccomment'];
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
										$text .= "<td style='width:80%; text-align:right' class='forumheader' colspan='2'>".PROFILE_256."&nbsp;&nbsp;<a href=\"$self?id=".$this->var['user_id']."&page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&comment_order=ASC\"><img src='images/order_down.png' title='".PROFILE_310."'></a></td>";
									} else {
										$text .= "<td style='width:80%; text-align:right' class='forumheader' colspan='2'>".PROFILE_256."&nbsp;&nbsp;<a href=\"$self?id=".$this->var['user_id']."&page=images&album=".$_GET['album']."&pic=".$_GET['pic']."&comment_order=DESC\"><img src='images/order_up.png' title='".PROFILE_309."'></a></td>";
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
/*
								if( $checkonline > 0 ) {
									$online = "<img src='images/online.gif' title='".PROFILE_96."' style='vertical-align: middle;' />";
								} else {
									$online = "";
								}
								unset($checkonline,$on_name);
*/
								$text .= "<br><table width='100%' class='fborder'>
								<tr>
									<td style='width:20%; text-align:left' class='fcaption'>".PROFILE_268."".$from['user_name']."</td>
									<td style='width:60%; text-align:left' class='fcaption'>".PROFILE_269."</td>
									<td style='width:20%; text-align:right' class='fcaption'>id: #".$comid."</td>
								</tr>
									<td class='forumheader'>&nbsp;<img src='images/".(( $check > 0 )?"green":"gray").".png' title='".(( $check > 0 )?PROFILE_96:PROFILE_97)."' style='vertical-align: middle;' />&nbsp;&nbsp;<a href='euser.php?id=".$com['com_by']."'><b>".$from['user_name']."</b></a></td>
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
								if ($this->var['euser_pref']['user_warn_support'] == "Yes" AND $fromext['user_warn'] !='null' AND $fromext['user_warn'] !='') {
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
								if ($break[2] == 1 && $this->var['user_id'] != USERID) {
									if ((!in_array(USERID, $friendb)) && ($this->var['euser_pref']['friends'] == "ON" || $this->var['euser_pref']['friends'] == "")) {
										$text .= "<tr><td>".$username." ".PROFILE_107b."</td></tr></table></form>";
									} else if ($this->var['euser_pref']['friends'] != "ON") {
										$text .= "<tr><td>".$username." ".PROFILE_107c."</td></tr></table></form>";
									} else {
										$text .= $cpbox;
										///comment küldése
										$text .= "</td></tr><tr><td><br/><br/><input type='hidden' name='id' value='".$this->var['user_id']."'><input type='hidden' name='pic' value='".$_GET['pic']."'><input type='hidden' name='picfull' value='".$_GET['album']."/".$_GET['pic']."'><input type='hidden' name='picname' value='".$picname[0]."'><input type='hidden' name='txtfile' value='".$data."'>";
										if ($this->var['euser_pref']['buttontype'] == "Yes") {
											$text .= "<input type='image' name='post_comment' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_comment_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_comment.gif\"' src='images/buttons/".e_LANGUAGE."_comment.gif' >";
										} else {
										$text .= "<input type='submit' name='post_comment' value='".PROFILE_208."' class='button'>";
										}
									}
								} else {
									$text .= $cpbox;
									///comment küldése
									$text .= "</td></tr><tr><td><br/><br/><input type='hidden' name='id' value='".$this->var['user_id']."'><input type='hidden' name='pic' value='".$_GET['pic']."'><input type='hidden' name='picfull' value='".$_GET['album']."/".$_GET['pic']."'><input type='hidden' name='picname' value='".$picname[0]."'><input type='hidden' name='txtfile' value='".$data."'>";
									if ($this->var['euser_pref']['buttontype'] == "Yes") {
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
					$text .= "<a href='euser.php?id=".$this->var['user_id']."&page=".$_GET['page']."'><< ".PROFILE_34."</a><br/>";
					$dir = "userimages/".$this->var['user_id']."/".$_GET['album']."/";
					if ((in_array(USERID, $friendb) && ($this->var['euser_pref']['friends'] == "ON" || $this->var['euser_pref']['friends'] == "") && USER) || !file_exists("".$dir."/only_friends") || $this->var['user_id'] == USERID || (ADMIN && getperms("4"))) {
						if (file_exists($dir)) {
							// IF glob has been disabled by your host then uncomment the above function and comment out the next 2 lines.
							$empty = (count(glob("$dir/*")) === 0) ? 'TRUE' : 'FALSE';
							if ($empty == "TRUE") {
								// Comment out until here - when uncommenting above, just remove the /* and */ from function to if.
								$text .= "<br/><i>".PROFILE_123."</i>";
							} else {
								$column = 1;
								if ($this->var['euser_pref']['piccol']) {
									$profile_piccol = $this->var['euser_pref']['piccol'];
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
if ($this->var['euser_pref']['userpic_order'] == 'ASC' || $this->var['euser_pref']['userpic_order'] == '') {
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
												$this->var['user_id'] = $split_id;
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
											$text .= "<td width='".$profile_piccol_p."%'><center><a href='euser.php?id=".$this->var['user_id']."&page=".$_GET['page']."&album=".$_GET['album']."&pic=".$file."'><img src='".$dir."thumbs/".$file."'></a><br/>".str_replace("_", " ", $newname);
											$query = mysql_query("SELECT com_id FROM ".MPREFIX."euser_com WHERE com_type='pics' AND com_extra='".mysql_real_escape_string($_GET['album'])."/".mysql_real_escape_string($file)."' ");
											$pic_all = mysql_num_rows($query);
											if ($pic_all > 0) {
												$text .= "<br/>".$pic_all." ".($pic_all == 1 ? PROFILE_315 : PROFILE_315)."</center></td>";
											} else {
												$text .= "</center></td>";
											}
										} else {
											$text .= "<td width='".$profile_piccol_p."%'><center><a href='euser.php?id=".$this->var['user_id']."&page=".$_GET['page']."&album=".$_GET['album']."&pic=".$file."'><img src='".$dir.$file."' width='100'></a><br/>".str_replace("_", " ", $newname)."";
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
//var_dump ("TESTERSRERERERE");
					$dir = "userimages/".$this->var['user_id']."/";
//MOD_20120418
					if ($handle = opendir($dir)) {
						$filenames = array();
						while (false !== ($filename = readdir($handle))) {
							$file_list[] = array('name' => $filename, 'size' => filesize($dir."/".$filename), 'mtime' => filemtime($dir."/".$filename));
						}
if ($this->var['euser_pref']['userpic_order'] == 'ASC' || $this->var['euser_pref']['userpic_order'] == '') {
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
						if ($this->var['euser_pref']['piccol']) {
							$profile_piccol = $this->var['euser_pref']['piccol'];
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
											$this->var['user_id'] = $split_id;
											$lnk=true;
											break;
										}
									}
									$kiterjesztes = $split[$counter - 1];
									$name = str_replace(".".$split[$counter - 1]."", "", $file);
									$newname = wordwrap($name, 17, "<br />\n");
									//Pictures:
									if (file_exists($dir."thumbs/".$file)) {
										$pic .= "<td width='".$profile_piccol_p."%'><center><a href='euser.php?id=".$this->var['user_id']."&page=images&album=root&pic=".$file."'><img src='".$dir."thumbs/".$file."'></a><br/>".str_replace("_", " ", $newname)."";
										$query = mysql_query("SELECT com_id FROM ".MPREFIX."euser_com WHERE com_type='pics' AND com_extra='root/".mysql_real_escape_string($file)."' ");
										$pic_all = mysql_num_rows($query);
										if ($pic_all > 0) {
											$pic .= "<br/>".$pic_all." ".($pic_all == 1 ? PROFILE_315 : PROFILE_315)."</center></td>";
										} else {
											$pic .= "</center></td>";
										}
									} else {
										$pic .= "<td width='".$profile_piccol_p."%'><center><a href='euser.php?id=".$this->var['user_id']."&page=images&album=root&pic=".$file."'><img src='".$dir.$file."' width='100'></a><br/>".str_replace("_", " ", $newname)."";
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
										$imageurl = "src='userimages/".$this->var['user_id']."/".$file."/thumbs/".$firstimage."' ";
									} else {
										$imageurl = "src='userimages/".$this->var['user_id']."/".$file."/".$firstimage."' width='100' ";
									}
									//Albums:
									if ((in_array(USERID, $friendb) && ($this->var['euser_pref']['friends'] == "ON" || $this->var['euser_pref']['friends'] == "") && USER) || $aof != 1 || $this->var['user_id'] == USERID || (ADMIN && getperms("4"))) {
/*
										if ($count == 0) {
											$text .="<td width='".$profile_piccol_p."%'><center><a href='euser.php?id=".$this->var['user_id']."&page=images&album=".$file."'  style=\"text-decoration: none;\"><img src='images/folder.png' width='64' style='padding:5px;border-style:outset;border-width:1px'><br/>".str_replace("_", " ", $file)."</a><br/><br/>".$count." ".($count == 1 ? PROFILE_134 : PROFILE_135)."<br/><br/></center></td>";
										} else {
											$text .="<td width='".$profile_piccol_p."%'><center><a href='euser.php?id=".$this->var['user_id']."&page=images&album=".$file."'  style=\"text-decoration: none;\"><img ".$imageurl." style='padding:5px;border-style:outset;border-width:3px'><br/>".str_replace("_", " ", $file)."</a><br/><br/>".$count." ".($count == 1 ? PROFILE_134 : PROFILE_135)."<br/><br/></center></td>";
										}
*/

											$text .="<td width='".$profile_piccol_p."%'><center><a href='euser.php?id=".$this->var['user_id']."&page=images&album=".$file."'  style=\"text-decoration: none;\"><img ".($count == 0?"src='images/folder.png' width='64'":$imageurl)." style='padding:5px;border-style:outset;border-width:3px'><br/>".str_replace("_", " ", $file)."</a><br/>".$count." ".($count == 1 ? PROFILE_134 : PROFILE_135)."<br/><p/></center></td>";

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
					$text .= "</td></tr></table>";

/*
					if ($numpicfiles > 2) {
						$text .= "<br/><table width='100%' ><tr><td class='forumheader' colspan='3' ><div class='smallblacktext'><a href='".e_SELF."?".e_QUERY."#top' onclick=\"window.scrollTo(0,0);\">".PROFILE_271."</a></div></td></tr></table>";
					}
*/
				}
return $text;
