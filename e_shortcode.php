<?php
/*
* Copyright (c) e107 Inc 2015 e107.org, Licensed under GNU GPL (http://www.gnu.org/licenses/gpl.txt)
*
* Log Stats shortcode batch class - shortcodes available site-wide. ie. equivalent to multiple .sc files.
*/

if (!defined('e107_INIT')) { exit; }
//var_dump ($parm);
class euser_shortcodes extends e_shortcode
{

	function __construct()
	{
    $this->sql = e107::getDb();
	}

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
$html = e107::getMenu()->renderMenu(($parm["path"]?:"euser/"), ($parm["path"]?"":"euser_").$parm["name"]."_menu", false, true);
//$html = e107::getMenu()->renderMenu($parm["path"], $parm["name"]."_menu", false, true);

//var_dump ($html);

if (!$html) {return;}
$doc = new DOMDocument();
libxml_use_internal_errors(true);
$doc->loadHTML($html);
$finder = new DomXPath($doc);
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

return ($parm["caption"]?str_replace('panel-heading',$parm["caption"],$doc->saveHTML($finder->query("//*[contains(@class, 'panel-heading')]")->item(0))):"").str_replace(array('panel-body', 'caption'),array('',($parm["caption"]?:'hidden')),$doc->saveHTML($finder->query("//*[contains(@class, 'panel-body')]")->item(0)));

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



}



?>