<?php

namespace App\Http\Requests\Manager;

use Illuminate\Foundation\Http\FormRequest;

class DonorRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'email' => ['required', 'unique:users,email'],
            'blood_group_id' => ['exists:blood_groups,id'],
            'contact' => ['required', 'numeric', 'digits:10'],
            'date_of_birth' => ['required', 'date'],
            'postal' => ['required', 'numeric', 'digits:6'],
        ];
    }
}
