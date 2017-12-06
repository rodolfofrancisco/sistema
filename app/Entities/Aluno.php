<?php
/**
* @version $Revision$
* @author $Author$
* @since $Date$
*/
namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Aluno extends Model implements Transformable {
    use TransformableTrait;

    protected $fillable = [
        'nome_completo',
        'matricula',
        'email',
        'data_nacimento',
        'sexo',
        'cpf',
        'telefone',
        'celular',
        'grau_instrucao',
        'cep',
        'turmas_id',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado'
    ];

}
