<?php
declare(strict_types=1);

namespace AccountBook\GroupFilter;

use AccountBook\Common\BaseDto;

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
}
