<?php
/**
 * Created by PhpStorm.
 * User: stefwijnberg
 * Date: 29/09/16
 * Time: 21:14
 */

include('vendor/autoload.php');

$oliewereld = new \PriceGuru\Scrapers\Oliewereld();
$products = $oliewereld->searchProducts('CASTROL EDGE 5W30 C3');

unlink('out.csv');
function writeCSV($record)
{
    $csv = 'out.csv';
    $line = implode(';', $record) . PHP_EOL;
    print $line;
    file_put_contents($csv, $line, FILE_APPEND);
}

writeCSV(['naam oliehandel', 'naam oliewereld', 'oliehandel prijs', 'oliewereld prijs']);
foreach ($products as $ow) {
    $oliehandel = new \PriceGuru\Scrapers\Oliehandel();
    $oliehandelProducts = $oliehandel->searchProducts($ow['name']);
    foreach ($oliehandelProducts as $oh) {

        $diff = ($oh['price'] - $ow['price']);
        $diff = $diff < 0 ? 0 - $diff : $diff;

        if($diff > 5000){
            continue;
        }

        writeCSV([
            $oh['name'],
            $ow['name'],
            round($oh['price'] / 1.21),
            $ow['price']
//            $diff
        ]);
    }
}



