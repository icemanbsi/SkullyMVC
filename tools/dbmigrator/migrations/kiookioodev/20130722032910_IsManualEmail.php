<?php

class IsManualEmail extends Ruckusing_Migration_Base
{
    public function up()
    {
	    $this->add_column("User", "isManualEmail", "boolean", array("null" => false));
    }//up()

    public function down()
    {
	    $this->remove_column("User", "isManualEmail");
    }//down()
}
