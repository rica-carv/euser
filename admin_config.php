<?php

// Generated e107 Plugin Admin Area 

require_once('../../class2.php');
if (!getperms('P')) 
{
	e107::redirect('admin');
	exit;
}

e107::lan('euser', 'admin', true);
e107::lan('euser', 'front', true);
e107::lan('euser', 'global', true);
// e107::lan('euser',true);

require_once('admin_class.php');

/*
function create_expandit_container ($parent, $data_array) {

//!vartrue($pref['membersonly_enabled']) ? "e-hideme" : "";

//					$this->prefs['new_icon']['writeParms']['post'] = "<div class='e-expandit-container ".(e107::getPlugPref('euser')['new_icon']==0?"e-hideme":"")."'><span class='form-inline'>".$new_icontype['title']." ".$frm->renderElement('new_icontype', e107::getPlugPref('euser')['new_icontype'], $new_icontype)."</span></div>";
foreach ($data_array as $key => $value){

//$frm = e107::getForm();
  $text .= "<span class='form-inline'>".$value['title']." ".e107::getForm()->renderElement($key, e107::getPlugPref('euser')[$key], $value)."</span>";
  $text .= "<br>";
}

var_dump ($parent);
var_dump (e107::getPlugPref('euser')[$parent]);
var_dump (vartrue(e107::getPlugPref('euser')[$parent]));
var_dump (empty(e107::getPlugPref('euser')[$parent]));
//return "<div class='e-expandit-container ".!vartrue(e107::getPlugPref('euser')[$parent]) ? "e-hideme" : "")."'><span class='form-inline'>".$data_array['title']." ".$frm->renderElement($key_array, e107::getPlugPref('euser')[$key_array], $data_array)."</span></div>";
return "<div class='e-expandit-container ".(!vartrue(e107::getPlugPref('euser')[$parent]) ? "e-hideme" : "")."'>".$text."</div>";

} 

function label_installed ($plug) {

e107::coreLan('plugin', true);

        $labeltype = "danger";
//        $labeltext = LAN_INSTALLED;
//        $labeltext = LANG_LAN_05;
        $labeltext = EPL_ADLAN_23;

			if(e107::isInstalled($plug))
			{
//				$fields['deleteme']['writeParms']['post'] = " <span class='label label-important label-danger'>".LANG_LAN_05."</span>";
        $labeltype = "success";
//        $labeltext = LAN_INSTALLED;
        $labeltext = EPL_ADLAN_22;
			}

      return "<span class='label label-important label-".$labeltype."'>".$labeltext."</span>";

} 
*/


class euser_adminArea extends e_admin_dispatcher
{

	protected $modes = array(	
	
/*
		'main'	=> array(
			'controller' 	=> 'euser_cache_ui',
			'path' 			=> null,
			'ui' 			=> 'euser_cache_form_ui',
			'uipath' 		=> null
		),
*/		

		'main'	=> array(
			'controller' 	=> 'euser_main_ui',
			'path' 			=> null,
			'ui' 			=> 'euser_main_form_ui',
			'uipath' 		=> null
		),
		'friends'	=> array(
			'controller' 	=> 'euser_friends_ui',
			'path' 			=> null,
			'ui' 			=> 'euser_friends_form_ui',
			'uipath' 		=> null
		),
		'profile'	=> array(
			'controller' 	=> 'euser_profile_ui',
			'path' 			=> null,
			'ui' 			=> 'euser_profile_form_ui',
			'uipath' 		=> null
		),
		'memberlist'	=> array(
			'controller' 	=> 'euser_memberlist_ui',
			'path' 			=> null,
			'ui' 			=> 'euser_memberlist_form_ui',
			'uipath' 		=> null
		),
		'whatsnew'	=> array(
			'controller' 	=> 'euser_whatsnew_ui',
			'path' 			=> null,
			'ui' 			=> 'euser_whatsnew_form_ui',
			'uipath' 		=> null
		),
		'online'	=> array(
			'controller' 	=> 'euser_online_ui',
			'path' 			=> null,
			'ui' 			=> 'euser_online_form_ui',
			'uipath' 		=> null
		),
		'color'	=> array(
			'controller' 	=> 'euser_color_ui',
			'path' 			=> null,
			'ui' 			=> 'euser_color_form_ui',
			'uipath' 		=> null
		),
		

	);	
	
	
	protected $adminMenu = array(

//		'main/list'			=> array('caption'=> LAN_MANAGE, 'perm' => 'P'),
//		'main/create'		=> array('caption'=> LAN_CREATE, 'perm' => 'P'),
		'main/prefs'			=> array('caption'=> LAN_PREFS, 'perm' => 'P'),
		'friends/prefs'			=> array('caption'=> LAN_EUSER_ADMIN_1, 'perm' => 'P'),

		'opt1'              => array('header'=> LAN_EUSER_ADMIN_2),

		'profile/prefs'			=> array('caption'=> LAN_USER_50, 'perm' => 'P'), 
		'memberlist/prefs'			=> array('caption'=> LAN_EUSER_500, 'perm' => 'P'),
//		'main/opt1'              => array('divider'=>true),
		'opt2'              => array('header'=> LAN_EUSER_ADMIN_3),
		'whatsnew/prefs'			=> array('caption'=> LAN_EUSER_501, 'perm' => 'P'),
//		'main/opt2'              => array('divider'=>true),
		'online/prefs'			=> array('caption'=> LAN_EUSER_502, 'perm' => 'P'),
//		'main/opt3'              => array('divider'=>true),
		'color/prefs'			=> array('caption'=> LAN_EUSER_ADMIN_4, 'perm' => 'P'),
//		'color/create'		=> array('caption'=> LAN_CREATE, 'perm' => 'P'),

		// 'main/custom'		=> array('caption'=> 'Custom Page', 'perm' => 'P')
	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list'				
	);	
	
	protected $menuTitle = LAN_EUSER_FULLNAME;
}

class euser_main_ui extends e_admin_ui
{
	//TODO Move to Class above. 
	protected $pluginTitle		= LAN_EUSER_FULLNAME;
	protected $pluginName		= 'euser';
//	protected $table			= "featurebox";	
//	protected $pid 				= "fb_id";
	protected $perPage 			= 10;
	protected $batchDelete 		= true;
	protected $batchCopy 		= true;
	protected $sortField		= 'fb_order';
	protected $orderStep 		= 1;
	protected $listOrder 		= 'fb_order asc';

  protected $preftabs			= array(LAN_OPTIONS,LAN_EUSER_ADMIN_300); 
	protected $prefs = array( 
           'lastupdate_filter'  => array('title'=> LAN_EUSER_ADMIN_301,'tab' => 0, 'type'=>'userclass', 'writeParms' => 'classlist=public,member,classes,admin,main'),
          'updatedtotal_col'  => array('title'=> LAN_EUSER_ADMIN_302,'tab' => 0, 'type'=>'text'),
  				'updateddirection'  => array('title'=> LAN_EUSER_ADMIN_303,'tab' => 0,  'type'=>'dropdown', 'writeParms'=>array('optArray'=> array('v'=> LAN_EUSER_ADMIN_310,'h'=> LAN_EUSER_ADMIN_311))),
          'updatedtotal'  => array('title'=> LAN_EUSER_ADMIN_304,'tab' => 0, 'type'=>'text','help' => LAN_EUSER_ADMIN_304H),
  				'buttontype'  => array('title'=> LAN_EUSER_ADMIN_305, 'type'=>'boolean','tab' => 0),
  				'user_warn_support'  => array('title'=> LAN_EUSER_ADMIN_306, 'type'=>'boolean','tab' => 0,'help' => LAN_EUSER_ADMIN_306H),
  				'redirect'  => array('title'=> LAN_EUSER_ADMIN_307, 'type'=>'boolean','tab' => 1,'writeParms'=>array('tdClassRight'=>'form-inline')),
  				'unreg'  => array('title'=> LAN_EUSER_ADMIN_308, 'type'=>'boolean','tab' => 1,'help' => LAN_EUSER_ADMIN_308H),
  				'unreg_save'  => array('title'=> LAN_EUSER_ADMIN_309, 'type'=>'boolean','tab' => 1,'help' => LAN_EUSER_ADMIN_309H),

	);
	
	function init()
	{
//          var_dump (e107::getPlugPref('euser','redirect_usersettings'));
//          var_dump (e107::getPlugPref('euser','redirect'));

					$this->prefs['redirect_usersettings']['writeParms']['post'] = "&nbsp;<span class='label label-important label-info'>".LAN_EUSER_ADMIN_501I."</span>";
					$this->prefs['redirect']['writeParms']['post'] = "&nbsp;<span class='label label-important label-info'>".LAN_EUSER_ADMIN_502I."</span>";
          
          		$categories = array();
		if(e107::getDb()->select('featurebox_category'))
		{
			while ($row = e107::getDb()->fetch())
			{
				$id = $row['fb_category_id'];
				$tmpl = $row['fb_category_template'];
				$categories[$id] = $row['fb_category_title'];
				$menuCat[$tmpl] = $row['fb_category_title'];
			}
		}

		$this->fields['fb_category']['writeParms'] 		= $categories;	
		$this->fields['fb_category']['readParms'] 		= $categories;
		
		unset($menuCat['unassigned']);
		
		$this->prefs['menu_category']['writeParms']['optArray'] 	= $menuCat;
		$this->prefs['menu_category']['readParms']['optArray'] 		= $menuCat;

//     	$mes = e107::getMessage();
//	    $message = LAN_EUSER_ADMIN_SHAREDCONFIG;
//			e107::getMessage()->addInfo(LAN_EUSER_ADMIN_SHAREDCONFIG);

	}
		
}


/*
  				'_hidden1'  => array('type'=>'method','tab' => 1, 'writeParms'=>array('nolabel'=>2)),

class euser_main_form_ui extends e_admin_form_ui
{

	function _hidden1($curVal,$mode)
	{
    $text .= '<tr class="collapse" id="collapsible"><td>'.LAN_EUSER_ADMIN_309.'</td><td>';
    $text .= e107::getForm()->renderElement('unreg_save', e107::getPlugPref('euser')['unreg_save'], array('title'=> LAN_EUSER_ADMIN_309, 'type'=>'boolean','help' => LAN_EUSER_ADMIN_309H));
    $text .= '</td></tr></div>';
		
		return $text;
	}

}		
*/






class euser_friends_ui extends e_admin_ui
{
	//TODO Move to Class above. 
	protected $pluginTitle		= LAN_EUSER_FULLNAME;
	protected $pluginName		= 'euser';
//	protected $table			= "featurebox";	
//	protected $pid 				= "fb_id";
	protected $perPage 			= 10;
	protected $batchDelete 		= true;
	protected $batchCopy 		= true;
	protected $sortField		= 'fb_order';
	protected $orderStep 		= 1;
	protected $listOrder 		= 'fb_order asc';

	protected $prefs = array( 
  				'friends'  => array('title'=> LAN_EUSER_ADMIN_400, 'type'=>'boolean'),
  				'frcol'  => array('title'=> LAN_EUSER_ADMIN_401, 'type'=>'text','help' => LAN_EUSER_ADMIN_401H),
//  				'fr_req_sendpm'  => array('title'=> LAN_EUSER_ADMIN_402, 'type'=>'boolean'),
  				'fr_req_sendpm'  => array('title'=> LAN_EUSER_ADMIN_402, 'type'=>'method'),
  				'fr_req_sendemail'  => array('title'=> LAN_EUSER_ADMIN_403, 'type'=>'method'),
	);
	
	function init()
	{
/*
$this->prefs['fr_req_sendpm']['writeParms']['post'] = e107::getForm()->renderElement('fr_req_sendpm_all', e107::getPlugPref('euser')['fr_req_sendpm_all'], array('title'=> "",'tab' => 2, 'type'=>'boolean', 'writeParms'=>array('pre'=>'<span class="pull-left">&nbsp;&nbsp;'.LAN_EUSER_ADMIN_404.'&nbsp;&nbsp;</span>')));

$this->prefs['fr_req_sendemail']['writeParms']['post'] = e107::getForm()->renderElement('fr_req_sendemail_all', e107::getPlugPref('euser')['fr_req_sendemail_all'], array('title'=> "",'tab' => 2, 'type'=>'boolean', 'writeParms'=>array('pre'=>'<span class="pull-left">&nbsp;&nbsp;'.LAN_EUSER_ADMIN_404.'&nbsp;&nbsp;</span>')));
*/
//          var_dump (e107::getPlugPref('euser','redirect_usersettings'));
//          var_dump (e107::getPlugPref('euser','redirect'));

//					$this->prefs['redirect_usersettings']['writeParms']['post'] = "&nbsp;<span class='label label-important label-info'>".LAN_EUSER_ADMIN_501I."</span>";
//					$this->prefs['redirect']['writeParms']['post'] = "&nbsp;<span class='label label-important label-info'>".LAN_EUSER_ADMIN_502I."</span>";
          
/*
          		$categories = array();
		if(e107::getDb()->select('featurebox_category'))
		{
			while ($row = e107::getDb()->fetch())
			{
				$id = $row['fb_category_id'];
				$tmpl = $row['fb_category_template'];
				$categories[$id] = $row['fb_category_title'];
				$menuCat[$tmpl] = $row['fb_category_title'];
			}
		}

		$this->fields['fb_category']['writeParms'] 		= $categories;	
		$this->fields['fb_category']['readParms'] 		= $categories;
		
		unset($menuCat['unassigned']);
		
		$this->prefs['menu_category']['writeParms']['optArray'] 	= $menuCat;
		$this->prefs['menu_category']['readParms']['optArray'] 		= $menuCat;
*/
//     	$mes = e107::getMessage();
//	    $message = LAN_EUSER_ADMIN_SHAREDCONFIG;
//			e107::getMessage()->addInfo(LAN_EUSER_ADMIN_SHAREDCONFIG);

	}
		
}

