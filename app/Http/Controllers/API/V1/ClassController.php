<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ClassRequest;
use App\Http\Resources\V1\ClassCollection;
use App\Http\Resources\V1\ClassResource;
use App\Models\MajorClass;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ClassCollection
    {
        abort_if(Gate::denies('class_access'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $paginate = request()->query('paginate');

        if ($paginate == 'false' || $paginate == '0') {
            return new ClassCollection(MajorClass::all());
        }

        return new ClassCollection(MajorClass::paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassRequest $request): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            "message" => "Class created successfully",
            "data" => new ClassResource(MajorClass::create($request->all())),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MajorClass $majorClass): ClassResource
    {
        abort_if(Gate::denies('class_show'), Response::HTTP_FORBIDDEN, 'Forbidden');
        return new ClassResource($majorClass->load('major'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassRequest $request, MajorClass $majorClass): \Illuminate\Http\JsonResponse
    {
        $majorClass->update($request->all());

        return response()->json([
            "message" => "Class $majorClass->id updated successfully",
            "data" => new ClassResource($majorClass),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MajorClass $majorClass): \Illuminate\Http\JsonResponse
    {
        abort_if(Gate::denies('class_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $majorClass->delete();

        return response()->json([
            "message" => "Class $majorClass->id deleted successfully",
        ]);
    }
}
