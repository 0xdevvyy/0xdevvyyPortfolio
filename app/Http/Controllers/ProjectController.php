<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Action\Project\Create;
use App\Action\Project\Delete;
use App\Action\Project\Update;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\TagResource;
use App\Models\Project;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Container\Attributes\Authenticated;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    public function index(): Response
    {
        $projects = Project::query()->with('tags')->where('is_published', true)->latest()->get(); // testing first, then i will add it in a query class. ex: isPublished

        return Inertia::render('landing/Projects', [
            'projects' => ProjectResource::collection($projects),
        ]);
    }

    public function show(string $slug): Response
    {
        $project = Project::with(['tags', 'screenshots'])
            ->where('slug', $slug)
            ->firstOrFail();

        return Inertia::render('project/Show', [
            'project' => new ProjectResource($project),
        ]);
    }

    public function indexAuth(): Response
    {
        $projects = Project::query()->with('tags')->latest()->get();

        return Inertia::render('project/Index', [
            'projects' => ProjectResource::collection($projects),
        ]);
    }

    public function edit(string $slug): Response
    {
        $project = Project::query()
            ->with(['tags', 'screenshots'])
            ->where('slug', $slug)
            ->firstOrFail();

        $tags = Tag::query()
            ->orderBy('name')
            ->get();

        return Inertia::render('project/Edit', [
            'project' => new ProjectResource($project),
            'tags' => TagResource::collection($tags),
        ]);
    }

    public function update(UpdateProjectRequest $request, Project $project, Update $action): RedirectResponse
    {

        $action->update($request->safe()->all(), $project);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Successfully Updated',
        ]);

        return to_route('auth.project.edit', $project->slug);
    }

    public function create(): Response
    {
        $tags = Tag::query()
            ->orderBy('name')
            ->get();

        return Inertia::render('project/Create', [
            'tags' => TagResource::collection($tags),
        ]);
    }

    public function store(StoreProjectRequest $request, #[Authenticated()] User $user, Create $action): RedirectResponse
    {
        $action->handle($request->safe()->all(), $user);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Project Successfully Created!!',
        ]);

        return to_route('auth.project.index');
    }

    public function delete(Project $project, Delete $action): RedirectResponse
    {
        $action->delete($project);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Project Successfully Deleted!!',
        ]);

        return to_route('auth.project.index');
    }
}
