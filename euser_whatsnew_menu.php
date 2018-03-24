<?php
if (!defined('e107_INIT')) { exit; }
//$text .= "------<hr>";

//global $euser_pref;
//global $tp, $sql;
// Defaults to global pref if no parm from menu pref
// Tirar caso aprovem o issue... os parms só vem por defeito das prefs em último caso...
if (!$parm) {$parm = e107::getPlugPref('euser');}
//e107::lan('euser', 'front', true);
//e107::lan('euser', 'whatsnew_menu', true);
e107::lan('euser', 'front', true);
e107::coreLan('online');
e107::css('euser','euser_menu.css');
$tp = e107::getParser();

//$euser_pref = e107::getPlugPref('euser');

//var_dump ($euser_pref);

/*
		$ordersql=new db;
//		$script="SELECT * FROM ".MPREFIX."euser_cache Where type='order' and cache='currentlyonline.php' ORDER BY type_order";

//    echo "--SCRIPT 1:".$script;
    
$ordersql->db_Select_gen("SELECT * FROM ".MPREFIX."euser_cache Where type='order' and cache='extrainfo.php' ORDER BY type_order");
		
//    echo "--ONLINE INFO ORDER:".$onlineinfoorder;

$orderrow = $ordersql->db_Fetch();
		 $orderhide=$orderrow['cache_hide'];
	if(!check_class($orderrow['cache_userclass']))	{ exit; }
*/
//if(check_class($orderclass)){

//----var_dump ($orderhide==1);
//----var_dump ($extrahide == 1);

//----		if($orderhide==1){

//$text .= OIM_TYPE." = ".($euser_pref['loginmenutype']!=0);

// Antigo????
/*
if ($euser_pref['loginmenutype']!=0){
        $caption .= '<div id="info-title" style="cursor:hand; text-align:left; font-size: '.$onlineinfomenufsize.'px; vertical-align: middle; width:'.$onlineinfomenuwidth.'; font-weight:bold;" title="'.EUSER_LOGIN_MENU_L38.'">&nbsp;'.EUSER_LOGIN_MENU_L38.'</div>';
}
// O tipo de menu passa a ser definido no próprio template... isto tem de sair daqui, para um shortcode, por exemplo... ou com uma constante definida no próprio template...
		$text .= '<div id="info" class="switchgroup1" style="'.($euser_pref['loginmenutype']!=0?'display:none;text-align:left; width:'.$onlineinfomenuwidth.'; margin-left:16px;':'text-align:center; ').'">';
*/


//----    if ($extrahide == 1)
//----    {

//$checkfornew=$onlineinfo_getgallery2info+$onlineinfo_getipbinfo+$onlineinfo_getsmfinfo+$new_bugs+$new_gametop+$new_game+$new_tube+$new_link+$new_downloads+$new_blog+$new_copper+$new_picture+$new_content+$new_guestbook+$new_users+$new_forum+$new_suggestions+$new_joke+$new_chat2+$new_chat+$new_comments+$new_news;

//var_dump ($checkfornew);

// O tipo de menu passa a ser definido no próprio template... isto tem de sair daqui, para um shortcode, por exemplo... ou com uma constante definida no próprio template...
/*
  if ($euser_pref['loginmenutype']==0) {
//  $text .= "<a title='".EUSER_LOGIN_MENU_L39." ".($checkfornew>0 ? "(".$checkfornew.")" : "(0)")."'><img src='".e_PLUGIN."euser/images/news".($checkfornew>0?"_new":"").($euser_pref['loginmenutype']==0?"_24":"").".png' style='border:0; vertical-align: middle'/>&nbsp;".($checkfornew>0?"<span class='onlineinfonew'>":"").$checkfornew."</a>&nbsp;&nbsp;";
  $text .= "<a title='".EUSER_LOGIN_MENU_L39." (".$checkfornew.")' ".(e107::isInstalled('list_new')?"href='".e_PLUGIN."list_new/list.php'":"")."><img src='".e_PLUGIN."euser/images/news".($checkfornew>0?"_new":"").($euser_pref['loginmenutype']==0?"_24":"").".png' style='border:0; vertical-align: middle'/>&nbsp;".($checkfornew>0?"<span class='onlineinfonew'>":"").$checkfornew."</a>&nbsp;&nbsp;";
  } else {
        $text .= "<div id='updates-title' style='cursor:hand; font-size: ".$onlineinfomenufsize."px; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".EUSER_LOGIN_MENU_L39.($checkfornew>0 ? " (".$checkfornew.")" : " (0)")."'>&nbsp;".EUSER_LOGIN_MENU_L39.($checkfornew>0 ? " (".$checkfornew.")" : " (0)")."</div>";
  }
*/
//----	    $caption .= "<div id='updates' class='switchgroup1' style='display:none'>";
//----        $text .= "<table style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px; margin-right:5px;'><tr><td>";
  
