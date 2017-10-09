<?php 

namespace App\Repositories;

use App\Entities\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class UserRepositoryEloquent extends BaseRepository implements UserRepository {

    public function model() {
        return User::class;
    }

    public function boot() {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}