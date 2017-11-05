<?php
declare(strict_types=1);

namespace AccountBook\GroupFilter;

class AccountFilterService
{
    public static function getFilters(): array
    {
        return AccountFilterModel::create()->getFilters();
    }

    public static function insert(GroupFilterDto $filter_dto)
    {
        return AccountFilterModel::create()->insert($filter_dto);
    }

    public static function update(GroupFilterDto $filter_dto)
    {
        return AccountFilterModel::create()->update($filter_dto);
    }

    public static function delete(int $filter_id)
    {
        return AccountFilterModel::create()->delete($filter_id);
    }
}
