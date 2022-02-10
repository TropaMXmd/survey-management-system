<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Repositories\QuestionTypeRepository;

class QuestionTypeController extends ApiController
{
    /**
     * @var
     */
    protected $questionTypeRepository;

    /**
     *
     * @param  object  $questionTypeRepository
     * @return void
     *
     */
    public function __construct(QuestionTypeRepository $questionTypeRepository)
    {
        $this->questionTypeRepository = $questionTypeRepository;
    }
}
