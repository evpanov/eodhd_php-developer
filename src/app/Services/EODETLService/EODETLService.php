<?php

namespace App\Services\EODETLService;

use App\Services\EODETLService\DTO\CsvRowDTO;
use App\Services\EODETLService\Repositories\TickerRepository;
use Illuminate\Support\Facades\Log;

final class EODETLService
{
    private TickerRepository $tickerRepository;
    private CsvDownloader $csvDownloader;
    private CsvExtractor $csvExtractor;
    private string $externalFilepath;
    private string $localFilepath;
    private string $dateValue;

    public function __construct(
        TickerRepository $tickerRepository,
        CsvDownloader $csvDownloader,
        CsvExtractor $csvExtractor,
        \DateTime $dateTime
    ) {
        $this->tickerRepository = $tickerRepository;
        $this->csvDownloader = $csvDownloader;
        $this->csvExtractor = $csvExtractor;

        $this->dateValue = $dateTime->format('Y-m-d');

        $this->externalFilepath = str_replace('{date}', $this->dateValue, config('eodetl.csvFilepathMask'));
        $this->localFilepath = storage_path('app/eod_' . $this->dateValue . '.csv');
    }

    public function run(): void
    {
        try {
            $this->csvDownloader->download($this->externalFilepath, $this->localFilepath);

            foreach ($this->csvExtractor->extractByChunk($this->localFilepath, 500) as $chunk) {
                foreach ($chunk as $row) {
                    $rowDTO = CsvRowDTO::createFromArray($row);
                    if ($this->dateValue !== $rowDTO->trade_date || $rowDTO->isValid() === false) {
                        continue;
                    }

                }
            }
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage(), [
                'exception_payload' => (array)$exception
            ]);
        }
    }
}
