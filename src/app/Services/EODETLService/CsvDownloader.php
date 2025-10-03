<?php

namespace App\Services\EODETLService;

use GuzzleHttp\Client;

final class CsvDownloader
{
    public function download(string $externalFilepath, $localFilepath): void
    {
        $client = new Client();
        $client->get($externalFilepath, [
            'sink' => $localFilepath
        ]);
    }
}
