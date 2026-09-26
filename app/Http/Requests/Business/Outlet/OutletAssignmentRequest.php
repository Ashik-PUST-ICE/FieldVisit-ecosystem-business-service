<?php

namespace App\Http\Requests\Business\Outlet;

use App\Models\Business\OutletAssignment;
use Illuminate\Foundation\Http\FormRequest;

class OutletAssignmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isUpdate = $this->route('assignment') instanceof OutletAssignment;

        return [
            'outlet_id' => [$isUpdate ? 'sometimes' : 'required', 'exists:outlets,id'],
            'user_id' => [$isUpdate ? 'sometimes' : 'required', 'exists:users,id'],
            'status' => ['nullable', 'in:0,1'],
        ];
    }
}
