<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2013 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * REPLACES OLD MEMBER_TEMPLATE????
 *
 */

if (!defined('e107_INIT')) { exit(); }
//			e107::lan('eforum');

// ########## STANDARD COMMON INLINE ##############
$EUSER_INFO_TEMPLATE['inline'] ='
<a class="{EUSER_ONLINE:class=1} align-middle" href="{EUSER_DATA:link=1}" title="{LAN=USER_50} {EUSER_DATA} {EUSER_ONLINE:text=1}" class="poster-avatar e-tip {EUSER_ONLINE:class=1}">
{SETIMAGE: w=16&h=16&crop=1}
{EUSER_AVATAR: shape=rounded&class=user-avatar border border-1&placeholder=1} {EUSER_DATA}
</a>
';

$EUSER_INFO_TEMPLATE['doubleinline'] ='
<a class="{EUSER_ONLINE:class=1} align-middle" href="{EUSER_DATA:link=1}" title="{LAN=USER_50} {EUSER_DATA} {EUSER_ONLINE:text=1}" class="poster-avatar e-tip {EUSER_ONLINE:class=1}">
{SETIMAGE: w=32&h=32&crop=1}
{EUSER_AVATAR: shape=rounded&class=user-avatar border border-1&placeholder=1} {EUSER_DATA}
</a>      {EUSER_LEVEL=glyph}

';

// ***************** STANDARD COMMON PANEL (VERTICAL) *****************
$EUSER_INFO_WRAPPER['panel']['EUSER_AVATAR'] = "
    <div class='col-12'>
<a href='{EUSER_DATA:link=1}' title='{LAN=USER_50} {EUSER_DATA} {EUSER_ONLINE:text=1}' class='poster-avatar e-tip {EUSER_ONLINE:class=1}'>
  <div class='post-by-author-avatar container'>
    {---}
  </div>
  <div>{EUSER_DATA}</div>
</a>
    </div>
  ";
$EUSER_INFO_WRAPPER['panel']['EUSER_NEWS'] = "<a class='btn btn-xs bd-blue-100 e-tip me-1' title='{LAN=LAN_EUSER_505}{EUSER_NEWS}' href='{NEWS_AUTHOR_ITEMS_URL}'>{GLYPH:type=fa-newspaper}{LAN=PLUGIN_NEWS_NAME}<span class='badge'>{---}</span></a>";
$EUSER_INFO_WRAPPER['panel']['EUSER_POSTS'] = "<a href='{EUSER_POSTS:url=1}' class='btn btn-xs bd-teal-100 e-tip' title='{LAN=LAN_EUSER_504}: {EUSER_POSTS}'>{GLYPH:type=fa-comments}{LAN=LAN_EUSER_506}<span class='badge'>{---}</span></a>";
$EUSER_INFO_WRAPPER['panel']['EUSER_LEVEL'] = "<small class='e-tip' title='{EUSER_LEVEL}'>{---}</small>";
$EUSER_INFO_WRAPPER['panel']['USER_SENDPM'] = '<div class="pt-1 d-print-none">{---}</div>';

$EUSER_INFO_TEMPLATE['panel'] = '
  <div class="row d-flex author-info text-center">
      {EUSER_AVATAR: shape=rounded&w=100&h=100&crop=1}
    <div class="col-12">
    {CUSTOMTITLE}
    </div>
    <div class="col-12 hidden-xs">
      {EUSER_LEVEL=glyph}
    </div>
    <div id="user_activity" class="col-12 hidden-xs small-text mb-1 d-print-none">
      {LAN=LAN_EUSER_503}<br>
      {EUSER_NEWS}
      {EUSER_POSTS}
    </div>
    {USER_SENDPM}
  </div>
                ';


// ***************** FORUM PANEL (VERTICAL) *****************
$EUSER_INFO_WRAPPER['forumpanel']['CUSTOMTITLE'] = "<span class='forum-viewtopic-customtitle'><small>{---}</small></span>";
$EUSER_INFO_WRAPPER['forumpanel']['EUSER_NEWS'] = "<a class='btn btn-xs bd-blue-100 e-tip' title='{LAN=LAN_EUSER_505} {EUSER_NEWS}' href='{EUSER_NEWS:url=1}'>{GLYPH:type=fa-newspaper}{LAN=PLUGIN_NEWS_NAME}<span class='badge'>{---}</span></a>";
$EUSER_INFO_WRAPPER['forumpanel']['EUSER_POSTS'] = "<a href='{EUSER_POSTS:url=1}' class='btn btn-xs bd-teal-100 e-tip' title='{LAN=LAN_EUSER_504}: {EUSER_POSTS}'>{GLYPH:type=fa-comments}{LAN=LAN_EUSER_506}<span class='badge'>{---}</span></a>";
$EUSER_INFO_WRAPPER['forumpanel']['EUSER_FORUM_COMBO'] = "<div class='col-12 d-block'>{---}</div>";
$EUSER_INFO_WRAPPER['forumpanel']['CUSTOMTITLE'] = "<div class='col-12 d-block'>{---}</div>";
$EUSER_INFO_WRAPPER['forumpanel']['EUSER_AVATAR'] = "
    <div class='col-12 text-center mb-1'>
