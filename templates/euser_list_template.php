<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2013 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * REPLACES MEMBERLIST_TEMPLATE
 *
 */

if (!defined('e107_INIT')) { exit(); }

// vvvvvvvv Antigo, estava no euser. Ser� para qu�?
/*
	$EXTENDED_CATEGORY_START = "<tr><td colspan='2' class='forumheader' style='text-align:left'>{EXTENDED_NAME}</td></tr>";
	$EXTENDED_CATEGORY_TABLE = "
		<tr><td class='forumheader3'>{EXTENDED_ICON}&nbsp;{EXTENDED_NAME}</td><td class='forumheader3'>{EXTENDED_VALUE}</td></tr>
		";
	$EXTENDED_END = "";
	$sc_style['USER_COMMENTS_LINK']['pre'] = "<tr><td colspan='2' class='forumheader3' style='text-align:left'>";
	$sc_style['USER_COMMENTS_LINK']['post'] = "</td></tr>";
	$sc_style['USER_FORUM_LINK']['pre'] = "<tr><td colspan='2' class='forumheader3' style='text-align:left'>";
	$sc_style['USER_FORUM_LINK']['post'] = "</td></tr>";
*/
// ^^^^^^^^ Antigo, estava no euser. Ser� para qu�?
/*
// Para que o link para amesma página aqui?
$EUSER_TEMPLATE['caption'] =	"<a href='{EUSER_SETTINGS:link}' title='{EUSER_SETTINGS:title}'>{EUSER_ONLINE}&nbsp;".LAN_EUSER_001009."&nbsp;#{USER_ID}&nbsp;".LAN_EUSER_4013." : {USER_NAME} ({USER_LOGINNAME})</a><span class='pull-right'><ul class='pager user-view-nextprev'>
<li class='previous'>
  {USER_JUMP_LINK:prev&class=btn btn-sm btn-default}
</li>
<li>
  <!-- Back to List? -->
</li>
<li class='next'>
  {USER_JUMP_LINK:next&class=btn btn-sm btn-default}
</li>
</ul></span>";
*/
//$EUSER_LIST_WRAPPER['caption']['USER_LOGINNAME'] = $EUSER_LIST_WRAPPER['main']['USER_LOGINNAME'] = " ({---})"; // LOGIN_NAME só aparece se quem estiver a ver for admin

//$EUSER_LIST_WRAPPER['caption']['USER_ID'] = " #{---}&nbsp;"; // USER_ID só aparece se quem estiver a ver for admin

/*
	$USER_TEMPLATE['list']['start']  = "
		<div class='content user-list'>
		<div class='center'>{LAN=USER_56} {TOTAL_USERS}
		<br />
		<br />
		{USER_FORM_START}
		<div class='form-inline'>
		{LAN=SHOW}: {USER_FORM_RECORDS} {LAN=USER_57} {USER_FORM_ORDER}
		{USER_FORM_SUBMIT}
		</div>
		{USER_FORM_END}
		</div>
		<br />
		<br />
		<table class='table fborder e-list'>
		<thead>
		<tr>
		<th class='fcaption' style='width:2%'>&nbsp;</th>
		<th class='fcaption' style='width:20%'>{LAN=USER_58}</th>
		<th class='fcaption' style='width:20%'>{LAN=USER_60}</th>
		<th class='fcaption' style='width:20%'>{LAN=USER_59}</th>
		</tr>
		</thead>
		<tbody>
		{SETIMAGE: w=40}
	";


	$USER_TEMPLATE['list']['item']  = "
	<tr>
		<td class='forumheader3' style='width:2%'>{USER_PICTURE}</td>
		<td class='forumheader3' style='width:20%'>{USER_ID}: {USER_NAME_LINK}</td>
		<td class='forumheader3' style='width:20%'>{USER_EMAIL}</td>
		<td class='forumheader3' style='width:20%'>{USER_JOIN}</td>
	</tr>
	";

	$USER_TEMPLATE['list']['end']  = "
	</tbody>
	</table>
	</div>
	";
*/





$EUSER_LIST_TEMPLATE['caption'] =	"{LAN=USER_56} {TOTAL_USERS}";

