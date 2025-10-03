<?php

namespace App\Services\EODETLService\Models;

use Illuminate\Database\Eloquent\Model;

final class Fundamental extends Model
{
    public const TABLE = 'fundamentals';
    public const FIELD_EOD_DATA_ID = 'eod_data_id';
    public const FIELD_SHARES_OUTSTANDING = 'shares_outstanding';
    public const FIELD_MARKET_CAP = 'market_cap';

    protected $table = self::TABLE;
    protected $fillable = [
        self::FIELD_EOD_DATA_ID,
        self::FIELD_SHARES_OUTSTANDING,
        self::FIELD_MARKET_CAP,
    ];
}
