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

// vvvvvvvv Antigo, estava no euser. Será para quê?
	$EXTENDED_CATEGORY_START = "<tr><td colspan='2' class='forumheader' style='text-align:left'>{EXTENDED_NAME}</td></tr>";
	$EXTENDED_CATEGORY_TABLE = "
		<tr><td class='forumheader3'>{EXTENDED_ICON}&nbsp;{EXTENDED_NAME}</td><td class='forumheader3'>{EXTENDED_VALUE}</td></tr>
		";
	$EXTENDED_END = "";
	$sc_style['USER_COMMENTS_LINK']['pre'] = "<tr><td colspan='2' class='forumheader3' style='text-align:left'>";
	$sc_style['USER_COMMENTS_LINK']['post'] = "</td></tr>";
	$sc_style['USER_FORUM_LINK']['pre'] = "<tr><td colspan='2' class='forumheader3' style='text-align:left'>";
	$sc_style['USER_FORUM_LINK']['post'] = "</td></tr>";
// ^^^^^^^^ Antigo, estava no euser. Será para quê?

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
// Novo caso seja aprovado o pull  $EUSER_TEMPLATE['caption'] =	"<a href='{EUSER_SETTINGS:link}' title='{EUSER_SETTINGS:title}'>{EUSER_ONLINE}&nbsp;".LAN_EUSER_001009."&nbsp;#{USER_ID}&nbsp;".LAN_EUSER_4013." : {USER_NAME} ({USER_LOGINNAME})</a><span class='pull-right'>{USER_JUMP_LINK:prev&class=btn btn-small}{USER_JUMP_LINK:next&class=btn btn-small}</span>";

  $EUSER_TEMPLATE['controls_logged'] =	"{EUSER_SETTINGS:class='btn btn-sm btn-default'}";
//  $EUSER_TEMPLATE['controls_logged'] =	"{USER_UPDATE_LINK}";

  $EUSER_TEMPLATE['controls'] =	"{EUSER_ADDFRIEND}<br>{EUSER_SENDPM}";

$EUSER_WRAPPER['main']['USER_LEVEL'] = "<div>
		  <span>{USER_ICON=level} ".LAN_USER_54.":</span>
		  <span class='pull-right'>{---}</span>
      </div>";
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

// SÓ TEXTO
//$EUSER_WRAPPER['main']['EUSER_SETTINGLINK'] = "{---}".PROFILE_17."</a>"
//USANDO O AVATAR...
//$EUSER_WRAPPER['main']['EUSER_AVATAR']= "<div style='text-align: center; vertical-align: middle; min-width: {EUSER_AVATARMINW}px;'>{---}</div><br>";
$EUSER_WRAPPER['main']['EUSER_AVATAR'] = "<div style='text-align: center; vertical-align: middle; min-width: {EUSER_AVATARMINW}px;'><a href='{EUSER_SETTINGS:link}' title='{EUSER_SETTINGS:title}'>{---}</a></div><br>";

$EUSER_WRAPPER['main']['EUSER_COMMENTS:caption'] = "<li><a data-toggle='tab' href='#euser_comments'>{---}</a></li>";
$EUSER_WRAPPER['main']['EUSER_FRIENDS:caption'] = "<li><a data-toggle='tab' href='#euser_friends'>{---}</a></li>";
$EUSER_WRAPPER['main']['EUSER_IMAGES:caption'] = "<li><a data-toggle='tab' href='#euser_images'>{---}</a></li>";
$EUSER_WRAPPER['main']['EUSER_VIDEOS:caption'] = "<li><a data-toggle='tab' href='#euser_videos'>{---}</a></li>";

//$EUSER_WRAPPER['main']['EUSER_COMMENTS:'] = "<div id='euser_comments' class='tab-pane fade panel-body'>{---}</div>";
$EUSER_WRAPPER['main']['PROFILE_COMMENTS'] = "<div id='euser_comments' class='tab-pane fade panel-body'>{---}</div>";
$EUSER_WRAPPER['main']['EUSER_FRIENDS:'] = "<div id='euser_friends' class='tab-pane fade panel-body'>{---}</div>";
$EUSER_WRAPPER['main']['EUSER_IMAGES:'] = "<div id='euser_images' class='tab-pane fade panel-body'>{---}</div>";
$EUSER_WRAPPER['main']['EUSER_VIDEOS:'] = "<div id='euser_videos' class='tab-pane fade panel-body'>{---}</div>";

$EUSER_TEMPLATE['plugins']  = '<div><span>{EUSER_ADDON_ICON}&nbsp;{EUSER_ADDON_LABEL}:</span>
			<span class="pull-right">{EUSER_ADDON_TEXT}</span></div>';

$EUSER_TEMPLATE['main'] =	"{EUSER_BGIMAGE}
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

// Alternativa {EUSER_ADDFRIEND:icon=fa-addfriend}

$EUSER_TEMPLATE['comments_caption'] =	PROFILE_15."&nbsp;<span class='badge'>[x]</span>";
$EUSER_TEMPLATE['comments_no'] =	IMAGE_comment."&nbsp;<i>".PROFILE_32."</i>";

$EUSER_TEMPLATE['friends_caption'] =	PROFILE_13."&nbsp;<span class='badge'>[x]</span>";
$EUSER_TEMPLATE['friends_no'] =	IMAGE_friends."&nbsp;<i>".PROFILE_30."</i>";

$EUSER_TEMPLATE['images_caption'] =	LAN_EUSER_650."&nbsp;<span class='badge'>[x]</span>";
$EUSER_TEMPLATE['images_no'] =	IMAGE_images."&nbsp;<i>".PROFILE_163."</i>";

$EUSER_TEMPLATE['videos_caption'] =	PROFILE_113."&nbsp;<span class='badge'>[x]</span>";
$EUSER_TEMPLATE['videos_no'] =	IMAGE_videos."&nbsp;<i>".PROFILE_118."</i>";

?>