$EUSER_LIST_TEMPLATE['start'] =	"
{EUSER_LISTNAV}
		<div class='content user-list'>
      {USER_FORM_START}
  		<div class='row mb-2 form-inline d-flex justify-content-center align-items-center'>
        <label class='control-label col-sm-auto' for='records'>{LAN=SHOW}:</label>
        <div class='col-sm-auto'>
          {USER_FORM_RECORDS}
        </div>
        <label class='control-label col-sm-auto'>{LAN=USER_57}</label>
        <div class='col-sm-auto'>
          {USER_FORM_ORDER}
        </div>
        <div class='col-sm-2'>{USER_FORM_SUBMIT}</div>
      </div>
		  {USER_FORM_END}

 		<table class='table table-striped table-condensed table-hover border e-list'>
    <colgroup>
      <col style='width:17%' />
      <col style='width:5%' />
      <col style='width:20%' />
      <col style='width:25%' />
      <col style='width:8%' />
      <col style='width:25%' />
    </colgroup>
		<thead>
		<tr>
		<th>{LAN=USER_58}</th>
		<th>{LAN=USER_54}</th>
		<th>{LAN=EUSER_12}</th>
		<th>{LAN=USER_59}</th>
		<th>{LAN=USER_21}</th>
		<th>{LAN=USER_65}</th>
		</tr>
		</thead>
		<tbody>
		{SETIMAGE: w=40}
";

$EUSER_LIST_TEMPLATE['default']['item']  = "
	<tr>
		<td>{EUSER_INFOCARD=inline}</td>
    <td>{USER_LEVEL}</td>
		<td>{USER_EMAIL}</td>
		<td>{USER_JOIN}</td>
		<td>{USER_VISITS}</td>
		<td>{USER_LASTVISIT}</td>
	</tr>
	";

$EUSER_LIST_TEMPLATE['end'] =	"
	    </tbody>
	  </table>
  </div>
  {EUSER_LISTNAV}
";
// Novo caso seja aprovado o pull  $EUSER_TEMPLATE['caption'] =	"<a href='{EUSER_SETTINGS:link}' title='{EUSER_SETTINGS:title}'>{EUSER_ONLINE}&nbsp;".LAN_EUSER_001009."&nbsp;#{USER_ID}&nbsp;".LAN_EUSER_4013." : {USER_NAME} ({USER_LOGINNAME})</a><span class='pull-right'>{USER_JUMP_LINK:prev&class=btn btn-small}{USER_JUMP_LINK:next&class=btn btn-small}</span>";

//$EUSER_TEMPLATE['controls_logged'] =	"{EUSER_SETTINGS:class='btn btn-sm btn-primary'}";
//  $EUSER_TEMPLATE['controls_logged'] =	"{USER_UPDATE_LINK}";

$EUSER_LIST_TEMPLATE['controls'] =	"{USER_SENDPM:glyph=envelope}{EUSER_ADDFRIEND}";

/*$EUSER_WRAPPER['main']['USER_LEVEL'] = "<div>
		  <span>{USER_ICON=level} ".LAN_USER_54.":</span>
		  <span class='pull-right'>{---}</span>
      </div>";
*/
//$EUSER_WRAPPER['main']['EUSER_AVATAR']= "<div style='text-align: center; vertical-align: middle; min-width: {EUSER_AVATARMINW}px;'>{---}</div><br>";
//$EUSER_WRAPPER['main']['USER_RATING']= "{---}<br>";
//$EUSER_WRAPPER['main']['SENDPM'] = "<tr><td class='forumheader3'><div class='f-left'>".LAN_USER_62.":</div><div class='f-right'>{---}</div></td></tr>";
//$EUSER_WRAPPER['main']['SENDPM'] = "<div><center>{---}</center></div>";
$EUSER_LIST_WRAPPER['main']['USER_RATING'] = "<tr><td class='forumheader3'><div class='f-left'>".LAN_RATING."</div><div class='f-right'>{---}</div></td></tr>";
$EUSER_LIST_WRAPPER['main']['USER_SIGNATURE'] = "<tr><td class='forumheader3 left'>{---}</td></tr>";
$EUSER_LIST_WRAPPER['main']['USER_EXTENDED_ALL'] = "<tr><td class='forumheader3 left'>{---}</td></tr>";
/*
$EUSER_WRAPPER['main']['EUSER_NEWS:'] = "<span>".IMAGE_news."&nbsp;".LAN_EUSER_600."</span><span class='pull-right'>{---}";
$EUSER_WRAPPER['main']['EUSER_UPLOADS:'] = "<span><img src='images/news.png'>&nbsp;".LAN_EUSER_601."&nbsp;&nbsp;</span><span class='pull-right'>{---}";
$EUSER_WRAPPER['main']['EUSER_DOWNLOADS:'] = "<span><img src='images/news.png'>&nbsp;".LAN_EUSER_602."&nbsp;&nbsp;</span><span class='pull-right'>{---}";
$EUSER_WRAPPER['main']['EUSER_LINKS:'] = "<span><img src='images/news.png'>&nbsp;".LAN_EUSER_603."&nbsp;&nbsp;</span><span class='pull-right'>{---}";
$EUSER_WRAPPER['main']['USER_CHATPER'] = $EUSER_WRAPPER['main']['USER_COMMENTPER'] = $EUSER_WRAPPER['main']['USER_FORUMPER'] = $EUSER_WRAPPER['main']['EUSER_NEWS:percent'] = $EUSER_WRAPPER['main']['EUSER_UPLOADS:percent'] = $EUSER_WRAPPER['main']['EUSER_DOWNLOADS:percent'] = $EUSER_WRAPPER['main']['EUSER_LINKS:percent'] = " ( {---}% )</span>";
*/
$EUSER_LIST_WRAPPER['main']['USER_CHATPER'] = $EUSER_LIST_WRAPPER['main']['USER_COMMENTPER'] = $EUSER_LIST_WRAPPER['main']['USER_FORUMPER'] = " ( {---}% )</span>";

