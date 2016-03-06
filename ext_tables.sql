#
# Table structure for table 'tx_mminteractive_domain_model_map'
#
CREATE TABLE tx_mminteractive_domain_model_map (
  uid int(11) unsigned NOT NULL auto_increment,
  pid int(11) unsigned NOT NULL default '0',
	title varchar(255) NOT NULL default '',
	image varchar(255) NOT NULL default '',
  PRIMARY KEY (uid)
);

#
# Table structure for table 'tx_mminteractive_domain_model_area'
#
CREATE TABLE tx_mminteractive_domain_model_area (
  uid int(11) unsigned NOT NULL auto_increment,
  pid int(11) unsigned NOT NULL default '0',
	mapid int(11) unsigned NOT NULL default '0',
	title varchar(255) NOT NULL default '',
	url varchar(255) NOT NULL default '',
	params text NOT NULL,
	alt text NOT NULL,
	shape tinyint(4) NOT NULL default '0',
  PRIMARY KEY (uid)
);

#
# Table structure for table 'tx_mminteractive_domain_model_event'
#
CREATE TABLE tx_mminteractive_domain_model_event (
  uid int(11) unsigned NOT NULL auto_increment,
  pid int(11) unsigned NOT NULL default '0',
	title varchar(255) NOT NULL default '',
  PRIMARY KEY (uid)
);

#
# Table structure for table 'tx_mminteractive_domain_model_action'
#
CREATE TABLE tx_mminteractive_domain_model_action (
  uid int(11) unsigned NOT NULL auto_increment,
  pid int(11) unsigned NOT NULL default '0',
	eventid int(11) NOT NULL default '0',
	areaid int(11) NOT NULL default '0',
	bgcolor varchar(20) NOT NULL default '',
	bgimage varchar(255) NOT NULL default '',
	bgimageix tinyint(4) NOT NULL default '0',
	bgimageiy tinyint(4) NOT NULL default '0',
	bgcoloropacity varchar(20) NOT NULL default '1',
	bgimageopacity varchar(20) NOT NULL default '1',
	bgimageoverbgcolor tinyint(4) NOT NULL default '0',
  popuptype tinyint(4) NOT NULL default '0',
	popuptitle varchar(255) NOT NULL default '',
  popupwidth int(11) NOT NULL default '0',
	popupheight int(11) NOT NULL default '0',
  popupx int(11) NOT NULL default '0',
	popupy int(11) NOT NULL default '0',
	popupborderstyle tinyint(4) NOT NULL default '0',
	popupborderwidth int(11) NOT NULL default '0',
	popupbordercolor varchar(20) NOT NULL default '',
	popupcontentid int(11) NOT NULL default '0',
	popuphtml text NOT NULL,
	bordercolor varchar(20) NOT NULL default '',
  borderstyle tinyint(4) NOT NULL default '0',
  borderwidth int(11) NOT NULL default '0',
	PRIMARY KEY (uid)
);

#
# Table structure for table 'tx_mminteractive_domain_model_areapoint'
#
CREATE TABLE tx_mminteractive_domain_model_areapoint (
  uid int(11) unsigned NOT NULL auto_increment,
  pid int(11) unsigned NOT NULL default '0',
  areaid int(11) NOT NULL default '0',
  x int(11) NOT NULL default '0',
  y int(11) NOT NULL default '0',
	sorting int(11) NOT NULL default '1',
  PRIMARY KEY (uid)
);

#
# Table structure for table 'tx_mminteractive_domain_model_mapcache'
#
CREATE TABLE tx_mminteractive_domain_model_mapcache (
  uid int(11) unsigned NOT NULL auto_increment,
  pid int(11) unsigned NOT NULL default '0',
	mapid int(11) unsigned NOT NULL default '0',
	cache blob,
	lastchanged timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY (uid)
);
