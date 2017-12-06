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


class Questionario extends Model implements Transformable {
    
    use TransformableTrait;
    
    protected $fillable = [
        'titulo'
    ];
    
    public function perguntas(){
        return $this->hasMany('App\Entities\Pergunta');
    }

}
