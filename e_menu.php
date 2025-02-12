<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2016 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 *
*/

if (!defined('e107_INIT')) { exit; }

e107::coreLan('language', true);
e107::lan('euser','admin',true);
e107::lan('euser','front',true);

require_once('admin_class.php');

//v2.x Standard for extending menu configuration within Menu Manager. (replacement for v1.x config.php)
//TODO Configure for news menus. 

class euser_menu
{

	public $tabs = array();

	function __construct()
	{
		// e107::lan('news','admin', 'true');
//		e107::lan('euser',true);

	}

	/**
	 * Configuration Fields.
	 * @return array
	 */
	public function config($menu='') //TODO LAN
	{
//    var_dump ($menu);

		$fields = array();
		$categories = array();

		$sources = array('latest'=> "Latest News Items", 'sticky' => "Sticky News Items", 'template'=>"Assigned News items");

		$tmp =  e107::getDb()->retrieve('news_category','category_id,category_name',null, true);

		foreach($tmp as $val)
		{
			$id = $val['category_id'];
			$categories[$id] = $val['category_name'];
		}


    if ($menu == "euser_dashboard"){
    $this->tabs = array(0 => LAN_PREFS, 1 => LAN_EUSER_ADMIN_SHAREDTAB);
      $fields = array(
/*   ANTIGOS PREFS
$onlineinfo_caption = $pref['onlineinfo_caption'];                    »TEMPLATE ?? dash_caption
$onlineinfo_width = $pref['onlineinfo_width'];                               »CSS
$onlineinfo_showpmmsg = $pref['onlineinfo_showpmmsg'];                       »PM
$onlineinfo_rememberbuttons = $pref['onlineinfo_rememberbuttons'];           remembersections
$onlineinfo_fontsize = $pref['onlineinfo_fontsize'];                         »CSS
$onlineinfo_sound =  $pref['onlineinfo_sound'];                              »PM
$onlineinfo_deleteme =  $pref['onlineinfo_deleteme'];                        deleteme
$onlineinfo_logindiag =  $pref['onlineinfo_logindiag'];                      logindiag
$onlineinfo_turnoffavatar = $pref['onlineinfo_turnoffavatar'];               avatar


$ns -> tablerender(ONLINEINFO_LOGIN_MENU_A2.' - '.ONLINEINFO_LOGIN_MENU_A71, $text);

*/
					'remembersections'  => array('title'=> LAN_EUSER_ADMIN_001, 'type'=>'boolean','tab'=>0,  'help'=>LAN_EUSER_ADMIN_001H),
					'logindiag'  => array('title'=> LAN_EUSER_ADMIN_003, 'type'=>'boolean','tab'=>0,  'help'=>LAN_EUSER_ADMIN_003H),
					'avatar'  => array('title'=> LAN_EUSER_ADMIN_004, 'type'=>'boolean','tab'=>0,  'help'=>LAN_EUSER_ADMIN_003H),

// Prefs que não estavam no config do OIM, mas já não estão no menu agora... Passaram para aqui. TODO: verificar lan's
//					'dash_caption'  => array('title'=> "Menu caption (leave empty for default)", 'type'=>'text'),
//          'adminstyle'  => array('title'=> "Admin style", 'type'=>'boolean'),
//					'maintenance_flag'  => array('title'=> "Maintenance flag", 'type'=>'boolean')

// Prefs colorkey, passaram para o admin_config.php
/*
					$fields['onoffcolour']  = array('title'=> "Colour members", 'type'=>'boolean');
					$fields['headadminactive']  = array('title'=> "Head admin active", 'type'=>'boolean');
					$fields['adminactive']  = array('title'=> "Admin active", 'type'=>'boolean');
					$fields['memactive']  = array('title'=> "Member active", 'type'=>'boolean');
					$fields['modactive']  = array('title'=> "Moderator active", 'type'=>'boolean');
*/
//					'_button'  => array('type'=>'text', 'class'=>'e-hideme'),

         );
// Ver a forma de fazer isto conforme o core
//          if(e107::isInstalled('deleteme')) {
//					$fields['deleteme']  = array('title'=> LAN_EUSER_ADMIN_002, 'type'=>'boolean', 'help'=>LAN_EUSER_ADMIN_002H);
//          }
//          if(e107::isInstalled('deleteme')) {
					$fields['deleteme']  = array('title'=> LAN_EUSER_ADMIN_002, 'type'=>'boolean','tab'=>0,  'help'=>(e107::isInstalled('deleteme'?LAN_EUSER_ADMIN_002H:'')));
//VAR_DUMP (!e107::isInstalled('deleteme'));
/*
			if(e107::isInstalled('deleteme') == false)
			{
				$fields['deleteme']['writeParms']['post'] = " <span class='label label-important label-danger'>".LANG_LAN_05."</span>";
			}
*/
// Standard core admin ui alert				$fields['deleteme']['writeParms']['post'] = "</div>&nbsp;".euser_admin::label_installed("deleteme");
e107::coreLan('plugin', true);
//"<span class='label label-important label-".$labeltype."'>".$labeltext."</span>"
//$fields['deleteme']['writeParms']['post'] = "</div>&nbsp;".(e107::isInstalled('deleteme')?"":"<a class='btn btn-danger btn-xs' role='button' href='plugin.php'>".EPL_ADLAN_70."&nbsp;".LAN_EUSER_ADMIN_CLICKHERESTART.LAN_EUSER_ADMIN_GOTO.ADLAN_98."</a>");
//$fields['deleteme']['writeParms']['post'] = "</div>&nbsp;".(e107::isInstalled('deleteme')?"":euser_admin::linkbutton("../../e107_admin/plugin.php", EPL_ADLAN_70."&nbsp;".LAN_EUSER_ADMIN_CLICKHERESTART.LAN_EUSER_ADMIN_GOTO.ADLAN_98, "danger", "btn-xs"));
$fields['deleteme']['writeParms']['post'] = "</div>&nbsp;".euser_admin::label_installed('deleteme', true);

///////////////////				$fields['deleteme']['writeParms']['class'] = (e107::isInstalled('deleteme')?:"disabled");
///////---- Com as minhas alterações
///////----				$fields['deleteme']['writeParms']['disabled'] = !e107::isInstalled('deleteme');
///////----       $fields['deleteme']['writeParms']['label'] = 'zero&um';
//				$fields['deleteme']['writeParms']['class'] = (e107::isInstalled('deleteme')?"":"hidden");
				$fields['deleteme']['writeParms']['pre'] = "<div class='".(e107::isInstalled('deleteme')?"":"hidden")."'>";
        
//				$fields['deleteme']['disabled'] = '11';
//				$fields['deleteme']['readParms']['disabled'] = '111';
//			}
//          }
//					$fields[]  = array('title'=> '<a href="../e107_plugins/euser/admin_config.php?mode=color&action=pref" class="btn btn-info btn-block" role="button">'.LAN_EUSER_ADMIN_CLICKSTART.LAN_EUSER_ADMIN_CONFIG." ".LAN_EUSER_001007.'</a>');
//'tab'=>0, 
//					$fields['alert']['tab'] = 1;
//					$fields['alert']['type'] = 'text';
//					$fields['alert']['title'] = LAN_EUSER_ADMIN_002;
//          $fields['_alert'] = euser_admin::render_dismalert ('info', LAN_EUSER_ADMIN_SHAREDCONFIG."<br>".LAN_EUSER_ADMIN_SHAREDCONFIGMENUS, 1);
          $fields['_alert'] = euser_admin::render_fulltableline ('info', LAN_EUSER_ADMIN_SHAREDCONFIG."<br>".LAN_EUSER_ADMIN_SHAREDCONFIGMENUS, 'dismalert',1);
//					$fields['button']['tab'] = 1;
//					$fields['_button'] = euser_admin::render_linkbutton ('admin_config.php?mode=color&action=pref', LAN_EUSER_ADMIN_CLICKHERESTART.LAN_EUSER_ADMIN_CONFIG." ".LAN_EUSER_001007, 1, 'default', ' ');
					$fields['_button'] = euser_admin::render_fulltableline ('admin_config.php?mode=color&action=pref', LAN_EUSER_ADMIN_CLICKHERESTART.LAN_EUSER_ADMIN_CONFIG." ".LAN_EUSER_001007, 'linkbutton',1, 'default', ' ');


//e107::getTemplate('euser', 'dashboard_menu', null, 'front');
var_dump (e107::getTemplate('euser', 'dashboard_menu', null, 'front'));
//var_dump (e107::getThemeInfo('front'));
//var_dump (e107::getTemplate('euser', 'dashboard_menu', null, false));
//var_dump (e107::getTemplate('euser', 'dashboard_menu'));
//var_dump($pref['sitetheme']);
//var_dump ($this->getEmbedMenus(e107::getTemplate('euser', 'dashboard_menu')));




//					$fields['_button']['writeParms']['post']  = '<a href="../e107_plugins/euser/admin_config.php?mode=color&action=pref" class="btn btn-info btn-block" role="button">'.LAN_EUSER_ADMIN_CLICKHERESTART.LAN_EUSER_ADMIN_CONFIG." ".LAN_EUSER_001007.'</a>';
//					$fields['table_post']  = '<a href="../e107_plugins/euser/admin_config.php?mode=color&action=pref" class="btn btn-info btn-block" role="button">'.LAN_EUSER_ADMIN_CLICKSTART.LAN_EUSER_ADMIN_CONFIG." ".LAN_EUSER_001007.'</a>';
//			e107::getMessage()->addInfo(LAN_EUSER_ADMIN_SHAREDCONFIG);
    }
    if ($menu == "euser_whatsnew"){
    $this->tabs = array(0 => LAN_EUSER_ADMIN_SHAREDTAB);
// NÃO FUNCIONA....
//     	$mes = e107::getMessage();
//	    $message = "TESTE TESTE TESTE TESTE";
//			$mes->addInfo($message);
          
// Prefs que não estavam no config do OIM, mas estão no menu agora... Passaram para aqui. TODO: verificar lan's
// passaram para o admin_config.php
//					$fields['whatsnewpage']  = array('title'=> "Use plugin what's new page, instead of core", 'type'=>'boolean');
//					$fields['_alert'] = euser_admin::render_dismalert ('info', LAN_EUSER_ADMIN_SHAREDCONFIG."<br>".LAN_EUSER_ADMIN_SHAREDCONFIGMENUS);
					$fields['_alert'] = euser_admin::render_fulltableline ('info', LAN_EUSER_ADMIN_SHAREDCONFIG."<br>".LAN_EUSER_ADMIN_SHAREDCONFIGMENUS, 'dismalert');
//					$fields['_button'] = euser_admin::render_linkbutton ('admin_config.php?mode=whatsnew&action=pref', LAN_EUSER_ADMIN_CLICKHERESTART.LAN_EUSER_ADMIN_CONFIG." ".LAN_EUSER_ADMIN_005, 0, 'default', ' ');
					$fields['_button'] = euser_admin::render_fulltableline ('admin_config.php?mode=whatsnew&action=pref', LAN_EUSER_ADMIN_CLICKHERESTART.LAN_EUSER_ADMIN_CONFIG." ".LAN_EUSER_ADMIN_005, 'linkbutton', 0, 'default', ' ');
//--					$fields['_button']['type'] = 'text';
//--					$fields['_button']['class'] = 'e-hideme';
//--					$fields['_button']['writeParms']['post']  = '<a href="../e107_plugins/euser/admin_config.php?mode=whatsnew&action=pref" class="btn btn-info btn-block" role="button">'.LAN_EUSER_ADMIN_CLICKHERESTART.LAN_EUSER_ADMIN_CONFIG." ".LAN_EUSER_ADMIN_005.'</a>';
//					$fields['table_post']  = '<a href="../e107_plugins/euser/admin_config.php?mode=whatsnew&action=pref" class="btn btn-info btn-block" role="button">'.LAN_EUSER_ADMIN_CLICKSTART.LAN_EUSER_ADMIN_CONFIG." ".LAN_EUSER_ADMIN_005.'</a>';
    }
    if ($menu == "euser_online"){
    $this->tabs = array(0 => LAN_PREFS, 1 => LAN_EUSER_ADMIN_SHAREDTAB);
				$fields = array(	'online_caption'  => array('title'=> "Menu caption (leave empty for default)", 'type'=>'text', 'tab'=>0));
// Tem de ser assim por causa do .
//					$fields['_alert'] = euser_admin::render_dismalert ('info', LAN_EUSER_ADMIN_SHAREDCONFIG."<br>".LAN_EUSER_ADMIN_SHAREDCONFIGMENUS, 1);
					$fields['_alert'] = euser_admin::render_fulltableline ('info', LAN_EUSER_ADMIN_SHAREDCONFIG."<br>".LAN_EUSER_ADMIN_SHAREDCONFIGMENUS, 'dismalert',1);
//					$fields['_button'] = euser_admin::render_linkbutton ('admin_config.php?mode=online&action=pref', LAN_EUSER_ADMIN_CLICKHERESTART.LAN_EUSER_ADMIN_CONFIG." ".LAN_EUSER_104, 1, 'default', ' ');
					$fields['_button'] = euser_admin::render_fulltableline ('admin_config.php?mode=online&action=pref', LAN_EUSER_ADMIN_CLICKHERESTART.LAN_EUSER_ADMIN_CONFIG." ".LAN_EUSER_104, 'linkbutton', 1, 'default', ' ');

//--					$fields['_button']['type'] = 'text';
//--					$fields['_button']['class'] = 'e-hideme';
//-- 					$fields['_button']['writeParms']['post']  = '<a href="../e107_plugins/euser/admin_config.php?mode=online&action=pref" class="btn btn-info btn-block" role="button">'.LAN_EUSER_ADMIN_CLICKHERESTART.LAN_EUSER_ADMIN_CONFIG." ".LAN_EUSER_104.'</a>';
          					//$fields['table_post']  = '<a href="../e107_plugins/euser/admin_config.php?mode=online&action=pref" class="btn btn-info btn-block" role="button">'.LAN_EUSER_ADMIN_CLICKSTART.LAN_EUSER_ADMIN_CONFIG." ".LAN_EUSER_104.'</a>';

    }



/*
######################## ADMIN CONFIGS DO OIM ANTIGO

########################### ADMIN_CONFIG_ORDER

if(IsSet($_POST['update_menu'])){



				$sql=new db;
	$checkcacheno = $sql -> db_Count("onlineinfo_cache", "(*)", "WHERE type ='order'");

		for ($b = 1; $b <= $checkcacheno; $b++)
	{


	$sql -> db_Update("onlineinfo_cache", "cache_hide='".$_POST['onlineinfo_hide'.$b]."', cache_userclass='".$_POST['onlineinfo_show'.$b]."', type_order='".$_POST['onlineinfo_order'.$b]."' WHERE type='order' AND cache_name='".$_POST['onlineinfo_cachename'.$b]."'");
	}

			$ns -> tablerender('', '<div style="text-align:center"><b>' .ONLINEINFO_LOGIN_MENU_A1.' ( '.ONLINEINFO_LOGIN_MENU_A74. ' )</b></div>');

}


$text = '<div style="text-align:center">
<form method="POST" action="'.e_SELF.'" name="menu_conf_form">
<table class="fborder">';

$text .= '<tr>
			<td class="forumheader3" style="text-decoration: underline; text-align: center;">'.ONLINEINFO_LOGIN_MENU_A74.'</td>
			<td class="forumheader3" style="text-decoration: underline; text-align: center;">'.ONLINEINFO_LOGIN_MENU_A36.'</td>
			<td class="forumheader3" style="text-decoration: underline; text-align: center;">'.ONLINEINFO_LOGIN_MENU_A30.'</td>
			<td class="forumheader3" style="text-decoration: underline; text-align: center;">'.ONLINEINFO_LOGIN_MENU_A21.'</td>
		</tr>';


		$b=1;
		$cname='';
		$onlineinfo_order_sql=new db;
		$script="SELECT * FROM ".MPREFIX."onlineinfo_cache Where type='order' ORDER BY type_order";
		$onlineinfo_order = $onlineinfo_order_sql->db_Select_gen($script);
		while ($row = $onlineinfo_order_sql->db_Fetch())
		{

			if($row['cache_name']=='ONLINEINFO_CACHEINFO_10'){$cname=ONLINEINFO_CACHEINFO_10;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_11'){$cname=ONLINEINFO_CACHEINFO_11;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_12'){$cname=ONLINEINFO_CACHEINFO_12;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_13'){$cname=ONLINEINFO_CACHEINFO_13;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_14'){$cname=ONLINEINFO_CACHEINFO_14;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_15'){$cname=ONLINEINFO_CACHEINFO_15;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_16'){$cname=ONLINEINFO_CACHEINFO_16;}


$text.='<tr>
		<td class="forumheader3" style="text-align: center;">'.Create_order_dropdown('onlineinfo_order'.$b,$row['type_order']).'
		<input type="hidden" name="onlineinfo_cachename'.$b.'" size="3" value="'.$row['cache_name'].'" />
		</td>
		<td class="forumheader3" style="text-align: right;">'.$cname.': </td>';


	if($row['cache_name']=='ONLINEINFO_CACHEINFO_11' && $pref['onlineinfo_flashchatuse']==0){
		$text.='<td class="forumheader3" style="text-align: center;">'.r_userclass('onlineinfo_show'.$i,'255',$mode = 'off',$optlist = 'nobody').'</td>';
	}elseif($row['cache_name']=='ONLINEINFO_CACHEINFO_12' && $ispminstalled==0){
		$text.='<td class="forumheader3" style="text-align: center;">'.r_userclass('onlineinfo_show'.$i,'255',$mode = 'off',$optlist = 'nobody').'</td>';
	}elseif($row['cache_name']=='ONLINEINFO_CACHEINFO_14' && $pref['track_online']==0){
  		$text.='<td class="forumheader3" style="text-align: center;">'.r_userclass('onlineinfo_show'.$i,'255',$mode = 'off',$optlist = 'nobody').'</td>';
	}else{
		$text.='<td class="forumheader3" style="text-align: center;">'.r_userclass('onlineinfo_show'.$b,$row['cache_userclass']).'</td>';
	}

		$text.='<td class="forumheader3" style="text-align: center;">'.Create_yes_no_dropdown('onlineinfo_hide'.$b,$row['cache_hide']).'</td>';


$text.='</tr>';

$b++;
}



$text .= '<tr>
<td class="forumheader" colspan="4" style="text-align:center"><input class="button" type="submit" name="update_menu" value="' .ONLINEINFO_LOGIN_MENU_A56. '" /></td>
</tr>
</table>
</form>
</div>';

$ns -> tablerender(ONLINEINFO_LOGIN_MENU_A2.' - '.ONLINEINFO_LOGIN_MENU_A36, $text);

require_once(e_ADMIN.'footer.php');



################# ADMIN_CONFIG_SMF
require_once('../../class2.php');
if(!getperms('P')){ header("location:".e_BASE."index.php"); exit ;}
require_once(e_ADMIN.'auth.php');
require_once(e_HANDLER.'userclass_class.php');

$lan_file = e_PLUGIN.'onlineinfo_menu/languages/admin_'.e_LANGUAGE.'.php';
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.'onlineinfo_menu/languages/admin_English.php');

include_once(e_PLUGIN.'onlineinfo_menu/functions.php');


if(IsSet($_POST['update_menu'])){
$pref['onlineinfo_smfuse']=$_POST['onlineinfo_smfuse'];
$pref['onlineinfo_smfprefix']=$_POST['onlineinfo_smfprefix'];
$pref['onlineinfo_smflocation']=$_POST['onlineinfo_smflocation'];
$pref['onlineinfo_smfwindow']=$_POST['onlineinfo_smfwindow'];
$pref['onlineinfo_smfshownum']=$_POST['onlineinfo_smfshownum'];
	
	save_prefs();


	$ns -> tablerender('', '<div style="text-align:center"><b>' .ONLINEINFO_LOGIN_MENU_A1.' ( '.ONLINEINFO_SMF_1. ' )</b></div>');
}



$onlineinfo_smfuse = $pref['onlineinfo_smfuse'];
$onlineinfo_smfprefix = $pref['onlineinfo_smfprefix'];
$onlineinfo_smflocation = $pref['onlineinfo_smflocation'];
$onlineinfo_smfwindow = $pref['onlineinfo_smfwindow'];
$onlineinfo_smfshownum = $pref['onlineinfo_smfshownum'];

$text = '<div style="text-align:center">
<form method="POST" action="'.e_SELF.'" name="menu_conf_form">
<table class="fborder">';


$text .= '<tr>
<td class="forumheader3" colspan="2">'.ONLINEINFO_LOGIN_MENU_A172.'</td>

</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A113.ONLINEINFO_SMF_1.'</td>
<td class="forumheader3">'.Create_yes_no_dropdown('onlineinfo_smfuse',$onlineinfo_smfuse).'</td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_SMF_1.ONLINEINFO_LOGIN_MENU_A111.'<br />('.ONLINEINFO_IPB_A6.'smf_)</td>
<td class="forumheader3"><input class="tbox" type="text" name="onlineinfo_smfprefix" size="12" value="'.$onlineinfo_smfprefix.'" maxlength="12" /></td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_SMF_1.ONLINEINFO_LOGIN_MENU_A112.'<br />('.ONLINEINFO_IPB_A6.SITEURL.'smf)</td>
<td class="forumheader3">'.SITEURL.'<input class="tbox" type="text" name="onlineinfo_smflocation" size="24" value="'.$onlineinfo_smflocation.'" maxlength="100" /></td>
</tr>
<tr>';

if($onlineinfo_smfwindow=='e107') {
$text .='<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A114.ONLINEINFO_SMF_1. ':<br /><span class="smalltext">' .ONLINEINFO_IPB_A6.ONLINEINFO_LOGIN_MENU_A115. '</td>
<td class="forumheader3"><input type="radio"  name="onlineinfo_smfwindow" value="e107" checked />&nbsp;' .ONLINEINFO_LOGIN_MENU_A115. '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"  name="onlineinfo_smfwindow" value="window" />&nbsp;' .ONLINEINFO_LOGIN_MENU_A116. '</td>';

}else{
	
$text .='<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A114.ONLINEINFO_SMF_1.':<br /><span class="smalltext">' .ONLINEINFO_IPB_A6.ONLINEINFO_LOGIN_MENU_A115. '</td>
<td class="forumheader3"><input type="radio"  name="onlineinfo_smfwindow" value="e107" />&nbsp;' .ONLINEINFO_LOGIN_MENU_A115. '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"  name="onlineinfo_smfwindow" value="window" checked />&nbsp;' .ONLINEINFO_LOGIN_MENU_A116. '</td>';
}

$text .='</tr>
<tr>
<td class="forumheader3">' .ONLINEINFO_SMF_2. '</td>
<td class="forumheader3"><input class="tbox" type="text" name="onlineinfo_smfshownum" size="4" value="'.$onlineinfo_smfshownum.'" maxlength="4" /></td>
</tr>

<tr>
<td colspan="4" class="forumheader" style="text-align:center"><input class="button" type="submit" name="update_menu" value="' .ONLINEINFO_LOGIN_MENU_A56. '" /></td>
</tr>
</table>
</form>';

$text .= '</div>';
$ns -> tablerender(ONLINEINFO_LOGIN_MENU_A2.' - '.ONLINEINFO_SMF_1, $text);

require_once(e_ADMIN.'footer.php');




 ########################## ADMIN_CONFIG_USERCOLS
require_once('../../class2.php');
if(!getperms('P')){ header("location:".e_BASE."index.php"); exit ;}
require_once(e_ADMIN.'auth.php');
require_once(e_HANDLER.'userclass_class.php');

$lan_file = e_PLUGIN.'onlineinfo_menu/languages/admin_'.e_LANGUAGE.'.php';
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.'onlineinfo_menu/languages/admin_English.php');

include_once(e_PLUGIN.'onlineinfo_menu/functions.php');


if(IsSet($_POST['update_menu'])){
$pref['onlineinfo_admincolour']=$_POST['onlineinfo_admincolour'];
$pref['onlineinfo_modcolour']=$_POST['onlineinfo_modcolour'];
$pref['onlineinfo_memcolour']=$_POST['onlineinfo_memcolour'];
$pref['onlineinfo_headadmincolour']=$_POST['onlineinfo_headadmincolour'];
$pref['onlineinfo_onoffcolour']=$_POST['onlineinfo_onoffcolour'];
$pref['onlineinfo_headadminactive']=$_POST['onlineinfo_headadminactive'];
$pref['onlineinfo_adminactive']=$_POST['onlineinfo_adminactive'];
$pref['onlineinfo_memactive']=$_POST['onlineinfo_memactive'];
$pref['onlineinfo_modactive']=$_POST['onlineinfo_modactive'];

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


		 
	 
	$sql -> db_Update("onlineinfo_cache", "cache='".$buildclasssave."' WHERE type='classcolour'");	



	$ns -> tablerender('', '<div style="text-align:center"><b>' .ONLINEINFO_LOGIN_MENU_A1.' ( '.ONLINEINFO_LOGIN_MENU_A101. ' )</b></div>');


}

$onlineinfo_admincolour = $pref['onlineinfo_admincolour'];
$onlineinfo_modcolour = $pref['onlineinfo_modcolour'];
$onlineinfo_memcolour = $pref['onlineinfo_memcolour'];
$onlineinfo_headadmincolour = $pref['onlineinfo_headadmincolour'];
$onlineinfo_onoffcolour = $pref['onlineinfo_onoffcolour'];
$onlineinfo_headadminactive = $pref['onlineinfo_headadminactive'];
$onlineinfo_adminactive = $pref['onlineinfo_adminactive'];
$onlineinfo_memactive = $pref['onlineinfo_memactive'];
$onlineinfo_modactive = $pref['onlineinfo_modactive'];


		$sql=new db;
		$script="SELECT cache FROM ".MPREFIX."onlineinfo_cache Where type='classcolour'";
		$onlineinfo_classcolour = $sql->db_Select_gen($script);
		while ($row = $sql->db_Fetch())
		{
			
			$buildclasslist=$row['cache'];

		}


$splitclasslist = explode(',',$buildclasslist);

$text = '<script language="JavaScript" src="'.e_PLUGIN.'onlineinfo_menu/picker.js"></script>

<div style="text-align:center">
<form method="POST" action="'.e_SELF.'" name="menu_conf_form">
<table class="fborder">
<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A104. '</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_onoffcolour',$onlineinfo_onoffcolour).'</td>
</tr>
<tr><td class="forumheader" colspan="4">'.ONLINEINFO_LOGIN_MENU_A101.'</td></tr>

<tr><td class="forumheader3" style="text-align:center; font-weight:bold;">'.ONLINEINFO_LOGIN_MENU_A30.'</td><td class="forumheader3" style="text-align:center; font-weight:bold;">'.ONLINEINFO_LOGIN_MENU_A189.'</td><td class="forumheader3"  colspan="2" style="text-align:center; font-weight:bold;">'.ONLINEINFO_LOGIN_MENU_A190.'</td></tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A179. '</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_headadmincolour" size="12" value="'.$onlineinfo_headadmincolour.'" maxlength="12" /> <a href="javascript:TCP.popup(document.forms[\'menu_conf_form\'].elements[\'onlineinfo_headadmincolour\'])"><img width="15" height="13" border="0" alt="'.ONLINEINFO_LOGIN_MENU_A159.'" src="'.e_PLUGIN.'onlineinfo_menu/images/sel.gif"></a></td>
<td class="forumheader3" colspan="2" style="text-align:center;">'.Create_yes_no_dropdown("onlineinfo_headadminactive",$onlineinfo_headadminactive).'</td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A40. '</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_admincolour" size="12" value="'.$onlineinfo_admincolour.'" maxlength="12" /> <a href="javascript:TCP.popup(document.forms[\'menu_conf_form\'].elements[\'onlineinfo_admincolour\'])"><img width="15" height="13" border="0" alt="'.ONLINEINFO_LOGIN_MENU_A159.'" src="'.e_PLUGIN.'onlineinfo_menu/images/sel.gif"></a></td>
<td class="forumheader3" colspan="2" style="text-align:center;">'.Create_yes_no_dropdown("onlineinfo_adminactive",$onlineinfo_adminactive).'</td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A41. '</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_modcolour" size="12" value="'.$onlineinfo_modcolour.'" maxlength="12" /> <a href="javascript:TCP.popup(document.forms[\'menu_conf_form\'].elements[\'onlineinfo_modcolour\'])"><img width="15" height="13" border="0" alt="'.ONLINEINFO_LOGIN_MENU_A159.'" src="'.e_PLUGIN.'onlineinfo_menu/images/sel.gif"></a></td>
<td class="forumheader3" colspan="2" style="text-align:center;">'.Create_yes_no_dropdown("onlineinfo_modactive",$onlineinfo_modactive).'</td>
</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A42. '</td>
<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_memcolour" size="12" value="'.$onlineinfo_memcolour.'" maxlength="12" /> <a href="javascript:TCP.popup(document.forms[\'menu_conf_form\'].elements[\'onlineinfo_memcolour\'])"><img width="15" height="13" border="0" alt="'.ONLINEINFO_LOGIN_MENU_A159.'" src="'.e_PLUGIN.'onlineinfo_menu/images/sel.gif"></a></td>
<td class="forumheader3" colspan="2" style="text-align:center;">'.Create_yes_no_dropdown("onlineinfo_memactive",$onlineinfo_memactive).'</td>
</tr>

<tr><td class="forumheader" colspan="4">'.ONLINEINFO_LOGIN_MENU_A187.'</td></tr>
<tr><td class="forumheader3" colspan="4">'.ONLINEINFO_LOGIN_MENU_A192.'</td></tr>
<tr><td class="forumheader3" style="text-align:center; font-weight:bold;">'.ONLINEINFO_LOGIN_MENU_A188.'</td><td class="forumheader3" style="text-align:center; font-weight:bold;">'.ONLINEINFO_LOGIN_MENU_A189.'</td><td class="forumheader3" style="text-align:center; font-weight:bold;">'.ONLINEINFO_LOGIN_MENU_A190.'</td><td class="forumheader3" style="text-align:center; font-weight:bold;">'.ONLINEINFO_LOGIN_MENU_A191.'</td></tr>
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
			 <a href="javascript:TCP.popup(document.forms[\'menu_conf_form\'].elements[\'onlineinfo_classcol'.$classcol.'\'])"><img width="15" height="13" border="0" alt="'.ONLINEINFO_LOGIN_MENU_A159.'" src="'.e_PLUGIN.'onlineinfo_menu/images/sel.gif"></a></td>
			 <td class="forumheader3" style="text-align:center;">'.Create_yes_no_dropdown("onlineinfo_classact".$classcol,$getclasssaveddetails[2]).'</td>
			 <td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_classpri'.$classcol.'" size="3" value="'.$getclasssaveddetails[3].'" maxlength="3" /></td>
        	</tr>';        
    	
        }else{
        
		 $text.='<tr>
   			<td class="forumheader3">'.$userclass_name.' ('.$userclass_description.')</td>     	
        	<td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_classcol'.$classcol.'" size="12" value="#000000" maxlength="12" />
			<input type="hidden" name="onlineinfo_classid'.$classcol.'" value="'.$userclass_id.'" />
			 <a href="javascript:TCP.popup(document.forms[\'menu_conf_form\'].elements[\'onlineinfo_classcol'.$classcol.'\'])"><img width="15" height="13" border="0" alt="'.ONLINEINFO_LOGIN_MENU_A159.'" src="'.e_PLUGIN.'onlineinfo_menu/images/sel.gif"></a></td>
			 <td class="forumheader3" style="text-align:center;">'.Create_yes_no_dropdown("onlineinfo_classact".$classcol,"0").'</td>
			 <td class="forumheader3" style="text-align:center;"><input class="tbox" type="text" name="onlineinfo_classpri'.$classcol.'" size="3" value="0" maxlength="3" /></td>
        	</tr>';	
        	
			
		}	
        
		
		
			$classcol++;        	        	
        	
        }
        
        $classcol=$classcol-1;
        
$text.='<input type="hidden" name="onlineinfo_classcounter" value="'.$classcol.'" />

<tr>
<td colspan="4" class="forumheader" style="text-align:center"><input class="button" type="submit" name="update_menu" value="' .ONLINEINFO_LOGIN_MENU_A56. '" /></td>
</tr>
</table>
</form>
</div>';

$ns -> tablerender(ONLINEINFO_LOGIN_MENU_A2.' - '.ONLINEINFO_LOGIN_MENU_A101, $text);

require_once(e_ADMIN.'footer.php');


###################### ADMIN_CONFIG_COPPERMINE
require_once('../../class2.php');
if(!getperms('P')){ header("location:".e_BASE."index.php"); exit ;}
require_once(e_ADMIN.'auth.php');
require_once(e_HANDLER.'userclass_class.php');

$lan_file = e_PLUGIN.'onlineinfo_menu/languages/admin_'.e_LANGUAGE.'.php';
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.'onlineinfo_menu/languages/admin_English.php');

include_once(e_PLUGIN."onlineinfo_menu/functions.php");


if(IsSet($_POST['update_menu'])){

$pref['onlineinfo_sa_coppermineuse']=$_POST['onlineinfo_sa_coppermineuse'];
$pref['onlineinfo_sa_coppermineprefix']=$_POST['onlineinfo_sa_coppermineprefix'];
$pref['onlineinfo_sa_copperminelocation']=$_POST['onlineinfo_sa_copperminelocation'];
$pref['onlineinfo_sa_copperminewindow']=$_POST['onlineinfo_sa_copperminewindow'];
$pref['onlineinfo_sa_coppermineshownum']=$_POST['onlineinfo_sa_coppermineshownum'];


	save_prefs();


	$ns -> tablerender('', '<div style="text-align:center"><b>' .ONLINEINFO_LOGIN_MENU_A1.' ( '.ONLINEINFO_LOGIN_MENU_A184. ' )</b></div>');
}



$onlineinfo_sa_coppermineuse = $pref['onlineinfo_sa_coppermineuse'];
$onlineinfo_sa_coppermineprefix = $pref['onlineinfo_sa_coppermineprefix'];
$onlineinfo_sa_copperminelocation = $pref['onlineinfo_sa_copperminelocation'];
$onlineinfo_sa_copperminewindow = $pref['onlineinfo_sa_copperminewindow'];
$onlineinfo_sa_coppermineshownum = $pref['onlineinfo_sa_coppermineshownum'];

$text = '<div style="text-align:center">
<form method="POST" action="'.e_SELF.'" name="menu_conf_form">
<table class="fborder">
';


$text .= '<tr>
<td class="forumheader3" colspan="2">'.ONLINEINFO_LOGIN_MENU_A185.'</td>

</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A113.ONLINEINFO_LOGIN_MENU_A184.'</td>
<td class="forumheader3">'.Create_yes_no_dropdown('onlineinfo_sa_coppermineuse',$onlineinfo_sa_coppermineuse).'</td>
</tr>


<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A184.ONLINEINFO_LOGIN_MENU_A111.'<br />('.ONLINEINFO_IPB_A6.'cpg_)</td>
<td class="forumheader3"><input class="tbox" type="text" name="onlineinfo_sa_coppermineprefix" size="12" value="'.$onlineinfo_sa_coppermineprefix.'" maxlength="12" /></td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A184.ONLINEINFO_LOGIN_MENU_A112.'<br />('.ONLINEINFO_IPB_A6.SITEURL.'cpg)</td>
<td class="forumheader3">'.SITEURL.'<input class="tbox" type="text" name="onlineinfo_sa_copperminelocation" size="24" value="'.$onlineinfo_sa_copperminelocation.'" maxlength="100" /></td>
</tr>

<tr>';

if($onlineinfo_sa_copperminewindow=='e107') {
$text .='<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A114.ONLINEINFO_LOGIN_MENU_A184. ':<br /><span class="smalltext">' .ONLINEINFO_IPB_A6.ONLINEINFO_LOGIN_MENU_A115. '</td>
<td class="forumheader3"><input type="radio"  name="onlineinfo_sa_copperminewindow" value="e107" checked />&nbsp;' .ONLINEINFO_LOGIN_MENU_A115. '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"  name="onlineinfo_sa_copperminewindow" value="window"/>&nbsp;' .ONLINEINFO_LOGIN_MENU_A116. '</td>';
}else{
$text .='<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A114.ONLINEINFO_LOGIN_MENU_A184.':<br /><span class="smalltext">' .ONLINEINFO_IPB_A6.ONLINEINFO_LOGIN_MENU_A115. '</td>
<td class="forumheader3"><input type="radio"  name="onlineinfo_sa_copperminewindow" value="e107"/>&nbsp;' .ONLINEINFO_LOGIN_MENU_A115. '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"  name="onlineinfo_sa_copperminewindow" value="window" checked />&nbsp;' .ONLINEINFO_LOGIN_MENU_A116. '</td>';
}
$text .='</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A186. '</td>
<td class="forumheader3"><input class="tbox" type="text" name="onlineinfo_sa_coppermineshownum" size="4" value="'.$onlineinfo_sa_coppermineshownum .'" maxlength="4" /></td>
</tr>


<tr>
<td colspan="4" class="forumheader" style="text-align:center"><input class="button" type="submit" name="update_menu" value="' .ONLINEINFO_LOGIN_MENU_A56. '" /></td>
</tr>
</table>
</form>';

$text .= '</div>';
$ns -> tablerender(ONLINEINFO_LOGIN_MENU_A2.' - '.ONLINEINFO_LOGIN_MENU_A184, $text);

require_once(e_ADMIN.'footer.php');


################################# ADMIN_CONFIG_EXTRA
require_once('../../class2.php');
if(!getperms('P')){ header("location:".e_BASE."index.php"); exit ;}
require_once(e_ADMIN.'auth.php');
require_once(e_HANDLER.'userclass_class.php');

include_lan(e_PLUGIN.'log/languages/admin/'.e_LANGUAGE.'.php');


$lan_file = e_PLUGIN.'onlineinfo_menu/languages/admin_'.e_LANGUAGE.'.php';
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.'onlineinfo_menu/languages/admin_English.php');


include_once(e_PLUGIN.'onlineinfo_menu/functions.php');



$isforuminstalled = $sql -> db_Count("plugin", "(*)", "WHERE plugin_path ='forum' AND plugin_installflag ='1'");
$isloginstalled = $sql -> db_Count("plugin", "(*)", "WHERE plugin_path ='log' AND plugin_installflag ='1'");




if(IsSet($_POST['update_menu'])){
	$pref['onlineinfo_formatbdays']=$_POST['onlineinfo_formatbdays'];
	$pref['onlineinfo_bavatar']=$_POST['onlineinfo_bavatar'];
	save_prefs();


	$sql=new db;
	$checkcacheno = $sql -> db_Count("onlineinfo_cache", "(*)", "WHERE type ='extraorder'");
	
		for ($a = 1; $a <= $checkcacheno; $a++)
	{	
	 
	 
	$sql -> db_Update("onlineinfo_cache", "cache_hide='".$_POST['onlineinfo_hide'.$a]."', cache_records='".$_POST['onlineinfo_records'.$a]."', cache_userclass='".$_POST['onlineinfo_show'.$a]."', cache_timestamp='".$_POST['onlineinfo_cachetime'.$a]."', cache_active='".$_POST['onlineinfo_acache'.$a]."', type_order='".$_POST['onlineinfo_order'.$a]."' WHERE type='extraorder' AND cache_name='".$_POST['onlineinfo_cachename'.$a]."'");	
	}
	
	
	$ns -> tablerender('', '<div style="text-align:center"><b>' .ONLINEINFO_LOGIN_MENU_A1.' ( '.ONLINEINFO_LOGIN_MENU_A73. ' )</b></div>');
}

$onlineinfo_formatbdays = $pref['onlineinfo_formatbdays'];
$onlineinfo_bavatar = $pref['onlineinfo_bavatar'];

$text = '<div style="text-align:center">
<form method="POST" action="'.e_SELF.'" name="menu_conf_form">
<table class="fborder">';


$text.='<tr>
			<td class="forumheader3" style="text-decoration: underline; text-align: center;">'.ONLINEINFO_LOGIN_MENU_A75.'</td>
			<td class="forumheader3" style="text-decoration: underline; text-align: center;">'.ONLINEINFO_LOGIN_MENU_A31.'</td>
			<td class="forumheader3" style="text-decoration: underline; text-align: center;">'.ONLINEINFO_LOGIN_MENU_A30.'</td>
			<td class="forumheader3" style="text-decoration: underline; text-align: center;">'.ONLINEINFO_LOGIN_MENU_A21.'</td>
			<td class="forumheader3" style="text-decoration: underline; text-align: center;">'.ONLINEINFO_LOGIN_MENU_A33.'</td>			
			<td class="forumheader3" style="text-decoration: underline; text-align: center;">'.ONLINEINFO_LOGIN_MENU_A34.'</td>			
			<td class="forumheader3" style="text-decoration: underline; text-align: center;">'.ONLINEINFO_LOGIN_MENU_A32.'</td>
		</tr>';


		$i=1;
		$cname='';
		$onlineinfo_extra_sql=new db;
		$script="SELECT * FROM ".MPREFIX."onlineinfo_cache Where type='extraorder' ORDER BY type_order";
		$onlineinfo_extra = $onlineinfo_extra_sql->db_Select_gen($script);
		while ($row = $onlineinfo_extra_sql->db_Fetch())
		{

			if($row['cache_name']=='ONLINEINFO_CACHEINFO_1'){$cname=ONLINEINFO_CACHEINFO_1;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_2'){$cname=ONLINEINFO_CACHEINFO_2;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_3'){$cname=ONLINEINFO_CACHEINFO_3;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_4'){$cname=ONLINEINFO_CACHEINFO_4;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_5'){$cname=ONLINEINFO_CACHEINFO_5;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_6'){$cname=ONLINEINFO_CACHEINFO_6;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_7'){$cname=ONLINEINFO_CACHEINFO_7;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_8'){$cname=ONLINEINFO_CACHEINFO_8;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_9'){$cname=ONLINEINFO_CACHEINFO_9;}



$text.='<tr>
<td class="forumheader3" style="text-align: center;">'.Create_eorder_dropdown('onlineinfo_order'.$i,$row['type_order']).'
		<input type="hidden" name="onlineinfo_cachename'.$i.'" size="3" value="'.$row['cache_name'].'" />
		</td>
		<td class="forumheader3" style="text-align: right;">'.$cname.': </td>';
	
			
if ($row['cache_name']=='ONLINEINFO_CACHEINFO_5' || $row['cache_name']=='ONLINEINFO_CACHEINFO_6' || $row['cache_name']=='ONLINEINFO_CACHEINFO_7'){
	
	
	$text.='<td class="forumheader3" style="text-align: center;">';
	
	if ($isforuminstalled==1){
		$text.=r_userclass('onlineinfo_show'.$i,$row['cache_userclass']);		
	}else{
		$text.=r_userclass('onlineinfo_show'.$i,'255',$mode = 'off',$optlist = 'nobody');		
	}
	
	$text.='</td>';
		
	
	}elseif($row['cache_name']=='ONLINEINFO_CACHEINFO_9'){
	
		$text.='<td class="forumheader3" style="text-align: center;">';
	
		if ($isloginstalled==1){
			$text.=r_userclass("onlineinfo_show".$i,$row['cache_userclass']);		
		}else{
			$text.=r_userclass("onlineinfo_show".$i,"255",$mode = "off",$optlist = "nobody");	
		}	
		
		$text.='</td>';
		
		
	}elseif($row['cache_name']=="ONLINEINFO_CACHEINFO_8"){
	
		if ($pref['profile_rate']==1){
			$text.="<td class='forumheader3' style='text-align: center;'>".r_userclass("onlineinfo_show".$i,$row['cache_userclass'])."</td>";		
		}else{
			$text.="<td class='forumheader3' style='text-align: center;'>".r_userclass("onlineinfo_show".$i,"255",$mode = "off",$optlist = "nobody")."</td>";	
		}
	
	}elseif($row['cache_name']=='ONLINEINFO_CACHEINFO_2' || $row['cache_name']=='ONLINEINFO_CACHEINFO_3'){
	
		$text.='<td class="forumheader3" style="text-align: center;">';
	
		if ($pref['track_online']==1){
			$text.=r_userclass("onlineinfo_show".$i,$row['cache_userclass']);		
		}else{
			$text.=r_userclass("onlineinfo_show".$i,"255",$mode = "off",$optlist = "nobody");	
		}	
		
		$text.='</td>';
		
}else{
 	$text.='<td class="forumheader3" style="text-align: center;">'.r_userclass('onlineinfo_show'.$i,$row['cache_userclass']).'</td>';
	}	
		
				
	$text.='<td class="forumheader3" style="text-align: center;">'.Create_yes_no_dropdown('onlineinfo_hide'.$i,$row['cache_hide']).'</td>';	
	
	
	if($row['cache_name']=='ONLINEINFO_CACHEINFO_1' || $row['cache_name']=='ONLINEINFO_CACHEINFO_3' || $row['cache_name']=='ONLINEINFO_CACHEINFO_9'){
	 
	$text.='<td class="forumheader3" style="text-align: center;"><input type="hidden" name="onlineinfo_acache'.$i.'" size="3" value="'.$row['cache_active'].'"  />&nbsp;</td>';	
	$text.='<td class="forumheader3" style="text-align: center;"><input type="hidden" name="onlineinfo_cachetime'.$i.'" size="3" value="'.$row['cache_timestamp'].'" />&nbsp;</td>';
	 }else{
	$text.='<td class="forumheader3" style="text-align: center;">'.Create_yes_no_dropdown('onlineinfo_acache'.$i,$row['cache_active']).'</td>';	
	$text.='<td class="forumheader3" style="text-align: center;"><input class="tbox" type="text" name="onlineinfo_cachetime'.$i.'" size="10" value="'.$row['cache_timestamp'].'" maxlength="11" /></td>';
	}
	
	$text.='<td class="forumheader3" style="text-align: center;">';
	
	if($row['cache_name']=='ONLINEINFO_CACHEINFO_1' || $row['cache_name']=='ONLINEINFO_CACHEINFO_9'){	 
	 $text.='<input type="hidden" name="onlineinfo_records'.$i.'" value="'.$row['cache_records'].'">&nbsp;';	 
}else{ 		
	$text.='<input class="tbox" type="text" name="onlineinfo_records'.$i.'" size="4" value="'.$row['cache_records'].'" maxlength="5" />';	
	}	
	$text.='</td></tr>';

	$i++;
}


$text .= '<tr><td class="forumheader" colspan="7">&nbsp;</td></tr>
<tr>
<td class="forumheader3" style="text-align: right;">'.ONLINEINFO_LOGIN_MENU_A39.'</td>
<td class="forumheader3" colspan="6"><input type="checkbox" name="onlineinfo_formatbdays" value="1"';
if ($pref['onlineinfo_formatbdays']=='1'){
	$text .= ' checked ';}
	
	$text .= '>
	
	</td></tr>
<tr>
<td class="forumheader3" style="text-align: right;">'.ONLINEINFO_LOGIN_MENU_A163.'</td>
<td class="forumheader3" colspan="6">'.Create_yes_no_dropdown('onlineinfo_bavatar',$onlineinfo_bavatar).'</td>
</tr>
<tr>
<td colspan="7" class="forumheader" style="text-align:center"><input class="button" type="submit" name="update_menu" value="' .ONLINEINFO_LOGIN_MENU_A56. '" /></td>
</tr>
</table>
</form>
</div>';

$ns -> tablerender(ONLINEINFO_LOGIN_MENU_A2.' - '.ONLINEINFO_LOGIN_MENU_A73, $text);

require_once(e_ADMIN.'footer.php');


#################### ADMIN_CONFIG_FLASHCHAT
require_once('../../class2.php');
if(!getperms('P')){ header("location:".e_BASE."index.php"); exit ;}
require_once(e_ADMIN.'auth.php');
require_once(e_HANDLER.'userclass_class.php');

$lan_file = e_PLUGIN.'onlineinfo_menu/languages/admin_'.e_LANGUAGE.'.php';
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.'onlineinfo_menu/languages/admin_English.php');

include_once(e_PLUGIN.'onlineinfo_menu/functions.php');


if(IsSet($_POST['update_menu'])){

	$pref['onlineinfo_flashchatuse']=$_POST['onlineinfo_flashchatuse'];
	$pref['onlineinfo_flashchatprefix']=$_POST['onlineinfo_flashchatprefix'];
	$pref['onlineinfo_flashchatlocation']=$_POST['onlineinfo_flashchatlocation'];
	$pref['onlineinfo_flashchatwindow']=$_POST['onlineinfo_flashchatwindow'];

	save_prefs();

	$ns -> tablerender('', '<div style="text-align:center"><b>' .ONLINEINFO_LOGIN_MENU_A1.' ( '.ONLINEINFO_LOGIN_MENU_A110. ' )</b></div>');
}

$onlineinfo_flashchatuse = $pref['onlineinfo_flashchatuse'];
$onlineinfo_flashchatprefix = $pref['onlineinfo_flashchatprefix'];
$onlineinfo_flashchatlocation = $pref['onlineinfo_flashchatlocation'];
$onlineinfo_flashchatwindow = $pref['onlineinfo_flashchatwindow'];


$text = '<div style="text-align:center">
<form method="POST" action="'.e_SELF.'" name="menu_conf_form">
<table class="fborder">';


$text .= '<tr>
<td class="forumheader3" colspan="2">'.ONLINEINFO_LOGIN_MENU_A118.'</td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A113.ONLINEINFO_LOGIN_MENU_A110.'</td>
<td class="forumheader3">'.Create_yes_no_dropdown('onlineinfo_flashchatuse',$onlineinfo_flashchatuse).'</td>
</tr>


<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A110.ONLINEINFO_LOGIN_MENU_A111.'<br />('.ONLINEINFO_IPB_A6.'e107_)</td>
<td class="forumheader3"><input class="tbox" type="text" name="onlineinfo_flashchatprefix" size="12" value="'.$onlineinfo_flashchatprefix.'" maxlength="12"" /></td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A110.ONLINEINFO_LOGIN_MENU_A112.'<br />('.ONLINEINFO_IPB_A6.SITEURL.'chat)</td>
<td class="forumheader3">'.SITEURL.'<input class="tbox" type="text" name="onlineinfo_flashchatlocation" size="24" value="'.$onlineinfo_flashchatlocation.'" maxlength="100" /></td>
</tr>
<tr>';

if($onlineinfo_flashchatwindow=='e107') {
$text .='<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A114.ONLINEINFO_LOGIN_MENU_A110. ':<br /><span class="smalltext">' .ONLINEINFO_IPB_A6.ONLINEINFO_LOGIN_MENU_A115. '</td>
<td class="forumheader3"><input type="radio"  name="onlineinfo_flashchatwindow" value="e107" checked />&nbsp;' .ONLINEINFO_LOGIN_MENU_A115. '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"  name="onlineinfo_flashchatwindow" value="window" />&nbsp;' .ONLINEINFO_LOGIN_MENU_A116. '</td>';

}else{
	
$text .='<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A114.ONLINEINFO_LOGIN_MENU_A110.':<br /><span class="smalltext">' .ONLINEINFO_IPB_A6.ONLINEINFO_LOGIN_MENU_A115. '</td>
<td class="forumheader3"><input type="radio"  name="onlineinfo_flashchatwindow" value="e107" />&nbsp;' .ONLINEINFO_LOGIN_MENU_A115. '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"  name="onlineinfo_flashchatwindow" value="window" checked />&nbsp;' .ONLINEINFO_LOGIN_MENU_A116. '</td>';
}

$text .='</tr>
<tr>
<td colspan="4" class="forumheader" style="text-align:center"><input class="button" type="submit" name="update_menu" value="' .ONLINEINFO_LOGIN_MENU_A56. '" /></td>
</tr>
</table>
</form>';

$text.='<br /><br /><iframe src="'.SITEURL.$menu_pref['onlineinfo_flashchatlocation'].'/admin/index.php" id="Flashchat Admin" name="iframe" width="100%" height="800px" scrolling="yes" frameborder="0" marginheight="0" marginwidth="0"><br />Your browser is not compatible with the frames used on this page, to view this page please click<a href="'.SITEURL.$menu_pref['onlineinfo_flashchatlocation'].'/admin/index.php">Here</a>.<br /></iframe>';


$text .= '</div>';
$ns -> tablerender(ONLINEINFO_LOGIN_MENU_A2.' - '.ONLINEINFO_LOGIN_MENU_A110, $text);

require_once(e_ADMIN.'footer.php');



############### ADMIN_CONFIG_GALLERY2
require_once('../../class2.php');
if(!getperms('P')){ header("location:".e_BASE."index.php"); exit ;}
require_once(e_ADMIN.'auth.php');
require_once(e_HANDLER.'userclass_class.php');

$lan_file = e_PLUGIN.'onlineinfo_menu/languages/admin_'.e_LANGUAGE.'.php';
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.'onlineinfo_menu/languages/admin_English.php');


include_once(e_PLUGIN.'onlineinfo_menu/functions.php');


if(IsSet($_POST['update_menu'])){

$pref['onlineinfo_gallery2use']=$_POST['onlineinfo_gallery2use'];
$pref['onlineinfo_gallery2prefix']=$_POST['onlineinfo_gallery2prefix'];
$pref['onlineinfo_gallery2location']=$_POST['onlineinfo_gallery2location'];
$pref['onlineinfo_gallery2window']=$_POST['onlineinfo_gallery2window'];
$pref['onlineinfo_gallery2shownum']=$_POST['onlineinfo_gallery2shownum'];


	save_prefs();


	$ns -> tablerender('', '<div style="text-align:center"><b>' .ONLINEINFO_LOGIN_MENU_A1.' ( '.ONLINEINFO_LOGIN_MENU_A145. ' )</b></div>');
}



$onlineinfo_gallery2use = $pref['onlineinfo_gallery2use'];
$onlineinfo_gallery2prefix = $pref['onlineinfo_gallery2prefix'];
$onlineinfo_gallery2location = $pref['onlineinfo_gallery2location'];
$onlineinfo_gallery2window = $pref['onlineinfo_gallery2window'];
$onlineinfo_gallery2shownum = $pref['onlineinfo_gallery2shownum'];

$text = '<div style="text-align:center">
<form method="POST" action="'.e_SELF.'" name="menu_conf_form">
<table class="fborder">';


$text .= '<tr>
<td class="forumheader3" colspan="2">'.ONLINEINFO_LOGIN_MENU_A146.'</td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A113.ONLINEINFO_LOGIN_MENU_A147.'</td>
<td class="forumheader3">'.Create_yes_no_dropdown('onlineinfo_gallery2use',$onlineinfo_gallery2use).'</td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A147.ONLINEINFO_LOGIN_MENU_A111.'<br />('.ONLINEINFO_IPB_A6.'g2_)</td>
<td class="forumheader3"><input class="tbox" type="text" name="onlineinfo_gallery2prefix" size="12" value="'.$onlineinfo_gallery2prefix.'" maxlength="12" /></td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A147.ONLINEINFO_LOGIN_MENU_A112.'<br />('.ONLINEINFO_IPB_A6.SITEURL.'gallery2)</td>
<td class="forumheader3">'.SITEURL.'<input class="tbox" type="text" name="onlineinfo_gallery2location" size="24" value="'.$onlineinfo_gallery2location.'" maxlength="100" /></td>
</tr>
<tr>';

if($onlineinfo_gallery2window=='e107') {
$text .='<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A114.ONLINEINFO_LOGIN_MENU_A147. ':<br /><span class="smalltext">' .ONLINEINFO_IPB_A6.ONLINEINFO_LOGIN_MENU_A115. '</td>
<td class="forumheader3"><input type="radio"  name="onlineinfo_gallery2window" value="e107" checked />&nbsp;' .ONLINEINFO_LOGIN_MENU_A115. '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"  name="onlineinfo_gallery2window" value="window" />&nbsp;' .ONLINEINFO_LOGIN_MENU_A116. '</td>';

}else{
	
$text .='<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A114.ONLINEINFO_LOGIN_MENU_A147.':<br /><span class="smalltext">' .ONLINEINFO_IPB_A6.ONLINEINFO_LOGIN_MENU_A115. '</td>
<td class="forumheader3"><input type="radio"  name="onlineinfo_gallery2window" value="e107" />&nbsp;' .ONLINEINFO_LOGIN_MENU_A115. '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"  name="onlineinfo_gallery2window" value="window" checked />&nbsp;' .ONLINEINFO_LOGIN_MENU_A116. '</td>';
}

$text .='</tr>

<tr>
<td class="forumheader3">' .ONLINEINFO_LOGIN_MENU_A148. '</td>
<td class="forumheader3"><input class="tbox" type="text" name="onlineinfo_gallery2shownum" size="4" value="'.$onlineinfo_gallery2shownum .'" maxlength="4" /></td>
</tr>

<tr>
<td colspan="4" class="forumheader" style="text-align:center"><input class="button" type="submit" name="update_menu" value="' .ONLINEINFO_LOGIN_MENU_A56. '" /></td>
</tr>
</table>
</form>';

$text .= '</div>';
$ns -> tablerender(ONLINEINFO_LOGIN_MENU_A2.' - '.ONLINEINFO_LOGIN_MENU_A147, $text);

require_once(e_ADMIN.'footer.php');





############### ADMIN_CONFIG_IPB
require_once('../../class2.php');
if(!getperms('P')){ header("location:".e_BASE."index.php"); exit ;}
require_once(e_ADMIN.'auth.php');
require_once(e_HANDLER.'userclass_class.php');

$lan_file = e_PLUGIN.'onlineinfo_menu/languages/admin_'.e_LANGUAGE.'.php';
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.'onlineinfo_menu/languages/admin_English.php');

include_once(e_PLUGIN.'onlineinfo_menu/functions.php');





if(IsSet($_POST['update_menu'])){


	if($_POST['onlineinfo_pm']==e_UC_PUBLIC){$_POST['onlineinfo_pm']=e_UC_MEMBER;}

$pref['onlineinfo_ibfpm']=$_POST['onlineinfo_ibfpm'];
$pref['onlineinfo_ibfuse']=$_POST['onlineinfo_ibfuse'];
$pref['onlineinfo_ibfprefix']=$_POST['onlineinfo_ibfprefix'];
$pref['onlineinfo_ibflocation']=$_POST['onlineinfo_ibflocation'];
$pref['onlineinfo_ibftime']=$_POST['onlineinfo_ibftime'];
$pref['onlineinfo_ibfshownum']=$_POST['onlineinfo_ibfshownum'];
$pref['onlineinfo_ibfautohide']=$_POST['onlineinfo_ibfautohide'];

	save_prefs();

	$ns -> tablerender('', '<div style="text-align:center"><b>' .ONLINEINFO_LOGIN_MENU_A1.' ( '.ONLINEINFO_IPB_A1. ' )</b></div>');
}


$onlineinfo_ibfpm = $pref['onlineinfo_ibfpm'];
$onlineinfo_ibfuse = $pref['onlineinfo_ibfuse'];
$onlineinfo_ibfprefix = $pref['onlineinfo_ibfprefix'];
$onlineinfo_ibflocation = $pref['onlineinfo_ibflocation'];
$onlineinfo_ibftime = $pref['onlineinfo_ibftime'];
$onlineinfo_ibfshownum = $pref['onlineinfo_ibfshownum'];
$onlineinfo_ibfautohide = $pref['onlineinfo_ibfautohide'];

$text = '<div style="text-align:center">
<form method="POST" action="'.e_SELF.'" name="menu_conf_form">
<table class="fborder">';


$dropdown1=Create_yes_no_dropdown('onlineinfo_ibfpm',$onlineinfo_ibfpm);
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
<td colspan="4" class="forumheader" style="text-align:center"><input class="button" type="submit" name="update_menu" value="' .ONLINEINFO_LOGIN_MENU_A56. '" /></td>
</tr>
</table>
</form>';


$text .= '</div>';
$ns -> tablerender(ONLINEINFO_LOGIN_MENU_A2.' - '.ONLINEINFO_IPB_A1, $text);

require_once(e_ADMIN.'footer.php');














*/



		switch($menu)
		{
			case "latestnews":
					$fields['caption']      = array('title'=> LAN_CAPTION, 'type'=>'text', 'multilan'=>true, 'writeParms'=>array('size'=>'xxlarge'));
					$fields['count']        = array('title'=> LAN_LIMIT, 'type'=>'text', 'writeParms'=>array('pattern'=>'[0-9]*', 'size'=>'mini'));
					$fields['category']     = array('title'=> LAN_CATEGORY, 'type'=>'dropdown', 'writeParms'=>array('optArray'=>$categories, 'default'=>'blank'));
			break;

			case "news_grid":
					$fields['caption']      = array('title'=> LAN_CAPTION, 'type'=>'text', 'multilan'=>true, 'writeParms'=>array('size'=>'xxlarge'), 'help'=>LAN_OPTIONAL);
					$fields['category']     = array('title'=> LAN_CATEGORY, 'type'=>'dropdown', 'writeParms'=>array('optArray'=>$categories, 'default'=>"(".LAN_ALL.")"), 'help'=>"Limit news items to a specific category");
					$fields['source']       = array('title'=> "Source", 'type'=>'dropdown','writeParms'=>array('optArray'=>$sources), 'help'=>"Assigned items are those with a template assigned to 'News Grid Menu' ");
					$fields['layout']       = array('title'=> "Layout", 'type'=>'method', 'writeParms'=>'');
					$fields['count']        = array('title'=> "Number of Items to Display", 'type'=>'number', 'writeParms'=>array('pattern'=>'[0-9]*', 'default'=>4));
					$fields['titleLimit']   = array('title'=> "Title Character Limit", 'type'=>'number', 'writeParms'=>'');
					$fields['summaryLimit'] = array('title'=> "Summary Character Limit", 'type'=>'number', 'writeParms'=>'');

			break;

			case "news_carousel":
					$fields['caption']      = array('title'=> LAN_CAPTION, 'type'=>'text', 'multilan'=>true, 'writeParms'=>array('size'=>'xxlarge'), 'help'=>LAN_OPTIONAL);
					$fields['category']     = array('title'=> LAN_CATEGORY, 'type'=>'dropdown', 'writeParms'=>array('optArray'=>$categories, 'default'=>"(".LAN_ALL.")"), 'help'=>"Limit news items to a specific category");
					$fields['source']       = array('title'=> "Source", 'type'=>'dropdown','writeParms'=>array('optArray'=>$sources), 'help'=>"Assigned items are those with a template assigned to 'News Carousel' ");
					$fields['count']        = array('title'=> "Number of Items to Display", 'type'=>'number', 'writeParms'=>array('pattern'=>'[0-9]*', 'default'=>4));
			break;


			case "news_categories":
					$fields['caption']      = array('title'=> LAN_CAPTION, 'type'=>'text', 'multilan'=>true, 'writeParms'=>array('size'=>'xxlarge'));
					$fields['count']        = array('title'=> LAN_LIMIT, 'type'=>'text', 'writeParms'=>array('pattern'=>'[0-9]*'));
				break;

			case "news_months":
					$fields['showarchive']  = array('title'=> "Display Archive Link", 'type'=>'boolean');
					$fields['year']         = array('title'=> "Year", 'type'=>'text', 'writeParms'=>array('pattern'=>'[0-9]*', 'size'=>'mini'));
				break;

			case "other_news":
			case "other_news2":
					$fields['caption']   = array('title'=> LAN_CAPTION, 'type'=>'text', 'multilan'=>true, 'writeParms'=>array('size'=>'xxlarge'));
				break;

		}

		 return $fields;




	}

