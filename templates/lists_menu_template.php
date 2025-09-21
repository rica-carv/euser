<?php

//echo "fui carregado";

if (!defined('e107_INIT')) { exit; }
//if(!defined("USER_WIDTH")){ define("USER_WIDTH","width:95%"); }
//echo "fui carregado";
/* PASSOU PARA O PHILLIS_MENU.PHP, NÃO FAZ SENTIDO AQUI
e107::css('phillis', 'phillis.css');
// Vou usar o bootstrap normal.... N�o h�, n�o h�...
//e107::css('url', '../phil/phil.css'); // ?
//e107::css('url', '../phil/dialog/dialog_box.css'); //?
e107::js("footer", "phillis_menu.js", "jquery");
*/
$LISTS_MENU_TEMPLATE['caption'] = "{LAN=LAN_PLUGIN_PHILLIS_1} - {LAN=LAN_PLUGIN_PHILCAT_01}"; //Ex - $LISTS_MENU_TITLE
//$sc_style['MENUCSS']['pre'] = "<link rel='stylesheet' href='";
//$sc_style['MENUCSS']['post'] = "phil.css' type='text/css' /><link rel='stylesheet' href='../phil/dialog/dialog_box.css' type='text/css'>";
/////$sc_style['MENUCONTENT']['pre'] = "<input type='hidden' name='phillis_vtype'/>".LAN_PLUGIN_PHILLIS_11.": ";
//Tenho de mudar estes ID do form e div no menu, eventualmente.....
//$LISTS_MENU = "{MENUCSS}<form action='" .e_SELF.(e_QUERY?"?".e_QUERY:"")."' method='post' id='phfltform' style='position:relative'><div id='catflt'>{MENUCONTENT}</div></form>{MENUEND}";
//////// Retirei porque por agora n�o uso...$LISTS_MENU_TEMPLATE['body'] = "<form action='" .e_SELF.(e_QUERY?"?".e_QUERY:"")."' method='post' id='phfltform' style='position:relative'>Ver lista novos<br>Ver lista usados<hr>Ver lista faltas<br>Ver lista trocas</form>";
//Passar isto para uma mess, antes da lista....$LISTS_MENU_TEMPLATE['body'] = "<div class='panel panel-info alert-info'><div class='panel-body'>Agora j� pode comparar listas, bastando para isso clicar nos �cones respectivos...</div></div>";
$LISTS_MENU_WRAPPER['home']['PHLIS_USERNAME'] = '&nbsp;<small class="news-info mt-1 text-muted muted">{LAN=LAN_PLUGIN_PHILLIS_27}{---}</small>';
$LISTS_MENU_WRAPPER['home']['PHLIS_LISTTOTAL'] = '<span class="badge">{---} {LAN=LAN_PLUGIN_PHILLIS_90}</span>';
$LISTS_MENU_WRAPPER['home']['PHLIS_LISTDATA:layout=home&output=data'] = '&nbsp;<small class="news-info mt-1 text-muted muted">{LAN=LAN_PLUGIN_PHILLIS_28}{---}</small>';

//$LISTS_MENU_WRAPPER['PHLIS_USERNAME'] = "{LAN=LAN_PLUGIN_PHILLIS_27}{---}";
//$LISTS_MENU_WRAPPER['PHLIS_LISTDATA:layout=home&output=data'] = "{LAN=LAN_PLUGIN_PHILLIS_28}{---}";
//$LISTS_MENU_WRAPPER['home']['PHIL_SAVEEDIT:msg'] = "<p><center>{---}</center>";
//$LISTS_MENU_WRAPPER['home']['PHLIS_LEG'] = "<p><br>{---}";
$LISTS_MENU_TEMPLATE['home']['start'] = '
<div class="media-list phillis-menu-latest">    <div class="ps-0 col">
	    <ul>
    ';

$LISTS_MENU_TEMPLATE['home']['item'] = '
<li class="media-heading m-0 d-flex align-items-center">
    {PHLIS_LISTDATA:layout=home}
    {PHLIS_LISTTOTAL}
    {PHLIS_USERNAME}
    {PHLIS_LISTDATA:layout=home&output=data}
</li>
    ';

$LISTS_MENU_TEMPLATE['home']['end'] = '
</ul>
    </div>
