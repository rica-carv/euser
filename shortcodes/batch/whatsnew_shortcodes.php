<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     ©Steve Dunstan 2001-2002
|     http://e107.org
|     jalist@e107.org
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $Source: /cvsroot/e107/e107_0.7/e107_plugins/login_menu/login_menu_shortcodes.php,v $
|     $Revision: 1.10 $
|     $Date: 2006/11/18 22:40:54 $
|     $Author: mcfly_e107 $
+----------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
//echo "SHORTCODES CARREGADOS";
//global $tp;
		require_once(e_PLUGIN."login_menu/login_menu_shortcodes.php"); // don't use 'require_once'.
include_once(e_PLUGIN.'euser/euser_class.php');

//		class plugin_euser_login_menu_shortcodes extends e_shortcode
// extende o login_menu_shortcodes para utilizar também os shortcodes do login menu do core....
		class plugin_euser_whatsnew_shortcodes extends login_menu_shortcodes
// Já não preciso de extender os shortcodes do login menu porque o menu é embebido com o EMBEDMENU
		{

/*
			private $use_imagecode =0;
			private $sec;
			private $usernameLabel = LAN_LOGINMENU_1;
			private $allowEmailLogin;
*/
//      private $orderList;
//########################## Temporário, assim que tudo estiver em shortcodes, fica no euser_login_menu.php
//		  private $euserlmsql;
//		  private $euserlm;

			function __construct()
			{
				$this->sql = e107::getDb(); 
				$this->tp = e107::getParser();
        $this->template = e107::getTemplate('euser', 'whatsnew_menu');
        $this->euser_pref = e107::getPlugPref('euser');

/*        $this->euserlm = function($what) {
//          var_dump (getcachedvars('orderList'));
      		$orderList = getcachedvars('orderList');
          $orderclass = $orderList[$what]['class'];
//          var_dump ($orderclass);
          include (e_PLUGIN."euser/includes/".$what);
//            var_dump ($text);
//            echo "<hr>";
          return $text;
        };
*/


		}

//--			function makelabel($text, $total = 0){
//      var_dump ($total);
//--      return "<span class='label label-".($total==0?"default":"danger")."'>".$text."</span>";
//--      }
// {EWNM_ADMIN:type=total} devolve só o número do total
			function sc_ewnm_admin($parm='')
			{
//var_dump ($parm);
// if ($pref['onlineinfo_hideadminarea'] == 1){
//    if (ADMIN == true){
/*
	if ($pref['onlineinfo_hideadmin'] == 1)
    {

        $text .= "<div id='admin-title' style='cursor:hand; font-size: ".$onlineinfomenufsize."px; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth.";' title='ADMIN SECTION'><b>&nbsp;".ADLAN_LAT_1."</b></div>";
         $text .= "<div id='admin' class='switchgroup1' style='display:none; border-style:inset; padding-left: 2px;'>";
	}
    else
    {
		$text .= '<div style="text-align:left; vertical-align: middle; font-size: '.$onlineinfomenufsize.'px; width:".$onlineinfomenuwidth.";"><b>'.ADLAN_LAT_1.'</b></div><div style="border-style:inset; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth.";">';
	}
*/	
	// ADMIN Section
	
if (ADMIN) {
	$e_sub_cat = 'main';
						
//			global $sql, $ns, $pref;

//			$submitted_news = $this->sql -> db_Count("submitnews", "(*)", "WHERE submitnews_auth = '0' ");
      $tmp['LINE_END']=$this->sql -> db_Count("submitnews", "(*)", "WHERE submitnews_auth = '0' ");
      $tmp['LINE_START']=E_16_NEWS." <a href='".e_ADMIN."newspost.php?sn'>".ADLAN_LAT_2."</a>";
    	$text .= ($tmp['LINE_END']==0 ? "":$this->tp->parseTemplate($this->template['section_line'], true, $tmp));
      $total = $tmp['LINE_END']; 
//			$text .= E_16_NEWS.($submitted_news ? " <a href='".e_ADMIN."newspost.php?sn'>".ADLAN_LAT_2.": $submitted_news</a>" : " ".ADLAN_LAT_2.": 0");

//   		$active_uploads = $this->sql -> db_Count("upload", "(*)", "WHERE upload_active = '0' ");
//			$text .= E_16_UPLOADS.($active_uploads ? " <a href='".e_ADMIN."upload.php'>".ADLAN_LAT_7.": $active_uploads</a>" : " ".ADLAN_LAT_7.": ".$active_uploads);

      $tmp['LINE_END']=$this->sql -> db_Count("upload", "(*)", "WHERE upload_active = '0' ");
      $tmp['LINE_START']=E_16_UPLOADS." <a href='".e_ADMIN."upload.php'>".ADLAN_LAT_7."</a>";
    	$text .= ($tmp['LINE_END']==0 ?"":$this->tp->parseTemplate($this->template['section_line'], true, $tmp));
      $total += $tmp['LINE_END']; 

/*
			$text .= "<div style='padding-bottom: 2px;'>".E_16_NEWS.($submitted_news ? " <a href='".e_ADMIN."newspost.php?sn'>".ADLAN_LAT_2.": $submitted_news</a>" : " ".ADLAN_LAT_2.": 0")."</div>";
			$text .= "<div style='padding-bottom: 2px;'>".E_16_UPLOADS.($active_uploads ? " <a href='".e_ADMIN."upload.php'>".ADLAN_LAT_7.": $active_uploads</a>" : " ".ADLAN_LAT_7.": ".$active_uploads)."</div>";
*/

//?
			foreach($this->euser_pref['e_latest_list'] as $val)
			{
				if (is_readable(e_PLUGIN.$val."/e_latest.php"))
				{
				   		include_once(e_PLUGIN.$val."/e_latest.php");
				}
			}
//?

			$messageTypes = array("Broken Download", "Dev Team Message");
			$queryString = "";
			foreach($messageTypes as $types) {
				$queryString .= " gen_type='$types' OR";
			}
			$queryString = substr($queryString, 0, -3);

			if($amount = $this->sql -> db_Select("generic", "*", $queryString)) {
				$text .= "<br /><b><a href='".e_ADMIN."message.php'>".ADLAN_LAT_8." [".$amount."]</a></b>";
			}

//        if ($total==0){$text = "<span class='text-info'>".LAN_NEWS_83."</span>";}
// Eu preciso do total de qualquer das formas, para ter o ícone...
//      if ($parm['type'] == "total") { return $total;}
//      if ($parm['style'] == "badge") { 
//        $badge_ini = "<span class='badge badge-pill badge-".($total==0?"info":"danger")."'>";
//        $badge_end = "</span>";
//      }
      if ($parm['type'] == "total") { return ($parm['style'] == "label"?euser::makelabel($total):$total);}
//      if ($parm['type'] == "total") { if ($total==0){return; } return $total;}

        if ($total==0){
        $mes = e107::getMessage();
        $mes->addInfo(LAN_NEWS_83); 
        return $mes->render();
        }
var_dump ($total==0);
				return $text;

}

//    $text.="</div><br />";

//    }

//}


//				global $LOGIN_MENU_STATS;
//				$data = getcachedvars('login_menu_data');
//        var_dump ($data);
//        var_dump ($LOGIN_MENU_STATS);
//				if(!$data['enable_stats']) return '';
			}


// Este shortcode depois é para partir em menores para maior customização
			function sc_ewnm_updated($parm='')
			{

//  global $euser_pref;
//$this->sql = e107::getDb();
//      var_dump ($this->var['cache_userclass']);

//      var_dump (check_class($extraclass));
//      var_dump ($euser_pref['showregusers']);
//      var_dump (check_class($euser_pref['showregusers']));

// Isto depois é para mudar, para as prefs
//var_dump(check_class($this->var['cache_userclass']));  VERDADEIRO
if(check_class($this->var['cache_userclass'])){

//$lvisit = USERLV;

$userfound = $this->sql->db_Select("euser_read","*","user_id=".USERID."");

if ($userfound==0){
	
	$this->sql->db_Insert(euser_read,"".USERID.",'','','','','','','','','','','','','','','','','','','','',''","user_id=".USERID."");			

}

while($row = $this->sql -> db_Fetch()){
	extract($row);

$newsread = euser::cleanup($news);
$chatboxread = euser::cleanup($chatbox);
$commentsread = euser::cleanup($comments);
$contentsread = euser::cleanup($contents);
$downloadsread = euser::cleanup($downloads);
$guestbookread = euser::cleanup($guestbook);
$picturesread = euser::cleanup($pictures);
$moviesread = euser::cleanup($movies);
$linksread = euser::cleanup($links);
$sitemembersread = euser::cleanup($sitemembers);
$gamesread = euser::cleanup($games);
$gametopread = euser::cleanup($game_top);
$galleryread = euser::cleanup($gallery);
$ibfread = euser::cleanup($ibf);
$smfread = euser::cleanup($smf);
$bugread = euser::cleanup($bug);
$chatbox2read = euser::cleanup($chatbox2);
$copperread = euser::cleanup($copper);
$jokesread = euser::cleanup($jokes);
$blogsread = euser::cleanup($blogs);
$suggestionsread = euser::cleanup($suggestions);
}													    	


if($this->euser_pref['shownews']==1){
if($newsread != "")
		{
			$news_read = " AND news_id NOT IN (".$newsread.")";
		}

    $new_news = $this->sql->db_Count("news", "(*)", "WHERE news_datestamp>'" . USERLV . "' and news_class IN (".USERCLASS_LIST.") ".$news_read."");

    if (!$new_news)
    {
        $new_news = ONLINEINFO_COUNTER_L9;
    }

}



//-----$checkfornew=0;
$splitcomments= explode("|",$commentsread);

if($splitcomments[0] != "")
		{
			$comments_read = " AND comment_id NOT IN (".$splitcomments[0].")";
		}


    $new_comments = $this->sql->db_Count("comments", "(*)", "WHERE comment_datestamp>'" . USERLV . "'".$comments_read."");


if ($this->euser_pref['bugtracker3'] == 1)
{
	
	if($splitcomments[3] != "")
		{
			$btdcomments_read = " AND bugtracker3_devc_timestamp NOT IN (".$splitcomments[3].")";
		}
	
	
    $new_bugdev_comments = $this->sql -> db_Count("bugtracker3_developer_comments", "(*)", " WHERE bugtracker3_devc_timestamp>".USERLV.$btdcomments_read."");
    }else{
	$new_bugdev_comments =0;	
	}


if ($this->euser_pref['coppermine'] == 1)
{
	
	if($splitcomments[1] != "")
		{
			$ccomments_read = " AND msg_id NOT IN (".$splitcomments[1].")";
		}
	
	
    $new_pic_comments = $this->sql -> db_Count("CPG_comments", "(*)", " WHERE UNIX_TIMESTAMP(msg_date)>".USERLV.$ccomments_read."");
    }else{
	$new_pic_comments =0;	
	}
	

	
	
	
    
    if ($this->euser_pref['gallery2use'] == 1)
    {
    	
    		if($splitcomments[2] != "")
		{
			$gcomments_read = " AND g_id NOT IN (".$splitcomments[2].")";
		}
    	
    	$query="SELECT COUNT(*) as records FROM ".$this->euser_pref['gallery2prefix']."Comment WHERE g_date>".USERLV.$gcomments_read."";
    	
		if($new_gcomments = $this->sql -> db_Select_gen($query)){

		while($row = $this->sql -> db_Fetch()){
			
			extract($row);
		$new_gallery_comments = $records;				
			
		}}
		
    }else{
		$new_gallery_comments=0;
	}


    $new_comments= $new_comments + $new_pic_comments + $new_gallery_comments + $new_bugdev_comments;

    if (!$new_comments)
    {

        $new_comments = ONLINEINFO_COUNTER_L9;
    }





    if ($this->euser_pref['chatbox'] == 1)
    {
    	
    	if($chatboxread != "")
		{
			$chatboxread = " AND cb_id NOT IN (".$chatboxread.")";
		}
    	
		$new_chat = $this->sql->db_Count("chatbox", "(*)", "WHERE cb_datestamp>'".USERLV."'".$chatboxread."");

		if (!$new_chat)
		{
			$new_chat = ONLINEINFO_COUNTER_L9;
		}
    }
    
        if ($this->euser_pref['chatboxII'] == 1)
    {
    	
    	if($chatbox2read != "")
		{
			$chatbox2read = " AND cb2_id NOT IN (".$chatbox2read.")";
		}
    	
		$new_chat2 = $this->sql->db_Count("chatbox2", "(*)", "WHERE cb2_datestamp>'".USERLV."'".$chatbox2read."");

		if (!$new_chat2)
		{
			$new_chat2 = ONLINEINFO_COUNTER_L9;
		}
    }
    
     if ($this->euser_pref['joke'] == 1)
    {
    	
    	if($jokesread != "")
		{
			$jokesread = " AND joke_id NOT IN (".$jokesread.")";
		}
    	
		$new_joke = $this->sql->db_Count("jokemenu_jokes", "(*)", "WHERE joke_posted>'".USERLV."'".$jokesread."");

		if (!$new_joke)
		{
			$new_joke = ONLINEINFO_COUNTER_L9;
		}
    }
    
    
        
     if ($this->euser_pref['suggestions'] == 1)
    {
    	
    	if($suggestionsread != "")
		{
			$suggestionsread = " AND suggestion_id NOT IN (".$suggestionsread.")";
		}
    	
		$new_suggestions = $this->sql->db_Count("sugg_suggs", "(*)", "WHERE suggestion_posted>'".USERLV."' AND suggestion_approved=1".$suggestionsread."");

		if (!$new_suggestions)
		{
			$new_suggestions = ONLINEINFO_COUNTER_L9;
		}
    }
    
    

    if ($this->euser_pref['forum'] == 1)
    {

	// forum_class from form header = user class
$userviewed = USERVIEWED;

$viewed = "";
		if($userviewed)
		{
			$viewed = preg_replace("#\.+#", ".", $userviewed);
			$viewed = preg_replace("#^\.#", "", $viewed);
			$viewed = preg_replace("#\.$#", "", $viewed);
			$viewed = str_replace(".", ",", $viewed);
		}
		if($viewed != "")
		{
			$viewed = " AND ft.thread_id NOT IN (".$viewed.")";
		}
		
	$qry = "SELECT ft.*, fp.thread_name as post_subject, fp.thread_total_replies as replies, u.user_id, f.forum_name,f.forum_id, u.user_name, f.forum_class
		FROM #forum_t AS ft
		LEFT JOIN #forum_t as fp ON fp.thread_id = ft.thread_parent
		LEFT JOIN #user as u ON u.user_id = SUBSTRING_INDEX(ft.thread_user,'.',1)
		LEFT JOIN #forum as f ON f.forum_id = ft.thread_forum_id
		WHERE ft.thread_datestamp > ".USERLV. "
		AND f.forum_class IN (".USERCLASS_LIST.")
		{$viewed}
		ORDER BY ft.thread_datestamp DESC LIMIT 0, ".$this->euser_pref['forumnum'];		
		
		$new_forum = $this->sql->db_Select_gen($qry);


		if (!$new_forum)
		{
			$new_forum = ONLINEINFO_COUNTER_L9;
		}

    }


if ($this->euser_pref['members'] == 1)
    {

if($sitemembersread != "")
		{
			$newmembers = " AND user_id NOT IN (".$sitemembersread.")";
		}

    $new_users = $this->sql->db_Count("user", "(*)", "WHERE user_join>'" . USERLV . "' ".$newmembers."");
    if (!$new_users)
    {
        $new_users = ONLINEINFO_COUNTER_L9;
    }

}


if ($this->euser_pref['smfuse']==1)

{
	if($smfread != "")
		{
			$newsmf = " AND ID_MSG NOT IN (".$smfread.")";
		}
		
			$script="SELECT * FROM ".$this->euser_pref['smfprefix']."messages WHERE posterTime >='". USERLV ."'".$newsmf;
			$onlineinfo_smf_sql = new db;
			$onlineinfo_getsmfinfo = $onlineinfo_smf_sql->db_Select_gen($script);
		
			if (!$onlineinfo_getsmfinfo)
			{
				$onlineinfo_getsmfinfo=ONLINEINFO_COUNTER_L9;
			}


}


if ($this->euser_pref['ibfuse']==1)

{
	if($ibfread != "")
		{
			$newibf = " AND topic_id NOT IN (".$ibfread.")";
		}
		
			$script="SELECT * FROM ".$this->euser_pref['ibfprefix']."posts WHERE post_date >='". USERLV ."'".$newibf;
			$onlineinfo_ipb_sql = new db;
			$onlineinfo_getipbinfo = $onlineinfo_ipb_sql->db_Select_gen($script);
		
			if (!$onlineinfo_getipbinfo)
			{
				$onlineinfo_getipbinfo=ONLINEINFO_COUNTER_L9;
			}


}

if ($this->euser_pref['gallery2use']==1)

{

   	if($galleryread != "")
		{
			$newgallery = " AND g_id NOT IN (".$galleryread.")";
		}
		
		
			$script="SELECT * FROM ".$this->euser_pref['gallery2prefix']."Item WHERE g_canContainChildren ='0' AND g_viewedSinceTimestamp >='". USERLV ."' ".$newgallery;
			$onlineinfo_gallery2_sql = new db;
			$onlineinfo_getgallery2info = $onlineinfo_gallery2_sql->db_Select_gen($script);
			
			if (!$onlineinfo_getgallery2info)
			{
				$onlineinfo_getgallery2info=ONLINEINFO_COUNTER_L9;
			}

}



	if ($this->euser_pref['guestbook'] == 1)
    {
    	
    	    	if($guestbookread != "")
		{
			$newguestbook = " AND id NOT IN (".$guestbookread.")";
		}
		
    $new_guestbook = $this->sql->db_Count("guestbook", "(*)", "WHERE date>'" . USERLV . "' ".$newguestbook."");
 
	        if (!$new_guestbook)
	        {
	            $new_guestbook = ONLINEINFO_COUNTER_L9;
        }
    }




    	if ($this->euser_pref['content'] == 1)
	    {

		if($contentsread != "")
		{
			$newcontents = " AND content_id NOT IN (".$contentsread.")";
		}
    	

	    $new_content = $this->sql->db_Count("pcontent", "(*)", "WHERE content_datestamp>'" . USERLV . "'  AND content_parent!='0' and content_class IN (".USERCLASS_LIST.") ".$newcontents."");
	    
		        if (!$new_content)
		        {
		            $new_content = ONLINEINFO_COUNTER_L9;
	        }
    }


    if ($this->euser_pref['coppermine'] == 1)
    {
    	
    	if($picturesread != "")
		{
			$newpictures = " AND pid NOT IN (".$picturesread.")";
		}
    	
    	
        $new_picture = $this->sql->db_Count("CPG_pictures", "(*)", "WHERE ctime>'" . USERLV . "' ".$newpictures."");
       
        if (!$new_picture)
        {
            $new_picture = ONLINEINFO_COUNTER_L9;
        }
    }

    if ($this->euser_pref['sa_coppermineuse'] == 1)
    {
    	
    	if($copperread != "")
		{
			$newcopper = " AND pid NOT IN (".$copperread.")";
		}
    	
	
		$script="SELECT * FROM ".$this->euser_pref['sa_coppermineprefix']."pictures WHERE ctime >='". USERLV ."' ".$newcopper;
		$onlineinfo_copper_sql = new db;
		$new_copper = $onlineinfo_copper_sql->db_Select_gen($script);
		
		if (!$new_copper)
		{
			$new_copper=ONLINEINFO_COUNTER_L9;
		}

    }

if ($this->euser_pref['blog'] == 1)
    {
	if($blogsread != "")
		{
			$newblog = " AND userjournals_id NOT IN (".$blogsread.")";
		}

    $new_blog = $this->sql->db_Count("userjournals", "(*)", "WHERE userjournals_timestamp>'".USERLV."' ".$newblog."");
    
	    if (!$new_blog)
	    {
	        $new_blog = ONLINEINFO_COUNTER_L9;
	    }
}



    if ($this->euser_pref['downloads'] == 1)
    {
    	
    	if($downloadsread != "")
		{
			$newdownloads = " AND download_id NOT IN (".$downloadsread.")";
		}

        $new_downloads = $this->sql->db_Count("download", "(*)", "WHERE download_datestamp>'" . USERLV . "'  and download_active=1 and download_visible IN (".USERCLASS_LIST.") ".$newdownloads."");
      
        if (!$new_downloads)
        {
            $new_downloads = ONLINEINFO_COUNTER_L9;
        }
    }
    
if ($this->euser_pref['links'] == 1)
    {
	if($linksread != "")
		{
			$newlinks = " AND link_id NOT IN (".$linksread.")";
		}

    $new_link = $this->sql->db_Count("links_page", "(*)", "WHERE link_datestamp>'".USERLV."' and link_class IN (".USERCLASS_LIST.") ".$newlinks."");
    
	    if (!$new_link)
	    {
	        $new_link = ONLINEINFO_COUNTER_L9;
	    }
}

if ($this->euser_pref['youtube'] == 1)
    {
    	
    	if($moviesread != "")
		{
			$newmovie = " AND movie_id NOT IN (".$moviesread.")";
		}
    	
    $new_tube = $this->sql->db_Count("er_ytm_gallery_movies", "(*)", "WHERE UNIX_TIMESTAMP(timestamp)>'".USERLV."' ".$newmovie."");
  
	    if (!$new_tube)
	    {
	        $new_tube = ONLINEINFO_COUNTER_L9;
	    }

	}
	
	if ($this->euser_pref['kroozearcade'] == 1)
{

if($gamesread != "")
		{
			$newgames = " AND game_id NOT IN (".$gamesread.")";
		}

	$new_game = $this->sql -> db_Count("arcade_games", "(*)","WHERE date_added>'".USERLV."' ".$newgames."");
	
	    if (!$new_game)
	    {
	        $new_game = ONLINEINFO_COUNTER_L9;
	    }

}

if ($this->euser_pref['kroozearcadetop'] == 1)
{
	
	if($gametopread != "")
		{
			$newtopscore = " AND champ_id NOT IN (".$gametopread.")";
		}

	$new_gametop = $this->sql -> db_Count("arcade_champs", "(*)","WHERE date_scored>'".USERLV."' ".$newtopscore."");
	
	    if (!$new_gametop)
	    {
	        $new_gametop = ONLINEINFO_COUNTER_L9;
	    }

}


if ($this->euser_pref['bugtracker3'] == 1)
{
	
	if($bugread != "")
		{
			$bugread = "AND ".MPREFIX."bugtracker3_bugs.bugtracker3_bugs_id NOT IN (".$bugread.")";
		}

	$new_bugs = $this->sql -> db_Count("bugtracker3_bugs", "(*)","WHERE bugtracker3_bugs_update_timestamp>'".USERLV."' ".$bugread."");
	
	    if (!$new_bugs)
	    {
	        $new_bugs = ONLINEINFO_COUNTER_L9;
	    }

}

//// ######################################################################################### POR ENQUANTO OS STATS DO LOGIN MENU DO CORE FICAM DESACTIVADOS, ATÉ EU TER SOLUÇÃO PARA OS APRESENTAR NESTE MENU AQUI......
//var_dump ($euser_pref);
		
/* ?????????????????????????
 if (!isset($EUSER_ALL_MENU_LOGGED)) 
	{
		if (file_exists(THEME.'templates/euser/all_menu_template.php')) // Preferred v2.x location. 
		{
	   		require(THEME.'templates/euser/all_menu_template.php');
		}
		elseif(file_exists(THEME.'all_menu_template.php')) 
		{
	   		require(THEME.'all_menu_template.php');
		}
		{
			require(e_PLUGIN.'euser/templates/all_menu_template.php');
		}
	}
	if(!$EUSER_ALL_MENU_LOGGED)
	{
    	require(e_PLUGIN.'euser/templates/all_menu_template.php');
	}
*/
//var_dump ($EUSER_WHATSNEW_MENU_STATS);
/*
if (!$EUSER_WHATSNEW_MENU_STATS) {
		if (file_exists(THEME."login_menu_template.php")){
	   		require(THEME."login_menu_template.php");
		}else{
			require(e_PLUGIN."euser/templates/login_menu_template.php");
		}
	}
*/

//var_dump ($LOGIN_MENU_STATS);
///////////////////var_dump (getcachedvars('login_menu_data'));
///////////////////$sc = e107::getScBatch('login_menu',TRUE);
///////////////////				$text_start = $tp -> parseTemplate("{LM_USERNAME_LABEL}".$LOGIN_MENU_STATS, true, $sc);
//////////////////				$text_start = $LOGIN_MENU_STATS;
//var_dump ($sc);
 if ($this->euser_pref['hideadminarea'] == 1){
    if (ADMIN == true){
	$e_sub_cat = 'main';

//var_dump ($e_sub_cat);
// O tipo de menu passa a ser definido no próprio template... isto tem de sair daqui, para um shortcode, por exemplo... ou com uma constante definida no próprio template...
//------------ if ($euser_pref['loginmenutype']==0){
/********************************
        $text_start .= "<a title='".LAN_EUSER_4011."' id='none' href='".e_ADMIN.$adminfpage."' target='_blank'><img src='".e_PLUGIN."euser/images/admin_into".($euser_pref['loginmenutype']==0?"_24":"").".png' style='border:0; vertical-align: middle'/></a>&nbsp;&nbsp;";
********************************/  
  
//------------  }else{
/* ISTO SALTOU DAQUI PARA O SHORTCODE ADMIN
	if ($this->euser_pref['hideadmin'] == 1)
    {

//        $text_start .= "<div id='admin-title' style='cursor:hand; font-size: ".$onlineinfomenufsize."px; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth.";' title='".ADLAN_LAT_1."'><b>&nbsp;".ADLAN_LAT_1."</b></div>";

// Depois o tag do admin tem de ir buscar o shortcode {LM_ADMIN}, quando ist for templatizado.....   logo esta variável deixa de existir...
				$adminfpage = (!$this->euser_pref["adminstyle"] || $this->euser_pref["adminstyle"] == 'default' ? 'admin.php' : $this->euser_pref["adminstyle"].'.php');				
				$text_start .= ($this->euser_pref["maintainance_flag"]==1 ? '<div style="text-align:center"><b>'.LAN_EUSER_4010.'</div></b><br />' : '' );
//				$text_start .= '<img src="'.$bulletimage.'" alt="bullet" />&nbsp;<a href="'.e_ADMIN.$adminfpage.'">'.LAN_EUSER_4011.'</a><br />';

// Depois o tag do admin tem de ir buscar o shortcode {LM_ADMIN}, quando ist for templatizado.....
        $text_start .= "<div style='cursor:pointer; font-size: ".$onlineinfomenufsize."px; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth.";'><span id='admin-title'></span><b>&nbsp;<a title='".LAN_EUSER_4011."' id='none' href='".e_ADMIN_ABS.$adminfpage."'>".LAN_EUSER_4011."</a></b></div>";


//         $text_start .= "<div id='admin' class='switchgroup1' style='display:none; border-style:inset; padding-left: 2px;'>";
         $text_start .= "<div id='admin' class='switchgroup1' style='width:".$onlineinfomenuwidth.";margin-left:5px'>";
	}
    else
    {
//		$text_start .= "<div style='text-align:left; vertical-align: middle; font-size: ".$onlineinfomenufsize."px; width:".$onlineinfomenuwidth.";'><b>".ADLAN_LAT_1."</b></div><div style='border-style:inset; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth.";'>";
// Depois o tag do admin tem de ir buscar o shortcode {LM_ADMIN}, quando ist for templatizado.....
		$text_start .= "<div style='text-align:left; vertical-align: middle; font-size: ".$onlineinfomenufsize."px; width:".$onlineinfomenuwidth.";'><a title='".LAN_EUSER_4011."' id='none' href='".e_ADMIN_ABS.$adminfpage."'><b>".ADLAN_LAT_1."</a></b></div><div style='text-align:left; vertical-align: middle;  margin-left:5px; margin-right:5px; width:".$onlineinfomenuwidth."'>";
	}
*/
//------------}	
	// ADMIN Section
	
// O tipo de menu passa a ser definido no próprio template... isto tem de sair daqui, para um shortcode, por exemplo... ou com uma constante definida no próprio template...
//    if ($this->euser_pref['loginmenutype']!=0){
/*
if (ADMIN) {                                      
						
//			global $sql, $ns, $this->euser_pref;

	   		$active_uploads = $this->sql -> db_Count("upload", "(*)", "WHERE upload_active = '0' ");
			$submitted_news = $this->sql -> db_Count("submitnews", "(*)", "WHERE submitnews_auth = '0' ");

			$text_start .= "<div style='padding-bottom: 2px;'>".IMAGE_new.($submitted_news ? " <a href='".e_ADMIN."newspost.php?sn'>".ADLAN_LAT_2.": $submitted_news</a>" : " ".ADLAN_LAT_2.": 0")."</div>";
			$text_start .= "<div style='padding-bottom: 2px;'>".IMAGE_upload.($active_uploads ? " <a href='".e_ADMIN."upload.php'>".ADLAN_LAT_7.": $active_uploads</a>" : " ".ADLAN_LAT_7.": ".$active_uploads)."</div>";

			foreach($this->euser_pref['e_latest_list'] as $val)
			{
				if (is_readable(e_PLUGIN.$val."/e_latest.php"))
				{
				   		include_once(e_PLUGIN.$val."/e_latest.php");
				}
			}

			$messageTypes = array("Broken Download", "Dev Team Message");
			$queryString = "";
			foreach($messageTypes as $types) {
				$queryString .= " gen_type='$types' OR";
			}
			$queryString = substr($queryString, 0, -3);

			if($amount = $this->sql -> db_Select("generic", "*", $queryString)) {
				$text_start .= "<br /><b><a href='".e_ADMIN."message.php'>".ADLAN_LAT_8." [".$amount."]</a></b>";
			}

// Valor para apresentar junto ao ícone (em shortcode)
      global $euser_all_menu_shortcodes;
      var_dump ("whatsnew_sc linha 809...   ".$euser_all_menu_shortcodes);
      if ($euser_all_menu_shortcodes){
      $euser_all_menu_shortcodes->addVars(array('admin_counter' => $active_uploads + $submitted_news + $amount));
      }
    $text_start.="</div><hr>";
}		
*/
//}

// O tipo de menu passa a ser definido no próprio template... isto tem de sair daqui, para um shortcode, por exemplo... ou com uma constante definida no próprio template...
/*
    if ($this->euser_pref['loginmenutype']!=0){
    $text_start.="<br/>";
//    $text_start.="<br/></div>";
    }
*/
    }

}

$checkfornew=$onlineinfo_getgallery2info+$onlineinfo_getipbinfo+$onlineinfo_getsmfinfo+$new_bugs+$new_gametop+$new_game+$new_tube+$new_link+$new_downloads+$new_blog+$new_copper+$new_picture+$new_content+$new_guestbook+$new_users+$new_forum+$new_suggestions+$new_joke+$new_chat2+$new_chat+$new_comments+$new_news;

/*
    if ($extrahide == 1)
    {

$checkfornew=$onlineinfo_getgallery2info+$onlineinfo_getipbinfo+$onlineinfo_getsmfinfo+$new_bugs+$new_gametop+$new_game+$new_tube+$new_link+$new_downloads+$new_blog+$new_copper+$new_picture+$new_content+$new_guestbook+$new_users+$new_forum+$new_suggestions+$new_joke+$new_chat2+$new_chat+$new_comments+$new_news;

//var_dump ($checkfornew);

// O tipo de menu passa a ser definido no próprio template... isto tem de sair daqui, para um shortcode, por exemplo... ou com uma constante definida no próprio template...

  if ($this->euser_pref['loginmenutype']==0) {
//  $text_start .= "<a title='".LAN_EUSER_4039." ".($checkfornew>0 ? "(".$checkfornew.")" : "(0)")."'><img src='".e_PLUGIN."euser/images/news".($checkfornew>0?"_new":"").($this->euser_pref['loginmenutype']==0?"_24":"").".png' style='border:0; vertical-align: middle'/>&nbsp;".($checkfornew>0?"<span class='onlineinfonew'>":"").$checkfornew."</a>&nbsp;&nbsp;";
  $text_start .= "<a title='".LAN_EUSER_4039." (".$checkfornew.")' ".(e107::isInstalled('list_new')?"href='".e_PLUGIN."list_new/list.php'":"")."><img src='".e_PLUGIN."euser/images/news".($checkfornew>0?"_new":"").($this->euser_pref['loginmenutype']==0?"_24":"").".png' style='border:0; vertical-align: middle'/>&nbsp;".($checkfornew>0?"<span class='onlineinfonew'>":"").$checkfornew."</a>&nbsp;&nbsp;";
  } else {
        $text_start .= "<div id='updates-title' style='cursor:hand; font-size: ".$onlineinfomenufsize."px; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".LAN_EUSER_4039.($checkfornew>0 ? " (".$checkfornew.")" : " (0)")."'>&nbsp;".LAN_EUSER_4039.($checkfornew>0 ? " (".$checkfornew.")" : " (0)")."</div>";
  }

// ISTO DEVE ESTAR REPETIDO NO MENU
	    $text_start .= "<div id='updates' class='switchgroup1' style='display:none'>";
        $text_start .= "<table style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px; margin-right:5px;'><tr><td>";
  
    }
    else
    {
*/
// A partir de agora, esta linha vem do caption do próprio menu....
//    	$text_start .= "<div class='smallblacktext' style='font-size: ".$onlineinfomenufsize."px; font-weight:bold; width:".$onlineinfomenuwidth."'>".LAN_EUSER_4039."</div><div style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px; margin-right:5px;'><table style='text-align:left; width:".$onlineinfomenuwidth."'><tr><td>";
    	$text_start .= "<div style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px; margin-right:5px;'><table style='text-align:left; width:".$onlineinfomenuwidth."'><tr><td>";
//----    }

/* Passou para o caption....
 if ($this->euser_pref['whatsnewtype'] == 1){
    $text_start .= "<a href='" . e_PLUGIN . "euser/new.php'>" . LAN_EUSER_4024 . "</a>";
    }else{
    $text_start .= "<a href='" . e_PLUGIN . "list_new/list.php?new'>" . LAN_EUSER_4024 . "</a>";
}
*/

if ($this->euser_pref['new_icon'] == 1)
        {
		$newicon="<img src='" . e_PLUGIN . "euser/images/" . $this->euser_pref['new_icontype'] . "' alt='' style='vertical-align:middle' />";
		}else{
		$newicon="";
		}

if($unreadpms==0)
{
$n=0;
}

if ($this->euser_pref['flashtext'] == 1)
        {
        $flashnew[0]="<div id='flashlink";
        $flashnew[1]="' flashtype=0 flashcolor='".$onlineinfomenucolour."'>";

        }else{
        $flashnew[0]="<div ";
        $flashnew[1]="style='text-align:left;'>";
        $n="";
        }


$newitems=0;

////#######CORE LOGIN MENU CODE
/// ?????????????????????????????????????????????????????????????????????
/* Passou para baixo, para depois do eval
if (!$EUSER_EXTRAINFO_MENU_STATS) {
		if (file_exists(THEME."extrainfo_menu_template.php")){
	   		require(THEME."extrainfo_menu_template.php");
//	   		require(THEME."login_menu_template.php");
		}else{
			require(e_PLUGIN."euser/templates/extrainfo_menu_template.php");
//			require(e_PLUGIN."login_menu/login_menu_template.php");
		}
	}
*/
//print_r (getcachedvars('login_menu_data'));
//e107::setRegistry('login_menu_data', array('enable_stats' => 1, 'test' => 1));
/////////-------------------------------$loginPrefs = e107::getConfig('menu')->getPref('login_menu');
/////////-------------------------------	$menu_data['enable_stats'] = true;
/////////-------------------------------			cachevars('login_menu_data', $menu_data);
//print_r (getcachedvars('login_menu_data'));

//$mes = e107::getMessage();
//$mes->addDebug("-vvvvvvvv-");
//////$mes->addDebug(var_dump($dom));

//////$mes->addDebug("---------");
//////$mes->addDebug(htmlspecialchars($field_div->saveHTML(), ENT_QUOTES));
//////$mes->addDebug("---------");
//$mes->addDebug(htmlspecialchars($html_fragment, ENT_QUOTES));
//$mes->addDebug("---------");
//$mes->addDebug(getcachedvars('login_menu_data'));

//$mes->addDebug("-^^^^^^^^-");

//				global $LOGIN_MENU_STATS;
//var_dump ($EUSER_WHATSNEW_MENU_STATS);
//$text_start .= $LOGIN_MENU_STATS;
//global $LOGIN_MENU_STATS;
//////////////////////////////$extrainfo_menu_shortcodes = e107::getScBatch('extrainfo_menu', 'euser');
//				$text_start .= $tp -> parseTemplate($EUSER_EXTRAINFO_MENU_STATS, true, $extrainfo_menu_shortcodes);

// PARTIMOS PARA A VERSÃO CURTO E GROSSO...
// Adição do código do user_menu do core
/*
$text_start .= "»»»»»»»»»»<hr>";
$text_start .= str_replace("\$ns->tablerender(\$caption, \$text_start, 'login');", "", file_get_contents(e_PLUGIN."login_menu/login_menu.php"));
$text_start .= "<hr>««««««««««";
*/

$core_login_menu = str_replace(array("\$ns->tablerender(\$caption, \$text, 'login');","<?php","?\>"), "", file_get_contents(e_PLUGIN."login_menu/login_menu.php"));

/*
$mes = e107::getMessage();
$mes->addDebug("-vvvvvvvv-");
$mes->addDebug($core_login_menu);
$mes->addDebug("-^^^^^^^^-");
*/

//ob_start();
eval ($core_login_menu);
//<?
//ob_end_clean();
//$text .= $core_login_menu;


//var_dump ($text); 
//------------$text .= '<ul class="login-menu-logged nav nav-list">'.strstr($text, '<li class="nav-header login-menu-stats');
//var_dump ($text); 


//  global $tp;
  
//  $template = e107::getTemplate('euser', 'extrainfo_menu');
 // var_dump ($template);
  $sc = e107::getScBatch('login_menu',TRUE);
//  $temp_shortcodes->wrapper('all_menu/logged');
//$EXTRAINFO_MENU_TEMPLATE['core'] = '<ul class="login-menu-logged nav nav-list"><li class="nav-header login-menu-stats smalltext">'.LAN_LOGINMENU_25.':</li><li>{LM_STATS}</li></ul>';

//  var_dump ($template);
// Dá para customizar... fixe... $LOGIN_MENU_STATITEM = '----------{LM_STAT_NEW} {LM_STAT_LABEL}{LM_STAT_EMPTY}--------------';
    	$text = $this->tp->parseTemplate($this->template['login_menu'], true, $sc);



/*
$dom = new DOMDocument;
$dom->loadHTML($text);
$xPath = new DOMXPath($dom);
$nodes = $xPath->query("//li[@class='login-menu-']");
if($nodes->item(0)) {
    $nodes->item(0)->parentNode->removeChild($nodes->item(0));
}
var_dump($dom->saveHTML());
*/
/*
if (!$EUSER_EXTRAINFO_MENU_STATS) {
		if (file_exists(THEME."extrainfo_menu_template.php")){
	   		require(THEME."extrainfo_menu_template.php");
//	   		require(THEME."login_menu_template.php");
		}else{
			require(e_PLUGIN."euser/templates/extrainfo_menu_template.php");
//			require(e_PLUGIN."login_menu/login_menu_template.php");
		}
	}
*/
//eval ($core_login_menu);
//$caption = "";
// Inclui fallback no caso do core menu não existir....
$text .= ($core_login_menu?"":"<div style='font-weight:bold;'>".LAN_EUSER_4027."</div>").$text_start;
//$text = "»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»»";

//	$sc = e107::getScBatch('all_menu', 'euser');
//				$text .= $tp -> parseTemplate($EUSER_EXTRAINFO_MENU_STATS, true, $sc);
//echo ">>>>>>>>>".$LOGIN_MENU_STATS."<<<<<<<";
//				$text = $LOGIN_MENU_STATS;
////##################################################################################
// FUTURAMENTE DAQUI PARA BAIXO POR ISTO TUDO EM SHORTCODES.....
// Inclui fallback no caso do core menu não existir....
//if($this->euser_pref['shownews']==1){
if($this->euser_pref['shownews']==1 && !$core_login_menu){

    if ($new_news <> ONLINEINFO_COUNTER_L9)
    {
            $text .= $flashnew[0].$n.$flashnew[1].$new_news." ".($new_news == 1 ? LAN_EUSER_4014 : LAN_EUSER_4015).$newicon."</div>";
            $newitems++;
            if ($this->euser_pref['flashtext'] == 1){$n++;}
    }
    else
    {
    	if($this->euser_pref['hideifnonew']==0){    	
        $text .= "<div style='text-align:left;'>".$new_news." ".LAN_EUSER_4015."</div>";
        $newitems++;
        }
        
    }
}

    if ($this->euser_pref['content'] == 1)
	    {
	    if ($new_content <> ONLINEINFO_COUNTER_L9)
		        {
		         $text .= $flashnew[0].$n.$flashnew[1].$new_content." ".($new_content == 1 ? LAN_EUSER_4058 : LAN_EUSER_4059).$newicon."</div>";
		         $newitems++;
		          if ($this->euser_pref['flashtext'] == 1){$n++;}
		        }
		        else
		        {
		        	if($this->euser_pref['hideifnonew']==0){    	
		            $text .= "<div style='text-align:left;'>".$new_content." ".LAN_EUSER_4059."</div>";
		            $newitems++;
					}
	        }



}

// Inclui fallback no caso do core menu não existir....
//if($this->euser_pref['shownews']==1){
if(!$core_login_menu){
    if ( $new_comments <> ONLINEINFO_COUNTER_L9)
	    {
	            $text .= $flashnew[0].$n.$flashnew[1].$new_comments." ".($new_comments == 1 ? LAN_EUSER_4018 : LAN_EUSER_4019).$newicon."</div>";
	            $newitems++;
	            if ($this->euser_pref['flashtext'] == 1){$n++;}
	    }
	    else
	    {
	    	if($this->euser_pref['hideifnonew']==0){    	
	        $text .= "<div style='text-align:left;'>".$new_comments." ".LAN_EUSER_4019."</div>";
	        $newitems++;
	        }
   		}
}


    if ($this->euser_pref['chatbox'] == 1)
    {


    if ($new_chat <> ONLINEINFO_COUNTER_L9)
    {
	    $text .= $flashnew[0].$n.$flashnew[1].$new_chat." ".($new_chat == 1 ? LAN_EUSER_4016 : LAN_EUSER_4017).$newicon."</div>";    
	    $newitems++;    
	    if ($this->euser_pref['flashtext'] == 1){$n++;}
    
    }else{
    	if($this->euser_pref['hideifnonew']==0){    	
        $text .= "<div style='text-align:left;'>".$new_chat." ".LAN_EUSER_4017."</div>";
        $newitems++;
        }
    }



	}
	
	    if ($this->euser_pref['chatboxII'] == 1)
    {


    if ($new_chat2 <> ONLINEINFO_COUNTER_L9)
    {
	    $text .= $flashnew[0].$n.$flashnew[1].$new_chat2." ".($new_chat2 == 1 ? LAN_EUSER_40112 : LAN_EUSER_40113).$newicon."</div>";    
	    $newitems++;    
	    if ($this->euser_pref['flashtext'] == 1){$n++;}
    
    }else{
    	if($this->euser_pref['hideifnonew']==0){    	
        $text .= "<div style='text-align:left;'>".$new_chat2." ".LAN_EUSER_40113."</div>";
        $newitems++;
        }
    }



	}
	
	    if ($this->euser_pref['joke'] == 1)
    {


    if ($new_joke <> ONLINEINFO_COUNTER_L9)
    {
	    $text .= $flashnew[0].$n.$flashnew[1].$new_joke." ".($new_joke == 1 ? LAN_EUSER_40117 : LAN_EUSER_40118).$newicon."</div>";    
	    $newitems++;    
	    if ($this->euser_pref['flashtext'] == 1){$n++;}
    
    }else{
    	if($this->euser_pref['hideifnonew']==0){    	
        $text .= "<div style='text-align:left;'>".$new_joke." ".LAN_EUSER_40118."</div>";
        $newitems++;
        }
    }



	}	
	
	    if ($this->euser_pref['suggestions'] == 1)
    {


    if ($new_suggestions <> ONLINEINFO_COUNTER_L9)
    {
	    $text .= $flashnew[0].$n.$flashnew[1].$new_suggestions." ".($new_suggestions == 1 ? LAN_EUSER_40121 : LAN_EUSER_40122).$newicon."</div>";    
	    $newitems++;    
	    if ($this->euser_pref['flashtext'] == 1){$n++;}
    
    }else{
    	if($this->euser_pref['hideifnonew']==0){    	
        $text .= "<div style='text-align:left;'>".$new_suggestions." ".LAN_EUSER_40122."</div>";
        $newitems++;
        }
    }

	}
	
	
	
    if ($this->euser_pref['forum'] == 1)
    {

    if ($new_forum <> ONLINEINFO_COUNTER_L9)
    {
      $text .= $flashnew[0].$n.$flashnew[1].$new_forum." ".($new_forum == 1 ? LAN_EUSER_4020 : LAN_EUSER_4021).$newicon."</div>";
      $newitems++;
      if ($this->euser_pref['flashtext'] == 1){$n++;}
    }
    else
    {
    	if($this->euser_pref['hideifnonew']==0){    	
        $text .= "<div style='text-align:left;'>".$new_forum." ".LAN_EUSER_4021."</div>";
        $newitems++;
        }   	
    }

    }
//$text .= print_r($this->euser_pref['downloads'] == 1);
//$text .= "AQUI!!!!";

    if ($this->euser_pref['downloads'] == 1)
    {
        if ($new_downloads <> ONLINEINFO_COUNTER_L9)
        {
          $text .= $flashnew[0].$n.$flashnew[1].$new_downloads." ".($new_downloads == 1 ? LAN_EUSER_4032 : LAN_EUSER_4033).$newicon."</div>";
          $newitems++;
           if ($this->euser_pref['flashtext'] == 1){$n++;}
        }
        else
        {
        	if($this->euser_pref['hideifnonew']==0){    	
            $text .= "<div style='text-align:left;'>".$new_downloads." ".LAN_EUSER_4033."</div>";
            $newitems++;
            }
        }


    }

if ($this->euser_pref['smfuse']==1)
	{

	if ($onlineinfo_getsmfinfo <> ONLINEINFO_COUNTER_L9)
		        {
                $text .= $flashnew[0].$n.$flashnew[1].$onlineinfo_getsmfinfo." ".($onlineinfo_getsmfinfo == 1 ? LAN_EUSER_40104 : LAN_EUSER_40105).$newicon."</div>";
                $newitems++;
                if ($this->euser_pref['flashtext'] == 1){$n++;}
		        }
		        else
		        {
		        	if($this->euser_pref['hideifnonew']==0){    	
		         $text .= "<div style='text-align:left;'>".$onlineinfo_getsmfinfo." ".LAN_EUSER_40105."</div>";
		         $newitems++;
		         }
        		}



	}


if ($this->euser_pref['ibfuse']==1)
	{

	if ($onlineinfo_getipbinfo <> ONLINEINFO_COUNTER_L9)
		        {
                $text .= $flashnew[0].$n.$flashnew[1].$onlineinfo_getipbinfo." ".($onlineinfo_getipbinfo == 1 ? LAN_EUSER_4064 : LAN_EUSER_4065).$newicon."</div>";
                $newitems++;
                if ($this->euser_pref['flashtext'] == 1){$n++;}
		        }
		        else
		        {
		        	if($this->euser_pref['hideifnonew']==0){    	
		         $text .= "<div style='text-align:left;'>".$onlineinfo_getipbinfo." ".LAN_EUSER_4065."</div>";
		         $newitems++;
		         }
        		}



	}


if ($this->euser_pref['gallery2use']==1)
	{

	if ($onlineinfo_getgallery2info <> ONLINEINFO_COUNTER_L9)
		        {
                $text .= $flashnew[0].$n.$flashnew[1].$onlineinfo_getgallery2info." ".($onlineinfo_getgallery2info == 1 ? LAN_EUSER_4086 : LAN_EUSER_4087).$newicon."</div>";
                $newitems++;
                if ($this->euser_pref['flashtext'] == 1){$n++;}
		        }
		        else
		        {
		        	if($this->euser_pref['hideifnonew']==0){    	
		         $text .= "<div style='text-align:left;'>".$onlineinfo_getgallery2info." ".LAN_EUSER_4087."</div>";
		         $newitems++;
		         }
        		}



	}




if ($this->euser_pref['guestbook'] == 1)
    {
    if ($new_guestbook <> ONLINEINFO_COUNTER_L9)
	        {
            $text .= $flashnew[0].$n.$flashnew[1].$new_guestbook." " . ($new_guestbook == 1 ? LAN_EUSER_4053 : LAN_EUSER_4054).$newicon."</div>";
            $newitems++;
			if ($this->euser_pref['flashtext'] == 1){$n++;}
	        }
	        else
	        {
	        	if($this->euser_pref['hideifnonew']==0){    	
	         $text .= "<div style='text-align:left;'>".$new_guestbook." ".LAN_EUSER_4054."</div>";
	         $newitems++;
	         }
       		 }


}


    if ($this->euser_pref['coppermine'] == 1)
    {
        if ($new_picture <> ONLINEINFO_COUNTER_L9)
        {
         $text .= $flashnew[0].$n.$flashnew[1].$new_picture." ".($new_picture == 1 ? LAN_EUSER_4034 : LAN_EUSER_4035).$newicon."</div>";
         $newitems++;
         if ($this->euser_pref['flashtext'] == 1){$n++;}
        }
        else
        {
        	if($this->euser_pref['hideifnonew']==0){    	
            $text .= "<div style='text-align:left;'>".$new_picture." ".LAN_EUSER_4035."</div>";
            $newitems++;
            }
        }


    }
    
    
        if ($this->euser_pref['sa_coppermineuse'] == 1)
    {
        if ($new_copper <> ONLINEINFO_COUNTER_L9)
        {
         $text .= $flashnew[0].$n.$flashnew[1].$new_copper." ".($new_copper == 1 ? LAN_EUSER_40114 : LAN_EUSER_40115).$newicon."</div>";
         $newitems++;
         if ($this->euser_pref['flashtext'] == 1){$n++;}
        }
        else
        {
        	if($this->euser_pref['hideifnonew']==0){    	
            $text .= "<div style='text-align:left;'>".$new_copper." ".LAN_EUSER_40115."</div>";
            $newitems++;
            }
        }

    }
//$text .= "----------------";
    
    if ($this->euser_pref['youtube'] == 1)
{
    
    if ($new_tube <> ONLINEINFO_COUNTER_L9)
        {
         $text .= $flashnew[0].$n.$flashnew[1].$new_tube." ".($new_tube == 1 ? LAN_EUSER_4088 : LAN_EUSER_4089).$newicon."</div>";
         $newitems++;
         if ($this->euser_pref['flashtext'] == 1){$n++;}
        }
        else
        {
        	if($this->euser_pref['hideifnonew']==0){    	
            $text .= "<div style='text-align:left;'>".$new_tube." ".LAN_EUSER_4089."</div>";
            $newitems++;
            }
        }


    }
    
        if ($this->euser_pref['kroozearcade'] == 1)
{
    
    if ($new_game <> ONLINEINFO_COUNTER_L9)
        {
         $text .= $flashnew[0].$n.$flashnew[1].$new_game." ".($new_game == 1 ? LAN_EUSER_40100 : LAN_EUSER_40101).$newicon."</div>";
         $newitems++;
         if ($this->euser_pref['flashtext'] == 1){$n++;}
        }else{
        	if($this->euser_pref['hideifnonew']==0){    	
            $text .= "<div style='text-align:left;'>".$new_game." ".LAN_EUSER_40101."</div>";
            $newitems++;
            }
        }


    }
    
    
            if ($this->euser_pref['kroozearcadetop'] == 1)
{
    
    if ($new_gametop <> ONLINEINFO_COUNTER_L9)
        {
         $text .= $flashnew[0].$n.$flashnew[1].$new_gametop." ".($new_gametop == 1 ? LAN_EUSER_40102 : LAN_EUSER_40103).$newicon."</div>";
         $newitems++;
         if ($this->euser_pref['flashtext'] == 1){$n++;}
        }else{
        	if($this->euser_pref['hideifnonew']==0){    	
            $text .= "<div style='text-align:left;'>".$new_gametop." ".LAN_EUSER_40103."</div>";
            $newitems++;
            }
        }


    }
    
    

if ($this->euser_pref['links'] == 1)
    {
        if ($new_link <> ONLINEINFO_COUNTER_L9)
	    {
			$newitems++;
	     $text .= $flashnew[0].$n.$flashnew[1].$new_link." ".($new_link == 1 ? LAN_EUSER_4060 : LAN_EUSER_4061).$newicon."</div>";
		if ($this->euser_pref['flashtext'] == 1){$n++;}

	    }
	    else
	    {
	    	if($this->euser_pref['hideifnonew']==0){    	
	        $text .= "<div style='text-align:left;'>".$new_link." ".LAN_EUSER_4061."</div>";
			$newitems++;
	        }
    }
}



if ($this->euser_pref['bugtracker3'] == 1)
    {
        if ($new_bugs <> ONLINEINFO_COUNTER_L9)
	    {
		$newitems++;
	     $text .= $flashnew[0].$n.$flashnew[1].$new_bugs." ".($new_bugs == 1 ? LAN_EUSER_40109 : LAN_EUSER_40110).$newicon."</div>";
		if ($this->euser_pref['flashtext'] == 1){$n++;}

	    }
	    else
	    {
	    	if($this->euser_pref['hideifnonew']==0){    	
	        $text .= "<div style='text-align:left;'>".$new_bugs." ".LAN_EUSER_40110."</div>";
	        $newitems++;
	        }
    }
}


if ($this->euser_pref['blog'] == 1)
    {
        if ($new_blog <> ONLINEINFO_COUNTER_L9)
	    {
		$newitems++;
	     $text .= $flashnew[0].$n.$flashnew[1].$new_blog." ".($new_blog == 1 ? LAN_EUSER_40119 : LAN_EUSER_40120).$newicon."</div>";
		if ($this->euser_pref['flashtext'] == 1){$n++;}

	    }
	    else
	    {
	    	if($this->euser_pref['hideifnonew']==0){    	
	        $text .= "<div style='text-align:left;'>".$new_blog." ".LAN_EUSER_40119."</div>";
	        $newitems++;
	        }
    }
}



// Inclui fallback no caso do core menu não existir....
//	if ($this->euser_pref['members'] == 1){
if($this->euser_pref['members']==1 && !$core_login_menu){
	    if ($new_users <> ONLINEINFO_COUNTER_L9)
	    {
	        $text .= $flashnew[0].$n.$flashnew[1].$new_users." ".($new_users == 1 ? LAN_EUSER_4022 : LAN_EUSER_4023).$newicon."</div>";
			$newitems++;
	    }
	    else
	    {
	    	if($this->euser_pref['hideifnonew']==0){    	
	        $text .= "<div style='text-align:left;'>".$new_users." ".LAN_EUSER_4023."</div>";
	        $newitems++;
	        }
	    }	    
	    
	}
	
//VAR_DUMP ($checkfornew);	
//VAR_DUMP ($newitems);	
//VAR_DUMP ($newitems == 0);	
//VAR_DUMP (!$core_login_menu);
//	if($newitems == 0 && !$core_login_menu){$text .= "<div style='text-align:left; font-weight:bold;'>".LAN_EUSER_40111."</div>";}
	if($checkfornew == 0){$text = "<div style='text-align:left; font-weight:bold;'>".LAN_EUSER_4027." ".LAN_EUSER_40111."</div>";}
else {$text .= "</td></tr></table>";}	
/*
		if ($extrahide == 1){
		$text.="</td></tr></table><br /></div>";
		}else{
*/
//	        $text .= "</td></tr></table></div>";
//	        $text .= "</td></tr></table>";
//----	        }
	
//var_dump($checkfornew);
//var_dump($newitems);
      if ($parm['type'] == "total") { return ($parm['style'] == "label"?euser::makelabel($checkfornew):$checkfornew);}
//      if ($parm['type'] == "total") { return ($parm['style'] == "label"?euser::makelabel($newitems, $newitems):$newitems);}

}

// Isto só é chamado uma vez, pode vir para aqui definitivo, não???
//require_once(e_PLUGIN."euser/euser_lm_regusers.php");
/* ISTO JÁ ESTÁ NO ONLINE MENU...
//var_dump(check_class($this->euser_pref['showregusers'])); FALSO
if(check_class($this->euser_pref['showregusers'])){


    if ($this->euser_pref['loginmenutype']!=0){
if ($this->euser_pref['hideregusers'] == 1)
{

$text .= "<div id='regu-title' style='cursor:hand; text-align:left; font-size: ".$onlineinfomenufsize."px; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".LAN_EUSER_4079."'>&nbsp;".LAN_EUSER_4079."</div>";
	$text .= "<div id='regu' class='switchgroup1' style='display:none;'>";
  
}else{

	$text .= "<div>";
}
  }

// Remove from total banned users.....
//    $total_members = $this->sql->db_Count("user");

$total_members = $this->sql->db_Count("user","(*)", "WHERE user_ban = 0");
    if ($total_members > 1)
    {
        $newest_member = $this->sql->db_Select("user", "user_id, user_name", "ORDER BY user_join DESC LIMIT 0,1", "no_where");
        $row = $this->sql->db_Fetch();
        extract($row);

    if ($this->euser_pref['loginmenutype']==0){
    $text .= "<br><a title='".ONLINE_EL5.$total_members.ONLINE_EL10."' href='".e_BASE."user.php'><img src='".e_PLUGIN."euser/images/members".($this->euser_pref['loginmenutype']==0?"_24":"").".png' style='border:0; vertical-align: middle'/>&nbsp;".$total_members."</a>&nbsp;&nbsp;
      <a title='".ONLINE_EL6.": ".$user_name."' href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id)."><img src='".e_PLUGIN."euser/images/member_recent".($this->euser_pref['loginmenutype']==0?"_24":"").".png' style='border:0; vertical-align: middle'/></a>&nbsp;&nbsp;";

    } else {
    $text .= "<div class='smallblacktext' style='margin-left:5px; width:".$onlineinfomenuwidth."'>" . ONLINE_EL5 . $total_members . ONLINE_EL10 . "</div>
           	<div style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'>".ONLINE_EL6.": <a href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".$user_name."</a></div>";
    }
    }

//$text.="<br />";


}
*/
				return $text;
			}

/*
updated
birthday
lastvisitors
topvisits
toppost
toppoststarter
toppostreplier
topratedmember
counter
*/

	function sc_ewnm_birthday($parm='')
	{

if(check_class($this->var['cache_userclass'])){
//if(check_class($extraclass)){

//$this->sql = e107::getDb();

	$birthdayavatar=$this->euser_pref['bavatar'];

	
    $onlineinfo_birthday_sql = new db;

    $onlineinfo_birthday_now = time();
    $onlineinfo_birthday_today = date("Y-m-d", $onlineinfo_birthday_now);
    $onlineinfo_birthday_month = date("m", $onlineinfo_birthday_now);
    $onlineinfo_birthday_day = date("d", $onlineinfo_birthday_now);
    $onlineinfo_birthday_year = date("Y", $onlineinfo_birthday_now);
    
    $BDAY_now = time();
    
/* NÃO PRECISO DA CACHE
    	if($extraacache==1){
		$cachet = $extracachetime*60;
		$currenttime=time();
		
		$script="SELECT * FROM ".MPREFIX."euser_cache Where type='birthday'";		
		$this->sql->db_Select_gen($script);	
		while ($row = $this->sql->db_Fetch())
        {
        	extract($row);            
        $lasttimerun= $cache_timestamp;   
        }
        
        	
    	if(($currenttime - $lasttimerun) > $cachet){
		//run cache update
			$buildcache="";
		
			$script="select *,YEAR(NOW()) - YEAR(user_birthday) -( DATE_FORMAT(NOW(), '%m-%d') < DATE_FORMAT(user_birthday, '%m-%d')) AS age
from #user_extended left join #user on user_extended_id = user_id
where (YEAR(NOW()) - YEAR(user_birthday) -( DATE_FORMAT(NOW(), '%m-%d') < DATE_FORMAT(user_birthday, '%m-%d'))!=-1) AND (user_birthday != '0000-00-00' and user_name!='' AND ((DAYOFYEAR(CONCAT(DATE_FORMAT(NOW(), '%Y-'), DATE_FORMAT(user_birthday,'%m-%d'))) < DAYOFYEAR(now()))*366)+
DAYOFYEAR(CONCAT(DATE_FORMAT(NOW(), '%Y-'), DATE_FORMAT(user_birthday,'%m-%d')))>=DAYOFYEAR(now())) ORDER BY
((DAYOFYEAR(CONCAT(DATE_FORMAT(NOW(), '%Y-'), DATE_FORMAT(user_birthday,'%m-%d'))) < DAYOFYEAR(now())) * 366) + DAYOFYEAR(CONCAT(DATE_FORMAT(NOW(), '%Y-'), DATE_FORMAT(user_birthday,'%m-%d'))),date_format(user_birthday,'%m%d') asc
limit 0,".$extrarecords."";
		
		if (!$this->sql->db_Select_gen($script)){
			
			 $arraydata="0|".ONLINEINFO_BDAY_L2;
			
		}else{
			$setarray=0;
			while ($row = $this->sql->db_Fetch())
       			 {
          			 	extract($row);  
          			 	
						$onlineinfo_birthday_age  = date("Y-m-d", $BDAY_now) - $user_birthday;
						             
            			$buildcache[$setarray] = $user_id."|".$user_name."=>".$user_birthday."¬".$onlineinfo_birthday_age;						
						$setarray++;
            	}
        			$arraydata="";					
					for ($y = 0; $y <= ($setarray-1); $y++)
					{
	 					$arraydata.=$buildcache[$y];
						$arraydata.= ($y < $setarray-1 ) ? "," : "";
					}					
						
				
			}
			
			$this->sql -> db_Update("euser_cache", "cache='".$arraydata."',cache_timestamp='".time()."' WHERE type='birthday'");
			
		}	
		 //use cache
		 $x=0;
		 $y=0;
		 
		$script="SELECT * FROM ".MPREFIX."euser_cache Where type='birthday'";
		$this->sql->db_Select_gen($script);	
		while ($row = $this->sql->db_Fetch())
        {
        	extract($row);
        	
        	$blowdata = explode(",", $cache);        	
        	$countdata= count($blowdata);
        	
        	for ($z = 0; $z <= ($countdata-1); $z++)
        	{				
        		$blowmoredata = explode("=>",$blowdata[$z]);        
				$blowdataagain = explode("|",$blowmoredata[0]);
				$blowevenmoredata=explode("¬",$blowmoredata[1]);						
        		$onlineinfo_birthday_datepart = explode("-", $blowevenmoredata[0]);		
				$user_birthday = $onlineinfo_birthday_datepart[1]."-".$onlineinfo_birthday_datepart[2];	
				$onlineinfo_birthday_age = $blowevenmoredata[1];
        		$user_id = $blowdataagain[0];
				$user_name = $blowdataagain[1];
					
					
					if($user_birthday == date("m-d",time()))
					{
				 
					 	if($y==0){
						  $hbtext .= "<div style='text-align:center;'><img src='".e_PLUGIN."euser/images/hb.gif' alt='Happy Birthday' /></div><div style='text-align:center; font-size: 14px; font-weight:bold;'><table width='100%'>";
						  $y++;
						 }
						 
$sql2 = e107::getDb();
						 // AVATAR ADDITION
						 $script="SELECT user_image FROM ".MPREFIX."user Where user_id='".$user_id."'";
		$sql2->db_Select_gen($script);	
		while ($row2 = $sql2->db_Fetch())
        {
        	extract($row2);
        	$avatar= $row2['user_image'];
        	$avatar = str_replace(" ", "%20", $avatar);
        	if ($row2['user_image'] == "")
                        {
                            $avatar =  e_PLUGIN.'euser/images/default.png';
						}else{				
						
			require_once(e_HANDLER."avatar_handler.php");
				$avatar = avatar($avatar);
				}	
        }
        
        if($birthdayavatar==1){
			$bavatar="<a href='javascript:void(0)' onMouseover='onlineinfoddrivetip(\"<center><img src=".e_PLUGIN."euser/images/hb.gif /><img src=".$avatar."><br /><b>".$user_name."<br />".$onlineinfo_birthday_age." ".ONLINEINFO_BDAY_L0."</b></center>\",\"\",\"150\")'  onMouseout='hideonlineinfoddrivetip()'><img src='".$avatar."' width='25' alt='' border='0' /></a>";
		}else{
			$bavatar="";
		}
						 
						 
				 		$hbtext .= "<tr><td>".$bavatar."</td><td style='text-align:left; font-size: 14px; font-weight:bold;'><a href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".$user_name." (".$onlineinfo_birthday_age.")</a></td></tr>";
					}else{
								
				
				
				if($user_id==0){  //no data				 
							     if ($extrahide == 1)
			    				{
			
			           				 $nbtext .= "<div id='bdays-title' style='cursor:hand; text-align:left; font-size: ".$onlineinfomenufsize."px; vertical-align: middle; width:".$onlineinfomenuwidth.";' title='".ONLINEINFO_BDAY_L3."'><b>&nbsp;".ONLINEINFO_BDAY_L3."</b></div>";
				       				 $nbtext .= "<div id='bdays' class='switchgroup1' style='display:none'>";
			   					 }
			   					 else
			   					 {
			   	    				 $nbtext .= "<div class='smallblacktext' style='font-size: ".$onlineinfomenufsize."px; font-weight:bold; margin-left:5px; margin-top:10px; width:".$onlineinfomenuwidth."'>".ONLINEINFO_BDAY_L3."</div>";
			   					 }
			   					 	 $nbtext .= "<div class='smalltext' style='text-align:left; width:".$onlineinfomenuwidth.";'>". ONLINEINFO_BDAY_L2 ."</div>";						 
				 }else{

						//data
						
						if($x==0){
						if ($extrahide == 1)
   						 {

        				    $nbtext .= "<div id='bdays-title' style='cursor:hand; text-align:left; font-size: ".$onlineinfomenufsize."px; vertical-align: middle; width:".$onlineinfomenuwidth.";' title='".ONLINEINFO_BDAY_L3."'><b>&nbsp;".ONLINEINFO_BDAY_L3."</b></div>";
	        				$nbtext .= "<div id='bdays' class='switchgroup1' style='display:none'>";
    					}else{
        					$nbtext .= "<div class='smallblacktext' style='font-size: ".$onlineinfomenufsize."px; font-weight:bold; margin-left:5px; margin-top:10px; width:".$onlineinfomenuwidth."'>".ONLINEINFO_BDAY_L3."</div>";
   						 }
							$x++;
							}
						
						if ($this->euser_pref['formatbdays'] == "1"){
               				 $nbtext .= "<div style='margin-left:5px; text-align:left; width:".$onlineinfomenuwidth.";'>".$onlineinfo_birthday_datepart[2]."/".$onlineinfo_birthday_datepart[1]." <a title='".$onlineinfo_birthday_datepart[2].".".$onlineinfo_birthday_datepart[1].".".$onlineinfo_birthday_datepart[0]."' href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".$user_name." (".$onlineinfo_birthday_age.")</a></div>";
           				 }else{
                			 $nbtext .= "<div style='margin-left:5px; text-align:left; width:".$onlineinfomenuwidth.";'>".$onlineinfo_birthday_datepart[1]."/".$onlineinfo_birthday_datepart[2]." <a title='".$onlineinfo_birthday_datepart[2].".".$onlineinfo_birthday_datepart[1].".".$onlineinfo_birthday_datepart[0]."' href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".$user_name." (".$onlineinfo_birthday_age.")</a></div>";
        }
										
				}
				
			}          	
        }
        
        if($y==0){$text.= $nbtext;}else{$text.= $hbtext."</table></div>".$nbtext;}
        
        
        
        
		 
		 }
		 
		 }else{
*/		
    		// no cache
    		$script="select *,YEAR(NOW()) - YEAR(user_birthday) -( DATE_FORMAT(NOW(), '%m-%d') < DATE_FORMAT(user_birthday, '%m-%d')) AS age from #user_extended left join #user on user_extended_id = user_id where (YEAR(NOW()) - YEAR(user_birthday) -( DATE_FORMAT(NOW(), '%m-%d') < DATE_FORMAT(user_birthday, '%m-%d'))!=-1) AND (user_birthday != '000-/00-00' and user_name!='' AND ((DAYOFYEAR(CONCAT(DATE_FORMAT(NOW(), '%Y-'), DATE_FORMAT(user_birthday,'%m-%d'))) < DAYOFYEAR(now()))*366)+ DAYOFYEAR(CONCAT(DATE_FORMAT(NOW(), '%Y-'), DATE_FORMAT(user_birthday,'%m-%d')))>=DAYOFYEAR(now())) ORDER BY ((DAYOFYEAR(CONCAT(DATE_FORMAT(NOW(), '%Y-'), DATE_FORMAT(user_birthday,'%m-%d'))) < DAYOFYEAR(now())) * 366) + DAYOFYEAR(CONCAT(DATE_FORMAT(NOW(), '%Y-'), DATE_FORMAT(user_birthday,'%m-%d'))),date_format(user_birthday,'%m%d') asc limit 0,".$extrarecords."";

$x=0;
$y=0;
			$this->sql->db_Select_gen($script);
    		while ($row = $this->sql->db_Fetch())
       			 {
          			 	extract($row);  
          			 	
									$onlineinfo_birthday_age  = date("Y-m-d", $BDAY_now) - $user_birthday;
									
    					$onlineinfo_birthday_datepart = explode("-", $user_birthday);		
						$user_birth = $onlineinfo_birthday_datepart[1]."-".$onlineinfo_birthday_datepart[2];	
    
    					
					if($user_birth == date("m-d",time()))
					{
				 
					 	if($y==0){
						  $hbtext .= "<div style='text-align:center;'><img src='".e_PLUGIN."euser/images/hb.gif' alt='Happy Birthday' /></div><div style='text-align:center; font-size: 14px; font-weight:bold;'><table width='100%'>";
						  $y++;
						 }
						 
						  // AVATAR ADDITION
						   $script="SELECT user_image FROM ".MPREFIX."user Where user_id='".$user_id."'";
		$sql2->db_Select_gen($script);	
		while ($row2 = $sql2->db_Fetch())
        {
        	extract($row2);
        	$avatar= $row2['user_image'];
        	$avatar = str_replace(" ", "%20", $avatar);
        	if ($row2['user_image'] == "")
                        {
                            $avatar =  e_PLUGIN.'euser/images/default.png';
						}else{				
						
			require_once(e_HANDLER."avatar_handler.php");
				$avatar = avatar($avatar);
				}	
        }
						 
        if($birthdayavatar==1){
			$bavatar="<a href='javascript:void(0)' onMouseover='onlineinfoddrivetip(\"<center><img src=".e_PLUGIN."euser/images/hb.gif /><img src=".$avatar."><br /><b>".$user_name."<br />".$onlineinfo_birthday_age." ".ONLINEINFO_BDAY_L0."</b></center>\",\"\",\"150\")'  onMouseout='hideonlineinfoddrivetip()'><img src='".$avatar."' width='25' alt='' border='0' /></a>";
		}else{
			$bavatar="";
		}
						 
						 
				 		$hbtext .= "<tr><td>".$bavatar."</td><td style='text-align:left; font-size: 14px; font-weight:bold;'><a href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".$user_name." (".$onlineinfo_birthday_age.")</a></td></tr>";
					}else{
    
    	
						if($x==0){
/*
						if ($extrahide == 1)
   						 {

        				    $nbtext .= "<div id='bdays-title' style='cursor:hand; text-align:left; font-size: ".$onlineinfomenufsize."px; vertical-align: middle; width:".$onlineinfomenuwidth.";' title='".ONLINEINFO_BDAY_L3."'><b>&nbsp;".ONLINEINFO_BDAY_L3."</b></div>";
	        				$nbtext .= "<div id='bdays' class='switchgroup1' style='display:none'>";
    					}else{
*/
        					$nbtext .= "<div class='smallblacktext' style='font-size: ".$onlineinfomenufsize."px; font-weight:bold; margin-left:5px; margin-top:10px; width:".$onlineinfomenuwidth."'>".ONLINEINFO_BDAY_L3."</div>";
//----   						 }
							$x++;
							}
						
						if ($this->euser_pref['formatbdays'] == "1"){
               				 $nbtext .= "<div style='margin-left:5px; text-align:left; width:".$onlineinfomenuwidth.";'>".$onlineinfo_birthday_datepart[2]."/".$onlineinfo_birthday_datepart[1]." <a title='".$onlineinfo_birthday_datepart[2].".".$onlineinfo_birthday_datepart[1].".".$onlineinfo_birthday_datepart[0]."' href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".$user_name." (".$onlineinfo_birthday_age.")</a></div>";
           				 }else{
                			 $nbtext .= "<div style='margin-left:5px; text-align:left; width:".$onlineinfomenuwidth.";'>".$onlineinfo_birthday_datepart[1]."/".$onlineinfo_birthday_datepart[2]." <a title='".$onlineinfo_birthday_datepart[2].".".$onlineinfo_birthday_datepart[1].".".$onlineinfo_birthday_datepart[0]."' href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".$user_name." (".$onlineinfo_birthday_age.")</a></div>";
        }
    
    
    				}   
    
    			}
    			
    			if($y==0){$text.= $nbtext;}else{$text.= $hbtext."</table></div>".$nbtext;}
    
  
//----}

/*
  if ($extrahide == 1)
    {
        $text .= "<br /></div>";
    }
*/
				return $text;
}
//				return $text;
  }

	function sc_ewnm_lastvisitors($parm='')
	{

//  if(check_class($extraclass)){
if(check_class($this->var['cache_userclass'])){

      $tmp['HEAD']=LAN_EUSER_4031;
      $tmp['HEAD_ID']="lv";
//      ++$tmp['HEAD_ID'];
//      var_dump ($tmp['HEAD_ID']);
      $text .= $this->tp->parseTemplate($this->template['section_head'], true, $tmp);

if (file_exists(e_PLUGIN."online/lastseen_menu.php"))
{
	return $text .= $this->tp->parseTemplate("{EMBEDMENU:path=online&menu=lastseen}".$this->template['section_end'], true, $tmp);
}

//if(check_class($extraclass)){

//$this->sql = e107::getDb();

//----	if($extrahide==1){

// isto depois tem de passar para o template, é o inicio...
//----        $text .= "<div id='lastv-title' style='cursor:hand; text-align:left; font-size: ".$onlineinfomenufsize."px; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".LAN_EUSER_4031."'>&nbsp;".LAN_EUSER_4031."</div>";
//----	    $text .= "<div id='lastv' class='switchgroup1' style='display:none'>";
//----        $text .= "<table style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'>";


/*
	}else{

      $tmp['HEAD']=LAN_EUSER_4031;
    	$text = $this->tp->parseTemplate($this->template['stat_head'], true, $tmp);
*/


//	$text .= "<div class='smallblacktext' style='font-size: ".$onlineinfomenufsize."px; font-weight:bold; margin-left:5px; margin-top:10px; width:".$onlineinfomenuwidth."'>".LAN_EUSER_4031."</div><div style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'><table style='text-align:left; width:".$onlineinfomenuwidth."'>";

//----	}

//  var_dump ($this->var['cache_records']);
//	if($this->sql -> db_Select("user", "user_id, user_name, user_currentvisit", "ORDER BY user_currentvisit DESC LIMIT 0,".$extrarecords, "no_where")){
	if($this->sql -> db_Select("user", "user_id, user_name, user_currentvisit", "ORDER BY user_currentvisit DESC LIMIT 0,".($this->var['cache_records']?:10), "no_where")){
//		while(list($user_id, $user_name, $user_currentvisit) = $this->sql-> db_Fetch()){
		while($row = $this->sql-> db_Fetch()){
//			$user = $user_name;
//			$userid = $user_id;
			//$datestamp = date("d/m H:m", $user_currentvisit);
//			$datestamp = $gen->convert_date($user_currentvisit, "short");

//var_dump ($row);
      $tmp['LINE_START']="<a href='".e_BASE."user.php?id.".$row['user_id']."'><span ".getuserclassinfo($row['user_id']).">".$row['user_name']."</span></a>";
      $tmp['LINE_END']=e107::getDate()->convert_date($row['user_currentvisit'], "short");
    	$text .= $this->tp->parseTemplate($this->template['section_line'], true, $tmp);

//      $text .= "<tr><td style='vertical-align:top; text-align:left; width:50%;' nowrap><a href='".e_BASE."user.php?id.".$row['user_id']."'><span ".getuserclassinfo($row['user_id']).">".$row['user_name']."</span></a></td><td style='vertical-align:top; text-align:right; width:50%; padding-right:20px;' nowrap>".e107::getDate()->convert_date($row['user_currentvisit'], "short")."</td></tr>";

		}
	}else{
      $tmp['HEAD']=LAN_EUSER_4047;
    	$text .= $this->tp->parseTemplate($this->template['section_head'], true, $tmp);
//		$text .= "<div class='smalltext' style='text-align:left; width:".$onlineinfomenuwidth.";'>".LAN_EUSER_4047."</div>";
	}
//		$text .= "</table><br /></div>";
				return $text .= $this->tp->parseTemplate($this->template['section_end'], true, $tmp);
}

}

}
?>