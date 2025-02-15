<?php

namespace App\Http\Requests\Courses;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CoursesRequest extends FormRequest
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
            'lecturer_id' => [
                'required',
                'integer',
                'exists:users,id',
                Rule::exists('users', 'id')->where('role', 'Dosen'),

            ],

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'description' => [
                'nullable',
                'string'
            ],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute harus diisi.',
            'integer'  => ':attribute harus berupa angka.',
            'lecturer_id.exists'   => 'Data dosen tidak ditemukan.',
            'string'  => ':attribute harus berupa string.',
        ];
    }
}
