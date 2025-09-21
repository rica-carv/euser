<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2014 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 */

$eplug_admin = true;
require_once('../../class2.php');

//var_dump(e107::getPref()['lan_global_list']);

if (!getperms('P'))
{
	e107::redirect('admin');
	exit;
}

e107::lan('phillis', 'admin', true);
e107::lan('phillis', 'global', true);
/////////e107::lan('phillis', 'front', true);

require_once(e_PLUGIN."philcat/handlers/philcat_class.php");
e107::lan('philcat', 'front', true);
e107::lan('philcat', 'admin', true);

require_once(e_PLUGIN."philcat/handlers/phil_trait.php");
/*
class PHLIS_Adminsql extends {
    use phillis_trait;

}
*/
/*
trait PHLIS_Admin_functions {

    function getdb_table ($table, $parm = NULL){
   		$sql = e107::getDb();

//        var_dump ($parm);
//        var_dump ($parm == 'selarray');
//        var_dump ($parm == 'count');
        
    	$count = $sql->gen("SELECT * FROM `#phillis_".$table."` ORDER BY descr");

        if ($parm == 'selarray' || $parm == 'selprefarray'){
            if ($parm == 'selprefarray'){
                $array[''] = PHCAT_LA42;
            }
    		while($row = $sql->fetch())
    		{
    			$array[$row['cod']] = $row['descr'];	
    	   	}
            return $array;
            exit;
        }

        return ($parm == 'count'?$count:"");
    }
*/
/*
    function getdb_tipos ($parm = NULL){
   		$sql = e107::getDb();

    	$count = $sql->gen("SELECT * FROM `#phillis_tipo` ORDER BY descr");
        if ($parm = 'array'){
            $array[''] = PHCAT_LA42;
    		while($row = $sql->fetch())
    		{
    			$array[$row['cod']] = $row['descr'];	
    	   	}
            return $array;
            exit;
        }

        return ($parm == 'count'?$count:"");
    }

    function getdb_familias ($parm = NULL){
   		$sql = e107::getDb();

    	$count = $sql->gen("SELECT * FROM `#phillis_familias` ORDER BY descr");
        if ($parm = 'array'){
            $array[''] = PHCAT_LA42;
    		while($row = $sql->fetch())
    		{
    			$array[$row['cod']] = $row['descr'];	
    	   	}
            return $array;
            exit;
        }

        return ($parm == 'count'?$count:"");
    }
*/
//}

class PHLIS_Admin extends e_admin_dispatcher
{
//    use PHLIS_Admin_functions;
///use philcat_trait;
   
   	protected $modes = array(	
		'main'	=> array(
			'controller' 	=> 'PHLIS_Admin_ui',
			'path' 			=> null,
			'ui' 			=> 'PHLIS_Admin_form_ui',
			'uipath' 		=> null
		),
		'db'	=> array(
			'controller' 	=> 'phillis_db_ui',
			'path' 			=> null,
			'ui' 			=> 'phillis_db_form_ui',
			'uipath' 		=> null
		),
		'item'	=> array(
			'controller' 	=> 'phillis_item_ui',
			'path' 			=> null,
			'ui' 			=> 'phillis_item_form_ui',
			'uipath' 		=> null
		),
	);	
	
	protected $adminMenu = array(
		'main/prefs' 		=> array('caption'=> LAN_PREFS, 'perm' => 'P'),	
		'db/main'      		=> array('caption'=> LANAD_PLUGIN_PHILLIS_34, 'perm' => 'P'),	

    	'divider01'         => array('divider' => true),

		'item/list'		=> array('caption'=> LAN_MANAGE." ".LANAD_PLUGIN_PHILLIS_1, 'perm' => 'P'),
		'item/create'		=> array('caption'=> LAN_CREATE." ".LANAD_PLUGIN_PHILLIS_1, 'perm' => 'P'),
	);

	protected $adminMenuAliases = array(
		'item/edit'	=> 'item/list'				
	);	
	
	protected $menuTitle = LAN_PLUGIN_PHILLIS_PAGE_NAME;

	public function init()
	{
/*
///// CONTADOR PARA IMAGESN NO MENU LATERAL
    		$f = e107::getFile();

            // Depois tenho de mudar isto para usar mesmo os cods da tabela paises....
			foreach(array('1', '2', '3', '4', '6', '7') as $var)
			{
          		$fList = $f->get_files(e_PLUGIN.'phillis\media\/'.$var.'\o', '\.jpg$');
        		$fcount += (count($fList));
			}
*/
//    		$count = self::getcount_images();

//			$this->adminMenu['images/list']['badge'] = array('value' => (int)$count, 'type' => ($count?'info':'warning'));

/*
    		$sql = e107::getDb();
    		$countp = $sql->gen("SELECT * FROM `#phillis_pais` ORDER BY descr");
			$this->adminMenu['country/list']['badge'] = array('value' => (int)$countp, 'type' => ($countp?'info':'warning'));

    		$countt = $sql->gen("SELECT * FROM `#phillis_tipo` ORDER BY descr");
			$this->adminMenu['type/list']['badge'] = array('value' => (int)$countt, 'type' => ($countt?'info':'warning'));

    		$countf = $sql->gen("SELECT * FROM `#phillis_familias` ORDER BY descr");
			$this->adminMenu['family/list']['badge'] = array('value' => (int)$countf, 'type' => ($countf?'info':'warning'));
*/
    		$sql = e107::getDb();
//    		$count = self::getdb_table('pais', 'count');
//            $count = $sql->select("phillis_pais");

//            var_dump ($countp);

//			$this->adminMenu['country/list']['badge'] = array('value' => (int)$count, 'type' => ($count?'info':'warning'));
//    		$count = self::getdb_table('tipo', 'count');
//            $count = $sql->select("phillis_tipo");
//			$this->adminMenu['type/list']['badge'] = array('value' => (int)$count, 'type' => ($count?'info':'warning'));
//      		$count = self::getdb_table('familias', 'count');
//            $count = $sql->select("phillis_familias");
//			$this->adminMenu['family/list']['badge'] = array('value' => (int)$count, 'type' => ($count?'info':'warning'));
//    		$count = self::getdb_table('', 'count');
            $count = $sql->select("phillis");
			$this->adminMenu['item/list']['badge'] = array('value' => (int)$count, 'type' => ($count?'info':'warning'));
//    		$count = self::getdb_table('series', 'count');
//            $count = $sql->select("phillis_series");
//			$this->adminMenu['series/list']['badge'] = array('value' => (int)$count, 'type' => ($count?'info':'warning'));
//    		$count = self::getdb_table('papel', 'count');
//            $count = $sql->select("phillis_papel");
//			$this->adminMenu['papel/list']['badge'] = array('value' => (int)$count, 'type' => ($count?'info':'warning'));
//    		$count = self::getdb_table('denteados', 'count');
//            $count = $sql->select("phillis_denteados")//;
//			$this->adminMenu['dent/list']['badge'] = array('value' => (int)$count, 'type' => ($count?'info':'warning'));
//    		$count = self::getdb_table('art', 'count');
//            $count = $sql->select("PHLIS_Art");
//			$this->adminMenu['art/list']['badge'] = array('value' => (int)$count, 'type' => ($count?'info':'warning'));
//    		$count = self::getdb_table('imp', 'count');
//            $count = $sql->select("phillis_imp");
//			$this->adminMenu['imp/list']['badge'] = array('value' => (int)$count, 'type' => ($count?'info':'warning'));
//    		$count = self::getdb_table('local', 'count');
//            $count = $sql->select("LAN_PLUGIN_PHILLIS_ocal");
//			$this->adminMenu['local/list']['badge'] = array('value' => (int)$count, 'type' => ($count?'info':'warning'));
//       		$count = self::getdb_table('codigo_catalogo', 'count');
//            $count = $sql->select("phillis_codigo_catalogo");
//			$this->adminMenu['catalogo/list']['badge'] = array('value' => (int)$count, 'type' => ($count?'info':'warning'));

	}
}

define("LANAD_PLUGIN_PHILLIS_5828",LANAD_PLUGIN_PHILLIS_58.mb_strtolower(LANAD_PLUGIN_PHILLIS_28, 'UTF-8'));
define("LANAD_PLUGIN_PHILLIS_5848",LANAD_PLUGIN_PHILLIS_58.mb_strtolower(LANAD_PLUGIN_PHILLIS_48, 'UTF-8'));
//define("LCOMENU7_FILTER",strtoupper(LCLAN_OPT_MENU_7)." - ".LAN_FILTER);
class PHLIS_Admin_ui extends e_admin_ui
{
//    use PHLIS_Admin_functions;
//    use phillis_trait;
use Phil_trait;
   
