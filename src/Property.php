<?php

namespace PriceGuru;

use PriceGuru\Modifications\Attribute;
use PriceGuru\Modifications\Explode;
use PriceGuru\Modifications\Modification;
use PriceGuru\Modifications\Numbers;
use PriceGuru\Modifications\SearchReplace;
use PriceGuru\Modifications\StripTags;
use PriceGuru\Modifications\ToUpper;
use PriceGuru\Modifications\Trim;
use Symfony\Component\DomCrawler\Crawler;

class Property
{

    private $selector;
    private $name;
    private $modifications = [];

    public function __construct($name, $selector)
    {
        $this->name = $name;
        $this->selector = $selector;
    }

    

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the data
     * @param $html
     * @return string
     */
    public function get($html)
    {
        $crawler = new Crawler();
        $crawler->addContent($html);

        $value  = $crawler->filter($this->selector)->html();

        /** @var Modification $modification */
        foreach($this->modifications as $modification){
            $value = $modification->run($value);
        }

        return $value;
    }

    /**
     * Trim the property
     * @return $this
     */
    public function trim(){
        $this->modifications[] = new Trim();
        return $this;
    }

    /**
     * Strip the result from HTML Tags
     * @return $this
     */
    public function stripTags()
    {
        $this->modifications[] = new StripTags();
        return $this;
    }

    public function toUpper(){
        $this->modifications[] = new ToUpper();
        return $this;
    }

    /**
     * Search/replace text
     * @param $search
     * @param $replace
     * @return $this
     */
    public function replace($search, $replace)
    {
        $this->modifications[] = new SearchReplace($search, $replace);
        return $this;
    }

    /**
     * Filter out only numbers
     * @return $this
     */
    public function numbers(){
        $this->modifications[] = new Numbers();
        return $this;
    }

    /**
     * Split the string in bits with the delimiter and get a part of the string
     * by it's index
     * @param $delimiter
     * @param $index
     * @return $this
     */
    public function explode($delimiter, $index)
    {
        $this->modifications[] = new Explode($delimiter, $index);
        return $this;
    }

    public function attribute($attribute){
        $this->modifications[] = new Attribute($attribute);
        return $this;
    }
}