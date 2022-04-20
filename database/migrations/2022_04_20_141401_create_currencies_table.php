<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->string('abbreviation');
            $table->unsignedDecimal('rateToEuro', $precision = 12, $scale = 4);
            $table->date('rateDate');
            $table->string('rateSource');
            $table->foreign('abbreviation')->references('abbreviation')->on('currency_names');
        });

        // DB::table('currencies')->insert(
        //     array(
        //         'abbreviation' => 'RUB',
        //         'rateToEuro' => 101.69,
        //         'rateDate' => '2022-04-19',
        //         'rateSource' => 'ME'
        //         )
        // );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
};
