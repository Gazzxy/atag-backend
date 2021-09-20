<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\JsonResponse;
use App\Http\Actions\v1\Users\Auth;
use App\Http\Actions\v1\Users\Info;
use App\Http\Controllers\Controller;
use App\Http\Actions\v1\Users\Types;
use Illuminate\Http\RedirectResponse;
use App\Http\Actions\v1\Users\Delete;
use App\Http\Actions\v1\Users\Listing;
use App\Http\Actions\v1\Users\Statuses;
use App\Http\Requests\API\v1\Users\Read;
use App\Http\Requests\API\v1\Users\Write;
use App\Http\Requests\API\v1\Users\Create;
use App\Http\Requests\API\v1\Users\UpdateAuth;
use App\Http\Requests\API\v1\Users\UpdateInfo;
use App\Http\Requests\API\v1\Users\UpdateName;
use App\Http\Requests\API\v1\Users\Authenticate;
use Illuminate\Support\Facades\Auth as AuthFacade;
use App\Http\Requests\API\v1\Users\UpdatePassword;
use App\Http\Requests\API\v1\Users\ChangePassword;
use App\Http\Actions\v1\Users\UpdateAuthentication;
use App\Http\Actions\v1\Users\Read as ReadUserAction;
use App\Http\Requests\API\v1\Users\RetrievePassword;
use App\Http\Actions\v1\Users\UpdatePasswordForUser;
use App\Http\Requests\API\v1\Users\UpdatePermissions;
use App\Http\Actions\v1\Users\ChangePasswordViaReset;
use App\Http\Requests\API\v1\Users\VerifyConfirmation;
use App\Http\Requests\API\v1\Users\ConfirmRegistration;
use App\Http\Requests\API\v1\Users\VerifyPasswordReset;
use App\Http\Actions\v1\Users\Create as CreateUserAction;
use App\Http\Actions\v1\Users\VerifyPasswordResetPayload;
use App\Http\Actions\v1\Users\UpdateInfo as UpdateInfoAction;
use App\Http\Actions\v1\Users\UpdateName as UpdateNameAction;
use App\Http\Actions\v1\Users\UpdatePassword as UpdatePasswordAction;
use App\Http\Actions\v1\Users\RetrievePassword as RetrievePasswordAction;
use App\Http\Actions\v1\Users\UpdatePermissions as UpdatePermissionsAction;
use App\Http\Actions\v1\Users\VerifyConfirmation as VerifyConfirmationAction;
use App\Http\Actions\v1\Users\ConfirmRegistration as ConfirmRegistrationAction;

class Users extends Controller
{
    /**
     * @param Authenticate $request
     * @param Auth $action
     * @return JsonResponse
     */
    public function login(Authenticate $request, Auth $action): JsonResponse
    {
        return response()->json($action
            ->execute($request->username(), $request->password())
            ->response())
            ;
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        AuthFacade::logout();

        session()->flush();

        return redirect('/');
    }

    /**
     * @param RetrievePassword $request
     * @param RetrievePasswordAction $action
     * @return JsonResponse
     */
    public function retrievePassword(RetrievePassword $request, RetrievePasswordAction $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($request->getEmail())
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
     * @param Create $request
     * @param CreateUserAction $action
     * @return JsonResponse
     */
    public function create(Create $request, CreateUserAction $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($request->getUserDTO())
                ->response()
        );
    }

    /**
     * @param Read $request
     * @param Info $action
     * @return JsonResponse
     */
    public function info(Read $request, Info $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($request->user())
                ->response()
        );
    }

    /**
     * @param Read $request
     * @param int $id
     * @param ReadUserAction $action
     * @return JsonResponse
     */
    public function read(Read $request, int $id, ReadUserAction $action)
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
     * @param Delete $action
     * @return JsonResponse
     */
    public function delete(Write $request, int $id, Delete $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($id)
                ->response()
        );
    }

    public function listAdministrators(Read $request)
    {

    }

    /**
     * @param Read $request
     * @param Statuses $action
     * @return JsonResponse
     */
    public function statuses(Read $request, Statuses $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute()
                ->response()
        );
    }

    /**
     * @param Read $request
     * @param Types $action
     * @return JsonResponse
     */
    public function types(Read $request, Types $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute()
                ->response()
        );
    }

    /**
     * @param UpdateAuth $request
     * @param int $user_id
     * @param UpdateAuthentication $action
     * @return JsonResponse
     */
    public function updateAuth(UpdateAuth $request, int $user_id, UpdateAuthentication $action)
    {
        return response()->json(
            $action
                ->execute($user_id, $request->getUsername(), $request->getNewPassword())
                ->response()
        );
    }

    /**
     * @param UpdateInfo $request
     * @param int $user_id
     * @param UpdateInfoAction $action
     * @return JsonResponse
     */
    public function updateInfo(UpdateInfo $request, int $user_id, UpdateInfoAction $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute(
                    $user_id,
                    $request->getFullName(),
                    $request->getStatusID(),
                    $request->getTypeID(),
                    $request->getExpiresAt()
                )
                ->response()
        );
    }

    /**
     * @param UpdateName $request
     * @param UpdateNameAction $action
     * @return JsonResponse
     */
    public function updateName(UpdateName $request, UpdateNameAction $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($request->user(), $request->getFullName())
                ->response()
        );
    }

    /**
     * @param UpdatePermissions $request
     * @param int $user_id
     * @param UpdatePermissionsAction $action
     * @return JsonResponse
     */
    public function updatePermissions(UpdatePermissions $request, int $user_id, UpdatePermissionsAction $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($request->getPermissions(), $user_id)
                ->response()
        );
    }

    /**
     * @param UpdatePassword $request
     * @param int $user_id
     * @param UpdatePasswordForUser $action
     * @return JsonResponse
     */
    public function updatePasswordForUser(UpdatePassword $request, int $user_id, UpdatePasswordForUser $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($user_id, $request->getNewPassword())
                ->response()
        );
    }

    /**
     * @param UpdatePassword $request
     * @param UpdatePasswordAction $action
     * @return JsonResponse
     */
    public function updatePassword(UpdatePassword $request, UpdatePasswordAction $action): JsonResponse
    {
        return response()->json(
            $action->execute($request->user(), $request->getNewPassword())
        );
    }

    /**
     * @param VerifyConfirmation $request
     * @param VerifyConfirmationAction $action
     * @return JsonResponse
     */
    public function verifyConfirmation(VerifyConfirmation $request, VerifyConfirmationAction $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($request->getSlug())
                ->response()
        );
    }

    /**
     * @param ConfirmRegistration $request
     * @param ConfirmRegistrationAction $action
     * @return JsonResponse
     */
    public function verifyAccount(ConfirmRegistration $request, ConfirmRegistrationAction $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($request->getSlug(), $request->getUserPassword())
                ->response()
        );
    }

    /**
     * @param VerifyPasswordReset $request
     * @param VerifyPasswordResetPayload $action
     * @return JsonResponse
     */
    public function verifyPasswordReset(VerifyPasswordReset $request, VerifyPasswordResetPayload $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($request->getResetPayload())
                ->response()
        );
    }

    /**
     * @param ChangePassword $request
     * @param ChangePasswordViaReset $action
     * @return JsonResponse
     */
    public function changePassword(ChangePassword $request, ChangePasswordViaReset $action): JsonResponse
    {
        return response()->json(
            $action
                ->execute($request->getResetPayload(), $request->getPassword())
                ->response()
        );
    }
}
