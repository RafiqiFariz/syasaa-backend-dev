<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\RequestUpdateProfileRequest;
use App\Http\Resources\V1\UpdateProfileRequestCollection;
use App\Http\Resources\V1\UpdateProfileRequestResource;
use App\Models\UpdateProfileRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class UpdateProfileRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): UpdateProfileRequestCollection
    {
        abort_if(Gate::denies('update_profile_request_access'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return new UpdateProfileRequestCollection(UpdateProfileRequest::paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestUpdateProfileRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $this->uploadImage($request);

        return response()->json([
            "message" => "Data created successfully",
            "data" => new UpdateProfileRequestResource(UpdateProfileRequest::create($data))
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(UpdateProfileRequest $updateProfileRequest): UpdateProfileRequestResource
    {
        abort_if(Gate::denies('update_profile_request_show'), Response::HTTP_FORBIDDEN, 'Forbidden');
        return new UpdateProfileRequestResource($updateProfileRequest);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RequestUpdateProfileRequest $request, UpdateProfileRequest $updateProfileRequest): \Illuminate\Http\JsonResponse
    {
        $data = $this->uploadImage($request);

        $updateProfileRequest->update($data);

        return response()->json([
            "message" => "Data $updateProfileRequest->id updated successfully",
            "data" => new UpdateProfileRequestResource($updateProfileRequest)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UpdateProfileRequest $updateProfileRequest): \Illuminate\Http\JsonResponse
    {
        abort_if(Gate::denies('update_profile_request_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $updateProfileRequest->delete();

        return response()->json([
            "message" => "Data deleted successfully",
        ]);
    }

    /**
     * @param RequestUpdateProfileRequest $request
     * @return array
     */
    protected function uploadImage(RequestUpdateProfileRequest $request): array
    {
        $imagePath = 'attendance_requests/student-' . $request->student_id;

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
            $reqImageName = $request->student_id . '-' . time() . '.' . Str::kebab(Str::lower($imageName));
            $request->file('image')->storeAs($imagePath, $reqImageName, 'public');
            $data['image'] = $reqImageName;
        }

        return $data;
    }
}
