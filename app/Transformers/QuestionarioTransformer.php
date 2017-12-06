<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Questionario;

/**
 * Class QuestionarioTransformer
 * @package namespace App\Transformers;
 */
class QuestionarioTransformer extends TransformerAbstract
{

    /**
     * Transform the \Questionario entity
     * @param \Questionario $model
     *
     * @return array
     */
    public function transform(Questionario $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
