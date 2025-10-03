<?php

namespace App\Services\EODETLService\Models;

use Illuminate\Database\Eloquent\Model;

final class SecurityType extends Model
{
    public const TABLE = 'security_types';
    public const FIELD_SECURITY_TYPE = 'security_type';

    protected $table = self::TABLE;
    protected $fillable = [
        self::FIELD_SECURITY_TYPE
    ];
}