$EUSER_LIST_WRAPPER['main']['EUSER_MP3'] = "<div><span>".PROFILE_416.":</span><span class='pull-right'>{---}</span></div>";

// S� TEXTO
//$EUSER_WRAPPER['main']['EUSER_SETTINGLINK'] = "{---}".PROFILE_17."</a>"
//USANDO O AVATAR...
//$EUSER_WRAPPER['main']['EUSER_AVATAR']= "<div style='text-align: center; vertical-align: middle; min-width: {EUSER_AVATARMINW}px;'>{---}</div><br>";
$EUSER_LIST_WRAPPER['main']['EUSER_AVATAR'] = "<div style='text-align: center; vertical-align: middle; min-width: {EUSER_AVATARMINW}px;'><a href='{EUSER_SETTINGS:link}' title='{EUSER_SETTINGS:title}'>{---}</a></div><br>";

//$EUSER_WRAPPER['main']['EUSER_COMMENTS:caption'] = "<li><a data-toggle='tab' href='#euser_comments'>{---}</a></li>";
//$EUSER_WRAPPER['main']['EUSER_FRIENDS:caption'] = "<li><a data-toggle='tab' href='#euser_friends'>{---}</a></li>";
//$EUSER_WRAPPER['main']['EUSER_IMAGES:caption'] = "<li><a data-toggle='tab' href='#euser_images'>{---}</a></li>";
//$EUSER_WRAPPER['main']['EUSER_VIDEOS:caption'] = "<li><a data-toggle='tab' href='#euser_videos'>{---}</a></li>";
$EUSER_LIST_WRAPPER['main']['EUSER_COMMENTS:caption'] = "<li><a class='tab-comments nav-link' data-bs-toggle='tab' href='#euser-comments'>{---}</a></li>";
$EUSER_LIST_WRAPPER['main']['EUSER_FRIENDS:caption'] = "<li><a class='tab-friends nav-link' data-bs-toggle='tab' href='#euser-friends'>{---}</a></li>";
$EUSER_LIST_WRAPPER['main']['EUSER_IMAGES:caption'] = '<li><a class="tab-images nav-link" data-bs-toggle="tab" href="#euser-images">{---}</a></li>';
$EUSER_LIST_WRAPPER['main']['EUSER_VIDEOS:caption'] = '<li><a class="tab-videos nav-link" data-bs-toggle="tab" href="#euser-videos">{---}</a></li>';
$EUSER_LIST_WRAPPER['main']['EUSER_FRIENDS:'] = "<div id='euser-friends' class='tab-pane fade card-body'>{---}</div>";
$EUSER_LIST_WRAPPER['main']['EUSER_IMAGES:'] = "<div id='euser-images' class='tab-pane fade card-body'>{---}</div>";
$EUSER_LIST_WRAPPER['main']['EUSER_VIDEOS:'] = "<div id='euser-videos' class='tab-pane fade card-body'>{---}</div>";

