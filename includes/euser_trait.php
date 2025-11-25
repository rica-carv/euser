<?php
/*
+---------------------------------------------------------------+
|	e107 website system
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
trait Euser_global_info {
	// some code...
	function userinfo($parm=null)
	{
//		var_dump (e_PLUGIN_DIR);

// Mais coisas com números:
// - comentários
// - listas
// - albuns
// - amigos
// - ficheiros / downloads
// - hiperligações / cliques
// - classificados / anúncios
// - likes ?
//
//
		if (strpos(e_PAGE, "forum") !== false) {
			$sc = e107::getScBatch('view', 'forum');
			$uinfo[$sc->var['post_user']] = $sc->var['user_name'];
//			var_dump ($sc->var);
		} elseif (strpos(e_PAGE, "news") !== false) {
			$sc = e107::getScBatch('news');
//			$uid = $sc->news_item['news_author'];
//			$uname = $sc->news_item['user_name'];
			$uinfo[$sc->news_item['news_author']] = $sc->news_item['user_name'];
////			var_dump ($sc->news_item);
		} elseif (strpos(e_PAGE, "pm") !== false) {
//			$sc = e107::getScBatch('pm');
//			$sc = e107::getScBatch('pm');

//			$userTo = $sc->sc_pm_form_touser();
//				var_dump($userTo);
//			$classTo = $sc->sc_pm_form_toclass();
//				var_dump($classTo);
//		var_dump($sc->var);
//			$sc = e107::getScBatch('epm');

//			$userTo = $sc->sc_pm_form_touser();
//				var_dump($userTo);
//			$classTo = $sc->sc_pm_form_toclass();
//				var_dump($classTo);
//		var_dump($sc->var);
			require_once(e_PLUGIN . 'pm/pm_class.php');
			$pm = new private_message();
				$qs = explode('.', e_QUERY);
				$pm_proc_id = intval(varset($qs[1], 0));
//			$pm_info = $pm->pm_get($pm_proc_id);
//				var_dump($pm_info);
/*
	if(isset($_POST['pm_come_from']))
	{
		$pmSource = $tp->toDB($_POST['pm_come_from']);
	}
	elseif(isset($qs[2]))
	{
		$pmSource = $tp->toDB($qs[2]);
	}
*/
			$pm_info = $pm->pm_get($pm_proc_id);
/*
			if(!empty($sc->var['pm_from']))
			{
				$uinfo[$sc->var()['pm_from']] = $sc->var()['from_name'];
				var_dump($uinfo);
//				return e107::getForm()->hidden('pm_to', $this->var['pm_from']).$this->var['from_name'];
			}
*/
//////			if($pm_info['pm_to'] != USERID && $pm_info['pm_from'] != USERID)
//				var_dump($pm_info);
//			echo "<hr>";
			if($pm_info['pm_from'] != USERID)
			{
				$uinfo[$pm_info['pm_from']] = $pm_info['from_name'];
//				var_dump($uinfo);
//				return e107::getForm()->hidden('pm_to', $this->var['pm_from']).$this->var['from_name'];
			} else {
				$uinfo[$pm_info['pm_to']] = $pm_info['sent_name'];

			}
//				var_dump($uinfo);
//			$uid = $sc->news_item['news_author'];
//			$uname = $sc->news_item['user_name'];
//			$uinfo[$sc->news_item['news_author']] = $sc->news_item['user_name'];
////			var_dump ($sc->news_item);
		} elseif (strpos(e_PAGE, "euser") !== false) {
			$sc = e107::getScBatch('user', 'euser', 'user');
//			$uid = $_GET['id'];
//var_dump($sc);
//var_dump($sc->getVars());
//echo "<hr>";
			$uinfo[$sc->getVars()['user_id']] = $sc->getVars()['user_name'];
		}
/*
		echo "<pre>";
		var_dump($sc->var);
		echo "</pre>";
		  var_dump ($uinfo);
		  echo "<pre>";
		  var_dump($this->var);
		  echo "</pre>";
*/
//		if (!$uinfo) {

//		}
		
//		  return ($parm=='name'?$unm:$uid);
		// vou passar ausar um array
//		  return array($uid => $uname);
//var_dump ($uinfo);
		  return ($uinfo??null);
	}

}

