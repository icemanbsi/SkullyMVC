<?php

class CampaignEntrySamples extends Ruckusing_Migration_Base
{
    public function up()
    {
	    $page = new \App\Models\Page(array(
		    'title' => 'Terms and Conditions',
		    'content' => '',
		    'code' => 'terms'
	    ), true);
	    $page->save();

	    $userGroup = \App\Models\UserGroup::model()->find()->first();

	    $campaignCategories = \App\Models\CampaignCategory::model()->find()->all();

	    $campaignTypes = array(
		    \App\Models\Campaign::_GIFTS,
//		    \App\Models\Campaign::_QUIZ,
		    \App\Models\Campaign::_WRITING,
		    \App\Models\Campaign::_PHOTO,
//		    \App\Models\Campaign::_GAMES,
//		    \App\Models\Campaign::_SAMPLE,
//		    \App\Models\Campaign::_CHECKIN
	    );

	    $users = array();
	    $userFb = array(
		    array("name" => "Linda Amehhaicjede Bharambesky", "uid" => "100005881930545", "email" => "jdambmy_bharambesky_1368176389@tfbnw.net"),
		    array("name" => "Patricia Amehedgebfk Changbergsenmans", "uid" => "100005854752600", "email" => "mdxzxng_changbergsenmansteinwitzescuskyson_1368176388@tfbnw.net"),
		    array("name" => "Donna Amehchfdbefb Narayanansen", "uid" => "100005838642562", "email" => "vditrqb_narayanansen_1368176387@tfbnw.net"),
		    array("name" => "Maria Amehflbgjc Qinman", "uid" => "100005860002703", "email" => "gyydywz_qinman_1368176386@tfbnw.net"),
		    array("name" => "Nancy Amehdedebecd Changsky", "uid" => "100005845452534", "email" => "vedtywy_changsky_1368176385@tfbnw.net"),
		    array("name" => "Susan Amehhaedjche Valtchanovescu", "uid" => "100005881540385", "email" => "hhwybtf_valtchanovescu_1368176385@tfbnw.net"),
		    array("name" => "Dorothy Ameheibbbfgi Chaiman", "uid" => "100005859222679", "email" => "addhjta_chaiman_1368176384@tfbnw.net"),
		    array("name" => "Will Amehhdedjfii Dinglesky", "uid" => "100005884540699", "email" => "ymrrent_dinglesky_1368176383@tfbnw.net"),
		    array("name" => "Mary Amehdehabeii Wisemanstein", "uid" => "100005845812599", "email" => "shpuohn_wisemanstein_1368176382@tfbnw.net"),
		    array("name" => "Dorothy Amehcejdbdij Changstein", "uid" => "100005835042490", "email" => "haspyxn_changstein_1368176382@tfbnw.net"),
		    array("name" => "Will Amehdegebghj Alisonsky", "uid" => "100005845752780", "email" => "dllbiek_alisonsky_1368176188@tfbnw.net"),
		    array("name" => "Betty Amehdigabfah Ricesonsteinwitzes", "uid" => "100005849712618", "email" => "nspvqao_ricesonsteinwitzescubergmansensky_1368176187@tfbnw.net"),
		    array("name" => "James Amehchfgbegi Panditsky", "uid" => "100005838672579", "email" => "fprvxsx_panditsky_1368176187@tfbnw.net"),
		    array("name" => "Tom Amehgajdjgfe Narayanansen", "uid" => "100005871040765", "email" => "hxrnwlj_narayanansen_1368176185@tfbnw.net"),
		    array("name" => "Sharon Amehfgeijdbj Rosenthalsonwitzs", "uid" => "100005867590420", "email" => "vrcpzxd_rosenthalsonwitzsenmanescuskybergstein_1368176184@tfbnw.net"),
		    array("name" => "Susan Amehhibejdha Wongman", "uid" => "100005889250481", "email" => "ezvimiq_wongman_1368176130@tfbnw.net"),
		    array("name" => "Helen Amehdccebeca Dinglebergescumans", "uid" => "100005843352531", "email" => "mkohrey_dinglebergescumanskysteinwitzsonsen_1368176129@tfbnw.net"),
		    array("name" => "Harry Amehbefhbgij Qinberg", "uid" => "100005825682790", "email" => "wbxthaf_qinberg_1368176128@tfbnw.net"),
		    array("name" => "Charlie Amehhdikeah Chaiescu", "uid" => "100005884900518", "email" => "vhtexhw_chaiescu_1368176127@tfbnw.net"),
		    array("name" => "Dorothy Amehhajfjfei Goldmanman", "uid" => "100005881060659", "email" => "qrnmgzv_goldmanman_1368176126@tfbnw.net")
	    );
	    for($i=0;$i<20;$i++) {
		    $a = strrpos($userFb[$i]["name"], " ");
		    $firstname = substr($userFb[$i]["name"], 0, $a);
		    $lastname = substr($userFb[$i]["name"], $a+1);
		    $user = new \App\Models\User(array(
			    'username' => $userFb[$i]["uid"],
			    'firstName' => $firstname,
			    'lastName' => $lastname,
			    'facebookId' => $userFb[$i]["uid"],
			    'gender' => rand(0,1),
			    'email' => $userFb[$i]["email"],
			    'userGroupId' => $userGroup->attributes['id'],
		    ), true);
		    $user->save();
		    $users[] = $user;
		    echo "created user ".$user->attributes['firstName']."\n";
	    }

	    $sponsorsFb = array(
		    array("id" => "462695530448501", "name" => "Aoyama", "url" => "http://www.facebook.com/AoyamaOfficial"),
		    array("id" => "491107787607946", "name" => "Shake Club House", "url" => "http://www.facebook.com/ShakeClubHouse"),
		    array("id" => "326807440769747", "name" => "Oat And Oat", "url" => "http://www.facebook.com/oatandoat"),
		    array("id" => "132362621334", "name" => "Safecare", "url" => "http://www.facebook.com/safecare.sip"),
		    array("id" => "161949543871197", "name" => "Samsung Mobile Japan", "url" => "http://www.facebook.com/samsungmobilejapan"),
		    array("id" => "232260823584492", "name" => "Gosh", "url" => "http://www.facebook.com/goshfashionID"),
		    array("id" => "320770371379488", "name" => "Bellagio", "url" => "http://www.facebook.com/BellagioFashionID"),
		    array("id" => "511631538872812", "name" => "Rotelli", "url" => "http://www.facebook.com/rotellifashion"),
		    array("id" => "326119680747972", "name" => "Teapresso", "url" => "http://www.facebook.com/loveteapresso"),
		    array("id" => "492720504098929", "name" => "Pro Design", "url" => "http://www.facebook.com/pages/Prodesign-knw/492720504098929"),
	    );

	    $sponsors = array();
	    for($i=0;$i<10;$i++) {
		    $sponsor = new \App\Models\Sponsor(array(
			    'name' => $sponsorsFb[$i]["name"],
			    'facebookId' => $sponsorsFb[$i]["id"],
			    'facebookUrl' => $sponsorsFb[$i]["url"],
			    'userGroupId' => $userGroup->attributes['id']
		    ), true);
		    $sponsor->save();
		    $sponsors[] = $sponsor;
		    echo "created sponsor ".$sponsor->attributes['name']."\n";
	    }

	    $admin = \App\Models\User::model()->find()->first();
	    $published = array(null, $admin->attributes['id']);
	    $maxUsers = 20;
	    $numWins = array(15, $maxUsers + 20); // Try with both users > quota and users < quota.
	    for ($i=0;$i<100;$i++) {
		    $allowedToPublishByUserId = $published[rand(0,1)];
		    $ct = $campaignTypes[rand(0,2)];
		    $startDate = time() - rand(500, 1000000);
		    $endDate = $startDate + rand(500000, 1000000);
		    $announceDate = $endDate + rand(259201, 359200);
		    $rSponsor = rand(0,count($sponsors)-1);
		    $campaign = new \App\Models\Campaign(array(
			    'title' => "Test Campaign $i",
			    'startDate' =>  $startDate,
			    'endDate' => $endDate,
			    'announcedAt' => $announceDate,
			    'campaignType' => $ct,
			    'isVotable' => ($ct == \App\Models\Campaign::_PHOTO || $ct == \App\Models\Campaign::_WRITING || $ct == \App\Models\Campaign::_SAMPLE ? 1 : 0),
			    'quota' => $numWins[rand(0,1)],
			    'thumbnail' => 'images/campaigns/2/cocacola-06.png',
			    'image' => 'images/campaigns/2/banner-03.png',
			    'isActive' => rand(0,1),
			    'allowedToPublishByUserId' => $allowedToPublishByUserId,
			    'allowedToPublishAt' => (!empty($allowedToPublishByUserId) ? time() : null),
			    'banner' => 'images/campaigns/2/banner-03-copy.png',
			    'isRecommended' => (rand(0,5) == 3 ? 1 : 0),
			    'sponsorId' => $sponsors[$rSponsor]->attributes['id'],
			    'campaignCategoryId' => $campaignCategories[rand(0,count($campaignCategories)-1)]->attributes['id'],
			    'rules' => '• You will need to Aoyama official Facebook page of clothes to the "Likes" in the application.
· I will consider it as a one-time per person applicants.
· Please refrain from the application of the participants.
· I will restrict to a person living in Japan for your application.
- Since I am afraid that I can not answer to queries about the prize, Please note.
, Due to unavoidable circumstances, which could be changed without prior notice prizes.
• The transfer to others the rights of the winner, can not be redeemed for cash.
• Note address winner is unclear, due to reasons such as change of address by the move, if you can not deliver the prize, you may be allowed to invalidate the winning qualification.
- I have a plan «late April» The shipment of the prize, but there is a case to be mixed up to some extent by circumstances. Please be forewarned.',
			    'prizes' => '350 ml of Coca Cola Zero for 200 winners',
			    'theme' => ($ct == \App\Models\Campaign::_PHOTO || $ct == \App\Models\Campaign::_WRITING || $ct == \App\Models\Campaign::_SAMPLE ? '“Summer Vacation with family ” Give us our best picture with your family. Have fun with it! Ex : Japan trip with family ' : ''),
//			    'settings' => ($ct == \App\Models\Campaign::_QUIZ ? '[{"question":"test question?","choices":[{"value":"a","isCorrect":true},{"value":"b","isCorrect":false}],"type":"multiple","score":3},{"question":"test question2?","choices":[{"value":"c","isCorrect":true},{"value":"d","isCorrect":false}],"type":"single","score":5}]' : ''),
			    'description' => $sponsors[$rSponsor]->attributes['name'] . ' Contest is now opened. JOIN NOW!!'
		    ), true);

		    $settings = array('prizeTypes' => array(
			    'eVoucher' => array(
				    'title' => 'Congratulations on winning!',
				    'description' => 'description something something',
				    'expiryDate' => '1368699931'
			    )
		    ));

		    if ($ct == \App\Models\Campaign::_QUIZ) {
			    $settings = array_merge($settings, array(
				    'questions' => array(
					    array(
						    "question" => "test qustion?",
						    "choices" => array(
							    array("value" => "a", "isCorrect" => true),
							    array("value" => "b", "isCorrect" => false),
						    ),
						    "type" => "multiple",
						    "score" => 3
					    ),
					    array(
						    "question" => "test qustion2?",
						    "choices" => array(
							    array("value" => "c", "isCorrect" => true),
							    array("value" => "d", "isCorrect" => false),
						    ),
						    "type" => "single",
						    "score" => 5
					    ),
				    )
			    ));
		    }

		    if ($ct == \App\Models\Campaign::_WRITING) {
			    $settings = array_merge($settings, array(
				    'maxLetterCount' => rand(500, 10000),
				    'mustUseWords' => array("Bruce Lee", "love", "TIME"),
				    'editorsPicks' => 5,
				    'favoriteWinners' => 5
			    ));
		    }
		    else if($ct == \App\Models\Campaign::_SAMPLE){
			    $settings = array_merge($settings, array(
				    'maxLetterCount' => rand(500, 10000),
				    'editorsPicks' => 5,
				    'favoriteWinners' => 5,
				    'mustUseWords' => array("Bruce Lee", "love", "TIME"),
			    ));
		    }
		    else if($ct == \App\Models\Campaign::_PHOTO){
			    $settings = array_merge($settings, array(
				    'maxLetterCount' => rand(500, 10000),
				    'mustUseWords' => array(),
				    'editorsPicks' => 5,
				    'favoriteWinners' => 5
			    ));
		    }

		    $campaign->attributes["settings"] = json_encode($settings);

		    // only quiz and games can have speed quota so...
		    if (in_array($campaign->attributes['campaignType'], array(\App\Models\Campaign::_QUIZ, \App\Models\Campaign::_GAMES))) {
			     $campaign->attributes['speedQuota'] = rand(0,30);
		    }
		    else {
			    $campaign->attributes['speedQuota'] = 0;
		    }

		    echo "set setting to " . $campaign->attributes['settings'] . "\n";
		    $campaign->save();
		    echo "created campaign ".$campaign->attributes['title']."\n";
		    if ($campaign->attributes['isActive']) {
			    for ($j=0;$j<$maxUsers;$j++) {
				    $userId = $users[$j]->attributes['id'];
				    $campaignEntry = $campaign->createEntry(array(
					    'userId' => $userId,
					    'likes' => rand(0, 100),
					    'createdAt' => $campaign->attributes['createdAt'] + ($j*1000),
					    'isApproved' => rand(0,1)
				    ), false, true);
				    if ($ct == \App\Models\Campaign::_WRITING || $ct == \App\Models\Campaign::_SAMPLE) {
					    $campaignEntry->attributes['content'] = json_encode(array('content' => "if you truly love life, don't waste time; because time is what life is made of - bruce lee"));
				    }
				    else if($ct == \App\Models\Campaign::_PHOTO){
					    $photoUrls = array(
						    '152162724961730',
						    '152163901628279',
						    '156375071207162',
						    '156376687873667',
						    '156594727851863',
						    '152433901601279',
						    '634337306581496',
						    '619064554775438',
						    '616439835037910',
						    '612050338810193',
						    '608220559193171',
						    '608144039200823',
						    '597501350265092',
						    '597442300270997',
						    '593371510678076',
						    '581992891815938'
					    );
					    $campaignEntry->attributes["content"] = json_encode(array(
						    "photoUrl" => $photoUrls[rand(0,count($photoUrls)-1)],
						    "title" => "photo title",
						    "description" => "photo description blablabla"
					    ));
				    }
				    else if($ct == \App\Models\Campaign::_QUIZ){
					    $ans1 = rand(0,1);
					    $ans2 = rand(0,1);
					    $campaignEntry->attributes["content"] = json_encode(array(
						    array("answer" => array($ans1 == 0 ? "a" : "b"), "isCorrect" => $ans1 == 0 ? true : false),
						    array("answer" => array($ans2 == 0 ? "c" : "d"), "isCorrect" => $ans2 == 0 ? true : false)
					    ));
					    $campaignEntry->attributes["score"] = ($ans1 == 0 ? 3 : 0) + ($ans2 == 0 ? 5 : 0);
				    }
				    else if($ct == \App\Models\Campaign::_GIFTS){
//					    $campaignEntry->attributes["code"] = $campaign->createCode();
				    }
					$campaignEntry->save();

				    $saved = rand(0,1);
				    $joined = ($saved ? rand(0,1): 1);
				    $userCampaign = new \App\Models\UserCampaign(array(
					    'userId' => $userId,
					    'campaignId' => $campaign->attributes['id'],
					    'saved' => $saved,
					    'joined' => $joined,
					    'step' => ($ct == \App\Models\Campaign::_GIFTS ? 2 : 3)
				    ), true);
				    $userCampaign->save();

				    echo "created campaign entry " . $campaignEntry->attributes['id'] . "\n";
			    }
		    }
	    }
    }//up()

    public function down()
    {
    }//down()
}
