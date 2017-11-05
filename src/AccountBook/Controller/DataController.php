<?php
declare(strict_types=1);

namespace AccountBook\Controller;

use AccountBook\Common\BaseController;
use AccountBook\Group\GroupService;
use AccountBook\Library\CsvUtils;
use AccountBook\Record\AccountRecordDto;
use AccountBook\Record\AccountRecordService;
use Symfony\Component\HttpFoundation\JsonResponse;

class DataController extends BaseController
{
    public function index(): array
    {
        return [
            'groups' => GroupService::getGroups(),
        ];
    }

    public function getList(): JsonResponse
    {
        $date = $this->request->query->get('date');
        $records = AccountRecordService::getRecordsByDate($date);

        return JsonResponse::create($records);
    }

    public function getRecord(): JsonResponse
    {
        $record_id = intval($this->request->query->get('nSeqNo'));
        $record = AccountRecordService::getRecord($record_id);

        return JsonResponse::create($record);
    }

    public function insertList(): JsonResponse
    {
        $data = $this->request->request->get('data');
        $date = $this->request->request->get('date');

        $datas = CsvUtils::parseFromString($data);
        $header = $datas[0];
        array_shift($datas);

        AccountRecordService::multiInsert($date, $header, $datas);

        return JsonResponse::create();
    }

    public function insertRecord(): JsonResponse
    {
        $record_dto = AccountRecordDto::importFromRequest($this->request);
        AccountRecordService::singleInsert($record_dto);

        return JsonResponse::create();
    }

    public function updateRecord(): JsonResponse
    {
        $record_dto = AccountRecordDto::importFromRequest($this->request);
        AccountRecordService::updateRecord($record_dto);

        return JsonResponse::create();
    }

    public function deleteRecord(): JsonResponse
    {
        $record_id = intval($this->request->query->get('nSeqNo'));
        AccountRecordService::deleteRecord($record_id);

        return JsonResponse::create();
    }

    public function updateGroup(): JsonResponse
    {
        $record_id = intval($this->request->query->get('nSeqNo'));
        $group_id = intval($this->request->query->get('nGroup'));

        AccountRecordService::updateGroupId($record_id, $group_id);

        return JsonResponse::create();
    }

    public function deleteMonth(): JsonResponse
    {
        $date = $this->request->query->get('date');

        AccountRecordService::deleteMonth($date);

        return JsonResponse::create();
    }
}
