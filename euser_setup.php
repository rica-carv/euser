<?php
/*
* e107 website system
*
* Copyright (c) 2008-2013 e107 Inc (e107.org)
* Released under the terms and conditions of the
* GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
*
* Custom FAQ install/uninstall/update routines
*
*/

class euser_setup
{
/*	
 	function install_pre($var)
	{
		// print_a($var);
		// echo "custom install 'pre' function<br /><br />";
	}
*/
	function install_post($var)
	{
		$sql = e107::getDb();
		$mes = e107::getMessage();
		
# --------------------------------------------------------
#
# Initial data for table `euser_cache`
#
		$query = "INSERT INTO #euser_cache (`type`, `cache_name`, `cache`, `cache_hide`, `cache_records`, `cache_userclass`, `cache_timestamp`, `cache_active`, `type_order`) VALUES 
			('birthday','Birthday Data Cache','',0,0,0,0,0,0),
			('extraorder','ONLINEINFO_CACHEINFO_1','updated',0,0,253,0,0,1),
			('extraorder','ONLINEINFO_CACHEINFO_2','topvisits',1,10,253,10,0,4),
      ('extraorder','ONLINEINFO_CACHEINFO_3','lastvisitors',1,10,253,0,0,3),
      ('extraorder','ONLINEINFO_CACHEINFO_4','birthday',1,10,253,1440,0,2),
      ('extraorder','ONLINEINFO_CACHEINFO_5','toppost',1,10,253,480,0,5),
      ('extraorder','ONLINEINFO_CACHEINFO_6','toppoststarter',1,10,253,480,0,6),
      ('extraorder','ONLINEINFO_CACHEINFO_7','toppostreplier',1,10,253,480,0,7),
      ('extraorder','ONLINEINFO_CACHEINFO_8','topratedmember',1,10,253,480,0,8),
      ('extraorder','ONLINEINFO_CACHEINFO_9','counter',0,0,0,0,0,9),
      ('order','ONLINEINFO_CACHEINFO_10','avatar',0,0,253,0,0,1),
      ('order','ONLINEINFO_CACHEINFO_11','fc',1,0,253,0,0,4),
      ('order','ONLINEINFO_CACHEINFO_12','pm',0,0,253,0,0,2),
      ('order','ONLINEINFO_CACHEINFO_13','friends',1,0,253,0,0,5),
      ('order','ONLINEINFO_CACHEINFO_14','online',0,0,0,0,0,3),
      ('order','ONLINEINFO_CACHEINFO_15','extrainfo',0,0,0,0,0,6),
      ('order','ONLINEINFO_CACHEINFO_16','tmembers',0,0,0,0,0,7),
      ('toppost','Top Poster Data Cache','',0,0,0,0,0,0),
      ('toppostreplier','Top Replier Data Cache','',0,0,0,0,0,0),
      ('toppoststarter','Top Starter Data Cache','',0,0,0,0,0,0),
      ('topratedmember','Top Rated Data Cache','',0,0,0,0,0,0),
      ('topvisits','Top Visitor Data Cache','',0,0,0,0,0,0),
      ('classcolour','Save the User Class Colours info','',0,0,0,0,0,0);
		";
		
		$status = ($sql->db_Select_gen($query)) ? E_MESSAGE_SUCCESS : E_MESSAGE_ERROR;
		$mes->add("Adding Default table data to table: euser_cache",$status);

		
/*
		$query2 = "INSERT INTO #faqs_info (`faq_info_id`, `faq_info_title`, `faq_info_about`, `faq_info_parent`, `faq_info_class`, `faq_info_order`, `faq_info_icon`, `faq_info_metad`, `faq_info_metak`) VALUES 
			(1, 'General', 'General Faqs', 0, 0, 0, '', '', ''),
			(2, 'Misc', 'Other FAQs', 0, 0, 1, '', '', '');
		";

		$status = ($sql->db_Select_gen($query2)) ? E_MESSAGE_SUCCESS : E_MESSAGE_ERROR;
		$mes->add("Adding Default table data to table: faqs_info",$status);
*/
	}
/*	
	function uninstall_options()
	{
	
	}


	function uninstall_post($var)
	{
		// print_a($var);
	}

	function upgrade_post($var)
	{
		// $sql = e107::getDb();
	}
*/	
}
