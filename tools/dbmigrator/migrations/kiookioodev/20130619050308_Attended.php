<?php

class Attended extends Ruckusing_Migration_Base
{
    public function up()
    {
	    $this->rename_column("User", "attending", "attended");
    }//up()

    public function down()
    {
	    $this->rename_column("User", "attended", "attending");
    }//down()
}
