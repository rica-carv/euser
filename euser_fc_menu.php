<?php
if (!defined('e107_INIT') || !e107::isInstalled('euser')) { exit; }
// ######### PARA TEMPLATIZAR!!!!!!!!!!

//if (!defined('e107_INIT')) { exit; }
global $euser_pref, $tp;
if(!$euser_pref['flashchatuse']){ return; }
//		$orderList = getcachedvars('orderList');
//var_dump ($data);
	//var_dump ($this->orderList['euser_lm_avatar.php']['class']);
//########################## Temporário, assim que tudo estiver em shortcodes, esta variável vem do euser_login_menu.php
//if(check_class($orderList['euser_lm_fc.php']['class']))
/*
		$ordersql=new db;
//		$script="SELECT * FROM ".MPREFIX."euser_cache Where type='order' and cache='currentlyonline.php' ORDER BY type_order";

//    echo "--SCRIPT 1:".$script;
    
$ordersql->db_Select_gen("SELECT * FROM ".MPREFIX."euser_cache Where type='order' and cache='fc.php' ORDER BY type_order");
		
//    echo "--ONLINE INFO ORDER:".$onlineinfoorder;

$orderrow = $ordersql->db_Fetch();
	if(!check_class($orderrow['cache_userclass']))	{ exit; }
*/

		$onlineinfo_flashchat_sql = new db;
		
		
		// fix if pop up not loged them out
		$timenow=time();
		//flashchatconnections 
		//updated
		$script="SELECT * FROM ".$euser_pref['flashchatprefix']."flashchatconnections";
		$onlineinfo_checkoldrecords = $onlineinfo_flashchat_sql->db_Select_gen($script);
		
		if($onlineinfo_checkoldrecords!=0){
		//echo strtotime("2007-05-10 12:20:44 GMT");	
			
		while ($row = $onlineinfo_flashchat_sql->db_Fetch())
		{
		 	$lastupdated = strtotime($row['updated']);
		 	$cache = 300; 
			$idnum = $row['id'];		 	
		 	
		 	if(($timenow - $lastupdated) > $cache){			
						
			$script="DELETE FROM ".$euser_pref['flashchatprefix']."flashchatconnections WHERE id='".$idnum."'";	
			$result = mysql_query($script);			
			
			}		 
		}
		
	}
		

	if ($orderrow['cache_hide'] == 1)
		{

		$script='SELECT * FROM '.$euser_pref['flashchatprefix'].'flashchatconnections,'.$euser_pref['flashchatprefix'].'flashchatrooms WHERE userid IS NOT NULL AND ispublic IS NOT NULL AND '.$euser_pref['flashchatprefix'].'flashchatconnections.roomid = '.$euser_pref['flashchatprefix'].'flashchatrooms.id';
		$onlineinfo_flashinuse = $onlineinfo_flashchat_sql->db_Select_gen($script);


        $text .= '<div id="flashchat-title" style="cursor:hand; text-align:left; font-size: '.$onlineinfomenufsize.'px; vertical-align: middle; width:'.$onlineinfomenuwidth.'; font-weight:bold;" title="'.OI_FLASHCHAT_1.'">&nbsp;'.OI_FLASHCHAT_1.'&nbsp;('.$onlineinfo_flashinuse.')</div>		
		<div id="flashchat" class="switchgroup1" style="display:none">
		<table style="text-align:left; width:'.$onlineinfomenuwidth.'; margin-left:20px;"><tr><td>';

		}
		else
		{

		$text .= '<div class="smallblacktext" style="font-size: '.$onlineinfomenufsize.'px; font-weight:bold; margin-left:5px; margin-top:10px; width:'.$onlineinfomenuwidth.'">'.OI_FLASHCHAT_1.'</div><div style="text-align:left; width:'.$onlineinfomenuwidth.'; margin-left:10px;"><table style="text-align:left; width:'.$onlineinfomenuwidth.'"><tr><td>';

		}

		// 0 users in 4 rooms

		// Gets rooms (id, name)
		$script="SELECT * FROM ".$euser_pref['flashchatprefix']."flashchatrooms WHERE ispublic IS NOT NULL order by ispermanent";
		$onlineinfo_flashrooms = $onlineinfo_flashchat_sql->db_Select_gen($script);
		while ($row = $onlineinfo_flashchat_sql->db_Fetch())
		{
			$onlineinfo_flashchat_sql2 = new db;

			$script="SELECT * FROM ".$euser_pref['flashchatprefix']."flashchatconnections WHERE userid IS NOT NULL AND roomid=".$row['id'];
			$onlineinfo_flashcountinroom = $onlineinfo_flashchat_sql2->db_Select_gen($script);

			if ($onlineinfo_flashcountinroom !=0)
			{


        $text .= '<div id="flashroom'.$row['name'].'-title" style="cursor:hand; text-align:left; vertical-align: middle; width:'.$onlineinfomenuwidth.'; font-weight:bold;" title="'.$row['name'].'">&nbsp;'.$row['name'].'&nbsp;('.$onlineinfo_flashcountinroom.')</div>
		<div id="flashroom'.$row['name'].'" class="switchgroup1" style="display:none">
		<table style="text-align:left; width:'.$onlineinfomenuwidth.'; margin-left:10px;"><tr><td class="smallblacktext" style="font-size: 10px;">';


				$onlineinfo_flashchat_sql3 = new db;
				$script="SELECT ".$euser_pref['flashchatprefix']."flashchatconnections.*,".MPREFIX."user.* FROM ".$euser_pref['flashchatprefix']."flashchatconnections JOIN ".MPREFIX."user ON ".$euser_pref['flashchatprefix']."flashchatconnections.userid = ".MPREFIX."user.user_id WHERE roomid =".$row['id'];
				$onlineinfo_flashuserinroom = $onlineinfo_flashchat_sql3->db_Select_gen($script);

				while ($row2 = $onlineinfo_flashchat_sql3->db_Fetch())
				{
					$text.='<a href="'.e_BASE.'user.php?id.'.$row2['user_id'].'">'.$row2['user_name'].'</a><br />';
				}

			$text .= '</td></tr></table></div>';
			}
			else
			{
				$text.='<div style="text-align:left; vertical-align: middle; width:'.$onlineinfomenuwidth.'; font-weight:bold;" title="'.$row['name'].'">'.$row['name'].'&nbsp;('.$onlineinfo_flashcountinroom.')</div>';
			}

		}

$enterroom = $onlineinfomenufsize-1;


	if ($euser_pref['flashchatwindow']=='e107')
	{
	$text.='<div class="smallblacktext" style="font-size: '.$enterroom.'px; font-weight:bold; text-align:center; width:'.$onlineinfomenuwidth.'">[<a href="'.e_PLUGIN.'euser/flashchat.php">'.OI_FLASHCHAT_2.'</a>]</div>';
	}
	else
	{
	$text.='<div class="smallblacktext" style="font-size: '.$enterroom.'px; font-weight:bold; text-align:center; width:'.$onlineinfomenuwidth.'">[<a href="'.SITEURL.$euser_pref['flashchatlocation'].'/flashchat.php" target="_blank">'.OI_FLASHCHAT_2.'</a>]</div>';
	}

		$text .= '</td></tr></table><br /></div>';
		
//	}
//}
	$ns->tablerender($caption, $text, 'euser_fc_menu');

?>