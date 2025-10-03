<?php

namespace App\Services\EODETLService\DTO;

use App\Services\EODETLService\Models\Ticker;
use Illuminate\Support\Facades\Cache;

final class CsvRowDTO
{
    public ?string $trade_date = null;
    public ?string $stock_code = null;
    public ?string $stock_name = null;
    public ?string $stock_long_name = null;
    public ?string $board = null;
    public ?string $sector = null;
    public ?string $security_type = null;
    public ?string $currency = null;
    public ?string $opening_price = null;
    public ?string $high_price = null;
    public ?string $lowest_price = null;
    public ?string $closing_price = null;
    public ?string $volume_traded_mkt_trans = null;
    public ?string $volume_traded_direct_business = null;
    public ?string $value_traded_mkt_trans = null;
    public ?string $value_traded_direct_business = null;
    public ?string $shares_outstanding = null;
    public ?string $market_cap = null;
    public ?string $klci_indicator = null;
    public ?string $fbm100_indicator = null;

    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public static function createFromArray(array $row): self
    {
        return new self($row);
    }

    public function isValid(): bool
    {
        /**
         * TODO: Add validation logic here
         */

        return true;
    }
}
