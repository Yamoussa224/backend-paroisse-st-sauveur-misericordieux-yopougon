<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\UserResource;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    protected UserRepositoryInterface $repo;

    public function __construct(UserRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * List users (paginated)
     */
    public function index(Request $request)
    {
        $conditions = [];

        if ($request->filled('fullname')) {
            $conditions[] = ['fullname', 'LIKE', '%' . $request->fullname . '%'];
        }

        if ($request->filled('email')) {
            $conditions[] = ['email', 'LIKE', '%' . $request->email . '%'];
        }

        if ($request->filled('phone')) {
            $conditions[] = ['phone', 'LIKE', '%' . $request->phone . '%'];
        }

        if ($request->filled('status')) {
            $conditions[] = ['status', '=', $request->status];
        }

        if ($request->filled('role')) {
            $conditions[] = ['role', '=', $request->role];
        }

        $users = $this->repo->paginate(
            with: [],
            page: (int) $request->input('per_page', 15),
            conditions: $conditions,
            skip: (int) $request->input('skip', 0),
            orderBy: $request->input('sort_by', 'id'),
            direction: $request->input('sort_dir', 'desc'),
        );

        return UserResource::collection($users);
    }

    /**
     * Store a new user
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        // Hash password
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user = $this->repo->create($data);

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Show user details
     */
    public function show(string $id)
    {
        return new UserResource($this->repo->find($id));
    }

    /**
     * Update user
     */
    public function update(UpdateRequest $request, string $id)
    {
        $data = $request->validated();

        // Hash password if present
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user = $this->repo->update($id, $data);
        return new UserResource($user);
    }

    /**
     * Soft delete user
     */
    public function destroy(string $id)
    {
        $this->repo->delete($id);

        return response()->json([
            'status'  => 'success',
            'message' => 'Utilisateur supprimé'
        ], Response::HTTP_NO_CONTENT);
    }
}
