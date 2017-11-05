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

    public function insert(string $name)
    {
        $this->db->sqlInsert('account_group', ['vcName' => $name]);
    }

    public function update(int $group_id, string $name)
    {
        $this->db->sqlUpdate('account_group', ['vcName' => $name], ['nSeqNo' => $group_id]);
    }

    public function delete(int $group_id)
    {
        $this->db->sqlDelete('account_group', ['nSeqNo' => $group_id]);
    }
}
