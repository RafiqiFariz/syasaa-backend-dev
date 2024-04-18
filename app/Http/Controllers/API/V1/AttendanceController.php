<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\AttendanceStoreRequest;
use App\Http\Requests\V1\AttendanceUpdateRequest;
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

        return new AttendanceCollection($attendances->paginate(20)->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttendanceStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $imagePath = 'attendances/student-' . $request->student_id;

        $data = $request->all();

        if ($request->hasFile('student_image')) {
            $studentImageName = $request->student_id . '-' .
                $request->course_class_id . time() . '.' . $request->student_image->extension();
            $request->file('student_image')->storeAs($imagePath, $studentImageName, 'public');
            $data['student_image'] = $studentImageName;
        }

        if ($request->hasFile('lecturer_image')) {
            $lecturerImageName = $request->student_id . '-lec-' .
                $request->course_class_id . time() . '.' . $request->lecturer_image->extension();
            $request->file('lecturer_image')->storeAs($imagePath, $lecturerImageName, 'public');
            $data['lecturer_image'] = $lecturerImageName;
        }

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
    public function update(AttendanceUpdateRequest $request, Attendance $attendance): \Illuminate\Http\JsonResponse
    {
        $imagePath = 'attendances/student-' . $request->student_id;

        $data = $request->all();

        if ($request->hasFile('student_image')) {
            // hapus gambar lama
            Storage::delete("public/$imagePath/$attendance->student_image");

            $studentImageName = $request->student_id . '-' .
                $request->course_class_id . time() . '.' . $request->student_image->extension();
            $request->file('student_image')->storeAs($imagePath, $studentImageName, 'public');
            $data['student_image'] = $studentImageName;
        }

        if ($request->hasFile('lecturer_image')) {
            // hapus gambar lama
            Storage::delete("public/$imagePath/$attendance->lecturer_image");

            $lecturerImageName = $request->student_id . '-lec-' .
                $request->course_class_id . time() . '.' . $request->lecturer_image->extension();
            $request->file('lecturer_image')->storeAs($imagePath, $lecturerImageName, 'public');
            $data['lecturer_image'] = $lecturerImageName;
        }

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
        $attendance->delete();
        return response()->json(["message" => "Attendance deleted successfully"]);
    }
}
