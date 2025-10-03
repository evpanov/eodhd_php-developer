<?php

use App\Services\EODETLService\Models\SecurityType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecurityTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('security_types', static function (Blueprint $table) {
            $table->increments('id');
            $table->string(SecurityType::FIELD_SECURITY_TYPE);
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
        Schema::dropIfExists('security_types');
    }
}
