<?php

namespace App\Http\Requests\Submissions;

use Illuminate\Foundation\Http\FormRequest;

class SubmissionsRequest extends FormRequest
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
            'assignments_id' => [
                'required',
                'integer',
            ],

           

            'file_path' => [
                'required',
                'file',
                'mimes:pdf',
                'max:10000',
            ],

            'score' => [
                'nullable',
                'integer',
               'min:0',
            ],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute harus diisi.',
            'integer'  => ':attribute harus berupa angka.',
            'string'  => ':attribute harus berupa string.',
            'file'    => ':attribute harus berupa file.',
            'mimes'   => ':attribute harus berupa file PDF.',
            'max'     => ':attribute maksimal 10MB.',
        ];
    }
}
