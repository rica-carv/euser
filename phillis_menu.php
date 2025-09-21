<?php
//VAr_dump("PHILIS_MENU");
if (!defined('e107_INIT')) { exit; }
//var_dump(e_QUERY);
//var_dump(e_PAGE=="phillis_view.php");
//var_dump(str_starts_with(e_QUERY, "n"));
//var_dump(str_starts_with(e_QUERY, "u"));
//var_dump(((e_PAGE=="phillis_view.php") && ((!str_starts_with(e_QUERY, "n")) || (!str_starts_with(e_QUERY, "u")))));
if (e_PAGE<>"phillis_view.php") { return null; }

e107::lan('phillis',"front", true);
//$phillis_shortcodes = e107::getScBatch('phillis', 'phillis');
//$sc = e107::getScBatch('phil_lis',TRUE);
$sc = e107::getScBatch('menu', 'phillis');
//var_dump ($phillis_shortcodes);
//ECHO "SC carregado!!!!";
/////////////////////////////////////////require_once(e_PLUGIN."phil/phil_class.php");

//if (file_exists(THEME."phillis_template.php")) {include_once(THEME."phillis_template.php");} else {include(e_PLUGIN."phil_lis/phillis_template.php");}
e107::getTemplate('phillis', 'icons');
e107::getTemplate('philcat', 'icons');
$phillis_template = e107::getTemplate('phillis', 'phillis_menu'); 	

e107::css('phillis', 'phillis.css');
// Vou usar o bootstrap normal.... N�o h�, n�o h�...
//e107::css('url', '../phil/phil.css'); // ?
//e107::css('url', '../phil/dialog/dialog_box.css'); //?
e107::js("footer", e_PLUGIN."phillis/js/phillis_menu.js");

/*
e107::js("footer-inline", "
var replaceurltext = function(element, find, replace) {
/*
      var url = $('.mylink').attr('href');
      url = url.replace('us-test', 'replaced-text');
      $('.mylink').attr('href', url);
*/
//      console.log (e);
/*
      var url = element.attr('href');
      url = url.replace(find, replace);
      element.attr('href', url);
}

  $('button#normal').click(function() {
      $( 'a.havexc' ).each(function() {
        $(this).html($(this).attr('data-html'));
        var self = $(this);
        $.each($(this).data('events'), function (_, e) {
          self.on(e[0].type, e[0].handler);
        });
        }).addClass('have imagepop').removeClass('havexc');
      $(this).add('button#condensed').prop('disabled', function(i, v) { return !v; }).addClass('btn-primary');
      $(this).removeClass('btn-primary');

      $('#phil_pdf, #phil_print').each(function (){replaceurltext($(this), '.x', '.d')});
//      sessionStorage.setItem('phillisview', 'd');
  });

  $('button#condensed').click(function() {
      $( 'a.list.have' ).each(function(){
//        $(this).attr('data-html', $(this).html());
//        $(this).data('events', $.extend(true, {}, $._data(this, 'events')));
        $(this).attr('data-html', $(this).html()).data('events', $.extend(true, {}, $._data(this, 'events')));
      }).off().html(' | ');
      $( 'a.have' ).addClass('havexc').removeClass('have imagepop');
//      $( 'a.col' ).off('mouseenter mouseleave').html(' | ').addClass('colxc').removeClass('col imagepop');
//      $( 'a.col' ).html(' | ').addClass('colxc').removeClass('col');
      $(this).add('button#normal').prop('disabled', function(i, v) { return !v; }).addClass('btn-primary');
      $(this).removeClass('btn-primary');
      $('#phil_pdf, #phil_print').each(function (){replaceurltext($(this), '.d', '.x')});
//      sessionStorage.setItem('phillisview', 'x');
  });
", "jquery");
*/


/*
e107::js("footer-inline", "


$('.btn-toggle').click(function() {
  $(this).find('.btn').toggleClass('active');  
  
  if ($(this).find('.btn-primary').length>0) {
    $(this).find('.btn').toggleClass('btn-primary');
  }
  if ($(this).find('.btn-danger').length>0) {
    $(this).find('.btn').toggleClass('btn-danger');
  }
  if ($(this).find('.btn-success').length>0) {
    $(this).find('.btn').toggleClass('btn-success');
  }
  if ($(this).find('.btn-info').length>0) {
    $(this).find('.btn').toggleClass('btn-info');
  }
  
  $(this).find('.btn').toggleClass('btn-default');
     
});

$('form').submit(function(){
var radioValue = $(\"input[name='options']:checked\").val();
if(radioValue){
   alert(\"You selected - \" + radioValue);
 };
  return false;
});


", "jquery");
*/