class euser_friends_form_ui extends e_admin_form_ui
{

	function fr_req_sendpm($curVal,$mode)
	{
/*
var_dump ($_POST);
echo "<hr>";
var_dump (e107::getPlugPref('euser'));		
*/
		$frm = e107::getForm();
		
    $text .= '<div class="pull-left">';
    $text .= $frm->renderElement('fr_req_sendpm', $curVal, array('type'=>'boolean'));
    $text .= '</div><div class="pull-left text-right">&nbsp;&nbsp;&nbsp;&nbsp;'.LAN_EUSER_ADMIN_404.'&nbsp;&nbsp;</div><div class="pull-left">';
    $text .= $frm->renderElement('fr_req_sendpm_all', e107::getPlugPref('euser')['fr_req_sendpm_all'], array('type'=>'boolean'));
    $text .= '</div></div>';
		
		return $text;
	}

	function fr_req_sendemail($curVal,$mode)
	{
		
		$frm = e107::getForm();
		
    $text .= '<div class="pull-left">';
    $text .= $frm->renderElement('fr_req_sendemail', $curVal, array('type'=>'boolean'));
    $text .= '</div><div class="pull-left text-right">&nbsp;&nbsp;&nbsp;&nbsp;'.LAN_EUSER_ADMIN_404.'&nbsp;&nbsp;</div><div class="pull-left">';
    $text .= $frm->renderElement('fr_req_sendemail_all', e107::getPlugPref('euser')['fr_req_sendemail_all'], array('type'=>'boolean'));
    $text .= '</div></div>';
		
		return $text;
	}


}		

class euser_profile_ui extends e_admin_ui
{
	//TODO Move to Class above. 
	protected $pluginTitle		= LAN_EUSER_FULLNAME;
	protected $pluginName		= 'euser';
//	protected $table			= "featurebox";	
//	protected $pid 				= "fb_id";
	protected $perPage 			= 10;
	protected $batchDelete 		= true;
	protected $batchCopy 		= true;
	protected $sortField		= 'fb_order';
	protected $orderStep 		= 1;
	protected $listOrder 		= 'fb_order asc';

  protected $preftabs			= array(LAN_OPTIONS,LAN_EUSER_ADMIN_510,LAN_EUSER_ADMIN_520,LAN_EUSER_ADMIN_540,LAN_EUSER_ADMIN_550); 
	protected $prefs = array( 
  				'memberprofile_view'  => array('title'=> LAN_EUSER_ADMIN_501,'tab' => 0, 'type'=>'userclass', 'writeParms'=>array('class'=>'pull-left')),
  				'memberprofile_edit'  => array('title'=> LAN_EUSER_ADMIN_502,'tab' => 0, 'type'=>'userclass', 'writeParms'=>array('class'=>'pull-left')),
  				'stats'  => array('title'=> LAN_EUSER_ADMIN_503,'tab' => 0, 'type'=>'boolean'),
  				'commentson'  => array('title'=> LAN_EUSER_ADMIN_510,'tab' => 1,  'type'=>'boolean'),
          'maxpcomment'  => array('title'=> LAN_EUSER_ADMIN_511,'tab' => 1, 'type'=>'text','help' => LAN_EUSER_ADMIN_511H),
          'maxpiccomment'  => array('title'=> LAN_EUSER_ADMIN_512,'tab' => 1, 'type'=>'text','help' => LAN_EUSER_ADMIN_512H),
          'maxvidcomment'  => array('title'=> LAN_EUSER_ADMIN_513,'tab' => 1, 'type'=>'text','help' => LAN_EUSER_ADMIN_513H),
          'apcomments'  => array('title'=> LAN_EUSER_ADMIN_514,'tab' => 1, 'type'=>'text'),
//          '_header'  => array('title'=> LAN_EUSER_ADMIN_515,'tab' => 1, 'type'=>'header', 'writeParms'=>array('pre'=>'<div class="e-hideme">', 'post'=>'</div>')),
          '_header'  => array('tab' => 1, 'type'=>'method', 'writeParms'=>array('nolabel'=>2)),
          'comments_spy_num'  => array('title'=> LAN_EUSER_ADMIN_516,'tab' => 1, 'type'=>'text','help' => LAN_EUSER_ADMIN_516H),
          'comments_spy'  => array('title'=> LAN_EUSER_ADMIN_517,'tab' => 1, 'type'=>'userclass', 'writeParms' => 'classlist=public,member,classes,admin,main'),
          'comments_spy_pic_size'  => array('title'=> LAN_EUSER_ADMIN_518,'tab' => 1, 'type'=>'text'),
  				'pics'  => array('title'=> LAN_EUSER_ADMIN_520,'tab' => 2,  'type'=>'boolean'),
//          '_header1'  => array('title'=> LAN_EUSER_ADMIN_521,'tab' => 2, 'type'=>'bbarea', 'writeParms'=>array('pre'=>'<div class="e-hideme">', 'post'=>'</div>')),
          '_header1'  => array('tab' => 2, 'type'=>'method', 'writeParms'=>array('nolabel'=>2)),
          'maxalbumnumber'  => array('title'=> LAN_EUSER_ADMIN_522,'tab' => 2, 'type'=>'text','help' => LAN_EUSER_ADMIN_522H),
          'maxpicnumber'  => array('title'=> LAN_EUSER_ADMIN_523,'tab' => 2, 'type'=>'text','help' => LAN_EUSER_ADMIN_523H),
          'piccol'  => array('title'=> LAN_EUSER_ADMIN_524,'tab' => 2, 'type'=>'text','help' => LAN_EUSER_ADMIN_304H),
          'maxuploadsize'  => array('title'=> LAN_EUSER_ADMIN_525,'tab' => 2, 'type'=>'text','help' => LAN_EUSER_ADMIN_525H),
          'indmaxuploadsize'  => array('title'=> LAN_EUSER_ADMIN_526,'tab' => 2, 'type'=>'text'),
  				'private_albums'  => array('title'=> LAN_EUSER_ADMIN_527,'tab' => 2,  'type'=>'boolean','help' => LAN_EUSER_ADMIN_527H),
  				'accents'  => array('title'=> LAN_EUSER_ADMIN_528,'tab' => 2,  'type'=>'boolean', 'writeParms'=>array('class'=>'pull-left')),
  				'user_image'  => array('title'=> LAN_EUSER_ADMIN_529,'tab' => 2,  'type'=>'dropdown', 'writeParms'=>array('optArray'=> array('100'=> "100",'150'=> "150",'200'=> "200")),'help' => LAN_EUSER_ADMIN_529H),
  				'imagick_support'  => array('title'=> LAN_EUSER_ADMIN_530,'tab' => 2,  'type'=>'boolean','help' => LAN_EUSER_ADMIN_530H),
//          '_header2'  => array('title'=> LAN_EUSER_ADMIN_531,'tab' => 2, 'type'=>'bbarea', 'writeParms'=>array('pre'=>'<div class="e-hideme">', 'post'=>'</div>')),
          '_header2'  => array('tab' => 2, 'type'=>'method', 'writeParms'=>array('nolabel'=>2)),
          'picviewsize'  => array('title'=> LAN_EUSER_ADMIN_532,'tab' => 2, 'type'=>'text'),
//          'imagewidth'  => array('title'=> LAN_EUSER_ADMIN_537,'tab' => 2, 'type'=>'text', 'writeParms'=>array('class'=>'pull-left'),'help' => LAN_EUSER_ADMIN_537H),
          'imagewidth'  => array('title'=> LAN_EUSER_ADMIN_537,'tab' => 2, 'type'=>'method'),
//          'avatarwidth'  => array('title'=> LAN_EUSER_ADMIN_538,'tab' => 2, 'type'=>'text', 'writeParms'=>array('class'=>'pull-left'),'help' => LAN_EUSER_ADMIN_538H),
          'avatarwidth'  => array('title'=> LAN_EUSER_ADMIN_538,'tab' => 2, 'type'=>'method'),
  				'videos'  => array('title'=> LAN_EUSER_ADMIN_540,'tab' => 3,  'type'=>'boolean'),
          'maxnovids'  => array('title'=> LAN_EUSER_ADMIN_541,'tab' => 3, 'type'=>'text','help' => LAN_EUSER_ADMIN_541H),
          'videowidth'  => array('title'=> LAN_EUSER_ADMIN_542,'tab' => 3, 'type'=>'text','help' => LAN_EUSER_ADMIN_542H),
//          '_header3'  => array('title'=> LAN_EUSER_ADMIN_543,'tab' => 3, 'type'=>'bbarea', 'writeParms'=>array('pre'=>'<div class="e-hideme">', 'post'=>'</div>')),
          '_header3'  => array('tab' => 3, 'type'=>'method', 'writeParms'=>array('nolabel'=>2)),
  				'youtube'  => array('title'=> LAN_EUSER_ADMIN_131,'tab' => 3,  'type'=>'boolean'),
  				'vimeo'  => array('title'=> LAN_EUSER_ADMIN_545,'tab' => 3,  'type'=>'boolean'),
  				'metacafe'  => array('title'=> LAN_EUSER_ADMIN_546,'tab' => 3,  'type'=>'boolean'),
  				'indavideo'  => array('title'=> LAN_EUSER_ADMIN_547,'tab' => 3,  'type'=>'boolean'),
  				'mp3enabled'  => array('title'=> LAN_EUSER_ADMIN_550,'tab' => 4,  'type'=>'boolean'),
  				'mp3'  => array('title'=> LAN_EUSER_ADMIN_551,'tab' => 4,  'type'=>'dropdown', 'writeParms'=>array('optArray'=> array('Remote Only'=> LAN_EUSER_ADMIN_556,'Local Only'=> LAN_EUSER_ADMIN_557,'Both'=> LAN_EUSER_ADMIN_558))),
          'mp3size'  => array('title'=> LAN_EUSER_ADMIN_552,'tab' => 4, 'type'=>'text','help' => LAN_EUSER_ADMIN_552H),
  				'mp3_autoplay'  => array('title'=> LAN_EUSER_ADMIN_553,'tab' => 4,  'type'=>'boolean'),
  				'mp3_loop'  => array('title'=> LAN_EUSER_ADMIN_554,'tab' => 4,  'type'=>'boolean'),
          'mp3_volume'  => array('title'=> LAN_EUSER_ADMIN_555,'tab' => 4, 'type'=>'text','help' => LAN_EUSER_ADMIN_555H),
 	);
	
	function init()
	{
//          var_dump (e107::getPlugPref('euser','redirect_usersettings'));
//          var_dump (e107::getPlugPref('euser','redirect'));

					$this->prefs['memberprofile_view']['writeParms']['post'] = "&nbsp;<span class='label label-important label-info'>".LAN_EUSER_ADMIN_501I."</span>";
					$this->prefs['memberprofile_edit']['writeParms']['post'] = "&nbsp;<span class='label label-important label-info'>".LAN_EUSER_ADMIN_502I."</span>";
          
//          var_dump (e107::pref('core','upload_enabled'));
          if (!e107::pref('core','upload_enabled')) {
          $this->prefs['indmaxuploadsize']['title'] .= "<br><span class='label label-important label-danger'>".LAN_EUSER_ADMIN_526W."</span>";
          }

//          	$post_max_resolution = round(intval(ini_get('memory_limit')) / 1.65 / 3);
	if (intval(ini_get('post_max_size')) >= intval(ini_get('upload_max_filesize'))) {
		$post_max_info = ini_get('upload_max_filesize');
	} else {
		$post_max_info = ini_get('post_max_size');
	}
          $this->prefs['indmaxuploadsize']['help'] = e107::getParser()->lanVars(LAN_EUSER_ADMIN_526H, array('x'=>$post_max_info, 'y'=>round(intval(ini_get('memory_limit')) / 1.65 / 3), 'z'=>ini_get('memory_limit')));
          $this->prefs['mp3size']['help'] = e107::getParser()->lanVars(LAN_EUSER_ADMIN_552H, array('x'=>$post_max_info));

          $this->prefs['accents']['writeParms']['post'] = "&nbsp<span class='label label-important label-warning'>".LAN_EUSER_ADMIN_528N."</span>";

//e107::getForm()->renderElement('imageheight', e107::getPlugPref('euser')['imageheight'], array('title'=> LAN_EUSER_ADMIN_533,'tab' => 2, 'type'=>'text'))

//$this->prefs['imagewidth']['writeParms']['post'] = euser_admin::render_expanditcontainer ('imageheight', array('title'=> LAN_EUSER_ADMIN_533,'tab' => 2, 'type'=>'text'));
          
//$this->prefs['imagewidth']['writeParms']['post'] = e107::getForm()->renderElement('imageheight', e107::getPlugPref('euser')['imageheight'], array('title'=> "",'tab' => 2, 'type'=>'text', 'writeParms'=>array('pre'=>'<span class="pull-left">&nbsp;X&nbsp;</span>'),'help' => LAN_EUSER_ADMIN_537H));

//$this->prefs['avatarwidth']['writeParms']['post'] = e107::getForm()->renderElement('avatarheight', e107::getPlugPref('euser')['avatarheight'], array('title'=> "",'tab' => 2, 'type'=>'text', 'writeParms'=>array('pre'=>'<span class="pull-left">&nbsp;X&nbsp;</span>'),'help' => LAN_EUSER_ADMIN_538H));

          $prefsexp['picviewsize'] = array(
//          '_alert'  => euser_admin::render_fulltableline (null, LAN_EUSER_ADMIN_113I, 'alert',null, 'warning'),
          '_alert'  => euser_admin::render_fulltableline (null, LAN_EUSER_ADMIN_532I, 'alert',null, 'info'),
          '_tablestart'  => euser_admin::render_fulltableline (null, '<div class="row"><div class="col-md-6"><table class="table adminform"><tbody><tr>', null, null),
          'lightbox'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_533, 'type'=>'boolean','help' => LAN_EUSER_ADMIN_533H),
          'lightwindowbox'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_534, 'type'=>'boolean','help' => LAN_EUSER_ADMIN_534H),
          'lightview'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_535, 'type'=>'boolean','help' => LAN_EUSER_ADMIN_535H),
          'clearbox'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_536, 'type'=>'boolean','help' => LAN_EUSER_ADMIN_536H),
          '_tablestart1'  => euser_admin::render_fulltableline (null, '</table></div>', null, null),
);

