<?php
/**
 * Created by PhpStorm.
 * User: stefwijnberg
 * Date: 29/09/16
 * Time: 21:23
 */

namespace PriceGuru\Modifications;

class SearchReplace implements Modification
{

    private $search;
    private $replace;

    public function __construct($search, $replace)
    {
        $this->search = $search;
        $this->replace = $replace;
    }

    public function run($data)
    {
        return str_replace($this->search, $this->replace, $data);
    }

}