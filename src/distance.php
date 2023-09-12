<?php

require_once __DIR__ . '/../vendor/autoload.php';

use MatthiasMullie\Geo;

$data = json_decode(file_get_contents(__DIR__ . '/data.json'));

$geo = new Geo\Geo('km');
$closest = [];
foreach ($data as $i => $coord) {
    foreach ($data as $j => $other) {
        if ($i === $j) {
            continue;
        }

        $distance = $geo->distance(
            new Geo\Coordinate($coord[0], $coord[1]),
            new Geo\Coordinate($other[0], $other[1]),
        );

        $closest[$i] = isset($closest[$i]) ? min($distance, $closest[$i]) : $distance;
    }
}

sort($closest);
echo 'closest distances to another point, ascending';
var_export($closest);