//var_dump ($prefsexp['whatsnewpage']);
//echo "<hr>";

//--array_walk($prefsexp['picviewsize'], function(&$value, $key) { $value['writeParms'] = ((strpos($key, '_')===0)xor($value['type']=='text'))?array('pattern'=>'[0-9]*', 'size'=>'mini'):$value['writeParms']; });

//var_dump ($prefsexp['whatsnewpage']);
//--				$prefsexp['whatsnewpage']['shownews']['writeParms']['pre'] = "<div class='".(e107::isInstalled('news')?"":"hidden")."'>";
//        $prefsexp['whatsnewpage']['shownews']['writeParms']['post'] .= "</div>&nbsp;".euser_admin::label_installed('news', true);
//--        $prefsexp['whatsnewpage']['shownews']['writeParms']['post'] .= "&nbsp;".euser_admin::label_installed('news', true);
/*
        $prefsexp['whatsnewpage']['shownews']['title'] .= "&nbsp;".euser_admin::label_installed('news');
        if (!e107::isInstalled('news')){
        $prefsexp['whatsnewpage']['shownews']['writeParms']['pre'] .= "</td><td colspan=3><div class='hidden>'";
        $prefsexp['whatsnewpage']['shownews']['writeParms']['post'] .= "</div>&nbsp;".euser_admin::label_installed('news', true);
        }
        
        $prefsexp['whatsnewpage']['chatbox']['title'] .= "&nbsp;".euser_admin::label_installed('chatbox');
        if (!e107::isInstalled('chatbox')){
        $prefsexp['whatsnewpage']['chatbox']['writeParms']['pre'] .= "</td><td colspan=3><div class='hidden>'";
        $prefsexp['whatsnewpage']['chatbox']['writeParms']['post'] .= "</div>&nbsp;".euser_admin::label_installed('chatbox', true);
        }
*/
//--        $prefsexp['picviewsize']['commentsnum']['title'].="<br><span class='label label-important label-info'>".LAN_EUSER_ADMIN_119I."</span>";
//--				$prefsexp['picviewsize']['forumsummary']['writeParms']['label'] = LAN_EUSER_ADMIN_121E.'&'.LAN_EUSER_ADMIN_121D;

// Check installed
// Old
//--$this->checkinstalled ('news', 'shownewsnum', $prefsexp);
//--$this->checkinstalled ('chatbox', 'chatboxnum', $prefsexp);

//$checkarray = array('news'=>'shownewsnum', 'forum'=>'forumnum', 'forum'=>'forumsummary', 'downloads'=>'downloadsnum', 'chatbox_menu'=>'chatboxnum', 'chatbox2_menu'=>'chatboxIInum', 'coppermine_menu'=>'copperminenum', 'coppermine_menu'=>'copperminecommentsnum', 'guestbook'=>'guestbooknum', 'ytm_gallery'=>'youtubenum', 'kroozearcade_menu'=>'kroozearcadenum', 'kroozearcade_menu'=>'kroozearcadetopnum', 'links_page'=>'linksnum', 'bugtracker3'=>'bugtracker3commentsnum', 'jokes_menu'=>'jokenum', 'userjournals_menu'=>'blognum', 'suggestions_menu'=>'suggestionsnum');
$checkarray = array('lightbox'=>'lightbox', 'lightwindowbox'=>'lightwindowbox', 'lightview'=>'lightview', 'clearbox'=>'euser');

//function checkinstalled($plugname, $arrkey, &$prefsexp) {
//foreach ($data_array as $key => $value){
//foreach($checkarray as $plugname => $arrkey) {
foreach($checkarray as $arrkey => $plugname) {

//var_dump ($plugname);
//var_dump ($arrkey);
//echo "<hr>";

        $prefsexp['picviewsize'][$arrkey]['title'] .= "<br>".euser_admin::label_installed($plugname);
        if (!e107::isInstalled($plugname)){
//---        $prefsexp['whatsnewpage'][$arrkey]['class'] = "hidden";
//---        $prefsexp['whatsnewpage'][$arrkey]['writeParms']['class'] = "hidden";
//        $prefsexp['whatsnewpage'][$arrkey]['writeParms']['pre'] = "<div class='e-hideme'>";
        $prefsexp['picviewsize'][$arrkey]['writeParms']['disabled'] = 1;
//---        $prefsexp['whatsnewpage'][$arrkey]['writeParms']['post'] = euser_admin::label_installed($plugname, true);
        $prefsexp['picviewsize'][$arrkey]['writeParms']['post'] = "</div>";

        $prefsexp['picviewsize']['_tableend'] = euser_admin::render_fulltableline (null, euser_admin::linkbutton("../../e107_admin/plugin.php", LAN_EUSER_ADMIN_123, "danger"), null, null);
        $prefsexp['picviewsize']['_tableend']['writeParms']['pre'] = "<center>";
        }
}

foreach ($prefsexp as $key => $value){
//$frm = e107::getForm();
//					$this->prefs[$key]['writeParms']['post'] = create_expandit_container ($key, $value);
//          var_dump ($value);
					$this->prefs[$key]['writeParms']['post'] .= euser_admin::render_expandedcontainer ($key, $value);
}
/*
          		$categories = array();
		if(e107::getDb()->select('featurebox_category'))
		{
			while ($row = e107::getDb()->fetch())
			{
				$id = $row['fb_category_id'];
				$tmpl = $row['fb_category_template'];
				$categories[$id] = $row['fb_category_title'];
				$menuCat[$tmpl] = $row['fb_category_title'];
			}
		}

		$this->fields['fb_category']['writeParms'] 		= $categories;	
		$this->fields['fb_category']['readParms'] 		= $categories;
		
		unset($menuCat['unassigned']);
		
		$this->prefs['menu_category']['writeParms']['optArray'] 	= $menuCat;
		$this->prefs['menu_category']['readParms']['optArray'] 		= $menuCat;
*/
//     	$mes = e107::getMessage();
//	    $message = LAN_EUSER_ADMIN_SHAREDCONFIG;
//			e107::getMessage()->addInfo(LAN_EUSER_ADMIN_SHAREDCONFIG);

	}
		
}

class euser_profile_form_ui extends e_admin_form_ui
{
	function _header($curVal,$mode)
	{
    return "<span class='text-info'>".LAN_EUSER_ADMIN_515."</span>";
  }
	function _header1($curVal,$mode)
	{
    return "<span class='text-info'>".LAN_EUSER_ADMIN_521."</span>";
  }
	function _header2($curVal,$mode)
	{
    return "<span class='text-info'>".LAN_EUSER_ADMIN_531."</span>";
  }
	function _header3($curVal,$mode)
	{
    return "<span class='text-info'>".LAN_EUSER_ADMIN_543."</span>";
  }
	function imagewidth($curVal,$mode)
	{
		
		$frm = e107::getForm();
		
    $text .= '<div class="pull-left">';
    $text .= $frm->renderElement('imagewidth', $curVal, array('type'=>'text', 'help' => LAN_EUSER_ADMIN_537H));
    $text .= '</div><div class="pull-left text-center">&nbsp;&nbsp;X&nbsp;&nbsp;</div><div class="pull-left">';
    $text .= $frm->renderElement('imageheight', e107::getPlugPref('euser')['imageheight'], array('type'=>'text', 'help' => LAN_EUSER_ADMIN_537H));
    $text .= '</div></div>';

		return $text;
	}

	function avatarwidth($curVal,$mode)
	{

		$frm = e107::getForm();
		
    $text .= '<div class="pull-left">';
    $text .= $frm->renderElement('avatarwidth', $curVal, array('type'=>'text', 'help' => LAN_EUSER_ADMIN_538H));
    $text .= '</div><div class="pull-left text-center">&nbsp;&nbsp;X&nbsp;&nbsp;</div><div class="pull-left">';
    $text .= $frm->renderElement('avatarheight', e107::getPlugPref('euser')['avatarheight'], array('type'=>'text', 'help' => LAN_EUSER_ADMIN_538H));
    $text .= '</div></div>';

		return $text;
	}

}		

class euser_memberlist_ui extends e_admin_ui
{
	//TODO Move to Class above. 
	protected $pluginTitle		= LAN_EUSER_FULLNAME;
	protected $pluginName		= 'euser';
//	protected $table			= "featurebox";	
//	protected $pid 				= "fb_id";
	protected $perPage 			= 10;
	protected $batchDelete 		= true;
	protected $batchCopy 		= true;
	protected $sortField		= 'fb_order';
	protected $orderStep 		= 1;
	protected $listOrder 		= 'fb_order asc';

  protected $preftabs			= array(LAN_OPTIONS,LAN_EUSER_ADMIN_646); 
	protected $prefs = array( 
  				'memberlist_access'  => array('title'=> LAN_EUSER_ADMIN_601, 'type'=>'userclass', 'tab' => 0, 'writeParms'=>array('class'=>'pull-left')),
  				'memberlist_direction'  => array('title'=> LAN_EUSER_ADMIN_602,'tab' => 0,  'type'=>'dropdown', 'writeParms'=>array('optArray'=> array('user_name'=> LAN_EUSER_ADMIN_603,'user_email'=> LAN_EUSER_ADMIN_604,'user_id'=> LAN_EUSER_ADMIN_605,'user_currentvisit'=> LAN_EUSER_ADMIN_606,'user_visits'=> LAN_EUSER_ADMIN_607))),
//  				'memberlist_order'  => array('title'=> LAN_EUSER_ADMIN_608,'tab' => 0,  'type'=>'dropdown', 'writeParms'=>array('optArray'=> array('ASC'=> LAN_EUSER_ADMIN_609,'DESC'=> LAN_EUSER_ADMIN_610))),
  				'memberlist_order'  => array('title'=> LAN_EUSER_ADMIN_608,'tab' => 0,  'type'=>'radio', 'writeParms'=>array('ASC'=> LAN_EUSER_ADMIN_609,'DESC'=> LAN_EUSER_ADMIN_610)),
//  				'memberlist_bcard'  => array('title'=> LAN_EUSER_ADMIN_611,'tab' => 0,  'type'=>'dropdown', 'writeParms'=>array('optArray'=> array('line'=> LAN_EUSER_ADMIN_612,'bcard'=> LAN_EUSER_ADMIN_613))),
  				'memberlist_bcard'  => array('title'=> LAN_EUSER_ADMIN_611,'tab' => 0,  'type'=>'radio', 'writeParms'=>array('line'=> LAN_EUSER_ADMIN_612,'bcard'=> LAN_EUSER_ADMIN_613)),
//  				'bcard_css'  => array('title'=> LAN_EUSER_ADMIN_614,'tab' => 0,  'type'=>'dropdown', 'writeParms'=>array('optArray'=> array('auto'=> LAN_EUSER_ADMIN_615,'lite'=> LAN_EUSER_ADMIN_616,'dark'=> LAN_EUSER_ADMIN_617))),
  				'bcard_css'  => array('title'=> LAN_EUSER_ADMIN_614,'tab' => 0,  'type'=>'radio', 'writeParms'=>array('auto'=> LAN_EUSER_ADMIN_615,'lite'=> LAN_EUSER_ADMIN_616,'dark'=> LAN_EUSER_ADMIN_617)),
  				'bcard_column'  => array('title'=> LAN_EUSER_ADMIN_618, 'tab' => 0, 'type'=>'text','help' => LAN_EUSER_ADMIN_304H),
  				'memberlist_class'  => array('title'=> LAN_EUSER_ADMIN_619, 'tab' => 0, 'type'=>'text','help' => LAN_EUSER_ADMIN_619H),
  				'memberlist_color_up'  => array('title'=> LAN_EUSER_ADMIN_620, 'tab' => 0, 'type'=>'text','help' => LAN_EUSER_ADMIN_620H),
  				'memberlist_color_down'  => array('title'=> LAN_EUSER_ADMIN_621, 'tab' => 0, 'type'=>'text','help' => LAN_EUSER_ADMIN_620H),
  				'memberlist_addtofriend'  => array('title'=> LAN_EUSER_ADMIN_622, 'tab' => 0, 'type'=>'boolean','help' => LAN_EUSER_ADMIN_622H),

////  				'memberlist_column_avatar'  => array('title'=> LAN_EUSER_ADMIN_624, 'tab' => 0, 'type'=>'boolean'),

  				'_checkboxgroup0'  => array('title'=> LAN_EUSER_ADMIN_623, 'tab' => 0, 'type'=>'method','help' => LAN_EUSER_ADMIN_623H),
          'memberlist_filter'  => array('title'=> LAN_EUSER_ADMIN_634,'tab' => 0, 'type'=>'userclass', 'writeParms' => 'classlist=public,member,classes,admin,main', 'help' => LAN_EUSER_ADMIN_634H),
  				'member_info'  => array('title'=> LAN_EUSER_ADMIN_635, 'tab' => 0, 'type'=>'boolean','help' => LAN_EUSER_ADMIN_635H),
  				'_checkboxgroup1'  => array('title'=> LAN_EUSER_ADMIN_636, 'tab' => 0, 'type'=>'method','help' => LAN_EUSER_ADMIN_636H),
  				'member_ext_search'  => array('title'=> LAN_EUSER_ADMIN_643, 'tab' => 0, 'type'=>'boolean'),
  				'_checkboxgroup2'  => array('title'=> LAN_EUSER_ADMIN_644, 'tab' => 0, 'type'=>'method','help' => LAN_EUSER_ADMIN_644H),
          'top_class'  => array('title'=> LAN_EUSER_ADMIN_647,'tab' => 1, 'type'=>'userclass', 'writeParms' => 'classlist=public,member,classes,admin,main'),
  				'top_bcard_column'  => array('title'=> LAN_EUSER_ADMIN_618, 'tab' => 1, 'type'=>'text','help' => LAN_EUSER_ADMIN_648H),
  				'top_x'  => array('title'=> LAN_EUSER_ADMIN_649, 'tab' => 1, 'type'=>'text','help' => LAN_EUSER_ADMIN_649H),
  				'_checkboxgroup3'  => array('title'=> LAN_EUSER_ADMIN_650, 'tab' => 1, 'type'=>'method'),
  				'top_noadmin'  => array('title'=> LAN_EUSER_ADMIN_658, 'tab' => 1, 'type'=>'boolean'),
	);
	
