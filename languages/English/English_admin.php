<?php

// ONLINE INFO MENU
/*
+---------------------------------------------------------------+
|	e107 website system
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

/* ANTIGO
define("EUSER_LOGIN_MENU_A1", "Euser menu configuration saved");
define("EUSER_LOGIN_MENU_A2", "Euser Menu Configuration");
*/

define("LAN_EUSER_ADMIN_CLICKHERESTART", "Click Here to ");
define("LAN_EUSER_ADMIN_GOTO", "go to ");
define("LAN_EUSER_ADMIN_CONFIG", "Configure");
define("LAN_EUSER_ADMIN_PICKCOLOR", "Pick up the color");
define("LAN_EUSER_ADMIN_SHAREDCONFIG", "Please take attention, these settings are shared across several areas of the plugin (menus, pages, etc.), and influence globally the output of those areas...");
define("LAN_EUSER_ADMIN_SHAREDCONFIGMENUS", "Therefore, some configurations for this menu should be setup using the link buttons below...");
define("LAN_EUSER_ADMIN_SHAREDTAB", "Shared preferences");

define("LAN_EUSER_ADMIN_COLORH",  LAN_EUSER_ADMIN_CLICKHERESTART.LAN_EUSER_ADMIN_PICKCOLOR);

//euser_menu lans
define("LAN_EUSER_ADMIN_001", "Section Memory");
define("LAN_EUSER_ADMIN_001H", "This sets the Browser to remember which sections are open or closed");
define("LAN_EUSER_ADMIN_002", "Use 'Delete Me' plugin");
define("LAN_EUSER_ADMIN_002H", "This is for the Delete me Plugin to allow user to delete the account.");
define("LAN_EUSER_ADMIN_003", "Login Dialog");
define("LAN_EUSER_ADMIN_003H", "Turn it off if your Theme already has a Login option on it.");
define("LAN_EUSER_ADMIN_004", "Display Avatar");
define("LAN_EUSER_ADMIN_004H", "Turn on/off Avatar and only show settings menu");

//define("LAN_EUSER_ADMIN_005", "What's New");
define("LAN_EUSER_ADMIN_006", "Members Sections");
define("LAN_EUSER_ADMIN_007", "Info Sections");
//define("LAN_EUSER_ADMIN_006", "Online");     LAN_EUSER_104, LAN_EUSER_0043

//euser_online lans
define("LAN_EUSER_ADMIN_051", "Use the Detailed View");
define("LAN_EUSER_ADMIN_051H", "There are now two views to pick from.<br /> The basic view will only show members online and only counts the guests.<br />It will also show you if they are an Head Administrator, Administrator, Forum Moderator or just a plain member.");
define("LAN_EUSER_ADMIN_052", "Settings for Detailed View");
define("LAN_EUSER_ADMIN_053", "Show Bots");
define("LAN_EUSER_ADMIN_053H", "Set to No to see as guests");
define("LAN_EUSER_ADMIN_054", "Admin IP Checker (Host lookup)");
define("LAN_EUSER_ADMIN_055", "Auto Hide Members");
define("LAN_EUSER_ADMIN_056", "Auto Hide Guests");
define("LAN_EUSER_ADMIN_057", "Show User Avatars");
define("LAN_EUSER_ADMIN_058", "Show Guest Info");
define("LAN_EUSER_ADMIN_059", "Show Icons Toolbar");
define("LAN_EUSER_ADMIN_060", "Show Admin Status in Toolbar");
// DEPRECATED! SETUP VIA TEMPLATE/CSS
/*
define("LAN_EUSER_ADMIN_061", "Pop up user info border colour");

define("LAN_EUSER_ADMIN_062", "Pop up user info background color");
define("LAN_EUSER_ADMIN_063", "Members name font size (px)");
*/
//define("LAN_EUSER_ADMIN_061H", "Pick up the color");

//euser_whatsnew lans
define("LAN_EUSER_ADMIN_101", "Select which link to What's new page");
define("LAN_EUSER_ADMIN_101E", "Built in Euser version");
define("LAN_EUSER_ADMIN_101D", "List plugin");
define("LAN_EUSER_ADMIN_102", "Show registered user count");
define("LAN_EUSER_ADMIN_103", "Auto hide registered users");
//define("LAN_EUSER_ADMIN_104", "Flash text for new items");
define("LAN_EUSER_ADMIN_105", "What's new flash text color");
define("LAN_EUSER_ADMIN_105I", "Clear color field to disable...");
//define("LAN_EUSER_ADMIN_106", "Show new items icon");
define("LAN_EUSER_ADMIN_107", "Select new items icon blink rate");
define("LAN_EUSER_ADMIN_107H", "Default: 20 times");
define("LAN_EUSER_ADMIN_108", "20 times");
define("LAN_EUSER_ADMIN_109", "Forever");
define("LAN_EUSER_ADMIN_110", "Hide items if there's nothing new");
define("LAN_EUSER_ADMIN_110H", "This hides the line on the menu if there are no new records to show");
define("LAN_EUSER_ADMIN_111", "Display admin area info");
define("LAN_EUSER_ADMIN_112", "Auto hide admin area");

define("LAN_EUSER_ADMIN_113", "What's New page configuration");
define("LAN_EUSER_ADMIN_113I", "These settings below are for the built in Euser version of 'What's New Page' and therefore will not change what is shown on the List version.<br>Furthermore, the below settings can be overriden by custom templates inside themes for the Euser plugin...");

define("LAN_EUSER_ADMIN_114", "Core plugin");
// Deprecated      define("LAN_EUSER_ADMIN_115", "Display");
define("LAN_EUSER_ADMIN_115", "News quantity to display");
define("LAN_EUSER_ADMIN_115H", "Set value to positive (ex.: 25) to enable<br>Set value to negative (ex.: -25) or clear value to disable");
define("LAN_EUSER_ADMIN_116", "News");
// Deprecated      define("LAN_EUSER_ADMIN_117", "Other Options");
define("LAN_EUSER_ADMIN_117", "Content");
define("LAN_EUSER_ADMIN_118", "New members");
define("LAN_EUSER_ADMIN_119", "Comments");
define("LAN_EUSER_ADMIN_119I", "This is for all comments");
define("LAN_EUSER_ADMIN_120", "Forum");
define("LAN_EUSER_ADMIN_121", "Display Forum as");
define("LAN_EUSER_ADMIN_121E", "Thread Summarised");
define("LAN_EUSER_ADMIN_121D", "Every Post");
define("LAN_EUSER_ADMIN_122", "Downloads");
define("LAN_EUSER_ADMIN_123", "Click here to install and configure the plugins that are not installed and have its fields disabled above.");

define("LAN_EUSER_ADMIN_125", "3rd party plugin");
define("LAN_EUSER_ADMIN_126", "Chatbox");
define("LAN_EUSER_ADMIN_127", "Chatbox II");
define("LAN_EUSER_ADMIN_128", "Coppermine (plugin)");
define("LAN_EUSER_ADMIN_129", "Coppermine comments");
define("LAN_EUSER_ADMIN_130", "Guestbook");
define("LAN_EUSER_ADMIN_131", "You Tube");
define("LAN_EUSER_ADMIN_132", "Krooze Arcade");
define("LAN_EUSER_ADMIN_133", "Krooze Arcade Top Scores");
define("LAN_EUSER_ADMIN_134", "Link Page");
define("LAN_EUSER_ADMIN_135", "Bugtracker3");
define("LAN_EUSER_ADMIN_136", "Jokes");
define("LAN_EUSER_ADMIN_137", "Blogs");
define("LAN_EUSER_ADMIN_138", "Suggestions");

// Settings lans
define("LAN_EUSER_ADMIN_300", "Registration and registration cancellation");
define("LAN_EUSER_ADMIN_301", "Recently changed to access a list of profiles");
define("LAN_EUSER_ADMIN_302", "Profiles page last changed columns");
define("LAN_EUSER_ADMIN_303", "Most recently changed the display mode menu profiles");
define("LAN_EUSER_ADMIN_304", "Last changed profiles up menu. many members appear");
define("LAN_EUSER_ADMIN_304H", "Default value: 3");
define("LAN_EUSER_ADMIN_305", "Clickable links for use with images?<br/>(Some of the topics better suited)");
define("LAN_EUSER_ADMIN_306", "WARN System Support");
define("LAN_EUSER_ADMIN_306H", "You can read more about the WARN system settings here: http://v1.e107hungary.org");
define("LAN_EUSER_ADMIN_307", "Redirect new users after logon to the profile set page");
define("LAN_EUSER_ADMIN_308", "Members can cancel their registration");
define("LAN_EUSER_ADMIN_308H", "When registration is canceled, member's Another Profiles picture, video, profile comments, friend lists, pictures & soundfiles will be deleted, and the member will be deleted from the user database of the page as well. The main Admin will be informed in an e-mail and private message.");
define("LAN_EUSER_ADMIN_309", "Members cancelling registration will save their pictures & music");
define("LAN_EUSER_ADMIN_309H", "If on, a save is done of the user albums, pictures and mp3 when cancelling registration");
define("LAN_EUSER_ADMIN_310", "Vertical");
define("LAN_EUSER_ADMIN_311", "Horizontal");

