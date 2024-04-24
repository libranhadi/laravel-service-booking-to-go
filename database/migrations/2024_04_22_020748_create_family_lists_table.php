<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_lists', function (Blueprint $table) {
            $table->bigIncrements('fl_id');
            $table->unsignedBigInteger('cst_id')->index();
            $table->foreign('cst_id')->references('cst_id')->on('customers');
            $table->string('fl_relation', 50);
            $table->string('fl_name', 50);
            $table->string('fl_dob', 50);
            $table->timestamps();
            $table->softDeletes()->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('family_lists');
    }
}
