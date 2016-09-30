<?php
/**
 * Created by PhpStorm.
 * User: stefwijnberg
 * Date: 29/09/16
 * Time: 23:15
 */

namespace PriceGuru\Scrapers;

use PriceGuru\Property;

class Oliewereld extends Scraper{



    public function __construct()
    {
        $this->addUrl('http://www.oliewereld.nl/index.php?route=product/search&search=&page=1');
        $this->setWrapperSelector('div.product-list > div');
        $this->setSource('wereld');
        $name = new Property('name', '.name > a');
        $name->replace([' -- gratis verzending!','NIEUW! ','VOORDEELPAK  ',' VAT'], '');
        $name->replace(' LITER','L');
        $name->replace('- 5 liter fles', '5L');
        $name->replace('- 5 literfles', '5L');
        $this->addProperty($name);

        $price = new Property('price', '.price-tax');
        $price->explode('<br><span', 0)->numbers();
        $this->addProperty($price);

    }

    public function searchProducts($search){
        $this->addUrl('http://www.oliewereld.nl/index.php?route=product/search&search='.urlencode($search).'&page=1');
        return $this->getData();
    }

}