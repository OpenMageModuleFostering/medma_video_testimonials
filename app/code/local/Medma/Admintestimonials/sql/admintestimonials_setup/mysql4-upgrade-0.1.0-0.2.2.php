<?php
// echo 'Running This Upgrade: '.get_class($this)."\n <br /> \n";
// die("Exit for now"); 
$installer = $this;

$installer->startSetup();

$installer->run("

   DROP TABLE IF EXISTS {$this->getTable('customer_video_testimonials')};
   CREATE TABLE {$this->getTable('customer_video_testimonials')}(
  `customertestimonials_id` int(11) unsigned NOT NULL auto_increment,
  `customer_video_url` varchar(255) NOT NULL default '',
  `customer_title` varchar(255) NOT NULL default '',
  `customer_name` varchar(255) NOT NULL default '',
  `customer_email` varchar(255) NOT NULL default '',
  `customer_comment` text NOT NULL default '',
  `product_id` int(11) NOT NULL ,
  `status` smallint(6) NOT NULL default '0',
  PRIMARY KEY (`customertestimonials_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup(); 
