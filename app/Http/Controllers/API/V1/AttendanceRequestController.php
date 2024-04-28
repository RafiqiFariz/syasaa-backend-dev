<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\RequestAttendanceRequest;
use App\Http\Resources\V1\AttendanceRequestCollection;
use App\Http\Resources\V1\AttendanceRequestResource;
use App\Models\Attendance;
use App\Models\AttendanceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AttendanceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AttendanceRequestCollection
    {
        abort_if(Gate::denies('attendance_request_access'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $attendanceRequests = AttendanceRequest::with(['courseClass.course', 'student']);

        $classId = $request->query('class_id');
        $majorId = $request->query('major_id');
        $studentId = $request->query('student_id');

        if ($classId) {
            $attendanceRequests = AttendanceRequest::whereHas('courseClass', function ($query) use ($classId) {
                $query->where('class_id', $classId);
            });
        }

        if ($majorId) {
            $attendanceRequests = AttendanceRequest::whereHas('courseClass', function ($query) use ($majorId) {
                $query->whereHas('class', function ($query) use ($majorId) {
                    $query->where('major_id', $majorId);
                });
            });
        }

        if ($studentId) {
            $attendanceRequests = $attendanceRequests->where('student_id', $studentId);
        }

        return new AttendanceRequestCollection($attendanceRequests->paginate(20)->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestAttendanceRequest $request): \Illuminate\Http\JsonResponse
    {
        $isExist = AttendanceRequest::where('student_id', $request->student_id)
            ->where('course_class_id', $request->course_class_id)
            ->whereDate('created_at', now()->toDateString())
            ->first();

        if ($isExist) {
            $courseClassName = $isExist->courseClass->course->name;

            return response()->json([
                "message" => "Attendance request for today in $courseClassName course already created",
                "data" => new AttendanceRequestResource($isExist),
            ], Response::HTTP_CONFLICT);
        }

        $data = $this->uploadAttendanceRequestImage($request);

        return response()->json([
            'message' => 'Attendance request created successfully.',
            'data' => new AttendanceRequestResource(AttendanceRequest::create($data)),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(AttendanceRequest $attendanceRequest): AttendanceRequestResource
    {
        $attendanceRequest->load(['courseClass.course', 'student']);
        return new AttendanceRequestResource($attendanceRequest);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RequestAttendanceRequest $request, AttendanceRequest $attendanceRequest): \Illuminate\Http\JsonResponse
    {
        if ($request->hasFile('student_image')) {
            Storage::disk('public')->delete($attendanceRequest->getRawOriginal('student_image'));
        }

        $data = $this->uploadAttendanceRequestImage($request);
        $attendanceRequest->update($data);

        return response()->json([
            "message" => "Attendance request $attendanceRequest->id updated successfully.",
            "data" => new AttendanceRequestResource($attendanceRequest),
        ]);
    }

    /**
     * Update status of the specified resource in storage.
     */
    public function updateStatus(Request $request, AttendanceRequest $attendanceRequest): \Illuminate\Http\JsonResponse
    {
        abort_if(Gate::denies('attendance_request_edit_status'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $attendanceRequest->update($request->all());

        if ($request->status === 'accepted') {
            $studentImage = $attendanceRequest->getRawOriginal('student_image');

            Attendance::firstOrCreate([
                'student_id' => $attendanceRequest->student_id,
                'course_class_id' => $attendanceRequest->course_class_id,
                'is_present' => $attendanceRequest->evidence === 'present',
                'student_image' => $studentImage,
                'attendance_request_id' => $attendanceRequest->id,
            ]);

            $newLocation = Str::replace(
                'attendance_requests', 'attendances',
                $studentImage
            );

            Storage::disk('public')->move($studentImage, $newLocation);
        }

        return response()->json([
            "message" => "Status of attendance request $attendanceRequest->id updated successfully.",
            "data" => new AttendanceRequestResource($attendanceRequest),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AttendanceRequest $attendanceRequest): \Illuminate\Http\JsonResponse
    {
        abort_if(Gate::denies('attendance_request_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $attendanceRequest->delete();

        return response()->json([
            'message' => 'Attendance request deleted successfully.',
        ]);
    }

    /**
     * @param RequestAttendanceRequest $request
     * @return array
     */
    protected function uploadAttendanceRequestImage(RequestAttendanceRequest $request): array
    {
        $imagePath = 'attendance_requests/student/' . $request->student_id;
        $data = $request->all();

        if ($request->hasFile('student_image')) {
            $imageName = $request->file('student_image')->getClientOriginalName();
            $studentImageName = time() . '-' . Str::kebab(Str::lower($imageName));
            $request->file('student_image')->storeAs($imagePath, $studentImageName, 'public');
            $data['student_image'] = "$imagePath/$studentImageName";
        }

        return $data;
    }
}
