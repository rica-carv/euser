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
$euser_pref['admincolour']=$_POST['onlineinfo_admincolour'];
$euser_pref['modcolour']=$_POST['onlineinfo_modcolour'];
$euser_pref['memcolour']=$_POST['onlineinfo_memcolour'];
$euser_pref['headadmincolour']=$_POST['onlineinfo_headadmincolour'];
$euser_pref['onoffcolour']=$_POST['onlineinfo_onoffcolour'];
$euser_pref['headadminactive']=$_POST['onlineinfo_headadminactive'];
$euser_pref['adminactive']=$_POST['onlineinfo_adminactive'];
$euser_pref['memactive']=$_POST['onlineinfo_memactive'];
$euser_pref['modactive']=$_POST['onlineinfo_modactive'];

save_prefs();

//$sql=new db;

//$script='TRUNCATE TABLE '.MPREFIX.'onlineinfo_userclasses';
//$sql->db_Select_gen($script);


for($a = 0; $a <= $_POST['onlineinfo_classcounter']; $a++){
	
	if ($a<>0){$buildclasssave.=',';}
			
	$buildclasssave.=$_POST['onlineinfo_classid'.$a].'|'.$_POST['onlineinfo_classcol'.$a].'|'.$_POST['onlineinfo_classact'.$a].'|'.$_POST['onlineinfo_classpri'.$a];
	
	//code for using a database table if Prefs is too slow
	
//	if($_POST['onlineinfo_classact'.$a]==1){
	
//	$script="INSERT INTO ".MPREFIX."onlineinfo_userclasses VALUES (".$_POST['onlineinfo_classid'.$a].",'".$_POST['onlineinfo_classcol'.$a]."',".$_POST['onlineinfo_classpri'.$a].")";
//	$sql->db_Select_gen($script);	
			
//	}
	
}


		 
	 
	$sql -> db_Update("euser_cache", "cache='".$buildclasssave."' WHERE type='classcolour'");	



	$ns -> tablerender('', '<div style="text-align:center"><b>' .EUSER_LOGIN_MENU_A1.' ( '.EUSER_LOGIN_MENU_A101. ' )</b></div>');


}

$onlineinfo_admincolour = $euser_pref['admincolour'];
$onlineinfo_modcolour = $euser_pref['modcolour'];
$onlineinfo_memcolour = $euser_pref['memcolour'];
$onlineinfo_headadmincolour = $euser_pref['headadmincolour'];
$onlineinfo_onoffcolour = $euser_pref['onoffcolour'];
$onlineinfo_headadminactive = $euser_pref['headadminactive'];
$onlineinfo_adminactive = $euser_pref['adminactive'];
$onlineinfo_memactive = $euser_pref['memactive'];
$onlineinfo_modactive = $euser_pref['modactive'];


		$sql=new db;
		$script="SELECT cache FROM ".MPREFIX."euser_cache Where type='classcolour'";
		$onlineinfo_classcolour = $sql->db_Select_gen($script);
		while ($row = $sql->db_Fetch())
		{
			
			$buildclasslist=$row['cache'];

		}


$splitclasslist = explode(',',$buildclasslist);

$text = '<script language="JavaScript" src="'.e_PLUGIN.'euser/picker.js"></script>

<div style="text-align:center">
<form method="POST" action="'.e_SELF.'" name="menu_conf_form">
<table class="fborder">
<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A104. '</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_onoffcolour',$onlineinfo_onoffcolour).'</td>
</tr>
<tr><td class="forumheader" colspan="4">'.EUSER_LOGIN_MENU_A101.'</td></tr>

<tr><td class="forumheader3" style="text-align:center; font-weight:bold;">'.EUSER_LOGIN_MENU_A30.'</td><td class="forumheader3" style="text-align:center; font-weight:bold;">'.EUSER_LOGIN_MENU_A189.'</td><td class="forumheader3"  colspan="2" style="text-align:center; font-weight:bold;">'.EUSER_LOGIN_MENU_A190.'</td></tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A179. '</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_headadmincolour" size="12" value="'.$onlineinfo_headadmincolour.'" maxlength="12" /> <a href="javascript:TCP.popup(document.forms[\'menu_conf_form\'].elements[\'onlineinfo_headadmincolour\'])"><img width="15" height="13" border="0" alt="'.EUSER_LOGIN_MENU_A159.'" src="'.e_PLUGIN.'euser/images/sel.gif"></a></td>
<td class="forumheader3" colspan="2" style="text-align:center;">'.Create_yes_no_dropdown("onlineinfo_headadminactive",$onlineinfo_headadminactive).'</td>
</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A40. '</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_admincolour" size="12" value="'.$onlineinfo_admincolour.'" maxlength="12" /> <a href="javascript:TCP.popup(document.forms[\'menu_conf_form\'].elements[\'onlineinfo_admincolour\'])"><img width="15" height="13" border="0" alt="'.EUSER_LOGIN_MENU_A159.'" src="'.e_PLUGIN.'euser/images/sel.gif"></a></td>
<td class="forumheader3" colspan="2" style="text-align:center;">'.Create_yes_no_dropdown("onlineinfo_adminactive",$onlineinfo_adminactive).'</td>
</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A41. '</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_modcolour" size="12" value="'.$onlineinfo_modcolour.'" maxlength="12" /> <a href="javascript:TCP.popup(document.forms[\'menu_conf_form\'].elements[\'onlineinfo_modcolour\'])"><img width="15" height="13" border="0" alt="'.EUSER_LOGIN_MENU_A159.'" src="'.e_PLUGIN.'euser/images/sel.gif"></a></td>
<td class="forumheader3" colspan="2" style="text-align:center;">'.Create_yes_no_dropdown("onlineinfo_modactive",$onlineinfo_modactive).'</td>
</tr>

