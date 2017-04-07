<?php
declare(strict_types=1);

namespace AccountBook\Payment\Model;

use AccountBook\Common\BaseModel;
use AccountBook\Payment\Dto\PayRecordDto;

class PayRecordModel extends BaseModel
{
	public function getPayRecord(int $record_id)
	{
		$dict = $this->db->sqlDict('SELECT * FROM pay_record WHERE id = ?', sqlWhere(['id' => $record_id]));

		if ($dict === null) {
			return PayRecordDto::importEmptyObject();
		} else {
			return PayRecordDto::importFromDatabase($dict);
		}
	}
}
