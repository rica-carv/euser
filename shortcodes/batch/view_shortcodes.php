<?php
//ECHO "SC VIEW";
// ########################################################################################
// O ficheiro tem de ficar com este nome por causa da treta da rotina interna dos shortcodes do e107
// ########################################################################################
if (!defined('e107_INIT')) { exit; }
//echo "<hr>SHORTCODES CARREGADOS???<HR>";
//include_once(e_HANDLER.'shortcode_handler.php');
//global $tp;
//$phillis_shortcodes = $tp -> e_sc -> parse_scbatch(__FILE__);
class plugin_phillis_view_shortcodes extends e_shortcode
{
  protected	$pref;
  protected	$tp;
  protected	$phcatpref;
//  public		$phillissRow;
  function __construct()
	{
//		$philliss_prefs = e107::getPref('phillis_settings');
	  $this->pref = e107::getPlugPref('phillis');
    $this->tp = e107::getParser();
    $this->phcatpref = e107::getPlugPref("philcat");
//    $this->js = eparse::toJSONON();
//		  print_a($philliss_prefs);
//    $phillis_tables_row = getcachedvars('phillis_tables_row');
	}
/*
  function sc_menucss()
  {
    return file_exists(THEME.'phillis.css')?THEME:e_PLUGIN."phil/";
  }
*/
/*
    function sc_listcss($parm='')
  {
var_dump ($parm);
    switch ($parm) {
    case 'phil':
    $plugin = "phil/";
    break;
    case 'phillis':
    $plugin = "phil_lis/";
    break;
    }
  return ((file_exists(THEME.$parm.".css"))?THEME:e_PLUGIN.$plugin).$parm.".css";
  }
*/
// ##############################################################
// SHORTCODES PARA phillis.PHP (listas individuais)
// ##############################################################
//function sc_phlis_sectioncode()
function sc_phlis_section($parm)
  {
    if (isset($parm['code']))
    {
//global $tp;
//  $phillis_row = getcachedvars('phillis_row');
//  $phillis_row = e107::getRegistry('phillis_row');
//  $phillis_row = $this->var['phillis_row'];
  //  return $tp->toHTML($phillis_row['pais'])."_".$tp->toHTML($phillis_row['tipo'])."_".$tp->toHTML($phillis_row['familia']);
  return $this->tp->toHTML($this->var['phillis_row']['pais'])."_".$this->tp->toHTML($this->var['phillis_row']['tipo'])."_".$this->tp->toHTML($this->var['phillis_row']['familia']);
  }
//    function sc_phlis_sectiontitle()
    if (isset($parm['title']))
//    {
    {
//global $phillis_tmpc;
//var_dump($phillis_row);
//  $phillis_tmpc = getcachedvars('phillis_tmpc');
//  return getcachedvars('phillis_tmpc');
//    if (isset($parm['title'])){
//      return ((check_class($this->pref['allow_hidesection']))?"<a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion".$this->tp->toHTML($this->var['cod'])."' href='#collapse".$this->tp->toHTML($this->var['cod'])."'>":"").getcachedvars('phillis_tmpc').((check_class($this->pref['allow_hidesection']))?"</a>":"");
//      return ((check_class($this->pref['allow_hidesection']))?"<a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion".$this->tp->toHTML($this->var['cod'])."' href='#collapse".$this->tp->toHTML($this->var['cod'])."'>":"").e107::getRegistry('phillis_tmpc').((check_class($this->pref['allow_hidesection']))?"</a>":"");
      return ((check_class($this->pref['allow_hidesection']))?"<a class='accordion-toggle' data-bs-toggle='collapse' data-bs-parent='#accordion".$this->tp->toHTML($this->var['cod'])."' href='#collapse".$this->tp->toHTML($this->var['cod'])."'>":"").$this->var['phillis_tmpc'].((check_class($this->pref['allow_hidesection']))?"</a>":"");
            //    }

//  return getcachedvars('phillis_tmpc');
}
if (isset($parm['data']))
{
//function sc_phlis_sectiondata()
//{
//  global $tp;
//  $phillis_row = e107::getRegistry('phillis_row');
//  $phillis_row = $this->var['phillis_row'];
return " data-pais='".$this->var['phillis_row']['pais_real']."' data-descpais='".$this->tp->toJSON($this->var['phillis_row']['desc_pais'])."' data-descfam='".$this->tp->toJSON($this->var['phillis_row']['desc_familias'])."' data-desctipo='".$this->tp->toJSON($this->var['phillis_row']['desc_tipo'])."'";
}  
}

