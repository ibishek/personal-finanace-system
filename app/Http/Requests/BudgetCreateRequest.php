<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BudgetCreateRequest extends FormRequest
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
        $weeks = now()->addDays(5)->format('Y-m-d');
        return [
            'title' => ['required', 'string', 'min:5'],
            'desc' => ['string', 'nullable'],
            'alloted_amount' => ['required'],
            'expiry_date' => ['required', 'date', 'date_format:Y-m-d', 'after:' . $weeks]
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
            'title.required' => 'Budget title is required',
            'title.string' => 'Invalid budget title',
            'title.min' => 'Budget title is too short',
            'desc.string' => 'Invalid description',
            'alloted_amount.required' => 'Estimated amount is required',
            'expiry_date.required' => 'Expiry date is required',
            'expiry_date.date' => 'Invalid date format',
            'expiry_date.date_format' => 'Expiry date format must be Year-Months-Day',
            'expiry_date.after' => 'Budget duration must be atleast one week is required'
        ];
    }
}
