<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Validators\UserValidator;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserCreateRequest;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

use App\Repositories\UserRepository;
use App\Services\UserService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class UserController extends Controller {

    private $repository;

    private $service;
    
    protected $validator;

    public function __construct(UserRepository $repository, UserService $service, UserValidator $validator) {
        $this->repository = $repository;
        $this->service = $service;
        $this->validator  = $validator;
    }
    
    public function authenticated() {
        $userId = Authorizer::getResourceOwnerId();
        return $this->repository->find($userId);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return $this->repository->paginate();
    }

    public function store(UserCreateRequest $request) {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $user = $this->repository->create($request->all());

            $response = [
                'message' => 'Usuário criado com sucesso.',
                'data'    => $user,
            ];

            if ($request->wantsJson()) {
                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ], 401);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->repository->find($id);

        /*if (isset($result['data']) && count($result['data'] > 0)) {
            $result = [
                'data' => array_shift($result['data'])
            ];
        }*/

        return $result['data'];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id) {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $user = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Usuário atualizado com sucesso.',
                'data'    => $user,
            ];

            if ($request->wantsJson()) {
                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ], 401);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Usuário excluído com sucesso.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Usuário excluído com sucesso.');
    }
}
