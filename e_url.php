<?php
/*
 * e107 Bootstrap CMS
 *
 * Copyright (C) 2008-2015 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 * 
 * IMPORTANT: Make sure the redirect script uses the following code to load class2.php: 
 * 
 * 	if (!defined('e107_INIT'))
 * 	{
 * 		require_once(__DIR__.'/../../class2.php');
 * 	}
 * 
 */
 
if (!defined('e107_INIT')) { exit; }

// v2.x Standard  - Simple mod-rewrite module. 
class euser_url
{
		public $alias = 'euser';
	function config()
	{
		$config = array();

		// Página principal do friends
		$config['index'] = array(
			'regex'			=> '^{alias}/?(.*)$', 						// matched against url, and if true, redirected to 'redirect' below.
			'sef'			=> '{alias}', 							// used by e107::url(); to create a url from the db table.
			'redirect' => '{e_PLUGIN}euser/euser.php$1', // ficheiro real
			'legacy' => '{e_PLUGIN}euser/euser.php$1', // ficheiro real
		);
/*
		// Página de perfil de um utilizador
		$config['profile'] = array(
			'regex'    => '^friends/([\w\-]+)/?$',      // captura o username
			'sef'      => 'friends/{user}',             // gera URL SEF
			'redirect' => '{e_PLUGIN}user_friends/user_friends.php?user={user}',
		);
*/
		return $config;
	}
}