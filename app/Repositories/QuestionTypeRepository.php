<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Repositories\Repository;


class QuestionTypeRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Models\QuestionType';
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
}
