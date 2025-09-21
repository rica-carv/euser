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

$tp = e107::getParser();
//if(deftrue("FONTAWESOME", false)) {
if(defined("FONTAWESOME")) {
//var_dump(IMAGE_alert);
define('IMAGE_alert', 				"{GLYPH:type=fa-exclamation-triangle}");
define('IMAGE_bigalert', 			"{GLYPH:type=fa-exclamation-triangle&size=2x}");
define('IMAGE_online', 				"{GLYPH:type=fa-power-off&class=text-success}");
// No tema tem de ser isto... define('IMAGE_online', 				"{GLYPH:type=off&class=text-success famicon}");
define('IMAGE_offline', 			"{GLYPH:type=fa-power-off&class=text-danger}");
define('IMAGE_registration', 		"{GLYPH:type=fa-registered}");
define('IMAGE_visits', 				"{GLYPH:type=fa-sign-in}");
define('IMAGE_lastvisit', 			"{GLYPH:type=fa-hourglass}");
define('IMAGE_chat', 				"{GLYPH:type=fa-commenting}");
define('IMAGE_comment', 			"{GLYPH:type=fa-comment}");
define('IMAGE_friends', 			"{GLYPH:type=fa-user-group}");
define('IMAGE_images', 				"{GLYPH:type=fa-images}");
define('IMAGE_videos', 				"{GLYPH:type=fa-film}");
define('IMAGE_forum', 				"{GLYPH:type=fa-comments-o}");
define('IMAGE_news', 				"{GLYPH:type=fa-newspaper-o}");
define('IMAGE_new', 				"{GLYPH:type=fa-certificate}");
define('IMAGE_upload', 				"{GLYPH:type=fa-upload}");
define('IMAGE_logout', 				"{GLYPH:type=fa-sign-out}");
define('IMAGE_admin', 				"{GLYPH:type=fa-cogs}");
define('IMAGE_settings', 			"{GLYPH:type=fa-pen-to-square}");
define('IMAGE_addfriend', 			"{GLYPH:type=fa-user-plus}");
define('IMAGE_colourkey', 			"{GLYPH:type=fa-circle-info}");
define('IMAGE_user', 				"{GLYPH:type=fa-user}");
define('IMAGE_users', 				"{GLYPH:type=fa-users}");
define('IMAGE_guest', 			    "{GLYPH:type=fa-user-secret}");

define('IMAGE_download', 			"{GLYPH:type=fa-download}");
define('IMAGE_download_up',			"{GLYPH:type=fa-upload}");
define('IMAGE_links', 				"{GLYPH:type=fa-link}");

} else {

// Thread info
define('IMAGE_alert', 				$tp->toImage(e_IMAGE_ABS.'icons/important_16.png"', array('alt'=>LAN_EUSER_500)));
define('IMAGE_bigalert', 			$tp->toImage(e_IMAGE_ABS.'icons/important_32.png"', array('alt'=>LAN_EUSER_501)));
define('IMAGE_online', 				"{GLYPH:type=off&class=text-success}");
define('IMAGE_offline', 			"{GLYPH:type=off&class=text-danger}");
define('IMAGE_registration', 		"{GLYPH:type=fa-registered}");
define('IMAGE_visits', 				"{GLYPH:type=fa-sign-in}");
define('IMAGE_lastvisit', 			"{GLYPH:type=fa-hourglass}");
define('IMAGE_chat', 				"{GLYPH:type=fa-commenting}");
define('IMAGE_comment', 			"{GLYPH:type=fa-comment}");
define('IMAGE_images', 				"{GLYPH:type=fa-picture-o}");
define('IMAGE_videos', 				"{GLYPH:type=fa-video-camera}");
define('IMAGE_forum', 				"{GLYPH:type=fa-comments-o}");
define('IMAGE_news', 				"{GLYPH:type=fa-newspaper-o}");
define('IMAGE_new', 				"{GLYPH:type=certificate}");
//define('IMAGE_e', 					'<img src="'.img_path('e.png').'" alt="" title="" />');
define('IMAGE_upload', 				'<img src="'.img_path('new.png').'" alt="'.LAN_FORUM_4001.'" title="'.LAN_FORUM_4001.'" />');
define('IMAGE_logout', 				'<img src="'.img_path('new.png').'" alt="'.LAN_FORUM_4001.'" title="'.LAN_FORUM_4001.'" />');
define('IMAGE_admin', 				'<img src="'.img_path('new.png').'" alt="'.LAN_FORUM_4001.'" title="'.LAN_FORUM_4001.'" />');
define('IMAGE_settings', 			"{GLYPH:type=pen-to-square}");
define('IMAGE_friends', 			'<img src="'.img_path('new.png').'" alt="'.LAN_FORUM_4001.'" title="'.LAN_FORUM_4001.'" />');
define('IMAGE_addfriend', 			"<span class='fa-groupstack'>{GLYPH:type=user}{GLYPH:type=plus}</span>");
define('IMAGE_colourkey', 			'<img src="'.img_path('new.png').'" alt="'.LAN_FORUM_4001.'" title="'.LAN_FORUM_4001.'" />');
define('IMAGE_user', 				'<img src="'.img_path('new.png').'" alt="'.LAN_FORUM_4001.'" title="'.LAN_FORUM_4001.'" />');
define('IMAGE_users', 				"<span class='fa-groupstack'>{GLYPH:type=user}{GLYPH:type=user}</span>");
define('IMAGE_guest', 				'<img src="'.img_path('new.png').'" alt="'.LAN_FORUM_4001.'" title="'.LAN_FORUM_4001.'" />');
}