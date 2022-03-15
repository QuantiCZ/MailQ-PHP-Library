<?php

namespace MailQ\Entities\v2;

use MailQ\Entities\BaseEntity;

/**
 * @property RecipientEntity[] $recipients
 */
class RecipientsEntity extends BaseEntity
{


	/**
	 * @in
	 * @out
	 * @var RecipientEntity[]
	 * @collection
	 */
	private $recipients;

	/**
	 * @return RecipientEntity[]
	 */
	public function getRecipients()
	{
		return $this->recipients;
	}

	/**
	 * @param RecipientEntity[] $recipients
	 * @return RecipientsEntity
	 */
	public function setRecipients($recipients)
	{
		$this->recipients = $recipients;
		return $this;
	}


}
