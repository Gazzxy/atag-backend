<?php

namespace App\DTO;

use App\Helpers\DataTransferObject;

class SortOptionDTO extends DataTransferObject
{
    public ?string $sort_by;
    public ?string $sort_way;
}
