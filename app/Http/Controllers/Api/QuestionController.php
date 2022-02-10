<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\QuestionRepository;
use App\Http\Controllers\Api\ApiController;

class QuestionController extends ApiController
{
    /**
     * @var
     */
    protected $questionRepository;

    /**
     *
     * @param  object  $questionRepository
     * @return void
     *
     */
    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }
}
