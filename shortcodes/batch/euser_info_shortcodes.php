<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     ©Steve Dunstan 2001-2002
|     http://e107.org
|     jalist@e107.org
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $Source: /cvsroot/e107/e107_0.7/e107_plugins/login_menu/login_menu_shortcodes.php,v $
|     $Revision: 1.10 $
|     $Date: 2006/11/18 22:40:54 $
|     $Author: mcfly_e107 $
+----------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
//echo "SHORTCODES CARREGADOS";
//global $tp;

//		class plugin_euser_login_menu_shortcodes extends e_shortcode
// extende o login_menu_shortcodes para utilizar também os shortcodes do login menu do core....
		class plugin_euser_euser_info_shortcodes extends e_shortcode
// Já não preciso de extender os shortcodes do login menu porque o menu é embebido com o EMBEDMENU
		{

/*
			private $use_imagecode =0;
			private $sec;
			private $usernameLabel = LAN_LOGINMENU_1;
			private $allowEmailLogin;
*/
//      private $orderList;
//########################## Temporário, assim que tudo estiver em shortcodes, fica no euser_login_menu.php
//		  private $euserlmsql;
		  private $eusersm;

			function __construct()
			{
        $this->tp = e107::getParser();
        $this->sql = e107::getDb();
		  }

// Está duplicada, também existe no user_shortcodes
/*
function sc_euser_online($parm='')
    {
  //var_dump (e107::isInstalled("pm"));
  //var_dump ($this->var['user_id'] > 0);
  //    var_dump ($this->var['user_id']);
  //    var_dump ($this->var['user_name']);
  //  	$on_name = "".$this->var['user_id'].".".$this->var['user_name']."";
      $check = $this->sql->count("online","(*)","online_user_id='".$this->var['user_id'].".".$this->var['user_name']."'");
      return "sdfdfdfsdfsf";
      return $this->tp->parseTemplate(( $check > 0 )?IMAGE_online:IMAGE_offline);
    }
*/
// Veio do eforum, renomeado
function sc_euser_forum_combo()
{
//  $tp = e107::getParser();
  $sc = e107::getScBatch('view', 'forum');
  //	$text2 = $this->sc_level('special');
  //	$text .= $this->sc_level('pic');
//  $uid = (int) $this->postInfo['post_user'];
//  $uid = (int) $sc->postInfo['post_user'];
//  $ue = $this->tp->parseTemplate("{USER_EXTENDED=location.text_value".$uid."}", true);
//  $username = (empty($this->postInfo['user_name'])) ? LAN_ANONYMOUS : $this->postInfo['user_name'];
//$username = (empty($sc->postInfo['user_name'])) ? LAN_ANONYMOUS : $sc->postInfo['user_name'];

//  $userUrl = empty($this->postInfo['post_user']) ? '#' : e107::getUrl()->create('user/profile/view', array('user_id' => $this->postInfo['post_user'], 'user_name' => $username));
//  $userUrl = empty($sc->postInfo['post_user']) ? '#' : e107::getUrl()->create('user/profile/view', array('user_id' => $sc->postInfo['post_user'], 'user_name' => $username));
  // e_HTTP.'user.php?id.'.$this->postInfo['post_user']
//  $text = '<div class="btn-group ">
//  $text = '<a href="' . $userUrl . '">' . $username . '</a>';
//  $text = '<a href="' . (empty($sc->postInfo['post_user']) ? '#' : e107::getUrl()->create('user/profile/view', array('user_id' => $sc->postInfo['post_user'], 'user_name' => $username))) . '">' . $username . '</a>';

//  $text .= "<li><a class='dropdown-item' href='#'>" . $this->sc_level('userid') . "</a></li>";
//  $text .= "<li><a class='dropdown-item' href='#'>" . $this->sc_joined() . "</a></li>";
//  $text .= "<br>" . $sc->sc_level('userid');
  if($level = $sc->sc_level('userid'))
  {
//    $text .= "<li class='dropdown-item'>" . $website . "</li>";
    $text .= "<br>".$level ;
  }
//---- Não mostro, não vale a pena  $text .= "<br><small>" . $sc->sc_joined() ."</small>";
//  if($ue)
//  {
//    $text .= "<li><a class='dropdown-item' hre='#'>" . $ue . "</a></li>";
//    $text .= $this->tp->parseTemplate("{USER_EXTENDED=location.text_value".(int) $sc->postInfo['post_user']."}", true)??"";
    $text .= $this->tp->parseTemplate("{USER_EXTENDED=location.text_value".(int) $sc->postInfo['post_user']."}");
//  }
//  $text .= "<li><a class='dropdown-item' href='#'>" . $this->sc_posts() . "</a></li>";
//  $text .= "<a href='#'>" . $sc->sc_posts() . "</a>";
//  $text .= $this->sc_eforum_postsuser();

//  if(e107::isInstalled('pm') && ($this->postInfo['post_user'] > 0))
/*
  if(e107::isInstalled('pm') && ($sc->postInfo['post_user'] > 0))
  {
//    if($pmButton = $this->tp->parseTemplate("{SENDPM: user=" . $this->postInfo['post_user'] . "&glyph=envelope&class=pm-send}", true))
//    if($pmButton = $this->tp->parseTemplate("{SENDPM: user=" . $sc->postInfo['post_user'] . "&glyph=envelope&class=btn pm-send}", true))
//    {
//      $text .= "<li class='divider'><hr class='dropdown-divider'></li>";
//      $text .= "<li class='dropdown-item'>" . $pmButton . "</li>";
        $text .= "{SENDPM: user=" . $sc->postInfo['post_user'] . "&glyph=envelope&class=btn pm-send}";
//    }

    // $text .= "<li><a href='".e_PLUGIN_ABS."pm/pm.php?send.{$this->postInfo['post_user']}'>".$tp->toGlyph('envelope')." ".LAN_FORUM_2036." </a></li>";
  }
*/
//  $text .= $this->sc_eforum_pmuser();

//  if($website = $this->sc_website())
/*
  if($website = $sc->sc_website())
  {
//    $text .= "<li class='dropdown-item'>" . $website . "</li>";
    $text .= $website ;
  }
*/
//    $text .= "<li class='dropdown-item'>" . $website . "</li>";
    $text .= $sc->sc_website()??null;

//	{EMAILIMG}
//	{WEBSITEIMG}

//  $text .= "</ul></div>";
///  $text = "#####################";
//return $this->tp->parseTemplate($text);
return $text;
}

}