<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\V1\UsersFilter;
use App\Http\Controllers\Controller;
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
//        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $filter = new UsersFilter();
        $filterItems = $filter->transform($request); // [['column', 'operator', 'value']]

        $includeRole = $request->query('includeRole');

        $users = User::where($filterItems);

        if ($includeRole) {
            $users = $users->with(['role']);
        }

        return new UserCollection($users->paginate(20)->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $request['password'] = bcrypt($request->password);
        return new UserResource(User::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
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
    public function update(Request $request, User $user)
    {
        if (!empty($request->password)) {
            $request['password'] = bcrypt($request->password);
            $user->update($request->all());
        }

        $user->update($request->except('password'));

        return response()->json(['status' => 'Data user berhasil diupdate.', 'data' => $request->all()]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['status' => 'Data user berhasil dihapus.']);
    }
}
