<?php

require_once 'autoload.php';
ini_set('memory_limit', '4G');
use App\CSVReader;
use App\MergeSort;
use App\StatisticalCalculator;

// Ensure the input file exists
$filename = 'testdata.csv';
if (!file_exists($filename)) {
    echo json_encode(['error' => 'File testdata.csv not found']);
    exit;
}
// Generate the report
$csvReader = new CSVReader($filename);
$data = $csvReader->readCSV();

$sorter = new MergeSort();
$sortedData = $sorter->sort($data);

$statisticalCalculator = new StatisticalCalculator;

$result = array_merge(
    [
    'total' => $statisticalCalculator->calculateTotal($sortedData),
    'mean' => $statisticalCalculator->calculateMean($sortedData)
], $statisticalCalculator->calculateMode($sortedData), ['median' => $statisticalCalculator->calculateMedian($sortedData)]);

echo json_encode($result);
?>