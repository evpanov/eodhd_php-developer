<?php

namespace App\Services\EODETLService\Models;

use Illuminate\Database\Eloquent\Model;

final class Board extends Model
{
    public const TABLE = 'boards';
    public const FIELD_BOARD = 'boards';

    protected $table = self::TABLE;
    protected $fillable = [
        self::FIELD_BOARD,
    ];
}
