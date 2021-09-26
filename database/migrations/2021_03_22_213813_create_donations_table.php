<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained();
            $table->foreignId('bank_id')
                ->constrained();
            $table->foreignId('blood_component_id')->constrained();
            $table->timestamp('donated_at')->useCurrent();
            $table->foreignId('camp_id')
                ->nullable();
            // $table->foreignId('demand_id')
            //     ->nullable();
            // $table->timestamp('expiry_at')->nullable();
            $table->enum('status', ['raw', 'failed', 'stored', 'rejected', 'transfused'])->default('raw');
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('donations');
    }
}