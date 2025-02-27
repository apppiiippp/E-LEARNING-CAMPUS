<?php

namespace App\Http\Requests\Discussions;

use Illuminate\Foundation\Http\FormRequest;

class DiscussionsRequest extends FormRequest
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
               'exists:courses,id',
            ],


            'content' => [
                'required',
                'string',
            ],
        ];
    }
}