	protected $pluginTitle		= LAN_PLUGIN_PHILLIS_PAGE_NAME;
	protected $pluginName		= 'phillis';
	protected $eventName		= 'phillis';
	protected $table			= 'generic';
	protected $pid				= 'gen_id';
	protected $perPage			= 10; 
	protected $batchDelete		= true;
	protected $batchCopy		= true;		
		
// 	protected $preftabs        = array(LAN_GENERAL, PHCAT_LA47, PHCAT_L01." - ".LAN_FILTER, PHCAT_LA32, PHCAT_LA33);
 	protected $preftabs        = array(LAN_GENERAL);
	protected $prefs = array(
/*
		'list'		 => array('title'=> PHCAT_LA39, 'tab'=>0, 'type'=>'boolean', 'data' => 'int','help'=> ''),
		'approval'	 => array('title'=> PHCAT_LA25, 'tab'=>0, 'type'=>'boolean', 'data' => 'int','help'=> ''),
*/

        'read'		 => array('title' => LANAD_PLUGIN_PHILLIS_29, 'tab'=>0, 'type'=>'userclass', 'data' => 'int','help'=>''),
//        'admin'		 => array('title' => LANAD_PLUGIN_PHILLIS_29233422434, 'tab'=>0, 'type'=>'userclass', 'data' => 'int','help'=>''),
        'create'	 => array('title' => LANAD_PLUGIN_PHILLIS_30, 'tab'=>0, 'type'=>'userclass', 'data' => 'int','help'=>''),
        'admin'		 => array('title' => LANAD_PLUGIN_PHILLIS_28, 'tab'=>0, 'type'=>'userclass', 'data' => 'int','help'=>''),
		'terms'	     => array('title' => LANAD_PLUGIN_PHILLIS_5828, 'tab'=>0, 'type'=>'bbarea'),
		'log'        => array('title'=> LANAD_PLUGIN_PHILLIS_52, 'tab'=>0, 'type'=>'boolean', 'data' => 'int','help'=> ''),
		'approval'	 => array('title'=> LANAD_PLUGIN_PHILLIS_25, 'tab'=>0, 'type'=>'boolean', 'data' => 'int','help'=> ''),
		'pop'	     => array('title'=> LANAD_PLUGIN_PHILLIS_35, 'tab'=>0, 'type'=>'boolean', 'data' => 'int','help'=> ''),
		'perpage'	 => array('title' => LANAD_PLUGIN_PHILLIS_57, 'tab'=>0, 'type'=>'number', 'data' => 'string', 'defaultValue' => '15'),

		'allow_fviews'      => array('title' =>  LANAD_PLUGIN_PHILLIS_15, 'tab'=>0, 'type' => 'dropdown', 'data' => 'str', 'readParms' => array()),
		'allow_tviews'      => array('title' =>  LANAD_PLUGIN_PHILLIS_16, 'tab'=>0, 'type' => 'dropdown', 'data' => 'str', 'readParms' => array()),
		'allow_eviews'      => array('title' =>  LANAD_PLUGIN_PHILLIS_17, 'tab'=>0, 'type' => 'dropdown', 'data' => 'str', 'readParms' => array()),

		'colnum'	 => array('title' => LANAD_PLUGIN_PHILLIS_56, 'tab'=>0, 'type'=>'text', 'data' => 'string', 'defaultValue' => '|'),
        'compare'	 => array('title' => LANAD_PLUGIN_PHILLIS_31, 'tab'=>0, 'type'=>'userclass', 'data' => 'int','help'=>''),

		'allow_cviews'      => array('title' =>  LANAD_PLUGIN_PHILLIS_18, 'tab'=>0, 'type' => 'dropdown', 'data' => 'str', 'readParms' => array()),

///		'aterms'	     => array('title' => LANAD_PLUGIN_PHILLIS_5828, 'tab'=>0, 'type'=>'bbarea'),
		'discl'	     => array('title' => LANAD_PLUGIN_PHILLIS_54." ".LANAD_PLUGIN_PHILLIS_55, 'tab'=>0, 'type'=>'bbarea'),

    	'dformat'    => array('title' => LANAD_PLUGIN_PHILLIS_49, 'tab'=>0, 'type' => 'dropdown', 'data' => 'str', 'readParms' => array(), 'writeParms' => array('optArray' => array('d-m-y' => LANAD_PLUGIN_PHILCAT_62,'m-d-y' => LANAD_PLUGIN_PHILCAT_63,'y-m-d' => LANAD_PLUGIN_PHILCAT_64))),

		'userating'	 => array('title'=> LANAD_PLUGIN_PHILLIS_50, 'tab'=>0, 'type'=>'boolean', 'data' => 'int','help'=> ''),
		'usecomments'       => array('title'=> LANAD_PLUGIN_PHILLIS_66, 'tab'=>0, 'type'=>'boolean', 'data' => 'int','help'=> ''),
		'icons'      => array('title'=> LANAD_PLUGIN_PHILLIS_51, 'tab'=>0, 'type'=>'boolean', 'data' => 'int','help'=> ''),

		'metad'	     => array('title' => LANAD_PLUGIN_PHILLIS_59, 'tab'=>0, 'type'=>'textarea', 'data' => 'string'),
		'metak'	     => array('title' => LANAD_PLUGIN_PHILLIS_60, 'tab'=>0, 'type'=>'textarea', 'data' => 'string'),

		'def_pais'      => array('title' =>  LAN_PLUGIN_PHILCAT_12." ".LANAD_PLUGIN_PHILLIS_11, 'tab'=>0, 'type' => 'dropdown', 'data' => 'str', 'readParms' => array()),
		'def_tipo'      => array('title' =>  LAN_PLUGIN_PHILCAT_13." ".LANAD_PLUGIN_PHILLIS_11, 'tab'=>0, 'type' => 'dropdown', 'data' => 'str', 'readParms' => array()),
		'def_familia'   => array('title' =>  LAN_PLUGIN_PHILCAT_15." ".LANAD_PLUGIN_PHILLIS_11, 'tab'=>0, 'type' => 'dropdown', 'data' => 'str', 'readParms' => array())

//		'aterms'	 => array('title' => PHCAT_LA5848, 'tab'=>0, 'type'=>'bbarea'),
//    	'dformat'    => array('title' => PHCAT_LA49, 'tab'=>0, 'type' => 'dropdown', 'data' => 'str', 'readParms' => array(), 'writeParms' => array('optArray' => array('d-m-y' => PHCAT_LA62,'m-d-y' => PHCAT_LA63,'y-m-d' => PHCAT_LA64))),
//		'usecomments'=> array('title'=> PHCAT_LA23, 'tab'=>0, 'type'=>'boolean', 'data' => 'int','help'=> ''),
/*
		'poli'       => array('title'=> PHCAT_LA30, 'tab'=>0, 'type'=>'boolean', 'data' => 'int','help'=> ''),
		'agrup_dent' => array('title' => PHCAT_LA27, 'tab'=>0, 'type'=>'boolean', 'data' => 'int','help'=> ''),
		'separator'	 => array('title' => PHCAT_LA56, 'tab'=>0, 'type'=>'text', 'data' => 'string'),
		'perpage'	 => array('title' => PHCAT_LA57, 'tab'=>0, 'type'=>'number', 'data' => 'string'),
*/
/*
   		'allow_cat'	     => array('title' => PHCAT_LA15." ".PHCAT_LA16, 'tab'=>1, 'type' => 'checkboxes', 'defaultValue' => '255'),
   		'allow_accordion' => array('title' => PHCAT_LA15." ".PHCAT_LA43, 'tab'=>1, 'type' => 'checkboxes', 'defaultValue' => '255'),
   		'allow_vseries'	 => array('title' => PHCAT_LA15." ".PHCAT_LA44, 'tab'=>1, 'type' => 'checkboxes', 'defaultValue' => '255'),
   		'allow_vpecas'	 => array('title' => PHCAT_LA15." ".PHCAT_LA45, 'tab'=>1, 'type' => 'checkboxes', 'defaultValue' => '255'),
   		'allow_vvar'	 => array('title' => PHCAT_LA15." ".PHCAT_LA46, 'tab'=>1, 'type' => 'checkboxes', 'defaultValue' => '255'),


		'agrup_dent' => array('title' => PHCAT_LA27, 'tab'=>3, 'type'=>'boolean', 'data' => 'int','help'=> ''),

		'list'		 => array('title'=> PHCAT_LA39, 'tab'=>4, 'type'=>'boolean', 'data' => 'int','help'=> ''),
*/
	);
	
