<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\UI\Read;
use App\Http\Actions\v1\UI\GetNavigation;

class UI extends Controller
{
    public function getNavigation(Read $request, GetNavigation $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($request->user())
                ->response()
        );
    }
}
