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

		require_once(e_PLUGIN."login_menu/login_menu_shortcodes.php"); // don't use 'require_once'.
include_once(e_PLUGIN.'euser/euser_class.php');

//var_dump($parm);
//$menu_pref 	= e107::getConfig('menu')->getPref();
//var_dump($menu_pref);
//		class plugin_euser_login_menu_shortcodes extends e_shortcode
// extende o login_menu_shortcodes para utilizar também os shortcodes do login menu do core....
		class plugin_euser_dashboard_menu_shortcodes extends login_menu_shortcodes
// Preciso de extender os shortcodes do login menu de qualquer das formas...
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
//		  private $euserlm;

			function __construct()
			{
/*
				$this->euserlm = function($what) {
//          var_dump (getcachedvars('orderList'));
      		$orderList = getcachedvars('orderList');
          $orderclass = $orderList[$what]['class'];
//          var_dump ($orderclass);
          include (e_PLUGIN."euser/includes/".$what);
//            var_dump ($text);
//            echo "<hr>";
          return $text;
        };
*/
/*
				$pref = e107::getPref();

				$this->use_imagecode = e107::getConfig()->get('logcode');
				$this->sec = e107::getSecureImg();
				$this->usernameLabel = '';
				$this->allowEmailLogin = $pref['allowEmailLogin'];
//########################## Temporário, assim que tudo estiver em shortcodes, fica no euser_login_menu.php
  		  $this->euserlmsql = new db;

				if($pref['allowEmailLogin']==1)
				{
					$this->usernameLabel = LAN_LOGINMENU_49;
				}

				if($pref['allowEmailLogin']==2)
				{
					$this->usernameLabel = LAN_LOGINMENU_50;
				}
*/

//########################## Temporário, assim que tudo estiver em shortcodes, fica no euser_login_menu.php
//		$ordersql=new db;
/*
    $script="SELECT * FROM ".MPREFIX."euser_cache Where type='order' ORDER BY type_order";
		$onlineinfoorder = $this->euserlmsql->db_Select_gen($script);
		while ($orderrow = $this->euserlmsql->db_Fetch()){
      $this->orderList[$orderrow['cache']] = array('hide' => $orderrow['cache_hide'], 'class' => $orderrow['cache_userclass']);
    }
*/

 				$this->sql = e107::getDb(); 
// Só preciso disto no avatar				$this->tp = e107::getParser();
//        $this->euser_pref = e107::getPlugPref('euser');
//        $this->parm = ($this->parm?:e107::getPlugPref('euser'));
//        var_dump ($this->var);
	    }

