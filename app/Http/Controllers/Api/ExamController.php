<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\ExamRepository;
use App\Http\Controllers\Api\ApiController;

class ExamController extends ApiController
{
    /**
     * @var
     */
    protected $examRepository;

    /**
     *
     * @param  object  $examRepository
     * @return void
     *
     */
    public function __construct(ExamRepository $examRepository)
    {
        $this->examRepository = $examRepository;
    }

    public function create()
    {
    }

    public function store()
    {
    }

    public function update()
    {
    }

    public function destroy()
    {
    }
}
