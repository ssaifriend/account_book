<?php
declare(strict_types=1);

namespace AccountBook\Controller;

use AccountBook\Common\BaseController;
use AccountBook\Group\GroupService;
use AccountBook\GroupFilter\AccountFilterService;
use AccountBook\GroupFilter\GroupFilterDto;
use Symfony\Component\HttpFoundation\JsonResponse;

class ConfigController extends BaseController
{
    public function index(): array
    {
        return [];
    }

    public function getFilterList(): JsonResponse
    {
        $filters = AccountFilterService::getFilters();

        return JsonResponse::create($filters);
    }

    public function addFilter(): JsonResponse
    {
        $filter_dto = GroupFilterDto::importFromRequest($this->request);
        AccountFilterService::insert($filter_dto);

        return JsonResponse::create();
    }

    public function editFilter(): JsonResponse
    {
        $filter_dto = GroupFilterDto::importFromRequest($this->request);
        AccountFilterService::update($filter_dto);

        return JsonResponse::create();
    }

    public function deleteFilter(): JsonResponse
    {
        $filter_id = intval($this->request->query->get('nSeqNo'));
        AccountFilterService::delete($filter_id);

        return JsonResponse::create();
    }

    public function getGroupList(): JsonResponse
    {
        $groups = GroupService::getGroups();

        return JsonResponse::create($groups);
    }

    public function addGroupList(): JsonResponse
    {
        $name = $this->request->request->get('group');
        GroupService::insertGroup($name);

        return JsonResponse::create();
    }

    public function editGroup(): JsonResponse
    {
        $group_id = intval($this->request->request->get('nSeqNo'));
        $name = $this->request->request->get('group');
        GroupService::updateGroup($group_id, $name);

        return JsonResponse::create();
    }

    public function deleteGroup(): JsonResponse
    {
        $group_id = intval($this->request->query->get('nSeqNo'));
        GroupService::deleteGroup($group_id);

        return JsonResponse::create();
    }
}
