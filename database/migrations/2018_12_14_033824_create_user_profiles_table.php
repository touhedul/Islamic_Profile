<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->integer('user_id')->primary();
            $table->string('gender',6)->nullable();
            $table->string('division')->nullable();
            $table->string('address')->nullable();
            $table->string('contact',20)->nullable();
            $table->string('details')->nullable();
            $table->string('education')->nullable();
            $table->string('image')->nullable();
            $table->date('dob')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}