// Friends system lans
define("LAN_EUSER_ADMIN_400", "Friends system");
define("LAN_EUSER_ADMIN_401", "That column to display the list of friends");
define("LAN_EUSER_ADMIN_401H", "Maximum allowed: 8");
define("LAN_EUSER_ADMIN_402", "New members receive a private message by default, if designated for a friend");
define("LAN_EUSER_ADMIN_403", "New members receive e-mail by default, if marked for a friend");
define("LAN_EUSER_ADMIN_404", "This setting overrides members personal settings");

// Profile lans
//define("LAN_EUSER_ADMIN_501", "Use plugin members \"settings\" and \"profile\" pages, instead of core ones");
define("LAN_EUSER_ADMIN_501", "Member class allowed to view user profile");
define("LAN_EUSER_ADMIN_501I", "If set to ".UC_LAN_2.", the profiles section of the plugin can only be used with direct links and will have no effect on the site");
define("LAN_EUSER_ADMIN_502", "User class allowed to edit own profile");
define("LAN_EUSER_ADMIN_502I", "If set to ".UC_LAN_2.", the edit profiles section of the plugin can only be used with direct links and will have no effect on the site");
define("LAN_EUSER_ADMIN_503", "Profile Statistics (All reviewers)");
define("LAN_EUSER_ADMIN_510", "Profile comments");
define("LAN_EUSER_ADMIN_511", "Maximum number of profile comments");
define("LAN_EUSER_ADMIN_511H", "The maximum number of profile comments per member");
define("LAN_EUSER_ADMIN_512", "Image comments max");
define("LAN_EUSER_ADMIN_512H", "The maximum number of posted comments per picture");
define("LAN_EUSER_ADMIN_513", "Video comments max");
define("LAN_EUSER_ADMIN_513H", "The maximum number of posted comments per video");
define("LAN_EUSER_ADMIN_514", "Number of comments per page");
define("LAN_EUSER_ADMIN_515", "<b>Following of profile, video and picture comments</b>");
define("LAN_EUSER_ADMIN_516", "Comments follow - The last profile, image and video posts list");
define("LAN_EUSER_ADMIN_516H", "Set the maximum number of posts to list here");
define("LAN_EUSER_ADMIN_517", "Comment tracking");
define("LAN_EUSER_ADMIN_518", "The maximum width of pictures and videos at the following of comments");
define("LAN_EUSER_ADMIN_520", "Image galleries");
define("LAN_EUSER_ADMIN_521", "<b>Pictures and albums</b>");
define("LAN_EUSER_ADMIN_522", "Maximum number of albums");
define("LAN_EUSER_ADMIN_522H", "Every member is limited to this number of picture albums");
define("LAN_EUSER_ADMIN_523", "Maximum images per album");
define("LAN_EUSER_ADMIN_523H", "Every member is limited to this number of pictures per album");
define("LAN_EUSER_ADMIN_524", "Column of User images and albums");
//define("LAN_EUSER_ADMIN_524H", "Default 3");
define("LAN_EUSER_ADMIN_525", "Photo Gallery quota per member (KB)");
define("LAN_EUSER_ADMIN_525H", "Every member is limited to this much of kB in images galleries");
define("LAN_EUSER_ADMIN_526", "Maximum upload picture size (KB)");
define("LAN_EUSER_ADMIN_526H", "Currently, the server php.ini setting is up to [x]B, maximum [y] megapixel resolution set to use in GD, and the php memory_limit is set to [z]. If you want to enable bigger resolutions file than this, then you have to enlarge php memory limit on the server or use imagick.");
define("LAN_EUSER_ADMIN_526W", "WARNING! File uploads disabled in core!!!");
//###################################################
define("ADMIN_PROFILE_21c", "MP resolution pictures can be uploaded.");
//###################################################
define("LAN_EUSER_ADMIN_527", "Allow private albums");
define("LAN_EUSER_ADMIN_527H", "If checked, then the members can create private albums. The moderation of user / administrator rights banning admins and members outside the establishing the album - if the system is turned on friends, only friends can view the tag");
define("LAN_EUSER_ADMIN_528", "Allow accented characters in image and album names");
define("LAN_EUSER_ADMIN_528N", "NOTE! Not every server supports accented names!");
define("LAN_EUSER_ADMIN_529", "The length field in the user table user_image");
define("LAN_EUSER_ADMIN_529H", "The default value 100, max. value 200");
define("LAN_EUSER_ADMIN_530", "Imagick PHP support enabled");
define("LAN_EUSER_ADMIN_530H", "If the server supports the use of imagick, then use Imagick instead of GD for resizing");
define("LAN_EUSER_ADMIN_531", "<b>Show Pictures</b>");
define("LAN_EUSER_ADMIN_532", "Uploaded images Max. display width in pixels");
define("LAN_EUSER_ADMIN_532I", "If a larger picture, then clicked the new window opens, or if enabled, then the Lightbox, LightWindow, LightView or ClearBox Displays");
define("LAN_EUSER_ADMIN_533", "Allow Lightbox");
define("LAN_EUSER_ADMIN_533H", "Lightbox plugin install needed for the use");
define("LAN_EUSER_ADMIN_534", "Allow LightWindow");
define("LAN_EUSER_ADMIN_534H", "LightWindow plugin install needed for the use");
define("LAN_EUSER_ADMIN_535", "Allow LightView");
define("LAN_EUSER_ADMIN_535H", "Corllete Lab Lightview Widget plugin install needed for the use");
define("LAN_EUSER_ADMIN_536", "Allow ClearBox");
define("LAN_EUSER_ADMIN_536H", "Clearbox included. To be able to use it you must accept the conditions in the file <a href='clearbox/clearbox.txt'>clearbox.txt</a>");
define("LAN_EUSER_ADMIN_537", "Profile picture size (Width x Height)");
define("LAN_EUSER_ADMIN_537H", "The size of the picture in the user profile. For keeping the scale you need to keep only the width. If you do not give data, the basic settings is 200px");
define("LAN_EUSER_ADMIN_538", "Avatar size (Width x Height) in the members, profile and settings page");
define("LAN_EUSER_ADMIN_538H", "Leave blank for basic settings (given in the e107 members settings) size. For keeping the scale you need to keep only the width");

define("LAN_EUSER_ADMIN_540", "Video galleries");
define("LAN_EUSER_ADMIN_541", "Maximum number of videos per member");
define("LAN_EUSER_ADMIN_541H", "0 = There is no limit");
define("LAN_EUSER_ADMIN_542", "Video width");
define("LAN_EUSER_ADMIN_542H", "Default 640");
define("LAN_EUSER_ADMIN_543", "<b>Selectable video sharing</b>");
//define("LAN_EUSER_ADMIN_544", "Youtube");
define("LAN_EUSER_ADMIN_545", "Vimeo");
define("LAN_EUSER_ADMIN_546", "Metacafe");
define("LAN_EUSER_ADMIN_547", "Indavideo");

define("LAN_EUSER_ADMIN_550", "Profile background music");
define("LAN_EUSER_ADMIN_551", "Profile background music location. If enabled the upload, do not forget to file type of authorization (filetypes.php - .mp3)");
define("LAN_EUSER_ADMIN_552", "Profile background music maximum size (KB)");
define("LAN_EUSER_ADMIN_552H", "Currently, the server php.ini setting is up to [x] the size of file can be uploaded!");
define("LAN_EUSER_ADMIN_553", "The background music starts automatically when opening the profile?");
define("LAN_EUSER_ADMIN_554", "Repeat music (loop), if the profile music has reached the end");
define("LAN_EUSER_ADMIN_555", "Music volume");
define("LAN_EUSER_ADMIN_555H", "Value between 1 (minimum volume) to 200 (maximum volume)");
define("LAN_EUSER_ADMIN_556", "External link");
define("LAN_EUSER_ADMIN_557", "File uploaded");
define("LAN_EUSER_ADMIN_558", "Both");

