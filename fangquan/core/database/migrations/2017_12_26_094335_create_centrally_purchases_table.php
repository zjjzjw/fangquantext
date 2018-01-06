<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentrallyPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centrally_purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('developer_id')->default(0)->comment('开发商id');
            $table->text('content')->default('')->comment('招标内容');
            $table->string('bidding_node', 255)->default('')->comment('招标期限');
            $table->timestamp('start_up_time')->default('0000-00-00 00:00:00')->comment('启动时间');
            $table->integer('p_nums')->default(0)->comment('项目数');
            $table->timestamp('publish_time')->default('0000-00-00 00:00:00')->comment('发布时间');
            $table->string('area', 255)->default('')->comment('项目覆盖区域');
            $table->integer('province_id')->default(0)->comment('省份id');
            $table->integer('city_id')->default(0)->comment('城市id');
            $table->string('address', 255)->default('')->comment('集采详细地址');
            $table->string('contact', 50)->default('')->comment('联系人');
            $table->string('contacts_phone', 50)->default('')->comment('联系电话');
            $table->string('contacts_position', 50)->default('')->comment('职位');
            $table->tinyInteger('status')->default(0)->comment('状态 1=正常上架状态 2=下架');
            $table->integer('created_user_id')->default(0)->comment('创建人');
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
        Schema::dropIfExists('centrally_purchases');
    }
}
