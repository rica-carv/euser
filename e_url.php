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
 * 		require_once("../../class2.php");
 * 	}
 * 
 */
 
if (!defined('e107_INIT')) { exit; }

// v2.x Standard  - Simple mod-rewrite module. 

class phillis_url // plugin-folder + '_url'
{
	public $alias = 'phillis';

	function config() 
	{
		$config = array();

/*
		$config['rules'] = array(
			'regex'			=> '^forum/rules/?',
			'sef'			=> 'forum/rules',
			'redirect'		=> '{e_PLUGIN}forum/forum.php?f=rules',
		);

		$config['stats'] = array(
			'regex'			=> '^forum/stats/?',
			'sef'			=> 'forum/stats',
			'redirect'		=> '{e_PLUGIN}forum/forum_stats.php',
		);

		$config['track'] = array(
			'regex'			=> '^forum/track/?',
			'sef'			=> 'forum/track',
			'redirect'		=> '{e_PLUGIN}forum/forum.php?f=track',
		);

		$config['markread']  = array(
			'sef'           => '^forum/markread/{forum_id}',
			'regex'			=> 'forum/markread/([\d]*)',
			'redirect'      => '{e_PLUGIN}forum/forum.php?f=mfar&id=$1',
			'legacy'        => '{e_PLUGIN}forum/forum.php?f=mfar&id={forum_id}'
		);

		$config['new']  = array(
            'regex'			=> '^forum/new$/?',
			'sef'           => 'forum/new',
			'redirect'      => '{e_PLUGIN}forum/forum.php?new'
		);

		$config['post'] = array(
			'regex'			=> '^forum/post/?',
			'sef'			=> 'forum/post/',
			'redirect'		=> '{e_PLUGIN}forum/forum_post.php',
		);

		// only create url  - parsed above.
		$config['move'] = array(
			'sef'           => 'forum/post/?f=move&id={thread_id}',
			'legacy'        => '{e_PLUGIN}forum/forum_post.php?f=move&id={thread_id}'
		);



		$config['split'] = array(
			'sef'           => 'forum/post/?f=split&id={thread_id}&post={post_id}',
			'legacy'        => '{e_PLUGIN}forum/forum_post.php?f=split&id={thread_id}&post={post_id}'
		);

		$config['topic'] = array(
			'regex'         => 'forum\/([^\/]*)\/([\d]*)(?:\/|-)([\w-]*)/?\??(.*)',
		//	'regex'			=> '^forum/(.*)/(\d*)(?:-|/)([\w-]*)/?\??(.*)',
			'sef'			=> 'forum/{forum_sef}/{thread_id}/{thread_sef}/',
			'redirect'		=> '{e_PLUGIN}forum/forum_viewtopic.php?id=$2&$4'
		);
*/
/*
		$config['view'] = array(
			// Matched against url, and if true, redirected to 'redirect' below.
			'regex'    => '^phillis/phillis_view.php/(.*)/(.*)$',
			// File-path of what to load when the regex returns true.
			'redirect' => '{e_PLUGIN}phillis/phillis_view.php?$1.$2'
		);
*/
/*
		$config['subforum'] = array(
			'regex'			=> '^forum/(.*)/(.*)$',
			'sef'			=> 'forum/{parent_sef}/{forum_sef}',
			'redirect'		=> '{e_PLUGIN}forum/forum_viewforum.php?sef=$2',
			'legacy'        => '{e_PLUGIN}forum/forum_viewforum.php?id={forum_id}'
		);
*/

		$config['index'] = array(
//			'alias'         => $alias."/",
			'regex'			=> '^{alias}/?$', 						// matched against url, and if true, redirected to 'redirect' below.
			'sef'			=> '{alias}', 							// used by e107::url(); to create a url from the db table.
			'redirect'		=> '{e_PLUGIN}phillis/phillis.php', 		// file-path of what to load when the regex returns true.
			'legacy'		=> '{e_PLUGIN}phillis/phillis.php', 		// file-path of what to load when the regex returns true.
		);

/*
		$config['image']     = array(
			'regex'		    => '^{alias}/images',
			'sef'           => '{alias}',
			'redirect'	    => '{e_PLUGIN}philcat/images', 		// file-path of what to load when the regex returns true.
		);

		$config['menu']     = array(
			'regex'		    => '^{alias}_menu\/?$',
			'sef'           => '{alias}',
			'redirect'	    => '{e_PLUGIN}philcat/philcat_menu.php', 		// file-path of what to load when the regex returns true.
		);
*/

		$config['media']     = array(
			'regex'		    => '^{alias}/media/([\d]*)/(.*)$',
			'sef'           => '{alias}/media',
			'redirect'	    => '{e_PLUGIN}phillis/media/([\d]*)/(.*)$', 		// file-path of what to load when the regex returns true.
		);

/*
		$config['page'] = array(
			'regex'         => 'forum\/([^\/]*)\/([\d]*)(?:\/|-)([\w-]*)/?\??(.*)',
		//	'regex'			=> '^forum/(.*)/(\d*)(?:-|/)([\w-]*)/?\??(.*)',
			'sef'			=> 'forum/{forum_sef}/{thread_id}/{thread_sef}/',
			'redirect'		=> '{e_PLUGIN}forum/forum_viewtopic.php?id=$2&$4'
		);
*/

		$config['view'] = array(
			'regex'			=> '^{alias}/view\/?(.*)$',
//		    'regex'    => '^{alias}/view/([nuos]\.[0-9]+)$',
			'sef'			=> '{alias}/view/{id}',
//			'redirect'		=> '{e_PLUGIN}philcat/philcat.php?$1&$2',
			'redirect'		=> '{e_PLUGIN}phillis/phillis_view.php?$1',
//			'legacy'        => '{e_PLUGIN}phillis/phillis_view.php?{FROM}'
		);

		$config['edit'] = array(
			'regex'			=> '^{alias}/edit\/?(.*)$',
//		    'regex'    => '^{alias}/edit/([nuos]\.[0-9]+)$',
			'sef'			=> '{alias}/edit/{id}',
//			'redirect'		=> '{e_PLUGIN}philcat/philcat.php?$1&$2',
			'redirect'		=> '{e_PLUGIN}phillis/phillis_view.php?$1&action=edit',
//			'legacy'        => '{e_PLUGIN}phillis/phillis_view.php?{FROM}'
		);

		return $config;
	}
	

	
}
