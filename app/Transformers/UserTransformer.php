<?php

namespace App\Transformers;

use Flugg\Responder\Transformers\Transformer;
use App\User;

class UserTransformer extends Transformer
{
    /**
     * A Fractal transformer.
     *
     * @param User $user
     * @return array
     */


    public function transform(User $user)
    {
        return $user->toArray();
    }
}
