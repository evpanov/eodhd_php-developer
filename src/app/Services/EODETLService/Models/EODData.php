<?php

namespace App\Services\EODETLService\Models;

use Illuminate\Database\Eloquent\Model;

final class EODData extends Model
{
    public const TABLE = 'eod_data';
    public const FIELD_BOARD = 'board';

    protected $table = self::TABLE;
    protected $fillable = [
        self::FIELD_BOARD,
    ];
}