    function sc_phlis_image()
  {
//  global $phillis_image;
//  return getcachedvars('phillis_image');
//  return e107::getRegistry('phillis_image');

//  return $this->var['phillis_image'];

  return $this->tp->toImage($this->var['phillis_image'], array ('loading'=>'lazy', 'alt'=>$this->tp->toHTML($this->var['cod']), 'class'=>'lazy thb_many', 'placeholder'=>'/e107_images/icons/important_16.png', 'w' => $this->phcatpref['wsize'], 'h' => $this->phcatpref['hsize']));
}
/*
    function sc_itemclass($parm)
  {
//  global $phillis_row;
  $phillis_shortcodesrow = getcachedvars('phillis_row');
//  var_dump($phillis_shortcodesrow);
//  exit;
return (($phillis_shortcodesrow['quants']==='0')?"wait ":"").(is_null($phillis_shortcodesrow['b'])?(($parm=="pr")?"":"list imagepop").(($parm=="ed")?((substr_count($phillis_shortcodesrow['cods'], ",")>0)?" more":""):""):(getcachedvars('phillis_view')=='x' && $parm<>"ed"?"colxc":"col".($parm=="pr"?"":" imagepop")));
//return (($phillis_shortcodesrow['quant']>'0' && !$phillis_shortcodesrow['quants'])?"troca ":"").(($phillis_shortcodesrow['quants']==='0')?"wait ":"").(!is_null($phillis_shortcodesrow['b'])?(getcachedvars('phillis_view')=='x' && $parm<>"ed"?"colxc":"col imagepop"):(($parm=="pr")?"":"list imagepop").(($parm=="ed")?((substr_count($phillis_shortcodesrow['cods'], ",")>0)?" more":""):""));
  }
    function sc_itemhref()
  {
//  global $phillis_shortcodesaction;
  $phillis_shortcodesaction = getcachedvars('PHLIS_Action');
//var_dump($phillis_shortcodesaction);
  $phillis_row = getcachedvars('phillis_row');
  $phillis_userid = getcachedvars('phillis_userid');
return e_SELF."?".$phillis_shortcodesaction."-".$phillis_userid.".".$phillis_row['peca'].(!is_null($phillis_row['b'])?"|".$phillis_row['cods']:"");
  }
    function sc_itemtitle()
  {
//  global $phillis_row;
  $phillis_row = getcachedvars('phillis_row');
return (!is_null($phillis_row['b'])?phillis_50:phillis_51);
  }
*/
// Deprecated, sc_data replaces it...
/*
    function sc_tiphtml()
  {
  global $tp;
  $phillis_row = getcachedvars('phillis_row');
return "<center><img src=\'".e_PLUGIN."phil_cat/images/".$phillis_row['pais_real']."/d/".$phillis_row['peca'].".jpg\'></center>".((getperms("P"))?"<center><b><i>".$phillis_row['peca']."</i></b></center>":"")."<b>".htmlspecialchars(phcat_14.":</b> ".$tp->toJSON($phillis_row['ano'])."-".$tp->toJSON($phillis_row['desc_serie'])."<br><b>".phcat_36.":</b> ".$tp->toJSON($phillis_row['desc'])."<br><b>".phcat_37.":</b> ".$tp->toJSON($phillis_row['valor_facial'])."<br><b>".phcat_A30.":</b> ".$tp->toJSON($phillis_row['desc_pais'])."<br><b>AFINSA:</b> ".$tp->toJSON($phillis_row['desc_familias']." - ".$phillis_row['desc_tipo']." ".$phillis_row['prefx'].$phillis_row['num'].$tp->toHTML($phillis_row['sufx'], true)), true);
}  
*/
/*
    function sc_itemdata()
  {
  global $tp;
  $phillis_row = getcachedvars('phillis_row');
//return " data-popimage='".$phillis_row['peca']."' data-peca='".$phillis_row['peca']."' data-ano='".$tp->toJSON($phillis_row['ano'])."' data-serie='".$tp->toJSON($phillis_row['desc_serie'])."' data-desc='".$tp->toJSON($phillis_row['desc'])."' data-valor='".$tp->toJSON($phillis_row['valor_facial'])."' data-afinsa='".$phillis_row['prefx'].$phillis_row['num'].$tp->toHTML($phillis_row['sufx'], true)."'";
return " data-popimage='".$phillis_row['peca']."' data-ano='".$tp->toJSON($phillis_row['ano'])."' data-serie='".$tp->toJSON($phillis_row['desc_serie'])."' data-desc='".$tp->toJSON($phillis_row['desc'])."' data-valor='".$tp->toJSON($phillis_row['valor_facial'])."'";
}  
*/
/* old
    function sc_item()
  {
//  global $phillis_tmp;
// $phillis_shortcodesrow = getcachedvars('phillis_row');
// $phillis_shortcodesallowedviews = getcachedvars('phillis_nallowedviews');
//  return (in_array($_SESSION{'phillis_view'}, getcachedvars('PHLIS_Allowedviews')) && $_SESSION{'phillis_view'}=="x" && !is_null($phillis_shortcodesrow['b'])?"|":getcachedvars('phillis_tmp'));
  return getcachedvars('phillis_tmp');
  }
*/
    function sc_phlis_item($parm)
  {

//  $phillis_shortcodesrow = e107::getRegistry('phillis_row');
//  $phillis_shortcodesrow = $this->var['phillis_row'];

//var_dump (isset($parm['class'])); 
if (isset($parm['class']))
  {
//var_dump ($parm['class']); 
//  global $phillis_row;
//  var_dump($phillis_shortcodesrow);
//  exit;
//return (($phillis_shortcodesrow['quants']==='0')?"wait ":"").(is_null($phillis_shortcodesrow['b'])?(($parm['class']=="pr")?"":"list imagepop").(($parm['class']=="ed")?((substr_count($phillis_shortcodesrow['cods'], ",")>0)?" more":""):""):(e107::getRegistry('phillis_view')=='x' && $parm['class']<>"ed"?"colxc":"col".($parm['class']=="pr"?"":" imagepop")));
return (($this->var['phillis_row']['quants']==='0')?"wait ":($this->var['phillis_quants']?"have ":"")).(is_null($this->var['phillis_row']['b'])?(($parm['class']=="pr")?"":"list imagepop").(($parm['class']=="ed")?((substr_count($this->var['phillis_row']['cods'], ",")>0)?" more":""):""):($this->var['phillis_view']=='x' && $parm['class']<>"ed"?"listxc":"list".($parm['class']=="pr"?"":" imagepop")));
//return (($phillis_shortcodesrow['quant']>'0' && !$phillis_shortcodesrow['quants'])?"troca ":"").(($phillis_shortcodesrow['quants']==='0')?"wait ":"").(!is_null($phillis_shortcodesrow['b'])?(getcachedvars('phillis_view')=='x' && $parm<>"ed"?"colxc":"col imagepop"):(($parm=="pr")?"":"list imagepop").(($parm=="ed")?((substr_count($phillis_shortcodesrow['cods'], ",")>0)?" more":""):""));

  }
/*
if (isset($parm['href']))
  {
//  global $phillis_shortcodesaction;
//  $phillis_shortcodesaction = getcachedvars('PHLIS_Action');
//var_dump($phillis_shortcodesaction);
//  $phillis_row = getcachedvars('phillis_row');
//  $phillis_userid = getcachedvars('phillis_userid');
//return e_SELF."?".$phillis_shortcodesaction."-".$phillis_userid.".".$phillis_shortcodesrow['peca'].(!is_null($phillis_shortcodesrow['b'])?"|".$phillis_shortcodesrow['cods']:"");
return $phillis_shortcodesrow['cods']:"");
  }
*/
if (isset($parm['title']))
//    function sc_itemtitle()
  {
//  global $phillis_row;
//////  $phillis_row = getcachedvars('phillis_row');
return ($this->var['phillis_quants'])?LAN_PLUGIN_PHILLIS_50:LAN_PLUGIN_PHILLIS_51;
  }
if (isset($parm['data']))
  {
//echo "<hr>";



/*------------------
$popdata ="data-phl-pais=".$this->var['phillis_row']['pais']." data-phl-image='".$this->var['phillis_row']['peca']."' "; 
-----------*/



//    if ($parm['data']=="popimage"){return "data-popimage='".$phillis_shortcodesrow['peca']."' ";}
///////////////////////////////////////////////////////////////    if ($parm['data']=="popimage"){$text = $popdata;} /// Para que é isto?
//    if (USERID==e107::getRegistry('phillis_userid') && $phillis_shortcodesrow['cods']){$codedata = "data-code='".$phillis_shortcodesrow['cods']."' ";}
//    if (USERID==$this->var['phillis_userid'] && $this->var['phillis_row']['cods']){$codedata = "data-phl-code='".$this->var['phillis_row']['cods']."' ";}
//    if ($parm['data']=="code"){return "data-code='".$phillis_shortcodesrow['cods']."' ";}
//    if ($parm['data']=="code"){return $codedata;}
//    if ($parm['data']=="code"){$text = (USERID==$this->var['phillis_userid'] && $this->var['phillis_row']['cods'])?"data-phl-code='".$this->var['phillis_row']['cods']."' ":null;}

//    var_dump($this->var['phillis_row']['desc_serie']);
//    global $tp;
//  $phillis_row = getcachedvars('phillis_row');
//return " data-popimage='".$phillis_row['peca']."' data-peca='".$phillis_row['peca']."' data-ano='".$tp->toJSON($phillis_row['ano'])."' data-serie='".$tp->toJSON($phillis_row['desc_serie'])."' data-desc='".$tp->toJSON($phillis_row['desc'])."' data-valor='".$tp->toJSON($phillis_row['valor_facial'])."' data-afinsa='".$phillis_row['prefx'].$phillis_row['num'].$tp->toHTML($phillis_row['sufx'], true)."'";
///    return "data-popimage='".$phillis_shortcodesrow['peca']."' data-ano='".$tp->toJSON($phillis_shortcodesrow['ano'])."' data-serie='".$tp->toJSON($phillis_shortcodesrow['desc_serie'])."' data-desc='".$tp->toJSON($phillis_shortcodesrow['desc'])."' data-valor='".$tp->toJSON($phillis_shortcodesrow['valor_facial'])."'";


/*------------------
return $popdata."data-phl-ano='".$this->var['phillis_row']['ano']."' data-phl-serie='".$this->var['phillis_row']['desc_serie']."' data-phl-desc='".$this->var['phillis_row']['desc_item']."' data-phl-valor='".$this->var['phillis_row']['valor_facial']."' onmouseover='changePopoverContent(this)'";
-----------------*/

global $phillis_template;

//var_dump($this->var['phillis_row']);

$jssc = array(
  "PHLIS_PAIS" => $this->var['phillis_row']['pais'],
  "PHLIS_SER" => $this->var['phillis_row']['desc_serie'],
  "PHLIS_DSC" => $this->var['phillis_row']['desc_item'],
  "PHLIS_VAL" => $this->var['phillis_row']['valor_facial'],
  "PHLIS_ANO" => $this->var['phillis_row']['ano'],
);

if ($parm['data']=="popover"){
    $this->var['phillis_image'] = e_PLUGIN_ABS."philcat/".e107::getPlugPref("philcat")['filepath'].$this->var['phillis_row']['pais']."/t/".$this->var['phillis_row']['peca'].".jpg";
    $jssc["PHLIS_IMAGE"] = $this->sc_phlis_image();
//    $jssc["PHLIS_IMG"] = $this->var['phillis_row']['peca'];
    return " data-phl-code=".$this->var['phillis_row']['peca']." data-bs-content='".$this->tp->toAttribute($this->tp->parseTemplate($phillis_template['popover'], true, $jssc), true)."' ";
  } else {
    return $this->tp->parseTemplate($phillis_template['trc'], true, $jssc);
  }

//return " data-bs-content='".e107::getParser()->toAttribute(e107::getParser()->parseTemplate($phillis_template['popover'], true, $jssc), true)."' onmouseover='displayPopover(this)
///////return $att_start.e107::getParser()->toAttribute(e107::getParser()->parseTemplate($template, true, $jssc), true).$att_end;

// Meter os dados do popover directo como o PHP torna mais lenta a página....
//return " data-bs-content='dffgsfdçgmk,.mxcv.zc,xmvldmvklmfsdklzmxcvm,,.vmmzsdklmfskdmv.zcxm,v.vmldmfklvfkm.vzx,mc.cmv,,vmxc.' onmouseover='displayPopover(this)'";

//    return $popdata."data-phl-ano=".json_encode($this->var['phillis_row']['ano'])." data-phl-serie=".json_encode($this->var['phillis_row']['desc_serie'])." data-phl-desc=".json_encode($this->var['phillis_row']['desc_item'])." data-phl-valor=".json_encode($this->var['phillis_row']['valor_facial'])." onmouseover='changePopoverContent(this)'";
}  
//  global $phillis_tmp;
// $phillis_shortcodesrow = getcachedvars('phillis_row');
// $phillis_shortcodesallowedviews = getcachedvars('phillis_nallowedviews');
//  return (in_array($_SESSION{'phillis_view'}, getcachedvars('PHLIS_Allowedviews')) && $_SESSION{'phillis_view'}=="x" && !is_null($phillis_shortcodesrow['b'])?"|":getcachedvars('phillis_tmp'));
/*
echo "<pre>";
var_dump($this->var['phillis_tmp']);
echo "</pre>";
*/
return $this->var['phillis_tmp'];
//  return e107::getRegistry('phillis_tmp');
  }
/*
    function sc_legpara()
  {
//  global $phillis_tmp;
// $phillis_shortcodesrow = getcachedvars('phillis_row');
// $phillis_shortcodesallowedviews = getcachedvars('phillis_nallowedviews');
//  return (in_array($_SESSION{'phillis_view'}, getcachedvars('PHLIS_Allowedviews')) && $_SESSION{'phillis_view'}=="x" && !is_null($phillis_shortcodesrow['b'])?"|":getcachedvars('phillis_tmp'));
//var_dump (getcachedvars('phillis_whatdo'));
  return (getcachedvars('phillis_whatdo')=='pr'?'&nbsp;&nbsp;&nbsp;':'<br>');
  }
*/
function sc_phlis_navlink($parm=null) //TODO add more options.
{
//          $url = $this->sc_news_nav_url($parm);

  $url = e107::getUrl()->create('phillis'); // default for now.
/*
  if(varset($parm['list']) == 'all') // A list of all items - usually headings and thumbnails
  {
    $url = e107::getUrl()->create('news/list/all');
  }
  elseif(varset($parm['list']) == 'category')
  {
    $url = e107::getUrl()->create('news/list/short', $this->news_item);  //default for now.
  }
  elseif(varset($parm['items']) == 'category')
  {
    $url = e107::getUrl()->create('news/list/category', $this->news_item);
  }
*/
  $caption = vartrue($parm['text'], $this->tp->toGlyph('fa-backward').LAN_BACK);
  
    $text = '<a class="pager-button btn hidden-print align-self-center mb-0" href="'.$url.'">'.e107::getParser()->toHTML($caption,false,'defs').'</a>';
  
  return $text;
}
function sc_phlis_peca() //Usada na lista e serie templates
{
//    return $this->tp->toHTML($this->var['cod_peca']);
///    return $this->tp->toHTML($this->var['cod']);
  return $this->tp->toHTML(e107::url('philcat', 'item', array('id'=>$this->var['phillis_row']['peca'])));
}

}