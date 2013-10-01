<?php

class Stores extends Ruckusing_Migration_Base
{
    public function up()
    {
	    $this->execute("CREATE TABLE `".app()->config("tablePrefix")."Store` (
	        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	        `sponsorId` int(11) unsigned NOT NULL,
	        `name` varchar(255) DEFAULT NULL,
	        `address` varchar(255) DEFAULT NULL,
	        `city` varchar(255) DEFAULT NULL,
	        `createdAt` bigint(20) unsigned DEFAULT NULL,
            `updatedAt` bigint(20) unsigned DEFAULT NULL,
	        PRIMARY KEY (`id`)
	    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

	    $this->execute("CREATE TABLE `".app()->config("tablePrefix")."CampaignStore` (
	        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	        `campaignId` int(11) unsigned NOT NULL,
	        `storeId` int(11) unsigned NOT NULL,
	        PRIMARY KEY (`id`)
	    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

	    $this->add_column("CampaignEntry", "storeId", "integer");
    }//up()

    public function down()
    {
	    $this->drop_table("Store");
	    $this->drop_table("CampaignStore");
	    $this->remove_column("CampaignEntry", "storeId");
    }//down()
}
