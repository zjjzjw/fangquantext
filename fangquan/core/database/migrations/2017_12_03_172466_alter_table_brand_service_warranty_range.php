<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class  AlterTableBrandServiceWarrantyRange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brand_service', function (Blueprint $table) {
            $table->string('warranty_range', 255)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brand_service', function (Blueprint $table) {
            $table->string('warranty_range', 50)->change();
        });
    }

}
