<?php
//var_dump ("PHILLIS_TEMPLATE");
if (!defined('e107_INIT')) { exit; }

/* PASSOU PARA O PHILLIS_VIEW.PHP, NÃO FAZ SENTIOD ESTAR AQUI
e107::css('phil_lis', 'phillis.css');
// Vou usar o bootstrap normal.... N�o h�, n�o h�...
//e107::css('phil', 'phil.css'); //?
//e107::css('url', '../phil/dialog/dialog_box.css'); //?

/////e107::css("footer", "PHILLIS_class.js");
//e107::js("footer", "PHILLIS_class.js");
e107::css('phil', 'includes/dhtmltooltip.css');
e107::js("footer", phdhtmlpop, "jquery"); 
e107::js("footer", "phillis.js", "jquery"); 
*/
//e107::js("footer", "https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.4/jquery.lazy.min.js", 'jquery');
//e107::js("footer-inline", "$('.lazy').Lazy();"); 
///echo "FUI CARREGADO------------------------";
//$PHILLIS_VIEW_TEMPLATE['edit']['start'] = "{LISTCSS=phillis} {LISTCSS=phil}<div id='listingu'{LISTCLASS}>"; // Ex- $PHILLIS_EDSTART

$PHILLIS_VIEW_WRAPPER['PHLIS_EDITVIEW_BUTTON'] = "
  <div class='col-auto text-end'>
                {---}
  </div>
";

$PHILLIS_VIEW_TEMPLATE['caption'] = "
<div class='row'>
  <div class='col'>
    {PHLIS_CAPTION}
  </div>
    {PHLIS_EDITVIEW_BUTTON}
</div>
";

$PHILLIS_VIEW_WRAPPER['PHLIS_SECTION:title'] = "
<h2 class='accordion-header bg-light d-flex position-relative'>
    <button class='accordion-button p-2 w-auto' type='button' data-bs-toggle='collapse' data-bs-target='#collapse_{PHLIS_SECTION:code}' aria-expanded='true' aria-controls='collapse_{PHLIS_SECTION:code}'>
        <strong class='lead fw-bold'>
            <div>
                {---}
            </div>
        </strong>
    </button>
</h2>
";

$PHILLIS_VIEW = "
<div class='item_{PHLIS_SECTION:code} accordion-item mb-3'>
    {PHLIS_SECTION:title}
    <div class='accordion-collapse collapse card-body with-nav-tabs show in p-1' id='collapse_{PHLIS_SECTION:code}' {PHLIS_SECTION:data}>
";

$PHILLIS_VIEW_TEMPLATE['edit_start'] = "
<div id='edlis' class='accordion'>
". $PHILLIS_VIEW;
 // Ex- $PHILLIS_EDSTART

//$PHILLIS_VIEW_TEMPLATE['print']['start'] = "{LISTCSS=phillis}<div {LISTCLASS}>";  // Ex- $PHILLIS_START
$PHILLIS_VIEW_TEMPLATE['print_start'] = "<div>{PHLIS_SECTION:title}<div>";  // Ex- $PHILLIS_START

//$PHILLIS_VIEW_WRAPPER['LISTCLASS'] = "<div id='listing' class='panel panel-default {---}'>";

$PHILLIS_VIEW_TEMPLATE['start'] = "
<div id='pclis' class='accordion'>
". $PHILLIS_VIEW;
//{SECTIONTITLE}<div class='panel-body panel-collapse collapse in collapse_{SECTIONCODE}' id='collapse_{SECTIONCODE}' {SECTIONDATA}>";  // Ex- $PHILLIS_START

$PHILLIS_VIEW_WRAPPER['PHLIS_ITEM:class'] = $PHILLIS_VIEW_WRAPPER['PHLIS_ITEM:class=ed'] = $PHILLIS_VIEW_WRAPPER['PHLIS_ITEM:class=pr'] = " class='{---}'";
//$PHILLIS_VIEW_TEMPLATE['item'] = "<span{ITEMCLASS} onmouseover=\"ddrivetip('{TIPHTML}')\" onmouseout='hideddrivetip()'>{ITEM}</span> ";  // Ex- $PHILLIS_ITEM


