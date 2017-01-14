<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$p = DISCUZ_ROOT . './data/hen_pet';
if(!is_dir($p)){mkdir($p,0777);}
$p .= '/pets';
if(!is_dir($p)){mkdir($p,0777);}

$sql = <<<EOF

DROP TABLE IF EXISTS `pre_hen_petshop`;
CREATE TABLE IF NOT EXISTS `pre_hen_petshop` (
`pid` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`image` TINYTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
`name` VARCHAR( 40 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'n/a',
`price` MEDIUMINT UNSIGNED NOT NULL DEFAULT '0',
`islimited` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0',
`limited` MEDIUMINT UNSIGNED NOT NULL DEFAULT '0',
`onsell` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

DROP TABLE IF EXISTS `pre_hen_mypet`;
CREATE TABLE IF NOT EXISTS `pre_hen_mypet` (
`uid` MEDIUMINT UNSIGNED NOT NULL ,
`pid` SMALLINT UNSIGNED NOT NULL ,
`text` VARCHAR( 25 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
`current` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

EOF;

runquery($sql);

$finish = TRUE;
?>