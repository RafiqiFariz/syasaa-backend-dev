<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CourseClassRequest;
use App\Http\Resources\V1\CourseClassCollection;
use App\Http\Resources\V1\CourseClassResource;
use App\Models\CourseClass;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): CourseClassCollection
    {
        abort_if(Gate::denies('course_class_access'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $includeClass = $request->query('includeClass');
        $includeCourse = $request->query('includeCourse');
        $includeLecturer = $request->query('includeLecturer');

        $classId = $request->query('class_id');
        $majorId = $request->query('major_id');
        $lecturerId = $request->query('lecturer_id');
        $paginate = $request->query('paginate');

        $courseClasses = CourseClass::query();

        if ($includeClass) {
            $courseClasses = $courseClasses->with(['class.major.faculty']);
        }

        if ($includeCourse) {
            $courseClasses = $courseClasses->with(['course']);
        }

        if ($includeLecturer) {
            $courseClasses = $courseClasses->with(['lecturer']);
        }

        if ($classId) {
            $courseClasses = $courseClasses->where('class_id', $classId);
        }

        if ($majorId) {
            $courseClasses = $courseClasses->whereHas('class', function ($query) use ($majorId) {
                $query->where('major_id', $majorId);
            });
        }

        if ($lecturerId) {
            $courseClasses = $courseClasses->where('lecturer_id', $lecturerId);
        }

        if ($paginate == 'false' || $paginate == '0') {
            return new CourseClassCollection($courseClasses->get());
        }

        return new CourseClassCollection($courseClasses->paginate(20)->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseClassRequest $request): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            "message" => "Course class created successfully",
            "data" => new CourseClassResource(CourseClass::create($request->all())),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseClass $courseClass): CourseClassResource
    {
        abort_if(Gate::denies('course_class_show'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $includeClass = request()->query('includeClass');
        $includeCourse = request()->query('includeCourse');
        $includeLecturer = request()->query('includeLecturer');

        if ($includeClass) {
            $courseClass->load('class');
        }

        if ($includeCourse) {
            $courseClass->load('course');
        }

        if ($includeLecturer) {
            $courseClass->load('lecturer');
        }

        return new CourseClassResource($courseClass);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseClassRequest $request, CourseClass $courseClass): \Illuminate\Http\JsonResponse
    {
        $courseClass->update($request->all());

        return response()->json([
            "message" => "Course class $courseClass->id updated successfully",
            "data" => new CourseClassResource($courseClass),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseClass $courseClass): \Illuminate\Http\JsonResponse
    {
        abort_if(Gate::denies('course_class_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $courseClass->delete();

        return response()->json(["message" => "Course class deleted successfully"]);
    }
}
