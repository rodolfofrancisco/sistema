<?php

namespace App\Presenters;

use App\Transformers\QuestionarioTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class QuestionarioPresenter
 *
 * @package namespace App\Presenters;
 */
class QuestionarioPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new QuestionarioTransformer();
    }
}
