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
//if ($phillis_whatdo <> "pr"){
  if (!defined('e107_INIT'))
  {
    require_once(__DIR__.'/../../class2.php');
  }

//  if (!defined('e107_INIT')){exit;}
/*
echo "<hr><hr><hr>";
var_dump (e107::isInstalled('philcat'));
echo "<hr><hr><hr>";
exit;
*/
//var_dump ((e_QUERY == ""));
//var_dump (!e107::isInstalled('phil_cat') || (e_QUERY == ""));
//exit;
//if (!e107::isInstalled('phil_cat') || (e_QUERY == ""))
/*
if (!e107::isInstalled('philcat'))
{
	e107::redirect();
	exit;
}
*/
e107::lan('phillis',"front", true);

if(!e_AJAX_REQUEST) {
  if(!defined('NAVIGATION_ACTIVE'))
  {
    define('NAVIGATION_ACTIVE','phillis');
  }

  $msg = e107::getMessage();

if (!e107::isInstalled('philcat'))
{
		$msg->addwarning(LAN_PLUGIN_PHILLIS_9);
    if (ADMIN == TRUE) {
        e107::lan('phillis',"admin", true);
		$msg->adderror(LANAD_PLUGIN_PHILLIS_19);
  }
}

$philis_pref=e107::getPlugPref("phillis");

if (!check_class($philis_pref['read'])) {
	$msg->addwarning(LAN_NO_PERMISSIONS);
}

if ($msg->hasMessage()) {
      require_once(HEADERF);
      echo $msg->render();
      require_once(FOOTERF);
      exit;
  }
  e107::js("footer-inline", "
  var lan_remove = '".LAN_PLUGIN_PHILLIS_50."';
  var lan_add = '".LAN_PLUGIN_PHILLIS_51."';
", "jquery");

/////define ("LEGPARA", $phillis_whatdo=='pr'?'&nbsp;&nbsp;&nbsp;':'<br>');
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
//include_lan(e_PLUGIN."phil_lis/languages/".e_LANGUAGE.".php");
//e107::lan('phillis',"front", true);
//include_lan(e_PLUGIN."phil_cat/languages/".e_LANGUAGE.".php");
//if ((!isset($pref['plug_installed']['phil_cat'])) || (e_QUERY == "")) {
//----para testes!---- if (1==1) {
// TENHO DE CORRIGIR ESTE ERRO, D� ERRO NO  PARSE HEADER
//  header('Refresh: 5; URL='.e_BASE.'index.php');
//  $phillis_caption = LAN_20;
//  $phillis_text = PHLIS_A99;
//	header("location:".e_BASE."index.php");
//	 exit;
//}
//else {
/*
$phllist_Ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
var_dump (e_AJAX_REQUEST);
if($phllist_Ajax) {
   ob_start();
  $sql = e107::getDb();
}
*/
/*
if(e_AJAX_REQUEST) {
   ob_start();
//  $sql = e107::getDb();
}
*/
//include_lan(e_PLUGIN."phil_lis/languages/".e_LANGUAGE.".php");
//include_lan(e_PLUGIN."phil_cat/languages/".e_LANGUAGE.".php");
//if(!$phllist_Ajax) {
  e107::lan('philcat',"front", true);
  define("LAN_PLUGIN_PHILLIS_PAGE_NAME", LAN_PLUGIN_PHILLIS_1);
//include_lan(e_LANGUAGEDIR.e_LANGUAGE."/lan_user.php");
e107::lan('core','user');
require_once(e_HANDLER . "userclass_class.php");

//////////////////////////////require_once(e_PLUGIN."phil/phil_class.php");

$sc = e107::getScBatch('view', 'phillis');
$sc->wrapper('phillis_view');
//if (file_exists(THEME."phillis_template.php")) {include_once(THEME."phillis_template.php");} else {include(e_PLUGIN."phil_lis/phillis_template.php");}
/////////////e107::getTemplate('phil', 'icons');

//$phillis_template = e107::getTemplate('phillis', 'phillis_view'); 	
$phillis_template = e107::getTemplate('phillis', 'phillis_view'); 	

e107::css('phillis', 'phillis.css');
// Vou usar o bootstrap normal.... N�o h�, n�o h�...
//e107::css('phil', 'phil.css'); //?
//e107::css('url', '../phil/dialog/dialog_box.css'); //?

/////e107::css("footer", "PHILLIS_class.js");
//e107::js("footer", "PHILLIS_class.js");
//// ANTIGO, TENHO DE IR BUSCAR ISTO A OUTRO SÍTIO....e107::css('phil', 'includes/dhtmltooltip.css');
///////////////////////--------------e107::js("footer", phdhtmlpop, "jquery"); // ??????????????????
//e107::js("footer", e_PLUGIN."phillis/js/phillis_ed.js", "jquery"); 

//e107::js("footer", "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js");
/*
e107::js("footer-inline", "
$(document).ready(function(){
  $('[data-bs-toggle=\"popover\"]').popover();  
});
  ", "jquery");
*/
/*
e107::js("footer", "
    let popoverTriggerList = [].slice.call( 
			document.querySelectorAll('[data-bs-toggle=\"popover\"]')) 
		
		let popoverList = 
		popoverTriggerList.map(function (popoverTriggerEl) { 
			return new bootstrap.Popover(popoverTriggerEl) 
		}) 
    ");
*/

/*
e107::js("footer-inline", "
function changePopoverContent() {

  var x = Math.floor(Math.random() * 7);
  
  let chance = '';
  switch (x) {
    case 6:
      chance = 'Chance: 1 to 13 983 816';
      break;  
    case 5:
      chance = 'Chance: 1 to 54 201';
      break;
    case 4:
      chance = 'Chance: 1 to 1 024';
      break;
    case 3:
      chance = 'Chance: 1 to 57';   
      break;
    case 2:
        chance = 'Chance: 1 to 7,5';
      break;
    case 1:
        chance = 'Chance: 1 to 2,4';
      break;
    case 0:
        chance = 'Chance 1 to 2,3';
      break;      
  }

  document.getElementsByClassName(\"imagepop\")[0].innerHTML = 'something else';

  }

  ", "jquery");
*/
/*
e107::js("footer-inline", "
document.getElementsByClassName('imagepop').addEventListener('mouseover', function() {  
    document.getElementsByClassName('popover-content')[0].innerHTML = 'dsgdfsdfdsfaerlwerkjlfkjafkdjjeiowaj'; 
});
", "jquery");
*/
/*
e107::js("footer-inline", "
$('.imagepop').addEventListener('mouseover', function(){
if($('.popover').hasClass('in')){
    $(this).popover('hide');
}
else
{
/////    $(this).attr('data-bs-content','Cannot proceed with Save while Editing a row.');
    $(this).popover('show');
}
});
", "jquery");
*/





/*-------------
$jssc = array(
  "PHLIS_PAIS" => '"+$(obj).attr(\'data-phl-pais\')+"',
  "PHLIS_IMG" => '"+$(obj).attr(\'data-phl-image\')+"',
  "PHLIS_SER" => '"+$(obj).attr(\'data-phl-serie\')+"',
  "PHLIS_DSC" => '"+$(obj).attr(\'data-phl-desc\')+"',
  "PHLIS_VAL" => '"+$(obj).attr(\'data-phl-valor\')+"',
  "PHLIS_ANO" => '"+$(obj).attr(\'data-phl-ano\')+"',
);

//$phillis_jstext = $tp->toJSON($tp->simpleparse($phillis_template['popover'], $jssc));
//$phillis_jstext = preg_replace('/^(\'[^\']*\'|"[^"]*")$/', '$2$3', ($tp->simpleparse($tp->toJSON($phillis_template['popover']), $jssc)));
//$phillis_jstext = $tp->simpleparse($phillis_template['popover'], $jssc);
//$phillis_jstext = $tp->parseSchemaTemplate($tp->toJSON($phillis_template['popover']), true, $jssc);

//$phillis_jstext = $tp->simpleparse($tp->toJSON($phillis_template['popover']), $jssc);
/////////$phillis_jstext = '"'.$tp->simpleparse($phillis_template['popover'], $jssc).'"';
$phillis_jstext = $tp->parseTemplate(json_encode($phillis_template['popover']), true, $jssc);
-------------*/





// Alternativa ao core
/*
$order = array(
  "{PHLIS_IMG}",
  "{PHLIS_SER}",
  "{PHLIS_DSC}",
  "{PHLIS_VAL}",
  "{PHLIS_ANO}",
);
$replace = array(
  '"+$(obj).attr(\'data-phl-image\')+"',
  '"+$(obj).attr(\'data-phl-serie\')+"',
  '"+$(obj).attr(\'data-phl-desc\')+"',
  '"+$(obj).attr(\'data-phl-valor\')+"',
  '"+$(obj).attr(\'data-phl-ano\')+"',
);
$phillis_jstext = str_replace($order, $replace, json_encode($phillis_template['popover']));
*/
/*
echo "<pre>";
var_dump($phillis_jstext);
echo "</pre>";
*/
///$(obj).attr('data-bs-content','werwerwerwerwer');




/*--------------
e107::js("footer-inline", "
function changePopoverContent(obj) {
if($('.popover').hasClass('in')){
    $(obj).popover('hide');
}
else
{
    $(obj).attr('data-bs-content', {$phillis_jstext});
    $(obj).popover('show');
}
    }
", "jquery");
-----------*/



/*----------------------------
e107::js("footer-inline", "
function displayPopover(obj) {
if($('.popover').hasClass('in')){
    $(obj).popover('hide');
}
else
{
    $(obj).popover('show');
}
    }
", "jquery");
-----------*/
/*
e107::js("footer-inline", "
var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle=\"popover\"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})
");
*/

e107::js("footer-inline", "
$(document).ready(function(){
	// Enable popovers everywhere
    $('[data-bs-toggle=\"popover\"]').popover();  
});
", "jquery");
//}

/*
e107::js("footer-inline", "
<!-- jQuery code to update the popover content -->
    // Get the popover element
    var popover = $('[data-bs-toggle=\"popover\"]');

    // Update the popover content when 
    // the update button is clicked
    $('.imagepop').on('click', function () {
        var newContent = 'GeeksforGeeks New popover content';
        popover.attr('data-bs-content', newContent);
        var popoverInstance = new bootstrap.Popover(popover[0]);
        popoverInstance.update();
    });

    var popoverTriggerList = [].slice.call(document
        .querySelectorAll('[data-bs-toggle=\"popover\"]'))
    var popoverList = popoverTriggerList
        .map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })
", "jquery");
*/
///$phillis_template = e107::getTemplate('phillis', 'phillis'); 	
//require_once(e_PLUGIN."phil_lis/phillis_shortcodes.php");
//          var_dump($phillis_SECTION_START);
////          echo $phillis_SECTION_START;
///var_dump($phillis_template);
///echo "<hr>----------------<hr>";
//if(!$phllist_Ajax) {
//if(!e_AJAX_REQUEST) {
require_once(e_HANDLER . "ren_help.php");
//require_once(HEADERF);

//var_dump ($pref);
//var_dump ($pref);
//exit;
//$pref=e107::getPlugPref("phillis");
//define("PHLIS_REPLXNUM",$pref['repl_xnum']);

//var_dump ($pref);

//extract($pref['phillis_settings']);
///// Um foreach?????
//var_dump ($pref);
//var_dump ($pref['allowed_views']);

$_SESSION['phillis_view'] = array('n' => $_POST['phillis_vtype']?:'d','u' => $_POST['phillis_vtype']?:'d','e' => $_POST['phillis_vtype']?:'d','c' => $_POST['phillis_vtype']?:$philis_pref['allow_compare']);

//$_SESSION['phillis_view'] = array('n' => 'd','u' => 'd','e' => 'd','c' => $pref['allow_compare']);


//$_SESSION['phillis_view'] = array('n' => $_SESSION['phillis_view']['n']?:$pref['allowed_views'],'u' => $_SESSION['phillis_view']['u']?:$pref['allowed_views'],'e' => $_SESSION['phillis_view']['e']?:$pref['allowed_eviews'],'c' => $_SESSION['phillis_view']['c']?:$pref['allow_compare']);
//$_SESSION['phillis_view'] = array($_SESSION['phillis_view'][0]?$_SESSION['phillis_view'][0]:key($allow_views['n']),$_SESSION['phillis_view'][1]?$_SESSION['phillis_view'][1]:key($allow_views['o']),$_SESSION['phillis_view'][2]?$_SESSION['phillis_view'][2]:key($allow_eviews),$_SESSION['phillis_view'][3]?$_SESSION['phillis_view'][3]:key($allow_cviews));
//var_dump(array(key($allow_views['n']),key($allow_views['o']),key($allow_eviews)));
//var_dump (e_QUERY);//include_lan(e_PLUGIN . "phil_lis/languages/" . e_LANGUAGE . ".php");
/// EST- NO P+HLIS_UPDATER
//VAR_DUMP($_SESSION['phillis_view']);
//VAR_DUMP(e_QUERY);
    }

/*
 Estrutura do e_QUERY modo vista: u.1 (u = tipo lista, 1 = userid)
 Estrutura do e_QUERY modo edição: u.1&action=edit (u = tipo lista, 1 = userid)
*/




if (e_QUERY)
{
//  var_dump(e_QUERY);
//    echo substr(e_QUERY, 1, 1);
//    $phillis_temp = explode(".", e_QUERY);
    $phillis_temp = preg_split('/[.]/', e_QUERY);
  $phillis_splitter = substr(e_QUERY, 1, 1);
//  var_dump($phillis_temp);
//$phillis_whatdo = 'pr';
//  $phillis_whatdo = (((USERID == $phillis_userid)?$phillis_splitter=='-':null)?"ed":null);
/* ANTIGO, REMOVIDO O FROM
    $phillis_codes = $phillis_temp[2];
    $phillis_from = intval($phillis_temp[0]);
    $phllist_Action = $phillis_temp[1];
    $phillis_userid = intval($phillis_temp[2]);
    $phillis_codes = $phillis_temp[3];
*/


/////echo "<hr><hr><hr>";
/////exit();

//    if ($phillis_whatdo == "pr") array_shift($phillis_temp);
//    $phillis_codes = $phillis_temp[2];
//    var_dump($phillis_temp);
    $phillis_userid = abs(intval($phillis_temp[1]));
//  $phillis_whatdo = ($phillis_whatdo?$phillis_whatdo:(((USERID == $phillis_userid)?$phillis_splitter=='-':null)?"ed":null));
  $phillis_whatdo = $phillis_whatdo ?? ((USERID == $phillis_userid) && ($_GET['action'] == 'edit')?"ed":null);
  if (!$phillis_whatdo && $_GET['action'] == 'edit') {
    $msg->addError(LAN_PLUGIN_PHILLIS_45);
  }
  //    var_dump($phillis_splitter);
    $phillis_action = ($phillis_userid==0?"show":$phillis_temp[0]);
}

if(!e_AJAX_REQUEST) {
//}

//VAR_DUMP($_SESSION{'phillis_action'});
//    var_dump($phillis_whatdo);
//    var_dump($phillis_splitter);
//    var_dump($phillis_whatdo);
//    echo $phillis_splitter;
//    echo $phillis_edit;
//VAR_DUMP($_SERVER['REQUEST_METHOD'] === "POST");
//VAR_DUMP($_POST['phillis_vtype']);
//if ($_SERVER['REQUEST_METHOD'] === "POST")
/*
if ($_POST['phillis_vtype'])
{
//VAR_DUMP($_POST);
//    echo $_POST['phillis_val'];
//    $phillis_vtype = $_POST['phillis_vtype'];
switch ($phllis_action) {
    case "u":
    case "n":
      $_SESSION['phillis_view']['n'] = $_POST['phillis_vtype'];
      break;
    case "s":
    case "o":
      $_SESSION['phillis_view']['u'] = $_POST['phillis_vtype'];
      break;
}
    if ($phillis_whatdo == "ed") $_SESSION['phillis_view']['e'] = $_POST['phillis_vtype'];
//$_SESSION['phillis_view'] = $_POST['phillis_vtype'];
//var_dump($_SESSION['phillis_view']);
//    $phillis_val = explode(",", $_POST['phillis_val']);
//    print_r ($phillis_val);
//    $phillis_temp = explode(".", $_POST['phillis_get']);
/* ANTIGO, REMOVIDO O FROM
    $phillis_from = intval($phillis_temp[0]);
    $phllis_action = $phillis_temp[1];
    $phillis_userid = intval($phillis_temp[2]);
    $phillis_codes = $phillis_temp[3];
*/
//    $phillis_from = intval($_POST['phillis_from']);
//    $phllis_action = $_POST['action'];
//    $phillis_userid = intval($_POST['phillis_bookid']);
//    $phillis_chapterid = intval($_POST['phillis_chapterid']);
/*
}
*/
//    $phllis_action = $phillis_temp[0];
//    $phillis_userid = intval($phillis_temp[1]);
//    $phllis_action = $phillis_temp[0];
//    extract($pref['phillis_settings']);
////////    cachevars('PHLIS_Allowedviews', (($phllis_action == "s" || $phllis_action == "o")?array("g", "l"):array(Null, "x")));
//    cachevars('phillis_nallowedviews', array(Null, "x"));
//    cachevars('phillis_iallowedviews', array("g", "l"));
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
//$phillis_whatdo = 'pr';
//  $phillis_whatdo = (((USERID == $phillis_userid)?$phillis_splitter=='-':null)?"ed":null);
//  $phillis_whatdo = ($phillis_whatdo?$phillis_whatdo:(((USERID == $phillis_userid)?$phillis_splitter=='-':null)?"ed":null));
//    var_dump($phillis_splitter);
//    var_dump($phillis_whatdo);
//    echo $phillis_splitter;
//    echo $phillis_edit;
//    $phillis_codes = $phillis_temp[2];
/// FIM EST- NO P+HLIS_UPDATER
//if(!$phllist_Ajax)   {
//if(!e_AJAX_REQUEST) {
if (isset($_POST['commentsubmit']))
{
    $phillis_tmp = explode(".", e_QUERY);
/* ANTIGO, REMOVIDO O FROM
    $phillis_from = intval($phillis_tmp[0]);
*/
    $phillis_action = "listf";
//    $phillis_userid = intval($phillis_tmp[2]);
    $phillis_userid = intval($phillis_tmp[1]);
    $phillis_com->enter_comment($_POST['author_name'], $_POST['comment'], "phcat", $phillis_userid, $pid, $_POST['subject']);
}
/// ---------- A GEST+O (ADI++O OU REMO++O) DE   PE+AS TEM DE FICAR AQUI POR CAUSA DO JAVASCRIPT
// GEST+O DE LISTAS, CASO VENHA NO ACTION
//echo "ACTION 2:".$phillis_action[2];
/// EST- NO P+HLIS_UPDATER
//ECHO "<HR>".$phillis_action[0];
//ECHO "=====".$phillis_action[2];
///if(!$phllist_Ajax) {
// define the over ride meta tags
// define("LAN_PLUGIN_PHILLIS_PAGE_NAME", phillis_01);
// check if we use the wysiwyg for text areas
$e_wysiwyg = "phillis_cdetails";
if ($philis_pref['wysiwyg'])
{
    $WYSIWYG = true;
}
//require_once(e_HANDLER . "userclass_class.php");
//require_once(e_HANDLER . "ren_help.php");
require_once(e_HANDLER . "rate_class.php");
$rater = new rater;
require_once(e_HANDLER . "date_handler.php");
$phillis_conv = new convert;
require_once(e_HANDLER . "comment_class.php");
$phillis_com = new comment;
//require_once(HEADERF);
$phillis_from = 0;
//require_once(e_PLUGIN.'phil_lis/phillis_class.php');
//$pl = new phillis_class();
// LOAD phillis CSS STYLE SHEET
/////$phillis_text .= $tp->parsetemplate($phillis_HEADER, true, $sc);
//$phillis_text = "<link rel='stylesheet' href='phillis.css' type='text/css' />";
// LOAD PHIL COMMON CSS STYLE SHEET
//$phillis_text .= "<link rel='stylesheet' href='".e_PLUGIN."phil/phil.css' type='text/css' />";
///}
}
//    if ($phillis_userid==0){
//      header('Location:'.e_PAGE);
//    }
//  $data_table = (($phillis_action == "s" || $phillis_action == "o")?"trc":"flt");
//  $data_table .= (($phillis_action == "s")?"u":(($phillis_action == "o")?"n":$phillis_action));
//  echo $data_table;
//if ($phillis_codes && USERID && USERID==$phillis_userid)
//  echo $phillis_codes."<hr>";
//  echo ($phillis_edit==1)."<hr>";
elseif(e_AJAX_REQUEST) {
  //if ($phillis_codes && $phillis_whatdo=="ed")
// #### IN�CIO DA EDI��O DAS LISTAS (APAGAR , ADICIONAR)
//if ($phillis_codestmp = explode('|', $phillis_temp[2]))
if ($phillis_codestmp = explode('.', $_GET['doid']))

//if ($phillis_codes)
{
//    $phillis_codestmp = explode('|', $phillis_codes);
//    array_walk( $phillis_codestmp, 'intval');
//var_dump($phillis_codestmp);
//if (intval($phillis_codestmp[1])>0)
//{
  $phillis_data_table = (($phillis_action == "s" || $phillis_action == "o")?"trc":"flt");
  $phillis_data_table .= (($phillis_action == "s")?"u":(($phillis_action == "o")?"n":$phillis_action));

if ((int)$phillis_codestmp[1]<0)
{
///  $phillis_codestmp[1] = abs($phillis_codestmp[1]);
  //if ($phillis_action[2] == "r")
//{
//    $phillis_codestmp = explode('|', $phillis_codes);
//echo $phillis_codes;
//echo "---";
//    print_r ($phillis_codestmp);
//  print_r(explode('_', 'test_underscore'));
/*
DELETE FROM `portugalstamps`.`e107_phillist_fltu` WHERE `e107_phillist_fltu`.`cod` = 3552
*/
//if ($phillis_action == "fn" || $phillis_action == "fu")
//-----if ($phillis_action == "n" || $phillis_action == "u")
//if ($phillis_action[0] == "f")
//-----{
//$phillis_rem = "DELETE FROM #phillist_flt".$phillis_action[1]." WHERE user=".USERID." AND cod=".$phillis_codestmp[1];
//-----$phillis_rem = "DELETE FROM #phillist_flt".$phillis_action." WHERE user=".USERID." AND cod=".$phillis_codestmp[1];
//-----}
/*
$phillis_rem = "DELETE FROM #phillist_".$phillis_data_table." WHERE user=".USERID." AND cod=".$phillis_codestmp[1];
echo $phillis_rem;
    if ($sql->db_Select_gen($phillis_rem, false))
*/
//$phillis_rem = "DELETE FROM #phillist_".$phillis_data_table." WHERE user=".USERID." AND cod=".$phillis_codestmp[1];
//echo $phillis_rem;
    if ($sql->delete("phillist_".$phillis_data_table, "user=".USERID." AND peca=".abs(intval($phillis_codestmp[1]))))
    {
//  $phillis_ajaxtext = LAN_PLUGIN_PHILLIS_27." ".$phillis_codestmp[0]." ( ".LAN_PLUGIN_PHILLIS_28." ".abs($phillis_codestmp[1])." ) ".LAN_PLUGIN_PHILLIS_39." ".LAN_PLUGIN_PHILLIS_40." ".LAN_PLUGIN_PHILLIS_38."!!!!";
  $phillis_ajaxret['lan'] = LAN_PLUGIN_PHILLIS_46;
  $phillis_ajaxret['status'] = 'success';
}
else
{
//$phillis_ajaxtext = LAN_PLUGIN_PHILLIS_57." ".LAN_PLUGIN_PHILLIS_50." ".LAN_PLUGIN_PHILLIS_27." ".$phillis_codestmp[0]." (".LAN_PLUGIN_PHILLIS_28." ".abs($phillis_codestmp[1]).") ".LAN_PLUGIN_PHILLIS_40." ".LAN_PLUGIN_PHILLIS_38."!!!!";
  $phillis_ajaxret['lan'] = LAN_PLUGIN_PHILLIS_47;
  $phillis_ajaxret['status'] = 'error';
}
//$phillis_ajaxret['text'] = str_replace(array('[x]', '[y]'), array($phillis_codestmp[0], abs($phillis_codestmp[1])), $phillis_ajaxret['lan']);
}
//else if ($phillis_action[2] == "a")
else if ((int)$phillis_codestmp[1]>0)
{
//----- if ($phillis_action == "n" || $phillis_action == "u")
//if ($phillis_action[0] == "f")
//----- {
//-----   $LAN_PLUGIN_PHILLIS_ast_insert_id = $sql->db_Insert(
//-----     "phillist_flt".$phillis_action,
//-----     "NULL, '".USERID."', '".$phillis_codes."', 1, -1, -1, 38, 1, NULL , 1, 1, NULL"
//-----   );
//----- }
//echo $phllist_Add;
//  $LAN_PLUGIN_PHILLIS_ast_insert_id = $sql->db_Insert($phillis_instbl, $phillis_insval);
//    if ($sql->db_Select_gen($phllist_Add, false))
/*
  $LAN_PLUGIN_PHILLIS_ast_insert_id = $sql->db_Insert(
    "phillist_".$phillis_data_table,
    "NULL, '".USERID."', '".$phillis_codes."', 1, -1, -1, 38, 1, NULL , 1, 1, NULL"
  );
*/
/*
  $last_insert_id = $sql->insert(
    "phillist_".$phillis_data_table,
    "NULL, ".USERID.", ".intval($phillis_codestmp[1]).", 1, -1, -1, 38, 1, NULL , 1, 1, NOW()"
  );
*/
//echo $LAN_PLUGIN_PHILLIS_ast_insert_id."  -  ".$phillis_codes;
  if ($sql->insert("phillist_".$phillis_data_table, "NULL, ".USERID.", ".intval($phillis_codestmp[1]).", 1, -1, -1, 38, 1, NULL , 1, 1, NOW()"))
  {
//  $phillis_ajaxtext = LAN_PLUGIN_PHILLIS_27." ".$phillis_codestmp[0]." ( ".LAN_PLUGIN_PHILLIS_28." ".$phillis_codestmp[1]." ) ".LAN_PLUGIN_PHILLIS_44." ".LAN_PLUGIN_PHILLIS_41." ".LAN_PLUGIN_PHILLIS_38."!!!!";
    $phillis_ajaxret['lan'] = LAN_PLUGIN_PHILLIS_48;
    $phillis_ajaxret['status'] = 'success';
  }
  else
  {
//$phillis_ajaxtext = LAN_PLUGIN_PHILLIS_57." ".LAN_PLUGIN_PHILLIS_51." ".LAN_PLUGIN_PHILLIS_27." ".$phillis_codestmp[0]." (".LAN_PLUGIN_PHILLIS_28." ".$phillis_codestmp[1].") ".LAN_PLUGIN_PHILLIS_38."!!!!";
//$phillis_utext .= "phillist_".$phillis_data_table. " ---- ".
//    "NULL, '".USERID."', '".$phillis_codes."', 1, -1, -1, 38, 1, NULL , 1, 1, NULL";
//  $phillis_ajaxret['err'] = 1;
    $phillis_ajaxret['lan'] = LAN_PLUGIN_PHILLIS_49;
    $phillis_ajaxret['status'] = 'error';
}
}
//}
$phillis_ajaxret['text'] = str_replace(array('[x]', '[y]'), array($phillis_codestmp[0], abs(intval($phillis_codestmp[1]))), $phillis_ajaxret['lan']);
}

/*
//if($phllist_Ajax) {
//if(e_AJAX_REQUEST) {
//  $phillis_ajaxtext = strtoupper($phillis_ajaxtext);
  //  if ($phllist_Ajaxerr) {header('HTTP/1.1 500 Internal Server Booboo'." - "."phillist_".$phillis_data_table." > "."NULL, '".USERID."', '".$phillis_codestmp[0]."', 1, -1, -1, 38, 1, NULL , 1, 1, NULL");}
  if ($phillis_ajaxret['err']) {
//      header('HTTP/1.1 500 Internal Server Booboo');
//      exit (json_encode(array ('text'=>$phillis_utext)));
//exit (json_encode(array ('status' => 'error', 'text'=>$phillis_ajaxtext."___".$phillis_temp[2].">>>>".$phillis_codestmp[0]."»»»»»".$phillis_codestmp[1]."||||||||".$phillis_data_table)));
exit (json_encode(array ('status' => 'error', 'text'=>$phillis_ajaxret)));
  } else {
  //This is an AJAX request, do AJAX specific stuff
//  header('Content-Type: application/json');
  //  $phllist_Ajaxret = json_encode(array ('text'=>$phillis_utext, 'val'=>($LAN_PLUGIN_PHILLIS_ast_insert_id?$LAN_PLUGIN_PHILLIS_ast_insert_id:"")));
//  echo ;
//  exit (json_encode(array ('fname'=>$phillis_codestmp[0], 'text'=>$phillis_utext, 'val'=>($LAN_PLUGIN_PHILLIS_ast_insert_id?$LAN_PLUGIN_PHILLIS_ast_insert_id:""))));
//  exit (json_encode(array ('text'=>$phillis_utext, 'val'=>($LAN_PLUGIN_PHILLIS_ast_insert_id?$LAN_PLUGIN_PHILLIS_ast_insert_id:""), 'sql'=>$phillis_rem)));
//  exit (json_encode(array ('text'=>$phillis_action, 'val'=>($LAN_PLUGIN_PHILLIS_ast_insert_id?:""))));
//  exit (json_encode(array ('text'=>$phillis_utext, 'val'=>($last_insert_id?:""))));
//  exit (json_encode(array ('status' => 'success', 'text'=>$phillis_ajaxtext."««««".$phillis_temp[2]."====".$phillis_codestmp[0]."----".$phillis_codestmp[1]."@@@@@".intval($phillis_codestmp[1]))));
  exit (json_encode(array ('status' => 'success', 'text'=>$phillis_ajaxret)));
  //  exit($phillis_utext.($LAN_PLUGIN_PHILLIS_ast_insert_id?"|".$LAN_PLUGIN_PHILLIS_ast_insert_id:""));
//  exit(array($phillis_utext, $LAN_PLUGIN_PHILLIS_ast_insert_id));
  }
*/
  exit (json_encode($phillis_ajaxret));
//  ob_end_clean();
}
// ###########
// FIM DO AJAX
// ###########

//  ##### FIM DA EDI��O
///    $phillis_codestmp = explode('|', $phillis_codes);
//    var_dump($phillis_codestmp);
///if ($phillis_codestmp[0]>0)
///{
///if ($phillis_codestmp[1])
///{
//if ($phillis_action[2] == "r")
//{
//    $phillis_codestmp = explode('|', $phillis_codes);
//echo $phillis_codes;
//echo "---";
//    print_r ($phillis_codestmp);
//  print_r(explode('_', 'test_underscore'));
/*
DELETE FROM `portugalstamps`.`e107_phillist_fltu` WHERE `e107_phillist_fltu`.`cod` = 3552
*/
//if ($phillis_action == "fn" || $phillis_action == "fu")
///if ($phillis_action == "n" || $phillis_action == "u")
//if ($phillis_action[0] == "f")
///{
//$phillis_rem = "DELETE FROM #phillist_flt".$phillis_action[1]." WHERE user=".USERID." AND cod=".$phillis_codestmp[1];
///$phillis_rem = "DELETE FROM #phillist_flt".$phillis_action." WHERE user=".USERID." AND cod=".$phillis_codestmp[1];
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
//else if ($phillis_action[2] == "a")
///else 
///{
//ECHO "=====".$phillis_action[2];
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
//if ($phillis_action == "fn" || $phillis_action == "fu")
///if ($phillis_action == "n" || $phillis_action == "u")
//if ($phillis_action[0] == "f")
///{
/*
$phllist_Add = "INSERT INTO #phillist_flt".$phillis_action[1]." (
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
//  $phillis_instbl = "phillist_flt".$phillis_action[1];
//  $phillis_instbl = "phillist_flt".$phillis_action;
//  $phillis_insval = "'".USERID."', '".$phillis_codes."', '1', '-1', '-1', '38', '1', NULL , NULL, '1', '1', NULL , NULL , NOW(), NOW(), NULL";
///  $LAN_PLUGIN_PHILLIS_ast_insert_id = $sql->db_Insert(
///    "phillist_flt".$phillis_action,
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
  exit (json_encode(array ('text'=>$phillis_action, 'val'=>($LAN_PLUGIN_PHILLIS_ast_insert_id?$LAN_PLUGIN_PHILLIS_ast_insert_id:""))));
//  exit($phillis_utext.($LAN_PLUGIN_PHILLIS_ast_insert_id?"|".$LAN_PLUGIN_PHILLIS_ast_insert_id:""));
//  exit(array($phillis_utext, $LAN_PLUGIN_PHILLIS_ast_insert_id));
}
*/
/*
$phillis_text .= "<link rel='stylesheet' href='../phil/dialog/dialog_box.css' type='text/css'>";
$phillis_text .= "<div id='listinginfo'>";
if($phillis_utext || $phillis_edit==1) {
$phillis_text .= "<p><center><div id='dialog '><div id='dialog-content' class='".($phillis_edit==1 && !$phillis_utext?"warning":($phllist_Ajaxerr?"error":"success"))."'>";
$phillis_text .= ($phillis_edit==1 && !$phillis_utext?phillis_300.(($phillis_action == "s" || $phillis_action == "o")?phillis_302:phillis_301):$phillis_utext);
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
//-----require_once(e_PLUGIN.'phil_lis/phillis_func.php');
// ######## CABE�ALHOS DAS LISTAS INDIVIDUAIS
//		global $sql, $phillis_action, $phillis_userid, $gstyle_obj;
//  if ($whatdo){
//    $sql->db_Select("user", "user_name", "user_id = ".$phillis_userid);
//    extract($sql->db_Fetch());
//  }
//////////$phillis_text .= $tp->parsetemplate($phillis_MAIN_START, true, $sc);
//var_dump ($phillis_action);
//if ($phillis_action == "n" || $phillis_action == "u" || $phillis_action == "s" || $phillis_action == "o")
if (in_array($phillis_action, array("n", "u", "s", "o")))
{
//var_dump($phillis_temp);
    $phillis_ctemp = preg_split('/[|]/', $phillis_temp[1]);
//    $phillis_cuserid = (USERID==abs(intval($phillis_ctemp[1])));
/////////////////    $phillis_cuserid = (USERID<>abs(intval($phillis_ctemp[1]))?abs(intval($phillis_ctemp[1])):null);
//    $phillis_cuserid = abs(intval($phillis_ctemp[1]));
//    $phillis_cuserid = ((USERID==abs(intval($phillis_ctemp[1])) || USERID==$phillis_userid) && $phillis_userid<>abs(intval($phillis_ctemp[1]))?abs(intval($phillis_ctemp[1])):null);
//var_dump ($phillis_temp[1], USERID==abs(intval($phillis_temp[1])), USERID==$phillis_userid, $phillis_userid<>abs(intval($phillis_temp[1])), $phillis_userid, abs(intval($phillis_temp[1])));
    $phillis_cuserid = ((USERID==abs(intval($phillis_ctemp[1])) || USERID==$phillis_userid) && $phillis_userid<>abs(intval($phillis_ctemp[1]))?abs(intval($phillis_ctemp[1])):null);
//    $phillis_cuserid = $phillis_userid;
//    cachevars('phillis_cuserid', $phillis_cuserid);
//    $phillis_cusername = ($phillis_cusername?$phillis_cusername:$gstyle_obj->showUser($phillis_cuserid));
$cudata = e107::user($phillis_cuserid);
//echo "<hr>";
//var_dump ($phillis_temp[1], preg_split('/[|]/', $phillis_temp[1]), $phillis_cuserid, $udata);
//exit;
//    $phillis_cusername = ($phillis_cusername?:$gstyle_obj->showUser($phillis_cuserid));
    $phillis_cusername = ($phillis_cusername?:$cudata['user_name']);
//    cachevars('phillis_cusername', $phillis_cusername);
//    $phillis_cuseremail = ($phillis_cuseremail?:$gstyle_obj
    $scvars['phillis_cusername'] = $phillis_cusername;
//    e107::setRegistry('phillis_cusername', $phillis_cusername);
    //var_dump($phillis_cuserid);
//var_dump(USERID);
//var_dump($phillis_ctemp[1]);
//  if ($phillis_whatdo=="pdf"){
//    $sql->db_Select("user", "user_name", "user_id = ".$phillis_userid);
//    extract($sql->db_Fetch());
//  }
//  $phillis_caption = LAN_PLUGIN_PHILLIS_1.LAN_PLUGIN_PHILLIS_33;
//  $phillis_caption = phillis_38.LAN_PLUGIN_PHILLIS_33;
      $phillis_table_name = "phillist_";
switch ($phillis_action) {
    case "u":
    case "n":
      $phillis_table_name .= "flt";
//      $phillis_text_action= LAN_PLUGIN_PHILLIS_34;
      $caption_array[0] = LAN_PLUGIN_PHILLIS_34;
      $phillis_view = $_SESSION['phillis_view']['n'];
//      $phillis_view = 'n';
      break;
    case "s":
    case "o":
      $phillis_table_name .= "trc";
//      $phillis_text_action= LAN_PLUGIN_PHILLIS_35;
      $caption_array[0] = LAN_PLUGIN_PHILLIS_35;
      $phillis_view = $_SESSION['phillis_view']['u'];

      $phillis_template['start'] = $phillis_template['start'].$phillis_template['trc_start']; 
      if ($phillis_whatdo != "ed") $phillis_template['end'] .= $phillis_template['trc_end'];
//      $phillis_template['end'] .= $phillis_template['trc_end']; 
//      $phillis_template['end'] = $phillis_template['trc_end']; 
//      $phillis_view = 'x';
      break;
}
//      $phillis_caption .= $phillis_text_action;
////      $phillis_pdftexttitle = $phillis_text_action." ";
    if ($phillis_whatdo == "ed") $phillis_view = $_SESSION['phillis_view']['e'];
//    var_dump ($phillis_view);
//    var_dump ($_SESSION['phillis_view']);
//    cachevars('phillis_view', $phillis_view);
    $scvars['phillis_view'] = $phillis_view;
//    var_dump($phillis_view);
    //    e107::setRegistry('phillis_view', $phillis_view);
//      $phillis_table_name .= $phillis_action;
//$phillis_caption = phillis_01." ".LAN_PLUGIN_PHILLIS_33.LAN_PLUGIN_PHILLIS_35.LAN_PLUGIN_PHILLIS_33.LAN_PLUGIN_PHILLIS_110." ".(($phillis_action == "s")?phillis_18:(($phillis_action == "o")?phillis_19:"")).LAN_PLUGIN_PHILLIS_37.$gstyle_obj->showUser($phillis_userid);
//      echo $phillis_table_name;
//      $phillis_caption .= LAN_PLUGIN_PHILLIS_33.LAN_PLUGIN_PHILLIS_110." ";
switch ($phillis_action) {
    case "n":
    case "o":
//      $phillis_caption .= LAN_PLUGIN_PHILLIS_19;
      $caption_array[1] = LAN_PLUGIN_PHILLIS_19;
      $phillis_table_name .= "n";
////      $phillis_pdftexttitle .= LAN_PLUGIN_PHILLIS_82;
      break;
    case "u":
    case "s":
//      $phillis_caption .= LAN_PLUGIN_PHILLIS_18;
      $caption_array[1] = LAN_PLUGIN_PHILLIS_18;
      $phillis_table_name .= "u";
////      $phillis_pdftexttitle .= LAN_PLUGIN_PHILLIS_83;
      break;
}
//      $phillis_table_name .= $phillis_temptable_name;
//var_dump($phillis_action);
//   $sql->db_Select("phillist_flt".$phillis_action, "DISTINCTROW MAX(data) as datam", "user = ".$phillis_userid);
//   $sql->select($phillis_table_name, "DISTINCTROW MAX(data) as datam", "user = ".$phillis_userid);
//   extract($sql->fetch());
//   var_dump($sql->retrieve($phillis_table_name, "DISTINCTROW MAX(data) as datam", "user = ".$phillis_userid));
/////////////$datam = $sql->retrieve($phillis_table_name, "DISTINCTROW MAX(data) as datam", "user = ".$phillis_userid);
   
$udata = e107::user($phillis_userid);
//    $phillis_username = ($phillis_username?$phillis_username:$gstyle_obj->showUser($phillis_userid));
    $phillis_username = ($phillis_username??$udata['user_name']);
//    cachevars('phillis_username', $phillis_username);
$scvars['phillis_username'] = $phillis_username;
//    e107::setRegistry('phillis_username', $phillis_username);
//  $phillis_caption .= LAN_PLUGIN_PHILLIS_37.$phillis_username.($phillis_cuserid?" ".LAN_PLUGIN_PHILLIS_54." ".($phillis_action=="n" || $phillis_action=="u"?LAN_PLUGIN_PHILLIS_35:LAN_PLUGIN_PHILLIS_34)." ".LAN_PLUGIN_PHILLIS_37.$phillis_cusername:"");
//  Isto depois tem de ser templatizado????
//  $phillis_caption .= LAN_PLUGIN_PHILLIS_37."<a href='".e107::getUrl()->create('user/profile/view', array('id' => $phillis_userid, 'name' => $phillis_username))."'>".$phillis_username."</a>".($phillis_cuserid?" ".LAN_PLUGIN_PHILLIS_54." ".($phillis_action=="n" || $phillis_action=="u"?LAN_PLUGIN_PHILLIS_35:LAN_PLUGIN_PHILLIS_34)." ".LAN_PLUGIN_PHILLIS_37.$phillis_cusername:"");
$caption_array[2] = "<a href='".e107::getUrl()->create('user/profile/view', array('id' => $phillis_userid, 'name' => $phillis_username))."'>".$phillis_username."</a>".($phillis_cuserid?" ".LAN_PLUGIN_PHILLIS_54." ".($phillis_action=="n" || $phillis_action=="u"?LAN_PLUGIN_PHILLIS_35:LAN_PLUGIN_PHILLIS_34)." ".LAN_PLUGIN_PHILLIS_37.$phillis_cusername:"");
$phillis_caption = str_replace(array('[x]', '[y]', '[z]'),$caption_array,LAN_PLUGIN_PHILLIS_33);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['expcsv'])) {
  $dados[]=array($phillis_caption);
}

$datam = $sql->retrieve($phillis_table_name, "DISTINCTROW MAX(data) as datam", "user = ".$phillis_userid);
/*
if ($datam = $sql->retrieve($phillis_table_name, "DISTINCTROW MAX(data) as datam", "user = ".$phillis_userid))
  {
  
///    if ($phillis_whatdo=="pdf") {
    if ($pdf) {
//    $sql->db_Select("user", "user_name", "user_id = ".$phillis_userid);
//    extract($sql->db_Fetch());
//    $phillis_pdfusername = ($user_name?$user_name:$gstyle_obj->showUser($phillis_userid));
$pdf->SetTitle($tp->toHTML(ucfirst($phillis_pdftexttitle)." (".strip_tags($phillis_username).")"));
//$pdf->SetKeywords(phalbuns_P02);
//$pdf->SetSubject($tp->toHTML(phillis_01.LAN_PLUGIN_PHILLIS_33.$text_string));
$pdf->SetSubject($phillis_pdfcaption=$tp->toHTML($phillis_caption));
//$pdf->SetSubject($tp->toHTML(phillis_01.LAN_PLUGIN_PHILLIS_33.LAN_PLUGIN_PHILLIS_110." ".(($action == "u")?phillis_18:(($action == "n")?phillis_19:""))));
//$pdf->SetAuthor($user_name);
$pdf->SetAuthor($phillis_username);
//$pdf->AliasNbPages();
//$pdf->getAliasNbPages();
//$pdf->SetFont($pdfpref['pdf_font_family'] , '', $pdfpref['pdf_font_size']);
$pdf->AddPage();
}
}
*/
//var_dump($phillis_view);
//    echo "<hr>".$phillis_table_name." - ".$datam."<hr>";
//  return array(phillis_01.LAN_PLUGIN_PHILLIS_33.LAN_PLUGIN_PHILLIS_34.LAN_PLUGIN_PHILLIS_33.LAN_PLUGIN_PHILLIS_110." ".(($phillis_action == "u")?phillis_18:(($phillis_action == "n")?phillis_19:"")).LAN_PLUGIN_PHILLIS_37.($user_name?$user_name:$gstyle_obj->showUser($phillis_userid)),($datam>0?"(".LAN_PLUGIN_PHILLIS_100 ." ".$datam.")":""));
//  $cab = array($phillis_caption,($user_name?$user_name:$gstyle_obj->showUser($phillis_userid)),($datam>0?"(".LAN_PLUGIN_PHILLIS_100 ." ".$datam.")":""),$text_title);
//$cab = cab_listas($phillis_action, $phillis_userid);
//  $phillis_caption = "<div style='position:fixed'>";
//  $phillis_caption = $cab[0]." ".$cab[1]."<span style='float:right;margin-right:10px;font-size:small;'>";
//  $phillis_caption = $cab[0].LAN_PLUGIN_PHILLIS_37.$cab[1]." <small>".$cab[2]."</small>";

if ($phillis_whatdo!="ed") {
    $phillis_caption .= " <br><small>".($datam>0?str_replace("[x]",$datam,LAN_PLUGIN_PHILLIS_23):(($phillis_whatdo <> "pr")?"":"<br>"))."</small>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['expcsv'])) {
  $dados[]=array($datam>0?str_replace("[x]",$datam,LAN_PLUGIN_PHILLIS_23):"");
}

// ESTE � das listas de TROCAS:  phillis_35.LAN_PLUGIN_PHILLIS_33.LAN_PLUGIN_PHILLIS_110." ".(($phillis_action == "s")?phillis_18:(($phillis_action == "o")?phillis_19:"")).LAN_PLUGIN_PHILLIS_37.$gstyle_obj->showUser($phillis_userid);
//$phillis_caption .= (USERID==$phillis_userid);
//$phillis_caption .= USERID;
//$phillis_caption .= $phillis_userid;
/////////$phillis_caption .= "<span>".((!is_null($phillis_edit) && USERID==$phillis_userid && $phillis_userid>0)?"<a href='".e_PLUGIN_ABS."phil_lis/phillis.php?".str_replace(($phillis_whatdo?"-":"."), ($phillis_whatdo?".":"-"), e_QUERY)."' title='".($phillis_whatdo==1?phillis_201:phillis_200)."'  ><img src='images/list_".($phillis_whatdo==1?"e":"")."edit.png'/>".($phillis_whatdo==1?phillis_201:phillis_200)."</a>&nbsp;":"");
// TESTE CRIA++O PDF
/*
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
$phillis_caption .= "&nbsp;&nbsp;&nbsp;<a href='".e_PLUGIN_ABS."phil_lis/phillis_pdf.php?".e_QUERY."' title='".LAN_PLUGIN_PHILLIS_98."'><img src='".$phillis_icon."' /></a>";
// TESTE IMPRESS+O - A imagem depois tem de ser mudada para aceitar a que vem do core..
// N+O FUNCIONA, TENHO DO IR BUSCAR - UNHA... require (e_FILE."shortcode/print_item.sc");
if (defined("ICONPRINT") && file_exists(THEME."images/".ICONPRINT))
     {
         $phillis_icon = THEME_ABS."images/".ICONPRINT;
     }
     else
     {
         $phillis_icon = e_IMAGE_ABS."generic/printer.png";
     }
$phillis_caption .= "&nbsp;&nbsp;<a href='".e_HTTP."print.php?plugin:phil_lis.".e_QUERY."' title='".LAN_PLUGIN_PHILLIS_97."'><img src='".$phillis_icon."'/></a>";
}
*/
//return " <a href='".e_PLUGIN_ABS."pdf/pdf.php?{$parms[1]}'><img src='".$phillis_icon."' style='border:0' alt='{$parms[0]}' title='{$parms[0]}' /></a>";
   //$phillis_caption .= "<a style='float:right; margin-right:10px' href='http://localhost/ps/print.php?plugin:phillist.".$phillis_from.".".$phillis_action.".".$phillis_userid."'>Imprimir</a>";
//$phillis_text .= "<a href='http://localhost/ps/print.php?plugin:phillist.".$phillis_from.".".$phillis_action.".".$phillis_userid."'>IMPRIMIR</a>";
//$phillis_text .= "<div id='listing".($phillis_whatdo==1?"u":"")."'>";
//$phillis_text .= "<div id='listing".($phillis_whatdo==1?"u":"")."'><div id='loading' style='display:none'><span><img src='".e_PLUGIN."phil_cat/images/loading.gif'>&nbsp;".LAN_PLUGIN_PHILLIS_96."&nbsp;<img src='".e_PLUGIN."phil_cat/images/loading.gif'></span></div>";
//$phillis_text .= "<div id='loading' style='display:none'><span><img src='".e_PLUGIN."phil_cat/images/loading.gif'>&nbsp;".LAN_PLUGIN_PHILLIS_96."&nbsp;<img src='".e_PLUGIN."phil_cat/images/loading.gif'></span></div><div id='listing".($phillis_whatdo==1?"u":"")."'>";
//  $phillis_text .= $pl->faltas(); 
//  $phillis_text .= "<hr>".$pl->leg_faltas()."</div>"; 
//  $phillis_text .= faltas(); 
//  $phillis_text .= "<hr>".leg_faltas()."</div>"; 
//}
///////////  $phillis_caption .= "</span>";
//  $phillis_caption .= "</div>";
//var_dump($phillis_action);
}






if ($datam || $phillis_whatdo=="ed") {


//var_dump($phillis_action);
// ######## FIM DOS CABE�ALHOS DAS LISTAS INDIVIDUAIS
e107::getTemplate('phillis', 'icons');
/////////////////include_once(e_PLUGIN."phil/phil_defines.php");
//var_dump($phillis_action);
// ######## MODO DE EDI��O DAS LISTAS
// TEMPLATIZAR......................
//var_dump ($philis_whatdo);
    // The data is placed in to cachevars() so that the shortcode can access it.
//    cachevars('phillis_action', $phillis_action);
$scvars['phillis_action'] = $phillis_action;
//e107::setRegistry('phillis_action', $phillis_action);
//    cachevars('phillis_whatdo', $whatdo);
//    cachevars('phillis_whatdo', $phillis_whatdo);
$scvars['phillis_whatdo'] = $phillis_whatdo;
//e107::setRegistry('phillis_whatdo', $phillis_whatdo);
//    cachevars('phillis_action', $phillis_action);
/*
if ($phillis_whatdo=="ed"){
//  $phillis_text .= "<div id='listingu'>";
//  $phillis_text .= lista_num(ed); 
  $phillis_text .= $tp->parsetemplate($phillis_template['edit']['start'], false, $sc); 
//echo "<hr>";
/// ADICIONAR JAVASCRIPTPROTOYPE
//If ($phillis_whatdo<="ed") {
//  $phillis_text .= "<link rel='stylesheet' href='".e_PLUGIN."phil/dialog/dialog_box.css' type='text/css' />";
//  $footer_js[] = "../phil/dialog/dialog_box.js";
//  $footer_js[] = "phillis_class.js";
//}
//if ($phillis_action == "n" || $phillis_action == "u") {
//  $phillis_text .= "<hr>".leg_faltas();
//}
//  $phillis_text .= "</div>";
//} ELSE {
// ######## LISTAS DE FALTAS INDIVIDUAIS
//-----if ($phillis_action == "n" || $phillis_action == "u")
//-----{
//  $phillis_text .= "<div id='listing'>";
//  $phillis_text .= lista_num(); 
//  $phillis_text .= $tp->parsetemplate((($phillis_whatdo <> "pr")?$phillis_template['start']:$phillis_template['print']['start']), false, $sc); 
//  $phillis_text .= "<hr>".leg_faltas()."</div>"; 
//  $phillis_text .= "</div>"; 
//-----}
// ######## FIM LISTAS DE FALTAS INDIVIDUAIS
// ######## LISTAS DE TROCAS INDIVIDUAIS
//-----if ($phillis_action == "o" || $phillis_action == "s")
//if ($phillis_action[0] == "t")
//-----{
//  $phillis_text .= lista_img();
//-----  $phillis_text .= $tp->parsetemplate($phillis_START.$phillis_intext.$phillis_END, false, $sc);
//-----}
// ######## FIM LISTAS DE TROCAS INDIVIDUAIS
}
*/
///////include_once(e_PLUGIN."phil_lis/phillis_include.php");
//require_once("../../class2.php");
//------	function cria_lista($whatdo = NULL, $type = NULL)
//------	{
//------		global $sql, $phillis_action, $phillis_userid, $tp;
//    var_dump($phillis_action);
//    var_dump($whatdo);
    // The data is placed in to cachevars() so that the shortcode can access it.
//    cachevars('phillis_action', $phillis_action);
//    cachevars('phillis_whatdo', $whatdo);
//    cachevars('phillis_whatdo', $phillis_whatdo);
//		global $sql, $phillis_userid, $tp;
////    $whatdo_tmp = $whatdo;
//    var_dump($phillis_whatdo);
//    var_dump($phillis_whatdo > "ed");
//    var_dump("fe" > "ed");
//------    include_once(e_PLUGIN."phil/phil_defines.php");
/// ISTO � PRECISO PARA CONSEGUIR PROCESSAR AS TEMPLATES DENTRO DA FUN��O....
//------		global $sc;
//------if (file_exists(THEME."phillis_template.php")) {include_once(THEME."phillis_template.php");} else {include(e_PLUGIN."phil_lis/phillis_template.php");}
// DIVIDIR EM DUAS QUERIES N�O FUNCIONA, FICA MUITO LENTO....
//-      $phllist_Arg = "select distinctrow peca, pais, tipo, familia, #philcat_catalogos.desc as desc_catalogo, #phil_pais.desc as desc_pais, #phil_tipo.desc as desc_tipo, #phil_familias.desc as desc_familia, prefx, num, sufx from #philcat_codigo left join #phil_tipo on #phil_tipo.cod = #philcat_codigo.tipo left join #phil_familias on #phil_familias.cod = #philcat_codigo.familia left join #philcat_catalogos on #philcat_catalogos.cod = #philcat_codigo.cat left join #phil_pais on #phil_pais.cod = #philcat_codigo.pais where #philcat_codigo.cat =1 order by #phil_pais.desc, #phil_tipo.desc, #phil_familias.desc, prefx, num, sufx";
//echo $phllist_Arg;
//     $phillis_uarg = "SELECT peca, b, GROUP_CONCAT(cod) as cods, SUM(quant) as quants FROM #phillist_flt".$phillis_action." where user = ".$phillis_userid." group by peca";
//$sql2->db_Select("phillist_flt".$phillis_action, "peca, b, GROUP_CONCAT(cod) as cods, SUM(quant) as quants", "where user = ".$phillis_userid." group by peca", "where", false);
//echo $phllist_Arg;
//DIE();
// ACHO QUE ESTE � MAIS R�PIDO:     
// Depois isto tem de sair
    $phillis_usersql = "user = ".$phillis_userid;
/*     $phllist_Arg = "SELECT DISTINCTROW GROUP_CONCAT(CASE WHEN $phillis_usersql THEN b ELSE NULL END) as b, GROUP_CONCAT(CASE WHEN $phillis_usersql THEN cod ELSE NULL END) AS cods, SUM(CASE WHEN $phillis_usersql THEN quant ELSE NULL END) AS quants, #phil_pais.desc AS desc_pais, #philcat_codigo.*, #phil_tipo.desc AS desc_tipo, #philcat_catalogos.desc AS desc_catalogo, #phil_familias.desc AS desc_familia
FROM #philcat_codigo
LEFT JOIN #phillist_flt".$phillis_action." ON peca = peca
LEFT JOIN #phil_tipo ON #phil_tipo.cod = tipo
LEFT JOIN #phil_familias ON #phil_familias.cod = familia
LEFT JOIN #philcat_catalogos ON #philcat_catalogos.cod = #philcat_codigo.cat
LEFT JOIN #phil_pais ON #phil_pais.cod = pais
WHERE #philcat_codigo.cat =1 
GROUP BY PECA
ORDER BY desc_pais, desc_tipo, desc_familia, prefx, num, sufx";
*/
/*     $phllist_Arg = "SELECT DISTINCTROW GROUP_CONCAT(IF($phillis_usersql, CONCAT_WS('.',b,cod,quant), NULL)) as data, #phil_pais.desc AS desc_pais, #philcat_codigo.*, #phil_tipo.desc AS desc_tipo, #philcat_catalogos.desc AS desc_catalogo, #phil_familias.desc AS desc_familia
FROM #philcat_codigo
LEFT JOIN #phillist_flt".$phillis_action." ON peca = peca
LEFT JOIN #phil_tipo ON #phil_tipo.cod = tipo
LEFT JOIN #phil_familias ON #phil_familias.cod = familia
LEFT JOIN #philcat_catalogos ON #philcat_catalogos.cod = #philcat_codigo.cat
LEFT JOIN #phil_pais ON #phil_pais.cod = pais
WHERE #philcat_codigo.cat =1 
GROUP BY PECA
ORDER BY desc_pais, desc_tipo, desc_familia, prefx, num, sufx";
    if ($sql->db_Select_gen($phllist_Arg, false))
    {
}
*/
// TESTE DE QUERIES INDIVIDUAIS     
// AS QUERIES INDIVIDUAIS S�O MUITO LENTAS COM GRANDES QUANTIDADES DE DADOS, PRINCIPALMENTE A PRIMEIRA QUERIE VVVVVVV
/*
     $phllist_Arg = "SELECT DISTINCTROW GROUP_CONCAT(IF($phillis_usersql, b, NULL)) as b, GROUP_CONCAT(IF ($phillis_usersql, cod, NULL)) AS cods, SUM(IF($phillis_usersql, quant, NULL)) AS quants FROM #phillist_flt".$phillis_action." GROUP BY PECA";
    if ($sql->db_Select_gen($phllist_Arg, false))
    {
/*
        while ($phillis_urow = $sql->db_Fetch()){
          $new_array[]=$phillis_urow;
        }
      print_r($new_array);
*/
/*    }
     $phllist_Arg = "SELECT DISTINCTROW #phil_pais.desc AS desc_pais, #philcat_codigo.*, #phil_tipo.desc AS desc_tipo, #philcat_catalogos.desc AS desc_catalogo, #phil_familias.desc AS desc_familia
FROM #philcat_codigo
LEFT JOIN #phil_tipo ON #phil_tipo.cod = tipo
LEFT JOIN #phil_familias ON #phil_familias.cod = familia
LEFT JOIN #philcat_catalogos ON #philcat_catalogos.cod = #philcat_codigo.cat
LEFT JOIN #phil_pais ON #phil_pais.cod = pais
WHERE #philcat_codigo.cat =1 
GROUP BY PECA
ORDER BY desc_pais, desc_tipo, desc_familia, prefx, num, sufx";
    if ($sql->db_Select_gen($phllist_Arg, false))
    {
    }
*/

//$phillis_trc_action = (($phillis_action == "s")?"u":(($phillis_action == "o")?"n":""));
//var_dump ($phillis_table_name);
      $phillis_trtable_name = str_replace("flt", "trc", $phillis_table_name, $phillis_trcvz);
      $phillis_trtable_name = ($phillis_trcvz==0?str_replace("trc", "flt", $phillis_table_name):$phillis_trtable_name);
//var_dump ($phillis_table_name);
//var_dump ($phillis_trtable_name);
//var_dump($phillis_action == "n" || $phillis_action == "u" || $phillis_whatdo=="ed");
require_once(e_PLUGIN."philcat/handlers/philcat_class.php");
//echo "<hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>";
$philcat = new Philcat;
  if ($phillis_action == "n" || $phillis_action == "u" || $phillis_whatdo=="ed") {

      if ($phillis_whatdo=="ed") e107::js("footer", e_PLUGIN."phillis/js/phillis_ed.js", "jquery"); 

    //var_dump ($phillis_trtable_name);
//$phillis_table = (($phillis_action == "n" || $phillis_action == "u")?"flt".$phillis_action:"trc".$phillis_trc_action);
// ACHO QUE ESTE � AINDA MAIS R�PIDO:     
//     $phllist_Arg = "SELECT DISTINCTROW GROUP_CONCAT(IF($phillis_usersql, b, NULL)) as b, GROUP_CONCAT(IF ($phillis_usersql, #phillist_".$phillis_table.".cod, NULL)) AS cods, SUM(IF($phillis_usersql, quant, NULL)) AS quants, #phil_pais.descr AS desc_pais, #philcat_codigo.*, #phil_tipo.descr AS desc_tipo, #philcat_catalogos.descr AS desc_catalogo, #phil_familias.descr AS desc_familia".($phillis_whatdo > "ed"?"":", #philcat_series.pais AS pais_real, #philcat_series.descr as desc_serie, #philcat_series.ano, #philcat.*")." FROM #philcat_codigo LEFT JOIN #phillist_".$phillis_table." ON #phillist_".$phillis_table.".peca = #philcat_codigo.peca".($phillis_whatdo > "ed"?"":" LEFT JOIN #philcat ON #philcat.cod = #philcat_codigo.peca LEFT JOIN #philcat_series ON #philcat_series.cod = #philcat.serie")." LEFT JOIN #phil_tipo ON #phil_tipo.cod = tipo LEFT JOIN #phil_familias ON #phil_familias.cod = familia LEFT JOIN #philcat_catalogos ON #philcat_catalogos.cod = #philcat_codigo.cat LEFT JOIN #phil_pais ON #phil_pais.cod = #philcat_codigo.pais WHERE #philcat_codigo.cat =1 GROUP BY PECA ORDER BY desc_pais, desc_tipo, desc_familia, prefx, num, sufx";
//    cachevars('phillis_cuserid', $phillis_cuserid);
/*
$phillis_arg = "SELECT DISTINCTROW ".($phillis_cuserid?"trocas.quant, ":"") ."GROUP_CONCAT(IF( #".$phillis_table_name.".$phillis_usersql, #".$phillis_table_name.".user, NULL)) as b, GROUP_CONCAT(IF ( #".$phillis_table_name.".$phillis_usersql, #".$phillis_table_name.".cod, NULL)) AS cods, SUM(IF( #".$phillis_table_name.".$phillis_usersql, #".$phillis_table_name.".quant, NULL)) AS quants, #phil_pais.descr AS desc_pais, #philcat_codigo.*, #phil_tipo.descr AS desc_tipo, #philcat_catalogos.descr AS desc_catalogo, #phil_familias.descr AS desc_familia".($phillis_whatdo > "ed"?"":", #philcat_series.pais AS pais_real, #philcat_series.descr as desc_serie, #philcat_series.ano, #philcat.*")." FROM #philcat_codigo LEFT JOIN #".$phillis_table_name." ON #".$phillis_table_name.".peca = #philcat_codigo.peca".($phillis_whatdo > "ed"?"":" LEFT JOIN #philcat ON #philcat.cod = #philcat_codigo.peca LEFT JOIN #philcat_series ON #philcat_series.cod = #philcat.serie")." LEFT JOIN #phil_tipo ON #phil_tipo.cod = tipo LEFT JOIN #phil_familias ON #phil_familias.cod = familia LEFT JOIN #philcat_catalogos ON #philcat_catalogos.cod = #philcat_codigo.cat LEFT JOIN #phil_pais ON #phil_pais.cod = #philcat_codigo.pais".($phillis_cuserid?" LEFT JOIN (SELECT * FROM #".$phillis_trtable_name." where #".$phillis_trtable_name.".user=$phillis_cuserid) as trocas ON trocas.peca = #philcat_codigo.peca":"")." WHERE #philcat_codigo.cat =1 GROUP BY PECA ORDER BY desc_pais, desc_tipo, desc_familia, prefx, num, sufx";
*/




/* ANTIGA, VINHA COM OS DADOS TODOS, PROVAVELMENTE NÃO PRECISO DOS DADOS TODOS
$phillis_arg = "     SELECT PE.*, cat.*, #philcat_pais.descr as desc_pais, US.TOTAL  FROM 
#philcat_pecas_vw AS PE
left join #philcat_pais on #philcat_pais.cod = PE.pais 
LEFT JOIN
	(
	select DISTINCTROW #philcat_codigo.*, #philcat_codigo_catalogo.descr AS desc_catalogo
	FROM #philcat_codigo
	LEFT JOIN #philcat_codigo_catalogo ON #philcat_codigo_catalogo.cod = #philcat_codigo.cat
	WHERE #philcat_codigo.cat = 11	
	) AS cat
ON cat.peca = PE.cod
LEFT JOIN
    (
	 SELECT DISTINCTROW LS.peca, SUM(LS.quant) AS TOTAL 
    FROM #".$phillis_table_name." AS LS
    WHERE LS.user = ".$phillis_userid." 
    GROUP BY LS.peca
	 ) AS US
ON US.peca = PE.cod
ORDER BY desc_pais, desc_tipo, desc_familia, prefx, num, sufx
";
*/
//require_once(e_PLUGIN."philcat/handlers/philcat_class.php");
//echo "<hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>";
//$philcat = new Philcat;
//// Acho que não vou usar o view, não preciso dos dados todos.... afinal preciso....
     $phillis_arg = "SELECT a.desc_tipo, a.desc_familia, a.valor_facial, a.descr AS desc_item, b.*, p.descr AS desc_pais, d.TOTAL, s.descr AS desc_serie, s.ano
     FROM ({$philcat->philcat_view}) AS a
     LEFT JOIN #philcat_pais AS p ON p.cod = a.pais
     LEFT JOIN #philcat_series AS s ON s.cod = a.serie
     LEFT JOIN (
     SELECT DISTINCTROW c.*, cc.descr AS desc_catalogo
     FROM #philcat_codigo AS c
     LEFT JOIN #philcat_codigo_catalogo AS cc ON cc.cod = c.cat
     WHERE c.cat = 11) AS b ON b.peca = a.cod
     LEFT JOIN (
     SELECT DISTINCTROW f.peca, SUM(f.quant) AS TOTAL
     FROM #{$phillis_table_name} AS f
     WHERE f.user = {$phillis_userid}
     GROUP BY f.peca) AS d ON d.peca = a.cod
     ORDER BY desc_pais, desc_tipo, desc_familia, prefx, num, sufx
";

/*
echo "<hr><hr>";
var_dump ($phillis_arg);
*/

    }
    else
    {
//-------    if ($type=="img") {
//    $phllist_Arg = "SELECT #phillist_trc".$phillis_trc_action .".*, #philcat_codigo.*, #phil_pais.descr AS desc_pais, #phil_tipo.descr AS desc_tipo, #philcat_catalogos.descr AS desc_catalogo, #phil_familias.descr AS desc_familia, #philcat_series.pais as pais_real FROM #phillist_trc".$phillis_trc_action ." LEFT JOIN #philcat ON #philcat.cod= #phillist_trc".$phillis_trc_action .".peca LEFT JOIN #philcat_series ON #philcat_series.cod= #philcat.serie LEFT JOIN #philcat_codigo on #philcat_codigo.peca= #phillist_trc".$phillis_trc_action.".peca LEFT JOIN #phil_tipo ON #phil_tipo.cod = tipo LEFT JOIN #phil_familias ON #phil_familias.cod = familia LEFT JOIN #philcat_catalogos ON #philcat_catalogos.cod = #philcat_codigo.cat LEFT JOIN #phil_pais ON #phil_pais.cod = #philcat_codigo.pais WHERE #philcat_codigo.cat=1 and ".$phillis_usersql." ORDER BY desc_pais, desc_tipo, desc_familia, prefx, num, sufx";
    $phillis_arg = "SELECT ".($phillis_cuserid?"trocas.quant, ":"") ."l.peca, l.quant AS quants, a.*, a.descr AS desc_item, s.ano, s.descr AS desc_serie, #philcat_pais.descr AS desc_pais, #philcat_codigo_catalogo.descr AS desc_catalogo, s.pais as pais_real FROM ({$philcat->philcat_view}) AS a
    LEFT JOIN #{$phillis_table_name} as l ON l.peca = a.cod
    LEFT JOIN #philcat_series AS s ON s.cod = a.serie
    LEFT JOIN #philcat_codigo on #philcat_codigo.peca = l.peca
    LEFT JOIN #philcat_codigo_catalogo ON #philcat_codigo_catalogo.cod = #philcat_codigo.cat
    LEFT JOIN #philcat_pais ON #philcat_pais.cod = #philcat_codigo.pais".($phillis_cuserid?"
    LEFT JOIN (SELECT * FROM #{$phillis_trtable_name} WHERE #{$phillis_trtable_name}.user={$phillis_cuserid}) as trocas ON trocas.peca = #philcat_codigo.peca":"")." 
    WHERE #philcat_codigo.cat=11 and l.{$phillis_usersql}
    ORDER BY desc_pais, desc_tipo, desc_familia, prefx, num, sufx
    ";
}/*
     $phillis_arg = "SELECT DISTINCTROW GROUP_CONCAT(IF($phillis_usersql, b, NULL)) as b, GROUP_CONCAT(IF ($phillis_usersql, #phillist_flt".$phillis_action.".cod, NULL)) AS cods, SUM(IF($phillis_usersql, quant, NULL)) AS quants, #phil_pais.descr AS desc_pais, #philcat_codigo.*, #phil_tipo.descr AS desc_tipo, #philcat_catalogos.descr AS desc_catalogo, #phil_familias.descr AS desc_familia, #philcat_series.pais AS pais_real, #philcat_series.descr as desc_serie, #philcat_series.ano, #philcat.* 
FROM #philcat_codigo
LEFT JOIN #phillist_flt".$phillis_action." ON #phillist_flt".$phillis_action.".peca = #philcat_codigo.peca
LEFT JOIN #philcat ON #philcat.cod = #philcat_codigo.peca
LEFT JOIN #philcat_series ON #philcat_series.cod = #philcat.serie
LEFT JOIN #phil_tipo ON #phil_tipo.cod = tipo
LEFT JOIN #phil_familias ON #phil_familias.cod = familia
LEFT JOIN #philcat_catalogos ON #philcat_catalogos.cod = #philcat_codigo.cat
LEFT JOIN #phil_pais ON #phil_pais.cod = #philcat_codigo.pais
WHERE #philcat_codigo.cat =1 
GROUP BY PECA
ORDER BY desc_pais, desc_tipo, desc_familia, prefx, num, sufx";
*/    
//    cachevars('phillis_userid', $phillis_userid);
$scvars['phillis_userid'] = $phillis_userid;
//e107::setRegistry('phillis_userid', $phillis_userid);
//var_dump($phillis_cuserid);
//var_dump(USERID);
//var_dump($phillis_ctemp);
//                                                  echo "<hr><hr>";
//                                                  var_dump($phillis_arg);
//var_dump($sql->gen($phllist_Arg, false));
//echo "<hr>";
//var_dump($phillis_arg);
//var_dump($sql->gen($phillis_arg, false));




    if ($sql->gen($phillis_arg))
    {
//      echo "<hr><hr>";
//      var_dump($phillis_arg);
//exit;
$phillis_current_pais = null;
$phillis_current_tipo = null;
$phillis_current_familia = null;
//-      $phillis_uarg = "SELECT peca, b, GROUP_CONCAT(cod) as cods, SUM(quant) as quants FROM #phillist_flt".$phillis_action." where user = ".$phillis_userid." group by peca";
//- $sql2->db_Select("phillist_flt".$phillis_action, "peca, b, GROUP_CONCAT(cod) as cods, SUM(quant) as quants", "where user = ".$phillis_userid." group by peca", "where", false);
//- $phillis_urow = $sql2->db_Getlist();
//var_dump($phillis_urow[0]);
//$phhelper = new Phil();
/// ISTO � PRECISO PARA CONSEGUIR PROCESSAR O SHORTCODE DENTRO DA FUN��O....
///global $phillis_image, $phillis_tmp;
$phillis_i = 0;
/* NÃO PERCEBO ISTO.....
switch ($phillis_action) {
    case "u":
    case "n":
//      $phillis_view = $_SESSION['phillis_view'][0];
//      $phillis_quants = $phillis_cuserid && $phillis_row['quant']>0 && !$phillis_row['quants'];
      $phillis_quants = $phillis_cuserid && $phillis_row['quant']>0;
      break;
    case "s":
    case "o":
//      $phillis_view = $_SESSION['phillis_view'][1];
//      $phillis_quants = $phillis_cuserid && $phillis_row['quants']>0 && !$phillis_row['quant'];
      $phillis_quants = $phillis_cuserid && !$phillis_row['quant'];
      break;
}
*/

//var_dump ($phillis_cuserid);
//        while ($phillis_row = $sql->rows()){
          foreach ($sql->rows() as $phillis_row){

// VOU TENTAR USAR ISTO ENTRETANTO
//$phillis_quants = $phillis_row['TOTAL']>0;
$scvars['phillis_quants'] = $phillis_row['TOTAL']>0;
//$phillis_quants = ($phillis_row['TOTAL']??0)>0;
/*
          echo "<hr>";
          var_dump (count($phillis_row));
          var_dump ($phillis_row);
          echo "<hr>";
*/
//  echo " - ".$phillis_row['b'].": ".decbin($phillis_row['b']);
//  echo " - ".$phillis_row['b'];
//  echo "=".($phillis_row['b'] & 2);
/////var_dump(key($phillis_row));
//var_dump($_GLOBAL[$phillis_row]);
//while ($row = $stmt->fetch()) {
//    cachevars('phillis_row', $phillis_row);
$scvars['phillis_row'] = $phillis_row;
//e107::setRegistry('phillis_row', $phillis_row);
  if ($phillis_row["pais"] != $phillis_current_pais) {
    $phillis_current_pais = $tp->toHTML($phillis_row['pais']);
    $phillis_current_tipo = null;
    $phillis_current_familia = null;
//    $phillis_text .= "<h4 style='text-align: center'>".$tp->toHTML($phillis_row['desc_pais'])."</h4>";
    $phillis_pais = $tp->toHTML($phillis_row['desc_pais']);
  }
  if ($phillis_row["tipo"] != $phillis_current_tipo) {
    $phillis_current_tipo = $tp->toHTML($phillis_row['tipo']);
    $phillis_current_familia = null;
//    $phillis_text .= "<table class='fborder' style='width:100%'><tr><td class='fcaption' style='width:100%; text-align:center'>".$tp->toHTML($phillis_row['desc_tipo'])."</td></tr></table>";
//    $phillis_text .= "<div class='fcaption' style='text-align:center'>".$tp->toHTML($phillis_row['desc_tipo'])."</div>";
    $phillis_tipo = $tp->toHTML($phillis_row['desc_tipo']);
  }
  if ($phillis_row["familia"] != $phillis_current_familia) {
//    $phillis_text .= $tp->parsetemplate($phillis_SECTION_DIV_END, false, $sc);
    $phillis_current_familia = $tp->toHTML($phillis_row['familia']);
//    $phillis_text .= "<table class='fborder' style='width:100%'><tr><td class='forumheader' style='width:100%; text-align:left'>".$tp->toHTML($phillis_row['desc_familia'])."</td></tr></table>";
//    $phillis_text .= "<div class='forumheader' style='text-align:left'>".$tp->toHTML($phillis_row['desc_familia'])."</div>";
    $phillis_familia = $tp->toHTML($phillis_row['desc_familia']);
//N�O � PR�TICO TER OS CABE�ALHOS S� NO INICIO, RESOLVI COLOCAR LOGO TODOS AO PRINCIPIO DE CADA LISTA...
//    $phillis_text .= "cab(\"".$phillis_pais."\", \"".$phillis_tipo."\", \"".$phillis_familia."\")\n";
//global $phillis_tmpc;
    $phillis_tmpc = $phillis_pais.", ".$phillis_tipo.", ".$phillis_familia;
/// ISTO � PRECISO PARA CONSEGUIR PROCESSAR O SHORTCODE DENTRO DA FUN��O....
//    cachevars('phillis_tmpc', $phillis_tmpc);
$scvars['phillis_tmpc'] = $phillis_tmpc;
//e107::setRegistry('phillis_tmpc', $phillis_tmpc);
//    var_dump ($phillis_tmpc);
//    if ($phillis_whatdo=="pdf") {
/*
    if ($pdf) {
//////      $phillis_text[]["cab"] = $phillis_tmpc;

// CABE�ALHOS PDF....
//$yy = $pdf->GetY()-$mmheight;
  $pdf->SetY($pdf->GetY()-$mmheight);
                        $pdf->Ln();
//$xx = $pdf->GetX();
//                        $pdf->SetFont( 'Arial', 'BI', 10 );
                        $pdf->SetFont( 'Helvetica', 'BI', 10 );
                        $pdf->SetTextColor( 0, 100, 0);
                        $pdf->SetFillColor(230, 230, 230); // Set background colour to black
                        $pdf->Cell(0, 4, $phillis_tmpc, 0, 0, 'L', TRUE);
//                        $pdf->Write( 5, $dt[cab]);
                        $pdf->Ln();
$x = null;//  $pdf->SetX($x);
//      echo $phillis_tmpc;
//      $phillis_text[]["cab"] .= "<hr><hr>";
    } else {
*/
//////////      $phillis_text .= ($phillis_text==""?"":"</div>");
//          $phillis_text .= ($phillis_text==""?"":"</td></tr></table>");
//        if ($phillis_whatdo!="pr") {
/*
          $phillis_tmpcod = $tp->toHTML($phillis_row['pais'])."_".$tp->toHTML($phillis_row['tipo'])."_".$tp->toHTML($phillis_row['familia']);
          $phillis_text .= ($phillis_text==""?"":"</td></tr></table>")."<table style='width:100%'><tr><td class='forumheader' id='nav' style='width:100% !important; padding: 1px !important'><input id='mytogglelis".$phillis_tmpcod."' type='checkbox' class='togglelis' /><label for='mytogglelis".$phillis_tmpcod."' class='togglelis'>&nbsp;&nbsp;&nbsp;&nbsp;";
*/
//          $phillis_tmpcod = $tp->toHTML($phillis_row['pais'])."_".$tp->toHTML($phillis_row['tipo'])."_".$tp->toHTML($phillis_row['familia']);
///////////////////          $phillis_text .= ($phillis_text==""?"":"</td></tr></table>");
/*echo "<hr>";
          var_dump(method_exists($tp,'toHTML'));
echo "<hr>";
          var_dump(method_exists($tp,'parsetemplate'));
echo "<hr>";
*/
//          var_dump($sc);
////          $phillis_text .= "<hr>::::::::::::::::::::::::::<hr>";
//          var_dump($phillis_SECTION_START);
/// ISTO � PRECISO PARA CONSEGUIR PROCESSAR AS TEMPLATES DENTRO DA FUN��O....
//		global $type;
//var_dump($phillis_row);
//          $phillis_text .= $phillis_i > 0?$tp->parsetemplate($phillis_template['end'], false, $sc):""; 

//          $phillis_text .= $phillis_i > 0?$tp->parsetemplate($phillis_template['start'], false, $sc):""; 
          
//var_dump ($phillis_row['pais'],$phillis_row['tipo'],$phillis_row['familia']);
//          $phillis_text .= ($phillis_row['pais']&&$phillis_row['tipo']&&$phillis_row['familia'])?$tp->parsetemplate($phillis_template['start'], false, $sc):"";

//  $phillis_text .= $tp->parsetemplate((($phillis_whatdo == "pr")?$phillis_template['print']['start'].$phillis_template['trc']['start']:(($phillis_whatdo == "ed")?$phillis_template['edit']['start']:$phillis_template['start'])), false, $sc); 
//$sc->addVars($scvars);
$sc->setVars($scvars);
//var_dump($phillis_i);
  $phillis_text .= $tp->parsetemplate(
    ($phillis_i > 0?$phillis_template['end']:"").
    (($phillis_whatdo == "pr")?$phillis_template['print_start'].$phillis_template['trc_start']:(($phillis_whatdo == "ed")?$phillis_template['edit_start']:$phillis_template['start']))
    , false, $sc); 
//          $phillis_text .= $tp->parsetemplate($phillis_template['section']['start'], false, $sc);
//      }
//    $phillis_text .= "<h4 class='sectiontitle'>".$phillis_tmpc."</h4>";
//    $phillis_text .= ($phillis_tmpc && $phillis_i > 0?$tp->parsetemplate($phillis_template['item']['end'], false, $sc):"");
//---    $phillis_text .= $tp->parsetemplate($phillis_template['section']['title'], false, $sc);
/*
        if ($phillis_whatdo!="pr") {
//          $phillis_text .= "</label><h4 class='sectiontitle'><br></h4><div class='toggle'>";    
//          $phillis_text .= "</label><h4 class='sectiontitle'><br></h4>";    
          $phillis_text .= $tp->parsetemplate($phillis_template['section']['end'], false, $sc);
        }
*/
//          $phillis_text .= $tp->parsetemplate($phillis_template['item']['start'], false, $sc);
//          $phillis_text .= ($phillis_whatdo == "pr"?"":$tp->parsetemplate($phillis_SECTION_DIV_START, false, $sc));
///              $phillis_text .= "<div class='togglelis'>";
//    $phillis_text .= "<div class='forumheader' style='text-align:left'>".$phillis_tmpc."</div>";
/*
echo "->";
var_dump ($phillis_template);
echo "<hr>";
      */
//        }
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['expcsv'])) {
  $dados[]=array($phillis_tmpc);
  $dados_col = 0;
}

}

  // Se for lista de usados
//if (($phillis_row['b'] & ~2)) {
//echo is_null($phillis_row['b']);
/*
$phillis_begin = ((($phillis_row['b'] & ~2) || ($phillis_row['b'] = 0))?"<span style='color:lightblue'>":"");
$phillis_end = ((($phillis_row['b'] & ~2) || ($phillis_row['b'] = 0))?"</span>":"");
*/
// Tem de fazer um reset � vari�vel....  sen�o fica tudo baralhado...
//$phillis_urow = "";
//$phillis_begin = "";
//$phillis_end = "";
//if (!is_null($phillis_row['b']))
//{
//*$phillis_begin = (!is_null($phillis_row['b'])?"<span class=col>":"");
//echo $phillis_row['quants'];
//echo "|";
//echo $phillis_row['quants']==='0';
//echo "-";
//function asearch($value, $key, $needle)
//{
//    array_search('peca', $value);
//}
//- echo array_walk($phillis_urow, function(&$n) {
//-    echo $n;
//-    array_search('peca', $n); }, $phillis_row['peca']);
//echo $phillis_row['peca']." == ";
//        while ($phillis_trow = $sql2->db_Fetch()){
//          $phillis_urow = ($phillis_trow['peca']==$phillis_row['peca']?$phillis_trow:"");         
//echo $phillis_trow['peca']." |";
//echo $phillis_urow['peca']." |";
//        }
//        $phillis_urow = $sql2->db_Fetch("peca=".$phillis_row['peca']);
//        while ($phillis_urow = $sql2->db_Fetch("peca=".$phillis_row['peca'])){
//var_dump($phillis_urow);
//- echo "<hr>";
//        }
//$phillis_tmp = $phhelper->format_catcode($phillis_row['prefx'],$phillis_row['num'],$phillis_row['sufx'],1);
//$phllist_Allowedviews = (($phillis_action == "s" || $phillis_action == "o")?array("g", "l"):array("c", "x"));
//      $phllist_Allowedviews = $allow_views[$phillis_action];
/*
switch ($phillis_action) {
    case "u":
    case "n":
      $phllist_Allowedviews = $allow_fviews;
      break;
    case "s":
    case "o":
      $phllist_Allowedviews = $allow_tviews;
      break;
}
*/
//  $scwhatdo = getcachedvars('phillis_whatdo');
//    $phllist_Allowedviews = ($phillis_whatdo == "ed" ? $allow_eviews : $allow_views[$phillis_action]);
//var_dump ($_SESSION['phillis_view']);
/*
switch ($phillis_action) {
    case "u":
    case "n":
//      $phillis_view = $_SESSION['phillis_view'][0];
      $phillis_quants = $phillis_cuserid && $phillis_row['quant']>0 && !$phillis_row['quants'];
      break;
    case "s":
    case "o":
//      $phillis_view = $_SESSION['phillis_view'][1];
      $phillis_quants = $phillis_cuserid && $phillis_row['quants']>0 && !$phillis_row['quant'];
      break;
}
var_dump ($phillis_cuserid);
*/
//    if ($phillis_whatdo == "ed") $phillis_view = $_SESSION['phillis_view'][2];
//    cachevars('phillis_view', $phillis_view);
//if ($phillis_row['quant']>'0' && !$phillis_row['quants']) $phillis_ccount++;
//echo "-";
//var_dump($phillis_quants);
//if ($phillis_quants) $phillis_ccount++;
if ($scvars['phillis_quants']) $phillis_ccount++;
//var_dump($phillis_cuserid);
//var_dump($phillis_row['quant']);
//var_dump($phillis_row['quants']);
//var_dump($phillis_ctemp[1]);
//$phillis_tmp = (array_key_exists($phillis_view, ($phillis_whatdo == "ed" ? $allow_eviews : $allow_views[$phillis_action])) && $phillis_view=="x" && !is_null($phillis_row['b']) && $phillis_whatdo<>"ed"?$colnum:($phillis_quants?"<mark>":"").$phhelper->format_catcode($phillis_row['prefx'],$phillis_row['num'],$phillis_row['sufx'],1).($phillis_quants?"</mark>":""));
//echo "<hr>";
//var_dump (array_key_exists($phillis_view, ($phillis_whatdo == "ed" ? $pref['allowed_eviews'] : $pref['allowed_views'][$phillis_action])) && $phillis_view=="x" && !is_null($phillis_row['b']) && $phillis_whatdo<>"ed");
//var_dump ($phillis_view);
//var_dump ($phillis_action);
//var_dump ($pref['allowed_views']);
//var_dump (array_key_exists($phillis_view, ($phillis_whatdo == "ed" ? $pref['allowed_eviews'] : $pref['allowed_views'])));
//var_dump ($phillis_view=="x");
//var_dump ($phillis_row);
//var_dump ($phillis_row['b']);
//var_dump (!is_null($phillis_row['b']));
//var_dump ($phillis_whatdo<>"ed");
//echo "<hr>";

////$phillis_tmp = (array_key_exists($phillis_view, ($phillis_whatdo == "ed" ? $pref['allowed_eviews'] : $pref['allowed_views'])) && $phillis_view=="x" && !is_null($phillis_row['b']) && $phillis_whatdo<>"ed"?PHLIS_REPLXNUM:($phillis_quants?"<mark>":"").Phil::format_catcode($phillis_row['prefx'],$phillis_row['num'],$phillis_row['sufx'],1).($phillis_quants?"</mark>":""));

///$phillis_tmp = (array_key_exists($phillis_view, ($phillis_whatdo == "ed" ? $pref['allowed_eviews'] : $pref['allowed_views'])) && $phillis_view=="x" && !is_null($phillis_row['b']) && $phillis_whatdo<>"ed"?$pref['repl_xnum']:($phillis_quants?"<del>":"").preg_replace('/(\[.*?\])/', '', $tp->toHTML((is_null($phillis_row['prefx'])?" ":$phillis_row['prefx']).$phillis_row['num'].(is_null($phillis_row['sufx'])?"":(preg_match("/^[[(]+/",$phillis_row['sufx'])?"<i><small>":"").$phillis_row['sufx'].(preg_match("/^[[(]+/",$phillis_row['sufx'])?"</small></i>":"")))).($phillis_quants?"</del>":""));
//var_dump($philis_pref['allow_eviews']);
//var_dump($philis_pref['allow_fviews']);
$phillis_tmp = (array_key_exists($phillis_view, $phillis_whatdo=="ed"? defset($philis_pref['allow_eviews'], array()) : defset($philis_pref['allow_fviews'], array())) && $phillis_view=="x" && !is_null($phillis_row['b']) && $phillis_whatdo<>"ed"?$philis_pref['repl_xnum']:preg_replace('/(\[.*?\])/', '', $tp->toHTML((is_null($phillis_row['prefx'])?" ":$phillis_row['prefx']).$phillis_row['num'].(is_null($phillis_row['sufx'])?"":(preg_match("/^[[(]+/",$phillis_row['sufx'])?"<i><small>":"").$phillis_row['sufx'].(preg_match("/^[[(]+/",$phillis_row['sufx'])?"</small></i>":"")))));

//$phillis_tmp = (array_key_exists($phillis_view, ($phillis_whatdo == "ed" ? $allow_eviews : $allow_views[$phillis_action])) && $phillis_view=="x" && !is_null($phillis_row['b']) && $phillis_whatdo<>"ed"?$colnum:(($phillis_row['quant']>'0' && !$phillis_row['quants'])?"<mark>":"").$phhelper->format_catcode($phillis_row['prefx'],$phillis_row['num'],$phillis_row['sufx'],1).(($phillis_row['quant']>'0' && !$phillis_row['quants'])?"</mark>":""));
//    cachevars('phillis_tmp', $phillis_tmp);
$scvars['phillis_tmp'] = $phillis_tmp;
//$scvars['phillis_quants'] = $phillis_quants;
//$sc->setVars(array(['phillis_tmp'] => $phillis_tmp));
//$sc->addVars(array(['testetetsetet'] => 'sdasdsdasdsd'));
$sc->addVars($scvars);

//var_dump ($phillis_tmp);
//e107::setRegistry('phillis_tmp', $phillis_tmp);    
    if ($phillis_whatdo=="ed") {
//var_dump ($phillis_whatdo);
    $phillis_text .= $tp->parsetemplate($phillis_template['edit_item'], false, $sc);
} else {
    if (($phillis_action == "o" || $phillis_action == "s")) {
//-----    if ($type=="img") {
//    ECHO "IMAGEM";
/////////////////////$phillis_image = e_PLUGIN_ABS."philcat/".e107::getPlugPref("philcat")['filepath'].$phillis_row['pais_real']."/t/".$phillis_row['peca'].".jpg";
$phillis_image = e_PLUGIN_ABS."philcat/".e107::getPlugPref("philcat")['filepath'].$phillis_row['pais']."/t/".$phillis_row['peca'].".jpg";

//    cachevars('phillis_image', $phillis_image);
$scvars['phillis_image'] = $phillis_image;
  $sc->addVars($scvars);
  //e107::setRegistry('phillis_image', $phillis_image);    
//$phillis_tmp = $tp->toHTML((is_null($phillis_row['prefx'])?" ":$phillis_row['prefx']).$phillis_row['num'].(is_null($phillis_row['sufx'])?" ":$phillis_row['sufx']));
//var_dump($phillis_row);
//$phillis_tmp = preg_replace('/(\[.*?\])/', '', $phillis_tmp);
/////if ($phillis_whatdo=="pdf") {
/*
if ($pdf) {
//    $phillis_text[]["img"] = array($phillis_image,$phillis_tmp);
// IMAGENS NO PDF...... FALTA COLOCAR AS IMAGENS MESMO....
var_dump ($phillis_image);
var_dump (is_readable($phillis_image));
echo "<hr>";
/*
if(!is_readable($phillis_image)) {
    $phillis_image = e_PLUGIN_ABS."philcat/images/miss.jpg";
}
*/
/*
//$x = $pdf->GetX();
//$y = $pdf->GetY();
list($width, $height) = getimagesize($phillis_image);
//$mmwidth = $pdf->pixelsToMM($width);
$mmheight = $pdf->pixelsToMM($height);
$x = ($x?$x+$mmwidth:$pdf->GetX());
//$x = ($x<210?$x:$fisrtx);
//$y = $pdf->GetY();
//$y = $pdf->GetY();
if ($x+$mmwidth>200) {
        $pdf->Ln();
//$y = $pdf->SetY($y-$mmheight);
}
$y = $pdf->GetY();
//$y = ($x<210?"":$pdf->SetY($y+$mmheight));
if ($x+$mmwidth>200) {
$x = $pdf->GetX();
$y = $pdf->SetY($y-$mmheight);
$y = $pdf->GetY();
}
//  $pdf->MultiCell( $mmwidth, $mmheight+4, $pdf->Image($phillis_image, $x, $y).$x.":".$y, 1, 0, 'C', false );
//  $pdf->Image($phillis_image, $x, $y);
//  $pdf->Cell( $mmwidth, $mmheight+4, $pdf->Image($phillis_image, $x, $y), 1, 0, 'C', false );
//  $pdf->Cell( $mmwidth, $mmheight+4, $pdf->Image($phillis_image, $x, $y), 1, 0, 'C', false );
//  $pdf->SetX($mmwidth);
//  $pdf->SetY($mmheight+4);
//  $pdf->Image($phillis_image, $x, $y);
  //if ($x==$fisrtx) {$pdf->SetY($y);};
  $pdf->SetX($x);
//  $pdf->Write($mmheight+22, $y.":".round($mmheight, 2));
  $pdf->Write($mmheight+22, strip_tags($phillis_tmp));
$y = $pdf->GetY();
  $pdf->Image($phillis_image, $x, $y);
//  $pdf->Write($mmheight+22, $x);
$mmwidth = $pdf->pixelsToMM($width);
//$xo = $x;
//            $pdf->MultiCell(50,6,$phillis_tmp,1);
//        $pdf->Ln();
//                        $pdf->Image($phillis_image);
//                        $pdf->SetFont( 'Arial', '', 10 );
//                        $pdf->SetTextColor( 0, 0, 0);
//                        $pdf->Write(4, strip_tags($phillis_tmp)."  ");
//                        $pdf->Write(4, $pdf->Image($phillis_image, $pdf->GetX(), $pdf->GetY()).strip_tags($phillis_tmp)."  ");
} else {
*/
//    $phillis_text .= "<li><img src='".$phillis_image."'/><br/><b>".$phillis_tmp."</b></li>";
//var_dump($phillis_tmp);
//    cachevars('phillis_tmp', $phillis_tmp);
//  $sc->addVars($scvars);

  $phillis_text .= $tp->parsetemplate($phillis_template['trc_body'], false, $sc);
//}
}
else {
///$phhelper = new Phil();
//$phillis_tmp = $phhelper->format_catcode($phillis_row['prefx'],$phillis_row['num'],$phillis_row['sufx'],1);
//$phillis_tmp = $tp->toHTML((is_null($phillis_row['prefx'])?" ":$phillis_row['prefx']).$phillis_row['num'].(is_null($phillis_row['sufx'])?"":(preg_match("/^[[(]+/",$phillis_row['sufx'])?"<i><small>":"").$phillis_row['sufx'].(preg_match("/^[[(]+/",$phillis_row['sufx'])?"</small></i>":"")));
//$phillis_tmp = preg_replace('/(\[.*?\])/', '', $phillis_tmp);
//$phillis_tmp = $tp->toHTML((is_null($phillis_row['prefx'])?" ":$phillis_row['prefx']).$phillis_row['num'].(is_null($phillis_row['sufx'])?"":(preg_match("/^[[(]+/",$phillis_row['sufx'])?"<i><small>":"").$phillis_row['sufx'].(preg_match("/^[[(]+/",$phillis_row['sufx'])?"</small></i>":"")));
Switch ($phillis_whatdo) {
////////////////////////case "pdf":
//if ($phillis_whatdo=="pdf") {
//$phillis_begin = "<span class='".(!is_null($phillis_row['b'])?"col":"list")."'";
//                        $pdf->SetFont( 'Arial', '', 10 );
////////////////////////                        $pdf->SetFont( 'Helvetica', '', 10 );
//$phillis_key = (!is_null($phillis_row['b'])
////////////////////////  (!is_null($phillis_row['b'])
////////////////////////                ?
//                  (($phillis_row['quants']==='0')
////////////////////////                    ($phillis_view=='x'
////////////////////////                  ?
//                        $pdf->SetFont( 'Arial', '', 10 );
////////////////////////                        $pdf->SetTextColor( 255, 0, 0)
//                        $pdf->Write( 4, $phillis_tmp." " );
////////////////////////                  :
//                        $pdf->SetFont( 'Arial', '', 10 );
////////////////////////                        $pdf->SetTextColor( 0, 255, 255)
//                        $pdf->Write( 4, $phillis_tmp." " );
////////////////////////                  )
////////////////////////                :
//                        $pdf->SetFont( 'Arial', '', 10 );
////////////////////////                        $pdf->SetTextColor( 0, 0, 0)
//                        $pdf->Write( 4, $phillis_tmp." " );
////////////////////////                );
////////////////////////                        $pdf->Write( 4, strip_tags($phillis_tmp)." " );
//- $phillis_begin = "<span class='".(!is_null($phillis_urow['b'])?"col":"list")."'";
//   $phillis_text[][$phillis_key] = $phillis_tmp;
//---} else if ($whatdo=="pr"){
//---  $phillis_text_class = (($phillis_row['quants']==='0')?"wait ":"").(!is_null($phillis_row['b'])?"col":"");
//---  $phillis_text .= ($phillis_text_class?"<span class='".$phillis_text_class."'>":"");
//---  $phillis_text .= $phillis_tmp." ";
//---  $phillis_text .= ($phillis_text_class?"</span>":"");
//} else {
//    cachevars('phillis_tmp', $phillis_tmp);
//var_dump ($phillis_whatdo);
//$teeemp = $phillis_whatdo;
////////////////////////      break;
//  case "ed":
//    $phillis_text .= $tp->parsetemplate($phillis_EDITITEM, false, $sc);
//    break;
  case "pr":
    $phillis_text .= $tp->parsetemplate($phillis_template['print_item'], false, $sc);
    break;
  default:
/*
    if ($pdf) {
                        $pdf->SetFont( 'Helvetica', '', 10 );
  (!is_null($phillis_row['b'])
                ?
                    ($phillis_view=='x'
                  ?
                        $pdf->SetTextColor( 255, 0, 0)
                  :
                        $pdf->SetTextColor( 0, 255, 255)
                  )
                :
                        $pdf->SetTextColor( 0, 0, 0)
                );
                        $pdf->Write( 4, strip_tags($phillis_tmp)." " );
    }
    else {
*/
    $phillis_text .= $tp->parsetemplate($phillis_template['item'], false, $sc);
//    }
} // FIM DO SWITCH....
//} // FIM DO IF PDF....
} // FIM DO IF IMG....
} // FIM DO IF EDIT....
$phillis_i++;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['expcsv'])) {
  $dados_val = $scvars['phillis_quants']?"":$phillis_row['prefx'].$phillis_row['num'].$phillis_row['sufx'];
  if ($dados_col == 0) {
    $dados[]=array($dados_val);
  }
  else {
    // Append to the last item (which is an array)
    $lastIndex = count($dados) - 1;
    $dados[$lastIndex][]=$dados_val;
  }
  $dados_col++;
  if ($dados_col > 14) {$dados_col=0;}
}

} // FIM DO WHILE....
//$sc->addVars($scvars);
$phillis_text .= $tp->parsetemplate($phillis_template['end'], false, $sc); 
//$phillis_text .= "FIM DO WHILE";
//        if ($phillis_whatdo!="pr") {
//          $phillis_text .= "</label><h4 class='sectiontitle'><br></h4><div class='toggle'>";    
//          $phillis_text .= "</label><h4 class='sectiontitle'><br></h4>";    
//          $phillis_text .= $tp->parsetemplate($phillis_template['section']['end'], false, $sc);
//        }
//    cachevars('phillis_ccount', $phillis_ccount);
//////////////////////////---------------------------------------$scvars['phillis_ccount'] = $phillis_ccount;  /// Para que isto aqui?
//e107::setRegistry('phillis_ccount', $phillis_ccount);    
  } // FIM DO SELECT....

} 

