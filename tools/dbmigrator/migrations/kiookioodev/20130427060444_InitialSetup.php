<?php

class InitialSetup extends Ruckusing_Migration_Base
{
    public function up()
    {

$this->execute("CREATE TABLE `".app()->config('tablePrefix')."CalendarEvent` (
	    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned DEFAULT NULL,
  `campaignId` int(10) unsigned DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `startDate` bigint(20) unsigned DEFAULT NULL,
  `endDate` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

$this->execute("CREATE TABLE `".app()->config('tablePrefix')."Campaign` (
	    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `startDate` bigint(20) DEFAULT NULL,
  `endDate` bigint(20) DEFAULT NULL,
  `campaignType` int(11) DEFAULT NULL,
  `quota` int(11) unsigned DEFAULT NULL,
  `campaignCategoryId` int(10) unsigned DEFAULT NULL,
  `sponsorId` int(10) unsigned DEFAULT NULL,
  `thumbnail` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `image` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `banner` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `prizeImage` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `link` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `likes` int(11) unsigned NOT NULL,
  `description` text CHARACTER SET latin1,
  `isVotable` tinyint(1) NOT NULL DEFAULT '0',
  `settings` text CHARACTER SET latin1,
  `createdAt` bigint(20) unsigned DEFAULT NULL,
  `updatedAt` bigint(20) unsigned DEFAULT NULL,
  `views` int(11) DEFAULT '0',
  `isActive` tinyint(1) DEFAULT '0',
  `announcedAt` bigint(20) unsigned DEFAULT NULL,
  `codeLast` int(11) DEFAULT '0',
  `isRecommended` tinyint(1) DEFAULT NULL,
  `allowedToPublishByUserId` int(11) unsigned DEFAULT NULL,
  `allowedToPublishAt` bigint(20) unsigned DEFAULT NULL,
  `rules` text CHARACTER SET latin1,
  `prizeDescription` text CHARACTER SET latin1,
  `prizeType` varchar(30) DEFAULT NULL,
  `theme` text CHARACTER SET latin1,
  `status` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `isEmailsSent` tinyint(1) NOT NULL DEFAULT '0',
  `sponsorLikesBefore` bigint(20),
  `sponsorLikesAfter` bigint(20),
  `descriptionImage` varchar(255),

  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

$this->execute("CREATE TABLE `".app()->config('tablePrefix')."CampaignCategory` (
	    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

$this->execute("CREATE TABLE `".app()->config('tablePrefix')."CampaignEntry` (
	    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned DEFAULT NULL,
  `campaignId` int(10) unsigned DEFAULT NULL,
  `createdAt` bigint(20) unsigned DEFAULT NULL,
  `updatedAt` bigint(20) unsigned DEFAULT NULL,
  `score` int(11) DEFAULT '0',
  `content` text,
  `isApproved` tinyint(1) DEFAULT '0',
  `winningStatus` tinyInt(1) DEFAULT '0',
  `isEditorsPick` tinyInt(1) DEFAULT '0',
  `rank` int(11) DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `likes` int(11) unsigned NOT NULL,
  `isEmailSent` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

$this->execute("CREATE TABLE `".app()->config('tablePrefix')."Page` (
	    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` text,
  `metaKeywords` text,
  `metaDescription` text,
  `title` text,
  `code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

$this->execute("CREATE TABLE `".app()->config('tablePrefix')."Sponsor` (
	    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `facebookId` varchar(20) DEFAULT NULL,
  `facebookUrl` varchar(255) DEFAULT NULL,
  `userGroupId` int(10) unsigned DEFAULT NULL,
  `createdAt` bigint(20) DEFAULT NULL,
  `updatedAt` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

$this->execute("CREATE TABLE `".app()->config("tablePrefix")."State` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(3) unsigned DEFAULT NULL,
  `countryIso` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");

$this->execute("CREATE TABLE `".app()->config('tablePrefix')."Ticket` (
	    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned DEFAULT NULL,
  `message` text,
  `status` tinyint(1) DEFAULT NULL,
  `createdAt` bigint(20) unsigned DEFAULT NULL,
  `updatedAt` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

$this->execute("CREATE TABLE `".app()->config('tablePrefix')."TicketItem` (
	    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

$this->execute("CREATE TABLE `".app()->config('tablePrefix')."User` (
	    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT '0',
  `birthdate` bigint(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `facebookId` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postalCode` varchar(20) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `additionalEmail` varchar(150) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `isSubscribed` tinyint(1) DEFAULT NULL,
  `attending` int(11) unsigned DEFAULT '0',
  `win` int(11) unsigned DEFAULT '0',
  `userGroupId` int(10) unsigned DEFAULT NULL,
  `createdAt` bigint(20) unsigned DEFAULT NULL,
  `updatedAt` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

$this->execute("CREATE TABLE `".app()->config('tablePrefix')."UserCampaign` (
	    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned DEFAULT NULL,
  `campaignId` int(10) unsigned DEFAULT NULL,
  `saved` tinyint(1) NOT NULL DEFAULT '0',
  `createdAt` bigint(20) unsigned NOT NULL DEFAULT '0',
  `joined` tinyint(1) NOT NULL DEFAULT '0',
  `step` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

$this->execute("CREATE TABLE `".app()->config('tablePrefix')."UserModule` (
	    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned DEFAULT NULL,
  `module` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

$this->execute("CREATE TABLE `".app()->config('tablePrefix')."UserSession` (
	    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned DEFAULT NULL,
  `sessionId` varchar(32) DEFAULT NULL,
  `createdAt` bigint(20) unsigned DEFAULT NULL,
  `updatedAt` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

	    $t = $this->create_table('UserGroup', array('options' => "ENGINE=MyISAM DEFAULT CHARSET=utf8;"));
	    $t->column('userId', 'integer', array('limit' => 10, 'unsigned' => true));
	    $t->column('name', 'string', array('limit' => 100));
	    $t->finish();


	    //add fulltext index
	    $this->execute("ALTER TABLE `".app()->config('tablePrefix')."Campaign` ADD FULLTEXT(`title`, `description`);");
	    $this->execute("ALTER TABLE `".app()->config('tablePrefix')."CampaignCategory` ADD FULLTEXT(`name`);");
	    $this->execute("ALTER TABLE `".app()->config('tablePrefix')."Sponsor` ADD FULLTEXT(`name`);");

	    //add state data
	    $this->execute("
	        INSERT INTO `".app()->config('tablePrefix')."State` (`id`, `name`, `enabled`, `countryIso`)
			VALUES
				(1,'Aceh',1,'ID'),
				(2,'Bali',1,'ID'),
				(3,'Banten',1,'ID'),
				(4,'Bengkulu',1,'ID'),
				(5,'Gorontalo',1,'ID'),
				(6,'Jakarta',1,'ID'),
				(7,'Jambi',1,'ID'),
				(8,'Jawa Barat',1,'ID'),
				(9,'Jawa Tengah',1,'ID'),
				(10,'Jawa Timur',1,'ID'),
				(11,'Kalimantan Barat',1,'ID'),
				(12,'Kalimantan Selatan',1,'ID'),
				(13,'Kalimantan Tengah',1,'ID'),
				(14,'Kalimantan Timur',1,'ID'),
				(15,'Kalimantan Utara',1,'ID'),
				(16,'Kepulauan Bangka Belitung',1,'ID'),
				(17,'Kepulauan Riau',1,'ID'),
				(18,'Lampung',1,'ID'),
				(19,'Maluku',1,'ID'),
				(20,'Maluku Utara',1,'ID'),
				(21,'Nusa Tenggara Barat',1,'ID'),
				(22,'Nusa Tenggara Timur',1,'ID'),
				(23,'Papua',1,'ID'),
				(24,'Papua Barat',1,'ID'),
				(25,'Riau',1,'ID'),
				(26,'Sulawesi Barat',1,'ID'),
				(27,'Sulawesi Selatan',1,'ID'),
				(28,'Sulawesi Tengah',1,'ID'),
				(29,'Sulawesi Tenggara',1,'ID'),
				(30,'Sulawesi Utara',1,'ID'),
				(31,'Sumatera Barat',1,'ID'),
				(32,'Sumatera Selatan',1,'ID'),
				(33,'Sumatera Utara',1,'ID'),
				(34,'Yogyakarta',1,'ID');
	    ");
    }//up()

    public function down()
    {
	    $this->drop_table('Campaign');
	    $this->drop_table('CampaignEntry');
	    $this->drop_table('CampaignCategory');
	    $this->drop_table('Sponsor');
	    $this->drop_table('User');
	    $this->drop_table('UserCampaign');
	    $this->drop_table('CalendarEvent');
	    $this->drop_table('UserSession');
	    $this->drop_table('Ticket');
	    $this->drop_table('TicketItem');
	    $this->drop_table('Page');
	    $this->drop_table('UserModule');
	    $this->drop_table('UserGroup');
	    $this->drop_table('State');
    }//down()
}
