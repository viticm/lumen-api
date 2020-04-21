<?php
/**
 * PLAIN FRAMEWORK ( https://github.com/viticm/lumen-api )
 * $Id Util.php
 * @link https://github.com/viticm/lumen-api for the canonical source repository
 * @copyright Copyright (c) 2014- viticm( viticm.ti@gmail.com )
 * @license
 * @user viticm<viticm.ti@gmail.com>
 * @date 2020/04/20 17:15
 * @uses The self util class.
*/

namespace App;

class Util
{
    /**
     * Get all key name values from an array.
     *
     * @param array $arrary The source array.
     * @param string $value Need find the key name.
     * @param int $depth 
     *
     * @return array
     */
    public static function arrayPluck($arrary, $value, $depth = INF)
    {
        $r = [];
        foreach($arrary as $k => $v) {
            if (! is_array($v)) {
                if ($k === $value) {
                    $r[] = $v;
                }
            } else {
                $values = $depth === 1
                    ? ($k == $value ? array_values($v) : [])
                    : self::arrayPluck($v, $value, $depth - 1);
                foreach ($values as $one) { 
                    $r[] = $one;
                }
            }
        }
        return $r;
    }

}
