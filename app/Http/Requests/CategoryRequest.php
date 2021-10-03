<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'min:5'],
            'desc' => ['string', 'nullable', 'min:10', 'max:250'],
            'entry' => ['required', 'string', 'max:2']
        ];
    }

    /**
     * Set custom validation messages to the request
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Title is required',
            'title.string' => 'Title is invalid',
            'title.min' => 'Title is too short',
            'desc.string' => 'Title is invalid',
            'desc.min' => 'Description is too short',
            'desc.max' => 'Description is too long',
            'entry.required' => 'Entry principle is required',
            'entry.string' => 'Entry principle is invalid',
            'entry.max' => 'Entry principle is too long'
        ];
    }
}
