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

var_dump ($this->euser_pref);
if ($this->euser_pref['mp3_sys'] == "OFF") {
//	Header("Location: euser_settings.php?".$luid." ");
	return null;
}
//$text .= "<table width='100%'><tr><td class='forumheader'><img src='images/music.png'>".PROFILE_166."</td></tr></table>";

$text .= "<table width='100%'><tr><td class='forumheader'><img src='images/music.png'><span style='text-align:center;width: 100%;position: absolute;line-height: 1.25em;'><b><u>".PROFILE_166."</u></b><br>";
	$text .= PROFILE_180."".sprintf("%01.1f", $maxmp3meret)."".PROFILE_181.$currentmp3;
$text .= "</span></td></tr></table>";

$text .= "<form method='POST' enctype='multipart/form-data' action='formhandler.php'>";

//$sql->db_Select("euser","user_mp3","user_id=".intval($id)."");
//$row = $sql->db_Fetch();
//$sql->db_Select("euser","user_mp3","user_id=".intval($id)."");
$row = $this->sql->retrieve("euser","user_mp3","user_id=".intval($id)."");

if ($this->euser_pref['mp3'] == "Both") {
	$text .= "<br /><table width='100%'><tr><td class='forumheader'>".PROFILE_154."</td></tr></table>";
	if ($row['user_mp3'] == "") {
		$http = 1;
		$text .= "<input type='radio' id='select' name='usemp3' value='remote'> ".PROFILE_152."    <input type='radio' id='select' name='usemp3' value='local'> ".PROFILE_153."    <input type='radio' id='select' name='usemp3' value='none' checked> ".PROFILE_159."<br/><br/>";
	} elseif(strpos($row['user_mp3'], "http://") === false && strpos($row['user_mp3'], "https://") === false && strpos($row['user_mp3'], "ftp://") === false) {
		$http = 0;
		$text .= "<input type='radio' id='select' name='usemp3' value='remote'> ".PROFILE_152."    <input type='radio' id='select' name='usemp3' value='local' checked> ".PROFILE_153."     <input type='radio' id='select' name='usemp3' value='none'> ".PROFILE_159."<br/><br/>";
	} else {
		$http = 1;
		$text .= "<input type='radio' id='select' name='usemp3' value='remote' checked> ".PROFILE_152."    <input type='radio' id='select' name='usemp3' value='local'> ".PROFILE_153."    <input type='radio' id='select' name='usemp3' value='none'> ".PROFILE_159."<br/><br/>";
	}
	$text .= "<table width='100%'><tr><td class='forumheader'>".PROFILE_150."</td></tr></table>";
	if ($row['user_mp3'] != "" && $http == 1) {
		$value = $row['user_mp3'];
	} else {
		$value = "http://...";
	}
	$text .= "<br/><input type='text' class='tbox' size='80' name='remote' value='".$value."'><br/><br/>";
}

if ($this->euser_pref['mp3'] == "Remote Only") {
	$http = 1;
	$text .= "<input type='hidden' id='select' name='usemp3' value='remote' checked>";
	if(strpos($row['user_mp3'], "http://") === false && strpos($row['user_mp3'], "https://") === false && strpos($row['user_mp3'], "ftp://") === false) {
	$http = 0;
}
if ($row['user_mp3'] != "" && $http == 1) {
	$value = $row['user_mp3'];
	$text .= "<input type='radio' id='select' name='usemp3' value='none'> ".PROFILE_159a."<br/><br/>";
} else {
	$value = "http://...";
}
	$text .= "<br/><table width='100%'><tr><td class='forumheader'>".PROFILE_150a."</td></tr></table>";
	$text .= "<br/><input type='text' class='tbox' size='80' name='remote' value='".$value."'><br/><br/>";
}

if ($this->euser_pref['mp3'] == "Both") {
	$text .= "<table width='100%'><tr><td class='forumheader'>".PROFILE_155."</td></tr></table>";
}

if ($this->euser_pref['mp3'] == "Local Only") {
	$text .= "<input type='radio' id='select' name='usemp3' value='none'> ".PROFILE_159a."<br/><br/>";
	$text .= "<table width='100%'><tr><td class='forumheader'>".PROFILE_155a."</td></tr></table>";
}
if ($this->euser_pref['mp3'] == "Both" || $this->euser_pref['mp3'] == "Local Only") {
	$text .= "<br/>".PROFILE_151."<br/><br/><input type='file' class='tbox' name='file_userfile[]' value='".$lvalue."'>";
}

if ($this->euser_pref['buttontype'] == "Yes") {
	$text .= "<br/><br/><input type='hidden' value='".$id."' name='uid'><input type='image' name='updatesong' value='".PROFILE_222."' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_update_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_update.gif\"' src='images/buttons/".e_LANGUAGE."_update.gif' ><input type='hidden' name='updatesong'></form>";
} else {
	$text .= "<br/><br/><br/><input type='hidden' value='".$id."' name='uid'><input type='submit' class='button' name='updatesong' value='".PROFILE_222."'></form>";
}

//return $text;
