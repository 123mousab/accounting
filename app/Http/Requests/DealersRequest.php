<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DealersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name.*' => 'required',
            'mobile' => 'required|unique:dealers',
            'email' => 'required|string|email|max:255|unique:dealers',
            'status' => 'required|bool'
        ];
    }
}
