<?php
declare(strict_types=1);

namespace AccountBook\Record;

use AccountBook\GroupFilter\GroupFilterDto;
use AccountBook\GroupFilter\AccountFilterModel;

class AccountRecordService
{
    private static $filters;

    public static function getRecordsByDate(string $date): array
    {
        return AccountDataModel::create()->getPayRecordsByDate($date);
    }

    public static function getRecord(int $record_id): AccountRecordDto
    {
        return AccountDataModel::create()->getPayRecord($record_id);
    }

    public static function multiInsert(string $date, array $header, array $datas)
    {
        $replace_comma_header = ['결제금액', '이용금액', '할인/수수료', '할인', '수수료'];
        $convert_dtos = function (array $data) use ($header, $replace_comma_header) {
            $header_to_data = [];
            foreach ($data as $index => $value) {
                $header_to_data[$header[$index]] = $value;
            }
            foreach ($replace_comma_header as $header_key) {
                if (isset($header_to_data[$header_key])) {
                    $header_to_data[$header_key] = str_replace(',', '', $header_to_data[$header_key]);
                }
            }

            return AccountRecordDto::importFromCsv($header_to_data);
        };

        $set_group = function (AccountRecordDto $dto) {
            self::setGroupUsingFilter($dto);
        };

        $set_date = function (AccountRecordDto $dto) use ($date) {
            $dto->date = $date;
        };

        $dicts = collect($datas)->map($convert_dtos)->each($set_group)->each($set_date)->map->exportToInsert();

        AccountDataModel::create()->multiInsert($dicts);
    }

    public static function setGroupUsingFilter(AccountRecordDto $pay_record_dto)
    {
        if (self::$filters === null) {
            self::$filters = AccountFilterModel::create()->getFilters();
        }
        /** @var GroupFilterDto $filter */
        foreach (self::$filters as $filter) {
            if (strpos($pay_record_dto->use_place, $filter->pattern) !== false) {
                $pay_record_dto->group_id = $filter->group_id;
            }
        }
    }

    public static function singleInsert(AccountRecordDto $record_dto)
    {
        if (empty($record_dto->group_id)) {
            self::setGroupUsingFilter($record_dto);
        }
        AccountDataModel::create()->insert($record_dto);
    }

    public static function updateRecord(AccountRecordDto $record_dto)
    {
        AccountDataModel::create()->update($record_dto);
    }

    public static function deleteRecord(int $record_id)
    {
        AccountDataModel::create()->delete($record_id);
    }

    public static function updateGroupId(int $record_id, int $group_id)
    {
        AccountDataModel::create()->updateGroupId($record_id, $group_id);
    }

    public static function deleteMonth(string $date)
    {
        AccountDataModel::create()->deleteMonth($date);
    }
}
