<?php
/**
 * Copyright (C) 2008-2011 e107 Inc (e107.org), Licensed under GNU GPL (http://www.gnu.org/licenses/gpl.txt)
 * $Id$
 * 
 * Latest download menu
 */

//echo "<hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>";
//var_dump ("dsgsadsfdfsdfadsfasfdsf");
if (!defined('e107_INIT'))  exit;

e107::lan('phillis', false, true); // Loads e_PLUGIN.'download/languages/'.e_LANGUAGE.'/English_front.php'

//require_once(e_PLUGIN . 'download/handlers/download_class.php');
//require_once(e_PLUGIN . 'download/handlers/category_class.php');

if(!class_exists('phillis_lists_menu'))
{
	class phillis_lists_menu // plugin folder + menu name (without the .php)
	{

		private $plugPref;
		private $phlparm;
		private $menuPref;
//		private $downloadObj;
		private $total = array();
//		private $cacheTag = 'lphlCache';
//		private $cacheTime = 1; // cache time in minutes.

		function __construct($phlparm)
		{
			$this->plugPref = e107::pref('phillis'); // general download preferences.
//			$this->menuPref = e107::getMenu()->pref();// ie. popup config details from within menu-manager.
			$menuPrefs = e107::getMenu()->pref();// ie. popup config details from within menu-manager.
//			$this->downloadObj = new downloadCategory();

			if(is_string($menuPrefs))
			{
				parse_str($menuPrefs, $this->menuPref);
			}
			else
			{
				$this->menuPref = $menuPrefs;
			}

			if(is_string($phlparm))
			{
				parse_str($phlparm, $phlparms);
			}
			else
			{
				$phlparms = $phlparm;

				e107::getDebug()->log($phlparms);
			}

//			echo "<hr><hr><hr>";
//			var_dump($this->menuPref);

			// Set some defaults ...
			if (!isset($this->menuPref['title'])) $this->menuPref['title'] = "";
			if (empty($this->menuPref['display'])) $this->menuPref['display'] = $phlparms['limit']??10;
			if (empty($this->menuPref['maxage'])) $this->menuPref['maxage'] = 0;
			if (empty($this->menuPref['characters'])) $this->menuPref['characters'] = 120;
			if (empty($this->menuPref['postfix'])) $this->menuPref['postfix'] = '...';
			if (!isset($this->menuPref['scroll'])) $this->menuPref['scroll'] = "";
			if (empty($this->menuPref['layout'])) $this->menuPref['layout'] = $phlparms['layout']??'default';

			if (empty($this->menuPref['source'])) $this->menuPref['source'] = $phlparms['source']??'default';

//			echo "<hr><hr><hr>";
//			var_dump($this->menuPref);

//            $this->cacheTag .= "_".$this->menuPref['layout'];
/*
            $this->cacheTag .= "_".$this->menuPref['layout']."_".$this->menuPref['show'];

            if($text = e107::getCache()->retrieve($this->cacheTag, $this->cacheTime, true))
            {
                e107::getDebug()->log("New download Posts Menu Cache Rendered");
                $caption = $this->getCaption();
                e107::getRender()->tablerender($caption, $text, 'phll_menu');
                return null;
            }
*/
/*
			$sql = e107::getDb();

			$this->total['topics'] = $sql->count("download_thread");
			$this->total['replies'] = $sql->count("download_post");

			if($sql->gen("SELECT sum(thread_views) as sum FROM #download_thread"))
			{
				$tmp = $sql->fetch();
				$this->total['views'] = intval($tmp["sum"]);
			}
*/
			$this->render($phlparms);

		}

/*---------------
		private function getQuery()
		{
//			var_dump("QUERY");
			$max_age = vartrue($this->menuPref['maxage'], 0);
			$max_age = ($max_age == 0) ? '' : '(p.post_datestamp > '.(time()-(int)$max_age*86400).') AND ';

////			$viewPerm = $this->downloadObj->cat_tree;
			$downloadList = implode(',', $viewPerm);   ///????? APAGAR ??

			// if downloadlist is empty (no download categories created yet), return false;
			if(!$downloadList)
			{
				return false;
			}

//			$this->menuPref['layout'] = vartrue($this->menuPref['layout'], 'latest');
			$this->menuPref['source'] = vartrue($this->menuPref['source'], 'default');
//			var_dump($this->menuPref['layout']);
			switch($this->menuPref['source'])
			{
//				case "latest":
				case "request":
/*
					$qry = "
					SELECT
					p.post_user, p.post_id, p.post_datestamp, p.post_user_anon, p.post_entry,
					t.*,
					u.user_id, u.user_name, u.user_image, u.user_currentvisit,
					lu.user_name as thread_lastuser_username, 
					f.download_name, f.download_sef
					FROM `#download_post` as p
					LEFT JOIN `#download_thread` AS t ON t.thread_id = p.post_thread
					LEFT JOIN `#download` as f ON f.download_id = t.thread_download_id
					LEFT JOIN `#user` AS u ON u.user_id = p.post_user
					LEFT JOIN `#user` AS lu ON t.thread_lastuser = lu.user_id
					WHERE {$max_age} p.post_download IN ({$downloadList})
					ORDER BY p.post_datestamp DESC LIMIT 0, ".vartrue($this->menuPref['display'],10);
					break;
*/
/*
					$qry = "
					SELECT * FROM `#download`
					ORDER BY download_datestamp DESC LIMIT ".vartrue($this->menuPref['display'],10);
*/
/*
					$qry = "
					SELECT d.*, dc.* FROM #download AS d
					LEFT JOIN #download_category AS dc ON d.download_category = dc.download_category_id
					WHERE d.download_active > 0
					AND d.download_visible IN (".USERCLASS_LIST.")
					AND dc.download_category_class IN (".USERCLASS_LIST.")
					ORDER BY download_datestamp DESC 
					LIMIT ".vartrue($this->menuPref['display'],10);
*/
/*--------------------
					$qry = "
					SELECT d.*, dc.*, rd.*
					FROM #download AS d
					LEFT JOIN #download_category AS dc 
  					ON d.download_category = dc.download_category_id
					LEFT JOIN (
					    SELECT 
					      download_request_download_id, 
					      MAX(download_request_datestamp) AS ultimo_datestamp
					    FROM #download_requests
					    GROUP BY download_request_download_id
					) AS rd 
					  ON d.download_id = rd.download_request_download_id
					WHERE d.download_active > 0 AND d.download_requested > 0
					AND d.download_visible IN (".USERCLASS_LIST.")
					AND dc.download_category_class IN (".USERCLASS_LIST.")
					ORDER BY rd.ultimo_datestamp DESC
					LIMIT ".vartrue($this->menuPref['display'],10);

//					$qry = "fldsjkfsdklfjklj";
					break;
				 // standardized field names.  thread_user_[user table fields without the '_')
				case "latest":
				case "default":
				default:
/*
					 $qry = "
					SELECT t.thread_id, t.thread_name, t.thread_datestamp, t.thread_user, t.thread_views, t.thread_lastpost, t.thread_lastuser, t.thread_total_replies, t.thread_active, 
					MAX(p.post_id) AS post_id,
					f.download_id, f.download_name, f.download_class, f.download_sef, 
					u.user_name as thread_user_username,  
					u.user_image as thread_user_userimage, 
					u.user_currentvisit as thread_user_usercurrentvisit,
					fp.download_class,  fp.download_sef as download_parent_sef,
					lp.user_name AS thread_lastuser_username
					FROM #download_thread AS t
					LEFT JOIN #download_post AS p ON t.thread_id = p.post_thread
					LEFT JOIN #user AS u ON t.thread_user = u.user_id
					LEFT JOIN #user AS lp ON t.thread_lastuser = lp.user_id
					LEFT JOIN #download AS f ON f.download_id = t.thread_download_id
					LEFT JOIN #download AS fp ON f.download_parent = fp.download_id
					WHERE f.download_id = t.thread_download_id AND f.download_class IN (".USERCLASS_LIST.")
					AND fp.download_class IN (".USERCLASS_LIST.") 
					GROUP BY t.thread_id  
					ORDER BY t.thread_lastpost DESC LIMIT 0, ".vartrue($this->menuPref['display'],10);
*/
/*-----------------
					$qry = "
					SELECT d.*, dc.* FROM #download AS d
					LEFT JOIN #download_category AS dc ON d.download_category = dc.download_category_id
					WHERE d.download_active > 0
					AND d.download_visible IN (".USERCLASS_LIST.")
					AND dc.download_category_class IN (".USERCLASS_LIST.")
					ORDER BY download_datestamp DESC 
					LIMIT ".vartrue($this->menuPref['display'],10);
					break;
					}

//			var_dump($qry);

			return $qry;
		}
---------------------*/
		private function render($parms)
		{
//			var_dump($parms);
//			var_dump("RENDER");
			$tp = e107::getParser();
			$sql = e107::getDb('lphl');
		//	$pref = e107::getPref();

//			$qry = $this->getQuery();



//			var_dump("QUERY");
//	$max_age = vartrue($this->menuPref['maxage'], 0);
//	$max_age = ($max_age == 0) ? '' : '(p.post_datestamp > '.(time()-(int)$max_age*86400).') AND ';

////			$viewPerm = $this->downloadObj->cat_tree;
/* #### AINDA NÃO EXISTE VIEW PERMS....
	$downloadList = implode(',', $viewPerm);   ///????? APAGAR ??

	// if downloadlist is empty (no download categories created yet), return false;
	if(!$downloadList)
	{
		return false;
	}
VIEW PERMS */
//			$this->menuPref['layout'] = vartrue($this->menuPref['layout'], 'latest');
	$this->menuPref['source'] = vartrue($this->menuPref['source'], 'default');
//			var_dump($this->menuPref['layout']);
	switch($this->menuPref['source'])
	{
//				case "latest":
/*--------------
		case "request":
/*
			$qry = "
			SELECT
			p.post_user, p.post_id, p.post_datestamp, p.post_user_anon, p.post_entry,
			t.*,
			u.user_id, u.user_name, u.user_image, u.user_currentvisit,
			lu.user_name as thread_lastuser_username, 
			f.download_name, f.download_sef
			FROM `#download_post` as p
			LEFT JOIN `#download_thread` AS t ON t.thread_id = p.post_thread
			LEFT JOIN `#download` as f ON f.download_id = t.thread_download_id
			LEFT JOIN `#user` AS u ON u.user_id = p.post_user
			LEFT JOIN `#user` AS lu ON t.thread_lastuser = lu.user_id
			WHERE {$max_age} p.post_download IN ({$downloadList})
			ORDER BY p.post_datestamp DESC LIMIT 0, ".vartrue($this->menuPref['display'],10);
			break;
*/
/*
			$qry = "
			SELECT * FROM `#download`
			ORDER BY download_datestamp DESC LIMIT ".vartrue($this->menuPref['display'],10);
*/
/*
			$qry = "
			SELECT d.*, dc.* FROM #download AS d
			LEFT JOIN #download_category AS dc ON d.download_category = dc.download_category_id
			WHERE d.download_active > 0
			AND d.download_visible IN (".USERCLASS_LIST.")
			AND dc.download_category_class IN (".USERCLASS_LIST.")
			ORDER BY download_datestamp DESC 
			LIMIT ".vartrue($this->menuPref['display'],10);
*/
/*--------------
			$qry = "
			SELECT d.*, dc.*, rd.*
			FROM #download AS d
			LEFT JOIN #download_category AS dc 
			  ON d.download_category = dc.download_category_id
			LEFT JOIN (
				SELECT 
				  download_request_download_id, 
				  MAX(download_request_datestamp) AS ultimo_datestamp
				FROM #download_requests
				GROUP BY download_request_download_id
			) AS rd 
			  ON d.download_id = rd.download_request_download_id
			WHERE d.download_active > 0 AND d.download_requested > 0
			AND d.download_visible IN (".USERCLASS_LIST.")
			AND dc.download_category_class IN (".USERCLASS_LIST.")
			ORDER BY rd.ultimo_datestamp DESC
			LIMIT ".vartrue($this->menuPref['display'],10);

//					$qry = "fldsjkfsdklfjklj";
			break;
----------*/
		 // standardized field names.  thread_user_[user table fields without the '_')
		case "latest":
		case "default":
		default:
/*
			 $qry = "
			SELECT t.thread_id, t.thread_name, t.thread_datestamp, t.thread_user, t.thread_views, t.thread_lastpost, t.thread_lastuser, t.thread_total_replies, t.thread_active, 
			MAX(p.post_id) AS post_id,
			f.download_id, f.download_name, f.download_class, f.download_sef, 
			u.user_name as thread_user_username,  
			u.user_image as thread_user_userimage, 
			u.user_currentvisit as thread_user_usercurrentvisit,
			fp.download_class,  fp.download_sef as download_parent_sef,
			lp.user_name AS thread_lastuser_username
			FROM #download_thread AS t
			LEFT JOIN #download_post AS p ON t.thread_id = p.post_thread
			LEFT JOIN #user AS u ON t.thread_user = u.user_id
			LEFT JOIN #user AS lp ON t.thread_lastuser = lp.user_id
			LEFT JOIN #download AS f ON f.download_id = t.thread_download_id
			LEFT JOIN #download AS fp ON f.download_parent = fp.download_id
			WHERE f.download_id = t.thread_download_id AND f.download_class IN (".USERCLASS_LIST.")
			AND fp.download_class IN (".USERCLASS_LIST.") 
			GROUP BY t.thread_id  
			ORDER BY t.thread_lastpost DESC LIMIT 0, ".vartrue($this->menuPref['display'],10);
*/
/*
			$qry = "
			SELECT d.*, dc.* FROM #download AS d
			LEFT JOIN #download_category AS dc ON d.download_category = dc.download_category_id
			WHERE d.download_active > 0
			AND d.download_visible IN (".USERCLASS_LIST.")
			AND dc.download_category_class IN (".USERCLASS_LIST.")
			ORDER BY download_datestamp DESC 
			LIMIT ".vartrue($this->menuPref['display'],10);
			break;
			}
*/
/*
SELECT l.* , IFNULL(s.total_quant, 0) AS total_quant
FROM e107_phillist_fltu l
LEFT JOIN 
(SELECT user, SUM(quant) AS total_quant FROM e107_phillist_fltu GROUP BY user) s
ON l.user = s.user
ORDER BY data DESC LIMIT 1 

			$sqlqry['u'] = "SELECT * FROM #phillist_fltu ORDER BY data DESC LIMIT ".vartrue($this->menuPref['display'],1);
			$sqlqry['n'] = "SELECT * FROM #phillist_fltn ORDER BY data DESC LIMIT ".vartrue($this->menuPref['display'],1);
			$sqlqry['s'] = "SELECT * FROM #phillist_trcu ORDER BY data DESC LIMIT ".vartrue($this->menuPref['display'],1);
			$sqlqry['o'] = "SELECT * FROM #phillist_trcn ORDER BY data DESC LIMIT ".vartrue($this->menuPref['display'],1);
*/



			$limit = (int) vartrue($this->menuPref['display'], 1);

$sqlqry['u'] = "
SELECT l.*, IFNULL(s.total_quant, 0) AS total_quant
FROM #phillist_fltu AS l
LEFT JOIN (
    SELECT user, SUM(quant) AS total_quant
    FROM #phillist_fltu
    GROUP BY user
) AS s ON l.user = s.user
ORDER BY l.data DESC
LIMIT {$limit}
";

$sqlqry['n'] = "
SELECT l.*, IFNULL(s.total_quant, 0) AS total_quant
FROM #phillist_fltn AS l
LEFT JOIN (
    SELECT user, SUM(quant) AS total_quant
    FROM #phillist_fltn
    GROUP BY user
) AS s ON l.user = s.user
ORDER BY l.data DESC
LIMIT {$limit}
";

$sqlqry['s'] = "
SELECT l.*, IFNULL(s.total_quant, 0) AS total_quant
FROM #phillist_trcu AS l
LEFT JOIN (
    SELECT user, SUM(quant) AS total_quant
    FROM #phillist_trcu
    GROUP BY user
) AS s ON l.user = s.user
ORDER BY l.data DESC
LIMIT {$limit}
";

$sqlqry['o'] = "
SELECT l.*, IFNULL(s.total_quant, 0) AS total_quant
FROM #phillist_trcn AS l
LEFT JOIN (
    SELECT user, SUM(quant) AS total_quant
    FROM #phillist_trcn
    GROUP BY user
) AS s ON l.user = s.user
ORDER BY l.data DESC
LIMIT {$limit}
";
			break;
			}

//			var_dump($parms['show']);
			if ($parms['show']) $qry = array_intersect_key($sqlqry, array_flip(explode(',', $parms['show'])));

//			var_dump($qry);

			$ns = e107::getRender();

//			$list = null;
			$text = null;

//			$layout = 'latest';

			if (!empty($this->menuPref['title']) && intval($this->menuPref['title']) === 1) // legacy pref value
			{
				$layout = 'default';
			}

			if(!empty($this->menuPref['layout'])) // @see e_menu
			{
				$layout = $this->menuPref['layout'];
			}

			$template = e107::getTemplate('phillis','lists_menu',$layout);

////			$param = array();

/*
			foreach($this->menuPref as $k=>$v)
			{
				$param['dl_'.$k] = $v;
			}
*/
//			var_dump($qry);
//			var_dump($layout);

			if($qry)
			{
				foreach ($qry as $key => $val) {
//var_dump($val);
				if($results = $sql->gen($val))
				{
					/*	if($tp->thumbWidth()  > 250) // Fix for unset image size.
					{
						$tp->setThumbSize(40,40,true);
					}*/

					$sc = e107::getScBatch('phillis', true);
//////////////////					$sc->setScVar('param',$param);
//					$sc->wrapper('latestdownload_menu/latest');
//			var_dump($layout);
					$sc->wrapper('lists_menu/'.$layout);
//////////////					$sc->wrapper('lists_menu');

//					$list = $tp->parseTemplate($template['start'], true);
					$text .= $tp->parseTemplate($template['start'], true);

					while($data = $sql->fetch())
					{
//						var_dump($row['phillis_tables_row']['user']);
//						echo "<hr>";
//$user = e107::getSystemUser($row['user']);
/*
if($user)
{
	$var = $user->getUserData();
}
*/
						$row['phillis_row_data'] = array_merge($data, e107::user($data['user']), array("source" => $key));
//$info = e107::user($row['phillis_tables_row']['user']);
//var_dump ($info);
//						$row['thread_sef'] = $this->downloadObj->getThreadSef($row);
//						$sc->download_requested_datestamp = $row['ultimo_datestamp'];
						$sc->setVars($row);
////						$sc->setScVar('postInfo', $row);

//						$sc->sc_download_requested_datestamp = function() use ($sc) {
//						    return "Teste".$sc->var['ultimo_datestamp'];
//						};

//						$list .= $tp->parseTemplate($template['item'], true, $sc);
						$text .= $tp->parseTemplate($template['item'], true, $sc);
/*
						++$total_topics;						
						$total_views += $row['thread_views'];						
						$total_replies += $row['thread_total_replies'];						
*/
					}

//					$TOTALS = array('TOTAL_TOPICS'=>$this->total['topics'], 'TOTAL_VIEWS'=>$this->total['views'], 'TOTAL_REPLIES'=>$this->total['replies']);
//					$TOTALS = array('TOTAL_TOPICS'=>$total_topics, 'TOTAL_VIEWS'=>$total_views, 'TOTAL_REPLIES'=>$total_replies);

//					$list .= $tp->parseTemplate($template['end'], true, $TOTALS);
					$text .= $tp->parseTemplate($template['end']);
//
//					$text = $list;
				}
				else
				{
					$text = LAN_DOWNLOAD_MENU_002;
				}
				}
			}
			else
			{
				$text = LAN_DOWNLOAD_MENU_016;
			}
//var_dump ($text);

//var_dump ($parms['caption']);
//var_dump (isset($parms['caption']));
			if(isset($parms['caption']))
//			if(isset($parms['caption']) && $parms['caption']!='no')
			{
				$caption = $this->getCaption();
			}


			if(!empty($this->menuPref['scroll']))
			{
				$text = "<div class='latest-menu-scroll' style='border: 0; width: auto; height: ".intval($this->menuPref['scroll'])."px; overflow: auto; '>".$text."</div>";
			}
		//	e107::debug('menuPref', $this->menuPref);

//		    e107::getCache()->set($this->cacheTag, $text, true);
/*
			var_dump($results);
			var_dump($parms['render']<>'dataonly');
			var_dump($parms['render']);
			var_dump($results && $parms['render']<>'dataonly');
			var_dump($results || !$parms['render']);
			var_dump(($results || !$parms['render']) || $parms['render']<>'dataonly');
*/
			if ((!$parms['render']) || ($results && $parms['render']=='dataonly')) {
				$ns->tablerender($caption, $text, 'dl_menu');
			}

		}

        private function getCaption()
        {
            if (!empty($this->menuPref['caption']))
            {
                if (array_key_exists(e_LANGUAGE, $this->menuPref['caption']))
                {
                    // Language key exists
                    $caption = vartrue($this->menuPref['caption'][e_LANGUAGE], LAN_THEME_4." ".LAN_PLUGIN_DOWNLOAD_NAME);
                }
                elseif (is_array($this->menuPref['caption']))
                {
                    // Language key not found
                    $keys = array_keys($caption = $this->menuPref['caption']);
                    // Just first language key from the list
                    $caption = vartrue($this->menuPref['caption'][$keys[0]], LAN_THEME_4." ".LAN_PLUGIN_DOWNLOAD_NAME);
                }
                else
                {
                    // No multilan array, just plain text
                    $caption = vartrue($this->menuPref['caption'], LAN_THEME_4." ".LAN_PLUGIN_DOWNLOAD_NAME);
                }
                //$caption = !empty($this->menuPref['caption'][e_LANGUAGE])  ? $this->menuPref['caption'][e_LANGUAGE] : $this->menuPref['caption'];
            }

            if (empty($caption))
            {
                $caption = LAN_THEME_4." ".LAN_PLUGIN_DOWNLOAD_NAME;
            }

            return $caption;
        }

	}

}

new phillis_lists_menu($parm);