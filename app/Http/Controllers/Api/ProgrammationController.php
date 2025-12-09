<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Programmation\StoreRequest;
use App\Http\Requests\Programmation\UpdateRequest;
use App\Http\Resources\ProgrammationResource;
use App\Repositories\Contracts\ProgrammationRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProgrammationController extends Controller
{
    protected ProgrammationRepositoryInterface $repo;

    public function __construct(ProgrammationRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * List programmations (paginated)
     */
    public function index(Request $request)
    {
        $conditions = [];

        if ($request->filled('name')) {
            $conditions[] = ['name', 'LIKE', '%' . $request->name . '%'];
        }

        if ($request->filled('date_from')) {
            $conditions[] = ['date_at', '>=', $request->date_from];
        }

        if ($request->filled('date_to')) {
            $conditions[] = ['date_at', '<=', $request->date_to];
        }

        $programmations = $this->repo->paginate(
            with: [],
            page: (int) $request->input('per_page', 15),
            conditions: $conditions,
            skip: (int) $request->input('skip', 0),
            orderBy: $request->input('sort_by', 'id'),
            direction: $request->input('sort_dir', 'desc'),
        );

        return ProgrammationResource::collection($programmations);
    }

    /**
     * Store a new programmation
     */
    public function store(StoreRequest $request)
    {
        $programmation = $this->repo->create($request->validated());

        return (new ProgrammationResource($programmation))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Show programmation details
     */
    public function show(string $id)
    {
        return new ProgrammationResource($this->repo->find($id));
    }

    /**
     * Update programmation
     */
    public function update(UpdateRequest $request, string $id)
    {
        $programmation = $this->repo->update($id, $request->validated());
        return new ProgrammationResource($programmation);
    }

    /**
     * Soft delete programmation
     */
    public function destroy(string $id)
    {
        $this->repo->delete($id);

        return response()->json([
            'status'  => 'success',
            'message' => 'Programmation supprimée'
        ], Response::HTTP_NO_CONTENT);
    }
}