<a href='{POSTER:link=1}' title='{LAN=USER_50} {POSTER:name=1} {EUSER_ONLINE:text=1}' class='poster-avatar e-tip {EUSER_ONLINE:class=1}'>
  <div class='post-by-author-avatar container'>
    {SETIMAGE: w=100&h=100&crop=1}
    {---}
  </div>
  <div>{EUSER_DATA}</div>
</a>
    </div>
  ";
$EUSER_INFO_WRAPPER['forumpanel']['USER_SENDPM'] = '<div class="col-12 hidden-xs align-self-end"><div class="pt-1 d-print-none">{---}</div></div>';
//Uso o do forum porque tem mais alguams coisas no level....
$EUSER_INFO_WRAPPER['forumpanel']['LEVEL'] = "<small class='e-tip' title='{LEVEL}'>{---}</small>";

$EUSER_INFO_TEMPLATE['forumpanel'] =  "
  <div class='row d-flex poster-info'>
    {EUSER_AVATAR: shape=rounded}
    {CUSTOMTITLE}
    <div class='col-12 hidden-xs text-start'>
      {NEWFLAG: class=1} {ANON_IP}
    </div>
    <div class='col-12 hidden-xs mb-1'>
      {LEVEL=glyph}
    </div>
    <div id='user_activity' class='col-12 hidden-xs small-text mb-1 d-print-none'>
        {LAN=LAN_EUSER_503}<br>
        {EUSER_POSTS}
        {EUSER_NEWS}
    </div>
    {USER_SENDPM}
  </div>
";

// ***************** NEWS PANEL (HORIZONTAL) *****************
// USO O ESUER_NEWS para ter a contagem das noticias porque o core não tem essa função...
// Não sei porquÊ o NEWS_AUTHOR_AVATAR não funciona...
$EUSER_INFO_WRAPPER['newspanel']['EUSER_AVATAR'] = '
                <a class="author-avatar e-tip {EUSER_ONLINE:class=1}" href="{NEWS_AUTHOR:link=1}" title="{LAN=USER_50} {NEWS_AUTHOR:nolink=1} {EUSER_ONLINE:text=1}">
<div class="post-by-author-avatar container">
                  {---}
                  </div>
                </a>
';
$EUSER_INFO_WRAPPER['newspanel']['NEWS_AUTHOR_SIGNATURE'] = '<div class="post-by-author-signature">{---}</div>';
$EUSER_INFO_WRAPPER['newspanel']['EUSER_NEWS'] = "<a class='btn btn-xs bd-blue-100 e-tip' title='{LAN=LAN_EUSER_505}{EUSER_NEWS}' href='{NEWS_AUTHOR_ITEMS_URL}'>{GLYPH:type=fa-newspaper}{LAN=PLUGIN_NEWS_NAME}<span class='badge'>{---}</span></a>";
$EUSER_INFO_WRAPPER['newspanel']['EUSER_POSTS'] = "<a href='{EUSER_POSTS:url=1}' class='btn btn-xs bd-teal-100 e-tip' title='{LAN=LAN_EUSER_504}: {EUSER_POSTS}'>{GLYPH:type=fa-comments}{LAN=LAN_EUSER_506}<span class='badge'>{---}</span></a>";

$EUSER_INFO_WRAPPER['newspanel']['EUSER_LEVEL'] = "<small class='e-tip' title='{EUSER_LEVEL}'>{---}</small>";
$EUSER_INFO_WRAPPER['newspanel']['USER_SENDPM'] = '<div class="pt-1 d-print-none">{---}</div>';

$EUSER_INFO_TEMPLATE['newspanel'] =  '
  <div class="row m-0 author-info post-by-author-inner">
    <div class="col-auto g-0">
      {EUSER_AVATAR: shape=rounded&class=me-3 user-avatar&placeholder=1&w=100&h=100}
    </div> 
              <div class="col">                 
	              <div class="post-by-author-body">
                  <div class="row">
                    <div class="col-auto">
                      <h6 class="e-tip" title="{LAN=USER_50} {NEWS_AUTHOR:nolink=1} {EUSER_ONLINE:text=1}">{NEWS_AUTHOR}</h6>
                    </div>
                    <div class="col">
                      {EUSER_LEVEL=glyph}
                    </div>
                  </div>
                  {NEWS_AUTHOR_SIGNATURE}
                  <div id="user_activity" class="small-text d-print-none">
                    {LAN=LAN_EUSER_503}: {EUSER_NEWS}{EUSER_POSTS}
                  </div>
                  {USER_SENDPM}
                </div> 
          </div> 
        </div> 
                ';