//Member list lans
//define("LAN_EUSER_ADMIN_511", "Use plugin member list, instead of core one");
define("LAN_EUSER_ADMIN_601", "Member class allowed to view members list");
define("LAN_EUSER_ADMIN_601I", "If set to ".UC_LAN_2.", default core member list is displayed");
define("LAN_EUSER_ADMIN_602", "Members list of the default sort criteria");
define("LAN_EUSER_ADMIN_603", "Username");
define("LAN_EUSER_ADMIN_604", "Email address");
define("LAN_EUSER_ADMIN_605", "Registration Date");
define("LAN_EUSER_ADMIN_606", "Last visit");
define("LAN_EUSER_ADMIN_607", "Number of visits");
define("LAN_EUSER_ADMIN_608", "Members list sorted by default");
define("LAN_EUSER_ADMIN_609", "Ascending");
define("LAN_EUSER_ADMIN_610", "Descending");
define("LAN_EUSER_ADMIN_611", "List Layout");
define("LAN_EUSER_ADMIN_612", "Traditional");
define("LAN_EUSER_ADMIN_613", "Contacts");
define("LAN_EUSER_ADMIN_614", "Css stylesheet layout used about");
define("LAN_EUSER_ADMIN_614H", "The css directory of the two sample css file. Lite: a clear theme, Dark: dark themes");
define("LAN_EUSER_ADMIN_615", "automatic");
define("LAN_EUSER_ADMIN_616", "lite");
define("LAN_EUSER_ADMIN_617", "dark");
define("LAN_EUSER_ADMIN_618", "About layout, the number of columns");
//define("LAN_EUSER_ADMIN_618H", "Default value: 3");
define("LAN_EUSER_ADMIN_619", "Column label CSS class");
define("LAN_EUSER_ADMIN_619H", "Enter the CSS class name of the column you want to use subtitles (default: \"button\")");
define("LAN_EUSER_ADMIN_620", "Ordered column color appears when the order is increasing");
define("LAN_EUSER_ADMIN_620H", "RGB hex code to enter eg. Red: FF0000 or F00. If you do not specify a color, then the theme will be used to set the color and did not appear, which column orderly");
define("LAN_EUSER_ADMIN_621", "Ordered column color appears when the order is decreasing");
define("LAN_EUSER_ADMIN_622", "Display \"Add to Friends\" link in member list");
define("LAN_EUSER_ADMIN_622H", "Click on the thumbnails directly from a list of the members designated as friends of the tag, and indicates that you have already checked / e-friendly");
define("LAN_EUSER_ADMIN_623", "Members List Columns");
define("LAN_EUSER_ADMIN_623H", "The logon name, time zone and IP Address columns in only the appropriate permissions (user moderation / banning, etc..) admins can see in");
define("LAN_EUSER_ADMIN_624", "Avatar");     //LAN_USER_07
define("LAN_EUSER_ADMIN_625", "User Online");
define("LAN_EUSER_ADMIN_626", "Real name");
define("LAN_EUSER_ADMIN_627", "Loginname");     //LAN_USER_02
//define("LAN_EUSER_ADMIN_628", "E-mail address");
define("LAN_EUSER_ADMIN_628", "Birth date");   // Data de nascimento
//define("LAN_EUSER_ADMIN_629", "Registration Date");
define("LAN_EUSER_ADMIN_629", "Country");   // País
//define("LAN_EUSER_ADMIN_630", "Last visit");
define("LAN_EUSER_ADMIN_630", "Website");   // Site
//define("LAN_EUSER_ADMIN_631", "Number of visits");
define("LAN_EUSER_ADMIN_631", "Language");    // Língua

define("LAN_EUSER_ADMIN_632", "Time Zone");
define("LAN_EUSER_ADMIN_633", "IP-Address");
define("LAN_EUSER_ADMIN_634", "Allow filtering of results");
define("LAN_EUSER_ADMIN_634H", "Who knows picture, video, messages, etc.. to filter the list of members");
define("LAN_EUSER_ADMIN_635", "To give extra information in the members' list about the member's comments, pictures, videos, music");
define("LAN_EUSER_ADMIN_635H", "If enabled, little pictures showing if the member has forum message, forum comment, or comments about his uploaded pictures, videos or profile");
define("LAN_EUSER_ADMIN_636", "The extra information contained herein show thumbnails (the nickname column)");
define("LAN_EUSER_ADMIN_636H", "If you go to the small pictures displayed on the mouse, you can see how many posts, comments, image or video is a member");
define("LAN_EUSER_ADMIN_637", "Forum Messages");
//define("LAN_EUSER_ADMIN_638", "Comments");
define("LAN_EUSER_ADMIN_638", "Location");    // Local
//define("LAN_EUSER_ADMIN_639", "Profile Comments");

define("LAN_EUSER_ADMIN_640", "Pictures");
define("LAN_EUSER_ADMIN_641", "Video");
define("LAN_EUSER_ADMIN_642", "Music");
define("LAN_EUSER_ADMIN_643", "Enable Advanced Search");
define("LAN_EUSER_ADMIN_644", "Advanced search using search fields are displayed");
define("LAN_EUSER_ADMIN_644H", "Search completed in certain fields of \"and \" relationship");
define("LAN_EUSER_ADMIN_645", "User Class");
define("LAN_EUSER_ADMIN_646", "Top members settings");
define("LAN_EUSER_ADMIN_647", "Availability Top Lists");
define("LAN_EUSER_ADMIN_648H", "Default value: 1");
define("LAN_EUSER_ADMIN_649", "Tag-up charts showing the number of members");
define("LAN_EUSER_ADMIN_649H", "Eg. Top 40 to enter 40. The value can be up to 200");
define("LAN_EUSER_ADMIN_650", "Select top lists");
define("LAN_EUSER_ADMIN_651", "Most active members");
define("LAN_EUSER_ADMIN_652", "Most message forums");
define("LAN_EUSER_ADMIN_653", "Most commented");
define("LAN_EUSER_ADMIN_654", "Most chatbox message");
define("LAN_EUSER_ADMIN_655", "Top Rated Members");
define("LAN_EUSER_ADMIN_656", "Most viewed profiles");
define("LAN_EUSER_ADMIN_657", "Most Friend");
define("LAN_EUSER_ADMIN_658", "Display administrators in the top of lists");

define("LAN_EUSER_ADMIN_659", "AIM");    // Endereço AIM
define("LAN_EUSER_ADMIN_660", "ICQ");    // Número ICQ
define("LAN_EUSER_ADMIN_661", "MSN");    // Endereço MSN
define("LAN_EUSER_ADMIN_662", "Yahoo");    // Endereço Yahoo

// Há aqui muitas LANS que estão no core... Troca-se? não...

// Passar para o config do menu PM
// Código do admin   . Tenho de ir á pesca da função   Create_sound_dropdown
/*
<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A64.'</td>
<td class="forumheader3" colspan="3">'.Create_sound_dropdown('onlineinfo_sound',$onlineinfo_sound).'<br />'.ONLINEINFO_LOGIN_MENU_A65.'</td>
</tr>

<tr>
<td class="forumheader3">'.ONLINEINFO_LOGIN_MENU_A126.'</td>
<td class="forumheader3" colspan="3">'.Create_yes_no_dropdown('onlineinfo_showpmmsg',$onlineinfo_showpmmsg).'</td>
</tr>
*/
define("EUSER_LOGIN_MENU_A64", "PM Sound to Play:");
define("EUSER_LOGIN_MENU_A65", "This will play a sound when you have a Private message.<br /><i>You can add extra sounds (wav or mp3 formats) by placing them in the Sounds folder to show up in the list</i>");
define("EUSER_LOGIN_MENU_A126", "Show Large PM Message: ");  


// Defines originais do OIM...
define("ONLINEINFO_IPB_A1", "Invision Power Board");
define("ONLINEINFO_IPB_A2", "This sets the link up to IPB so that users can be seen on who&acute;s online");
define("ONLINEINFO_IPB_A3", "Use Invision Power Board: ");
define("ONLINEINFO_IPB_A4", "IPB Time Online: ");
define("ONLINEINFO_IPB_A5", "This sets the time limit that a user is classed as being online.");
define("ONLINEINFO_IPB_A6", "default: ");
define("ONLINEINFO_IPB_A7", "Minute");
define("ONLINEINFO_IPB_A8", "IPB table prefix: ");
define("ONLINEINFO_IPB_A9", "IPB Location: ");
define("ONLINEINFO_IPB_A10", "How many Records to show from the IPB Forum: ");
define("ONLINEINFO_IPB_A11", "Use IPB Private Messenging: ");
define("ONLINEINFO_IPB_A12", "You need to have Purchased, Downloaded from <a href='http://www.invisionpower.com'>Invision Power Board Site</a> and install it.");
define("ONLINEINFO_IPB_A13", "Auto Hide IPB Forum: ");

define("ONLINEINFO_LOGIN_dropdown_A1", "Yes");
define("ONLINEINFO_LOGIN_dropdown_A2", "No");

// Não usados no config, passou a ser definido via template...
//define("EUSER_LOGIN_MENU_A3", "Caption: ");
//define("EUSER_LOGIN_MENU_A4", "default: Online Info");
//define("EUSER_LOGIN_MENU_A5", "Put ");
//define("EUSER_LOGIN_MENU_A6", " for user welcome message");

//define("EUSER_LOGIN_MENU_A7", "Online Info Width: ");
//define("EUSER_LOGIN_MENU_A8", "default: 95%");
//define("EUSER_LOGIN_MENU_A9", "can be set to px or %");


define("EUSER_LOGIN_MENU_A10", "Show PM plugin: ");
define("EUSER_LOGIN_MENU_A11", "Show who is online: ");


define("EUSER_LOGIN_MENU_A19", "Extra Information");
define("EUSER_LOGIN_MENU_A20", "Auto Hide All: ");
define("EUSER_LOGIN_MENU_A21", "Auto Hide");
define("EUSER_LOGIN_MENU_A22", "Auto Hide: ");

define("EUSER_LOGIN_MENU_A30", "User Class");
define("EUSER_LOGIN_MENU_A31", "Extra Info");
define("EUSER_LOGIN_MENU_A32", "No. Records to Show");
define("EUSER_LOGIN_MENU_A33", "Activate Cache");
define("EUSER_LOGIN_MENU_A34", "Cache Time<br />(Minutes)");

define("EUSER_LOGIN_MENU_A36", "Sections");


define("EUSER_LOGIN_MENU_A39", "Set Birthday Dates to<br />dd/mm Format: ");
define("EUSER_LOGIN_MENU_A40", "Administrator Colour");
define("EUSER_LOGIN_MENU_A41", "Forum Moderator Colour");
define("EUSER_LOGIN_MENU_A42", "Members Colour");

