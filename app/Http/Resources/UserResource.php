<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use OpenApi\Attributes as OA;

/** @mixin User */
#[OA\Schema(
    schema: 'UserResource',
    title: 'User',
    description: 'User resource',
    required: ['id', 'name', 'email', 'phone', 'position_id', 'position', 'photo'],
    properties: [
        new OA\Property(property: 'id', type: 'integer', minimum: 1, example: 2, description: 'User id from database'),
        new OA\Property(property: 'name', type: 'string', example: 'Maxwell Skiles', description: 'User name'),
        new OA\Property(property: 'email', type: 'string', example: 'imelda90@hotmail.com', description: 'User email'),
        new OA\Property(property: 'phone', type: 'string', example: '+380677564422', description: 'User phone'),
        new OA\Property(property: 'position_id', type: 'integer', example: 1, description: 'Position id of user'),
        new OA\Property(property: 'position', type: 'string', example: 'Lawyer', description: 'Position name'),
        new OA\Property(
            property: 'photo',
            type: 'string',
            example: 'https://abz.my-test.website/storage/images/users/17338578606758924472914.jpg',
            description: 'User photo'
        ),
    ]
)]
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'position_id' => $this->position_id,
            'position' => optional($this->position)->name,
            'registration_timestamp' => Carbon::parse($this->created_at)->timestamp,
            'photo' => $this->photo,
        ];
    }
}
