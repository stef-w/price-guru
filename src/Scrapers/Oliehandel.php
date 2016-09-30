<?php
/**
 * Created by PhpStorm.
 * User: stefwijnberg
 * Date: 29/09/16
 * Time: 23:15
 */

namespace PriceGuru\Scrapers;

use PriceGuru\Property;

class Oliehandel extends Scraper{


    public function __construct()
    {
        $this->setSource('handel');
        $this->setWrapperSelector('div.row-fluid');

        $name = new Property('name', '.name a');
        $name->trim();
        $this->addProperty($name);

        $price = new Property('price', '.name');
        $price->explode('<br>', 1)->numbers();
        $this->addProperty($price);
    }

    public function searchProducts($search)
    {
        $search = str_replace('/', '%2F', $search);
        $this->addUrl('http://www.oliehandel.nl/product/autocomplete?input='.urlencode($search));
        $data = $this->getData();
        return $data;
    }

}