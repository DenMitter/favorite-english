<?php

namespace App\Services\Admin;

use App\Models\Course;

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
}
