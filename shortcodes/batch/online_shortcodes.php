<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2013 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Online shortcodes
 *
*/
if (!defined('e107_INIT')) { exit; }
include_once(e_PLUGIN.'euser/euser_class.php');

//--register_shortcode('online_shortcodes', true);
//--$online_shortcodes = initShortcodeClass('online_shortcodes');

class plugin_euser_online_shortcodes extends e_shortcode
{
	protected $e107;
//	public $memberInfo = array();				// Site stats
////	public $currentMember = array('oid' => '0', 'oname' => '??', 'page' => 'lost');
	public $currentUser = array();				// Information about current user (for last seen)
	public $onlineMembersList = '';
	private $extendedMode;
//	public $memberTemplate = '';
	protected $gen;
	private $Pref = array();
	
	
	public function __construct()
	{
		// Need to set initial value for $scVars. Otherwise it results warning message.
		parent::__construct();

		$this->e107 = e107::getInstance();
//		$this->memberInfo = e107::getConfig('history');
		$this->gen = e107::getDateConvert();
//		$this->menuPref = e107::getConfig('menu')->getPref();
// Não vai buscar as prefs do menu, vai buscar do plugin... 
		$this->Pref = e107::getPlugPref('euser');
//var_dump ($this->menuPref);
		$this->extendedMode = e107::getConfig('menu')->get('online_show_memberlist_extended');

  	$this->memberTemplate = e107::getTemplate('euser', 'member');
//  	$template = e107::getTemplate('euser', 'member');
//    $this->memberTemplate = $template['extended'];
//    $this->newestTemplate = $template['short'];
        $this->template = e107::getTemplate('euser', 'online_menu');

	}


	function sc_eom_style($parm=null)
	{
		if($this->extendedMode)
		{
			return 'list-unstyled online-menu-extended';
		}

	}

	// Last Seen Menu
	function sc_lastseen_userlink()
	{
		$uparams = array('id' => $this->currentUser['user_id'], 'name' => $this->currentUser['user_name']);
		$link = e107::getUrl()->create('user/profile/view', $uparams);
		return "<a href='".$link."'>".$this->currentUser['user_name']."</a>";

	// $uparams = array('id' => $this->currentUser['user_id'], 'name' => $this->currentUser['user_name']);
	//	return "<a href='".e_BASE."user.php?id.".$this->currentUser['user_id']."'>".$this->currentUser['user_name']."</a>";
	}

	function sc_lastseen_date()
	{
		$seen_ago = $this->gen->computeLapse($this->currentUser['user_currentvisit'], false, false, true, 'short');
		return $seen_ago;
		// return ($seen_ago ? $seen_ago : '1 '.LANDT_09).' '.LANDT_AGO;
	}


	function sc_eom_tracking_disabled()
	{
		$url = e_ADMIN."users.php?mode=main&amp;action=prefs";

		$srch = array("[","]");
		$repl = array("<a href='".$url."'>", "</a>");

		$message = str_replace($srch,$repl, LAN_EUSER_10TRACKING_MESSAGE);
		return e107::getParser()->toHTML($message, true);

	}

	
	// Online Menu
	function sc_eom_guests()
	{
		//var_dump($this->menuPref['online_show_guests']);

//--		if(!isset($this->menuPref['online_show_guests']) || !empty($this->menuPref['online_show_guests']))
//--		{
			return euser::makelabel(GUESTS_ONLINE);
//--		}




	}

	function sc_eom_members()
	{
			return euser::makelabel(MEMBERS_ONLINE);
//		return MEMBERS_ONLINE;
	}

	function sc_eom_members_list()
	{
		if(!empty($this->Pref['show_memberlist']))
		{
			return (MEMBERS_ONLINE ? MEMBER_LIST : '');
		}
	}


	function sc_eom_page()
	{
			return euser::makelabel(ON_PAGE);
//		return ON_PAGE;
	}


	function sc_eom_members_total()
	{
		$total_members = e107::getCache()->retrieve("online_menu_member_total", 120);
		if($total_members == false) 
		{
			$total_members = e107::getDb()->count('user','(*)',"where user_ban='0'");
			e107::getCache()->set("online_menu_member_total", $total_members);
		}
		return euser::makelabel($total_members);
	}