	function init()
	{
//          var_dump (e107::getPlugPref('euser','redirect_usersettings'));
//          var_dump (e107::getPlugPref('euser','redirect'));

					$this->prefs['memberlist_access']['writeParms']['post'] = "&nbsp;<span class='label label-important label-info'>".LAN_EUSER_ADMIN_601I."</span>";
          
/*
          		$categories = array();
		if(e107::getDb()->select('featurebox_category'))
		{
			while ($row = e107::getDb()->fetch())
			{
				$id = $row['fb_category_id'];
				$tmpl = $row['fb_category_template'];
				$categories[$id] = $row['fb_category_title'];
				$menuCat[$tmpl] = $row['fb_category_title'];
			}
		}

		$this->fields['fb_category']['writeParms'] 		= $categories;	
		$this->fields['fb_category']['readParms'] 		= $categories;
		
		unset($menuCat['unassigned']);
		
		$this->prefs['menu_category']['writeParms']['optArray'] 	= $menuCat;
		$this->prefs['menu_category']['readParms']['optArray'] 		= $menuCat;

*/
//     	$mes = e107::getMessage();
//	    $message = LAN_EUSER_ADMIN_SHAREDCONFIG;
//			e107::getMessage()->addInfo(LAN_EUSER_ADMIN_SHAREDCONFIG);

	}
		
}

class euser_memberlist_form_ui extends e_admin_form_ui
{
	function _checkboxgroup0($curVal,$mode)
	{
		$frm = e107::getForm();
		
		$groupCheckboxes = array("memberlist_column_avatar" => LAN_EUSER_ADMIN_624, "memberlist_column_online" => LAN_EUSER_ADMIN_625,"memberlist_column_realname" => LAN_EUSER_ADMIN_626,"memberlist_column_loginname" => LAN_EUSER_ADMIN_603,"memberlist_column_email" => LAN_EUSER_ADMIN_604,"memberlist_column_join" => LAN_EUSER_ADMIN_605,"memberlist_column_lastvisit" => LAN_EUSER_ADMIN_606,"memberlist_column_visits" => LAN_EUSER_ADMIN_607,"memberlist_column_timezone" => LAN_EUSER_ADMIN_632,"memberlist_column_userip" => LAN_EUSER_ADMIN_633);
	
		$groupOpts = e107::getPlugPref('euser');
//		$text = "";
			var_dump($_POST);
//    $v = 1;
		foreach($groupCheckboxes as $k => $t)
		{
//			$checked = isset($groupOpts[$k]) ? true : false;
//			var_dump($groupOpts[$k]);
/////////			$checked = isset($groupOpts[$k]);
//			$text .= $frm->checkbox('check_opts['.$k.']', $k, $checked, array('label'=>$t));	
//////////////			$text .= $frm->checkbox('check_opts['.$k.']',$k, $checked, array('label'=>$t));	
			$text .= "<span class='pull-left'>".$t.":&nbsp;</span>".$frm->radio_switch($k, null, LAN_ON, LAN_OFF);	

//      $v ++;
		}

/*
		$Checkboxes = array("memberlist_column_avatar" => array('title'=> LAN_EUSER_ADMIN_624, 'type'=>'checkbox'),
     "memberlist_column_online" => array('label'=> LAN_EUSER_ADMIN_625, 'type'=>'checkbox'),
     "memberlist_column_realname" => array('title'=> LAN_EUSER_ADMIN_626, 'type'=>'checkbox'),
     "memberlist_column_loginname" => array('title'=> LAN_EUSER_ADMIN_627, 'type'=>'checkbox'),
     "memberlist_column_email" => array('title'=> LAN_EUSER_ADMIN_628, 'type'=>'checkbox'),
     "memberlist_column_join" => array('title'=> LAN_EUSER_ADMIN_629, 'type'=>'checkbox'),
     "memberlist_column_lastvisit" => array('title'=> LAN_EUSER_ADMIN_630, 'type'=>'checkbox'),
     "memberlist_column_visits" => array('title'=> LAN_EUSER_ADMIN_631, 'type'=>'checkbox'),     
     "memberlist_column_timezone" => array('title'=> LAN_EUSER_ADMIN_632, 'type'=>'checkbox'),
     "memberlist_column_userip" => array('title'=> LAN_EUSER_ADMIN_633, 'type'=>'checkbox'),
     "memberlist_column_online" => array('title'=> LAN_EUSER_ADMIN_625, 'type'=>'checkbox'),
     "memberlist_column_online" => array('title'=> LAN_EUSER_ADMIN_625, 'type'=>'checkbox'));

		foreach($Checkboxes as $key => $value){
        $text .= $frm->renderElement($key, e107::getPlugPref('euser')[$key], $value);
    }		
*/
		$text .= $frm->admin_button('check_all', 'jstarget:check_opts', 'checkall', LAN_CHECKALL)."&nbsp;&nbsp;".$frm->admin_button('uncheck_all', 'jstarget:check_opts', 'checkall', LAN_UNCHECKALL);
	
		return $text;
  }

	function _checkboxgroup1($curVal,$mode)
	{
		$frm = e107::getForm();
		
		$groupCheckboxes = array("memberlist_forum_info" => LAN_EUSER_ADMIN_637, "memberlist_comment_1_info" => LAN_EUSER_ADMIN_119,"memberlist_comment_info" => LAN_EUSER_ADMIN_510,"memberlist_pic_info" => LAN_EUSER_ADMIN_640,"memberlist_vid_info" => LAN_EUSER_ADMIN_641,"memberlist_mp3_info" => LAN_EUSER_ADMIN_642);
	
		$groupOpts = e107::getPlugPref('euser');
//		$text = "";
//    $v = 1;
		foreach($groupCheckboxes as $k => $t)
		{
//			$checked = isset($groupOpts[$k]) ? true : false;
//			var_dump($groupOpts[$k]);
			$checked = isset($groupOpts[$k]);
//			$text .= $frm->checkbox('check_opts['.$k.']', $k, $checked, array('label'=>$t));	
			$text .= $frm->checkbox('check_opts1['.$k.']',$k, $checked, array('label'=>$t));	
//      $v ++;
		}

		$text .= $frm->admin_button('check_all', 'jstarget:check_opts1', 'checkall', LAN_CHECKALL)."&nbsp;&nbsp;".$frm->admin_button('uncheck_all', 'jstarget:check_opts1', 'checkall', LAN_UNCHECKALL);
	
		return $text;
  }

  	function _checkboxgroup2($curVal,$mode)
	{
		$frm = e107::getForm();
		
		$groupCheckboxes = array("user_search_username" => LAN_EUSER_ADMIN_603, "user_search_realname" => LAN_EUSER_ADMIN_626,"user_search_loginname" => LAN_EUSER_ADMIN_627,"user_search_email" => LAN_EUSER_ADMIN_604,"user_search_ip" => LAN_EUSER_ADMIN_633,"user_search_groupname" => LAN_EUSER_ADMIN_645);
	
		$groupOpts = e107::getPlugPref('euser');
//		$text = "";
//    $v = 1;
		foreach($groupCheckboxes as $k => $t)
		{
//			$checked = isset($groupOpts[$k]) ? true : false;
//			var_dump($groupOpts[$k]);
			$checked = isset($groupOpts[$k]);
//			$text .= $frm->checkbox('check_opts['.$k.']', $k, $checked, array('label'=>$t));	
			$text .= $frm->checkbox('check_opts2['.$k.']',$k, $checked, array('label'=>$t));	
//      $v ++;
		}

		$text .= $frm->admin_button('check_all', 'jstarget:check_opts2', 'checkall', LAN_CHECKALL)."&nbsp;&nbsp;".$frm->admin_button('uncheck_all', 'jstarget:check_opts2', 'checkall', LAN_UNCHECKALL);
	
		return $text;
  }

  	function _checkboxgroup3($curVal,$mode)
	{
		$frm = e107::getForm();
		
		$groupCheckboxes = array("top_level" => LAN_EUSER_ADMIN_651, "top_forums" => LAN_EUSER_ADMIN_652,"top_comments" => LAN_EUSER_ADMIN_653,"top_chatbox" => LAN_EUSER_ADMIN_654,"top_rate" => LAN_EUSER_ADMIN_655,"top_profile" => LAN_EUSER_ADMIN_656,"top_friends" => LAN_EUSER_ADMIN_657);
	
		$groupOpts = e107::getPlugPref('euser');
//		$text = "";
//    $v = 1;
		foreach($groupCheckboxes as $k => $t)
		{
//			$checked = isset($groupOpts[$k]) ? true : false;
//			var_dump($groupOpts[$k]);
			$checked = isset($groupOpts[$k]);
//			$text .= $frm->checkbox('check_opts['.$k.']', $k, $checked, array('label'=>$t));	
			$text .= $frm->checkbox('check_opts2['.$k.']',$k, $checked, array('label'=>$t));	
//      $v ++;
		}

		$text .= $frm->admin_button('check_all', 'jstarget:check_opts2', 'checkall', LAN_CHECKALL)."&nbsp;&nbsp;".$frm->admin_button('uncheck_all', 'jstarget:check_opts2', 'checkall', LAN_UNCHECKALL);
	
		return $text;
  }

}		

/*				
class euser_cache_ui extends e_admin_ui
{
			
		protected $pluginTitle		= LAN_EUSER_FULLNAME;
		protected $pluginName		= 'euser';
	//	protected $eventName		= 'euser-euser_cache'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'euser_cache';
		protected $pid				= '';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
	//	protected $batchCopy		= true;		
	//	protected $sortField		= 'somefield_order';
	//	protected $orderStep		= 10;
	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= ' DESC';
	
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'type' =>   array ( 'title' => LAN_TYPE, 'type' => 'dropdown', 'data' => 'str', 'width' => 'auto', 'batch' => true, 'filter' => true, 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'cache_name' =>   array ( 'title' => LAN_TITLE, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'cache' =>   array ( 'title' => 'Cache', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'cache_hide' =>   array ( 'title' => 'Hide', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'cache_records' =>   array ( 'title' => 'Records', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'cache_userclass' =>   array ( 'title' => 'Userclass', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'cache_timestamp' =>   array ( 'title' => 'Timestamp', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'cache_active' =>   array ( 'title' => 'Active', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'type_order' =>   array ( 'title' => LAN_ORDER, 'type' => 'number', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'options' =>   array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),
		);		
		
		protected $fieldpref = array('type', 'cache_name');
		

	//	protected $preftabs        = array('General', 'Other' );
		protected $prefs = array(
		); 

	
		public function init()
		{
			// Set drop-down values (if any). 
			$this->fields['type']['writeParms']['optArray'] = array('type_0','type_1', 'type_2'); // Example Drop-down array. 
	
		}

		
		// ------- Customize Create --------
		
		public function beforeCreate($new_data,$old_data)
		{
			return $new_data;
		}
	
		public function afterCreate($new_data, $old_data, $id)
		{
			// do something
		}

		public function onCreateError($new_data, $old_data)
		{
			// do something		
		}		
		
		
		// ------- Customize Update --------
		
		public function beforeUpdate($new_data, $old_data, $id)
		{
			return $new_data;
		}

		public function afterUpdate($new_data, $old_data, $id)
		{
			// do something	
		}
		
		public function onUpdateError($new_data, $old_data, $id)
		{
			// do something		
		}		
		
			
/*	/*	
		// optional - a custom page.  
		public function customPage()
		{
			$text = 'Hello World!';
			$otherField  = $this->getController()->getFieldVar('other_field_name');
			return $text;
			
		}
	*/    /*
			
}
				
class euser_cache_form_ui extends e_admin_form_ui
{

}		
*/

