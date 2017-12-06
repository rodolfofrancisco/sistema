<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PerguntaRepository;
use App\Entities\Pergunta;
use App\Validators\PerguntaValidator;

/**
 * Class PerguntaRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PerguntaRepositoryEloquent extends BaseRepository implements PerguntaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Pergunta::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PerguntaValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
