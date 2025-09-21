<?php
//ECHO "SC LIST";
// ########################################################################################
// O ficheiro tem de ficar com este nome por causa da treta da rotina interna dos shortcodes do e107
// ########################################################################################
if (!defined('e107_INIT')) { exit; }
//echo "<hr>SHORTCODES CARREGADOS???<HR>";
//include_once(e_HANDLER.'shortcode_handler.php');
//global $tp;
//$phillis_shortcodes = $tp -> e_sc -> parse_scbatch(__FILE__);
class phillis_shortcodes extends e_shortcode
{
  protected	$pref;
//  public		$phillissRow;
  function __construct()
	{
//		$philliss_prefs = e107::getPref('phillis_settings');
	  $this->pref = e107::getPlugPref('phillis');
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
// SHORTCODES PARA phillisS.PHP (listagem listas de todos)
// ##############################################################
    function sc_phlis_mainlineclass()
  {
//	  $this->phillisRow = getcachedvars('phillis_tables_row');
//	  $this->phillisRow = e107::getRegistry('phillis_tables_row');
//		  print_a(getcachedvars('phillis_tables_row'));
//parent::__construct();
//  $phillis_tables_row = getcachedvars('phillis_tables_row');
//global $phillis_tables_row;
/*
  if ($this->phillisRow['user_id']==USERID) {
    $phillis_shortcodestext = " current";
  }
return $phillis_shortcodestext;
*/
//var_dump($this->var['phillis_row_data']);
return ($this->var['phillis_row_data']['user_id']==USERID)?" userlist":"";
}
    function sc_phlis_username()
  {
//global $gstyle_obj;
//var_dump (user_id);
//  $phillis_tables_row = getcachedvars('phillis_tables_row');
//var_dump ($user_list);
//if ($parm == 1) {
//return $gstyle_obj->showUser($user_list[0][user_id]);
//   }
//   else
//    {
//    return $gstyle_obj->showUser($this->phillisRow[user_id]);
//    return e107::getEvent()->trigger("showuser", );
//return e107::getSystemUser($this->phillisRow[user_id])->getName();
//    }
//RETURN "<HR><HR>";
//  	$uparams = array('id' => $this->phillisRow[user_id], 'name' => $this->phillisRow[user_name]);
//var_dump ($this->phillisRow['user_id']);
  		return "<a href='".e107::getUrl()->create('user/profile/view', array('id' => $this->var['phillis_row_data']['user_id'], 'name' => $this->var['phillis_row_data']['user_name']))."'>".
      e107::getParser()->toAvatar($this->var['phillis_row_data'], array('shape' => 'circle', 'h' => 16, 'w' => 16)).
      "&nbsp;".
      $this->var['phillis_row_data']['user_name'].
      "</a>";
  }
    function sc_phlis_listdata($parm)
  {
//global $phillis_tables_row;
//  $phillis_tables_row = getcachedvars('phillis_tables_row');
//extract($pref['phillis_settings']);
//var_dump ($user_list);
//var_dump ($pref['phillis_settings']['compare']);
//var_dump (array_keys($pref['phillis_settings']['compare']));
//$tmp = check_class(implode(",",array_keys($pref['phillis_settings']['compare'])));
//var_dump ($tmp);
//switch ($parm) {
//  case 'n':
//    $phillis_shortcodesquant = $phillis_tables_row[nfltcount];
//    $phillis_shortcodesdataact = $phillis_tables_row[afltn];
//    break;
//  case 'u':
//    $phillis_shortcodesquant = $phillis_tables_row[ufltcount];
//    $phillis_shortcodesdataact = $phillis_tables_row[afltu];
//    break;
//  case 'o':
//    $phillis_shortcodesquant = $phillis_tables_row[ntrccount];
//    $phillis_shortcodesdataact = $phillis_tables_row[atrcn];
//    break;
//  case 's':
//    $phillis_shortcodesquant = $phillis_tables_row[utrccount];
//    $phillis_shortcodesdataact = $phillis_tables_row[atrcu];
//    break;
//   }
//extract($this->phillisRow);
//$scarr = array(n=>array($nfltcount,$afltn,o), u=>array($ufltcount,$afltu,s), o=>array($ntrccount,$atrcn,n), s=>array($utrccount,$atrcu,u));
$scarr = array('n'=>array('nfltcount','afltn','o', LAN_PLUGIN_PHILLIS_112." ".strtolower(LAN_PLUGIN_PHILLIS_82)), 'u'=>array('ufltcount','afltu','s', LAN_PLUGIN_PHILLIS_112." ".strtolower(LAN_PLUGIN_PHILLIS_83)), 'o'=>array('ntrccount','atrcn','n', LAN_PLUGIN_PHILLIS_113." ".strtolower(LAN_PLUGIN_PHILLIS_82)), 's'=>array('utrccount','atrcu','u', LAN_PLUGIN_PHILLIS_113." ".strtolower(LAN_PLUGIN_PHILLIS_83)));
//var_dump ($parm);
//var_dump ($scarr);
//var_dump (array_intersect_key($scarr, $parm));
//echo "<hr>";
/*
       if(isset($scarr[$parm])){
        $phillis_shortcodesquant = $scarr[$parm][0];
        $phillis_shortcodesdataact = $scarr[$parm][1];
        $phillis_shortcodesrevparm = $scarr[$parm][2];
        }
*/
/*
       if(isset($scarr[$parm])){
        $phillis_shortcodesquant = $this->phillisRow[$scarr[$parm][0]];
        $phillis_shortcodesdataact = $this->phillisRow[$scarr[$parm][1]];
        $phillis_shortcodesrevparm = $this->phillisRow[$scarr[$parm][2]];
        }
*/
/*
echo "<pre>";
var_dump($parm);
*/
$parm[$this->var['phillis_row_data']['source']]="";
/*
var_dump($parm);
echo "</pre>";
*/
$intarray = array_intersect_key($scarr, $parm);
    $arrkey = key($intarray);
//       if(isset($scarr[$parm])){
/*
        $phillis_shortcodesquant = $this->var['phillis_row_data'][$intarray[$arrkey][0]];
        $phillis_shortcodesdataact = $this->var['phillis_row_data'][$intarray[$arrkey][1]];
        $phillis_shortcodesrevparm = $this->var['phillis_row_data'][$intarray[$arrkey][2]];
*/
//        }
/*
echo "<pre>";
var_dump($intarray);
echo "</pre>";
*/
//    $phillis_shortcodesuserid = $phillis_tables_row[user_id];
//      $phillis_shortcodesurl = e_PLUGIN."phil_lis/phillis.php";
//    define(phillis_SCURL, e_PLUGIN."phil_lis/phillis_view.php");

///    $phillis_scurl = e_PLUGIN."phillis/phillis_view.php";

//    return "<a title='".($phillis_shortcodesquant>0?phillis_15:(USERID==$phillis_tables_row[user_id]?phillis_10:""))." ".LAN_PLUGIN_PHILLIS_38."' href='".e_SELF."?".$parm.($phillis_shortcodesquant>0?".":(USERID==$phillis_tables_row[user_id]?"-":".")).$phillis_tables_row[user_id]."'>".($phillis_shortcodesquant>0?$phillis_shortcodesquant." ".LAN_PLUGIN_PHILLIS_110:(USERID==$phillis_tables_row[user_id]?phillis_10." ".LAN_PLUGIN_PHILLIS_38:""))."</a>".($phillis_shortcodesdataact>0?"<br><span class='smalltext' title='".LAN_PLUGIN_PHILLIS_100.$phillis_shortcodesdataact."'>(".$phillis_shortcodesdataact.")</span>":"").((USERID && USERID!=$phillis_tables_row[user_id] && $phillis_shortcodesquant>0)?((USERID)?"<div class='trc'><a href='".e_SELF."?".$parm.".".$phillis_tables_row[user_id].".".USERID."'><img title='".LAN_PLUGIN_PHILLIS_16.(($parm == 'o' || $parm == 's')?phillis_34:phillis_35)."' src='images/compare.png'></a></div>":""):"");
//echo "<hr>";
//    var_dump (USERID);
//    var_dump ($phillis_tables_row[user_id]);
//    var_dump ($phillis_shortcodesquant);
//    var_dump (check_class(implode(",",array_keys($pref['phillis_settings']['compare']))));
//    print_a ($this->pref[compare]);
//    print_a (implode(",",$this->pref[compare]));
//    print_a (check_class(implode(",",array_keys($this->pref[compare]))));
//extract(e107::getPref('phillis_settings'));
//    return "<a title='".($phillis_shortcodesquant>0?phillis_15:(USERID==$user_id?phillis_10:""))." ".LAN_PLUGIN_PHILLIS_38."' href='".LAN_PLUGIN_PHILLIS_scurl."?".$parm.($phillis_shortcodesquant>0?".":(USERID==$user_id?"-":".")).$user_id."'>".($phillis_shortcodesquant>0?$phillis_shortcodesquant." ".LAN_PLUGIN_PHILLIS_110:(USERID==$user_id?phillis_10." ".LAN_PLUGIN_PHILLIS_38:""))."</a>".($phillis_shortcodesdataact>0?"<br><span class='smalltext' title='".LAN_PLUGIN_PHILLIS_100.$phillis_shortcodesdataact."'>(".$phillis_shortcodesdataact.")</span>":"").((USERID && USERID!=$user_id && $phillis_shortcodesquant>0 && check_class(implode(",",array_keys($pref['phillis_settings']['compare']))))?"<div class='trc'><a href='".LAN_PLUGIN_PHILLIS_scurl."?".$phillis_shortcodesrevparm.".".USERID."|".$user_id."'><img title='".LAN_PLUGIN_PHILLIS_16.(($parm == 'o' || $parm == 's')?phillis_34:phillis_35)."' src='images/compare.png'></a></div>":"");
//    return "<a title='".($phillis_shortcodesquant>0?phillis_15:(USERID==$user_id?phillis_10:""))." ".LAN_PLUGIN_PHILLIS_38."' href='".LAN_PLUGIN_PHILLIS_scurl."?".$parm.($phillis_shortcodesquant>0?".":(USERID==$user_id?"-":".")).$user_id."'>".($phillis_shortcodesquant>0?$phillis_shortcodesquant." ".LAN_PLUGIN_PHILLIS_110:(USERID==$user_id?phillis_10." ".LAN_PLUGIN_PHILLIS_38:""))."</a>".($phillis_shortcodesdataact>0?"<br><span class='smalltext' title='".LAN_PLUGIN_PHILLIS_100.$phillis_shortcodesdataact."'>(".$phillis_shortcodesdataact.")</span>":"").((USERID && USERID!=$user_id && $phillis_shortcodesquant>0 && check_class(implode(",",array_keys($this->pref[compare]))))?"<div class='trc'><a href='".LAN_PLUGIN_PHILLIS_scurl."?".$phillis_shortcodesrevparm.".".USERID."|".$user_id."'><img title='".LAN_PLUGIN_PHILLIS_16.(($parm == 'o' || $parm == 's')?phillis_34:phillis_35)."' src='images/compare.png'></a></div>":"");
//SPRITE ICONS
/*
echo "<hr>";
var_dump ((USERID && USERID!=$user_id && $phillis_shortcodesquant>0 && check_class($this->pref['allow_compare'])));
echo " - ";
var_dump (USERID!=$user_id);
echo " - ";
var_dump ($phillis_shortcodesquant>0);
echo " - ";
var_dump (check_class(implode(",",$this->pref['allow_compare'])));
echo " - ";
var_dump (check_class($this->pref['allow_compare']));
echo " - ";
var_dump ($this->pref['allow_compare']);
*/

//    return "<a title='".($phillis_shortcodesquant>0?LAN_PLUGIN_PHILLIS_15:(USERID==$user_id?LAN_PLUGIN_PHILLIS_10:""))." ".LAN_PLUGIN_PHILLIS_38."' href='".phillis_SCURL."?".$parm.($phillis_shortcodesquant>0?".":(USERID==$user_id?"-":".")).$user_id."'>".($phillis_shortcodesquant>0?$phillis_shortcodesquant." ".LAN_PLUGIN_PHILLIS_110:(USERID==$user_id?LAN_PLUGIN_PHILLIS_10." ".LAN_PLUGIN_PHILLIS_38:""))."</a>".($phillis_shortcodesdataact>0?"<br><span class='smalltext' title='".LAN_PLUGIN_PHILLIS_100.$phillis_shortcodesdataact."'>(".$phillis_shortcodesdataact.")</span>":"").((USERID && USERID!=$user_id && $phillis_shortcodesquant>0 && check_class($this->pref['allow_compare']))?"<div class='trc'><a href='".phillis_SCURL."?".$phillis_shortcodesrevparm.".".USERID."|".$user_id."' class='phillis_icon' id='compare' title='".LAN_PLUGIN_PHILLIS_16.(($parm == 'o' || $parm == 's')?LAN_PLUGIN_PHILLIS_34:LAN_PLUGIN_PHILLIS_35)."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></div>":"");
//var_dump ($this->phillisRow[user_id]);
//echo "<hr>";
/*
    return "<div><a title='".($phillis_shortcodesquant>0?LAN_PLUGIN_PHILLIS_15:(USERID==$this->phillisRow[user_id]?LAN_PLUGIN_PHILLIS_10:""))." ".LAN_PLUGIN_PHILLIS_38."' href='".$phillis_scurl."?".$parm.($phillis_shortcodesquant>0?".":(USERID==$this->phillisRow[user_id]?"-":".")).$this->phillisRow[user_id]."'>".($phillis_shortcodesquant>0?$phillis_shortcodesquant." ".LAN_PLUGIN_PHILLIS_110:(USERID==$this->phillisRow[user_id]?LAN_PLUGIN_PHILLIS_10." ".LAN_PLUGIN_PHILLIS_38:""))."</a>".($phillis_shortcodesdataact>0?"<br><span class='smalltext' title='".LAN_PLUGIN_PHILLIS_100.$phillis_shortcodesdataact."'>(".$phillis_shortcodesdataact.")</span></div>":"").((USERID && USERID!=$this->phillisRow[user_id] && $phillis_shortcodesquant>0 && check_class($this->pref['allow_compare']))?"<div class='trc btn btn-default'><a href='".$phillis_scurl."?".$phillis_shortcodesrevparm.".".USERID."|".$this->phillisRow[user_id]."' title='".LAN_PLUGIN_PHILLIS_16.(($parm == 'o' || $parm == 's')?LAN_PLUGIN_PHILLIS_34:LAN_PLUGIN_PHILLIS_35)."'>".PHLIS_ICON_compare."</a></div>":"");
*/
/*
var_dump ($intarray);
echo "           =          ";
var_dump (key($intarray));
echo "           -----------          ";
var_dump ($intarray[key($intarray)][0]);
echo "           -----------          ";
var_dump ($intarray[key($intarray)][1]);
echo "           -----------          ";
var_dump ($intarray[key($intarray)][2]);
echo "<hr>";
*/
//    $text = (isset($parm['date'])?($phillis_shortcodesdataact>0?$phillis_shortcodesdataact:null):($phillis_shortcodesquant>0?$phillis_shortcodesquant." ".LAN_PLUGIN_PHILLIS_110:null));

//    $button = !$text(USERID==$this->phillisRow[user_id]?LAN_PLUGIN_PHILLIS_10." ".LAN_PLUGIN_PHILLIS_38:null);

//    $arrkey = key($intarray);
//$phillis_scurl = e_BASE ."phillis_view"; 
//e107::url('philcat', 'item', array('id'=>$this->var['cod']))
/*
var_dump ($this->var['phillis_row_data']);
echo "<hr>";
*/
    if ($text = isset($parm['date'])?($this->var['phillis_row_data'][$intarray[$arrkey][1]]>0?$this->var['phillis_row_data'][$intarray[$arrkey][1]]:null):($this->var['phillis_row_data'][$intarray[$arrkey][0]]>0?$this->var['phillis_row_data'][$intarray[$arrkey][0]]." ".LAN_PLUGIN_PHILLIS_110:null)) {
//      return "<a title='".LAN_PLUGIN_PHILLIS_15."' href='".$phillis_scurl."?".$arrkey.".".$this->var['phillis_row_data']['user_id']."'>".$text."</a>".((USERID && USERID!=$this->var['phillis_row_data']['user_id'] && check_class($this->pref['allow_compare']) && !isset($parm['date']))?"&nbsp;<button class='trc btn btn-default' title='".LAN_PLUGIN_PHILLIS_16.(($arrkey == 'o' || $arrkey == 's')?LAN_PLUGIN_PHILLIS_34:LAN_PLUGIN_PHILLIS_35)."'><a href='".$phillis_scurl."?".$phillis_shortcodesrevparm.".".USERID."|".$this->var['phillis_row_data']['user_id']."'>".PHLIS_ICON_compare."</a></button>":"");
      return "<a title='".LAN_PLUGIN_PHILLIS_15."' href='".e107::url('phillis', 'view', array('id'=>$arrkey.".".$this->var['phillis_row_data']['user_id']))."'>".$text."</a>".((USERID && USERID!=$this->var['phillis_row_data']['user_id'] && check_class($this->pref['allow_compare']) && !isset($parm['date']))?"&nbsp;<button class='trc btn btn-default' title='".LAN_PLUGIN_PHILLIS_16.(($arrkey == 'o' || $arrkey == 's')?LAN_PLUGIN_PHILLIS_34:LAN_PLUGIN_PHILLIS_35)."'><a href='".e107::url('phillis', 'view', array('id'=>$this->var['phillis_row_data'][$intarray[$arrkey][2]].".".USERID."|".$this->var['phillis_row_data']['user_id']))."'>".$text."</a>"."'>".PHLIS_ICON_compare."</a></button>":"");

    }
    elseif ($button = (!$text && !isset($parm['date']))?(USERID==$this->var['phillis_row_data']['user_id']?LAN_PLUGIN_PHILLIS_10:null):null)
    {
//      return "<a title='".LAN_PLUGIN_PHILLIS_10."' href='".$phillis_scurl."?".$arrkey.".".$this->var['phillis_row_data']['user_id']."&action=edit'>".$button."</a>";
      return "<a class='btn btn-primary icon-new' title='".LAN_PLUGIN_PHILLIS_10."' href='".e107::url('phillis', 'edit', array('id'=>$arrkey.".".$this->var['phillis_row_data']['user_id']))."'>".$button."</a>";
    }
    elseif ($parm['layout']=="home")
    {
      if ($parm['output']=="data") return $this->var['phillis_row_data']['data'];
/*
      var_dump($text);
      var_dump($intarray[$arrkey][3]);
*/
/*
var_dump($this->var['phillis_row_data']);
echo "<hr>";
var_dump($intarray[$arrkey][1]);
*/
      return "<a title='".LAN_PLUGIN_PHILLIS_15."' href='".e107::url('phillis', 'view', array('id'=>$arrkey.".".$this->var['phillis_row_data']['user_id']))."'>".($text??$intarray[$arrkey][3])."</a>";
    }
//    return "<a title='".($phillis_shortcodesquant>0?LAN_PLUGIN_PHILLIS_15:(USERID==$this->phillisRow[user_id]?LAN_PLUGIN_PHILLIS_10:""))." ".LAN_PLUGIN_PHILLIS_38."' href='".$phillis_scurl."?".$arrkey.($phillis_shortcodesquant>0?".":(USERID==$this->phillisRow[user_id]?"-":".")).$this->phillisRow[user_id]."'>".$text."</a>".((USERID && USERID!=$this->phillisRow[user_id] && $phillis_shortcodesquant>0 && check_class($this->pref['allow_compare']) && !isset($parm['date']))?"&nbsp;<button class='trc btn btn-default' title='".LAN_PLUGIN_PHILLIS_16.(($arrkey == 'o' || $arrkey == 's')?LAN_PLUGIN_PHILLIS_34:LAN_PLUGIN_PHILLIS_35)."'><a href='".$phillis_scurl."?".$phillis_shortcodesrevparm.".".USERID."|".$this->phillisRow[user_id]."'>".PHLIS_ICON_compare."</a></button>":"");
    return null;

/// ARRANJAR FORMA DE METER AQUI UM CONTADOR PARA AS QUANTIDADES DE SELOS QUE TEM PARA TROCAR...
}
    function sc_phlis_listclass()
  {
//global $action;
//var_dump($what_tmp);
//var_dump($phillis_shortcodesaction);
//echo "<hr>".$type."<hr>";
  $phillis_shortcodeswhatdo = getcachedvars('phillis_whatdo');
  $phillis_shortcodesaction = getcachedvars('PHLIS_Action');
//var_dump($itme);
//var_dump($phillis_shortcodeswhatdo);
//var_dump($phillis_shortcodesaction);
//  return (($phillis_shortcodesaction == "o" || $phillis_shortcodesaction == "s")?($phillis_shortcodeswhatdo=="ed"?"":" class='list_img'"):"");
  return (($phillis_shortcodesaction == "o" || $phillis_shortcodesaction == "s")?($phillis_shortcodeswhatdo=="ed"?"":"list_img"):"");
}

function sc_phlis_listtotal()
{
//global $action;
//var_dump($what_tmp);
//var_dump($phillis_shortcodesaction);
//echo "<hr>".$type."<hr>";
//$phillis_shortcodeswhatdo = getcachedvars('phillis_whatdo');
//$phillis_shortcodesaction = getcachedvars('PHLIS_Action');
//var_dump($itme);
//var_dump($phillis_shortcodeswhatdo);
//var_dump($phillis_shortcodesaction);
//  return (($phillis_shortcodesaction == "o" || $phillis_shortcodesaction == "s")?($phillis_shortcodeswhatdo=="ed"?"":" class='list_img'"):"");
return $this->var['phillis_row_data']['total_quant'];
}
}