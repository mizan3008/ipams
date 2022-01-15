<?php

namespace App\Http\Requests\IPAddress;

use Illuminate\Foundation\Http\FormRequest;

class StoreIpAddressRequest extends FormRequest
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
            'ip_address' => 'required|ip|unique:App\Models\IpAddress,ip_address|max:20',
        ];
    }
}
