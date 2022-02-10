<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'duration',
        'publish_date',
        'number_of_questions'
    ];

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }
}
