<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2013 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Forum icons template - default
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
$EUSER_WRAPPER['caption']['USER_LOGINNAME'] = " ({---})"; // LOGIN_NAME só aparece se quem estiver a ver for admin

$EUSER_WRAPPER['caption']['USER_ID'] = " #{---}&nbsp;"; // LOGIN_NAME só aparece se quem estiver a ver for admin

$EUSER_TEMPLATE['caption'] =	"
    <div class='row'>
      <div class='col'>
        <h1>{LAN=USER_50}&nbsp;{USER_ID}: {USER_NAME}{USER_LOGINNAME}</h1>
      </div>
      <div class='col-auto pull-end text-end'>
        <div class='pager user-view-nextprev'>
    	    {USER_JUMP_LINK:prev&class=btn btn-default}{USER_JUMP_LINK:next&class=btn btn-default}
        </div>
      </div>
    </div>
";
// Novo caso seja aprovado o pull  $EUSER_TEMPLATE['caption'] =	"<a href='{EUSER_SETTINGS:link}' title='{EUSER_SETTINGS:title}'>{EUSER_ONLINE}&nbsp;".LAN_EUSER_001009."&nbsp;#{USER_ID}&nbsp;".LAN_EUSER_4013." : {USER_NAME} ({USER_LOGINNAME})</a><span class='pull-right'>{USER_JUMP_LINK:prev&class=btn btn-small}{USER_JUMP_LINK:next&class=btn btn-small}</span>";

//$EUSER_TEMPLATE['controls_logged'] =	"{EUSER_SETTINGS:class='btn btn-sm btn-primary'}";
//  $EUSER_TEMPLATE['controls_logged'] =	"{USER_UPDATE_LINK}";

$EUSER_TEMPLATE['controls'] =	"{USER_SENDPM:glyph=envelope}{EUSER_ADDFRIEND}";

/*$EUSER_WRAPPER['main']['USER_LEVEL'] = "<div>
		  <span>{USER_ICON=level} ".LAN_USER_54.":</span>
		  <span class='pull-right'>{---}</span>
      </div>";
*/
//$EUSER_WRAPPER['main']['EUSER_AVATAR']= "<div style='text-align: center; vertical-align: middle; min-width: {EUSER_AVATARMINW}px;'>{---}</div><br>";
//$EUSER_WRAPPER['main']['USER_RATING']= "{---}<br>";
//$EUSER_WRAPPER['main']['SENDPM'] = "<tr><td class='forumheader3'><div class='f-left'>".LAN_USER_62.":</div><div class='f-right'>{---}</div></td></tr>";
//$EUSER_WRAPPER['main']['SENDPM'] = "<div><center>{---}</center></div>";
$EUSER_WRAPPER['main']['USER_RATING'] = "<tr><td class='forumheader3'><div class='f-left'>".LAN_RATING."</div><div class='f-right'>{---}</div></td></tr>";
$EUSER_WRAPPER['main']['USER_SIGNATURE'] = "<tr><td class='forumheader3 left'>{---}</td></tr>";
$EUSER_WRAPPER['main']['USER_EXTENDEDALL'] = "<tr><td class='forumheader3 left'>{---}</td></tr>";
/*
$EUSER_WRAPPER['main']['EUSER_NEWS:'] = "<span>".IMAGE_news."&nbsp;".LAN_EUSER_600."</span><span class='pull-right'>{---}";
$EUSER_WRAPPER['main']['EUSER_UPLOADS:'] = "<span><img src='images/news.png'>&nbsp;".LAN_EUSER_601."&nbsp;&nbsp;</span><span class='pull-right'>{---}";
$EUSER_WRAPPER['main']['EUSER_DOWNLOADS:'] = "<span><img src='images/news.png'>&nbsp;".LAN_EUSER_602."&nbsp;&nbsp;</span><span class='pull-right'>{---}";
$EUSER_WRAPPER['main']['EUSER_LINKS:'] = "<span><img src='images/news.png'>&nbsp;".LAN_EUSER_603."&nbsp;&nbsp;</span><span class='pull-right'>{---}";
$EUSER_WRAPPER['main']['USER_CHATPER'] = $EUSER_WRAPPER['main']['USER_COMMENTPER'] = $EUSER_WRAPPER['main']['USER_FORUMPER'] = $EUSER_WRAPPER['main']['EUSER_NEWS:percent'] = $EUSER_WRAPPER['main']['EUSER_UPLOADS:percent'] = $EUSER_WRAPPER['main']['EUSER_DOWNLOADS:percent'] = $EUSER_WRAPPER['main']['EUSER_LINKS:percent'] = " ( {---}% )</span>";
*/
$EUSER_WRAPPER['main']['USER_CHATPER'] = $EUSER_WRAPPER['main']['USER_COMMENTPER'] = $EUSER_WRAPPER['main']['USER_FORUMPER'] = " ( {---}% )</span>";

