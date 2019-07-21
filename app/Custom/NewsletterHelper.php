<?php

namespace App\Custom;

use App\User;

use ConvertKit\ConvertKit;

class NewsletterHelper {

	$ck = new ConvertKit(env('CONVERT_KIT_API_KEY'), env('rDFmqYZWpoSfiTLIGEMhhRrpAYSKSNhbHkYn_lK-c1U'));

	public static function getSequences() {
		return json_encode($ck->sequence()->showall());
	}

	public static function getSubscribers() {
		return json_encode($ck->subscriber()->showall());
	}

	public static function getSubscriberDetails($subscriber_id) {
		return json_encode($ck->subscriber($subscriberId)->view());
	}

	public static function getTags() {
		$data = $ck->api('tag/showall');
		$tags = array();
		foreach($data as $tag) {
			array_push($tags, $tag);
		}

		return json_encode($tags);
	}

	public static function addSubscriber($email, $sequence_id) {
		$subscriber_data = array(
			'email' => $email
		);

		$subscriber = $ck->subscriber();
		$request = $subscriber->addToCourse($courseId, $subscriberData);

		return json_encode($request);
	}

	public static function removeTag($subsriber_id, $tag_id) {
		return json_encode($ck->subscriber($subscriber_id)->removeTag($tag_id));
	}

	public static function addTag($email, $tag_id) {
		$subscriberData = array(
			'email' => $email
		);

		$ck->tag($tag_id)->addToSubscriber($subscriberData);
	}

}

?>