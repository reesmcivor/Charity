<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeopleEditRequest extends FormRequest
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
     *  A tradesperson must provide the following details:
    • First name, last name, email, address, trades (builder, plumber, electrician), address

    A tradesperson can choose to provide the following details:
    • Date of birth, telephone number
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'unique:people,email,' . $this->id,
            'address' => 'required',
            'trades' => 'required'
        ];
    }
}
