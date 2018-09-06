<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobAddRequest extends FormRequest
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
     *  A job must have a person associated, title and date
     * @return array
     */
    public function rules()
    {
        return [
            'people_id' => 'required',
            'title' => 'required',
            'date' => 'required'
        ];
    }
}
