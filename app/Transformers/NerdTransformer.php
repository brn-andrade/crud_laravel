<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Nerd;

/**
 * Class NerdTransformer
 * @package namespace App\Transformers;
 */
class NerdTransformer extends TransformerAbstract
{

    /**
     * Transform the \Nerd entity
     * @param \Nerd $model
     *
     * @return array
     */
    public function transform(Nerd $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
