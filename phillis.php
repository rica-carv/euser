<?php
   // Start collecting any output so we don't accidently put non-XML stuff in there
/*  ISTO PASSOU PARA DENTRO DO IF.....
$phllist_Ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
if($phllist_Ajax) {
   ob_start();
}
*/
/*
Acho que isto veio do phcat.... lol!
- Implementar caixas de selec��o din�micas no filtro
- Criar rotina para construir caixas do filtro
LISTA DE PENDENTES A FAZER:
- Implementar lista compacta (n� | n� n� | n�...)
- Implementar forma de inserir e remover as faltas na p�gina em que mostra a lista de faltas:
  - Edi��o simples (apaga e adiciona, e mais nada)
  - Edi��o avan�ada (utiliza um "carrinho de compras", com hip�tese de colocar o estado, quantidades, etc.)
- Na inser��o e remo��o das faltas, adicionar uma check box para confirmar ou n�o (opcional?)
- Implementar bitwise (b e b j� t�m os bitwises certos - ver no meio da rotina), e apagar colunas pl*_n, pl*_g e pl*_c da bd.....
<?php
    // Security permissions:
    $writePost = 1;
    $readPost = 2;
    $deletePost = 4;
    $addUser = 8;
    $deleteUser = 16;
    // User groups:
    $administrator = $writePost | $readPosts | $deletePosts | $addUser | $deleteUser;
    $moderator = $readPost | $deletePost | $deleteUser;
    $writer = $writePost | $readPost;
    $guest = $readPost;
    // function to check for permission
    function checkPermission($user, $permission) {
        if($user & $permission) {
            return true;
        } else {
            return false;
        }
    }
    // Now we apply all of this!
    if(checkPermission($administrator, $deleteUser)) {
        deleteUser("Some User"); # This is executed because $administrator can $deleteUser
    }
? >  <- retirar espa�o....
*/
//echo "<hr><hr><hr><hr><hr>";
//echo "rewrRWEFEFEWFEWDEWFRGRGFF";
//exit;
if (!defined('e107_INIT'))
{
	require_once("../../class2.php");
}
//////require_once("../../class2.php");
// If not a valid call to the script then leave it
if (!defined('e107_INIT')){ exit;}

$msg = e107::getMessage();
/*
if (!e107::isInstalled('philcat'))
{
	e107::redirect();
	exit;
}
*/
/*
$mes = e107::getMessage();
//$mes->setTitle(LAN_STATUS, 'info');
 $mes->addWarning('Layout <strong>'.vartrue($templates[$new_data['fb_category_template']], 'n/a').'</strong> is in use by another category. Layout should be unique per category. ');
echo $mes->render('warning','warning',false);
*/

/*  ISTO PASSOU PARA DENTRO DO IF.....
include_lan(e_PLUGIN."phil_lis/languages/".e_LANGUAGE.".php");
include_lan(e_PLUGIN."phil_cat/languages/".e_LANGUAGE.".php");
if(!$phllist_Ajax) {
define("LAN_PLUGIN_PHILLIS_PAGE_NAME", phillis_01);
include_lan(e_LANGUAGEDIR.e_LANGUAGE."/lan_user.php");
}
require_once(e_HANDLER . "userclass_class.php");
if (file_exists(THEME."phillis_template.php")) {include_once(THEME."phillis_template.php");} else {include(e_PLUGIN."phil_lis/phillis_template.php");}
require_once(e_PLUGIN."phil_lis/phillis_shortcodes.php");
//          var_dump($phillis_SECTION_START);
/////          echo $phillis_SECTION_START;
if(!$phllist_Ajax) {
require_once(e_HANDLER . "ren_help.php");
require_once(HEADERF);
}
require_once(e_PLUGIN."phil/phil_class.php");
*/
// If plugin catalog not instaled, then leave it
/*if (!isset($pref['plug_installed']['phil_cat'])) {
//----para testes!---- if (1==1) {
  header('Refresh: 5; URL='.e_BASE.'index.php');
  $phillis_caption = LAN_20;
  $phillis_text = PHLIS_A99;
//	header("location:".e_BASE."index.php");
//	 exit;
}
else {
*/
e107::lan('phillis',"front", true);
/*
e107::lan('phillis',"front", true);

if (!e107::isInstalled('philcat'))
{
  		$msg = e107::getMessage();
		$msg->warning(LAN_PLUGIN_PHILLIS_9);
  if (ADMIN == TRUE) {
        e107::lan('phillis',"admin", true);
		$msg->error(LANAD_PLUGIN_PHILLIS_19);
  }
//---	e107::redirect();
//---	exit;
}
*/
////require_once(HEADERF);



if (!e107::isInstalled('philcat'))
///  if (1==1)
{
		$msg->addwarning(LAN_PLUGIN_PHILLIS_9);
//    echo "<hr><hr>";
//    var_dump (ADMIN == TRUE);
    if (ADMIN == TRUE) {
        e107::lan('phillis',"admin", true);
		$msg->adderror(LANAD_PLUGIN_PHILLIS_19);
  }
//---	e107::redirect();
}

e107::css('phillis', 'phillis.css');
/*
echo "<hr><hr><hr>---------------<hr>";
var_dump($msg->hasMessage());
var_dump($msg);
*/
$pref=e107::getPlugPref("phillis");

//var_dump ($pref);
if (!check_class($pref['read'])) {
//  if (!check_class($pref['read']) || !(check_class(implode(', ',array_keys($pref['allow_vseries'])))) || !(check_class(implode(', ',array_keys($pref['allow_vpecas']))))) {
	$msg->addwarning(LAN_NO_PERMISSIONS);
///    require_once(HEADERF);
}

if ($msg->hasMessage()) {
  //    echo $msg->get('error');
  //    echo $msg->get('warning');
  require_once(HEADERF);
  echo $msg->render();
  ////    $ns->tablerender(PHILCAT_PAGE_NAME, $tp->parseTemplate($PHCAT_MENU_TITLE.$PHCAT_MENU, false, $sc));
      require_once(FOOTERF);
      exit;
  }
//$phllist_Ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
//if($phllist_Ajax) {
//   ob_start();
//}
//include_lan(e_PLUGIN."phil_lis/languages/".e_LANGUAGE.".php");
///////e107::lan('phillis',"front", true);
//include_lan(e_PLUGIN."phil_cat/languages/".e_LANGUAGE.".php");
e107::lan('philcat',"front", true);
//if(!$phllist_Ajax) {
define("LAN_PLUGIN_PHILLIS_PAGE_NAME", LAN_PLUGIN_PHILLIS_1);
//include_lan(e_LANGUAGEDIR.e_LANGUAGE."/lan_user.php");
e107::lan('core','user');
//}
///////////require_once(e_HANDLER . "userclass_class.php");
//$sc = e107::getScBatch('phillis', 'phil_lis');

//// ####### INICIO REESCRITA DO C�DIGO 2024 #######
$sc = e107::getScBatch('phillis', TRUE);
$sc->wrapper('phillis');

$template = e107::getTemplate('phillis', 'phillis'); 	
$phillis_caption = LAN_PLUGIN_PHILLIS_1." ".LAN_PLUGIN_PHILLIS_67;

$phillis_text .= $tp->parsetemplate($template['start'], true, $sc);

    $phillis_from = intval($_POST['phillis_from']);   /// tEORICAMENTE N�O H� post, PORQUE � que est� aqui????
