<?php
/**
* @version $Revision$
* @author $Author$
* @since $Date$
*/
namespace App\Http\Requests;

use App\Http\Requests\Request;
use Carbon\Carbon;


class AlunoUpdateRequest extends Request {
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $id = $this->get('id');
        
        $dataNascimento = $this->get('data_nacimento');
        if (!empty($dataNascimento)) {
            $datetime = Carbon::createFromFormat('d/m/Y', $dataNascimento);
            if ($datetime) {
                $this->merge(['data_nacimento' => $datetime->format('Y-m-d')]);
            }
        }
        
        return [
            'nome_completo'  => 'required|max:255',
            'matricula'      => 'required|max:255',
            'email'          => 'required|email|max:255|unique:alunos,email,'.$id,
            'data_nacimento' => 'required',
            'cpf'            => 'required',
            'turmas_id'      => 'required',
            'logradouro'     => 'max:255',
            'complemento'    => 'max:255',
            'bairro'         => 'max:100',
            'cidade'         => 'max:100',
            'estado'         => 'max:2'
        ];
    }
    
}
