<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BankRequest extends FormRequest
{
    private $rules = [];

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
        if (request()->isMethod('POST')) {
            return $this->storeRules();
        }
    }

    /**
     * Get the validation rules that apply to the store request(POST).
     *
     * @return array
     */
    private function storeRules()
    {
        $rules = [
            'user_name' => ['required', 'max:255'],
            'email' => ['required', 'unique:users,email'],
            'name' => ['required', 'max:255'],
            'bank_code' => ['required', 'unique:banks,bank_code'],
            'address' => ['required'],
            'postal' => ['required'],
        ];
        return array_merge($this->rules, $rules);
    }
}
