<?php

namespace MailQ\Entities\v2;

use MailQ\Entities\BaseEntity;

/**
 * @property SmsEntity[] $batch
 */
class SmsBatchEntity extends BaseEntity
{


	/**
	 * @in
	 * @out
	 * @var SmsEntity[]
	 * @collection
	 */
	private $batch;

	/**
	 * @return SmsEntity[]
	 */
	public function getBatch()
	{
		return $this->batch;
	}

	/**
	 * @param SmsEntity[] $batch
	 * @return SmsBatchEntity
	 */
	public function setBatch($batch)
	{
		$this->batch = $batch;
		return $this;
	}


}