$EUSER_WRAPPER['main']['EUSER_MP3'] = "<div><span>".PROFILE_416.":</span><span class='pull-right'>{---}</span></div>";

// S� TEXTO
//$EUSER_WRAPPER['main']['EUSER_SETTINGLINK'] = "{---}".PROFILE_17."</a>"
//USANDO O AVATAR...
//$EUSER_WRAPPER['main']['EUSER_AVATAR']= "<div style='text-align: center; vertical-align: middle; min-width: {EUSER_AVATARMINW}px;'>{---}</div><br>";
$EUSER_WRAPPER['main']['EUSER_AVATAR'] = "<div style='text-align: center; vertical-align: middle; min-width: {EUSER_AVATARMINW}px;'><a href='{EUSER_SETTINGS:link}' title='{EUSER_SETTINGS:title}'>{---}</a></div><br>";

//$EUSER_WRAPPER['main']['EUSER_COMMENTS:caption'] = "<li><a data-toggle='tab' href='#euser_comments'>{---}</a></li>";
//$EUSER_WRAPPER['main']['EUSER_FRIENDS:caption'] = "<li><a data-toggle='tab' href='#euser_friends'>{---}</a></li>";
//$EUSER_WRAPPER['main']['EUSER_IMAGES:caption'] = "<li><a data-toggle='tab' href='#euser_images'>{---}</a></li>";
//$EUSER_WRAPPER['main']['EUSER_VIDEOS:caption'] = "<li><a data-toggle='tab' href='#euser_videos'>{---}</a></li>";
$EUSER_WRAPPER['main']['EUSER_COMMENTS:caption'] = "<li><a class='tab-comments nav-link' data-bs-toggle='tab' href='#euser-comments'>{---}</a></li>";
$EUSER_WRAPPER['main']['EUSER_FRIENDS:caption'] = "<li><a class='tab-friends nav-link' data-bs-toggle='tab' href='#euser-friends'>{---}</a></li>";
$EUSER_WRAPPER['main']['EUSER_IMAGES:caption'] = '<li><a class="tab-images nav-link" data-bs-toggle="tab" href="#euser-images">{---}</a></li>';
$EUSER_WRAPPER['main']['EUSER_VIDEOS:caption'] = '<li><a class="tab-videos nav-link" data-bs-toggle="tab" href="#euser-videos">{---}</a></li>';
$EUSER_WRAPPER['main']['EUSER_FRIENDS:'] = "<div id='euser-friends' class='tab-pane fade panel-body'>{---}</div>";
$EUSER_WRAPPER['main']['EUSER_IMAGES:'] = "<div id='euser-images' class='tab-pane fade panel-body'>{---}</div>";
$EUSER_WRAPPER['main']['EUSER_VIDEOS:'] = "<div id='euser-videos' class='tab-pane fade panel-body'>{---}</div>";


//$EUSER_WRAPPER['main']['EUSER_COMMENTS:'] = "<div id='euser_comments' class='tab-pane fade panel-body'>{---}</div>";
$EUSER_WRAPPER['main']['PROFILE_COMMENTS'] = "<div id='euser_comments' class='tab-pane fade panel-body'>{---}</div>";

	// View shortcode wrappers.
	$USER_WRAPPER['main']['USER_COMMENTPOSTS']      = '<div class="col-xs-12 col-md-4">{LAN=USER_68}</div><div class="col-xs-12 col-md-8">{---} ( {USER_COMMENTPER}% )</div>';
//	$USER_WRAPPER['main']['USER_COMMENTPER']        = ' ( {---}% )</div>';
	$USER_WRAPPER['main']['USER_SIGNATURE']         = '<div>{---}</div>';
	$USER_WRAPPER['main']['USER_RATING']            = '<div>{---}</div>';
	$USER_WRAPPER['main']['USER_SENDPM']            = '<div>{---}</div>';
