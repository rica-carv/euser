<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2016 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)

*/

$ONLINE_MENU_TEMPLATE = array();

// Last seen Menu
$ONLINE_MENU_TEMPLATE['lastseen']['start']	                        = "<ul class='lastseen-menu '>";
$ONLINE_MENU_TEMPLATE['lastseen']['item']	                        = "<li>{LASTSEEN_USERLINK} <small class='muted'>{LASTSEEN_DATE}</small></li>";
$ONLINE_MENU_TEMPLATE['lastseen']['end']	                        = "</ul>";




// Online Menu - default.

$ONLINE_MENU_TEMPLATE['default']['enabled']                         = "
																	<ul class='online-menu'>
																	{EOM_GUESTS}
																	{EOM_MEMBERS}
																	{EOM_MEMBERS_LIST_EXTENDED}
																	{EOM_ONPAGE}
																	{EOM_MEMBER_TOTAL}
																	{EOM_MEMBER_NEWEST}
																	<li>
																	{EOM_MOST}
																	<small class='muted'>
																	{EOM_MOST_GUESTS}
																	{EOM_MOST_MEMBERS}
																	{EOM_MOST_DATESTAMP}
																	</small>
																	</li>
																	</ul>
																	";

$ONLINE_MENU_TEMPLATE['default']['disabled']                        = "{EOM_TRACKING_DISABLED}";
$ONLINE_MENU_TEMPLATE['default']['online_members_list_extended']    = "{SETIMAGE: w=40}<li class='media'><span class='media-object pull-left'>{EOM_MEMBER_IMAGE=avatar}</span><span class='media-body'>{EOM_MEMBER_USER} ".LAN_EUSER_107." {EOM_MEMBER_PAGE}</span></li>";




$ONLINE_MENU_WRAPPER['default']['EOM_GUESTS']                   = "<li>".LAN_EUSER_101."{---}</li>";
$ONLINE_MENU_WRAPPER['default']['EOM_MEMBERS']                  = "<li>".LAN_EUSER_102."{---}</li>";
$ONLINE_MENU_WRAPPER['default']['EOM_MEMBERS_LIST']             = "<ul>{---}</ul>";
$ONLINE_MENU_WRAPPER['default']['EOM_MEMBERS_LIST_EXTENDED']    = "<ul class='unstyled list-unstyled'>{---}</ul>";
$ONLINE_MENU_WRAPPER['default']['EOM_ONPAGE']                   = "<li>".LAN_EUSER_103."{---}</li>";
$ONLINE_MENU_WRAPPER['default']['EOM_MEMBER_TOTAL']             = "<li>".LAN_EUSER_102."{---}</li>";
$ONLINE_MENU_WRAPPER['default']['EOM_MEMBER_NEWEST']            = "<li>".LAN_EUSER_106."{---}</li>";
$ONLINE_MENU_WRAPPER['default']['EOM_MOST']                     = LAN_EUSER_108."{---}<br />";
$ONLINE_MENU_WRAPPER['default']['EOM_MOST_MEMBERS']             = LAN_EUSER_102."{---}";
$ONLINE_MENU_WRAPPER['default']['EOM_MOST_GUESTS']              = LAN_EUSER_101."{---}";
$ONLINE_MENU_WRAPPER['default']['EOM_MOST_DATESTAMP']           = LAN_EUSER_109."{---}";
$ONLINE_MENU_WRAPPER['default']['EOM_MEMBERS_REGISTERED']       = "<li>".LAN_EUSER_1011."{---}";


//##### ONLINE MEMBER LIST EXTENDED -------------------------------------------

$ONLINE_MENU_TEMPLATE['disabled']                       = "{EOM_TRACKING_DISABLED}";

// Daqui para cima tiro tudo???


