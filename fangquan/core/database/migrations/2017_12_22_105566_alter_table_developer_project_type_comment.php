<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class  AlterTableDeveloperProjectTypeComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('developer_project', function (Blueprint $table) {
            $table->integer('type')->comment('施工类型 1=新建 2=翻新 3=扩建 4=室内装饰 5=设备安装')->change();
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
            $table->integer('type')->comment('项目类型 1=新建 2=翻新 3=扩建 4=室内装饰 5=设备安装')->change();
        });
    }

}
