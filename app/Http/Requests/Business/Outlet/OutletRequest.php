<?php

namespace App\Http\Requests\Business\Outlet;

use App\Models\Business\Outlet;
use Illuminate\Foundation\Http\FormRequest;

class OutletRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isUpdate = $this->route('outlet') instanceof Outlet;

        return [
            'name' => [$isUpdate ? 'sometimes' : 'required', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:255'],
            'qr_token' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'latitude' => ['nullable', 'string', 'max:255'],
            'longitude' => ['nullable', 'string', 'max:255'],
            'geofence_radius' => ['nullable', 'integer'],
            'phone' => ['nullable', 'string', 'max:20'],
            'owner_name' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'in:0,1'],
        ];
    }
}
