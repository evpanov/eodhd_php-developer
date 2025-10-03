<?php

namespace App\Services\EODETLService\Repositories;

use App\Services\EODETLService\DTO\CsvRowDTO;
use App\Services\EODETLService\Models\EODData;
use App\Services\EODETLService\Models\Fundamental;

final class FundamentalRepository extends BaseRepository
{
    public function create(CsvRowDTO $rowDTO): EODData
    {
        return Fundamental::create([
            Fundamental::FIELD_EOD_DATA_ID => $rowDTO->trade_date,
            Fundamental::FIELD_SHARES_OUTSTANDING => $rowDTO->shares_outstanding,
            Fundamental::FIELD_MARKET_CAP => $rowDTO->market_cap,
        ]);
    }

    public function getModel(CsvRowDTO $rowDTO): void
    {
    }
}
