#
# Table structure for table `euser`
#
CREATE TABLE euser (
  user_id int(5) NOT NULL default '0',
  user_custompage text NOT NULL,
  user_background varchar(255) NOT NULL default '',
  user_friends text NOT NULL,
  user_friends_request text NOT NULL,
  user_settings varchar(50) NOT NULL default '',
  user_simple int(1) NOT NULL default '1',
  user_lastviewed text NOT NULL,
  user_totalviews int(10) NOT NULL default '0',
  user_lastupdated int(11) NOT NULL default '0',
  user_mp3 text NOT NULL,
  PRIMARY KEY  (user_id)
);
# --------------------------------------------------------
#
# Table structure for table `euser_memberlist`
#
CREATE TABLE euser_memberlist (
  memberlist_id int(5) NOT NULL default '0',
  memberlist_search varchar(200) NOT NULL default '',
  memberlist_columns varchar(200) NOT NULL default '',
  PRIMARY KEY  (memberlist_id)
);
# --------------------------------------------------------
#
# Initial data for table `euser_memberlist`
#
INSERT INTO euser_memberlist VALUES ('','|username|email|','');
# --------------------------------------------------------
#
# Table structure for table `euser_commments`
#
CREATE TABLE euser_comments (
  com_id int(10) NOT NULL auto_increment,
  com_by int(10) NOT NULL default '0',
  com_to int(10) NOT NULL default '0',
  com_message text NOT NULL,
  com_date varchar(55) NOT NULL default '',
  com_type varchar(4) NOT NULL default '',
  com_extra varchar(255) NOT NULL default '',
  PRIMARY KEY  (com_id)
);
# --------------------------------------------------------
#
# Table structure for table `euser_vids`
#
CREATE TABLE euser_vids (
  vid_id int(10) NOT NULL auto_increment,
  vid_uid int(10) NOT NULL default '0',
  vid_name varchar(30) NOT NULL default '',
  vid_desc varchar(255) NOT NULL default '',
  vid_embed text NOT NULL,
  vid_added varchar(55) NOT NULL default '',
  PRIMARY KEY  (vid_id)
);
# --------------------------------------------------------
#
# Table structure for table `euser_friends`
#
# DEPRECATED
# CREATE TABLE IF NOT EXISTS euser_friends (
#   friend_id int(10) unsigned NOT NULL auto_increment,
#   friend_user int(10) unsigned NOT NULL,
#   friend_friend int(10) unsigned NOT NULL,
#   PRIMARY KEY  (friend_id)
# ) TYPE=MyISAM AUTO_INCREMENT=1;
# --------------------------------------------------------
#
# Table structure for table `euser_suspend`
#
## A gestão de contas suspensas é feita pelo próprio login_menu do core, que é incluido aqui no caso de o utilizador não estar logado. Não vale a pena estar a duplicar templates e código....
# DEPRECATED
# CREATE TABLE IF NOT EXISTS euser_suspend (
# user_id INT NOT NULL ,
# user_name varchar(100) NOT NULL default '' ,
# ip varchar(20) NOT NULL default '' ,
# PRIMARY KEY (user_id)
# ) TYPE=MyISAM;
# --------------------------------------------------------
#
# Table structure for table `euser_cache`
#
CREATE TABLE IF NOT EXISTS euser_cache (
  type varchar(50) NOT NULL default '',
  cache_name varchar(100) NOT NULL default '',
  cache text NOT NULL,
  cache_hide tinyint(1) NOT NULL default '0',
  cache_records int(11) NOT NULL default '0',
  cache_userclass int(10) NOT NULL default '0',
  cache_timestamp int(10) NOT NULL default '0',
  cache_active tinyint(1) NOT NULL default '0',
  type_order int(11) NOT NULL default '0',
  PRIMARY KEY  (type,cache_name,type_order)
) TYPE=MyISAM;
# --------------------------------------------------------
#
# Table structure for table `euser_read`
#
CREATE TABLE IF NOT EXISTS euser_read (
  user_id int(10) NOT NULL default '0',
  news text NOT NULL,
  chatbox text NOT NULL,
  comments text NOT NULL,
  contents text NOT NULL,
  downloads text NOT NULL,
  guestbook text NOT NULL,
  pictures text NOT NULL,
  movies text NOT NULL,
  links text NOT NULL,
  sitemembers text NOT NULL,
  games text NOT NULL,
  game_top text NOT NULL,
  gallery text NOT NULL,
  ibf text NOT NULL,
  smf text NOT NULL,
  bug text NOT NULL,
  chatbox2 text NOT NULL,
  copper text NOT NULL,
  jokes text NOT NULL,
  blogs text NOT NULL,
  suggestions text NOT NULL,
  PRIMARY KEY  (user_id)
) ENGINE=MyISAM;
# --------------------------------------------------------