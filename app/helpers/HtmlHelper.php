<?php
/**
 * Created by Trio Design (trio@tgitriodesign.com).
 * Date: 5/5/13
 * Time: 8:15 AM
 * Description:
 */
namespace App\Helpers;
class HtmlHelper extends BaseHelper
{
	public function tableHeaders($cols) {
		if (!empty($cols)) {
			foreach($cols as $col) {

			}
		}
	}

	public function randomColor() {
		$letters = array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F');
		$color = '#';
		for ($i = 0; $i < 6; $i++ ) {
			$color .= $letters[rand(0,15)];
		}
		return $color;
	}

	public function displayCampaignStatus($campaign) {
		if (is_array($campaign)) {
			$attributes = $campaign;
		}
		else {
			$attributes = $campaign->attributes;
		}
		$status = \App\Models\Campaign::model()->getStatusFromAttributes($attributes);

		if ($status == \App\Models\Campaign::STATUS_NEAR_END || $status == \App\Models\Campaign::STATUS_PENDING_REVIEW || $status == \App\Models\Campaign::STATUS_END) {
			if ($status == \App\Models\Campaign::STATUS_NEAR_END) {
				$status = app()->helper('TimeHelper')->timeLeft($attributes['endDate']).' left';
			}
			$status = '<div class="label label-important">'.$status.'</div>';
		}
		elseif ($status == \App\Models\Campaign::STATUS_ANNOUNCED || $status == \App\Models\Campaign::STATUS_CANCELLED) {
			$status = '<div class="label label-default">'.$status.'</div>';
		}
		else {
			$status = '<div class="label label-info">'.$status.'</div>';
		}
		return $status;
	}
}
