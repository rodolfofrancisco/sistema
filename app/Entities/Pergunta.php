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


class Pergunta extends Model implements Transformable {
    
    use TransformableTrait;
    
    protected $table = 'perguntas';

    protected $fillable = [
        'descricao',
        'tipo',
        'questionario_id'
    ];
    
    public function questionarios(){
    return $this->belongsTo('App\Entities\Questionario');
}

}
