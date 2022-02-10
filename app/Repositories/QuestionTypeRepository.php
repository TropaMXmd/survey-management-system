<?php

namespace App\Repositories;

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
}
