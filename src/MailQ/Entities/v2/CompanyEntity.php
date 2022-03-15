<?php

namespace MailQ\Entities\v2;

use MailQ\Entities\BaseEntity;

/**
 * @property integer $id
 * @property string $name
 * @property string $apiKey
 * @property string $defaultSendAs
 * @property string $defaultSenderEmail
 * @property LinkEntity[] $users
 * @property LinkEntity[] $senderEmails
 * @property LinkEntity[] $recipientsLists
 */
class CompanyEntity extends BaseEntity
{

	/**
	 * @in
	 * @out
	 * @var integer
	 */
	private $id;

	/**
	 * @in
	 * @out
	 * @var string
	 */
	private $name;

	/**
	 * @in
	 * @out
	 * @var string
	 */
	private $apiKey;

	/**
	 * @in
	 * @out
	 * @var string
	 */
	private $defaultSendAs;

	/**
	 * @in
	 * @out
	 * @var string
	 */
	private $defaultSenderEmail;

	/**
	 * @in
	 * @out
	 * @var LinkEntity[]
	 * @collection
	 */
	private $users;

	/**
	 * @in
	 * @out
	 * @var LinkEntity[]
	 * @collection
	 */
	private $senderEmails;

	/**
	 * @in
	 * @out recipientLists
	 * @var LinkEntity[]
	 * @collection
	 */
	private $recipientsLists;

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 * @return CompanyEntity
	 */
	public function setId($id)
	{
		$this->id = $id;
        	return $this;
	}	
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 * @return CompanyEntity
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getApiKey()
	{
		return $this->apiKey;
	}

	/**
	 * @param string $apiKey
	 * @return CompanyEntity
	 */
	public function setApiKey($apiKey)
	{
		$this->apiKey = $apiKey;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDefaultSendAs()
	{
		return $this->defaultSendAs;
	}

	/**
	 * @param string $defaultSendAs
	 * @return CompanyEntity
	 */
	public function setDefaultSendAs($defaultSendAs)
	{
		$this->defaultSendAs = $defaultSendAs;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDefaultSenderEmail()
	{
		return $this->defaultSenderEmail;
	}

	/**
	 * @param string $defaultSenderEmail
	 * @return CompanyEntity
	 */
	public function setDefaultSenderEmail($defaultSenderEmail)
	{
		$this->defaultSenderEmail = $defaultSenderEmail;
		return $this;
	}

	/**
	 * @return LinkEntity[]
	 */
	public function getUsers()
	{
		return $this->users;
	}

	/**
	 * @param LinkEntity[] $users
	 * @return CompanyEntity
	 */
	public function setUsers($users)
	{
		$this->users = $users;
		return $this;
	}

	/**
	 * @return LinkEntity[]
	 */
	public function getSenderEmails()
	{
		return $this->senderEmails;
	}

	/**
	 * @param LinkEntity $senderEmails
	 * @return CompanyEntity
	 */
	public function setSenderEmails($senderEmails)
	{
		$this->senderEmails = $senderEmails;
		return $this;
	}

	/**
	 * @return LinkEntity[]
	 */
	public function getRecipientsLists()
	{
		return $this->recipientsLists;
	}

	/**
	 * @param LinkEntity $recipientsLists
	 * @return CompanyEntity
	 */
	public function setRecipientsLists($recipientsLists)
	{
		$this->recipientsLists = $recipientsLists;
		return $this;
	}
    

}
