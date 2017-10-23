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
}