/*------------------
$PHILLIS_VIEW_TEMPLATE['item'] = "<a{PHLIS_ITEM:class} {PHLIS_ITEM:data} type='button' data-bs-trigger='hover'
					data-bs-placement='bottom' data-bs-toggle='popover' data-bs-html=true data-bs-content='Loading...'>{PHLIS_ITEM}</a> ";  // Ex- $PHILLIS_ITEM
-----------*/
////$PHILLIS_VIEW_WRAPPER['PHLIS_ITEM:href'] = " href='{---}'";
$PHILLIS_VIEW_WRAPPER['PHLIS_ITEM:title'] = " title='{---}'";

$PHILLIS_VIEW_TEMPLATE['edit_item'] = "<a {PHLIS_ITEM:class=ed} type='button' data-bs-trigger='hover focus' data-bs-placement='bottom' data-bs-toggle='popover' data-bs-html=true  {PHLIS_ITEM:data=popover} {PHLIS_ITEM:title}>{PHLIS_ITEM}</a> ";  // Ex- $PHILLIS_EDITITEM

$PHILLIS_VIEW_TEMPLATE['print_item'] = "<span {PHLIS_ITEM:class=pr}>{PHLIS_ITEM}</span> ";  // Ex- $PHILLIS_PRINTITEM

$PHILLIS_VIEW_TEMPLATE['item'] = "<a href={PHLIS_PECA} {PHLIS_ITEM:class} type='button' data-bs-trigger='hover focus' data-bs-placement='bottom' data-bs-toggle='popover' data-bs-html=true {PHLIS_ITEM:data=popover} >{PHLIS_ITEM}</a> ";  // Ex- $PHILLIS_ITEM

/*
$PHILLIS_VIEW_TEMPLATE['popover'] = "
<center>
    <img src='".e_PLUGIN_ABS."philcat/media/{PHLIS_PAIS}/t/{PHLIS_IMG}.jpg'>
</center>
<div class='row m-2'>
    <label class='col-xs-12 col-md-2'>
        {LAN=LAN_PLUGIN_PHILCAT_32} - {LAN=LAN_PLUGIN_PHILCAT_14}: 
    </label>
    <div class='col-xs-12 col-md-10'>
        {PHLIS_ANO} - {PHLIS_SER}
    </div>
</div>
<div class='row m-2'>
    <label class='col-xs-12 col-md-2'>
        {LAN=LAN_PLUGIN_PHILCAT_36}: 
    </label>
    <div class='col-xs-12 col-md-10'>
        {PHLIS_DSC}
    </div>
</div>
<div class='row m-2'>
    <label class='col-xs-12 col-md-2'>
        {LAN=LAN_PLUGIN_PHILCAT_37}: 
    </label>
    <div class='col-xs-12 col-md-10'>
        {PHLIS_VAL}
    </div>
</div>
<div class='row m-2'>
    <label class='col-xs-12 col-md-2'>
        {LAN=LAN_PLUGIN_PHILCAT_32}: 
    </label>
    <div class='col-xs-12 col-md-10'>
        {PHLIS_ANO}
    </div>
</div>
";
*/
/*
$PHILLIS_VIEW_TEMPLATE['popover'] = "
<div class='d-flex'>
  <div class='flex-shrink-0 text-center'>
    <img src='".e_PLUGIN_ABS."philcat/media/{PHLIS_PAIS}/t/{PHLIS_IMG}.jpg'>
    <p>
    {PHLIS_VAL}
  </div>
  <div class='flex-grow-1 ms-3'>
    {PHLIS_ANO} - {PHLIS_SER}
    <p>
    {PHLIS_DSC}
  </div>
</div>
";
*/
$PHILLIS_VIEW_TEMPLATE['popover'] = "
<div class='d-flex'>
  <div class='flex-shrink-0 text-center'>
    {PHLIS_IMAGE}
    <p>
    {PHLIS_VAL}
  </div>
  <div class='flex-grow-1 ms-3'>
    {PHLIS_ANO} - {PHLIS_SER}
    <p>
    {PHLIS_DSC}
  </div>
</div>
";

$PHILLIS_VIEW_TEMPLATE['end'] = '
        </div>
    </div>
</div>
';  // Ex- $PHILLIS_END

$PHILLIS_VIEW_TEMPLATE['end_footer'] = '
<div class="container-fluid about-item d-print-none p-0">
  <div class="row">
    <div class="col text-center">
      <div class="btn-toolbar justify-content-center align-items-center" role="toolbar" aria-label="Toolbar with button groups">
        {PHLIS_NAVLINK}
      </div>
    </div>
  </div>
