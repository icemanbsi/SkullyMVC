<?php

class City extends Ruckusing_Migration_Base
{
    public function up()
    {
	    $this->execute("CREATE TABLE `".app()->config('tablePrefix')."City` (
		  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
		  `name` varchar(255) DEFAULT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

	    $this->execute("CREATE TABLE `".app()->config('tablePrefix')."CampaignCity` (
		  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
		  `campaignId` int(10) unsigned NOT NULL,
		  `cityId` int(11) unsigned NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

	    $city = new \App\Models\City(array("name" => "Jakarta")); $city->save();
	    $city = new \App\Models\City(array("name" => "Surabaya")); $city->save();
	    $city = new \App\Models\City(array("name" => "Bandung")); $city->save();
	    $city = new \App\Models\City(array("name" => "Semarang")); $city->save();
	    $city = new \App\Models\City(array("name" => "Yogyakarta")); $city->save();
	    $city = new \App\Models\City(array("name" => "Serang")); $city->save();

	    $city = new \App\Models\City(array("name" => "Banda Aceh")); $city->save();
	    $city = new \App\Models\City(array("name" => "Medan")); $city->save();
	    $city = new \App\Models\City(array("name" => "Padang")); $city->save();
	    $city = new \App\Models\City(array("name" => "Pekanbaru")); $city->save();
	    $city = new \App\Models\City(array("name" => "Jambi")); $city->save();
	    $city = new \App\Models\City(array("name" => "Palembang")); $city->save();
	    $city = new \App\Models\City(array("name" => "Bengkulu")); $city->save();
	    $city = new \App\Models\City(array("name" => "Bandar Lampung")); $city->save();
	    $city = new \App\Models\City(array("name" => "Tanjung Pinang")); $city->save();
	    $city = new \App\Models\City(array("name" => "Pangkal Pinang")); $city->save();

	    $city = new \App\Models\City(array("name" => "Denpasar")); $city->save();
	    $city = new \App\Models\City(array("name" => "Kupang")); $city->save();
	    $city = new \App\Models\City(array("name" => "Mataram")); $city->save();

	    $city = new \App\Models\City(array("name" => "Pontianak")); $city->save();
	    $city = new \App\Models\City(array("name" => "Palangkaraya")); $city->save();
	    $city = new \App\Models\City(array("name" => "Banjarmasin")); $city->save();
	    $city = new \App\Models\City(array("name" => "Samarinda")); $city->save();
	    $city = new \App\Models\City(array("name" => "Tanjung Selor")); $city->save();

	    $city = new \App\Models\City(array("name" => "Manado")); $city->save();
	    $city = new \App\Models\City(array("name" => "Palu")); $city->save();
	    $city = new \App\Models\City(array("name" => "Makassar")); $city->save();
	    $city = new \App\Models\City(array("name" => "Kendari")); $city->save();
	    $city = new \App\Models\City(array("name" => "Gorontalo")); $city->save();
	    $city = new \App\Models\City(array("name" => "Mamuju")); $city->save();

	    $city = new \App\Models\City(array("name" => "Ambon")); $city->save();
	    $city = new \App\Models\City(array("name" => "Sofifi")); $city->save();

	    $city = new \App\Models\City(array("name" => "Jayapura")); $city->save();
	    $city = new \App\Models\City(array("name" => "Manokwari")); $city->save();


    }//up()

    public function down()
    {
	    $this->drop_table("City");
	    $this->drop_table("CampaignCity");
    }//down()
}
