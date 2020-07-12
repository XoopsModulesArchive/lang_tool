CREATE TABLE lt_languages (
  id int(5) unsigned NOT NULL auto_increment,
  title varchar(100) NOT NULL,
  dirname varchar(30) NOT NULL,
  PRIMARY KEY  (id)
) TYPE=MyISAM;

INSERT INTO `lt_languages` VALUES ('', 'English', 'english');
INSERT INTO `lt_languages` VALUES ('', 'Traditional Chinese', 'zh-tw');
INSERT INTO `lt_languages` VALUES ('', 'Simplified Chinese', 'schinese');
INSERT INTO `lt_languages` VALUES ('', 'French', 'french');
INSERT INTO `lt_languages` VALUES ('', 'Bulgarian', 'bulgarian');
INSERT INTO `lt_languages` VALUES ('', 'German', 'german');
INSERT INTO `lt_languages` VALUES ('', 'Portuguesebr', 'portuguesebr');
INSERT INTO `lt_languages` VALUES ('', 'Lithuanian', 'lithuanian');
INSERT INTO `lt_languages` VALUES ('', 'Spanish', 'spanish');
INSERT INTO `lt_languages` VALUES ('', 'Polish', 'polish');
INSERT INTO `lt_languages` VALUES ('', 'Dansk', 'danish');