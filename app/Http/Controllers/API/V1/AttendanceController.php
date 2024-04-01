<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\AttendanceRequest;
use App\Http\Resources\V1\AttendanceCollection;
use App\Http\Resources\V1\AttendanceResource;
use App\Models\Attendance;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AttendanceCollection
    {
        abort_if(Gate::denies('attendance_access'), Response::HTTP_FORBIDDEN, 'Forbidden');
        return new AttendanceCollection(Attendance::paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttendanceRequest $request): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            "message" => "Attendance created successfully",
            "data" => new AttendanceResource(Attendance::create($request->all())),
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
        $attendance->update($request->all());

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
