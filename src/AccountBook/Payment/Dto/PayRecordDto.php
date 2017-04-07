<?php
declare(strict_types=1);

namespace AccountBook\Payment\Dto;

use AccountBook\Common\BaseDto;

class PayRecordDto extends BaseDto
{
	/** @var int */
	public $id;
	/** @var string */
	public $date;
	/** @var int */
	public $group_id;
	/** @var string */
	public $use_date;
	/** @var string */
	public $use_place;
	/** @var string */
	public $pay_type;
	/** @var int */
	public $pay_price;
	/** @var int */
	public $use_price;
	/** @var int */
	public $discount;

	public static function importFromDatabase(array $dict): self
	{
		$dto = new self;
		$dto->id = intval($dict['id']);
		$dto->date = $dict['date'];
		$dto->group_id = intval($dict['group_id']);
		$dto->use_date = $dict['use_date'];
		$dto->use_place = $dict['use_place'];
		$dto->pay_type = $dict['pay_type'];
		$dto->pay_price = intval($dict['pay_price']);
		$dto->use_price = intval($dict['use_price']);
		$dto->discount = intval($dict['discount']);

		return $dto;
	}
}
