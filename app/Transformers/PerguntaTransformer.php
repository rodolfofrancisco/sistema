<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Pergunta;

/**
 * Class PerguntaTransformer
 * @package namespace App\Transformers;
 */
class PerguntaTransformer extends TransformerAbstract
{

    /**
     * Transform the \Pergunta entity
     * @param \Pergunta $model
     *
     * @return array
     */
    public function transform(Pergunta $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
