<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Validators\UserValidator;

class UserService {

    /**
     * @var UserRepository
     */
    protected $repository;

    protected $validator;

    public function __construct(UserRepository $repository, UserValidator $validator) {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data) {
        try {
            $this->validator->with($data)->passesOrFail();

            return $this->repository->create($data);
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function update(array $data, $id) {
        try {
            $this->validator->with($data)->passesOrFail();

            return $this->repository->update($data, $id);
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

}