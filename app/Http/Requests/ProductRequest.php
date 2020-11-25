<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $data = request()->all();
        return [
            'name.*' => 'required',
            'barcode' => 'required|unique:products',
            'description' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'product_type_id' => 'required|exists:product_types,id',
            'category_id' => 'required|exists:categories,id',
            'branch_section_id' => 'required|exists:branch_sections,id',
            'company_manufacture_id' => 'nullable|exists:company_manufactures,id',
            'store_id' => 'nullable|exists:stores,id',
            'has_parent' => 'required|bool',
            'parent_id' => 'required_if:has_parent,1|exists:products,id',
            'unit_id' => 'required|exists:units,id',
            'size_id' => 'nullable|exists:sizes,id',
            'color_id' => 'nullable|exists:colors,id',
            'currency_id' => 'required|exists:currencies,id',
            'dealer_id' => 'nullable|exists:dealers,id',
            'expire_date' => 'required|bool',
            'sale_price1' => 'required',
            'sale_price2' => 'nullable',
            'sale_price3' => 'nullable',
            'purchase_price1' => 'nullable',
            'purchase_price2' => 'nullable',
            'purchase_price3' => 'nullable',
            'multiply_factor' => 'required',
            'number_of_small_unit' => 'required_if:has_parent,1',
            'contain_child_from_parent' => 'required_if:has_parent,1',
            'total_quantity' => 'required',
            'balance_last_date' => 'nullable',
            'start_amount' => 'nullable',
            'favorite' => 'required|bool',
            'related_store' => 'required|bool',
            'related_tax' => 'required|bool',
            'status' => 'required|bool'
        ];
    }
}
