<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\MajorRequest;
use App\Http\Resources\V1\MajorCollection;
use App\Http\Resources\V1\MajorResource;
use App\Models\Major;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): MajorCollection
    {
        abort_if(Gate::denies('major_access'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $majors = Major::query();
        $includeClasses = request()->query('includeClasses');

        if ($includeClasses) {
            $majors = $majors->with('classes');
        }

        return new MajorCollection($majors->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MajorRequest $request): MajorResource
    {
        return new MajorResource(Major::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Major $major): MajorResource
    {
        $includeClasses = request()->query('includeClasses');

        if ($includeClasses) {
            return new MajorResource($major->loadMissing('classes'));
        }

        return new MajorResource($major);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MajorRequest $request, Major $major): \Illuminate\Http\JsonResponse
    {
        $major->update($request->all());

        return response()->json([
            "message" => "Major $major->id updated successfully",
            "data" => new MajorResource($major),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Major $major): \Illuminate\Http\JsonResponse
    {
        $major->delete();
        return response()->json(["message" => "Major deleted successfully"]);
    }
}
