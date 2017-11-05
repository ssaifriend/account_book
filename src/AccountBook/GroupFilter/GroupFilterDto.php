<?php
declare(strict_types=1);

namespace AccountBook\GroupFilter;

use AccountBook\Common\BaseDto;
use Symfony\Component\HttpFoundation\Request;

class GroupFilterDto extends BaseDto
{
    /** @var int */
    public $id;
    /** @var int */
    public $group_id;
    /** @var string */
    public $pattern;

    public static function importFromDatabase(array $dict): self
    {
        $dto = new self;
        $dto->id = intval($dict['nSeqNo']);
        $dto->group_id = intval($dict['nGroup']);
        $dto->pattern = $dict['vcUse'];

        return $dto;
    }

    public static function importFromRequest(Request $request): self
    {
        $dto = new self;
        $dto->id = intval($request->request->get('nSeqNo'));
        $dto->group_id = intval($request->request->get('group'));
        $dto->pattern = $request->request->get('use');

        return $dto;
    }

    public function exportToDatabase(): array
    {
        return [
            'nGroup' => $this->group_id,
            'vcUse' => $this->pattern,
        ];
    }
}
