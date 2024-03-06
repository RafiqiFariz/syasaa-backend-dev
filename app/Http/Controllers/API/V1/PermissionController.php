<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\PermissionRequest;
use App\Http\Resources\V1\PermissionCollection;
use App\Http\Resources\V1\PermissionResource;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): PermissionCollection
    {
        return new PermissionCollection(Permission::paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request): PermissionResource
    {
        return new PermissionResource(Permission::create($request->only('name')));
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission): PermissionResource
    {
        return new PermissionResource($permission);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, Permission $permission): \Illuminate\Http\JsonResponse
    {
        $permission->update($request->only('name'));
        return response()->json([
            'message' => 'Permission updated successfully',
            'data' => new PermissionResource($permission)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission): \Illuminate\Http\JsonResponse
    {
        $permission->delete();
        return response()->json(['message' => 'Permission deleted successfully']);
    }
}
