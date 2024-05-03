<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\V1\UsersFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\UserStoreRequest;
use App\Http\Requests\V1\UserUpdateRequest;
use App\Http\Resources\V1\UserCollection;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): UserCollection
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $filter = new UsersFilter();
        $filterItems = $filter->transform($request); // [['column', 'operator', 'value']]

        $includeRole = $request->query('includeRole');
        $paginate = $request->query('paginate');

        $users = User::where($filterItems);

        if ($includeRole) {
            $users = $users->with(['role']);
        }

        if ($request->role_id && $request->role_id['eq'] == 2 && $request->faculty_id) {
            $users = $users->whereHas('facultyStaff', function ($query) use ($request) {
                $query->where('faculty_id', $request->faculty_id);
            });
        }

        if ($request->role_id && $request->role_id['eq'] == 4 && $request->class_id) {
            $users = $users->whereHas('student', function ($query) use ($request) {
                $query->where('class_id', $request->class_id);
            });
        }

        if ($paginate == 'false' || $paginate == '0') {
            return new UserCollection($users->get());
        }

        return new UserCollection($users->paginate(20)->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $request['password'] = bcrypt($request->password);

        $user = User::create($request->all());

        if ((int)$request->role_id === 2) {
            $user->facultyStaff()->create(["faculty_id" => $request->faculty_id]);
        } else if ((int)$request->role_id === 3) {
            $user->lecturer()->create(["address" => $request->address]);
        } else if ((int)$request->role_id === 4) {
            $user->student()->create(["class_id" => $request->class_id]);
        }

        return response()->json([
            "message" => "User created successfully",
            "data" => new UserResource($user),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): UserResource
    {
        $includeRole = request()->query('includeRole');

        if ($includeRole) {
            return new UserResource($user->loadMissing('role'));
        }

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user): \Illuminate\Http\JsonResponse
    {
        if (!empty($request->password)) {
            $request['password'] = bcrypt($request->password);
            $user->update($request->all());
        }

        $user->update($request->except('password'));

        if ((int)$request->role_id === 2) {
            $user->facultyStaff()->update(["faculty_id" => $request->faculty_id]);
        } else if ((int)$request->role_id === 3) {
            $user->lecturer()->update(["address" => $request->address]);
        } else if ((int)$request->role_id === 4) {
            $user->student()->update(["class_id" => $request->class_id]);
        }

        return response()->json([
            "message" => "User $user->id updated successfully.",
            "data" => new UserResource($user)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): \Illuminate\Http\JsonResponse
    {
        $user->delete();
        return response()->json(["message" => "User deleted successfully."]);
    }
}
