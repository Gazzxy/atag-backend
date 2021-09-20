<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Actions\v1\Permissions\Listing;
use App\Http\Requests\API\v1\Permissions\Read;

class Permissions extends Controller
{
    public function listing(Read $request, Listing $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute()
                ->response()
        );
    }
}
