<?php

namespace App\Services\EODETLService\Repositories;

use App\Services\EODETLService\DTO\CsvRowDTO;
use App\Services\EODETLService\Models\EODData;

final class EODDataRepository extends BaseRepository
{
    public function create(CsvRowDTO $rowDTO): EODData
    {
        return EODData::create([
            EODData::FIELD_TRADE_DATE => $rowDTO->trade_date,
            EODData::FIELD_TICKER_ID => $rowDTO->ticker_id,
            EODData::FIELD_BOARD_ID => $rowDTO->board_id,
            EODData::FIELD_SECTOR_ID => $rowDTO->sector_id,
            EODData::FIELD_SECURITY_TYPE_ID => $rowDTO->security_type_id,
            EODData::FIELD_CURRENCY_CODE_NUMERIC => $rowDTO->currency_code_numeric,
            EODData::FIELD_OPENING_PRICE => $rowDTO->opening_price,
            EODData::FIELD_HIGH_PRICE => $rowDTO->high_price,
            EODData::FIELD_LOWEST_PRICE => $rowDTO->lowest_price,
            EODData::FIELD_CLOSING_PRICE => $rowDTO->closing_price,
            EODData::FIELD_VOLUME_TRADED_MKT_TRANS => $rowDTO->volume_traded_mkt_trans,
            EODData::FIELD_VOLUME_TRADED_DIRECT_BUSINESS => $rowDTO->volume_traded_direct_business,
        ]);
    }

    public function getModel(CsvRowDTO $rowDTO): void
    {
    }
}
