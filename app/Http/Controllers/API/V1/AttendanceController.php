<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\AttendanceRequest;
use App\Http\Resources\V1\AttendanceCollection;
use App\Http\Resources\V1\AttendanceResource;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AttendanceCollection
    {
        abort_if(Gate::denies('attendance_access'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $classId = $request->query('class_id');
        $majorId = $request->query('major_id');
        $studentId = $request->query('student_id');
        $lecturerId = $request->query('lecturer_id');
        $facultyId = $request->query('faculty_id');
        $paginate = $request->query('paginate');

        $attendances = Attendance::with([
            'courseClass.course', 'courseClass.lecturer.user',
            'courseClass.class',
        ]);

        if ($classId) {
            $attendances = $attendances->whereHas('courseClass', function ($query) use ($classId) {
                $query->where('class_id', $classId);
            });
        }

        if ($majorId) {
            $attendances = $attendances->whereHas('courseClass', function ($query) use ($majorId) {
                $query->whereHas('class', function ($query) use ($majorId) {
                    $query->where('major_id', $majorId);
                });
            });
        }

        if ($studentId) {
            $attendances = $attendances->where('student_id', $studentId);
        }

        if ($lecturerId) {
            $attendances = $attendances->whereHas('courseClass', function ($query) use ($lecturerId) {
                $query->where('lecturer_id', $lecturerId);
            });
        }

        if ($facultyId) {
            $attendances = $attendances->whereHas('courseClass.class.major', function ($query) use ($facultyId) {
                $query->where('faculty_id', $facultyId);
            });
        }

        if ($paginate == 'false' || $paginate == '0') {
            return new AttendanceCollection($attendances->get());
        }

        return new AttendanceCollection($attendances->paginate(20)->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttendanceRequest $request): \Illuminate\Http\JsonResponse
    {
        $isExist = Attendance::where('course_class_id', $request->course_class_id)
            ->where('student_id', $request->student_id)
            ->whereDate('created_at', now()->toDateString())
            ->first();

        if ($isExist) {
            $courseClassName = $isExist->courseClass->course->name;

            return response()->json([
                "message" => "Attendance for today in $courseClassName course already created",
                "data" => new AttendanceResource($isExist),
            ], Response::HTTP_CONFLICT);
        }

        $data = $this->uploadAttendanceImage($request);

        return response()->json([
            "message" => "Attendance created successfully",
            "data" => new AttendanceResource(Attendance::create($data)),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance): AttendanceResource
    {
        abort_if(Gate::denies('attendance_show'), Response::HTTP_FORBIDDEN, 'Forbidden');
        return new AttendanceResource($attendance);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttendanceRequest $request, Attendance $attendance): \Illuminate\Http\JsonResponse
    {
        if ($request->hasFile('student_image')) {
            Storage::disk('public')->delete($attendance->getRawOriginal('student_image'));
        }

        if ($request->hasFile('lecturer_image')) {
            Storage::disk('public')->delete($attendance->getRawOriginal('lecturer_image'));
        }

        $data = $this->uploadAttendanceImage($request);

        $attendance->update($data);

        return response()->json([
            "message" => "Attendance $attendance->id updated successfully",
            "data" => new AttendanceResource($attendance),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance): \Illuminate\Http\JsonResponse
    {
        Storage::disk('public')->delete($attendance->getRawOriginal('student_image'));
        Storage::disk('public')->delete($attendance->getRawOriginal('lecturer_image'));

        $attendance->delete();
        return response()->json(["message" => "Attendance deleted successfully"]);
    }

    /**
     * @param AttendanceRequest $request
     * @return array
     */
    protected function uploadAttendanceImage(AttendanceRequest $request): array
    {
        $imagePath = 'attendances/student/' . $request->student_id;
        $data = $request->all();

        if ($request->hasFile('student_image')) {
            $studentImageName = $request->course_class_id . time() . '.' . $request->student_image->extension();
            $request->file('student_image')->storeAs($imagePath, $studentImageName, 'public');
            $data['student_image'] = "$imagePath/$studentImageName";
        }

        if ($request->hasFile('lecturer_image')) {
            $lecturerImageName =
                'lec-' . $request->course_class_id . time() . '.' . $request->lecturer_image->extension();
            $request->file('lecturer_image')->storeAs($imagePath, $lecturerImageName, 'public');
            $data['lecturer_image'] = "$imagePath/$lecturerImageName";
        }

        return $data;
    }
}
