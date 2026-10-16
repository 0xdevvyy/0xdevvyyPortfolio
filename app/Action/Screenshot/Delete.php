<?php

declare(strict_types=1);

namespace App\Action\Screenshot;

use App\Models\Screenshot;

final readonly class Delete
{
    public function delete(Screenshot $screenshot): void
    {
        $screenshot->delete();
    }
}
