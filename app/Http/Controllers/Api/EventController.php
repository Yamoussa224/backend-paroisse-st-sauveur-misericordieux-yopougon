<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\StoreRequest;
use App\Http\Requests\Event\UpdateRequest;
use App\Http\Resources\EventResource;
use App\Repositories\EventRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventController extends Controller
{
    protected EventRepository $repo;

    public function __construct(EventRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        $conditions = [];

        if ($request->filled('title')) {
            $conditions[] = ['title', 'LIKE', '%' . $request->title . '%'];
        }

        if ($request->filled('status')) {
            $conditions[] = ['status', '=', $request->status];
        }

        if ($request->filled('from')) {
            $conditions[] = ['date', '>=', $request->from];
        }

        if ($request->filled('to')) {
            $conditions[] = ['date', '<=', $request->to];
        }

        $events = $this->repo->paginate(
            with: [],
            page: (int) $request->input('per_page', 15),
            conditions: $conditions,
            skip: (int) $request->input('skip', 0),
            orderBy: $request->input('sort_by', 'id'),
            direction: $request->input('sort_dir', 'desc'),
        );

        return EventResource::collection($events);
    }

    public function store(StoreRequest $request)
    {
        $event = $this->repo->create($request->validated());
        return (new EventResource($event))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(string $id): EventResource
    {
        return new EventResource($this->repo->find($id));
    }

    public function update(UpdateRequest $request, string $id): EventResource
    {
        $event = $this->repo->update($id, $request->validated());
        return new EventResource($event);
    }

    public function destroy(string $id): JsonResponse
    {
        $this->repo->delete($id);
        return response()->json([
            'status'  => 'success',
            'message' => 'Event supprimée'
        ], Response::HTTP_NO_CONTENT);
    }
}
