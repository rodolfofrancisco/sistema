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
use App\Entities\Pergunta;
use App\Repositories\RespostaRepository;


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
    
    
    protected $repositoryAnswer;
    

    public function __construct(PerguntaRepository $repository, PerguntaValidator $validator, RespostaRepository $repositoryAnswer)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->repositoryAnswer = $repositoryAnswer;
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
    public function show($id) {
        $pergunta = Pergunta::with('Respostas')->where('perguntas.id', $id)->first();

        if (request()->wantsJson()) {
            if (isset($pergunta['data']) && count($pergunta['data']) > 0) {
                $pergunta = $pergunta['data'];
                
                if (isset($pergunta['updated_at'])) {
                    unset($pergunta['updated_at']);                    
                }
                
                if (isset($pergunta['created_at'])) {
                    unset($pergunta['created_at']);
                }
            }
            
            return response()->json($pergunta);
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
    public function update(PerguntaUpdateRequest $request, $id) {        
        $pergunta = array();
        if (count($request->json()->all()) > 0) {
            $pergunta = $request->json()->all();
        } else {
            $pergunta = $request->all();
        }
        
        try {
            $this->validator->with($pergunta)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $perguntum = $this->repository->update($pergunta, $id);
            
            if (isset($pergunta['respostas']) && count($pergunta['respostas']) > 0) {
                $answerIds = [];
                foreach ($pergunta['respostas'] as $resposta) {
                    $resposta['pergunta_id'] = $perguntum->id;
                    
                    $validator = Validator::make($resposta, [
                        'descricao'   => 'required|max:255',
                        'pergunta_id' => 'required',
                    ]);
                    
                    if ($validator->fails()) {    
                        return response()->json($validator->messages(), 401);
                    }                    
                    
                    if (isset($resposta['id']) && !empty($resposta['id'])) {
                        $this->repositoryAnswer->update($resposta, $resposta['id']);
                        $answerIds[] = $resposta['id'];
                    } else {
                        $answer = $this->repositoryAnswer->create($resposta);
                        $answerIds[] = $answer->id;
                    }
                }
                
                if (count($answerIds) > 0) {
                    $respostas = Resposta::whereNotIn('id', $answerIds)->where('pergunta_id', $id)->get();
                    foreach ($respostas as $resposta) {
                        $resposta->delete();
                    }
                }                    
            }

            $response = [
                'message' => 'Pergunta atualizada com sucesso.',
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
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $pergunta = Pergunta::with('Respostas')->where('perguntas.id', $id)->first();
        if (isset($pergunta['respostas']) && count($pergunta['respostas']) > 0) {
            foreach ($pergunta['respostas'] as $resposta) {
                $this->repositoryAnswer->delete($resposta->id);
            }
        }
        
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
