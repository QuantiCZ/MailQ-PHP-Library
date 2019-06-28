<?php

namespace MailQ\Entities\v2;

use MailQ\Entities\BaseEntity;

/**
 * @property integer $id
 * @property \DateTime $undelivered
 * @property string $postfixMessage 
 * @property \DateTime $openedTimestamp
 * @property string $recipientEmail
 * @property string $replyToEmail
 * @property array $bcc
 * @property array $cc
 * @property array $data
 * @property AttachmentEntity[] $attachments
 */
class NotificationDataEntity extends BaseEntity {

   
    /**
     * @in
     * @out
     * @var integer 
     */
    private $id;
    /**
     * @in undeliveredTimestamp
     * @out undeliveredTimestamp
     * @var \DateTime
     */
    private $undelivered;
    /**
     * @in
     * @out
     * @var string 
     */
    private $postfixMessage;   
    /**
     * @in openedTimestamp
     * @out openedTimestamp
     * @var \DateTime
     */
    private $opened;   
    /**
     * @in
     * @out
     * @var string
     */
    private $recipientEmail;
    /**
     * @in
     * @out
     * @var string
     */
    private $replyToEmail;
    /**
     * @in
     * @out
     * @var array
     */
    private $bcc;
    /**
     * @in
     * @out
     * @var array
     */
    private $cc;
    /**
     * @in
     * @out
     * @var array 
     */
    private $data;
    /**
     * @in
     * @out
     * @var AttachmentEntity
     * @collection 
     */
    private $attachments;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return NotificationDataEntity
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }


    /**
     * @return null|string
     */
    public function getUndelivered()
    {
        if ($this->undelivered != null) {
            return $this->undelivered->format(DATE_ATOM);
        } else {
            return null;
        }
    }
   

    public function getUndeliveredAsDateTime() {
        return $this->undelivered;
    }   
   
    /**
     * @param string $postfixMessage
     * @return NotificationDataEntity
     */
    public function setPostfixMessage($postfixMessage)
    {
        $this->postfixMessage = $postfixMessage;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostfixMessage()
    {
        return $this->postfixMessage;
    }   
   
    /**
     * @return null|string
     */
    public function getOpened()
    {
        if ($this->opened != null) {
            return $this->opened->format(DATE_ATOM);
        } else {
            return null;
        }
    }   

    public function getOpenedAsDateTime() {
        return $this->opened;
    }

    /**
     * @param $undelivered
     * @return NotificationDataEntity
     */
    public function setUndelivered($undelivered)
    {
        if (is_string($undelivered)) {
            $this->undelivered = \DateTime::createFromFormat(DATE_ATOM, $undelivered);
        } elseif ($undelivered instanceof \DateTime) {
            $this->undelivered = $undelivered;
        }
        return $this;
    }
   
    /**
     * @param $undelivered
     * @return NotificationDataEntity
     */
    public function setOpened($opened)
    {
        if (is_string($opened)) {
            $this->opened = \DateTime::createFromFormat(DATE_ATOM, $opened);
        } elseif ($opened instanceof \DateTime) {
            $this->opened = $opened;
        }
        return $this;
    }   


    /**
     * @return string
     */
    public function getRecipientEmail()
    {
        return $this->recipientEmail;
    }

    /**
     * @param string $recipientEmail
     * @return NotificationDataEntity
     */
    public function setRecipientEmail($recipientEmail)
    {
        $this->recipientEmail = $recipientEmail;
        return $this;
    }

    /**
     * @return string
     */
    public function getReplyToEmail()
    {
        return $this->replyToEmail;
    }

    /**
     * @param string $replyToEmail
     * @return NotificationDataEntity
     */
    public function setReplyToEmail($replyToEmail)
    {
        $this->replyToEmail = $replyToEmail;
        return $this;
    }

    /**
     * @return array
     */
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * @param array $bcc
     * @return NotificationDataEntity
     */
    public function setBcc($bcc)
    {
        $this->bcc = $bcc;
        return $this;
    }

    /**
     * @return array
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * @param array $cc
     * @return NotificationDataEntity
     */
    public function setCc($cc)
    {
        $this->cc = $cc;
        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return NotificationDataEntity
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return AttachmentEntity[]
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * @param AttachmentEntity[] $attachments
     * @return NotificationDataEntity
     */
    public function setAttachments($attachments)
    {
        $this->attachments = $attachments;
        return $this;
    }



    
    
    

    


}
