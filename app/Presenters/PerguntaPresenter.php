<?php

namespace App\Presenters;

use App\Transformers\PerguntaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PerguntaPresenter
 *
 * @package namespace App\Presenters;
 */
class PerguntaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PerguntaTransformer();
    }
}
