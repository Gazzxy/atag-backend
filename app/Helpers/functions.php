<?php

namespace App\Helpers;


use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Log;

function dateFromFormats(string $input, string $output, array $formats = ['Y-m-d', 'Y-m-d H:i:s']): string
{
    $result = '';

    foreach($formats as $format)
    {
        $dt = \DateTime::createFromFormat($format, $input);

        if(false !== $dt)
        {
            $result = $dt->format($output);

            break;
        }
    }

    return $result;
}

function verifyResetPasswordPayload(string $payload): array
{
    $response = [];

    try
    {
        $decrypted = json_decode(decrypt($payload), true);

        if(!isset($decrypted['id']) && !isset($decrypted['date']))
        {
            throw new \Exception('Required properties "id" and "date" not found in decrypted payload.');
        }

        $tz = new \DateTimeZone('UTC');
        $id = (int)$decrypted['id'];
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $decrypted['date'], $tz);
        $now = new \DateTime("now", $tz);

        $reset = PasswordReset::findOrFail($id);

        /** @var  $user User */
        $user = User::findOrFail($reset->user_id);

        if(($date->modify('+1 day')) < $now)
        {
            $response = ['success' => false, 'message' => 'Link expired'];
        }
        elseif(!$user->isActive())
        {
            $response = ['success' => false, 'message' => 'Account not active'];
        }
        else
        {
            $response = ['success' => true];
        }
    }
    catch(\Exception $e)
    {
        Log::warning('Invalid payload supplied while verifying password reset', [
            'message' => $e->getMessage(),
            'payload' => $payload
        ]);

        $response = [
            'success' => false,
            'message' => $e->getMessage()
        ];
    }

    return $response;
}
