<?php

class AlterCampaignCity extends Ruckusing_Migration_Base
{
    public function up()
    {
	    $this->execute("ALTER TABLE `".app()->table("City")."` MODIFY id INTEGER");
	    $this->execute("ALTER TABLE `".app()->table("CampaignCity")."` MODIFY cityId INTEGER");

	    $this->execute("UPDATE `".app()->table("CampaignCity")."` SET cityId=-1 WHERE cityId=0");
    }//up()

    public function down()
    {
	    $this->execute("ALTER TABLE `".app()->table("City")."` MODIFY id INTEGER UNSIGNED");
	    $this->execute("ALTER TABLE `".app()->table("CampaignCity")."` MODIFY cityId INTEGER UNSIGNED");
    }//down()
}
