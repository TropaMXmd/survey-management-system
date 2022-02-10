<?php

namespace App\Repositories;

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
}
