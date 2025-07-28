<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;

class CreateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string|min:3|max:200',
            'start_date' => 'date_format:Y-m-d|before_or_equal:end_date',
            'end_date' => 'date_format:Y-m-d|after_or_equal:start_date',
            'status' => 'required|integer'
        ];
    }
}
