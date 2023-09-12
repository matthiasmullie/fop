<?php

require_once __DIR__ . '/../vendor/autoload.php';

use MatthiasMullie\Geo;

$data = json_decode(file_get_contents(__DIR__ . '/data.json'));

$clusterer = new Geo\Clusterer(
    new Geo\Bounds(
        new Geo\Coordinate(90, 180),
        new Geo\Coordinate(-90, -180)
    )
);

$clusterer->setNumberOfClusters(127525000);
$clusterer->setMinClusterLocations(2);

foreach ($data as $coord) {
    $clusterer->addCoordinate(new Geo\Coordinate($coord[0], $coord[1]));
}

echo 'clusters: ' . count($clusterer->getClusters()) . "\n";
echo 'coords in clusters: ' . array_sum(array_map(static function ($c) {
    return $c->total;
}, $clusterer->getClusters())) . "\n";
echo 'unclustered coordinates: ' . count($clusterer->getCoordinates()) . "\n";