	public function init()
		{
/*
			if(e107::isInstalled('deleteme') == false)
			{
				$this->prefs['deleteme']['writeParms']['post'] = " <span class='label label-important label-danger'>".LANG_LAN_05."</span>";
			}
*/
// NÃO FUNCIONA....			e107::getMessage()->addInfo(LAN_EUSER_ADMIN_SHAREDCONFIG);
    }



function getEmbedMenus($menuarray) {
//  var_dump ($menuarray);
var_dump($pref['sitetheme']);
  $contents = array();
  $startDelimiter = "{EUSER_EMBEDMENU:";
  $endDelimiter = "}";
  $startDelimiterLength = strlen($startDelimiter);
  $endDelimiterLength = strlen($endDelimiter);
  $startFrom = $contentStart = $contentEnd = 0;

  foreach ($menuarray as $str){
    while (false !== ($contentStart = strpos($str, $startDelimiter, $startFrom))) {
      $contentStart += $startDelimiterLength;
      $contentEnd = strpos($str, $endDelimiter, $contentStart);
      if (false === $contentEnd) {
        break;
      }
      $contents[] = substr($str, $contentStart, $contentEnd - $contentStart);
      $startFrom = $contentEnd + $endDelimiterLength;
    }
  }

  return $contents;
}



}

