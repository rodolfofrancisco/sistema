<?php

namespace App\Presenters;

use App\Transformers\RespostaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RespostaPresenter
 *
 * @package namespace App\Presenters;
 */
class RespostaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RespostaTransformer();
    }
}
