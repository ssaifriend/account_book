<?php
declare(strict_types=1);

namespace AccountBook\Group;

class GroupService
{
    public static function getGroups(): array
    {
        return AccountGroupModel::create()->getGroups();
    }

    public static function insertGroup(string $name)
    {
        AccountGroupModel::create()->insert($name);
    }

    public static function updateGroup(int $group_id, string $name)
    {
        AccountGroupModel::create()->update($group_id, $name);
    }

    public static function deleteGroup(int $group_id)
    {
        AccountGroupModel::create()->delete($group_id);
    }
}
