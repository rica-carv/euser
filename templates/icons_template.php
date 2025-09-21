<?php

if (!defined('e107_INIT')) { exit(); }

$tp = e107::getParser();
//if(deftrue("FONTAWESOME", false)) {
if(defined("FONTAWESOME")) {
//var_dump(IMAGE_alert);
//// dEIXEI DE USAR
/*
define('PHLIS_ICON_normal', 				$tp->toGlyph('fa-expand'));
define('PHLIS_ICON_condensed', 				$tp->toGlyph('fa-compress'));
*/
//define('PHLIS_ICON_save', 				$tp->toImage(e_PLUGIN.'phil_lis/images/icons.png', array('class'=> 'phillis_icon', 'id'=>'save', 'alt'=>LAN_EUSER_500)));
define('PHLIS_ICON_save', 				    $tp->toGlyph('fa-floppy-disk'));
//define('PHLIS_ICON_edit', 				$tp->toImage(e_PLUGIN.'phil_lis/images/icons.png', array('class'=> 'phillis_icon', 'id'=>'edit', 'alt'=>LAN_EUSER_500)));
define('PHLIS_ICON_edit', 				    $tp->toGlyph('fa-pen-to-square'));
define('PHLIS_ICON_compare', 				$tp->toGlyph('fa-retweet'));
define('PHLIS_ICON_csv',     				$tp->toGlyph('fa-file-csv'));
/*define('PHLIS_IMAGE_online', 				$tp->toGlyph('fa-power-off', array('class'=>'text-success')));
// No tema tem de ser isto... define('PHLIS_IMAGE_online', 				$tp->toGlyph('off', array('class'=>'text-success famicon')));
define('PHLIS_IMAGE_offline', 				$tp->toGlyph('fa-power-off', array('class'=>'text-danger')));
define('PHLIS_IMAGE_registration', 				$tp->toGlyph('fa-registered'));
define('PHLIS_IMAGE_visits', 				$tp->toGlyph('fa-sign-in'));
define('PHLIS_IMAGE_lastvisit', 				$tp->toGlyph('fa-hourglass'));
define('PHLIS_IMAGE_chat', 				$tp->toGlyph('fa-commenting'));
define('PHLIS_IMAGE_comment', 				$tp->toGlyph('fa-comment'));
define('PHLIS_IMAGE_PHLIS_IMAGEs', 				$tp->toGlyph('fa-photo'));
define('PHLIS_IMAGE_videos', 				$tp->toGlyph('fa-facetime-video'));
define('PHLIS_IMAGE_forum', 				$tp->toGlyph('fa-comments-o'));
define('PHLIS_IMAGE_news', 				$tp->toGlyph('fa-newspaper-o'));
define('PHLIS_IMAGE_new', 				$tp->toGlyph('fa-certificate'));
define('PHLIS_IMAGE_upload', 				$tp->toGlyph('fa-upload'));
define('PHLIS_IMAGE_logout', 				$tp->toGlyph('fa-sign-out'));
define('PHLIS_IMAGE_admin', 				$tp->toGlyph('fa-cogs'));
define('PHLIS_IMAGE_settings', 				$tp->toGlyph('fa-wrench'));
define('PHLIS_IMAGE_friends', 				$tp->toGlyph('fa-user-circle'));
define('PHLIS_IMAGE_addfriend', 				$tp->toGlyph('fa-user-plus'));
define('PHLIS_IMAGE_colourkey', 				$tp->toGlyph('fa-info-circle'));
define('PHLIS_IMAGE_user', 				$tp->toGlyph('fa-user'));
define('PHLIS_IMAGE_users', 				$tp->toGlyph('fa-users'));
define('PHLIS_IMAGE_guest', 			$tp->toGlyph('fa-user-secret'));
/*
define('PHLIS_IMAGE_new_small',  			$tp->toGlyph('fa-star'));
define('PHLIS_IMAGE_nonew_small',  		$tp->toGlyph('fa-comment'));
define('PHLIS_IMAGE_new_popular',  		$tp->toGlyph('fa-comments', 'size=2x'));
define('PHLIS_IMAGE_nonew_popular', 		$tp->toGlyph('fa-comments-o', 'size=2x'));
define('PHLIS_IMAGE_new_popular_small',  	$tp->toGlyph('fa-comments'));
define('PHLIS_IMAGE_nonew_popular_small', $tp->toGlyph('fa-comments-o'));
define('PHLIS_IMAGE_sticky',  			$tp->toGlyph('fa-thumb-tack', 'size=2x'));
define('PHLIS_IMAGE_stickyclosed',  		$tp->toGlyph('fa-lock', 'size=2x'));
define('PHLIS_IMAGE_sticky_small', 		$tp->toGlyph('fa-thumb-tack'));
define('PHLIS_IMAGE_stickyclosed_small',  $tp->toGlyph('fa-lock'));
define('PHLIS_IMAGE_announce',  			$tp->toGlyph('fa-bullhorn', 'size=2x'));
define('PHLIS_IMAGE_announce_small',  	$tp->toGlyph('fa-bullhorn'));
define('PHLIS_IMAGE_closed_small',  		$tp->toGlyph('fa-lock'));
define('PHLIS_IMAGE_closed', 				$tp->toGlyph('fa-lock', 'size=2x'));
define('PHLIS_IMAGE_noreplies', 			$tp->toGlyph('fa-comment-o', 'size=2x'));
define('PHLIS_IMAGE_noreplies_small', 	$tp->toGlyph('fa-comment-o'));
define('PHLIS_IMAGE_track', 		        $tp->toGlyph('fa-bell'));
define('PHLIS_IMAGE_untrack', 	        $tp->toGlyph('fa-bell-o'));
*/    
//var_dump(PHLIS_IMAGE_alert);
} else {
////////////////e107::css();
/*
define('PHLIS_ICON_normal', 				$tp->toImage(e_PLUGIN.'phil_lis/images/icons.png', array('class'=> 'phillis_icon', 'id'=>'numcond', 'alt'=>LAN_EUSER_500)));
define('PHLIS_ICON_condensed', 				$tp->toImage(e_PLUGIN.'phil_lis/images/icons.png', array('class'=> 'phillis_icon', 'id'=>'numcondplus', 'alt'=>LAN_EUSER_500)));
*/
define('PHLIS_ICON_save', 				$tp->toImage(e_PLUGIN.'phil_lis/images/save.png', array('class'=> 'phillis_icon', 'id'=>'save', 'alt'=>LAN_EUSER_500)));
define('PHLIS_ICON_edit', 				$tp->toImage(e_PLUGIN.'phil_lis/images/edit.png', array('class'=> 'phillis_icon', 'id'=>'edit', 'alt'=>LAN_EUSER_500)));
define('PHLIS_ICON_compare', 				$tp->toImage(e_PLUGIN.'phil_lis/images/compare.png', array('class'=> 'phillis_icon', 'id'=>'compare', 'alt'=>LAN_EUSER_500)));
define('PHLIS_ICON_csv', 				$tp->toImage(e_PLUGIN.'phil_lis/images/csv.png', array('class'=> 'phillis_icon', 'id'=>'compare', 'alt'=>LAN_EUSER_500)));
// Thread info
/*
define('PHLIS_IMAGE_alert', 				$tp->toPHLIS_IMAGE(e_PHLIS_IMAGE_ABS.'icons/important_16.png"', array('alt'=>LAN_EUSER_500)));
define('PHLIS_IMAGE_bigalert', 			$tp->toPHLIS_IMAGE(e_PHLIS_IMAGE_ABS.'icons/important_32.png"', array('alt'=>LAN_EUSER_501)));
define('PHLIS_IMAGE_online', 				$tp->toGlyph('off'), array('class'=>'text-success'));
define('PHLIS_IMAGE_offline', 				$tp->toGlyph('off'), array('class'=>'text-danger'));
define('PHLIS_IMAGE_registration', 				$tp->toGlyph('fa-registered'));
define('PHLIS_IMAGE_visits', 				$tp->toGlyph('fa-sign-in'));
define('PHLIS_IMAGE_lastvisit', 				$tp->toGlyph('fa-hourglass'));
define('PHLIS_IMAGE_chat', 				$tp->toGlyph('fa-commenting'));
define('PHLIS_IMAGE_comment', 				$tp->toGlyph('fa-comment'));
define('PHLIS_IMAGE_PHLIS_IMAGEs', 				$tp->toGlyph('fa-picture-o'));
define('PHLIS_IMAGE_videos', 				$tp->toGlyph('fa-video-camera'));
define('PHLIS_IMAGE_forum', 				$tp->toGlyph('fa-comments-o'));
define('PHLIS_IMAGE_news', 				$tp->toGlyph('fa-newspaper-o'));
define('PHLIS_IMAGE_new', 				$tp->toGlyph('certificate'));
//define('PHLIS_IMAGE_e', 					'<img src="'.img_path('e.png').'" alt="" title="" />');
define('PHLIS_IMAGE_upload', 				'<img src="'.img_path('new.png').'" alt="'.LAN_FORUM_4001.'" title="'.LAN_FORUM_4001.'" />');
define('PHLIS_IMAGE_logout', 				'<img src="'.img_path('new.png').'" alt="'.LAN_FORUM_4001.'" title="'.LAN_FORUM_4001.'" />');
define('PHLIS_IMAGE_admin', 				'<img src="'.img_path('new.png').'" alt="'.LAN_FORUM_4001.'" title="'.LAN_FORUM_4001.'" />');
define('PHLIS_IMAGE_settings', 				$tp->toGlyph('wrench'));
define('PHLIS_IMAGE_friends', 				'<img src="'.img_path('new.png').'" alt="'.LAN_FORUM_4001.'" title="'.LAN_FORUM_4001.'" />');
define('PHLIS_IMAGE_addfriend', 				"<span class='fa-groupstack'>".$tp->toGlyph('user').$tp->toGlyph('plus')."</span>");
define('PHLIS_IMAGE_colourkey', 				'<img src="'.img_path('new.png').'" alt="'.LAN_FORUM_4001.'" title="'.LAN_FORUM_4001.'" />');
define('PHLIS_IMAGE_user', 				'<img src="'.img_path('new.png').'" alt="'.LAN_FORUM_4001.'" title="'.LAN_FORUM_4001.'" />');
define('PHLIS_IMAGE_users', 				"<span class='fa-groupstack'>".$tp->toGlyph('user').$tp->toGlyph('user')."</span>");
define('PHLIS_IMAGE_guest', 				'<img src="'.img_path('new.png').'" alt="'.LAN_FORUM_4001.'" title="'.LAN_FORUM_4001.'" />');
/*
define('PHLIS_IMAGE_nonew', 				'<img src="'.img_path('nonew.png').'" alt="'.LAN_FORUM_4002.'" title="'.LAN_FORUM_4002.'" />');
define('PHLIS_IMAGE_new_small', 			'<img src="'.img_path('new_small.png').'" alt="'.LAN_FORUM_4001.'" title="'.LAN_FORUM_4001.'" />');
define('PHLIS_IMAGE_nonew_small', 		'<img src="'.img_path('nonew_small.png').'" alt="'.LAN_FORUM_4002.'" title="'.LAN_FORUM_4002.'" />');
define('PHLIS_IMAGE_new_popular', 		'<img src="'.img_path('new_popular.png').'" alt="'.LAN_FORUM_4003.'" title="'.LAN_FORUM_4003.'" />');
define('PHLIS_IMAGE_nonew_popular', 		'<img src="'.img_path('nonew_popular.png').'" alt="'.LAN_FORUM_4004.'" title="'.LAN_FORUM_4004.'" />');
define('PHLIS_IMAGE_new_popular_small', 	'<img src="'.img_path('new_popular_small.png').'" alt="'.LAN_FORUM_4003.'" title="'.LAN_FORUM_4003.'" />');
define('PHLIS_IMAGE_nonew_popular_small',	'<img src="'.img_path('nonew_popular_small.png').'" alt="'.LAN_FORUM_4004.'" title="'.LAN_FORUM_4004.'" />');
define('PHLIS_IMAGE_sticky', 				'<img src="'.img_path('sticky.png').'" alt="'.LAN_FORUM_1011.'" title="'.LAN_FORUM_1011.'" />');
define('PHLIS_IMAGE_sticky_small', 		'<img src="'.img_path('sticky_small.png').'" alt="'.LAN_FORUM_1011.'" title="'.LAN_FORUM_1011.'" />');
define('PHLIS_IMAGE_stickyclosed', 		'<img src="'.img_path('sticky_closed.png').'" alt="'.LAN_FORUM_1012.'" title="'.LAN_FORUM_1012.'" />');
define('PHLIS_IMAGE_stickyclosed_small', 	'<img src="'.img_path('sticky_closed_small.png').'" alt="'.LAN_FORUM_1012.'" title="'.LAN_FORUM_1012.'" />');
define('PHLIS_IMAGE_announce', 			'<img src="'.img_path('announce.png').'" alt="'.LAN_FORUM_1013.'" title="'.LAN_FORUM_1013.'" />');
define('PHLIS_IMAGE_announce_small', 		'<img src="'.img_path('announce_small.png').'" alt="'.LAN_FORUM_1013.'" title="'.LAN_FORUM_1013.'" />');
define('PHLIS_IMAGE_closed_small', 		'<img src="'.img_path('closed_small.png').'" alt="'.LAN_FORUM_1014.'" title="'.LAN_FORUM_1014.'" />');
define('PHLIS_IMAGE_closed', 				'<img src="'.img_path('closed.png').'" alt="'.LAN_FORUM_1014.'" title="'.LAN_FORUM_1014.'" />');

define('PHLIS_IMAGE_track', 		'<img src="'.img_path('track.png').'" alt="'.LAN_FORUM_4009.'" title="'.LAN_FORUM_4009.'" class="icon S16 action" />');
define('PHLIS_IMAGE_untrack', 	'<img src="'.img_path('untrack.png').'" alt="'.LAN_FORUM_4010.'" title="'.LAN_FORUM_4010.'" class="icon S16 action" />');
*/
}