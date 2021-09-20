<?php

namespace App\DTO;

use App\Helpers\DataTransferObject;

class DecryptedConfirmationDTO extends DataTransferObject
{
    public string $public_id;
    public int $client_id;
    public int $account_id;
}
