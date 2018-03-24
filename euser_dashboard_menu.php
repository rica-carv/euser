<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        Online Info Menu v3.0 for e107 v0.616 by TheMadMonk
|              TheMadMonk@GamingMad.com
|
|      Released under the terms and conditions of the
|      GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+

############# PARCIALMENTE Actualizado para E107 V2.0
*/

//echo "<hr><hr>";
//exit;

//require_once('../../class2.php');
//var_dump ("TESTER");

if (!defined('e107_INIT')) { exit; }
//var_dump($parm);

/*
global $tp;
	$sc = e107::getScBatch('euser', true);
//var_dump ($sc);
//	$sc = e107::getScBatch('user');
var_dump ($sc);

//var_dump ($user_shortcodes);

var_dump ($tp->parseTemplate("---->{USER_NAME_LINK}{USER_JOIN}{USER_REALNAME}<----<br>{LM_USERNAME_LABEL}<br />
            {LM_USERNAME_INPUT}<br />
            {LM_PASSWORD_LABEL}<br />
            {LM_PASSWORD_INPUT}", true, $sc));
*/

// ###### TESTES PARA VER O QUE VOU FAZER....
// SE INCLUIR O CÓDIGO DO LOGIN_MENU, SE FAZER O RENDER DO LOGIN_MENU E INJECTAR HTML LÁ DENTRO....

//____>global $tp;
//____>$sc = e107::getScBatch('login_menu',TRUE);
//____>echo "<hr><hr><hr><hr><hr>CMENU:<br>";
//____>var_dump ($tp->parseTemplate("{CMENU=login_menu/login}", true, $sc));
//____>echo "<hr><hr><hr><hr><hr>função render_menu true (SC_CMENU):<br>";
//____>var_dump (e107::getMenu()->renderMenu('login_menu/login', false, false, true));
//____>echo "<hr><hr><hr><hr><hr>função render_menu false (SC_CMENU):<br>";
//____>var_dump (e107::getMenu()->renderMenu('login_menu/login', false, false, false));
//____>echo "<hr><hr><hr><hr><hr>MENU:<br>";
//____>var_dump ($tp->parseTemplate("{MENU=login_menu/login}", true, $sc));
//____>echo "<hr><hr><hr><hr><hr>função render_menu sem parametros (SC_MENU):<br>";
//____>var_dump (e107::getMenu()->renderMenu('login_menu','login_menu'));
//____>echo "<hr><hr><hr><hr><hr>função render_menu TRUE (SC_MENU):<br>";
//$mes = e107::getMessage();

//////e107::getMessage()->addDebug(htmlspecialchars(e107::getMenu()->renderMenu('login_menu','login_menu', false, true), ENT_QUOTES));
//print_r (e107::getMenu()->renderMenu('login_menu','login_menu', false, true));
//////e107::getMessage()->addDebug(e107::getMenu()->renderMenu('login_menu','login_menu', false, true));

// ###### TESTES PARA VER O QUE VOU FAZER....
// O DOM nem vale a pena, é uma merda........
//$doc = new DomDocument;
        //$dom->preserveWhiteSpace = FALSE;
//        $doc->loadHTML(e107::getMenu()->renderMenu('login_menu','login_menu', false, true));

//////$node = $doc->createElement("para");
//////$node = $doc->loadHTML("<hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>");
/*
$f = $doc->createDocumentFragment();
$f->appendXML("<hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>");
$doc->appendChild($f);
*/
//$field_html = $doc->createDocumentFragment(); // create fragment
//$field_html->appendXML("<hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>");
//$field_div = $doc->createElement("div");
//$field_div->appendChild($field_html);
//$doc->appendChild($field_div);


//$mes->addDebug("-vvvvvvvv-");
//////$mes->addDebug(var_dump($dom));

//////$mes->addDebug("---------");
//////$mes->addDebug(htmlspecialchars($field_div->saveHTML(), ENT_QUOTES));
//////$mes->addDebug("---------");
//$mes->addDebug(htmlspecialchars($html_fragment, ENT_QUOTES));
//$mes->addDebug("---------");
//$mes->addDebug($html_fragment);

//$mes->addDebug("-^^^^^^^^-");

//var_dump (getcachedvars('login_menu_data'));

// Defaults to global pref if no parm from menu pref
//var_dump ($parm);
// Tirar caso aprovem o issue... os parms só vem por defeito das prefs em último caso...
//if (!$parm) {$parm = e107::getPlugPref('euser');}
$parm = $this->getParams('euser_dashboard_menu', 1)[0]; // area 2
if (!$parm) {$parm = e107::getPlugPref('euser');}
//echo "<hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>";
//var_dump ("sladkaslkdksalçdklçsadkaslçdk");
//var_dump ($parm);

// O tipo de menu passa a ser definido no próprio template...
//If ($euser_pref['loginmenutype']==0){//define(OIM_TYPE, "micro");
// CARREGAMENTO E DEFINIÇÕES DAS TEMPLATES - ANTIGO
//}

if(!deftrue('BOOTSTRAP'))
{
e107::js('euser', 'js/switchcontent.js');  // Mostra e esconde conteúdo (http://dynamicdrive.com/dynamicindex17/switchcontent.htm)    V2
e107::js('euser', 'js/online.js');  // Tooltips js??    V2
}

e107::css('euser','euser_menu.css');
//e107::lan('euser','front', true);
//e107::lan('login_menu', '', true);
//    o e107:: lan não funciona com o login menu lan's...
e107::includeLan(e_PLUGIN.'login_menu/languages/'.e_LANGUAGE.'.php');
//e107::lan('euser','all_menu', true);
e107::lan('euser', 'front', true);


//global $eMenuActive, $e107, $tp, $use_imagecode;

global $eMenuActive, $e107, $use_imagecode;
$tp = e107::getParser();
//include_once(e_PLUGIN."euser/includes/euser_functions.php");
// Passou para o fundo, linha 968, as funções só são precisas quase no fim...


