<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Actions\v1\Properties\Listing;
use App\Http\Requests\API\v1\Properties\Read;
use App\Http\Requests\API\v1\Properties\Write;
use App\Http\Requests\API\v1\Properties\Create;
use App\Http\Requests\API\v1\Properties\Update;
use App\Http\Actions\v1\Properties\ReadEquipment;
use App\Http\Actions\v1\Properties\DeleteProperty;
use App\Http\Actions\v1\Properties\CreateProperty;
use App\Http\Actions\v1\Properties\UpdateProperty;
use App\Http\Actions\v1\Properties\Read as ReadProperty;

class Properties extends Controller
{
    /**
     * @param Read $request
     * @param Listing $action
     * @return JsonResponse
     */
    public function listing(Read $request, Listing $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($request->user(), $request->getFilterQuery(), $request->getSortOptions())
                ->response()
        );
    }

    /**
     * @param Create $request
     * @param CreateProperty $action
     * @return JsonResponse
     */
    public function create(Create $request, CreateProperty $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($request->getDataModel())
                ->response()
        );
    }

    /**
     * @param Update $request
     * @param int $id
     * @param UpdateProperty $action
     * @return JsonResponse
     */
    public function update(Update $request, int $id, UpdateProperty $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($request->getDataModel(), $id)
                ->response()
        );
    }

    /**
     * @param Read $request
     * @param int $id
     * @param ReadProperty $action
     * @return JsonResponse
     */
    public function read(Read $request, int $id, ReadProperty $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($id)
                ->response()
        );
    }

    /**
     * @param Read $request
     * @param int $id
     * @param ReadEquipment $action
     * @return JsonResponse
     */
    public function readEquipment(Read $request, int $id, ReadEquipment $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($id)
                ->response()
        );
    }

    /**
     * @param Write $request
     * @param int $id
     * @param DeleteProperty $action
     * @return JsonResponse
     */
    public function delete(Write $request, int $id, DeleteProperty $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($id)
                ->response()
        );
    }
}
