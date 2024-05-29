<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'dni' => 'required|integer|unique:students,dni,'.$this->student->dni,
            'name' => 'required|string',
            'lastname' => 'required|string',
            'group' => 'nullable|string',
            'birthdate' => 'nullable|date',
            'curso'=> 'nullable|string'
        ];
    }
}