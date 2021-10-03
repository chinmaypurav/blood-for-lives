<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('bank_code')->unique();
            $table->string('email')->nullable();
            $table->string('address');
            $table->string('postal');
            $table->decimal('latitude', 9, 6)->nullable();
            $table->decimal('longitude', 9, 6)->nullable();
            $table->unsignedTinyInteger('status')->default(0);
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_active')->default(false);
            $table->string('signature')->nullable();
            $table->json('properties')->nullable();
            $table->json('banks_in_proximity')->nullable();
            $table->softDeletes('deleted_at');
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
        Schema::dropIfExists('banks');
    }
}