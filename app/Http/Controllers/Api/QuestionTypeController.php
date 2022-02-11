<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\QuestionTypeRequest;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\QuestionTypeResource;
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

    public function index(Request $request)
    {
        try {
            $result = $this->questionTypeRepository->filteredData($request);
            if (count($result) > 0)
                return $this->respond('Fetched all question types.', 'success', 200, QuestionTypeResource::collection($result));

            return $this->errorResponse('No data found.', 400);
        } catch (\Exception $e) {
            app('log')->error('Question-type: ' . $e->getMessage(), $e->getTrace());
            return $this->errorResponse();
        }
    }

    public function store(QuestionTypeRequest $request)
    {
        try {
            $result = $this->questionTypeRepository->create($request->all());
            if ($result)
                return $this->respond('New question type added successfully!', 'success', 201, new QuestionTypeResource($result));

            return $this->errorResponse('Not Created successfully', 400);
        } catch (\Exception $e) {
            app('log')->error('Question-type: ' . $e->getMessage(), $e->getTrace());
            return $this->errorResponse();
        }
    }

    public function update(QuestionTypeRequest $request, $typeId)
    {
        try {
            $result = $this->questionTypeRepository->update($request->all(), $typeId);
            if ($result)
                return $this->respond('Question type updated successfully!', 'success', 200);

            return $this->errorResponse('Not updated successfully', 400);
        } catch (\Exception $e) {
            app('log')->error('Question-type: ' . $e->getMessage(), $e->getTrace());
            return $this->errorResponse();
        }
    }

    public function destroy($typeId)
    {
        try {
            $result = $this->questionTypeRepository->delete($typeId);
            if ($result)
                return $this->respond('Question type deleted successfully', 'removed');

            return $this->errorResponse(400, $result);
        } catch (\Exception $e) {
            app('log')->error('Question-type: ' . $e->getMessage(), $e->getTrace());
            return $this->errorResponse();
        }
    }
}
