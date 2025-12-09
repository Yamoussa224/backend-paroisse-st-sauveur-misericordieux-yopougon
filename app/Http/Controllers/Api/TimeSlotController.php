<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TimeSlot\StoreRequest;
use App\Http\Requests\TimeSlot\UpdateRequest;
use App\Http\Resources\TimeSlotResource;
use App\Repositories\Contracts\TimeSlotRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TimeSlotController extends Controller
{
    protected TimeSlotRepositoryInterface $repo;

    public function __construct(TimeSlotRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * List time slots (paginated)
     */
    public function index(Request $request)
    {
        $conditions = [];

        if ($request->filled('priest_id')) {
            $conditions[] = ['priest_id', '=', $request->priest_id];
        }

        if ($request->filled('weekday')) {
            $conditions[] = ['weekday', '=', $request->weekday];
        }

        if ($request->filled('is_available')) {
            $conditions[] = ['is_available', '=', $request->is_available];
        }

        $timeSlots = $this->repo->paginate(
            with: ['priest'],
            page: (int) $request->input('per_page', 15),
            conditions: $conditions,
            skip: (int) $request->input('skip', 0),
            orderBy: $request->input('sort_by', 'id'),
            direction: $request->input('sort_dir', 'desc'),
        );

        return TimeSlotResource::collection($timeSlots);
    }

    /**
     * Store a new time slot
     */
    public function store(StoreRequest $request)
    {
        $timeSlot = $this->repo->create($request->validated());

        return (new TimeSlotResource($timeSlot))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Show time slot details
     */
    public function show(string $id)
    {
        return new TimeSlotResource($this->repo->find($id, ['priest']));
    }

    /**
     * Update time slot
     */
    public function update(UpdateRequest $request, string $id)
    {
        $timeSlot = $this->repo->update($id, $request->validated());
        return new TimeSlotResource($timeSlot);
    }

    /**
     * Soft delete time slot
     */
    public function destroy(string $id)
    {
        $this->repo->delete($id);

        return response()->json([
            'status'  => 'success',
            'message' => 'Créneau supprimé'
        ], Response::HTTP_NO_CONTENT);
    }
}
