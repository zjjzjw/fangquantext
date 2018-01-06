<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNumToDeveloperProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('developer_project', function (Blueprint $table) {
            $table->integer('cover_num')->after('source')->default(0)->comment('套数');
            $table->timestamp('opening_time')->after('source')->default('0000-00-00 00:00:00')->comment('开盘时间');
            $table->timestamp('invitation_time')->after('source')->default('0000-00-00 00:00:00')->comment('招标时间');
            $table->integer('created_user_id')->after('source')->default(0)->comment('创建人id')->nullable();
            $table->integer('centrally_purchases_id')->after('source')->default(0)->comment('所属集采id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('developer_project', function (Blueprint $table) {
            $table->dropColumn('cover_num');
            $table->dropColumn('opening_time');
            $table->dropColumn('invitation_time');
            $table->dropColumn('created_user_id');
            $table->dropColumn('centrally_purchases_id');
        });
    }

}
