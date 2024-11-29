<?php

namespace App\Repositories;

use App\Exceptions\UserNotFoundException;
use App\Http\Requests\UserShowRequest;
use App\Models\User;

class UserShowRepository
{
    public function getUserById(UserShowRequest $request)
    {
        $user = User::find($request->route('id'));

        if (is_null($user)) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
