<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;

class QuestionTypeRequest extends FormRequest
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
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            return [
                'name' => 'regex:/^[a-zA-Z0-9\s]+$/',
                'answer_type' => 'in:1,2'
            ];
        } else {
            return [
                'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
                'answer_type' => 'required|in:1,2'
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Please insert a valid  title!',
            'name.regex' => 'The name must be alphanumeric!',
            'answer_type.required'   => 'Please insert a valid answer type (1: Single Answer, 2:Multiple Answer)!',
            'answer_type.in'   => 'Answer type must be between 1 or 2 (1: Single Answer, 2:Multiple Answer)!'
        ];
    }
}
