<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
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
}
