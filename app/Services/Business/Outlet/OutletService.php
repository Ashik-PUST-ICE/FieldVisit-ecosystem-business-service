<?php

namespace App\Services\Business\Outlet;

use App\Models\Business\Outlet;
use Illuminate\Pagination\LengthAwarePaginator;

class OutletService
{
    public function index(array $filters): LengthAwarePaginator
    {
        return Outlet::query()
            ->when($filters['search'] ?? null, fn($q, $search) => $q->where('name', 'like', "%{$search}%"))
            ->latest()
            ->paginate($filters['per_page'] ?? 15);
    }

    public function store(array $data): Outlet
    {
        return Outlet::create($data);
    }

    public function show(Outlet $outlet): Outlet
    {
        return $outlet;
    }

    public function update(Outlet $outlet, array $data): Outlet
    {
        $outlet->update($data);

        return $outlet;
    }

    public function destroy(Outlet $outlet): void
    {
        $outlet->delete();
    }
}
