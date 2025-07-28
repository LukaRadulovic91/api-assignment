<?php

namespace App\Http\Requests\Tasks;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
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
            'project_id' => 'required|integer|exists:projects,id',
            'task_name' => 'required|string',
            'description' => 'required|string|min:3|max:200',
            'due_date' => 'date_format:Y-m-d',
            'priority' => 'required|integer'
        ];
    }
}
