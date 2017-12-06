<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\QuestionarioRepository;
use App\Entities\Questionario;
use App\Validators\QuestionarioValidator;

/**
 * Class QuestionarioRepositoryEloquent
 * @package namespace App\Repositories;
 */
class QuestionarioRepositoryEloquent extends BaseRepository implements QuestionarioRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Questionario::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return QuestionarioValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
