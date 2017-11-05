<?php
declare(strict_types=1);

namespace AccountBook\Controller;

use AccountBook\CarRecord\CarRecordService;
use AccountBook\Common\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;

class CarmonthController extends BaseController
{
    public function index(): array
    {
        return [];
    }

    public function getMonthGroup(): JsonResponse
    {
        $stats = CarRecordService::getMonthStats();

        return JsonResponse::create($stats);
    }
}
