<?php
/*
+---------------------------------------------------------------+
|	e107 website system
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

require_once('../../class2.php');
if(!getperms('P')){ header('location:'.e_BASE.'index.php'); exit ;}
require_once(e_ADMIN.'auth.php');
require_once(e_HANDLER.'userclass_class.php');

include_lan(e_PLUGIN.'list_new/languages/'.e_LANGUAGE.'.php');

$lan_file = e_PLUGIN.'euser/languages/admin_'.e_LANGUAGE.'.php';
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.'euser/languages/admin_English.php');

//include_once(e_PLUGIN.'euser/functions.php');
include_once(e_PLUGIN.'euser/euser_class.php');


$islistinstalled = $sql -> db_Count('plugin', '(*)', 'WHERE plugin_path ="list_new" AND plugin_installflag ="1"');


if(IsSet($_POST['update_menu'])){

	if($_POST['onlineinfo_showupdates']==e_UC_PUBLIC){$_POST['onlineinfo_showupdates']=e_UC_MEMBER;}
	
$euser_pref['coppermine']=$_POST['onlineinfo_coppermine'];
$euser_pref['guestbook']=$_POST['onlineinfo_guestbook'];
$euser_pref['downloads']=$_POST['onlineinfo_downloads'];
$euser_pref['new_icon']=$_POST['onlineinfo_new_icon'];
$euser_pref['new_icontype']=$_POST['onlineinfo_new_icontype'];
$euser_pref['hideadminarea']=$_POST['onlineinfo_hideadminarea'];
$euser_pref['content']=$_POST['onlineinfo_content'];
$euser_pref['chatnum']=$_POST['onlineinfo_chatnum'];
$euser_pref['forumnum']=$_POST['onlineinfo_forumnum'];
$euser_pref['downloadnum']=$_POST['onlineinfo_downloadnum'];
$euser_pref['guestbooknum']=$_POST['onlineinfo_guestbooknum'];
$euser_pref['copperminenum']=$_POST['onlineinfo_copperminenum'];
$euser_pref['commentsnum']=$_POST['onlineinfo_commentsnum'];
$euser_pref['copperminecommentsnum']=$_POST['onlineinfo_copperminecommentsnum'];
$euser_pref['linksnum']=$_POST['onlineinfo_linksnum'];
$euser_pref['usersnum']=$_POST['onlineinfo_usersnum'];
$euser_pref['newsnum']=$_POST['onlineinfo_newsnum'];
$euser_pref['contentsnum']=$_POST['onlineinfo_contentsnum'];
$euser_pref['whatsnewtype']=$_POST['onlineinfo_whatsnewtype'];
$euser_pref['flashtext']=$_POST['onlineinfo_flashtext'];
$euser_pref['flashtext_colour']=$_POST['onlineinfo_flashtext_colour'];
$euser_pref['chatbox']=$_POST['onlineinfo_chatbox'];
$euser_pref['hideadmin']=$_POST['onlineinfo_hideadmin'];
$euser_pref['hideregusers']=$_POST['onlineinfo_hideregusers'];
$euser_pref['showregusers']=$_POST['onlineinfo_showregusers'];
$euser_pref['shownews']=$_POST['onlineinfo_shownews'];
$euser_pref['youtubenum']=$_POST['onlineinfo_youtubenum'];
$euser_pref['youtube']=$_POST['onlineinfo_youtube'];
$euser_pref['forum_summary']=$_POST['onlineinfo_forum_summary'];
$euser_pref['kroozearcade']=$_POST['onlineinfo_kroozearcade'];
$euser_pref['kroozearcadenum']=$_POST['onlineinfo_kroozearcadenum'];
$euser_pref['kroozearcadetop']=$_POST['onlineinfo_kroozearcadetop'];
$euser_pref['kroozearcadetopnum']=$_POST['onlineinfo_kroozearcadetopnum'];
$euser_pref['links']=$_POST['onlineinfo_links'];
$euser_pref['members']=$_POST['onlineinfo_members'];
$euser_pref['bugtracker3']=$_POST['onlineinfo_bugtracker3'];
$euser_pref['bugtracker3commentsnum']=$_POST['onlineinfo_bugtracker3commentsnum'];
$euser_pref['hideifnonew']=$_POST['onlineinfo_hideifnonew'];

$euser_pref['chatboxII']=$_POST['onlineinfo_chatboxII'];
$euser_pref['chatIInum']=$_POST['onlineinfo_chatIInum'];
$euser_pref['joke']=$_POST['onlineinfo_joke'];
$euser_pref['jokenum']=$_POST['onlineinfo_jokenum'];
$euser_pref['blog']=$_POST['onlineinfo_blog'];
$euser_pref['blognum']=$_POST['onlineinfo_blognum'];
$euser_pref['suggestions']=$_POST['onlineinfo_suggestions'];
$euser_pref['suggestionsnum']=$_POST['onlineinfo_suggestionsnum'];
$euser_pref['showcomments']=$_POST['onlineinfo_showcomments'];

	save_prefs();

	$ns -> tablerender('', '<div style="text-align:center"><b>' .EUSER_LOGIN_MENU_A1.' ( '.EUSER_LOGIN_MENU_A76. ' )</b></div>');
}

$onlineinfo_coppermine = $euser_pref['coppermine'];
$onlineinfo_guestbook = $euser_pref['guestbook'];
$onlineinfo_downloads = $euser_pref['downloads'];
$onlineinfo_new_icon = $euser_pref['new_icon'];
$onlineinfo_new_icontype = $euser_pref['new_icontype'];
$onlineinfo_hideadminarea = $euser_pref['hideadminarea'];
$onlineinfo_content = $euser_pref['content'];
$onlineinfo_chatnum = $euser_pref['chatnum'];
$onlineinfo_forumnum = $euser_pref['forumnum'];
$onlineinfo_downloadnum = $euser_pref['downloadnum'];
$onlineinfo_guestbooknum = $euser_pref['guestbooknum'];
$onlineinfo_copperminenum = $euser_pref['copperminenum'];
$onlineinfo_commentsnum = $euser_pref['commentsnum'];
$onlineinfo_copperminecommentsnum = $euser_pref['copperminecommentsnum'];
$onlineinfo_linksnum = $euser_pref['linksnum'];
$onlineinfo_usersnum = $euser_pref['usersnum'];
$onlineinfo_newsnum = $euser_pref['newsnum'];
$onlineinfo_contentsnum = $euser_pref['contentsnum'];
$onlineinfo_whatsnewtype = $euser_pref['whatsnewtype'];
$onlineinfo_flashtext = $euser_pref['flashtext'];
$onlineinfo_flashtext_colour = $euser_pref['flashtext_colour'];
$onlineinfo_chatbox = $euser_pref['chatbox'];
$onlineinfo_forum = $euser_pref['forum'];
$onlineinfo_hideadmin = $euser_pref['hideadmin'];
$onlineinfo_hideregusers = $euser_pref['hideregusers'];
$onlineinfo_showregusers = $euser_pref['showregusers'];
$onlineinfo_youtubenum = $euser_pref['youtubenum'];
$onlineinfo_youtube = $euser_pref['youtube'];
$onlineinfo_shownews = $euser_pref['shownews'];
$onlineinfo_forum_summary  = $euser_pref['forum_summary'];
$onlineinfo_kroozearcadenum = $euser_pref['kroozearcadenum'];
$onlineinfo_kroozearcade = $euser_pref['kroozearcade'];
$onlineinfo_kroozearcadetopnum = $euser_pref['kroozearcadetopnum'];
$onlineinfo_kroozearcadetop = $euser_pref['kroozearcadetop'];
$onlineinfo_links = $euser_pref['links'];
$onlineinfo_members = $euser_pref['members'];
$onlineinfo_bugtracker3 = $euser_pref['bugtracker3'];
$onlineinfo_bugtracker3commentsnum = $euser_pref['bugtracker3commentsnum'];
$onlineinfo_hideifnonew = $euser_pref['hideifnonew'];
//added 8.5.0
$onlineinfo_chatboxII = $euser_pref['chatboxII'];
$onlineinfo_chatIInum = $euser_pref['chatIInum'];
$onlineinfo_joke = $euser_pref['joke'];
$onlineinfo_jokenum = $euser_pref['jokenum'];
$onlineinfo_blog = $euser_pref['blog'];
$onlineinfo_blognum = $euser_pref['blognum'];
$onlineinfo_suggestions = $euser_pref['suggestions'];
$onlineinfo_suggestionsnum = $euser_pref['suggestionsnum'];
$onlineinfo_showcomments = $euser_pref['showcomments'];



$text = '<div style="text-align:center">
<form method="POST" action="'.e_SELF.'" name="menu_conf_form">
<table class="fborder">';


// check for plugins installed and active
$iscopperinstalled = $sql -> db_Count('plugin', '(*)', 'WHERE plugin_path ="coppermine_menu" AND plugin_installflag ="1"');
$isguestbookinstalled = $sql -> db_Count('plugin', '(*)', 'WHERE plugin_path ="guestbook" AND plugin_installflag ="1"');
$ischatboxinstalled = $sql -> db_Count('plugin', '(*)', 'WHERE plugin_path ="chatbox_menu" AND plugin_installflag ="1"');
$ischatboxIIinstalled = $sql -> db_Count('plugin', '(*)', 'WHERE plugin_path ="chatbox2_menu" AND plugin_installflag ="1"');
$isforuminstalled = $sql -> db_Count('plugin', '(*)', 'WHERE plugin_path ="forum" AND plugin_installflag ="1"');
$isyoutubeinstalled = $sql -> db_Count('plugin', '(*)', 'WHERE plugin_path ="ytm_gallery" AND plugin_installflag ="1"');
$iskroozearcadeinstalled = $sql -> db_Count('plugin', '(*)', 'WHERE plugin_path ="kroozearcade_menu" AND plugin_installflag ="1"');
$islinkpageinstalled = $sql -> db_Count('plugin', '(*)', 'WHERE plugin_path ="links_page" AND plugin_installflag ="1"');
$isbugtracker3installed = $sql -> db_Count('plugin', '(*)', 'WHERE plugin_path ="bugtracker3" AND plugin_installflag ="1"');
$isjokeinstalled = $sql -> db_Count('plugin', '(*)', 'WHERE plugin_path ="jokes_menu" AND plugin_installflag ="1"');
$isbloginstalled = $sql -> db_Count('plugin', '(*)', 'WHERE plugin_path ="userjournals_menu" AND plugin_installflag ="1"');
$issuggestioninstalled = $sql -> db_Count('plugin', '(*)', 'WHERE plugin_path ="suggestions_menu" AND plugin_installflag ="1"');


$text .= '<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A107. '</td>
<td class="forumheader3" colspan="4">';

if($onlineinfo_whatsnewtype=='1'){
$text.=EUSER_LOGIN_MENU_A108.'<input type="radio"  name="onlineinfo_whatsnewtype" value="1" checked />&nbsp;&nbsp;&nbsp;';

	$text.=EUSER_LOGIN_MENU_A109.'<input type="radio"  name="onlineinfo_whatsnewtype" value="0"';

	if($islistinstalled==1){
		$text.=' />';
	}else{
		$text.=' disabled />';
	}
}else{



	if($islistinstalled==1){
		$text.=EUSER_LOGIN_MENU_A108.'<input type="radio"  name="onlineinfo_whatsnewtype" value="1" />&nbsp;&nbsp;&nbsp;';
		$text.=EUSER_LOGIN_MENU_A109.'<input type="radio"  name="onlineinfo_whatsnewtype" value="0" checked />';
	}else{
		$text.=EUSER_LOGIN_MENU_A108.'<input type="radio"  name="onlineinfo_whatsnewtype" value="1" checked />&nbsp;&nbsp;&nbsp;';
		$text.=EUSER_LOGIN_MENU_A109.'<input type="radio"  name="onlineinfo_whatsnewtype" value="0" disabled />';
	}
}

$text.='</td>
</tr>
<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A68. '</td>
<td class="forumheader3" colspan="3">'.r_userclass('onlineinfo_showregusers',$onlineinfo_showregusers).'</td>

</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A123. '</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_hideregusers',$onlineinfo_hideregusers).'</td>
</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A12. '</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_flashtext',$onlineinfo_flashtext).'
&nbsp;&nbsp;&nbsp;' .EUSER_LOGIN_MENU_A13.Create_colour_dropdown('onlineinfo_flashtext_colour',$onlineinfo_flashtext_colour).'
</td>
</tr>


<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A23. '</td>
<td class="forumheader3">'.Create_yes_no_dropdown('onlineinfo_new_icon',$onlineinfo_new_icon).'</td>';


if($onlineinfo_new_icontype=='new.gif') {
$text .='<td class="forumheader3">' .EUSER_LOGIN_MENU_A24. '<br /><span class="smalltext">' .EUSER_LOGIN_MENU_A25. '</span></td>
<td class="forumheader3"><input type="radio"  name="onlineinfo_new_icontype" value="new.gif" checked />&nbsp;<img src="'.e_PLUGIN.'euser/images/new.gif" />' .EUSER_LOGIN_MENU_A26. '<br /><input type="radio"  name="onlineinfo_new_icontype" value="new2.gif"/>&nbsp;<img src="'.e_PLUGIN.'euser/images/new2.gif" />' .EUSER_LOGIN_MENU_A27. '</td>';
}else{
$text .='<td class="forumheader3">'.EUSER_LOGIN_MENU_A24.'<br /><span class="smalltext">' .EUSER_LOGIN_MENU_A25. '</span></td>
<td class="forumheader3"><input type="radio"  name="onlineinfo_new_icontype" value="new.gif"/>&nbsp;<img src="'.e_PLUGIN.'euser/images/new.gif" />' .EUSER_LOGIN_MENU_A26. '<br /><input type="radio"  name="onlineinfo_new_icontype" value="new2.gif" checked />&nbsp;<img src="'.e_PLUGIN.'euser/images/new2.gif" />' .EUSER_LOGIN_MENU_A27. '</td>';
}


$text .='</tr>
<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A177. '</td>
<td class="forumheader3" colspan="4">'.Create_yes_no_dropdown('onlineinfo_hideifnonew',$onlineinfo_hideifnonew).'<span class="smalltext">'.EUSER_LOGIN_MENU_A178.'</span></td>
</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A63. '</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_hideadminarea',$onlineinfo_hideadminarea).'&nbsp;&nbsp;&nbsp;'.EUSER_LOGIN_MENU_A122.Create_yes_no_dropdown('onlineinfo_hideadmin',$onlineinfo_hideadmin).'
</td>
</tr>

<tr><td class="forumheader3" colspan="5" style="font-style: italic;">'.EUSER_LOGIN_MENU_A171.'</td></tr>

<tr>
<td class="forumheader" colspan="5" style="text-align:center; font-weight:bold;">' .EUSER_LOGIN_MENU_A89. '</td>
</tr>

<tr>
<td class="forumheader3" style="text-align:center; font-weight:bold;">'.EUSER_LOGIN_MENU_A199.'</td>
<td class="forumheader3" style="text-align:center; font-weight:bold;">'.EUSER_LOGIN_MENU_A200.'</td>
<td class="forumheader3" style="text-align:center; font-weight:bold;">'.EUSER_LOGIN_MENU_A201.'</td>
<td class="forumheader3" style="text-align:center; font-weight:bold;">'.EUSER_LOGIN_MENU_A176.'</td>
</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A153. '</td>
<td class="forumheader3">'.Create_yes_no_dropdown('onlineinfo_shownews',$onlineinfo_shownews).'</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_newsnum" size="4" value="'.$onlineinfo_newsnum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A67. '</td>
<td class="forumheader3">'.Create_yes_no_dropdown('onlineinfo_content',$onlineinfo_content).'</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_contentsnum" size="4" value="'.$onlineinfo_contentsnum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A14. '</td>

<td class="forumheader3">';

if ($ischatboxinstalled==1){
$text .=Create_yes_no_dropdown('onlineinfo_chatbox',$onlineinfo_chatbox);
}else{
$text .=Create_no_dropdown('onlineinfo_chatbox','0');
}

$text.='</td>

<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_chatnum" size="4" value="'.$onlineinfo_chatnum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A182. '</td>

<td class="forumheader3">';


if ($ischatboxIIinstalled==1){
$text .=Create_yes_no_dropdown('onlineinfo_chatboxII',$onlineinfo_chatboxII);
}else{
$text .=Create_no_dropdown('onlineinfo_chatboxII','0');
}

$text.='</td>';


$text.='<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_chatIInum" size="4" value="'.$onlineinfo_chatIInum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A121. '</td>
<td class="forumheader3">
';


if ($isforuminstalled==1){
$text .=Create_yes_no_dropdown('onlineinfo_forum',$onlineinfo_forum);
}else{
$text .=Create_no_dropdown('onlineinfo_forum','0');
}

$text.='</td>

<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_forumnum" size="4" value="'.$onlineinfo_forumnum .'" maxlength="4" /></td>';


$text .='<td class="forumheader3"><b>'.EUSER_LOGIN_MENU_A156.'</b>';

	if($onlineinfo_forum_summary==1){
		$text.=EUSER_LOGIN_MENU_A157.'<input type="radio"  name="onlineinfo_forum_summary" value="1" checked />&nbsp;&nbsp;&nbsp;';
		$text.=EUSER_LOGIN_MENU_A158.'<input type="radio"  name="onlineinfo_forum_summary" value="0" />';
	}else{
		$text.=EUSER_LOGIN_MENU_A157.'<input type="radio"  name="onlineinfo_forum_summary" value="1" />&nbsp;&nbsp;&nbsp;';
		$text.=EUSER_LOGIN_MENU_A158.'<input type="radio"  name="onlineinfo_forum_summary" value="0" checked />';
	}

$text.='</td>
</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A28. '</td>
<td class="forumheader3">'.Create_yes_no_dropdown('onlineinfo_downloads',$onlineinfo_downloads).'</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_downloadnum" size="4" value="'.$onlineinfo_downloadnum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A29. '</td>
<td class="forumheader3">
';

if ($iscopperinstalled==1){
$text .=Create_yes_no_dropdown('onlineinfo_coppermine',$onlineinfo_coppermine);
}else{
$text .=Create_no_dropdown('onlineinfo_coppermine','0');
}

$text.='</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_copperminenum" size="4" value="'.$onlineinfo_copperminenum .'" maxlength="4" /></td>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A96. '<input class="tbox" type="text" name="onlineinfo_copperminecommentsnum" size="4" value="'.$onlineinfo_copperminecommentsnum .'" maxlength="4" /></td>
</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A57. '</td>
<td class="forumheader3">
';

if ($isguestbookinstalled==1){
$text .=Create_yes_no_dropdown('onlineinfo_guestbook',$onlineinfo_guestbook);
}else{
$text .=Create_no_dropdown('onlineinfo_guestbook','0');
}

$text.='</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_guestbooknum" size="4" value="'.$onlineinfo_guestbooknum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A155. '</td>

<td class="forumheader3">';

if ($isyoutubeinstalled==1){
$text .=Create_yes_no_dropdown('onlineinfo_youtube',$onlineinfo_youtube);
}else{
$text .=Create_no_dropdown('onlineinfo_youtube','0');
}

$text.='</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_youtubenum" size="4" value="'.$onlineinfo_youtubenum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A165. '</td>
<td class="forumheader3">
';

if ($iskroozearcadeinstalled==1){
$text .=Create_yes_no_dropdown('onlineinfo_kroozearcade',$onlineinfo_kroozearcade);
}else{
$text .=Create_no_dropdown('onlineinfo_kroozearcade','0');
}

$text.='</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_kroozearcadenum" size="4" value="'.$onlineinfo_kroozearcadenum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A166. '</td>

<td class="forumheader3">';

if ($iskroozearcadeinstalled==1){
$text .=Create_yes_no_dropdown('onlineinfo_kroozearcadetop',$onlineinfo_kroozearcadetop);
}else{
$text .=Create_no_dropdown('onlineinfo_kroozearcadetop','0');
}

$text.='</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_kroozearcadetopnum" size="4" value="'.$onlineinfo_kroozearcadetopnum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A169. '</td>

<td class="forumheader3">';

if ($islinkpageinstalled==1){
$text .=Create_yes_no_dropdown('onlineinfo_links',$onlineinfo_links);
}else{
$text .=Create_no_dropdown('onlineinfo_links','0');
}

$text.='</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_linksnum" size="4" value="'.$onlineinfo_linksnum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A170. '</td>
<td class="forumheader3">'.Create_yes_no_dropdown('onlineinfo_members',$onlineinfo_members).'</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_usersnum" size="4" value="'.$onlineinfo_usersnum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A173. '</td>

<td class="forumheader3">';

if ($isbugtracker3installed==1){
$text .=Create_yes_no_dropdown('onlineinfo_bugtracker3',$onlineinfo_bugtracker3);
}else{
$text .=Create_no_dropdown('onlineinfo_bugtracker3','0');
}

$text.='</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_bugtracker3commentsnum" size="4" value="'.$onlineinfo_bugtracker3commentsnum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A194. '</td>

<td class="forumheader3">';

if ($isjokeinstalled==1){
$text .=Create_yes_no_dropdown('onlineinfo_joke',$onlineinfo_joke);
}else{
$text .=Create_no_dropdown('onlineinfo_joke','0');
}

$text.='</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_jokenum" size="4" value="'.$onlineinfo_jokenum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A196. '</td>

<td class="forumheader3">';

if ($isbloginstalled==1){
$text .=Create_yes_no_dropdown('onlineinfo_blog',$onlineinfo_blog);
}else{
$text .=Create_no_dropdown('onlineinfo_blog','0');
}

$text.='</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_blognum" size="4" value="'.$onlineinfo_blognum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A198. '</td>

<td class="forumheader3">';

if ($issuggestioninstalled==1){
$text .=Create_yes_no_dropdown('onlineinfo_suggestions',$onlineinfo_suggestions);
}else{
$text .=Create_no_dropdown('onlineinfo_suggestions','0');
}

$text.='</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_suggestionsnum" size="4" value="'.$onlineinfo_suggestionsnum .'" maxlength="4" /></td>
<td class="forumheader3">&nbsp;</td>
</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A95. '</td>
<td class="forumheader3">'.Create_yes_no_dropdown('onlineinfo_showcomments',$onlineinfo_showcomments).'</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_commentsnum" size="4" value="'.$onlineinfo_commentsnum .'" maxlength="4" /></td>
<td class="forumheader3" style="text-style:italic;">'.EUSER_LOGIN_MENU_A202.'</td>
</tr>

<tr>
<td colspan="6" class="forumheader" style="text-align:center"><input class="button" type="submit" name="update_menu" value="' .EUSER_LOGIN_MENU_A56. '" /></td>
</tr>
</table>
</form>
</div>';

$ns -> tablerender(EUSER_LOGIN_MENU_A2.' - '.EUSER_LOGIN_MENU_A76, $text);

require_once(e_ADMIN.'footer.php');

?>