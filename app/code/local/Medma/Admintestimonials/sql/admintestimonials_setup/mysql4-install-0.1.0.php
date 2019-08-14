<?php
// echo 'Running This Upgrade: '.get_class($this)."\n <br /> \n";
// die("Exit for now"); 
$installer = $this;

$installer->startSetup();

$installer->run("

   DROP TABLE IF EXISTS {$this->getTable('admin_video_testimonials')};
   CREATE TABLE {$this->getTable('admin_video_testimonials')}(
  `admintestimonials_id` int(11) unsigned NOT NULL auto_increment,
  `video_url` varchar(255) NOT NULL default '',
  `category_id` int(11) NOT NULL ,
  `status` smallint(6) NOT NULL default '0',
  `position` smallint(6) NOT NULL default '0',
  PRIMARY KEY (`admintestimonials_id`),
  UNIQUE KEY (category_id, position)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup(); 
