<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2013 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * e107 Bootstrap Theme Shortcodes. 
 *
*/
////exit();
/*
var_dump (class_exists('user_shortcodes'));
//if(!class_exists('user_shortcodes'))
//{
  require_once(e_CORE."shortcodes/batch/user_shortcodes.php");
//}
echo "<hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>";
var_dump (class_exists('user_shortcodes'));
*/
//var_dump ($euser_pref);
require_once(e_CORE."shortcodes/batch/usersettings_shortcodes.php");
include_once(e_PLUGIN . "euser/shortcodes/euser_trait.php");

class plugin_euser_user_settings_shortcodes extends usersettings_shortcodes
{
	use Euser_info;

//	public $var;

	function __construct()
	{
		parent::__construct(); // this line calls the parent (a) constructor
		$this->sql = e107::getDb(); 
		$this->tp = e107::getParser();
//        $this->template = e107::getTemplate('euser', 'whatsnew_menu');
//		$this->var['euser_pref'] = $this->var['euser_pref'];
        
//    		$this->sql->select("euser", "*", "user_id='".$this->var['user_id']."' ");
//    		$this->euser_data = $this->sql->fetch();
//		$this->var['euser_data'] = $this->sql->retrieve("euser", "*", "user_id='".USERID."'");

if (intval(ini_get('post_max_size')) >= intval(ini_get('upload_max_filesize'))) {
	$this->post_max_info = intval(ini_get('upload_max_filesize'));
} else {
	$this->post_max_info = intval(ini_get('post_max_size'));
}

//	$this->euser_privprefs = ($this->euser_getprefs(array("user_settings"=>64+32+8+1)));
//	$this->euser_privprefs = ($this->euser_getprefs($this->var['euser_data']['user_settings']));
//	echo $this->var;
//	print_r($this->var);

//	$this->init();
//echo "<pre>";
//var_dump($this);
//echo "</pre>";

//		echo parent::var;
	}

// Override shortcodes originais do user_settings	
/*
function init()
{
echo $this->var;
echo "-----";
echo $this->var['euser_data'];
echo "-----";
echo $this->var['euser_data']['user_settings'];
}
*/
function sc_avatar_remote($parm = null)
{

	if(!empty($this->var['user_xup'])) // social login active.
	{
		//	return $this->var['user_image'];
		return e107::getParser()->toAvatar($this->var);
	}

//	return e107::getForm()->avatarpicker('image', $this->var['user_image'], array('upload' => 1));
//	return e107::getParser()->toAvatar($this->var['user_image']);
	return $this->avatarpicker('image', e107::getParser()->toAvatar($this->var['user_image'], array('type'=>'url')), array('upload' => 1));
}

public function avatarpicker($name, $curVal='', $options=array())
{
	$tp 		= $this->tp;
	$pref 		= e107::getPref();
	
	$attr 		= 'aw=' .$pref['im_width']. '&ah=' .$pref['im_height'];
	$tp->setThumbSize($pref['im_width'],$pref['im_height']);
	
	$blankImg 	= $tp->thumbUrl(e_IMAGE. 'generic/blank_avatar.jpg',$attr);
	$localonly 	= true;
	$idinput 	= e107::getForm()->name2id($name);
	$previnput	= $idinput. '-preview';
	$optioni 	= $idinput. '-options';
	
	
	$path = (strpos($curVal,'-upload-') === 0) ? '{e_AVATAR}upload/' : '{e_AVATAR}default/';
	$newVal = str_replace('-upload-','',$curVal);

	$img = (strpos($curVal, '://')!==false) ? $curVal : $tp->thumbUrl($path.$newVal);
			
	if(!$curVal)
	{
		$img = $blankImg;	
	}
	
	$parm = $options;
	$classlocal = (!empty($parm['class'])) ? "class='".$parm['class']." e-tip avatar'" : " class='img-rounded rounded e-tip avatar '";
	$class = (!empty($parm['class'])) ? "class='".$parm['class']." '" : " class='img-rounded rounded btn btn-default btn-secondary button'";

	if($localonly == true)
	{
		$text = "<input class='tbox' style='width:80%' id='{$idinput}' type='hidden' name='image' value='{$curVal}'  />";
		$text .= "<img src='".$img."' id='{$previnput}' ".$classlocal." style='cursor:pointer; width:".$pref['im_width']. 'px; height:' .$pref['im_height']."px' title='".LAN_EFORM_001."' alt='".LAN_EFORM_001."' role='button' data-bs-toggle='modal' data-bs-target='#".$optioni."' />";
	}
	else
	{			
		$text = "<input class='tbox' style='width:80%' id='{$idinput}' type='text' name='image' size='40' value='$curVal' maxlength='100' title=\"".LAN_SIGNUP_111. '" />';
		$text .= "<img src='".$img."' id='{$previnput}' style='display:none' />";
		$text .= '<input ' .$class." type ='button' role='button' style='cursor:pointer' data-bs-toggle='modal' data-bs-target='#".$optioni."' size='30' value=\"".LAN_EFORM_002. '"  />';
	}
					
	$avFiles = e107::getFile()->get_files(e_AVATAR_DEFAULT, '.jpg|.png|.gif|.jpeg|.JPG|.GIF|.PNG');
		
//	$text .= "\n<div id='{$optioni}' style='display:none;padding:10px' >\n"; //TODO unique id. 

	$text .= '<!-- Modal -->
<div id="'.$optioni.'" class="modal fade" tabindex="-1" aria-labelledby="AvatarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="AvatarModalLabel">'.LAN_EUSER_109.'</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
';


	$count = 0;
	if (!empty($pref['avatar_upload']) && FILE_UPLOADS && !empty($options['upload']))
	{
			$diz = LAN_USET_32.($pref['im_width'] || $pref['im_height'] ? "\n".str_replace(array('[x]-','[y]'), array($pref['im_width'], $pref['im_height']), LAN_USER_86) : '');

			$text .= "<div style='margin-bottom:10px'>".LAN_USET_26."
			<input  class='tbox' name='file_userfile[avatar]' type='file' size='47' title=\"{$diz}\" />
			</div>";
			
			if(count($avFiles) > 0)
			{
				$text .= "<div class='divider'><span>".LAN_EFORM_003. '</span></div>';
				$count = 1;
			}
	}
	

	foreach($avFiles as $fi)
	{
		$img_path = $tp->thumbUrl(e_AVATAR_DEFAULT.$fi['fname']);	
		$text .= "\n<a class='' title='".LAN_EFORM_004."' href='#{$optioni}'><img src='".$img_path."' alt=''  onclick=\"insertext('".$fi['fname']."', '".$idinput."');document.getElementById('".$previnput."').src = this.src;return false\" /></a> ";
		$count++;


		//TODO javascript CSS selector
	}
	
	if($count == 0)
	{
		$text .= "<div class='row'>";
		$text .= "<div class='alert alert-info'>".LAN_EFORM_005. '</div>';

		if(ADMIN)
		{
			$EAVATAR = e_AVATAR_DEFAULT;
			$text .= "<div class='alert alert-danger'>";
			$text .= $this->tp->lanVars($this->tp->toHTML(LAN_EFORM_006, true), array('x'=>$EAVATAR));
			$text .= '</div>';
		}

		$text .= '</div>';
	}
	
//	$text .= '</div>';
	
	// Used by usersettings.php right now. 
	$text .= '
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        '.($count !=0?'<button type="button" class="btn btn-primary">Save changes</button>':'').'
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->
';
	
	return $text;
	/*
	//TODO discuss and FIXME
		// Intentionally disable uploadable avatar and photos at this stage
		if (false && $pref['avatar_upload'] && FILE_UPLOADS)
		{
			$text .= "<br /><span class='smalltext'>".LAN_SIGNUP_25."</span> <input class='tbox' name='file_userfile[]' type='file' size='40' />
			<br /><div class='smalltext'>".LAN_SIGNUP_34."</div>";
		}
	
		if (false && $pref['photo_upload'] && FILE_UPLOADS)
		{
			$text .= "<br /><span class='smalltext'>".LAN_SIGNUP_26."</span> <input class='tbox' name='file_userfile[]' type='file' size='40' />
			<br /><div class='smalltext'>".LAN_SIGNUP_34."</div>";
		}  */
}

// Fim override shortcodes originais do user_settings	



//	function sc_euser_settings_edit(){
//		global $eus;
//		return "safklagçklçaskçdlkflçfkfçalsdfkad";
//		$this->wrapper('euser_settings/edit');
//		return $eus->euser_init(); 
/*
		echo "<pre>";
		var_dump ($this);
		echo "</pre>";
	*/
//	}

