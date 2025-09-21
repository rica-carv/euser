CREATE TABLE phillist_estado (
  cod int(10) NOT NULL auto_increment,
  descr varchar(100) default NULL,
  PRIMARY KEY  (cod),
  UNIQUE KEY estado_unico (descr),
  KEY codigo (cod)
) ENGINE=MyISAM;

CREATE TABLE phillist_cond (
  cod int(10) NOT NULL auto_increment,
  descr varchar(100) default NULL,
  PRIMARY KEY  (cod),
  UNIQUE KEY cond_unico (descr),
  KEY codigo (cod)
) ENGINE=MyISAM;

CREATE TABLE phillist_fltu (
  `cod` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(10) unsigned NOT NULL,
  `peca` int(10) unsigned NOT NULL,
  `n` tinyint(1) default NULL,
  `g` tinyint(1) default NULL,
  `c` tinyint(1) default NULL,
  `b` tinyint(1) unsigned default NULL,
  `quant` smallint(2) unsigned default NULL,
  `observacoes` varchar(255) default NULL,
  `estado` tinyint(1) unsigned default NULL,
  `cond` tinyint(1) unsigned default NULL,
  `data` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY  (cod),
  UNIQUE KEY codigo (cod),
  UNIQUE KEY num_unico (user, peca,n,g,c,b,estado,cond)
) ENGINE=MyISAM;

CREATE TABLE phillist_fltn (
  `cod` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(10) unsigned NOT NULL,
  `peca` int(10) unsigned NOT NULL,
  `n` tinyint(1) default NULL,
  `g` tinyint(1) default NULL,
  `c` tinyint(1) default NULL,
  `b` tinyint(1) unsigned default NULL,
  `quant` smallint(2) unsigned default NULL,
  `observacoes` varchar(255) default NULL,
  `estado` tinyint(1) unsigned default NULL,
  `cond` tinyint(1) unsigned default NULL,
  `data` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY  (cod),
  UNIQUE KEY codigo (cod),
  UNIQUE KEY num_unico (user, peca,n,g,c,b,estado,cond)
) ENGINE=MyISAM;

CREATE TABLE phillist_trcn (
  `cod` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(10) unsigned NOT NULL,
  `peca` int(10) unsigned NOT NULL,
  `n` tinyint(1) default NULL,
  `g` tinyint(1) default NULL,
  `c` tinyint(1) default NULL,
  `b` tinyint(1) unsigned default NULL,
  `quant` smallint(2) unsigned default NULL,
  `observacoes` varchar(255) default NULL,
  `estado` tinyint(1) unsigned default NULL,
  `cond` tinyint(1) unsigned default NULL,
  `data` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY  (cod),
  UNIQUE KEY codigo (cod),
  UNIQUE KEY num_unico (user, peca,g,c,b,estado)
) ENGINE=MyISAM;

CREATE TABLE phillist_trcu (
  `cod` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(10) unsigned NOT NULL,
  `peca` int(10) unsigned NOT NULL,
  `n` tinyint(1) default NULL,
  `g` tinyint(1) default NULL,
  `c` tinyint(1) default NULL,
  `b` tinyint(1) unsigned default NULL,
  `quant` smallint(2) unsigned default NULL,
  `observacoes` varchar(255) default NULL,
  `estado` tinyint(1) unsigned default NULL,
  `cond` tinyint(1) unsigned default NULL,
  `data` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY  (cod),
  UNIQUE KEY codigo (cod),
  UNIQUE KEY num_unico (user, peca,g,c,b,estado)
) ENGINE=MyISAM;

CREATE TABLE phillist_vfltu (
  cod int(10) UNSIGNED NOT NULL DEFAULT '0',
  valor varchar(50) default NULL,
  data_valor TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM;

CREATE TABLE phillist_vfltn (
  cod int(10) UNSIGNED NOT NULL DEFAULT '0',
  valor varchar(50) default NULL,
  data_valor TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM;
