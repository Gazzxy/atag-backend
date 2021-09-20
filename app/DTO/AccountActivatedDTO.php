<?php

namespace App\DTO;

use App\Helpers\DataTransferObject;

class AccountActivatedDTO extends DataTransferObject
{
    public string $name;
    public string $username;
    public string $app_url;
}