	private function render_checkboxes($name, $var){
		if (!$this->euser_privprefs){
			$this->euser_privprefs = ($this->euser_getprefs($this->var['euser_data']['user_settings']));
		}
		/*
		echo "<pre>";
		var_dump($this->euser_privprefs);
		echo "</pre>";
*/
/*
		echo "<pre>";
		var_dump($this->var['euser_data']['user_settings']);
		echo "</pre>";
*/
//		$options[1]['label'] = LAN_EUSER_130;
//		$options[2]['label'] = LAN_EUSER_131;
//		$options[4]['label'] = LAN_ALL;
//		array_walk();
		
//		var_dump ($this->var['euser_pref']['friends']);
/*
		return ($this->var['euser_pref'][$var])?"<div class='d-inline-flex'>"."<span>".
		($this->var['euser_pref']['friends']?e107::getForm()->checkbox($name.'_fr', 0, $this->euser_privprefs[$name.'_fr'], array('label' => LAN_EUSER_130)).
		"</span><span class='ps-2'>":"").
		e107::getForm()->checkbox($name.'_us', 0, $this->euser_privprefs[$name.'_us'], array('label' => LAN_EUSER_131)).
		"</span><span class='ps-2'>".
		e107::getForm()->checkbox($name, 0, $this->euser_privprefs[$name], array('label' => LAN_EUSER_132)).
		"</span>"."</div>":null;
*/
		return ($this->var['euser_pref'][$var])?"<div class='d-inline-flex'>"."<span>".
		($this->var['euser_pref']['friends']?e107::getForm()->checkbox('eprefs[]', '+'.$this->flags[$name.'_fr'], $this->euser_privprefs[$name.'_fr'], array('label' => LAN_EUSER_130)).
		"</span><span class='ps-2'>":"").
		e107::getForm()->checkbox('eprefs[]', '+'.$this->flags[$name.'_us'], $this->euser_privprefs[$name.'_us'], array('label' => LAN_EUSER_131)).
		"</span><span class='ps-2'>".
		e107::getForm()->checkbox('eprefs[]', '+'.$this->flags[$name], $this->euser_privprefs[$name], array('label' => LAN_EUSER_132)).
		"</span>"."</div>":null;
	}
	function sc_euser_infowatch($parm = null)
	{
//		var_dump ($this->var['user_settings']);
		//		if($parm == 'radio')
//		{
//			$options['enabled'] = array('title' => LAN_USER_84);

/*			$opts = array(
				1   => "Amigos",
				2   => "Utilizadores registados",
				3   => "Todos"
			);
*/
			//$options['label'] = "Amigos";

//			$result = $this->_frm->checkboxes('name', $opts, array(2=>'two'));

			return $this->render_checkboxes("infovis", "friends");
//		}
	}
	function sc_euser_profriends($parm = null)
	{
			return $this->render_checkboxes("friendvis", "friends");
	}
	function sc_euser_procommwatch($parm = null)
	{
		return $this->render_checkboxes("prcommvis", 'commentson');
	}
	function sc_euser_procomm($parm = null)
	{
			return $this->render_checkboxes("prcom", 'commentson');
	}
	function sc_euser_propicwatch($parm = null)
	{
			return $this->render_checkboxes("primgvis", 'pics');
	}
	function sc_euser_propiccomm($parm = null)
	{
			return $this->render_checkboxes("primgcom", 'pics');
	}
	function sc_euser_providwatch($parm = null)
	{
			return $this->render_checkboxes("prvidvis", 'videos');
	}
	function sc_euser_providcomm($parm = null)
	{
			return $this->render_checkboxes("prvidcom", 'videos');
	}
	function sc_euser_promp3($parm = null)
	{
		$profile = $this->sql->retrieve("euser_mp3", "mp3_id, mp3_embed", "mp3_id='{$id}'");
		if ($profile['mp3_embed'] == "") {
			$mp3file = "<i>".PROFILE_278."</i>";
		} else {
			if(strpos($profile['mp3_embed'], "http://") === false) {
			$mp3file = $profile['mp3_embed'];
			} else {
				$mp3break = explode("/", $profile['mp3_embed']);
				$mp3file = end($mp3break);
			}
		}
//		$currentmp3 = " ".PROFILE_158." ".str_replace("_", " ", $mp3file);
		
			return $this->render_checkboxes("prmp3vis", "mp3enabled")."<div class='d-inline-flex ms-4'><b>".PROFILE_158."</b> ".str_replace("_", " ", $mp3file)."</div>";
	}
	function sc_euser_pmonfriend($parm = null)
	{
//			return $this->var['euser_pref']['friends']?"<span>".e107::getForm()->checkbox("pmfriend", 1, false, array('label' => LAN_EUSER_22))."</span><span class='ps-2'>":null;
			return "<div class='radio'>" . e107::getForm()->radio_switch("pmfriend", $this->euser_privprefs['pmfriend'], LAN_YES, LAN_NO) . "</div>";

//			$this->render_checkboxes("pmfriend", "friends");
	}
	function sc_euser_emailonfriend($parm = null)
	{
//		return $this->var['euser_pref']['friends']?"<span>".e107::getForm()->checkbox("emfriend", 1, false, array('label' => LAN_EUSER_23))."</span><span class='ps-2'>":null;
		return "<div class='radio'>" . e107::getForm()->radio_switch("emfriend", $this->euser_privprefs['emfriend'], LAN_YES, LAN_NO) . "</div>";
		//		return $this->render_checkboxes("", "friends");
	}
	function sc_euser_showfriendbutton($parm = null)
	{
//		return $this->var['euser_pref']['friends']?"<span>".e107::getForm()->checkbox("emfriend", 1, false, array('label' => LAN_EUSER_23))."</span><span class='ps-2'>":null;
		return "<div class='radio'>" . e107::getForm()->radio_switch("showfrbut", $this->euser_privprefs['showfrbut'], LAN_YES, LAN_NO) . "</div>";
		//		return $this->render_checkboxes("", "friends");
	}