/*
		function sc_elm_caption($parm=''){
//var_dump (USERNAME);
return LAN_LOGINMENU_5.' '.(USER?USERNAME:LAN_EUSER_0046);
}
*/

			function sc_eam_seticons($parm=''){
          $this->icons = $parm;
      }

			function sc_eam_avatar($parm='')
			{
//        var_dump ($this->var);
//global $this->tp, $this->sql;
//$this->euser_pref = e107::getPlugPref('euser');

//var_dump ($orderclass);
//if(check_class($orderclass))
//{

//########################## Temporário, assim que tudo estiver em shortcodes, esta variável vem do euser_login_menu.php
//var_dump ($orderList['euser_lm_avatar.php']['hide'] == 1);
// A variável $orderlist não existe aqui no shortcode.... pufff... isto é para desaparecer???
/*
if ($orderList['euser_lm_avatar.php']['hide'] == 1)
    {

    $text = '<div id="avatar-title" style="cursor:hand; text-align:left; font-size: '.$onlineinfomenufsize.'px; vertical-align: middle; width:'.$onlineinfomenuwidth.'; font-weight:bold;" title="'.LAN_EUSER_0080.'">&nbsp;'.LAN_EUSER_0080.'</div>
	<div id="avatar" class="switchgroup1" style="display:none; margin-left:2px;">';

}else{
//---> ANTIGO, PARA O MENU NORMAL->   	$text .= '<div style="float:left;">';
	$text .= '';

}
*/

//unset($avatardata);
//unset($avatarimage);
	
/*
		$this->sql = new db;
		if($this->sql -> db_Select("user", "*", "user_id='".USERID."'")){
			$row = $this->sql -> db_Fetch();
			if($row[user_image] == '') {
				$user_image = e_PLUGIN.'euser/images/default.png';
////				$avatarimage .= '<img src="'.$user_image.'" width="100" alt="" />';
			}else{
				$user_image = $row[user_image];
				require_once(e_HANDLER.'avatar_handler.php');
				$user_image = avatar($user_image);
////				$avatarimage .= '<img src="'.$user_image.'" width="100" alt="" />';
			}
*/
/*				$avatarimage .= '<img src="'.$user_image.'" width="100" alt="" />';

			$avatarimage .= '<br><img src="'.$bulletimage.'" alt="bullet" /> <a href="'.e_BASE.'usersettings.php">'.LAN_EUSER_0012.'</a><br /><img src="'.$bulletimage.'" alt="bullet" /> <a href="'.e_BASE.'user.php?id.'.USERID.'">'.LAN_EUSER_0013.'</a><br /><br /><img src="'.$bulletimage.'" alt="bullet" /> <a href="'.e_BASE.'index.php?logout">'.LAN_EUSER_008.'</a>';
*/

// TENHO DE FORÇAR O AVATAR A USAR O USERID, SENÃO MOSTRA-ME O AVATAR DO ID 1
//$avatarimage .= $this->tp->parseTemplate( '<a href="'.e_BASE.'user.php?id.'.USERID.'" title="'.USERNAME.' - '.LAN_EUSER_0013.'">{USER_AVATAR='.USERID.'}</a>', TRUE);
/*
$user_shortcodes = e107::getScBatch('user');
//Isto vai buscar ao core e permite deixar de usar os defines USERID e USERNAME....
//e107::getScBatch('user')->setVars($user);
$doc = DOMDocument::loadHTML($this->tp->parseTemplate('<a href="'.e_BASE.'user.php?id.'.USERID.'" title="'.USERNAME.' - '.LAN_EUSER_0013.'">{USER_PICTURE}</a>', TRUE, $user_shortcodes));
//$image = $doc->getElementsByTagName('img');
foreach($doc->getElementsByTagName('img') as $image){
//    foreach(array('width', 'height') as $attribute_to_remove){
        if($image->hasAttribute('title')){
            $image->removeAttribute('title');
        }
//    }
}
$avatarimage .= $doc->saveHTML();
*/
//        var_dump($this->euser_pref['turnoffavatar']==0);
//var_dump($this->euser_pref['avatar']);
//var_dump($fields['avatar']);
//var_dump($this->var['avatar']);
//if ($this->euser_pref['avatar']==1){
				$tp = e107::getParser();

//var_dump ($this->var['avatar']);
if ($this->var['avatar']){
//$avatar = $this->tp->parseTemplate('<a href="'.$this->sc_lm_profile_href().'" title="'.USERNAME.' - '.LAN_EUSER_0013.'">{USER_AVATAR}</a>',true);
//$avatar = $this->tp->parseTemplate('{USER_AVATAR}',true);
$avatar = $tp->parseTemplate('{USER_AVATAR}',true);


/////			$avatarimage .= '<a href="'.e_BASE.'usersettings.php">{USER_AVATAR}<img src="'.$user_image.'" width="100" title="'.LAN_EUSER_0012.'" alt="'.LAN_EUSER_0012.'" /></a>';
//			$avatarimage .= '<a href="'.e_BASE.'user.php?id.'.USERID.'"><img src="'.$user_image.'" width="100" title="'.LAN_EUSER_0013.'" alt="'.LAN_EUSER_0013.'" /></a><br><a href="'.e_BASE.'usersettings.php">'.LAN_EUSER_0012.'</a>';
      
//      $avatarimage .= '<br /><br /><img src="'.$bulletimage.'" alt="bullet" /> <a href="'.e_BASE.'index.php?logout">'.LAN_EUSER_008.'</a>';

		

}else{
/*
			if(ADMIN == TRUE){
				$adminfpage = (!$this->euser_pref["adminstyle"] || $this->euser_pref["adminstyle"] == 'default' ? 'admin.php' : $this->euser_pref["adminstyle"].'.php');				
				$avatar .= ($this->euser_pref["maintenance_flag"]==1 ? '<div style="text-align:center"><b>'.LAN_EUSER_0010.'</div></b><br />' : '' );
//				$avatar .= '<img src="'.$bulletimage.'" alt="bullet" />&nbsp;<a href="'.e_ADMIN.$adminfpage.'">'.LAN_EUSER_0011.'</a><br />';
				$avatar .= '<a href="'.e_ADMIN.$adminfpage.'">'.LAN_EUSER_0011.'</a><br /><br/>';
			}
*/
			




/////// ############### ESTE BIKEPLUGIN PODE SER FEITO PARA O LISTAS.....
/*
				$sql3 = new db;
						$bikeplugin = $sql3->db_Count("plugin", "(*)", "WHERE plugin_name='My Bike' and plugin_installflag='1'");

					  if ($bikeplugin)
				      {
						
//						$avatar.='<img src="'.$bulletimage.'" alt="bullet" /> <a href="'.e_PLUGIN.'bikes/bike.php?id.'.USERID.'">'.ONLINEINFO_LIST_BIKE1.'</a><br />';
						$avatar.='<a href="'.e_PLUGIN.'bikes/bike.php?id.'.USERID.'">'.ONLINEINFO_LIST_BIKE1.'</a><br />';
						
					}
*/					
					
			// Add in look for Delete Me Plugin
if ($this->var['deleteme'] && e107::isInstalled('deleteme'))
// TODO: Adicionar verificação se o plugin está instalado
//			if ($this->euser_pref['deleteme']==1)
				      {
//			$avatar.='<img src="'.$bulletimage.'" alt="bullet" /> <a href="'.e_PLUGIN.'deleteme/deleteme.php">'.LAN_EUSER_0093.'</a><br />';
			$avatar.='<a href="'.e_PLUGIN.'deleteme/deleteme.php">'.LAN_EUSER_0093.'</a><br />';
			}
			
//			$avatar .= '<img src="'.$bulletimage.'" alt="bullet" /> <a href="'.e_BASE.'usersettings.php">'.LAN_EUSER_0012.'</a><br /><img src="'.$bulletimage.'" alt="bullet" /> <a href="'.e_BASE.'user.php?id.'.USERID.'">'.LAN_EUSER_0013.'</a><br /><br /><img src="'.$bulletimage.'" alt="bullet" /> <a href="'.e_BASE.'index.php?logout">'.LAN_EUSER_008.'</a>';
  	$memberTemplate = e107::getTemplate('euser', 'member');
			$avatar .= $tp->parseTemplate($memberTemplate['noavatar']);
//			$avatar .= '<a href="'.e_BASE.'user.php?id.'.USERID.'">'.IMAGE_user.'</a>';
//			$avatar .= '<a href="'.e_BASE.'usersettings.php">'.LAN_EUSER_0012.'</a><br /><a href="'.e_BASE.'user.php?id.'.USERID.'">'.LAN_EUSER_0013.'</a><br /><br /><a href="'.e_BASE.'index.php?logout">'.LAN_EUSER_008.'</a>';
/*
// APAGAR ALGO QUE NÃO EXISTE?????
			if(!$this->sql -> db_Select("online", "*", "online_ip='".$ip."' AND online_user_id='0' ")){
				$this->sql -> db_Delete("online", "online_ip='".$ip."' AND online_user_id='0' ");
			}
*/
}
//		$new_total = 0;
//		$time = USERLV;
//
		
		
/* ANTIGO, PARA O MENU NORMAL
  	$text .='<table id="usermenu" style="width:'.$onlineinfomenuwidth.'">
		<tr>
		<td style="width:120px; text-align: center;vertical-align:middle;">';
*/		
//		if($this->euser_pref['turnoffavatar']==0){
//		$text.=(($this->euser_pref['turnoffavatar']==0)?$avatarimage:$avatar);

//    		$text.="EUSER_LM_AVATAR ANTIGO - APAGAR";
//        return call_user_func($this ->euserlm, "avatar.php");
        return $avatar;
			}

