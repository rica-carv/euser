<?php

global $euser_pref;

$euser_pref_new = array_diff_key($euser_pref, array_flip(
	"profile_apcomments",
	"profile_frcol",
	"profile_allowguests",
	"profile_maxuploadsize",
	"profile_avatarwidth",
	"profile_avatarheight",
	"profile_indmaxuploadsize",
	"profile_maxnovids",
	"profile_friends",
	"profile_pics",
	"profile_videos",
	"profile_commentson",
	"profile_stats",
	"profile_buttontype",
	"profile_redirect",
	"profile_mp3enabled",
	"profile_mp3",
	"profile_mp3size",
	"profile_picviewsize",
	"profile_lightbox",
	"profile_lightwindowbox",
	"profile_lightview",
	"profile_clearbox",
	"profile_memberlist",
	"profile_maxpcomment",
	"profile_maxpiccomment",
	"profile_maxvidcomment",
	"profile_maxalbumnumber",
	"profile_maxpicnumber",
	"profile_accents",
	"profile_redirect_usersettings",
	"profile_user_image",
	"profile_imagewidth",
	"profile_imageheight",
	"profile_unreg",
	"profile_fr_req_sendpm",
	"profile_fr_req_sendemail",
	"profile_unreg_save",
	"profile_user_warn_support",
	"profile_imagick_support" ,
	"profile_member_info",
	"profile_fr_req_sendemail_all",
	"profile_fr_req_sendpm_all",
	"profile_comments_spy_num",
	"profile_comments_spy",
	"profile_comments_spy_pic_size",
	"profile_memberlist_order",
	"profile_memberlist_direction",
	"profile_memberlist_accept",
	"profile_memberlist_forum_info",
	"profile_memberlist_comment_1_info",
	"profile_memberlist_comment_info",
	"profile_memberlist_pic_info",
	"profile_memberlist_vid_info",
	"profile_memberlist_mp3_info",
	"profile_memberlist_column_avatar",
	"profile_memberlist_column_online",
	"profile_memberlist_column_email",
	"profile_memberlist_column_join",
	"profile_memberlist_column_lastvisit",
	"profile_memberlist_column_visits",
	"profile_memberlist_filter",
	"profile_memberlist_column_realname",
	"profile_memberlist_column_loginname",
	"profile_memberlist_column_timezone",
	"profile_memberlist_column_userip",
	"profile_member_ext_search",
	"profile_memberlist_color_up",
	"profile_memberlist_color_down",
	"profile_memberlist_class",
	"profile_mp3_autoplay",
	"profile_mp3_loop",
	"profile_mp3_volume",
	"profile_top",
	"profile_top_class",
	"profile_top_x",
	"profile_top_level",
	"profile_top_forums",
	"profile_top_comments",
	"profile_top_chatbox",
	"profile_top_rate",
	"profile_top_profile",
	"profile_top_friends",
	"profile_top_noadmin",
	"profile_memberlist_bcard",
	"profile_bcard_column",
	"profile_top_bcard_column",
	"profile_bcard_css",
	"profile_updateddirection",
	"profile_updatedtotal",
	"profile_updatedtotal_col",
	"profile_lastupdate_filter",
	"profile_piccol",
	"profile_memberlist_addtofriend",
	"profile_private_albums",
	"profile_videowidth",
	"profile_youtube",
	"profile_vimeo",
	"profile_metacafe",
	"profile_indavideo",
	"profile_check_video",
	"profile_userpic_order",

        "onlineinfo_caption",
		"onlineinfo_amigo",
		"onlineinfo_amigo_hide",
		"onlineinfo_coppermine",
		"onlineinfo_guest",
		"onlineinfo_downloads",
		"onlineinfo_new_icon",
		"onlineinfo_new_icontype",
		"onlineinfo_avatar",
		"onlineinfo_formatbdays",
		"onlineinfo_width",
		"onlineinfo_showforum",
		"onlineinfo_forumno",
		"onlineinfo_showicons",
		"onlineinfo_showadmin",
		"onlineinfo_border",
		"onlineinfo_color",
		"onlineinfo_guestbook",
		"onlineinfo_hideadminarea",
		"onlineinfo_content",
		"onlineinfo_showregusers",
		"onlineinfo_chatnum",
		"onlineinfo_forumnum",
		"onlineinfo_downloadnum",
		"onlineinfo_guestbooknum",
		"onlineinfo_copperminenum",
		"onlineinfo_commentsnum",
		"onlineinfo_copperminecommentsnum",
		"onlineinfo_linksnum",
		"onlineinfo_usersnum",
		"onlineinfo_newsnum",
		"onlineinfo_contentsnum",
		"onlineinfo_hideuserrating",
		"onlineinfo_userratingno",
		"onlineinfo_whatsnewtype",
		"onlineinfo_ibfuse",
		"onlineinfo_ibfprefix"=>"ibf_",
		"onlineinfo_ibflocation"=>"forums",
		"onlineinfo_ibftime",
		"onlineinfo_ibfshownum",
// UTILIZA��O DE OUTRO SISTEMA DE PM'S, TEM DE SAIR DAQUI, TIPO PARA UM SHORTCODE...
//		"onlineinfo_ibfpm",
		"onlineinfo_flashchatuse",
		"onlineinfo_flashchatprefix"=>"e107_",
		"onlineinfo_flashchatlocation"=>"chat",
		"onlineinfo_flashchatwindow"=>"e107",
		"onlineinfo_flashchatshow"=>e_UC_MEMBER,
		"onlineinfo_hideguest",
		"onlineinfo_hideusers",
		"onlineinfo_ibfautohide",
		"onlineinfo_flashtext",
		"onlineinfo_flashtext_colour"=>"red",
		"onlineinfo_chatbox",
		"onlineinfo_forum",
		"onlineinfo_hideadmin",
		"onlineinfo_hideregusers",
// AS PM'S NORMAIS S�O GERIDAS PELO PR�PRIO LOGIN MENU DO CORE....
//		"onlineinfo_showpmmsg",
		"onlineinfo_rememberbuttons",
		"onlineinfo_fontsize",
		"onlineinfo_usernamefontsize",
		"onlineinfo_ipchecker",
		"onlineinfo_nolocations",
		"onlineinfo_admincolour"=>"#ff0000",
		"onlineinfo_memcolour"=>"#ffffff",
		"onlineinfo_modcolour"=>"#ffff40",
		"onlineinfo_botchecker",
		"onlineinfo_gallery2use",
		"onlineinfo_gallery2prefix"=>"g2_",
		"onlineinfo_gallery2location"=>"gallery2",
		"onlineinfo_gallery2window"=>"e107",
		"onlineinfo_gallery2shownum",
		"onlineinfo_smfuse",
		"onlineinfo_smfprefix"=>"smf_",
		"onlineinfo_smflocation"=>"smf",
		"onlineinfo_smfwindow"=>"e107",
		"onlineinfo_smfshownum",
		"onlineinfo_sound"=>"none",
		"onlineinfo_deleteme",
		"onlineinfo_logindiag",
		"onlineinfo_bavatar",
		"onlineinfo_shownews",
		"onlineinfo_youtubenum",
		"onlineinfo_youtube",
		"onlineinfo_forum_summary",
		"onlineinfo_kroozearcade",
		"onlineinfo_kroozearcadenum",
		"onlineinfo_kroozearcadetop",
		"onlineinfo_kroozearcadetopnum",
		"onlineinfo_links",
		"onlineinfo_members",
		"onlineinfo_bugtracker3",
		"onlineinfo_bugtracker3commentsnum",
		"onlineinfo_hideifnonew",
		"onlineinfo_headadmincolour"=>"#8080ff",
	"onlineinfo_sa_coppermineuse",
	"onlineinfo_sa_coppermineprefix"=>"cpg_",
	"onlineinfo_sa_copperminelocation"=>"cpg",
	"onlineinfo_sa_copperminewindow"=>"e107",
	"onlineinfo_sa_coppermineshownum",
	"onlineinfo_chatboxII",
	"onlineinfo_chatIInum",
	"onlineinfo_joke",
	"onlineinfo_jokenum",
	"onlineinfo_blog",
	"onlineinfo_blognum",
	"onlineinfo_suggestions",
	"onlineinfo_suggestionsnum",
	"onlineinfo_showcomments",
	"onlineinfo_onoffcolour",
	"onlineinfo_headadminactive",
	"onlineinfo_adminactive",
	"onlineinfo_memactive",
	"onlineinfo_modactive"
  ));

?>