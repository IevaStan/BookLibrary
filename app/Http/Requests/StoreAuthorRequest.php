<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuthorRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:80', 
            'surname' => 'required|min:3|max:32',
            'country' => 'required|min:2|max:32',
            'birtdate' => 'required'
        ];
    }
}
