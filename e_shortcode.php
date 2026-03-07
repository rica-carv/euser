<?php
/*
* Copyright (c) e107 Inc 2015 e107.org, Licensed under GNU GPL (http://www.gnu.org/licenses/gpl.txt)
*
* Log Stats shortcode batch class - shortcodes available site-wide. ie. equivalent to multiple .sc files.
*/

if (!defined('e107_INIT')) { exit; }
include_once(e_PLUGIN . "euser/includes/euser_trait.php");
//e107::lan('eforum');
//e107::lan('eforum','',true);  // English_menu.php or {LANGUAGE}_menu.php
//var_dump ($parm);
// Tenho de injectar os icones aqui, senão não dá....
/*if (file_exists(THEME.'templates/icons_template.php')) // Preferred v2.x location.
{
	require_once(THEME.'templates/icons_template.php');
}
elseif (file_exists(THEME.'euser/icons_template.php'))
{
	require_once(THEME.'euser/icons_template.php');
}
elseif (file_exists(THEME.'icons_template.php'))
{
	require_once(THEME.'icons_template.php');
}
else
{
	require_once(e_PLUGIN.'euser/templates/icons_template.php');
}
*/
/*------
e107::getTemplate('euser', 'icons');
e107::coreLan('admin', true);
e107::css('euser', 'euser.css'); // always load style.css last.
------*/
//include_once(e_PLUGIN . "euser/shortcodes/batch/user_shortcodes.php");

