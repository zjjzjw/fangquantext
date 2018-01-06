<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_sign', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->default('')->comment('用户名称');
            $table->string('phone', 50)->default('')->comment('联系方式');
            $table->integer('is_sign')->default(0)->comment('状态1=已签到 2=未签到');
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
        Schema::dropIfExists('user_sign');
    }
}