	public function init()
	{
// É preciso aqui definir os dropdowns do Pais, Familia e tipo
/*
    		$sql = e107::getDb();


    		$sql->gen("SELECT * FROM `#phillis_pais` ORDER BY descr");
            $array[''] = PHCAT_LA42;
    		while($row = $sql->fetch())
    		{
    			$array[$row['cod']] = $row['descr'];	
    	   	}
*/
    		$array = self::get_phildbtable('pais', 'selarray');
   		$this->prefs['def_pais']['writeParms']['optArray'] = varset(self::get_phildbtable('pais', 'selprefarray'), array());
/*
    		$sql->gen("SELECT * FROM `#phillis_tipo` ORDER BY descr");
            $array[''] = PHCAT_LA42;
    		while($row = $sql->fetch())
    		{
//    			$id = $row['cod'];
    			$array[$row['cod']] = $row['descr'];	
    	   	}
    		$this->prefs['def_tipo']['writeParms']['optArray'] = varset($array, array());
*/
   		$this->prefs['def_tipo']['writeParms']['optArray'] = varset(self::get_phildbtable('tipo', 'selprefarray'), array());
/*
    		$sql->gen("SELECT * FROM `#phillis_familias` ORDER BY descr");
            $array[''] = PHCAT_LA42;
    		while($row = $sql->fetch())
    		{
//    			$id = $row['cod'];
    			$array[$row['cod']] = $row['descr'];	
    	   	}
    		$this->prefs['def_familia']['writeParms']['optArray'] = varset($array, array());
*/
   		$this->prefs['def_familia']['writeParms']['optArray'] = varset(self::get_phildbtable('familias', 'selprefarray'), array());


function r_viewtype_check($fieldname, $curval = '', $optlist = "")
{
	global $pref;
	$curArray = explode(",", $curval);
	$ret = "";
	$ret .= "<div class='tbox' style='margin-left:0px;margin-right:auto;width:60%;height:58px;overflow:auto'>";
	if (!$optlist || strpos($optlist, "c") !== FALSE)
	{
		$c = (in_array("c", $curArray)) ? " checked='checked' " : "";
		$ret .= "<label><input type='checkbox' name='{$fieldname}[c]' value='1' {$c} /> ".LAN_PLUGIN_PHILLIS_42."</label><br />";
	}
	if (!$optlist || strpos($optlist, "x") !== FALSE)
	{
		$c = (in_array("x", $curArray)) ? " checked='checked' " : "";
		$ret .= "<label><input type='checkbox' name='{$fieldname}[x]' value='1' {$c} /> ".LAN_PLUGIN_PHILLIS_43."</label><br />";
	}
	if (!$optlist || strpos($optlist, "g") !== FALSE)
	{
		$c = (in_array("g", $curArray)) ? " checked='checked' " : "";
		$ret .= "<label><input type='checkbox' name='{$fieldname}[g]' value='1' {$c} /> ".LAN_PLUGIN_PHILLIS_21."</label><br />";
	}
	if (!$optlist || strpos($optlist, "l") !== FALSE)
	{
		$c = (in_array("l", $curArray)) ? " checked='checked' " : "";
		$ret .= "<label><input type='checkbox' name='{$fieldname}[l]' value='1' {$c} /> ".LAN_PLUGIN_PHILLIS_22."</label><br />";
	}
/*
	if (!$optlist || strpos($optlist, "n") !== FALSE)
	{
		$c = (in_array("n", $curArray)) ? " checked='checked' " : "";
		$ret .= "<label><input type='checkbox' name='{$fieldname}[n]' value='1' {$c} /> ".LAN_PLUGIN_PHILLIS_23."</label><br />";
	}
	if (!$optlist || strpos($optlist, "i") !== FALSE)
	{
		$c = (in_array("i", $curArray)) ? " checked='checked' " : "";
		$ret .= "<label><input type='checkbox' name='{$fieldname}[i]' value='1' {$c} /> ".LAN_PLUGIN_PHILLIS_24."</label><br />";
	}
*/
	if (!$optlist || strpos($optlist, "admin") !== FALSE)
	{
		$classList = array("n"=>phillis_23,"i"=>phillis_24);
		foreach($classList as $key => $row)
		{
//			if (strpos($optlist, "matchclass") === FALSE || getperms("0") || check_class($row['userclass_id'])) {
				$c = (in_array($key, $curArray)) ? " checked='checked' " : "";
				$ret .= "<label><input type='checkbox' name='{$fieldname}[{$key}]' value='1' {$c} /> {$row}</label><br />";
//			}
		}
	}
	if (strpos($optlist, "language") !== FALSE && $pref['multilanguage']) {
			$ret .= "<hr />\n";
		$tmpl = explode(",",e_LANLIST);
        foreach($tmpl as $lang){
				$c = (in_array($lang, $curArray)) ? " checked='checked' " : "";
        		$ret .= "<label><input type='checkbox' name='{$fieldname}[{$lang}]'  value='1' {$c} /> {$lang}</label><br />";
		}
	}
	$ret .= "</div>";
	return $ret;
}




        $this->prefs['allow_cat']['writeParms']['optArray'] = e107::getUserClass()->uc_required_class_list();
	    $this->prefs['allow_accordion']['writeParms']['optArray'] = $this->prefs['allow_cat']['writeParms']['optArray'];
	    $this->prefs['allow_vseries']['writeParms']['optArray'] = $this->prefs['allow_accordion']['writeParms']['optArray'];
        $this->prefs['allow_vpecas']['writeParms']['optArray'] = $this->prefs['allow_vseries']['writeParms']['optArray'];
        $this->prefs['allow_vvar']['writeParms']['optArray'] = $this->prefs['allow_vpecas']['writeParms']['optArray'];
    	$this->prefs['perpage']['writeParms']['post'] = "  <div class='label label-warning' role='alert'><i><b>".LAN_PLUGIN_PHILCAT_15."</b></i></div>";
	}
	
	public function beforeCreate($new_data, $old_data)
	{
//			return $new_data;
	}
	
	public function afterCreate($new_data, $old_data, $id)
	{
			// do something
	}

	public function beforeUpdate($new_data, $old_data, $id)
	{
//			return $new_data;
	}

	public function afterUpdate($new_data, $old_data, $id)
	{
//			e107::getCache()->clear("wmessage");
	}
		
	public function onCreateError($new_data, $old_data)
	{
			// do something		
	}

	public function onUpdateError($new_data, $old_data, $id)
	{
			// do something		
	}
}

class phillis_db_ui extends e_admin_ui
{
//    use PHLIS_Admin_functions;
//    use phillis_trait;
   
	protected $pluginTitle		= LAN_PLUGIN_PHILLIS_PAGE_NAME;
	protected $pluginName		= 'phillis';
	protected $eventName		= 'phillis';
/*
	protected $table			= 'generic';
	protected $pid				= 'gen_id';
	protected $perPage			= 10; 
	protected $batchDelete		= true;
	protected $batchCopy		= true;		
		
 	protected $preftabs        = array(LAN_GENERAL, PHCAT_LA47, PHCAT_L01." - ".LAN_FILTER, PHCAT_LA32, PHCAT_LA33);
*/	
protected $tables        = array('philcat' => LANAD_PLUGIN_PHILCAT_1, 'philcat_art' => LANAD_PLUGIN_PHILCAT_7, 'philcat_codigo' => LANAD_PLUGIN_PHILCAT_65, 'philcat_codigo_catalogo' => LAN_PLUGIN_PHILCAT_50, 'philcat_codigo_cotacao' => LANAD_PLUGIN_PHILCAT_66, 'philcat_datas' => LANAD_PLUGIN_PHILCAT_19, 'philcat_denteados' => LANAD_PLUGIN_PHILCAT_5, 'philcat_familias' => LANAD_PLUGIN_PHILCAT_8, 'philcat_folhas' => LAN_PLUGIN_PHILCAT_26, 'philcat_imp' => LANAD_PLUGIN_PHILCAT_9, 'philcat_local' => LANAD_PLUGIN_PHILCAT_10, 'philcat_pais' => LANAD_PLUGIN_PHILCAT_6, 'philcat_papel' => LANAD_PLUGIN_PHILCAT_3, 'philcat_series' => LANAD_PLUGIN_PHILCAT_2, 'philcat_tipo' => LANAD_PLUGIN_PHILCAT_4);

	public function init()
	{

		if($_GET['action'] == 'scan')
		{
			return $this->scanPage();
		}

	}

	
        public function MainPage()
        {
            /** @var file_inspector  */
		$frm 	= e107::getForm();
    	$tp = e107::getParser();
   		$sql = e107::getDb();


/*	if($details['installed'] == true)
	{
		$icon = $tp->toGlyph('fa-check');
		$text = LAN_OK;
		return '<span class="text-success" data-toggle="tooltip" data-bs-toggle="tooltip" data-placement="top" title="' . $text . '">' . $icon . '</span>';
	}

	$icon = $tp->toGlyph('fa-remove');
	$text = $details['error'];
*/
/*
            $fi =e107::getSingleton('file_inspector');
            return $fi->scan_config();
*/

		$text = "<div><div id='results-container'></div>
		<form action='".e_SELF."' method='get' id='scanform'>";

$text .= '<table class="table adminform table-striped">';
$text .= '<thead>';
$text .= '<tr>';
$text .= '<th>' . PHCAT_LA38 . '</th>';
$text .= '<th>' . PHCAT_LA35 . '</th>';
$text .= '<th>' . PHCAT_LA36 . '</th>';
$text .= '<th>' . PHCAT_LA37 . '</th>';
$text .= '</tr>';
$text .= '</thead>';
$text .= '<tbody>';

foreach($this->tables as $table => $name)
{
	$text .= '<tr>';
	$text .= '<td>'.$name.'</td>';
/*
	$text .= '<td>'.$frm->rendervalue("opt_".$table, 1, array('type'  => 'boolean')).'</td>';
	$text .= '<td>'.$frm->rendervalue("miss_".$table, 1, array('type'  => 'boolean'))." ".$tp->toGlyph('fa-check').'</td>';
	$text .= '<td>'.$frm->rendervalue("orph_".$table, 1, array('type'  => 'boolean')).'</td>';
	$text .= '<td>'.$frm->radio_switch("opt_".$table, 1, '', '', array('switch'  => 'normal', 'writeParms' => array('label' => 'yesno'))).'</td>';
	$text .= '<td>'.$frm->radio_switch("miss_".$table, 1, '', '', array('switch'  => 'normal', 'writeParms' => array('label' => 'yesno')))." ".$tp->toGlyph('fa-check').'</td>';
	$text .= '<td>'.$frm->radio_switch("orph_".$table, 1, '', '', array('switch'  => 'normal', 'writeParms' => array('label' => 'yesno'))).'</td>';
*/
//SELECT COUNT(*) FROM count_demos;
//SELECT max(id) FROM tableName
//    $sql_miss = ;
//    	$count = $sql->gen("SELECT COUNT(*), max(cod) FROM #".$table.";");
    	$sql->gen("SELECT COUNT(*), max(cod) FROM #".$table.";");
    		if($row = $sql->fetch()){
                $inntext = $row['COUNT(*)']." / ".$row['max(cod)'];
                $missed = $row['COUNT(*)'] == $row['max(cod)'];
            }

//    var_dump($missed);

	$text .= '<td>'.$frm->renderElement("opt_".$table, 1, array('type'=>'boolean', 'writeParms' => array('label' => 'yesno'))).'</td>';
	$text .= '<td class="all_inline">'.($row['max(cod)']?$frm->renderElement("miss_".$table, !$missed, array('type'=>'boolean', 'writeParms' => array('label' => 'yesno', 'readonly' => $missed)))." <span class='text-".($missed?'success':'warning')."'>".$tp->toGlyph($missed?'fa-check':'fa-remove')." ".$inntext.'</span>':'').'</td>';
	$text .= '<td>'.($row['max(cod)']?$frm->renderElement("orph_".$table, 1, array('type'=>'boolean', 'writeParms' => array('label' => 'yesno'))):'').'</td>';

//$frm->renderElement('hsize', $ppref['hsize'], array('tab'=>0, 'type'=>'number', 'data' => 'int', 'validate' => 'rule_size', 'rule' => 'rule_size', 'error' => 'Validation Error message', 'writeParms' => array('defaultValue' => $ppref['hsize'])))

	$text .= '</tr>';
}

$text .= '</tbody>';
$text .= '</table>';
//$text .= "</fieldset>";

		$text .= "
		<div class='buttons-bar center'>";

			$text .= '<a id="start-render" class="btn btn-primary e-progress e-ajax " data-src="'.e_SELF.'?mode=db&action=scan" data-target="#results-container" data-loading-icon="fa-spinner" data-loading-target="#fi-loading-target" ><span id="fi-loading-target"></span> '.LAN_GO.'</a>';

/*
		$text .= "
		<div class='buttons-bar center'>
		".$frm->admin_button('scan', md5(time()), 'other', LAN_GO).
		$frm->hidden('mode','db').
		$frm->hidden('action','scan')."
*/
		$text .= "</div>
		</form>
		</div>";

//		$html = $head.$text.$foot;


            return $text;

        }

