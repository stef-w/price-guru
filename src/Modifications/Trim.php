<?php
/**
 * Created by PhpStorm.
 * User: stefwijnberg
 * Date: 29/09/16
 * Time: 21:23
 */

namespace PriceGuru\Modifications;

class Trim implements Modification
{
    public function run($data)
    {
        return trim($data);
    }

}