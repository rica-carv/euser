<?php
if (!defined('e107_INIT')) { exit; }

if (!e107::isInstalled('phil_lis'))
{
	e107::redirect();
	exit;
}

if(check_class($euser_pref['showregusers'])){


// O tipo de menu passa a ser definido no pr�prio template... isto tem de sair daqui, para um shortcode, por exemplo... ou com uma constante definida no pr�prio template...
    if ($euser_pref['loginmenutype']!=0){
if ($euser_pref['hideregusers'] == 1)
{

$menu_text .= "<div id='regu-title' style='cursor:hand; text-align:left; font-size: ".$onlineinfomenufsize."px; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".EUSER_LOGIN_MENU_L79."'>&nbsp;".EUSER_LOGIN_MENU_L79."</div>";
	$menu_text .= "<div id='regu' class='switchgroup1' style='display:none;'>";
  
}else{

	$menu_text .= "<div>";
}
  }

// Remove from total banned users.....
//    $total_members = $sql->db_Count("user");
$total_members = $sql->db_Count("user","(*)", "WHERE user_ban = 0");
    if ($total_members > 1)
    {
        $newest_member = $sql->db_Select("user", "user_id, user_name", "ORDER BY user_join DESC LIMIT 0,1", "no_where");
        $row = $sql->db_Fetch();
        extract($row);

// O tipo de menu passa a ser definido no pr�prio template... isto tem de sair daqui, para um shortcode, por exemplo... ou com uma constante definida no pr�prio template...
    if ($euser_pref['loginmenutype']==0){
    $menu_text .= "<br><a title='".ONLINE_EL5.$total_members.ONLINE_EL10."' href='".e_BASE."user.php'><img src='".e_PLUGIN."euser/images/members".($euser_pref['loginmenutype']==0?"_24":"").".png' style='border:0; vertical-align: middle'/>&nbsp;".$total_members."</a>&nbsp;&nbsp;
      <a title='".ONLINE_EL6.": ".$user_name."' href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id)."><img src='".e_PLUGIN."euser/images/member_recent".($euser_pref['loginmenutype']==0?"_24":"").".png' style='border:0; vertical-align: middle'/></a>&nbsp;&nbsp;";

    } else {
    $menu_text .= "<div class='smallblacktext' style='margin-left:5px; width:".$onlineinfomenuwidth."'>" . ONLINE_EL5 . $total_members . ONLINE_EL10 . "</div>
           	<div style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'>".ONLINE_EL6.": <a href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".$user_name."</a></div>";
    }
    }


//$menu_text.="<br />";


}
?>