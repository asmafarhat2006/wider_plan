<?php

namespace App;

class CSVReader
{
    public function __construct(private string $fileName) {}

    public function readCSV()
    {
        $data = [];
        if (($handle = fopen($this->fileName, 'r')) !== false) {
            $headerSkipped = false;
            while (($row = fgetcsv($handle)) !== false) {
                // Skip headers if non-numeric
                if (!$headerSkipped && !is_numeric($row[1])) {
                    $headerSkipped = true;
                    continue;
                }
                $data[] = (float) $row[1];
            }
            fclose($handle);
        }
        return $data;
    }
}