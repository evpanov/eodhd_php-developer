<?php

use App\Services\EODETLService\Models\EODData;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEodDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eod_data', function (Blueprint $table) {
            $table->increments('id');
            $table->date(EODData::FIELD_TRADE_DATE);
            $table->unsignedInteger(EODData::FIELD_TICKER_ID);
            $table->unsignedInteger(EODData::FIELD_BOARD_ID);
            $table->unsignedInteger(EODData::FIELD_SECTOR_ID);
            $table->unsignedInteger(EODData::FIELD_SECURITY_TYPE_ID);
            $table->string(EODData::FIELD_CURRENCY, 3);
            $table->double(EODData::FIELD_OPENING_PRICE);
            $table->double(EODData::FIELD_HIGH_PRICE);
            $table->double(EODData::FIELD_LOWEST_PRICE);
            $table->double(EODData::FIELD_CLOSING_PRICE);
            $table->unsignedBigInteger(EODData::FIELD_VOLUME_TRADED_MKT_TRANS);
            $table->unsignedBigInteger(EODData::FIELD_VOLUME_TRADED_DIRECT_BUSINESS);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eod_data');
    }
}
