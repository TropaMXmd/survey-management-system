<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\ExamRequest;
use App\Repositories\ExamRepository;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\ExamResource;

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

    public function index(Request $request)
    {
        try {
            $result = $this->examRepository->filteredData($request);
            if (count($result) > 0)
                return $this->respond('Fetched all exams.', 'success', 200, ExamResource::collection($result));

            return $this->errorResponse('No data found.', 400);
        } catch (\Exception $e) {
            app('log')->error('Exam: ' . $e->getMessage(), $e->getTrace());
            return $this->errorResponse();
        }
    }

    public function show($examId)
    {
        try {
            $result = $this->examRepository->find($examId);
            if (!empty($result))
                return $this->respond('Fetched exam details.', 'success', 200, new ExamResource($result));

            return $this->errorResponse('No data found.', 400);
        } catch (\Exception $e) {
            app('log')->error('Exam: ' . $e->getMessage(), $e->getTrace());
            return $this->errorResponse();
        }
    }

    public function store(ExamRequest $examRequest)
    {
        try {
            $result = $this->examRepository
                ->createWithPivot($examRequest);
            if ($result)
                return $this->respond('New exam added successfully!', 'success', 201, new ExamResource($result));

            return $this->errorResponse('Not Created successfully', 400);
        } catch (\Exception $e) {
            app('log')->error('Exam: ' . $e->getMessage(), $e->getTrace());
            return $this->errorResponse();
        }
    }

    public function update(ExamRequest $examRequest, $examId)
    {
        try {
            $result = $this->examRepository->updateWithPivot($examRequest, $examId);
            if ($result)
                return $this->respond('Exam updated successfully!', 'success', 200);

            return $this->errorResponse('Not updated successfully', 400);
        } catch (\Exception $e) {
            app('log')->error('Exam: ' . $e->getMessage(), $e->getTrace());
            return $this->errorResponse();
        }
    }

    public function destroy($examId)
    {
        try {
            $result = $this->examRepository->deleteWithPivot($examId);
            if ($result)
                return $this->respond('Exam deleted successfully', 'removed');

            return $this->errorResponse(400, $result);
        } catch (\Exception $e) {
            app('log')->error('Exam: ' . $e->getMessage(), $e->getTrace());
            return $this->errorResponse();
        }
    }
}