	function sc_euser_music_size(){
// MAX_MP3_FILESIZE
$maxmp3meret = $this->var['euser_pref']['mp3size']/1024;
if ($maxmp3meret >= $this->post_max_info) {
	$maxmp3meret = $this->post_max_info;
}
$maxmp3meret_kb = $maxmp3meret * 1024;  // É definido aqui mas nunca é usado... Deixei por causa das cócegas....

return sprintf("%01.1f", $maxmp3meret);

	}

	function sc_euser_mp3_set(){
		if ($this->var['euser_pref']['mp3enabled']){
//			global $template;
			$sc_template = e107::getTemplate('euser', 'euser_settings');
			return $this->tp->parseTemplate($sc_template['mp3'], TRUE, $this);
		}
	}

	function sc_euser_music_remote($parms = null)
	{
		if ($this->var['euser_pref']['mp3enabled'] && ($this->var['euser_pref']['mp3'] == "Both" || $this->var['euser_pref']['mp3'] == "Remote Only")){
			if($parms['radio'])
		{
//			$options['enabled'] = array('title' => LAN_USER_84);
			$options['label'] = PROFILE_152;
			$options['id'] = 'remote';

			return "<div class='radio'>" . e107::getForm()->radio("mp3[]", 'remote', $this->var['euser_data']['user_mp3'] != "", $options) . "</div>";
		}

		$text .= '<div class="mp3-remote d-none"><label for="remoteFormControlInput1" class="form-label">'.PROFILE_150.'</label>';
	if ($this->var['euser_data']['user_mp3'] != "") {
		$value = $this->var['euser_data']['user_mp3'];
	} else {
		$value = "http://...";
	}
	$text .= "<input type='text' class='form-control' id='remoteFormControlInput1' name='mp3[remote]' value='".$value."'>
	</div>";

//	if ($this->var['euser_pref']['mp3'] == "Remote Only") {
/*
		$http = 1;
		$text .= "<input type='hidden' id='select' name='mp3[]' value='remote' checked>";
		if(strpos($this->var['euser_data']['user_mp3'], "http://") === false && strpos($this->var['euser_data']['user_mp3'], "https://") === false && strpos($this->var['euser_data']['user_mp3'], "ftp://") === false) {
		$http = 0;
	}
	if ($this->var['euser_data']['user_mp3'] != "" && $http == 1) {
		$value = $this->var['euser_data']['user_mp3'];
		$text .= "<input type='radio' id='select' name='mp3[]' value='none'> ".PROFILE_159a."<br/><br/>";
	} else {
		$value = "http://...";
	}
	//$text .= "<br/><table width='100%'><tr><td class='forumheader'>".PROFILE_150a."</td></tr></table>";
	//$text .= "<br/><input type='text' class='tbox' size='80' name='remote' value='".$value."'><br/><br/>";
		$text .= '<div class="mb-3">
					<label for="remoteFormControlInput1" class="form-label">'.PROFILE_150a."</label>
					<input type='text' class='form-control' id='remoteFormControlInput1' name='mp3[remote]' value='{$value}'>
				</div>";
*/
//	}

//	$text .= "<br>".PROFILE_155;
//	$text .= "<br/>".PROFILE_151."<br/><br/><input type='file' class='tbox' name='mp3[file_userfile][]' value='".$lvalue."'>";

	return $text;
}

	}

