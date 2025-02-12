<?php
// Esta treta dos menus activos não funciona, não sei porquê....
//var_dump ($eMenuActive);
//echo "----------------------";
//e107::getMessage()->addError(var_dump ($eMenuActive), 'default', true);

/*
+---------------------------------------------------------------+
| Another Profiles Plugin v0.9.6
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
//var_dump (defined('e107_INIT'));
if (!defined('e107_INIT') || !e107::isInstalled('euser')) { exit; }

$euser_pref = e107::getPlugPref('euser');
//var_dump ($euser_pref);
//if ($euser_pref['plug_installed']['euser']) {
//  if ($euser_pref['redirect_usersettings'] == "Yes" && e_PAGE == "usersettings.php" && e_QUERY != "update") {
/*
var_dump (e107::getPlugPref('euser','redirect_usersettings'));
var_dump (e107::getPlugPref('euser','redirect'));
var_dump (e_PAGE);
var_dump (e_PAGE == "user.php");
  var_dump(e107::getPlugPref('euser','redirect_usersettings') && e_PAGE == "usersettings.php" && e_QUERY != "update");
  var_dump(e107::getPlugPref('euser','redirect_usersettings') && e_PAGE == "user.php");
  var_dump(USER && e107::getPlugPref('euser','redirect_usersettings') && e107::getPlugPref('euser','redirect') && e_PAGE != "euser_settings.php" && e_QUERY != "update");
*/
//exit;
//var_dump(check_class($euser_pref['allowguests']));
//var_dump(check_class($euser_pref['memberlist_accept']));

//  if ($euser_pref['redirect_usersettings'] && e_PAGE == "usersettings.php" && e_QUERY != "update") {
  if (check_class($euser_pref['memberprofile_edit']) && e_PAGE == "usersettings.php" && e_QUERY != "update") {
//  if (e107::getPlugPref('euser','redirect_usersettings') && e_PAGE == "usersettings.php" && e_QUERY != "update") {
  $_uid = is_numeric(e_QUERY) ? intval(e_QUERY) : "";
	if ($_uid != '') {
    e107::redirect(e_PLUGIN."euser/euser_settings.php?uid=".$_uid);
//				header("Location: ".e_PLUGIN."euser/euser_settings.php?uid=".$_uid."");
	} else {
    e107::redirect(e_PLUGIN."euser/euser_settings.php?page=settings");
//		header("Location: ".e_PLUGIN."euser/euser_settings.php?page=settings");
	}
  }

//  if ($euser_pref['redirect_usersettings'] && e_PAGE == "user.php") {
//  var_dump (e_QUERY);
  if (check_class($euser_pref['memberprofile_view']) && e_PAGE == "user.php" && e_QUERY) {
//  if (e107::getPlugPref('euser','redirect_usersettings') && e_PAGE == "user.php") {
// Para quê reinventar a roda e transformar isto para um $GET?????
/*
	$url = $_SERVER["REQUEST_URI"];
	$user = explode(".", $url);
	$counter=0;
	foreach($user as $string) {
		$counter++;
		if ($string == 'php?id') {
			$uid = $user[$counter];
			header("Location: ".e_PLUGIN."euser/euser.php?id=".$uid."");
			$lnk=true;
			break;
		}
	}
*/
//var_dump("aqui");
//exit;
    e107::redirect(e_PLUGIN."euser/euser.php?".e_QUERY);

// Para que é isto????
  }

//   var_dump($euser_pref['memberlist_access']);
//   var_dump(e_PAGE == "user.php");
//   var_dump(!e_QUERY);
   if ($euser_pref['memberlist_access'] && e_PAGE == "user.php" && !e_QUERY) {
//   if (e107::getPlugPref('euser','memberlist') == "Yes" && !$lnk) {
    e107::redirect(e_PLUGIN."euser/euser_memberlist.php");
//		header("Location: ".e_PLUGIN."euser/euser.php");
	}

  // Check if new user and then redirect and prompt them to fill in profile info.
//  if (USER && e107::getPlugPref('euser','redirect_usersettings') && e107::getPlugPref('euser','redirect') && e_PAGE != "euser_settings.php" && e_QUERY != "update") {
// ISTO POR ENQUANTO FICA DESLIGADO SENÃO APARECE EM TODAS AS PÁGINAS...
/*
  if (USER && $euser_pref['redirect_usersettings'] && $euser_pref['redirect'] && e_PAGE != "euser_settings.php" && e_QUERY != "update") {
	$sql -> db_Select("euser", "*", "user_id='".USERID."'");
	$count = $sql -> db_Rows();
		if ($count == 0) {
			header("Location: ".e_PLUGIN."euser/euser_settings.php?first");
		}
  }
*/
  if (e_PAGE == "users.php") {
	if ($_POST['useraction'] == "deluser") {
    e107::redirect(e_PLUGIN."euser/admin_menu.php?page=deluser&deluser_id=".intval($_POST['userid']));
//		header("Location: ".e_PLUGIN."euser/admin_menu.php?page=deluser&deluser_id=".intval($_POST['userid'])."");
	} else if (varset($_POST['useraction'])) {
		foreach ($_POST['useraction'] as $key => $val) {
			if ($val) {
				$_POST['useraction'] = $val;
				$_POST['userid'] = $key;
				break;
			}
		}
/*
		if ($_POST['useraction'] == "deluser") {
    e107::redirect(e_PLUGIN."euser/admin_menu.php?page=deluser&deluser_id=".intval($_POST['userid']));
//			header("Location: ".e_PLUGIN."euser/admin_menu.php?page=deluser&deluser_id=".intval($_POST['userid'])."");
		}
*/
	}
  }
//}
?>