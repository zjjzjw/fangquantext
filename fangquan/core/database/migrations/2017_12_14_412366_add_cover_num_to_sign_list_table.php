<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoverNumToSignListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brand_sign_list', function (Blueprint $table) {
            $table->integer('cover_num')->after('product_model')->default(0)->comment('套数');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brand_sign_list', function (Blueprint $table) {
            $table->dropColumn('cover_num');
        });
    }

}
