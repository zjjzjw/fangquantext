<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryToDeveloperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('developer', function (Blueprint $table) {
            $table->string('developer_address', 100)->after('logo')->default('')->comment('开发商地点');
            $table->string('principles', 150)->after('logo')->default('')->comment('分级原则');
            $table->string('decision', 150)->after('logo')->default('')->comment('项目落地决策');
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
            $table->dropColumn('developer_address');
            $table->dropColumn('principles');
            $table->dropColumn('decision');
        });
    }

}
