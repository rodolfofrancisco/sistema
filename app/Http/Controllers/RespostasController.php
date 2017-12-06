<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\RespostaCreateRequest;
use App\Http\Requests\RespostaUpdateRequest;
use App\Repositories\RespostaRepository;
use App\Validators\RespostaValidator;


class RespostasController extends Controller
{

    /**
     * @var RespostaRepository
     */
    protected $repository;

    /**
     * @var RespostaValidator
     */
    protected $validator;

    public function __construct(RespostaRepository $repository, RespostaValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $respostas = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $respostas,
            ]);
        }

        return view('respostas.index', compact('respostas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RespostaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RespostaCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $respostum = $this->repository->create($request->all());

            $response = [
                'message' => 'Resposta created.',
                'data'    => $respostum->toArray(),
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
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $respostum = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $respostum,
            ]);
        }

        return view('respostas.show', compact('respostum'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $respostum = $this->repository->find($id);

        return view('respostas.edit', compact('respostum'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  RespostaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(RespostaUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $respostum = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Resposta updated.',
                'data'    => $respostum->toArray(),
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
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Resposta deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Resposta deleted.');
    }
}
