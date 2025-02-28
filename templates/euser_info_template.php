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

//			e107::lan('eforum');
// Templates for SC User info panel
$EUSER_INFO_TEMPLATE['news']['inline'] =  '
<span class="d-inline-flex align-items-center">{LAN=LAN_AUTHOR}:&nbsp;<span class="d-flex" data-bs-original-title="{LAN=USER_50}: {NEWS_AUTHOR=nolink}" title="{LAN=USER_50}: {NEWS_AUTHOR=nolink}">
{SETIMAGE: w=16&h=16&crop=1}
{NEWS_AUTHOR_AVATAR: shape=rounded&class=user-avatar&placeholder=1} {NEWS_AUTHOR}</span></span>
';

// USO O ESUER_NEWS para ter a contagem das noticias porque o core não tem essa função...

$EUSER_INFO_WRAPPER['news']['panel']['NEWS_AUTHOR_AVATAR'] = '<div class="post-by-author-avatar container">{---}</div>';
$EUSER_INFO_WRAPPER['news']['panel']['NEWS_AUTHOR_SIGNATURE'] = '<div class="post-by-author-signature">{---}</div>';
$EUSER_INFO_WRAPPER['news']['panel']['EUSER_NEWS'] = "<a class='btn btn-xs bd-blue-100' title='{LAN=PROFILE_38}{EUSER_NEWS}' href='{NEWS_AUTHOR_ITEMS_URL}'>{GLYPH:type=fa-newspaper}{LAN=PLUGIN_NEWS_NAME}<span class='badge'>{---}</span></a>";
$EUSER_INFO_WRAPPER['news']['panel']['EUSER_POSTS'] = "<a href='{EUSER_POSTS:url=1}' class='btn btn-xs bd-teal-100' title='{LAN=PROFILE_213}: {EUSER_POSTS}'>{GLYPH:type=fa-comments}{LAN=PROFILE_389}<span class='badge'>{---}</span></a>";

$EUSER_INFO_TEMPLATE['news']['panel'] =  '
        <div class="row m-0 author-info">
          <div class="col post-by-author-inner g-0">
            <div class="row m-0 g-0">
              <div class="col-auto">
                {SETIMAGE: w=75&h=75&crop=1}
                 <a class="author-avatar {EUSER_ONLINE:class=1}" href="{NEWS_AUTHOR:link=1}" data-bs-original-title="{LAN=USER_50} {NEWS_AUTHOR=nolink} {EUSER_ONLINE:text=1}" title="{LAN=USER_50} {NEWS_AUTHOR=nolink} {EUSER_ONLINE:text=1}">
                  {NEWS_AUTHOR_AVATAR: shape=rounded&class=me-3 user-avatar&placeholder=1}
                </a>
              </div> 
              <div class="col">                 
	              <div class="post-by-author-body">
                  <h6><span data-bs-original-title="{LAN=USER_50} {NEWS_AUTHOR=nolink} {EUSER_ONLINE:text=1}" title="{LAN=USER_50} {NEWS_AUTHOR=nolink} {EUSER_ONLINE:text=1}">{NEWS_AUTHOR}</span></h6>
                  {NEWS_AUTHOR_SIGNATURE}
                  <div class="small-text">
                    {LAN=PROFILE_390}
                    {EUSER_NEWS}
                    {EUSER_POSTS}
                  </div>
                  <div class="small-text pt-1">
                    {EUSER_PMUSER}
                  </div>
                </div> 
              </div> 
            </div> 
          </div> 
        </div> 
                ';


$EUSER_INFO_WRAPPER['forum']['panel']['CUSTOMTITLE'] = "<span class='forum-viewtopic-customtitle'><small>{---}</small></span>";
$EUSER_INFO_WRAPPER['forum']['panel']['EUSER_NEWS'] = "<a class='btn btn-xs bd-blue-100' title='{LAN=PROFILE_38} {EUSER_NEWS}' href='{EUSER_NEWS:url=1}'>{GLYPH:type=fa-newspaper}{LAN=PLUGIN_NEWS_NAME}<span class='badge'>{---}</span></a>";
$EUSER_INFO_WRAPPER['forum']['panel']['EUSER_POSTS'] = "<a href='{EUSER_POSTS:url=1}' class='btn btn-xs bd-teal-100' title='{LAN=PROFILE_213}: {EUSER_POSTS}'>{GLYPH:type=fa-comments}{LAN=PROFILE_389}<span class='badge'>{---}</span></a>";
$EUSER_INFO_WRAPPER['forum']['panel']['EUSER_FORUM_COMBO'] = "<div class='col-12 d-block'>{---}</div>";
$EUSER_INFO_WRAPPER['forum']['panel']['CUSTOMTITLE'] = "<div class='col-12 d-block'>{---}</div>";
$EUSER_INFO_WRAPPER['forum']['panel']['AVATAR'] = '<div class="post-by-author-avatar container">{---}</div>';

$EUSER_INFO_TEMPLATE['forum']['panel'] =  "
  <div class='row d-flex author-info'>
    <div class='col-12 text-center mb-2'>
      {SETIMAGE: w=100&h=100&crop=1}
      <a href='{POSTER:link=1}' data-bs-original-title='{LAN=USER_50} {POSTER:name=1} {EUSER_ONLINE:text=1}' title='{LAN=USER_50} {POSTER:name=1} {EUSER_ONLINE:text=1}' class='poster-avatar {EUSER_ONLINE:class=1}'>
        {AVATAR: shape=rounded}
        <div>{EUSER_DATA}</div>
      </a>
    </div>
    {EUSER_FORUM_COMBO}
    {CUSTOMTITLE}
    <div class='col-12 hidden-xs text-start'>
      {NEWFLAG: class=1} {ANON_IP}
    </div>
    <div class='col-12 hidden-xs'>
      <small>
        {LEVEL=badge} {LEVEL=glyph}
      </small>
    </div>
    <div class='col-12 hidden-xs small-text mb-1'>
      <small>
        {LAN=PROFILE_390}<br>
      </small>
        {EUSER_POSTS}
        {EUSER_NEWS}
    </div>
    <div class='col-12 hidden-xs align-self-end'>
      <div class='small-text pt-1'>
        {EUSER_PMUSER}
      </div>
    </div>
  </div>
";