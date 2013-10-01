<?php
// Remove this in production
class SampleData extends Ruckusing_Migration_Base
{
    public function up()
    {
	    $this->execute("
	    INSERT INTO `".app()->config('tablePrefix')."Campaign` (`id`, `title`, `startDate`, `endDate`, `campaignType`, `quota`, `campaignCategoryId`, `sponsorId`, `image`, `banner`, `link`, `likes`, `description`, `isVotable`, `settings`, `createdAt`, `updatedAt`)
VALUES
	(1,'New You, New Aquarius! Be The Best In You!',1366361026,1367590940,1,200,1,1,'images/campaigns/1/aquarius-04.png',NULL,'http://www.facebook.com/pages/Aquarius%E5%8B%95%E5%85%83%E7%B4%A0/205250742936892',0,NULL,0,NULL,1366400940,1366400940),
	(2,'New You, New Aquarius! Be The Best In You!',1366361026,1367590940,2,200,2,1,'images/campaigns/2/cocacola-06.png','images/campaigns/2/banner-03.png',NULL,0,NULL,0,NULL,1366400940,1366400940),
	(3,'New You, New Aquarius! Be The Best In You!',1366361026,1367590940,3,200,5,1,'images/campaigns/3/lipton-07.png',NULL,NULL,0,NULL,0,NULL,1366400940,1366400940),
	(4,'New You, New Aquarius! Be The Best In You!',1366361026,1367590940,2,200,4,1,'images/campaigns/4/aquarius-04.png',NULL,NULL,0,NULL,0,NULL,1366400940,1366400940),
	(5,'New You, New Aquarius! Be The Best In You!',1366361026,1367590940,5,200,8,1,'images/campaigns/5/cocacola-06.png',NULL,NULL,0,NULL,0,NULL,1366400940,1366400940),
	(6,'New You, New Aquarius! Be The Best In You!',1366361026,1367590940,6,200,3,1,'images/campaigns/6/lipton-07.png',NULL,NULL,0,NULL,0,NULL,1366400940,1366400940);
	    ");

	    $this->execute("
	    INSERT INTO `".app()->config('tablePrefix')."CampaignCategory` (`id`, `name`, `url`)
VALUES
	(1,'Food &amp; Beverage','food-and-beverage'),
	(2,'Electronics','electronics'),
	(3,'Sports','sports'),
	(4,'Fashions','fashions'),
	(5,'Beauty Cosmetics','beauty-cosmetics'),
	(6,'Travel &amp; Leisure','traver-and-leisure'),
	(7,'Internet','internet'),
	(8,'Living &amp; Kitchen','living-and-kitchen'),
	(9,'Business Money','business-money'),
	(10,'Book &amp; Magazines','book-and-magazines'),
	(11,'Furniture &amp; Interior','furniture-amp-interior'),
	(12,'Diet &amp; Health','diet-and-health'),
	(13,'Pets','pets'),
	(14,'Video &amp; Music','video-and-music'),
	(15,'Shops &amp; Stores','shops-and-stores');
	    ");

//	    $this->execute("
//INSERT INTO `kioo_User` (`id`, `firstName`, `lastName`, `gender`, `birthdate`, `email`, `facebookId`, `address`, `state`, `city`, `country`, `postalCode`, `phone`, `additionalEmail`, `isSubscribed`, `role`, `userGroupId`)
//VALUES
//(NULL,'Jay','TWP',0,1356973200,'teguhwpurwanto@gmail.com','762603129','',NULL,'Surabaya',NULL,'60113','6281931619956',NULL,0, '".\App\Models\User::_ROLE_SUPERADMIN."', null),
//(NULL,'Kio','Kioo',0,1356973200,'contact@kiookioo.com','100005040098461','',NULL,'Surabaya',NULL,'60113','6281931619956',NULL,0, '".\App\Models\User::_ROLE_ADMIN."', 1);
//	    ");
	    $user = \App\Models\User::model()->new(array(
		    'firstName' => 'Jay',
		    'lastName' => 'TWP',
		    'gender' => \App\Models\User::_MALE,
		    'birthdate' => 1356973200,
		    'email' => 'teguhwpurwanto@gmail.com',
		    'facebookId' => '762603129',
		    'role' => \App\Models\User::_ROLE_SUPERADMIN,
		    'userGroupId' => null
	    ), true);
		$user->save();

	    $user2 = \App\Models\User::model()->new(array(
		    'firstName' => 'Queen',
		    'lastName' => 'Kioo',
		    'gender' => \App\Models\User::_FEMALE,
		    'birthdate' => 1356973200,
		    'email' => 'contact@kiookioo.com',
		    'facebookId' => '100005040098461',
		    'role' => \App\Models\User::_ROLE_SUPERADMIN,
		    'userGroupId' => null
	    ), true);
	    $user2->save();

	    $user = \App\Models\User::model()->find()->first();
	    $userGroup = \App\Models\UserGroup::model()->new(array('name' => 'Test Group', 'userId' => $user->attributes['id']));
	    $userGroup->save();

	    $this->execute("
INSERT INTO `".app()->config('tablePrefix')."Sponsor` (`id`, `name`, `facebookId`, `facebookUrl`, `userGroupId`)
VALUES
	(1,'Aquarius','205250742936892','http://www.facebook.com/pages/Aquarius%E5%8B%95%E5%85%83%E7%B4%A0/205250742936892', ".$userGroup->attributes['id'].");
	    ");

	    $this->execute("
INSERT INTO `".app()->config('tablePrefix')."UserCampaign` (`id`, `userId`, `campaignId`, `saved`)
VALUES
	(1,1,2,1),
	(2,1,1,1);
	    ");
    }//up()

    public function down()
    {
    }//down()
}
