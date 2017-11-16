<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Turma;

/**
 * Class TurmaTransformer
 * @package namespace App\Transformers;
 */
class TurmaTransformer extends TransformerAbstract
{

    /**
     * Transform the \Turma entity
     * @param \Turma $model
     *
     * @return array
     */
    public function transform(Turma $model)
    {
        return [
            'id'         => (int) $model->id,
            'descricao'  => $model->descricao,
            'nivel'      => $model->nivel,
            'professor'  => $model->professor,
            'created_at' => $model->created_at->format('d/m/Y H:i:s'),
            'updated_at' => $model->updated_at
        ];
    }
}