//	$USER_WRAPPER['main']['PROFILE_COMMENTS']       = '<div class="clearfix">{---}</div>';

  
$EUSER_TEMPLATE['main'] =	'
  {EUSER_WARN}
	<div class="euser-profile row">
    <div class="col-md-12">
	    <div class="panel panel-default panel-profile">
	      <div class="panel-body">
	        <div class="row border-0">
            <div class="col-auto text-center">
              {SETIMAGE: w=200&h=200&crop=1}
              <div class="{EUSER_ONLINE:class=1}" data-bs-original-title="{EUSER_ONLINE:text=2}" title="{EUSER_ONLINE:text=2}">
                {USER_PICTURE: shape=circle&link=1&class=mt-0 image-circle user-avatar}
              </div>
            <div class="d-grid gap-2 text-center">
         	    <!-- Controls -->
              {EUSER_CONTROLS}
	            <!-- End Controls -->
	          </div>
            </div>
            <div class="col ps-0">

              <div class="tabbed-menu">
                <div class="tabbed-menu-body">
                  <div class="tabs-wrapper">
                  <div class="card with-nav-tabs bg-light">
                  <div class="card-header">
                                    <ul class="nav nav-tabs" role="tablist">
                      <li><a class="tab-home active nav-link" data-bs-toggle="tab" href="#euser-home">{LAN=LAN_418}</a></li>
                      <li><a class="tab-1 nav-link" data-bs-toggle="tab" href="#euser-t1">{LAN=EUSERPROFILE_1}</a></li>
                      {EUSER_FRIENDS:caption}
                      {EUSER_IMAGES:caption}
                      {EUSER_VIDEOS:caption}
                      <div class="col">
                        {EUSER_SETTINGS:class=btn btn-sm float-end}
                      </div>
                      </ul>
                    </div>
                  	<div class="card-body bg-white p-0">

                    <div class="tab-content container">
                      <div id="euser-home" class="tab-pane fade in active show" role="tabpanel">
                        <div class="d-flex row rows-col-2">
                          <div class="col-xs-12 col-md-4">{LAN=USER_63}</div><div class="col-xs-12 col-md-8">{USER_REALNAME}</div>
	                        <div class="col-xs-12 col-md-4">{LAN=USER_02}:</div><div class="col-xs-12 col-md-8">{USER_LOGINNAME}</div>
                          <div class="col-xs-12 col-md-4">{LAN=USER_60}</div><div class="col-xs-12 col-md-8">{USER_EMAIL}</div>
	                        <div class="col-xs-12 col-md-4">{LAN=USER_54}:</div><div class="col-xs-12 col-md-8">{USER_LEVEL}</div>
                          {USER_RATING}
                          {USER_SIGNATURE}
                          {EUSER_MP3}
                        </div>
                      </div>
                      <div id="euser-t1" class="tab-pane fade" role="tabpanel">
  <div class="container pt-4">
    <div class="card">
      <div class="card-body alert alert-warning mb-0 text-center">
        EM CONSTRUÇÃO<br>
                            Vou usar para (a maior parte vem do another profiles):
                            - comentário próprio
                            - localização (se existir)
                            - dia de aniversário
                            - país
                            - lingua
                            - endereço site
                            - msn
                            - skype
                            - etc.
      </div>
    </div>
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

	        <div class="row border-0">
            <div class="col p-o">
              <div class="tabbed-menu">
                <div class="tabbed-menu-body">
                  <div class="tabs-wrapper">
                  <div class="card with-nav-tabs bg-info">
                  <div class="card-header">
                    <ul class="nav nav-tabs" role="tablist">
                      <li><a class="tab-resumo active nav-link" data-bs-toggle="tab" href="#euser-resumo">{LAN=EUSERPROFILE_4}</a></li>
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
          <div class="col">
            {USER_EXTENDED_ALL}
          </div>
        </div>
	    </div>
	  </div>
		<!-- Start Comments -->
	  {PROFILE_COMMENTS}
	  <!-- End Comments -->
    {PROFILE_COMMENT_FORM}
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

      <div class='tab-content panel panel-default panel-body'>
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
$EUSER_TEMPLATE['comments_caption'] =	PROFILE_15."&nbsp;<span class='badge'>[x]</span>";
$EUSER_TEMPLATE['comments'] =	'<div class="d-flex row">
<hr>
                      <span>'.IMAGE_comment.'&nbsp;'.LAN_USER_68.':</span>
                      <span class="pull-right">{USER_COMMENTPOSTS}
<hr>
                      </div>';
$EUSER_TEMPLATE['comments_no'] =	IMAGE_comment."&nbsp;<i>".PROFILE_32."</i>";
/*
$EUSER_TEMPLATE['news_caption'] =	"<li><a class='tab-news nav-link' data-bs-toggle='tab' href='#euser-news'>NOTICIAS&nbsp;<span class='badge'>[x]</span></a></li>";
$EUSER_TEMPLATE['news_no'] =	IMAGE_friends."&nbsp;<i>".PROFILE_30."</i>";

$EUSER_TEMPLATE['forum_caption'] =	"<li><a class='tab-forum nav-link' data-bs-toggle='tab' href='#euser-forum'>FORUM&nbsp;<span class='badge'>[x]</span></a></li>";
$EUSER_TEMPLATE['forum_no'] =	IMAGE_friends."&nbsp;<i>".PROFILE_30."</i>";
*/