//$EUSER_WRAPPER['main']['EUSER_COMMENTS:'] = "<div id='euser_comments' class='tab-pane fade card-body'>{---}</div>";
$EUSER_LIST_WRAPPER['main']['PROFILE_COMMENTS'] = "<div id='euser_comments' class='tab-pane fade card-body'>{---}</div>";
$EUSER_LIST_WRAPPER['main']['EUSER_TOTALVIEWS'] = '<div class="euser-infoline col-auto"><small class="tags" data-bs-original-title="{LAN=LAN_EUSER_9}" title="{LAN=LAN_EUSER_9}">{GLYPH=eye} &nbsp;{---}</small></div>';
$EUSER_LIST_WRAPPER['main']['EUSER_LASTVIEWED'] = '<div class="euser-infoline col-auto"><small class="tags" data-bs-original-title="{LAN=LAN_EUSER_10}" title="{LAN=LAN_EUSER_10}">{GLYPH=calendar} &nbsp;{---}</small></div>';

	// View shortcode wrappers.
	$USER_WRAPPER['main']['USER_COMMENTPOSTS']      = '<div class="col-xs-12 col-md-4">{LAN=USER_68}</div><div class="col-xs-12 col-md-8">{---} ( {USER_COMMENTPER}% )</div>';
//	$USER_WRAPPER['main']['USER_COMMENTPER']        = ' ( {---}% )</div>';
	$USER_WRAPPER['main']['USER_SIGNATURE']         = '<div>{---}</div>';
	$USER_WRAPPER['main']['USER_RATING']            = '<div>{---}</div>';
	$USER_WRAPPER['main']['USER_SENDPM']            = '<div>{---}</div>';
//	$USER_WRAPPER['main']['PROFILE_COMMENTS']       = '<div class="clearfix">{---}</div>';

  
$EUSER_LIST_TEMPLATE['main'] =	'
<div class="euser-info mb-2 row align-items-center">
      {EUSER_TOTALVIEWS}
      {EUSER_LASTVIEWED=dd M yyyy}
</div>
<div class="euser-profile row">
  <div class="col-md-12">
    <div class="euser-panel">
      <div class="euser-body">
        <div class="row border-0 pb-3">
          <div class="col-auto text-center">
            {SETIMAGE: w=200&h=200&crop=1}
            <div class="{EUSER_ONLINE:class=1} pb-3" data-bs-original-title="{EUSER_ONLINE:text=2}" title="{EUSER_ONLINE:text=2}">
              {USER_PICTURE: shape=circle&link=1&class=mt-0 image-circle user-avatar border border-3}
            </div>
            <div class="d-grid gap-2 text-center">
              <!-- Controls -->
              {EUSER_CONTROLS}
              <!-- End Controls -->
            </div>
          </div>
          <!-- Primeira secção abas -->
          <div class="col ps-0">
            <div class="tabbed-menu">
              <div class="tabbed-menu-body">
                <div class="tabs-wrapper">
                  <div class="card spt_rowuborders with-nav-tabs bg-secondary">
                    <div class="card-header pb-0">
                      <ul class="nav nav-tabs" role="tablist">
                        <li>
                          <a class="tab-home active nav-link" data-bs-toggle="tab" href="#euser-home">{LAN=LAN_418}</a>
                        </li>
                        <li>
                          <a class="tab-1 nav-link" data-bs-toggle="tab" href="#euser-t1">{LAN=LAN_EUSER_1}</a>
                        </li>
                        {EUSER_FRIENDS:caption}
                        {EUSER_IMAGES:caption}
                        {EUSER_VIDEOS:caption}
                      </ul>
                    </div>

                    <div class="card-body bg-light p-0">
                      <div class="tab-content container">
                        <!-- Tab: Home -->
                        <div id="euser-home" class="tab-pane fade in active show" role="tabpanel">
                          <div class="d-flex row row-cols-2 p-2">
                            <div class="col-xs-12 col-md-4">{LAN=USER_02}:</div>
                            <div class="col-xs-12 col-md-8">{USER_NAME}{USER_LOGINNAME}</div>

                            <div class="col-xs-12 col-md-4">{LAN=USER_63}</div>
                            <div class="col-xs-12 col-md-8">{USER_REALNAME}</div>

                            <div class="col-xs-12 col-md-4">{LAN=USER_60}</div>
                            <div class="col-xs-12 col-md-8">{USER_EMAIL}</div>

                            <div class="col-xs-12 col-md-4">{LAN=USER_54}:</div>
                            <div class="col-xs-12 col-md-8">{USER_LEVEL}</div>

                            {USER_RATING}
                            {USER_SIGNATURE}
                            {EUSER_MP3}
                          </div>
                        </div>

                        <!-- Tab: T1 -->
                        <div id="euser-t1" class="tab-pane fade" role="tabpanel">
                          <div class="container pt-4">
                            <div class="card spt_rowuborders">
                              <div class="card-body alert alert-warning mb-0 text-center">
                                EM CONSTRUÇÃO<br>
                                Vou usar para (a maior parte vem do another profiles):<br>
                                - comentário próprio<br>
                                - localização (se existir)<br>
                                - dia de aniversário<br>
                                - país<br>
                                - língua<br>
                                - endereço do site<br>
                                - MSN<br>
                                - Skype<br>
                                - etc.
                              </div>
                            </div>
                            {USER_EXTENDED_ALL}
                          </div>
                        </div>
                        {EUSER_FRIENDS:}
                        {EUSER_IMAGES:}
                        {EUSER_VIDEOS:}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Segunda seção de abas -->
        <div class="row border-0">
          <div class="col">
            <div class="tabbed-menu">
              <div class="tabbed-menu-body">
                <div class="tabs-wrapper">
                  <div class="card spt_rowuborders with-nav-tabs bg-info">
                    <div class="card-header pb-0">
                      <ul class="nav nav-tabs" role="tablist">
                        <li>
                          <a class="tab-resumo active nav-link" data-bs-toggle="tab" href="#euser-resumo">{LAN=LAN_EUSER_4}</a>
                        </li>
                        {EUSER_PLUGINS:caption}
                      </ul>
                    </div>

                    <div class="card-body bg-white p-0">
                      <div class="tab-content container m-0 mw-100">
                        <div id="euser-resumo" class="tab-pane fade in active show" role="tabpanel">
                          {EUSER_PLUGINS:resume}
                        </div>
                        {EUSER_PLUGINS}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> 
        </div>

      </div> <!-- /.euser-body -->
    </div> <!-- /.euser-panel -->
  </div> <!-- /.col-md-12 -->
