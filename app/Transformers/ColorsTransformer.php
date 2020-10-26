<?php

namespace App\Transformers;

use App\Colors;
use League\Fractal\TransformerAbstract;

class ColorsTransformer extends TransformerAbstract
{
    public function transform(Colors $color)
    {
        $hexColor = sprintf("#%02x%02x%02x", $color->red, $color->green, $color->blue); // #0d00ff
        return [
            'id'            => $color->id,
            'color'          => $hexColor
        ];
    }
}
