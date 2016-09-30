<?php
/**
 * Created by PhpStorm.
 * User: stefwijnberg
 * Date: 29/09/16
 * Time: 21:23
 */

namespace PriceGuru\Modifications;

class Numbers implements Modification{

    public function run($data){
        preg_match_all('!\d+!', $data, $matches);
        if(isset($matches[0]) && is_array($matches[0])){
            $numString = implode('',$matches[0]);
            return intval($numString);
        }
        return 0;
    }

}