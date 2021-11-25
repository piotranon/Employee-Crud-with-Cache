<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @bodyParam name string required Name of employee. Example: Piotr
 * @bodyParam last_name string required Last Name of employee. Example: Długosz
 * @bodyParam position string required Position of employee. Example: Szef totalny
 * @bodyParam salary int Salary of employee. Example: 10000.00
 */
class StoreEmployee extends FormRequest
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
            'name'=>'required|string|min:3|max:30',
            'last_name'=>'required|string|min:3|max:30',
            'position'=>'required|string|min:3|max:30',
            'salary' => 'required|numeric|min:0'
        ];
    }
}
