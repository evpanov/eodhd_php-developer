<?php

namespace App\Services\EODETLService\Models;

use Illuminate\Database\Eloquent\Model;

final class Ticker extends Model
{
    public const TABLE = 'tickers';
    public const FIELD_STOCK_CODE = 'stock_code';
    public const FIELD_STOCK_NAME = 'stock_name';
    public const FIELD_STOCK_LONG_NAME = 'stock_long_name';

    protected $table = self::TABLE;
    protected $fillable = [
        self::FIELD_STOCK_CODE,
        self::FIELD_STOCK_NAME,
        self::FIELD_STOCK_LONG_NAME
    ];
}
