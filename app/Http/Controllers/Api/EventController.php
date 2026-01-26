<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Event\StoreRequest;
use App\Http\Requests\Event\UpdateRequest;

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
            with: ['participants'],
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
        $data = $request->validated();

        // Gérer l'upload d'image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // Option 1: Stocker dans storage/app/public/events
            $path = $image->store('events', 'public');

            // Mettre à jour le champ image avec le chemin relatif
            $data['image'] = 'storage/' . $path;
        }

        // Créer l'événement avec le repository
        $event = $this->repo->create($data);

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
        $data = $request->validated();

        $event = $this->repo->find($id); // récupérer l'événement existant

        // Gestion de l'image
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Supprimer l'ancienne image si elle existe
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }

            // Stocker la nouvelle image
            $path = $image->store('events', 'public');
            $data['image'] = 'storage/' . $path;
        }

        // Mettre à jour l'événement
        $event = $this->repo->update($id, $data);

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
