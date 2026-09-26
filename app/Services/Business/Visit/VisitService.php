<?php

namespace App\Services\Business\Visit;

use App\Models\Business\Visit;
use Illuminate\Pagination\LengthAwarePaginator;

class VisitService
{
    public function index(array $filters): LengthAwarePaginator
    {
        return Visit::query()
            ->when($filters['search'] ?? null, function ($q, $search) {
                $q->where('status', 'like', "%{$search}%")
                    ->orWhere('notes', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate($filters['per_page'] ?? 15);
    }

    public function store(array $data): Visit
    {
        return Visit::create($data);
    }

    public function show(Visit $visit): Visit
    {
        return $visit->load('photos', 'competitors', 'products');
    }

    public function update(Visit $visit, array $data): Visit
    {
        $visit->update($data);

        return $visit;
    }

    public function destroy(Visit $visit): void
    {
        $visit->delete();
    }
}
