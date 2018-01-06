<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeveloperPartnershipCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developer_partnership_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('partnership_id')->default(0)->comment('合作关系ID');
            $table->bigInteger('category_id')->default(0)->comment('开发商采购的品类');
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
        Schema::dropIfExists('developer_partnership_category');
    }
}
