<?php

namespace MailQ\Entities\v2;

use MailQ\Entities\BaseEntity;

/**
 * @property string $id
 * @property string $email
 * @property \DateTime $unsubscribed
 * @property string $action
 * @property LinkEntity[] $recipientsList
 * @property LinkEntity $company
 */
class UnsubscriberEntity extends BaseEntity
{


	/**
	 * @in
	 * @out
	 * @var string
	 */
	private $id;

	/**
	 * @in
	 * @out
	 * @var string
	 */
	private $email;

	/**
	 * @in
	 * @out
	 * @var \DateTime
	 */
	private $unsubscribed;

	/**
	 * @in
	 * @out
	 * @var string
	 */
	private $action;

	/**
	 * @in
	 * @out
	 * @var LinkEntity[]
	 * @collection
	 */
	private $recipientsList;

	/**
	 * @in
	 * @out
	 * @var LinkEntity
	 */
	private $company;

	/**
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param string $id
	 * @return UnsubscriberEntity
	 */
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @param string $email
	 * @return UnsubscriberEntity
	 */
	public function setEmail($email)
	{
		$this->email = $email;
		return $this;
	}
	
	/**
	 * @return null|string
	 */
	public function getUnsubscribed()
	{
		if ($this->unsubscribed != null) {
			return $this->unsubscribed->format(DATE_ATOM);
		} else {
			return null;
		}
	}

	/**
	 * @return \DateTime
	 */
	public function getUnsubscribedAsDateTime() {
		return $this->unsubscribed;
	}


	/**
	 * @param $unsubscribed
	 * @return UnsubscriberEntity
	 */
	public function setUnsubscribed($unsubscribed)
	{
		if (is_string($unsubscribed)) {
			$this->unsubscribed = \DateTime::createFromFormat(DATE_ATOM, $unsubscribed);
		} elseif ($unsubscribed instanceof \DateTime) {
			$this->unsubscribed = $unsubscribed;
		}
		return $this;
	}

	/**
	 * @return string
	 */
	public function getAction()
	{
		return $this->action;
	}

	/**
	 * @param string $action
	 * @return UnsubscriberEntity
	 */
	public function setAction($action)
	{
		$this->action = $action;
		return $this;
	}

	/**
	 * @return LinkEntity[]
	 */
	public function getRecipientsList()
	{
		return $this->recipientsList;
	}

	/**
	 * @param LinkEntity[] $recipientsList
	 * @return UnsubscriberEntity
	 */
	public function setRecipientsList($recipientsList)
	{
		$this->recipientsList = $recipientsList;
		return $this;
	}

	/**
	 * @return LinkEntity
	 */
	public function getCompany()
	{
		return $this->company;
	}

	/**
	 * @param LinkEntity $company
	 * @return UnsubscriberEntity
	 */
	public function setCompany($company)
	{
		$this->company = $company;
		return $this;
	}


}