// §§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§
// ESTE CÓDIGO DAQUI PARA BAIXO TEM DE SER TODO REVISTO E ALTERADO, PORQUE DUPLICA COISAS E PODE SER MINIMIZADO...

// O tipo de menu passa a ser definido no próprio template... isto tem de sair daqui, para um shortcode, por exemplo... ou com uma constante definida no próprio template...
//var_dump ($euser_pref['loginmenutype']);
if(!deftrue('BOOTSTRAP')){
//If ($euser_pref['loginmenutype']==0){//define(OIM_TYPE, "micro");
//define(OIM_TYPE, "mini");
var_dump ("-NON BOOTSTRAP EUSER ALL MENU-");

// se o bootstrap não estiver definido (se não for um tema boostrap), carrega o javascript
//--->if(!deftrue('BOOTSTRAP'))
//--->{
//$text="<script type='text/javascript' src='".e_PLUGIN."euser/switchcontent.js'></script>";   // Antigo
//--->e107::js('euser', 'js/switchcontent.js');  // Mostra e esconde conteúdo (http://dynamicdrive.com/dynamicindex17/switchcontent.htm)    V2
//--->e107::js('euser', 'js/online.js');  // Tooltips js??    V2

//--->}






//$text = '';

//$text = OIM_TYPE." = ".($euser_pref['loginmenutype']!=0);


//--->e107::lan('euser','front', true);
//$lan_file = e_PLUGIN."euser/languages/".e_LANGUAGE.".php";
//include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."euser/languages/English.php");

//--->include_once(e_PLUGIN."euser/includes/euser_functions.php");


//$text = '<div id="eusermenu"><link rel="stylesheet" type="text/css" href="'.e_PLUGIN.'euser/login_mini_menu_template.css"><div id="onlineinfodhtmltooltip"></div><script type="text/javascript" src="'.e_PLUGIN.'euser/online.js"></script>';
/*
$text = '<div id="eusermenu"><div id="onlineinfodhtmltooltip"></div>';
e107::css('euser','euser_login_menu.css');

//$euser_pref = e107::getPlugPref('euser');

//$euser_pref = e107::getPlugPref('euser');
//global $euser_pref;
//print_r (e107::getPlugPref('euser'));
//var_dump($euser_pref);

$onlineinfomenuwidth=$euser_pref['width'];
//$onlineinfomenuwidth=e107::pref('onlineinfo_width');
//var_dump ($onlineinfomenuwidth);

$onlineinfomenucolour=$euser_pref['flashtext_colour'];
$onlineinfomenufsize=$euser_pref['fontsize'];

$text.='
<script type="text/javascript">
var flashlinks=new Array()
function changelinkcolor(){
for (i=0; i< flashlinks.length; i++){
var flashtype=document.getElementById? flashlinks[i].getAttribute("flashtype")*1 : flashlinks[i].flashtype*1
var flashcolor=document.getElementById? flashlinks[i].getAttribute("flashcolor") : flashlinks[i].flashcolor
if (flashtype==0){
if (flashlinks[i].style.color!=flashcolor)
flashlinks[i].style.color=flashcolor
else
flashlinks[i].style.color=""
}
else if (flashtype==1){
if (flashlinks[i].style.backgroundColor!=flashcolor)
flashlinks[i].style.backgroundColor=flashcolor
else
flashlinks[i].style.backgroundColor=""
}
}
}

function init(){
var i=0
if (document.all){
while (eval("document.all.flashlink"+i)!=null){
flashlinks[i]= eval("document.all.flashlink"+i)
i++
}
}
else if (document.getElementById){
while (document.getElementById("flashlink"+i)!=null){
flashlinks[i]= document.getElementById("flashlink"+i)
i++
}
}
setInterval("changelinkcolor()", 500)
}

if (window.addEventListener)
window.addEventListener("load", init, false)
else if (window.attachEvent)
window.attachEvent("onload", init)
else if (document.all)
window.onload=init

</script>
';
*/
/*§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§
// A gestão de contas suspensas é feita pelo próprio login_menu do core, que é incluido aqui no caso de o utilizador não estar logado. Não vale a pena estar a duplicar templates e código....

$n=0;
$suspended=0;



$script="SELECT * from ".MPREFIX."euser_suspend WHERE user_id=".USERID." ORDER BY user_name";

//echo $script;

$data = $sql->db_Select_gen($script);
if ($data)
    {
	$text.='<script language="javascript" type="text/javascript"> window.location="'.e_BASE.'index.php?logout"; </script>';
	}


 $script="SELECT * from ".MPREFIX."euser_suspend WHERE ip='".$_SERVER['REMOTE_ADDR']."' ORDER BY user_name";

//echo $script;
//var_dump($script);

 $data = $sql->db_Select_gen($script);
//var_dump($data);
 if ($data)
     {
// CONTA SUSPENSA
//--    $caption = "<img src='".e_PLUGIN."'euser/images/delete.png' alt='' />".LAN_EUSER_0083;
	$text.="<div id='flashlink".$n."' flashtype=0 flashcolor='".$onlineinfomenucolour."' style='font-size: 14px; text-align:center; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;'><br />".LAN_EUSER_0083."<br /><br /></div>";
	$text.="<div style='font-size: 12px; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;'>".LAN_EUSER_0084."<br /><br /></div>";
	$suspended=1;
$n++;

 	}

//var_dump($suspended);
//var_dump($suspended==0);
§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§*/

//___>if ($suspended==0){

//global $eMenuActive, $e107, $tp, $use_imagecode;
// Código antigo
//require_once(e_PLUGIN."euser/euser_shortcodes.php");
//$ip = $e107->getip();

// TODA A GESTÃO DO LOGIN INICIAL E COMPANHIA É FEITO PELO MENU LOGIN DO CORE.....
//$bullet = (defined("BULLET") ? "<img src='".THEME_ABS."images/".BULLET."' alt='' style='vertical-align: middle;' />" : "<img src='".THEME_ABS."images/bullet2.gif' alt='bullet' style='vertical-align: middle;' />");

//if (defined('CORRUPT_COOKIE') && CORRUPT_COOKIE == TRUE) {	$text = "<div style='text-align:center'>".LOGIN_MENU_L7."<br /><br />	".$bullet." <a href='".e_BASE."index.php?logout'>".LOGIN_MENU_L8."</a></div>";	$ns->tablerender(LOGIN_MENU_L9, $text, 'login');}
//$use_imagecode = ($euser_pref['logcode'] && extension_loaded('gd'));

//if ($use_imagecode) {
//	global $sec_img;
//	include_once(e_HANDLER.'secure_img_handler.php');
//	$sec_img = new secure_image;
//}
//---$text .= "";

//--- ISTO TEM DE PASSAR PARA A PÁGINA DO PERFIL #################		$caption = '<a href="'.e_BASE.'usersettings.php" title="'.LAN_EUSER_0012.'" ><img src="'.e_PLUGIN.'euser/images/user_edit.png" alt="" />&nbsp;';
/*-----
if ($euser_pref['caption'] == "[Welcome User]")
{
// LOGIN FEITO
    $caption .= LAN_EUSER_005 . "&nbsp;".USERNAME;
}
else
{
    $caption .= $euser_pref['caption'];
}
----*/
//		$caption .= '</a><span style="float: right;"><a href="'.e_BASE.'index.php?logout" title="'.LAN_EUSER_008.'"><img src="'.e_PLUGIN.'euser/images/cancel.png" alt="" /></a></span>';
//    $caption .= "</a>";







//var_dump (USER == true || ADMIN == true);

$euser_pref = e107::getPlugPref('euser');
// START LOGGED CODE
if (USER == true || ADMIN == true)
{
//		$text .= '<span style="float: right; z-index: 1000; position: relative; margin-top: 2px"><a href="'.e_BASE.'index.php?logout" title="'.LAN_EUSER_008.'"><img src="'.e_PLUGIN.'euser/images/cancel.png" alt="" /></a></span>';

//var_dump($euser_pref['ibfpm']==0);
// UTILIZAÇÃO DE OUTRO SISTEMA DE PM'S, TEM DE SAIR DAQUI, TIPO PARA UM SHORTCODE...
	if($euser_pref['ibfpm']==0){


//		$sql=new db;
		$script="SELECT cache_userclass FROM ".MPREFIX."euser_cache Where type='order' and cache_name='ONLINEINFO_CACHEINFO_12'";		
		$onlineinfoorder = $sql->db_Select_gen($script);		
		while ($row = $sql->db_Fetch()){
		 $cacheuserclass=$row['cache_userclass'];
		 }

//	var_dump(check_class($cacheuserclass));
	if(check_class($cacheuserclass)){



	$pm_user = USERID;
	$unreadpms = $sql -> db_Count("private_msg", "(*)", "WHERE pm_to=$pm_user AND pm_read_del=0 and pm_read=0");

	$pmpath=e_PLUGIN."pm/pm.php?inbox";

	}
	}else{

	$onlineinfo_ipb_sql = new db;

	$script="SELECT * FROM ".$euser_pref['ibfprefix']."message_topics WHERE mt_read=0 AND mt_to_id = ".USERID;
	$onlineinfo_getipbinboxunread = $onlineinfo_ipb_sql->db_Select_gen($script);

	$unreadpms=$onlineinfo_getipbinboxunread;

	$pmpath=SITEURL.$euser_pref['ibflocation']."/index.php?act=Msg&CODE=01&VID=in";

	}


//var_dump($euser_pref['showpmmsg']);
if($euser_pref['showpmmsg']==1){

	if($unreadpms<>0)
	{

if ($euser_pref['sound']=="none" || $euser_pref['sound']==""){
  unset ($euser_pref['sound']);
}
if ($euser_pref['sound']){

////$text .= "SOM:".$euser_pref['sound']."---FIM SOM".!($euser_pref['sound']!="none" || $euser_pref['sound']!="");
	
	$checkpath = explode("/pm/",e_SELF);
	
	if($checkpath[1] != "pm.php"){
	
	$text.="<embed src=\"".e_PLUGIN."euser/sounds/".$euser_pref['sound']."\" autostart=\"true\" loop=\"0\" hidden=\"true\"></embed>";
	
		}
}
	$text.="<div style='background-color: yellow; font-size: 14px; text-align:center; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;'><a id='flashlink".$n."' flashtype=0 flashcolor='".$onlineinfomenucolour."' href='".$pmpath."' title='".LAN_EUSER_0082."' style='text-decoration: none;'>".LAN_EUSER_0081."</a></div>";

	$n++;
	}

}

        list($uid, $upw) = ($_COOKIE[$euser_pref['cookie_name']] ? explode(".", $_COOKIE[$euser_pref['cookie_name']]) : explode(".", $_SESSION[$euser_pref['cookie_name']]));



		$ordersql=new db;
		$script="SELECT * FROM ".MPREFIX."euser_cache Where type='order' ORDER BY type_order";		

//    echo "--SCRIPT 1:".$script;
    
		$onlineinfoorder = $ordersql->db_Select_gen($script);
		
//    echo "--ONLINE INFO ORDER:".$onlineinfoorder;


//    $text .='<table><tr>';
//echo "while";
		while ($orderrow = $ordersql->db_Fetch()){
		 
		 $orderhide=$orderrow['cache_hide'];
		 $orderclass=$orderrow['cache_userclass'];
/*
     echo "AQUI:";
    echo ($orderrow['cache']." - ");
     echo "ORDEM:";
    echo ($orderrow['type_order']."<br>");
*/

//      $text .='<td>';


//echo "switch";
switch ($orderrow['type_order']) {
    case 1:
        $text .='<div id="box">';
        break;
    case 7:
//        $text .='<table><tr><td>';
        $text .='</div><div id="avatar">';
        break;
//    case 3:
//        $text .='</div><div class="forumheader3" style="text-align:left; height: 200px; font-size: 10px; font-family: Arial; overflow: -moz-scrollbars-vertical; overflow-y: scroll; overflow-x: hide;">';
//        $text .='</CENTER>';
//        break;

}
//        $text .='</CENTER>';


//      if ($orderrow['type_order']==3){
//$text .='<div class="forumheader3" style="text-align:left; padding:5px 15px 5px 5px; height: 200px; font-size: 10px; font-family: Arial; overflow: -moz-scrollbars-vertical; overflow-y: scroll; overflow-x: hide;">';
//      }

//if ((isset($euser_pref['plug_installed']['euser']))&&($orderrow['cache']=='euser_friend.php')) {
//echo "ini";
//if ($orderrow['cache']=='euser_friend.php') {
//$orderrow['cache'] = "euser_euser_friend.php";
//}
//if (ADMIN) {
//echo "<br>->CACHE: ".$orderrow['cache'];
//var_dump ($euser_pref);
//}

//
//exit;
//echo "load";
//var_dump ($orderrow['cache']);
		 require_once(e_PLUGIN."euser/".$orderrow['cache']);
//echo "feito";
//      $text .='</td>';

		}

//$text .='</tr></table>';
//$text .='</div>';

//echo $text;
		$text .= '<span><a href="'.e_BASE.'index.php?logout" title="'.LAN_EUSER_008.'"><img src="'.e_PLUGIN.'euser/images/cancel.png" alt="" /></a></span>';

$text .='</div>';

}
// START NOT LOGGED CODE	
// A PARTE DO NOT LOGGED É TODA GERIDA PELO LOGIN_MENU DO CORE.....
//___>else
//___>{

//var_dump ($euser_pref['logindiag']);
//___>if ($euser_pref['logindiag']==0){

//___>if (!$EUSER_ALL_MENU_FORM) {
//___>		if (file_exists(THEME."login_mini_menu_template.php")){
//___>	   		require_once(THEME."login_mini_menu_template.php");
//___>		}else{
//___>			require_once(e_PLUGIN."euser/templates/login_mini_menu_template.php");
//___>		}
//___>	}

/*
	if (LOGINMESSAGE != '') {
//		$text = '<div style="text-align: center;">'.LOGINMESSAGE.'</div>';
	$text = $tp->parseTemplate($EUSER_ALL_MENU_MESSAGE , true, $sc);
	}
*/
//___>	$text .= '<form method="post" id="login_form" action="'.e_SELF.(e_QUERY ? '?'.e_QUERY : '').'">';

//  var_dump (LOGINMESSAGE);
//  var_dump (LOGINMESSAGE != 'LOGINMESSAGE');

//___>	$text .= $tp->parseTemplate($EUSER_ALL_MENU_FORM.((LOGINMESSAGE != 'LOGINMESSAGE')?$EUSER_ALL_MENU_MESSAGE:""), true, $sc);
/*
	if (LOGINMESSAGE != '') {
//		$text = '<div style="text-align: center;">'.LOGINMESSAGE.'</div>';
	$text .= $tp->parseTemplate($EUSER_ALL_MENU_MESSAGE , true, $sc);
	}
*/
//___>	$text .= '</form>';

////	if (file_exists(THEME_ABS.'images/icon_login.gif')) {
//	if (file_exists(THEME.'images/login_menu.png')) {
//		$caption = '<img src="'.THEME_ABS.'images/login_menu.png" alt="" />'.LOGIN_MENU_L5;
////		$caption = '<img src="'.THEME_ABS.'images/icon_login.gif" alt="" />';
//	} else {
//		$caption = LOGIN_MENU_L5;
////	}
// UTILIZADOR
//---		$caption = '<img src="'.e_PLUGIN.'"euser/images/user_edit.png" alt="" />'.LOGIN_MENU_L5;
  
//___>        }

// VISITANTE
//        $caption = LAN_EUSER_0046;
//        $caption = '';

//// ###### NÃO PERCEBO PORQUE É QUE ISTO ESTÁ AQUI NO LOGIN FORM......
/*
        if ((MEMBERS_ONLINE + GUESTS_ONLINE) > ($euser_pref['most_members_online'] + $euser_pref['most_guests_online']))
        {
            $euser_pref['most_members_online'] = MEMBERS_ONLINE;
            $euser_pref['most_guests_online'] = GUESTS_ONLINE;
            $euser_pref['most_online_datestamp'] = time();
			
			save_prefs();

        }


		$ordersql=new db;
		$script="SELECT * FROM ".MPREFIX."euser_cache Where type='order' ORDER BY type_order";		

//    echo "--SCRIPT 2:".$script;

		$onlineinfoorder = $ordersql->db_Select_gen($script);
		
		
		while ($orderrow = $ordersql->db_Fetch()){
		 
		 $orderhide=$orderrow['cache_hide'];
		 $orderclass=$orderrow['cache_userclass'];

//     echo "AQUI:";
//    echo ($orderrow['cache']."<hr>");
//if (e107::isInstalled('euser')&&$orderrow['cache']=='euser_friend.php') {
//$orderrow['cache'] = "euser_friend.php";
//}
//if (ADMIN) {
//echo " ->CACHE 2: ".$orderrow['cache'];
//}

		 		 
		 require_once(e_PLUGIN."euser/".$orderrow['cache']);	

		 	 
		}
*/

//___>    }

/*
if (USER == true){
//  $text.="</div>";
 $text.=colourkey(1);   
}
*/
 
$text.="
        <script type='text/javascript'>
		var showhide=new switchcontent('switchgroup1', 'div') //Limit scanning of switch contents to just div elements
		showhide.setStatus('<img src=\"".e_PLUGIN."euser/images/minus.gif\" width=\"11px\" alt=\"\" /> ', '<img src=\"".e_PLUGIN."euser/images/plus.gif\" width=\"11px\" alt=\"\" /> ')
		// showhide.setColor('#FFFFFF','#EAAE10')
		showhide.collapsePrevious(false) //Allow more than 1 content to be open simultanously
		showhide.setPersist(".$euser_pref['rememberbuttons'].")
		showhide.init()
</script></div>";

//___>}

///$text .="<hr><hr>PARM: ".$parm."LOOP_UID: ".$loop_uid."<hr>";

//$caption = "";
//$ns->tablerender($caption, $text);
//echo $text;
//$ns->tablerender(null, $text);
}
// ##################################  END OF NON BOOTSTRAP EUSER LOGIN MENU - PARA SER REFEITO!!!!!
 else {
//var_dump ($euser_pref['loginmenutype']);
/*
##########################################################################################
PARA VERIFICAR, HÁ AQUI COISAS REPETIDAS ENTRE AMBOS OS MENUS
##########################################################################################
*/
/*
+---------------------------------------------------------------+
|        e107 website system
|        Online Info Menu v3.0 for e107 v0.616 by TheMadMonk
|              TheMadMonk@GamingMad.com
|
|      Released under the terms and conditions of the
|      GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

//define(OIM_TYPE, "standard");

/*
$text = '';

$text.="<script type='text/javascript' src='".e_PLUGIN."euser/switchcontent.js'></script>";

$lan_file = e_PLUGIN."euser/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."euser/languages/English.php");

include_once(e_PLUGIN."euser/includes/euser_functions.php");


$text.= '<style rel="stylesheet" type="text/css">

#onlineinfodhtmltooltip{
position: absolute;
width: 100px;
border: 1px solid '.$euser_pref['border'].'; -moz-border-radius: .8em; -webkit-border-radius: .8em; border-radius: .8em;
padding: 2px;
background-color: '.$euser_pref['color'].';
visibility: hidden;
z-index: 100;
}

</style>
<div id="onlineinfodhtmltooltip"></div>
<script type="text/javascript" src="'.e_PLUGIN.'euser/online.js"></script>';


$onlineinfomenuwidth=$euser_pref['width'];
$onlineinfomenucolour=$euser_pref['flashtext_colour'];
$onlineinfomenufsize=$euser_pref['fontsize'];

$text.='
<script type="text/javascript">
var flashlinks=new Array()
function changelinkcolor(){
for (i=0; i< flashlinks.length; i++){
var flashtype=document.getElementById? flashlinks[i].getAttribute("flashtype")*1 : flashlinks[i].flashtype*1
var flashcolor=document.getElementById? flashlinks[i].getAttribute("flashcolor") : flashlinks[i].flashcolor
if (flashtype==0){
if (flashlinks[i].style.color!=flashcolor)
flashlinks[i].style.color=flashcolor
else
flashlinks[i].style.color=""
}
else if (flashtype==1){
if (flashlinks[i].style.backgroundColor!=flashcolor)
flashlinks[i].style.backgroundColor=flashcolor
else
flashlinks[i].style.backgroundColor=""
}
}
}

function init(){
var i=0
if (document.all){
while (eval("document.all.flashlink"+i)!=null){
flashlinks[i]= eval("document.all.flashlink"+i)
i++
}
}
else if (document.getElementById){
while (document.getElementById("flashlink"+i)!=null){
flashlinks[i]= document.getElementById("flashlink"+i)
i++
}
}
setInterval("changelinkcolor()", 500)
}

if (window.addEventListener)
window.addEventListener("load", init, false)
else if (window.attachEvent)
window.attachEvent("onload", init)
else if (document.all)
window.onload=init

</script>
';
*/
/*§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§
// A gestão de contas suspensas é feita pelo próprio login_menu do core, que é incluido aqui no caso de o utilizador não estar logado. Não vale a pena estar a duplicar templates e código....
$n=0;
$suspended=0;



$script="SELECT * from ".MPREFIX."euser_suspend WHERE user_id=".USERID." ORDER BY user_name";

//echo $script;

$data = $sql->db_Select_gen($script);
if ($data)
    {
	$text.='<script language="javascript" type="text/javascript"> window.location="'.e_BASE.'index.php?logout"; </script>';
	}


 $script="SELECT * from ".MPREFIX."euser_suspend WHERE ip='".$_SERVER['REMOTE_ADDR']."' ORDER BY user_name";

//echo $script;

 $data = $sql->db_Select_gen($script);
 if ($data)
     {
// CONTA SUSPENSA
    $caption = "<img src='".e_PLUGIN."'euser/images/delete.png' alt='' />".LAN_EUSER_0083;
	$text.="<div id='flashlink".$n."' flashtype=0 flashcolor='".$onlineinfomenucolour."' style='font-size: 14px; text-align:center; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;'><br />".LAN_EUSER_0083."<br /><br /></div>";
	$text.="<div style='font-size: 12px; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;'>".LAN_EUSER_0084."<br /><br /></div>";
	$suspended=1;
$n++;

 	}
§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§*/


//___>if ($suspended==0){

//global $eMenuActive, $e107, $tp, $use_imagecode;
//-antigo-require_once(e_PLUGIN."euser/login_menu_shortcodes.php");
// TODA A GESTÃO DO LOGIN INICIAL E COMPANHIA É FEITO PELO MENU LOGIN DO CORE.....
//$ip = $e107->getip();

//$bullet = (defined("BULLET") ? "<img src='".THEME_ABS."images/".BULLET."' alt='' style='vertical-align: middle;' />" : "<img src='".THEME_ABS."images/bullet2.gif' alt='bullet' style='vertical-align: middle;' />");

//if (defined('CORRUPT_COOKIE') && CORRUPT_COOKIE == TRUE) {	$text = "<div style='text-align:center'>".LOGIN_MENU_L7."<br /><br /> 	".$bullet." <a href='".e_BASE."index.php?logout'>".LOGIN_MENU_L8."</a></div>";	$ns->tablerender(LOGIN_MENU_L9, $text, 'login');}
//$use_imagecode = ($euser_pref['logcode'] && extension_loaded('gd'));

//if ($use_imagecode) {
//	global $sec_img;
//	include_once(e_HANDLER.'secure_img_handler.php');
//	$sec_img = new secure_image;
//}
//$text .= "";

//		$caption = '<a href="'.e_BASE.'usersettings.php" title="'.LAN_EUSER_0012.'" ><img src="'.e_PLUGIN.'euser/images/user_edit.png" alt="" />&nbsp;';
//if ($euser_pref['caption'] == "[Welcome User]")
//{
// LOGIN FEITO
//    $caption .= LAN_EUSER_005 . "&nbsp;".USERNAME;
//}
//else
//{
//    $caption .= $euser_pref['caption'];
//}

//		$caption .= '</a><span style="float: right;"><a href="'.e_BASE.'index.php?logout" title="'.LAN_EUSER_008.'"><img src="'.e_PLUGIN.'euser/images/cancel.png" alt="" /></a></span>';
//    $caption .= "</a>";


		$euserlmsql=new db;
    $script="SELECT * FROM ".MPREFIX."euser_cache Where type='order' ORDER BY type_order";
		$onlineinfoorder = $euserlmsql->db_Select_gen($script);
		while ($orderrow = $euserlmsql->db_Fetch()){
      $orderList[$orderrow['cache']] = array('hide' => $orderrow['cache_hide'], 'class' => $orderrow['cache_userclass']);
    }

// TODO: Depois tenho de usar o gettemplate, novo na v2
//var_dump (IMAGE_logout);
if(!defined('IMAGE_logout'))
{
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
}


		// ------------ Pass the data & parse ------------
//-------------		cachevars('orderList', $orderList);
    $template = e107::getTemplate('euser', 'dashboard_menu');
//var_dump ($template);
/*
if (!$EUSER_ALL_MENU_LOGGED) {
		if (file_exists(THEME."all_menu_template.php")){
	   		require(THEME."all_menu_template.php");
		}else{
			require(e_PLUGIN."euser/templates/all_menu_template.php");
		}
	}
*/

//var_dump ($EUSER_ALL_MENU_STATS);
//	$sc = e107::getScBatch('euser', null, 'euser_login_menu');
//var_dump ($orderList);
//
//				global $EUSER_ALL_MENU_STATS;
//  global $EUSER_ALL_MENU_STATS;
	$sc = e107::getScBatch('dashboard_menu', 'euser');
//var_dump ($sc);
//var_dump (!$parm);


//&&&&&&&&& CÓDIGO "TEMPORÁRIO" PARA SACAR OS PARMS....
/*
if (!$parm)
{
$eMenuArea = $this->getDataLegacy();
foreach($eMenuArea as $area => $val)
		{
			foreach($val as $row)
			{
//        var_dump ($row['menu_name']=='euser_all_menu');
        if ($row['menu_name']=='euser_all_menu')
//				if($this->isVisible($row))
				{
//          var_dump (e107::unserialize($row['menu_parms']));
          $parm = (e107::unserialize($row['menu_parms']));
//					$path = str_replace("/", "", $row['menu_path']);
//					if(!isset($total[$area]))
//					{
//						$total[$area] = 0;
//					}
//					$this->eMenuActive[$area][] = $row;
//					$total[$area]++;
				}
			}
		}
}
*/
//&&&&&&&&& FIM DO CÓDIGO "TEMPORÁRIO" PARA SACAR OS PARMS....
//-------------------$parm = ($parm?:euser::getmenuparm($this->getDataLegacy(), 'euser_all_menu'));
//        var_dump ($parm);
//$parm = ($parm?:euser::getmenuparm($this, 'euser_all_menu'));
//var_dump ($this->_current_parms);    
  $sc->setVars($parm);
//  $sc->wrapper('all_menu/logged_head');
//  $sc->wrapper('all_menu/form');
  $sc->wrapper('dashboard_menu/logged');

if (USER == true || ADMIN == true)
{

// Há igual em baixo......
/*
		$euserlmsql=new db;
    $script="SELECT * FROM ".MPREFIX."euser_cache Where type='order' ORDER BY type_order";
		$onlineinfoorder = $euserlmsql->db_Select_gen($script);
		while ($orderrow = $euserlmsql->db_Fetch()){
      $orderList[$orderrow['cache']] = array('hide' => $orderrow['cache_hide'], 'class' => $orderrow['cache_userclass']);
    }

		// ------------ Pass the data & parse ------------
		cachevars('orderList', $orderList);
*/
/*
var_dump ($orderList);

if (!$EUSER_ALL_MENU_LOGGED) {
		if (file_exists(THEME."all_menu_template.php")){
	   		require(THEME."all_menu_template.php");
		}else{
			require(e_PLUGIN."euser/templates/all_menu_template.php");
		}
	}

//var_dump ($EUSER_ALL_MENU_STATS);
//	$sc = e107::getScBatch('euser', null, 'euser_login_menu');
//var_dump ($orderList);
//
//				global $EUSER_ALL_MENU_STATS;
//  global $EUSER_ALL_MENU_STATS;
	$sc = e107::getScBatch('login_menu', 'euser');
//var_dump ($sc);
*/
/*
if (!empty($EUSER_ALL_MENU_LOGGED)) {
	$text = $tp->parseTemplate($EUSER_ALL_MENU_LOGGED, true, $sc);
  $EUSER_ALL_MENU_HEAD=$EUSER_ALL_MENU_LOGGED_HEAD;
}
*/
//if (!empty($EUSER_ALL_MENU_LOGGED)) {
	$caption = $tp->parseTemplate($template['logged']['head'], true, $sc);
	$text = $tp->parseTemplate($template['logged']['body'], true, $sc);
//  $EUSER_ALL_MENU_HEAD=$template['logged']['head'];
//}




// UTILIZAÇÃO DE OUTRO SISTEMA DE PM'S, TEM DE SAIR DAQUI, TIPO PARA UM SHORTCODE...
	if($euser_pref['ibfpm']==0){

// AS PM'S NORMAIS SÃO GERIDAS PELO PRÓPRIO LOGIN MENU DO CORE....
/*
		$sql=new db;
		$script="SELECT cache_userclass FROM ".MPREFIX."euser_cache Where type='order' and cache_name='ONLINEINFO_CACHEINFO_12'";		
		$onlineinfoorder = $sql->db_Select_gen($script);		
		while ($row = $sql->db_Fetch()){
		 $cacheuserclass=$row['cache_userclass'];
		 }

	if(check_class($cacheuserclass)){


	$pm_user = USERID;
	$unreadpms = $sql -> db_Count("private_msg", "(*)", "WHERE pm_to=$pm_user AND pm_read_del=0 and pm_read=0");

	$pmpath=e_PLUGIN."pm/pm.php?inbox";

	}
*/
	}else{
// UTILIZAÇÃO DE OUTRO SISTEMA DE PM'S, TEM DE SAIR DAQUI, TIPO PARA UM SHORTCODE...

	$onlineinfo_ipb_sql = new db;

	$script="SELECT * FROM ".$euser_pref['ibfprefix']."message_topics WHERE mt_read=0 AND mt_to_id = ".USERID;
	$onlineinfo_getipbinboxunread = $onlineinfo_ipb_sql->db_Select_gen($script);

	$unreadpms=$onlineinfo_getipbinboxunread;

	$pmpath=SITEURL.$euser_pref['ibflocation']."/index.php?act=Msg&CODE=01&VID=in";

	}


// AS PM'S NORMAIS SÃO GERIDAS PELO PRÓPRIO LOGIN MENU DO CORE....
/*
if($euser_pref['showpmmsg']==1){

	if($unreadpms<>0)
	{

if ($euser_pref['sound']=="none" || $euser_pref['sound']==""){
  unset ($euser_pref['sound']);
}
if ($euser_pref['sound']){

////$text .= "SOM:".$euser_pref['sound']."---FIM SOM".!($euser_pref['sound']!="none" || $euser_pref['sound']!="");
	
	$checkpath = explode("/pm/",e_SELF);
	
	if($checkpath[1] != "pm.php"){
	
	$text.="<embed src=\"".e_PLUGIN."euser/sounds/".$euser_pref['sound']."\" autostart=\"true\" loop=\"0\" hidden=\"true\"></embed>";
	
		}
}
	$text.="<div style='background-color: yellow; font-size: 14px; text-align:center; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;'><a id='flashlink".$n."' flashtype=0 flashcolor='".$onlineinfomenucolour."' href='".$pmpath."' title='".LAN_EUSER_0082."' style='text-decoration: none;'>".LAN_EUSER_0081."</a></div>";

	$n++;
	}

}
*/

//PARA QUE É ISTO????//        list($uid, $upw) = ($_COOKIE[$euser_pref['cookie_name']] ? explode(".", $_COOKIE[$euser_pref['cookie_name']]) : explode(".", $_SESSION[$euser_pref['cookie_name']]));



/*
		$ordersql=new db;
		$script="SELECT * FROM ".MPREFIX."euser_cache Where type='order' ORDER BY type_order";		

//    echo "--SCRIPT 1:".$script;
    
		$onlineinfoorder = $ordersql->db_Select_gen($script);
		
//    echo "--ONLINE INFO ORDER:".$onlineinfoorder;

//$orderList = array();
///////////////////////////// Isto depois é para aqui, para o caso de não existir template, faz pela order row.....
/////////////////////////////if (!empty($EUSER_ALL_MENU_LOGGED)) {

		while ($orderrow = $ordersql->db_Fetch()){
		 
//      $orderList[] = array('name' => $orderrow['cache'], 'hide' => $orderrow['cache_hide'], 'class' => $orderrow['cache_userclass']);
		 		 
//     echo "AQUI:";
//    echo ($orderrow['cache']."<br>");
//     echo "ORDEM:";
//    echo ($orderrow['type_order']."   -   ");

//var_dump(":::::::".$orderrow['type_order']);
*/
/*
switch ($orderrow['type_order']) {
    case 1:
        $text .='<table><tr><td>';
        break;
    case 2:
        $text .='</td><td>';
        break;
    case 3:
        $text .='</td></tr></table><div class="forumheader3" style="text-align:left; height: 200px; font-size: 10px; font-family: Arial; overflow: -moz-scrollbars-vertical; overflow-y: scroll; overflow-x: hide;">';
        break;
}
*/
//      if ($orderrow['type_order']==3){
//$text .='<div class="forumheader3" style="text-align:left; padding:5px 15px 5px 5px; height: 200px; font-size: 10px; font-family: Arial; overflow: -moz-scrollbars-vertical; overflow-y: scroll; overflow-x: hide;">';
//      }
/*
if ((isset($euser_pref['plug_installed']['euser']))&&($orderrow['cache']=='euser_friend.php')) {
$orderrow['cache'] = "euser_euser_friend.php";
}
//if (ADMIN) {
$text .= "<hr>->CACHE: ".$orderrow['type_order']." = ".$orderrow['cache'];
//}
		 $orderhide=$orderrow['cache_hide'];
		 $orderclass=$orderrow['cache_userclass'];

		 require(e_PLUGIN."euser/includes/euser_".$orderrow['cache']);

		}
$text .='</div>';
*/

//var_dump(">>>>>".$text);
}
else
{
// No caso de não estar logado, vai usar o sistema do login_menu do core... Todo este código é para alterar....
/////$text = $text;

/* CÓDIGO ANTIGO.....
if ($euser_pref['logindiag']==0){

if (!$EUSER_ALL_MENU_FORM) {
		if (file_exists(THEME."all_menu_template.php")){
	   		require_once(THEME."all_menu_template.php");
		}else{
			require_once(e_PLUGIN."euser/templates/all_menu_template.php");
		}
	}

/////	$sc = e107::getScBatch('euser', null, 'euser_login_menu');
	$sc = e107::getScBatch('all_menu', 'euser');
//var_dump ($sc);
	if (LOGINMESSAGE != '') {
//		$text = '<div style="text-align: center;">'.LOGINMESSAGE.'</div>';
	$text .= $tp->parseTemplate($EUSER_ALL_MENU_MESSAGE , true, $sc);
	}
//var_dump ($EUSER_ALL_MENU_FORM);

	$text .= '<form method="post" action="'.e_SELF.(e_QUERY ? '?'.e_QUERY : '').'">';
	$text .= $tp->parseTemplate($EUSER_ALL_MENU_FORM, true, $sc);
	$text .= '</form>';

////	if (file_exists(THEME_ABS.'images/icon_login.gif')) {
//	if (file_exists(THEME.'images/login_menu.png')) {
//		$caption = '<img src="'.THEME_ABS.'images/login_menu.png" alt="" />'.LOGIN_MENU_L5;
////		$caption = '<img src="'.THEME_ABS.'images/icon_login.gif" alt="" />';
//	} else {
//		$caption = LOGIN_MENU_L5;
////	}
// UTILIZADOR
		$caption = '<img src="'.e_PLUGIN.'"euser/images/user_edit.png" alt="" />'.LOGIN_MENU_L5;
  
        }
*/        
// VISITANTE
//        $caption = LAN_EUSER_0046;
        if ((MEMBERS_ONLINE + GUESTS_ONLINE) > ($euser_pref['most_members_online'] + $euser_pref['most_guests_online']))
        {
            $euser_pref['most_members_online'] = MEMBERS_ONLINE;
            $euser_pref['most_guests_online'] = GUESTS_ONLINE;
            $euser_pref['most_online_datestamp'] = time();
			
//			save_prefs();
  		e107::getPlugConfig('euser')->setPref($euser_pref)->save(true, false, false);

        }


// ########### NA ALTURA DO LOGIN NÃO É PRECISO CORRER A CACHE........ OU É?????
/*
		$ordersql=new db;
		$script="SELECT * FROM ".MPREFIX."euser_cache Where type='order' ORDER BY type_order";		

//    echo "--SCRIPT 2:".$script;

		$onlineinfoorder = $ordersql->db_Select_gen($script);
		
		
		while ($orderrow = $ordersql->db_Fetch()){
		 
		 $orderhide=$orderrow['cache_hide'];
		 $orderclass=$orderrow['cache_userclass'];

//     echo "AQUI:";
//    echo ($orderrow['cache']."<hr>");
if ((isset($euser_pref['plug_installed']['euser']))&&($orderrow['cache']=='euser_friend.php')) {
$orderrow['cache'] = "euser_euser_friend.php";
}
//if (ADMIN) {
//echo " ->CACHE 2: ".$orderrow['cache'];
//}

		 		 
		 require_once(e_PLUGIN."euser/euser_".$orderrow['cache']);	

		 	 
		}
*/
//var_dump ("------->".$text);
//$sc->originalmenutext = $text;
/*
if (!empty($EUSER_ALL_MENU_FORM)) {
	$text = $tp->parseTemplate($EUSER_ALL_MENU_FORM, true, $sc);
  $EUSER_ALL_MENU_HEAD=$EUSER_ALL_MENU_FORM_HEAD;
}
*/
//var_dump ($template['form']);
	$caption = $tp->parseTemplate($template['form_head']);
	$text = $tp->parseTemplate($template['form'], true, $sc);
//  $EUSER_ALL_MENU_HEAD=$template['form']['head'];

    }


 
/*   CÓDIGO ANTIGO.....
$text.="
        <script type='text/javascript'>
		var showhide=new switchcontent('switchgroup1', 'div') //Limit scanning of switch contents to just div elements
		showhide.setStatus('<img src=\"".e_PLUGIN."euser/images/minus.gif\" width=\"11px\" alt=\"\" /> ', '<img src=\"".e_PLUGIN."euser/images/plus.gif\" width=\"11px\" alt=\"\" /> ')
		// showhide.setColor('#FFFFFF','#EAAE10')
		showhide.collapsePrevious(false) //Allow more than 1 content to be open simultanously
		showhide.setPersist(".$euser_pref['rememberbuttons'].")
		showhide.init()
</script>";
*/
//___>}

///$text .="<hr><hr>PARM: ".$parm."LOOP_UID: ".$loop_uid."<hr>";


//$ns->tablerender($caption, $text);


}
// PONHO A COLOUR KEY A APARECER TAMBÉM QUANDO NÃO SE ESTÁ LOGADO?????
// OU TALVEZ APARECER APENAS NAS PÁGINAS ONDE APARECE O NOME DOS USERS??????
//----if (USER == true){
////// include_once(e_PLUGIN.'euser/euser_class.php');
//  $text.="</div>";
// $text.=colourkey(1);   
////// $text.=euser::colourkey(1);
//----}
//$ns->tablerender($caption, $text);
//var_dump (htmlspecialchars($text));
//Existe algures um div sem fecho, daí meter aqui este div
//var_dump ("CAPTION:".$caption);
//	$caption = $tp->parseTemplate($EUSER_ALL_MENU_HEAD, true, $sc);
//var_dump ($caption);
//	$ns->tablerender($tp->parseTemplate($EUSER_ALL_MENU_HEAD, true, $sc), $text, 'euser_login_menu');
//$text .= print_r(USER_AREA);
//$text .= print_r(USER_AREA);

	$ns->tablerender($caption, $text, 'euser_dashboard_menu');
?>