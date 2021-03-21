<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name' => 'required',
            'registry_number' => 'nullable|max:50',
            'address' => 'nullable|max:250',
            'latitud_number' => 'numeric|nullable',
            'longitude_number' => 'numeric|nullable',
            'mobile_number' => 'nullable|max:20',
            'phone_number' => 'nullable|max:20',
            'email' => 'nullable|max:250',
            'country_code' => 'numeric|nullable'
        ];
    }
}
