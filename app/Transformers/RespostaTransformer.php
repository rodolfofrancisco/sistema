<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Resposta;

/**
 * Class RespostaTransformer
 * @package namespace App\Transformers;
 */
class RespostaTransformer extends TransformerAbstract
{

    /**
     * Transform the \Resposta entity
     * @param \Resposta $model
     *
     * @return array
     */
    public function transform(Resposta $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