/*
			function sc_eam_pm($parm='')
			{
}
*/
// Shortcode ou constant???
/*
			function sc_eam_admin_icon($parm='')
			{
//        var_dump ($this->var['admin_counter']);
// O $admin_counter só conta depois de incluir o extrainfo_updated.php através do euser_online_menu.php....
// Possivelmente este shortcode tem de passar para dentro do euser_online_menu.php.....
				if(ADMIN == TRUE) {
//					return '<div class="btn-group btn-group-xs"><a class="login_menu_link admin btn btn-primary" id="login_menu_link_admin" href="'.$this->sc_lm_adminlink('href').'">'.IMAGE_admin.'<span class="badge">'.$this->var['admin_counter'].'</span></a></div>';
					return IMAGE_admin;
				}
				return '';
			}
			function sc_eam_admin_count($parm='')
			{
//        var_dump ($this->var['admin_counter']);
// O $admin_counter só conta depois de incluir o extrainfo_updated.php através do euser_online_menu.php....
// Possivelmente este shortcode tem de passar para dentro do euser_online_menu.php.....
				if(ADMIN == TRUE) {
//					return '<div class="btn-group btn-group-xs"><a class="login_menu_link admin btn btn-primary" id="login_menu_link_admin" href="'.$this->sc_lm_adminlink('href').'">'.IMAGE_admin.'<span class="badge">'.$this->var['admin_counter'].'</span></a></div>';
					return ($this->var['admin_counter']?:'');
				}
				return '';
			}
*/
/*
			function sc_elm_online($parm='')
			{
        return call_user_func($this ->euserlm, "currentlyonline.php");
			}
*/
/*
			function sc_elm_fc($parm='')
			{
        return call_user_func($this ->euserlm, "fc.php");
      }
*/
/*
			function sc_elm_friends($parm='')
			{
        return call_user_func($this ->euserlm, "friends.php");
      }
*/
/*
			function sc_elm_extrainfo($parm='')
			{
        return call_user_func($this ->euserlm, "extrainfo.php");
      }

			function sc_elm_tmembers($parm='')
			{
        return call_user_func($this ->euserlm, "tmembers.php");
      }
*/
/*
function sc_elm_coreloginmenu($parm=null){
return $this->originalmenutext;
}
*/

