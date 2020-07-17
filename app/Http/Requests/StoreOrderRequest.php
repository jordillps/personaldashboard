<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'table' => 'required',
            'dishes_ids' => 'required|array'
        ];
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        return [
            'table.required' => 'Cal indicar la taula',
            'dishes_ids.required' => 'Cal escollir com a mínim un plat',
            'dishes_ids.array' => 'Cal escollir com a mínim un plat',
        ];
    }
}