// Bootstrap switch button https://palcarazm.github.io/bootstrap5-toggle/
  // PROVAVELMENTE DEPOIS CARREGAR ISTO COM O CDN, POR AGORA FICA LOCAL
e107::css('phillis', '/lib/bootstrap5-toggle/css/bootstrap5-toggle.min.css');
e107::js("footer", e_PLUGIN."phillis/lib/bootstrap5-toggle/js/bootstrap5-toggle.jquery.min.js", "jquery"); 


//e107::getTemplate('phil_lis', 'icons');
//var_dump (PHLIS_IMAGE_normal); 	
//e107::getTemplate('phil_lis');
//require_once(e_PLUGIN."phil_lis/phillis_shortcodes.php");
//preg_match("/\bphillis.php\b/i", e_SELF, $match);
//require_once(e_PLUGIN.($match?"phillis":"phil_cat")."/phil_menu_shortcodes.php");

//var_dump($phillis_shortcodes);
//var_dump($phillis_template);
/*
$phillis_temp = preg_split('/[.-]/', e_QUERY);
$phillis_userid = abs(intval($phillis_temp[1]));
$action = ($phillis_userid==0?"show":$phillis_temp[0]);
$phillis_splitter = substr(e_QUERY, 1, 1);
$phillis_edit = ((USERID == $phillis_userid)?$phillis_splitter=='-':null);
*/

//$phillis_text = $tp->parsetemplate($phillis_MENU_TITLE, false, $phillis_shortcodes);
//$phillis_text .= $tp->parsetemplate($phillis_MENU_TITLE.$phillis_MENU, false, $phillis_shortcodes);

//unset ($_SESSION{'ph'.($match?'list':'catalogue').'_filter'});

//$tp->parsetemplate(($phillis_shortcodesaction == "n" || $phillis_shortcodesaction == "u" || $phillis_shortcodesedit)?"<div id='dialog-content' style='padding: 0px;'>".$phillis_INILEG.($phillis_shortcodesccount?$phillis_COMPLEG:"").($phillis_shortcodesedit?$phillis_EDITLEGFALTAS:$LAN_PLUGIN_PHILLIS_EGFALTAS[$phillis_shortcodesview]).$phillis_ENDLEG."</div>":"");
//var_dump ($phllist_Action);
//e107::css('phil_lis', 'phillis.css');
//e107::css('phil', 'phil.css');
//e107::css('phil', 'dialog/dialog_box.css');
/*
var_dump(e107::getRegistry('phillis_action'));
var_dump(e107::getRegistry('phillis_userid'));
var_dump(e107::getRegistry('phillis_ccount'));
var_dump(e107::getRegistry('phillis_whatdo'));
*/
//  $phillis_shortcodesaction = getcachedvars('phillis_action');
//  $phillis_shortcodesuserid = getcachedvars('phillis_userid');
//  $phillis_shortcodesccount = getcachedvars('phillis_ccount');
//  $phillis_shortcodesview = getcachedvars('phillis_view');
//  $phillis_shortcodesccount = e107::getRegistry('phillis_ccount');
//$phillis_shortcodesedit = (e107::getRegistry('phillis_ccount')?null:(USERID==e107::getRegistry('phillis_userid') && e107::getRegistry('phillis_whatdo')=="ed"));

/*
var_dump ("ACTION", $phillis_shortcodesaction);
var_dump ("USERID", $phillis_shortcodesuserid);
var_dump ("CCOUNT", $phillis_shortcodesccount);
var_dump ("VIEW", $phillis_shortcodesview);
echo "<hr>";
var_dump (($phillis_shortcodesaction == "n" || $phillis_shortcodesaction == "u" || $phillis_shortcodesedit));
*/
$sc->wrapper('phillis_menu');

$caption = $tp->parsetemplate($phillis_template['caption'], true, $sc);

/////$check_url = e_PAGE!="e_PAGE" ? e_PAGE : end(explode('/', parse_url(e_URL_LEGACY)['path']));

