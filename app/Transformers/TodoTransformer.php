<?php

namespace App\Transformers;

use App\Todo;
use Flugg\Responder\Transformers\Transformer;

class TodoTransformer extends Transformer
{
    /**
     * A Fractal transformer.
     *
     * @param Todo $todo
     * @return array
     */
    public function transform(Todo $todo)
    {
        return $todo->toArray();
    }
}
