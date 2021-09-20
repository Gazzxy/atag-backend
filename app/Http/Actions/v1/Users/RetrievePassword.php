<?php

namespace App\Http\Actions\v1\Users;

use App\Models\User;
use App\Models\UsersView;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendPasswordResetInstructions;

class RetrievePassword
{
    protected array $response;

    public function execute(string $email): self
    {
        try
        {
            $user = User::where('email', $email)->firstOrFail();

            $reset = PasswordReset::create([
                'user_id' => $user->id,
                'created_at' => now()
            ]);

            Mail::to($user->email)->send(new SendPasswordResetInstructions($user, $reset));
        }
        catch(\Exception $e)
        {
            Log::warning('Account retrieval initiated, but email specified cannot be found', [
                'email' => $email,
                'ip' => request()->getClientIps(),
                'browser' => request()->userAgent(),
                'exception' => $e->getMessage()
            ]);
        }

        $this->response = ['result' => true];

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
