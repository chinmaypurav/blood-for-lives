<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankDonorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_donor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')
                    ->constrained();
            $table->foreignId('bank_id')
                    ->constrained();
            $table->enum('blood_component', ['whole', 'plasma', 'platelets', 'wbc', 'rbc']);
            $table->enum('status', ['raw', 'failed', 'stored', 'rejected', 'transfused'])->default('raw');
            $table->string('editor');
            $table->timestamp('donated_at')->useCurrent();
            $table->timestamp('expiry_at')->nullable();
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
        Schema::dropIfExists('bank_donor');
    }
}