// Colorkey passou para o e_shortcode

// ################## Shortcodes em princípio não utilizados, pois vai ser utilizado o por defeito do login menu do core.
/*
			function sc_lm_username_input($parm='')
			{
				$pref = e107::getPref();

				// If logging in with email address - ignore pref and increase to 100 chars.
				$maxLength  = ($this->allowEmailLogin == 1 || $this->allowEmailLogin) ? 100 : varset($pref['loginname_maxlength'],30);

				return "<input class='form-control tbox login user' type='text' name='username' placeholder='".$this->usernameLabel."' required='required' id='username' size='15' value='' maxlength='".$maxLength."' />\n";
			}


			function sc_lm_username_label($parm='')
			{
				return $this->usernameLabel;
			}


			function sc_lm_password_input($parm='')
			{
				$pref = e107::getPref();
				$t_password = "<input class='form-control tbox login pass' type='password' placeholder='".LAN_PASSWORD."' required='required' name='userpass' id='userpass' size='15' value='' maxlength='30' />\n";
				if (!USER && e107::getSession()->is('challenge') && varset($pref['password_CHAP'],0)) $t_password .= "<input type='hidden' name='hashchallenge' id='hashchallenge' value='".e107::getSession()->get('challenge')."' />\n\n";
				return $t_password;
			}


			function sc_lm_password_label($parm='')
			{
				return LAN_LOGINMENU_2;
			}


			function sc_lm_imagecode($parm='')
			{
				//DEPRECATED - use LM_IMAGECODE_NUMBER, LM_IMAGECODE_BOX instead
				if($this->use_imagecode)
				{
				    return '<input type="hidden" name="rand_num" id="rand_num" value="'.$this->sec->random_number.'" />
				            '.$this->sec->r_image().'
				            <br /><input class="tbox login verify" type="text" name="code_verify" id="code_verify" size="15" maxlength="20" /><br />';
				}
				return '';
			}


			function sc_lm_imagecode_number($parm='')
			{
				if($this->use_imagecode)
				{
				    return '<input type="hidden" name="rand_num" id="rand_num" value="'.$this->sec->random_number.'" />
				        '.$this->sec->r_image();
				}
				return '';
			}

			function sc_lm_imagecode_box($parm='')
			{
				$placeholder = LAN_ENTER_CODE;

				if($this->use_imagecode)
				{
				    return '<input class="form-control tbox login verify" type="text" name="code_verify" id="code_verify" size="15" maxlength="20" placeholder="'.$placeholder.'" />';
				}
				return '';
			}

			function sc_lm_loginbutton($parm='')
			{
				return "<input class='button btn btn-default login' type='submit' name='userlogin' id='userlogin' value='".LAN_LOGIN."' />";
			}

			function sc_lm_rememberme($parm='')
			{
				$pref = e107::getPref();
				if($parm == "hidden"){
					return "<input type='hidden' name='autologin' id='autologin' value='1' />";
				}
				if($pref['user_tracking'] != "session")
				{
					return "<label for='autologin'><input type='checkbox' name='autologin' id='autologin' value='1' checked='checked' />".($parm ? $parm : "".LAN_LOGINMENU_6."</label>");
				}
				return '';
			}

			function sc_lm_signup_link($parm='')
			{
				$pref = e107::getPref();
				if (intval($pref['user_reg'])===1)
				{
					if (!$pref['auth_method'] || $pref['auth_method'] == 'e107')
					{
						return $parm == 'href' ? e_SIGNUP : "<a class='login_menu_link signup' id='login_menu_link_signup' href='".e_SIGNUP."' title=\"".LAN_LOGINMENU_3."\">".LAN_LOGINMENU_3."</a>";
					}
				}
				return '';
			}

			function sc_lm_fpw_link($parm='')
			{
				$pref = e107::getPref();
				if (!$pref['auth_method'] || $pref['auth_method'] == 'e107')
				{
					return $parm == 'href' ? SITEURL.'fpw.php' : "<a class='login_menu_link fpw' id='login_menu_link_fpw' href='".SITEURL."fpw.php' title=\"".LAN_LOGINMENU_4."\">".LAN_LOGINMENU_4."</a>";
				}
				return '';
			}

			function sc_lm_resend_link($parm='')
			{
				$pref = e107::getPref();

				if (intval($pref['user_reg'])===1)
				{
					if(isset($pref['user_reg_veri']) && $pref['user_reg_veri'] == 1)
					{
						if (!$pref['auth_method'] || $pref['auth_method'] == 'e107' )
						{
							return $parm == 'href' ? e_SIGNUP.'?resend' : "<a class='login_menu_link resend' id='login_menu_link_resend' href='".e_SIGNUP."?resend' title=\"".LAN_LOGINMENU_40."\">".LAN_LOGINMENU_40."</a>";
						}
					}
				}
				return '';
			}
*/