        public function scanPage()
        {

     		$sql = e107::getDb();
  		$msg = e107::getMessage();

foreach($this->tables as $table => $name)
{
//Optimize... OPTIMIZE TABLE `e107_phillis_codigo` 
            if ("opt_".$table){
$msg->addinfo($sql->gen("OPTIMIZE TABLE #".$table));
//                $opt = $sql->gen("OPTIMIZE TABLE #".$table);
            }

//Missing
            if ("miss_".$table){
//                $sql->gen("OPTIMIZE TABLE #".$table);
            }


//Orphan
            $reftables = array(
                'phillis' => array('phillis_codigo'=> 'peca', 'phillis_datas'=> 'peca', 'phillis_folhas'=> 'peca'),
                'PHLIS_Art' => array('phillis'=> 'desenho', 'phillis '=> 'gravura'), //Falta a gravura
                'phillis_codigo_catalogo' => array('phillis_codigo'=> 'cat'), 
                'phillis_codigo' => array('phillis_codigo_cotacao'=> 'codigo'), 
                'phillis_denteados' => array('phillis'=> 'dentv', 'phillis '=> 'denth'), //Falta denth
                'phillis_familias' => array('phillis'=> 'familia'),
                'phillis_imp' => array('phillis'=> 'tipo_imp'),
                'LAN_PLUGIN_PHILLIS_ocal' => array('phillis'=> 'local_imp'),
                'phillis_pais' => array('phillis'=> 'pais'),
                'phillis_papel' => array('phillis'=> 'papel'),
                'phillis_series' => array('phillis'=> 'serie'),
                'phillis_tipo' => array('phillis'=> 'tipo')
            );

            if ("orph_".$table){
/*
SELECT table_a.*
FROM table_a
    LEFT JOIN table_b
        ON table_a.id = table_b.a_key
WHERE table_b.id IS NULL

*/
//                $reforph = $reftables[$table];            
            
//            foreach($reforph as $tab => $fld)
            foreach($reftables[$table] as $tab => $fld)
            {
/*                $dqlorph = "
SELECT ".$table.".*
FROM ".$table."
    LEFT JOIN ".$tab."
        ON ".$table.".cod = ".$tab.".".$fld."
WHERE ".$tab.".".$fld." IS NULL
";
*/
        $tab = trim($tab);

    	$count = $sql->gen("SELECT #".$table.".cod FROM #".$table." LEFT JOIN #".$tab." ON #".$table.".cod = #".$tab.".".$fld." WHERE #".$tab.".".$fld." IS NULL ORDER BY cod");
////    	$contar = $sql->gen("SELECT #".$table.".* FROM #".$table);

/*
                $text .= "
SELECT #".$table.".cod
FROM #".$table."
    LEFT JOIN #".$tab."
        ON #".$table.".cod = #".$tab.".".$fld."
WHERE #".$tab.".".$fld." IS NULL
"        
;
*/

///                $text .= $contar." -> ";
///////////                $text .= $sql->rowCount()." -> ";
            $txt = $this->tables[$table]." <-> ".$this->tables[$tab]." : ".$count."<br>";
			if ($count)
			{
//    		if($sql->fetch()){
                $texterr .= $txt;
            }
            else
            {
//	   $msg->addinfo($txt);
                $textok .= $txt;
            }

            }
    if ($texterr) {$msg->addwarning($texterr); unset ($texterr);}
//    $msg->addwarning(PHCAT_L05);
	if ($textok) {$msg->addinfo($textok); unset ($textok);}

//	   $msg->addinfo(PHCAT_L06);
 
}

        }
//            echo var_dump($_POST).$text;

if ($msg->hasMessage()) {
//    echo $msg->get('error');
//    echo $msg->get('warning');
    echo $msg->render();
////    $ns->tablerender(LAN_PLUGIN_PHILLIS_PAGE_NAME, $tp->parseTemplate($PHCAT_MENU_TITLE.$PHCAT_MENU, false, $sc));
}


////            echo $texterr."<hr>".$textok;
}

	public function beforeCreate($new_data, $old_data)
	{


	}
	
	public function afterCreate($new_data, $old_data, $id)
	{


	}
}

class phillis_item_ui extends e_admin_ui
{
//    use PHLIS_Admin_functions;
//    use phillis_trait;

	protected $pluginTitle      = LAN_PLUGIN_PHILLIS_PAGE_NAME;
	protected $pluginName	    = 'phillis';
	protected $table			= 'phillis';
	protected $pid				= 'cod';
	protected $perPage			= 10; 
	protected $batchDelete		= true;
 	protected $batchCopy		= true;		
	protected $defaultOrderField = 'cod';
	protected $defaultOrder = 'asc';
	
