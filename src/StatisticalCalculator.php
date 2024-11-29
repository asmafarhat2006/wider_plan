<?php

namespace App;

class StatisticalCalculator
{
    public static function calculateMean(array $data)
    {
        $sum = self::calculateTotal($data);

        return round($sum / count($data), 2);
    }

    public static function calculateMode(array $data)
    {
        // Create a hash set for storing frequencies against values
        $frequency = [];

        foreach ($data as $value) {
            $key = (string)$value;
            if (!isset($frequency[$key])) {
                $frequency[$key] = 0;
            }
            $frequency[$key]++;
        }

        // Get max key from the hashset
        $maxFrequency = 0;
        foreach ($frequency as $count) {
            if ($count > $maxFrequency) {
                $maxFrequency = $count;
            }
        }

        // Get the value against the max key
        $modes = [];
        foreach ($frequency as $value => $count) {
            if ($count === $maxFrequency) {
                $modes[] = $value;
            }
        }
    
        return [
            'modal' => $modes,
            'frequency' => $maxFrequency,
        ];
    }

    public static function calculateTotal(array $data)
    {
        $sum = 0;

        foreach ($data as $value) {
            $sum += $value;
        }

        return round($sum, 2);
    }

    public static function calculateMedian(array $data)
    {
        $count = count($data);

        if ($count % 2 === 1) { // If odd no of elements middle is the exact half
            return round($data[floor($count / 2)], 2);
        }
        $middle1 = $data[$count / 2 - 1];
        $middle2 = $data[$count / 2];
        return round(($middle1 + $middle2) / 2, 2);
    }
}