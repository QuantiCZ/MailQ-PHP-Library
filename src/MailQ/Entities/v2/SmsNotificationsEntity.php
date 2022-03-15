<?php

namespace MailQ\Entities\v2;

use MailQ\Entities\BaseEntity;

/**
 * @property SmsNotificationEntity[] $smsNotifications
 */
class SmsNotificationsEntity extends BaseEntity
{


	/**
	 * @in
	 * @out
	 * @var SmsNotificationEntity[]
	 * @collection
	 */
	private $smsNotifications;

	/**
	 * @return SmsNotificationEntity[]
	 */
	public function getSmsNotifications()
	{
		return $this->smsNotifications;
	}

	/**
	 * @param SmsNotificationEntity[] $smsNotifications
	 * @return SmsNotificationsEntity
	 */
	public function setSmsNotifications($smsNotifications)
	{
		$this->smsNotifications = $smsNotifications;
		return $this;
	}


}
