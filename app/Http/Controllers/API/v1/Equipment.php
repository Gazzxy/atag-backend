<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Actions\v1\Equipment\Create;
use App\Http\Actions\v1\Equipment\Update;
use App\Http\Actions\v1\Equipment\Listing;
use App\Http\Requests\API\v1\Equipment\Read;
use App\Http\Requests\API\v1\Equipment\Write;
use App\Http\Actions\v1\Equipment\ReadByUUID;
use App\Http\Actions\v1\Equipment\ListReports;
use App\Http\Requests\API\v1\Equipment\Delete;
use App\Http\Actions\v1\Equipment\CreateReport;
use App\Http\Requests\API\v1\Equipment\Download;
use App\Http\Actions\v1\Equipment\DownloadReport;
use App\Http\Actions\v1\Equipment\DeleteEquipment;
use App\Http\Requests\API\v1\Equipment\WriteReport;
use App\Http\Actions\v1\Equipment\Read as ReadAction;
use App\Http\Actions\v1\Equipment\ListReportsByUUID;
use App\Http\Actions\v1\Equipment\CreateReportByUUID;

class Equipment extends Controller
{
    public function read(Read $request, int $id, ReadAction $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($id)
                ->response()
        );
    }

    /**
     * @param Read $request
     * @param string $uuid
     * @param ReadByUUID $action
     * @return JsonResponse
     */
    public function readByUUID(Read $request, string $uuid, ReadByUUID $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($uuid)
                ->response()
        );
    }

    /**
     * @param Write $request
     * @param Create $action
     * @return JsonResponse
     */
    public function create(Write $request, Create $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($request->getModelDTO())
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
     * @param Write $request
     * @param int $id
     * @param Update $action
     * @return JsonResponse
     */
    public function update(Write $request, int $id, Update $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($id, $request->getModelData())
                ->response()
        );
    }

    /**
     * @param Read $request
     * @param int $id
     * @param ListReports $action
     * @return JsonResponse
     */
    public function listReports(Read $request, int $id, ListReports $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($id)
                ->response()
        );
    }

    /**
     * @param Read $request
     * @param string $uuid
     * @param ListReportsByUUID $action
     * @return JsonResponse
     */
    public function listReportsByUUID(Read $request, string $uuid, ListReportsByUUID $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($uuid)
                ->response()
        );
    }

    /**
     * @param WriteReport $request
     * @param int $id
     * @param CreateReport $action
     * @return JsonResponse
     * @throws \Exception
     */
    public function createReport(WriteReport $request, int $id, CreateReport $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($id, $request->getModelDTO())
                ->response()
        );
    }

    /**
     * @param WriteReport $request
     * @param string $uuid
     * @param CreateReportByUUID $action
     * @return JsonResponse
     * @throws \Exception
     */
    public function createReportByUUID(WriteReport $request, string $uuid, CreateReportByUUID $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($uuid, $request->getModelDTO())
                ->response()
        );
    }

    /**
     * @param Read $request
     * @param int $id
     * @param DownloadReport $action
     * @return mixed
     */
    public function downloadReport(Download $request, int $id, DownloadReport $action)
    {
        return $action->execute($id);
    }

    public function downloadReportByUUID(Read $request, string $uuid)
    {

    }

    /**
     * @param Write $request
     * @param int $id
     * @param DeleteEquipment $action
     * @return JsonResponse
     */
    public function delete(Delete $request, int $id, DeleteEquipment $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($id)
                ->response()
        );
    }
}
