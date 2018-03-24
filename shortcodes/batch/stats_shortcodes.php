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
include_once(e_PLUGIN.'euser/euser_class.php');

//		class plugin_euser_login_menu_shortcodes extends e_shortcode
// extende o login_menu_shortcodes para utilizar também os shortcodes do login menu do core....
		class plugin_euser_stats_shortcodes extends e_shortcode
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
		  private $eusersm;

			function __construct()
			{
				$this->sql = e107::getDb(); 
				$this->tp = e107::getParser();
        $this->template = e107::getTemplate('euser', 'stats_menu');
/*
        $this->eusersm = function($what) {
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
//Include forum_stats class não funciona, o código está no meio do init......
		// get all replies
		$total_posts = $this->sql->count('forum_post');

		$query = "
		SELECT COUNT(fp.post_id) AS post_count, u.user_name, u.user_id, fp.post_thread FROM #forum_post as fp
		LEFT JOIN #user AS u ON fp.post_user = u.user_id
		GROUP BY fp.post_user
		ORDER BY post_count DESC LIMIT 0,".($this->var['cache_records']?:10);

		$this->sql->gen($query);
	// 	$top_repliers_data = $this->sql->db_getList('ALL', false, false, 'user_id');
		$top_repliers_data = $this->sql->retrieve($query,true);

		// build top posters meanwhile
		$top_posters = array();
		$topReplier = array();
		foreach($top_repliers_data as $poster)
		{
			$percent = round(($poster['post_count'] / $total_posts) * 100, 2);
			$topReplier[] = intval($poster['user_id']);
			$top_posters[] = array("user_id" => $poster['user_id'], "user_name" => vartrue($poster['user_name'],LAN_ANONYMOUS), "user_forums" => $poster['post_count'], "percentage" => $percent);
		}
			// end build top posters

		// find topics by top 10 users
		$query = "
		SELECT COUNT(ft.thread_id) AS thread_count, u.user_id FROM #forum_thread as ft
		LEFT JOIN #user AS u ON ft.thread_user = u.user_id
		WHERE u.user_id IN ({$ids})	GROUP BY ft.thread_user";

		$this->sql->gen($query);
		$top_repliers_data_c = $this->sql->db_getList('ALL', false, false, 'user_id');

		$top_repliers = array();
		foreach($top_repliers_data as $uid => $poster)
		{
			$poster['post_count'] = $poster['post_count'] - $top_repliers_data_c[$uid]['thread_count'];
			$percent = round(($poster['post_count'] / $total_replies) * 100, 2);
			$top_repliers_sort[$uid] = $poster['post_count'];
			//$top_repliers[$uid] = $poster;
			$top_repliers_data[$uid]['user_forums'] = $poster['post_count'];
			$top_repliers_data[$uid]['percentage'] = $percent;
			//$top_repliers_data[$uid] = array("user_id" => $poster['user_id'], "user_name" => $poster['user_name'], "user_forums" => $poster['post_count'], "percentage" => $percent);
		}

		// sort

		arsort($top_repliers_sort, SORT_NUMERIC);

		// build top repliers
		foreach ($top_repliers_sort as $uid => $c)
		{
			$top_repliers[] = $top_repliers_data[$uid];
		}

		// get all replies
		$query = "
		SELECT COUNT(ft.thread_id) AS thread_count, u.user_name, u.user_id FROM #forum_thread as ft
		LEFT JOIN #user AS u ON ft.thread_user = u.user_id
		GROUP BY ft.thread_user
		ORDER BY thread_count DESC LIMIT 0,10";

		$this->sql->gen($query);
		$top_topic_starters_data = $this->sql->db_getList();
		$top_topic_starters = array();

		foreach($top_topic_starters_data as $poster)
		{
			$percent = round(($poster['thread_count'] / $total_topics) * 100, 2);
			$top_topic_starters[] = array("user_id" => $poster['user_id'], "user_name" => vartrue($poster['user_name'],LAN_ANONYMOUS), "user_forums" => $poster['thread_count'], "percentage" => $percent);
		}

    $this->top_posters = $top_posters;
    $this->top_starters = $top_topic_starters;
    $this->top_repliers = $top_repliers;

		}

/*
			function sc_esm_members($parm='')
			{
//				global $LOGIN_MENU_STATS;
//				$data = getcachedvars('login_menu_data');
//        var_dump ($data);
//        var_dump ($LOGIN_MENU_STATS);
//				if(!$data['enable_stats']) return '';
				return "STATS MEMBERS";
			}
*/

	function sc_esm_topvisits($parm='')
	{

if(check_class($this->var['cache_userclass'])){
//if(check_class($extraclass)){

    // Most Visits
//----    if ($extrahide == 1)
//----    {

//----                $text .= "<div id='topvisit-title' style='cursor:hand; text-align:left; font-size: ".$onlineinfomenufsize."px; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".LAN_EUSER_205."'>&nbsp;".LAN_EUSER_205."</div>";
//----		        $text .= "<div id='topvisit' class='switchgroup1' style='display:none'>";
//----        $text .= "<table style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'>";

//    }
//    else
//    {

//         $text .= "<div class='smallblacktext' style='font-size: ".$onlineinfomenufsize."px; font-weight:bold; margin-left:5px; margin-top:10px; width:".$onlineinfomenuwidth."'>".LAN_EUSER_205."</div><div style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'><table style='text-align:left; width:".$onlineinfomenuwidth."'>";

//----    }

//$this->sql = e107::getDb();

// Para que é que eu quero isto da extracache??? Provavelmente vai zarpar daqui... zarpou...
/*
	if($extraacache==1){
		$cachet = $extracachetime*60;
		$currenttime=time();
		
		
		$script="SELECT * FROM ".MPREFIX."euser_cache Where type='topvisits'";		
		$this->sql->db_Select_gen($script);	
		while ($row = $this->sql->db_Fetch())
        {
        	extract($row);            
        $lasttimerun= $cache_timestamp;   
        }
        
        	
    	if(($currenttime - $lasttimerun) > $cachet){	
		 	
			//run cache update
			$buildcache="";
			
      var_dump ("s-a,aslfm.asdmdasmd");
			if (!$this->sql->db_Select("user", "*", "ORDER BY user_visits DESC LIMIT 0, ".($this->var['cache_records']?:10), "no_where"))
    		{
    		 $arraydata="0|".LAN_EUSER_206;
    		 
     		}else{
     		 $setarray=0;
        		while ($row = $this->sql->db_Fetch())
       			 {
          			 	extract($row);            
            			$buildcache[$setarray] = $user_id."|".$user_name."=>".$user_visits;						
						$setarray++;
            	}
        			$arraydata="";					
					for ($y = 0; $y <= ($setarray-1); $y++)
					{
	 					$arraydata.=$buildcache[$y];
						$arraydata.= ($y < $setarray-1 ) ? "," : "";
					}					
						
				
			}
			
			$this->sql -> db_Update("euser_cache", "cache='".$arraydata."',cache_timestamp='".time()."' WHERE type='topvisits'");
			
		}				
			
			//use cache
			$script="SELECT * FROM ".MPREFIX."euser_cache Where type='topvisits'";
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
						
        		$user_visits = $blowmoredata[1];	
        		$user_id = $blowdataagain[0];
				$user_name = $blowdataagain[1];
				
				if($user_id==0){
				 $text .= "<div class='smalltext' style='text-align:left; width:".$onlineinfomenuwidth.";'>". LAN_EUSER_206 ."</div>";
				 }else{
				$text .= "<tr><td style='vertical-align:top; text-align:left; width:80%;'><a href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".$user_name."</a></td>
			<td style='vertical-align:top; text-align:right; width:20%; padding-right:20px;'>".$user_visits."</td></tr>";	
										
				}
				
			}          	
        }
			
			
	}else{
*/
    if ($this->sql->db_Select("user", "*", "ORDER BY user_visits DESC LIMIT 0, ".($this->var['cache_records']?:10), "no_where"))
    {
      $tmp['HEAD']=LAN_EUSER_205;
      $tmp['HEAD_ID']="tv";
      $text .= $this->tp->parseTemplate($this->template['section_head'], true, $tmp);

        while ($row = $this->sql->db_Fetch())
        {
//            var_dump ($row);
//            extract($row);

/* PASSOU PARA O RENDER_USER_LINE
      $tmp['LINE_START']="<a href='".e_BASE."user.php?id.".$row['user_id']."'><span ".getuserclassinfo($row['user_id']).">".$row['user_name']."</span></a>";
      $tmp['LINE_END']=$row['user_visits'];
    	$text .= $this->tp->parseTemplate($this->template['section_line'], true, $tmp);
*/
    	$text .= $this->render_user_line($row);
//$text .= "<tr><td style='vertical-align:top; text-align:left; width:80%;'><a href='".e_BASE."user.php?id.".$row['user_id']."' ".getuserclassinfo($row['user_id']).">".$row['user_name']."</a></td>
//			<td style='vertical-align:top; text-align:right; width:20%; padding-right:20px;'>".$row['user_visits']."</td></tr>";	
        }
    }else{
      $tmp['HEAD']=LAN_EUSER_206;
    	$text .= $this->tp->parseTemplate($this->template['section_head'], true, $tmp);
//        $text .= "<div class='smalltext' style='text-align:left; width:".$onlineinfomenuwidth.";'>". LAN_EUSER_206 ."</div>";
    }
    
//----}
//        $text .= "</table><br /></div>";
				return $text .= $this->tp->parseTemplate($this->template['section_end'], true, $tmp);;
}

//				return $text .= $this->tp->parseTemplate($this->template['section_end'], true, $tmp);;

  }  

/// PROVAVELMENTE JUNTO ESTES 3 SHORTCODES NUM SÓ E USO OS PARMS....
	function sc_esm_topforumpost($parm='')
	{

if(check_class($this->var['cache_userclass'])){

//Include forum_stats class não funciona, o código está no meio do init......
/*
if (!file_exists(e_PLUGIN.'forum/forum_stats.php')) {return;}
ob_start();
include_once (e_PLUGIN.'forum/forum_stats.php');
$frmStats = new forumStats;
    $test = $frmStats->init();
ob_end_clean();
*/
    // Forum
//----    if ($extrahide == 1)
//----    {

//----            $text .= "<div id='toppost-title' style='cursor:hand; font-size: ".$onlineinfomenufsize."px; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".LAN_EUSER_209."'>&nbsp;".LAN_EUSER_209."</div>";
//----	        $text .= "<div id='toppost' class='switchgroup1' style='display:none'>";
//----        $text .= "<table style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'>";

// }
//    else
//    {

//         $text .= "<div class='smallblacktext' style='font-size: ".$onlineinfomenufsize."px; font-weight:bold; margin-left:5px; margin-top:10px; width:".$onlineinfomenuwidth."'>".LAN_EUSER_209."</div><div style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'><table style='text-align:left; width:".$onlineinfomenuwidth."'>";

//----    }
    
// Mais uma vez a trampa da extra cache....   zarpou...
/*
    	if($extraacache==1){
		$cachet = $extracachetime*60;
		$currenttime=time();
		
		
		$script="SELECT * FROM ".MPREFIX."euser_cache Where type='toppost'";		
		$this->sql->db_Select_gen($script);	
		while ($row = $this->sql->db_Fetch())
        {
        	extract($row);            
        $lasttimerun= $cache_timestamp;   
        }
        
        	
    	if(($currenttime - $lasttimerun) > $cachet){	
		 	
			//run cache update
			$buildcache="";
			
			if (!$this->sql->db_Select("user", "*", "ORDER BY user_forums DESC LIMIT 0, ".$extrarecords."", "no_where"))
    		{
    		 $arraydata="0|".EUSER_LOGIN_MENU_L45;
    		 
     		}else{
     		 $setarray=0;
        		while ($row = $this->sql->db_Fetch())
       			 {
          			 	extract($row);            
            			$buildcache[$setarray] = $user_id."|".$user_name."=>".$user_forums;						
						$setarray++;
            	}
        			$arraydata="";					
					for ($y = 0; $y <= ($setarray-1); $y++)
					{
	 					$arraydata.=$buildcache[$y];
						$arraydata.= ($y < $setarray-1 ) ? "," : "";
					}					
						
				
			}
			
			$this->sql -> db_Update("euser_cache", "cache='".$arraydata."',cache_timestamp='".time()."' WHERE type='toppost'");
			
		}				
			
			//use cache
			$script="SELECT * FROM ".MPREFIX."euser_cache Where type='toppost'";
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
						
        		$user_forums = $blowmoredata[1];	
        		$user_id = $blowdataagain[0];
				$user_name = $blowdataagain[1];
				
				if($user_id==0){
				 $text .= "<div class='smalltext' style='text-align:left; width:".$onlineinfomenuwidth.";'>". LAN_EUSER_2010 ."</div>";
				 }else{
				$text .= "<tr><td style='vertical-align:top; text-align:left; width:80%;'><a href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".$user_name."</a></td>
			<td style='vertical-align:top; text-align:right; width:20%; padding-right:20px;'>".$user_forums."</td></tr>";	
										
				}
				
			}          	
        }
			
			
	}else{
*/ 
//    var_dump ($this->top_posters);
//    var_dump ($frmStats->init());
//    if ($this->sql->db_Select("user", "*", "ORDER BY user_forums DESC LIMIT 0, ".($this->var['cache_records']?:10), "no_where"))
    if ($this->top_posters)
    {
      $tmp['HEAD']=LAN_EUSER_209;
      $tmp['HEAD_ID']="tfp";
      $text .= $this->tp->parseTemplate($this->template['section_head'], true, $tmp);

		foreach($this->top_posters as $row)
//        while ($row = $top_posters)
        {
/* PASSOU PARA O RENDER_USER_LINE
      $tmp['LINE_START']="<a href='".e_BASE."user.php?id.".$row['user_id']."'><span ".getuserclassinfo($row['user_id']).">".$row['user_name']."</span></a>";
      $tmp['LINE_END']=$row['user_forums'];
    	$text .= $this->tp->parseTemplate($this->template['section_line'], true, $tmp);
*/
    	$text .= $this->render_user_line($row);

//            extract($row);

//            $text .= "<tr><td style='vertical-align:top; text-align:left; width:80%;'><a href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".$user_name."</a></td>
//			<td style='vertical-align:top; text-align:right; width:20%; padding-right:20px;'>".$user_forums."</td></tr>";
        }
    }
    else
    {
      $tmp['HEAD']=LAN_EUSER_2010;
    	$text .= $this->tp->parseTemplate($this->template['section_head'], true, $tmp);
//        $text .= "<div class='smalltext' style='text-align:left; width:".$onlineinfomenuwidth.";'>". LAN_EUSER_2010 ."</div>";
    }
//----}
//  $text .= "</table><br /></div>";

				return $text .= $this->tp->parseTemplate($this->template['section_end'], true, $tmp);
  }
//				return htmlEntities($text .= $this->tp->parseTemplate($this->template['section_end'], true, $tmp), ENT_QUOTES);
//				return $text .= $this->tp->parseTemplate($this->template['section_end'], true, $tmp);
  }

	function sc_esm_topforumstarter($parm='')
	{

if(check_class($this->var['cache_userclass'])){
    // Forum
//----    if ($extrahide == 1)
//----    {

//----        $text .= "<div id='topstarter-title' style='cursor:hand; font-size: ".$onlineinfomenufsize."px; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".LAN_EUSER_2011."'>&nbsp;".LAN_EUSER_2011."</div>";
//----		$text .= "<div id='topstarter' class='switchgroup1' style='display:none'>";
//----        $text .= "<table style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'>";

//    }
//    else
//    {

//        $text .= "<div class='smallblacktext' style='font-size: ".$onlineinfomenufsize."px; font-weight:bold; margin-left:5px; margin-top:10px; width:".$onlineinfomenuwidth."'>".LAN_EUSER_2011."</div><div style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'><table style='text-align:left; width:".$onlineinfomenuwidth."'>";

//----    }

/*
			$query="SELECT FLOOR(thread_user) as t_user, COUNT(FLOOR(ft.thread_user)) AS ucount, u.user_name, u.user_id FROM #forum_t as ft
		LEFT JOIN #user AS u ON FLOOR(ft.thread_user) = u.user_id
		WHERE ft.thread_parent=0
		GROUP BY t_user
		ORDER BY ucount DESC
		LIMIT 0,".$extrarecords."";
*/

// Mais uma vez a trampa da extra cache....
/*
if($extraacache==1){
		$cachet = $extracachetime*60;
		$currenttime=time();
		
		
		$script="SELECT * FROM ".MPREFIX."euser_cache Where type='toppoststarter'";		
		$this->sql->db_Select_gen($script);	
		while ($row = $this->sql->db_Fetch())
        {
        	extract($row);            
        $lasttimerun= $cache_timestamp;   
        }
        
        	
    	if(($currenttime - $lasttimerun) > $cachet){	
		 	
			//run cache update
			$buildcache="";
							
			$this->sql -> db_Select_gen($query);
			
    	
     		 $setarray=0;
        		while ($row = $this->sql->db_Fetch())
       			 {
          			 	extract($row);            
            			$buildcache[$setarray] = $t_user."|".$user_name."=>".$ucount;						
						$setarray++;
            	}
        			$arraydata="";					
					for ($y = 0; $y <= ($setarray-1); $y++)
					{
	 					$arraydata.=$buildcache[$y];
						$arraydata.= ($y < $setarray-1 ) ? "," : "";
					}					
						
				
			
			
			$this->sql -> db_Update("euser_cache", "cache='".$arraydata."',cache_timestamp='".time()."' WHERE type='toppoststarter'");
			
		}				
			
			//use cache
			$script="SELECT * FROM ".MPREFIX."euser_cache Where type='toppoststarter'";
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
						
        		$toppoststarter = $blowmoredata[1];	
        		$t_user = $blowdataagain[0];
				$user_name = $blowdataagain[1];
				
			if($t_user=="0"){
		    $text .= "<tr><td style='vertical-align:top; text-align:left; width:80%;'>".LAN_EUSER_207."</td>
					<td style='vertical-align:top; text-align:right; width:20%; padding-right:20px;'>".$toppoststarter."</td></tr>";
		}else{
		
		    $text .= "<tr><td style='vertical-align:top; text-align:left; width:80%;'><a href='".e_BASE."user.php?id.".$t_user."' ".getuserclassinfo($t_user).">".$user_name."</a></td>
					<td style='vertical-align:top; text-align:right; width:20%; padding-right:20px;'>".$toppoststarter."</td></tr>";
		}
					
			}          	
        }
			
			
	}else{
*/
      $tmp['HEAD']=LAN_EUSER_2011;
      $tmp['HEAD_ID']="tfs";
      $text .= $this->tp->parseTemplate($this->template['section_head'], true, $tmp);

//		$this->sql -> db_Select_gen($query);
//		$posters = $this->sql -> db_getList();
//    var_dump ($this->top_starters);
		foreach($this->top_starters as $row)
		
		{
/* PASSOU PARA O RENDER_USER_LINE
      $tmp['LINE_START']="<a href='".e_BASE."user.php?id.".$row['user_id']."'><span ".getuserclassinfo($row['user_id']).">".$row['user_name']."</span></a>";
      $tmp['LINE_END']=$row['user_forums'];
    	$text .= $this->tp->parseTemplate($this->template['section_line'], true, $tmp);
*/
    	$text .= $this->render_user_line($row);
		
//		if($poster['t_user']=="0"){
//		    $text .= "<tr><td style='vertical-align:top; text-align:left; width:80%;'>".LAN_EUSER_207."</td>
//					<td style='vertical-align:top; text-align:right; width:20%; padding-right:20px;'>".$poster['ucount']."</td></tr>";
//		}else{
		
//		    $text .= "<tr><td style='vertical-align:top; text-align:left; width:80%;'><a href='".e_BASE."user.php?id.".$poster['user_id']."' ".getuserclassinfo($poster['user_id']).">".$poster['user_name']."</a></td>
//					<td style='vertical-align:top; text-align:right; width:20%; padding-right:20px;'>".$poster['ucount']."</td></tr>";
//		}
		}


//---- }
 
//  $text .= "</table></div>";
				return $text .= $this->tp->parseTemplate($this->template['section_end'], true, $tmp);

  }
//				return htmlEntities($text .= $this->tp->parseTemplate($this->template['section_end'], true, $tmp), ENT_QUOTES);

//				return $text .= $this->tp->parseTemplate($this->template['section_end'], true, $tmp);
  }

	function sc_esm_topforumreplier($parm='')
	{

if(check_class($this->var['cache_userclass'])){
    // Forum
//----    if ($extrahide == 1)
//----    {

//----         $text .= "<div id='topreplier-title' style='cursor:hand; font-size: ".$onlineinfomenufsize."px; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".LAN_EUSER_208."'>&nbsp;".LAN_EUSER_208."</div>";
//----        $text .= "<div id='topreplier' class='switchgroup1' style='display:none'>";
//----        $text .= "<table style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'>";

//    }
//    else
//    {

//     $text .= "<div class='smallblacktext' style='font-size: ".$onlineinfomenufsize."px; font-weight:bold; margin-left:5px; margin-top:10px; width:".$onlineinfomenuwidth."'>".LAN_EUSER_208."</div><div style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'><table style='text-align:left; width:".$onlineinfomenuwidth."'>";

//----    }

/*
$query = "
SELECT FLOOR(thread_user) as t_user, COUNT(FLOOR(ft.thread_user)) AS ucount, u.user_name, u.user_id FROM #forum_t as ft
LEFT JOIN #user AS u ON FLOOR(ft.thread_user) = u.user_id
WHERE ft.thread_parent!=0
GROUP BY t_user
ORDER BY ucount DESC
LIMIT 0,".$extrarecords."";
*/

// Mais uma vez a trampa da extra cache....
/*
if($extraacache==1){
		$cachet = $extracachetime*60;
		$currenttime=time();
		
		
		$script="SELECT * FROM ".MPREFIX."euser_cache Where type='toppostreplier'";		
		$this->sql->db_Select_gen($script);	
		while ($row = $this->sql->db_Fetch())
        {
        	extract($row);            
        $lasttimerun= $cache_timestamp;   
        }
        
        	
    	if(($currenttime - $lasttimerun) > $cachet){	
		 	
			//run cache update
			$buildcache="";
			
				
			$this->sql -> db_Select_gen($query);
			
    	
     		 $setarray=0;
        		while ($row = $this->sql->db_Fetch())
       			 {
          			 	extract($row);            
            			$buildcache[$setarray] = $t_user."|".$user_name."=>".$ucount;						
						$setarray++;
            	}
        			$arraydata="";					
					for ($y = 0; $y <= ($setarray-1); $y++)
					{
	 					$arraydata.=$buildcache[$y];
						$arraydata.= ($y < $setarray-1 ) ? "," : "";
					}					
						
				
			
			
			$this->sql -> db_Update("euser_cache", "cache='".$arraydata."',cache_timestamp='".time()."' WHERE type='toppostreplier'");
			
		}				
			
			//use cache
			$script="SELECT * FROM ".MPREFIX."euser_cache Where type='toppostreplier'";
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
						
        		$toppostreplier = $blowmoredata[1];	
        		$t_user = $blowdataagain[0];
				$user_name = $blowdataagain[1];
				
			if($t_user=="0"){
		    $text .= "<tr><td style='vertical-align:top; text-align:left; width:80%;'>".LAN_EUSER_207."</td>
					<td style='vertical-align:top; text-align:right; width:20%; padding-right:20px;'>".$toppostreplier."</td></tr>";
		}else{
		
		    $text .= "<tr><td style='vertical-align:top; text-align:left; width:80%;'><a href='".e_BASE."user.php?id.".$t_user."' ".getuserclassinfo($t_user).">".$user_name."</a></td>
					<td style='vertical-align:top; text-align:right; width:20%; padding-right:20px;'>".$toppostreplier."</td></tr>";
		}
					
			}          	
        }
			
			
	}else{
*/
      $tmp['HEAD']=LAN_EUSER_208;
      $tmp['HEAD_ID']="tfr";
      $text .= $this->tp->parseTemplate($this->template['section_head'], true, $tmp);


//$this->sql -> db_Select_gen($query);
//$posters = $this->sql -> db_getList();

foreach($this->top_repliers as $row)
{
/* PASSOU PARA O RENDER USER LINE
      $tmp['LINE_START']="<a href='".e_BASE."user.php?id.".$row['user_id']."'><span ".getuserclassinfo($row['user_id']).">".vartrue($row['user_name'],LAN_ANONYMOUS)."</span></a>";
      $tmp['LINE_END']=$row['user_forums'];
    	$text .= $this->tp->parseTemplate($this->template['section_line'], true, $tmp);
*/
    	$text .= $this->render_user_line($row);
/*
if($poster['t_user']=="0"){
$text .= "<tr>
<td style='vertical-align:top; text-align:left; width:80%;'>".LAN_EUSER_207."</td>
<td style='vertical-align:top; text-align:right; width:20%; padding-right:20px;'>".$poster['ucount']."</td>
</tr>";
}else{
*/
//$text .= "<tr>
//<td style='vertical-align:top; text-align:left; width:80%;'><a href='".e_BASE."user.php?id.".$poster['user_id']."' ".getuserclassinfo($poster['user_id']).">".$poster['user_name']."</a></td>
//<td style='vertical-align:top; text-align:right; width:20%; padding-right:20px;'>".$poster['ucount']."</td>
//</tr>";
//}


}


//----}
		
//		$text .= "</table><br /></div>";
				return $text .= $this->tp->parseTemplate($this->template['section_end'], true, $tmp);;
 
  }
//				return $text .= $this->tp->parseTemplate($this->template['section_end'], true, $tmp);;
  }

			function sc_esm_topratedmember($parm='')
			{

//----	if ($extrahide == 1)
//----    {

//----        $text .= "<div id='toprate-title' style='cursor:hand; font-size: ".$onlineinfomenufsize."px; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".LAN_EUSER_203."'>&nbsp;".LAN_EUSER_203."</div>";
//----	           $text .= "<div id='toprate' class='switchgroup1' style='display:none'>";
//----        $text .= "<table style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'>";

//----    }
//    else
//    {
//        $text .= "<div class='smallblacktext' style='font-size: ".$onlineinfomenufsize."px; font-weight:bold; margin-left:5px; margin-top:10px; width:".$onlineinfomenuwidth."'>".LAN_EUSER_203."</div><div style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'><table style='text-align:left; width:".$onlineinfomenuwidth."'>";
//    }

$query = "SELECT * FROM #rate as r LEFT JOIN #user AS u ON r.rate_itemid = u.user_id
WHERE rate_table ='user'
ORDER BY rate_rating/rate_votes DESC
LIMIT 0,".$extrarecords."";

/*
if($extraacache==1){
		$cachet = $extracachetime*60;
		$currenttime=time();
		
		
		$script="SELECT * FROM ".MPREFIX."euser_cache Where type='topratedmember'";		
		$this->sql->db_Select_gen($script);	
		while ($row = $this->sql->db_Fetch())
        {
        	extract($row);            
        $lasttimerun= $cache_timestamp;   
        }
        
        	
    	if(($currenttime - $lasttimerun) > $cachet){	
		 	
			//run cache update
			$buildcache="";
			
			if (!$this->sql -> db_Select_gen($query))
    		{
    		 $arraydata="0|".ONLINEINFO_COUNTER_L9." ".LAN_EUSER_203;
    		 
     		}else{
     		 $setarray=0;
        		while ($row = $this->sql->db_Fetch())
       			 {
          			 	extract($row);            
            			$buildcache[$setarray] = $user_id."|".$user_name."=>".round($rate_rating/$rate_votes,2);						
						$setarray++;
            	}
        			$arraydata="";					
					for ($y = 0; $y <= ($setarray-1); $y++)
					{
	 					$arraydata.=$buildcache[$y];
						$arraydata.= ($y < $setarray-1 ) ? "," : "";
					}					
						
				
			}
			
			$this->sql -> db_Update("euser_cache", "cache='".$arraydata."',cache_timestamp='".time()."' WHERE type='topratedmember'");
			
		}				
			
			//use cache
			$script="SELECT * FROM ".MPREFIX."euser_cache Where type='topratedmember'";
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
						
        		$topratedmember = $blowmoredata[1];	
        		$user_id = $blowdataagain[0];
				$user_name = $blowdataagain[1];
				
				if($user_id==0){
				 $text .= "<div class='smalltext' style='text-align:left; width:".$onlineinfomenuwidth.";'>".ONLINEINFO_COUNTER_L9." ".LAN_EUSER_203."</div>";
				 }else{
				$text .= "<tr><td style='vertical-align:top; text-align:left; width:80%;'><a href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".$user_name."</a></td>
			<td style='vertical-align:top; text-align:right; width:20%; padding-right:20px;'>".$topratedmember."</td></tr>";	
										
				}
				
			}          	
        }
			
			
	}else{
*/

	if($this->sql -> db_Select_gen($query)){
      $tmp['HEAD']=LAN_EUSER_203;
      $tmp['HEAD_ID']="tmb";
      $text .= $this->tp->parseTemplate($this->template['section_head'], true, $tmp);

		while($row = $this->sql -> db_Fetch()){
//			extract($row);

/*
			$text .= "<tr><td style='vertical-align:top text-align:left; width:80%;'><a href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".$user_name."</a></td>
			<td style='vertical-align:top; text-align:right; width:20%; padding-right:20px;'>".round($rate_rating/$rate_votes,2)."</td></tr>";
*/
/*  PASSOU PARA O RENDER_USER_LINE
            $tmp['LINE_START']="<a href='".e_BASE."user.php?id.".$row['user_id']."'><span ".getuserclassinfo($row['user_id']).">".vartrue($row['user_name'],LAN_ANONYMOUS)."</span></a>";
      $tmp['LINE_END']=round($row['rate_rating']/$row['rate_votes'],2);
    	$text .= $this->tp->parseTemplate($this->template['section_line'], true, $tmp);
*/
    	$text .= $this->render_user_line($row);

		}
	}
  else {
//      $tmp['HEAD']=LAN_EUSER_204;
//    	$text .= $this->tp->parseTemplate($this->template['section_head'], true, $tmp);
//      $tmp['HEAD']=;
    	$text .= "<span class='text-info'>".LAN_EUSER_204."</span>";
  }

//----}
//        $text .= "</table><br /></div>";

				return $text;
//				return "TOPRATED MEMBER HERE";
			}

			function sc_esm_counter($parm='')
			{

//var_dump ($euser_pref['statActivate']);
//var_dump ($euser_pref);
//if (isset($euser_pref['statActivate']) && $euser_pref['statActivate'] == true ) {
if (e107::isInstalled("log")) {


if(check_class($this->var['cache_userclass'])){
//	if(check_class($extraclass)){

//----	if($extrahide==1){

//----	         $text .= '<div id="counter-title" style="cursor:hand; font-size: '.$onlineinfomenufsize.'px; text-align:left; vertical-align: middle; width:'.$onlineinfomenuwidth.'; font-weight: bold;" title="'.EUSER_LOGIN_MENU_L42.'">&nbsp;'.EUSER_LOGIN_MENU_L42.'</div>';
//----	         $text .= '<div id="counter" class="switchgroup1" style="display:none">';

//----			}else{

				$text .='<div class="smallblacktext" style="font-size:'.$onlineinfomenufsize.'px; margin-left:5px; margin-top:10px; font-weight:bold;">'.LAN_EUSER_2012.'</div>
				<div style="text-align:left">';
//----			}

        $euser_pref = e107::getPlugPref('euser');

		if (isset($euser_pref['statActivate']) && $euser_pref['statActivate'] == true) {
			$pageName = preg_replace('/(\?.*)|(\_.*)|(\.php)/', '', basename (e_SELF));
			$logfile = e_PLUGIN.'log/logs/logp_'.date('z.Y', time()).'.php';
			if(!is_readable($logfile))
			{
				if(ADMIN && !$euser_pref['statCountAdmin'])
				{
					$text .= '<div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';font-weight: italic;">** '.ONLINEINFO_COUNTER_L1.' **</div>';
				}
				$total = 1;
				$unique = 1;
				$siteTotal = 1;
				$siteUnique = 1;
				$totalever = 1;
				$uniqueever = 1;
			} else {

				require($logfile);
				if($this->sql -> db_Select("logstats", "*", "log_id='statTotal' OR log_id='statUnique' OR log_id='pageTotal'"))
				{
					while($row = $this->sql -> db_Fetch())
					{
						if($row['log_id'] == 'statTotal')
						{
							$siteTotal += $row['log_data'];
						}
							else if($row['log_id'] == 'statUnique')
						{
							$siteUnique += $row['log_data'];
						}
							else
						{
							$dbPageInfo = unserialize($row['log_data']);
							$totalPageEver = ($dbPageInfo[$pageName]['ttlv'] ? $dbPageInfo[$pageName]['ttlv'] : 0);
							$uniquePageEver = ($dbPageInfo[$pageName]['unqv'] ? $dbPageInfo[$pageName]['unqv'] : 0);
						}
					}
				}
				$pageName = preg_replace('/(\?.*)|(\_.*)|(\.php)/', '', basename (e_SELF));
				$total = ($pageInfo[$pageName]['ttl'] ? $pageInfo[$pageName]['ttl'] : 0);
				$unique = ($pageInfo[$pageName]['unq'] ? $pageInfo[$pageName]['unq'] : 0);
				$totalever = ($pageInfo[$pageName]['ttlv'] ? $pageInfo[$pageName]['ttlv'] : 0) + $totalPageEver + $total;
				$uniqueever = ($pageInfo[$pageName]['unqv'] ? $pageInfo[$pageName]['unqv'] : 0) + $uniquePageEver + $unique;
			}


			$text .= '<div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';font-weight: bold;">'.ONLINEINFO_COUNTER_L2.'</div><div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';">'.ONLINEINFO_COUNTER_L3.': '.$total.'</div><div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';">'.ONLINEINFO_COUNTER_L5.': '.$unique.'</div><br />
			
			<div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';font-weight: bold;">'.ONLINEINFO_COUNTER_L4.'</div><div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';">'.ONLINEINFO_COUNTER_L3.': '.$totalever.'</div><div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';">'.ONLINEINFO_COUNTER_L5.': '.$uniqueever.'</div><br />
			
			<div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';font-weight: bold;">'.ONLINEINFO_COUNTER_L6.'</div><div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';">'.ONLINEINFO_COUNTER_L3.': '.$siteTotal.'</div><div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';">'.ONLINEINFO_COUNTER_L5.': '.$siteUnique.'</div>';

			unset($dbPageInfo);


				if((MEMBERS_ONLINE + GUESTS_ONLINE) > ($euser_pref['most_members_online'] + $euser_pref['most_guests_online'])){
							$euser_pref['most_members_online'] = MEMBERS_ONLINE;
							$euser_pref['most_guests_online'] = GUESTS_ONLINE;
							$euser_pref['most_online_datestamp'] = time();
//							save_prefs();
          		e107::getPlugConfig('euser')->setPref($euser_pref)->save();
						}
						if(!is_object($gen)){
							$gen = new convert;
						}

						$datestamp = $gen->convert_date($euser_pref['most_online_datestamp'], '');
						
						$text .= '<br /><div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.'; font-weight: bold;">'.ONLINE_EL8.': '.($euser_pref['most_members_online'] + $euser_pref['most_guests_online']).'</div><div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';">('.ONLINE_EL2.$euser_pref['most_members_online'].', '.ONLINE_EL1.$euser_pref['most_guests_online'].')</div><div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';">'.ONLINE_EL9.' '.$datestamp.'</div><br />';
						$total_members = $this->sql -> db_Count("user");


				$text .='</div>';

		}
		else
		{
			if(ADMIN)
			{
				$text .= '<div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';">'.ONLINEINFO_COUNTER_L8.'</div>
				<br /></div>';

			}
		}
	}


}else
{
 // if log is not running

			if (ADMIN)
			{
/*
if(check_class($this->var['cache_userclass'])){
				//if(check_class($extraclass)){


				if($extrahide==1){
	         $text .= '<div id="counter-title" style="cursor:hand; text-align:left; vertical-align: middle; width:'.$onlineinfomenuwidth.';" title="'.LAN_EUSER_2012.'"><b>&nbsp;'.LAN_EUSER_2012.'</b></div>
			 <div id="counter" class="switchgroup1" style="display:none">';

						}else{

							$text .='<div class="smallblacktext" style="font-size: 14px;font-weight:bold;">'.LAN_EUSER_2012.'</div>
							<div style="text-align:left">';
						}

			$text .= '<div class="smalltext"  style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';">'.LAN_EUSER_2013.'</div>
			
			<br /></div>';

			}
*/
        $mes = e107::getMessage();
        $mes->addInfo(LAN_EUSER_2012."<br>".LAN_EUSER_2013); 
        $text = $mes->render();
			}
}
				return $text;
			}

			function render_user_line($row='')
			{

      if (!$row) {return;};
      
      $tmp['LINE_START']="<a href='".e_BASE."user.php?id.".$row['user_id']."'><span ".euser::getuserclassinfo($row['user_id']).">".$row['user_name']."</span></a>";
      $tmp['LINE_END']=$row['user_visits'];
    	return $this->tp->parseTemplate($this->template['section_line'], true, $tmp);

      }


}
?>