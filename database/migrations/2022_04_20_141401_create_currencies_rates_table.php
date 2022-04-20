<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies_rates', function (Blueprint $table) {
            $table->string('currencyAbbreviation');
            $table->unsignedDecimal('rateToEuro', $precision = 12, $scale = 4);
            $table->date('rateDate');
            $table->string('rateSource');
            $table->foreign('currencyAbbreviation')->references('abbreviation')->on('currency_names');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies_rates');
    }
};