////    $phillis_arg = "SELECT user_id, user_name, fltn.count AS nfltcount, fltu.count AS ufltcount, trcn.count AS ntrccount, trcu.count AS utrccount, fltn.actdata as afltn, fltu.actdata as afltu, trcn.actdata as atrcn, trcu.actdata as atrcu FROM #user LEFT JOIN (SELECT user, count(user) AS count, max(data) AS actdata FROM #phillist_fltn GROUP BY user) AS fltn ON user_id = fltn.user LEFT JOIN (SELECT user, count(user) AS count, max(data) AS actdata FROM #phillist_fltu GROUP BY user) AS fltu ON user_id = fltu.user LEFT JOIN (SELECT user, count(user) AS count, max(data) AS actdata FROM #phillist_trcn GROUP BY user) AS trcn ON user_id = trcn.user LEFT JOIN (SELECT user, count(user) AS count, max(data) AS actdata FROM #phillist_trcu GROUP BY user) AS trcu ON user_id = trcu.user WHERE (coalesce( fltn.count, 0 ) + coalesce( fltu.count, 0 ) + coalesce( trcn.count, 0 ) + coalesce( trcu.count, 0 )) >0".(USERID>0?" OR user_id = ".USERID:"")." GROUP BY user_id";
    $phillis_arg = "SELECT user_id, user_name, fltn.count AS nfltcount, fltu.count AS ufltcount, trcn.count AS ntrccount, trcu.count AS utrccount, fltn.actdata as afltn, fltu.actdata as afltu, trcn.actdata as atrcn, trcu.actdata as atrcu FROM #user
    LEFT JOIN (SELECT user, count(user) AS count, max(data) AS actdata FROM #phillist_fltn GROUP BY user) AS fltn ON user_id = fltn.user
    LEFT JOIN (SELECT user, count(user) AS count, max(data) AS actdata FROM #phillist_fltu GROUP BY user) AS fltu ON user_id = fltu.user
    LEFT JOIN (SELECT user, count(user) AS count, max(data) AS actdata FROM #phillist_trcn GROUP BY user) AS trcn ON user_id = trcn.user
    LEFT JOIN (SELECT user, count(user) AS count, max(data) AS actdata FROM #phillist_trcu GROUP BY user) AS trcu ON user_id = trcu.user
    WHERE (coalesce( fltn.count, 0 ) + coalesce( fltu.count, 0 ) + coalesce( trcn.count, 0 ) + coalesce( trcu.count, 0 )) >0
    ";
//    echo $phillis_arg;
//var_dump ($pref['phillis_perpage']);
    $phillis_arg .= ($pref['phillis_perpage'] > 0?" limit {$phillis_from}," . $pref['phillis_perpage']:"");
// #######ISTO � PRECISO POR CAUSA DO BYETHOST E ETHERNETYHOST!!!!!!!!!!!
//    $phillis_count = $sql->gen("SET SQL_BIG_SELECTS=1;", false);
    $sql->gen("SET SQL_BIG_SELECTS=1", false);
//    echo $phillis_count;
//  echo "<hr>";
//    $phillis_count = $sql->gen($phillis_arg, true);

/*
  echo "<hr>";
  echo $phillis_arg;
  echo $phillis_count;
  echo "<hr>";
*/
////$phillis_array = $sql->rows();   /// Isto tem de ficar aqui, sen�o o array desaparece....

    if (($phillis_count = $sql->gen($phillis_arg)) > 0) {

//$sc = e107::getScBatch('phillis', TRUE);
//$sc->wrapper('phillis');
//$sc = e107::getScBatch('phillis',TRUE);
require_once(e_HANDLER . "userclass_class.php");

//echo "<hr>--------------------->";
//var_dump (e107::getScBatch('phillis', TRUE));
//echo "<hr><hr><hr>--------------------->";
//var_dump (e107::getScBatch('philcat', TRUE));

//if (file_exists(THEME."phillis_template.php")) {include_once(THEME."phillis_template.php");} else {include(e_PLUGIN."phil_lis/phillis_template.php");}
//echo "TEMPLATE INICIO: ";
//var_dump ($template);
//////////////////////////////////////////////////////////////////e107::getTemplate('phillis', 'icons');
//$template = e107::getTemplate('phillis', 'phillis'); 	
//echo "<hr>template inicio";
//var_dump($template);
//echo "<hr>template inicio";
//var_dump(e107::getTemplate('philcat', 'philcat'));
//require_once(e_PLUGIN."phil_lis/phillis_shortcodes.php");
//          var_dump($phillis_SECTION_START);
/////          echo $phillis_SECTION_START;
//if(!$phllist_Ajax) {
require_once(e_HANDLER . "ren_help.php");
//echo "<hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>template inicio";
//var_dump($template);
//}
//include_lan(e_PLUGIN . "phil_lis/languages/" . e_LANGUAGE . ".php");
/// EST- NO P+HLIS_UPDATER
//if ($_SERVER['REQUEST_METHOD'] == "POST")
//{
//    echo $_POST['phillis_val'];
//    $phillis_val = explode(",", $_POST['phillis_val']);
//    print_r ($phillis_val);
//    $phillis_temp = explode(".", $_POST['phillis_get']);
/* ANTIGO, REMOVIDO O FROM
    $phillis_from = intval($phillis_temp[0]);
    $action = $phillis_temp[1];
    $phillis_userid = intval($phillis_temp[2]);
    $phillis_codes = $phillis_temp[3];
*/
//    $action = $_POST['action'];
//    $phillis_userid = intval($_POST['phillis_bookid']);
//    $phillis_chapterid = intval($_POST['phillis_chapterid']);
//} elseif (e_QUERY)
//{
//    echo substr(e_QUERY, 1, 1);
//    $phillis_temp = explode(".", e_QUERY);
//    $phillis_temp = preg_split('/[.-]/', e_QUERY);
/* ANTIGO, REMOVIDO O FROM
    $phillis_from = intval($phillis_temp[0]);
    $action = $phillis_temp[1];
    $phillis_userid = intval($phillis_temp[2]);
    $phillis_codes = $phillis_temp[3];
*/
//}
//    $action = $phillis_temp[0];
//    $phillis_userid = intval($phillis_temp[1]);
//    $action = $phillis_temp[0];
//    $phillis_userid = abs(intval($phillis_temp[1]));
//    $action = ($phillis_userid==0?"show":$phillis_temp[0]);
//    echo USERID;
//    echo " -- ";
//    echo $phillis_userid;
//    echo " -- ";
//    var_dump($phillis_temp);
//    echo " -- ";
//    $phillis_edit = ((USERID == $phillis_userid)?intval($phillis_temp[1])<0:null);
//  $phillis_splitter = substr(e_QUERY, 1, 1);
//    $phillis_splitter = $phillis_splitter[0] = e_QUERY;
//  $phillis_splitter = substr(e_QUERY, 1, 1);
//  $phillis_whatdo = (((USERID == $phillis_userid)?$phillis_splitter=='-':null)?"ed":null);
//    var_dump($phillis_splitter);
//    var_dump($phillis_whatdo);
//    echo $phillis_splitter;
//    echo $phillis_edit;
//    $phillis_codes = $phillis_temp[2];
/// FIM EST- NO P+HLIS_UPDATER
//if(!$phllist_Ajax)   {
//if (isset($_POST['commentsubmit']))
//{
//    $phillis_tmp = explode(".", e_QUERY);
/* ANTIGO, REMOVIDO O FROM
    $phillis_from = intval($phillis_tmp[0]);
*/
//    $action = "listf";
//    $phillis_userid = intval($phillis_tmp[2]);
//    $phillis_userid = intval($phillis_tmp[1]);
//    $phillis_com->enter_comment($_POST['author_name'], $_POST['comment'], "phcat", $phillis_userid, $pid, $_POST['subject']);
//}
/// ---------- A GEST+O (ADI++O OU REMO++O) DE   PE+AS TEM DE FICAR AQUI POR CAUSA DO JAVASCRIPT
// GEST+O DE LISTAS, CASO VENHA NO ACTION
//echo "ACTION 2:".$action[2];
/// EST- NO P+HLIS_UPDATER
//ECHO "<HR>".$action[0];
//ECHO "=====".$action[2];
///if(!$phllist_Ajax) {
// define the over ride meta tags
// define("LAN_PLUGIN_PHILLIS_PAGE_NAME", phillis_01);
// check if we use the wysiwyg for text areas
//$e_wysiwyg = "phillis_cdetails";
//if ($pref['wysiwyg'])
//{
//    $WYSIWYG = true;
//}
//require_once(e_HANDLER . "userclass_class.php");
//require_once(e_HANDLER . "ren_help.php");
//require_once(e_HANDLER . "rate_class.php");
//$rater = new rater;
//require_once(e_HANDLER . "date_handler.php");
//$phillis_conv = new convert;
//require_once(e_HANDLER . "comment_class.php");
//$phillis_com = new comment;
//require_once(HEADERF);
//$phillis_from = 0;
//require_once(e_PLUGIN.'phil_lis/phillis_class.php');
//$pl = new phillis_class();
// LOAD phillis CSS STYLE SHEET
/////$phillis_text .= $tp->parsetemplate($phillis_HEADER, true, $sc);
//$phillis_text = "<link rel='stylesheet' href='phillis.css' type='text/css' />";
// LOAD PHIL COMMON CSS STYLE SHEET
//$phillis_text .= "<link rel='stylesheet' href='".e_PLUGIN."phil/phil.css' type='text/css' />";
///}
//}
//    if ($phillis_userid==0){
//      header('Location:'.e_PAGE);
//    }
//  $data_table = (($action == "s" || $action == "o")?"trc":"flt");
//  $data_table .= (($action == "s")?"u":(($action == "o")?"n":$action));
//  echo $data_table;
//if ($phillis_codes && USERID && USERID==$phillis_userid)
//  echo $phillis_codes."<hr>";
//  echo ($phillis_edit==1)."<hr>";
//if ($phillis_codes && $phillis_whatdo=="ed")
// #### IN�CIO DA EDI��O DAS LISTAS (APAGAR , ADICIONAR)
/*
if ($phillis_codes)
{
    $phillis_codestmp = explode('|', $phillis_codes);
//var_dump($phillis_codestmp);
if ($phillis_codestmp[0]>0)
{
  $data_table = (($action == "s" || $action == "o")?"trc":"flt");
  $data_table .= (($action == "s")?"u":(($action == "o")?"n":$action));
if ($phillis_codestmp[1])
{
//if ($action[2] == "r")
//{
//    $phillis_codestmp = explode('|', $phillis_codes);
//echo $phillis_codes;
//echo "---";
//    print_r ($phillis_codestmp);
//  print_r(explode('_', 'test_underscore'));
*/
/*
DELETE FROM `portugalstamps`.`e107_phillist_fltu` WHERE `e107_phillist_fltu`.`cod` = 3552
*/
/*
//if ($action == "fn" || $action == "fu")
//-----if ($action == "n" || $action == "u")
//if ($action[0] == "f")
//-----{
//$phillis_rem = "DELETE FROM #phillist_flt".$action[1]." WHERE user=".USERID." AND cod=".$phillis_codestmp[1];
//-----$phillis_rem = "DELETE FROM #phillist_flt".$action." WHERE user=".USERID." AND cod=".$phillis_codestmp[1];
//-----}
$phillis_rem = "DELETE FROM #phillist_".$data_table." WHERE user=".USERID." AND cod=".$phillis_codestmp[1];
//echo $phillis_rem;
    if ($sql->db_Select_gen($phillis_rem, false))
    {
  $phillis_utext = phillis_27." ".$phillis_codestmp[0]." ( ".LAN_PLUGIN_PHILLIS_28." ".$phillis_codestmp[1]." ) ".LAN_PLUGIN_PHILLIS_39." ".LAN_PLUGIN_PHILLIS_40." ".LAN_PLUGIN_PHILLIS_38."!!!!";
}
else
{
$phillis_utext = phillis_57." ".LAN_PLUGIN_PHILLIS_50." ".LAN_PLUGIN_PHILLIS_27." ".$phillis_codestmp[0]." (".LAN_PLUGIN_PHILLIS_28." ".$phillis_codestmp[1].") ".LAN_PLUGIN_PHILLIS_40." ".LAN_PLUGIN_PHILLIS_38."!!!!";
$phllist_Ajaxerr = 1;
}
}
//else if ($action[2] == "a")
else 
{
//----- if ($action == "n" || $action == "u")
//if ($action[0] == "f")
//----- {
//-----   $LAN_PLUGIN_PHILLIS_ast_insert_id = $sql->db_Insert(
//-----     "phillist_flt".$action,
//-----     "NULL, '".USERID."', '".$phillis_codes."', 1, -1, -1, 38, 1, NULL , 1, 1, NULL"
//-----   );
//----- }
//echo $phllist_Add;
//  $LAN_PLUGIN_PHILLIS_ast_insert_id = $sql->db_Insert($phillis_instbl, $phillis_insval);
//    if ($sql->db_Select_gen($phllist_Add, false))
  $LAN_PLUGIN_PHILLIS_ast_insert_id = $sql->db_Insert(
    "phillist_".$data_table,
    "NULL, '".USERID."', '".$phillis_codes."', 1, -1, -1, 38, 1, NULL , 1, 1, NULL"
  );
  if ($LAN_PLUGIN_PHILLIS_ast_insert_id)
  {
  $phillis_utext = phillis_27." ".$phillis_codes." ( ".LAN_PLUGIN_PHILLIS_28." ".$LAN_PLUGIN_PHILLIS_ast_insert_id." ) ".LAN_PLUGIN_PHILLIS_44." ".LAN_PLUGIN_PHILLIS_41." ".LAN_PLUGIN_PHILLIS_38."!!!!";
  }
  else
  {
$phillis_utext = phillis_57." ".LAN_PLUGIN_PHILLIS_51." ".LAN_PLUGIN_PHILLIS_27." ".$phillis_codes." ".LAN_PLUGIN_PHILLIS_38."!!!!";
//$phillis_utext .= "phillist_".$data_table. " ---- ".
//    "NULL, '".USERID."', '".$phillis_codes."', 1, -1, -1, 38, 1, NULL , 1, 1, NULL";
  $phllist_Ajaxerr = 1;
  }
}
}
}
$phillis_utext = strtoupper($phillis_utext);
if($phllist_Ajax) {
  if ($phllist_Ajaxerr) {header('HTTP/1.1 500 Internal Server Booboo');}
  ob_end_clean();
  //This is an AJAX request, do AJAX specific stuff
  header('Content-Type: application/json');
//  $phllist_Ajaxret = json_encode(array ('text'=>$phillis_utext, 'val'=>($LAN_PLUGIN_PHILLIS_ast_insert_id?$LAN_PLUGIN_PHILLIS_ast_insert_id:"")));
//  echo ;
//  exit (json_encode(array ('fname'=>$phillis_codestmp[0], 'text'=>$phillis_utext, 'val'=>($LAN_PLUGIN_PHILLIS_ast_insert_id?$LAN_PLUGIN_PHILLIS_ast_insert_id:""))));
//  exit (json_encode(array ('text'=>$phillis_utext, 'val'=>($LAN_PLUGIN_PHILLIS_ast_insert_id?$LAN_PLUGIN_PHILLIS_ast_insert_id:""), 'sql'=>$phillis_rem)));
  exit (json_encode(array ('text'=>$action, 'val'=>($LAN_PLUGIN_PHILLIS_ast_insert_id?$LAN_PLUGIN_PHILLIS_ast_insert_id:""))));
//  exit($phillis_utext.($LAN_PLUGIN_PHILLIS_ast_insert_id?"|".$LAN_PLUGIN_PHILLIS_ast_insert_id:""));
//  exit(array($phillis_utext, $LAN_PLUGIN_PHILLIS_ast_insert_id));
}
*/
//  ##### FIM DA EDI��O
///    $phillis_codestmp = explode('|', $phillis_codes);
//    var_dump($phillis_codestmp);
///if ($phillis_codestmp[0]>0)
///{
///if ($phillis_codestmp[1])
///{
//if ($action[2] == "r")
//{
//    $phillis_codestmp = explode('|', $phillis_codes);
//echo $phillis_codes;
//echo "---";
//    print_r ($phillis_codestmp);
//  print_r(explode('_', 'test_underscore'));
/*
DELETE FROM `portugalstamps`.`e107_phillist_fltu` WHERE `e107_phillist_fltu`.`cod` = 3552
*/
//if ($action == "fn" || $action == "fu")
///if ($action == "n" || $action == "u")
//if ($action[0] == "f")
///{
//$phillis_rem = "DELETE FROM #phillist_flt".$action[1]." WHERE user=".USERID." AND cod=".$phillis_codestmp[1];
///$phillis_rem = "DELETE FROM #phillist_flt".$action." WHERE user=".USERID." AND cod=".$phillis_codestmp[1];
///}
//echo $phillis_rem;
///    if ($sql->db_Select_gen($phillis_rem, false))
///    {
///  $phillis_utext = phillis_27." ".$phillis_codestmp[0]." ( ".LAN_PLUGIN_PHILLIS_28." ".$phillis_codestmp[1]." ) FOI REMOVIDA ".LAN_PLUGIN_PHILLIS_38."!!!!";
///}
///else
///{
///$phillis_utext = phillis_57." ".LAN_PLUGIN_PHILLIS_50." ".LAN_PLUGIN_PHILLIS_27.$phillis_codestmp[0]." ".LAN_PLUGIN_PHILLIS_28." ".$phillis_codestmp[1].") ".LAN_PLUGIN_PHILLIS_38."!!!!";
///$phllist_Ajaxerr = 1;
///}
///}
//else if ($action[2] == "a")
///else 
///{
//ECHO "=====".$action[2];
/*
user 	
peca 	
n (Pe�a definitiva, Prova ou falso)   <--- ACHO QUE ISTO J� DEVERIA VIR DO CAT�LOGO....	
g  (Goma original, regomado, ou sem goma)	
c 	(Com charneira, com vest�gios, ou sem charneira)
######### NOVOS
1 	-1 	-1
1 	-1 	1
1 	1 	-1
1 	1 	0
1 	1 	1
1 	-1 	0
0 	1 	-1
0 	-1 	-1
######### USADOS
-1 	-1 	-1
-1 	1 	1
-1 	1 	-1
-1 	-1 	1
-1 	-1 	0
b 
-1 | 0   2   0
   |         8
 1 | 1   4   16
___________________
    -1 	1 	1 	20
    -1 	-1 	1 	16
    -1 	-1 	0 	8
    -1 	1 	-1 	4
-1 | 0   4   32
0  | 1   8   64
1  | 2   16  128
___________________
   -1 	1 	1 	0+16+128 = 144
   -1 	-1 	1 	0+4+128  = 132
   -1 	-1 	0 	0+4+64   = 68
   -1 	1 	-1 	0+16+32  = 48
*/
/*
INSERT INTO `portugalstamps`.`e107_phillist_fltn` (`user`, `peca`, `n`, `g`, `c`, `b`, `quant`, `valor`, `observacoes`, `estado`, `cond`, `ff`, `fv`, `di`, `da`, `cod`) VALUES ('3', '4604', '1', '1', '-1', '4', '2', NULL, 'Carimbo Lisboa', '1', '1', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL);
*/
/*
INSERT INTO `portugalstamps`.`e107_phillist_fltu` (
`user` ,
`peca` ,
`n` ,
`g` ,
`c` ,
`b` ,
`quant` ,
`valor` ,
`observacoes` ,
`estado` ,
`cond` ,
`ff` ,
`fv` ,
`di` ,
`da` ,
`cod`
)
VALUES (
'3', '2015', '-1', '-1', '-1', '0', '1', NULL , 'da carteira', '1', '1', NULL , NULL , '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL
)
*/
/// FALTA A VERIFICA++O DE ERROS: SE A PE+A J- EXISTIR NESTE USER, D- ERRO
//if ($action == "fn" || $action == "fu")
///if ($action == "n" || $action == "u")
//if ($action[0] == "f")
///{
/*
$phllist_Add = "INSERT INTO #phillist_flt".$action[1]." (
`user` ,
`peca` ,
`n` ,
`g` ,
`c` ,
`b` ,
`quant` ,
`valor` ,
`observacoes` ,
`estado` ,
`cond` ,
`ff` ,
`fv` ,
`di` ,
`da` ,
`cod`
)
VALUES (
'".USERID."', '".$phillis_codes."', '1', '-1', '-1', '38', '1', NULL , NULL, '1', '1', NULL , NULL , NOW(), NOW(), NULL
)
";
*/
//  $phillis_instbl = "phillist_flt".$action[1];
//  $phillis_instbl = "phillist_flt".$action;
//  $phillis_insval = "'".USERID."', '".$phillis_codes."', '1', '-1', '-1', '38', '1', NULL , NULL, '1', '1', NULL , NULL , NOW(), NOW(), NULL";
///  $LAN_PLUGIN_PHILLIS_ast_insert_id = $sql->db_Insert(
///    "phillist_flt".$action,
///    "NULL, '".USERID."', '".$phillis_codes."', 1, -1, -1, 38, 1, NULL , 1, 1, NULL"
///  );
//  $phillis_instbl = ;
//  $phillis_insval = ;
///}
//echo $phllist_Add;
//  $LAN_PLUGIN_PHILLIS_ast_insert_id = $sql->db_Insert($phillis_instbl, $phillis_insval);
//    if ($sql->db_Select_gen($phllist_Add, false))
///  if ($LAN_PLUGIN_PHILLIS_ast_insert_id)
///  {
//  $phillis_utext = "A PE�A ".$phillis_codes." (ALIAS ".$LAN_PLUGIN_PHILLIS_ast_insert_id.") FOI ADICIONADA A LISTA!!!!";
///  $phillis_utext = phillis_27." ".$phillis_codes." ( ".LAN_PLUGIN_PHILLIS_28." ".$LAN_PLUGIN_PHILLIS_ast_insert_id." ) FOI ADICIONADA ".LAN_PLUGIN_PHILLIS_38."!!!!";
///  }
///  else
///  {
//  $phillis_utext = "OCORREU UM ERRO AO ADICIONAR A PE�A ".$phillis_codes." A LISTA!!!!";
///$phillis_utext = phillis_57." ".LAN_PLUGIN_PHILLIS_51." ".LAN_PLUGIN_PHILLIS_27." ".$phillis_codes." ".LAN_PLUGIN_PHILLIS_38."!!!!";
///  $phllist_Ajaxerr = 1;
///  }
///}
///}
/*
else if ($phillis_codestmp[0]=="p") 
{
  echo "IMPRESS�O PHIL LIST";
  die();
}
*/
///}
/*
$phillis_utext = strtoupper($phillis_utext);
if($phllist_Ajax) {
  if ($phllist_Ajaxerr) {header('HTTP/1.1 500 Internal Server Booboo');}
  ob_end_clean();
  //This is an AJAX request, do AJAX specific stuff
  header('Content-Type: application/json');
//  $phllist_Ajaxret = json_encode(array ('text'=>$phillis_utext, 'val'=>($LAN_PLUGIN_PHILLIS_ast_insert_id?$LAN_PLUGIN_PHILLIS_ast_insert_id:"")));
//  echo ;
//  exit (json_encode(array ('fname'=>$phillis_codestmp[0], 'text'=>$phillis_utext, 'val'=>($LAN_PLUGIN_PHILLIS_ast_insert_id?$LAN_PLUGIN_PHILLIS_ast_insert_id:""))));
//  exit (json_encode(array ('text'=>$phillis_utext, 'val'=>($LAN_PLUGIN_PHILLIS_ast_insert_id?$LAN_PLUGIN_PHILLIS_ast_insert_id:""), 'sql'=>$phillis_rem)));
  exit (json_encode(array ('text'=>$action, 'val'=>($LAN_PLUGIN_PHILLIS_ast_insert_id?$LAN_PLUGIN_PHILLIS_ast_insert_id:""))));
//  exit($phillis_utext.($LAN_PLUGIN_PHILLIS_ast_insert_id?"|".$LAN_PLUGIN_PHILLIS_ast_insert_id:""));
//  exit(array($phillis_utext, $LAN_PLUGIN_PHILLIS_ast_insert_id));
}
*/
/*
$phillis_text .= "<link rel='stylesheet' href='../phil/dialog/dialog_box.css' type='text/css'>";
$phillis_text .= "<div id='listinginfo'>";
if($phillis_utext || $phillis_edit==1) {
$phillis_text .= "<p><center><div id='dialog '><div id='dialog-content' class='".($phillis_edit==1 && !$phillis_utext?"warning":($phllist_Ajaxerr?"error":"success"))."'>";
$phillis_text .= ($phillis_edit==1 && !$phillis_utext?phillis_300.(($action == "s" || $action == "o")?phillis_302:phillis_301):$phillis_utext);
$phillis_text .= "</div></div></center>";
}
$phillis_text .= "</div>";
*/
//echo "cheguei aqui!!!!";
//$phillis_text = "";
//echo "<HR><HR>".$phillis_utext;
//EXIT; 
/// FIM EST- NO P+HLIS_UPDATER
///   ------ FIM GEST+O
// ########### EXIBI++O DAS LISTAS DE TODOS
//if (empty($action) || $action == "show")
//{
//  $phillis_caption = LAN_PLUGIN_PHILLIS_1." ".LAN_PLUGIN_PHILLIS_67;
//----    session_start();
// O FILTRO PASSOU A SER A FUN��O create_filter NO FICHEIRO phil_class.php!!!!!!!!!!
/*
   if (!isset($_SESSION['phillis_pais']))
    {
        $_SESSION['phillis_pais'] = 1;
        $_SESSION['phillis_tipo'] = 1;
        $_SESSION['phillis_familia'] = 1;
    } elseif (!empty($_POST['dofilter']))
    {
        $_SESSION['phillis_pais'] = intval($_POST['phillis_pais']);
        $_SESSION['phillis_tipo'] = intval($_POST['phillis_tipo']);
        $_SESSION['phillis_familia'] = intval($_POST['phillis_familia']);
        $_SESSION['phillis_iano'] = $_POST['phillis_iano'];
        $_SESSION['phillis_fano'] = $_POST['phillis_fano'];
    }
    $phillis_paissel = "<select name='phillis_pais' class='tbox'>";
//$paises= @mysql_query("SELECT distinctrow pais.cod, pais.desc FROM $dbname.`pais` INNER JOIN $dbname.`series` ON pais.cod=`series`.pais ORDER BY pais.`desc` ASC;");
    $phillis_arg = "select distinctrow #philcat_pais.cod, #philcat_pais.desc from #philcat_pais inner join #philcat_series on #philcat_pais.cod= #philcat_series.pais order by desc";
    if ($sql->db_Select_gen($phillis_arg, false))
//    if ($sql->db_Select("pais", "cod,desc", " order by desc", "nowhere", false))
    {
        $phillis_paissel .= "<option value='0' >" .LAN_PLUGIN_PHILLIS_4 . "</option>";
        while ($phillis_row = $sql->db_Fetch())
        {
            $phillis_paissel .= "<option value='" . $phillis_row['cod'] . "' " . ($_SESSION['phillis_pais'] == $phillis_row['cod']?"selected='selected'":"") . " >" . $tp->toFORM($phillis_row['desc']) . "</option>";
        } // while
    }
    else
    {
        $phillis_paissel .= "<option value='' >" .LAN_PLUGIN_PHILLIS_3 . "</option>";
    }
    $phillis_paissel .= "</select>";
    $phillis_tiposel = "<select name='phillis_tipo' class='tbox'>";
//$tipos= @mysql_query("SELECT DISTINCTROW tipo.cod, tipo.desc FROM $dbname.tipo right join $dbname.`codigo_pecas` on tipo.cod=`codigo_pecas`.tipo where $fpais ORDER BY tipo.cod;");
//$fpais = ($pais == '') ? "" : " `codigo_pecas`.pais=$pais ";
    $phillis_where = ($_SESSION['phillis_pais']>0?" where #philcat_pecas_codigo.pais=".intval($_SESSION['phillis_pais']):"");
    $phillis_arg = "select distinctrow #philcat_tipo.cod, #philcat_tipo.desc from #philcat_tipo right join #philcat_pecas_codigo on #philcat_tipo.cod= #philcat_pecas_codigo.tipo".$phillis_where." order by cod";
//    echo intval($_SESSION['phillis_pais']); 
    if ($sql->db_Select_gen($phillis_arg, false))
//    if ($sql->db_Select("pa_genre", "pa_genre_id,pa_genre_name", " order by pa_genre_name", "nowhere", false))
    {
        $phillis_tiposel .= "<option value='0' >" .LAN_PLUGIN_PHILLIS_5 . "</option>";
        while ($phillis_row = $sql->db_Fetch())
        {
            $phillis_tiposel .= "<option value='" . $phillis_row['cod'] . "'  " . ($_SESSION['phillis_tipo'] == $phillis_row['cod']?"selected='selected'":"") . " >" . $tp->toFORM($phillis_row['desc']) . "</option>";
        } // while
    }
    else
    {
        $phillis_tiposel .= "<option value='' >" .LAN_PLUGIN_PHILLIS_6 . "</option>";
    }
    $phillis_tiposel .= "</select>";
    $phillis_familiasel = "<select name='phillis_familia' class='tbox'>";
*/
/*    
$familias= @mysql_query("SELECT  DISTINCTROW familias.cod, familias.desc, `codigo_pecas`.tipo, `codigo_pecas`.pais
 FROM $dbname.familias right join
$dbname.`codigo_pecas` on `familias`.cod=`codigo_pecas`.familia where $ftipo and $fpais
 ORDER BY familias.cod;");
$fpais = ($pais == '') ? "" : " `codigo_pecas`.pais=$pais ";
$ftipo = ($tipo == '') ? "" : " `codigo_pecas`.tipo=$tipo ";
*/    
/*
    $phillis_where .= ($_SESSION['phillis_tipo']>0?($phillis_where<>""?" and":" where")." #philcat_pecas_codigo.tipo=".intval($_SESSION['phillis_tipo']):"");
    $phillis_arg = "select distinctrow #philcat_familias.cod, #philcat_familias.desc from #philcat_familias right join #philcat_pecas_codigo on #philcat_familias.cod= #philcat_pecas_codigo.familia".$phillis_where." order by cod";
*/
/*
    echo intval($_SESSION['phillis_tipo']);
    echo "<hr>"; 
    echo $phillis_arg; 
*/
/*
    if ($sql->db_Select_gen($phillis_arg, false))
//    if ($sql->db_Select("pa_book", "pa_book_characters", "", "nowhere", false))                                         
    {
        $phillis_familiasel .= "<option value='0' >" .LAN_PLUGIN_PHILLIS_7 . "</option>";
        while ($phillis_row = $sql->db_Fetch())
        {
            $phillis_familiasel .= "<option value='" . $phillis_row['cod'] . "'  " . ($_SESSION['phillis_familia'] == $phillis_row['cod']?"selected='selected'":"") . " >" . $tp->toFORM($phillis_row['desc']) . "</option>";
        } // while
*/
/*
            $phillis_charlist = explode(",", $phillis_row['pa_book_characters']);
            foreach($phillis_charlist as $phillis_charname)
            {
                if (!empty($phillis_charname))
                {
                    $phllist_array[] = $phillis_charname;
                }
            }
        } // while
        $phllist_array = array_unique($phllist_array);
        foreach($phllist_array as $phillis_name)
        {
            $phillis_familiasel .= "<option value='" . $tp->toFORM($phillis_name) . "' " . ($_SESSION['phillis_characters'] == $tp->toFORM($phillis_name)?"selected='selected'":"") . "  >" . $tp->toFORM($phillis_name) . "</option>";
        }
*/
/*
    }
    else
    {
        $phillis_familiasel .= "<option value='' >" .LAN_PLUGIN_PHILLIS_23 . "</option>";
    }
    $phillis_familiasel .= "</select>";
*/
/**/
/*
$ianos= @mysql_query("SELECT DISTINCTROW `series`.ano FROM $dbname.`series`
 left join ($dbname.`pecas` LEFT JOIN $dbname.`codigo_pecas` ON
`pecas`.cod = `codigo_pecas`.peca) on `pecas`.serie=`series`.cod
where $fpais and $ftipo and $ffamilia
 ORDER BY `series`.ano ASC;");
//Constru��o dos filtros
$fpais = ($pais == '') ? "" : " `codigo_pecas`.pais=$pais ";
$ftipo = ($tipo == '') ? "" : " `codigo_pecas`.tipo=$tipo ";
$ffamilia = ($familia == '') ? "" : " `codigo_pecas`.familia=$familia ";
*/
/*
    $phillis_ianosel = "<select name='phillis_iano' class='tbox'>";
    $phillis_where .= ($_SESSION['phillis_familia']>0?($phillis_where<>""?" and":" where")." #philcat_pecas_codigo.familia=".intval($_SESSION['phillis_familia']):"");
    $phillis_arg = "select distinctrow #philcat_series.ano from #philcat_series left join ( #philcat_pecas left join #philcat_pecas_codigo on #philcat_pecas.cod= #philcat_pecas_codigo.peca) on #philcat_pecas.serie = #philcat_series.cod".$phillis_where." order by ano";
*/
/*
    echo $phillis_arg; 
*/
//    if ($sql->db_Select_gen($phillis_arg, false))
/*
    $phillis_arg = "select distinct pa_book_author from #pa_book order by substring(pa_book_author,locate('.',pa_book_author))";
    if ($sql->db_Select_gen($phillis_arg, false))
*/
/*
    {
//        $phillis_ianosel .= "<option value='0' >" .LAN_PLUGIN_PHILLIS_20 . "</option>";
        while ($phillis_row = $sql->db_Fetch())
        {
//            $phillis_tmp = explode(".", $phillis_row['ano'], 2);
//            $phllist_Author = $phillis_tmp[1];
            if (!isset($_SESSION['phillis_iano'])) $_SESSION['phillis_iano'] = $phillis_row['ano'];
            $phillis_ianosel .= "<option value='" . $phillis_row['ano'] . "'  " . ($_SESSION['phillis_iano'] == $phillis_row['ano']?"selected='selected'":"") . " >" . $tp->toFORM($phillis_row['ano']) . "</option>";
        } // while
    }
    else
    {
        $phillis_ianosel .= "<option value='' >" .LAN_PLUGIN_PHILLIS_8 . "</option>";
    }
    $phillis_ianosel .= "</select>";
*/
/**/
//    $phillis_fanosel = "<select name='phillis_fano' class='tbox'>";
/*
    $phillis_arg = "select distinct pa_book_author from #pa_book order by substring(pa_book_author,locate('.',pa_book_author))";
    if ($sql->db_Select_gen($phillis_arg, false))
*/
/*
$fanos= @mysql_query("SELECT DISTINCTROW `series`.ano FROM $dbname.`series`
 left join ($dbname.`pecas` LEFT JOIN $dbname.`codigo_pecas` ON
`pecas`.cod = `codigo_pecas`.peca) on `pecas`.serie=`series`.cod
where $fpais and $ftipo and $ffamilia and `series`.ano between '$iano' and YEAR(NOW())
 ORDER BY `series`.ano ASC;");
*/
//    $phillis_where .= " and ano between ".intval($_SESSION['phillis_iano'])." and ".strftime('%Y');
//    $phillis_arg = "select distinctrow #philcat_series.ano from #philcat_series left join ( #philcat_pecas left join #philcat_pecas_codigo on #philcat_pecas.cod= #philcat_pecas_codigo.peca) on #philcat_pecas.serie = #philcat_series.cod".$phillis_where." order by ano";
/*
            if (!isset($_SESSION['phillis_fano'])) {
//              $phillis_arg2 = $phillis_arg." desc limit 1";
              $sql->db_Select_gen($phillis_arg." desc limit 1", false);
              $phillis_row = $sql->db_Fetch();
              $_SESSION['phillis_fano'] = $phillis_row['ano'];
            }
*/
/*
    echo $phillis_arg; 
*/
/*    if ($sql->db_Select_gen($phillis_arg, false))
    {
//        $phillis_fanosel .= "<option value='0' >" .LAN_PLUGIN_PHILLIS_20 . "</option>";
        while ($phillis_row = $sql->db_Fetch())
        {
//            $phillis_tmp = explode(".", $phillis_row['pa_book_author'], 2);
//            $phllist_Author = $phillis_tmp[1];
            $phillis_fanosel .= "<option value='" . $phillis_row['ano'] . "'  " . ($_SESSION['phillis_fano'] == $phillis_row['ano']?"selected='selected'":"") . " >" . $tp->toFORM($phillis_row['ano']) . "</option>";
        } // while
    }
    else
    {
        $phillis_fanosel .= "<option value='' >" .LAN_PLUGIN_PHILLIS_8 . "</option>";
    }
    $phillis_fanosel .= "</select>";
*/

/* ########### POR ENQUANTO O FILTRO FICA DESLIGADO
    $phillis_text .= "
    <form action='" . e_SELF . "' method='post' id='pcform' >
<table class='tblheader' style='width:100%' >
	<tr>
		<td style='text-align:center;'>" .LAN_PLUGIN_PHILLIS_12 . ":" . $phillis_paissel . "&nbsp;&nbsp;" .LAN_PLUGIN_PHILLIS_13 . ":" . $phillis_tiposel . "&nbsp;&nbsp;" .LAN_PLUGIN_PHILLIS_29 . ":" . $phillis_familiasel . "<br />" .LAN_PLUGIN_PHILLIS_25 . ":" . $phillis_ianosel . "&nbsp;&nbsp;" .LAN_PLUGIN_PHILLIS_30 . ":" . $phillis_fanosel . "</td>
		<td style='text-align:center;'><input type='submit' class='button' name='dofilter' value='" .LAN_PLUGIN_PHILLIS_31 . "' /></td>
	</tr>
	</table>
	<table class='fborder' style='width:100%' >
";
*/
/*
$phillis_text .= "		<td class='fcaption' style='width:10%;text-align:center;'>" .LAN_PLUGIN_PHILLIS_30 . "</td>
<TD class='fcaption' style='width:10%;text-align:center;'>" .LAN_PLUGIN_PHILLIS_202 . "</TD>
	</tr>
	<tr>
		<td class='forumheader' style='text-align:left; font-weight:bold;' colspan='6'> &nbsp; " .LAN_PLUGIN_PHILLIS_2 . "</td>
	</tr>
";
*/
    // build up complex where for the filtering
/*
echo $phillis_where;
    if (intval($_POST['phillis_pais']) > 0)
    {
        $phillis_where .= " and pa_book_category=" . intval($_POST['phillis_pais']);
    }
    if (intval($_POST['phillis_tipo']) > 0)
    {
        $phillis_where .= " and pa_book_genre=" . intval($_POST['phillis_tipo']);
    }
    switch (intval($_POST['phillis_completion']))
    {
        case 1:
            $phillis_where .= " and pa_book_complete=0";
            break;
        case 2:
            $phillis_where .= " and pa_book_complete=1";
            break;
    }
    if (!empty($_POST['PHLIS_Author']))
    {
        $phillis_where .= " and pa_book_author='" . $_POST['PHLIS_Author'] . "'";
    }
    if (!empty($_POST['phillis_characters']))
    {
        $phillis_where .= " and find_in_set('" . $_POST['phillis_characters'] . "',pa_book_characters)";
    }
*/
    // $_SESSION['phillis_characters'] = $_POST['phillis_characters'];
/*
$series= @mysql_query("SELECT DISTINCTROW `series`.cod FROM $dbname.`series`
 left join ($dbname.`pecas` LEFT JOIN $dbname.`codigo_pecas` ON
`pecas`.cod = `codigo_pecas`.peca) on `pecas`.serie=`series`.cod
where $fpais and $ftipo and $ffamilia
and `series`.ano between '$iano' and '$fano' ORDER BY `series`.ano ASC;");
*/
////// A REFORMULAR PARA SE ADAPTAR -S LISTAS
/*------>
    $phillis_where .= " and ano between ".intval($_SESSION['phillis_iano'])." and ".intval($_SESSION['phillis_fano']);
    $phillis_arg = "select distinctrow #philcat_series.* from #philcat_series left join ( #philcat_pecas left join #philcat_pecas_codigo on #philcat_pecas.cod = #philcat_pecas_codigo.peca ) on #philcat_pecas.serie = #philcat_series.cod $phillis_where order by ano, cod";
    $phillis_count = $sql->db_Select_gen($phillis_arg, false);
    ($pref['phillis_perpage'] > 0?$phillis_arg .= " limit $phillis_from," . $pref['phillis_perpage']:"");
//    echo $phillis_arg; 
    if ($sql->db_Select_gen($phillis_arg, true))
    {
        while ($phillis_row = $sql->db_Fetch())
        {
            extract($phillis_row);
            // If we use rating
            $phillis_rating = "";
            if ($ratearray = $rater->getrating("phcat", $pa_book_id))
            {
                for($c = 1;
                    $c <= $ratearray[1];
                    $c++)
                {
                    $phillis_rating .= "<img src='images/star.png' alt='' />";
                }
                if ($ratearray[2])
                {
                    $phillis_rating .= "<img src='images/" . $ratearray[2] . ".png'  alt='' />";
                }
                if ($ratearray[2] == "")
                {
                    $ratearray[2] = 0;
                }
                // $phillis_rating .="&nbsp;" . $ratearray[1] . "." . $ratearray[2] . " - " . $ratearray[0] . "&nbsp;";
                // $phillis_rating .=($ratearray[0]==1 ? RCPEMENU_89 : RCPEMENU_88);
            }
            else
            {
                $phillis_rating .= "<span class='smalltext'>" .LAN_PLUGIN_PHILLIS_53 . "</span>";
            }
<-----*/
//            $phillis_tmp = explode(".", $pa_book_author, 2);
//            $phillis_text .= "
//	<tr>
//		<td id='nav' style='width:100% !important; padding: 0px !important'><ul><li><h4>".$tp->toHTML($ano)." : ".$tp->toHTML($desc).(is_null($emissao)?"":$tp->toHTML($emissao).LAN_PLUGIN_PHILLIS_100." ".LAN_PLUGIN_PHILLIS_101)."<span style='float:right;'><label for='mytoggle".$tp->toHTML($cod)."' class='toggle'><img src='images/show_hide.png'></label></span></h4></li></ul></td></tr>";
/*            $phillis_text .= "
	<tr>
		<td class='forumheader3'><a href='" . e_SELF . "?$phillis_from.listf.$pa_book_id'>" . $tp->toHTML($pa_book_title) . "</a>";
*/
/*
            $phillis_text .= "
	<tr>
		<td class='forumheader'>
<div>    
    <table width=100%>
      <tr>
        <td class='cserie'>".LAN_PLUGIN_PHILLIS_102." :</td><td class='tcserie'>".$tp->toHTML($desenho)."</td><td class='cserie'>".LAN_PLUGIN_PHILLIS_106." :</td><td class='tcserie'>".((is_null($folha_x) && is_null($folha_y))?"&nbsp;":$tp->toHTML($folha_x)." x ".$tp->toHTML($folha_y)." (".($tp->toHTML($folha_x)*$tp->toHTML($folha_y))." ".LAN_PLUGIN_PHILLIS_110.")")."</td>
      </tr><tr>
        <td class='cserie'>".LAN_PLUGIN_PHILLIS_103." :</td><td class='tcserie'>".$tp->toHTML($gravura)."</td><td class='cserie'>".LAN_PLUGIN_PHILLIS_107." :</td><td class='tcserie'>".$tp->toHTML($aplic)."</td>
      </tr><tr>
        <td class='cserie'>".LAN_PLUGIN_PHILLIS_104." :</td><td class='tcserie'>".$tp->toHTML($tipo_imp)."</td><td class='cserie'>".LAN_PLUGIN_PHILLIS_108." :</td><td class='tcserie'>".$tp->toHTML($erros)."</td>
      </tr><tr>
        <td class='cserie'>".LAN_PLUGIN_PHILLIS_105." :</td><td class='tcserie'>".$tp->toHTML($local_imp)."</td><td class='cserie'>".LAN_PLUGIN_PHILLIS_109." :</td><td class='tcserie'>".$tp->toHTML($observacoes)."</td>
      </tr>
    </table>
</div>    
    </td></tr>";
*/
/*  A VERIFICAR, VEIO DO OUTRO SCRIPT
            if ($pref['phillis_userating'] == 1 && $pa_book_rate == 1)
            {
                $phillis_text .= "<br />$phillis_rating";
            }
            $phillis_writer = "<a href='" . e_SELF . "?0.sbio.0." . $phillis_tmp[0] . "' >" . $tp->toHTML($phillis_tmp[1]) . "</a>";
            if ($pref['phillis_icons'] == 1)
            {
                if (is_readable("./images/cicons/" . $pa_category_icon . ""))
                {
                    $pa_category_name = "<img src='./images/cicons/" . $pa_category_icon . "' alt='" . $pa_category_name . "' title='" . $pa_category_name . "' style='vertical-align:middle' />&nbsp;" . $pa_category_name;
                }
                if (is_readable("./images/ticons/" . $pa_genre_icon . ""))
                {
//                    $pa_genre_name = "<img id='imageToSwap' src='./images/ticons/" . $pa_genre_icon . "' alt='" . $pa_genre_name . "' title='" . $pa_genre_name . "' style='vertical-align:middle' />";
                    $pa_genre_name = "<img id='imageToSwap' src='./images/help.png' alt='" . $pa_genre_name . "' title='" . $pa_genre_name . "' style='vertical-align:middle' />";
                }
            }
*/
/*
            $phillis_text .= "<tr>
		<td class='forumheader3' style='text-align:center;' >" . $pa_category_name . "</td>
		<td class='forumheader3' style='text-align:center;' ><nobr>" . $pa_genre_name;
    $phillis_text .= "
<style type='text/css'>
option.imagebacked {
padding: 0px 0 0px 20px;
background-repeat: no-repeat;
background-position: 0px 1px;
vertical-align: middle;
}
select.imagebacked {
padding: 0px 0 0px 20px;
background-repeat: no-repeat;
background-position: 0px 1px;
vertical-align: middle;
}
</style>        
    <select name='phillis_usergenre' class='tbox imagebacked' style='background-image: url(images/ticons/ic_". $pa_genre_icon . ");'>";
*/
/*
$results=query_count("Select DISTINCTROW `pecas`.`cod`,`pecas`.`serie`,`pecas`.`i_circ`,`pecas`.`f_circ`,`pecas`.`tiragem`,`pecas`.`papel`,`pecas`.`denteado`
,`pecas`.`valor_facial`,`pecas`.`cor`,`pecas`.`texto_descritivo`,`codigo_pecas`.`tipo`,`codigo_pecas`.`familia`,`tipo`.`desc` AS
`tdesc`,`denteados`.`denteado` AS `ddesc`, `papel`.`papel` AS `pdesc`,`familias`.`catalogo` AS
`ncatalogo`,`familias`.`desc` AS `fdesc` from $dbname.`pecas` left join
($dbname.`codigo_pecas` left join $dbname.`tipo` on
`tipo`.`cod` = `codigo_pecas`.`tipo`
) on `pecas`.`cod` = `codigo_pecas`.`peca`
 left join $dbname.`denteados` on `denteados`.`cod` = `pecas`.`denteado`
 left join $dbname.`papel` on `papel`.`cod` = `pecas`.`papel`
 left join $dbname.`familias` on `familias`.`cod` = `codigo_pecas`.`familia`
where $codser
 order by `pecas`.`cod`;");
*/
//     $phillis_arg = "select distinctrow #philcat_pecas.cod as cod_peca, #philcat_pecas.*, #philcat_pecas_codigo.*, #philcat_tipo.desc as desc_tipo, #philcat_denteados.desc as desc_denteado, #philcat_papel.desc as desc_papel, #philcat_familias.cat, #philcat_familias.desc  as desc_familias from #philcat_pecas left join ( #philcat_pecas_codigo left join #philcat_tipo on #philcat_tipo.cod = #philcat_pecas_codigo.tipo ) on #philcat_pecas.cod = #philcat_pecas_codigo.peca left join #philcat_denteados on #philcat_denteados.cod = #philcat_pecas.dent left join #philcat_papel on #philcat_papel.cod = #philcat_pecas.papel left join #philcat_familias on #philcat_familias.cod = #philcat_pecas_codigo.familia where #philcat_pecas.serie = ".$cod." AND #philcat_pecas_codigo.cat =1 order by #philcat_pecas.cod";
//     $phillis_arg = "select distinctrow #philcat_pecas.cod as cod_peca, #philcat_pecas.*, #philcat_pecas_codigo.*, #philcat_tipo.desc as desc_tipo, #philcat_denteados.desc as desc_denteado, #philcat_papel.desc as desc_papel, #philcat_familias.cat, #philcat_familias.desc  as desc_familias from #philcat_pecas left join ( #philcat_pecas_codigo left join #philcat_tipo on #philcat_tipo.cod = #philcat_pecas_codigo.tipo ) on #philcat_pecas.cod = #philcat_pecas_codigo.peca left join #philcat_denteados on #philcat_denteados.cod = #philcat_pecas.dent left join #philcat_papel on #philcat_papel.cod = #philcat_pecas.papel left join #philcat_familias on #philcat_familias.cod = #philcat_pecas_codigo.familia where #philcat_pecas.serie = ".$cod.($_SESSION['phillis_tipo']>0?" AND #philcat_tipo.cod = ".$_SESSION['phillis_tipo']:"").($_SESSION['phillis_familia']>0?" AND #philcat_familias.cod = ".$_SESSION['phillis_familia']:"")." AND #philcat_pecas_codigo.cat =1 order by #philcat_pecas.cod";
// POR AGORA TEM DE FICAR ASSIM, PARA LISTAR APENAS OS AFINSA!!!!!!
//    echo "<hr>".$phillis_arg; 
//    if ($sql2->db_Select_gen($phillis_arg, false))
//    if ($sql2->db_Select("pa_genre", "pa_genre_id,pa_genre_name,pa_genre_icon", " order by pa_genre_name", "nowhere", false))
//    {
//        $phillis_tiposel .= "<option value='0' >" .LAN_PLUGIN_PHILLIS_5 . "</option>";
/*
SELECT user_id, fltn.count AS nfltcount, fltu.count AS ufltcount, trcn.count AS ntrccount, trcu.count AS utrccount
FROM e107_user
LEFT JOIN (
SELECT e107_phillistfltn.user, count( e107_phillistfltn.user ) AS count
FROM e107_phillistfltn
) AS fltn ON user_id = fltn.user
LEFT JOIN (
SELECT e107_phillistfltu.user, count( e107_phillistfltu.user ) AS count
FROM e107_phillistfltu
) AS fltu ON user_id = fltu.user
LEFT JOIN (
SELECT e107_phillistfltu.user, count( e107_phillistfltu.user ) AS count
FROM e107_phillistfltu
) AS trcu ON user_id = fltu.user
LEFT JOIN (
SELECT e107_phillistfltu.user, count( e107_phillistfltu.user ) AS count
FROM e107_phillistfltu
) AS trcn ON user_id = fltu.user
WHERE fltn.count IS NOT NULL
AND fltu.count IS NOT NULL
AND trcn.count IS NOT NULL
AND trcu.count IS NOT NULL
*/
/* #######################3
    $phillis_from = intval($_POST['phillis_from']);
////    $phillis_arg = "SELECT user_id, user_name, fltn.count AS nfltcount, fltu.count AS ufltcount, trcn.count AS ntrccount, trcu.count AS utrccount, fltn.actdata as afltn, fltu.actdata as afltu, trcn.actdata as atrcn, trcu.actdata as atrcu FROM #user LEFT JOIN (SELECT user, count(user) AS count, max(data) AS actdata FROM #phillist_fltn GROUP BY user) AS fltn ON user_id = fltn.user LEFT JOIN (SELECT user, count(user) AS count, max(data) AS actdata FROM #phillist_fltu GROUP BY user) AS fltu ON user_id = fltu.user LEFT JOIN (SELECT user, count(user) AS count, max(data) AS actdata FROM #phillist_trcn GROUP BY user) AS trcn ON user_id = trcn.user LEFT JOIN (SELECT user, count(user) AS count, max(data) AS actdata FROM #phillist_trcu GROUP BY user) AS trcu ON user_id = trcu.user WHERE (coalesce( fltn.count, 0 ) + coalesce( fltu.count, 0 ) + coalesce( trcn.count, 0 ) + coalesce( trcu.count, 0 )) >0".(USERID>0?" OR user_id = ".USERID:"")." GROUP BY user_id";
    $phillis_arg = "SELECT user_id, user_name, fltn.count AS nfltcount, fltu.count AS ufltcount, trcn.count AS ntrccount, trcu.count AS utrccount, fltn.actdata as afltn, fltu.actdata as afltu, trcn.actdata as atrcn, trcu.actdata as atrcu FROM #user LEFT JOIN (SELECT user, count(user) AS count, max(data) AS actdata FROM #phillist_fltn GROUP BY user) AS fltn ON user_id = fltn.user LEFT JOIN (SELECT user, count(user) AS count, max(data) AS actdata FROM #phillist_fltu GROUP BY user) AS fltu ON user_id = fltu.user LEFT JOIN (SELECT user, count(user) AS count, max(data) AS actdata FROM #phillist_trcn GROUP BY user) AS trcn ON user_id = trcn.user LEFT JOIN (SELECT user, count(user) AS count, max(data) AS actdata FROM #phillist_trcu GROUP BY user) AS trcu ON user_id = trcu.user WHERE (coalesce( fltn.count, 0 ) + coalesce( fltu.count, 0 ) + coalesce( trcn.count, 0 ) + coalesce( trcu.count, 0 )) >0";
//    echo $phillis_arg;
//var_dump ($pref['phillis_perpage']);
    ($pref['phillis_perpage'] > 0?$phillis_arg .= " limit $phillis_from," . $pref['phillis_perpage']:"");
// #######ISTO � PRECISO POR CAUSA DO BYETHOST!!!!!!!!!!!
//    $phillis_count = $sql->gen("SET SQL_BIG_SELECTS=1", false);
//    echo $phillis_count;
//  echo "<hr>";
    $phillis_count = $sql->gen($phillis_arg, true);
*/ ////###############
//    echo $phillis_count;
//  echo "<hr>";
// echo $phillis_arg;
///    echo "<hr><hr>";
///    print_r ($phillis_gettables_row = $sql->db_getList());
/*
    echo "<hr><hr>";
    print_r ($sql->gen($phillis_arg, false));
    echo "<hr><hr>";
    print_r ($phillis_arg);
    echo "<hr><hr>";
*/
/*
    echo "<hr><hr>";
    print_r ($phillis_count);
    echo "-----------------<hr><hr>";
var_dump($sql->gen($phillis_arg, false));
    echo "<hr><hr>";
      if ($sql->gen($phillis_arg, false))
*/
//    {
//var_dump ($template);
//exit;
//$phillis_text .= $tp->parsetemplate($template['start'], false, $sc);
//echo "<hr>";
//var_dump ($template['start']);
//exit;
/*
function customShift($phllist_array, $phillis_id){
//var_dump($phllist_array);
    foreach($phllist_array as $phillis_key => $phillis_val){     // loop all elements
//  echo "-----KEY:".$key;
//  echo "<hr>".var_dump($val)."<hr>";
//  echo " ID:".$id;
//  echo " -------> USERID:".$val[user_id];
//        if($val->user_id == $id){             // check for id $id
        if($phillis_val[user_id] == $phillis_id){             // check for id $id
            unset($phllist_array[$phillis_key]);         // unset the $phllist_array with id $id
            array_unshift($phllist_array, $phillis_val); // unshift the array with $val to push in the beginning of array
            return $phllist_array;               // return new $phllist_array
        }
    }
}
*/
//$phillis_tables_row = search($sql_lista_array, 'user_id', USERID);
//echo "<hr>";
//echo "<hr>";
//print_r(customShift($sql_lista_array, USERID));
//echo "<hr>";
//echo "<hr>";
//  $phillis_sql_lista_array = $sql->db_getList();
/*
$phillis_sql_lista_array = (USERID?(customShift($sql->rows(), USERID)):$sql->rows());
echo "<hr>";
print_r($phillis_sql_lista_array);
echo "<hr>";
echo USERID;
*/
$phillis_array=$sql->rows();
////$temp = $sql->gen($phillis_arg, true);

///$phillis_array = $sql->rows();
/*
echo "<hr>==========================".var_dump($sql);
echo "<hr>";
*/
/*
if (USERID){
echo "<hr>==========================".print_r($phllis_array);
echo "<hr>";
*/
//echo "<hr><hr><hr>-------";
//print_r($sql);
//echo "<hr>";
/*
echo "<hr><hr><hr>-------";
var_dump ($temp);
echo "<hr><hr><hr>-------";
var_dump ($phillis_array);
echo "<hr>";
*/
    if (USERID) {
    foreach($phillis_array as $phillis_key => $phillis_val){     // loop all elements
        if($phillis_val['user_id'] == USERID){             // check for id $id
            unset($phillis_array[$phillis_key]);         // unset the $phllist_array with id $id
            array_unshift($phillis_array, $phillis_val); // unshift the array with $val to push in the beginning of array
/////////////////////////////            $phillis_sql_lista_array=$phillis_array;               // return new $phllist_array
            }
//       else
//            {
//                $phillis_sql_lista_array=$phillis_array;
//            }

} /// Foreach

/*
    echo "<pre>";
    var_dump ($phillis_array);
    echo "</pre>";
*/
if($phillis_array[0]['user_id'] != USERID){
  array_unshift($phillis_array, array('user_id' => USERID, 'user_name' => USERNAME)); // unshift the array with $val to push in the beginning of array
}// check for id $id

}
/*
    echo "<pre>";
    var_dump ($phillis_array);
    echo "</pre>";
*/

////////////////////////////     else
////////////////////////////    {
////////////////////////////                $phillis_sql_lista_array=$phillis_array;
////////////////////////////    }
//    }
/*
echo "<hr><hr><hr>-------";
print_r($phillis_sql_lista_array);
echo "<hr>";
*/



/*
            $phillis_text .= "<table width=100%><tr>
		<th class='fcaption'>" .LAN_PLUGIN_PHILLIS_111 . "</th>
		<th class='fcaption cen'>" .LAN_PLUGIN_PHILLIS_112 . "<br><span class='smalltext'>( " .LAN_PLUGIN_PHILLIS_100 .")</span></th>
		<th class='fcaption cen'>" .LAN_PLUGIN_PHILLIS_113 . "<br><span class='smalltext'>( " .LAN_PLUGIN_PHILLIS_100 .")</span></th>
		<th class='fcaption cen'>" .LAN_PLUGIN_PHILLIS_114 . "<br><span class='smalltext'>( " .LAN_PLUGIN_PHILLIS_100 .")</span></th>
		<th class='fcaption cen'>" .LAN_PLUGIN_PHILLIS_115 . "<br><span class='smalltext'>( " .LAN_PLUGIN_PHILLIS_100 .")</span></th>
    </tr>";
*/
// TAMB�M TENHO DE VERIFICAR SE O UTILIZADOR TEM LISTAS DE TROCAS, ANTES DE MOSTRAR O ICONE DE CRUZAR AS LISTAS DE TROCAS E FALTAS.... ;D
/*
	function dados_lista($index, $quant, $dataact, $userid)
	{
  global $tp;
//    phillis_10." ".LAN_PLUGIN_PHILLIS_38
//    return ($quant>0?"<a title='".LAN_PLUGIN_PHILLIS_15."' href='".e_SELF."?".$index.".".$userid."'>".$quant." ".LAN_PLUGIN_PHILLIS_110."</a>".($dataact>0?"<br><span class='smalltext' title='".LAN_PLUGIN_PHILLIS_100.$dataact."'>(".$dataact.")</span>":""):"");
//    echo " - ";
//    echo $quant>0 && USERID==$userid;
//    echo ($quant>0 && USERID==$userid?".":"-");
    $phil_link_title = ($quant>0?phillis_15:(USERID==$userid?phillis_10:""))." ".LAN_PLUGIN_PHILLIS_38;
    $phil_link_href = e_SELF."?".$index.($quant>0?".":(USERID==$userid?"-":".")).$userid;
    $phil_link_text = ($quant>0?$quant." ".LAN_PLUGIN_PHILLIS_110:(USERID==$userid?phillis_10." ".LAN_PLUGIN_PHILLIS_38:""));
echo "<hr>AQUI AQUI";
///    return "<a title='".($quant>0?phillis_15:(USERID==$userid?phillis_10:""))." ".LAN_PLUGIN_PHILLIS_38."' href='".e_SELF."?".$index.($quant>0?".":(USERID==$userid?"-":".")).$userid."'>".($quant>0?$quant." ".LAN_PLUGIN_PHILLIS_110:(USERID==$userid?phillis_10." ".LAN_PLUGIN_PHILLIS_38:""))."</a>".($dataact>0?"<br><span class='smalltext' title='".LAN_PLUGIN_PHILLIS_100.$dataact."'>(".$dataact.")</span>":"");
//var_dump ($phillis_MAIN_LINKS);
    return $tp->parsetemplate($phillis_MAIN_LINKS, true, $sc);
  }
*/
/*
  if(USERID>0){
  $phillis_trcini = "<div class='trc'><a href='".e_SELF;
  $phillis_trcfim = ".0'><img title='".LAN_PLUGIN_PHILLIS_16."' src='images/compare.png'></a></div>";
  }
*/
/*
function search($phllist_array, $key, $value)
{
    $results = array();
    search_r($phllist_array, $key, $value, $results);
    return $results;
}
function search_r($phllist_array, $key, $value, &$results)
{
    if (!is_array($phllist_array)) {
        return;
    }
    if (isset($phllist_array[$key]) && $phllist_array[$key] == $value) {
        $results[] = $phllist_array;
    }
    foreach ($phllist_array as $subarray) {
//      var_dump($phllist_array);
//      echo "<hr>";
        search_r($subarray, $key, $value, $results);
    }
}
  $phillis_sql_lista_array = $sql->db_getList();
//var_dump ($phillis_sql_lista_array);
//  print_r ($phillis_sql_lista_array);
//echo "<hr>";
//print_r(search($phillis_sql_lista_array, 'user_id', USERID));
//$user_list = search($phillis_sql_lista_array, 'user_id', USERID);
$phillis_tables_row = search($phillis_sql_lista_array, 'user_id', USERID);
*/
//echo "<hr>";
//echo explode($user_list);
//echo "<hr>";
/*
function arrayRecursiveDiff($aArray1, $aArray2) {
  $aReturn = array();
  foreach ($aArray1 as $mKey => $mValue) {
    if (array_key_exists($mKey, $aArray2)) {
      if (is_array($mValue)) {
        $aRecursiveDiff = arrayRecursiveDiff($mValue, $aArray2[$mKey]);
        if (count($aRecursiveDiff)) { $aReturn[$mKey] = $aRecursiveDiff; }
      } else {
        if ($mValue != $aArray2[$mKey]) {
          $aReturn[$mKey] = $mValue;
        }
      }
    } else {
      $aReturn[$mKey] = $mValue;
    }
  }
  return $aReturn;
} 
*/
/*
function arr_diff($a1,$a2){
  foreach($a1 as $k=>$v){
    unset($dv);
    if(is_int($k)){
      // Compare values
      if(array_search($v,$a2)===false) $dv=$v;
      else if(is_array($v)) $dv=arr_diff($v,$a2[$k]);
      if($dv) $diff[]=$dv;
    }else{
      // Compare noninteger keys
      if(!$a2[$k]) $dv=$v;
      else if(is_array($v)) $dv=arr_diff($v,$a2[$k]);
      if($dv) $diff[$k]=$dv;
    }   
  }
  return $diff;
}
*/
//$arr1 =    arrayRecursiveDiff($big_array,$small_array);
//print_r(array_diff($phillis_sql_lista_array, $user_list));
//print_r(arrayRecursiveDiff($phillis_sql_lista_array, $user_list));
//print_r(arr_diff($phillis_sql_lista_array, $user_list));
/*
function my_serialize(&$arr,$pos){
  $arr = serialize($arr);
}
function my_unserialize(&$arr,$pos){
  $arr = unserialize($arr);
}
//make a copy
$first_array_s = $phillis_sql_lista_array;
$second_array_s = $phillis_tables_row;
echo "<hr>";
var_dump($phillis_sql_lista_array);
echo "<hr>";
var_dump($phillis_tables_row);
// serialize all sub-arrays
array_walk($first_array_s,'my_serialize');
array_walk($second_array_s,'my_serialize');
// array_diff the serialized versions
$diff = array_diff($first_array_s,$second_array_s);
// unserialize the result
array_walk($diff,'my_unserialize');
// you've got it!
*/
/*
function arrayRecursiveDiff($aArray1, $aArray2) {
  $aReturn = array();
  foreach ($aArray1 as $mKey => $mValue) {
    if (array_key_exists($mKey, $aArray2)) {
      if (is_array($mValue)) {
        $aRecursiveDiff = arrayRecursiveDiff($mValue, $aArray2[$mKey]);
        if (count($aRecursiveDiff)) { $aReturn[$mKey] = $aRecursiveDiff; }
      } else {
        if ($mValue != $aArray2[$mKey]) {
          $aReturn[$mKey] = $mValue;
        }
      }
    } else {
      $aReturn[$mKey] = $mValue;
    }
  }
  return $aReturn;
} 
  $diff = arrayRecursiveDiff($phillis_sql_lista_array,$phillis_tables_row);
*/
//$my_value = 3;
//$filtered_array = array_filter($phillis_sql_lista_array, function ($element) use ($phillis_tables_row) { return ($element != $phillis_tables_row); } );
//print_r($filtered_array); 
/*
  echo "<hr>";
var_dump($phillis_sql_lista_array);
echo "<hr>";
var_dump($phillis_tables_row);
echo "<hr>";
var_dump(array_keys($phillis_sql_lista_array, $phillis_tables_row));
echo "<hr>";
echo "<hr>";
var_dump($diff);
*/
//print_r($diff); 
/*
  if(USERID>0){
    define("phillis_trcini","<div class='trc'><a href='".e_SELF);
    define("phillis_trcfim",".0'><img title='".LAN_PLUGIN_PHILLIS_16.LAN_PLUGIN_PHILLIS_35."' src='images/compare.png'></a></div>");
  ((USERID>0)?"<div class='trc'><a href='".e_SELF:"")
    define("phillis_trcfim",);
  }
*/
/*
function linha_format ($phillis_tables_row, $current)
{
global $gstyle_obj;
            return "<tr class='user".($current?" current":"")."'>
    <td class='forumheader3 lef'>".$gstyle_obj->showUser($phillis_tables_row[user_id])."</td>
		<td class='forumheader3 cen'>".dados_lista("n",$phillis_tables_row[nfltcount],$phillis_tables_row[afltn],$phillis_tables_row[user_id]).((USERID && USERID!=$phillis_tables_row[user_id] && $phillis_tables_row[nfltcount]>0)?phillis_trcini."?n.".$phillis_tables_row[user_id].LAN_PLUGIN_PHILLIS_trcfim:"")."</td>
		<td class='forumheader3 cen'>".dados_lista("u",$phillis_tables_row[ufltcount],$phillis_tables_row[afltu],$phillis_tables_row[user_id]).((USERID && USERID!=$phillis_tables_row[user_id] && $phillis_tables_row[ufltcount]>0)?phillis_trcini."?u.".$phillis_tables_row[user_id].LAN_PLUGIN_PHILLIS_trcfim:"")."</td>
		<td class='forumheader3' style='text-align:center'>".dados_lista("o",$phillis_tables_row[ntrccount],$phillis_tables_row[atrcn],$phillis_tables_row[user_id])."</td>
		<td class='forumheader3' style='text-align:center'>".dados_lista("s",$phillis_tables_row[utrccount],$phillis_tables_row[atrcu],$phillis_tables_row[user_id])."</td>
    </tr>
";
}
*/
//echo "<hr>";
//  print_r ($user_list);
//linha_format($user_list[0],1)
//var_dump ($user_list);
//echo "<hr>".$user_list[0]['user_id']." : ".USERID."<hr>";
//        $phillis_tables_row = $phillis_tables_row[1];
//        if ($phillis_tables_row['user_id']==USERID) {$phillis_text .= $tp->parsetemplate($phillis_MAIN_INI_LIN_CUSER.$phillis_MAIN_LIN, true, $sc);}
//        unset($phillis_tables_row);
//        if ($user_list <> "" && USERID) {$phillis_text .= linha_format($user_list[0],1);}
//        foreach ( $sql->db_getList() as $phillis_tables_row)
//        foreach ($diff as $phillis_tables_row)
//var_dump ($phillis_sql_lista_array);
/////////////////////////////////////////        foreach ($phillis_sql_lista_array as $phillis_tables_row)
        foreach ($phillis_array as $phillis_tables_row)
        {
/*
echo "<hr>";
print_r($phillis_tables_row);
echo "<hr>";
*/
//var_dump ($phillis_tables_row);
/*            $phillis_text .= "
		<tr class='user".(USERID&&USERID==$phillis_tables_row[user_id]?" current":"")."'>
    <td class='forumheader3 lef'>".$gstyle_obj->showUser($phillis_tables_row[user_id])."</td>
		<td class='forumheader3 cen'>".($phillis_tables_row[nfltcount]>0?"<a title='" .LAN_PLUGIN_PHILLIS_15 . "' href='" . e_SELF . "?n." . $phillis_tables_row[user_id] . "'>".$phillis_tables_row[nfltcount]." " .LAN_PLUGIN_PHILLIS_110 . "</a>".($phillis_tables_row[afltn]>0?"<br><span class='smalltext' title='".LAN_PLUGIN_PHILLIS_100.$phillis_tables_row[afltn]."'>(".$phillis_tables_row[afltn].")</span>":""):"").((USERID&&USERID!=$phillis_tables_row[user_id])?$phillis_trcini."?n.".$phillis_tables_row[user_id].$phillis_trcfim:"")."</td>
		<td class='forumheader3 cen'>".($phillis_tables_row[ufltcount]>0?"<a title='" .LAN_PLUGIN_PHILLIS_15 . "' href='" . e_SELF . "?u." . $phillis_tables_row[user_id] . "'>".$phillis_tables_row[ufltcount]." " .LAN_PLUGIN_PHILLIS_110 . "</a>".($phillis_tables_row[afltu]>0?"<br><span class='smalltext' title='".LAN_PLUGIN_PHILLIS_100.$phillis_tables_row[afltu]."'>(" .$phillis_tables_row[afltu].")</span>":""):"").((USERID&&USERID!=$phillis_tables_row[user_id])?$phillis_trcini."?u.".$phillis_tables_row[user_id].$phillis_trcfim:"")."</td>
		<td class='forumheader3' style='text-align:center'>".($phillis_tables_row[ntrccount]>0?"<a title='" .LAN_PLUGIN_PHILLIS_15 . "' href='" . e_SELF . "?o." . $phillis_tables_row[user_id] . "'>".$phillis_tables_row[ntrccount]." " .LAN_PLUGIN_PHILLIS_110 . "</a><br>".($phillis_tables_row[atrcn]>0?"<br><span class='smalltext' title='".LAN_PLUGIN_PHILLIS_100.$phillis_tables_row[atrcn]."'>(" .$phillis_tables_row[atrcn].")</span>":""):"")."</td>
		<td class='forumheader3' style='text-align:center'>".($phillis_tables_row[utrccount]>0?"<a title='" .LAN_PLUGIN_PHILLIS_15 . "' href='" . e_SELF . "?s." . $phillis_tables_row[user_id] . "'>".$phillis_tables_row[utrccount]." " .LAN_PLUGIN_PHILLIS_110 . "</a><br>".($phillis_tables_row[atrcu]>0?"<br><span class='smalltext' title='".LAN_PLUGIN_PHILLIS_100.$phillis_tables_row[atrcu]."'>(" .$phillis_tables_row[atrcu].")</span>":""):"")."</td>
    </tr>
";
*/
/*
            $LAN_PLUGIN_PHILLIS_inha = "
		<tr class='user".(USERID==$phillis_tables_row[user_id]?" current":"")."'>
    <td class='forumheader3 lef'>".$gstyle_obj->showUser($phillis_tables_row[user_id])."</td>
		<td class='forumheader3 cen'>".dados_lista("n",$phillis_tables_row[nfltcount],$phillis_tables_row[afltn],$phillis_tables_row[user_id]).((USERID && USERID!=$phillis_tables_row[user_id])?$phillis_trcini."?n.".$phillis_tables_row[user_id].$phillis_trcfim:"")."</td>
		<td class='forumheader3 cen'>".dados_lista("u",$phillis_tables_row[ufltcount],$phillis_tables_row[afltu],$phillis_tables_row[user_id]).((USERID && USERID!=$phillis_tables_row[user_id])?$phillis_trcini."?u.".$phillis_tables_row[user_id].$phillis_trcfim:"")."</td>
		<td class='forumheader3' style='text-align:center'>".dados_lista("o",$phillis_tables_row[ntrccount],$phillis_tables_row[atrcn],$phillis_tables_row[user_id])."</td>
		<td class='forumheader3' style='text-align:center'>".dados_lista("s",$phillis_tables_row[utrccount],$phillis_tables_row[atrcu],$phillis_tables_row[user_id])."</td>
    </tr>
";
          if (USERID==$phillis_tables_row[user_id]) $LAN_PLUGIN_PHILLIS_inhau = $LAN_PLUGIN_PHILLIS_inha else $LAN_PLUGIN_PHILLIS_inhat = $LAN_PLUGIN_PHILLIS_inha; 
*/
//        if ($phillis_tables_row['user_id']==USERID) {$phillis_text .= $tp->parsetemplate($phillis_MAIN_INI_LIN_CUSER.$phillis_MAIN_LIN, true, $sc);}
//    cachevars('phillis_tables_row', $phillis_tables_row);
//    e107::setRegistry('phillis_tables_row', $phillis_tables_row);  //? Porque não passa isto directo para o sc?

    $sc->setVars(array( 'phillis_row_data' => $phillis_tables_row ));
    $phillis_text .= $tp->parsetemplate($template['item'], true, $sc);
/*
echo "<hr>";
print_r($phillis_text);
echo "<hr>";
*/
/////////            $phillis_text .= linha_format($phillis_tables_row,0);
/*
            $phillis_text .= "
		<tr class='user".(USERID==$phillis_tables_row[user_id]?" current":"")."'>
    <td class='forumheader3 lef'>".$gstyle_obj->showUser($phillis_tables_row[user_id])."</td>
		<td class='forumheader3 cen'>".dados_lista("n",$phillis_tables_row[nfltcount],$phillis_tables_row[afltn],$phillis_tables_row[user_id]).((USERID && USERID!=$phillis_tables_row[user_id] && $phillis_tables_row[nfltcount]>0)?$phillis_trcini."?n.".$phillis_tables_row[user_id].$phillis_trcfim:"")."</td>
		<td class='forumheader3 cen'>".dados_lista("u",$phillis_tables_row[ufltcount],$phillis_tables_row[afltu],$phillis_tables_row[user_id]).((USERID && USERID!=$phillis_tables_row[user_id] && $phillis_tables_row[ufltcount]>0)?$phillis_trcini."?u.".$phillis_tables_row[user_id].$phillis_trcfim:"")."</td>
		<td class='forumheader3' style='text-align:center'>".dados_lista("o",$phillis_tables_row[ntrccount],$phillis_tables_row[atrcn],$phillis_tables_row[user_id])."</td>
		<td class='forumheader3' style='text-align:center'>".dados_lista("s",$phillis_tables_row[utrccount],$phillis_tables_row[atrcu],$phillis_tables_row[user_id])."</td>
    </tr>
";
*/
/*
            $phillis_text .= "
		<tr class='user".(USERID==$phillis_tables_row[user_id]?" current":"")."'>
    <td class='forumheader3 lef'>".$gstyle_obj->showUser($phillis_tables_row[user_id])."</td>
		<td class='forumheader3 cen'>".($phillis_tables_row[nfltcount]>0?"<a title='" .LAN_PLUGIN_PHILLIS_15 . "' href='" . e_SELF . "?n." . $phillis_tables_row[user_id] . "'>".$phillis_tables_row[nfltcount]." " .LAN_PLUGIN_PHILLIS_110 . "</a>".($phillis_tables_row[afltn]>0?"<br><span class='smalltext' title='".LAN_PLUGIN_PHILLIS_100.$phillis_tables_row[afltn]."'>(".$phillis_tables_row[afltn].")</span>":""):"").((USERID && USERID!=$phillis_tables_row[user_id])?$phillis_trcini."?n.".$phillis_tables_row[user_id].$phillis_trcfim:"")."</td>
		<td class='forumheader3 cen'>".($phillis_tables_row[ufltcount]>0?"<a title='" .LAN_PLUGIN_PHILLIS_15 . "' href='" . e_SELF . "?u." . $phillis_tables_row[user_id] . "'>".$phillis_tables_row[ufltcount]." " .LAN_PLUGIN_PHILLIS_110 . "</a>".($phillis_tables_row[afltu]>0?"<br><span class='smalltext' title='".LAN_PLUGIN_PHILLIS_100.$phillis_tables_row[afltu]."'>(" .$phillis_tables_row[afltu].")</span>":""):"").((USERID && USERID!=$phillis_tables_row[user_id])?$phillis_trcini."?u.".$phillis_tables_row[user_id].$phillis_trcfim:"")."</td>
		<td class='forumheader3' style='text-align:center'>".($phillis_tables_row[ntrccount]>0?"<a title='" .LAN_PLUGIN_PHILLIS_15 . "' href='" . e_SELF . "?o." . $phillis_tables_row[user_id] . "'>".$phillis_tables_row[ntrccount]." " .LAN_PLUGIN_PHILLIS_110 . "</a>".($phillis_tables_row[atrcn]>0?"<br><span class='smalltext' title='".LAN_PLUGIN_PHILLIS_100.$phillis_tables_row[atrcn]."'>(" .$phillis_tables_row[atrcn].")</span>":""):"")."</td>
		<td class='forumheader3' style='text-align:center'>".($phillis_tables_row[utrccount]>0?"<a title='" .LAN_PLUGIN_PHILLIS_15 . "' href='" . e_SELF . "?s." . $phillis_tables_row[user_id] . "'>".$phillis_tables_row[utrccount]." " .LAN_PLUGIN_PHILLIS_110 . "</a>".($phillis_tables_row[atrcu]>0?"<br><span class='smalltext' title='".LAN_PLUGIN_PHILLIS_100.$phillis_tables_row[atrcu]."'>(" .$phillis_tables_row[atrcu].")</span>":""):"")."</td>
    </tr>
";
*/
        } // FOREACH
//            $phillis_text .= "</table></td></tr>";
//    var_dump ($phillis_text);
    
//    }
/*
    else
    {
        $phillis_text .= "<center><b>" .LAN_PLUGIN_PHILLIS_77 . "</b></center>";
    }
*/
//    $phillis_text .= "</select>";
/*
<option value='http://images.devshed.com/af/caticons/braindump.gif'>Brain Dump</option>
<option value='http://images.devshed.com/af/caticons/asp.gif'>ASP</option>
<option value='http://images.devshed.com/af/caticons/aspnet.gif'>ASP.NET</option>
*/
//print_r ($pagenre_iconarray);
/*
$phillis_text .= "
</td>
		<td class='forumheader3' style='text-align:center;'>" . $phillis_writer . "</td>
";
*/
/*
		<td class='forumheader3' style='text-align:right;' >" . $pa_book_chapters . "</td>
*/
/*
$phillis_text .= "<td class='forumheader3' style='text-align:center;'>" . ($pa_book_complete > 0?"<img src='./images/album-valid.png' alt='" .LAN_PLUGIN_PHILLIS_11 . "' title='" .LAN_PLUGIN_PHILLIS_11 . "' />":"&nbsp;") . "</td>";
$phillis_text .= "<td class='forumheader3' style='text-align:center;'>
			<a href='../email.php?plugin:cwriter.{$pa_book_id}'>
				<img src='" . e_IMAGE . "generic/" . IMODE . "/email.png' style='border:0' alt='" .LAN_PLUGIN_PHILLIS_73 . "' title='" .LAN_PLUGIN_PHILLIS_73 . "' />
			</a>&nbsp;&nbsp;
			<a href='phillis_pdf.php?{$pa_book_id}' target='_blank'>
				<img src='" . e_PLUGIN . "pdf/images/pdf_16.png' style='border:0' alt='" .LAN_PLUGIN_PHILLIS_72 . "' title='" .LAN_PLUGIN_PHILLIS_72 . "' />
			</a>
		</td>";
*/
//$phillis_text .= "</tr>";
/*---------------->
        } // while
    }  // IF
    else
    {
            $phillis_text .= "<center><img src='".pherrimg."' style='vertical-align:middle'>&nbsp;&nbsp;&nbsp;".LAN_PLUGIN_PHILLIS_71."&nbsp;&nbsp;&nbsp;<img src='".pherrimg."' style='vertical-align:middle'></center>";
    }
<-----------------*/
/*
    $phillis_npaction = "show";
    $parms = $phillis_count . "," . $pref['phillis_perpage'] . "," . $phillis_from . "," . e_SELF . '?' . "[FROM]." . $phillis_npaction;
    $phillis_nextprev = $tp->parseTemplate("{NEXTPREV={$parms}}") . "";
    $phillis_text .= "
    <tr>
    	<td style='text-align:center;' colspan='6'>
    	$phillis_nextprev";
*/
//    $parms = $phillis_count . "," . $pref['phillis_perpage'] . "," . $phillis_from . "," . e_SELF . '?' . "[FROM].show";
//  ###### PASSAR ISTO PARA O MENU......
//var_dump($pref);
    $phillis_text .= $tp->parseTemplate("{NEXTPREV={".$phillis_count . "," . $pref['perpage'] . "," . $phillis_from . "," . e_SELF . "?[FROM].show"."}");
/// ISTO � SUPOSTO SER PARA CADA UTILIZADOR GERIR AS SUAS PR�PRIAS LISTAS... EVENTUALMENTE PASSO ISTO PARA O MENU....
/*
    if (check_class($pref['PHLIS_Admin']) || check_class($pref['phillis_create']))
    {
        $phillis_text .= "&nbsp;&nbsp;<a href='mylists.php' >" .LAN_PLUGIN_PHILLIS_32 . "</a>";
    }
*/
/*
    $phillis_text .= "
		&nbsp;</td>
	</tr>
</table>
</form>";
*/
//$phillis_text .= $tp->parsetemplate($template['end'], false, $sc);
//} // ##### FIM DA ESCRITA CASO O PLUGIN CATALOGO ESTEJA ACTIVO....

/*
    echo "<hr>";
    var_dump ($phillis_text);
    echo "<hr>";
    var_dump (!$phillis_text);
*/
//// ########    if (!$phillis_count) {$phillis_text = "<div class='alert alert-warning'>".LAN_PLUGIN_PHILLIS_77."</div>";}



    }
    else
    {
        $phillis_text .= "<div class='alert alert-warning'>".LAN_PLUGIN_PHILLIS_77."</div>";
}

$phillis_text .= $tp->parsetemplate($template['end'], true, $sc);

if (ADMIN == TRUE) {
  e107::lan('phillis',"admin", true);
  if (!check_class($pref['create'])){
    $msg->addwarning(LANAD_PLUGIN_PHILLIS_20);
    $phillis_text = $msg->render().$phillis_text;
  }
}
require_once(HEADERF);

$ns->tablerender(($phillis_caption??""), $phillis_text);
/*
if ($comment_to > 0 && $pref['phillis_usecomments'] > 0)
{
    $phillis_com->compose_comment("phcat", "comment", $comment_to, $width, $comment_sub, false);
}
*/
require_once(FOOTERF);