<?php

class CampaignDescriptionVideo extends Ruckusing_Migration_Base
{
    public function up()
    {
	    $this->add_column('Campaign', 'descriptionVideo', 'string');
    }//up()

    public function down()
    {
	    $this->remove_column('Campaign', 'descriptionVideo');
    }//down()
}
