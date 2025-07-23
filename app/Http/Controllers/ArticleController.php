<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Traits\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller
{
    use ResponseHelper;

     public function publicIndex(Request $request)
    {
        $query = Article::where('status', 'published');

        if ($request->has('author')) {
            $query->where('author_id', $request->author);
        }

        $articles = $query->get();

        return $this->successResponse(
            ArticleResource::collection($articles),
            'Successfully Fetched Published Articles',
            200
        );
    }

    public function publicShow(string $slug)
    {
        $article = Article::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return $this->successResponse(
            new ArticleResource($article),
            'Successfully Fetched Published Article',
            200
        );
    }

    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = Article::query()->where('author_id', $request->user()->id);

        when($request->has('status'), fn() => $query->where('status', $request->status));
        $articles = $query->get();
        return $this->successResponse(
            ArticleResource::collection($articles),
            'Successfully Fetched Articles',
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request, Article $article)
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
    public function show(string $slug)
    {
        $article = Article::where('slug', $slug)->get();
        return $this->successResponse(
            ArticleResource::collection($article),
            'Successfully Fetched Article',
            200,
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $data = $request->validated();
        $article->update($data);
        return $this->successResponse(
            new ArticleResource($article),
            'Successfully Updated Article',
            200,
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return $this->successResponse(
            null,
            'Successfully Trashed Article',
            200,
        );
    }

    public function trashed(Request $request)
    {
        $articles = Article::onlyTrashed()->where('author_id', $request->user()->id)->get();
        return $this->successResponse(
            ArticleResource::collection($articles),
            'Successfully Fetched Trashed Article',
            200,
        );
    }

    public function restore(Request $request, $id)
    {
        $article = Article::onlyTrashed()->where('id',  $id)->where('author_id', $request->user()->id)->firstOrFail();
        $article->restore();
        return $this->successResponse(
            null,
            'Successfully Restored Article',
            200,
        );
    }
}
