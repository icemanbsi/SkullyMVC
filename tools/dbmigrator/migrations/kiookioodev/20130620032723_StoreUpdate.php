<?php

class StoreUpdate extends Ruckusing_Migration_Base
{
    public function up()
    {
	    $this->remove_column('CampaignEntry', 'storeId');
	    $this->add_column('UserCampaign', 'storeId', 'integer');
    }//up()

    public function down()
    {
	    $this->remove_column('UserCampaign', 'storeId');
	    $this->add_column('CampaignEntry', 'storeId', 'integer');
    }//down()
}
