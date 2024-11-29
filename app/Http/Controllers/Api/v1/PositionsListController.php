<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\PositionsNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\PositionResource;
use App\Repositories\PositionsListRepository;

class PositionsListController extends Controller
{
    public function __construct(private readonly PositionsListRepository $positionsList)
    {
    }

    public function __invoke()
    {
        try {
            $positions = $this->positionsList->getPositions();

            return response()->json([
                'success' => true,
                'positions' => PositionResource::collection($positions),
            ], 200);
        } catch (PositionsNotFoundException $e) {
            return $e->render();
        }
    }

}
