<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Resposta extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'descricao',
        'pergunta_id'
    ];

}
