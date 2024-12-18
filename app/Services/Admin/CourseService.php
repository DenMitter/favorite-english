<?php

namespace App\Services\Admin;

use App\Models\Course;
use Exception;

class CourseService
{
    public function index(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Course::query()
            ->with(['tags' => function ($query) {
                $query->select('name');
            }])
            ->paginate(10, ['id', 'name'])
            ->withQueryString();
    }

    public function store(array $data): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
    {
        return Course::query()->create($data);
    }

    /**
     * @throws Exception
     */
    public function show($id): \Illuminate\Database\Eloquent\Builder|array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
    {
        if (!Course::query()->find($id)) {
            throw new Exception('Course does not exist.');
        }

        return Course::query()
            ->with(['tags' => function ($query) {
                $query->select('name');
            }])
            ->findOrFail($id, ['id', 'name', 'description', 'price', 'color', 'image']);
    }

    /**
     * @throws Exception
     */
    public function update($id, array $data): bool|int
    {
        if (!Course::query()->find($id)) {
            throw new Exception('Course does not exist.');
        }

        return Course::query()
            ->findOrFail($id)
            ->update($data);
    }

    /**
     * @throws Exception
     */
    public function destroy($id): bool
    {
        if (!Course::query()->find($id)) {
            throw new Exception('Course does not exist.');
        }

        return Course::query()->find($id)->delete();
    }
}