class euser_whatsnew_ui extends e_admin_ui
{
	//TODO Move to Class above. 
	protected $pluginTitle		= LAN_EUSER_FULLNAME;
	protected $pluginName		= 'euser';
//	protected $table			= "featurebox";	
//	protected $pid 				= "fb_id";
/*
	protected $perPage 			= 10;
	protected $batchDelete 		= true;
	protected $batchCopy 		= true;
	protected $sortField		= 'fb_order';
	protected $orderStep 		= 1;
	protected $listOrder 		= 'fb_order asc';
*/	
/* ---
	protected $fields = array(
		'checkboxes'		=> array('title'=> '',					'type' => null, 			'width' =>'5%', 'forced'=> TRUE, 'thclass'=>'center first', 'class'=>'center'),
		'fb_id'				=> array('title'=> LAN_ID,				'type' => 'number',			'data'=> 'int', 'width' =>'5%', 'forced'=> TRUE),
     	'fb_category' 		=> array('title'=> LAN_CATEGORY,		'type' => 'dropdown',		'inline'=>true,  'data'=> 'int',	'width' => '10%',  'filter'=>TRUE, 'batch'=>TRUE),
		'fb_title' 			=> array('title'=> LAN_TITLE,			'type' => 'text',			'inline'=>true,  'width' => 'auto', 'thclass' => 'left'), 
    	'fb_image' 			=> array('title'=> "Image/Video",		'type' => 'image',			'width' => '100px', 'readParms'=>'thumb=60&thumb_urlraw=0&thumb_aw=60','writeParms'=>'size=xxlarge&media=featurebox&video=1'),
	
	 	'fb_text' 			=> array('title'=> FBLAN_08,			'type' => 'bbarea',			'width' => '30%', 'readParms' => 'expand=...&truncate=50&bb=1','writeParms'=>'template=admin'), 
		//DEPRECATED 'fb_mode' 			=> array('title'=> FBLAN_12,			'type' => 'dropdown',		'data'=> 'int',	'width' => '5%', 'filter'=>TRUE, 'batch'=>TRUE),		
		//DEPRECATED 'fb_rendertype' 	=> array('title'=> FBLAN_22,			'type' => 'dropdown',		'data'=> 'int',	'width' => 'auto', 'noedit' => TRUE),	
        'fb_template' 		=> array('title'=> LAN_TEMPLATE,			'type' => 'layouts',		'data'=> 'str', 'width' => 'auto', 'writeParms' => 'plugin=featurebox', 'filter' => true, 'batch' => true),	 	// Photo
		'fb_imageurl' 		=> array('title'=> "Image Link",		'type' => 'url',			'width' => 'auto','writeParms'=>'size=xxlarge'),
		'fb_class' 			=> array('title'=> LAN_VISIBILITY,		'type' => 'userclass',		'data' => 'int', 'inline'=>true, 'width' => 'auto', 'filter' => true, 'batch' => true),	// User id
		'fb_order' 			=> array('title'=> LAN_ORDER,			'type' => 'number',			'data'=> 'int','width' => '5%' ),
		'options' 			=> array('title'=> LAN_OPTIONS,			'type' => null,				'forced'=>TRUE, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center', 'readParms'=>'sort=1')
	);
	 
	protected $fieldpref = array('checkboxes', 'fb_id', 'fb_category', 'fb_title', 'fb_template', 'fb_class', 'fb_order', 'options');
*/	
/*
	protected $prefs = array( 
		'menu_category'	   	=> array('title'=> "Featurebox Menu Category", 'type'=>'dropdown', 'help' => 'Category to use for the featurebox menu')
	);
*/
	  protected $preftabs			= array(LAN_OPTIONS,LAN_EUSER_ADMIN_113); 
  	protected $prefs = array( 
// Prefs que não estavam no config do OIM, mas estão no menu agora... Passaram para aqui. TODO: verificar lan's

  					'showregusers'  => array('title'=> LAN_EUSER_ADMIN_102,'tab' => 0, 'type' => 'userclass',		'width' => 'auto', 'data' => 'int', 'inline'=>true),
					  'autohideregusers'  => array('title'=> LAN_EUSER_ADMIN_103,'tab' => 0, 'type'=>'boolean'),
//--- Deprecated					  'flashtext'  => array('title'=> LAN_EUSER_ADMIN_104,'tab' => 0, 'type'=>'boolean', 'writeParms'=>array('class'=>'e-expandit')),
					  'flashcolor'  => array('title'=> LAN_EUSER_ADMIN_105,'tab' => 0, 'type'=>'text', 'help' => LAN_EUSER_ADMIN_COLORH, 'inline'=>true, 'writeParms'=>array('class'=>'colorpicker pull-left')),
//--- Deprecated					  'new_icon'  => array('title'=> LAN_EUSER_ADMIN_106,'tab' => 0, 'type'=>'boolean', 'writeParms'=>array('class'=>'e-expandit')),
					  'new_icontype'  => array('title'=> LAN_EUSER_ADMIN_107,'tab' => 0, 'type'=>'dropdown', 'writeParms'=>array('optArray'=> array(''=> LAN_OFF,'new.gif'=> LAN_EUSER_ADMIN_108,'new2.gif'=> LAN_EUSER_ADMIN_109)), 'help' => LAN_EUSER_ADMIN_107H),
// Start flash color test line
//					  'flashtext_testline'  => array('title'=> LAN_EUSER_ADMIN_104, 'tab' => 0, 'type'=>'boolean', 'writeParms'=>array('class'=>'e-expandit')),
// End flash color test line



					  'hideifnonew'  => array('title'=> LAN_EUSER_ADMIN_110,'tab' => 0, 'type'=>'boolean', 'help'=>LAN_EUSER_ADMIN_110H),
					  'hideadminarea'  => array('title'=> LAN_EUSER_ADMIN_111,'tab' => 0, 'type'=>'boolean', 'writeParms'=>array('id' => 'hideadminarea')),
					  'autohideadminarea'  => array('title'=> LAN_EUSER_ADMIN_112,'tab' => 0, 'type'=>'boolean', 'writeParms'=>array('pre' => '<fieldset id="autohideadminarea">')),

//  					'whatsnewpage'  => array('title'=> LAN_EUSER_ADMIN_101, 'type'=>'boolean','tab' => 1, 'writeParms'=>'enabled=LAN_EUSER_ADMIN_101E&disabled=LAN_EUSER_ADMIN_101D'),
// Teste
//  					'whatsnewpage'  => array('title'=> LAN_EUSER_ADMIN_101, 'type'=>'boolean', 'tab' => 1, 'writeParms'=>array('enabled' => LAN_EUSER_ADMIN_101E, 'disabled' => LAN_EUSER_ADMIN_101D, 'class'=>'e-expandit')),
// Minha versão...
//  					'whatsnewpage'  => array('title'=> LAN_EUSER_ADMIN_101, 'type'=>'boolean', 'tab' => 1),
  				'whatsnewpage'  => array('title'=> LAN_EUSER_ADMIN_101,'tab' => 1,  'type'=>'boolean', 'writeParms'=>array('enabled'=> LAN_EUSER_ADMIN_101E,'disabled'=> LAN_EUSER_ADMIN_101D)),
          
// Depois tenho de arranjar forma de por aqui um toggle: data-toggle="collapse" data-target="#demo"   https://www.w3schools.com/bootstrap/bootstrap_collapse.asp          
          '_morewhatsnew' => array('type'=>'method','tab' => 1, 'writeParms'=>array('nolabel'=>2)),

//          'info1'  => array('title'=> ' ', 'tab' => 1, 'type' => 'text', 'writeParms'=>array('id'=>'e-hideme'))
// Os id só funcionam dentro dos writeParms...


//          $this->prefs['whatsnewpage']['writeParms'] = array('post' =>  '</td></tr><tr><td colspan=2><div class="alert alert-info text-center">'.LAN_EUSER_ADMIN_113I.'</div>');
//          'info1'  => array('title'=> ' ', 'tab' => 1, 'type' => 'text', )
//          []['writeParms']['post']  => '<span class="btn btn-info btn-block">'.LAN_EUSER_ADMIN_113I.'</span>'),

	);

/**
 * Removes an item from the array and returns its value.
 *
 * @param array $arr The input array
 * @param $key The key pointing to the desired value
 * @return The value mapped to $key or null if none
 */
/*
private function array_remove(array &$arr, $key) {
    if (array_key_exists($key, $arr)) {
        $val = $arr[$key];
        unset($arr[$key]);

        return $val;
    }

    return null;
}
*/
	public function init()
		{
        e107::js("footer-inline","$('input:hidden[name=\'whatsnewpage\']').on('change', function () {
if (this.value==0)  {
  $('#collapsible').collapse('hide');
  }
  else
  {
  $('#collapsible').collapse('show');
  }
});");

