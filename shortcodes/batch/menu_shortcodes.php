<?php
//ECHO "SC LIS MENU";

if (!defined('e107_INIT')) { exit; }

class plugin_phillis_menu_shortcodes extends e_shortcode
{
 protected $pref;
 protected $tp;
//public		$phillissRow;
  function __construct()
	{
//		$philliss_prefs = e107::getPref('phillis_settings');
	  $this->pref = e107::getPlugPref("phil_lis");
      $this->tp=e107::getParser();
//		  print_a($philliss_prefs);
//    $phillis_tables_row = getcachedvars('phillis_tables_row');
	}


// ##############################################################
// SHORTCODES PARA MENU
// ##############################################################

  // Deprecated
  function sc_menucontent()
  {
  //$phillis_shortcodesaction = getcachedvars('PHLIS_Action');
//  $phillis_shortcodesview = getcachedvars('phillis_view');
//var_dump($phillis_shortcodesaction);
//$pref = e107::getPref('phillis_settings');
//var_dump($pref);
//extract($pref['phillis_settings']);
//////extract($this->pref);
//var_dump($allow_fviews);
//  $phillis_shortcodesviewarr = array("c" => array(phillis_42,"numcond"),"x" => array(phillis_43,"numcondplus"),"g" => array(phillis_21,"imggal"),"l" => array(phillis_22,"imglis"),"n" => array(phillis_23,"ednum"),"i" => array(phillis_24,"edimg"));
//var_dump($phillis_shortcodesviewarr);
//switch ($phillis_shortcodesaction) {
//    case "u":
//    case "n":
//      $allow_views = $allow_fviews;
//      break;
//    case "s":
//    case "o":
//      $allow_views = $allow_tviews;
//      break;
//}
  $phillis_shortcodeswhatdo = getcachedvars('phillis_whatdo');
//var_dump($phillis_shortcodeswhatdo);
//    $scallow_views = ($phillis_shortcodeswhatdo == "ed" ? $allow_eviews : $allow_views[$phillis_shortcodesaction]);
//    $allow_views = ($phillis_shortcodesaction == "n" || $phillis_shortcodesaction == "u") ? $allow_fviews : null;
//var_dump($phillis_shortcodeswhatdo);
//var_dump($pref['phillis_settings']);
//		foreach($allow_views as $key => $row)
  $allowed_views = (getcachedvars('phillis_ccount')?null:$this->pref['allowed_views']);
//  $allowed_views = (getcachedvars('phillis_ccount')?null:$_SESSION{'phillis_view'}[$phillis_shortcodesaction]);
//  var_dump ($_SESSION{'phillis_view'});

//var_dump($this->pref['allowed_views']);
///var_dump($allowed_views);
//		foreach(($phillis_shortcodeswhatdo == "ed" ? $allow_eviews : $allow_views[$phillis_shortcodesaction]) as $key => $row)
//		foreach((getcachedvars('phillis_whatdo') == "ed" ? $allow_eviews : $allowed_views[$phillis_shortcodesaction]) as $key => $row)
    $views_icons = array('d' => array('Normal','numcond'), 'x' => array('Condensed','numcondplus'));

		foreach((getcachedvars('phillis_whatdo') == "ed" ? $this->pref['allowed_eviews'] : $allowed_views) as $key => $row)
		{
//var_dump($key);
//				$text .= (array_key_exists($key, $views_icons)) ? "<a href='javascript:this.phfltform.LAN_PLUGIN_PHILLIS_vtype.value=\"".$key."\";this.phfltform.submit()' title='".$views_icons[$key][0]."' ><img src='images/view_".$views_icons[$key][1].($phillis_shortcodesview==$key?"":"off").".png'></a>&nbsp;" : "";
//				$text .= (array_key_exists($key, $views_icons)) ? "<a href='javascript:this.phfltform.LAN_PLUGIN_PHILLIS_vtype.value=\"".$key."\";this.phfltform.submit()' title='".$views_icons[$key][0]."' ><img src='images/view_".$views_icons[$key][1].(getcachedvars('phillis_view')==$key?"":"off").".png'></a>&nbsp;" : "";
// SPRITES DOS ICONES
				$text .= (array_key_exists($key, $views_icons)) ? "<a href='javascript:this.phfltform.phillis_vtype.value=\"".$key."\";this.phfltform.submit()' title='".$views_icons[$key][0]."' class='phillis_icon' id='".$views_icons[$key][1].(getcachedvars('phillis_view')==$key?"":"off")."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>&nbsp;" : "";
//var_dump($_SESSION{'phillis_view'});
//var_dump($_SESSION{'phillis_view'}==$key);
		}
return $text;
//return (array_key_exists($key, $views_icons)) ? "<a href='javascript:this.phfltform.LAN_PLUGIN_PHILLIS_vtype.value=\"".$key."\";this.phfltform.submit()' title='".$views_icons[$key][0]."' ><img src='images/view_".$views_icons[$key][1].($phillis_shortcodesview==$key?"":"off").".png'></a>&nbsp;" : "";
//return (($phillis_shortcodesaction == "n" || $phillis_shortcodesaction == "u")?"<input type='hidden' name='phillis_vtype'/>".LAN_PLUGIN_PHILLIS_11.": "."<a href='javascript:this.phfltform.LAN_PLUGIN_PHILLIS_vtype.value=\"c\";this.phfltform.submit()' title='".LAN_PLUGIN_PHILLIS_42."' ><img src='images/view_numcond".(!$phillis_shortcodesview=="c"}?"":"off").".png'></a>&nbsp;<a href='javascript:this.phfltform.LAN_PLUGIN_PHILLIS_vtype.value=\"x\";this.phfltform.submit();' title='".LAN_PLUGIN_PHILLIS_43."' ><img src='images/view_numcondplus".($phillis_shortcodesview=="x"?"":"off").".png'></a>":"");
  }
/*----------- DEPRECATED
  function sc_menuend()
  {
//var_dump ("hgjhgjhfjhgjfdg") ;
//Global $phillis_EDITLEGFALTAS, $LAN_PLUGIN_PHILLIS_EGFALTAS, $phillis_INILEG, $phillis_ENDLEG, $phillis_COMPLEG, $tp;
////////////////////////////preg_match("/\bphillis.php\b/i", e_SELF, $match);
//$phillis_temp = preg_split('/[.-]/', e_QUERY);
//$phillis_userid = abs(intval($phillis_temp[1]));
//$action = ($phillis_userid==0?"show":$phillis_temp[0]);
//$phillis_splitter = substr(e_QUERY, 1, 1);
//  $phillis_shortcodeswhatdo = getcachedvars('phillis_whatdo');
//  $phillis_shortcodescuserid = getcachedvars('phillis_cuserid');
  $phillis_shortcodesaction = getcachedvars('PHLIS_Action');
  $phillis_shortcodesuserid = getcachedvars('phillis_userid');
  $phillis_shortcodesccount = getcachedvars('phillis_ccount');
  $phillis_shortcodesusername = getcachedvars('phillis_username');
  $phillis_shortcodescusername = getcachedvars('phillis_cusername');
$phillis_shortcodesedit = ($phillis_shortcodesccount?null:(USERID==$phillis_shortcodesuserid && getcachedvars('phillis_whatdo')=="ed"));
//var_dump($phillis_shortcodesccount);
//var_dump($phillis_shortcodesedit);
//var_dump($sc_style);
//var_dump($phil_shortcodes);
//var_dump($_SESSION{'phillis_view'});
//if ($action == "n" || $action == "u"){
//    $phillis_vtxti = phillis_11.": ";
//switch ($_SESSION{'phillis_view'}) {
//  case 'x':
//    $phillis_vximg = "off";
////    $phillis_vtxt .= phillis_42;
////    $phillis_vval = "";
//    break;
//  default:
//    $phillis_vimg = "condplus";
//    $phillis_vtxt .= phillis_43;
//    $phillis_vval = "x";
//   }
//}
switch ($phillis_shortcodesaction) {
    case "u":
    case "n":
      $phillis_shortcodesview = $_SESSION{'phillis_view'}[0];
      $phillis_shortcodesuser =(USERID==$phillis_shortcodesuserid);
      break;
    case "s":
    case "o":
      $phillis_shortcodesview = $_SESSION{'phillis_view'}[1];
      $phillis_shortcodesuser =(USERID<>$phillis_shortcodesuserid);
      break;
}
$phillis_shortcodesusern = (USERID==$phillis_shortcodesuserid?$phillis_shortcodescusername:$phillis_shortcodesusername);
////return ((!is_null($phillis_shortcodesedit) && USERID==$phillis_shortcodesuserid && $phillis_shortcodesuserid>0)?"<p><center><a href='".e_PLUGIN_ABS."phil_lis/phillis.php?".str_replace(($phillis_shortcodesedit?"-":"."), ($phillis_shortcodesedit?".":"-"), e_QUERY)."' title='".($phillis_shortcodesedit==1?phillis_201:phillis_200)."'><img src='images/list_".($phillis_shortcodesedit==1?"save":"edit").".png'/>&nbsp;&nbsp;".($phillis_shortcodesedit==1?phillis_201:phillis_200)."</a></center>".(($phillis_utext || $phillis_shortcodesedit==1)?"<p><center><div id='dialog-content' class='".($phillis_shortcodesedit==1 && !$phillis_utext?"warning":($phllist_Ajaxerr?"error":"success"))."'>".($phillis_shortcodesedit==1 && !$phillis_utext?phillis_300.(($phillis_shortcodesaction == "s" || $phillis_shortcodesaction == "o")?phillis_302:phillis_301):$phillis_utext)."</div></center>":""):"").(($phillis_shortcodesaction == "n" || $phillis_shortcodesaction == "u" || $phillis_edit)?"<div id='dialog-content' style='padding: 0px;'>".($phillis_shortcodesedit?$phillis_EDITLEGFALTAS:$LAN_PLUGIN_PHILLIS_EGFALTAS)."</div>":"");
//extract($pref['phillis_settings']);
//var_dump ($phillis_shortcodesccount);
//print_a ($this->pref['terms']);
//return ((!is_null($phillis_shortcodesedit) && USERID==$phillis_shortcodesuserid && $phillis_shortcodesuserid>0)?"<p><center><a href='".e_PLUGIN_ABS."phil_lis/phillis.php?".str_replace(($phillis_shortcodesedit?"-":"."), ($phillis_shortcodesedit?".":"-"), e_QUERY)."' title='".($phillis_shortcodesedit==1?phillis_201:phillis_200)."'><img src='images/list_".($phillis_shortcodesedit==1?"save":"edit").".png'/>&nbsp;&nbsp;".($phillis_shortcodesedit==1?phillis_201:phillis_200)."</a></center>".(($phillis_utext || $phillis_shortcodesedit==1)?"<p><center><div id='dialog-content' class='".($phillis_shortcodesedit==1 && !$phillis_utext?"warning":($phllist_Ajaxerr?"error":"success"))."'>".($phillis_shortcodesedit==1 && !$phillis_utext?$tp->toHTML($pref['phillis_settings']['terms'], true):$phillis_utext)."</div></center>":""):"").($phillis_shortcodesccount?"<p><strong><div class='successheader'><center>".LAN_PLUGIN_PHILLIS_90." ".LAN_PLUGIN_PHILLIS_76."</center></div><div class='success'><mark>".($phillis_shortcodesuser?phillis_68." ".$phillis_shortcodesusern." ".lcfirst(phillis_75):phillis_75)." ".$phillis_shortcodesccount." ".lcfirst(phillis_90)." ".LAN_PLUGIN_PHILLIS_76." ".($phillis_shortcodesuser?phillis_69:phillis_74." ".$phillis_shortcodesusern)."</mark></div></strong><p>":"");
//var_dump ($phillis_shortcodesedit);
//var_dump ($phillis_shortcodesuserid);
//var_dump ($phillis_shortcodesccount);

return ((!is_null($phillis_shortcodesedit) && USERID==$phillis_shortcodesuserid && $phillis_shortcodesuserid>0)?"<p><center><a href='".e_PLUGIN_ABS."phil_lis/phillis_view.php?".str_replace(($phillis_shortcodesedit?"-":"."), ($phillis_shortcodesedit?".":"-"), e_QUERY)."' title='".($phillis_shortcodesedit==1?LAN_PLUGIN_PHILLIS_201:LAN_PLUGIN_PHILLIS_200)."'><img src='images/list_".($phillis_shortcodesedit==1?"save":"edit").".png'/>&nbsp;&nbsp;".($phillis_shortcodesedit==1?LAN_PLUGIN_PHILLIS_201:LAN_PLUGIN_PHILLIS_200)."</a></center>".(($phillis_utext || $phillis_shortcodesedit==1)?"<p><center><div id='dialog-content' class='".($phillis_shortcodesedit==1 && !$phillis_utext?"warning":($phllist_Ajaxerr?"error":"success"))."'>".($phillis_shortcodesedit==1 && !$phillis_utext?$tp->toHTML($this->pref['terms'], true):$phillis_utext)."</div></center>":""):"").($phillis_shortcodesccount?"<p><strong><div class='successheader'><center>".LAN_PLUGIN_PHILLIS_90." ".LAN_PLUGIN_PHILLIS_76."</center></div><div class='success'><mark>".($phillis_shortcodesuser?LAN_PLUGIN_PHILLIS_68." ".$phillis_shortcodesusern." ".lcfirst(LAN_PLUGIN_PHILLIS_75):LAN_PLUGIN_PHILLIS_75)." ".$phillis_shortcodesccount." ".lcfirst(LAN_PLUGIN_PHILLIS_90)." ".LAN_PLUGIN_PHILLIS_76." ".($phillis_shortcodesuser?LAN_PLUGIN_PHILLIS_69:LAN_PLUGIN_PHILLIS_74." ".$phillis_shortcodesusern)."</mark></div></strong><p>":"");
  }
---------*/


/*----
  function sc_phlis_viewswitch($parm)
  {
    var_dump (PHLIS_ICON_normal);
    var_dump (PHLIS_ICON_condensed);
//    return e107::getForm()->flipswitch('contact_emailcopy', $pref['contact_emailcopy'], array('on'=>'<img src="'.e_PLUGIN.'phil_lis/images/icons.png">', 'off'=>'<img src="'.e_PLUGIN.'phil_lis/images/icons.png">'));
    return e107::getForm()->flipswitch('contact_emailcopy', $pref['contact_emailcopy'], array('on'=>addslashes(PHLIS_ICON_normal),'off'=>addslashes(PHLIS_ICON_condensed)));
  }
----*/
function sc_phlis_ltypebutton($parms)
{
/*
var_dump($parms);
var_dump($parms['onlabel']);
var_dump($parms['onlabel']??LAN_PLUGIN_PHILLIS_42);
*/
/*
var_dump($parms['width']);
var_dump($parms['width']??"50%");
*/
//if (e107::getRegistry('phillis_action') <> "n" || e107::getRegistry('phillis_action') <> "u") {return null;} 
//var_dump((e107::getRegistry('phillis_action') <> "n") || (e107::getRegistry('phillis_action') <> "u")); 

if (e107::getRegistry('phillis_action') == "n" || e107::getRegistry('phillis_action') == "u") { 
return "<input id='ltype' type='checkbox' class='toggle-switch icon-big icon-small' checked data-toggle='toggle' data-width='".($parms['width']??"49%")."' data-onlabel='".($parms['onlabel']??LAN_PLUGIN_PHILLIS_42)."' data-offlabel='".($parms['offlabel']??LAN_PLUGIN_PHILLIS_43)."' data-onstyle='".($parms['onstyle']??"success")."' data-offstyle='".($parms['offstyle']??"danger")."'>";
}
/* Antigo, usa imagens....
IF ($phillis_whatdo <> "pr") {
if (defined("ICONPRINTPDF") && file_exists(THEME."images/".ICONPRINTPDF)) 
{
$phillis_icon = THEME_ABS."images/".ICONPRINTPDF;
}
else
{
$phillis_icon = e_PLUGIN_ABS."pdf/images/pdf_16.png";
}
//$phillis_caption .= "<span><a href='".e_PLUGIN_ABS."phil_lis/phillis_pdf.php?".e_QUERY."' title='".LAN_PLUGIN_PHILLIS_98."'><img src='".$phillis_icon."' /></a>";
return "<a class='btn btn-default' href='".e_PLUGIN_ABS."phil_lis/phillis_pdf.php?".e_QUERY."' title='".LAN_PLUGIN_PHILLIS_98."'><img src='".$phillis_icon."' /></a>";
}
*/
return null;
}

/*
function sc_phlis_pdf($parm)
  {
return "<a id='phil_pdf' class='btn btn-default' data-toggle='tooltip' data-placement='bottom' href='".e_PLUGIN_ABS."phillis/phillis_pdf.php?".e_QUERY.".d' title='".LAN_PLUGIN_PHILLIS_98."'>".PHCAT_ICON_PDF."</a>";
/* Antigo, usa imagens....
IF ($phillis_whatdo <> "pr") {
if (defined("ICONPRINTPDF") && file_exists(THEME."images/".ICONPRINTPDF)) 
{
	$phillis_icon = THEME_ABS."images/".ICONPRINTPDF;
}
else
{
	$phillis_icon = e_PLUGIN_ABS."pdf/images/pdf_16.png";
}
//$phillis_caption .= "<span><a href='".e_PLUGIN_ABS."phil_lis/phillis_pdf.php?".e_QUERY."' title='".LAN_PLUGIN_PHILLIS_98."'><img src='".$phillis_icon."' /></a>";
return "<a class='btn btn-default' href='".e_PLUGIN_ABS."phil_lis/phillis_pdf.php?".e_QUERY."' title='".LAN_PLUGIN_PHILLIS_98."'><img src='".$phillis_icon."' /></a>";
}
*/
/*
}
*/
/* DEPRECATED DEPRECATED DEPRECATED DEPRECATED
    function sc_phlis_print($parm)
  {
return "<a id='phil_print' class='btn btn-default' data-toggle='tooltip' data-placement='bottom' href='".e_HTTP."print.php?plugin:phillis.".e_QUERY.".d' title='".LAN_PLUGIN_PHILLIS_97."'>".PHCAT_ICON_PRINT."</a>";
/* Antigo, usa imagens....
IF ($phillis_whatdo <> "pr") {
if (defined("ICONPRINT") && file_exists(THEME."images/".ICONPRINT))
     {
         $phillis_icon = THEME_ABS."images/".ICONPRINT;
     }
     else
     {
         $phillis_icon = e_IMAGE_ABS."generic/printer.png";
     }
return "<a class='btn btn-default' href='".e_HTTP."print.php?plugin:phil_lis.".e_QUERY."' title='".LAN_PLUGIN_PHILLIS_97."'><img src='".$phillis_icon."'/></a>";
}
*/
//DEPRECATED DEPRECATED DEPRECATED DEPRECATED DEPRECATED DEPRECATED }
function sc_phlis_csvbutton($parm)
{
/*
$phillis_shortcodesaction = getcachedvars('phillis_action');
$phillis_shortcodesuserid = getcachedvars('phillis_userid');
$phillis_shortcodesccount = getcachedvars('phillis_ccount');
$phillis_shortcodesusername = getcachedvars('phillis_username');
$phillis_shortcodescusername = getcachedvars('phillis_cusername');
$phillis_shortcodesedit = ($phillis_shortcodesccount?null:(USERID==$phillis_shortcodesuserid && getcachedvars('phillis_whatdo')=="ed"));

switch ($phillis_shortcodesaction) {
  case "u":
  case "n":
    $phillis_shortcodesview = $_SESSION{'phillis_view'}['n'];
    $phillis_shortcodesuser =(USERID==$phillis_shortcodesuserid);
    break;
  case "s":
  case "o":
    $phillis_shortcodesview = $_SESSION{'phillis_view'}['u'];
    $phillis_shortcodesuser =(USERID<button>$phillis_shortcodesuserid);
    break;
}
$phillis_shortcodesusern = (USERID==$phillis_shortcodesuserid?$phillis_shortcodescusername:$phillis_shortcodesusername);
*/
//var_dump ($phillis_shortcodesedit);
//var_dump ($phillis_shortcodesuserid);
//var_dump ($phillis_shortcodesccount);
/*
$mes = e107::getMessage();

$mestype = "add".(($phillis_utext || $phillis_shortcodesedit==1)?($phillis_shortcodesedit==1 && !$phillis_utext?"Warning":($phllist_Ajaxerr?"Error":"Success")):"");
*/
//$mes->addSuccess(($phillis_shortcodesedit==1 && !$phillis_utext?$tp->toHTML($this->pref['terms'], true):$phillis_utext));

//$mes->$mestype(($phillis_shortcodesedit==1 && !$phillis_utext?$tp->toHTML($this->pref['terms'], true):$phillis_utext));
/*
$mes->$mestype(($phillis_shortcodesedit==1 && !$phillis_utext?$this->tp->toHTML($this->pref['terms'], true):$phillis_utext));

  if (isset($parm['msg'])){
    echo $mes->render();
    return;
////return (($phillis_utext || $phillis_shortcodesedit==1)?"<p><center><div id='dialog-content' class='".($phillis_shortcodesedit==1 && !$phillis_utext?"warning":($phllist_Ajaxerr?"error":"success"))."'>".($phillis_shortcodesedit==1 && !$phillis_utext?$tp->toHTML($this->pref['terms'], true):$phillis_utext)."</div></center>":"");
  }
return ((!is_null($phillis_shortcodesedit) && USERID==$phillis_shortcodesuserid && $phillis_shortcodesuserid>0)?"<a class='btn btn-default button' title='".($phillis_shortcodesedit==1?LAN_PLUGIN_PHILLIS_201:LAN_PLUGIN_PHILLIS_200)."' data-toggle='tooltip' data-placement='bottom' href='".e_PLUGIN_ABS."phillis/phillis_view.php?".str_replace(($phillis_shortcodesedit?"-":"."), ($phillis_shortcodesedit?".":"-"), e_QUERY)."' title='".($phillis_shortcodesedit==1?LAN_PLUGIN_PHILLIS_201:LAN_PLUGIN_PHILLIS_200)."'>".($phillis_shortcodesedit==1?PHLIS_ICON_save:PHLIS_ICON_edit)."</a>":"");
*/
//return "<a class='btn btn-default button' title='".LAN_PLUGIN_PHILLIS_202."' data-toggle='tooltip' data-placement='bottom' href='".e_PLUGIN_ABS."phillis/phillis_view.php?"."' title='".LAN_PLUGIN_PHILLIS_202."'>".PHLIS_ICON_csv.LAN_PLUGIN_PHILLIS_202."</a>";
return "<form action='' method='post'><button type='submit' name='expcsv' class='btn btn-default button' title='".LAN_PLUGIN_PHILLIS_202."' data-toggle='tooltip' data-placement='bottom' title='".LAN_PLUGIN_PHILLIS_202."'>".PHLIS_ICON_csv.LAN_PLUGIN_PHILLIS_202."</button></form>";


/*

  <h3>Exportação de Dados (PHP)</h3>

  <form action="" method="post">
   <button type="submit" name="exportar" class="btn btn-success">Exportar para CSV</button>
  </form>


/*
// Se o botão foi pressionado, exporta CSV
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exportar'])) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="dados.csv"');

    $dados = [
        ['Nome', 'Idade', 'Email'],
        ['João', 30, 'joao@email.com'],
        ['Maria', 25, 'maria@email.com']
    ];

    $output = fopen('php://output', 'w');
    foreach ($dados as $linha) {
        fputcsv($output, $linha);
    }
    fclose($output);
    exit;
}
*/



}

