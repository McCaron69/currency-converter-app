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
        Schema::create('currency_names', function (Blueprint $table) {
            $table->string('abbreviation')->primary();
            $table->string('name');
        });

        $currencies = array(
            'AUD' => 'Australian Dollar',
            'BGN' => 'Bulgarian Lev',
            'BRL' => 'Brazilian Real',
            'CAD' => 'Canadian Dollar',
            'CHF' => 'Swiss Franc',
            'CNY' => 'Chinese Yuan',
            'CZK' => 'Czech Koruna',
            'DKK' => 'Danish Krone',
            'GBP' => 'British Pound Sterling',
            'HKD' => 'Hong Kong Dollar',
            'HRK' => 'Croatian Kuna',
            'HUF' => 'Hungarian Forint',
            'IDR' => 'Indonesian Rupiah',
            'ILS' => 'Israeli Shekel',
            'INR' => 'Indian Rupee',
            'ISK' => 'Icelandic Krona',
            'JPY' => 'Japanese Yen',
            'KRW' => 'South Korean Won',
            'MYR' => 'Malaysian Ringgit',
            'MXN' => 'Mexican Peso',
            'NOK' => 'Norwegian Krone',
            'NZD' => 'New Zealand Dollar',
            'PHP' => 'Philippine Peso',
            'PLN' => 'Polish Zloty',
            'RON' => 'Romanian Leu',
            'RUB' => 'Russian Ruble',
            'SEK' => 'Swedish Krona',
            'SGD' => 'Singapore Dollar',
            'THB' => 'Thai Baht',
            'TRY' => 'Turkish Lira',
            'USD' => 'US Dollar',
            'ZAR' => 'South African Rand'
        );

        foreach ($currencies as $abbreviation => $name) {
            DB::table('currency_names')->insert(
                array(
                    'abbreviation' => $abbreviation,
                    'name' => $name
                    )
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currency_names');
    }
};
