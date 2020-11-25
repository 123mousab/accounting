<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
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
            'mobile' => 'required|unique:branches',
            'email' => 'required|string|email|max:255|unique:branches',
            'fax' => 'required',
            'branch_manger' => 'required',
            'branch_phone' => 'required',
            'area_id' => 'required|exists:areas,id',
            'city_id' => 'required|exists:cities,id',
            'status' => 'required|bool'
        ];
    }
}
