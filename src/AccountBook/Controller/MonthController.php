<?php
declare(strict_types=1);

namespace AccountBook\Controller;

use AccountBook\Common\BaseController;
use AccountBook\Group\GroupService;

class MonthController extends BaseController
{
    public function index()
    {
        return [
            'groups' => GroupService::getGroups(),
            'special_groups' => \Config::MONTH_CALC_SPECIALS,
            'group_summary' => \Config::MONTH_CALC_GROUP_SUMMARY,
        ];
    }
}
