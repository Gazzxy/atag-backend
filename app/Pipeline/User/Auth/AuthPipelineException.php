<?php

namespace App\Pipeline\User\Auth;

use Illuminate\Support\Facades\Log;

class AuthPipelineException extends \Exception
{
    public function __construct(string $message, int $code)
    {
        parent::__construct($message, $code);
    }

    public function render()
    {
        return response()->json(['message' => $this->getMessage()], $this->getCode());
    }

    public function report()
    {
        Log::channel('authlog')->info('Login failed', [
            'message' => $this->getMessage(),
            'ip' => request()->getClientIp(),
            'browser' => request()->userAgent()
        ]);
    }
}
