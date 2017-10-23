<?php
declare(strict_types=1);

namespace AccountBook\Group;

use AccountBook\Common\BaseModel;

class AccountGroupModel extends BaseModel
{
    public function getGroups(): array
    {
        return $this->db->sqlDicts('SELECT * FROM account_group');
    }
}