					$this->prefs['flashcolor']['writeParms']['post'] = "&nbsp;<span class='label label-important label-info'>".LAN_EUSER_ADMIN_105I."</span>";
//  					'whatsnewpage'  'enabled' => LAN_EUSER_ADMIN_101E, 'disabled' => LAN_EUSER_ADMIN_101D, 'class'=>'e-expandit')),
//					$this->prefs['whatsnewpage']['writeParms']['enabled'] = LAN_EUSER_ADMIN_101E;
//					$this->prefs['whatsnewpage']['writeParms']['disabled'] = LAN_EUSER_ADMIN_101D;
// Início da minha versão...
//----					$this->prefs['whatsnewpage']['writeParms']['label'] = LAN_EUSER_ADMIN_101E.'&'.LAN_EUSER_ADMIN_101D;
//----					$this->prefs['whatsnewpage']['writeParms']['class'] = 'e-expandit';
// Fim da minha versão, acima...
//					$this->prefs['whatsnewpage']['writeParms']['post'] = '<div class="alert alert-info text-center">'.LAN_EUSER_ADMIN_113I.'</div><table><th><td>1</td><td>2</td><td>3</td><td>4</td></th><tr><td>';

//$frm = e107::getForm();
// Start flash color test line
//					$this->prefs['flashtext']['writeParms']['pre'] = "<div class='form-inline' style=''>";
//					$this->prefs['flashcolor']['writeParms']['pre'] = "<div class='e-expandit-container e-hideme'>";
//					$this->prefs['flashcolor']['writeParms']['post'] = "</div></div>";

//					$this->prefs['flashtext_testline']['writeParms']['pre'] = "<div class='form-inline' style=''>";
//var_dump ($this);
//var_dump (e107::getPlugPref('euser')['flashtext']);
//					$this->prefs['flashtext']['writeParms']['post'] = "<div class='e-expandit-container ".(e107::getPlugPref('euser')['flashtext']==0?"":"e-hideme")."'>". LAN_EUSER_ADMIN_105."&nbsp;<input name='flashcolor' value='".e107::getPlugPref('euser')['flashcolor']."' maxlength='32' id='flashcolor' class='colorpicker tbox form-control ui-state-valid form-inline' data-original-title='' title='".LAN_EUSER_ADMIN_COLORH."'' type='text'></div></div>";
//--$flashcolor = $this->array_remove($this->prefs, 'flashcolor');
//var_dump ($flashcolor);
//var_dump (e107::getPlugPref('euser')['flashtext']);
//var_dump (e107::getPlugPref('euser')['flashtext']==0);
//					$this->prefs['flashtext']['writeParms']['post'] = "<div class='e-expandit-container ".(e107::getPlugPref('euser')['flashtext']==0?"":"e-hideme")."'>". $frm->renderElement('flashcolor', e107::getPlugPref('euser')['flashcolor'], array('title'=> LAN_EUSER_ADMIN_105,'tab' => 0, 'type'=>'text', 'help' => LAN_EUSER_ADMIN_COLORH, 'writeParms'=>array('class'=>'colorpicker', 'trClass' => 'e-expandit-container e-hideme')))."</div>";
//--					$this->prefs['flashtext']['writeParms']['post'] = "<div class='e-expandit-container ".(e107::getPlugPref('euser')['flashtext']==0?"":"e-hideme")."'><span class='form-inline'>".$flashcolor['title']." ".$frm->renderElement('flashcolor', e107::getPlugPref('euser')['flashcolor'], $flashcolor)."</span></div>";
//--- Deprecated          $prefsexp['flashtext'] = array('flashcolor'  => array('title'=> LAN_EUSER_ADMIN_105,'tab' => 0, 'type'=>'text', 'help' => LAN_EUSER_ADMIN_COLORH, 'writeParms'=>array('class'=>'colorpicker')));
//          $prefsexp = array('flashcolor'  => array('title'=> LAN_EUSER_ADMIN_105,'tab' => 0, 'type'=>'text', 'help' => LAN_EUSER_ADMIN_COLORH, 'writeParms'=>array('class'=>'colorpicker')));
//					$this->prefs['flashtext']['writeParms']['post'] = create_expandit_container ('flashtext', $prefsexp);

//renderElement($key, $value, $attributes, $required_data = array(), $id = 0)

//					$this->prefs['new_icon']['writeParms']['post'] = "<div class='e-expandit-container ".(e107::getPlugPref('euser')['new_icontype']==0?"":"e-hideme")."'>". LAN_EUSER_ADMIN_107."&nbsp;<input name='new_icontype' value='".e107::getPlugPref('euser')['new_icontype']."' maxlength='32' id='new_icontype' class='tbox form-control ui-state-valid form-inline' data-original-title='' title='".LAN_EUSER_ADMIN_107H."'' type='text'></div></div>";
//--$new_icontype = $this->array_remove($this->prefs, 'new_icontype');
//var_dump (e107::getPlugPref('euser')['new_icon']);
//var_dump (e107::getPlugPref('euser')['new_icon']==0);
//--					$this->prefs['new_icon']['writeParms']['post'] = "<div class='e-expandit-container ".(e107::getPlugPref('euser')['new_icon']==0?"e-hideme":"")."'><span class='form-inline'>".$new_icontype['title']." ".$frm->renderElement('new_icontype', e107::getPlugPref('euser')['new_icontype'], $new_icontype)."</span></div>";

//--- Deprecated          $prefsexp['new_icon'] = array('new_icontype'  => array('title'=> LAN_EUSER_ADMIN_107,'tab' => 0, 'type'=>'dropdown', 'writeParms'=>array('optArray'=> array('new.gif'=> LAN_EUSER_ADMIN_108,'new2.gif'=> LAN_EUSER_ADMIN_109)), 'help' => LAN_EUSER_ADMIN_107H),);
//          $prefsexp = array('new_icontype'  => array('title'=> LAN_EUSER_ADMIN_107,'tab' => 0, 'type'=>'dropdown', 'writeParms'=>array('optArray'=> array('new.gif'=> LAN_EUSER_ADMIN_108,'new2.gif'=> LAN_EUSER_ADMIN_109)), 'help' => LAN_EUSER_ADMIN_107H),);
//					$this->prefs['new_icon']['writeParms']['post'] = create_expandit_container ('new_icon', $prefsexp);
//          $prefsexp['whatsnewpage']['_new'] = euser_admin::render_fulltableline ('info', LAN_EUSER_ADMIN_113I, 'alert',1);
//          '<div class="alert alert-info text-center">'.LAN_EUSER_ADMIN_113I.'</div><table><th><td>1</td><td>2</td><td>3</td><td>4</td></th><tr><td>';
/*          
          $prefsexp['whatsnewpage'] = array(
//          '_alert'  => euser_admin::render_fulltableline (null, LAN_EUSER_ADMIN_113I, 'alert',null, 'warning'),
          '_alert'  => euser_admin::render_fulltableline (null, LAN_EUSER_ADMIN_113I, 'alert',null, 'warning'),
          '_tablestart'  => euser_admin::render_fulltableline (null, '<div class="row"><div class="col-md-6"><table class="table adminform"><tr><th><center>'.LAN_EUSER_ADMIN_114.'</th><th><center>'.LAN_EUSER_ADMIN_115.'</th></tr><tbody><tr>', null, null),

//					$this->prefs['flashcolor']['writeParms']['post'] = "&nbsp;<span class='label label-important label-info'>".LAN_EUSER_ADMIN_105I."</span>";
//          '_table'  => euser_admin::render_fulltableline (null, '----', null, null),
//          '_tablehead'  => euser_admin::render_fulltableline (null, '<tr><th>'.LAN_EUSER_ADMIN_114.'</th><th>'.LAN_EUSER_ADMIN_115.'</th><th>'.LAN_EUSER_ADMIN_116.'</th><th>'.LAN_EUSER_ADMIN_117.'</th></tr>', null, null),

/*
          'shownews'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_116, 'type'=>'boolean', 'writeParms'=>array('pre'=>'</td><td>','post'=>euser_admin::render_postablerow(array(
          'shownewsnum' => array ('type'=>'text', 'writeParms'=>array('pattern'=>'[0-9]*', 'size'=>'mini'))
          )))),
*/
//          'shownewsnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_116, 'type'=>'text', 'writeParms'=>array('pattern'=>'[0-9]*', 'size'=>'mini', 'help'=>LAN_EUSER_ADMIN_115H)),
/*
          'shownewsnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_116, 'type'=>'text'),
/*
           'content'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_117, 'type'=>'boolean', 'writeParms'=>array('pre'=>'</td><td>','post'=>euser_admin::render_postablerow(array(
          'contentnum' => array ('type'=>'text', 'writeParms'=>array('pattern'=>'[0-9]*', 'size'=>'mini'))
          )))),
*/
//           'contentnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_117, 'type'=>'text', 'writeParms'=>array('pattern'=>'[0-9]*', 'size'=>'mini', 'help'=>LAN_EUSER_ADMIN_115H)),
//           'contentnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_117, 'type'=>'text'),
/*           
          'chatbox'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_118, 'type'=>'boolean', 'writeParms'=>array('pre'=>'</td><td>','post'=>euser_admin::render_postablerow(array(
          'chatboxnum' => array ('type'=>'text', 'writeParms'=>array('pattern'=>'[0-9]*', 'size'=>'mini'))
          )))),
*/           
//           'usersnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_118, 'type'=>'text', 'writeParms'=>array('pattern'=>'[0-9]*', 'size'=>'mini', 'help'=>LAN_EUSER_ADMIN_115H)),
//           'commentsnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_119, 'type'=>'text', 'writeParms'=>array('pattern'=>'[0-9]*', 'size'=>'mini', 'help' => LAN_EUSER_ADMIN_115H)),
/*
           'usersnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_118, 'type'=>'text'),
           'commentsnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_119, 'type'=>'text'),
           'forumnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_120, 'type'=>'text'),
           'forumsummary'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_121, 'type'=>'boolean'),
           'downloadsnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_122, 'type'=>'text'),
// Depois meter isto num ficheiro á parte para ser mais fácil adicionar novos plugins???
          '_tablestart1'  => euser_admin::render_fulltableline (null, '</table></div><div class="col-md-6"><table class="table adminform"><tr><th><center>'.LAN_EUSER_ADMIN_125.'</th><th><center>'.LAN_EUSER_ADMIN_115.'</th></tr><tbody><tr>', null, null),
//          'chatboxnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_125, 'type'=>'text', 'writeParms'=>array('pattern'=>'[0-9]*', 'size'=>'mini', 'help'=>LAN_EUSER_ADMIN_115H)),
          'chatboxnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_126, 'type'=>'text'),
          'chatboxIInum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_127, 'type'=>'text'),
          'copperminenum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_128, 'type'=>'text'),
          'copperminecommentsnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_129, 'type'=>'text'),
          'guestbooknum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_130, 'type'=>'text'),
          'youtubenum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_131, 'type'=>'text'),
          'kroozearcadenum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_132, 'type'=>'text'),
          'kroozearcadetopnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_133, 'type'=>'text'),
          'linksnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_134, 'type'=>'text'),
          'bugtracker3commentsnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_135, 'type'=>'text'),
          'jokenum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_136, 'type'=>'text'),
          'blognum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_137, 'type'=>'text'),
          'suggestionsnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_138, 'type'=>'text'),



          '_tablestart2'  => euser_admin::render_fulltableline (null, '</table></div>', null, null),

);

//var_dump ($prefsexp['whatsnewpage']);
//echo "<hr>";
array_walk($prefsexp['whatsnewpage'], function(&$value, $key) { $value['writeParms'] = ((strpos($key, '_')===0)xor($value['type']=='text'))?array('pattern'=>'[0-9]*', 'size'=>'mini', 'help'=>LAN_EUSER_ADMIN_115H):$value['writeParms']; });
//var_dump ($prefsexp['whatsnewpage']);
//--				$prefsexp['whatsnewpage']['shownews']['writeParms']['pre'] = "<div class='".(e107::isInstalled('news')?"":"hidden")."'>";
//        $prefsexp['whatsnewpage']['shownews']['writeParms']['post'] .= "</div>&nbsp;".euser_admin::label_installed('news', true);
//--        $prefsexp['whatsnewpage']['shownews']['writeParms']['post'] .= "&nbsp;".euser_admin::label_installed('news', true);
/*
        $prefsexp['whatsnewpage']['shownews']['title'] .= "&nbsp;".euser_admin::label_installed('news');
        if (!e107::isInstalled('news')){
        $prefsexp['whatsnewpage']['shownews']['writeParms']['pre'] .= "</td><td colspan=3><div class='hidden>'";
        $prefsexp['whatsnewpage']['shownews']['writeParms']['post'] .= "</div>&nbsp;".euser_admin::label_installed('news', true);
        }
        
        $prefsexp['whatsnewpage']['chatbox']['title'] .= "&nbsp;".euser_admin::label_installed('chatbox');
        if (!e107::isInstalled('chatbox')){
        $prefsexp['whatsnewpage']['chatbox']['writeParms']['pre'] .= "</td><td colspan=3><div class='hidden>'";
        $prefsexp['whatsnewpage']['chatbox']['writeParms']['post'] .= "</div>&nbsp;".euser_admin::label_installed('chatbox', true);
        }
*/
/*
        $prefsexp['whatsnewpage']['commentsnum']['title'].="<br><span class='label label-important label-info'>".LAN_EUSER_ADMIN_119I."</span>";
				$prefsexp['whatsnewpage']['forumsummary']['writeParms']['label'] = LAN_EUSER_ADMIN_121E.'&'.LAN_EUSER_ADMIN_121D;

// Check installed
// Old
//--$this->checkinstalled ('news', 'shownewsnum', $prefsexp);
//--$this->checkinstalled ('chatbox', 'chatboxnum', $prefsexp);

//$checkarray = array('news'=>'shownewsnum', 'forum'=>'forumnum', 'forum'=>'forumsummary', 'downloads'=>'downloadsnum', 'chatbox_menu'=>'chatboxnum', 'chatbox2_menu'=>'chatboxIInum', 'coppermine_menu'=>'copperminenum', 'coppermine_menu'=>'copperminecommentsnum', 'guestbook'=>'guestbooknum', 'ytm_gallery'=>'youtubenum', 'kroozearcade_menu'=>'kroozearcadenum', 'kroozearcade_menu'=>'kroozearcadetopnum', 'links_page'=>'linksnum', 'bugtracker3'=>'bugtracker3commentsnum', 'jokes_menu'=>'jokenum', 'userjournals_menu'=>'blognum', 'suggestions_menu'=>'suggestionsnum');
$plugcheckarray = array('shownewsnum'=>'news', 'forumnum'=>'forum', 'forumsummary'=>'forum', 'downloadsnum'=>'downloads', 'chatboxnum'=>'chatbox_menu', 'chatboxIInum'=>'chatbox2_menu', 'copperminenum'=>'coppermine_menu', 'copperminecommentsnum'=>'coppermine_menu', 'guestbooknum'=>'guestbook', 'youtubenum'=>'ytm_gallery', 'kroozearcadenum'=>'kroozearcade_menu', 'kroozearcadetopnum'=>'kroozearcade_menu', 'linksnum'=>'links_page', 'bugtracker3commentsnum'=>'bugtracker3', 'jokenum'=>'joke_menu', 'blognum'=>'userjournals_menu', 'suggestionsnum'=>'suggestions_menu');

//function checkinstalled($plugname, $arrkey, &$prefsexp) {
//foreach ($data_array as $key => $value){
//foreach($checkarray as $plugname => $arrkey) {
foreach($plugcheckarray as $arrkey => $plugname) {

//var_dump ($plugname);
//var_dump ($arrkey);
//echo "<hr>";

        $prefsexp['whatsnewpage'][$arrkey]['title'] .= "<br>".euser_admin::label_installed($plugname);
        if (!e107::isInstalled($plugname)){
//---        $prefsexp['whatsnewpage'][$arrkey]['class'] = "hidden";
//---        $prefsexp['whatsnewpage'][$arrkey]['writeParms']['class'] = "hidden";
//        $prefsexp['whatsnewpage'][$arrkey]['writeParms']['pre'] = "<div class='e-hideme'>";
        $prefsexp['whatsnewpage'][$arrkey]['writeParms']['disabled'] = 1;
//---        $prefsexp['whatsnewpage'][$arrkey]['writeParms']['post'] = euser_admin::label_installed($plugname, true);
        $prefsexp['whatsnewpage'][$arrkey]['writeParms']['post'] = "</div>";

        $prefsexp['whatsnewpage']['_tableend'] = euser_admin::render_fulltableline (null, euser_admin::linkbutton("../../e107_admin/plugin.php", LAN_EUSER_ADMIN_123, "danger"), null, null);
        $prefsexp['whatsnewpage']['_tableend']['writeParms']['pre'] = "<center>";
        }
}
//var_dump (e107::isInstalled('news'));


//          $prefsexp['shownews']['writeParms'] = array('new_icontype'  => array('title'=> LAN_EUSER_ADMIN_107,'tab' => 0, 'type'=>'dropdown', 'writeParms'=>array('optArray'=> array('new.gif'=> LAN_EUSER_ADMIN_108,'new2.gif'=> LAN_EUSER_ADMIN_109)), 'help' => LAN_EUSER_ADMIN_107H),);

//					$prefsexp['whatsnewpage']['new_icontype1']['writeParms']['post'] = '</td></tr><tr><td colspan=2><div class="alert alert-info text-center">'.LAN_EUSER_ADMIN_113I.'</div>';
//					$prefsexp['whatsnewpage']['new_icontype1']['writeParms']['class'] = 'e-hideme';

foreach ($prefsexp as $key => $value){
//$frm = e107::getForm();
//					$this->prefs[$key]['writeParms']['post'] = create_expandit_container ($key, $value);
//          var_dump ($value);
					$this->prefs[$key]['writeParms']['post'] .= euser_admin::render_expanditcontainer ($key, $value);
}
*/


// End flash color test line
//          $this->prefs['whatsnewpage']['writeParms'] = array('enabled=LAN_EUSER_ADMIN_101E&disabled=LAN_EUSER_ADMIN_101D', 'post' =>  '</td></tr><tr><td colspan=2><div class="alert alert-info text-center">'.LAN_EUSER_ADMIN_113I.'</div>');
/*
					$this->prefs['whatsnewpage']['writeParms']['post'] = '</td></tr><tr><td colspan=4><div class="alert alert-info alert-dismissable text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.LAN_EUSER_ADMIN_113I.'</div></td><tr>
<td class="forumheader3" style="text-align:center; font-weight:bold;">'.LAN_EUSER_ADMIN_114T.'</td>
<td class="forumheader3" style="text-align:center; font-weight:bold;">'.LAN_EUSER_ADMIN_115T.'</td>
<td class="forumheader3" style="text-align:center; font-weight:bold;">'.LAN_EUSER_ADMIN_116T.'</td>
<td class="forumheader3" style="text-align:center; font-weight:bold;">'.LAN_EUSER_ADMIN_117T;
*/
//					$this->prefs['info1']['writeParms']['class'] = 'e-expandit-container e-hideme';

//          []['writeParms']['post']  => '<span class="btn btn-info btn-block">'.LAN_EUSER_ADMIN_113I.'</span>'),
			e107::getMessage()->addInfo(LAN_EUSER_ADMIN_SHAREDCONFIG);
		}	

	
