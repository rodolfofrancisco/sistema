<?php
/**
* @version $Revision$
* @author $Author$
* @since $Date$
*/
namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TurmaRepository;
use App\Entities\Turma;
use App\Validators\TurmaValidator;
use App\Presenters\TurmaPresenter;

/**
 * Class TurmaRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TurmaRepositoryEloquent extends BaseRepository implements TurmaRepository {
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model() {
        return Turma::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator() {
        return TurmaValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot() {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter() {
        return TurmaPresenter::class;
    }
    
}
