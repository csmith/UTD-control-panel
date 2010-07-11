-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Apr 07, 2008 at 05:21 PM
-- Server version: 5.0.38
-- PHP Version: 5.2.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `admin`
-- 
CREATE DATABASE `admin` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `admin`;

-- --------------------------------------------------------

-- 
-- Table structure for table `actions`
-- 

CREATE TABLE `actions` (
  `action_id` int(5) NOT NULL auto_increment,
  `user_id` int(5) NOT NULL,
  `action_type` enum('pass','create','lock','unlock','restart','updateconf') NOT NULL,
  `action_value` text NOT NULL,
  PRIMARY KEY  (`action_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66467 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `banneduser`
-- 

CREATE TABLE `banneduser` (
  `bu_id` int(5) NOT NULL auto_increment,
  `bu_name` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`bu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `banneduser`
-- 

INSERT INTO `banneduser` (`bu_id`, `bu_name`) VALUES 
(1, 'admin'),
(2, 'www'),
(3, 'support'),
(4, 'utd');

-- --------------------------------------------------------

-- 
-- Table structure for table `billitems`
-- 

CREATE TABLE `billitems` (
  `bi_id` int(5) NOT NULL auto_increment,
  `bill_id` int(5) NOT NULL,
  `up_id` int(5) NOT NULL,
  `bi_cost` int(5) NOT NULL,
  PRIMARY KEY  (`bi_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `bills`
-- 

CREATE TABLE `bills` (
  `bill_id` int(5) NOT NULL auto_increment,
  `user_id` int(5) NOT NULL,
  `bill_due` int(11) NOT NULL,
  `bill_generated` int(11) NOT NULL,
  `bill_total` int(5) NOT NULL,
  `bill_paid` int(1) NOT NULL default '0',
  PRIMARY KEY  (`bill_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `db_dbs`
-- 

CREATE TABLE `db_dbs` (
  `db_id` int(5) NOT NULL auto_increment,
  `user_id` int(5) NOT NULL default '0',
  `db_name` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`db_id`),
  UNIQUE KEY `db_name` (`db_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `db_perms`
-- 

CREATE TABLE `db_perms` (
  `dbperm_id` int(5) NOT NULL auto_increment,
  `dbuser_id` int(5) NOT NULL default '0',
  `db_id` int(5) NOT NULL default '0',
  PRIMARY KEY  (`dbperm_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `db_users`
-- 

CREATE TABLE `db_users` (
  `dbuser_id` int(5) NOT NULL auto_increment,
  `user_id` int(5) NOT NULL default '0',
  `dbuser_name` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`dbuser_id`),
  UNIQUE KEY `dbuser_name` (`dbuser_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `discounts`
-- 

CREATE TABLE `discounts` (
  `discount_id` int(5) NOT NULL auto_increment,
  `package_id` int(5) NOT NULL default '1',
  `discount_code` varchar(24) NOT NULL default '',
  `discount_time` int(11) NOT NULL default '0',
  `discount_money` int(10) NOT NULL default '0',
  `discount_type` enum('signup','general') NOT NULL default 'signup',
  `discount_start` int(11) NOT NULL default '0',
  `discount_end` int(11) NOT NULL default '0',
  `discount_message` text NOT NULL,
  PRIMARY KEY  (`discount_id`),
  UNIQUE KEY `vouhcer_code` (`discount_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `discountusers`
-- 

CREATE TABLE `discountusers` (
  `du_id` int(5) NOT NULL auto_increment,
  `user_id` int(5) NOT NULL default '0',
  `discount_id` int(5) NOT NULL default '0',
  PRIMARY KEY  (`du_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `domains`
-- 

CREATE TABLE `domains` (
  `domain_id` int(5) NOT NULL auto_increment,
  `user_id` int(5) NOT NULL default '0',
  `domain_name` varchar(200) NOT NULL default '',
  `domain_enabled` tinyint(1) NOT NULL default '0',
  `domain_parent` int(5) NOT NULL default '0',
  PRIMARY KEY  (`domain_id`),
  UNIQUE KEY `domain_name` (`domain_name`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `email`
-- 

CREATE TABLE `email` (
  `email_id` int(5) NOT NULL auto_increment,
  `domain_id` int(5) default NULL,
  `email_user` varchar(255) default NULL,
  `mailbox_id` int(5) default NULL,
  PRIMARY KEY  (`email_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `finances`
-- 

CREATE TABLE `finances` (
  `finance_id` int(5) NOT NULL auto_increment,
  `finance_time` int(11) NOT NULL,
  `finance_desc` varchar(200) NOT NULL,
  `user_id` int(5) NOT NULL,
  `finance_receipts` int(10) NOT NULL default '0',
  `finance_payments` int(10) NOT NULL default '0',
  `finance_balance` int(10) NOT NULL,
  PRIMARY KEY  (`finance_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `historic_user`
-- 

CREATE TABLE `historic_user` (
  `hu_id` int(7) NOT NULL auto_increment,
  `user_id` int(5) NOT NULL default '0',
  `hu_start` int(11) NOT NULL default '0',
  `hu_end` int(11) NOT NULL default '0',
  `hu_hdd` bigint(12) NOT NULL default '0',
  `hu_bw` bigint(12) NOT NULL default '0',
  PRIMARY KEY  (`hu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=197 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `ipbans`
-- 

CREATE TABLE `ipbans` (
  `ipban_id` int(5) NOT NULL auto_increment,
  `ipban_ip` varchar(15) NOT NULL,
  `ipban_expires` int(11) NOT NULL,
  `ipban_message` varchar(200) NOT NULL,
  PRIMARY KEY  (`ipban_id`),
  KEY `ipban_ip` (`ipban_ip`),
  KEY `ipban_expires` (`ipban_expires`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `iptdata`
-- 

CREATE TABLE `iptdata` (
  `ipt_id` int(5) NOT NULL auto_increment,
  `ipt_user` varchar(100) NOT NULL,
  `ipt_in` int(15) NOT NULL,
  `ipt_out` int(15) NOT NULL,
  `ipt_lastchecked` int(11) NOT NULL,
  PRIMARY KEY  (`ipt_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `issues_assigns`
-- 

CREATE TABLE `issues_assigns` (
  `iaut_id` int(5) NOT NULL auto_increment,
  `icat_id` int(5) default NULL,
  `user_id` int(5) default NULL,
  PRIMARY KEY  (`iaut_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `issues_categories`
-- 

CREATE TABLE `issues_categories` (
  `icat_id` int(5) NOT NULL auto_increment,
  `icat_name` varchar(100) default NULL,
  `icat_assign` int(5) NOT NULL default '0',
  PRIMARY KEY  (`icat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='InnoDB free: 4096 kB' AUTO_INCREMENT=10 ;

-- 
-- Dumping data for table `issues_categories`
-- 

INSERT INTO `issues_categories` (`icat_id`, `icat_name`, `icat_assign`) VALUES 
(1, 'General', 0),
(2, 'Website', 0),
(3, 'Issue Tracker', 3),
(4, 'Service Monitor', 0),
(5, 'Long Term', 0),
(6, 'Signup', 0),
(7, 'Control Panel', 0),
(8, 'Admin', 0),
(9, 'Server-Asimov', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `issues_issues`
-- 

CREATE TABLE `issues_issues` (
  `i_id` int(5) NOT NULL auto_increment,
  `icat_id` int(5) default NULL,
  `i_submitter` int(5) default NULL,
  `i_assignee` int(5) default NULL,
  `i_priority` enum('urgent','high','normal','low') default 'normal',
  `i_added` int(11) default NULL,
  `i_updated` int(11) default NULL,
  `i_deadline` int(11) default NULL,
  `i_title` varchar(100) default NULL,
  `i_status` enum('open','assigned','closed','reopened') default 'open',
  `i_text` text,
  `i_extensiveness` enum('trivial','normal','extensive') NOT NULL default 'normal',
  PRIMARY KEY  (`i_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='InnoDB free: 4096 kB' AUTO_INCREMENT=80 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `issues_logs`
-- 

CREATE TABLE `issues_logs` (
  `ilog_id` int(5) NOT NULL auto_increment,
  `i_id` int(5) default NULL,
  `ilog_time` int(11) default NULL,
  `user_id` int(5) default NULL,
  `ilog_field` varchar(100) default NULL,
  `ilog_old` text,
  `ilog_new` text,
  PRIMARY KEY  (`ilog_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='InnoDB free: 4096 kB' AUTO_INCREMENT=70 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `issues_replies`
-- 

CREATE TABLE `issues_replies` (
  `irep_id` int(5) NOT NULL auto_increment,
  `i_id` int(5) default NULL,
  `user_id` int(5) default NULL,
  `irep_time` int(11) default NULL,
  `irep_text` text,
  PRIMARY KEY  (`irep_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='InnoDB free: 4096 kB' AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `issues_searches`
-- 

CREATE TABLE `issues_searches` (
  `isea_id` int(5) NOT NULL auto_increment,
  `user_id` int(5) default NULL,
  `isea_name` varchar(100) default NULL,
  `isea_options` text,
  PRIMARY KEY  (`isea_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='InnoDB free: 4096 kB' AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `log`
-- 

CREATE TABLE `log` (
  `log_id` int(5) NOT NULL auto_increment,
  `user_id` int(5) NOT NULL,
  `log_level` enum('critical','important','normal','info','unknown') NOT NULL default 'unknown',
  `log_time` int(11) NOT NULL,
  `log_message` varchar(200) NOT NULL,
  PRIMARY KEY  (`log_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2012 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `mailboxes`
-- 

CREATE TABLE `mailboxes` (
  `mailbox_id` int(5) NOT NULL auto_increment,
  `domain_id` int(5) default NULL,
  `mailbox_user` varchar(255) default NULL,
  `mailbox_password` varchar(255) default NULL,
  PRIMARY KEY  (`mailbox_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `messages`
-- 

CREATE TABLE `messages` (
  `message_id` int(4) NOT NULL auto_increment,
  `message_type` enum('admin','public','announcement','information') NOT NULL default 'public',
  `message_title` varchar(150) NOT NULL default '',
  `message_time` int(12) NOT NULL default '0',
  `message_body` text NOT NULL,
  PRIMARY KEY  (`message_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `packages`
-- 

CREATE TABLE `packages` (
  `package_id` int(5) NOT NULL auto_increment,
  `package_name` varchar(255) NOT NULL,
  `package_cost` int(5) NOT NULL,
  `package_duration` int(10) NOT NULL,
  `package_type` enum('hosting','dns','backup','ssh') NOT NULL,
  `package_description` text NOT NULL,
  `package_published` int(1) NOT NULL default '0',
  PRIMARY KEY  (`package_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `packages`
-- 

INSERT INTO `packages` (`package_id`, `package_name`, `package_cost`, `package_duration`, `package_type`, `package_description`, `package_published`) VALUES 
(1, 'Hosting - One Year', 3500, 31556736, 'hosting', 'Our standard hosting package. This package gives you a full year''s hosting for just £35. All of our hosting packages give you 3.5 GB of storage, and a massive 50 GB of data transfer per month. You also get basic DNS hosting and unlimited e-mail addresses, sites, subdomains and MySQL databases.', 1),
(2, 'Hosting - Three Months', 1000, 7889184, 'hosting', 'A shorter hosting package, for those who don''t want to pay for a year''s hosting in advance. Three months hosting for just £10. All of our hosting packages give you 3.5 GB of storage, and a massive 50 GB of data transfer per month. You also get basic DNS hosting and unlimited e-mail addresses, sites, subdomains and MySQL databases.', 1),
(3, 'DNS - One Year', 500, 31556736, 'dns', '', 0),
(4, 'DNS - Three Months', 150, 7889184, 'dns', '', 0),
(5, 'SSH access - One Year', 0, 31556736, 'ssh', '', 0),
(6, 'SSH access - Three Months', 0, 7889184, 'ssh', '', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `records`
-- 

CREATE TABLE `records` (
  `record_id` int(5) NOT NULL auto_increment,
  `domain_id` int(5) NOT NULL default '0',
  `record_type` char(5) NOT NULL,
  `record_value` varchar(200) NOT NULL default '',
  `record_ttl` int(10) NOT NULL default '86400',
  PRIMARY KEY  (`record_id`),
  KEY `domain_id` (`domain_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=155 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `sessions`
-- 

CREATE TABLE `sessions` (
  `session_id` int(3) NOT NULL auto_increment,
  `user_id` int(2) NOT NULL default '0',
  `session_ip` varchar(15) NOT NULL default '',
  `session_start` int(12) NOT NULL default '0',
  `session_last` int(12) NOT NULL default '0',
  `session_ident` varchar(32) NOT NULL default '',
  `session_spoof` int(5) NOT NULL default '0',
  PRIMARY KEY  (`session_id`),
  KEY `session_ident` (`session_ident`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=726 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `signups`
-- 

CREATE TABLE `signups` (
  `signup_id` int(5) NOT NULL auto_increment,
  `signup_ip` varchar(12) NOT NULL,
  `signup_time` int(11) NOT NULL,
  `signup_data` text NOT NULL,
  `signup_processed` int(1) NOT NULL default '0',
  `signup_checked` int(1) NOT NULL default '0',
  PRIMARY KEY  (`signup_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `sites`
-- 

CREATE TABLE `sites` (
  `site_id` int(3) NOT NULL auto_increment,
  `user_id` int(2) NOT NULL default '0',
  `site_name` varchar(100) NOT NULL default '',
  `site_bandin` bigint(12) NOT NULL default '0',
  `site_bandout` bigint(12) NOT NULL default '0',
  `site_docroot` text NOT NULL,
  `site_curdocroot` text NOT NULL,
  `site_logpos` int(10) NOT NULL default '0',
  `site_php` enum('stable','dev','legacy') NOT NULL default 'stable',
  `site_htaccess` smallint(1) NOT NULL default '1',
  `site_index` smallint(1) NOT NULL default '1',
  PRIMARY KEY  (`site_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `sshkeys`
-- 

CREATE TABLE `sshkeys` (
  `key_id` int(5) NOT NULL auto_increment,
  `user_id` int(5) NOT NULL,
  `key_comment` varchar(200) NOT NULL,
  `key_key` text NOT NULL,
  PRIMARY KEY  (`key_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tickets`
-- 

CREATE TABLE `tickets` (
  `ticket_id` int(4) NOT NULL auto_increment,
  `user_id` int(2) NOT NULL default '0',
  `ticket_status` enum('new','assigned','closed','reopened','reply') NOT NULL default 'new',
  `ticket_thread` int(4) NOT NULL default '0',
  `ticket_title` varchar(200) NOT NULL default '',
  `ticket_body` text NOT NULL,
  `ticket_time` int(12) NOT NULL default '0',
  PRIMARY KEY  (`ticket_id`),
  KEY `user_id` (`user_id`),
  KEY `ticket_thread` (`ticket_thread`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=106 ;

-- 
-- Table structure for table `userdetails`
-- 

CREATE TABLE `userdetails` (
  `user_id` int(3) NOT NULL default '0',
  `ud_name` text NOT NULL,
  `ud_address` text NOT NULL,
  `ud_telephone` varchar(20) NOT NULL default '',
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Table structure for table `userpackages`
-- 

CREATE TABLE `userpackages` (
  `up_id` int(5) NOT NULL auto_increment,
  `package_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `up_expires` int(11) NOT NULL,
  `up_cost` int(5) NOT NULL,
  `up_invoice` int(1) NOT NULL default '1',
  `up_active` int(1) NOT NULL default '1',
  PRIMARY KEY  (`up_id`),
  KEY `user_id` (`user_id`),
  KEY `up_active` (`up_active`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL auto_increment,
  `user_name` varchar(20) NOT NULL default '',
  `user_pass` varchar(33) NOT NULL,
  `user_email` varchar(255) NOT NULL default '',
  `user_admin` int(1) NOT NULL default '0',
  `user_tac` int(4) NOT NULL default '0',
  `user_ref` int(5) NOT NULL default '0',
  `user_signup` int(11) NOT NULL,
  `user_limitstarts` int(11) NOT NULL default '0',
  `user_limitends` int(11) NOT NULL default '0',
  `mail_announce` int(1) NOT NULL default '1',
  `mail_tickets` int(1) NOT NULL default '1',
  `mail_warning` int(1) NOT NULL default '1',
  `mail_over` int(1) NOT NULL default '1',
  `band_total` bigint(12) NOT NULL default '50000000000',
  `band_used` bigint(12) NOT NULL default '0',
  `hdd_total` bigint(12) NOT NULL default '3500000000',
  `hdd_used` bigint(12) NOT NULL default '0',
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

