<?php

class InitCampaignCity extends Ruckusing_Migration_Base
{
    public function up()
    {
	    $this->execute("INSERT INTO " . app()->table("CampaignCity") . "(campaignId, cityId) SELECT id, -1 FROM " . app()->table("Campaign"));
    }//up()

    public function down()
    {
    }//down()
}
