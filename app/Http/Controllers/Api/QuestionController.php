<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use App\Http\Resources\QuestionResource;
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

    public function index(Request $request)
    {
        try {
            $result = $this->questionRepository->filteredData($request);
            if (count($result) > 0)
                return $this->respond('Fetched all questions.', 'success', 200, QuestionResource::collection($result));

            return $this->errorResponse('No data found.', 400);
        } catch (\Exception $e) {
            app('log')->error('Content: ' . $e->getMessage(), $e->getTrace());
            return $this->errorResponse();
        }
    }

    public function store(QuestionRequest $questionRequest)
    {
        try {
            $result = $this->questionRepository
                ->create(array(
                    'title' => $questionRequest->get('title'),
                    'question_type_id' => $questionRequest->get('question_type_id'),
                    'options' => json_encode($questionRequest->get('options'))
                ));
            if ($result)
                return $this->respond('New question added successfully!', 'success', 201, new QuestionResource($result));

            return $this->errorResponse('Not Created successfully', 400);
        } catch (\Exception $e) {
            app('log')->error('Pocket: ' . $e->getMessage(), $e->getTrace());
            return $this->errorResponse();
        }
    }

    public function update(QuestionRequest $questionRequest, $quesId)
    {
        try {
            $result = $this->questionRepository->update(array(
                'title' => $questionRequest->get('title'),
                'question_type_id' => $questionRequest->get('question_type_id'),
                'options' => json_encode($questionRequest->get('options'))
            ), $quesId);
            if ($result)
                return $this->respond('Question updated successfully!', 'success', 200);

            return $this->errorResponse('Not updated successfully', 400);
        } catch (\Exception $e) {
            app('log')->error('Content: ' . $e->getMessage(), $e->getTrace());
            return $this->errorResponse();
        }
    }

    public function destroy($typeId)
    {
        try {
            $result = $this->questionRepository->delete($typeId);
            if ($result)
                return $this->respond('Question deleted successfully', 'removed');

            return $this->errorResponse(400, $result);
        } catch (\Exception $e) {
            app('log')->error('Content: ' . $e->getMessage(), $e->getTrace());
            return $this->errorResponse();
        }
    }
}
