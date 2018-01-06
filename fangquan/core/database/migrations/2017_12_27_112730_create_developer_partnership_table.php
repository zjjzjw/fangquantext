<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeveloperPartnershipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developer_partnership', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('developer_id')->default(0)->comment('开发商id');
            $table->bigInteger('provider_id')->default(0)->comment('供应商id');
            $table->timestamp('time')->default('0000-00-00 00:00:00')->comment('签订时间');
            $table->string('address', 255)->default('')->comment('签订地点');
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
        Schema::dropIfExists('developer_partnership');
    }
}
