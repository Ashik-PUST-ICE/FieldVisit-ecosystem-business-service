<?php

namespace App\Http\Controllers\Api\V1\Business;

use App\Http\Controllers\Controller;
use App\Http\Resources\Business\Visit\VisitResource;
use App\Http\Requests\Business\Visit\VisitRequest;
use App\Models\Business\Visit;
use App\Services\Applications\Api\ApiResponse;
use App\Services\Business\Visit\VisitService;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function __construct(protected VisitService $visitService) {}

    public function index(Request $request)
    {
        return $this->handleRequest(function () use ($request) {
            $visits = $this->visitService->index($request->only(['search', 'per_page']));

            return ApiResponse::success($visits, 'Visits retrieved successfully');
        });
    }

    public function store(VisitRequest $request)
    {
        return $this->handleRequest(function () use ($request) {
            $visit = $this->visitService->store($request->validated());

            return ApiResponse::success(new VisitResource($visit), 'Visit created successfully', 201);
        });
    }

    public function show(Visit $visit)
    {
        return $this->handleRequest(function () use ($visit) {
            $visit = $this->visitService->show($visit);

            return ApiResponse::success(new VisitResource($visit), 'Visit retrieved successfully');
        });
    }

    public function update(VisitRequest $request, Visit $visit)
    {
        return $this->handleRequest(function () use ($request, $visit) {
            $visit = $this->visitService->update($visit, $request->validated());

            return ApiResponse::success(new VisitResource($visit), 'Visit updated successfully');
        });
    }

    public function destroy(Visit $visit)
    {
        return $this->handleRequest(function () use ($visit) {
            $this->visitService->destroy($visit);

            return ApiResponse::success(null, 'Visit deleted successfully');
        });
    }

    public function uploadPhoto(Request $request, Visit $visit)
    {
        return $this->handleRequest(function () use ($request, $visit) {
            $request->validate([
                'photo' => ['required', 'image', 'max:2048'],
                'caption' => ['nullable', 'string', 'max:255'],
            ]);

            $path = $request->file('photo')->store('visit-photos', 'public');

            $photo = $visit->photos()->create([
                'company_id' => $visit->company_id,
                'path' => $path,
                'caption' => $request->caption,
            ]);

            return ApiResponse::success($photo, 'Photo uploaded successfully', 201);
        });
    }
}
