<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pastor\StoreRequest;
use App\Http\Requests\Pastor\UpdateRequest;
use App\Http\Resources\PastorResource;
use App\Repositories\Contracts\PastorRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PastorController extends Controller
{
    protected PastorRepositoryInterface $repo;

    public function __construct(PastorRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * List pastors (paginated)
     */
    public function index(Request $request)
    {
        $conditions = [];

        if ($request->filled('fullname')) {
            $conditions[] = ['fullname', 'LIKE', '%' . $request->fullname . '%'];
        }

        if ($request->filled('started_at_from')) {
            $conditions[] = ['started_at', '>=', $request->started_at_from];
        }

        if ($request->filled('started_at_to')) {
            $conditions[] = ['started_at', '<=', $request->started_at_to];
        }

        if ($request->filled('ended_at_from')) {
            $conditions[] = ['ended_at', '>=', $request->ended_at_from];
        }

        if ($request->filled('ended_at_to')) {
            $conditions[] = ['ended_at', '<=', $request->ended_at_to];
        }

        $pastors = $this->repo->paginate(
            with: [],
            page: (int) $request->input('per_page', 15),
            conditions: $conditions,
            skip: (int) $request->input('skip', 0),
            orderBy: $request->input('sort_by', 'id'),
            direction: $request->input('sort_dir', 'desc'),
        );

        return PastorResource::collection($pastors);
    }

    /**
     * Store a new pastor
     */
    public function store(StoreRequest $request)
    {
        $pastor = $this->repo->create($request->validated());

        return (new PastorResource($pastor))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Show pastor details
     */
    public function show(string $id)
    {
        return new PastorResource($this->repo->find($id));
    }

    /**
     * Update pastor
     */
    public function update(UpdateRequest $request, string $id)
    {
        $pastor = $this->repo->update($id, $request->validated());
        return new PastorResource($pastor);
    }

    /**
     * Soft delete pastor
     */
    public function destroy(string $id)
    {
        $this->repo->delete($id);

        return response()->json([
            'status'  => 'success',
            'message' => 'Pastor supprimé'
        ], Response::HTTP_NO_CONTENT);
    }
}
