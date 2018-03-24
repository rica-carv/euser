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
define('IMAGE_alert', 				$tp->toGlyph('fa-exclamation-triangle'));
define('IMAGE_bigalert', 				$tp->toGlyph('fa-exclamation-triangle', array('size'=>'2x')));
define('IMAGE_online', 				$tp->toGlyph('fa-power-off', array('class'=>'text-success')));
// No tema tem de ser isto... define('IMAGE_online', 				$tp->toGlyph('off', array('class'=>'text-success famicon')));
define('IMAGE_offline', 				$tp->toGlyph('fa-power-off', array('class'=>'text-danger')));
define('IMAGE_registration', 				$tp->toGlyph('fa-registered'));
define('IMAGE_visits', 				$tp->toGlyph('fa-sign-in'));
define('IMAGE_lastvisit', 				$tp->toGlyph('fa-hourglass'));
define('IMAGE_chat', 				$tp->toGlyph('fa-commenting'));
define('IMAGE_comment', 				$tp->toGlyph('fa-comment'));
define('IMAGE_images', 				$tp->toGlyph('fa-photo'));
define('IMAGE_videos', 				$tp->toGlyph('fa-facetime-video'));
define('IMAGE_forum', 				$tp->toGlyph('fa-comments-o'));
define('IMAGE_news', 				$tp->toGlyph('fa-newspaper-o'));
define('IMAGE_new', 				$tp->toGlyph('fa-certificate'));
define('IMAGE_upload', 				$tp->toGlyph('fa-upload'));
define('IMAGE_logout', 				$tp->toGlyph('fa-sign-out'));
define('IMAGE_admin', 				$tp->toGlyph('fa-cogs'));
define('IMAGE_settings', 				$tp->toGlyph('fa-wrench'));
define('IMAGE_friends', 				$tp->toGlyph('fa-user-circle'));
define('IMAGE_addfriend', 				$tp->toGlyph('fa-user-plus'));
define('IMAGE_colourkey', 				$tp->toGlyph('fa-info-circle'));
define('IMAGE_user', 				$tp->toGlyph('fa-user'));
define('IMAGE_users', 				$tp->toGlyph('fa-users'));
define('IMAGE_guest', 			$tp->toGlyph('fa-user-secret'));
/*
define('IMAGE_new_small',  			$tp->toGlyph('fa-star'));
define('IMAGE_nonew_small',  		$tp->toGlyph('fa-comment'));
define('IMAGE_new_popular',  		$tp->toGlyph('fa-comments', 'size=2x'));
define('IMAGE_nonew_popular', 		$tp->toGlyph('fa-comments-o', 'size=2x'));
define('IMAGE_new_popular_small',  	$tp->toGlyph('fa-comments'));
define('IMAGE_nonew_popular_small', $tp->toGlyph('fa-comments-o'));
define('IMAGE_sticky',  			$tp->toGlyph('fa-thumb-tack', 'size=2x'));
define('IMAGE_stickyclosed',  		$tp->toGlyph('fa-lock', 'size=2x'));
define('IMAGE_sticky_small', 		$tp->toGlyph('fa-thumb-tack'));
define('IMAGE_stickyclosed_small',  $tp->toGlyph('fa-lock'));
define('IMAGE_announce',  			$tp->toGlyph('fa-bullhorn', 'size=2x'));
define('IMAGE_announce_small',  	$tp->toGlyph('fa-bullhorn'));
define('IMAGE_closed_small',  		$tp->toGlyph('fa-lock'));
define('IMAGE_closed', 				$tp->toGlyph('fa-lock', 'size=2x'));
define('IMAGE_noreplies', 			$tp->toGlyph('fa-comment-o', 'size=2x'));
define('IMAGE_noreplies_small', 	$tp->toGlyph('fa-comment-o'));
define('IMAGE_track', 		        $tp->toGlyph('fa-bell'));
define('IMAGE_untrack', 	        $tp->toGlyph('fa-bell-o'));
*/    
//var_dump(IMAGE_alert);
} else {

// Thread info
define('IMAGE_alert', 				$tp->toImage(e_IMAGE_ABS.'icons/important_16.png"', array('alt'=>LAN_EUSER_500)));
define('IMAGE_bigalert', 			$tp->toImage(e_IMAGE_ABS.'icons/important_32.png"', array('alt'=>LAN_EUSER_501)));
define('IMAGE_online', 				$tp->toGlyph('off'), array('class'=>'text-success'));
define('IMAGE_offline', 				$tp->toGlyph('off'), array('class'=>'text-danger'));
define('IMAGE_registration', 				$tp->toGlyph('fa-registered'));
define('IMAGE_visits', 				$tp->toGlyph('fa-sign-in'));
define('IMAGE_lastvisit', 				$tp->toGlyph('fa-hourglass'));
define('IMAGE_chat', 				$tp->toGlyph('fa-commenting'));
define('IMAGE_comment', 				$tp->toGlyph('fa-comment'));
define('IMAGE_images', 				$tp->toGlyph('fa-picture-o'));
define('IMAGE_videos', 				$tp->toGlyph('fa-video-camera'));
define('IMAGE_forum', 				$tp->toGlyph('fa-comments-o'));
define('IMAGE_news', 				$tp->toGlyph('fa-newspaper-o'));
define('IMAGE_new', 				$tp->toGlyph('certificate'));
//define('IMAGE_e', 					'<img src="'.img_path('e.png').'" alt="" title="" />');
define('IMAGE_upload', 				'<img src="'.img_path('new.png').'" alt="'.LAN_FORUM_4001.'" title="'.LAN_FORUM_4001.'" />');
define('IMAGE_logout', 				'<img src="'.img_path('new.png').'" alt="'.LAN_FORUM_4001.'" title="'.LAN_FORUM_4001.'" />');
define('IMAGE_admin', 				'<img src="'.img_path('new.png').'" alt="'.LAN_FORUM_4001.'" title="'.LAN_FORUM_4001.'" />');
define('IMAGE_settings', 				$tp->toGlyph('wrench'));
define('IMAGE_friends', 				'<img src="'.img_path('new.png').'" alt="'.LAN_FORUM_4001.'" title="'.LAN_FORUM_4001.'" />');
define('IMAGE_addfriend', 				"<span class='fa-groupstack'>".$tp->toGlyph('user').$tp->toGlyph('plus')."</span>");
define('IMAGE_colourkey', 				'<img src="'.img_path('new.png').'" alt="'.LAN_FORUM_4001.'" title="'.LAN_FORUM_4001.'" />');
define('IMAGE_user', 				'<img src="'.img_path('new.png').'" alt="'.LAN_FORUM_4001.'" title="'.LAN_FORUM_4001.'" />');
define('IMAGE_users', 				"<span class='fa-groupstack'>".$tp->toGlyph('user').$tp->toGlyph('user')."</span>");
define('IMAGE_guest', 				'<img src="'.img_path('new.png').'" alt="'.LAN_FORUM_4001.'" title="'.LAN_FORUM_4001.'" />');
/*
define('IMAGE_nonew', 				'<img src="'.img_path('nonew.png').'" alt="'.LAN_FORUM_4002.'" title="'.LAN_FORUM_4002.'" />');
define('IMAGE_new_small', 			'<img src="'.img_path('new_small.png').'" alt="'.LAN_FORUM_4001.'" title="'.LAN_FORUM_4001.'" />');
define('IMAGE_nonew_small', 		'<img src="'.img_path('nonew_small.png').'" alt="'.LAN_FORUM_4002.'" title="'.LAN_FORUM_4002.'" />');
define('IMAGE_new_popular', 		'<img src="'.img_path('new_popular.png').'" alt="'.LAN_FORUM_4003.'" title="'.LAN_FORUM_4003.'" />');
define('IMAGE_nonew_popular', 		'<img src="'.img_path('nonew_popular.png').'" alt="'.LAN_FORUM_4004.'" title="'.LAN_FORUM_4004.'" />');
define('IMAGE_new_popular_small', 	'<img src="'.img_path('new_popular_small.png').'" alt="'.LAN_FORUM_4003.'" title="'.LAN_FORUM_4003.'" />');
define('IMAGE_nonew_popular_small',	'<img src="'.img_path('nonew_popular_small.png').'" alt="'.LAN_FORUM_4004.'" title="'.LAN_FORUM_4004.'" />');
define('IMAGE_sticky', 				'<img src="'.img_path('sticky.png').'" alt="'.LAN_FORUM_1011.'" title="'.LAN_FORUM_1011.'" />');
define('IMAGE_sticky_small', 		'<img src="'.img_path('sticky_small.png').'" alt="'.LAN_FORUM_1011.'" title="'.LAN_FORUM_1011.'" />');
define('IMAGE_stickyclosed', 		'<img src="'.img_path('sticky_closed.png').'" alt="'.LAN_FORUM_1012.'" title="'.LAN_FORUM_1012.'" />');
define('IMAGE_stickyclosed_small', 	'<img src="'.img_path('sticky_closed_small.png').'" alt="'.LAN_FORUM_1012.'" title="'.LAN_FORUM_1012.'" />');
define('IMAGE_announce', 			'<img src="'.img_path('announce.png').'" alt="'.LAN_FORUM_1013.'" title="'.LAN_FORUM_1013.'" />');
define('IMAGE_announce_small', 		'<img src="'.img_path('announce_small.png').'" alt="'.LAN_FORUM_1013.'" title="'.LAN_FORUM_1013.'" />');
define('IMAGE_closed_small', 		'<img src="'.img_path('closed_small.png').'" alt="'.LAN_FORUM_1014.'" title="'.LAN_FORUM_1014.'" />');
define('IMAGE_closed', 				'<img src="'.img_path('closed.png').'" alt="'.LAN_FORUM_1014.'" title="'.LAN_FORUM_1014.'" />');

define('IMAGE_track', 		'<img src="'.img_path('track.png').'" alt="'.LAN_FORUM_4009.'" title="'.LAN_FORUM_4009.'" class="icon S16 action" />');
define('IMAGE_untrack', 	'<img src="'.img_path('untrack.png').'" alt="'.LAN_FORUM_4010.'" title="'.LAN_FORUM_4010.'" class="icon S16 action" />');
*/
}

?>
