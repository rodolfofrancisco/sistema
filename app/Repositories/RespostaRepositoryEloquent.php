<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RespostaRepository;
use App\Entities\Resposta;
use App\Validators\RespostaValidator;

/**
 * Class RespostaRepositoryEloquent
 * @package namespace App\Repositories;
 */
class RespostaRepositoryEloquent extends BaseRepository implements RespostaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Resposta::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return RespostaValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
