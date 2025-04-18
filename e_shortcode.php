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
e107::getTemplate('euser', 'icons');

class euser_shortcodes extends e_shortcode
{
	use Euser_global_info;
	protected $tp;

	protected $sql;

	function __construct()
	{
		$this->sql = e107::getDb();
		$this->tp = e107::getParser();
	}

	/*----------------------------- 
  PM SHORTCODE 
-----------------------------*/  
// Tenho de ver se substituo isto pelo do euser ou não....
function sc_signin_pm_nav($parm=null)
{
  if(!e107::isInstalled('pm') )
  {
    return null;
  }

//  $sc = e107::getScBatch('pm', true);

/*
  return $sc->sc_pm_nav($parm);;
}

function sc_pm_nav($parm='')
	{
    echo "<HR>ESTOU AQUI<HR><HR>";
*/

//    $tp = e107::getParser();

    require_once(e_PLUGIN."pm/pm_func.php");

    $pmprefs = e107::getPlugPref('pm');

		if(!isset($pmprefs['pm_class']) || !check_class($pmprefs['pm_class']))
		{
			return null;
		}

		$pm = new pmbox_manager();
		$mbox = $pm->pm_getInfo('inbox');

		if(!empty($mbox['inbox']['new']))
		{
			$count = "<span class='badge bg-danger'>".$mbox['inbox']['new']."</span>";
//			$icon = $this->tp->toGlyph('fa-envelope');
		}
		else
		{
//			$icon = $this->tp->toGlyph('fa-envelope');
			$count = '';
		}

    $icon = $this->tp->toGlyph('fa-envelope');
		$urlInbox = e107::url('pm','index','', array('query'=>array('mode'=>'inbox')));
		$urlOutbox = e107::url('pm','index','', array('query'=>array('mode'=>'outbox')));
		$urlCompose = e107::url('pm','index','', array('query'=>array('mode'=>'send')));

		return '<a class="pm-nav nav-link dropdown-toggle icon-link" data-toggle="dropdown" data-bs-toggle="dropdown" data-bs-toggle="dropdown" href="#">'.$icon.$count.'</a>
		<ul class="dropdown-menu dropdown-menu-end">
		<li>
			<a class="dropdown-item icon-link" href="'.$urlInbox.'"><i class="fa-solid fa-inbox"></i> '.LAN_PLUGIN_PM_INBOX.'</a>
			<a class="dropdown-item icon-link" href="'.$urlOutbox.'"><i class="fa-solid fa-envelopes-bulk"></i> '.LAN_PLUGIN_PM_OUTBOX.'</a>
			<a class="dropdown-item icon-link" href="'.$urlCompose.'"><i class="fa-solid fa-pen"></i> '.LAN_PLUGIN_PM_NEW.'</a> 
		</li>
		</ul>';
	}