	function sc_euser_music_local($parms = null)
	{
		if ($this->var['euser_pref']['mp3enabled'] && ($this->var['euser_pref']['mp3'] == "Both" || $this->var['euser_pref']['mp3'] == "Local Only")){
			if($parms['radio'])
		{
			//			$options['enabled'] = array('title' => LAN_USER_84);
			$options['label'] = PROFILE_153;
			$options['id'] = 'local';

			return "<div class='radio'>" . e107::getForm()->radio("mp3[]", 'local', strpos($this->var['euser_data']['user_mp3'], "http://") === false && strpos($this->var['euser_data']['user_mp3'], "https://") === false && strpos($this->var['euser_data']['user_mp3'], "ftp://") === false, $options) . "</div>";
		}


		$text .= "<div class='mp3-local d-none'><div class='alert alert-secondary' role='alert'>".PROFILE_180.$this->sc_euser_music_size().PROFILE_181."</div>
".PROFILE_155;
//		$text .= "<input type='radio' id='select' name='mp3[]' value='none'> ".PROFILE_159a."<br/><br/>";
//		$text .= "<br>".PROFILE_155a;
		$text .= "<br/>".PROFILE_151."<br/><br/><input type='file' class='tbox' name='mp3[file_userfile][]' value='".$lvalue."'></div>";

		return $text;
	}
	
	}

