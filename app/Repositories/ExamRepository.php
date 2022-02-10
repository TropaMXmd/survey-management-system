<?php

namespace App\Repositories;

use App\Repositories\Repository;


class ExamRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Models\Exam';
    }

    public function createWithPivot($request)
    {
        $quesIds = explode(",", $request->get('questions'));
        $exam = $this->model->create($request->all());
        $exam->questions()->attach($quesIds);
        return $exam;
    }

    public function updateWithPivot($request, $examId)
    {
        $quesIds = $request->has('questions') ? explode(",", $request->get('questions')) : [];
        $exam = $this->model->find($examId);
        $exam->update($request->all());
        if (count($quesIds) > 0) $exam->questions()->attach($quesIds);
        return $exam;
    }

    public function deleteWithPivot($examId)
    {
        $this->model->find($examId)->questions()->detach();
        $this->model->delete($examId);
        return true;
    }
}