trait Euser_admin_info {
	// some code...
	function adminwarn($euser_pref, $parm=null)
	{
		if(ADMIN)
		{
			$tp = e107::getParser();
//				var_dump($euser_pref['friend_sys']);
/*
			$sections = $euser_pref['friend_sys']?LAN_EUSER_130.", ":null;
			$sections .= $euser_pref['image_sys']?LAN_EUSER_140.", ":null;
			$sections .= $euser_pref['video_sys']?LAN_EUSER_150:null;
*/
			$sections[$euser_pref['friend_sys']][]= LAN_EUSER_130;
			$sections[$euser_pref['image_sys']][]=LAN_EUSER_140;
			$sections[$euser_pref['video_sys']][]=LAN_EUSER_150;

//			$adminwarn = "<div class='alert alert-warning'>".$tp->lanVars($tp->toHTML(LAN_EUSER_6, true), array('x'=>$sections)).'</div>';
//			var_dump($sections);
			$adminwarn = "<div class='alert alert-warning'>".$tp->toHTML(LAN_EUSER_6, true);
			$adminwarn .= $sections[0]?$tp->lanVars($tp->toHTML(LAN_EUSER_7, true), array('x'=>implode(", ", $sections[0]))):'';
			$adminwarn .= $sections[1]?'<br>'.$tp->lanVars($tp->toHTML(LAN_EUSER_8, true), array('x'=>implode(", ", $sections[1]))):'';
			$adminwarn .= '</div>';
		}
		return ($adminwarn??null);
	}
}

trait Euser_info {
	// some code...
	/*
	protected $flags = array(
		1 => 'infovis_fr',	2 => 'infovis_us',	4 => 'infovis',
		8 => 'prcommvis_fr',	16 => 'prcommvis_us',	32 => 'prcommvis',
		64 => 'prcom_fr',	128 => 'prcom_us',	256 => 'prcom_vis',
		512 => 'prmp3vis_fr',	1024 => 'prmp3vis_us',	2048 => 'prmp3vis',
		4096 => 'friendvis_fr',	8192 => 'friendvis_us',	16384 => 'friendvis',
		32768 => 'pmfriend',
		65536 => 'emfriend',
		131072 => 'showfrbut',
		262144 => 'primgvis_fr',	524288 => 'primgvis_us',	1048576 => 'primgvis',
		2097152 => 'primgcom_fr',	4194304 => 'primgcom_us',	8388608 => 'primgcom',
		16777216 => 'prvidvis_fr',	33554432 => 'prvidvis_us',	67108864 => 'prvidvis',
		134217728 => 'prvidcom_fr',	268435456 => 'prvidcom_us',	536870912 => 'prvidcom',
	);
	*/
	protected $flags = array(
		'infovis_fr'=> 1 ,	'infovis_us'=> 2 ,	'infovis' =>4 ,
		'prcommvis_fr'=>8  ,	'prcommvis_us'=>16  ,	'prcommvis' =>32 ,
		'prcom_fr'=> 64 ,	'prcom_us'=> 128 ,	'prcom'=> 256 ,
		'prmp3vis_fr'=> 512 ,	'prmp3vis_us'=> 1024 ,	'prmp3vis'=> 2048 ,
		'friendvis_fr'=> 4096 ,	'friendvis_us'=> 8192 ,	'friendvis'=> 16384 ,
		'pmfriend' => 32768 ,
		'emfriend' =>65536 ,
		'showfrbut' =>131072 ,
		'primgvis_fr'=> 262144 ,	'primgvis_us'=> 524288 ,	'primgvis' => 1048576,
		'primgcom_fr' => 2097152,	'primgcom_us' => 4194304,	'primgcom' => 8388608,
		'prvidvis_fr' => 16777216,	'prvidvis_us' => 33554432,	'prvidvis' => 67108864,
		'prvidcom_fr' => 134217728,	'prvidcom_us' => 268435456,	'prvidcom' => 536870912,
	);

	function euser_setprefs($euser_id = USERID, $parm=null)
	{
/*
		const TYPE_CONTRACTOR = 1;   // 00000001
		const TYPE_CASUAL = 2;       // 00000010
		const TYPE_PARTTIME = 4;     // 00000100
		const TYPE_FULLTIME = 8;     // 00001000
		const TYPE_PROJECT = 16;     // 00010000

// Define constants for permissions
const READ = 1;      // Binary: 0001
const WRITE = 2;     // Binary: 0010
const EXECUTE = 4;   // Binary: 0100

// Set initial permissions
$userPermissions = 0;

// Grant permissions using bitwise OR operator (|)
$userPermissions = $userPermissions | READ | WRITE;

// Check if a specific permission is granted using bitwise AND operator (&)
$hasReadPermission = $userPermissions & READ;
$hasWritePermission = $userPermissions & WRITE;
$hasExecutePermission = $userPermissions & EXECUTE;

// Display results
echo "User Permissions: $userPermissions\n";
echo "Has Read Permission: " . ($hasReadPermission ? 'Yes' : 'No') . "\n";
echo "Has Write Permission: " . ($hasWritePermission ? 'Yes' : 'No') . "\n";
echo "Has Execute Permission: " . ($hasExecutePermission ? 'Yes' : 'No') . "\n";
*/
	}

