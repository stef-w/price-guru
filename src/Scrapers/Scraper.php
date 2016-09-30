<?php

namespace PriceGuru\Scrapers;

use Symfony\Component\DomCrawler\Crawler;

class Scraper{

    private $urls;
    private $wrapperSelector = 'body';
    private $properties;
    private $source = 'scraper';

    public function setSource($source){
        $this->source = $source;
    }

    public function addUrl($url){
        $this->urls[] = $url;
        return $this;
    }

    public function setWrapperSelector($selector){
        $this->wrapperSelector = $selector;
        return $this;
    }

    public function addProperty($property){
        $this->properties[] = $property;
        return $this;
    }

    private function scrape($url){
        $html = file_get_contents($url);
        $pageCrawler = new Crawler();
        $pageCrawler->addContent($html);

        $results = [];
        $entityNodes = $pageCrawler->filter($this->wrapperSelector);
        for ($i = 0; $i < count($entityNodes); $i++) {

            $entityNode = $entityNodes->eq($i);
            $html = $entityNode->html();
            $result = [
                'source' => $this->source
            ];

            /** @var Property $property */
            foreach($this->properties as $property){
                $name = $property->getName();
                $result[$name] = $property->get($html);
            }

            $results[] = $result;
        }
        return $results;
    }


    public function getData()
    {
        $results = [];
        foreach($this->urls as $url) {
            $urlResults = $this->scrape($url);
            $results = array_merge($urlResults, $results);
        }
        return $results;
    }
}