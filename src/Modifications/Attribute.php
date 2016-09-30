<?php
/**
 * Created by PhpStorm.
 * User: stefwijnberg
 * Date: 29/09/16
 * Time: 21:23
 */

namespace PriceGuru\Modifications;

use Symfony\Component\DomCrawler\Crawler;

class Attribute implements Modification
{

    private $attribute;

    public function __construct($attribute)
    {
        $this->attribute = $attribute;
    }

    public function run($data)
    {

            throw new \Exception('Not implemented');
    }

}