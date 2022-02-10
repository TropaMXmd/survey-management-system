<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'exam_name' => $this->title,
            'duration' => $this->duration,
            'published_on' => $this->publish_date,
            'total_questions' => $this->number_of_questions,
            'questions' => QuestionResource::collection($this->questions),
        ];
    }
}
