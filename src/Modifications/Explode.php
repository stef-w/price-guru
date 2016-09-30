<?php
/**
 * Created by PhpStorm.
 * User: stefwijnberg
 * Date: 29/09/16
 * Time: 21:23
 */

namespace PriceGuru\Modifications;

class Explode implements Modification
{

    private $index;
    private $delimiter;

    public function __construct($delimiter, $index)
    {
        $this->delimiter = $delimiter;
        $this->index = $index;
    }

    public function run($data)
    {
        $bits = explode($this->delimiter, $data);
        return isset($bits[$this->index]) ? $bits[$this->index] : null;
    }

}