	function sc_eom_member_newest($parm=null)
	{
		$ret =e107::getCache()->retrieve('online_menu_member_newest', 120);
		if($ret == false) 
		{
  		$sql = e107::getDb();

			$sql->select('user', 'user_id, user_name,user_image', "user_ban='0' ORDER BY user_join DESC LIMIT 1");
			$row = $sql->fetch();
			//$ret = "<a href='".e_HTTP."user.php?id.".$row['user_id']."'>".$row['user_name']."</a>";
//      var_dump ($row);
//      var_dump ($parm);
			if(varset($parm['type']) == 'avatar')
			{
//				$this->currentMember =  array('oid'	=> $row['user_id'], 'oname'=> $row['user_name'], 'page' => null, 'pinfo' => null,'oimage' => $row['user_image']	);

	$sc = e107::getScBatch('member', 'euser');
					$sc->currentMember = array('oid'	=> $row['user_id'], 'oname'=> $row['user_name'], 'page' => null, 'pinfo' => null,'oimage' => $row['user_image']	);
//var_dump ($this);


//    $this->memberTemplate = $template['extended'];
//    $this->newestTemplate = $template['short'];

//				$ret =  e107::getParser()->parseTemplate($this->newestTemplate, TRUE, $this);
				$ret =  e107::getParser()->parseTemplate($this->memberTemplate['short'], TRUE, $sc);

			}
			else
			{
				$uparams = array('id' => $row['user_id'], 'name' => $row['user_name']);
				$link = e107::getUrl()->create('user/profile/view', $uparams);
				$ret = "<a href='".$link."'>".$row['user_name']."</a>";
			}
			e107::getCache()->set('online_menu_member_newest', $ret);
		}
		return $ret;
	}


/* Antigo, veio do online menu...
	function sc_eom_most()
	{
		return intval($this->memberInfo->get('most_members_online') + $this->memberInfo->get('most_guests_online'));
	}


	function sc_eom_most_members()
	{
		return $this->memberInfo->get('most_members_online');
	}


	function sc_eom_most_guests()
	{
		return $this->memberInfo->get('most_guests_online');
	}


	function sc_eom_most_datestamp($parm='short')
	{
		return $this->gen->convert_date($this->memberInfo->get('most_online_datestamp'), $parm);
	}
*/

	function sc_eom_most($parm = '')
	{
		$memberInfo = e107::getConfig('history');

    if ($parm['type'] == "members") {return $memberInfo->get('most_members_online');}
    elseif ($parm['type'] == "guests") {return $memberInfo->get('most_guests_online');}
    elseif ($parm['type'] == "datestamp") {return $this->gen->convert_date($memberInfo->get('most_online_datestamp'), $parm['style']);}
		
    return euser::makelabel(intval($memberInfo->get('most_members_online') + $memberInfo->get('most_guests_online')));
	}


/*
	function sc_eom_most_members()
	{
		return $this->memberInfo->get('most_members_online');
	}


	function sc_eom_most_guests()
	{
		return $this->memberInfo->get('most_guests_online');
	}


	function sc_eom_most_datestamp($parm='short')
	{
		return $this->gen->convert_date($this->memberInfo->get('most_online_datestamp'), $parm);
	}
*/

	//##### ONLINE MEMBER LIST EXTENDED 
	function sc_eom_members_list_extended()
	{
		//display list of 'member viewing page'
		if($this->extendedMode == false)
		{
			return null;
		}

		$text = '';

		if (MEMBERS_ONLINE)
		{
			//	global $listuserson;

				$listuserson = e107::getOnline()->userList();

				$ret='';
				foreach($listuserson as $uinfo => $row)
				{
					if($row['user_active'] != 1)
					{
						continue;
					}

					$pinfo = $row['user_location'];

					$online_location_page = str_replace('.php', '', substr(strrchr($pinfo, '/'), 1));
					if ($pinfo == 'log.php' || $pinfo == 'error.php')
					{
						$pinfo = 'news.php';
						$online_location_page = 'news';
					}
					elseif ($online_location_page == 'request.php')
					{
						$pinfo = 'download.php';
						$online_location_page = 'download';
					}
					elseif (strstr($online_location_page, 'forum'))
					{
						$pinfo = e_PLUGIN.'forum/forum.php';
						$online_location_page = 'forum';
					}
					elseif (strstr($online_location_page, 'content'))
					{
						$pinfo = 'content.php';
						$online_location_page = 'content';
					}
					elseif (strstr($online_location_page, 'comment'))
					{
						$pinfo = 'comment.php';
						$online_location_page = 'comment';
					}

					list($oid, $oname) = explode('.', $uinfo, 2);

					$data = array(
						'oid' 	=> $row['user_id'],
						'oname' =>$row['user_name'],
						'page' 	=> $online_location_page,
						'pinfo' => $pinfo,
						'oimage' => $row['user_image']
					);

	$sc = e107::getScBatch('member', 'euser');
					$sc->currentMember = $data;
//var_dump ($this->memberTemplate);
//    $this->memberTemplate = $template['extended'];
//    $this->newestTemplate = $template['short'];

// 					$text .= e107::getParser()->parseTemplate($this->memberTemplate, true, $this);
 					$text .= e107::getParser()->parseTemplate($this->memberTemplate['extended'], true, $sc);
// 					$text .= e107::getParser()->parseTemplate($template['members_extended'], true, $this);

				}

			}


		return $text;

	}

	function sc_eom_members_registered()
	{
		return euser::makelabel(e107::getDb()->count('user','(*)','user_ban = 0'));

	}

/*
	function sc_eom_member_image($parm=null)
	{
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


	function sc_eom_member_user()
	{
		//return "<a href='".e_HTTP."user.php?id.{$this->currentMember['oid']}'>{$this->currentMember['oname']}</a>";



		$uparams = array('id' => $this->currentMember['oid'], 'name' => $this->currentMember['oname']);
		$link = e107::getUrl()->create('user/profile/view', $uparams);



		return "<a href='".$link."'>".$this->currentMember['oname']."</a>";
	}


	function sc_eom_member_page()
	{
		if(empty($this->currentMember['page']))
		{
			return null;
		}

		global $ADMIN_DIRECTORY;
		return (!strstr($this->currentMember['pinfo'], $ADMIN_DIRECTORY) ? "<a href='".$this->currentMember['pinfo']."'>".$this->currentMember['page']."</a>" : $this->currentMember['page']);
	}
*/
}

