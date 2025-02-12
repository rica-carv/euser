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


	if($_POST['onlineinfo_pm']==e_UC_PUBLIC){$_POST['onlineinfo_pm']=e_UC_MEMBER;}

// UTILIZAÇÃO DE OUTRO SISTEMA DE PM'S, TEM DE SAIR DAQUI, TIPO PARA UM SHORTCODE...
//$euser_pref['ibfpm']=$_POST['onlineinfo_ibfpm'];
$euser_pref['ibfuse']=$_POST['onlineinfo_ibfuse'];
$euser_pref['ibfprefix']=$_POST['onlineinfo_ibfprefix'];
$euser_pref['ibflocation']=$_POST['onlineinfo_ibflocation'];
$euser_pref['ibftime']=$_POST['onlineinfo_ibftime'];
$euser_pref['ibfshownum']=$_POST['onlineinfo_ibfshownum'];
$euser_pref['ibfautohide']=$_POST['onlineinfo_ibfautohide'];

	save_prefs();

	$ns -> tablerender('', '<div style="text-align:center"><b>' .EUSER_LOGIN_MENU_A1.' ( '.ONLINEINFO_IPB_A1. ' )</b></div>');
}


// UTILIZAÇÃO DE OUTRO SISTEMA DE PM'S, TEM DE SAIR DAQUI, TIPO PARA UM SHORTCODE...
//$onlineinfo_ibfpm = $euser_pref['ibfpm'];
$onlineinfo_ibfuse = $euser_pref['ibfuse'];
$onlineinfo_ibfprefix = $euser_pref['ibfprefix'];
$onlineinfo_ibflocation = $euser_pref['ibflocation'];
$onlineinfo_ibftime = $euser_pref['ibftime'];
$onlineinfo_ibfshownum = $euser_pref['ibfshownum'];
$onlineinfo_ibfautohide = $euser_pref['ibfautohide'];

$text = '<div style="text-align:center">
<form method="POST" action="'.e_SELF.'" name="menu_conf_form">
<table class="fborder">';


// UTILIZAÇÃO DE OUTRO SISTEMA DE PM'S, TEM DE SAIR DAQUI, TIPO PARA UM SHORTCODE...
//$dropdown1=Create_yes_no_dropdown('onlineinfo_ibfpm',$onlineinfo_ibfpm);
$dropdown2=Create_yes_no_dropdown('onlineinfo_ibfuse',$onlineinfo_ibfuse);
$dropdown3=Create_yes_no_dropdown('onlineinfo_ibfautohide',$onlineinfo_ibfautohide);


$text .= '<tr>
<td class="forumheader3" colspan="2">'.ONLINEINFO_IPB_A12.'</td>

</tr>
<tr>
<td class="forumheader3">'.ONLINEINFO_IPB_A11. '</td>
<td class="forumheader3">'.$dropdown1.'</td>
</tr>
<tr>
<td class="forumheader3">'.ONLINEINFO_IPB_A3.'</td>
<td class="forumheader3">'.$dropdown2.'</td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_IPB_A13.'</td>
<td class="forumheader3">'.$dropdown3.'</td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_IPB_A4.'<br />('.ONLINEINFO_IPB_A5.')<br />('.ONLINEINFO_IPB_A6.'1 <i>'.ONLINEINFO_IPB_A7.'</i>)</td>
<td class="forumheader3"><input class="tbox" type="text" name="onlineinfo_ibftime" size="3" value="'.$onlineinfo_ibftime.'" maxlength="3" /></td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_IPB_A8.'<br />('.ONLINEINFO_IPB_A6.'ibf_)</td>
<td class="forumheader3"><input class="tbox" type="text" name="onlineinfo_ibfprefix" size="12" value="'.$onlineinfo_ibfprefix.'" maxlength="12" /></td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_IPB_A9.'<br />('.ONLINEINFO_IPB_A6.SITEURL.'forums)</td>
<td class="forumheader3">'.SITEURL.'<input class="tbox" type="text" name="onlineinfo_ibflocation" size="24" value="'.$onlineinfo_ibflocation.'" maxlength="100" /></td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_IPB_A10. '</td>
<td class="forumheader3"><input class="tbox" type="text" name="onlineinfo_ibfshownum" size="4" value="'.$onlineinfo_ibfshownum .'" maxlength="4" /></td>
</tr>

<tr>
<td colspan="4" class="forumheader" style="text-align:center"><input class="button" type="submit" name="update_menu" value="' .EUSER_LOGIN_MENU_A56. '" /></td>
</tr>
</table>
</form>';


$text .= '</div>';
$ns -> tablerender(EUSER_LOGIN_MENU_A2.' - '.ONLINEINFO_IPB_A1, $text);

require_once(e_ADMIN.'footer.php');

?>