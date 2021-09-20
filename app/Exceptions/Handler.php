<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Contracts\Encryption\DecryptException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        AccessDeniedHttpException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function(AccessDeniedHttpException $e, $request)
        {
            return response()->json(['error' => 'Access denied'], 401);
        });

        $this->renderable(function(QueryException $e, $request)
        {
            return response()->json([
                'message' => 'Entry already exists',
                'exception' => $e->getMessage()
            ], 409);
        });

        $this->renderable(function(DecryptException $e, $request)
        {
            return response()->json([
                'message' => 'Invalid data supplied',
                'exception' => $e->getMessage()
            ], 422);
        });
    }

    public function report(\Throwable $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            app('sentry')->captureException($exception);
        }

        parent::report($exception);
    }
}