// Shortcodes pós login...
/*
			function sc_lm_maintenance($parm='')
			{
				$pref = e107::getPref();

				if(ADMIN && varset($pref['maintainance_flag']))
				{
					return LAN_LOGINMENU_10;
				}
				return '';
			}

			function sc_lm_adminlink_bullet($parm='')
			{
				if(ADMIN)
				{
					$data = getcachedvars('login_menu_data');
					return $parm == 'src' ? $data['link_bullet_src'] : $data['link_bullet'];
				}
				return '';
			}

			function sc_lm_adminlink($parm='')
			{
				if(ADMIN == TRUE) {
					return $parm == 'href' ? e_ADMIN_ABS.'admin.php' : '<a class="login_menu_link admin" id="login_menu_link_admin" href="'.e_ADMIN_ABS.'admin.php">'.LAN_LOGINMENU_11.'</a>';
				}
				return '';
			}

			function sc_lm_admin_configure($parm='')
			{
			if(ADMIN == TRUE) {
				return $parm == 'href' ? e_PLUGIN_ABS.'login_menu/config.php' : '<a class="login_menu_link config" id="login_menu_link_config" href="'.e_PLUGIN_ABS.'login_menu/config.php">'.LAN_LOGINMENU_48.'</a>';
			}
			return '';
			}

			function sc_lm_bullet($parm='')
			{
			$data = getcachedvars('login_menu_data');
			return $parm == 'src' ? $data['link_bullet_src'] : $data['link_bullet'];
			}

			function sc_lm_usersettings($parm='')
			{
				$text = ($parm) ? $parm : LAN_SETTINGS;
				$url = $this->sc_lm_usersettings_href();
				return '<a class="login_menu_link usersettings" id="login_menu_link_usersettings" href="'.$url.'">'.$text.'</a>';
			}

			function sc_lm_usersettings_href($parm='')
			{
				return e107::getUrl()->create('user/myprofile/edit',array('id'=>USERID));
			// return e_HTTP.'usersettings.php';
			}

			function sc_lm_profile($parm='')
			{
				$text = ($parm) ? $parm : LAN_LOGINMENU_13;
				$url = $this->sc_lm_profile_href();
				return '<a class="login_menu_link profile" id="login_menu_link_profile" href="'.$url.'">'.$text.'</a>';
			}

			function sc_lm_profile_href($parm='')
			{
				return e107::getUrl()->create('user/profile/view',array('user_id'=>USERID, 'user_name'=>USERNAME));
				// return e_HTTP.'user.php?id.'.USERID;
			}

			function sc_lm_logout($parm='')
			{
			$text = ($parm) ? $parm : LAN_LOGOUT;
			return '<a class="login_menu_link logout" id="login_menu_link_logout" href="'.e_HTTP.'index.php?logout">'.$text.'</a>';
			}

			function sc_lm_logout_href($parm='')
			{
			return e_HTTP.'index.php?logout';
			}

			function sc_lm_external_links($parm='')
			{
				global $menu_pref, $EUSER_LOGIN_MENU_shortcodes, $EUSER_LOGIN_MENU_EXTERNAL_LINK;

				$this->tp = e107::getParser();

				if(!vartrue($menu_pref['login_menu']['external_links'])) return '';
				$lbox_infos = login_menu_class::parse_external_list(true, false);
				$lbox_active = $menu_pref['login_menu']['external_links'] ? explode(',', $menu_pref['login_menu']['external_links']) : array();
				if(!vartrue($lbox_infos['links'])) return '';
				$ret = '';
				foreach ($lbox_active as $stackid) {
				    $lbox_items = login_menu_class::clean_links(varset($lbox_infos['links'][$stackid]));
				    if(!$lbox_items) continue;
				    foreach ($lbox_items as $num=>$lbox_item) {
				        $lbox_item['link_id'] = $stackid.'_'.$num;
				        cachevars('login_menu_linkdata', $lbox_item);
				        $ret .= $this->tp -> parseTemplate($EUSER_LOGIN_MENU_EXTERNAL_LINK, false, $EUSER_LOGIN_MENU_shortcodes);
				    }
				}
				return $ret;
			}

			function sc_lm_external_link($parm='')
			{
				$lbox_item = getcachedvars('login_menu_linkdata');
				return $parm == 'href' ? $lbox_item['link_url'] : '<a href="'.$lbox_item['link_url'].'" class="login_menu_link external" id="login_menu_link_external_'.$lbox_item['link_id'].'">'.vartrue($lbox_item['link_label'], '['.LAN_LOGINMENU_44.']').'</a>';
			}

			function sc_lm_external_link_label($parm='')
			{
				$lbox_item = getcachedvars('login_menu_linkdata');
				return vartrue($lbox_item['link_label'], '['.LAN_LOGINMENU_44.']');
			}

			function sc_lm_stats($parm='')
			{
				$this->tp = e107::getParser();
				global $EUSER_LOGIN_MENU_STATS;
				$data = getcachedvars('login_menu_data');
				if(!$data['enable_stats']) return '';
				return $this->tp -> parseTemplate($EUSER_LOGIN_MENU_STATS, true, $this);
			}

			function sc_lm_new_news($parm='')
			{
				$this->tp = e107::getParser();
				global $EUSER_LOGIN_MENU_STATITEM;
				$data = getcachedvars('login_menu_data');
				if(!isset($data['new_news'])) return '';
				$tmp = array();
				if($data['new_news']){
					$tmp['LM_STAT_NEW']   = $data['new_news'];
					$tmp['LM_STAT_LABEL'] = $data['new_news'] == 1 ? LAN_LOGINMENU_14 : LAN_LOGINMENU_15;
					$tmp['LM_STAT_EMPTY'] = '';
				} else {
					$tmp['LM_STAT_NEW'] = '';
					$tmp['LM_STAT_LABEL'] = '';
					$tmp['LM_STAT_EMPTY'] = LAN_LOGINMENU_26." ".LAN_LOGINMENU_15;
				}
				return $this->tp -> parseTemplate($EUSER_LOGIN_MENU_STATITEM, false, $tmp);
			}

			function sc_lm_new_comments($parm='')
			{
				global $EUSER_LOGIN_MENU_STATITEM, $this->tp;
				$data = getcachedvars('login_menu_data');
				if(!isset($data['new_comments'])) return '';
				$tmp = array();
				if($data['new_comments']){
					$tmp['LM_STAT_NEW']   = $data['new_comments'];
					$tmp['LM_STAT_LABEL'] = $data['new_comments'] == 1 ? LAN_LOGINMENU_18 : LAN_LOGINMENU_19;
					$tmp['LM_STAT_EMPTY'] = '';
				} else {
					$tmp['LM_STAT_NEW']   = '';
					$tmp['LM_STAT_LABEL'] = '';
					$tmp['LM_STAT_EMPTY'] = LAN_LOGINMENU_26." ".LAN_LOGINMENU_19;
				}
				return $this->tp -> parseTemplate($EUSER_LOGIN_MENU_STATITEM, false, $tmp);
			}

			function sc_lm_new_users($parm='')
			{
				global $EUSER_LOGIN_MENU_STATITEM, $this->tp;
				$data = getcachedvars('login_menu_data');
				if(!isset($data['new_users'])) return '';
				$tmp = array();
				if($data['new_users']){
					$tmp['LM_STAT_NEW']   = $data['new_users'];
					$tmp['LM_STAT_LABEL'] = $data['new_users'] == 1 ? LAN_LOGINMENU_22 : LAN_LOGINMENU_23;
					$tmp['LM_STAT_EMPTY'] = '';
				} else {
					$tmp['LM_STAT_NEW']   = '';
					$tmp['LM_STAT_LABEL'] = '';
					$tmp['LM_STAT_EMPTY'] = LAN_LOGINMENU_26." ".LAN_LOGINMENU_23;
				}
				return $this->tp -> parseTemplate($EUSER_LOGIN_MENU_STATITEM, false, $tmp);
			}

			function sc_lm_plugin_stats($parm='')
			{
				global $this->tp, $menu_pref, $new_total, $EUSER_LOGIN_MENU_STATITEM, $LM_STATITEM_SEPARATOR;

				if(!vartrue($menu_pref['login_menu']['external_stats'])) return '';

				$lbox_infos = login_menu_class::parse_external_list(true, false);

				if(!vartrue($lbox_infos['stats'])) return '';

				$lbox_active_sorted = $menu_pref['login_menu']['external_stats'] ? explode(',', $menu_pref['login_menu']['external_stats']) : array();

				$ret = array();

				$sep = varset($LM_STATITEM_SEPARATOR, '<br />');

				foreach ($lbox_active_sorted as $stackid)
				{
				    if(!varset($lbox_infos['stats'][$stackid])) continue;

				    foreach ($lbox_infos['stats'][$stackid] as $lbox_item)
				    {
				        $tmp = array();
				        if($lbox_item['stat_new'])
				        {
				            $tmp['LM_STAT_NEW'] = $lbox_item['stat_new'];
				            $tmp['LM_STAT_LABEL'] = $lbox_item["stat_new"] == 1 ? $lbox_item['stat_item'] : $lbox_item['stat_items'];
				            $tmp['LM_STAT_EMPTY'] = '';
				            $new_total += $lbox_item['stat_new'];
				        }
				        else
				        {
				            //if(empty($lbox_item['stat_nonew'])) continue;
				            $tmp['LM_STAT_NEW'] = '';
				            $tmp['LM_STAT_LABEL'] = '';
				            $tmp['LM_STAT_EMPTY'] = $lbox_item['stat_nonew'];
				        }

				        $ret[] = $this->tp->parseTemplate($EUSER_LOGIN_MENU_STATITEM, false, $tmp);
				    }
				}

				return $ret ? implode($sep, $ret) : '';

			}


			function sc_lm_listnew_link($parm='')
			{
				$data = getcachedvars('login_menu_data');
				if($parm == 'href') return $data['listnew_link'];
				return $data['listnew_link'] ? '<a href="'.$data['listnew_link'].'" class="login_menu_link listnew" id="login_menu_link_listnew">'.LAN_LOGINMENU_24.'</a>' : '';
			}


			function sc_lm_message($parm='')
			{
				global $this->tp, $EUSER_LOGIN_MENU_MESSAGE;
				if(!deftrue('LOGINMESSAGE')) return '';
				if($parm == "popup"){
					$srch = array("<br />","'");
					$rep = array("\\n","\'");
					return "<script type='text/javascript'>
						alert('".$this->tp->toJS(LOGINMESSAGE)."');
						</script>";
				}
				else
				{
				    return e107::getParser()->parseTemplate($EUSER_LOGIN_MENU_MESSAGE, true, $this);
				}
			}


			function sc_lm_message_text($parm='')
			{
				return deftrue('LOGINMESSAGE', '');
			}
*/



		}
