<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'options',
        'question_type_id'
    ];

    public function questionType()
    {
        return $this->belongsTo(QuestionType::class, 'question_type_id');
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class);
    }
}
