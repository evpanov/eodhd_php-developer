<?php

namespace App\Services\EODETLService\Repositories;

use App\Services\EODETLService\DTO\CsvRowDTO;
use App\Services\EODETLService\Models\SecurityType;
use Illuminate\Support\Facades\Cache;

final class SecurityTypeRepository extends BaseRepository
{
    public function getModel(CsvRowDTO $rowDTO): SecurityType
    {
        return Cache::remember(
            __CLASS__ . __METHOD__ . $rowDTO->security_type,
            self::CACHE_TTL_MINUTES,
            fn() => SecurityType::firstOrCreate(
                [
                    SecurityType::FIELD_SECURITY_TYPE => $rowDTO->security_type
                ]
            )
        );
    }
}
