<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount(['articles' => fn ($q) => $q->published()])->get();

        $query = Article::published()
            ->with(['author', 'category', 'tags'])
            ->latest('published_at');

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->category));
        }

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(fn ($q) =>
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
            );
        }

        $articles  = $query->paginate(9)->withQueryString();
        $featured  = Article::published()->with(['author', 'category'])->latest('published_at')->first();

        return view('pages.article', compact('articles', 'categories', 'featured'));
    }

    public function show($slug)
    {
        $article = Article::published()
            ->with(['author', 'category', 'tags'])
            ->where('slug', $slug)
            ->firstOrFail();

        $related = Article::published()
            ->with(['author', 'category'])
            ->where('id', '!=', $article->id)
            ->where('category_id', $article->category_id)
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('pages.article-detail', compact('article', 'related'));
    }
}