//var_dump ($_SESSION{'phillis_view'});
//var_dump ($phillis_shortcodesview);
//var_dump ($phillis_shortcodesview);
//$text = $tp->parsetemplate(($check_url==="phillis.php"?$phillis_template['body']:$phillis_template['view']['body']).(($phillis_shortcodesaction == "n" || $phillis_shortcodesaction == "u" || $phillis_shortcodesedit)?$phillis_template['leg']['start'].($phillis_shortcodesccount?$phillis_template['leg']['body']:"").($phillis_shortcodesedit?$phillis_template['leg']['edit']:$phillis_template['leg'][$phillis_shortcodesview]).$phillis_template['leg']['end']:""), TRUE, $sc);
/*
$text = $tp->parsetemplate(($check_url==="phillis.php"?$phillis_template['body']:$phillis_template['view']['body']).
((e107::getRegistry('phillis_action') == "n" || e107::getRegistry('phillis_action') == "u" || $phillis_shortcodesedit)?$phillis_template['leg']['start'].
($phillis_shortcodesedit?$phillis_template['leg']['edit']:$phillis_template['leg']['body']).
$phillis_template['leg']['end']:null)
, TRUE, $sc);
*/
$text = $tp->parsetemplate($phillis_template['menu'], TRUE, $sc);

if ($text) {$ns->tablerender($caption, $text);}

/*
$ns->tablerender(($match?phillis_01:phcat_01)." - ".PHIL_L02, "<form action='" . e_SELF . "' method='post' id='phfltform' style='position:relative'><div id='loading' style='display:none'><br><img src='../phil/images/loading.gif'><br>".phcat_96."</div><div id='catflt'>".$_SESSION{'ph'.($match?'list':'catalogue').'_filter'}."</div><script type=\"text/javascript\">
  function getSecond(name) {
    var form = $('phfltform');
    var input = form['phcatalogue_pais'];
    param = {};
     param['phcatalogue_pais'] = $(input).getValue();
    var input = form['phcatalogue_familia'];
     param['phcatalogue_familia'] = $(input).getValue();
    var input = form['phcatalogue_tipo'];
     param['phcatalogue_tipo'] = $(input).getValue();
    var input = form['phcatalogue_iano'];
     param['phcatalogue_iano'] = $(input).getValue();
    var input = form['phcatalogue_fano'];
     param['phcatalogue_fano'] = $(input).getValue();
    var myAjax = new Ajax.Request
      (
        'phcat_list.php',
        {
          method: \"post\",
          parameters : param,          
          onLoading: function() {
            $('loading').show();
            document.getElementById('pclist').innerHTML=\"<div id='loading'><center><img src='../phil/images/loading.gif'><br>".phcat_96."<br><img src='../phil/images/loading.gif'></center></div>\";
          },
          onComplete: function() {
            $('loading').hide();
          },
          onSuccess: function transResult (response) {
            responsepart = response.responseText.split('|');
            document.getElementById('catflt').innerHTML=responsepart[0];
            document.getElementById('pclist').innerHTML=responsepart[1];
          },
          onFailure: function transResult (response) {
            alert ('Failure'+response.responseText);
          }
        }
      );
      return false;
  }
  </script></form><link rel='stylesheet' href='../phil/dialog/dialog_box.css' type='text/css'>".($match?((!is_null($phillis_edit) && USERID==$phillis_userid && $phillis_userid>0)?"<p><center><a href='".e_PLUGIN_ABS."phil_lis/phillis.php?".str_replace(($phillis_edit?"-":"."), ($phillis_edit?".":"-"), e_QUERY)."' title='".($phillis_edit==1?phillis_201:phillis_200)."'><img src='images/list_".($phillis_edit==1?"save":"edit").".png'/>&nbsp;&nbsp;".($phillis_edit==1?phillis_201:phillis_200)."</a></center>".(($phillis_utext || $phillis_edit==1)?"<p><center><div id='dialog-content' class='".($phillis_edit==1 && !$phillis_utext?"warning":($phllist_Ajaxerr?"error":"success"))."'>".($phillis_edit==1 && !$phillis_utext?phillis_300.(($action == "s" || $action == "o")?phillis_302:phillis_301):$phillis_utext)."</div></center>":""):"").(($action == "n" || $action == "u")?"<div id='dialog-content' style='padding: 0px;'>".leg_faltas(($phillis_edit?"ed":""))."</div>":""):""));
*/
