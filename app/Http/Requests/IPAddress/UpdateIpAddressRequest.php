<?php

namespace App\Http\Requests\IPAddress;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateIpAddressRequest extends FormRequest
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
            'label' => 'required|max:100',
            'ip_address' => [
                'required',
                'ip',
                'max:250',
                Rule::unique('ip_addresses')->ignore($this->id),
            ],
        ];
    }
}