	function sc_sendpm($parm=null)
	{
	
	  // global $sysprefs, $pm_prefs;
	  // $pm_prefs = $sysprefs->getArray("pm_prefs");
	
	  if(is_string($parm))
	  {
		$parm = array('user'=>$parm);
	  }
	  
	  $pm_prefs = e107::getPlugPref('pm');
	
	  $url = e107::url('pm','index').'?send.'.varset($parm['user']);
	
	  require_once(e_PLUGIN."pm/pm_class.php");
	
	  $pm = new private_message;
	
//	  $glyph  = empty($parm['glyph']) ? 'fa-paper-plane' : $parm['glyph'];
	  $glyph  = empty($parm['glyph']) ? 'fa-message' : $parm['glyph'];
	  $class  = empty($parm['class']) ? 'sendpm btn btn-sm btn-light' : $parm['class'];
	
	
	  if(isset($pm_prefs['pm_class']) && check_class($pm_prefs['pm_class']) && $pm->canSendTo($parm['user'])) // check $this->pmPrefs['send_to_class'].
	  {
		  if(deftrue('FONTAWESOME') && deftrue('BOOTSTRAP'))
		  {
			  $img =  e107::getParser()->toGlyph($glyph,'');
	/// TENHO DE TER O SC AQUI SÓ POR CAUSA DESTA LINHA VVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV
			  return  "<a class='".$class."' href='".$url ."' title='".LAN_PM_1."'>{$img} ".LAN_PM_1."</a>";
		  }
	
	/*  
		  if(file_exists(THEME.'forum/pm.png'))
		  {
				 $img = "<img src='".THEME_ABS."forum/pm.png' alt='".LAN_PM."' title='".LAN_PM."' style='border:0' />";
		   }
		   else
		   {
				$img = "<img src='".e_PLUGIN_ABS."pm/images/pm.png' alt='".LAN_PM."' title='".LAN_PM."' style='border:0' />";
		   }
	*/  
	
	
		return  "<a class='sendpm' href='".$url ."'>{$img}</a>";
	  }
	  else
	  {
		return null;
	  }
	
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
	function sc_euser_infocard($parms=null)
	{
		e107::lan('eforum');
		e107::lan('euser');
//		e107::lan('eforum');
		e107::css('euser', 'euser.css'); // always load style.css last.
	
	// VOu usar e duplicar as chamadas aos shortcodes porque quero ter um painel com informação de todas as zonas do site...
  // paciência...
  
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
		  $template = e107::getTemplate('euser', 'euser_info');
/*
		  echo "<pre>";
		  var_dump ($template);
echo "</pre>";
*/
//        $sc->wrapper('selospt_user/news');
  //if ($forum && (substr( e_PAGE, 0, 5 ) === "forum")){
  //        $main = (substr( e_PAGE, 0, 10 ) === "forum_view")?"forum":((substr( e_PAGE, 0, 4 ) === "news")?"news":"");
  //        $submain = (substr( e_PAGE, 0, 10 ) === "forum_view")?"forum":null;
		  $submain = strpos(e_PAGE, "forum_view")===False?null:"forum";
  //        $main = (substr( e_PAGE, 0, 10 ) === "forum_view")?"view":((substr( e_PAGE, 0, 4 ) === "news")?"news":"");
		  $main = strpos(e_PAGE, "forum_view")===False?
		  ((strpos( e_PAGE, "news")===false?
			(array_filter($_GET, function($key) {return strpos($key, 'news') == 0;}, ARRAY_FILTER_USE_KEY)===false?"":"news")
			:"news"))
		  :"view";
/*
		  echo "<pre>";
		  var_dump ($main);
		  var_dump ($submain);
			echo "</pre>";
*/
		  $sc     = e107::getScBatch($main, $submain); // get template shortcodes.
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
			$sub = ($parms['inline']?"inline":"panel");
//var_dump ('euser/'.($submain??$main));
			$sc->wrapper('euser_info/'.($submain??$main).'/'.$sub);
//			e107::lan('eforum');
//		  $text = $this->tp->parseTemplate($template[($submain?:$main)][$sub], true, $sc_merged); // parse news shortcodes.
//e107::lan('eforum');  // English_menu.php or {LANGUAGE}_menu.php
			$sc_info    = e107::getScBatch('euser_info', 'euser'); // get template shortcodes.
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
			$tmpl = $this->tp->simpleParse($template[($submain?:$main)][$sub], $var, false);
//			$text = $this->tp->parseTemplate($template[($submain?:$main)][$sub], true, $obj3);
//			$text = $this->tp->parseTemplate($template[($submain?:$main)][$sub], true, $sc);

//			$text = $this->tp->parseTemplate($template[($submain?:$main)][$sub], true, $sc); // parse news shortcodes.
			$text = $this->tp->parseTemplate($tmpl, true, $sc); // parse news shortcodes.
  
  
		  // teste para ver se os tags funcionam no tema em snippets. Funciona
		  //        $text .= e107::getForm()->checkbox_toggle('e-column-toggle', '1', 'multiselect');
  //        var_dump ($main);
  //        var_dump ($template[($submain?:$main)][$sub]);
		  //        $text = $template['news']; // parse news shortcodes.
	///var_dump ($template);
	return $text; // parse news shortcodes.
	}

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
		$uinfo = $this->userinfo();
//			var_dump ($uinfo);
//		$this->var['user_id']=key($uinfo);
//		$this->var['user_name']=current($uinfo);
//	}

$check = $this->sql->count("online","(*)","online_user_id='".key($uinfo).".".current($uinfo)."'");
/*
echo "<hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>";
	  var_dump ($parms['class']);
	  var_dump ($parms['text']);

echo "<hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>";
var_dump ($parms['text']);
*/
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
  }


	function sc_euser_data(){
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
	  $uinfo=$this->userinfo();

		if ($parms['url']){

//	  public function sc_news_author_items_url($parm=null)
		  if(empty($uinfo))
		  {
			  return null;
		  }
  
		  return e107::getUrl()->create('news/list/author',array('author'=>current($uinfo))); // e_BASE."news.php?author=".$val
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
	  if(!empty($uinfo))
	  {
		$row = $this->sql->retrieve("SELECT n.news_author, COUNT(n.news_id) AS totalnews FROM #news AS n
		WHERE n.news_author = ".key($uinfo));
	/*
	echo "<pre>";
	var_dump (empty($row['totalnews']));
	echo "</pre>";
	*/
		return empty($row['totalnews'])?null:$row['totalnews'];
	  }

	}

	}


	function sc_euser_posts($parms=null) // default count
	{
		$uinfo=$this->userinfo();
		
		if ($parms['url']){

			//	  public function sc_news_author_items_url($parm=null)
					  if(empty($uinfo))
					  {
						  return null;
					  }
			  
// Quando puder tenho de meter isto com o geturl
 //					  return e107::getUrl()->create('news/list/author',array('author'=>$unm)); // e_BASE."news.php?author=".$val
						return e_HTTP.'userposts.php?0.forums.'.key($uinfo);
				}
		else
		{
//			var_dump (e107::getRegistry('_all_')); // Não vou usar o registry, nem sei como funciona....
			if(!empty($uinfo))
			{
			  $row = $this->sql->retrieve("SELECT p.post_user, COUNT(p.post_id) AS totalposts FROM #forum_post AS p WHERE p.post_user = ".key($uinfo));
		  /*
		  echo "<pre>";
		  var_dump (empty($row['totalnews']));
		  echo "</pre>";
		  */
			  return empty($row['totalposts'])?null:$row['totalposts'];
			}
		}

	}

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

}