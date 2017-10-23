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
    public function index()
    {
        return [
            'group' => GroupService::getGroups(),
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
        $record_id = $this->request->query->get('nSeqNo');
        $record = AccountRecordService::getRecord($record_id);

        return JsonResponse::create($record);
    }

    public function insertList()
    {
        $data = $this->request->request->get('data');
        $date = $this->request->request->get('date');

        $datas = CsvUtils::parseFromString($data);
        $header = $datas[0];
        array_shift($datas);

        AccountRecordService::multiInsert($date, $header, $datas);
    }

    public function insertRecord()
    {
        $record_dto = AccountRecordDto::importFromRequest($this->request);
        AccountRecordService::singleInsert($record_dto);
    }

    public function updateRecord()
    {
        $record_dto = AccountRecordDto::importFromRequest($this->request);
        AccountRecordService::updateRecord($record_dto);
    }

    public function deleteRecord()
    {
        $record_id = intval($this->request->query->get('nSeqNo'));
        AccountRecordService::deleteRecord($record_id);
    }

    public function updateGroup()
    {
        $record_id = intval($this->request->query->get('nSeqNo'));
        $group_id = intval($this->request->query->get('nGroup'));

        AccountRecordService::updateGroupId($record_id, $group_id);
    }

    public function deleteMonth()
    {
        $date = $this->request->query->get('date');

        AccountRecordService::deleteMonth($date);
    }
}
