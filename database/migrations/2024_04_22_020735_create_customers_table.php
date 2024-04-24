<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('cst_id');
            $table->unsignedBigInteger('nationality_id')->index();
            $table->foreign('nationality_id')->references('nationality_id')->on('nationalities');
            $table->char('cst_name', 50);
            $table->date('cst_dob');
            $table->string('cst_phoneNum', 20);
            $table->string('cst_email', 20);
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
        Schema::dropIfExists('customers');
    }
}
