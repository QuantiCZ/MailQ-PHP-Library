<?php

namespace MailQ\Entities\v2;

use MailQ\Entities\BaseEntity;

/**
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property string $subject
 * @property string $sendAs
 * @property string $senderEmail
 * @property string $replyTo
 * @property bool $unlimited
 * @property integer $recipientsListId
 * @property integer $dataPersistence
 * @property string $campaign
 * @property string $templateUrl
 * @property string $template
 * @property string $tags
 * @property string $unsubscribeTemplateUrl
 * @property string $text
 */
class PreparedNewsletterEntity extends BaseEntity {

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
    private $code;

    /**
     * @in
     * @out
     * @var string 
     */
    private $subject;

    /**
     * @in
     * @out
     * @var string 
     */
    private $sendAs;

    /**
     * @in
     * @out
     * @var string 
     */
    private $senderEmail;


	/**
	 * @in
	 * @out replyToEmail
	 * @var string
	 */
	private $replyTo;


	/**
     * @in
     * @out
     * @var bool 
     */
    private $unlimited;
	
	/**
     * @in
     * @out
     * @var integer 
     */
    private $dataPersistence;

    /**
     * @in
     * @out
     * @var string 
     */
    private $campaign;
	
    /**
     * @in
     * @out
     * @var string 
     */
    private $templateUrl;

	/**
	 * @in
	 * @out
	 * @var string
	 */
	private $template;

	/**
	 * @in
	 * @out
	 * @var TagEntity[]
	 * @collection
	 */
	private $tags;

    /**
     * @in
     * @out
     * @var string 
     */
    private $unsubscribeTemplateUrl;
	
	/**
	 * @in
     * @out
	 * @var string 
	 */
	private $text;
    
    
	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 * @return PreparedNewsletterEntity
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
	 * @return PreparedNewsletterEntity
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getCode()
	{
		return $this->code;
	}

	/**
	 * @param string $code
	 * @return PreparedNewsletterEntity
	 */
	public function setCode($code)
	{
		$this->code = $code;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getSubject()
	{
		return $this->subject;
	}

	/**
	 * @param string $subject
	 * @return PreparedNewsletterEntity
	 */
	public function setSubject($subject)
	{
		$this->subject = $subject;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getSendAs()
	{
		return $this->sendAs;
	}

	/**
	 * @param string $sendAs
	 * @return PreparedNewsletterEntity
	 */
	public function setSendAs($sendAs)
	{
		$this->sendAs = $sendAs;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getSenderEmail()
	{
		return $this->senderEmail;
	}

	/**
	 * @param string $senderEmail
	 * @return PreparedNewsletterEntity
	 */
	public function setSenderEmail($senderEmail)
	{
		$this->senderEmail = $senderEmail;
		return $this;
	}

	/**
	 * @return boolean
	 */
	public function isUnlimited()
	{
		return $this->unlimited;
	}

	/**
	 * @param boolean $unlimited
	 * @return PreparedNewsletterEntity
	 */
	public function setUnlimited($unlimited)
	{
		$this->unlimited = $unlimited;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getDataPersistence()
	{
		return $this->dataPersistence;
	}

	/**
	 * @param int $dataPersistence
	 * @return PreparedNewsletterEntity
	 */
	public function setDataPersistence($dataPersistence)
	{
		$this->dataPersistence = $dataPersistence;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getCampaign()
	{
		return $this->campaign;
	}

	/**
	 * @param string $campaign
	 * @return PreparedNewsletterEntity
	 */
	public function setCampaign($campaign)
	{
		$this->campaign = $campaign;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getTemplateUrl()
	{
		return $this->templateUrl;
	}

	/**
	 * @param string $templateUrl
	 * @return PreparedNewsletterEntity
	 */
	public function setTemplateUrl($templateUrl)
	{
		$this->templateUrl = $templateUrl;
		return $this;
	}

    /**
     * @return string
     */
    public function getUnsubscribeTemplateUrl()
    {
        return $this->unsubscribeTemplateUrl;
    }

    /**
     * @param string $unsubscribeTemplateUrl
     * @return PreparedNewsletterEntity
     */
    public function setUnsubscribeTemplateUrl($unsubscribeTemplateUrl)
    {
        $this->unsubscribeTemplateUrl = $unsubscribeTemplateUrl;
        return $this;
    }

	/**
	 * @return string
	 */
	public function getText()
	{
		return $this->text;
	}

	/**
	 * @param string $text
	 * @return PreparedNewsletterEntity
	 */
	public function setText($text)
	{
		$this->text = $text;
		return $this;
	}


	/**
	 * @return string
	 */
	public function getReplyTo()
	{
		return $this->replyTo;
	}

	/**
	 * @param string $replyTo
	 * @return PreparedNewsletterEntity
	 */
	public function setReplyTo($replyTo)
	{
		$this->replyTo = $replyTo;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getTemplate()
	{
		return $this->template;
	}

	/**
	 * @param string $template
	 * @return PreparedNewsletterEntity
	 */
	public function setTemplate($template)
	{
		$this->template = $template;
		return $this;
	}

	/**
	 * @return TagEntity[]
	 */
	public function getTags()
	{
		return $this->tags;
	}

	/**
	 * @param string $tags
	 * @return PreparedNewsletterEntity
	 */
	public function setTags($tags)
	{
		$this->tags = $tags;
		return $this;
	}





}
