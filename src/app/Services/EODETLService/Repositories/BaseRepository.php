<?php

namespace App\Services\EODETLService\Repositories;

abstract class BaseRepository implements RepositoryInterface
{
    protected const CACHE_TTL_MINUTES = 10;
}
