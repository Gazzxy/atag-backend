<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\Reports\Write;
use App\Http\Actions\v1\Reports\DeleteReport;

class Reports extends Controller
{
    /**
     * @param Write $request
     * @param int $id
     * @param DeleteReport $action
     * @return JsonResponse
     */
    public function delete(Write $request, int $id, DeleteReport $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($id)
                ->response()
        );
    }
}
