<?php

use App\Services\EODETLService\Models\Fundamental;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFundamentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Fundamental::TABLE, function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger(Fundamental::FIELD_EOD_DATA_ID);
            $table->unsignedInteger(Fundamental::FIELD_SHARES_OUTSTANDING);
            $table->unsignedInteger(Fundamental::FIELD_MARKET_CAP);
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
        Schema::dropIfExists('fundamentals');
    }
}