	function sc_euser_music_none($parms = null)
	{
		if ($this->var['euser_pref']['mp3enabled']) {
			if ($parms['radio'])
		{
//			$options['enabled'] = array('title' => LAN_USER_84);
			$options['label'] = PROFILE_159;
			$options['id'] = 'none';

			return "<div class='radio'>" . e107::getForm()->radio("mp3[]", 'none', $this->var['euser_data']['user_mp3'] == "", $options) . "</div>";
		}

	}
		
	}

//	function sc_euser_music_edit(){
//		global $eus;
//		return "safklagçklçaskçdlkflçfkfçalsdfkad";
//		$this->wrapper('euser_settings/edit');


//var_dump ($this->var['euser_data']);
//var_dump ($this->var['euser_pref']['mp3enabled']);
// MP3 /// Render menu mp3
//if ($this->var['euser_pref']['mp3enabled'] == "ON" || $this->var['euser_pref']['mp3enabled'] == "") {
//if ($this->var['euser_pref']['mp3enabled']) {
/*
$text .= '<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#MP3Modal">'.LAN_EUSER_103.'
</button>';
*/
// MAX_MP3_FILESIZE
/*
$this->maxmp3meret = $this->var['euser_pref']['mp3size']/1024;
if ($this->maxmp3meret >= $this->post_max_info) {
	$this->maxmp3meret = $this->post_max_info;
}
$maxmp3meret_kb = $this->maxmp3meret * 1024;  // É definido aqui mas nunca é usado... Deixei por causa das cócegas....
*/
	//	$sql->mySQLresult = @mysql_query("SELECT user_id, user_custompage, user_background, user_simple, user_mp3 FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
	//	$rows = $sql->rows();
	//	$profile = $sql->fetch();
//		$this->sql->select("euser", "user_id, user_custompage, user_background, user_simple, user_mp3", "user_id='{$id}'");
//		$rows = $this->sql->rows();
//		$profile = $this->sql->fetch();
/*
$profile = $this->sql->retrieve("euser_mp3", "mp3_id, mp3_embed", "mp3_id='{$id}'");
if ($profile['mp3_embed'] == "") {
	$mp3file = "<i>".PROFILE_278."</i>";
} else {
	if(strpos($profile['mp3_embed'], "http://") === false) {
	$mp3file = $profile['mp3_embed'];
	} else {
		$mp3break = explode("/", $profile['mp3_embed']);
		$mp3file = end($mp3break);
	}
}
$currentmp3 = " ".PROFILE_158." ".str_replace("_", " ", $mp3file);
*/
/*
$text .= '<!-- Modal -->
<div id="MP3Modal" class="modal fade " tabindex="-1" aria-labelledby="MP3ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="MP3ModalLabel">'.LAN_EUSER_103.'</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
';
*/
//$text .="<tr><td {$main_colspan} width='20%' class='forumheader3'>";
//$text .= "<img src ='images/mp3.png' style='border: 0px solid black; width: 16px; height: 16px; float: left; margin-right: 3px' alt = ''><a href='euser_settings.php?page=mp3".$luid."'>".PROFILE_166."</a><br>";
//$text .= "</td><td class='forumheader3'>".PROFILE_180."".sprintf("%01.1f", $maxmp3meret)."".PROFILE_181."</span></td></tr>";
/*
$text .= '<div class="alert alert-secondary" role="alert">'.PROFILE_180."".sprintf("%01.1f", $this->maxmp3meret)."".PROFILE_181.'</div>';
*/
/*
$text .= "<table width='100%'><tr><td class='forumheader'><img src='images/music.png'><span style='text-align:center;width: 100%;position: absolute;line-height: 1.25em;'><b><u>".PROFILE_166."</u></b><br>";
	$text .= PROFILE_180."".sprintf("%01.1f", $maxmp3meret)."".PROFILE_181.$currentmp3;
$text .= "</span></td></tr></table>";

$text .= "<form method='POST' enctype='multipart/form-data' action='formhandler.php'>";
*/
//$sql->db_Select("euser","user_mp3","user_id=".intval($id)."");
//$row = $sql->db_Fetch();
//$sql->db_Select("euser","user_mp3","user_id=".intval($id)."");
//$row = $this->sql->retrieve("euser","user_mp3","user_id=".intval($id)."");

//if ($this->var['euser_pref']['mp3'] == "Both") {
//	$text .= "<br /><table width='100%'><tr><td class='forumheader'>".PROFILE_154;
//	$text .= "<br />".PROFILE_154;
/*
	if ($this->var['euser_data']['user_mp3'] == "") {
		$http = 1;
//		$text .= "<input type='radio' id='select' name='mp3[]' value='remote'> ".PROFILE_152."    <input type='radio' id='select' name='mp3[]' value='local'> ".PROFILE_153."    <input type='radio' id='select' name='mp3[]' value='none' checked> ".PROFILE_159."<br/><br/>";
	} elseif(strpos($this->var['euser_data']['user_mp3'], "http://") === false && strpos($this->var['euser_data']['user_mp3'], "https://") === false && strpos($this->var['euser_data']['user_mp3'], "ftp://") === false) {
		$http = 0;
//		$text .= "<input type='radio' id='select' name='mp3[]' value='remote'> ".PROFILE_152."    <input type='radio' id='select' name='mp3[]' value='local' checked> ".PROFILE_153."     <input type='radio' id='select' name='mp3[]' value='none'> ".PROFILE_159."<br/><br/>";
	} else {
		$http = 1;
//		$text .= "<input type='radio' id='select' name='mp3[]' value='remote' checked> ".PROFILE_152."    <input type='radio' id='select' name='mp3[]' value='local'> ".PROFILE_153."    <input type='radio' id='select' name='mp3[]' value='none'> ".PROFILE_159."<br/><br/>";
	}
*/
//	$text .= "<table width='100%'><tr><td class='forumheader'>".PROFILE_150;
	/*
	$text .= '<div class="mb-3"><label for="remoteFormControlInput1" class="form-label">'.PROFILE_150.'</label>';
	if ($this->var['euser_data']['user_mp3'] != "" && $http == 1) {
		$value = $this->var['euser_data']['user_mp3'];
	} else {
		$value = "http://...";
	}
	$text .= "<input type='text' class='form-control' id='remoteFormControlInput1' name='mp3[remote]' value='".$value."'>
	</div>";
	*/
//}
/*
if ($this->var['euser_pref']['mp3'] == "Remote Only") {
	$http = 1;
	$text .= "<input type='hidden' id='select' name='mp3[]' value='remote' checked>";
	if(strpos($this->var['euser_data']['user_mp3'], "http://") === false && strpos($this->var['euser_data']['user_mp3'], "https://") === false && strpos($this->var['euser_data']['user_mp3'], "ftp://") === false) {
	$http = 0;
}
if ($this->var['euser_data']['user_mp3'] != "" && $http == 1) {
	$value = $this->var['euser_data']['user_mp3'];
	$text .= "<input type='radio' id='select' name='mp3[]' value='none'> ".PROFILE_159a."<br/><br/>";
} else {
	$value = "http://...";
}
//$text .= "<br/><table width='100%'><tr><td class='forumheader'>".PROFILE_150a."</td></tr></table>";
//$text .= "<br/><input type='text' class='tbox' size='80' name='remote' value='".$value."'><br/><br/>";
	$text .= '<div class="mb-3">
				<label for="remoteFormControlInput1" class="form-label">'.PROFILE_150a."</label>
				<input type='text' class='form-control' id='remoteFormControlInput1' name='mp3[remote]' value='{$value}'>
			</div>";
}
*/
/*
if ($this->var['euser_pref']['mp3'] == "Both") {
//	$text .= "<table width='100%'><tr><td class='forumheader'>".PROFILE_155."</td></tr></table>";
//	$text .= "<br>".PROFILE_155;
}

if ($this->var['euser_pref']['mp3'] == "Local Only") {
//	$text .= "<input type='radio' id='select' name='mp3[]' value='none'> ".PROFILE_159a."<br/><br/>";
//	$text .= "<table width='100%'><tr><td class='forumheader'>".PROFILE_155a."</td></tr></table>";
//	$text .= "<br>".PROFILE_155a;
}
if ($this->var['euser_pref']['mp3'] == "Both" || $this->var['euser_pref']['mp3'] == "Local Only") {
//	$text .= "<br/>".PROFILE_151."<br/><br/><input type='file' class='tbox' name='mp3[file_userfile][]' value='".$lvalue."'>";
}
*/
// Será que o pref buttontype só é usado aqui?
/*
if ($this->var['euser_pref']['buttontype'] == "Yes") {
	$text .= "<br/><br/><input type='hidden' value='".$id."' name='uid'><input type='image' name='updatesong' value='".PROFILE_222."' onmouseover='this.src=\"images/buttons/".e_LANGUAGE."_update_over.gif\"' onmouseout='this.src=\"images/buttons/".e_LANGUAGE."_update.gif\"' src='images/buttons/".e_LANGUAGE."_update.gif' ><input type='hidden' name='updatesong'></form>";
} else {
	$text .= "<br/><br/><br/><input type='hidden' value='".$id."' name='uid'><input type='submit' class='button' name='updatesong' value='".PROFILE_222."'></form>";
}
*/

//	}
/*
	$text .= '
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->
';
*/

//		return $text; 
//	}





