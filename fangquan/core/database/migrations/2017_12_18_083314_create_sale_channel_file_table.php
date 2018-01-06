<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleChannelFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_channel_file', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('provider_id')->default(0)->comment('供应商id');
            $table->integer('file_id')->default(0)->comment('文件id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_channel_file');
    }
}