</div> <!-- /.euser-profile -->

<!-- Start Comments -->
{PROFILE_COMMENTS}
<!-- End Comments -->

{PROFILE_COMMENT_FORM}

';

//Set this to TRUE if you would like any extended user field that is empty to NOT be shown on the profile page
define("HIDE_EMPTY_FIELDS", TRUE);

$EUSER_LIST_TEMPLATE['extended']['start'] = '<div class="d-flex row rows-col-2 ">';
$EUSER_LIST_TEMPLATE['extended']['end']   = '</div>';

$EUSER_LIST_TEMPLATE['extended']['item'] = '
      <div class="col-xs-12 col-md-4">{EXTENDED_NAME}</div>
      <div class="col-xs-12 col-md-8">{EXTENDED_VALUE}</div>
  ';
/*
// POR enquanto não vou permitir nem imagens nem videos....
"
{EUSER_BGIMAGE}
<div class='container-fluid'>
  <div class='row'>
    <div class='col-md-4'>
      <center>{EUSER_AVATAR}</center>
      <div>
    		<span>{USER_ICON=realname} ".LAN_USER_63."</span>
		    <span class='pull-right'>{USER_REALNAME}</span>
      </div><div>
		    <span>{USER_ICON=email} ".LAN_USER_60."</span>
		    <span class='pull-right'>{USER_EMAIL}</span>
      </div>{USER_LEVEL}
      <div>
        {USER_RATING}
      </div><div>
      {USER_SIGNATURE}
      {USER_EXTENDED_ALL}
      {EUSER_MP3}
      </div><div class='text-center'>
      <br>
      {EUSER_CONTROLS}
      </div>
    </div>
    <div class='col-md-8'>
      <ul class='userprofile nav nav-tabs' role='tablist'>
        <li class='active'><a data-toggle='tab' href='#euser_general'>".LAN_USER_64."</a></li>
        {EUSER_COMMENTS:caption}
        {EUSER_FRIENDS:caption}
        {EUSER_IMAGES:caption}
        {EUSER_VIDEOS:caption}
      </ul>

      <div class='tab-content panel card-default card-body'>
        <div id='euser_general' class='tab-pane fade in active'>
          <div>
            <span>".IMAGE_registration."&nbsp;".LAN_USER_59.":</span>
            <span class='pull-right' title='{USER_DAYSREGGED}'>{USER_JOIN}</span>
          </div><div>
		        <span>".IMAGE_visits."&nbsp;".LAN_USER_66.":</span>
            <span class='pull-right'>{USER_VISITS}
          </div><div>
            <span>".IMAGE_lastvisit."&nbsp;".PROFILE_353.":</span>
            <span class='pull-right'>{USER_LASTVISIT}</span>
          </div><div>
		        {EUSER_WARN}
          </div><div>
            <span>".IMAGE_chat."&nbsp;".LAN_USER_67.":</span>
            <span class='pull-right'>{USER_CHATPOSTS}{USER_CHATPER}
          </div><div>
            <span>".IMAGE_comment."&nbsp;".LAN_USER_68.":</span>
            <span class='pull-right'>{USER_COMMENTPOSTS}{USER_COMMENTPER}
          </div>
            {USER_ADDONS}
            {EUSER_PLUGINS}
        </div>
	            {PROFILE_COMMENTS}
	            {PROFILE_COMMENT_FORM}
        {EUSER_FRIENDS:}
        {EUSER_IMAGES:}
        {EUSER_VIDEOS:}
      </div>
    </div>
  </div>
";
*/
// Alternativa {EUSER_ADDFRIEND:icon=fa-addfriend}
/*
$EUSER_TEMPLATE['comments_caption'] =	PROFILE_15."&nbsp;<span class='badge'>[x]</span>";
$EUSER_TEMPLATE['comments_no'] =	IMAGE_comment."&nbsp;<i>".PROFILE_32."</i>";

$EUSER_TEMPLATE['friends_caption'] =	PROFILE_13."&nbsp;<span class='badge'>[x]</span>";
$EUSER_TEMPLATE['friends_no'] =	IMAGE_friends."&nbsp;<i>".PROFILE_30."</i>";

$EUSER_TEMPLATE['images_caption'] =	LAN_EUSER_650."&nbsp;<span class='badge'>[x]</span>";
$EUSER_TEMPLATE['images_no'] =	IMAGE_images."&nbsp;<i>".PROFILE_163."</i>";

$EUSER_TEMPLATE['videos_caption'] =	PROFILE_113."&nbsp;<span class='badge'>[x]</span>";
$EUSER_TEMPLATE['videos_no'] =	IMAGE_videos."&nbsp;<i>".PROFILE_118."</i>";
*/
// Este depois também vai desaparecer.... vvvvvvvvvvvvvvvvv
$EUSER_LIST_TEMPLATE['comments_caption'] =	PROFILE_15."&nbsp;<span class='badge'>[x]</span>";
$EUSER_LIST_TEMPLATE['comments'] =	'<div class="d-flex row">
<hr>
                      <span>'.IMAGE_comment.'&nbsp;'.LAN_USER_68.':</span>
                      <span class="pull-right">{USER_COMMENTPOSTS}
