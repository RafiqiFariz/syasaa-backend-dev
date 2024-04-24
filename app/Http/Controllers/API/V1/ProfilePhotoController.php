<?php

namespace App\Http\Controllers\API\V1;

use App\Actions\Profile\DeleteProfilePhoto;
use App\Actions\Profile\UpdateProfilePhoto;
use App\Http\Requests\V1\ProfilePhotoRequest;
use App\Http\Responses\DeletePhotoResponse;
use App\Http\Responses\UpdatePhotoResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ProfilePhotoController extends Controller
{
    /**
     * Update the user's profile photo.
     *
     * @param ProfilePhotoRequest $request
     * @param UpdateProfilePhoto $updater
     * @return UpdatePhotoResponse
     */
    public function update(ProfilePhotoRequest $request, UpdateProfilePhoto $updater) : UpdatePhotoResponse
    {
        $updater->update($request->user(), $request->all());

        return app(UpdatePhotoResponse::class);

    }

    /**
     * Delete the user's profile photo.
     *
     * @param Request $request
     * @param DeleteProfilePhoto $updater
     * @return DeletePhotoResponse
     */
    public function delete(Request $request, DeleteProfilePhoto $updater) : DeletePhotoResponse
    {
        $updater->delete($request->user());

        return app(DeletePhotoResponse::class);

    }
}
