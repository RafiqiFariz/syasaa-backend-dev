<?php

namespace App\Http\Controllers\API\V1;

use App\Actions\Profile\DeleteProfilePhoto;
use App\Actions\Profile\UpdateProfilePhoto;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\RequestUpdateProfileRequest;
use App\Http\Resources\V1\UpdateProfileRequestCollection;
use App\Http\Resources\V1\UpdateProfileRequestResource;
use App\Models\Student;
use App\Models\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $isExist = UpdateProfileRequest::where('student_id', $request->student_id)
            ->where('changed_data', $request->changed_data)
            ->where('status', 'pending')
            ->first();

        if ($isExist) {
            return response()->json([
                "message" => "You have already request to change '$request->changed_data' data. Please wait for the response from the admin.",
            ], Response::HTTP_CONFLICT);
        }

        $data = $this->uploadImage($request);
        $data['status'] = 'pending';

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
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($updateProfileRequest->getRawOriginal('image'));
        }

        $data = $this->uploadImage($request);
        $updateProfileRequest->update($data);

        return response()->json([
            "message" => "Data $updateProfileRequest->id updated successfully",
            "data" => new UpdateProfileRequestResource($updateProfileRequest)
        ]);
    }

    /**
     * Update status of the specified resource in storage.
     */
    public function updateStatus(Request $request, UpdateProfileRequest $updateProfileRequest, DeleteProfilePhoto $deleteProfilePhoto): \Illuminate\Http\JsonResponse
    {
        abort_if(Gate::denies('update_profile_request_edit_status'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $request->validate([
            'status' => 'required|in:accepted,rejected'
        ]);

        $data = ['status' => $request->status];

        DB::beginTransaction();
        try {
            // update status requestnya
            $updateProfileRequest->update($data);

            if ($request->status !== 'accepted') DB::commit();

            // Cari student yang melakukan request
            $student = User::whereHas('student', function ($query) use ($updateProfileRequest) {
                $query->where('id', $updateProfileRequest->student_id);
            });

            // Jika status requestnya diterima, dan data yang diubah adalah image
            // maka update image student dengan image baru
            if ($updateProfileRequest->changed_data === 'image') {
                $imgName = last(explode('/', $updateProfileRequest->new_value));
                $newLocation = "profile-photos/$imgName";
                $deleteProfilePhoto->delete($student->first());
                Storage::disk('public')->copy($updateProfileRequest->new_value, $newLocation);
                $student->update(['image' => $newLocation]);
            } else {
                $student->update([$updateProfileRequest->changed_data => $updateProfileRequest->new_value]);
            }

            DB::commit();
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Failed to update status of data $updateProfileRequest->id",
                "error" => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            "message" => "Status of data $updateProfileRequest->id updated successfully",
            "data" => new UpdateProfileRequestResource($updateProfileRequest)
        ]);
    }

    /**
     * @param RequestUpdateProfileRequest $request
     * @return array
     */
    protected function uploadImage(RequestUpdateProfileRequest $request): array
    {
        $data = $request->all();

        if (!$request->hasFile('image')) return $data;

        $imagePath = 'update_profile_requests/student/' . $request->student_id;
        $imageName = $request->file('image')->getClientOriginalName();
        $reqImageName = time() . '-' . Str::kebab(Str::lower($imageName));
        $request->file('image')->storeAs($imagePath, $reqImageName, 'public');
        $data['image'] = "$imagePath/$reqImageName";

        $student = User::whereHas('student', function ($query) use ($request) {
            $query->where('id', $request->student_id);
        })->first();

        $data['old_value'] = $student->getRawOriginal('image');
        $data['new_value'] = $data['image'];

        return $data;
    }
}