//----    }
//----    else
//----    {

//----    	$caption .= "<div class='smallblacktext' style='font-size: ".$onlineinfomenufsize."px; font-weight:bold; width:".$onlineinfomenuwidth."'>".EUSER_LOGIN_MENU_L39."</div><div style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px; margin-right:5px;'><table style='text-align:left; width:".$onlineinfomenuwidth."'><tr><td>";
//----    }
//----}

	$sc = e107::getScBatch('whatsnew', 'euser');
  $sc->setVars($parm);
  $sc->wrapper('whatsnew_menu/main');

// Isto depois é para mudar, para as prefs
		$extrasql=new db;
		$script="SELECT * FROM ".MPREFIX."euser_cache Where type='extraorder' ORDER BY type_order";
		$onlineinfoextra = $extrasql->db_Select_gen($script);


		while ($extrarow = $extrasql->db_Fetch()){

      $sc->setVars($extrarow);

		 $extraclass=$extrarow['cache_userclass'];
//		 var_dump($extraclass);
		 $extrahide=$extrarow['cache_hide'];
		 $extraacache=$extrarow['cache_active'];
		 $extracachetime=$extrarow['cache_timestamp'];
		 $extrarecords=$extrarow['cache_records'];

//$text .= "-----------------".$extrarow['cache']."-----------------";
//if (ADMIN) {
//echo " ->EXTRA: ".$extrarow['cache'];
//}

//    echo ($extrarow['cache']."<hr>");
//$text .='<div style="text-align:left; padding:5px; background-image:url(http://www.snazzyspace.com/scroll-boxes/medium-grey.gif); width: 280px; height: 100px; background-color: #000000; border-color: #000000; border-width: 1px; border-style: solid; color: #FFFFFF; font-size: 10px; font-family: Arial; overflow: auto;">';
//      require_once(e_PLUGIN.'euser/includes/extrainfo_'.$extrarow['cache'].'.php');
//$text .= $extrarow['cache'];
//$text .='</div>';

		}

// O tipo de menu passa a ser definido no próprio template... isto tem de sair daqui, para um shortcode, por exemplo... ou com uma constante definida no próprio template...
/*
if ($euser_pref['loginmenutype']!=0){
		$text .='</div>';

		if($orderhide==1){ $text .='</div>';}
}
*/
//    var_dump ($EXTRAINFO_MENU_TEMPLATE['main']);
  $template = e107::getTemplate('euser', 'whatsnew_menu');
//    var_dump ($template['main']);
//    var_dump ($EXTRAINFO_MENU_TEMPLATE['main']);
//	$sc = e107::getScBatch('whatsnew_menu', 'euser');

//	$text = $template['main'];
	$text = $tp->parseTemplate($template['main'], true, $sc);
//  $text = "TESTE";
/*
 if ($euser_pref['whatsnewtype'] == 1){
    $caption .= "<a href='" . e_PLUGIN . "euser/new.php'>" . EUSER_LOGIN_MENU_L24 . "</a>";
    }else{
    $text_start .= "<a href='" . e_PLUGIN . "list_new/list.php?new'>" . EUSER_LOGIN_MENU_L24 . "</a>";
}
*/
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

$caption .= "<a href='".e_PLUGIN.($parm['whatsnewpage'] == 1?"euser/new.php":"list_new/list.php?new")."' title='".LAN_EUSER_4024."'>".LAN_EUSER_4039."</a>";
	$ns->tablerender($caption, $text, 'euser_whatsnew_menu');

?>