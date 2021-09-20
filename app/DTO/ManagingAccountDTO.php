<?php

namespace App\DTO;

use App\Helpers\DataTransferObject;

class ManagingAccountDTO extends DataTransferObject
{
    public ?int $id;
    public string $email;
    public string $name;
    public ?string $password;
    public ?string $hashed_password;
    public ?int $client_id;
    public ?int $type_id;
    public ?string $expires_at;
    public bool $requireEmailConfirmation;
    public bool $autoGeneratePassword;
    public bool $requirePasswordChangeOnFirstLogin;
    public bool $sendNotificationEmail;
}