</div>
    ';

        /*
    $LISTS_MENU_TEMPLATE['menu'] = "
    {PHLIS_LTYPE:onstyle=primary&offstyle=secondary}

    &nbsp;&nbsp;&nbsp;
    {PHLIS_SAVEEDIT:}
    {PHIL_SAVEEDIT:msg}
    &nbsp;&nbsp;&nbsp;
    <form method='get' class='btn-group hidden-print'>
    </form>
    <form action='" .e_SELF.(e_QUERY?"?".e_QUERY:"")."' method='post' id='phfltform' style='position:relative'>
        &nbsp;
        <div id='catflt'>
        </div>
        {PHIL_SUBMIT}
    </form>
    ";
*/
/*
$LISTS_MENU_TEMPLATE['leg']['start'] = "
    <p>
        <div class='card'>
            <div class='card-header bg-info bg-gradient'>
                <b>{LAN=LAN_PLUGIN_PHILLIS_94}</b>
            </div>
            <div class='card-body alert alert-info mb-0'>";  //$phillis_INILEG
////$phillis_MENU_TEMPLATE['leg']['body'] = "<mark>".LAN_PLUGIN_PHILLIS_90." ".LAN_PLUGIN_PHILLIS_76."</mark>".LEGPARA;

////$phillis_MENU_TEMPLATE['leg']['d'] = "<a class='col'>".LAN_PLUGIN_PHILLIS_46."</a> : ".LAN_PLUGIN_PHILLIS_90." ".LAN_PLUGIN_PHILLIS_92.LEGPARA."<a>".LAN_PLUGIN_PHILLIS_46."</a> : ".LAN_PLUGIN_PHILLIS_90." ".LAN_PLUGIN_PHILLIS_91.LEGPARA."<a class='wait col'>".LAN_PLUGIN_PHILLIS_46."</a> : ".LAN_PLUGIN_PHILLIS_90." ".LAN_PLUGIN_PHILLIS_92." ".LAN_PLUGIN_PHILLIS_93."</a>";
$LISTS_MENU_TEMPLATE['leg']['body'] = $phillis_MENU_TEMPLATE['leg']['edit'] = "
    <a class='list imagepop have'>
        <b>{LAN=LAN_PLUGIN_PHILLIS_46}</b>
    </a>
     : 
    {LAN=LAN_PLUGIN_PHILLIS_90} {LAN=LAN_PLUGIN_PHILLIS_92}
    <br>
    <a class='list imagepop'>
        <b>{LAN=LAN_PLUGIN_PHILLIS_46}</b>
    </a>
     : 
    {LAN=LAN_PLUGIN_PHILLIS_90} {LAN=LAN_PLUGIN_PHILLIS_91}
    <br>
    <a class='list wait'>
        <b>{LAN=LAN_PLUGIN_PHILLIS_46}</b>
    </a>
     : 
    {LAN=LAN_PLUGIN_PHILLIS_90} 
    {LAN=LAN_PLUGIN_PHILLIS_92}
    {LAN=LAN_PLUGIN_PHILLIS_93}
    ";
///////$phillis_MENU_TEMPLATE['leg']['x'] = "<a class='colxc'>&nbsp;".PHLIS_REPLXNUM."&nbsp;</a>: ".LAN_PLUGIN_PHILLIS_90." ".LAN_PLUGIN_PHILLIS_92.LEGPARA."<a>".LAN_PLUGIN_PHILLIS_46."</a> : ".LAN_PLUGIN_PHILLIS_90." ".LAN_PLUGIN_PHILLIS_91;
//////$phillis_MENU_TEMPLATE['leg']['edit'] = "<span id='listingu' style='position: inherit;'><a class='col' href=''>".LAN_PLUGIN_PHILLIS_90." ".LAN_PLUGIN_PHILLIS_92."</a><br><a>".LAN_PLUGIN_PHILLIS_90." ".LAN_PLUGIN_PHILLIS_91."</a><br><a class='wait col' href=''>".LAN_PLUGIN_PHILLIS_90." ".LAN_PLUGIN_PHILLIS_92." ".LAN_PLUGIN_PHILLIS_93."</a></span>";
//$phillis_PRINTLEGFALTAS = "<span class='col'>".LAN_PLUGIN_PHILLIS_90." ".LAN_PLUGIN_PHILLIS_92."</span>&nbsp;&nbsp;&nbsp;".LAN_PLUGIN_PHILLIS_90." ".LAN_PLUGIN_PHILLIS_91."&nbsp;&nbsp;&nbsp;<span class='wait col'>".LAN_PLUGIN_PHILLIS_90." ".LAN_PLUGIN_PHILLIS_92." ".LAN_PLUGIN_PHILLIS_93;

$LISTS_MENU_TEMPLATE['leg']['end'] = "</div></div>"; //$phillis_ENDLEG
*/

