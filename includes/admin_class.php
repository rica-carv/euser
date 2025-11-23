<?php

// Generated e107 Plugin Admin Area 

/*
require_once('../../class2.php');
*/
//var_dump ("tetererererer");
//var_dump (!getperms('P'));
if (!getperms('P')) 
{
	e107::redirect('admin');
	exit;
}

class euser_admin
{
function render_expandedcontainer ($parent, $data_array) {

//!vartrue($pref['membersonly_enabled']) ? "e-hideme" : "";

//					$this->prefs['new_icon']['writeParms']['post'] = "<div class='e-expandit-container ".(e107::getPlugPref('euser')['new_icon']==0?"e-hideme":"")."'><span class='form-inline'>".$new_icontype['title']." ".$frm->renderElement('new_icontype', e107::getPlugPref('euser')['new_icontype'], $new_icontype)."</span></div>";
//$model = $this->getModel();

foreach ($data_array as $key => $value){

  $cell = $value['cell']?:'span';
//var_dump ($cell);
//$frm = e107::getForm();
// $text .= ($value['writeParms']['class']='hidden'?"":"<".$cell." class='form-inline'>".$value['title']." </".$cell.">");
//  $text .= "<".$cell." class='form-inline'>".$value['title']." </".$cell.">";
//  $text .= "<".$cell.">".e107::getForm()->renderElement($key, e107::getPlugPref('euser')[$key], $value)."</".$cell.">";
  $text .= $value['cell']=="td"?"<tr>":"";
  $text .= $value['title']?"<".$cell." class='form-inline'>".$value['title']."&nbsp;":"";
  $text .= $value['cell']=="td"?"</td><td class='form-inline text-center'>":"";
  $text .= e107::getForm()->renderElement($key, e107::getPlugPref('euser')[$key], $value);

//--------  $text .= $this->getUI()->renderCreateFieldset($key, $value, $model, $tab=0);

//				$rightCell = $this->renderElement($keyName, $model->getIfPosted($valPath), $att, varset($model_required[$key], array()), $model->getId())." {$help}";

  $text .= $value['title']?"</".$cell.">":"";
  $text .= $value['cell']=="td"?"</tr>":"";
//var_dump ($value['title']);
//echo "<hr>";
//-- Por enquanto fica assim, mete-me um br antes da table....  $text .= $value['title']?'<br>':'';
}

//var_dump ($text);
//var_dump ($parent);
//var_dump (e107::getPlugPref('euser')[$parent]);
//var_dump (vartrue(e107::getPlugPref('euser')[$parent]));
//var_dump (empty(e107::getPlugPref('euser')[$parent]));
//return "<div class='e-expandit-container ".!vartrue(e107::getPlugPref('euser')[$parent]) ? "e-hideme" : "")."'><span class='form-inline'>".$data_array['title']." ".$frm->renderElement($key_array, e107::getPlugPref('euser')[$key_array], $data_array)."</span></div>";
//-----return "<div class='e-expandit-container ".(!vartrue(e107::getPlugPref('euser')[$parent]) ? "e-hideme" : "")."'>".$text."</div>";
return "<div>".$text."</div>";

} 

function label_installed ($plug, $notinstalledbutton = null) {

e107::coreLan('plugin', true);

			if(is_null($notinstalledbutton)){
        $labeltype = "danger";
//        $labeltext = LAN_INSTALLED;
//        $labeltext = LANG_LAN_05;
        $labeltext = EPL_ADLAN_23;
      }

			if(e107::isInstalled($plug))
			{
//				$fields['deleteme']['writeParms']['post'] = " <span class='label label-important label-danger'>".LANG_LAN_05."</span>";
        $labeltype = "success";
//        $labeltext = LAN_INSTALLED;
        $labeltext = EPL_ADLAN_22;
			}

      $text = "<span class='label label-important label-".$labeltype."'>".$labeltext."</span>";

      return (e107::isInstalled($plug)?$text:($notinstalledbutton?euser_admin::linkbutton("../../e107_admin/plugin.php", EPL_ADLAN_70."&nbsp;".LAN_EUSER_ADMIN_CLICKHERESTART.LAN_EUSER_ADMIN_GOTO.ADLAN_98, "danger", "btn-xs"):$text));

} 
/*
function render_alert ($altype = 'info', $altext, $tab = 0) {
$postext = '</td></tr><tr><td colspan=2><div class="alert alert-'.$altype.'">'.$altext.'</div>';
return array ('type' => 'text', 'tab' => $tab, 'writeParms' => array('post' => $postext, 'class' => 'hidden'));
} 

function render_dismalert ($altype = 'info', $altext, $tab = 0) {
/*
$postext = '</td></tr><tr><td colspan=2><div class="s-message">
				<div class="s-message alert alert-block fade in '.$altype.'  alert-'.$altype.'"><a class="close" data-dismiss="alert">×</a><i class="s-message-icon s-message-'.$altype.'"></i>
				<h4 class="s-message-title">System Information</h4>
				<div class="s-message-body">
					<div class="s-message-item">'.$altext.'</div>
				</div>
			</div>
		
			</div>';
*/
/*
$postext = '</td></tr><tr><td colspan=2>';
$postext .= e107::getMessage()->addInfo($altext)->render();

return array ('type' => 'text', 'tab' => $tab, 'writeParms' => array('post' => $postext, 'class' => 'hidden'));
}      

function render_linkbutton ($link, $butext, $tab = 0, $btclass = 'default', $addclass = '') {
$postext = '</td></tr><tr><td colspan=2>';
$postext .= euser_admin::linkbutton($link,$butext,$btclass,$addclass);
//$postext = '</td></tr><tr><td colspan=2><a href="../e107_plugins/euser/'.$link.'" class="btn btn-'.$btclass.' '.$addclass.'" role="button">'.$butext.'</a>';
return array ('type' => 'text', 'tab' => $tab, 'writeParms' => array('post' => $postext, 'class' => 'hidden'));
} 
*/
function render_fulltableline ($link, $text, $rtype, $tab = 0, $class = 'default', $addclass = '') {
$postext = is_null($tab)?'':'</td></tr><tr><td colspan=2>';
//var_dump ($postext);
		switch($rtype)
		{
			case "alert":
$postext .= '<div class="alert alert-'.$class.'" style="margin-bottom: 0px !important">'.$text.'</div>';
			break;
			case "dismalert":
$postext .= e107::getMessage()->addInfo($text)->render();
			break;
			case "linkbutton":
$postext .= euser_admin::linkbutton($link,$text,$class,$addclass);
			break;
			case "tr":
$postext .= '<tr>'.$text.'</tr>';
			break;
      default:
$postext .= $text;
    }

//$postext = '</td></tr><tr><td colspan=2><a href="../e107_plugins/euser/'.$link.'" class="btn btn-'.$btclass.' '.$addclass.'" role="button">'.$butext.'</a>';
return array ('type' => 'text', 'tab' => $tab, 'writeParms' => array('post' => $postext, 'class' => 'hidden'));
} 

function render_postablerow ($array) {

foreach ($array as $key => $value){

// Com título  $postext .= "<span class='form-inline'>".$value['title']." ".e107::getForm()->renderElement($key, e107::getPlugPref('euser')[$key], $value)."</span>";
// Sem título
  $postext .= "</td><td>";
  $postext .= e107::getForm()->renderElement($key, e107::getPlugPref('euser')[$key], $value);
}
//$postext = '</td></tr><tr><td colspan=2><a href="../e107_plugins/euser/'.$link.'" class="btn btn-'.$btclass.' '.$addclass.'" role="button">'.$butext.'</a>';
//return array ('type' => 'text', 'tab' => $tab, 'writeParms' => array('post' => $postext, 'class' => 'hidden'));
return $postext."</td></tr>";
} 

function linkbutton ($link, $butext, $btclass = 'default', $addclass = '') {
//$postext = '</td></tr><tr><td colspan=2>';
return '<a href="../e107_plugins/euser/'.$link.'" class="btn btn-'.$btclass.' '.$addclass.'" role="button" style="word-wrap:break-word;white-space:normal !important;">'.$butext.'</a>';
} 

}