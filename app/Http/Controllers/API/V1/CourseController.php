<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CourseRequest;
use App\Http\Resources\V1\CourseCollection;
use App\Http\Resources\V1\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): CourseCollection
    {
        abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $paginate = $request->query('paginate');

        if ($paginate == 'false' || $paginate == '0') {
            return new CourseCollection(Course::get());
        }

        return new CourseCollection(Course::paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            "message" => "Course created successfully",
            "data" => new CourseResource(Course::create($request->all())),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course): CourseResource
    {
        abort_if(Gate::denies('course_show'), Response::HTTP_FORBIDDEN, 'Forbidden');
        return new CourseResource($course);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request, Course $course): \Illuminate\Http\JsonResponse
    {
        $course->update($request->all());

        return response()->json([
            "message" => "Course $course->id updated successfully",
            "data" => new CourseResource($course),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course): \Illuminate\Http\JsonResponse
    {
        abort_if(Gate::denies('course_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');

        if ($course->classes->count() > 0) {
            return response()->json(["message" => "Course has classes, cannot delete"], 403);
        }

        $course->delete();
        return response()->json(["message" => "Course deleted successfully"]);
    }
}
