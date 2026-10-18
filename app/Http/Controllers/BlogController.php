<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Inertia\Inertia;
use Inertia\Response;

class BlogController extends Controller
{
    public function authIndex(): void
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $blogs = Blog::query()
            ->where('is_published', true)
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->get();

        return Inertia::render('landing/Blogs', [
            'blogs' => BlogResource::collection($blogs),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug): Response
    {
        $blog = Blog::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->where('published_at', '<=', now())
            ->firstOrFail();

        return Inertia::render('blog/Show', [
            'blog' => new BlogResource($blog),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog): void
    {
        //
    }
}