// optional
class euser_menu_form extends e_form
{

	public function layout($curVal)
	{

		// class='alert alert-info'

		$arr = array(
		"col-md-6" => "<div class='row'><div class='col-md-6'><div {STYLE}>1/2</div></div><div class='col-md-6'><div {STYLE}>1/2</div></div></div>",
		"col-md-4" => "<div class='row'><div class='col-md-4'><div {STYLE}>1/3</div></div><div class='col-md-4'><div {STYLE}>1/3</div></div><div class='col-md-4'><div {STYLE}>1/3</div></div></div>",
		"col-md-3" => "<div class='row'><div class='col-md-3 '><div {STYLE}>1/4</div></div><div class='col-md-3'><div {STYLE}>1/4</div></div><div class='col-md-3'><div {STYLE}>1/4</div></div><div class='col-md-3'><div {STYLE}>1/4</div></div></div>",
		);

		$text = '<table class="table news-menu-shade">';

		foreach($arr as $k=>$v)
		{

			$text .= "<tr><td>".$this->radio('layout', $k, ($curVal == $k), array('label'=>$k))."</td><td>".str_replace('{STYLE}',"class='alert alert-info' style='margin-bottom:0;text-align:center' ",$v)."</td></tr>";
		}

		$text .= "</table>";

		return $text;
	}

}