<?php

namespace App\Services\EODETLService\Repositories;

use App\Services\EODETLService\DTO\CsvRowDTO;

interface RepositoryInterface
{
    public function getModel(CsvRowDTO $rowDTO);
}
