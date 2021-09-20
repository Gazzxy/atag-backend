<?php

namespace App\Http\Controllers\API\v1;

use App\Models\User;
use App\DTO\ClientDTO;
use App\DTO\UserInfoDTO;
use Illuminate\Support\Str;
use App\Models\PasswordReset;
use App\DTO\ManagingAccountDTO;
use App\Mail\SendClientCreated;
use App\DTO\AccountActivatedDTO;
use Illuminate\Http\JsonResponse;
use App\Mail\SendAccountActivated;
use App\Http\Controllers\Controller;
use App\Http\Actions\v1\Preview\Show;
use App\Http\Requests\API\v1\Preview\Read;
use App\Mail\SendPasswordResetInstructions;
use App\Mail\SendAccountCreatedNotification;
use App\Mail\SendPasswordResetSuccessfullyNotification;

class Preview extends Controller
{
    public function show(Read $request, Show $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute()
                ->response()
        );
    }

    /**
     * @param Read $request
     * @return SendAccountCreatedNotification
     */
    public function renderSendAccountCreatedNotification(Read $request)
    {
        $dto = new ManagingAccountDTO([
            'id' => 6,
            'email' => 'test-user@brightfmgroup.com',
            'name' => 'Jay Wilkinson',
            'password' => 'password',
            'hashed_password' => password_hash('password', PASSWORD_ARGON2I),
            'client_id' => 0,
            'type_id' => 1,
            'expires_at' => now()->format('Y-m-d H:i:s'),
            'requireEmailConfirmation' => true,
            'autoGeneratePassword' => true,
            'requirePasswordChangeOnFirstLogin' => true,
            'sendNotificationEmail' => true,
        ]);

        return new SendAccountCreatedNotification($dto);
    }

    /**
     * @param Read $request
     * @return SendAccountActivated
     */
    public function renderSendAccountActivated(Read $request)
    {
        $dto = new AccountActivatedDTO([
            'name' => 'Jay Wilkinson',
            'username' => 'test-user@brightfmgroup.com',
            'app_url' => config('brightfm.url')
        ]);

        return new SendAccountActivated($dto);
    }

    /**
     * @param Read $request
     * @return SendClientCreated
     */
    public function renderSendClientCreated(Read $request)
    {
        $client = new ClientDTO([
            'statusID' => 1,
            'client_id' => 1,
            'public_id' => Str::uuid(),
            'title' => 'Wilkinson Group',
            'description' => 'Description',
            'address' => 'Address',
            'expires_at' => null
        ]);

        $user = new ManagingAccountDTO([
            'id' => 6,
            'email' => 'test-user@brightfmgroup.com',
            'name' => 'Jay Wilkinson',
            'password' => 'password',
            'hashed_password' => password_hash('password', PASSWORD_ARGON2I),
            'client_id' => 1,
            'type_id' => 1,
            'expires_at' => now()->format('Y-m-d H:i:s'),
            'requireEmailConfirmation' => true,
            'autoGeneratePassword' => true,
            'requirePasswordChangeOnFirstLogin' => true,
            'sendNotificationEmail' => true,
        ]);

        return new SendClientCreated($client, $user);
    }

    public function renderSendPasswordResetInstructions(Read $request)
    {
        $user = new User(['full_name' => 'Jay Wilkinson', 'id' => 6]);
        $reset = new PasswordReset(['id' => 1]);

        return new SendPasswordResetInstructions($user, $reset);
    }

    public function renderSendPasswordResetSuccessfullyNotification(Read $request)
    {
        $user = new UserInfoDTO(['full_name' => 'Test User']);

        return new SendPasswordResetSuccessfullyNotification($user);
    }
}
