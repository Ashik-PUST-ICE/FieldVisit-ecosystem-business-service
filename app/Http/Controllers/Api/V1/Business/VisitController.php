<?php

namespace App\Http\Controllers\Api\V1\Business;

use App\Http\Controllers\Controller;
use App\Http\Resources\Business\Visit\VisitResource;
use App\Http\Requests\Business\Visit\VisitRequest;
use App\Http\Requests\Business\Visit\StartVisitRequest;
use App\Http\Requests\Business\Visit\VerifyLocationRequest;
use App\Http\Requests\Business\Visit\CompleteVisitRequest;
use App\Http\Requests\Business\Outlet\VerifyQrRequest;
use App\Models\Business\Visit;
use App\Services\Applications\Api\ApiResponse;
use App\Services\Business\Visit\VisitService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

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

            $photo = $this->visitService->uploadPhoto($visit, $request->file('photo'), $request->caption);

            return ApiResponse::success($photo, 'Photo uploaded successfully', 201);
        });
    }

    public function verifyQr(VerifyQrRequest $request)
    {
        return $this->handleRequest(function () use ($request) {
            $result = $this->visitService->verifyQr($request->qr_token);

            return ApiResponse::success($result, 'QR verified successfully');
        });
    }

    public function startVisit(StartVisitRequest $request)
    {
        return $this->handleRequest(function () use ($request) {
            $visit = $this->visitService->startVisit($request->validated());

            return ApiResponse::success(new VisitResource($visit), 'Visit started successfully', 201);
        });
    }

    public function verifyLocation(VerifyLocationRequest $request, Visit $visit)
    {
        return $this->handleRequest(function () use ($request, $visit) {
            $visit = $this->visitService->verifyLocation($visit, $request->validated());

            return ApiResponse::success(new VisitResource($visit), 'Location verified successfully');
        });
    }

    public function completeVisit(CompleteVisitRequest $request, Visit $visit)
    {
        return $this->handleRequest(function () use ($request, $visit) {
            $visit = $this->visitService->completeVisit(
                $visit,
                $request->validated(),
                $request->file('photos'),
                $request->input('competitors'),
                $request->input('products')
            );

            return ApiResponse::success(new VisitResource($visit), 'Visit completed successfully');
        });
    }
}
