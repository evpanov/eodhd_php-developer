<?php

namespace App\Services\EODETLService\Models;

use Illuminate\Database\Eloquent\Model;

final class Sector extends Model
{
    public const TABLE = 'sectors';
    public const FIELD_SECTOR = 'sector';

    protected $table = self::TABLE;
    protected $fillable = [
        self::FIELD_SECTOR,
    ];
}
