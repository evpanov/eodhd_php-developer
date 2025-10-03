<?php

use App\Services\EODETLService\Models\Ticker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(Ticker::TABLE, static function (Blueprint $table) {
            $table->increments('id');
            $table->string(Ticker::FIELD_STOCK_CODE);
            $table->string(Ticker::FIELD_STOCK_NAME);
            $table->string(Ticker::FIELD_STOCK_LONG_NAME);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tickers');
    }
}
