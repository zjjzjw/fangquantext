<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCityIdToDeveloperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('developer', function (Blueprint $table) {
            $table->integer('city_id')->after('decision')->default(0)->comment('城市id');
            $table->integer('province_id')->after('decision')->default(0)->comment('省id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('developer', function (Blueprint $table) {
            $table->dropColumn('city_id');
            $table->dropColumn('province_id');
        });
    }

}