/*
	function init()
	{
		$categories = array();
		if(e107::getDb()->select('featurebox_category'))
		{
			while ($row = e107::getDb()->fetch())
			{
				$id = $row['fb_category_id'];
				$tmpl = $row['fb_category_template'];
				$categories[$id] = $row['fb_category_title'];
				$menuCat[$tmpl] = $row['fb_category_title'];
			}
		}

		$this->fields['fb_category']['writeParms'] 		= $categories;	
		$this->fields['fb_category']['readParms'] 		= $categories;
		
		unset($menuCat['unassigned']);
		
		$this->prefs['menu_category']['writeParms']['optArray'] 	= $menuCat;
		$this->prefs['menu_category']['readParms']['optArray'] 		= $menuCat;

	}
*/
/*
function checkinstalled($plugname, $arrkey, &$prefsexp) {

        $prefsexp['whatsnewpage'][$arrkey]['title'] .= "&nbsp;".euser_admin::label_installed($plugname);
        if (!e107::isInstalled($plugname)){
        $prefsexp['whatsnewpage'][$arrkey]['class'] = "hidden";
        $prefsexp['whatsnewpage'][$arrkey]['writeParms']['class'] = "hidden";
//        $prefsexp['whatsnewpage'][$arrkey]['writeParms']['pre'] = "<div class='e-hideme'>";
        $prefsexp['whatsnewpage'][$arrkey]['writeParms']['post'] = euser_admin::label_installed($plugname, true);
        }
}
*/		
}

class euser_whatsnew_form_ui extends e_admin_form_ui
{
	function _morewhatsnew($curVal,$mode)
	{
/*
  				$key = 'whatsnewpage';
  				$value = array('title'=> LAN_EUSER_ADMIN_101, 'type'=>'boolean', 'writeParms'=>array('enabled'=> LAN_EUSER_ADMIN_101E,'disabled'=> LAN_EUSER_ADMIN_101D));
///  				$value = array('class'=>'boing boing', 'data-toggle'=>"collapse", 'data-target'=>"#collapsible",);

//var_dump (key($field));
 $text = "</td></tr><tr><td>";
  $text .= $value['title']."&nbsp;";
/////  $text .= LAN_EUSER_ADMIN_101."&nbsp;";
  $text .= "</td><td>";
  $text .= "<div data-toggle='collapse' data-target='#collapsible'>";
  $text .= e107::getForm()->renderElement($key, e107::getPlugPref('euser')[$key], $value);
//  $text .= e107::getForm()->radio_switch($key, e107::getPlugPref('euser')[$key],null,null,$value);

//var_dump (str_replace('span','340px data-toggle="collapse" data-target="#collapsible"',$text));

//var_dump ($text);

  $text .= "</div>";

//////////  $text .= e107::getForm()->flipswitch($key,$checked_enabled, array('on'=>LAN_EUSER_ADMIN_101E,'off'=>LAN_EUSER_ADMIN_101D),$value);
  $text .= "</td></tr><tr><td colspan='2'>";
*/
  $text .= '<div class="collapse" id="collapsible">';
//  $text .= "<hr><hr><hr><hr><hr>";
//var_dump ($field[key($field)]);


          $prefsexp['whatsnewpage'] = array(
          '_alert'  => euser_admin::render_fulltableline (null, LAN_EUSER_ADMIN_113I, 'alert',null, 'warning'),
          '_tablestart'  => euser_admin::render_fulltableline (null, '<div class="row"><div class="col-md-6"><table class="table adminform"><tr><th><center>'.LAN_EUSER_ADMIN_114.'</th><th><center>'.LAN_EUSER_ADMIN_115.'</th></tr><tbody><tr>', null, null),
          'shownewsnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_116, 'type'=>'text'),
           'contentnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_117, 'type'=>'text'),
           'usersnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_118, 'type'=>'text'),
           'commentsnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_119, 'type'=>'text'),
           'forumnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_120, 'type'=>'text'),

//--           'forumsummary'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_121, 'type'=>'boolean'),
  				'forumsummary'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_121, 'type'=>'radio', 'writeParms'=>array('1'=> LAN_EUSER_ADMIN_121E,'0'=> LAN_EUSER_ADMIN_121D)),
           'downloadsnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_122, 'type'=>'text'),
// Depois meter isto num ficheiro á parte para ser mais fácil adicionar novos plugins???
          '_tablestart1'  => euser_admin::render_fulltableline (null, '</table></div><div class="col-md-6"><table class="table adminform"><tr><th><center>'.LAN_EUSER_ADMIN_125.'</th><th><center>'.LAN_EUSER_ADMIN_115.'</th></tr><tbody><tr>', null, null),
          'chatboxnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_126, 'type'=>'text'),
          'chatboxIInum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_127, 'type'=>'text'),
          'copperminenum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_128, 'type'=>'text'),
          'copperminecommentsnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_129, 'type'=>'text'),
          'guestbooknum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_130, 'type'=>'text'),
          'youtubenum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_131, 'type'=>'text'),
          'kroozearcadenum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_132, 'type'=>'text'),
          'kroozearcadetopnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_133, 'type'=>'text'),
          'linksnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_134, 'type'=>'text'),
          'bugtracker3commentsnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_135, 'type'=>'text'),
          'jokenum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_136, 'type'=>'text'),
          'blognum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_137, 'type'=>'text'),
          'suggestionsnum'  => array('cell'=>'td','title'=> LAN_EUSER_ADMIN_138, 'type'=>'text'),
          '_tablestart2'  => euser_admin::render_fulltableline (null, '</table></div>', null, null),

);

array_walk($prefsexp['whatsnewpage'], function(&$value, $key) { $value['writeParms'] = ((strpos($key, '_')===0)xor($value['type']=='text'))?array('pattern'=>'[0-9]*', 'size'=>'mini', 'help'=>LAN_EUSER_ADMIN_115H):$value['writeParms']; });
        $prefsexp['whatsnewpage']['commentsnum']['title'].="<br><span class='label label-important label-info'>".LAN_EUSER_ADMIN_119I."</span>";

$plugcheckarray = array('shownewsnum'=>'news', 'forumnum'=>'forum', 'forumsummary'=>'forum', 'downloadsnum'=>'downloads', 'chatboxnum'=>'chatbox_menu', 'chatboxIInum'=>'chatbox2_menu', 'copperminenum'=>'coppermine_menu', 'copperminecommentsnum'=>'coppermine_menu', 'guestbooknum'=>'guestbook', 'youtubenum'=>'ytm_gallery', 'kroozearcadenum'=>'kroozearcade_menu', 'kroozearcadetopnum'=>'kroozearcade_menu', 'linksnum'=>'links_page', 'bugtracker3commentsnum'=>'bugtracker3', 'jokenum'=>'joke_menu', 'blognum'=>'userjournals_menu', 'suggestionsnum'=>'suggestions_menu');

foreach($plugcheckarray as $arrkey => $plugname) {
        $prefsexp['whatsnewpage'][$arrkey]['title'] .= "<br>".euser_admin::label_installed($plugname);
        if (!e107::isInstalled($plugname)){
        $prefsexp['whatsnewpage'][$arrkey]['writeParms']['disabled'] = 1;
        $prefsexp['whatsnewpage'][$arrkey]['writeParms']['post'] = "</div>";

        $prefsexp['whatsnewpage']['_tableend'] = euser_admin::render_fulltableline (null, euser_admin::linkbutton("../../e107_admin/plugin.php", LAN_EUSER_ADMIN_123, "danger"), null, null);
        $prefsexp['whatsnewpage']['_tableend']['writeParms']['pre'] = "<center>";
        }
}

foreach ($prefsexp as $key => $value){
////					$this->prefs[$key]['writeParms']['post'] .= euser_admin::render_expandedcontainer ($key, $value);
					$text .= euser_admin::render_expandedcontainer ($key, $value);
}
$text .= "</div>";

return $text;
}
}

