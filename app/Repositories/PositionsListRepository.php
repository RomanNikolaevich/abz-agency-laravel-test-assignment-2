<?php

namespace App\Repositories;

use App\Exceptions\PositionsNotFoundException;
use App\Models\Position;
use Illuminate\Database\Eloquent\Collection;

class PositionsListRepository
{
    public function getPositions(): Collection
    {
        $positions = Position::all();

        if ($positions->isEmpty()) {
            throw new PositionsNotFoundException();
        }

        return $positions;
    }
}
