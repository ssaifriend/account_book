<?php
declare(strict_types=1);

namespace AccountBook\CarRecord;

class CarRecordService
{
    public static function getRecord(int $record_id): CarRecordDto
    {
        return CarRecordModel::create()->getRecord($record_id);
    }

    public static function getRecordsByYear(int $year): array
    {
        return CarRecordModel::create()->getRecordsByYear($year);
    }

    public static function insert(CarRecordDto $record_dto)
    {
        return CarRecordModel::create()->insert($record_dto);
    }

    public static function update(CarRecordDto $record_dto)
    {
        return CarRecordModel::create()->update($record_dto);
    }

    public static function delete(int $record_id)
    {
        return CarRecordModel::create()->delete($record_id);
    }

    public static function getMonthStats()
    {
        return CarRecordModel::create()->getMonthStats();
    }
}