//////////////////$EUSER_LOGIN_MENU_shortcodes = $this->tp -> e_sc -> parse_scbatch(__FILE__);


/*
SC_BEGIN LM_USERNAME_INPUT
return "<input class='tbox login user' type='text' id='username' name='username' size='15' value='' maxlength='30' required placeholder='".LOGIN_MENU_L1."'/>\n";
SC_END
SC_BEGIN LM_PASSWORD_INPUT
return "<input class='tbox login pass' type='password' id='userpass' name='userpass' size='15' value='' maxlength='20' required placeholder='".LOGIN_MENU_L2."'/>\n\n";
SC_END
SC_BEGIN LM_IMAGECODE
global $use_imagecode, $sec_img;
if($use_imagecode)
{
	return '<input type="hidden" name="rand_num" value="'.$sec_img->random_number.'" />
		'.$sec_img->r_image().'
		<br /><input class="tbox login verify" type="text" name="code_verify" size="15" maxlength="20" /><br />';
}
SC_END
SC_BEGIN LM_LOGINBUTTON
return "<input class='button' type='submit' name='userlogin' value='".LOGIN_MENU_L28."' />";
SC_END
SC_BEGIN LM_REMEMBERME
$this->euser_pref = e107::getPlugPref('euser');
if($parm == "hidden"){
	return "<input type='hidden' name='autologin' value='1' />";
}
if($this->euser_pref['user_tracking'] != "session")
{
	return "<input type='checkbox' name='autologin' value='1' checked='checked' />".LOGIN_MENU_L6;
}
SC_END
SC_BEGIN LM_SIGNUP_LINK
//$this->euser_pref = e107::getPlugPref('euser');
//var_dump ($this->euser_pref['user_reg']);
if ($pref['user_reg'])
{
	if (!$pref['auth_method'] || $pref['auth_method'] == 'e107')
	{
		return "<a class='login_menu_link signup' href='".e_SIGNUP."' title=\"".LOGIN_MENU_L3."\">".LOGIN_MENU_L3."</a>";
	}
}
return "";
SC_END
SC_BEGIN LM_FPW_LINK
//$this->euser_pref = e107::getPlugPref('euser');
if ($pref['user_reg'])
{
	if (!$pref['auth_method'] || $pref['auth_method'] == 'e107')
	{
		return "<a class='login_menu_link fpw' href='".e_BASE."fpw.php' title=\"".LOGIN_MENU_L4."\">".LOGIN_MENU_L4."</a>";
	}
}
return "";
SC_END
SC_BEGIN LM_RESEND_LINK
//$this->euser_pref = e107::getPlugPref('euser');
if(isset($pref['user_reg_veri']) && $pref['user_reg_veri'] == 1){
	if (!$pref['auth_method'] || $pref['auth_method'] == 'e107' )
	{
		return "<a class='login_menu_link resend' href='".e_SIGNUP."?resend' title=\"".LOGIN_MENU_L40."\">".LOGIN_MENU_L40."</a>";
	}
}
return "";
SC_END
SC_BEGIN LM_MAINTENANCE
//$this->euser_pref = e107::getPlugPref('euser');
if(ADMIN == TRUE){
	return ($pref['maintainance_flag'] == 1 ? '<div style="text-align:center"><strong>'.LOGIN_MENU_L10.'</strong></div><br />' : '' );
}
SC_END
SC_BEGIN LM_ADMINLINK_BULLET
global $bullet;
if(ADMIN==TRUE && $bullet !='bullet'){
	return $bullet;
}
SC_END
SC_BEGIN LM_ADMINLINK
global $ADMIN_DIRECTORY, $eplug_admin;
//die(e_PAGE);
if(ADMIN == TRUE) {
		if (strpos(e_SELF, $ADMIN_DIRECTORY) !== FALSE || $eplug_admin == true || substr(e_PAGE, 0, 6) == 'admin_')
		{
			return '<a class="login_menu_link" href="'.e_BASE.'index.php">'.LOGIN_MENU_L39.'</a>';
		}
		else
		{
			return '<a class="login_menu_link" href="'.e_ADMIN_ABS.'admin.php">'.LOGIN_MENU_L11.'</a>';
		}
}
SC_END
SC_BEGIN LM_BULLET
global $bullet;
return $bullet;
SC_END
SC_BEGIN LM_USERSETTINGS
$text = ($parm) ? $parm : LOGIN_MENU_L12;
return '<a class="login_menu_link" href="'.e_HTTP.'usersettings.php">'.$text.'</a>';
SC_END
SC_BEGIN LM_PROFILE
$text = ($parm) ? $parm : LOGIN_MENU_L13;
return '<a class="login_menu_link" href="'.e_HTTP.'user.php?id.'.USERID.'">'.$text.'</a>';
SC_END
SC_BEGIN LM_LOGOUT
$text = ($parm) ? $parm : LOGIN_MENU_L8;
return '<a class="login_menu_link" href="'.e_HTTP.'index.php?logout">'.$text.'</a>';
SC_END
SC_BEGIN LM_MESSAGE
global $this->tp;
if($parm == "popup"){
	$srch = array("<br />","'");
	$rep = array("\\n","\'");
	return "<script type='text/javascript'>
		alert('".$this->tp->toJS(LOGINMESSAGE)."');
		</script>";
}else{
	return strip_tags(LOGINMESSAGE);
}
SC_END
*/
?>