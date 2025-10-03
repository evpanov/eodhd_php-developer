<?php

namespace App\Services\EODETLService;

final class CsvExtractor
{
    private const DELIMITER = ';';

    public function extractByChunk(string $localFilepath, int $chunkSize = 256): \Generator
    {
        $handle = fopen($localFilepath, 'rb');
        if ($handle === false) {
            throw new \RuntimeException('Cannot open file: ' . $localFilepath);
        }

        $header = fgetcsv($handle, 0, self::DELIMITER);

        while (feof($handle) === false){
            $rows = [];

            for ($index = 0; $index < $chunkSize && feof($handle) === false; $index++){
                $row = fgetcsv($handle, 0, self::DELIMITER);

                if (empty($row) === true){
                    continue;
                }

                $rows[] = array_combine($header, $row);
            }

            empty($rows) && yield $rows;
        }

        fclose($handle);
    }
}
