<?php

namespace App\Repositories;

use Carbon\Carbon;
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

    public function filteredData($request, $perPage = 15, $columns = array('*'))
    {
        $query = $this->model->select($columns);

        if ($request->has('updated_at') && !empty($request->get('updated_at'))) {
            $query->whereDate('updated_at', '=', Carbon::parse($request->get('updated_at'))->format('Y-m-d'));
        }

        return $query->orderBy('updated_at', 'DESC')
            ->paginate($perPage);
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
