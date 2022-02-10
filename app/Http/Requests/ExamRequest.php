<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;

class ExamRequest extends FormRequest
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
                'title' => 'regex:/^[a-zA-Z0-9\s]+$/',
                'duration' => 'integer',
                'publish_date' => 'date_format:"Y-m-d"',
                'number_of_questions' => 'integer',
            ];
        } else {
            return [
                'title' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
                'duration' => 'required|integer',
                'publish_date' => 'required|date_format:"Y-m-d"',
                'number_of_questions' => 'required|integer',
                'questions' => 'required'
            ];
        }
    }

    public function messages()
    {
        return [
            'title.required' => 'Please add exam title!',
            'title.regex' => 'Please insert a valid  title!',
            'duration.required' => 'Please mention exam duration(hour)!',
            'duration.integer' => 'Duration(hour) must be an integer!',
            'publish_date.required' => 'Please mention the date of publish!',
            'publish_date.date_format' => 'Please mention the publish date in this format: "Y-m-d"',
            'number_of_questions.required' => 'Please mention the total number of questions!',
            'number_of_questions.integer' => 'Number of questions must be an integer number!',
            'questions.required' => 'Please mention question ids in comma separated text!',
        ];
    }
}
