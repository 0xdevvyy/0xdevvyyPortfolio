<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Action\Tag\Delete;
use App\Action\Tag\Store;
use App\Action\Tag\Update;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        Gate::authorize('viewAny', Tag::class);

        return Inertia::render('tag/Index', [
            'tags' => TagResource::collection(Tag::all()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('tag/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request, Tag $tag, Store $action): RedirectResponse
    {
        $action->handle($request->safe()->all(), $tag);

        Inertia::flash('toast', [
            'type' => 'successfull',
            'message' => 'Tag Successfully Created',
        ]);

        return to_route('auth.tag.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag): Response
    {
        Gate::authorize('view', $tag);

        return Inertia::render('tag/Show', [
            'tag' => new TagResource($tag),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag): Response
    {
        Gate::authorize('workWith', $tag);

        return Inertia::render('tag/Edit', [
            'tag' => new TagResource($tag),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag, Update $action): RedirectResponse
    {
        Gate::authorize('workWith', $tag);

        $action->update($request->safe()->all(), $tag);

        Inertia::flash('toast', [
            'type' => 'successfull',
            'message' => 'Tag Successfully Updated',
        ]);

        return to_route('auth.tag.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag, Delete $action): RedirectResponse
    {
        Gate::authorize('workWith', $tag);

        $action->destory($tag);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Tag Successfully Deleted',
        ]);

        return to_route('auth.tag.index');
    }
}
