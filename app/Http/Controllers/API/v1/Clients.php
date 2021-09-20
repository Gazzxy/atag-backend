<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Actions\v1\Clients\Listing;
use App\Http\Actions\v1\Clients\GetUsers;
use App\Http\Requests\API\v1\Clients\Read;
use App\Http\Actions\v1\Clients\ReadClient;
use App\Http\Actions\v1\Clients\GetStatuses;
use App\Http\Requests\API\v1\Clients\Create;
use App\Http\Requests\API\v1\Clients\Delete;
use App\Http\Requests\API\v1\Clients\Update;
use App\Http\Actions\v1\Clients\DeleteClient;
use App\Http\Actions\v1\Clients\GetEquipment;
use App\Http\Actions\v1\Clients\UpdateClient;
use App\Http\Actions\v1\Clients\GetProperties;
use App\Http\Actions\v1\Clients\GetAccountTypes;
use App\Http\Requests\API\v1\Clients\ReadProperties;
use App\Http\Requests\API\v1\Properties\Read as ReadProperty;
use App\Http\Actions\v1\Clients\CreateClientAndManagingAccount;

class Clients extends Controller
{
    /**
     * @param Create $request
     * @param CreateClientAndManagingAccount $action
     * @return JsonResponse
     */
    public function create(Create $request, CreateClientAndManagingAccount $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($request->getClientDTO(), $request->getManagingAccountDTO())
                ->response()
        );
    }

    /**
     * @param Read $request
     * @param int $client_id
     * @param ReadClient $action
     * @return JsonResponse
     */
    public function read(Read $request, int $client_id, ReadClient $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($client_id)
                ->response()
        );
    }

    /**
     * @param Update $request
     * @param int $client_id
     * @param UpdateClient $action
     * @return JsonResponse
     */
    public function update(Update $request, int $client_id, UpdateClient $action)
    {
        return response()->json(
            $action
                ->execute($request->getClientDTO($client_id))
                ->response()
        );
    }

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
     * @param Read $request
     * @param GetStatuses $action
     * @return JsonResponse
     */
    public function statuses(Read $request, GetStatuses $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute()
                ->response()
        );
    }

    /**
     * @param Read $request
     * @param int $client_id
     * @param GetUsers $action
     * @return JsonResponse
     */
    public function users(Read $request, int $client_id, GetUsers $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($client_id)
                ->response()
        );
    }

    /**
     * @param Read $request
     * @param int $client_id
     * @param GetProperties $action
     * @return JsonResponse
     */
    public function properties(ReadProperties $request, int $client_id, GetProperties $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($client_id)
                ->response()
        );
    }

    /**
     * @param Read $request
     * @param int $client_id
     * @param GetEquipment $action
     * @return JsonResponse
     */
    public function equipment(Read $request, int $client_id, GetEquipment $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($client_id)
                ->response()
        );
    }

    /**
     * @param Delete $request
     * @param int $client_id
     * @param DeleteClient $action
     * @return JsonResponse
     */
    public function delete(Delete $request, int $client_id, DeleteClient $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($client_id)
                ->response()
        );
    }

    /**
     * @param Read $request
     * @param GetAccountTypes $action
     * @return JsonResponse
     */
    public function accountTypes(Read $request, GetAccountTypes $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute()
                ->response()
        );
    }
}
