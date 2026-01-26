<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ParticipantEventResource;
use App\Http\Requests\ParticipantEvent\StoreRequest;
use App\Http\Requests\ParticipantEvent\UpdateRequest;
use App\Repositories\Contracts\ParticipantEventRepositoryInterface;

class ParticipantEventController extends Controller
{
    protected ParticipantEventRepositoryInterface $repo;

    public function __construct(ParticipantEventRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        $conditions = [];

        if ($request->filled('fullname')) {
            $conditions[] = ['fullname', 'LIKE', '%' . $request->fullname . '%'];
        }

        if ($request->filled('email')) {
            $conditions[] = ['email', 'LIKE', '%' . $request->email . '%'];
        }

        if ($request->filled('event_id')) {
            $conditions[] = ['event_id', '=', $request->event_id];
        }

        $participants = $this->repo->paginate(
            with: ['event'],
            page: (int) $request->input('per_page', 15),
            conditions: $conditions,
            skip: (int) $request->input('skip', 0),
            orderBy: $request->input('sort_by', 'id'),
            direction: $request->input('sort_dir', 'desc'),
        );

        return ParticipantEventResource::collection($participants);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $participant = $this->repo->create($data);

        return (new ParticipantEventResource($participant->load('event')))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(string $id): ParticipantEventResource
    {
        return new ParticipantEventResource(
            $this->repo->find($id, ['event'])
        );
    }

    public function update(UpdateRequest $request, string $id): ParticipantEventResource
    {
        $data = $request->validated();

        $participant = $this->repo->update($id, $data);

        return new ParticipantEventResource(
            $participant->load('event')
        );
    }

    public function destroy(string $id): JsonResponse
    {
        $this->repo->delete($id);

        return response()->json([
            'status'  => 'success',
            'message' => 'Participant supprimé'
        ], Response::HTTP_NO_CONTENT);
    }
}
