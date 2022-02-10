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
        return [
            'title' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'question_type_id' => 'required|exists:question_types,id'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please add your question!',
            'title.regex' => 'Please insert a valid  title!',
            'question_type_id.required' => 'Please mention question type!',
            'question_type_id.exists' => 'This is not a valid question type!'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new Response([
            'message' => 'Validation error',
            'type' => 'error',
            'code' => 422,
            'error' => $validator->errors()
        ], 422);
        throw new ValidationException($validator, $response);
    }
}
