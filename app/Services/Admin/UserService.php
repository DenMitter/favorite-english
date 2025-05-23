<?php

namespace App\Services\Admin;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;

class UserService
{
    public function index(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return User::query()
            ->with(['roles' => function ($query) {
                $query->select('name');
            }])
            ->paginate(10, ['id', 'name', 'email', 'avatar'])
            ->withQueryString();
    }

    public function store(array $data): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
    {
        $data['password'] = Hash::make($data['password']);
        return User::query()->create($data);
    }

    /**
     * @throws Exception
     */
    public function show($id): \Illuminate\Database\Eloquent\Builder|array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
    {
        if (!User::query()->find($id)) {
            throw new Exception('User does not exist.');
        }

        return User::query()
            ->with(['roles' => function ($query) {
                $query->select('name');
            }])
            ->findOrFail($id, ['id', 'name', 'email', 'avatar']);
    }

    /**
     * @throws Exception
     */
    public function update($id, array $data): bool|int
    {
        if (!User::query()->find($id)) {
            throw new Exception('User does not exist.');
        }

        return User::query()
            ->findOrFail($id)
            ->update($data);
    }

    /**
     * @throws Exception
     */
    public function destroy($id): bool
    {
        if (!User::query()->find($id)) {
            throw new Exception('User does not exist.');
        }

        return User::query()->find($id)->delete();
    }
}
