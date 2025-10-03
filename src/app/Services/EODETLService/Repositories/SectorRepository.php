<?php

namespace App\Services\EODETLService\Repositories;

use App\Services\EODETLService\DTO\CsvRowDTO;
use App\Services\EODETLService\Models\Sector;
use Illuminate\Support\Facades\Cache;

final class SectorRepository extends BaseRepository
{
    public function getModel(CsvRowDTO $rowDTO): Sector
    {
        return Cache::remember(
            __CLASS__ . __METHOD__ . $rowDTO->sector,
            self::CACHE_TTL_MINUTES,
            fn() => Sector::firstOrCreate(
                [
                    Sector::FIELD_SECTOR => $rowDTO->sector,
                ]
            )
        );
    }
}
