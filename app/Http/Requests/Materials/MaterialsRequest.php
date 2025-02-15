<?php

namespace App\Http\Requests\Materials;

use Illuminate\Foundation\Http\FormRequest;

class MaterialsRequest extends FormRequest
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
            'courses_id' => [
                'integer',
                'required',
                'exists:courses,id'
            ],

            'title' => [
                'required',
                'string',
                'max:255'
            ],

            'file_path' => [
                'required',
                'file',
                'mimes:pdf',
                'max:5000'
            ],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute harus diisi.',
            'integer'  => ':attribute harus berupa angka.',
            'courses_id.exists'   => 'Data courses tidak ditemukan.',
            'string'  => ':attribute harus berupa string.',
            'file'    => ':attribute harus berupa file.',
            'mimes'   => ':attribute harus berupa file PDF.',
            'max'     => ':attribute maksimal 5MB.',
        ];
    }
}