<hr>
                      </div>';
$EUSER_LIST_TEMPLATE['comments_no'] =	IMAGE_comment."&nbsp;<i>".PROFILE_32."</i>";
/*
$EUSER_TEMPLATE['news_caption'] =	"<li><a class='tab-news nav-link' data-bs-toggle='tab' href='#euser-news'>NOTICIAS&nbsp;<span class='badge'>[x]</span></a></li>";
$EUSER_TEMPLATE['news_no'] =	IMAGE_friends."&nbsp;<i>".PROFILE_30."</i>";

$EUSER_TEMPLATE['forum_caption'] =	"<li><a class='tab-forum nav-link' data-bs-toggle='tab' href='#euser-forum'>FORUM&nbsp;<span class='badge'>[x]</span></a></li>";
$EUSER_TEMPLATE['forum_no'] =	IMAGE_friends."&nbsp;<i>".PROFILE_30."</i>";
*/

$EUSER_LIST_TEMPLATE['friends_caption'] =	PROFILE_13."&nbsp;<span class='badge'>{count}</span>";
$EUSER_LIST_TEMPLATE['friends_no'] =	"<div class='container p-4'><div class='card'>
      <div class='card-body alert alert-warning mb-0 text-center'>
".IMAGE_friends."&nbsp;<i>".PROFILE_30."</i>
      </div></div>
    </div>
