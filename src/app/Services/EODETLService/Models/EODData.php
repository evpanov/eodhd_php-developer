<?php

namespace App\Services\EODETLService\Models;

use Illuminate\Database\Eloquent\Model;

final class EODData extends Model
{
    public const TABLE = 'eod_data';
    public const FIELD_TRADE_DATE = 'trade_date';
    public const FIELD_TICKER_ID = 'ticker_id';
    public const FIELD_BOARD_ID = 'board_id';
    public const FIELD_SECTOR_ID = 'sector_id';
    public const FIELD_SECURITY_TYPE_ID = 'security_type_id';
    public const FIELD_CURRENCY_CODE_NUMERIC = 'currency_code_numeric';
    public const FIELD_OPENING_PRICE = 'opening_price';
    public const FIELD_HIGH_PRICE = 'high_price';
    public const FIELD_LOWEST_PRICE = 'lowest_price';
    public const FIELD_CLOSING_PRICE = 'closing_price';
    public const FIELD_VOLUME_TRADED_MKT_TRANS = 'volume_traded_mkt_trans';
    public const FIELD_VOLUME_TRADED_DIRECT_BUSINESS = 'volume_traded_direct_business';


    protected $table = self::TABLE;
    protected $fillable = [
        self::FIELD_TRADE_DATE,
        self::FIELD_TICKER_ID,
        self::FIELD_BOARD_ID,
        self::FIELD_SECTOR_ID,
        self::FIELD_SECURITY_TYPE_ID,
        self::FIELD_CURRENCY_CODE_NUMERIC,
        self::FIELD_OPENING_PRICE,
        self::FIELD_HIGH_PRICE,
        self::FIELD_LOWEST_PRICE,
        self::FIELD_CLOSING_PRICE,
        self::FIELD_VOLUME_TRADED_MKT_TRANS,
        self::FIELD_VOLUME_TRADED_DIRECT_BUSINESS,
    ];
}
