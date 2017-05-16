<?php

namespace App\Presenters;

use App\Transformers\NerdTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class NerdPresenter
 *
 * @package namespace App\Presenters;
 */
class NerdPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new NerdTransformer();
    }
}
