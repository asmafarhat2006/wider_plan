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
        $frequency = [];
        foreach ($data as $value) {
            $key = (string)$value;
            if (!isset($frequency[$key])) {
                $frequency[$key] = 0;
            }
            $frequency[$key]++;
        }
    
        $maxFrequency = 0;
        foreach ($frequency as $count) {
            if ($count > $maxFrequency) {
                $maxFrequency = $count;
            }
        }
    
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

        return $sum;
    }

    public static function calculateMedian(array $data)
    {
        $count = count($data);
        if ($count % 2 === 1) {
            return round($data[floor($count / 2)], 2);
        } else {
            $middle1 = $data[$count / 2 - 1];
            $middle2 = $data[$count / 2];
            return round(($middle1 + $middle2) / 2, 2);
        }
    }
}