<?php

class CampaignIsEnded extends Ruckusing_Migration_Base
{
    public function up()
    {
	    $this->add_column('Campaign', 'isEnded', 'boolean', array("null" => false));
    }//up()

    public function down()
    {
	    $this->remove_column('Campaign', 'isEnded');
    }//down()
}
