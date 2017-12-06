<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PerguntaCreateRequest;
use App\Http\Requests\PerguntaUpdateRequest;
use App\Repositories\PerguntaRepository;
use App\Validators\PerguntaValidator;
use App\Entities\Resposta;


class PerguntasController extends Controller
{

    /**
     * @var PerguntaRepository
     */
    protected $repository;

    /**
     * @var PerguntaValidator
     */
    protected $validator;

    public function __construct(PerguntaRepository $repository, PerguntaValidator $validator)
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
        $perguntas = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $perguntas,
            ]);
        }

        return view('perguntas.index', compact('perguntas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PerguntaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PerguntaCreateRequest $request) {
        $pergunta = array();
        if (count($request->json()->all()) > 0) {
            $pergunta = $request->json()->all();
        } else {
            $pergunta = $request->all();
        }
        
        try {
            $this->validator->with($pergunta)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $perguntum = $this->repository->create($pergunta);
            
            if (isset($pergunta['respostas']) && count($pergunta['respostas']) > 0) {
                foreach ($pergunta['respostas'] as $resposta) {
                    $resposta['pergunta_id'] = $perguntum->id;
                    
                    $validator = Validator::make($resposta, [
                        'descricao'   => 'required|max:255',
                        'pergunta_id' => 'required',
                    ]);
                    
                    if ($validator->fails()) {    
                        return response()->json($validator->messages(), 401);
                    }
                    
                    Resposta::create($resposta);                    
                }
            }

            $response = [
                'message' => 'Pergunta criada com sucesso.',
                'data'    => $perguntum,
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
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $perguntum = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $perguntum,
            ]);
        }

        return view('perguntas.show', compact('perguntum'));
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

        $perguntum = $this->repository->find($id);

        return view('perguntas.edit', compact('perguntum'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PerguntaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(PerguntaUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $perguntum = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Pergunta updated.',
                'data'    => $perguntum->toArray(),
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
                'message' => 'Pergunta deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Pergunta deleted.');
    }
}
