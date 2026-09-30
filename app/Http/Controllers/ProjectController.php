<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Inertia\Response;

class ProjectController extends Controller
{
    public function index(): Response
    {
        $projects = Project::query()->with(['screenshots', 'tags'])->where('is_published', true)->get(); // testing first, then i will add it in a query class. ex: isPublished

        return inertia('landing/Projects', [
            'projects' => ProjectResource::collection($projects),
        ]);
    }
}
