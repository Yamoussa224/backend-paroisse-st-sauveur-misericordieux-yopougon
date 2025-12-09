<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\StoreRequest;
use App\Http\Requests\Service\UpdateRequest;
use App\Http\Resources\ServiceResource;
use App\Repositories\Contracts\ServiceRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ServiceController extends Controller
{
    protected ServiceRepositoryInterface $repo;

    public function __construct(ServiceRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * List services (paginated)
     */
    public function index(Request $request)
    {
        $conditions = [];

        if ($request->filled('title')) {
            $conditions[] = ['title', 'LIKE', '%' . $request->title . '%'];
        }

        if ($request->filled('description')) {
            $conditions[] = ['description', 'LIKE', '%' . $request->description . '%'];
        }

        $services = $this->repo->paginate(
            with: [],
            page: (int) $request->input('per_page', 15),
            conditions: $conditions,
            skip: (int) $request->input('skip', 0),
            orderBy: $request->input('sort_by', 'id'),
            direction: $request->input('sort_dir', 'desc'),
        );

        return ServiceResource::collection($services);
    }

    /**
     * Store a new service
     */
    public function store(StoreRequest $request)
    {
        $service = $this->repo->create($request->validated());

        return (new ServiceResource($service))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Show service details
     */
    public function show(string $id)
    {
        return new ServiceResource($this->repo->find($id));
    }

    /**
     * Update service
     */
    public function update(UpdateRequest $request, string $id)
    {
        $service = $this->repo->update($id, $request->validated());
        return new ServiceResource($service);
    }

    /**
     * Soft delete service
     */
    public function destroy(string $id)
    {
        $this->repo->delete($id);

        return response()->json([
            'status'  => 'success',
            'message' => 'Service supprimé'
        ], Response::HTTP_NO_CONTENT);
    }
}
