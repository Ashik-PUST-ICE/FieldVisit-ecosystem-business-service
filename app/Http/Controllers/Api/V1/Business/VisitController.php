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
use App\Models\Business\Outlet;
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

    public function verifyQr(VerifyQrRequest $request)
    {
        return $this->handleRequest(function () use ($request) {
            $outlet = Outlet::where('qr_token', $request->qr_token)->firstOrFail();
            $user = auth()->user();

            $assigned = \App\Models\Business\OutletAssignment::where('outlet_id', $outlet->id)
                ->where('user_id', $user->id)
                ->where('status', 1)
                ->exists();

            if (! $assigned) {
                return ApiResponse::error('This outlet is not assigned to you.', 403);
            }

            $existingPending = Visit::where('outlet_id', $outlet->id)
                ->where('user_id', $user->id)
                ->where('status', 'pending')
                ->exists();

            if ($existingPending) {
                return ApiResponse::error('You already have a pending visit for this outlet.', 409);
            }

            return ApiResponse::success([
                'outlet' => new \App\Http\Resources\Business\Outlet\OutletResource($outlet),
                'can_visit' => true,
            ], 'QR verified successfully');
        });
    }

    public function startVisit(StartVisitRequest $request)
    {
        return $this->handleRequest(function () use ($request) {
            $user = auth()->user();
            $outlet = Outlet::findOrFail($request->outlet_id);

            $visit = Visit::create([
                'company_id' => $outlet->company_id,
                'outlet_id' => $outlet->id,
                'user_id' => $user->id,
                'client_id' => $request->client_id,
                'status' => 'pending',
                'verification_status' => false,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'outlet_latitude' => $outlet->latitude,
                'outlet_longitude' => $outlet->longitude,
                'allowed_radius_meters' => $outlet->geofence_radius,
                'started_at' => now(),
            ]);

            return ApiResponse::success(new VisitResource($visit), 'Visit started successfully', 201);
        });
    }

    public function verifyLocation(VerifyLocationRequest $request, Visit $visit)
    {
        return $this->handleRequest(function () use ($request, $visit) {
            if ($visit->status !== 'pending') {
                return ApiResponse::error('Visit is not in pending state.', 400);
            }

            $outlet = $visit->outlet;

            $distance = $this->calculateDistance(
                (float) $request->latitude,
                (float) $request->longitude,
                (float) $outlet->latitude,
                (float) $outlet->longitude
            );

            $allowedRadius = $outlet->geofence_radius ?? 100;
            $isVerified = $distance <= $allowedRadius;

            $visit->update([
                'verification_status' => $isVerified,
                'distance_meters' => round($distance, 2),
                'allowed_radius_meters' => $allowedRadius,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            if (! $isVerified) {
                return ApiResponse::error("You are {$distance} meters away. Allowed radius: {$allowedRadius} meters.", 422);
            }

            return ApiResponse::success(new VisitResource($visit), 'Location verified successfully');
        });
    }

    public function completeVisit(CompleteVisitRequest $request, Visit $visit)
    {
        return $this->handleRequest(function () use ($request, $visit) {
            if (! $visit->verification_status) {
                return ApiResponse::error('Location verification is required before completing visit.', 422);
            }

            $visit->update([
                'status' => 'completed',
                'completed_at' => now(),
                'remarks' => $request->remarks,
                'display_condition' => $request->display_condition,
                'display_quantity' => $request->display_quantity,
            ]);

            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $path = $photo->store('visit-photos', 'public');
                    $visit->photos()->create([
                        'company_id' => $visit->company_id,
                        'path' => $path,
                        'caption' => null,
                    ]);
                }
            }

            if ($request->filled('competitors')) {
                foreach ($request->competitors as $competitorData) {
                    $visit->competitors()->create([
                        'company_id' => $visit->company_id,
                        'competitor_id' => $competitorData['competitor_id'] ?? null,
                        'notes' => $competitorData['notes'] ?? null,
                    ]);
                }
            }

            if ($request->filled('products')) {
                foreach ($request->products as $productData) {
                    $visit->products()->create([
                        'company_id' => $visit->company_id,
                        'product_id' => $productData['product_id'] ?? null,
                        'quantity' => $productData['quantity'] ?? null,
                        'availability' => $productData['availability'] ?? null,
                        'notes' => $productData['notes'] ?? null,
                    ]);
                }
            }

            return ApiResponse::success(new VisitResource($visit), 'Visit completed successfully');
        });
    }

    private function calculateDistance(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $earthRadius = 6371;

        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
             cos($latFrom) * cos($latTo) *
             sin($lonDelta / 2) * sin($lonDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c * 1000;
    }
}
