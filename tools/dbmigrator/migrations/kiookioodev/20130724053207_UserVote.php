<?php

class UserVote extends Ruckusing_Migration_Base
{
    public function up()
    {
	    $this->execute("CREATE TABLE `".app()->config('tablePrefix')."UserVote` (
	      `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		  `userId` int(10) unsigned DEFAULT NULL,
		  `campaignId` int(10) unsigned DEFAULT NULL,
		  `campaignEntryId` int(11) unsigned DEFAULT NULL,
		  `createdAt` bigint(20) unsigned DEFAULT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
    }//up()

    public function down()
    {
	    $this->drop_table("UserVote");
    }//down()
}
