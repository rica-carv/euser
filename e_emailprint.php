<?php
if (!defined('e107_INIT')) { exit; }
//include_once(e_PLUGIN.'phil_lis/phillis_class.php');
//echo "<hr><hr><hr><hr><hr><hr>";
//require_once("../class2.php");
include_lan(e_PLUGIN . "phil_lis/languages/".e_LANGUAGE.".php");
//include_once(e_PLUGIN.'phil_lis/phillis_func.php');
/* VERS�O ANTIGA - MANTENHO PARA TESTES DE VELOCIDADE COMPARATIVO
include_once(e_PLUGIN.'phil_lis/_phillis_class.php');
*/
    $arr = explode('phillis.', e_QUERY);
    $phillis_temp = explode(".", $arr[1]);
//    $phillis_from = intval($phillis_temp[0]);
    $action = $phillis_temp[0];
//    $phillis_userid = intval($phillis_temp[1]);
    $phillis_purl= "http://".$_SERVER['HTTP_HOST'].e_HTTP.e_PLUGIN."phil_lis/phillis.php?".$arr[1];
//    var_dump ($phillis_purl);
function print_item($id) {
//    echo "���".$action."���";
//global $arr;
require_once(e_PLUGIN."phil/phil_class.php");
//		global $phillis_purl, $action, $phillis_userid, $sql, $tp, $sc_style;
  global $pref, $sql, $tp, $sc_style, $gstyle_obj, $phillis_purl;
//    echo "���".$action."���";
//    echo "���".e_QUERY."���";
    $arr = explode('.', e_QUERY);
//    var_dump ($arr);
    $_POST['phillis_vtype'] = array_pop($arr);

//    $plpr = new phillis_class();
/*
    $arr = explode('phillist.', e_QUERY);
    $phillis_temp = explode(".", $arr[1]);
//    $phillis_from = intval($phillis_temp[0]);
    $action = $phillis_temp[1];
    $phillis_userid = intval($phillis_temp[2]);
*/
//    $phillis_codes = $phillis_temp[3];
//    echo "<hr>".$action."<hr>";
//    echo "<hr>".$phillis_userid."<hr>";
//    echo "���".$action."���";
//    echo "<hr>teste<hr>";
//   $text = $id . "  - TESTE IMPRESS�O";
//   echo SITEURL . e_PLUGIN . "phil_lis/phillis.php?" . $important;
//   ob_start();
//    $text = include(SITEURL . e_PLUGIN . "phil_lis/phillis.php?" . $important . ".p");
//    ob_end_clean();
//   $text = include_once(e_PLUGIN . "phil_lis/phillis.php?" . $important);
//   return $text;
//  $phillis_text = "<link rel='stylesheet' href='phillis.css' type='text/css' />";
//  $phillis_text = "<h1>".LAN_PLUGIN_PHILLIS_1.LAN_PLUGIN_PHILLIS_33.$plp->cab_faltas()."</h1>";
//  $phillis_text .= $plp->faltas(p);
//^    $phillis_purl= "http://".$_SERVER['HTTP_HOST'].e_HTTP.e_PLUGIN."phil_lis/phillis.php?".$arr[1];
//    $text = $plpr->faltas(pr);
//        foreach ($plpr->faltas(pr) as $dt)
/*
        foreach (faltas(pr) as $dt)
            {
                switch (key($dt))
                    {
                    case "cab":
                        $text .= "<div class='forumheader' style='text-align:left'>".$dt[cab]."</div>";
                        break;
                    case "c":
                        $text .= "<span class='col'>".$dt[c]."</span> ";
                        break;
                    case "t":
                        $text .= "<span class='col wait'>".$dt[t]."</span> ";
                        break;
                    default:
                        $text .= $dt[l]." ";
                    }
            }
*/
//      $cab = $plpr->cab_faltas(pr);
//////////      $cab = cab_listas($action, $phillis_userid, pr);
//    return "<div style='top:-60px;position:relative'><link rel='stylesheet' href='".e_PLUGIN."phil_lis/phillis.css' type='text/css' /><center><h1>".$cab[0]."<br>".$cab[1]."</h1></center><br>".$text."<hr />".$plpr->leg_faltas(pr)."<hr><p align='left'>".LAN_PLUGIN_PHILLIS_2." ".SITENAME."<br />( <a href=$phillis_purl>$phillis_purl</a> )</div>";
    //return "<style>body {overflow: auto !important;}</style><div style='top:-60px;position:relative'><link rel=
////$text_string.LAN_PLUGIN_PHILLIS_37.($user_name?$user_name:$gstyle_obj->showUser($phillis_userid))."<br><small>".($datam>0?"(".LAN_PLUGIN_PHILLIS_100 ." ".$datam.")":"")."</small>";
// ####### PARA ALTERAR PARA COLOCAR A NUMERA��O CONFORME O QUE VEM DA BASE DE DADOS    
//////////        return "<link rel='stylesheet' href='".e_PLUGIN."phil_lis/phillis.css' type='text/css'/><div style='top:-90px;position:relative'><div style='left:80px;text-align: center'><h1 style='text-align: center'>".$cab[0].LAN_PLUGIN_PHILLIS_37.$cab[1]."</h1> ".$cab[2]."<BR>NUMERA��O AFINSA"."</div>".(($action=="u" || $action=="n")?cria_lista(pr):cria_lista(pr, img))."<hr />".(($action=="u" || $action=="n")?leg_faltas(pr)."<hr>":"")."<p align='left'>".LAN_PLUGIN_PHILLIS_2." ".SITENAME.": <a href=$phillis_purl>$phillis_purl</a></div>";
///////return "TESTE TESTE TESTE"."���".$arr[1]."���";
//var_dump (e_QUERY);
//if (file_exists(THEME."phillis_template.php")) {include_once(THEME."phillis_template.php");} else {include(e_PLUGIN."phil_lis/phillis_template.php");}
//require_once(e_PLUGIN."phil_lis/phillis_shortcodes.php");
/////////  $phillis_text .= $tp->parsetemplate("{LISTCSS=phillis}", false, $phillis_shortcodes); 
$phillis_whatdo = 'pr';
include_once(e_PLUGIN.'phil_lis/phillis_view.php');
//var_dump ($phillis_temp);
//return "<div style='top:-125px;position:relative'><div style='left:80px;text-align: center'><h1 style='text-align: center'>".$phillis_caption."</h1>NUMERA��O AFINSA<BR></div><BR>".$tp->parsetemplate("{LISTCSS=phillis}", false, $phillis_shortcodes).$phillis_text.((($phllist_Action=="o" || $phllist_Action=="s"))?"":"<hr />".$tp->parsetemplate($phillis_INILEG.($phillis_ccount?$phillis_COMPLEG:"").$LAN_PLUGIN_PHILLIS_EGFALTAS[$phillis_view].$phillis_ENDLEG, false, $phillis_shortcodes))."<hr><p align='left'>".LAN_PLUGIN_PHILLIS_2." ".SITENAME.": <a href=$phillis_purl>$phillis_purl</a></div>";
//e107::css('phil_lis', 'phillis.css');
/*
return "<div style='top:-115px;position:relative'><div style='left:80px;text-align: center'><h1 style='text-align: center'>".$phillis_caption."<br>NUMERA��O AFINSA<br></div><br><br>".$phillis_text.((($phllist_Action=="o" || $phllist_Action=="s"))?"":"<hr />".$tp->parsetemplate($phillis_INILEG.($phillis_ccount?$phillis_COMPLEG:"").$LAN_PLUGIN_PHILLIS_EGFALTAS[$phillis_view].$phillis_ENDLEG, false, $phillis_shortcodes))."<hr><p align='left'>".LAN_PLUGIN_PHILLIS_2." ".SITENAME.": <a href=$phillis_purl>$phillis_purl</a></div>";
*/
$menusc = e107::getScBatch('menu', 'phil_lis');
$menusc->wrapper('phillis_menu');
$templatemenu = e107::getTemplate('phil_lis', 'phillis_menu'); 	

return "<div style='position:relative'><div style='left:80px;text-align: center'><h1 style='text-align: center'>".$phillis_caption."</h1>NUMERA��O AFINSA<br></div><br>".$phillis_text.$tp->parsetemplate($template['end'], false, $sc).((($phllist_Action=="o" || $phllist_Action=="s"))?"":$tp->parsetemplate("<center>".$templatemenu['leg']['start'].($phillis_ccount?$templatemenu['leg']['body']:"").str_replace($_POST['phillis_vtype']=='x'?"col'":'', $_POST['phillis_vtype']=='x'?"colxc'":'', $templatemenu['leg']['body']).$templatemenu['leg']['end']."</center>", false, $menusc))."<br><div align='left'>".LAN_PLUGIN_PHILLIS_2." ".SITENAME.": <a href=$phillis_purl>$phillis_purl</a></div>";
/* VERS�O ANTIGA - MANTENHO PARA TESTES DE VELOCIDADE COMPARATIVO
    return "<link rel='stylesheet' href='".e_PLUGIN."phil_lis/phillis.css' type='text/css' /><h1>".LAN_PLUGIN_PHILLIS_1.LAN_PLUGIN_PHILLIS_33.$plpr->cab_faltas(pr)."</h1>".$plpr->faltas(pr)."<hr />".$plpr->leg_faltas(pr)."<hr><p align='left'>".LAN_PLUGIN_PHILLIS_2." ".SITENAME."<br />( <a href=$phillis_purl>$phillis_purl</a> )";
*/
}
function email_item($id) {
   // populate this with the message text to be e-mailed
   $message = "TESTE EMAIL";
   return $message;
}
/*  DESACTIVADO PORQUE O MEU PDF � MELHOR.... :D
function print_item_pdf($id) {
		global $phillis_purl, $tp, $phillis_userid, $sql, $action;
    $plpdf = new phillis_class();
    $text = "<b>".LAN_PLUGIN_PHILLIS_1.LAN_PLUGIN_PHILLIS_33.$plpdf->cab_faltas(pdf)."</b><br><hr>".$plpdf->faltas(pdf)."<br><hr>".$plpdf->leg_faltas(pdf)."<br><hr>".LAN_PLUGIN_PHILLIS_2." ".SITENAME." (<a href=$phillis_purl>$phillis_purl</a>)";
   // return an array with the following data:
   // * document text
   // * document creator, e.g. SITENAME
   // * document author, 
   // * document title
   // * document subject
   // * document keywords
   // * document header URL
   // Do NOT add parser function to the variables, leave them as raw data
   // as the PDF methods will handle this!
    $sql->db_Select("user", "user_name", "user_id = ".$phillis_userid);
    extract($sql->db_Fetch());
   ob_start();
   return array($tp->toHTML($text), SITENAME, $user_name, $tp->toHTML(ucfirst(phillis_34)." ".(($action == "u")?phillis_83:(($action == "n")?phillis_82:""))." (".$user_name.")"), $tp->toHTML(phillis_01.LAN_PLUGIN_PHILLIS_33.LAN_PLUGIN_PHILLIS_110." ".(($action == "u")?phillis_18:(($action == "n")?phillis_19:""))), $keywords, $phillis_purl);
}
*/
?>