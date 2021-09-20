<?php

namespace App\DTO;

use App\Helpers\DataTransferObject;

class UserInfoDTO extends DataTransferObject
{
    public string $full_name;

    public function toArray()
    {
        return [
            'full_name' => $this->full_name
        ];
    }
}