	/*
	 * Note: these functions are protected to prevent outside code
	 * from falsely setting BITS. See how the extending class 'User'
	 * handles this.
	 *
	 */
/*
	protected function isFlagSet($flag)
	{
	  return (($this->flags & $flag) == $flag);
	}
*/  
	protected function setFlag($flag, $value)
	{
	  if($value)
	  {
		$this->flags |= $flag;
	  }
	  else
	  {
		$this->flags &= ~$flag;
	  }
	}
	function euser_getprefs($euser_settings, $parm=null)
	{
/*
		echo "<pre>";
		var_dump ($this->flags);
		var_dump ($euser_settings);
		echo "</pre>";
*/
		foreach($this->flags as $key => $val){
			$prefs[$key] = (($val & $euser_settings) == $val);
		}

/*
//infovis		1, 2, 4
$prefs['infovis_fr']=$euser_prefs['user_settings'] & 1;
$prefs['infovis_us']=$euser_prefs['user_settings'] & 2;
$prefs['infovis_vis']=$euser_prefs['user_settings'] & 4;
//prcommvis	8, 16, 32
$prefs['prcommvis_fr']=$euser_prefs['user_settings'] & 8;
$prefs['prcommvis_us']=$euser_prefs['user_settings'] & 16;
$prefs['prcommvis_vis']=$euser_prefs['user_settings'] & 32;
//		prcom		64, 128, 256
$prefs['prcom_fr']=$euser_prefs['user_settings'] & 64;
$prefs['prcom_us']=$euser_prefs['user_settings'] & 128;
$prefs['prcom_vis']=$euser_prefs['user_settings'] & 256;
//		prmp3vis	512, 1024, 2048
$prefs['prmp3vis_fr']=$euser_prefs['user_settings'] & 512;
$prefs['prmp3vis_us']=$euser_prefs['user_settings'] & 1024;
$prefs['prmp3vis_vis']=$euser_prefs['user_settings'] & 2048;
//		friendvis	4096, 8192, 16384		
$prefs['friendvis_fr']=$euser_prefs['user_settings'] & 4096;
$prefs['friendvis_us']=$euser_prefs['user_settings'] & 8192;
$prefs['friendvis_vis']=$euser_prefs['user_settings'] & 16384;
//		pmfriend	32768
$prefs['pmfriend']=$euser_prefs['user_settings'] & 32768;
//		emfriend	65536
$prefs['emfriend']=$euser_prefs['user_settings'] & 65536;
//		showfrbut	131072
$prefs['showfrbut']=$euser_prefs['user_settings'] & 131072;
//		primgvis 	262144, 524288, 1048576
$prefs['primgvis_fr']=$euser_prefs['user_settings'] & 262144;
$prefs['primgvis_us']=$euser_prefs['user_settings'] & 524288;
$prefs['primgvis_vis']=$euser_prefs['user_settings'] & 1048576;
//		primgcom	2097152, 4194304, 8388608
$prefs['primgcom_fr']=$euser_prefs['user_settings'] & 2097152;
$prefs['primgcom_us']=$euser_prefs['user_settings'] & 4194304;
$prefs['primgcom_vis']=$euser_prefs['user_settings'] & 8388608;
//		prvidvis	16777216, 33554432, 67108864
$prefs['prvidvis_fr']=$euser_prefs['user_settings'] & 16777216;
$prefs['prvidvis_us']=$euser_prefs['user_settings'] & 33554432;
$prefs['prvidvis_vis']=$euser_prefs['user_settings'] & 67108864;
//		prvidcom	134217728, 268435456, 536870912
$prefs['prvidcom_fr']=$euser_prefs['user_settings'] & 134217728;
$prefs['prvidcom_us']=$euser_prefs['user_settings'] & 268435456;
$prefs['prvidcom_vis']=$euser_prefs['user_settings'] & 536870912;
*/
/*

		const TYPE_CONTRACTOR = 1;   // 00000001
		const TYPE_CASUAL = 2;       // 00000010
		const TYPE_PARTTIME = 4;     // 00000100
		const TYPE_FULLTIME = 8;     // 00001000
		const TYPE_PROJECT = 16;     // 00010000

// Define constants for permissions
const READ = 1;      // Binary: 0001
const WRITE = 2;     // Binary: 0010
const EXECUTE = 4;   // Binary: 0100

// Set initial permissions
$userPermissions = 0;

// Grant permissions using bitwise OR operator (|)
$userPermissions = $userPermissions | READ | WRITE;

// Check if a specific permission is granted using bitwise AND operator (&)
$hasReadPermission = $userPermissions & READ;
$hasWritePermission = $userPermissions & WRITE;
$hasExecutePermission = $userPermissions & EXECUTE;

// Display results
echo "User Permissions: $userPermissions\n";
echo "Has Read Permission: " . ($hasReadPermission ? 'Yes' : 'No') . "\n";
echo "Has Write Permission: " . ($hasWritePermission ? 'Yes' : 'No') . "\n";
echo "Has Execute Permission: " . ($hasExecutePermission ? 'Yes' : 'No') . "\n";
*/
		return $prefs;
	}




	// Friends sql: https://stackoverflow.com/questions/24741185/cross-selection-of-two-columns-in-a-mysql-table
	// https://sqlfiddle.com/mysql/online-compiler?&id=6238b70f-718c-4a4e-9bd6-64f57d7fb7a5

}