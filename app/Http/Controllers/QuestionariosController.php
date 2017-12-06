<?php
/**
* @version $Revision$
* @author $Author$
* @since $Date$
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Entities\Questionario;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\QuestionarioCreateRequest;
use App\Http\Requests\QuestionarioUpdateRequest;
use App\Repositories\QuestionarioRepository;
use App\Validators\QuestionarioValidator;


class QuestionariosController extends Controller {

    /**
     * @var QuestionarioRepository
     */
    protected $repository;

    /**
     * @var QuestionarioValidator
     */
    protected $validator;

    public function __construct(QuestionarioRepository $repository, QuestionarioValidator $validator) {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return $this->repository->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  QuestionarioCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionarioCreateRequest $request) {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $questionario = $this->repository->create($request->all());

            $response = [
                'message' => 'Questionário criado com sucesso.',
                'data'    => $questionario,
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
        $questionario = Questionario::with('Perguntas')->where('questionarios.id', $id)->first();
        
        if (request()->wantsJson()) {
            if (isset($questionario['data']) && count($questionario['data']) > 0) {
                $questionario = $questionario['data'];
                
                if (isset($questionario['updated_at'])) {
                    unset($questionario['updated_at']);                    
                }
                
                if (isset($questionario['created_at'])) {
                    unset($questionario['created_at']);
                }
            }
            return response()->json($questionario);
        }

        return view('questionarios.show', compact('questionario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $questionario = $this->repository->find($id);
        return view('questionarios.edit', compact('questionario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  QuestionarioUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(QuestionarioUpdateRequest $request, $id) {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $questionario = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Questionario updated.',
                'data'    => $questionario,
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
                'message' => 'Questionario deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Questionario deleted.');
    }
}