<tr>
<td class="forumheader3">' .EUSER_LOGIN_MENU_A42. '</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_memcolour" size="12" value="'.$onlineinfo_memcolour.'" maxlength="12" /> <a href="javascript:TCP.popup(document.forms[\'menu_conf_form\'].elements[\'onlineinfo_memcolour\'])"><img width="15" height="13" border="0" alt="'.EUSER_LOGIN_MENU_A159.'" src="'.e_PLUGIN.'euser/images/sel.gif"></a></td>
<td class="forumheader3" colspan="2" style="text-align:center;">'.Create_yes_no_dropdown("onlineinfo_memactive",$onlineinfo_memactive).'</td>
</tr>

<tr><td class="forumheader" colspan="4">'.EUSER_LOGIN_MENU_A187.'</td></tr>
<tr><td class="forumheader3" colspan="4">'.EUSER_LOGIN_MENU_A192.'</td></tr>
<tr><td class="forumheader3" style="text-align:center; font-weight:bold;">'.EUSER_LOGIN_MENU_A188.'</td><td class="forumheader3" style="text-align:center; font-weight:bold;">'.EUSER_LOGIN_MENU_A189.'</td><td class="forumheader3" style="text-align:center; font-weight:bold;">'.EUSER_LOGIN_MENU_A190.'</td><td class="forumheader3" style="text-align:center; font-weight:bold;">'.EUSER_LOGIN_MENU_A191.'</td></tr>
';

$classcol=0;


$script="SELECT * FROM ".MPREFIX."userclass_classes ORDER BY userclass_id";		
		$sql->db_Select_gen($script);	
		while ($row = $sql->db_Fetch())
        {
        	extract($row);
        	
        	$checkhowmanyinsaved = count($splitclasslist);
        	
        	$foundit=-1;
        	
        	for($a = 0; $a <= $checkhowmanyinsaved; $a++){
				
			$getclasssaveddetails = explode('|',$splitclasslist[$a]);
				
			if($userclass_id==$getclasssaveddetails[0]){
				
				$foundit=$a;
			}
				
			}
        	        	
        	if($foundit<>-1){
			     	$getclasssaveddetails = explode('|',$splitclasslist[$foundit]);    
        	
   $text.='<tr>
   			<td class="forumheader3">'.$userclass_name.' ('.$userclass_description.')</td>     	
        	<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_classcol'.$classcol.'" size="12" value="'.$getclasssaveddetails[1].'" maxlength="12" />
			<input type="hidden" name="onlineinfo_classid'.$classcol.'" value="'.$userclass_id.'" />
			 <a href="javascript:TCP.popup(document.forms[\'menu_conf_form\'].elements[\'onlineinfo_classcol'.$classcol.'\'])"><img width="15" height="13" border="0" alt="'.EUSER_LOGIN_MENU_A159.'" src="'.e_PLUGIN.'euser/images/sel.gif"></a></td>
			 <td class="forumheader3" style="text-align:center;">'.Create_yes_no_dropdown("onlineinfo_classact".$classcol,$getclasssaveddetails[2]).'</td>
			 <td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_classpri'.$classcol.'" size="3" value="'.$getclasssaveddetails[3].'" maxlength="3" /></td>
        	</tr>';        
    	
        }else{
        
		 $text.='<tr>
   			<td class="forumheader3">'.$userclass_name.' ('.$userclass_description.')</td>     	
        	<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_classcol'.$classcol.'" size="12" value="#000000" maxlength="12" />
			<input type="hidden" name="onlineinfo_classid'.$classcol.'" value="'.$userclass_id.'" />
			 <a href="javascript:TCP.popup(document.forms[\'menu_conf_form\'].elements[\'onlineinfo_classcol'.$classcol.'\'])"><img width="15" height="13" border="0" alt="'.EUSER_LOGIN_MENU_A159.'" src="'.e_PLUGIN.'euser/images/sel.gif"></a></td>
			 <td class="forumheader3" style="text-align:center;">'.Create_yes_no_dropdown("onlineinfo_classact".$classcol,"0").'</td>
			 <td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_classpri'.$classcol.'" size="3" value="0" maxlength="3" /></td>
        	</tr>';	
        	
			
		}	
        
		
		
			$classcol++;        	        	
        	
        }
        
        $classcol=$classcol-1;
        
$text.='<input type="hidden" name="onlineinfo_classcounter" value="'.$classcol.'" />

<tr>
<td colspan="4" class="forumheader" style="text-align:center"><input class="button" type="submit" name="update_menu" value="' .EUSER_LOGIN_MENU_A56. '" /></td>
</tr>
</table>
</form>
</div>';

$ns -> tablerender(EUSER_LOGIN_MENU_A2.' - '.EUSER_LOGIN_MENU_A101, $text);

require_once(e_ADMIN.'footer.php');

?>