	protected $fields 		= array (
        'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		'cod' =>   array ( 'title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		'original' =>   array ( 'title' => PHCAT_LA13, 'type'=>'number', 'data' => 'str', 'help' => '', 'readParms' => '', 'writeParms' => array('pre' => '<style>.select {width: auto !important;}</style>', ), 'class' => 'left', 'thclass' => 'left',  ),
		'serie' =>   array ( 'title' => PHCAT_L14, 'type'=>'dropdown', 'data' => 'int', 'help' => '', 'readParms' => '', 'writeParms' => array('required'=>1), 'class' => 'left', 'thclass' => 'left',  ),
		'tiragem' =>   array ( 'title' => PHCAT_L31, 'type'=>'number', 'help' => '', 'readParms' => '', 'writeParms' => array('size' => 15, ), 'class' => 'input left', 'thclass' => 'left',  ),
		'papel' =>   array ( 'title' => PHCAT_L16, 'type'=>'dropdown', 'data' => 'int', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
//		'denth' =>   array ( 'title' => PHCAT_L34." (".LAN_HEIGHT.")", 'type'=>'number', 'data' => 'int', 'help' => '', 'readParms' => '', 'writeParms'=>'trClass=hidden', 'class' => 'hidden', 'thclass' => 'hidden'),
		'denth' =>   array ( 'title' => PHCAT_L34." (".LAN_HEIGHT.")", 'type'=>'number', 'data' => 'str', 'help' => '', 'readParms' => '', 'writeParms'=>'trClass=hidden', 'class' => 'hidden', 'thclass' => 'hidden'),
//		'denth' =>   array ( 'title' => PHCAT_L34." (".LAN_HEIGHT.")", 'type'=>'number', 'data' => 'int', 'noedit'=>true),
//		'denth' =>   array ( 'noedit'=>true),
//		'dentv' =>   array ( 'title' => PHCAT_L34." (".LAN_WIDTH.")", 'type'=>'dropdown', 'data' => 'int', 'help' => '', 'readParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
//		'dentv' =>   array ( 'title' => PHCAT_L34." (".LAN_WIDTH." x ".LAN_HEIGHT.")", 'type' => 'method', 'data'=>'int', 'writeParms'=>array('show'=>1, 'tdClassRight'=>'form-inline'), 'help'=>''),
		'dentv' =>   array ( 'title' => PHCAT_L34." (".LAN_WIDTH." x ".LAN_HEIGHT.")", 'type' => 'method', 'data' => 'str', 'writeParms'=>array('show'=>1, 'tdClassRight'=>'form-inline'), 'help'=>''),
//		'denth' =>   array ( 'title' => PHCAT_L34." (".LAN_HEIGHT.")", 'type'=>'dropdown', 'data' => 'int', 'help' => '', 'readParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		'valor_facial' =>   array ( 'title' => PHCAT_L37, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => array('size'=>'block-level', 'required'=>1), 'class' => 'left', 'thclass' => 'left',  ),
		'cor' =>   array ( 'title' => PHCAT_L35, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),
		'descr' =>   array ( 'title' => LAN_DESCRIPTION, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),
//		'larg' =>   array ( 'title' => LAN_WIDTH." x ".LAN_HEIGHT, 'type'=>'number', 'data' => 'int', 'help' => '', 'readParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
//		'alt' =>   NULL,
		'alt' =>   array ( 'title' => LAN_HEIGHT, 'type'=>'number', 'data' => 'int', 'help' => '', 'readParms' => '', 'writeParms'=>'trClass=hidden', 'class' => 'hidden', 'thclass' => 'hidden'),
//		'alt' =>   array ( 'title' => LAN_HEIGHT, 'type'=>'hidden'),
//		'alt' =>   array ( 'title' => LAN_HEIGHT),
//		'alt' =>   array (),
		'larg' =>   array ( 'title' => PHCAT_L49.", ".LAN_WIDTH." x ".LAN_HEIGHT." (".PHCAT_L51.")", 'type'=>'method', 'data' => 'int', 'help' => '', 'readParms' => '', 'writeParms'=>'tdClassRight=form-inline', 'class' => 'left', 'thclass' => 'left',  ),
//		'larg' =>   array ( 'title' => LAN_WIDTH, 'type'=>'number', 'data' => 'int', 'help' => '', 'readParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
//		'alt' =>   array ( 'title' => LAN_HEIGHT, 'type'=>'number', 'data' => 'int', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		'desenho' =>   array ( 'title' => PHCAT_L22, 'type'=>'dropdown', 'data' => 'int', 'help' => '', 'readParms' => '', 'writeParms' => array('required'=>1), 'class' => 'left', 'thclass' => 'left',  ),
/////		'gravura' =>   array ( 'title' => PHCAT_L23, 'type'=>'dropdown', 'data' => 'int', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		'gravura' =>   array ( 'title' => PHCAT_L23, 'type'=>'dropdown', 'data' => 'str', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		'tipo_imp' =>   array ( 'title' => PHCAT_L24, 'type'=>'dropdown', 'data' => 'int', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		'local_imp' =>   array ( 'title' => PHCAT_L25, 'type'=>'dropdown', 'data' => 'int', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		'observacoes' =>   array ( 'title' => PHCAT_L29, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),
//		'folhas_x' =>   array ( 'title' => PHCAT_LA18." (".LAN_WIDTH.")", 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => PHCAT_LA31, 'readParms' => '', 'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),
//		'folhas_y' =>   array ( 'title' => PHCAT_LA18." (".LAN_HEIGHT.")", 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => PHCAT_LA31, 'readParms' => '', 'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),
////		'folhas_y' =>   array ( 'title' => PHCAT_LA18." (".LAN_HEIGHT.")", 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => PHCAT_LA31, 'readParms' => '', 'writeParms'=>'trClass=hidden', 'class' => 'hidden', 'thclass' => 'hidden'),
////		'folhas_x' =>   array ( 'title' => PHCAT_LA18." (".LAN_WIDTH." x ".LAN_HEIGHT.")", 'type' => 'method', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => PHCAT_LA31, 'readParms' => '', 'writeParms'=>'tdClassRight=form-inline', 'class' => 'left', 'thclass' => 'left',  ),
		'pais' =>   array ( 'title' => PHCAT_L12, 'type'=>'dropdown', 'data' => 'int', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		'tipo' =>   array ( 'title' => PHCAT_L13, 'type'=>'dropdown', 'data' => 'int', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		'familia' =>   array ( 'title' => PHCAT_L15, 'type'=>'dropdown', 'data' => 'int', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),

		'folhas' =>   array ( 'title' => PHCAT_L30." ".PHCAT_LA18." (".LAN_WIDTH." x ".LAN_HEIGHT.")", 'type' => 'method', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => PHCAT_LA31, 'readParms' => '', 'writeParms'=>'tdClassRight=form-inline', 'class' => 'left', 'thclass' => 'left',  ),
//		'i_circs' =>   array ( 'title' => PHCAT_LA19." (".PHCAT_L40.")", 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => PHCAT_LA31, 'readParms' => '', 'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),
//		'f_circs' =>   array ( 'title' => PHCAT_LA19." (".PHCAT_L41.")", 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => PHCAT_LA31, 'readParms' => '', 'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),
////		'f_circs' =>   array ( 'title' => PHCAT_LA19." (".PHCAT_L41.")", 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => PHCAT_LA31, 'readParms' => '', 'writeParms'=>'trClass=hidden', 'class' => 'hidden', 'thclass' => 'hidden'),
////		'i_circs' =>   array ( 'title' => PHCAT_LA19." (".PHCAT_L40." - ".PHCAT_L41.")", 'type' => 'method', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => PHCAT_LA31, 'readParms' => '', 'writeParms'=>'tdClassRight=form-inline', 'class' => 'left', 'thclass' => 'left',  ),
		'datas' =>   array ( 'title' => PHCAT_LA19." (".PHCAT_L40." - ".PHCAT_L41.")", 'type' => 'method', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => PHCAT_LA31, 'readParms' => '', 'writeParms'=>'tdClassRight=form-inline', 'class' => 'left', 'thclass' => 'left',  ),

//        'image'			=> array('title' =>ADLAN_105, 'type' => 'image', 'writeParms' => array('dropzone' => 'no', 'readonly'=>TRUE, ), ),
//////        'image'			=> array('title' =>ADLAN_105, 'type' => 'method', ),

        'options' =>   array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),
	);		
		
	protected $fieldpref = array('serie', 'tiragem', 'valor_facial', 'cor', 'descr', 'observacoes', 'image');

 	protected $res		= false;		
	
	public function init()
	{

//        var_dump ($this->getController()->getFields());

//        $frm = e107::getForm();
/*
        $dent = varset(self::getdb_table('denteados', 'selarray'), array());
        $this->fields['dentv']['writeParms'] = $dent;
		$this->fields['dentv']['writeParms']['pre'] = "<style>#dentv, #denth {display: inline;}</style>";
//        $this->fields['dentv']['writeParms'] = varset(self::getdb_table('denteados', 'selarray'), array());
		$this->fields['dentv']['writeParms']['post'] = " x ".$frm->renderElement('denth', $ppref['denth'], array('tab'=>0, 'type'=>'dropdown', 'data' => 'int', 'writeParms' => $dent));

var_dump ($this->fields['dentv']['writeParms']);
*/
/*
echo "<pre>";
var_dump ($this);
echo "</pre>";
*/
/*
        if ($this->getController()->getListModel()){
            $val = $this->getController()->getListModel()->get('alt');		
        }
        $val = $this->getController()->getModel()->get('alt');		
*/
//		$this->fields['larg']['writeParms']['pre'] = "<style>#larg, #alt {display: inline;}</style>";
//		$this->fields['larg']['writeParms']['post'] = " x ".$frm->renderElement('alt', $val, array('tab'=>0, '__tableField' => '`#phillis`.alt', '__tableFrom' => '`#phillis`.alt', 'field' => 'alt', 'type'=>'number', 'data' => 'int', 'validate' => 'rule_size', 'rule' => 'rule_size', 'error' => 'Validation Error message', 'writeParms' => ''));
/*
        ["field"]=>
      string(3) "alt"
      ["__tableField"]=>
      string(14) "`#phillis`.alt"
      ["__tableFrom"]=>
      string(14) "`#phillis`.alt"
*/
////		'alt' =>   array ( 'title' => LAN_HEIGHT, 'type'=>'number', 'data' => 'int', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),

//        $sql = e107::getDb();
        $tp = e107::getParser(); //TODO - find & replace $tp, $e107->tp
        
//		$row = $sql->retrieve("SELECT dblog_eventcode,dblog_title FROM #admin_log WHERE dblog_eventcode !='' AND dblog_title !='' GROUP BY dblog_eventcode",true);

//// Só uso estas 4 colunas....
//        if($rows = $sql->retrieve('phillis_series', 'cod, ano, descr, emissao', '', true)){
        if($rows = e107::getDb()->retrieve('phillis_series', 'cod, ano, descr, emissao', '', true)){
//		$row = $sql->retrieve("SELECT dblog_eventcode,dblog_title FROM #admin_log WHERE dblog_eventcode !='' AND dblog_title !='' GROUP BY dblog_eventcode",true);
	        foreach($rows as $val)
	        {
/*
			$id = $val['dblog_eventcode'];
			$def = strpos($val['dblog_title'], "LAN") !== false ? $id : $val['dblog_title'];
			$this->eventTypes[$id] = str_replace(': [x]', '', deftrue($val['dblog_title'],$def));
*/                            
                $sarray[$val['cod']] = $tp->toHTML($val['ano']).", ".$tp->toHTML($val['descr']).((is_null($val['emissao']) || $val['emissao']<1)?"":" - ".$tp->toHTML($val['emissao']).PHCAT_L20." ".mb_strtolower (PHCAT_L19, 'UTF-8'));
		    }
//            var_dump ($array);

//		$this->prefs['serie']['writeParms'] = array(10=>10, 15=>15, 20=>20, 30=>30, 40=>40, 50=>50);
            $this->fields['serie']['writeParms'] = $sarray;
        }

   		$this->fields['papel']['writeParms'] = varset(self::getdb_table('papel', 'selarray'), array());
/*
        if($rows = $sql->retrieve('phillis_papel', '*', '', true)){
	        foreach($rows as $val)
	        {
                $parray[$val['cod']] = $tp->toHTML($val['descr']);
		    }
            $this->fields['papel']['writeParms'] = $parray;
        }
*/
///////        $this->fields['dentv']['writeParms'] = $this->fields['denth']['writeParms'] = varset(self::getdb_table('denteados', 'selarray'), array());
//        $this->fields['dentv']['writeParms'] = varset(self::getdb_table('denteados', 'selarray'), array());

/*
        if($rows = $sql->retrieve('phillis_denteados', '*', '', true)){
	        foreach($rows as $val)
	        {
                $darray[$val['cod']] = $tp->toHTML($val['descr']);
		    }
            $this->fields['dentv']['writeParms'] = $darray;
            $this->fields['denth']['writeParms'] = $darray;
        }
*/
        $this->fields['desenho']['writeParms'] = $this->fields['gravura']['writeParms'] = array("_NULL_" => strtoupper (PHCAT_LA71)) + varset(self::getdb_table('art', 'selarray'), array());
/*
        if($rows = $sql->retrieve('PHLIS_Art', '*', '', true)){
	        foreach($rows as $val)
	        {
                $aarray[$val['cod']] = $tp->toHTML($val['descr']);
		    }
            $this->fields['desenho']['writeParms'] = $aarray;
            $this->fields['gravura']['writeParms'] = $aarray;
        }
*/
        $this->fields['tipo_imp']['writeParms'] = varset(self::getdb_table('imp', 'selarray'), array());
/*
        if($rows = $sql->retrieve('phillis_imp', '*', '', true)){
	        foreach($rows as $val)
	        {
                $tarray[$val['cod']] = $tp->toHTML($val['descr']);
		    }
            $this->fields['tipo_imp']['writeParms'] = $tarray;
        }
*/
        $this->fields['local_imp']['writeParms'] = varset(self::getdb_table('local', 'selarray'), array());
/*
        if($rows = $sql->retrieve('LAN_PLUGIN_PHILLIS_ocal', '*', '', true)){
	        foreach($rows as $val)
	        {
                $larray[$val['cod']] = $tp->toHTML($val['descr']);
		    }
            $this->fields['local_imp']['writeParms'] = $larray;
        }
*/
        $this->fields['pais']['writeParms'] = varset(self::getdb_table('pais', 'selarray'), array());
        $this->fields['tipo']['writeParms'] = varset(self::getdb_table('tipo', 'selarray'), array());
        $this->fields['familia']['writeParms'] = varset(self::getdb_table('familias', 'selarray'), array());
//
//		'denth' =>   array ( 'title' => PHCAT_L34, 'type'=>'dropdown', 'data' => 'int', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
//
//		$this->fields['folhas'] = array ( 'title' => PHCAT_LA18." (".LAN_WIDTH." x ".LAN_HEIGHT.")", 'type' => 'method', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => PHCAT_LA31, 'readParms' => '', 'writeParms'=>'tdClassRight=form-inline', 'class' => 'left', 'thclass' => 'left',  );
        
//		$this->fields['datas'] = array ( 'title' => PHCAT_LA19." (".PHCAT_L40." - ".PHCAT_L41.")", 'type' => 'method', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => PHCAT_LA31, 'readParms' => '', 'writeParms'=>'tdClassRight=form-inline', 'class' => 'left', 'thclass' => 'left',  );

  	}
		// ------- Customize Create --------
	
	public function beforeCreate($new_data, $old_data)
	{
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
/*
var_dump($this->getDataFields());
echo "<hr>";
		var_dump($this->dataFields);
echo "<hr>";
        var_dump(array_diff_key($this->dataFields, array("datas" => "datas", "folhas" => "folhas")));
echo "<hr>";
*/
//        $this->dataFields = array_diff_key($this->dataFields, array("datas" => "datas", "folhas" => "folhas"));
//echo "<hr>";
//        $this->_model->setDataFields($this->dataFields);
        $this->_model->setDataFields(array_diff_key($this->dataFields, array("datas" => "datas", "folhas" => "folhas")));
/*
echo "<hr>";
echo "<hr>";
var_dump($this->getDataFields());
echo "<hr>";
		var_dump($this->dataFields);
echo "<hr>";
*/
/*
var_dump($_POST);
echo "<hr>";
var_dump($new_data);
echo "<hr>";
var_dump(json_decode($new_data['folhas'], true));
echo "<hr>";
var_dump(json_decode($new_data['datas'], true));
echo "<hr>";
*/
/*
var_dump($new_data);

$data = array_map(function($value) {
   return $value === "" ? 'NULL' : $value;
}, $new_data); // array_map should walk through $array

var_dump($data);
*/
foreach (json_decode($new_data['folhas'], true) as $tfolhas){
    if ($tfolhas['folha_x'] || $tfolhas['folha_y']){
        $new_folhas[] = array_merge( array ('peca' => $id), $tfolhas, array ('observacoes' => ''));
    }
}
//var_dump($new_folhas);
//echo "<hr>";
//$new_folhas_tarray = json_decode($new_data['folhas'], true);
//$new_datas_tarray = json_decode($new_data['datas'], true);
    		$sql = e107::getDb();
//    		$count = self::getdb_table('pais', 'count');
		if ($sql->select("phillis_folhas", "*", "peca = ".$id))
		{
			$row_folhas[] = $sql->fetch();
//			$text .= $text?", ":"";

//        { X: '100', Y: '963'},
//            var_dump ($this->getController()->getModel()->get('cod'));
//            var_dump ($row_folhas);
//echo "<hr>";

//			$text .= "{ folha_x: '".$row['folha_x']."', folha_y: '".$row['folha_y']."'}";
		}
//            var_dump ($new_folhas === $row_folhas);
//echo "<hr>";
            if (($new_folhas === $row_folhas) == FALSE){
//                var_dump ($id);
                $sql->delete("phillis_folhas", "peca = ".$id);
                foreach ($new_folhas as $nfolhas){
                    $this->res = $sql->insert('phillis_folhas', $nfolhas);
                }
/*
            if($res !== FALSE)
            {
				e107::getMessage()->addSuccess(LAN_UPDATED);
            }
            else 
            {
                if($sql->getLastErrorNumber())
                {
					e107::getMessage()->addError(LAN_CREATED_FAILED.' : '.LAN_SQL_ERROR);
                    e107::getMessage()->addDebug('SQL Link Creation Error #'.$sql->getLastErrorNumber().': '.$sql->getLastErrorText());
                }
				else
				{
					e107::getMessage()->addError(LAN_CREATED_FAILED. ': '.LAN_UNKNOWN_ERROR);//Unknown Error
				}
            }
*/                
            };

        


foreach (json_decode($new_data['datas'], true) as $tdatas){
    if ($tdatas['i_circ'] || $tdatas['f_circ']){
        $new_datas[] = array_merge( array ('peca' => $id), $tdatas, array ('observacoes' => ''));
    }
}

//var_dump($new_datas);
//echo "<hr>";

		if ($sql->select("phillis_datas", "*", "peca = ".$id))
		{
			$row_datas[] = $sql->fetch();
//			$text .= $text?", ":"";

//        { X: '100', Y: '963'},
//            var_dump ($this->getController()->getModel()->get('cod'));
//            var_dump ($row_datas);
//echo "<hr>";

//			$text .= "{ folha_x: '".$row['folha_x']."', folha_y: '".$row['folha_y']."'}";
		}
//            var_dump ($new_datas === $row_datas);
//echo "<hr>";
            if (($new_datas === $row_datas) == false){
//                var_dump ($id);
                $sql->delete("phillis_datas", "peca = ".$id);
                foreach ($new_datas as $ndatas){
                    $this->res = $sql->insert('phillis_datas', $ndatas);
                }
/*
            if($res !== FALSE)
            {
				e107::getMessage()->addSuccess(LAN_UPDATED);
            }
            else 
            {
                if($sql->getLastErrorNumber())
                {
					e107::getMessage()->addError(LAN_CREATED_FAILED.' : '.LAN_SQL_ERROR);
                    e107::getMessage()->addDebug('SQL Link Creation Error #'.$sql->getLastErrorNumber().': '.$sql->getLastErrorText());
                }
				else
				{
					e107::getMessage()->addError(LAN_CREATED_FAILED. ': '.LAN_UNKNOWN_ERROR);//Unknown Error
				}
            }
*/

            };

/*
var_dump($old_data);
echo "<hr>";
var_dump($id);
*/
//        $text = var_dump($new_data);
//			$this->getConfig()->addMessageError(
//        $text.$new_data['alt'].
//        "<hr>".
//        $old_data['alt']
//            );
////		$new_data['alt'] = (($new_data['papel__switch']?:$new_data['papel']) * 1) + (($new_data['dent__switch']?:$new_data['dent']) * 2) + (($new_data['folhas__switch']?:$new_data['folhas']) * 4);
////		return $new_data;
//		$new_data = e107::getCustomFields()->processConfigPost('alt', $new_data);

//		return $new_data;
//		return $data;

	}

	public function afterUpdate($new_data, $old_data, $id)
	{
            if($this->res !== FALSE)
            {
				e107::getMessage()->reset();
				e107::getMessage()->addSuccess(LAN_UPDATED." #".$id);
                return true;
            }
			// do something	
	}
		
	public function onUpdateError($new_data, $old_data, $id)
	{
			// do something		
	}		
			
}

class phillis_item_form_ui extends e_admin_form_ui
{
//    use phillis_trait;
//    protected $frm;

	public function init()
	{
	e107::js('footer',"http://rawgit.com/ruisoftware/jquery-rsLiteGrid/master/src/jquery.rsLiteGrid.js");

		e107::js('footer-inline',"
$(document).ready(function () {
      // export data
      $('#etrigger-submit').click(function () {
//        console.log($('#folhas').rsLiteGrid('getData'));
$('<input>').attr({
    type: 'hidden',
    id: 'folhas',
    name: 'folhas',
    value: JSON.stringify($('#folhas').rsLiteGrid('getData')),
}).appendTo('#plugin-phillis-form');

//        console.log($('#datas').rsLiteGrid('getData'));
$('<input>').attr({
    type: 'hidden',
    id: 'datas',
    name: 'datas',
    value: JSON.stringify($('#datas').rsLiteGrid('getData')),
}).appendTo('#plugin-phillis-form');

//        alert('Open your browser console to see the Json data.');
      })
    });
		");
/*
		$this->fields['folhas'] = array ( 'title' => PHCAT_LA18." (".LAN_WIDTH." x ".LAN_HEIGHT.")", 'type' => 'method', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => PHCAT_LA31, 'readParms' => '', 'writeParms'=>'tdClassRight=form-inline', 'class' => 'left', 'thclass' => 'left',  );
        
		$this->fields['datas'] = array ( 'title' => PHCAT_LA19." (".PHCAT_L40." - ".PHCAT_L41.")", 'type' => 'method', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => PHCAT_LA31, 'readParms' => '', 'writeParms'=>'tdClassRight=form-inline', 'class' => 'left', 'thclass' => 'left',  );
*/        
////         array ('folhas' =>   array ( 'title' => PHCAT_LA18." (".LAN_WIDTH." x ".LAN_HEIGHT.")", 'type' => 'method', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => PHCAT_LA31, 'readParms' => '', 'writeParms'=>'tdClassRight=form-inline', 'class' => 'left', 'thclass' => 'left',  ),
//		'i_circs' =>   array ( 'title' => PHCAT_LA19." (".PHCAT_L40.")", 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => PHCAT_LA31, 'readParms' => '', 'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),
//		'f_circs' =>   array ( 'title' => PHCAT_LA19." (".PHCAT_L41.")", 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => PHCAT_LA31, 'readParms' => '', 'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),
////		'f_circs' =>   array ( 'title' => PHCAT_LA19." (".PHCAT_L41.")", 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => PHCAT_LA31, 'readParms' => '', 'writeParms'=>'trClass=hidden', 'class' => 'hidden', 'thclass' => 'hidden'),
////		'i_circs' =>   array ( 'title' => PHCAT_LA19." (".PHCAT_L40." - ".PHCAT_L41.")", 'type' => 'method', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => PHCAT_LA31, 'readParms' => '', 'writeParms'=>'tdClassRight=form-inline', 'class' => 'left', 'thclass' => 'left',  ),
///		'datas' =>   array ( 'title' => PHCAT_LA19." (".PHCAT_L40." - ".PHCAT_L41.")", 'type' => 'method', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => PHCAT_LA31, 'readParms' => '', 'writeParms'=>'tdClassRight=form-inline', 'class' => 'left', 'thclass' => 'left',  ))


//	e107::js('footer',e_PLUGIN_ABS.'phillis/js/jquery.rsLiteGrid.js', 'jquery');
//		$this->frm = e107::getForm();
/*
		$this->frontPage = $fp;
		
		$ns = e107::getRender();
		$mes = e107::getMessage();
		
		global $fp_settings;
		
		
		if(vartrue($_GET['mode']) == 'create')
		{
			$text = $this->edit_rule(array('order' => 0, 'class' => e_UC_PUBLIC, 'page' => 'news.php', 'force' => FALSE)); // Display edit form as well
		//	$text .= $this->select_class($fp_settings, FALSE);
			$ns->tablerender(FRTLAN_PAGE_TITLE.SEP.FRTLAN_42, $text);
		}
		elseif(vartrue($_GET['id']))
		{
			$key = intval($_GET['id']);
			$text = $this->edit_rule($fp_settings[$key]); // Display edit form as well
		//	$text .= $this->select_class($fp_settings, FALSE);
			$ns->tablerender(FRTLAN_PAGE_TITLE.SEP.FRTLAN_46, $text);
		}
		else
		{ // Just show existing rules
			$ns->tablerender(FRTLAN_PAGE_TITLE.SEP.FRTLAN_13, $mes->render().$this->select_class($fp_settings, TRUE));
		}
*/		
	}
/*
    use phillis_trait;
	// Custom Method/Function 
	function dentv($curVal,$mode)
	{
        $frm = e107::getForm();
        $sql = e107::getDb();
        $tp = e107::getParser(); //TODO - find & replace $tp, $e107->tp

        $dent = varset(self::getdb_table('denteados', 'selarray'), array());
        $this->fields['dentv']['writeParms'] = $dent;
		$this->fields['dentv']['writeParms']['pre'] = "<style>#dentv, #denth {display: inline;}</style>";
//        $this->fields['dentv']['writeParms'] = varset(self::getdb_table('denteados', 'selarray'), array());
		$this->fields['dentv']['writeParms']['post'] = " x ".$frm->renderElement('denth', $ppref['denth'], array('tab'=>0, 'type'=>'dropdown', 'data' => 'int', 'writeParms' => $dent));

var_dump ($this->fields['dentv']['writeParms']);


		$frm = e107::getForm();		
        if ($this->getController()->getListModel()){
            return $frm->rendervalue('papel', $this->getController()->getListModel()->get('cols') & 1, array('type'  => 'boolean'));		
        }
        return $frm->radio_switch('papel', $this->getController()->getModel()->get('cols') & 1, '', '', array('switch'  => 'normal'));		
	}
*/

	function larg($curVal,$mode)
	{
////////////        $frm = e107::getForm();
//			$this->prefs['wsize']['writeParms']['post'] = " x ".$frm->renderElement('hsize', $ppref['hsize'], array('tab'=>0, 'type'=>'number', 'data' => 'int', 'validate' => 'rule_size', 'rule' => 'rule_size', 'error' => 'Validation Error message', 'writeParms' => array('defaultValue' => $ppref['hsize']))).PHCAT_LAI38;
        $altVal = $this->getController()->getModel()->get('alt');		

//        return "<style>#larg, #alt {display: inline;}</style>".
/*
        return $frm->renderElement('larg', $curVal, array('tab'=>0, 'type'=>'number', 'data' => 'int', 'validate' => 'rule_size', 'rule' => 'rule_size', 'error' => 'Validation Error message', 'writeParms' => array('defaultValue' => $curVal))).
        " x ".
        $frm->renderElement('alt', $altVal, array('tab'=>0, 'type'=>'number', 'data' => 'int', 'validate' => 'rule_size', 'rule' => 'rule_size', 'error' => 'Validation Error message', 'writeParms' => array('defaultValue' => $altVal)));
*/
        return $this->renderElement('larg', $curVal, array('tab'=>0, 'type'=>'number', 'data' => 'int', 'validate' => 'rule_size', 'rule' => 'rule_size', 'error' => 'Validation Error message', 'writeParms' => array('defaultValue' => $curVal))).
        " x ".
        $this->renderElement('alt', $altVal, array('tab'=>0, 'type'=>'number', 'data' => 'int', 'validate' => 'rule_size', 'rule' => 'rule_size', 'error' => 'Validation Error message', 'writeParms' => array('defaultValue' => $altVal)));
/*
        return $this->frm->renderElement('larg', $curVal, array('tab'=>0, 'type'=>'number', 'data' => 'int', 'validate' => 'rule_size', 'rule' => 'rule_size', 'error' => 'Validation Error message', 'writeParms' => array('defaultValue' => $curVal))).
        " x ".
        $this->frm->renderElement('alt', $altVal, array('tab'=>0, 'type'=>'number', 'data' => 'int', 'validate' => 'rule_size', 'rule' => 'rule_size', 'error' => 'Validation Error message', 'writeParms' => array('defaultValue' => $altVal)));
*/
//                $frm->radio_switch($id, $this->getController()->getModel()->get('cols') & $val, '', '', array('switch'  => 'normal'));		

	}

	function dentv($curVal,$mode)
	{
///////////////        $frm = e107::getForm();
//			$this->prefs['wsize']['writeParms']['post'] = " x ".$frm->renderElement('hsize', $ppref['hsize'], array('tab'=>0, 'type'=>'number', 'data' => 'int', 'validate' => 'rule_size', 'rule' => 'rule_size', 'error' => 'Validation Error message', 'writeParms' => array('defaultValue' => $ppref['hsize']))).PHCAT_LAI38;
        $denthVal = $this->getController()->getModel()->get('denth');		

//        return "<style>#larg, #alt {display: inline;}</style>".

//		'dentv' =>   array ( 'title' => PHCAT_L34." (".LAN_WIDTH.")", 'type'=>'dropdown', 'data' => 'int', 'help' => '', 'readParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
///        $writeParms = varset(self::getdb_table('denteados', 'selarray'), array());

        $writeParms = array("_NULL_" => strtoupper(PHCAT_LA71), "-0" => LAN_NO." ".strtolower(PHCAT_L34)) + varset(self::getdb_table('denteados', 'selarray'), array());
/*        
        return $frm->renderElement('dentv', $curVal, array('tab'=>0, 'type'=>'dropdown', 'data' => 'int', 'validate' => 'rule_size', 'rule' => 'rule_size', 'error' => 'Validation Error message', 'writeParms' => $writeParms)).
        " x ".
        $frm->renderElement('denth', $denthVal, array('tab'=>0, 'type'=>'dropdown', 'data' => 'int', 'validate' => 'rule_size', 'rule' => 'rule_size', 'error' => 'Validation Error message', 'writeParms' => $writeParms));
*/
/*
        return $this->renderElement('dentv', $curVal, array('tab'=>0, 'type'=>'dropdown', 'data' => 'int', 'validate' => 'rule_size', 'rule' => 'rule_size', 'error' => 'Validation Error message', 'writeParms' => $writeParms)).
        " x ".
        $this->renderElement('denth', $denthVal, array('tab'=>0, 'type'=>'dropdown', 'data' => 'int', 'validate' => 'rule_size', 'rule' => 'rule_size', 'error' => 'Validation Error message', 'writeParms' => $writeParms));
*/
        return $this->renderElement('dentv', $curVal, array('tab'=>0, 'type'=>'dropdown', 'data' => 'str', 'validate' => 'rule_size', 'rule' => 'rule_size', 'error' => 'Validation Error message', 'writeParms' => $writeParms)).
        " x ".
        $this->renderElement('denth', $denthVal, array('tab'=>0, 'type'=>'dropdown', 'data' => 'str',  'validate' => 'rule_size', 'rule' => 'rule_size', 'error' => 'Validation Error message', 'writeParms' => $writeParms));
/*
        return $this->frm->renderElement('dentv', $curVal, array('tab'=>0, 'type'=>'dropdown', 'data' => 'int', 'validate' => 'rule_size', 'rule' => 'rule_size', 'error' => 'Validation Error message', 'writeParms' => $writeParms)).
            " x ".
            $this->frm->renderElement('denth', $denthVal, array('tab'=>0, 'type'=>'dropdown', 'data' => 'int', 'validate' => 'rule_size', 'rule' => 'rule_size', 'error' => 'Validation Error message', 'writeParms' => $writeParms));
*/
//                $frm->radio_switch($id, $this->getController()->getModel()->get('cols') & $val, '', '', array('switch'  => 'normal'));		

	}

/*
	function image($curVal,$mode)
	{
        $frm = e107::getForm();

        var_dump ($this->fields);


		$this->fields['dentv']['writeParms']['pre'] = "<style>#dentv, #denth {display: inline;}</style>";
//        $this->fields['dentv']['writeParms'] = varset(self::getdb_table('denteados', 'selarray'), array());
		$this->fields['dentv']['writeParms']['post'] = " x ".$frm->renderElement('denth', $ppref['denth'], array('tab'=>0, 'type'=>'dropdown', 'data' => 'int', 'writeParms' => $dent));

var_dump ($this->fields['dentv']['writeParms']);


		$frm = e107::getForm();		
        if ($this->getController()->getListModel()){
            return $frm->rendervalue('papel', $this->getController()->getListModel()->get('cols') & 1, array('type'  => 'boolean'));		
        }
        return $frm->radio_switch('papel', $this->getController()->getModel()->get('cols') & 1, '', '', array('switch'  => 'normal'));		


	}
*/
//	function folhas_x($curVal,$mode)
	function folhas($curVal,$mode)
	{
        	$tp = e107::getParser();
/*
        $frm = e107::getForm();
//			$this->prefs['wsize']['writeParms']['post'] = " x ".$frm->renderElement('hsize', $ppref['hsize'], array('tab'=>0, 'type'=>'number', 'data' => 'int', 'validate' => 'rule_size', 'rule' => 'rule_size', 'error' => 'Validation Error message', 'writeParms' => array('defaultValue' => $ppref['hsize']))).PHCAT_LAI38;
        $folhasVal = $this->getController()->getModel()->get('folhas_y');		

//        return "<style>#larg, #alt {display: inline;}</style>".

        return $frm->renderElement('folhas_x', $curVal, array('tab'=>0, 'type'=>'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => PHCAT_LA31, 'readParms' => '', )).
        " x ".
        $frm->renderElement('folhas_y', $folhasVal, array('tab'=>0, 'type'=>'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => PHCAT_LA31, 'readParms' => '', ));
*/
/*
        return $this->frm->renderElement('folhas_x', $curVal, array('tab'=>0, 'type'=>'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => PHCAT_LA31, 'readParms' => '', )).
            " x ".
            $this->frm->renderElement('folhas_y', $folhasVal, array('tab'=>0, 'type'=>'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => PHCAT_LA31, 'readParms' => '', ));
*/
//                $frm->radio_switch($id, $this->getController()->getModel()->get('cols') & $val, '', '', array('switch'  => 'normal'));		
    		$sql = e107::getDb();
//    		$count = self::getdb_table('pais', 'count');
		if ($sql->select("phillis_folhas", "*", "peca = ".$this->getController()->getModel()->get('cod')))
		{
			$row = $sql->fetch();
			$text .= $text?", ":"";

//        { X: '100', Y: '963'},
//            var_dump ($this->getController()->getModel()->get('cod'));
//            var_dump ($row);

			$text .= "{ folha_x: '".$row['folha_x']."', folha_y: '".$row['folha_y']."'}";
		}
//	e107::js('footer',"http://rawgit.com/ruisoftware/jquery-rsLiteGrid/master/src/jquery.rsLiteGrid.js");
/*
		e107::js('footer-inline',"
$(document).ready(function () {
      $('#folhas').rsLiteGrid();
      			});
		");
*/
/*
		e107::js('footer-inline',"
$(document).ready(function () {
      $('table').rsLiteGrid({
        caption: 'Table caption',

        cols: [{
          name: 'name',
          header: 'Name'
        }, {
          name: 'gender',
          header: 'Gender',
          markup: '<select><option value=\"male\">Male</option><option value=\"female\">Female</option></select>',
          defaultValue: 'male'
        }, {
          name: 'age',
          header: 'Age',
          markup: '<input type=\"number\">'
        }, {
          name: 'rule',
          header: 'Rule'
        }, {
          // Delete button needs no name, since this columns does not need to be exported to Json
          markup: '<button title=\"delete this row\">X</button>',
          tabStop: false
        }],

        // event fired after each row is appended to the table.
        // The right place to set the click event for the delete row button
        onAddRow: function (event, $lastNewRow) {
          $('button', $lastNewRow).click(function () {
            $('table').rsLiteGrid('delRow', $lastNewRow);
          });
        }

        // load table with 2 rows of data
      }).rsLiteGrid('setData', [
        { name: 'John', rule: 'Developer', age: 43 },
        { name: 'Maria', gender: 'female' }
      ]);

      // export data
      $('table + button').click(function () {
        console.log($('table').rsLiteGrid('getData'));
        alert('Open your browser console to see the Json data.');
      })
    });

		");
*/

		e107::js('footer-inline',"
$(document).ready(function () {
      $('#folhas').rsLiteGrid({

        cols: [{
          name: 'folha_x',
          markup: '<input type=\"number\" min=\"0\" step=\"1\" class=\"tbox number e-spinner  input-small form-control ui-state-valid\" pattern=\"^[0-9]*\" data-original-title=\"\" title=\"\">'
        }, {
          name: 'folha_y',
          markup: '<input type=\"number\" min=\"0\" step=\"1\" class=\"tbox number e-spinner  input-small form-control ui-state-valid\" pattern=\"^[0-9]*\" data-original-title=\"\" title=\"\">'
        }, {
          // Delete button needs no name, since this columns does not need to be exported to Json
          markup: '<button type=\"button\" class=\"btn btn-danger\" title=\"".PHCAT_LA68."\"><i class=\"fa fa-trash-alt\"><!-- --></i></button>',
          tabStop: false
        }],

        // event fired after each row is appended to the table.
        // The right place to set the click event for the delete row button
        onAddRow: function (event, \$lastNewRow) {
          $(':button', \$lastNewRow).click(function () {
            $('#folhas').rsLiteGrid('delRow', \$lastNewRow);
          });
            $('input', \$lastNewRow).first().after('&nbsp;x&nbsp;');
        }

        // load table with 2 rows of data
      }).rsLiteGrid('setData', [
".$text."
      ]);

      // export data
//      $('#folhas + button').click(function () {
//        console.log($('#folhas').rsLiteGrid('getData'));
//        alert('Open your browser console to see the Json data.');
//      })
    });

		");
//        return $text;
        return "<span id='folhas'></span>";
	}

//	function i_circs($curVal,$mode)
	function datas($curVal,$mode)
	{
        	$tp = e107::getParser();

    		$sql = e107::getDb();
		if ($sql->select("phillis_datas", "*", "peca = ".$this->getController()->getModel()->get('cod')))
		{
			$row = $sql->fetch();
			$text .= $text?", ":"";

			$text .= "{ i_circ: '".$row['i_circ']."', f_circ: '".$row['f_circ']."'}";
		}
		e107::js('footer-inline',"
$(document).ready(function () {
      $('#datas').rsLiteGrid({

        cols: [{
          name: 'i_circ',
          markup: '<input type=\"number\" min=\"0\" step=\"1\" class=\"tbox number e-spinner input form-control ui-state-valid\" pattern=\"^[0-9]*\" data-original-title=\"\" title=\"\">'
        }, {
          name: 'f_circ',
          markup: '<input type=\"number\" min=\"0\" step=\"1\" class=\"tbox number e-spinner input form-control ui-state-valid\" pattern=\"^[0-9]*\" data-original-title=\"\" title=\"\">'
        }, {
          // Delete button needs no name, since this columns does not need to be exported to Json
//          markup: '<span>&nbsp;&nbsp;</span><button type=\"button\" class=\"btn btn-default\" title=\"delete this row\">X</button>',
          markup: '<button type=\"button\" class=\"btn btn-danger\" title=\"".PHCAT_LA68."\"><i class=\"fa fa-trash-alt\"><!-- --></i></button>',
          tabStop: false
        }],

        // event fired after each row is appended to the table.
        // The right place to set the click event for the delete row button
        onAddRow: function (event, \$lastNewRow) {
          $(':button', \$lastNewRow).click(function () {
            $('#datas').rsLiteGrid('delRow', \$lastNewRow);
          });
            $('input', \$lastNewRow).first().after('&nbsp;-&nbsp;');
        }

        // load table with 2 rows of data
      }).rsLiteGrid('setData', [
".$text."
      ]);

      // export data
//      $('#datas + button').click(function () {
//        console.log($('#datas').rsLiteGrid('getData'));
//        alert('Open your browser console to see the Json data.');
//      })
    });

		");

        return "<span id='datas'></span>";
	}
//		'i_circs' =>   array ( 'title' => PHCAT_LA19." (".PHCAT_L40.")", 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => PHCAT_LA31, 'readParms' => '', 'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),
//		'f_circs' =>   array ( 'title' => PHCAT_LA19." (".PHCAT_L41.")", 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => PHCAT_LA31, 'readParms' => '', 'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),


}		

new PHLIS_Admin();

require_once(e_ADMIN."auth.php");

e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");