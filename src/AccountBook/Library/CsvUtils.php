<?php
declare(strict_types=1);

namespace AccountBook\Library;

class CsvUtils
{
    public static function parseFromString(string $input, string $delimiter = ',', string $enclosure = '"'): array
    {
        $temp = fopen("php://memory", "rw");
        fwrite($temp, $input);
        fseek($temp, 0);
        $return = [];
        while (($data = fgetcsv($temp, 4096, $delimiter, $enclosure)) !== false) {
            $return[] = $data;
        }
        fclose($temp);

        return $return;
    }
}
