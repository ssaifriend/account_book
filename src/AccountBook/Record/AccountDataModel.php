<?php
declare(strict_types=1);

namespace AccountBook\Record;

use AccountBook\Common\BaseModel;

class AccountDataModel extends BaseModel
{
	public function getPayRecord(int $record_id)
	{
		$dict = $this->db->sqlDict('SELECT * FROM account_data WHERE ?', sqlWhere(['nSeqNo' => $record_id]));

		if ($dict === null) {
			return AccountRecordDto::importEmptyObject();
		} else {
			return AccountRecordDto::importFromDatabase($dict);
		}
	}

	public function getPayRecordsByDate(string $date): array
    {
        $where = ['vcDate' => $date];
        $dicts = $this->db->sqlDicts('SELECT * FROM account_data WHERE ? ORDER BY nSeqNo ASC', sqlWhere($where));
        $dtos = [];
        foreach ($dicts as $dict) {
            $dtos[] = AccountRecordDto::importFromDatabase($dict);
        }

        return $dtos;
    }

    public function insert(AccountRecordDto $pay_record_dto)
    {
        $dict = array_filter($pay_record_dto->exportToDatabase());
        $this->db->sqlInsert('account_data', $dict);
    }

    public function multiInsert(array $dicts)
    {
        $keys = array_keys($dicts[0]);
        $this->db->sqlInsertBulk('account_data', $keys, $dicts);
    }

    public function update(AccountRecordDto $pay_record_dto)
    {
        $dict = $pay_record_dto->exportToDatabase();
        $this->db->sqlUpdate('account_data', $dict, ['nSeqNo' => $dict['nSeqNo']]);
    }

    public function delete(int $record_id)
    {
        $this->db->sqlDelete('account_data', ['nSeqNo' => $record_id]);
    }

    public function updateGroupId(int $record_id, int $group_id)
    {
        $this->db->sqlUpdate('account_data', ['nGroup' => $group_id], ['nSeqNo' => $record_id]);
    }

    public function deleteMonth(string $date)
    {
        $this->db->sqlDelete('account_data', ['vcDate' => $date]);
    }
}
