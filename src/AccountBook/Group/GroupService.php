<?php
declare(strict_types=1);

namespace AccountBook\Group;

class GroupService
{
    public static function getGroups(): array
    {
        return AccountGroupModel::create()->getGroups();
    }
}