";
//$EUSER_TEMPLATE['friends_no'] =	IMAGE_friends."&nbsp;<i>".PROFILE_30."</i>";

$EUSER_LIST_TEMPLATE['images_caption'] =	PROFILE_14."&nbsp;<span class='badge'>{count}</span>";
$EUSER_LIST_TEMPLATE['images_no'] =	"<div class='container p-4'><div class='card'>
      <div class='card-body alert alert-warning mb-0 text-center'>
{txt}
      </div></div>
    </div>
";
//$EUSER_TEMPLATE['images_no'] =	IMAGE_images."&nbsp;<i>".PROFILE_163."</i>";

$EUSER_LIST_TEMPLATE['videos_caption'] =	PROFILE_113."&nbsp;<span class='badge'>{count}</span>";
$EUSER_LIST_TEMPLATE['videos_no'] =	"<div class='container p-4'><div class='card'>
      <div class='card-body alert alert-warning mb-0 text-center'>
".IMAGE_videos."&nbsp;<i>".PROFILE_118."</i>
      </div></div>
    </div>
";
//$EUSER_TEMPLATE['videos_no'] =	IMAGE_videos."&nbsp;<i>".PROFILE_118."</i>";

$EUSER_LIST_TEMPLATE['plugins_caption'] =	"<li><a class='tab-{plg} nav-link' title='{ttl}' data-bs-toggle='tab' href='#euser-{plg}'>{txt}&nbsp;<small><span class='badge'>{count}</span></small></a></li>";
$EUSER_LIST_TEMPLATE['plugins_no'] =	"<div class='container p-4'><div class='card'>
      <div class='card-body alert alert-warning mb-0 text-center'>
".IMAGE_friends."&nbsp;<i>".PROFILE_30."</i>
      </div></div>
    </div>
";
// Isto só mostra uma linha com os dados e eventualmente um link....
$EUSER_LIST_TEMPLATE['plugins_resume_s']  = '
  <div class="d-flex row rows-col-2 p-2">
    <div class="col-xs-12 col-md-4">{LAN=USER_59}:</div><div class="col-xs-12 col-md-8">{USER_JOIN}<br><small class="fst-italic">({USER_DAYSREGGED})</small></div>
    <div class="col-xs-12 col-md-4">{LAN=USER_66}:</div><div class="col-xs-12 col-md-8">{USER_VISITS}</div>
    <div class="col-xs-12 col-md-4">{LAN=USER_65}:</div><div class="col-xs-12 col-md-8">{USER_LASTVISIT}<br><small class="fst-italic">({USER_LASTVISIT_LAPSE})</small></div>
    <div class="w-100"><hr></div>
';
$EUSER_LIST_TEMPLATE['plugins_resume']  = '
    <div class="col-xs-12 col-md-4">{EUSER_ADDON_ICON}&nbsp;{EUSER_ADDON_LABEL}</div><div class="col-xs-12 col-md-8">{EUSER_ADDON_TEXT}</div>
';
$EUSER_LIST_TEMPLATE['plugins_resume_e']  = '
  </div>
';
$EUSER_LIST_TEMPLATE['plugins']  = '
<div id="euser-{PLG}" class="tab-pane fade" role="tabpanel">
  <div class="container p-4">
    <div class="card">
      <div class="card-body alert alert-warning mb-0 text-center">
        EM CONSTRUÇÃO
      </div>
    </div>
  </div>
</div>';

$EUSER_LIST_TEMPLATE['plugins_forum']  = '
<div id="euser-forum" class="tab-pane fade in" role="tabpanel">

{EUSER_FORUM}


  <div class="container pt-4">
    <div class="card">
      <div class="card-body alert alert-warning mb-0 text-center">
        EM CONSTRUÇÃO<br>
AQUI VAI APARECER AS MENSAGENS DO FORUM
      </div>
    </div>
  </div>
</div>';

$EUSER_LIST_TEMPLATE['plugins_chatbox_menu']  = '
<div id="euser-chatbox_menu" class="tab-pane fade in" role="tabpanel">
<div class="d-flex row">
  <span>'.IMAGE_chat.'&nbsp;{LAN=USER_67}:</span>
  <span class="pull-right">{USER_CHATPOSTS}{USER_CHATPER}</span>
</div>
</div>';
