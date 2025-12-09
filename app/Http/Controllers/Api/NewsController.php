<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\StoreRequest;
use App\Http\Requests\News\UpdateRequest;
use App\Http\Resources\NewsResource;
use App\Repositories\Contracts\NewRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NewsController extends Controller
{
    protected NewRepositoryInterface $repo;

    public function __construct(NewRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * List news (paginated)
     */
    public function index(Request $request)
    {
        $conditions = [];

        if ($request->filled('title')) {
            $conditions[] = ['title', 'LIKE', '%' . $request->title . '%'];
        }

        if ($request->filled('author')) {
            $conditions[] = ['author', 'LIKE', '%' . $request->author . '%'];
        }

        if ($request->filled('category')) {
            $conditions[] = ['category', '=', $request->category];
        }

        if ($request->filled('status')) {
            $conditions[] = ['new_status', '=', $request->status];
        }

        if ($request->filled('from')) {
            $conditions[] = ['published_at', '>=', $request->from];
        }

        if ($request->filled('to')) {
            $conditions[] = ['published_at', '<=', $request->to];
        }

        $news = $this->repo->paginate(
            with: [],
            page: (int) $request->input('per_page', 15),
            conditions: $conditions,
            skip: (int) $request->input('skip', 0),
            orderBy: $request->input('sort_by', 'id'),
            direction: $request->input('sort_dir', 'desc'),
        );

        return NewsResource::collection($news);
    }

    /**
     * Store a new news
     */
    public function store(StoreRequest $request)
    {
        $newsItem = $this->repo->create($request->validated());

        return (new NewsResource($newsItem))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Show news details
     */
    public function show(string $id)
    {
        return new NewsResource($this->repo->find($id));
    }

    /**
     * Update news
     */
    public function update(UpdateRequest $request, string $id)
    {
        $newsItem = $this->repo->update($id, $request->validated());
        return new NewsResource($newsItem);
    }

    /**
     * Soft delete news
     */
    public function destroy(string $id)
    {
        $this->repo->delete($id);

        return response()->json([
            'status'  => 'success',
            'message' => 'News supprimée'
        ], Response::HTTP_NO_CONTENT);
    }
}