$EUSER_TEMPLATE['friends_caption'] =	PROFILE_13."&nbsp;<span class='badge'>{count}</span>";
$EUSER_TEMPLATE['friends_no'] =	"<div class='container p-4'><div class='card'>
      <div class='card-body alert alert-warning mb-0 text-center'>
".IMAGE_friends."&nbsp;<i>".PROFILE_30."</i>
      </div></div>
    </div>
";
//$EUSER_TEMPLATE['friends_no'] =	IMAGE_friends."&nbsp;<i>".PROFILE_30."</i>";

$EUSER_TEMPLATE['images_caption'] =	PROFILE_14."&nbsp;<span class='badge'>{count}</span>";
$EUSER_TEMPLATE['images_no'] =	"<div class='container p-4'><div class='card'>
      <div class='card-body alert alert-warning mb-0 text-center'>
{txt}
      </div></div>
    </div>
";
//$EUSER_TEMPLATE['images_no'] =	IMAGE_images."&nbsp;<i>".PROFILE_163."</i>";

$EUSER_TEMPLATE['videos_caption'] =	PROFILE_113."&nbsp;<span class='badge'>{count}</span>";
$EUSER_TEMPLATE['videos_no'] =	"<div class='container p-4'><div class='card'>
      <div class='card-body alert alert-warning mb-0 text-center'>
".IMAGE_videos."&nbsp;<i>".PROFILE_118."</i>
      </div></div>
    </div>
";
//$EUSER_TEMPLATE['videos_no'] =	IMAGE_videos."&nbsp;<i>".PROFILE_118."</i>";

$EUSER_TEMPLATE['plugins_caption'] =	"<li><a class='tab-{plg} nav-link' title='{ttl}' data-bs-toggle='tab' href='#euser-{plg}'>{txt}&nbsp;<small><span class='badge'>{count}</span></small></a></li>";
$EUSER_TEMPLATE['plugins_no'] =	"<div class='container p-4'><div class='card'>
      <div class='card-body alert alert-warning mb-0 text-center'>
".IMAGE_friends."&nbsp;<i>".PROFILE_30."</i>
      </div></div>
    </div>
";
// Isto só mostra uma linha com os doados e eventualmente um link....
$EUSER_TEMPLATE['plugins_resume_s']  = '
  <div class="d-flex row rows-col-2">
    <div class="col-xs-12 col-md-4">{LAN=USER_59}:</div><div class="col-xs-12 col-md-8">{USER_JOIN}<br /><small class="padding-left">{USER_DAYSREGGED}</small></div>
    <div class="col-xs-12 col-md-4">{LAN=USER_66}:</div><div class="col-xs-12 col-md-8">{USER_VISITS}</div>
    <div class="col-xs-12 col-md-4">{LAN=USER_65}:</div><div class="col-xs-12 col-md-8">{USER_LASTVISIT}<br /><small class="padding-left">{USER_LASTVISIT_LAPSE}</small></div>
    <div class="w-100"><hr></div>
';
$EUSER_TEMPLATE['plugins_resume']  = '
    <div class="col-xs-12 col-md-4">{EUSER_ADDON_ICON}&nbsp;{EUSER_ADDON_LABEL}</div><div class="col-xs-12 col-md-8">{EUSER_ADDON_TEXT}</div>
';
$EUSER_TEMPLATE['plugins_resume_e']  = '
  </div>
';
$EUSER_TEMPLATE['plugins']  = '
<div id="euser-{PLG}" class="tab-pane fade" role="tabpanel">
  <div class="container p-4">
    <div class="card">
      <div class="card-body alert alert-warning mb-0 text-center">
        EM CONSTRUÇÃO
      </div>
    </div>
  </div>
</div>';

$EUSER_TEMPLATE['plugins_forum']  = '
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

$EUSER_TEMPLATE['plugins_chatbox_menu']  = '
<div id="euser-chatbox_menu" class="tab-pane fade in" role="tabpanel">
<div class="d-flex row">
  <span>'.IMAGE_chat.'&nbsp;{LAN=USER_67}:</span>
  <span class="pull-right">{USER_CHATPOSTS}{USER_CHATPER}</span>
</div>
</div>';
