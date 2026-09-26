<?php

namespace App\Services\Business\Beat;

use App\Models\Business\Beat;
use Illuminate\Pagination\LengthAwarePaginator;

class BeatService
{
    public function index(array $filters): LengthAwarePaginator
    {
        return Beat::query()
            ->when($filters['search'] ?? null, fn($q, $search) => $q->where('name', 'like', "%{$search}%"))
            ->latest()
            ->paginate($filters['per_page'] ?? 15);
    }

    public function today(array $filters): LengthAwarePaginator
    {
        return Beat::query()
            ->whereDate('date', now()->toDateString())
            ->latest()
            ->paginate($filters['per_page'] ?? 15);
    }

    public function store(array $data): Beat
    {
        return Beat::create($data);
    }

    public function show(Beat $beat): Beat
    {
        return $beat->load('outlets', 'assignedUser');
    }

    public function update(Beat $beat, array $data): Beat
    {
        $beat->update($data);

        return $beat;
    }

    public function destroy(Beat $beat): void
    {
        $beat->delete();
    }
}
