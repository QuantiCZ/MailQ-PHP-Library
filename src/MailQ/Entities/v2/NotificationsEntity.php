<?php

namespace MailQ\Entities\v2;

use MailQ\Entities\BaseEntity;

/**
 * @property NotificationEntity[] $notifications
 */
class NotificationsEntity extends BaseEntity
{


	/**
	 * @in
	 * @out
	 * @var NotificationEntity[]
	 * @collection
	 */
	private $notifications;

	/**
	 * @return NotificationEntity[]
	 */
	public function getNotifications()
	{
		return $this->notifications;
	}

	/**
	 * @param NotificationEntity[] $notifications
	 * @return NotificationsEntity
	 */
	public function setNotifications($notifications)
	{
		$this->notifications = $notifications;
		return $this;
	}
    

}