class euser_online_ui extends e_admin_ui
{
	//TODO Move to Class above. 
	protected $pluginTitle		= LAN_EUSER_FULLNAME;
	protected $pluginName		= 'euser';
//	protected $table			= "featurebox";	
//	protected $pid 				= "fb_id";
/*
	protected $perPage 			= 10;
	protected $batchDelete 		= true;
	protected $batchCopy 		= true;
	protected $sortField		= 'fb_order';
	protected $orderStep 		= 1;
	protected $listOrder 		= 'fb_order asc';
*/	
/* ---
	protected $fields = array(
		'checkboxes'		=> array('title'=> '',					'type' => null, 			'width' =>'5%', 'forced'=> TRUE, 'thclass'=>'center first', 'class'=>'center'),
		'fb_id'				=> array('title'=> LAN_ID,				'type' => 'number',			'data'=> 'int', 'width' =>'5%', 'forced'=> TRUE),
     	'fb_category' 		=> array('title'=> LAN_CATEGORY,		'type' => 'dropdown',		'inline'=>true,  'data'=> 'int',	'width' => '10%',  'filter'=>TRUE, 'batch'=>TRUE),
		'fb_title' 			=> array('title'=> LAN_TITLE,			'type' => 'text',			'inline'=>true,  'width' => 'auto', 'thclass' => 'left'), 
    	'fb_image' 			=> array('title'=> "Image/Video",		'type' => 'image',			'width' => '100px', 'readParms'=>'thumb=60&thumb_urlraw=0&thumb_aw=60','writeParms'=>'size=xxlarge&media=featurebox&video=1'),
	
	 	'fb_text' 			=> array('title'=> FBLAN_08,			'type' => 'bbarea',			'width' => '30%', 'readParms' => 'expand=...&truncate=50&bb=1','writeParms'=>'template=admin'), 
		//DEPRECATED 'fb_mode' 			=> array('title'=> FBLAN_12,			'type' => 'dropdown',		'data'=> 'int',	'width' => '5%', 'filter'=>TRUE, 'batch'=>TRUE),		
		//DEPRECATED 'fb_rendertype' 	=> array('title'=> FBLAN_22,			'type' => 'dropdown',		'data'=> 'int',	'width' => 'auto', 'noedit' => TRUE),	
        'fb_template' 		=> array('title'=> LAN_TEMPLATE,			'type' => 'layouts',		'data'=> 'str', 'width' => 'auto', 'writeParms' => 'plugin=featurebox', 'filter' => true, 'batch' => true),	 	// Photo
		'fb_imageurl' 		=> array('title'=> "Image Link",		'type' => 'url',			'width' => 'auto','writeParms'=>'size=xxlarge'),
		'fb_class' 			=> array('title'=> LAN_VISIBILITY,		'type' => 'userclass',		'data' => 'int', 'inline'=>true, 'width' => 'auto', 'filter' => true, 'batch' => true),	// User id
		'fb_order' 			=> array('title'=> LAN_ORDER,			'type' => 'number',			'data'=> 'int','width' => '5%' ),
		'options' 			=> array('title'=> LAN_OPTIONS,			'type' => null,				'forced'=>TRUE, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center', 'readParms'=>'sort=1')
	);
	 
	protected $fieldpref = array('checkboxes', 'fb_id', 'fb_category', 'fb_title', 'fb_template', 'fb_class', 'fb_order', 'options');
*/	
/*
	protected $prefs = array( 
		'menu_category'	   	=> array('title'=> "Featurebox Menu Category", 'type'=>'dropdown', 'help' => 'Category to use for the featurebox menu')
	);
*/
	protected $prefs = array( 
/*   ANTIGOS PREFS
$onlineinfo_border = $pref['onlineinfo_border'];                       bordercolor
$onlineinfo_color = $pref['onlineinfo_color'];                         backcolor
$onlineinfo_avatar = $pref['onlineinfo_avatar'];                       useravatar
$onlineinfo_showicons = $pref['onlineinfo_showicons'];                 showicons
$onlineinfo_showadmin = $pref['onlineinfo_showadmin'];                 showadmin
$onlineinfo_guest = $pref['onlineinfo_guest'];                         guestinfo
$onlineinfo_hideguest = $pref['onlineinfo_hideguest'];                 hideguest
$onlineinfo_hideusers = $pref['onlineinfo_hideusers'];                 hideusers
$onlineinfo_usernamefontsize = $pref['onlineinfo_usernamefontsize'];   usernamefontsize
$onlineinfo_botchecker = $pref['onlineinfo_botchecker'];               botchecker
$onlineinfo_ipchecker = $pref['onlineinfo_ipchecker'];                 ipchecker
$onlineinfo_nolocations = $pref['onlineinfo_nolocations'];             detailedview
*/          
 					'detailedview'  => array('title'=> LAN_EUSER_ADMIN_051, 'type'=>'boolean', 'help'=>LAN_EUSER_ADMIN_051H,),
//          []['writeParms']['post']  => '<span class="btn btn-info btn-block">'.LAN_EUSER_ADMIN_052.'</span>'),
          'info1'  => array(),
					'botchecker'  => array('title'=> LAN_EUSER_ADMIN_053, 'type'=>'boolean', 'help'=>LAN_EUSER_ADMIN_053H),
					'ipchecker'  => array('title'=> LAN_EUSER_ADMIN_054, 'type'=>'boolean'),
					'hideusers'  => array('title'=> LAN_EUSER_ADMIN_055, 'type'=>'boolean'),
					'hideguest'  => array('title'=> LAN_EUSER_ADMIN_056, 'type'=>'boolean'),
					'useravatar'  => array('title'=> LAN_EUSER_ADMIN_057, 'type'=>'boolean'),
					'guestinfo'  => array('title'=> LAN_EUSER_ADMIN_058, 'type'=>'boolean'),
					'showicons'  => array('title'=> LAN_EUSER_ADMIN_059, 'type'=>'boolean'),
					'showadmin'  => array('title'=> LAN_EUSER_ADMIN_060, 'type'=>'boolean'),
// Poderá sair daqui, pode ser templatizado via css. Como algumas coisas acima também podem ser...
// DEPRECATED! SETUP VIA TEMPLATE/CSS
//					'bordercolor'  => array('title'=> LAN_EUSER_ADMIN_061, 'type'=>'text', 'writeParms' => array('class' => 'colorpicker'), 'help'=>LAN_EUSER_ADMIN_COLORH),
//					'backcolor'  => array('title'=> LAN_EUSER_ADMIN_062, 'type'=>'text', 'writeParms' => array('class' => 'colorpicker'), 'help'=>LAN_EUSER_ADMIN_COLORH),
//					'usernamefontsize'  => array('title'=> LAN_EUSER_ADMIN_063, 'type'=>'text'),
 
// Prefs que não estavam no config do OIM, mas estão no menu agora... Passaram para aqui. TODO: verificar lan's
					'show_memberlist'  => array('title'=> "Show member list", 'type'=>'boolean')
	);

	public function init()
		{
					$this->prefs['info1']['writeParms']['post'] = '<span class="btn btn-info btn-block">'.LAN_EUSER_ADMIN_052.'</span>';

//---------					$this->prefs['detailedview']['writeParms']['post'] = label_installed('colorpicker');
//					$this->prefs['flashtext_testline']['writeParms']['post'] = "&nbsp;". LAN_EUSER_ADMIN_105."&nbsp;<input name='flashcolor' value='' maxlength='32' id='flashcolor' class='tbox form-control ui-state-valid' data-original-title='' title='".LAN_EUSER_ADMIN_COLORH."'' type='text'></div>";
			e107::getMessage()->addInfo(LAN_EUSER_ADMIN_SHAREDCONFIG);
		}	






	

	
/*
	function init()
	{
		$categories = array();
		if(e107::getDb()->select('featurebox_category'))
		{
			while ($row = e107::getDb()->fetch())
			{
				$id = $row['fb_category_id'];
				$tmpl = $row['fb_category_template'];
				$categories[$id] = $row['fb_category_title'];
				$menuCat[$tmpl] = $row['fb_category_title'];
			}
		}

		$this->fields['fb_category']['writeParms'] 		= $categories;	
		$this->fields['fb_category']['readParms'] 		= $categories;
		
		unset($menuCat['unassigned']);
		
		$this->prefs['menu_category']['writeParms']['optArray'] 	= $menuCat;
		$this->prefs['menu_category']['readParms']['optArray'] 		= $menuCat;

	}
*/
		
}

class euser_color_ui extends e_admin_ui
{
	//TODO Move to Class above. 
	protected $pluginTitle		= LAN_EUSER_FULLNAME;
	protected $pluginName		= 'euser';
//	protected $table			= "featurebox";	
//	protected $pid 				= "fb_id";
	protected $perPage 			= 10;
	protected $batchDelete 		= true;
	protected $batchCopy 		= true;
	protected $sortField		= 'fb_order';
	protected $orderStep 		= 1;
	protected $listOrder 		= 'fb_order asc';
	
/* ---
	protected $fields = array(
		'checkboxes'		=> array('title'=> '',					'type' => null, 			'width' =>'5%', 'forced'=> TRUE, 'thclass'=>'center first', 'class'=>'center'),
		'fb_id'				=> array('title'=> LAN_ID,				'type' => 'number',			'data'=> 'int', 'width' =>'5%', 'forced'=> TRUE),
     	'fb_category' 		=> array('title'=> LAN_CATEGORY,		'type' => 'dropdown',		'inline'=>true,  'data'=> 'int',	'width' => '10%',  'filter'=>TRUE, 'batch'=>TRUE),
		'fb_title' 			=> array('title'=> LAN_TITLE,			'type' => 'text',			'inline'=>true,  'width' => 'auto', 'thclass' => 'left'), 
    	'fb_image' 			=> array('title'=> "Image/Video",		'type' => 'image',			'width' => '100px', 'readParms'=>'thumb=60&thumb_urlraw=0&thumb_aw=60','writeParms'=>'size=xxlarge&media=featurebox&video=1'),
	
	 	'fb_text' 			=> array('title'=> FBLAN_08,			'type' => 'bbarea',			'width' => '30%', 'readParms' => 'expand=...&truncate=50&bb=1','writeParms'=>'template=admin'), 
		//DEPRECATED 'fb_mode' 			=> array('title'=> FBLAN_12,			'type' => 'dropdown',		'data'=> 'int',	'width' => '5%', 'filter'=>TRUE, 'batch'=>TRUE),		
		//DEPRECATED 'fb_rendertype' 	=> array('title'=> FBLAN_22,			'type' => 'dropdown',		'data'=> 'int',	'width' => 'auto', 'noedit' => TRUE),	
        'fb_template' 		=> array('title'=> LAN_TEMPLATE,			'type' => 'layouts',		'data'=> 'str', 'width' => 'auto', 'writeParms' => 'plugin=featurebox', 'filter' => true, 'batch' => true),	 	// Photo
		'fb_imageurl' 		=> array('title'=> "Image Link",		'type' => 'url',			'width' => 'auto','writeParms'=>'size=xxlarge'),
		'fb_class' 			=> array('title'=> LAN_VISIBILITY,		'type' => 'userclass',		'data' => 'int', 'inline'=>true, 'width' => 'auto', 'filter' => true, 'batch' => true),	// User id
		'fb_order' 			=> array('title'=> LAN_ORDER,			'type' => 'number',			'data'=> 'int','width' => '5%' ),
		'options' 			=> array('title'=> LAN_OPTIONS,			'type' => null,				'forced'=>TRUE, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center', 'readParms'=>'sort=1')
	);
	 
	protected $fieldpref = array('checkboxes', 'fb_id', 'fb_category', 'fb_title', 'fb_template', 'fb_class', 'fb_order', 'options');
*/	
/*
	protected $prefs = array( 
		'menu_category'	   	=> array('title'=> "Featurebox Menu Category", 'type'=>'dropdown', 'help' => 'Category to use for the featurebox menu')
	);
*/
	protected $prefs = array( 
  					'onoffcolour'  => array('title'=> "Colour members", 'type'=>'boolean'),
					'headadminactive'  => array('title'=> "Head admin active", 'type'=>'boolean'),
					'adminactive'  => array('title'=> "Admin active", 'type'=>'boolean'),
					'memactive'  => array('title'=> "Member active", 'type'=>'boolean'),
					'modactive'  => array('title'=> "Moderator active", 'type'=>'boolean')
	);

	

	
	function init()
	{
/*
		$categories = array();
		if(e107::getDb()->select('featurebox_category'))
		{
			while ($row = e107::getDb()->fetch())
			{
				$id = $row['fb_category_id'];
				$tmpl = $row['fb_category_template'];
				$categories[$id] = $row['fb_category_title'];
				$menuCat[$tmpl] = $row['fb_category_title'];
			}
		}

		$this->fields['fb_category']['writeParms'] 		= $categories;	
		$this->fields['fb_category']['readParms'] 		= $categories;
		
		unset($menuCat['unassigned']);
		
		$this->prefs['menu_category']['writeParms']['optArray'] 	= $menuCat;
		$this->prefs['menu_category']['readParms']['optArray'] 		= $menuCat;
*/
//     	$mes = e107::getMessage();
//	    $message = LAN_EUSER_ADMIN_SHAREDCONFIG;
//----			e107::getMessage()->addInfo(LAN_EUSER_ADMIN_SHAREDCONFIG);

	}
		
}

/*				
class euser_read_ui extends e_admin_ui
{
			
		protected $pluginTitle		= LAN_EUSER_FULLNAME;
		protected $pluginName		= 'euser';
	//	protected $eventName		= 'euser-euser_read'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'euser_read';
		protected $pid				= '';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
	//	protected $batchCopy		= true;		
	//	protected $sortField		= 'somefield_order';
	//	protected $orderStep		= 10;
	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= ' DESC';
	
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'user_id' =>   array ( 'title' => LAN_ID, 'type' => 'boolean', 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'news' =>   array ( 'title' => 'News', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'chatbox' =>   array ( 'title' => 'Chatbox', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'comments' =>   array ( 'title' => 'Comments', 'type' => 'textarea', 'data' => 'str', 'width' => '40%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'contents' =>   array ( 'title' => 'Contents', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'downloads' =>   array ( 'title' => 'Downloads', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'guestbook' =>   array ( 'title' => 'Guestbook', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'pictures' =>   array ( 'title' => 'Pictures', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'movies' =>   array ( 'title' => 'Movies', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'links' =>   array ( 'title' => 'Links', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'sitemembers' =>   array ( 'title' => 'Sitemembers', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'games' =>   array ( 'title' => 'Games', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'game_top' =>   array ( 'title' => 'Top', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'gallery' =>   array ( 'title' => 'Gallery', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'ibf' =>   array ( 'title' => 'Ibf', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'smf' =>   array ( 'title' => 'Smf', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'bug' =>   array ( 'title' => 'Bug', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'copper' =>   array ( 'title' => 'Copper', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'jokes' =>   array ( 'title' => 'Jokes', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'blogs' =>   array ( 'title' => 'Blogs', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'suggestions' =>   array ( 'title' => 'Suggestions', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'options' =>   array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),
		);		
		
		protected $fieldpref = array();
		
	
		public function init()
		{
			// Set drop-down values (if any). 
	
		}

		
		// ------- Customize Create --------
		
		public function beforeCreate($new_data,$old_data)
		{
			return $new_data;
		}
	
		public function afterCreate($new_data, $old_data, $id)
		{
			// do something
		}

		public function onCreateError($new_data, $old_data)
		{
			// do something		
		}		
		
		
		// ------- Customize Update --------
		
		public function beforeUpdate($new_data, $old_data, $id)
		{
			return $new_data;
		}

		public function afterUpdate($new_data, $old_data, $id)
		{
			// do something	
		}
		
		public function onUpdateError($new_data, $old_data, $id)
		{
			// do something		
		}		
		
			
	/*	
		// optional - a custom page.  
		public function customPage()
		{
			$text = 'Hello World!';
			$otherField  = $this->getController()->getFieldVar('other_field_name');
			return $text;
			
		}
	*/
/*			
}
				


class euser_read_form_ui extends e_admin_form_ui
{

}		
*/		
		
new euser_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");