define("EUSER_LOGIN_MENU_A44", "Order");
define("EUSER_LOGIN_MENU_A45", "Avatar");
define("EUSER_LOGIN_MENU_A46", "Private Message");
define("EUSER_LOGIN_MENU_A47", "Who is Online");
define("EUSER_LOGIN_MENU_A48", "Extra Info");
define("EUSER_LOGIN_MENU_A49", "Order of Extra Information");
define("EUSER_LOGIN_MENU_A50", "Latest Changes");
define("EUSER_LOGIN_MENU_A51", "Top Forum Posts");
define("EUSER_LOGIN_MENU_A52", "Top Visitors");
define("EUSER_LOGIN_MENU_A53", "Birthdays");
define("EUSER_LOGIN_MENU_A54", "Last Visitors");
define("EUSER_LOGIN_MENU_A55", "Hit Counter");
//////////define("EUSER_LOGIN_MENU_A56", "Update Menu Settings");

define("EUSER_LOGIN_MENU_A60", "Check List");
define("EUSER_LOGIN_MENU_A61", "--- Do Not Play any Sounds ---");
define("EUSER_LOGIN_MENU_A62", "Top Forum Starters");

define("EUSER_LOGIN_MENU_A66", "Top Forum Repliers");

define("EUSER_LOGIN_MENU_A69", "Show Buddies: ");
define("EUSER_LOGIN_MENU_A70", "Buddies");
define("EUSER_LOGIN_MENU_A71", "General");
define("EUSER_LOGIN_MENU_A72", "Who&acute;s Online");
define("EUSER_LOGIN_MENU_A73", "Extra Info");
define("EUSER_LOGIN_MENU_A74", "Order of Sections");
define("EUSER_LOGIN_MENU_A75", "Order of Extra Info");
define("EUSER_LOGIN_MENU_A76", "Latest Changes");
define("EUSER_LOGIN_MENU_A77", "Online Info Settings");
define("EUSER_LOGIN_MENU_A78", " Installed");
define("EUSER_LOGIN_MENU_A79", " Not Installed");
define("EUSER_LOGIN_MENU_A80", " Enabled");
define("EUSER_LOGIN_MENU_A81", " Not Enabled");
define("EUSER_LOGIN_MENU_A82", "Coppermine (plugin)");
define("EUSER_LOGIN_MENU_A83", "Guestbook");
define("EUSER_LOGIN_MENU_A84", "Private Messager");
define("EUSER_LOGIN_MENU_A85", "Statistic Logging");
define("EUSER_LOGIN_MENU_A86", "Forum");
define("EUSER_LOGIN_MENU_A87", "User Tracking");
define("EUSER_LOGIN_MENU_A88", "User Rating");

define("EUSER_LOGIN_MENU_A90", "Chatbox: ");
define("EUSER_LOGIN_MENU_A91", "Forum: ");
define("EUSER_LOGIN_MENU_A92", "Downloads: ");
define("EUSER_LOGIN_MENU_A93", "Guestbook: ");
define("EUSER_LOGIN_MENU_A94", "Coppermine Images: ");

define("EUSER_LOGIN_MENU_A97", "Links: ");
define("EUSER_LOGIN_MENU_A98", "Users: ");
define("EUSER_LOGIN_MENU_A99", "News: ");
define("EUSER_LOGIN_MENU_A100", "Contents: ");
//define("EUSER_LOGIN_MENU_A101", "User Colours");

define("EUSER_LOGIN_MENU_A103", " part Disabled");
define("EUSER_LOGIN_MENU_A104", "Turn User and Class Colours On");
define("EUSER_LOGIN_MENU_A105", "Top Rated Member");
define("EUSER_LOGIN_MENU_A106", "List");

define("EUSER_LOGIN_MENU_A110", "Flash Chat");
define("EUSER_LOGIN_MENU_A111", " table prefix: ");
define("EUSER_LOGIN_MENU_A112", " Location: ");
define("EUSER_LOGIN_MENU_A113", "Use ");
define("EUSER_LOGIN_MENU_A114", "Open up ");
define("EUSER_LOGIN_MENU_A115", "Inside e107");
define("EUSER_LOGIN_MENU_A116", "New Window");
define("EUSER_LOGIN_MENU_A117", "Show Flash Chat: ");
define("EUSER_LOGIN_MENU_A118", "You need to have Purchased ($5), Downloaded from <a href='http://www.tufat.com/s_flash_chat_chatroom.htm'>Flash Chat Site</a> and install it. making sure you used the e107 Integration option.");


define("EUSER_LOGIN_MENU_A124", "Auto Hide PM: ");
define("EUSER_LOGIN_MENU_A125", "Auto Hide Avatar: ");
define("EUSER_LOGIN_MENU_A127", "Suspended Accounts");
define("EUSER_LOGIN_MENU_A129", "Select a Account to Suspend: ");
define("EUSER_LOGIN_MENU_A130", "Suspend");
define("EUSER_LOGIN_MENU_A131", "No Accounts Suspended");
define("EUSER_LOGIN_MENU_A132", "Account already Suspended");
define("EUSER_LOGIN_MENU_A133", "Account Suspended");
define("EUSER_LOGIN_MENU_A134", "ID");
define("EUSER_LOGIN_MENU_A135", "Name");
define("EUSER_LOGIN_MENU_A136", "Remove");
define("EUSER_LOGIN_MENU_A137", "Last IP Address");
define("EUSER_LOGIN_MENU_A138", "Are you sure you want to delete this user out of the Suspended Accounts?");
define("EUSER_LOGIN_MENU_A139", " has been removed from Suspended Accounts");
define("EUSER_LOGIN_MENU_A140", "Auto Hide all Currently online");

// Definido via CSS do template...
//define("EUSER_LOGIN_MENU_A142", "Section headings Font size: ");
//define("EUSER_LOGIN_MENU_A143", "px");

define("EUSER_LOGIN_MENU_A145", "Gallery 2");
define("EUSER_LOGIN_MENU_A146", "You need to have downloaded from Gallery 2 from <a href='http://gallery.menalto.com/'>Gallery Site</a> and install it to the same database as e107.");
define("EUSER_LOGIN_MENU_A147", "Gallery 2");
define("EUSER_LOGIN_MENU_A148", "How many Records to show from Gallery 2: ");
define("EUSER_LOGIN_MENU_A149", "Addons (Outside e107)");
define("EUSER_LOGIN_MENU_A150", "Delete Me");
define("EUSER_LOGIN_MENU_A151", "You Tube");

define("EUSER_LOGIN_MENU_A154", "You Tube:");

define("EUSER_LOGIN_MENU_A163", "Show Users Avatar on Birthday: ");
define("EUSER_LOGIN_MENU_A164", "Krooze Arcade:");

define("EUSER_LOGIN_MENU_A167", "KA Top Scores:");
define("EUSER_LOGIN_MENU_A168", "Link Page");


define("EUSER_LOGIN_MENU_A172", "You need to have downloaded from SMF from <a href='http://www.simplemachines.org/'>SMF Site</a> and install it to the same database as e107.");

define("EUSER_LOGIN_MENU_A174", "Bugtracker3: ");
define("EUSER_LOGIN_MENU_A175", "Bugtracker3");


define("EUSER_LOGIN_MENU_A179", "Head Administrator Colour");
define("EUSER_LOGIN_MENU_A180", "Chatbox");
define("EUSER_LOGIN_MENU_A181", "Chatbox II");

define("EUSER_LOGIN_MENU_A183", "--- Check for Updates ---");
define("EUSER_LOGIN_MENU_A184", "Coppermine Photo Gallery");
define("EUSER_LOGIN_MENU_A185", "You need to have downloaded from Coppermine Photo Gallery from <a href='http://coppermine-gallery.net/'>Coppermine-Gallery Site</a> and install it to the same database as e107.");
define("EUSER_LOGIN_MENU_A186", "How many Records to show from Coppermine Photo Gallery: ");
define("EUSER_LOGIN_MENU_A187", "Use User Class Colours (Head Admin, Admin & Moderators overrule these)");
define("EUSER_LOGIN_MENU_A188", "User Class (Description)");
define("EUSER_LOGIN_MENU_A189", "Colour");
define("EUSER_LOGIN_MENU_A190", "Active");
define("EUSER_LOGIN_MENU_A191", "Priority");
define("EUSER_LOGIN_MENU_A192", "Select the Colour of the User classes you wish to use and set Active to YES.<br />Make sure that you set a Priority to the Active ones, this will set the lower number (0 onwards) to be the class to show for the user if they have more than one of the classes selected.<br /> The Class description will be shown on the plugin Key so make sure you have set the Description to how you would like it shown.");
define("EUSER_LOGIN_MENU_A193", "Jokes");

define("EUSER_LOGIN_MENU_A195", "Blogs (UserJournals)");

define("EUSER_LOGIN_MENU_A197", "Suggestions");




