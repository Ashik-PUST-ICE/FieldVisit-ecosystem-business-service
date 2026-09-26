<?php

namespace App\Http\Requests\Business\Beat;

use App\Models\Business\Beat;
use Illuminate\Foundation\Http\FormRequest;

class BeatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isUpdate = $this->route('beat') instanceof Beat;

        return [
            'name' => [$isUpdate ? 'sometimes' : 'required', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:255'],
            'assigned_user_id' => ['nullable', 'exists:users,id'],
            'date' => ['nullable', 'date'],
            'status' => ['nullable', 'in:0,1'],
        ];
    }
}
