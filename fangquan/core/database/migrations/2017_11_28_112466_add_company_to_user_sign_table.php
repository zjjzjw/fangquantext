<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyToUserSignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_sign', function (Blueprint $table) {
            $table->string('company_name', 50)->after('phone')->default('')->comment('公司名称');
            $table->string('position', 50)->after('phone')->default('')->comment('职位');
            $table->string('crowd', 50)->after('phone')->default('')->comment('人群');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_sign', function (Blueprint $table) {
            $table->dropColumn('company_name');
            $table->dropColumn('position');
            $table->dropColumn('crowd');
        });
    }
}
