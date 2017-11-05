<?php
declare(strict_types=1);

namespace AccountBook\CarRecord;

use AccountBook\Common\BaseModel;

class CarRecordModel extends BaseModel
{
    public function getRecord(int $record_id): CarRecordDto
    {
        $dict = $this->db->sqlDict('SELECT * FROM car_data WHERE ?', sqlWhere(['nSeqNo' => $record_id]));

        if ($dict === null) {
            return CarRecordDto::importEmptyObject();
        } else {
            return CarRecordDto::importFromDatabase($dict);
        }
    }

    public function getRecordsByYear(int $year): array
    {
        $where = [
            'dtUseDate' => sqlBetween($year . '-01-01', $year . '-12-31'),
        ];

        $dicts = $this->db->sqlDicts('SELECT * FROM car_data WHERE ? ORDER BY dtUseDate DESC', sqlWhere($where));
        $dtos = [];
        foreach ($dicts as $dict) {
            $dtos[] = CarRecordDto::importFromDatabase($dict);
        }

        return $dtos;
    }

    public function insert(CarRecordDto $record_dto)
    {
        $this->db->sqlInsert('car_data', $record_dto->exportToDatabase());
    }

    public function update(CarRecordDto $record_dto)
    {
        $where = ['nSeqNo' => $record_dto->id];
        $this->db->sqlUpdate('car_data', $record_dto->exportToDatabase(), $where);
    }

    public function delete(int $record_id)
    {
        $this->db->sqlDelete('car_data', ['nSeqNo' => $record_id]);
    }

    public function getMonthStats(): array
    {
        return $this->db->sqlDicts(
            'SELECT
              year(dtUseDate) as year,
              month(dtUseDate) as month,
              sum(nKm) as nKm,
              sum(nLitter) as nLitter,
              sum(nTotal) as nTotal,
              count(*) as cnt
            FROM car_data
            GROUP BY year(dtUseDate), month(dtUseDate)
            ORDER BY year(dtUseDate) desc, month(dtUseDate) desc'
        );
    }
}
