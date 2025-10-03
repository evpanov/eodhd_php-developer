<?php

namespace App\Services\EODETLService;

use Alcohol\ISO4217;
use App\Services\EODETLService\DTO\CsvRowDTO;
use App\Services\EODETLService\Repositories\BoardRepository;
use App\Services\EODETLService\Repositories\EODDataRepository;
use App\Services\EODETLService\Repositories\SectorRepository;
use App\Services\EODETLService\Repositories\SecurityTypeRepository;
use App\Services\EODETLService\Repositories\TickerRepository;
use Illuminate\Support\Facades\Log;

final class EODETLService
{
    private TickerRepository $tickerRepository;
    private BoardRepository $boardRepository;
    private SectorRepository $sectorRepository;
    private SecurityTypeRepository $securityTypeRepository;
    private EODDataRepository $EODDataRepository;
    private CsvDownloader $csvDownloader;
    private CsvExtractor $csvExtractor;
    private string $externalFilepath;
    private string $localFilepath;
    private string $dateValue;

    public function __construct(
        TickerRepository $tickerRepository,
        BoardRepository $boardRepository,
        SectorRepository $sectorRepository,
        SecurityTypeRepository $securityTypeRepository,
        EODDataRepository $EODDataRepository,
        CsvDownloader $csvDownloader,
        CsvExtractor $csvExtractor,
        \DateTime $dateTime
    ) {
        $this->tickerRepository = $tickerRepository;
        $this->boardRepository = $boardRepository;
        $this->sectorRepository = $sectorRepository;
        $this->securityTypeRepository = $securityTypeRepository;
        $this->EODDataRepository = $EODDataRepository;

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

                    $rowDTO->setTickerId($this->tickerRepository->getModel($rowDTO)->id);
                    $rowDTO->setBoardId($this->boardRepository->getModel($rowDTO)->id);
                    $rowDTO->setSectorId($this->sectorRepository->getModel($rowDTO)->id);
                    $rowDTO->setSecurityTypeId($this->securityTypeRepository->getModel($rowDTO)->id);

                    $iso4217 = new ISO4217();
                    $rowDTO->setCurrencyCodeNumeric($iso4217->getByAlpha3(strtoupper($rowDTO->currency))['numeric']);

                    $this->EODDataRepository->create($rowDTO);
                }
            }
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage(), [
                'exception_payload' => (array)$exception
            ]);
        }
    }
}