	function sc_euser_friends_edit($parm){
//		if ($this->var['euser_pref']['friends']) {
//	$euser_template = e107::getTemplate('euser');
//			        global $euser_template;
			//        var_dump ($euser_template);
					
			//---                if (isset($parm['caption'])){return $this->tp->parseTemplate($euser_template['friends_caption'], TRUE, $this);}
			
			//---$text .= "<div class='virtualpage4".(($_GET['page'] == friends)?"":" hidepiece")."'>";
			// Carrego o ficheiro para no futuro ter uma hipótese de reoordenar como eu quiser isto...
			//var_dump ("Inicio");
//			define(FR_ED, 1);
		return require("includes/friends.php");
//		}
	}
	function sc_euser_images_edit($parm){
///		global $eus;
//		return "safklagçklçaskçdlkflçfkfçalsdfkad";
//		$this->wrapper('euser_settings/edit');
///		return $eus->euser_init(); 
return require("includes/images.php");
	}
	function sc_euser_videos_edit($parm){
///		global $eus;
//		return "safklagçklçaskçdlkflçfkfçalsdfkad";
//		$this->wrapper('euser_settings/edit');
///		return $eus->euser_init(); 
return require("includes/videos.php");
	}

	function sc_euser_profile_stats($parm){
	if ($this->var['euser_pref']['stats']) {
//		$text .= "<br/><div class='forumheader3'><img src ='images/stat.png' style='border: 0px solid black; width: 24px; height: 24px; margin-right: 3px' alt = ''><b>".PROFILE_148."</b></div><br/>";
//			$sql->mySQLresult = @mysql_query("SELECT user_lastviewed, user_totalviews FROM ".MPREFIX."euser WHERE user_id='".$id."' ");
//			$getdata = $sql->fetch();
//			$sql->select("euser", "user_lastviewed, user_totalviews","user_id='{$id}'");
//			$euser_data = $sql->fetch();
		$data = unserialize($this->var['euser_data']['user_lastviewed']);
		$total = count($data);
		$place = 1;
		$text .= "<b>".PROFILE_142."</b><br/>";
		if ($total == 0 || $data == "") {
			$text .= "<i>".PROFILE_143."</i>";
		} else {
			foreach ($data as $d) {
			$spldata = explode("|", $d);
//				$userdata = get_user_data($spldata[0]);
			$userdata = e107::user($spldata[0]);
			$text .= $place.". ".PROFILE_412.": <a href='".e_BASE."user.php?id.".$userdata['user_id']."'>".$userdata['user_name']."</a> ".PROFILE_413.": ".date("Y/m/d. H:i", $spldata[1])."<br/>";
			$place++;
			}
		}
		if (!$this->var['euser_data']['user_totalviews'] == 0) {
			$text .= "<br/>".PROFILE_144." ".($this->var['euser_data']['user_totalviews'] == 1 ? $this->var['euser_data']['user_totalviews']." ".PROFILE_146." ".PROFILE_147 : $this->var['euser_data']['user_totalviews']."".PROFILE_145." ".PROFILE_147a)."";
		}
	} else {
		$text .= "<i>".PROFILE_148a."</i>";
	}
		return $text;
	}

// redundante, já esiste no core
/*
	function sc_euser_del_avatar($parm){
		return e107::getForm()->checkbox('setavatar', 1, false, array('label' => LAN_EUSER_109));
//		"<input type='checkbox' name='setavatar' unchecked ".$setavatar."> ".PROFILE_110."<br/>";
	}
*/
}