define("ONLINEINFO_CACHEINFO_1", "Latest Changes");
define("ONLINEINFO_CACHEINFO_2", "Top Visitors");
define("ONLINEINFO_CACHEINFO_3", "Last Vistors");
define("ONLINEINFO_CACHEINFO_4", "Birthdays");
define("ONLINEINFO_CACHEINFO_5", "Top Forum Posters");
define("ONLINEINFO_CACHEINFO_6", "Top Forum Starters");
define("ONLINEINFO_CACHEINFO_7", "Top Forum Repliers");
define("ONLINEINFO_CACHEINFO_8", "Top Rated Members");
define("ONLINEINFO_CACHEINFO_9", "Hit Counter");
define("ONLINEINFO_CACHEINFO_10", "Avatar");
define("ONLINEINFO_CACHEINFO_11", "Flash Chat");
define("ONLINEINFO_CACHEINFO_12", "Private Messages");
define("ONLINEINFO_CACHEINFO_13", "Buddies");
define("ONLINEINFO_CACHEINFO_14", "Who is Online");
define("ONLINEINFO_CACHEINFO_15", "Extra Info");
define("ONLINEINFO_CACHEINFO_16", "Members Visited Today");

define("ONLINEINFO_HELP_1", "Version");
define("ONLINEINFO_HELP_2", "Please make sure that on upgrading or New installs that you have saved each page in this admin section as there have been loads of preference changes.");
define("ONLINEINFO_HELP_3", "Support");
define("ONLINEINFO_HELP_4", "For Support, please post on my forum: ");
define("ONLINEINFO_HELP_5", "If your site feels slow, try using the Cache system and turning off IP checker, Bot checker, also large avatars can slow it down, try turning off Avatars on Who's Online.");
define("ONLINEINFO_HELP_6", "New to ");
define("ONLINEINFO_HELP_7", "'Krooze Arcade' Plugin Intergration (New Games and Top Score).");
define("ONLINEINFO_HELP_8", "New to ");
define("ONLINEINFO_HELP_9", "'You Tube' Plugin Intergration.");
define("ONLINEINFO_HELP_10", "'Delete Me' Plugin Intergration.");
define("ONLINEINFO_HELP_11", "PM New Message Sound.");
define("ONLINEINFO_HELP_12", "'Members on today' section.");
define("ONLINEINFO_HELP_13", "Check List Moved to this Help Menu.");
define("ONLINEINFO_HELP_14", "OnlineInfo Help & information");
define("ONLINEINFO_HELP_15", "'Whats New' posts / info now can be Marked as read.");
define("ONLINEINFO_HELP_16", " or post on the Bug Tracker: ");
define("ONLINEINFO_HELP_17", "'Delete Me' Plugin by <a href='http://www.keal.me.uk' title='www.keal.me.uk'>Father Barry</a>");
define("ONLINEINFO_HELP_18", "Intergraded Plugins Info");
define("ONLINEINFO_HELP_19", "'Private Messager' Plugin by <a href='http://www.e107.org' title='www.e107.org'>McFly</a>");
define("ONLINEINFO_HELP_20", "'You Tube' Plugin by <a href='http://www.erichradstake.nl' title='www.erichradstake.nl'>Erich Radstake</a>");
define("ONLINEINFO_HELP_21", "'Coppermine' Plugin by <a href='http://www.e107coders.org/download.php?view.1296' title='www.e107coders.org'>McFly</a>");
define("ONLINEINFO_HELP_22", "'List' Plugin by <a href='http://eindhovenseschool.net' title='eindhovenseschool.net'>Eric Vanderfeesten (lisa)</a>");
define("ONLINEINFO_HELP_23", "'Statistic Logging' Plugin by <a href='http://www.e107.org' title='www.e107.org'>jalist</a>");
define("ONLINEINFO_HELP_24", "'Forum' Plugin by <a href='http://www.e107.org' title='www.e107.org'>e107dev</a>");
define("ONLINEINFO_HELP_25", "'Links Page' Plugin by <a href='http://www.e107.org' title='www.e107.org'>e107dev</a>");
define("ONLINEINFO_HELP_26", "'Content Management' Plugin by <a href='http://eindhovenseschool.net' title='eindhovenseschool.net'>Eric Vanderfeesten (lisa)</a>");
define("ONLINEINFO_HELP_27", "'Chatbox' Plugin by <a href='http://www.e107.org' title='www.e107.org'>e107</a>");
define("ONLINEINFO_HELP_28", "'Guestbook' Plugin by <a href='http://www.greycube.com' title='www.greycube.com'>Chavo & Rich</a>");
define("ONLINEINFO_HELP_29", "Supplied with e107");
define("ONLINEINFO_HELP_30", "Forum Posts in what's New can be set to show every post or to Summarize them by Thread.");
define("ONLINEINFO_HELP_31", "'Krooze Arcade' Plugin by <a href='http://boreded.co.uk' title='http://boreded.co.uk'>Paul Blundell</a>");
define("ONLINEINFO_HELP_32", "Key Colours for Admin, moderator, member now has a colour picker.");
define("ONLINEINFO_HELP_33", "'Flash if new' now uses a colour selector.");
define("ONLINEINFO_HELP_34", "'Login Dialog Box' can now be turned off for Themes that have it built in.");
define("ONLINEINFO_HELP_35", "'Pop up user info' now has a colour picker.");
define("ONLINEINFO_HELP_36", "More 'Latest Changes' can be turned off (News, Chatbox, etc.)");
define("ONLINEINFO_HELP_37", "This has been tested with IE7, Firefox 2 & 3 beta, Netscape Navigator, Opera, Safari.");
define("ONLINEINFO_HELP_38", "Notes");
define("ONLINEINFO_HELP_39", "Tested on php 4.4.8 and 5.2.5, MySQL 4.1.22-standard.");
define("ONLINEINFO_HELP_40", "Older versions of MySQL (less than 4.0) may not install the tables into the database, if this happens manually add them by getting there structures out of the plugin.php file");
define("ONLINEINFO_HELP_41", "The Cached data may not show to start with until the cached time has passed, set cache to 0 then go out of admin for it to catch the data and then reset the time of the cached info");
define("ONLINEINFO_HELP_42", "Todays Birthdays have Avatar on/off option");
define("ONLINEINFO_HELP_43", "Gallery 2 Comments now added to 'what's new' comments");
define("ONLINEINFO_HELP_44", "Simple Machine Forum Intergrated");
define("ONLINEINFO_HELP_45", "'Bugtracker3' Plugin by <a href='http://www.bugrain.plus.com' title='http://www.bugrain.plus.com'>bugrain</a>");
define("ONLINEINFO_HELP_46", "'Bugtracker3' Intergration");
define("ONLINEINFO_HELP_47", "What's New List on Menu can now hide if the item has no new posts.");

define("ONLINEINFO_HELP_48", "FIXED - Lastest changes always showing zero when hidden.");
define("ONLINEINFO_HELP_49", "FIXED - Error in sql code in plugin.php which stopped new installs.");
define("ONLINEINFO_HELP_50", "ADDED - German Language files.");
define("ONLINEINFO_HELP_51", "FIXED - Reported issue with some old plugin confliction with reading system preferences.");
define("ONLINEINFO_HELP_52", "FIXED - Flash chat showing users in rooms issue");
define("ONLINEINFO_HELP_53", "FIXED - Possible issue in the admin section found by Nowwhat@ my forum");
define("ONLINEINFO_HELP_54", "ADDED - Head Admin shows separate to normal admins on 'Members on today' and summary 'currently online' wanted by His MAJESTY @ my fourm.");
define("ONLINEINFO_HELP_55", "Extra Bots added");
define("ONLINEINFO_HELP_56", "'Chatbox II' Plugin by <a href='http://www.vitalogix.com' title='http://www.vitalogix.com'>Vitalogix</a>");
define("ONLINEINFO_HELP_57", "ADDED - 'Chatbox II' Intergration.");
define("ONLINEINFO_HELP_58", "ADDED - Updates checker (new Version numbering.)");
define("ONLINEINFO_HELP_59", "ADDED - 'Coppermine Photo Gallery' Intergration.");
define("ONLINEINFO_HELP_60", "Previous Updates");
define("ONLINEINFO_HELP_61", "ADDED - User Class colours.");
define("ONLINEINFO_HELP_62", "CHANGED - Moved all Fuctions to own php file to shorten coding.");
define("ONLINEINFO_HELP_63", "FIXED - Remove Table render around Admin Section.");
define("ONLINEINFO_HELP_64", "FIXED - PM heading now same class as others when not set to hide.");
define("ONLINEINFO_HELP_65", "FIXED - Some small bugs in code.");
define("ONLINEINFO_HELP_66", "ADDED - 'Jokes Menu' Intergration.");
define("ONLINEINFO_HELP_67", "'Jokes Menu' Plugin by <a href='http://www.keal.me.uk' title='www.keal.me.uk'>Father Barry</a>");
define("ONLINEINFO_HELP_68", "ADDED - 'UserJournals' Intergration.");
define("ONLINEINFO_HELP_69", "'UserJournals' Plugin by <a href='http://http://www.bugrain.plus.com' title='http://www.bugrain.plus.com'>Del Rudolph, SKiTZ716, bkwon, bugrain</a>");
define("ONLINEINFO_HELP_70", "ADDED - 'Suggestions Menu' Intergration.");
define("ONLINEINFO_HELP_71", "'Suggestions Menu' Plugin by <a href='http://www.keal.me.uk' title='www.keal.me.uk'>Father Barry</a>");
define("ONLINEINFO_HELP_72", "ADDED - Comments on whats new can be turned on/off.");
define("ONLINEINFO_HELP_73", "CHANGED - Admin's & User Class colours now used on the whole Plugin.");
define("ONLINEINFO_HELP_74", "ADDED - Users Avatar can now be turned off just to show settings menu.");
define("ONLINEINFO_HELP_75", "ADDED - Default user classes (Head admin, Admin, etc) can now be turned on or off.");
define("ONLINEINFO_HELP_76", "FIXED - Missing Comments for krooze Arcade on New page. (on 8.5.1)");
define("ONLINEINFO_HELP_77", "FIXED - Missing Comments for Agenda Plugin on New page. (on 8.5.2)");


