<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Action\Project\Update;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    public function index(): Response
    {
        $projects = Project::query()->with('tags')->where('is_published', true)->get(); // testing first, then i will add it in a query class. ex: isPublished

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
        $projects = Project::query()->with('tags')->get();

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
            'tags' => $tags,
        ]);
    }

    public function update(UpdateProjectRequest $request, Project $project, Update $action): RedirectResponse
    {
        $attr = $request->safe()->except(['tags']);
        $action->update($request->safe()->all(), $project);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Successfully Updated',
        ]);

        return to_route('auth.project.edit', $project->slug);

        // if($screenshot) .....$project->screenshots->create([]) ..no update only add
        // if(tag) ..... same as the screenshot

        // second approach:

        // if(screenshot){$screenshot->create($request->safe()->only('screenshots'))}
        // the tag can be added in the update action because it is a pivot table i can just sync it
    }
}
