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
		class plugin_euser_member_shortcodes extends e_shortcode
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

		}

	function sc_euser_member_image($parm=null)
	{
//var_dump (plugin_euser_online_menu_shortcodes::$currentMember);
//var_dump (parent::$currentMember);

		if(is_string($parm))
		{
			$parm= array('type'=> $parm);
		}

		if($parm['type'] == 'avatar')
		{
			$userData = array(
				'user_image' => $this->currentMember['oimage'],
				'user_name'	=> $this->currentMember['oname']
			);

			return e107::getParser()->toAvatar($userData, $parm);
			
		//	return e107::getParser()->parseTemplate("{USER_AVATAR=".$this->currentMember['oimage']."}",true);	
		}
		
		return "<img src='".e_IMAGE_ABS."admin_images/users_16.png' alt='' style='vertical-align:middle' />";
	}

	function sc_euser_member()
	{
		//return "<a href='".e_HTTP."user.php?id.{$this->currentMember['oid']}'>{$this->currentMember['oname']}</a>";

		$uparams = array('id' => $this->currentMember['oid'], 'name' => $this->currentMember['oname']);
		$link = e107::getUrl()->create('user/profile/view', $uparams);

		return "<a href='".$link."'>".$this->currentMember['oname']."</a>";
	}


	function sc_euser_member_page()
	{
		if(empty($this->currentMember['page']))
		{
			return null;
		}

		global $ADMIN_DIRECTORY;
		return (!strstr($this->currentMember['pinfo'], $ADMIN_DIRECTORY) ? "<a href='".$this->currentMember['pinfo']."'>".$this->currentMember['page']."</a>" : $this->currentMember['page']);
	}


}
?>