define("ONLINEINFO_SMF_1", "Simple Machines Forum");
define("ONLINEINFO_SMF_2", "How many Records to show from SMF: ");





/*
+---------------------------------------------------------------+
| Another Profiles Plugin v0.9.8
| Copyright Copyright 2008 Istvan Csonka
| http://freedigital.hu
| support@freedigital.hu
|
|        For the e107 website system
|        Copyright Steve Dunstan
|        http://e107.org
|        jalist@e107.org
|
| (The original program is Alternate Profiles v2.0
| boreded.co.uk)
|
| Another Profiles Plugin comes with
| ABSOLUTELY NO WARRANTY
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
// ANOTHER-PROFILES-ADMIN-MENU
define("ADMIN_PROFILE_01", "<a href='http://freedigital.hu'>Another Profiles Plugin</a>");
define("ADMIN_PROFILE_1", "<b>e107 Another profiles plugin 0.9 version</b>");
define("ADMIN_PROFILE_1a", "Install:");
define("ADMIN_PROFILE_1b", "Before installing, make a database save! After extracting the euser_v0.9.x.tar.gz -file copy the euser directory tho the e107 plugins directory. The webserver needs writing authority for the A userimages and usermp3 directories, so please check the attributes of these directories. The plugin can be installed from the plugin-manager. Check every settings after installing!");
define("ADMIN_PROFILE_1c", "Update:");
define("ADMIN_PROFILE_1d", "Save the database and the existing euser   before refreshing ! After extending euser_v0.9.x.tar.gz copy the euser directory to the e107 plugins directory. You overwite the previous version with copying. The webserver needs writing authority for the A userimages and usermp3 directories, so please check the attributes of these directories. Don't forget to click on the Another Profiles refresh icon. Check every settings after refreshing.");
define("ADMIN_PROFILE_1e", "Server check:");
define("ADMIN_PROFILE_1f", "In order to function properly, there are some requiremnets to fulfil from the server page. Right now, the plugin is 100% compatible with the e107 v0.7.11 - v1.0.2 versions. Because it makes picture resizing while working, the GD directory must exist( with proper php settings). It is even better if you have the possibility to use the PHP Imagick module. THe <a href='admin_menu.php?phpinfo'> server information </a> help you with the proper server settings, or with finding the possible errors.");
define("ADMIN_PROFILE_1g", "Warranty:");
define("ADMIN_PROFILE_1h", "I cannot garantee anything in connections with the program.");
define("ADMIN_PROFILE_1i", "License:");
define("ADMIN_PROFILE_1j", "Another Profiles Plugin License: GNU General Public License <a href='http://www.gnu.org/licenses/gpl.html' rel='external'>http://www.gnu.org/licenses/gpl.html</a><br/>MP3 Player Maxi License: MPL 1.1 <a href='http://www.mozilla.org/MPL/' rel='external'>http://www.mozilla.org/MPL/</a><br/>ClearBox License:to be able to use it you must accept the conditions in the file <a href='clearbox/clearbox.txt'>clearbox.txt</a>");
define("ADMIN_PROFILE_1k", "Version Information:");
define("ADMIN_PROFILE_1l", "The changes in the <a href='./readme.txt'>readme.txt</a> file can read.");
define("ADMIN_PROFILE_1m", "Download:");
//define("ADMIN_PROFILE_2", "Number of comments per page.");
//define("ADMIN_PROFILE_7", "Who can view members profiles:");
define("ADMIN_PROFILE_8", "You must first be logged in to view details of members!");
//define("ADMIN_PROFILE_9b", "Images per album max. (pcs.) <i> Every member is limited to this number of pictures per album.</i>");
//define("ADMIN_PROFILE_9c", "Column of User images and albums<i> Default 3.</i>");
//define("ADMIN_PROFILE_9a", "Number of albums max. (pcs.) <i> Every member is limited to this number of picture-albums.</i>");
//define("ADMIN_PROFILE_9", "Photo Gallery quota/member (KB) <i> Every member is limited to this much of kB. with pictures.</i>");
define("ADMIN_PROFILE_10", "ERROR");
define("ADMIN_PROFILE_11", "You have no permission to enter the admin area!");
define("ADMIN_PROFILE_13", "No comments yet.");
define("ADMIN_PROFILE_15", "Admin Profile editor");
define("ADMIN_PROFILE_16", "<b>Another Profile Plugin general settings</b>");
//define("ADMIN_PROFILE_18", "Avatar size (Width x Height) the members, profile and settings page. <br/><i> Leave blank for basic settings ( given in the e107 members settings) size. For keeping the scale you need to keep only the width.</i>");
//define("ADMIN_PROFILE_19", "Profile picture size (Width x Height) <br/><i> The size of the picture in the user profile. For keeping the scale you need to keep only the width. If you do not give data, the basic settings is 200px.</i>");
define("ADMIN_PROFILE_20", "Personal profile background (It does not work in all themes)");
//define("ADMIN_PROFILE_21", "Maximum upload picture size (KB)");
//define("ADMIN_PROFILE_21a", "Currently, the server php.ini setting that can be up ");
//define("ADMIN_PROFILE_21b", "B, maximum ");
//define("ADMIN_PROFILE_21c", "MP resolution pictures can be uploaded.");
//define("ADMIN_PROFILE_22", "Maximum number of videos per member. (0 = There is no limit)");
define("ADMIN_PROFILE_24", "<b>Another Profile modules settings</b>");
//define("ADMIN_PROFILE_25", "Friends system");
//define("ADMIN_PROFILE_26", "Profile comments");
//define("ADMIN_PROFILE_27", "Image galleries");
//define("ADMIN_PROFILE_28", "Video galleries");
//define("ADMIN_PROFILE_39", "Profile Statistics (All reviewers)");
//define("ADMIN_PROFILE_40", "Clickable links for use with images?<br/>(Some of the topics better suited)");
//define("ADMIN_PROFILE_42", "The new users to logon to the following shifting their profile set?");
//define("ADMIN_PROFILE_43", "Profile background music. If enabled the upload, do not forget to file type of authorization (filetypes.php - .mp3)");
//define("ADMIN_PROFILE_44", "Profile background music max. size (KB)<br>");
//define("ADMIN_PROFILE_44a", "B size of file can be uploaded!");
//define("ADMIN_PROFILE_45", "Profile background music");
define("ADMIN_PROFILE_48", "YES");
define("ADMIN_PROFILE_48a", "ON");
define("ADMIN_PROFILE_49", "NO");
define("ADMIN_PROFILE_49a", "OFF");
define("ADMIN_PROFILE_50", "<b>Main Features</b>");
//define("ADMIN_PROFILE_51", "Uploaded images Max. display width in pixels<br><i>If a larger picture, then clicked the new window opens, or if enabled, then the Lightbox, LightWindow, LightView or ClearBox Displays.</i>");
//define("ADMIN_PROFILE_52", "Allow Lightbox<br><i>Lightbox plugin install needed for the use</i>");
//define("ADMIN_PROFILE_53", "Allow LightWindow<br><i>LightWindow plugin install needed for the use</i>");
//define("ADMIN_PROFILE_53a", "Allow LightView<br><i>Corllete Lab Lightview Widget plugin install needed for the use</i>");
//define("ADMIN_PROFILE_53b", "Allow ClearBox<br><i>Clearbox included. To be able to use it you must accept the conditions in the file <a href='clearbox/clearbox.txt'>clearbox.txt</a></i>");
//define("ADMIN_PROFILE_54", "That column to display the list of friends<i> (max.8)</i>");
//define("ADMIN_PROFILE_55", "The list of members to be displayed by the Another Profile plugin.<br><i> If not, there is no change in the list of memebers (Site main menu- Members) display.</i>");
define("ADMIN_PROFILE_56", "Options Update");
define("ADMIN_PROFILE_57", "Information");
define("ADMIN_PROFILE_58", "Options");
define("ADMIN_PROFILE_59", "My Page");
define("ADMIN_PROFILE_60", "The latest version can be downloaded for <a href='http://freedigital.hu'>freedigital.hu</a>.");
//define("ADMIN_PROFILE_61", "Maximum number of profile comments .<i> the maximum number of profile comments per member.</i>");
//define("ADMIN_PROFILE_62", "Image comments max.<i> the maximum number of posts per picture.</i>");
//define("ADMIN_PROFILE_63", "Video comments max.<i> the maximum number of posts per video.</i>");
//define("ADMIN_PROFILE_64", "Image and album names contain accented characters. <i>Not every server supports accented file names!</i>");

//define("ADMIN_PROFILE_65", "The members \"settings\" and \"proflie\" pages to be used by Another Profiles Plugin.<br><i> If not, then the plugin can be used only with direct links and the installment of the plugin will have no effect on the working of the site.</i>");

define("ADMIN_PROFILE_66", "Main Features");
define("ADMIN_PROFILE_67", "<b>Comments</b>");
//define("ADMIN_PROFILE_68", "<b>Pictures and albums</b>");
//define("ADMIN_PROFILE_69", "<b>Show Pictures</b>");
define("ADMIN_PROFILE_70", "<b>Profile Music</b>");
define("ADMIN_PROFILE_71", "<b>Videos</b>");
define("ADMIN_PROFILE_71a", "<b>Friends</b>");
//define("ADMIN_PROFILE_71b", "<b>Registration and registration cancellation</b>");
define("ADMIN_PROFILE_72", "<b>More</b>");
//define("ADMIN_PROFILE_73", "<b>Only use an external link</b>");
//define("ADMIN_PROFILE_74", "<b>Allow only file added</b>");
//define("ADMIN_PROFILE_75", "<b>Both are permissible</b>");
//define("ADMIN_PROFILE_76", "The length field in the user table user_image <br><i>The default value 100, max. value 200.</i>");
//define("ADMIN_PROFILE_77", "Can the members cancel their registration?<br><i>When you cancel registration the member's Another Profiles picture, video, profile comments, friend lists, pictures, soundfiles will be deleted, and the member will be deleted from the user database of the page as well. The main Admin will be informed in an e-mail and private message.</i> ");
//define("ADMIN_PROFILE_78", "Should deleted members have a save of their pictures, music?<br><i>If yes, then a save is done from the albums, pictures and mp3.</i>");
//define("ADMIN_PROFILE_79", "New members receive a private message by default, if designated for a friend?");
//define("ADMIN_PROFILE_79a", "New members receive e-mail by default, if marked for a friend?");
//define("ADMIN_PROFILE_80", "WARN System Support<br><i>you can read more about the WARN system settings here: http://e107hungary.org</i>");
//define("ADMIN_PROFILE_81", "Imagick PHP support enabled<br><i>If the server supports the use of imagick, then use Imagick instead of GD for resizing</i>");
//define("ADMIN_PROFILE_82", "To give extra information in the members' list about the member's comments, pictures, videos, music.<br><i> If enabled, little pictures showing if the member has forum message, forum comment, or comments about his uploaded pictures, videos or profile.</i> ");
//define("ADMIN_PROFILE_83", "This setting should apply to every members despite personal settings.");
//define("ADMIN_PROFILE_84", "Comments follow - The last profile, image and video posts list. <i>Set the maximum number of posts to list here.</i>");
//define("ADMIN_PROFILE_85", "Comment tracking");
define("ADMIN_PROFILE_86", "Only Admins");
define("ADMIN_PROFILE_87", "Members Only");
define("ADMIN_PROFILE_88", "All visitors");
define("ADMIN_PROFILE_89", "Delete User");
define("ADMIN_PROFILE_90", "The following user selected for deletion");
define("ADMIN_PROFILE_91", "Remove user name:");
define("ADMIN_PROFILE_92", "Remove user code:");
define("ADMIN_PROFILE_93", "Confirmation");
define("ADMIN_PROFILE_94", "When user is deleted by a member of the Another Profiles Database (friends, friends indicated, profiles, images, video comments), the user data will be deleted e107 user database. Afer that the Another Profiles will be deleted according to personal settings or save his music and pictures.");
define("ADMIN_PROFILE_95", "Final deletion of member");
define("ADMIN_PROFILE_96", "The following members:");
define("ADMIN_PROFILE_97", "Deleted.");
define("ADMIN_PROFILE_98", "This member has not been deleted.");
define("ADMIN_PROFILE_99", "Back to the members settings");
//define("ADMIN_PROFILE_100", "The maximum width of pictures and videos at the following of comments.");
//define("ADMIN_PROFILE_101", "<b>Following of profile, video and picture comments<b>");
//define("ADMIN_PROFILE_102", "Megapixel resolution can be if you are using GD (the php memory_limit ");
//define("ADMIN_PROFILE_103", "). If you want to enable bigger resolutions file than this, then you have to enlarge php memory limit on the server or use imagick.");
define("ADMIN_PROFILE_104", "Server information");
define("ADMIN_PROFILE_104a", "PHP information");
define("ADMIN_PROFILE_105", "PHP module, directive");
define("ADMIN_PROFILE_106", "Value");
define("ADMIN_PROFILE_107", "Compliance");
define("ADMIN_PROFILE_108", "memory_limit:");
define("ADMIN_PROFILE_109", "post_max_size:");
define("ADMIN_PROFILE_110", "upload_max_filesize:");
define("ADMIN_PROFILE_111a", "The value is correct. GD resize images with maximum resolution ");
define("ADMIN_PROFILE_111b", "The value is still appropriate, however, you need to be prepared that in some cases problems may occur when you resize the image. GD resize the image with maximum resolution ");
define("ADMIN_PROFILE_111c", "The value is not something good. A lot of trouble to resize the images because they often may have higher-resolution photos. GD resize the image with maximum resolution ");
define("ADMIN_PROFILE_111d", "The value is not appropriate. GD resize the image with maximum resolution ");
define("ADMIN_PROFILE_111e", "Mpixel.");
define("ADMIN_PROFILE_111f", "Mpixel. You might use the Imagick module instead of GD, if the server supports.");
define("ADMIN_PROFILE_111g", "Mpixel. I suggest you use the Imagick module instead of GD, if your server supports, or increase the value of PHP memory_limit to 64MB!");
define("ADMIN_PROFILE_111h", "Mpixel. I suggest you use the Imagick module instead of GD, if your server supports, or increase the value of PHP memory_limit to 64MB!");
define("ADMIN_PROFILE_112a", "The corresponding value.");
define("ADMIN_PROFILE_112b", "The value is still appropriate. Post in a likely will not receive more than this, perhaps one may have trouble uploading mp3 music.");
define("ADMIN_PROFILE_112c", "The value is not something good. Worth increased by 15 to 20MB. Mainly be a problem uploading the mp3 files.");
define("ADMIN_PROFILE_112d", "Unfortunately, this is not enough. The problems will be uploading files.");
define("ADMIN_PROFILE_113a", "The value is correct.");
define("ADMIN_PROFILE_113b", "The value is still appropriate. Probably not upload files larger one, perhaps one may have trouble uploading mp3 music.");
define("ADMIN_PROFILE_113c", "The value is not something good. Worth increased by 15 to 20MB. Mainly be a problem uploading the mp3 files.");
define("ADMIN_PROFILE_113d", "Unfortunately, this is not enough. The problems will be uploading files.");
define("ADMIN_PROFILE_114", "GD version:");
define("ADMIN_PROFILE_115", "It does not work.");
define("ADMIN_PROFILE_116", "GD version is correct.");
define("ADMIN_PROFILE_116a", "GD version is correct, but at least one function is not necessary.");
define("ADMIN_PROFILE_117", "GD version is not appropriate.");
define("ADMIN_PROFILE_117a", "GD version is not appropriate and needed at least one function does not work.");
define("ADMIN_PROFILE_118", "GD is not installed.");
define("ADMIN_PROFILE_119", "Imagick version:");
define("ADMIN_PROFILE_120", "Imagick is not installed.");
define("ADMIN_PROFILE_121", "Imagick can not be used.");
define("ADMIN_PROFILE_122", "Imagick module is installed, usable.");
define("ADMIN_PROFILE_123", "File upload:");
define("ADMIN_PROFILE_124", "Enabled");
define("ADMIN_PROFILE_124a", "The value is correct.");
define("ADMIN_PROFILE_125", "Not allowed");
define("ADMIN_PROFILE_125a", "The server is not enabled for file uploading.");
define("ADMIN_PROFILE_126", "The value is correct.");
define("ADMIN_PROFILE_127", "Upload files should be created in the temporary directory.");
define("ADMIN_PROFILE_127a", "The file has been created to fill a temporary library.");
define("ADMIN_PROFILE_127b", "The value is appropriate because it is not enabled the galleries and the profile background.");
define("ADMIN_PROFILE_128", "Temporary directory for uploading:");
define("ADMIN_PROFILE_129", "Not specified");
define("ADMIN_PROFILE_130", "Enabled");
define("ADMIN_PROFILE_131", "The value is correct.");
define("ADMIN_PROFILE_132", "Not allowed");
define("ADMIN_PROFILE_133", "Uploads to the public should be allowed, that members are able to copy their pictures and music.");
define("ADMIN_PROFILE_133a", "The value is correct, because it did not turn on the background of the profile and galleries.");
define("ADMIN_PROFILE_134", "Public uploads:");
define("ADMIN_PROFILE_135", "E107 Administration Settings");
define("ADMIN_PROFILE_136", "E107 Options");
define("ADMIN_PROFILE_137", "The file is found filetypes.xml");
define("ADMIN_PROFILE_138", "The value is correct.");
define("ADMIN_PROFILE_139", "None of the \"filetypes.xml\" file");
define("ADMIN_PROFILE_140", "E107_admin to be renamed the directory the file filetypes_xml filetypes.xml - from the file types to allow.");
define("ADMIN_PROFILE_141", "Allow file types:");
define("ADMIN_PROFILE_142", "A filetypes.php file found");
define("ADMIN_PROFILE_143", "None of the \"filetypes.php\" file");
define("ADMIN_PROFILE_144", "Rename the directory e107_admin filetypes_php filetypes.php file - from the file types to allow.");
define("ADMIN_PROFILE_144a", "The value is correct, because it did not turn on the background of the profile and galleries.");
define("ADMIN_PROFILE_145", "Allow file types:");
define("ADMIN_PROFILE_146", "Appropriate version of the e107 CMS.");
define("ADMIN_PROFILE_147", "Profiles in Another plugin is not compatible with this version of the e107, whether or not the original file ver.php!");
define("ADMIN_PROFILE_148", "E107 CMS version:");
define("ADMIN_PROFILE_149", "Enabled");
define("ADMIN_PROFILE_150", "The value is correct.");
define("ADMIN_PROFILE_151", "The member is not allowed");
define("ADMIN_PROFILE_152", "HTML codes without the authorization of the movies are not members can set their profiles. Turn off video galleries of the main functions setting, or the HTML codes to enable the members.");
define("ADMIN_PROFILE_152a", "The value is reasonable, since the video galleries are not enabled.");
define("ADMIN_PROFILE_153", "Enable HTML code:");
define("ADMIN_PROFILE_154", "Allowed file types: ");
define("ADMIN_PROFILE_155", "The value is correct.");
define("ADMIN_PROFILE_156", "The required file type (mp3 or jpg) is not enabled.");
define("ADMIN_PROFILE_157", "The value is correct, because it did not turn on the background of the profile or galleries.");
define("ADMIN_PROFILE_158", "The file that contains the file types that can not be read.");
define("ADMIN_PROFILE_159", "The corresponding value");
define("ADMIN_PROFILE_160", "Still available");
define("ADMIN_PROFILE_161", "Not good");
define("ADMIN_PROFILE_162", "Unusable");
//define("ADMIN_PROFILE_163", "Members list sorted by default");
//define("ADMIN_PROFILE_164", "Ascending");
//define("ADMIN_PROFILE_165", "Descending");
//define("ADMIN_PROFILE_166", "Members list of the default sort criteria");
//define("ADMIN_PROFILE_167", "Username");
//define("ADMIN_PROFILE_168", "Email address");
//define("ADMIN_PROFILE_169", "Registration Date");
//define("ADMIN_PROFILE_170", "Last visit");
//define("ADMIN_PROFILE_171", "Number of visits");
//define("ADMIN_PROFILE_172", "Who can view the list of members:");
define("ADMIN_PROFILE_173", "List of members");
define("ADMIN_PROFILE_174", "Members list settings");
//define("ADMIN_PROFILE_175", "Forum Messages");
//define("ADMIN_PROFILE_176", "Comments");
//define("ADMIN_PROFILE_177", "Profile Comments");
//define("ADMIN_PROFILE_178", "Pictures");
//define("ADMIN_PROFILE_179", "Video");
//define("ADMIN_PROFILE_180", "Music");
//define("ADMIN_PROFILE_181", "The extra information contained herein show thumbnails (the nickname column):<br/><br/><i>If you go to the small pictures displayed on the mouse, you can see how many posts, comments, image or video is a member.</i>");
/*
define("ADMIN_PROFILE_182", "Members List Columns:<br/><br/><i>The logon name, time zone and IP Address columns in only the appropriate permissions (user moderation / banning, etc..) admins can see in.</i>");
define("ADMIN_PROFILE_183", "Avatar");
define("ADMIN_PROFILE_184", "Username");
define("ADMIN_PROFILE_185", "E-mail address");
define("ADMIN_PROFILE_186", "Registration Date");
define("ADMIN_PROFILE_187", "Last visit");
define("ADMIN_PROFILE_188", "Number of visits");
define("ADMIN_PROFILE_189", "Allow filtering of results. <i>Who knows picture, video, messages, etc.. to filter the list of members.</i>");
define("ADMIN_PROFILE_190", "Real name");
define("ADMIN_PROFILE_191", "Username");
define("ADMIN_PROFILE_192", "Time Zone");
define("ADMIN_PROFILE_193", "IP-Address");
define("ADMIN_PROFILE_194", "Advanced search using search fields are displayed:<br/><br/><i>Search completed in certain fields of \"and \" relationship.</i>");
define("ADMIN_PROFILE_195", "Email address");
define("ADMIN_PROFILE_196", "Username");
define("ADMIN_PROFILE_197", "Enable Advanced Search");
*/
define("ADMIN_PROFILE_198", "Directories");
define("ADMIN_PROFILE_199", "The userimages usermp3 and writable");
define("ADMIN_PROFILE_200", "The userimages, or do not have write permission to the directory usermp3");
define("ADMIN_PROFILE_201", "The uploads to the Web server must have write access to directories userimages and usermp3.");
define("ADMIN_PROFILE_202", "The value is correct, because it did not turn on the background of the profile or galleries.");
define("ADMIN_PROFILE_203", "The value is correct.");
//define("ADMIN_PROFILE_204", "Ordered column color appears when the order of increasing:<br/><i>RGB hex code to enter eg. Red: FF0000 or F00. If you do not specify a color, then the theme will be used to set the color and did not appear, which column orderly.</i>");
//define("ADMIN_PROFILE_205", "Ordered column color appears when the order of decreasing:<br/><i>RGB hex code to enter eg. Green: 00FF00, or 0F0. If you do not specify a color, then the theme will be used to set the color and did not appear, which column orderly.</i>");
//define("ADMIN_PROFILE_205a", "Display \"Add to Friends\" link in member list:<br/><i>Click on the thumbnails directly from a list of the members designated as friends of the tag, and indicates that you have already checked / e-friendly.</i>");
define("ADMIN_PROFILE_206", "Simply entered the wrong color code!<br/>The other settings Update");
define("ADMIN_PROFILE_207", "Simply entered the wrong value!<br/>The other settings Update");
//define("ADMIN_PROFILE_208", "Column label CSS class:<br/><i>Enter the CSS class name of the column you want to use subtitles (default: \"button\").</i>");
//define("ADMIN_PROFILE_209", "The background music starts automatically when opening the profile?");
//define("ADMIN_PROFILE_210", "Repeat playback, if the profile music has reached the end?");
//define("ADMIN_PROFILE_211", "The playback volume:<br/><i>The value of 1 to 200 can be. 1 - minimum volume, 200 - max volume.</i>");
//define("ADMIN_PROFILE_212", "Tag-up charts showing the number of members.<br/><i>Eg. Top 40 to enter 40. The value can be up to 200.</i>");
define("ADMIN_PROFILE_213", "Top list enabled");
//define("ADMIN_PROFILE_214", "Availability Top Lists");
//define("ADMIN_PROFILE_215", "Top members settings");
//define("ADMIN_PROFILE_216", "Select top lists");
//define("ADMIN_PROFILE_217", "Most active members");
//define("ADMIN_PROFILE_218", "Most message forums");
//define("ADMIN_PROFILE_219", "Most commented");
//define("ADMIN_PROFILE_220", "Top Rated Members");
//define("ADMIN_PROFILE_221", "Most viewed profiles");
//define("ADMIN_PROFILE_222", "Most Friend");
//define("ADMIN_PROFILE_223", "Most chatbox message");
//define("ADMIN_PROFILE_224", "Display administrators in the top lists?");
//define("ADMIN_PROFILE_225", "List Layout");
//define("ADMIN_PROFILE_226", "Traditional");
//define("ADMIN_PROFILE_227", "Contacts");
//define("ADMIN_PROFILE_228", "About layout, the number of columns <i>(default value: 3)</i>");
//define("ADMIN_PROFILE_228a", "About layout, the number of columns <i>(default value: 1)</i>");
//define("ADMIN_PROFILE_229", "Css stylesheet layout used about <i>(the css directory of the two sample css file. Lite: a clear theme, Dark: dark themes)</i>");
//define("ADMIN_PROFILE_230", "lite");
//define("ADMIN_PROFILE_231", "dark");
//define("ADMIN_PROFILE_232", "Most recently changed the display mode menu profiles");
//define("ADMIN_PROFILE_233", "Horizontal");
//define("ADMIN_PROFILE_234", "Vertical");
//define("ADMIN_PROFILE_235", "Last changed profiles up menu. many members appear <i>(default value: 3)</i>");
//define("ADMIN_PROFILE_236a", "Profiles page last changed columns");
//define("ADMIN_PROFILE_236", "Recently changed to access a list of profiles");
//define("ADMIN_PROFILE_237", "automatic");
//define("ADMIN_PROFILE_238", "User Class");
//define("ADMIN_PROFILE_239", "Allow private albums<br/><i>If checked, then the members can create private albums. The moderation of user / administrator rights banning admins and members outside the establishing the album - if the system is turned on friends, only friends can view the tag.</i>");
//define("ADMIN_PROFILE_240", "Video width <i>(Default 640)</i>");
//define("ADMIN_PROFILE_241", "Selectable video sharing");
//define("ADMIN_PROFILE_242", "Youtube");
//define("ADMIN_PROFILE_243", "Vimeo");
//define("ADMIN_PROFILE_244", "Metacafe");
//define("ADMIN_PROFILE_245", "Indavideo");
define("ADMIN_PROFILE_246", "Check video file access<br/><i>Recommended option: Yes</i>");
define("ADMIN_PROFILE_247", "User pictures sorted by default");
?>
