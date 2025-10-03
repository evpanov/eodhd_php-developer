<?php

namespace App\Services\EODETLService\Repositories;

use App\Services\EODETLService\DTO\CsvRowDTO;
use App\Services\EODETLService\Models\Ticker;
use Illuminate\Support\Facades\Cache;

final class TickerRepository extends BaseRepository
{
    public function getModel(CsvRowDTO $rowDTO): Ticker
    {
        return Cache::remember(
            __CLASS__ . __METHOD__ . $rowDTO->stock_code,
            self::CACHE_TTL_MINUTES,
            fn() => Ticker::firstOrCreate(
                [
                    Ticker::FIELD_STOCK_CODE => $rowDTO->stock_code
                ],
                [
                    Ticker::FIELD_STOCK_NAME => $rowDTO->stock_name,
                    Ticker::FIELD_STOCK_LONG_NAME => $rowDTO->stock_long_name
                ]
            )
        );
    }
}
