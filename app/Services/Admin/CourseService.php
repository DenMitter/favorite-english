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
    public function update($id, array $data): bool|int
    {
        if (!Course::query()->find($id)) {
            throw new Exception('Course does not exist.');
        }

        return Course::query()
            ->findOrFail($id)
            ->update($data);
    }
}
