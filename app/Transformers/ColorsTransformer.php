<?php

namespace App\Transformers;

use App\Colors;
use League\Fractal\TransformerAbstract;

class ColorsTransformer extends TransformerAbstract
{
    function rgbToHex($rgb) {
        $hex = "#";
        $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

        return $hex; // returns the hex value including the number sign (#)
    }

    public function transform(Colors $color)
    {
        // $hexColor = sprintf("#%02x%02x%02x", $color->red, $color->green, $color->blue); // #0d00ff
        return [
            'id'            => $color->id,
            'color'          => $this->rgbToHex([$color->red, $color->green, $color->blue])
        ];
    }
}
