<?php

namespace App\Repositories;

use App\Http\Requests\UsersListRequest;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UsersListRepository
{
    public function getUsersList(UsersListRequest $request): LengthAwarePaginator
    {
        $defaultCount = config(key: 'pagination.default_users_per_page');
        $count = $request->input(key: 'count', default: $defaultCount);
        $page = $request->input(key: 'page', default: 1);

        return User::query()->paginate($count, ['*'], 'page', $page);
    }
}
