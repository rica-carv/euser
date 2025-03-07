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


$euser_pref['border']=$_POST['onlineinfo_border'];
$euser_pref['color']=$_POST['onlineinfo_color'];
$euser_pref['avatar']=$_POST['onlineinfo_avatar'];
$euser_pref['showicons']=$_POST['onlineinfo_showicons'];
$euser_pref['showadmin']=$_POST['onlineinfo_showadmin'];
$euser_pref['guest']=$_POST['onlineinfo_guest'];
$euser_pref['hideguest']=$_POST['onlineinfo_hideguest'];
$euser_pref['hideusers']=$_POST['onlineinfo_hideusers'];
$euser_pref['usernamefontsize']=$_POST['onlineinfo_usernamefontsize'];
$euser_pref['botchecker']=$_POST['onlineinfo_botchecker'];
$euser_pref['ipchecker']=$_POST['onlineinfo_ipchecker'];
$euser_pref['nolocations']=$_POST['onlineinfo_nolocations'];


save_prefs();

	$ns -> tablerender('', '<div style="text-align:center"><b>' .EUSER_LOGIN_MENU_A1.' ( '.EUSER_LOGIN_MENU_A72. ' )</b></div>');
}

$onlineinfo_border = $euser_pref['border'];
$onlineinfo_color = $euser_pref['color'];
$onlineinfo_avatar = $euser_pref['avatar'];
$onlineinfo_showicons = $euser_pref['showicons'];
$onlineinfo_showadmin = $euser_pref['showadmin'];
$onlineinfo_guest = $euser_pref['guest'];
$onlineinfo_hideguest = $euser_pref['hideguest'];
$onlineinfo_hideusers = $euser_pref['hideusers'];
$onlineinfo_usernamefontsize = $euser_pref['usernamefontsize'];
$onlineinfo_botchecker = $euser_pref['botchecker'];
$onlineinfo_ipchecker = $euser_pref['ipchecker'];
$onlineinfo_nolocations = $euser_pref['nolocations'];



$text = '<script language="JavaScript" src="'.e_PLUGIN.'euser/picker.js"></script>

<div style="text-align:center">
<form method="POST" action="'.e_SELF.'" name="menu_conf_form">
<table class="fborder">

<tr><td class="forumheader3" colspan="4">'.EUSER_LOGIN_MENU_A43.'</td></tr>

<tr><td class="forumheader3">' .EUSER_LOGIN_MENU_A38. '</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_nolocations',$onlineinfo_nolocations).'</td>
</tr>

<tr><td class="forumheader" colspan="4">'.EUSER_LOGIN_MENU_A102.'</td></tr>

<tr><td class="forumheader3">' .EUSER_LOGIN_MENU_A37. '</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_botchecker',$onlineinfo_botchecker).'</td>
</tr>

<tr><td class="forumheader3">' .EUSER_LOGIN_MENU_A35. '</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_ipchecker',$onlineinfo_ipchecker).'</td>
</tr>

<tr><td class="forumheader3">' .EUSER_LOGIN_MENU_A119. '</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_hideusers',$onlineinfo_hideusers).'</td>
</tr>

<tr><td class="forumheader3">' .EUSER_LOGIN_MENU_A120. '</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_hideguest',$onlineinfo_hideguest).'</td>
</tr>

<tr><td class="forumheader3">' .EUSER_LOGIN_MENU_A15. '</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_avatar',$onlineinfo_avatar).'</td>
</tr>
<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A16. '</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_guest',$onlineinfo_guest).'</td>
</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A17. '</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_showicons',$onlineinfo_showicons).'</td>
</tr>
<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A18. '</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_showadmin',$onlineinfo_showadmin).'</td>
</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A58. '</td>
<td class="forumheader3" colspan="3"><input class="tbox" type="text" name="onlineinfo_border" size="12" value="'.$onlineinfo_border.'" maxlength="12" /> <a href="javascript:TCP.popup(document.forms[\'menu_conf_form\'].elements[\'onlineinfo_border\'])"><img width="15" height="13" border="0" alt="'.EUSER_LOGIN_MENU_A159.'" src="'.e_PLUGIN.'euser/images/sel.gif"></a></td>
</tr>
<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A59. '</td>
<td class="forumheader3" colspan="3"><input class="tbox" type="text" name="onlineinfo_color" size="12" value="'.$onlineinfo_color.'" maxlength="12" /> <a href="javascript:TCP.popup(document.forms[\'menu_conf_form\'].elements[\'onlineinfo_color\'])"><img width="15" height="13" border="0" alt="'.EUSER_LOGIN_MENU_A159.'" src="'.e_PLUGIN.'euser/images/sel.gif"></a></td>
</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A144. '</td>
<td class="forumheader3" colspan="3"><input class="tbox" type="text" name="onlineinfo_usernamefontsize" size="2" value="'.$onlineinfo_usernamefontsize.'" maxlength="2" />&nbsp;'.EUSER_LOGIN_MENU_A143.'</td>
</tr>

<tr>
<td colspan="4" class="forumheader" style="text-align:center"><input class="button" type="submit" name="update_menu" value="' .EUSER_LOGIN_MENU_A56. '" /></td>
</tr>
</table>
</form>
</div>';

$ns -> tablerender(EUSER_LOGIN_MENU_A2.' - '.EUSER_LOGIN_MENU_A72, $text);

require_once(e_ADMIN.'footer.php');

?>