    function sc_phlis_saveedit($parm)
  {
  $phillis_shortcodesaction = getcachedvars('phillis_action');
  $phillis_shortcodesuserid = getcachedvars('phillis_userid');
  $phillis_shortcodesccount = getcachedvars('phillis_ccount');
  $phillis_shortcodesusername = getcachedvars('phillis_username');
  $phillis_shortcodescusername = getcachedvars('phillis_cusername');
$phillis_shortcodesedit = ($phillis_shortcodesccount?null:(USERID==$phillis_shortcodesuserid && getcachedvars('phillis_whatdo')=="ed"));

switch ($phillis_shortcodesaction) {
    case "u":
    case "n":
      $phillis_shortcodesview = $_SESSION{'phillis_view'}['n'];
      $phillis_shortcodesuser =(USERID==$phillis_shortcodesuserid);
      break;
    case "s":
    case "o":
      $phillis_shortcodesview = $_SESSION{'phillis_view'}['u'];
      $phillis_shortcodesuser =(USERID<>$phillis_shortcodesuserid);
      break;
}
$phillis_shortcodesusern = (USERID==$phillis_shortcodesuserid?$phillis_shortcodescusername:$phillis_shortcodesusername);

//var_dump ($phillis_shortcodesedit);
//var_dump ($phillis_shortcodesuserid);
//var_dump ($phillis_shortcodesccount);

$mes = e107::getMessage();

$mestype = "add".(($phillis_utext || $phillis_shortcodesedit==1)?($phillis_shortcodesedit==1 && !$phillis_utext?"Warning":($phllist_Ajaxerr?"Error":"Success")):"");

//$mes->addSuccess(($phillis_shortcodesedit==1 && !$phillis_utext?$tp->toHTML($this->pref['terms'], true):$phillis_utext));

//$mes->$mestype(($phillis_shortcodesedit==1 && !$phillis_utext?$tp->toHTML($this->pref['terms'], true):$phillis_utext));
$mes->$mestype(($phillis_shortcodesedit==1 && !$phillis_utext?$this->tp->toHTML($this->pref['terms'], true):$phillis_utext));

    if (isset($parm['msg'])){
      echo $mes->render();
      return;
////return (($phillis_utext || $phillis_shortcodesedit==1)?"<p><center><div id='dialog-content' class='".($phillis_shortcodesedit==1 && !$phillis_utext?"warning":($phllist_Ajaxerr?"error":"success"))."'>".($phillis_shortcodesedit==1 && !$phillis_utext?$tp->toHTML($this->pref['terms'], true):$phillis_utext)."</div></center>":"");
    }
return ((!is_null($phillis_shortcodesedit) && USERID==$phillis_shortcodesuserid && $phillis_shortcodesuserid>0)?"<a class='btn btn-default button' title='".($phillis_shortcodesedit==1?LAN_PLUGIN_PHILLIS_201:LAN_PLUGIN_PHILLIS_200)."' data-toggle='tooltip' data-placement='bottom' href='".e_PLUGIN_ABS."phillis/phillis_view.php?".str_replace(($phillis_shortcodesedit?"-":"."), ($phillis_shortcodesedit?".":"-"), e_QUERY)."' title='".($phillis_shortcodesedit==1?LAN_PLUGIN_PHILLIS_201:LAN_PLUGIN_PHILLIS_200)."'>".($phillis_shortcodesedit==1?PHLIS_ICON_save:PHLIS_ICON_edit)."</a>":"");
  }

