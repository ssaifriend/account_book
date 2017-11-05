<?php
declare(strict_types=1);

namespace AccountBook\Record;

use AccountBook\Common\BaseDto;
use Symfony\Component\HttpFoundation\Request;

class AccountRecordDto extends BaseDto
{
    /** @var int */
    public $id;
    /** @var string */
    public $date;
    /** @var int */
    public $group_id;
    /** @var string */
    public $use_date;
    /** @var string */
    public $use_place;
    /** @var string */
    public $pay_type;
    /** @var int */
    public $pay_price;
    /** @var int */
    public $use_price;
    /** @var int */
    public $discount;

    public static function importFromDatabase(array $dict): self
    {
        $dto = new self;
        $dto->id = intval($dict['nSeqNo']);
        $dto->date = $dict['vcDate'];
        $dto->group_id = intval($dict['nGroup']);
        $dto->use_date = $dict['dtUseDate'];
        $dto->use_place = $dict['vcUse'];
        $dto->pay_type = $dict['vcBank'];
        $dto->pay_price = intval($dict['nPrice']);
        $dto->use_price = intval($dict['nUse']);
        $dto->discount = intval($dict['nEtc']);

        return $dto;
    }

    public static function importFromCsv(array $data): self
    {
        $dto = new self;
        $dto->use_date = $data['이용일'];
        $dto->use_place = $data['사용처'];
        $dto->pay_type = $data['지불수단'];

        if (isset($data['결제금액'])) {
            $dto->pay_price = intval($data['결제금액']);
        }
        if (isset($data['이용금액'])) {
            $dto->use_price = intval($data['이용금액']);
        }

        if (isset($data['할인/수수료'])) {
            $dto->discount = intval($data['할인/수수료']);
        } elseif (isset($data['할인'])) {
            $dto->discount = intval($data['할인']);
        } elseif (isset($data['수수료'])) {
            $dto->discount = intval($data['수수료']);
        }

        return $dto;
    }

    public static function importFromRequest(Request $request): self
    {
        $dto = new self;
        $dto->id = $request->request->get('id');
        $dto->date = $request->request->get('date');
        $dto->group_id = intval($request->request->get('group_id'));
        $dto->use_date = $request->request->get('use_date');
        $dto->use_place = $request->request->get('use_place');
        $dto->pay_type = $request->request->get('pay_type');
        $dto->pay_price = intval($request->request->get('pay_price'));
        $dto->use_price = intval($request->request->get('use_price'));
        $dto->discount = intval($request->request->get('discount'));

        return $dto;
    }

    public function exportToDatabase(): array
    {
        $dict = [
            'nSeqNo' => $this->id,
            'vcDate' => $this->date,
            'nGroup' => $this->group_id,
            'dtUseDate' => $this->use_date,
            'vcUse' => $this->use_place,
            'vcBank' => $this->pay_type,
            'nPrice' => $this->pay_price,
            'nUse' => $this->use_price,
            'nEtc' => $this->discount,
        ];

        return array_filter($dict);
    }
}