class euser_shortcodes extends e_shortcode
//class euser_shortcodes extends plugin_euser_user_shortcodes
{
	

	use Euser_global_info;
//	use Euser_info;
	public $override = true; // when set to true, existing core/plugin shortcodes matching methods below will be overridden. 
	protected $tp;
	protected $sql;

	function __construct()
	{
		$this->sql = e107::getDb();
		$this->tp = e107::getParser();

		e107::getTemplate('euser', 'icons');
		e107::coreLan('admin', true);
		e107::css('euser', 'euser.css'); // always load style.css last.
	}

// ####################################
// ##### PLUGIN GLOBAL SHORTCODES #####
// ####################################	

//// Tenho de o ter aqui para mostrar em várias páginas...
/*
function sc_euser_online($parm='')
{
//var_dump (e107::isInstalled("pm"));
//var_dump ($this->var['user_id'] > 0);
//    var_dump ($this->var['user_id']);
//    var_dump ($this->var['user_name']);
//  	$on_name = "".$this->var['user_id'].".".$this->var['user_name']."";
  $check = $this->sql->count("online","(*)","online_user_id='".$this->var['user_id'].".".$this->var['user_name']."'");
	return $this->tp->parseTemplate(( $check > 0 )?IMAGE_online:IMAGE_offline);
}
*/
	function sc_euser_embedmenu($parm=''){

//var_dump ($parm);
// Isto é para sair daqui???? O path tem de vir sempre...
/*
if (!$parm["path"]){
		$ordersql=new db;
//		$script="SELECT * FROM ".MPREFIX."euser_cache Where type='order' and cache='currentlyonline.php' ORDER BY type_order";

//    echo "--SCRIPT 1:".$script;
    
$ordersql->db_Select_gen("SELECT * FROM ".MPREFIX."euser_cache Where type='order' and cache='".$parm["menu"]."' ORDER BY type_order");
		
//var_dump ("SELECT * FROM ".MPREFIX."euser_cache Where type='order' and cache='".$parm["menu"]."' ORDER BY type_order");
//    echo "--ONLINE INFO ORDER:".$onlineinfoorder;

$orderrow = $ordersql->db_Fetch();
		 $orderhide=$orderrow['cache_hide'];
//var_dump ($orderrow['cache_userclass']);
	if(!check_class($orderrow['cache_userclass']))	{ return ""; }
}
*/
//			return e107::getMenu()->renderMenu($parm,  false, false, true);									
//			return preg_replace('#<div class="panel-heading">(.*?)</div>#', '', e107::getMenu()->renderMenu($parm["path"],  $parm["menu"], false, true));

//var_dump ($parm);
//var_dump (($parm["path"]?$parm["path"]:"euser"));
/*
$html = new simple_html_dom();   
$html->load(e107::getMenu()->renderMenu($parm["path"],  $parm["menu"], false, true)); 
$items = $html->find('div.panel-body',0)->children(1)->outertext; 
return $items;
*/
// Failsafe para o caso dos menus fora do euser não existirem (o euser reverte para os seus com o mesmo nome, se existirem, claro...)
//var_dump ($parm["path"] && !file_exists(e_PLUGIN.$parm["path"]."/".$parm["menu"]."_menu.php"));

//$parm["path"] = explode("\",$parm["path"])
//var_dump ($parm["path"]);
//var_dump ($parm["name"]);
//Não falta meter aqui a verificação de se está instalado ou não?
if ($parm["path"] && e107::isInstalled($parm["path"]) && !file_exists(e_PLUGIN.$parm["path"]."/".$parm["name"]."_menu.php")) 
{
  unset ($parm["path"]);
//    $parm["path"] = "euser/";
//    $parm["name"] = "euser_".$parm["name"];
}

//var_dump ($parm["path"]);
//var_dump ($parm["name"]);

// POR ENQUANTO TEM DE FICAR ASSIM PARA REMOVER A CAPTION, PORQUE O TABLESTYLE NÃO FUNCIONA AQUI....
return e107::getMenu()->renderMenu(($parm["path"]?:"euser/"), ($parm["path"]?"":"euser_").$parm["name"]."_menu", false, true);
/////$html = e107::getMenu()->renderMenu(($parm["path"]?:"euser/"), ($parm["path"]?"":"euser_").$parm["name"]."_menu", false, true);
//$html = e107::getMenu()->renderMenu($parm["path"], $parm["name"]."_menu", false, true);

//var_dump ($html);

/*
if (!$html) {return;}
$doc = new DOMDocument();
libxml_use_internal_errors(true);
$doc->loadHTML($html);
$finder = new DomXPath($doc);
*/
//$mainhead = ($parm["caption"]?$finder->query("//*[contains(@class, 'panel-heading')]"):"");
//$nodes = $finder->query("//*[contains(@class, 'panel-body')]");

//$dom = new DOMDocument;
//$nodes->childNodes;
//foreach($nodes->childNodes as $node) {
//    $html .= $dom->saveHTML($node, LIBXML_NOEMPTYTAG);
//}
/*
$tmp_dom = new DOMDocument();
foreach ($nodes as $node) 
    {
    $tmp_dom->appendChild($tmp_dom->importNode($node,true));
    }
$innerHTML.=$tmp_dom->saveHTML(); 
var_dump($innerHTML);
*/

//$dom = $nodes->item(0);
/*    $innerHTML = ""; 
    $children = $nodes->item(0);

    foreach ($children as $child) 
    { 
        $innerHTML .= $finder->saveHTML($child);
    }
*/

//$html = 


//var_dump ($html);
//var_dump ($parm["caption"]);

//return $nodes;
// Retiro apena a classe ao div, o filho da mãe continua lá....
//$caption = ($parm["caption"]?str_replace('panel-heading',$parm["caption"],$doc->saveHTML($finder->query("//*[contains(@class, 'panel-heading')]")->item(0))):"");

//return ($parm["caption"]?str_replace('panel-heading',$parm["caption"],$doc->saveHTML($finder->query("//*[contains(@class, 'panel-heading')]")->item(0))):"").str_replace('panel-body','',$doc->saveHTML($finder->query("//*[contains(@class, 'panel-body')]")->item(0)));

////////////////return ($parm["caption"]?str_replace('panel-heading',$parm["caption"],$doc->saveHTML($finder->query("//*[contains(@class, 'panel-heading')]")->item(0))):"").str_replace(array('panel-body', 'caption'),array('',($parm["caption"]?:'hidden')),$doc->saveHTML($finder->query("//*[contains(@class, 'panel-body')]")->item(0)));

//return $caption.str_replace('panel-body','',$doc->saveHTML($finder->query("//*[contains(@class, 'panel-body')]")->item(0)));
//return $text;

		}
	
    /**
     * Recursively merges two objects and returns a resulting object.
     * @param object $obj1 The base object
     * @param object $obj2 The merge object
     * @return object The merged object
     */
/*
	public function mergeObjectsRecursively($obj1, $obj2)
    {
        $merged = $this->_mergeRecursively($obj1, $obj2);
        return $merged;
    }
*/
    /**
     * Recursively merges two objects and returns a resulting object.
     * @param object $obj1 The base object
     * @param object $obj2 The merge object
     * @return object The merged object
     */
/*
    private function _mergeRecursively($obj1, $obj2) {
        if (is_object($obj2)) {
            $keys = array_keys(get_object_vars($obj2));
            foreach ($keys as $key) {
                if (
                    isset($obj1->{$key})
                    && is_object($obj1->{$key})
                    && is_object($obj2->{$key})
                ) {
                    $obj1->{$key} = $this->_mergeRecursively($obj1->{$key}, $obj2->{$key});
                } elseif (isset($obj1->{$key})
                && is_array($obj1->{$key})
                && is_array($obj2->{$key})) {
                    $obj1->{$key} = $this->_mergeRecursively($obj1->{$key}, $obj2->{$key});
                }
				/*
				 else {
                    $obj1->{$key} = $obj2->{$key};
                }
*/
/*
            }
        } elseif (is_array($obj2)) {
            if (
                is_array($obj1)
                && is_array($obj2)
            ) {
                $obj1 = array_merge_recursive($obj1, $obj2);
            } else {
                $obj1 = $obj2;
            }
        }

        return $obj1;
    }
*/
// Provavelmente depois tornar isto num menu, para ser mais fácil....
	function sc_euser_infocard($parm="inline")
	{

//	var_dump ($parm);
	    // Verificar se $parm é nulo, vazio ou um array vazio passado pelo e107 parser
    if (empty($parm) || (is_array($parm) && empty($parm))) {
        $parm = "inline"; // Definir manualmente o valor padrão se nada for fornecido
//    } else if (is_array($parm)) {
		// Se $parm for um array, tentar extrair o valor da chave 'type'
//		$parm = key($parm);
	}

		e107::lan('eforum');
		e107::lan('euser');
//		e107::lan('eforum');
		e107::css('euser', 'euser.css'); // always load style.css last.
	
	// VOu usar e duplicar as chamadas aos shortcodes porque quero ter um painel com informação de todas as zonas do site...
  // paciência...
    // 🔐 SALVAR estado atual dos wrappers
//    $prevWrapper  = $this->wrapper ?? null;
//    $prevWrappers = $this->wrappers ?? [];  
	
//	$tempwrapper = e107::templateWrapper($this->wrapper());

//	var_dump ($tempwrapper);
//	var_dump ($prevWrappers);
  //    $news   = e107::getObject('e_news_category_tree');  // get news class.
  //    $news   = e107::getObject('e_news_category_tree');  // get news class.
  //    $sc     = e107::getScBatch('news'); // get news shortcodes.
    // $tp     = e107::getParser(); // get parser.
  
      // load active news categories. ie. the correct userclass etc.
  //    $data = $news->loadActive(false)->toArray();  // false to utilize the built-in cache.
  
  //    var_dump ( e107::getRegistry('core/news/schook_data')["params"]["category"]);
  //    $TEMPLATE = "{NEWS_CATEGORY_NEWS_COUNT=raw}";
  //    $TEMPLATE = "<li>{NEWS_CATEGORY_NAME: link=1}{NEWS_CATEGORY_NEWS_COUNT=raw}</li>";
  //    var_dump ( e107::getRegistry('core/news/schook_data')["params"]["category"]);
//        echo "<hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>";

//        var_dump (e_PAGE);
//        var_dump (substr( e_PAGE, 0, 5 ) === "forum");
//        var_dump (substr( e_PAGE, 0, 4 ) === "news");
  //    $text = '';
  /*
        echo "<hr>";
        var_dump ($row['category_id']);
        echo " = ";
  //      var_dump (e107::getRegistry('core/news/schook_data'));
  
        var_dump (e107::getRegistry('core/news/schook_data')["params"]["category"]);
        echo " = ";
        var_dump (e107::getRegistry('core/news/schook_data')["data"]["news_category"]);
        echo " = ";
        var_dump (e107::getRegistry('core/news/schook_data')["data"]["category_id"]);
  
        echo " : ";
        var_dump ($row['category_news_count']);
  */
  //      $sc->setScVar('news_item', $row); // send $row values to shortcodes.
    // 👉 Aplicar wrapper DO EUSER
	
//	var_dump ($parm);
	$template = e107::getTemplate('euser', 'euser_info', $parm);
    
//	$this->wrapper(array_merge(($this->wrapper()??[]),'euser_info/'.$parm));
//	$this->wrapper('euser_info/'.$parm);
//	$infocard_Sc = e107::getScBatch('euser_info', 'euser'); // get template shortcodes.

//global $EUSER_INFO_WRAPPER;

//$wrapperSet = $EUSER_INFO_WRAPPER[$parm] ?? [];
/*
		  echo "<pre>";
		  var_dump ($template);
echo "</pre>";
*/
//		echo "<pre>";
//		var_dump ($EUSER_INFO_WRAPPER);
//		var_dump (e107::getRegistry('templates/wrapper/euser_info'));
//		var_dump ($wrapperSet);
//		echo "</pre>";
		$euserWrappers = e107::getRegistry('templates/wrapper/euser_info')[$parm] ?? [];

//		$euserWrappers = $allWrappers['euser_info/'.$parm] ?? [];

//        $sc->wrapper('selospt_user/news');
  //if ($forum && (substr( e_PAGE, 0, 5 ) === "forum")){
  //        $main = (substr( e_PAGE, 0, 10 ) === "forum_view")?"forum":((substr( e_PAGE, 0, 4 ) === "news")?"news":"");
  //        $submain = (substr( e_PAGE, 0, 10 ) === "forum_view")?"forum":null;
///////////		  $submain = strpos(e_PAGE, "forum_view")===False?null:"forum";
  //        $main = (substr( e_PAGE, 0, 10 ) === "forum_view")?"view":((substr( e_PAGE, 0, 4 ) === "news")?"news":"");
/*
		  $main = strpos(e_PAGE, "forum_view")===False?
		  ((strpos( e_PAGE, "news")===false?
			(array_filter($_GET, function($key) {return strpos($key, 'news') == 0;}, ARRAY_FILTER_USE_KEY)===false?"":
			(strpos( e_PAGE, "pm")===false?"user":"user")
		  	)					
			:"user"))
		  :"view";
		  $submain = $main==='view'?"forum":($main==='user'?"euser":null);
*/
//		  $main = "user";
//		  $submain = "euser";
		  		  /*
		  echo "<pre>";
		  var_dump (strpos(e_PAGE, "forum_view")===False);
		  var_dump (strpos( e_PAGE, "news")===false);
		  var_dump (array_filter($_GET, function($key) {return strpos($key, 'news') == 0;}, ARRAY_FILTER_USE_KEY)===false);
		  var_dump ($main);
		  var_dump ($submain);
			echo "</pre>";
*/
//----		  $sc     = e107::getScBatch($main, $submain); // get template shortcodes.
/*
		  		  echo "<pre>";
		  var_dump ($sc);
			echo "</pre>";
*/
//		  var_dump ($parm);
  /*
		$sc1     = e107::getScBatch("news"); // get template shortcodes.
		$sc2     = e107::getScBatch("view", "forum"); // get template shortcodes.
		$sc_merged = (object) array_merge((array) $sc1, (array) $sc2);
		echo "<pre>";
		var_dump ($sc_merged);
echo "</pre>";
*/
  //        var_dump (e_PAGE);
  //        var_dump ($_GET);
  //        var_dump(array_filter($_GET, function($key) {return strpos($key, 'news') == 0;}, ARRAY_FILTER_USE_KEY)===false);
  //        var_dump (strpos(e_PAGE, "forum_view"));
  //        var_dump (strpos(e_PAGE, "forum_view")===false);
  //        var_dump (strpos( e_PAGE, "news"));
  //        var_dump (strpos( e_PAGE, "news")===false);
  //        var_dump ($main);
  //        var_dump ($submain);

//		  $sc->wrapper('user/'.$main.$submain);
//			$sub = $parm;
//var_dump ('euser/'.($submain??$main));
/*
var_dump ($submain);
var_dump ($main);
var_dump ($sub);
var_dump ('euser_info/'.($submain??$main).'/'.$sub);
*/
//			$this->wrapper('euser_info/'.($submain??$main).'/'.$sub);
//			$temp_wrapper = $this->getWrapperID();

//    if ($parm <> "inline"){
//---------------			$this->wrapper('euser_info/'.$parm);
						// TEMPLATEID_WRAPPER support - see contact template
			// must be registered in e_shortcode object (batch) via () method before parsing
			// Do it only once per parsing cylcle and not on every doCode() loop - performance
/*
			if(method_exists($this->addedCodes, 'wrapper'))
			{
				$tmpWrap = e107::templateWrapper($this->addedCodes->wrapper());
				$this->wrapper = $this->addedCodes->getWrapperID();

				if(!empty($tmpWrap)) // FIX for #3 above.
				{
					$this->wrappers = array_merge($this->wrappers,$tmpWrap);
				}
				elseif(!empty($this->wrapper))  // if there's a wrapper id but no wrappers assigned to it, clear the wrappers array.
				{
					$this->wrappers = array();
				}
			}
*/
//    }
//--			$tmpWrap = e107::templateWrapper('euser_info/'.$parm);
//				var_dump ($temp_wrapper);
//--				$this->wrapper = array_merge($this->wrapper,$tmpWrap);
//				$this->wrapper = $extraCodes['_WRAPPER_'];
//			e107::lan('eforum');
//		  $text = $this->tp->parseTemplate($template[($submain?:$main)][$sub], true, $sc_merged); // parse news shortcodes.
//e107::lan('eforum');  // English_menu.php or {LANGUAGE}_menu.php
			$sc_info    = e107::getScBatch('euser_info', 'euser'); // get template shortcodes.
//			$sc_info->wrapper('euser_info/'.$parm);
			$var['EUSER_FORUM_COMBO']=$sc_info->sc_euser_forum_combo();
/*
ESQUECE, NÃO FUNCIONA....
			$sc_user	= e107::getScBatch('user', 'euser', 'user');
*/
// Tenho de injectar os icones aqui, senão não dá....
/*
if (file_exists(THEME.'templates/icons_template.php')) // Preferred v2.x location.
{
	require_once(THEME.'templates/icons_template.php');
}
elseif (file_exists(THEME.'euser/icons_template.php'))
{
	require_once(THEME.'euser/icons_template.php');
}
elseif (file_exists(THEME.'icons_template.php'))
{
	require_once(THEME.'icons_template.php');
}
else
{
	require_once(e_PLUGIN.'euser/templates/icons_template.php');
}
*/
/*
			$var['EUSER_ONLINE']=$sc_user->sc_euser_online();
*/

//    var_dump ($sc_info->var['user_id']);
//    var_dump ($sc_info->var['user_name']);
//    var_dump ($this->userinfo());
/*
	$uinfo = $this->userinfo();
	$check = e107::getDb()->count("online","(*)","online_user_id='".key($uinfo).".".current($uinfo)."'");
$var['EUSER_ONLINE']=$this->tp->parseTemplate(( $check > 0 )?IMAGE_online:IMAGE_offline);
*/
/*
$obj1 = $sc;

$sc_euser = e107::getScBatch('user', 'euser', 'user');

$obj2 = $sc_euser;

$obj3 = $this->mergeObjectsRecursively($obj1, $obj2);
*/
//$sc_euser = e107::getScBatch('user', 'euser', 'user');

//$this->sc_euser_online() = $sc_euser->sc_euser_online();
///			$var['EUS1ER_FORUM_COMBO']="========================";
//			$sc_euser = e107::getScBatch('user', 'euser', 'user');
//			$tmpl = $this->tp->simpleParse($template[($submain?:$main)][$sub], $var, false);
//			var_dump($parm);
//__________		$tmpl = $this->tp->simpleParse($template[$parm], $var, false);
//			var_dump($submain?:$main);
//			var_dump($sub);
//			$text = $this->tp->parseTemplate($template[($submain?:$main)][$sub], true, $obj3);
//			$text = $this->tp->parseTemplate($template[($submain?:$main)][$sub], true, $sc);

//			$text = $this->tp->parseTemplate($template[($submain?:$main)][$sub], true, $sc); // parse news shortcodes.
//__________			return $this->tp->parseTemplate($tmpl, true, $this); // parse news shortcodes.
//			$this->wrapper($temp_wrapper);
//		  	return $text;
		  // teste para ver se os tags funcionam no tema em snippets. Funciona
		  //        $text .= e107::getForm()->checkbox_toggle('e-column-toggle', '1', 'multiselect');
  //        var_dump ($main);
  //        var_dump ($template[($submain?:$main)][$sub]);
		  //        $text = $template['news']; // parse news shortcodes.
	///var_dump ($template);
//	return $text; // parse news shortcodes.
    // 🔴 AQUI está a solução
    // wrappers LOCAIS, só para este parse

/*
    $wrappers = !empty($GLOBALS['EUSER_INFO_WRAPPER'])
        ? $GLOBALS['EUSER_INFO_WRAPPER']
        : null;
*/
/*
// wrappers vivem no global
global $EUSER_INFO_WRAPPER;
    $wrappers = $EUSER_INFO_WRAPPER ?? null;
//var_dump($GLOBALS['EUSER_INFO_WRAPPER']);
//var_dump($parm);
var_dump($wrappers);

    return $this->tp->parseTemplate(
        $template,
        true,
        $sc_info,
        $wrappers
    );
*/
//$template = e107::getTemplate('euser', 'euser_info');
//$text     = $template[$parm];

$text = $euserWrappers?$this->euser_LocalWrappers($template, $euserWrappers):$template;

return $this->tp->parseTemplate($text, true, $this);

//return $this->tp->parseTemplate($template, true, $this, $euserWrappers);

//echo "<pre>";
//var_dump ($template);
//echo "</pre>";
//    $tmpl = e107::getParser()->simpleParse($template, $var, false);
//    $out  = e107::getParser()->parseTemplate($tmpl, true, $this);

    // 🔓 RESTAURAR estado anterior
  //  $this->wrapper  = $prevWrapper;
  //  $this->wrappers = $prevWrappers;
//	$this->wrapper('phillis');

//    return $out;
	}

// *******************************************************
// Mantenho aqui ou passo para o euser_info_shortcodes???
function sc_euser_colourkey($parm=null){
$euser_pref = e107::getPlugPref('euser');
//$colourkey="";

if($euser_pref['onoffcolour']==1){
//if($this->var['onoffcolour']==1){

//$this->sql = new db;

		$script="SELECT cache FROM ".MPREFIX."euser_cache Where type='classcolour'";
		$onlineinfo_classcolour = $this->sql->db_Select_gen($script);
		while ($row = $this->sql->db_Fetch())
		{
			
			$buildclasslist=$row['cache'];

		}


$splitclasslist = explode(',',$buildclasslist);
		
  $classcol=0;


$script="SELECT * FROM ".MPREFIX."userclass_classes ORDER BY userclass_id";		
		$this->sql->db_Select_gen($script);	
		while ($row = $this->sql->db_Fetch())
        {
        	extract($row);
        	
        	$countclasscol = count($splitclasslist);
        	
        	$foundit=-1;
        	
        	for($a = 0; $a <= $countclasscol; $a++){
				
				$getclasssaveddetails = explode("|",$splitclasslist[$a]);
					
				if($userclass_id==$getclasssaveddetails[0]){
					
					$foundit=$a;
				}
			}
        	        	
        	if($foundit<>-1){
			    $getclasssaveddetails = explode("|",$splitclasslist[$foundit]);   
				if($getclasssaveddetails[2]==1){
// ######## TODO ESTE HTML DEVERIA SER TEMPLATIZADO.....
					
					if($layout==1){
   						$classdata.='<div style="text-align:left; color:'.$getclasssaveddetails[1].';">'.$userclass_description.'</div>'; 
					}else{
						$classdata.='<span style="text-align:left; color:'.$getclasssaveddetails[1].';">'.$userclass_description.'</span>, ';
					}
				}	  
        	
			}	
        	$classcol++;
        }
        	$classcol=$classcol-1;

//global $this->tp;
// ####### TENHO DE ARRANJAR FORMA DE ISTO PASSAR PARA UM SHORTCODE, COM OS GLYPHS COMO O SHORTCODE DO CORE {NEWSCOMMENTCOUNT} (https://github.com/e107inc/e107/blob/eecbfbd61dc61e2633aa26b2948cb21dcc41ae4a/e107_core/shortcodes/batch/news_shortcodes.php#L444)

//	$colourkey='<div style="text-align:left;" class="mediumtext"><span class="fa-stack">'.$this->tp->toGlyph('user').$this->tp->toGlyph('info-sign').'</span><b>'.ONLINENOW_7.'</b>:</div>';
	$colourkey='<div style="text-align:left;" class="mediumtext">'.IMAGE_colourkey.'<b>'.LAN_EUSER_001007.'</b>:</div>';
//	$colourkey='<div style="text-align:left;" class="mediumtext">'.e107::getParser()->toGlyph('user').e107::getParser()->toGlyph('info-sign').'<b>'.ONLINENOW_7.'</b>:</div>';
	

	if($euser_pref['headadminactive']==1){
//	if($this->var['headadminactive']==1){
//		$colourkey.='<div style="text-align:left; font-weight:bold; color:'.$this->euser_pref['headadmincolour'].';">'.ONLINENOW_1.'</div>';
		$colourkey.='<span style="text-align:left; font-weight:bold; color:'.$this->euser_pref['headadmincolour'].';"><nobr>'.LAN_EUSER_001001.'</nobr></span>';
	}  
	 
	if($euser_pref['adminactive']==1){  
//	if($this->var['adminactive']==1){  
//		$colourkey.='<div style="text-align:left; font-weight:bold; color:'.$this->euser_pref['admincolour'].';">'.ONLINENOW_8.'</div>';
		$colourkey.=', <span style="text-align:left; font-weight:bold; color:'.$this->euser_pref['admincolour'].';"><nobr>'.LAN_EUSER_001008.'</nobr></span>';
	}
	
	if($euser_pref['modactive']==1){
//	if($this->var['modactive']==1){
//		$colourkey.='<div style="text-align:left; font-weight:bold; color:'.$this->euser_pref['modcolour'].';">'.ONLINENOW_10.'</div>';
		$colourkey.=', <span style="text-align:left; font-weight:bold; color:'.$this->euser_pref['modcolour'].';"><nobr>'.LAN_EUSER_001010.'</nobr></span>';
	}
	
	$colourkey.=$classdata;
	
	if($euser_pref['memactive']==1){
//	if($this->var['memactive']==1){
//		$colourkey.='<div style="text-align:left; color:'.$this->euser_pref['memcolour'].';">'.ONLINENOW_9.'</div>';	
		$colourkey.=', <span style="text-align:left; color:'.$this->euser_pref['memcolour'].';"><nobr>'.LAN_EUSER_001009.'</nobr></span>';	
	}


//if($parm['layout']<>1){
 if($layout<>1){
	
	if(substr($colourkey,strlen($colourkey)-2,1)==','){
		
	$colourkey=	substr($colourkey,0,strlen($colourkey)-2);
		
	}
	
	}
/* ANTIGO!!!
if($layout==1){
	$colourkey='<div style="text-align:left;" class="mediumtext"><img src="'.e_PLUGIN.'euser/images/keys.png" height="18px" /><b>'.ONLINENOW_7.'</b>:</div>';
	
	if($this->euser_pref['headadminactive']==1){
//		$colourkey.='<div style="text-align:left; font-weight:bold; color:'.$this->euser_pref['headadmincolour'].';">'.ONLINENOW_1.'</div>';
		$colourkey.='<span style="text-align:left; font-weight:bold; color:'.$this->euser_pref['headadmincolour'].';">'.ONLINENOW_1.'</span>, ';
	}  
	 
	if($this->euser_pref['adminactive']==1){  
//		$colourkey.='<div style="text-align:left; font-weight:bold; color:'.$this->euser_pref['admincolour'].';">'.ONLINENOW_8.'</div>';
		$colourkey.='<span style="text-align:left; font-weight:bold; color:'.$this->euser_pref['admincolour'].';">'.ONLINENOW_8.'</span>, ';
	}
	
	if($this->euser_pref['modactive']==1){
//		$colourkey.='<div style="text-align:left; font-weight:bold; color:'.$this->euser_pref['modcolour'].';">'.ONLINENOW_10.'</div>';
		$colourkey.='<span style="text-align:left; font-weight:bold; color:'.$this->euser_pref['modcolour'].';">'.ONLINENOW_10.'</span>, ';
	}
	
	$colourkey.=$classdata;
	
	if($this->euser_pref['memactive']==1){
//		$colourkey.='<div style="text-align:left; color:'.$this->euser_pref['memcolour'].';">'.ONLINENOW_9.'</div>';	
		$colourkey.='<span style="text-align:left; color:'.$this->euser_pref['memcolour'].';">'.ONLINENOW_9.'</span>';	
	}

}else{
		
	$colourkey='<div style="text-align:left;" class="mediumtext"><img src="'.e_PLUGIN.'euser/images/keys.png" height="18px" /><b>'.ONLINENOW_7.'</b>:</div>';
	
	if($this->euser_pref['headadminactive']==1){
//		$colourkey.='<div style="text-align:left;"><span style="text-align:left; font-weight:bold; color:'.$this->euser_pref['headadmincolour'].';">'.ONLINENOW_1.'</span>, ';  
		$colourkey.='<span style="text-align:left;"><span style="text-align:left; font-weight:bold; color:'.$this->euser_pref['headadmincolour'].';">'.ONLINENOW_1.'</span>, ';  
	} 
	
	if($this->euser_pref['adminactive']==1){  
		$colourkey.='<span style="text-align:left; font-weight:bold; color:'.$this->euser_pref['admincolour'].';">'.ONLINENOW_8.'</span>, ';
	}
	
	if($this->euser_pref['modactive']==1){
		$colourkey.='<span style="text-align:left; font-weight:bold; color:'.$this->euser_pref['modcolour'].';">'.ONLINENOW_10.'</span>, ';
	}
	
	$colourkey.=$classdata;
	
	if($this->euser_pref['memactive']==1){
		$colourkey.='<span style="text-align:left; color:'.$this->euser_pref['memcolour'].';">'.ONLINENOW_9.'</span></div>';
	}
	
	if(substr($colourkey,strlen($colourkey)-2,1)==','){
		
	$colourkey=	substr($colourkey,0,strlen($colourkey)-2);
		
	}
	
	}
*/
}	
	
	
return $colourkey;	
	
}
	// Mantenho aqui ou passo para o euser_info_shortcodes???
		function sc_euser_avatar($opts=null)
	{
		$uinfo=$this->userinfo();
//		var_dump($uinfo);
//		var_dump(key($uinfo)==null);
		if (!$uinfo || key($uinfo)==null) {return false;}
		//Depois tenho de por aqui uma pref para ter ou não isto....
// Define a variável global ajaxUrl e inclui o JS
		e107::js('footer-inline', "var ajaxUrl = '".e_PLUGIN."euser/handlers/online_status.php';");
		e107::js('footer', e_PLUGIN.'euser/js/avatarStatus.js', 'jquery', 5);
//		return e107::getParser()->toAvatar(e107::user($this->var['forum_lastpost_user']),$opts);
//var_dump ($this->userinfo());
//var_dump (array('user_id'=>array_key_first($this->userinfo())));
/*
var_dump ($opts);
echo "<pre>";
var_dump (e107::user(key($this->userinfo())));
echo "</pre>";
*/
//		return e107::getParser()->toAvatar(array('user_id'=>key($this->userinfo())),$opts);
//		var_dump($this->userinfo());
		$opts['id'] = "Euser".key($uinfo);
//		var_dump($opts);
//		echo "<hr>";

		return e107::getParser()->toAvatar(e107::user(key($uinfo)),$opts);
	}
	// Mantenho aqui ou passo para o euser_info_shortcodes???	
// preciso de ter o meu para ter o texto nos popups, a classe posso eventualmente usar a do avatar... Mas por enquanto fica....
	function sc_euser_online($parms='')
	{
//var_dump (e107::isInstalled("pm"));
//var_dump ($this->var['user_id'] > 0);
//    var_dump ($this->var['user_id']);
//    var_dump ($this->var['user_name']);
//  	$on_name = "".$this->var['user_id'].".".$this->var['user_name']."";
/*
		if (!$this->var['user_id'] || !$this->var['user_name']) {
			$uinfo = $this->userinfo();
//			var_dump ($uinfo);
			$this->var['user_id']=key($uinfo);
			$this->var['user_name']=current($uinfo);
		}

	$check = $this->sql->count("online","(*)","online_user_id='".$this->var['user_id'].".".$this->var['user_name']."'");
*/
//		var_dump($this->userinfo());
//			var_dump ($uinfo);
//		$this->var['user_id']=key($uinfo);
//		$this->var['user_name']=current($uinfo);
//	}
//var_dump($GLOBALS['euser_vars']['user_id']);
		if (!($uinfo=$this->userinfo())) {return false;}

//////////////////$check = $this->sql->count("online","(*)","online_user_id='".key($uinfo).".".current($uinfo)."'");
//$online = e107::getOnline();
//$onlineList = $online->userList();
//$check = isset($onlineList[key($uinfo)]);
//var_dump (key($uinfo));
$check = false;
foreach (e107::getOnline()->userList() as $userData) {
    if ($userData['user_id'] == key($uinfo)) {
        $check = true;
        break;  // já encontrou, sai do loop
    }
}//var_dump ($check);
/*
echo "<pre>";
var_dump ($onlineList);
echo "</pre>";
*/
/*
echo "<hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>";
	  var_dump ($parms['class']);
	  var_dump ($parms['text']);

echo "<hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>";
var_dump ($parms['text']);
*/
//var_dump ($uinfo);
//var_dump ($check);
//var_dump (current($uinfo));
	if ($parms['class']){
		$text = $check?'euseron':'euseroff';
	} elseif ($parms['text']==2){
		$text = $check?LAN_ON:LAN_OFF;
	} elseif ($parms['text']){
		$text = $check?'('.LAN_ON.')':'('.LAN_OFF.')';
	} else {
		$text = $check?IMAGE_online:IMAGE_offline;
	}
	return $text;
  }
	// Mantenho aqui ou passo para o euser_info_shortcodes???
	function sc_euser_level($parm='')
	{
//var_dump (e107::isInstalled("pm"));
//var_dump ($this->var['user_id'] > 0);
//    var_dump ($this->var['user_id']);
//    var_dump ($this->var['user_name']);
//  	$on_name = "".$this->var['user_id'].".".$this->var['user_name']."";
/*
		if (!$this->var['user_id'] || !$this->var['user_name']) {
			$uinfo = $this->userinfo();
//			var_dump ($uinfo);
			$this->var['user_id']=key($uinfo);
			$this->var['user_name']=current($uinfo);
		}

	$check = $this->sql->count("online","(*)","online_user_id='".$this->var['user_id'].".".$this->var['user_name']."'");
*/
		if (!$this->userinfo()) {return false;}
		$uid = array_key_first($this->userinfo());
//			var_dump ($uinfo);
/*
			if ($parms['class']){
		$text = ( $check > 0 )?'euseron':'euseroff';
	} elseif ($parms['text']==2){
		$text = ( $check > 0 )?LAN_ON:LAN_OFF;
	} elseif ($parms['text']){
		$text = ( $check > 0 )?'('.LAN_ON.')':'('.LAN_OFF.')';
	} else {
		$text = ( $check > 0 )?IMAGE_online:IMAGE_offline;
	}
	return $text;
*/
// A partir daqui é praticamente uma cópia do sc_level do view_shortcodes do forum
		if(empty($uid))
		{
			return '';
		}

		$rankInfo = e107::getRank()->getRanks($uid);
		// FIXME - level handler!!!

		//	print_a($rankInfo);

		if($parm == 'badge')
		{
			if(!empty($rankInfo['name']))
			{
				return "<span class='label label-info'>" . $rankInfo['name'] . "</span>";
			}
		}

		if(!$parm)
		{
			$parm = 'name';
		}

		switch($parm)
		{
			case 'userid' :
				return $uid;
				break;

			case 'glyph':
				$text = "";
				$tp = e107::getParser();
				for($i = 0; $i < $rankInfo['value']; $i++)
				{
					$text .= $tp->toGlyph('fa-star');
				}

				return $text;
				break;

			default:
				return varset($rankInfo[$parm], '');
				break;
		}
//return array_key_first($uinfo);
  }
	// Mantenho aqui ou passo para o euser_info_shortcodes???
	function sc_euser_data($parms=null){
	
		if (!$this->userinfo()) {return false;}

		if ($parms['link']) {
//		$url = e107::getUrl();
			return e107::getUrl()->create('user/profile/view', array('id' => array_key_first($this->userinfo()), 'name' => current($this->userinfo())));
		}
		return current($this->userinfo());
	}

	//Possivelmente depois sai daqui para o shortcode interno do euser........
	function sc_euser_news($parms=null) // default count
	{
	/*
	  echo "<pre>";
	  var_dump (e_PAGE);
	//  var_dump (strpos(e_PAGE, "forum"));
	  var_dump (strpos(e_PAGE, "forum") !== false);
	  echo "</pre>";
	*/
	/*
	echo "<pre>";
	var_dump ($this->userinfo());
	echo "</pre>";
	*/
	/*
	  if (strpos(e_PAGE, "forum") !== false) {
		$sc = e107::getScBatch('view', 'forum');
		$uid = $sc->var['post_user'];
	  } else {
		$sc = e107::getScBatch('news');
		$uid = $sc->news_item['news_author'];
	  }
	  */
//	  $uinfo=$this->userinfo();
		if (!$this->userinfo()) {return false;}

		if ($parms['url']){

//	  public function sc_news_author_items_url($parm=null)
/*
		  if(empty($uinfo))
		  {
			  return null;
		  }
 */ 
		  return e107::getUrl()->create('news/list/author',array('author'=>current(array: $this->userinfo()))); // e_BASE."news.php?author=".$val
	}
	else
	{
//		$uinfo=$this->userinfo();
	  /*
	  echo "<pre>";
	  var_dump ($uid);
	//  var_dump (strpos(e_PAGE, "forum"));
	  echo "</pre>";
	  echo "<hr><hr><hr>";
	 */
		/*
	  echo "<pre>";
	  var_dump ($sc->news_item);
	  echo "</pre>";
	*/
	//  $sql = e107::getDb();
	/*
	if(empty($uid = $sc->news_item['news_author'])){
	  $sc = e107::getScBatch('view', 'forum');
	  echo "<pre>";
	  var_dump ($uid = $sc->var['post_user']);
	  echo "</pre>";
	  }
	*/
	/*
	  if(!empty($nuid = $sc->news_item['user_id']))
	  {
		$query = "SELECT n.news_author, COUNT(n.news_id) AS totalnews FROM #news AS n
		WHERE n.news_author = ".$nuid;
	
		if ($sql->gen($query))
		{
		  while ($row = $sql->fetch()) 
		  {
			return $row['totalnews'];
		  }		
		}
	  }
	*/
	/*
	echo "<pre>";
	var_dump ($sc);
	echo "</pre>";
	*/
//	  if(!empty($uinfo))
//	  {
		$row = $this->sql->retrieve("SELECT n.news_author, COUNT(n.news_id) AS totalnews FROM #news AS n
		WHERE n.news_author = ".key($this->userinfo()));
	/*
	echo "<pre>";
	var_dump (empty($row['totalnews']));
	echo "</pre>";
	*/
		return empty($row['totalnews'])?null:$row['totalnews'];
//	  }

	}

	}

	//Possivelmente depois sai daqui para o shortcode interno do euser........
	function sc_euser_posts($parms=null) // default count
	{
//		$uinfo=$this->userinfo();
		if (!$this->userinfo()) {return false;}
		
		if ($parms['url']){

			//	  public function sc_news_author_items_url($parm=null)
/*					  if(empty($uinfo))
					  {
						  return null;
					  }
*/			  
// Quando puder tenho de meter isto com o geturl
 //					  return e107::getUrl()->create('news/list/author',array('author'=>$unm)); // e_BASE."news.php?author=".$val
						return e_HTTP.'userposts.php?0.forums.'.key($this->userinfo());
				}
		else
		{
//			var_dump (e107::getRegistry('_all_')); // Não vou usar o registry, nem sei como funciona....
//			if(!empty($uinfo))
//			{
			  $row = $this->sql->retrieve("SELECT p.post_user, COUNT(p.post_id) AS totalposts FROM #forum_post AS p WHERE p.post_user = ".key($this->userinfo()));
		  /*
		  echo "<pre>";
		  var_dump (empty($row['totalnews']));
		  echo "</pre>";
		  */
			  return empty($row['totalposts'])?null:$row['totalposts'];
//			}
		}

	}

	//CUSTOM EUSER PLUGIN SHORTCODES (USER IN EUSER INFO PANEL), USES SENDPM (EITHER CUSOTMIZED FROM EPM OR FROM STANDARD CORE SHORTCODE....)
	// ISTO É PRATICAMENTE IGUAL AO sc_user_sendpm NO USER_SHORTCODES DAQUI...
/*----
	function sc_euser_pmuser()
{
//  $sc = e107::getScBatch('view', 'forum');
	$uinfo=$this->userinfo();

  	if(e107::isInstalled('pm') && $uinfo)
  {
//    if($pmButton = $this->tp->parseTemplate("{SENDPM: user=" . $this->postInfo['post_user'] . "&glyph=envelope&class=pm-send}", true))
//    if($pmButton = $this->tp->parseTemplate("{SENDPM: user=" . $sc->postInfo['post_user'] . "&glyph=envelope&class=btn pm-send}", true))
//    {
//      $text .= "<li class='divider'><hr class='dropdown-divider'></li>";
//      $text .= "<li class='dropdown-item'>" . $pmButton . "</li>";
// E chamar directamente a função? não ?
return $this->tp->parseTemplate("{SENDPM: user=" . key($uinfo) . "}");
////////////return $this->sc_sendpm(array('user'=>key($uinfo)));
//    }

    // $text .= "<li><a href='".e_PLUGIN_ABS."pm/pm.php?send.{$this->postInfo['post_user']}'>".$tp->toGlyph('envelope')." ".LAN_FORUM_2036." </a></li>";
  }
}
-----*/

/***********************
 * 
 * REWRITE USER_SENDPM CORE SHORTCODE
 * 
 */
// Para sair se aprovarem o pull https://github.com/e107inc/e107/pull/5435, mas já refiz com outras opções... É muito diferente do pull request original
function sc_user_sendpm($parm=null)// Tornei este sc global e código refeito
{
//	var_dump($this->userinfo());
	$uinfo = $this->userinfo();
	if (!$uinfo) {return false;}
//	$pref = e107::getPref();
	if (!e107::isInstalled("pm")) return null;
	
/////	$tp = e107::getParser();
	if($this->var['user_id'] > 0)
	{
		$parms_str = 'user='.$this->var['user_id'];
	}
	elseif (key($uinfo) <> USERID){
		$parms_str = 'user='.key($uinfo);
	}

	if ($parms_str){
		if ($parm) {
			$parms_str .='&'.implode('&', array_map(
            function($k, $v) { 
                return $k . '=' . $v;
            }, 
            array_keys($parm), 
            array_values($parm)
            )
        );
		}
//		var_dump ($set);
		return $this->tp->parseTemplate("{SENDPM:".$parms_str.'}');
//	}
//	elseif (key($this->userinfo()) <> USERID){
//			return $this->tp->parseTemplate("{SENDPM: user=" . key($this->userinfo()) . "}");
	}
}

/*

Enhanced USEREXTENDED_ALL shortcode

Adds support for separated tab rendering for Bootstrap-based themes.

New parameters:
- tabs          : default e107 tab rendering
- tabs_caption  : outputs only the tab navigation items
- tabs_text     : outputs only the tab content panes

This allows themes to fully control the tab markup.

Example usage in theme:

<ul class="nav nav-tabs">
{USEREXTENDED_ALL=tabs_caption}
</ul>

<div class="tab-content">
{USEREXTENDED_ALL=tabs_text}
</div>

Additional fix:
Reloads user_extended values directly from the database to ensure
updated values are displayed immediately after form submission,
avoiding session caching issues with e107::user().
*/
function sc_userextended_all($parm = '')
{
    $userMethods = e107::getUserSession();

    $sql = e107::getDb();
    $curUE = $sql->retrieve('user_extended', '*', 'user_extended_id='.(int) USERID);

    $curVal = e107::user(USERID);
    $curVal = array_merge($curVal, $curUE);
    $curVal['userclass_list'] = $userMethods->addCommonClasses($curVal, false);

    require_once(e_CORE."shortcodes/batch/usersettings_shortcodes.php");

    $us_sc = new usersettings_shortcodes();
    $us_sc->setVars($curVal);
    $us_sc->reset();

    $catList = empty($us_sc->catInfo) ? $us_sc->loadUECatData() : $us_sc->catInfo;

    if(empty($us_sc->fieldInfo))
    {
        $us_sc->loadUEFieldData();
    }

    $tabs = [];
    $ret  = '';

    foreach($catList as $cat)
    {
        $us_sc->catInfo[$cat['user_extended_struct_id']] = $cat;

        $content = $us_sc->sc_userextended_cat($cat['user_extended_struct_id']);
        $ret .= $content;

        if(empty($content))
        {
            continue;
        }

        $caption = vartrue($cat['user_extended_struct_text'], $cat['user_extended_struct_name']);

        if($parm === 'tabs_caption')
        {
            $tabs[] = ['caption' => $caption];
        }
        elseif($parm === 'tabs_text')
        {
            $tabs[] = ['text' => $content];
        }
        else
        {
            $tabs[] = ['caption' => $caption, 'text' => $content];
        }
    }

    if(in_array($parm, ['tabs','tabs_caption','tabs_text']) && !empty($tabs) && deftrue('BOOTSTRAP'))
    {
        if($parm === 'tabs')
        {
            return e107::getForm()->tabs($tabs);
        }

        $out = '';

        foreach($tabs as $key => $tab)
        {
            $id = is_numeric($key) ? 'tab-'.$key : $key;

            if($parm === 'tabs_caption')
            {
                $out .= '<li class="nav-item"><a class="nav-link" href="#'.$id.'" data-bs-toggle="tab" role="tab">'.$tab['caption'].'</a></li>';
            }
            else
            {
                $out .= '<div class="tab-pane fade show" id="'.$id.'" role="tabpanel">'.$tab['text'].'</div>';
            }
        }

        return $out;
    }

    return $ret;
}

}