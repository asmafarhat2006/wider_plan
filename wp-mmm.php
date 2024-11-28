<?php

require_once 'autoload.php';

ini_set('memory_limit', '4G');

use App\CSVReader;
use App\MergeSort;
use App\StatisticalCalculator;

$filename = 'testdata.csv';
if (!file_exists($filename)) {
    print json_encode(['error' => 'File testdata.csv not found']);
    exit;
}

$csvReader = new CSVReader($filename);
$data = $csvReader->readCSV();

$sorter = new MergeSort();
$sortedData = $sorter->sort($data);

$statisticalCalculator = new StatisticalCalculator();

$result = array_merge(
    [
        'total' => $statisticalCalculator->calculateTotal($sortedData),
        'mean' => $statisticalCalculator->calculateMean($sortedData),
    ], $statisticalCalculator->calculateMode($sortedData), ['median' => $statisticalCalculator->calculateMedian($sortedData)]);

print json_encode($result);
