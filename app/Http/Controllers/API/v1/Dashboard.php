<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\Dashboard\Read;
use App\Http\Actions\v1\Dashboard\Statistics;

class Dashboard extends Controller
{
    /**
     * @param Read $request
     * @param Statistics $action
     * @return JsonResponse
     */
    public function stats(Read $request, Statistics $action): JsonResponse
    {
        $user = $request->user();

        return response()->json(
            $action
                ->execute($user)
                ->response()
        );
    }
}
