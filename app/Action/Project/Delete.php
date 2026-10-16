<?php

declare(strict_types=1);

namespace App\Action\Project;

use App\Models\Project;

final readonly class Delete
{
    public function delete(Project $project): void
    {
        $project->delete();
    }
}
