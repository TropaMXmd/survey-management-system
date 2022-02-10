<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;

class QuestionRequest extends FormRequest
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
                'title' => 'regex:/^[a-zA-Z0-9\s\.,!?]*$/',
                "options"    => "array|min:4",
                "options.*"  => "string|distinct|min:4",
            ];
        } else {
            return [
                'title' => 'required|regex:/^[a-zA-Z0-9\s\.,!?]*$/',
                'question_type_id' => 'required|exists:question_types,id',
                "options"    => "required|array|min:4",
                "options.*"  => "required|string|distinct|min:4",
            ];
        }
    }

    public function messages()
    {
        return [
            'title.required' => 'Please add your question!',
            'title.regex' => 'Please insert a valid  title!',
            'question_type_id.required' => 'Please mention question type!',
            'question_type_id.exists' => 'This is not a valid question type!',
            'options.required' => 'Please add four options!',
            'options.min' => 'Please add four options!',
            'options.array' => 'Options must be an array!'
        ];
    }
}
