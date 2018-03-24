<?php
if (!defined('e107_INIT')) { exit; }

//e107::lan('euser', 'pm_menu', true);
e107::lan('euser', 'front', true);
// Se o código do pm.php vier para aqui, o código tem de ser limpo do construct....
//        return call_user_func($this ->euserlm, "includes/pm.php");

// UTILIZAÇÃO DE OUTRO SISTEMA DE PM'S, TEM DE SAIR DAQUI, TIPO PARA UM SHORTCODE...
//if($euser_pref['ibfpm']==0){


// UTILIZAÇÃO DE OUTRO SISTEMA DE PM'S, TEM DE SAIR DAQUI, TIPO PARA UM SHORTCODE...
// IPB Forum PM System
if($euser_pref['ibfpm']==1){
	$onlineinfo_ipb_sql = new db;

	// check e107 userid = IPB userid

	$sql -> db_Select("user","*","user_id=".USERID."");
	while($row = $sql -> db_Fetch())
		{
		extract($row);
		$userloginname= $user_loginname;

		}

	//get userid from IPB
	$script="SELECT * FROM ".$euser_pref['ibfprefix']."members WHERE name ='".$userloginname."'";
	$onlineinfo_getipbuserid = $onlineinfo_ipb_sql->db_Select_gen($script);
	while ($row = $onlineinfo_ipb_sql->db_Fetch())
	{
	$ipbuserid=	$row['id'];
	}

 if($ipbuserid==USERID)
 	{

		define("PM_INBOX_ICON", "<img src='".e_PLUGIN."euser/images/mail_get.png' style='height:16;width:16;border:0' alt='".ONLINEINFO_LAN_PM_25."' title='".LAN_PM_25."' />");
		define("PM_OUTBOX_ICON", "<img src='".e_PLUGIN."euser/images/mail_send.png' style='height:16;width:16;border:0' alt='".ONLINEINFO_LAN_PM_26."' title='".LAN_PM_26."' />");
		define("PM_SEND_LINK", ONLINEINFO_LAN_PM_35);
		define("NEWPM_ANIMATION", "<img src='".e_PLUGIN."euser/images/newpm.gif' alt='' style='border:0' />");


		$script="SELECT * FROM ".$euser_pref['ibfprefix']."message_topics WHERE mt_to_id = ".USERID;
		$onlineinfo_getipbinbox = $onlineinfo_ipb_sql->db_Select_gen($script);
		$script="SELECT * FROM ".$euser_pref['ibfprefix']."message_topics WHERE mt_from_id = ".USERID;
		$onlineinfo_getipboutbox = $onlineinfo_ipb_sql->db_Select_gen($script);
		// $script="SELECT * FROM ".$euser_pref['ibfprefix']."message_topics WHERE mt_read=0 AND mt_to_id = ".USERID;
		// $onlineinfo_getipbinboxunread = $onlineinfo_ipb_sql->db_Select_gen($script);
		$script="SELECT * FROM ".$euser_pref['ibfprefix']."message_topics WHERE mt_read=0 AND mt_from_id = ".USERID;
		$onlineinfo_getipboutboxunread = $onlineinfo_ipb_sql->db_Select_gen($script);



	$text .= "<div id='pm-title' style='cursor:hand; text-align:left; vertical-align: font-size: ".$onlineinfomenufsize."px; middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".EUSER_LOGIN_MENU_L66.EUSER_LOGIN_MENU_L29."'>&nbsp;".EUSER_LOGIN_MENU_L66.EUSER_LOGIN_MENU_L29." (".$onlineinfo_getipbinboxunread.")</div>";
	$text .= "<div id='pm' class='switchgroup1' style='display:none'>";
$text .= "<table style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:20px;'><tr><td>";







		if ($onlineinfo_getipbinboxunread!=0){
			$text.="<a href='".SITEURL.$euser_pref['ibflocation']."/index.php?act=Msg&CODE=01&VID=in'>".NEWPM_ANIMATION."</a><br />";
		}

		$text.="<a href='".SITEURL.$euser_pref['ibflocation']."/index.php?act=Msg&CODE=01&VID=in'>".PM_INBOX_ICON."</a>
		<a href='".SITEURL.$euser_pref['ibflocation']."/index.php?act=Msg&CODE=01&VID=in'>".ONLINEINFO_LAN_PM_25."</a>";




		$text.="<br />
		".$onlineinfo_getipbinbox."&nbsp;".ONLINEINFO_LAN_PM_36.",&nbsp;".$onlineinfo_getipbinboxunread."&nbsp;".ONLINEINFO_LAN_PM_37."
		<br />
		<a href='".SITEURL.$euser_pref['ibflocation']."/index.php?act=Msg&CODE=01&VID=sent'>".PM_OUTBOX_ICON."</a>
		<a href='".SITEURL.$euser_pref['ibflocation']."/index.php?act=Msg&CODE=01&VID=sent'>".ONLINEINFO_LAN_PM_26."</a><br />
		".$onlineinfo_getipboutbox."&nbsp;".ONLINEINFO_LAN_PM_36.",&nbsp;".$onlineinfo_getipboutboxunread."&nbsp;".ONLINEINFO_LAN_PM_37."
		<br />[<a href='".SITEURL.$euser_pref['ibflocation']."/index.php?act=Msg&CODE=04'>".ONLINEINFO_LAN_PM_35."</a> ]";


		$text .= "</td></tr></table></div>";

	}
}

