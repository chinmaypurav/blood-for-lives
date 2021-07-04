<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BankRequest extends FormRequest
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
            'user_name' => 'required|max:255',
            'email' => 'required|unique:users,email',
            'name' => 'required|max:255',
            'bank_code' => 'required|unique:banks,bank_code',
            'address' => 'required',
            'postal' => 'required',
        ];
    }
}