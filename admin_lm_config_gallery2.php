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
if(!getperms('P')){ header("location:".e_BASE."index.php"); exit ;}
require_once(e_ADMIN.'auth.php');
require_once(e_HANDLER.'userclass_class.php');

$lan_file = e_PLUGIN.'euser/languages/admin_'.e_LANGUAGE.'.php';
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.'euser/languages/admin_English.php');


//include_once(e_PLUGIN.'euser/functions.php');
include_once(e_PLUGIN.'euser/euser_class.php');


if(IsSet($_POST['update_menu'])){

$euser_pref['gallery2use']=$_POST['onlineinfo_gallery2use'];
$euser_pref['gallery2prefix']=$_POST['onlineinfo_gallery2prefix'];
$euser_pref['gallery2location']=$_POST['onlineinfo_gallery2location'];
$euser_pref['gallery2window']=$_POST['onlineinfo_gallery2window'];
$euser_pref['gallery2shownum']=$_POST['onlineinfo_gallery2shownum'];


	save_prefs();


	$ns -> tablerender('', '<div style="text-align:center"><b>' .EUSER_LOGIN_MENU_A1.' ( '.EUSER_LOGIN_MENU_A145. ' )</b></div>');
}



$onlineinfo_gallery2use = $euser_pref['gallery2use'];
$onlineinfo_gallery2prefix = $euser_pref['gallery2prefix'];
$onlineinfo_gallery2location = $euser_pref['gallery2location'];
$onlineinfo_gallery2window = $euser_pref['gallery2window'];
$onlineinfo_gallery2shownum = $euser_pref['gallery2shownum'];

$text = '<div style="text-align:center">
<form method="POST" action="'.e_SELF.'" name="menu_conf_form">
<table class="fborder">';


$text .= '<tr>
<td class="forumheader3" colspan="2">'.EUSER_LOGIN_MENU_A146.'</td>
</tr>

<tr>
<td class="forumheader3">'.EUSER_LOGIN_MENU_A113.EUSER_LOGIN_MENU_A147.'</td>
<td class="forumheader3">'.Create_yes_no_dropdown('onlineinfo_gallery2use',$onlineinfo_gallery2use).'</td>
</tr>

<tr>
<td class="forumheader3">'.EUSER_LOGIN_MENU_A147.EUSER_LOGIN_MENU_A111.'<br />('.ONLINEINFO_IPB_A6.'g2_)</td>
<td class="forumheader3"><input class="tbox" type="text" name="onlineinfo_gallery2prefix" size="12" value="'.$onlineinfo_gallery2prefix.'" maxlength="12" /></td>
</tr>

<tr>
<td class="forumheader3">'.EUSER_LOGIN_MENU_A147.EUSER_LOGIN_MENU_A112.'<br />('.ONLINEINFO_IPB_A6.SITEURL.'gallery2)</td>
<td class="forumheader3">'.SITEURL.'<input class="tbox" type="text" name="onlineinfo_gallery2location" size="24" value="'.$onlineinfo_gallery2location.'" maxlength="100" /></td>
</tr>
<tr>';

if($onlineinfo_gallery2window=='e107') {
$text .='<td class="forumheader3">' .EUSER_LOGIN_MENU_A114.EUSER_LOGIN_MENU_A147. ':<br /><span class="smalltext">' .ONLINEINFO_IPB_A6.EUSER_LOGIN_MENU_A115. '</td>
<td class="forumheader3"><input type="radio"  name="onlineinfo_gallery2window" value="e107" checked />&nbsp;' .EUSER_LOGIN_MENU_A115. '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"  name="onlineinfo_gallery2window" value="window" />&nbsp;' .EUSER_LOGIN_MENU_A116. '</td>';

}else{
	
$text .='<td class="forumheader3">'.EUSER_LOGIN_MENU_A114.EUSER_LOGIN_MENU_A147.':<br /><span class="smalltext">' .ONLINEINFO_IPB_A6.EUSER_LOGIN_MENU_A115. '</td>
<td class="forumheader3"><input type="radio"  name="onlineinfo_gallery2window" value="e107" />&nbsp;' .EUSER_LOGIN_MENU_A115. '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"  name="onlineinfo_gallery2window" value="window" checked />&nbsp;' .EUSER_LOGIN_MENU_A116. '</td>';
}

$text .='</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A148. '</td>
<td class="forumheader3"><input class="tbox" type="text" name="onlineinfo_gallery2shownum" size="4" value="'.$onlineinfo_gallery2shownum .'" maxlength="4" /></td>
</tr>

<tr>
<td colspan="4" class="forumheader" style="text-align:center"><input class="button" type="submit" name="update_menu" value="' .EUSER_LOGIN_MENU_A56. '" /></td>
</tr>
</table>
</form>';

$text .= '</div>';
$ns -> tablerender(EUSER_LOGIN_MENU_A2.' - '.EUSER_LOGIN_MENU_A147, $text);

require_once(e_ADMIN.'footer.php');

?>