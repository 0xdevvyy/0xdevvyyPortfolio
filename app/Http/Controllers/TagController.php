<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Action\Tag\Create;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
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
    public function store(StoreTagRequest $request, Tag $tag, Create $action): RedirectResponse
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
    public function show(Tag $tag): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag): void
    {
        //
    }
}
