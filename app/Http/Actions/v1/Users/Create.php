<?php

namespace App\Http\Actions\v1\Users;

use App\DTO\UserDTO;
use App\Models\User;
use App\Models\UserStatus;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendAccountCreatedNotification;

class Create
{
    protected array $response;

    public function execute(UserDTO $dto): self
    {
        if($dto->sendNotificationEmail)
        {
            $dto->status_id = UserStatus::S_PENDING;
        }

        $user = User::create($dto->toArray());

        if($dto->sendNotificationEmail)
        {
            Mail::to($dto->email)->send(new SendAccountCreatedNotification($dto));
        }

        $this->response = $user->toArray();

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
