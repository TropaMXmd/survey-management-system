<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Repositories\Repository;


class QuestionRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Models\Question';
    }

    public function filteredData($request, $perPage = 15, $columns = array('*'))
    {
        $query = $this->model->select($columns);

        if ($request->has('question_type_id') && !empty($request->get('question_type_id'))) {
            $query->where('question_type_id', $request->get('question_type_id'));
        }
        if ($request->has('updated_at') && !empty($request->get('updated_at'))) {
            $query->whereDate('updated_at', '=', Carbon::parse($request->get('updated_at'))->format('Y-m-d'));
        }

        return $query->orderBy('updated_at', 'DESC')
            ->paginate($perPage);
    }
}
