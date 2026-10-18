<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Action\Blog\Store;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Container\Attributes\Authenticated;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class BlogController extends Controller
{
    public function indexAuth(#[Authenticated] User $user): Response
    {
        $blogs = $user->blogs()
            ->latest('created_at')
            ->get();

        return Inertia::render('blog/Index', [
            'blogs' => BlogResource::collection($blogs),
        ]);
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
    public function create(): Response
    {
        return Inertia::render('blog/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request, #[Authenticated] User $user, Store $action): RedirectResponse
    {
        $action->store($request->safe()->all(), $user);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Blog Successfully Created',
        ]);

        return to_route('auth.blog.index');
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
    public function edit(Blog $blog): Response
    {
        Gate::authorize('workWith', $blog);

        return Inertia::render('blog/Edit', [
            'blog' => new BlogResource($blog),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog): RedirectResponse
    {
        Gate::authorize('workWith', $blog);

        $data = $request->validated();
        $data['published_at'] ??= now();
        $blog->update($data);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Blog Successfully Updated',
        ]);

        return to_route('auth.blog.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog): RedirectResponse
    {
        Gate::authorize('workWith', $blog);

        $blog->delete();

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Blog Successfully Deleted',
        ]);

        return to_route('auth.blog.index');
    }
}