//	if(check_class($orderclass)){
// ANTIGO	if(check_class($orderclass) && e107::isInstalled("pm")){
// ################ AGORA É TUDO TRATADO PELO PLUGIN PM.... Inclusive o próprio plugin chamada é o PM...
//Este só serve se não houver plugin PM...
/*--
*/
	if(e107::isInstalled("pm")){
//var_dump ($data);
	//var_dump ($this->orderList['euser_lm_avatar.php']['class']);
//########################## Temporário, assim que tudo estiver em shortcodes, esta variável vem do euser_login_menu.php

/*
	$pm_user = USERID;
	$unreadpms = $sql -> db_Count("private_msg", "(*)", "WHERE pm_to=$pm_user AND pm_read_del=0 and pm_read=0");
*/
/*--
			require_once(e_PLUGIN."pm/pm_func.php");

		$pm=new pmbox_manager;

      $pm_inbox = $pm->pm_getInfo('inbox');
//var_dump ($pm_inbox);
//echo "<hr><hr>";
      $unreadpms=intval($pm_inbox['inbox']['unread']);

      if($unreadpms<>0){
			define("NEWPM_START", "<A style='background:url(".e_PLUGIN_ABS."euser/images/newpm_back.gif); width: 98%; padding: 2px; font-weight: bold !important'");
//			define("NEWPM_END", "</A>");
//			define("NEWPM_START", "<span style='background:url(".e_PLUGIN_ABS."euser/images/newpm_back.gif); width: 98%; display: block; padding: 2px; font-weight: 900 !important'>");
//			define("NEWPM_END", "</span>");

//			$sc_style['INBOX_UNREAD']['pre'] = "<span style='font-weight: 900 !important'>";
//			$sc_style['INBOX_UNREAD']['post'] = "</span>";
} else {
			define("NEWPM_START", "<A");
//			define("NEWPM_END", "");
}
			define("NEWPM_END", "</A>");

//var_dump ($orderhide);

if ($orderhide == 1)
    {

$text .= "<div id='pm-title' style='cursor:hand; text-align:left; font-size: ".$onlineinfomenufsize."px; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".EUSER_LOGIN_MENU_L29."'>".NEWPM_START."&nbsp;".EUSER_LOGIN_MENU_L29." (".$unreadpms.")".NEWPM_END."</div>";
$text .= "<div id='pm' class='switchgroup1' style='display:none'>";
$text .= "<table style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'><tr><td>";

}else{
//$text .= "<td><div class='smallblacktext' style='text-align:left; font-size: ".$onlineinfomenufsize."px; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".EUSER_LOGIN_MENU_L29."'>&nbsp;".EUSER_LOGIN_MENU_L29."</div>";
  if ($euser_pref['loginmenutype']!=0)
    {
// NORMAL TEMPLATE
$text .= "<div class='smallblacktext' style='text-align:left; font-size: ".$onlineinfomenufsize."px; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".EUSER_LOGIN_MENU_L29."'>&nbsp;".EUSER_LOGIN_MENU_L29."</div>";
    }
$text .= "<div id='pm'>";
$text .= "<table style='text-align:left; width:".$onlineinfomenuwidth.";'><tr><td>";
}



//			global $sysprefs, $euser_pref, $pm_prefs;
			global $euser_pref, $pm_prefs;
			if(!isset($pm_prefs['perpage']))
			{
//				$pm_prefs = $sysprefs->getArray("pm_prefs");

				$pm_prefs = e107::getPlugPref('pm');
//        var_dump($pm_prefs);
			}
			require_once(e_PLUGIN."pm/pm_func.php");
			$pm->pm_getInfo('clear');

/*
			define("OLPM_NEWINBOX_ICON", "<img src='".e_PLUGIN."euser/images/newpm_icon".($euser_pref['loginmenutype']==0?"_24":"").".gif' style='height:22px; border:0' alt='".ONLINEINFO_LAN_PM_25."' title='".ONLINEINFO_LAN_PM_25."' />");

			define("OLPM_INBOX_ICON", "<img src='".e_PLUGIN."euser/images/mail_get.png' style='height:16px; border:0' alt='".ONLINEINFO_LAN_PM_25."' title='".ONLINEINFO_LAN_PM_25."' />");
			define("OLPM_OUTBOX_ICON", "<img src='".e_PLUGIN."euser/images/mail_send.png' style='height:16px; border:0' alt='".ONLINEINFO_LAN_PM_26."' title='".ONLINEINFO_LAN_PM_26."' />");
*/
/*--
			define("OLPM_INBOX_ICON", "<img src='".e_PLUGIN."euser/images/mail_get".($euser_pref['loginmenutype']==0?"_24":"").".png' style='border:0; vertical-align: middle'/>");
			define("OLPM_OUTBOX_ICON", "<img src='".e_PLUGIN."euser/images/mail_send".($euser_pref['loginmenutype']==0?"_24":"").".png' style='border:0; vertical-align: middle'/>");
			define("PM_SEND_LINK", "<img src='".e_PLUGIN."euser/images/mail_edit".($euser_pref['loginmenutype']==0?"_24":"").".png' style='border:0; vertical-align: middle' title=".ONLINEINFO_LAN_PM_35."/>");
//			define("NEWPM_ANIMATION", "<img src='".e_PLUGIN."euser/images/newpm.gif' alt='' style='border:0' />");
//			$sc_style['SEND_PM_LINK']['pre'] = "<p /><img src='".e_PLUGIN."euser/images/mail_edit.png' alt='' style='border:0' /> ";
//			$sc_style['SEND_PM_LINK']['pre'] = "<img src='".e_PLUGIN."euser/images/mail_edit.png' style='border:0' /> ";
//			$sc_style['SEND_PM_LINK']['post'] = "";
//			$sc_style['PM_SEND_LINK']['pre'] = "<img src='".e_PLUGIN."euser/images/mail_edit.png' style='border:0' /> ";
//			$sc_style['PM_SEND_LINK']['post'] = "";

			$sc_style['INBOX_FILLED']['pre'] = "[";
			$sc_style['INBOX_FILLED']['post'] = "%]";

			$sc_style['OUTBOX_FILLED']['pre'] = "[";
			$sc_style['OUTBOX_FILLED']['post'] = "%]";

//			$sc_style['NEWPM_ANIMATE']['pre'] = "<a href='".e_PLUGIN_ABS."pm/pm.php?inbox'>";
//			$sc_style['NEWPM_ANIMATE']['post'] = "</a>";


			if(!defined($pm_menu_template))
			{

/*
				$pm_menu_template .= "
				<a href='".e_PLUGIN_ABS."pm/pm.php?inbox'>".OLPM_INBOX_ICON."</a>
        $pm_menu_template = "
        <a href='".e_PLUGIN_ABS."pm/pm.php?inbox' style='background:url(".e_PLUGIN_ABS."euser/images/newpm_icon.gif)'>".($unreadpms<>0 ?OLPM_NEWINBOX_ICON:OLPM_INBOX_ICON);
*/
/*        $pm_menu_template = NEWPM_START."
        <a href='".e_PLUGIN_ABS."pm/pm.php?inbox'>".OLPM_INBOX_ICON."&nbsp;".ONLINEINFO_LAN_PM_25."
				<br>({INBOX_TOTAL}&nbsp;".ONLINEINFO_LAN_PM_36.",&nbsp;{INBOX_UNREAD}&nbsp;".ONLINEINFO_LAN_PM_37."&nbsp;{INBOX_FILLED})".NEWPM_END."</a>
				<p style='margin: 0'/>
				<a href='".e_PLUGIN_ABS."pm/pm.php?outbox'>".OLPM_OUTBOX_ICON."&nbsp;".ONLINEINFO_LAN_PM_26."
				<br />(
				{OUTBOX_TOTAL}&nbsp;".ONLINEINFO_LAN_PM_36.",&nbsp;{OUTBOX_UNREAD}&nbsp;".ONLINEINFO_LAN_PM_37."&nbsp;{OUTBOX_FILLED})</a>
				<br /><br />{SEND_PM_LINK}
				";
*/
//echo $_SERVER["SCRIPT_NAME"];

//var_dump(OIM_TYPE);
/*--
  if ($euser_pref['loginmenutype']==0)
    {
// MINI TEMPLATE
        $pm_menu_template = NEWPM_START." href='".e_PLUGIN_ABS."pm/pm.php?inbox' title='".ONLINEINFO_LAN_PM_25." ({PM_INBOX_TOTAL}&nbsp;".ONLINEINFO_LAN_PM_36.",&nbsp;{PM_INBOX_UNREAD}&nbsp;".ONLINEINFO_LAN_PM_37."&nbsp;{PM_INBOX_FILLED})'>".OLPM_INBOX_ICON."&nbsp;{PM_INBOX_TOTAL}&nbsp;/&nbsp;".($unreadpms<>0?"<span class='onlineinfonew'>":"")."{PM_INBOX_UNREAD}".NEWPM_END."&nbsp;&nbsp;<a href='".e_PLUGIN_ABS."pm/pm.php?outbox' title='".ONLINEINFO_LAN_PM_26." ({PM_OUTBOX_TOTAL}&nbsp;".ONLINEINFO_LAN_PM_36.",&nbsp;{PM_OUTBOX_UNREAD}&nbsp;".ONLINEINFO_LAN_PM_37."&nbsp;{PM_OUTBOX_FILLED})'>".OLPM_OUTBOX_ICON."&nbsp;{PM_OUTBOX_TOTAL}&nbsp;/&nbsp;{PM_OUTBOX_UNREAD}</a>&nbsp;&nbsp;&nbsp;&nbsp;{PM_SEND_PM_LINK}";
//        $pm_menu_template = NEWPM_START." href='".e_PLUGIN_ABS."pm/pm.php?inbox' title='".ONLINEINFO_LAN_PM_25." ({INBOX_TOTAL}&nbsp;".ONLINEINFO_LAN_PM_36.",&nbsp;{INBOX_UNREAD}&nbsp;".ONLINEINFO_LAN_PM_37."&nbsp;{INBOX_FILLED})'>".OLPM_INBOX_ICON."&nbsp;".($unreadpms<>0?"<span class='onlineinfonew'>":"")."{INBOX_TOTAL}&nbsp;/&nbsp;{INBOX_UNREAD}".NEWPM_END."&nbsp;&nbsp;<a href='".e_PLUGIN_ABS."pm/pm.php?outbox' title='".ONLINEINFO_LAN_PM_26." ({OUTBOX_TOTAL}&nbsp;".ONLINEINFO_LAN_PM_36.",&nbsp;{OUTBOX_UNREAD}&nbsp;".ONLINEINFO_LAN_PM_37."&nbsp;{OUTBOX_FILLED})'>".OLPM_OUTBOX_ICON."&nbsp;{OUTBOX_TOTAL}&nbsp;/&nbsp;{OUTBOX_UNREAD}</a>&nbsp;&nbsp;&nbsp;&nbsp;{SEND_PM_LINK}";
    } else {
// NORMAL TEMPLATE
        $pm_menu_template = NEWPM_START." href='".e_PLUGIN_ABS."pm/pm.php?inbox'>".OLPM_INBOX_ICON."&nbsp;".ONLINEINFO_LAN_PM_25."
				<br>({INBOX_TOTAL}&nbsp;".ONLINEINFO_LAN_PM_36.",&nbsp;{INBOX_UNREAD}&nbsp;".ONLINEINFO_LAN_PM_37."&nbsp;{INBOX_FILLED})".NEWPM_END."
				<p style='margin: 0'/>
				<a href='".e_PLUGIN_ABS."pm/pm.php?outbox'>".OLPM_OUTBOX_ICON."&nbsp;".ONLINEINFO_LAN_PM_26."
				<br />(
				{OUTBOX_TOTAL}&nbsp;".ONLINEINFO_LAN_PM_36.",&nbsp;{OUTBOX_UNREAD}&nbsp;".ONLINEINFO_LAN_PM_37."&nbsp;{OUTBOX_FILLED})</a>
				<br /><br />{SEND_PM_LINK}
				".ONLINEINFO_LAN_PM_35;
    }

			}

//			var_dump($pm_prefs['pm_class']);
//			var_dump(check_class($pm_prefs['pm_class']));
			if(check_class($pm_prefs['pm_class']))
			{
//				global $tp, $pm_inbox;
				global $tp;
//				$pm_inbox = $pm->pm_getInfo('inbox');
//var_dump($pm_inbox);
//echo "<hr><hr>";
//				require_once(e_PLUGIN."pm/pm_shortcodes.php");

        $pm_shortcodes = e107::getScBatch('pm',TRUE);
//var_dump ($pm_shortcodes);
				$text .= $tp->parseTemplate($pm_menu_template, TRUE, $pm_shortcodes);
				if($pm_inbox['inbox']['new'] > 0 && $pm_prefs['popup'] && strpos(e_SELF, "pm.php") === FALSE && $_COOKIE["pm-alert"] != "ON")
				{
/*
					$text .= euserpm::onlineinfo_pm_show_popup();
function onlineinfo_pm_show_popup()
			{
*/
// Old function onlineinfo_pm_show_popup()
/*--
				global $pm_inbox, $pm_prefs;
				$alertdelay = intval($pm_prefs['popup_delay']);
				if($alertdelay == 0) { $alertdalay = 60; }
				setcookie("pm-alert", "ON", time()+$alertdelay);
				$popuptext = "
				<html>
					<head>
						<title>".$pm_inbox['inbox']['new']." ".ONLINEINFO_LAN_PM_109."</title>
						<link rel=stylesheet href=" . THEME . "style.css>
					</head>
					<body style=\'padding-left:2px;padding-right:2px;padding:2px;padding-bottom:2px;margin:0px;text-align:center\' marginheight=0 marginleft=0 topmargin=0 leftmargin=0>
					<table style=\'width:100%;text-align:center;height:99%;padding-bottom:2px\' class=\'bodytable\'>
						<tr>
							<td width=100% >
								<center><b>--- ".ONLINEINFO_LAN_PM." ---</b><br />".$pm_inbox['inbox']['new']." ".ONLINEINFO_LAN_PM_109."<br />".$pm_inbox['inbox']['unread']." ".ONLINEINFO_LAN_PM_37."<br /><br />
								<form>
									<input class=\'button\' type=\'submit\' onclick=\'self.close();\' value = \'".ONLINEINFO_LAN_PM_110."\' />
								</form>
								</center>
							</td>
						</tr>
					</table>
					</body>
				</html> ";
				$popuptext = str_replace("\n", "", $popuptext);
				$popuptext = str_replace("\t", "", $popuptext);
				$text .= "
				<script type='text/javascript'>
				winl=(screen.width-200)/2;
				wint = (screen.height-100)/2;
				winProp = 'width=200,height=100,left='+winl+',top='+wint+',scrollbars=no';
				window.open('javascript:document.write(\"".$popuptext."\");', \"pm_popup\", winProp);
				</script >";
/*
				return $text;
	}
*/
/*--					
if ($euser_pref['sound']=="none" || $euser_pref['sound']==""){
  unset ($euser_pref['sound']);
}
if ($euser_pref['sound']){

						
							$checkpath = explode("/pm/",e_SELF);
	
	if($checkpath[1] != "pm.php"){
				$text.="<embed src=\"".e_PLUGIN."euser/sounds/".$euser_pref['sound']."\" autostart=\"true\" loop=\"1\" hidden=\"true\"></embed>";
				}
}
				}

			}
//echo "<hr><hr>";


//	$text .= "</td></tr></table></div></td></tr></table>";
	$text .= "</td></tr></table></div>";

// ################ DAQUI PARA CIMA ISTO TEM DE SAIR TUDO, AGORA É TUDO TRATADO PELO PLUGIN PM.... Inclusive o próprio plugin chamada é o PM...
//Este só serve se não houver plugin PM...
//---------	$text = $tp->parseTemplate('{PM_NAV}{SENDPM}', true, $EUSER_LOGIN_MENU_shortcodes);
//	return $tp->parseTemplate('{PM_NAV}{SENDPM}', true, $EUSER_LOGIN_MENU_shortcodes);
//---------	$caption = LAN_EUSER_301;	
*/
    include_once(e_PLUGIN.'pm/pm_menu.php');
    return;
    
    }
  if ((ADMIN) && !$text) {
        $mes = e107::getMessage();
        $mes->addInfo(LAN_EUSER_302); 
        $text = $mes->render();
//        return $mes->render();
  }
			
      	$ns->tablerender($caption, $text, 'euser_pm_menu');

?>