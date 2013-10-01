<?php

class VoucherPath extends Ruckusing_Migration_Base
{
    public function up()
    {
	    $this->add_column("CampaignEntry", 'voucherPath', 'string');
    }//up()

    public function down()
    {
	    $this->remove_column("CampaignEntry", 'voucherPath');
    }//down()
}
