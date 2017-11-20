<?php 

namespace App\Repositories;

use App\Entities\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Presenters\UserPresenter;

class UserRepositoryEloquent extends BaseRepository implements UserRepository {

    public function model() {
        return User::class;
    }

    public function boot() {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter() {
        return UserPresenter::class;
    }
    
    public function create(array $data) {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    
    public function update(array $data, $id) {
        return User::find($id)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

}