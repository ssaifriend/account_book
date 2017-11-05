<?php
declare(strict_types=1);

namespace AccountBook\Controller;

use AccountBook\CarRecord\CarRecordDto;
use AccountBook\CarRecord\CarRecordService;
use AccountBook\Common\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;

class CardataController extends BaseController
{
    public function index(): array
    {
        return [];
    }

    public function getList(): JsonResponse
    {
        $year = intval($this->request->query->get('year'));
        $records = CarRecordService::getRecordsByYear($year);

        return JsonResponse::create($records);
    }

    public function getRecord(): JsonResponse
    {
        $record_id = intval($this->request->query->get('nSeqNo'));
        $record = CarRecordService::getRecord($record_id);

        return JsonResponse::create($record);
    }

    public function insertRecord(): JsonResponse
    {
        $record_dto = CarRecordDto::importFromRequest($this->request);
        CarRecordService::insert($record_dto);

        return JsonResponse::create();
    }

    public function updateRecord(): JsonResponse
    {
        $record_dto = CarRecordDto::importFromRequest($this->request);
        CarRecordService::update($record_dto);

        return JsonResponse::create();
    }

    public function deleteRecord(): JsonResponse
    {
        $record_id = $this->request->query->get('nSeqNo');
        CarRecordService::delete($record_id);

        return JsonResponse::create();
    }
}
