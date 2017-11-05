<?php
declare(strict_types=1);

namespace AccountBook\GroupFilter;

use AccountBook\Common\BaseModel;

class AccountFilterModel extends BaseModel
{
    public function getFilters(): array
    {
        $dicts = $this->db->sqlDicts('SELECT * FROM account_filter');
        $dtos = [];
        foreach ($dicts as $dict) {
            $dtos[] = GroupFilterDto::importFromDatabase($dict);
        }

        return $dtos;
    }

    public function insert(GroupFilterDto $filter_dto)
    {
        $this->db->sqlInsert('account_filter', $filter_dto->exportToDatabase());
    }

    public function update(GroupFilterDto $filter_dto)
    {
        $this->db->sqlUpdate('account_filter', $filter_dto->exportToDatabase(), ['nSeqNo' => $filter_dto->id]);
    }

    public function delete(int $filter_id)
    {
        $this->db->sqlDelete('account_filter', ['nSeqNo' => $filter_id]);
    }
}