$ONLINE_MENU_TEMPLATE['enabled']                        = "
																		<ul class='online-menu online-menu-extended list-unstyled'>
																		{EOM_GUESTS}
																		{EOM_MEMBERS}
																		{EOM_MEMBERS_LIST_EXTENDED}
																		{EOM_ONPAGE}
																		{EOM_MEMBERS_TOTAL}
																		{EOM_MEMBER_NEWEST: type=avatar}
																		{EOM_MEMBERS_REGISTERED}
																		<li class='online-menu-extended-label'>
																		{EOM_MOST:default}
																		<div id='online-menu-extended-most' class='text-muted text-right' style='display:none'>
																		<small>
																		{EOM_MOST:type=guests}<br />
																		{EOM_MOST:type=members}<br />
																		{EOM_MOST:type=datestamp&style=long}
																		</small>
																		</div>
																		</li>
																		</ul>
																	";

/*
$ONLINE_MENU_TEMPLATE['online_members_list_extended']   = "{SETIMAGE: w=48&h=48&crop=1}<li class='media'><div class='media-left'>{EOM_MEMBER_IMAGE: type=avatar&shape=circle}</div><div class='media-body'><span class='online-menu-user'>{EOM_MEMBER_USER}</span><small class='text-muted'>{EOM_MEMBER_PAGE}</small></div></li>";
$ONLINE_MENU_TEMPLATE['online_member_newest']           = "{SETIMAGE: w=48&h=48&crop=1}<li class='media'><div class='media-left'>{EOM_MEMBER_IMAGE: type=avatar&shape=circle}</div><div class='media-body'><span class='online-menu-user'>{EOM_MEMBER_USER}</span></div></li>";
*/
//

// Shortcode wrappers
$ONLINE_MENU_WRAPPER['EOM_GUESTS']                   = "<li class='online-menu-extended-label'>".LAN_EUSER_101."<span class='label label-primary pull-right'>{---}</span></li>";
$ONLINE_MENU_WRAPPER['EOM_MEMBERS']                  = "<li class='online-menu-extended-label'>".LAN_EUSER_102."<span class='label label-primary pull-right'>{---}</span></li>";
$ONLINE_MENU_WRAPPER['EOM_MEMBERS_LIST']             = "<ul>{---}</ul>";
$ONLINE_MENU_WRAPPER['EOM_MEMBERS_LIST_EXTENDED']    = "<ul class='unstyled list-unstyled'>{---}</ul>";
$ONLINE_MENU_WRAPPER['EOM_ONPAGE']                   = "<li>".LAN_EUSER_103."<span class='label label-default pull-right'>{---}</span></li>";
$ONLINE_MENU_WRAPPER['EOM_MEMBERS_TOTAL']             = "<li class='online-menu-extended-label'>".LAN_EUSER_105."<span class='label label-default pull-right'>{---}</span></li>";
$ONLINE_MENU_WRAPPER['EOM_MEMBER_NEWEST']            = "<li class='online-menu-extended-label'>".LAN_EUSER_106."</li><ul class='unstyled list-unstyled'>{---}</ul>";
$ONLINE_MENU_WRAPPER['EOM_MOST:default']                     = "<a class='e-expandit' href='#online-menu-extended-most'>".LAN_EUSER_108."</a><span class='label label-default pull-right'>{---}</span><br />";
$ONLINE_MENU_WRAPPER['EOM_MOST:type=members']             = LAN_EUSER_102."{---}";
$ONLINE_MENU_WRAPPER['EOM_MOST:type=guests']              = LAN_EUSER_101."{---}";
$ONLINE_MENU_WRAPPER['EOM_MOST:type=datestamp&style=long']           = "{---}";
$ONLINE_MENU_WRAPPER['EOM_MEMBERS_REGISTERED']       = "<li class='online-menu-extended-label'>".LAN_EUSER_1011."<span class='label label-default pull-right'>{---}</li>";
$ONLINE_MENU_WRAPPER['EOM_MEMBER_PAGE']              = LAN_EUSER_107." {---}";
