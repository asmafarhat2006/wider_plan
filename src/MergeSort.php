<?php

namespace App;

class MergeSort
{
    public function sort(array $data): array
    {
        // Base case
        if (count($data) <= 1) {
            return $data;
        }

        // Split the array into two halves
        $middle = intdiv(count($data), 2);
        $left = array_slice($data, 0, $middle);
        $right = array_slice($data, $middle);

        // Recursively sort both halves and merge them
        return $this->merge($this->sort($left), $this->sort($right));
    }

    private function merge(array $left, array $right): array
    {
        $sorted = [];
        $i = 0; // Left array pointer
        $j = 0; // Right array pointer

        // Compare elements of left & right and add them in an array
        while ($i < count($left) && $j < count($right)) {
            if ($left[$i] <= $right[$j]) {
                $sorted[] = $left[$i];
                $i++;
            } else {
                $sorted[] = $right[$j];
                $j++;
            }
        }

        // Append any remaining elements from the left or right arrays
        while ($i < count($left)) {
            $sorted[] = $left[$i];
            $i++;
        }
        while ($j < count($right)) {
            $sorted[] = $right[$j];
            $j++;
        }

        return $sorted;
    }
}
