<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2013 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Members templates
 *
 */

if (!defined('e107_INIT')) { exit(); }

// Templates for own euser menus
$MEMBER_TEMPLATE['extended']   = "{SETIMAGE: w=48&h=48&crop=1}<li class='media'><div class='media-left'>{EUSER_MEMBER_IMAGE: type=avatar&shape=circle}</div><div class='media-body'><span class='online-menu-user'>{EUSER_MEMBER}</span><small class='text-muted'>{EUSER_MEMBER_PAGE}</small></div></li>"; //Online menu
$MEMBER_TEMPLATE['short']           = "{SETIMAGE: w=48&h=48&crop=1}<li class='media'><div class='media-left'>{EUSER_MEMBER_IMAGE: type=avatar&shape=circle}</div><div class='media-body'><span class='online-menu-user'>{EUSER_MEMBER}</span></div></li>"; // Online menu
$MEMBER_TEMPLATE['noavatar']           = '<a href="'.e_BASE.'user.php?id.'.USERID.'">'.LAN_EUSER_0013.'</a>'; // Dashboard menu