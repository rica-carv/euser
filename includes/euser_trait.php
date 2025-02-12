<?php
/*
+---------------------------------------------------------------+
|	e107 website system
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
trait Euser_global_info {
	// some code...
	function userinfo($parm=null)
	{
//		var_dump (e_PLUGIN_DIR);

// Mais coisas com números:
// - comentários
// - listas
// - albuns
// - amigos
// - ficheiros / downloads
// - hiperligações / cliques
// - classificados / anúncios
// - likes ?
//
//
		if (strpos(e_PAGE, "forum") !== false) {
			$sc = e107::getScBatch('view', 'forum');
			$uinfo[$sc->var['post_user']] = $sc->var['user_name'];
//			var_dump ($sc->var);
		} elseif (strpos(e_PAGE, "news") !== false) {
			$sc = e107::getScBatch('news');
//			$uid = $sc->news_item['news_author'];
//			$uname = $sc->news_item['user_name'];
			$uinfo[$sc->news_item['news_author']] = $sc->news_item['user_name'];
////			var_dump ($sc->news_item);
		} elseif (strpos(e_PAGE, "euser") !== false) {
			$sc = e107::getScBatch('user', 'euser', 'user');
//			$uid = $_GET['id'];
			$uinfo[$sc->var['user_id']] = $sc->var['user_name'];
		}
/*
		echo "<pre>";
		var_dump($sc->var);
		echo "</pre>";
		  var_dump ($uinfo);
		  echo "<pre>";
		  var_dump($this->var);
		  echo "</pre>";
*/
		if (!$uinfo) {

		}
		
//		  return ($parm=='name'?$unm:$uid);
		// vou passar ausar um array
//		  return array($uid => $uname);
		  return $uinfo;
	}

}