</div>
';  // Ex- $PHILLIS_END

// Antigo $PHILLIS_VIEW_WRAPPER['SECTIONTITLE'] = "<h4 class='sectiontitle'>{---}</h4>'";
//$PHILLIS_VIEW_TEMPLATE['section']['start'] = "<div class='panel panel-default'>{SECTIONTITLE}";  // Ex- $PHILLIS_SECTION_START
//--$PHILLIS_VIEW_TEMPLATE['section']['title']= "<div class='panel-heading'>{SECTIONTITLE}</div>";  // Ex- $PHILLIS_SECTION_TITLE
// Antigo $PHILLIS_VIEW_TEMPLATE['section']['start'] = "<table style='width:100%'><tr><td class='forumheader' id='nav' style='width:100% !important; padding: 1px !important'><input id='mytogglelis{SECTIONCODE}' type='checkbox' class='togglelis' /><label for='mytogglelis{SECTIONCODE}' class='togglelis'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";  // Ex- $PHILLIS_SECTION_START
//$PHILLIS_VIEW_TEMPLATE['section']['end'] = "</div>";  // Ex- $PHILLIS_SECTION_INI_END
//$PHILLIS_VIEW_TEMPLATE['item']['start'] = "<div class='panel-body panel-collapse collapse in collapse{SECTIONCODE}' id='collapse{SECTIONCODE}'>";  // Ex- $PHILLIS_SECTION_DIV_START
//$PHILLIS_VIEW_TEMPLATE['item']['end'] = "</div>";  // Ex- $PHILLIS_SECTION_DIV_END
//$PHILLIS_XCITEM = "<span{ITEMCLASS=x} onmouseover=\"ddrivetip('{TIPHTML}')\" onmouseout='hideddrivetip()'>{ITEM=x}</span> ";
/*
$sc_style['ITEMHREF']['pre'] = " href='";
$sc_style['ITEMHREF']['post'] = "'";
$sc_style['ITEMTITLE']['pre'] = " title=";
$sc_style['ITEMTITLE']['post'] = "";
*/
//$PHILLIS_VIEW_TEMPLATE['edit']['item'] = "<a{ITEMCLASS=ed}{ITEMHREF}{ITEMTITLE} onmouseover=\"ddrivetip('{TIPHTML}');\" onmouseout='hideddrivetip()'>{ITEM}</a> ";  // Ex- $PHILLIS_EDITITEM
//
//$PHILLIS_VIEW_WRAPPER['ITEM:class=ed'] = " class='{---}'";
//$sc_style['IMAGE']['pre'] = "<img src='";
//$sc_style['IMAGE']['post'] = "'/>";
//$PHILLIS_VIEW_WRAPPER['PHLIS_IMAGE'] = "<img src='{---}'/>";
//$sc_style['IMGTXT']['pre'] = "<b>";
//$sc_style['IMGTXT']['post'] = "</b>";
//$PHILLIS_VIEW_TEMPLATE['trc_start'] = "<center><ul class='list-group list-group-horizontal'>";
//$PHILLIS_VIEW_TEMPLATE['trc_body'] = "<li class='list-group-item border-0'>{PHLIS_IMAGE}<br><center>{PHLIS_ITEM}</center></li>";  // Ex- $PHILLIS_IMAGE
//$PHILLIS_VIEW_TEMPLATE['trc_end'] = "</ul>";   
//$PHILLIS_VIEW_WRAPPER['PHLIS_IMAGE'] = "{---}";
//$PHILLIS_VIEW_WRAPPER['PHLIS_ITEM:data'] = "{---}";

$PHILLIS_VIEW_TEMPLATE['trc_start'] = "<div class='row'>";
$PHILLIS_VIEW_TEMPLATE['trc_body'] = "
<div class='col-auto text-center text-wrap'>
  <a class='list' href={PHLIS_PECA}>
    {PHLIS_IMAGE}
    {PHLIS_ITEM:data}
  </a>
</div>";  // Ex- $PHILLIS_IMAGE
$PHILLIS_VIEW_TEMPLATE['trc_end'] = "</div>";   
$PHILLIS_VIEW_TEMPLATE['trc'] = "
    <p>
    {PHLIS_VAL}
    <p>
    {PHLIS_ANO}
";