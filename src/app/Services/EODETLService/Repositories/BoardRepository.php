<?php

namespace App\Services\EODETLService\Repositories;

use App\Services\EODETLService\DTO\CsvRowDTO;
use App\Services\EODETLService\Models\Board;
use Illuminate\Support\Facades\Cache;

final class BoardRepository extends BaseRepository
{
    public function getModel(CsvRowDTO $rowDTO): Board
    {
        return Cache::remember(
            __CLASS__ . __METHOD__ . $rowDTO->board,
            self::CACHE_TTL_MINUTES,
            fn() => Board::firstOrCreate(
                [
                    Board::FIELD_BOARD => $rowDTO->board,
                ]
            )
        );
    }
}