  function sc_phlis_leg($parm)
  {
    if ((e107::getRegistry('phillis_action') == "n") || (e107::getRegistry('phillis_action') == "u") || (e107::getRegistry('phillis_ccount')?null:(USERID==e107::getRegistry('phillis_userid'))) && (e107::getRegistry('phillis_whatdo')=="ed")){
      return $this->tp->parsetemplate(e107::getTemplate('phillis', 'phillis_menu', 'leg'), true, $this); 	
//      return $phillis_template['leg'];
    }

    return null;
  }

  function sc_phlis_legcol($parm)
  {
    return ($_POST['phillis_vtype']=='x'?PHLIS_REPLXNUM:LAN_PLUGIN_PHILLIS_52);
  }

}

/* Antigo, para sair daqui.....

include_once(e_HANDLER.'shortcode_handler.php');
global $tp, $phillis_shortcodes;
$phil_shortcodes = array_merge ($phil_shortcodes, $tp -> e_sc -> parse_scbatch(__FILE__));
//$phil_shortcodes[LEGPARA] = $phillis_shortcodes[LEGPARA];
//var_dump($phillis_shortcodes[LEGPARA]);
//var_dump($phil_shortcodes[LEGPARA]);
/*
SC_BEGIN MENUTITLE
return phillis_01." - ".PHCAT_L02;
SC_END
SC_BEGIN MENUFILTER
  $phillis_scaction = getcachedvars('PHLIS_Action');
  $phillis_scview = getcachedvars('phillis_view');
//var_dump($phillis_scaction);
extract($pref['phillis_settings']);
//var_dump($allow_fviews);
//  $phillis_scviewarr = array("c" => array(phillis_42,"numcond"),"x" => array(phillis_43,"numcondplus"),"g" => array(phillis_21,"imggal"),"l" => array(phillis_22,"imglis"),"n" => array(phillis_23,"ednum"),"i" => array(phillis_24,"edimg"));
//var_dump($phillis_scviewarr);
//switch ($phillis_scaction) {
//    case "u":
//    case "n":
//      $allow_views = $allow_fviews;
//      break;
//    case "s":
//    case "o":
//      $allow_views = $allow_tviews;
//      break;
//}
  $phillis_scwhatdo = getcachedvars('phillis_whatdo');
//    $scallow_views = ($phillis_scwhatdo == "ed" ? $allow_eviews : $allow_views[$phillis_scaction]);
//    $allow_views = ($phillis_scaction == "n" || $phillis_scaction == "u") ? $allow_fviews : null;
//var_dump($phillis_scwhatdo);
//var_dump($allow_views);
//		foreach($allow_views as $key => $row)
  $allow_views = (getcachedvars('phillis_ccount')?null:$allow_views);
		foreach(($phillis_scwhatdo == "ed" ? $allow_eviews : $allow_views[$phillis_scaction]) as $key => $row)
		{
//var_dump($key);
				$text .= (array_key_exists($key, $views_icons)) ? "<a href='javascript:this.phfltform.LAN_PLUGIN_PHILLIS_vtype.value=\"".$key."\";this.phfltform.submit()' title='".$views_icons[$key][0]."' ><img src='images/view_".$views_icons[$key][1].($phillis_scview==$key?"":"off").".png'></a>&nbsp;" : "";
//var_dump($_SESSION{'phillis_view'});
//var_dump($_SESSION{'phillis_view'}==$key);
		}
return ($text?"<input type='hidden' name='phillis_vtype'/>".LAN_PLUGIN_PHILLIS_11.": ".$text:"");
//return (($phillis_scaction == "n" || $phillis_scaction == "u")?"<input type='hidden' name='phillis_vtype'/>".LAN_PLUGIN_PHILLIS_11.": "."<a href='javascript:this.phfltform.LAN_PLUGIN_PHILLIS_vtype.value=\"c\";this.phfltform.submit()' title='".LAN_PLUGIN_PHILLIS_42."' ><img src='images/view_numcond".(!$phillis_scview=="c"}?"":"off").".png'></a>&nbsp;<a href='javascript:this.phfltform.LAN_PLUGIN_PHILLIS_vtype.value=\"x\";this.phfltform.submit();' title='".LAN_PLUGIN_PHILLIS_43."' ><img src='images/view_numcondplus".($phillis_scview=="x"?"":"off").".png'></a>":"");
SC_END
SC_BEGIN MENULOADING
return "";
SC_END
SC_BEGIN MENUEND
Global $phillis_EDITLEGFALTAS, $LAN_PLUGIN_PHILLIS_EGFALTAS, $phillis_INILEG, $phillis_ENDLEG, $phillis_COMPLEG, $tp;
////////////////////////////preg_match("/\bphillis.php\b/i", e_SELF, $match);
//$phillis_temp = preg_split('/[.-]/', e_QUERY);
//$phillis_userid = abs(intval($phillis_temp[1]));
//$action = ($phillis_userid==0?"show":$phillis_temp[0]);
//$phillis_splitter = substr(e_QUERY, 1, 1);
//  $phillis_scwhatdo = getcachedvars('phillis_whatdo');
//  $phillis_sccuserid = getcachedvars('phillis_cuserid');
  $phillis_scaction = getcachedvars('PHLIS_Action');
  $phillis_scuserid = getcachedvars('phillis_userid');
  $phillis_scccount = getcachedvars('phillis_ccount');
  $phillis_scusername = getcachedvars('phillis_username');
  $phillis_sccusername = getcachedvars('phillis_cusername');
$phillis_scedit = ($phillis_scccount?null:(USERID==$phillis_scuserid && getcachedvars('phillis_whatdo')=="ed"));
//var_dump($phillis_scccount);
//var_dump($phillis_scedit);
//var_dump($sc_style);
//var_dump($phillis_shortcodes);
//var_dump($_SESSION{'phillis_view'});
//if ($action == "n" || $action == "u"){
//    $phillis_vtxti = phillis_11.": ";
//switch ($_SESSION{'phillis_view'}) {
//  case 'x':
//    $phillis_vximg = "off";
////    $phillis_vtxt .= phillis_42;
////    $phillis_vval = "";
//    break;
//  default:
//    $phillis_vimg = "condplus";
//    $phillis_vtxt .= phillis_43;
//    $phillis_vval = "x";
//   }
//}
switch ($phillis_scaction) {
    case "u":
    case "n":
      $phillis_scview = $_SESSION{'phillis_view'}[0];
      $phillis_scuser =(USERID==$phillis_scuserid);
      break;
    case "s":
    case "o":
      $phillis_scview = $_SESSION{'phillis_view'}[1];
      $phillis_scuser =(USERID<>$phillis_scuserid);
      break;
}
$phillis_scusern = (USERID==$phillis_scuserid?$phillis_sccusername:$phillis_scusername);
////return ((!is_null($phillis_scedit) && USERID==$phillis_scuserid && $phillis_scuserid>0)?"<p><center><a href='".e_PLUGIN_ABS."phil_lis/phillis.php?".str_replace(($phillis_scedit?"-":"."), ($phillis_scedit?".":"-"), e_QUERY)."' title='".($phillis_scedit==1?phillis_201:phillis_200)."'><img src='images/list_".($phillis_scedit==1?"save":"edit").".png'/>&nbsp;&nbsp;".($phillis_scedit==1?phillis_201:phillis_200)."</a></center>".(($phillis_utext || $phillis_scedit==1)?"<p><center><div id='dialog-content' class='".($phillis_scedit==1 && !$phillis_utext?"warning":($phllist_Ajaxerr?"error":"success"))."'>".($phillis_scedit==1 && !$phillis_utext?phillis_300.(($phillis_scaction == "s" || $phillis_scaction == "o")?phillis_302:phillis_301):$phillis_utext)."</div></center>":""):"").(($phillis_scaction == "n" || $phillis_scaction == "u" || $phillis_edit)?"<div id='dialog-content' style='padding: 0px;'>".($phillis_scedit?$phillis_EDITLEGFALTAS:$LAN_PLUGIN_PHILLIS_EGFALTAS)."</div>":"");
//extract($pref['phillis_settings']);
return ((!is_null($phillis_scedit) && USERID==$phillis_scuserid && $phillis_scuserid>0)?"<p><center><a href='".e_PLUGIN_ABS."phil_lis/phillis.php?".str_replace(($phillis_scedit?"-":"."), ($phillis_scedit?".":"-"), e_QUERY)."' title='".($phillis_scedit==1?phillis_201:phillis_200)."'><img src='images/list_".($phillis_scedit==1?"save":"edit").".png'/>&nbsp;&nbsp;".($phillis_scedit==1?phillis_201:phillis_200)."</a></center>".(($phillis_utext || $phillis_scedit==1)?"<p><center><div id='dialog-content' class='".($phillis_scedit==1 && !$phillis_utext?"warning":($phllist_Ajaxerr?"error":"success"))."'>".($phillis_scedit==1 && !$phillis_utext?$tp->toHTML($pref['phillis_settings']['terms'], true):$phillis_utext)."</div></center>":""):"").($phillis_scccount?"<p><strong><div class='successheader'><center>".LAN_PLUGIN_PHILLIS_90." ".LAN_PLUGIN_PHILLIS_76."</center></div><div class='success'><mark>".($phillis_scuser?phillis_68." ".$phillis_scusern." ".lcfirst(phillis_75):phillis_75)." ".$phillis_scccount." ".lcfirst(phillis_90)." ".LAN_PLUGIN_PHILLIS_76." ".($phillis_scuser?phillis_69:phillis_74." ".$phillis_scusern)."</mark></div></strong><p>":"").$tp->parsetemplate(($phillis_scaction == "n" || $phillis_scaction == "u" || $phillis_scedit)?"<div id='dialog-content' style='padding: 0px;'>".$phillis_INILEG.($phillis_scccount?$phillis_COMPLEG:"").($phillis_scedit?$phillis_EDITLEGFALTAS:$LAN_PLUGIN_PHILLIS_EGFALTAS[$phillis_scview]).$phillis_ENDLEG."</div>":"");
SC_END
SC_BEGIN POST
global $post_info, $tp, $iphost;
$ret = "";
$ret = $tp->toHTML($post_info["thread_thread"], TRUE, "USER_BODY", 'class:'.$post_info["user_class"]);
if (ADMIN && $iphost) {
$ret .= "<br />".$iphost;
}
return $ret;
SC_END
SC_BEGIN PRIVMESSAGE
global $pref, $post_info, $tp;
if(isset($pref['plug_installed']['pm']) && ($post_info['user_id'] > 0))
{
	return $tp->parseTemplate("{SENDPM={$post_info['user_id']}}");
}
SC_END
SC_BEGIN AVATAR
global $post_info;
if ($post_info['user_id']) {
if ($post_info["user_image"]) {
require_once(e_HANDLER."avatar_handler.php");
return "<div class='spacer'><img src='".avatar($post_info['user_image'])."' alt='' /></div><br />";
} else {
return "";
}
} else {
return "<span class='smallblacktext'>".LAN_194."</span>";
}
SC_END
SC_BEGIN ANON_IP
global $post_info;
//die($post_info['thread_user']);
$x = explode(chr(1), $post_info['thread_user']);
if($x[1] && ADMIN)
{
	return $x[1];
}
SC_END
SC_BEGIN POSTER
global $post_info, $tp;
if($post_info['user_name'])
{
	return "<a href='".e_BASE."user.php?id.".$post_info['user_id']."'><b>".$post_info['user_name']."</b></a>";
}
else
{
	$x = explode(chr(1), $post_info['thread_user']);
	$tmp = explode(".", $x[0], 2);
	if(!$tmp[1])
	{
		return FORLAN_103;
	}
	else
	{
		return "<b>".$tp->toHTML($tmp[1])."</b>";
	}
}
SC_END
SC_BEGIN EMAILIMG
global $post_info;
if(USER && $post_info['user_id'] && !$post_info['user_hideemail'])
{
	return "<a href='mailto:{$post_info['user_email']}'>".IMAGE_email."</a>";
}
return '';
SC_END
SC_BEGIN EMAILITEM
global $post_info, $tp;
if($post_info['thread_parent'] == 0)
{
	return $tp->parseTemplate("{EMAIL_ITEM=".FORLAN_101."^plugin:forum.{$post_info['thread_id']}}");
}
SC_END
SC_BEGIN PRINTITEM
global $post_info, $tp;
if($post_info['thread_parent'] == 0)
{
	return $tp->parseTemplate("{PRINT_ITEM=".FORLAN_102."^plugin:forum.{$post_info['thread_id']}}");
}
SC_END
SC_BEGIN SIGNATURE
global $post_info, $tp;
if ($post_info['user_forums'] >= $pref['forum_posts_sig'] && check_class($pref['forum_class_sig'], $post_info['user_class'])) {
return ($post_info['user_signature'] ? "<br /><hr style='width:15%; text-align:left' /><span class='smalltext'>".$tp->toHTML($post_info['user_signature'],TRUE)."</span>" : "");
}
SC_END
SC_BEGIN PROFILEIMG
global $post_info, $tp;
if (USER && $post_info['user_id']) {
return $tp->parseTemplate("{PROFILE={$post_info['user_id']}}");
} else {
return "";
}
SC_END
SC_BEGIN POSTS
global $post_info;
if ($post_info['user_id']) {
return LAN_67.": ".$post_info['user_forums']."<br />";
}
SC_END
SC_BEGIN VISITS
global $post_info;
if ($post_info['user_id']) {
return LAN_09.": ".$post_info['user_visits']."<br />";
}
SC_END
SC_BEGIN EDITIMG
global $post_info, $thread_info, $thread_id;
if ($post_info['user_id'] != '0' && $post_info['user_name'] === USERNAME && $thread_info['head']['thread_active']) {
return "<a href='forum_post.php?edit.".$post_info['thread_id']."'>".IMAGE_edit."</a> ";
} else {
return "";
}
SC_END
SC_BEGIN CUSTOMTITLE
global $post_info, $tp;
if ($post_info['user_customtitle']) {
return $tp->toHTML($post_info['user_customtitle'])."<br />";
}
SC_END
SC_BEGIN WEBSITE
global $post_info, $tp;
if ($post_info['user_homepage']) {
return LAN_08.": ".$post_info['user_homepage']."<br />";
}
SC_END
SC_BEGIN WEBSITEIMG
global $post_info;
if ($post_info['user_homepage'] && $post_info['user_homepage'] != "http://") {
return "<a href='{$post_info['user_homepage']}'>".IMAGE_website."</a>";
}
SC_END
SC_BEGIN QUOTEIMG
global $thread_info, $post_info, $forum_info;
if (check_class($forum_info['forum_postclass']) && check_class($forum_info['parent_postclass']) && $thread_info["head"]["thread_active"]) {
return "<a href='".e_PLUGIN."forum/forum_post.php?quote.{$post_info['thread_id']}'>".IMAGE_quote."</a>";
}
SC_END
SC_BEGIN REPORTIMG
global $post_info, $from;
if (USER) {
return "<a href='".e_PLUGIN."forum/forum_viewtopic.php?{$post_info['thread_id']}.{$from}.report'>".IMAGE_report."</a> ";
}
SC_END
SC_BEGIN RPG
global $post_info;
return rpg($post_info['user_join'],$post_info['user_forums']);
SC_END
SC_BEGIN MEMBERID
global $post_info, $ldata, $pref, $forum_info;
if ($post_info['anon']) {
return "";
}
$fmod = ($post_info['user_class'] != "" && check_class($forum_info['forum_moderators'], $post_info['user_class'], TRUE));
if(!$fmod && $forum_info['forum_moderators'] == e_UC_ADMIN)
{
	$fmod = $post_info['user_admin'];
}
if (!array_key_exists($post_info['user_id'],$ldata)) {
	$ldata[$post_info['user_id']] = get_level($post_info['user_id'], $post_info['user_forums'], $post_info['user_comments'], $post_info['user_chats'], $post_info['user_visits'], $post_info['user_join'], $post_info['user_admin'], $post_info['user_perms'], $pref, $fmod);
}
return $ldata[$post_info['user_id']][0];
SC_END
SC_BEGIN LEVEL
global $post_info, $ldata, $pref, $forum_info;
if ($post_info['anon']) {
return "";
}
$fmod = ($post_info['user_class'] != "" && check_class($forum_info['forum_moderators'], $post_info['user_class'], TRUE));
if(!$fmod && $forum_info['forum_moderators'] == e_UC_ADMIN)
{
	$fmod = $post_info['user_admin'];
}
if (!array_key_exists($post_info['user_id'],$ldata)) {
$ldata[$post_info['user_id']] = get_level($post_info['user_id'], $post_info['user_forums'], $post_info['user_comments'], $post_info['user_chats'], $post_info['user_visits'], $post_info['user_join'], $post_info['user_admin'], $post_info['user_perms'], $pref, $fmod);
}
if($parm == 'pic')
{
return $ldata[$post_info['user_id']]['pic'];
}
if($parm == 'name')
{
return $ldata[$post_info['user_id']]['name'];
}
if($parm == 'special')
{
return $ldata[$post_info['user_id']]['special'];
}
if($parm == 'userid')
{
return $ldata[$post_info['user_id']]['userid'];
}
return $ldata[$post_info['user_id']][1];
SC_END
SC_BEGIN MODOPTIONS
if (MODERATOR) {
return showmodoptions();
}
SC_END
SC_BEGIN LASTEDIT
global $post_info, $gen;
if ($post_info['thread_edit_datestamp']) {
return $gen->convert_date($post_info['thread_edit_datestamp'],'forum');
}
return "";
SC_END
SC_BEGIN POLL
global $pollstr;
return $pollstr;
SC_END
SC_BEGIN NEWFLAG
// Defined in case an indicator is required
return '';
SC_END
*/
