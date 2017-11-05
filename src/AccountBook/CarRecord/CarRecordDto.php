<?php
declare(strict_types=1);

namespace AccountBook\CarRecord;

use AccountBook\Common\BaseDto;
use Symfony\Component\HttpFoundation\Request;

class CarRecordDto extends BaseDto
{
    public $id;
    public $use_date;
    public $litter;
    public $distance;
    public $price_per_unit;
    public $total_price;

    public static function importFromDatabase(array $dict): self
    {
        $dto = new self;
        $dto->id = intval($dict['nSeqNo']);
        $dto->use_date = $dict['dtUseDate'];
        $dto->litter = floatval($dict['nLitter']);
        $dto->distance = floatval($dict['nKm']);
        $dto->price_per_unit = intval($dict['nPrice']);
        $dto->total_price = intval($dict['nTotal']);

        return $dto;
    }

    public static function importFromRequest(Request $request): self
    {
        $dto = new self;
        $dto->id = intval($request->request->get('id'));
        $dto->use_date = $request->request->get('use_date');
        $dto->litter = floatval($request->request->get('litter'));
        $dto->distance = floatval($request->request->get('distance'));
        $dto->price_per_unit = intval($request->request->get('price_per_unit'));
        $dto->total_price = intval($request->request->get('total_price'));

        return $dto;
    }

    public function exportToDatabase(): array
    {
        return [
            'dtUseDate' => $this->use_date,
            'nLitter' => $this->litter,
            'nKm' => $this->distance,
            'nPrice' => $this->price_per_unit,
            'nTotal' => $this->total_price,
        ];
    }
}
