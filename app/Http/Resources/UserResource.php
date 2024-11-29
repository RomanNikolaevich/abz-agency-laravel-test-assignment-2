<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

/** @mixin User */
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