//------}
//var_dump ($whatdo);
//var_dump ($phillis_whatdo);
/*
if ($phillis_whatdo==1){
//  $phillis_text .= "<div id='listingu'>";
//  $phillis_text .= lista_num(ed); 
  $phillis_text .= $tp->parsetemplate($phillis_EDSTART.$phillis_text.$phillis_END, false, $sc); 
//echo "<hr>";
/// ADICIONAR JAVASCRIPTPROTOYPE
If (!$whatdo) {
//  $phillis_text .= "<link rel='stylesheet' href='".e_PLUGIN."phil/dialog/dialog_box.css' type='text/css' />";
//  $footer_js[] = "../phil/dialog/dialog_box.js";
  $footer_js[] = "phillis_class.js";
}
//if ($phillis_action == "n" || $phillis_action == "u") {
//  $phillis_text .= "<hr>".leg_faltas();
//}
//  $phillis_text .= "</div>";
} ELSE {
// ######## LISTAS DE FALTAS INDIVIDUAIS
//-----if ($phillis_action == "n" || $phillis_action == "u")
//-----{
//  $phillis_text .= "<div id='listing'>";
//  $phillis_text .= lista_num(); 
  $phillis_text .= $tp->parsetemplate($phillis_START.$phillis_text.$phillis_END, false, $sc); 
//  $phillis_text .= "<hr>".leg_faltas()."</div>"; 
//  $phillis_text .= "</div>"; 
//-----}
// ######## FIM LISTAS DE FALTAS INDIVIDUAIS
// ######## LISTAS DE TROCAS INDIVIDUAIS
//-----if ($phillis_action == "o" || $phillis_action == "s")
//if ($phillis_action[0] == "t")
//-----{
//  $phillis_text .= lista_img();
//-----  $phillis_text .= $tp->parsetemplate($phillis_START.$phillis_text.$phillis_END, false, $sc);
//-----}
// ######## FIM LISTAS DE TROCAS INDIVIDUAIS
}
*/
//$phillis_text .= $tp->parsetemplate($phillis_template['end'], false, $sc); 
/*
if ($phillis_whatdo==1){
//  $phillis_text .= "<div id='listingu'>";
//  $phillis_text .= lista_num(ed); 
  $phillis_text .= $tp->parsetemplate($phillis_EDSTART.cria_lista(ed).$phillis_END, false, $sc); 
//echo "<hr>";
/// ADICIONAR JAVASCRIPTPROTOYPE
If (!$whatdo) {
//  $phillis_text .= "<link rel='stylesheet' href='".e_PLUGIN."phil/dialog/dialog_box.css' type='text/css' />";
//  $footer_js[] = "../phil/dialog/dialog_box.js";
  $footer_js[] = "phillis_class.js";
}
//if ($phillis_action == "n" || $phillis_action == "u") {
//  $phillis_text .= "<hr>".leg_faltas();
//}
//  $phillis_text .= "</div>";
} ELSE {
// ######## LISTAS DE FALTAS INDIVIDUAIS
if ($phillis_action == "n" || $phillis_action == "u")
{
//  $phillis_text .= "<div id='listing'>";
//  $phillis_text .= lista_num(); 
  $phillis_text .= $tp->parsetemplate($phillis_START.cria_lista().$phillis_END, false, $sc); 
//  $phillis_text .= "<hr>".leg_faltas()."</div>"; 
//  $phillis_text .= "</div>"; 
}
// ######## FIM LISTAS DE FALTAS INDIVIDUAIS
// ######## LISTAS DE TROCAS INDIVIDUAIS
if ($phillis_action == "o" || $phillis_action == "s")
//if ($phillis_action[0] == "t")
{
//  $phillis_text .= lista_img();
  $phillis_text .= $tp->parsetemplate($phillis_START.cria_lista(NULL ,img).$phillis_END, false, $sc);
}
// ######## FIM LISTAS DE TROCAS INDIVIDUAIS
}
*/
//If ($phillis_whatdo<="ed") {
//--- If ($phillis_whatdo==1) {
//  $phillis_text .= '<script type="text/javascript" src="phillis_class.js"></script> ';
//---  $footer_js[] = "phillis_class.js";
//  $footer_js[] = "../phil/dialog/dialog_box.js";
//  $phillis_text .= '<script type="text/javascript" src="phillis_class.js"></script> ';
/// } else {
//---    }
//$phillis_text .= phdhtmlpopcss;
//e107::js("footer", phdhtmlpopjs);
//$footer_js[] = phdhtmlpop;
//$footer_js[] = phdhtmlpopjs;
/*
$phillis_text .= "<link rel='stylesheet' href='".e_PLUGIN."phil_cat/includes/imagepop.css' type='text/css' />
<div id='dhtmltooltip'><img src='".e_PLUGIN."phil_cat/images/loading.gif'></div>
<script src='".e_PLUGIN."phil_cat/includes/imagepop.js' language='javascript' type='text/javascript'></script>";
*/
//$phillis_text .= "</div>";
//}
// ######## FIM MODO DE EDI��O DAS LISTAS
// ######## COMENT-RIOS
if ($phillis_action[0] == "c" && $phillis_action[1] == "." )
{
$phillis_caption = LAN_PLUGIN_PHILLIS_34.LAN_PLUGIN_PHILLIS_33.LAN_PLUGIN_PHILLIS_110." ".(($phillis_action[3] == "u")?LAN_PLUGIN_PHILLIS_18:(($phillis_action[3] == "n")?LAN_PLUGIN_PHILLIS_19:"")).LAN_PLUGIN_PHILLIS_37.$gstyle_obj->showUser($phillis_userid);
$phillis_text .= "<center><p class='fcaption'>".LAN_PLUGIN_PHILLIS_17."</p>";
$phillis_text .= "<form action='" . e_SELF . "' method='post' id='phillisform' >";
$phillis_text .= "<textarea name='phillis_val' style='width:100%;' cols='50' rows='7' class='tbox'></textarea><br />";
$phillis_text .= "<input type='submit' class='button' name='subbio' value='Enviar'/>";
$phillis_text .= "<input class='tbox' name='phillis_get' type='hidden' value='".(e_QUERY?str_replace("c_", "", e_QUERY):$_POST['phillis_get'])."'/>";
$phillis_text .= "</form>";
}
// ######## FIM COMENT-RIOS
//var_dump ($phillis_caption);
//echo "<hr><hr><hr><hr><hr><hr><hr>";
//var_dump ($phillis_whatdo<= "ed");
//exit;

