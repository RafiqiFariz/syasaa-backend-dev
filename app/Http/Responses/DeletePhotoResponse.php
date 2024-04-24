<?php

namespace App\Http\Responses;

use App\Contracts\BaseResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeletePhotoResponse implements BaseResponse
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  Request  $request
     * @return Response
     */
    public function toResponse($request): Response
    {
        return $request->wantsJson()
            ? response()->json([
                'message' => 'Profile photo deleted',
            ], 200)
            : back()->with('status', 'profile photo deleted');
    }
}
