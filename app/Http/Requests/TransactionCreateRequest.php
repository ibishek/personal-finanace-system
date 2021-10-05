<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionCreateRequest extends FormRequest
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
            'desc' => ['string', 'nullable', 'min:8'],
            'mode' => ['required'],
            'category' => ['required'],
            'amount' => ['required']
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
            'title.required' => 'Transaction title is required',
            'title.string' => 'Invalid transaction title',
            'title.min' => 'Transaction title is too short',
            'desc.string' => 'Invalid description',
            'desc.min' => 'Description is too short',
            'mode.required' => 'Payment mode is required',
            'category.required' => 'Transaction category is required',
            'amount.required' => 'Amount is required',
        ];
    }
}