//Isto tem de ir por causa do menu.... Ou uso cookies?
e107::setRegistry('phillis_action', $phillis_action);
e107::setRegistry('phillis_userid', $phillis_userid);
e107::setRegistry('phillis_ccount', $phillis_ccount);
e107::setRegistry('phillis_whatdo', $phillis_whatdo);
/*
$phillis_shortcodesaction = getcachedvars('phillis_action');
$phillis_shortcodesuserid = getcachedvars('phillis_userid');
$phillis_shortcodesccount = getcachedvars('phillis_ccount');
//  $phillis_shortcodesview = getcachedvars('phillis_view');
 getcachedvars('phillis_whatdo');
*/
//} // ##### FIM DA ESCRITA CASO O PLUGIN CATALOGO ESTEJA ACTIVO....
//var_dump ($phillis_text);
/*
var_dump(e107::getRegistry('phillis_action'));
var_dump(e107::getRegistry('phillis_userid'));
var_dump(e107::getRegistry('phillis_ccount'));
var_dump(e107::getRegistry('phillis_whatdo'));
*/
//if ($phillis_whatdo <= "ed" && !$pdf){
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['expcsv'])) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="lista.csv"');

/*  
    $dados = [
        ['Nome', 'Idade', 'Email'],
        ['João', 30, 'joao@email.com'],
        ['Maria', 25, 'maria@email.com']
    ];
*/

    $output = fopen('php://output', 'w');
    foreach ($dados as $linha) {
        fputcsv($output, $linha);
    }
    fclose($output);
    exit;
  }

  if ($phillis_whatdo <= "ed"){
    require_once(HEADERF);
//echo "<hr><hr><hr><hr><hr><hr><hr>";
//e107::js("footer", "var phcat_14 = '".phcat_14."';", "jquery"); 
if (ADMIN == TRUE) {
//  $pref=e107::getPlugPref("phillis");
  e107::lan('phillis',"admin", true);
//  var_dump($philis_pref['read']);
//  var_dump($philis_pref['create']);
//  var_dump($philis_pref['admin']);
    if (!check_class($philis_pref['create'])){
    $msg->addwarning(LANAD_PLUGIN_PHILLIS_20);
//    $phillis_text = $msg->render().$phillis_text;
  }
}

if ($phillis_whatdo == "ed") {
  $msg->addwarning(LAN_PLUGIN_PHILLIS_14);
/*
  $phillis_text .='
<!--begin::Toast-->
<div id="phillis-toast-container" class="toast-container top-0 end-0 p-3">
 
</div>
<!--end::Toast-->
  ';
*/
} else {
  if (!$datam && !$phillis_ccount) $msg->addinfo(LAN_PLUGIN_PHILLIS_36);
}
//$msg->addwarning(LAN_PLUGIN_PHILLIS_14);
$phillis_text .= $tp->parsetemplate($phillis_template['end_footer'], false, $sc); 
// Add toasts if in edit mode
$phillis_text .=$phillis_whatdo == "ed"?'<div id="phillis-toast-container" class="toast-container bottom-0 end-0 p-3"></div>':
'';
//var_dump($phillis_text);
//$ns->tablerender(($phillis_caption?$phillis_caption:""), $phillis_text);
if ($phillis_template['caption']) {
  $caption_sc['PHLIS_CAPTION'] = $phillis_caption;

	if((USER && $phillis_userid == USERID) || ADMIN)
	{
	  //$url = e107::url('forum', 'post') . "?f=edit&amp;id=" . $threadID . "&amp;post=" . $postID;
//	  $url = e107::url('forum', 'post') . "?f=edit&amp;id=" . $this->fv_threadID . "&amp;post=" . $this->viewforum_sc->postInfo['post_id'] . "&amp;p=".(varset($_GET['p']) ? (int)$_GET['p'] : 1);
	  //$url = e107::getUrl()->create('forum/thread/edit', array('id' => $threadID, 'post'=>$postID));
//var_dump($phillis_whatdo);
//var_dump($phillis_action);
//var_dump($phillis_temp[0].".".$phillis_userid);
    $buttmode = ($phillis_whatdo == "ed"?'view':'edit');
    $caption_sc['PHLIS_EDITVIEW_BUTTON'] = "<a class='btn btn-default text-nowrap icon-{$buttmode}' role='button' href='" . e107::url('phillis', $buttmode, array("id" =>$phillis_temp[0].".".$phillis_userid)) ."'>".($phillis_whatdo == "ed"?LAN_VIEW:LAN_EDIT)."</a>";
  }

  $phillis_caption = $tp->parsetemplate($phillis_template['caption'], false, $caption_sc);
}
$ns->tablerender($phillis_caption, $msg->render().$phillis_text);
/*
if ($comment_to > 0 && $pref['phillis_usecomments'] > 0)
{
    $phillis_com->compose_comment("phcat", "comment", $comment_to, $width, $comment_sub, false);
}
*/

require_once(FOOTERF);

}
