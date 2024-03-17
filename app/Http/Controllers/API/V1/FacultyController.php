<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\FacultyRequest;
use App\Http\Resources\V1\FacultyCollection;
use App\Http\Resources\V1\FacultyResource;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): FacultyCollection
    {
        abort_if(Gate::denies('faculty_access'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $faculties = Faculty::query();
        $includeMajors = request()->query('includeMajors');

        if ($includeMajors) {
            $faculties = $faculties->with('majors');
        }

        return new FacultyCollection($faculties->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FacultyRequest $request): FacultyResource
    {
        return new FacultyResource(Faculty::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Faculty $faculty): FacultyResource
    {
        abort_if(Gate::denies('faculty_show'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $includeMajors = request()->query('includeMajors');

        if ($includeMajors) {
            return new FacultyResource($faculty->loadMissing('majors'));
        }

        return new FacultyResource($faculty);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FacultyRequest $request, Faculty $faculty): \Illuminate\Http\JsonResponse
    {
        $faculty->update($request->all());

        return response()->json([
            "message" => "Faculty $faculty->id updated successfully",
            "data" => new FacultyResource($faculty)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faculty $faculty): \Illuminate\Http\JsonResponse
    {
        abort_if(Gate::denies('faculty_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $faculty->delete();
        return response()->json(["message" => "Faculty deleted successfully"]);
    }
}
