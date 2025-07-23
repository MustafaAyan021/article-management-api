<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest\StoreArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Traits\ResponseHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest\UpdateArticleRequest;

class ArticleController extends Controller
{
    use ResponseHelper;

    public function publicIndex(Request $request): JsonResponse
    {
        $query = Article::where('status','published');
        when($request->has('author'), fn() => $query->where('author_id', $request->author_id));
        $articles = $query->get();
        return $this->successResponse(
            ArticleResource::collection($articles),
            'Successfully Fetched Published Articles',
        );
    }

    public function publicShow(string $slug): JsonResponse
    {
        $article = Article::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return $this->successResponse(
            new ArticleResource($article),
            'Successfully Fetched Published Article',
        );
    }

    /**
     * Display a listing of the resource.
     */

    public function index(Request $request): JsonResponse
    {
        $query = Article::query()->where('author_id', $request->user()->id);

        when($request->has('status'), fn() => $query->where('status', $request->status));
        $articles = $query->get();
        return $this->successResponse(
            ArticleResource::collection($articles),
            'Successfully Fetched Articles',
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request, Article $article): JsonResponse
    {
        $data = $request->validated();
        $data['author_id'] = $request->user()->id;
        $article = Article::create($data);

        return $this->successResponse(
            new ArticleResource($article),
            'Successfully Created Article',
            201,
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug): JsonResponse
    {
        $article = Article::where('slug', $slug)->get();
        return $this->successResponse(
            ArticleResource::collection($article),
            'Successfully Fetched Article',
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article): JsonResponse
    {
        $data = $request->validated();
        $article->update($data);
        return $this->successResponse(
            new ArticleResource($article),
            'Successfully Updated Article',
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article): JsonResponse
    {
        $article->delete();
        return $this->successResponse(
            null,
            'Successfully Trashed Article',
            204,
        );
    }

    public function trashed(Request $request): JsonResponse
    {
        $articles = Article::onlyTrashed()->where('author_id', $request->user()->id)->get();
        return $this->successResponse(
            ArticleResource::collection($articles),
            'Successfully Fetched Trashed Article',
        );
    }

    public function restore(Request $request, $id): JsonResponse
    {
        $article = Article::onlyTrashed()->where('id',  $id)->where('author_id', $request->user()->id)->firstOrFail();
        $article->restore();
        return $this->successResponse(
            null,
            'Successfully Restored Article',
            204,
        );
    }
}
