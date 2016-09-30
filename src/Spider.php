<?php

namespace PriceGuru;

class Spider
{
    public function crawl($url){
        return file_get_contents($url);
    }
}