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
            $json = json_encode([
                'raw' => [
                    'id' => null,
                    'updated_at' => null
                ],
                'failed' => [
                    'id' => null,
                    'updated_at' => null
                ],
                'stored' => [
                    'id' => null,
                    'updated_at' => null
                ],
                'rejected' => [
                    'id' => null,
                    'updated_at' => null
                ],
                'transfused' => [
                    'id' => null,
                    'updated_at' => null
                ],
            ]);

            $table->id();
            $table->foreignId('donor_id')
                    ->constrained();
            $table->foreignId('bank_id')
                    ->constrained();
            $table->enum('blood_component', ['whole', 'plasma', 'platelets', 'wbc', 'rbc']);
            $table->timestamp('donated_at')->useCurrent();
            $table->foreignId('camp_id')
                    ->nullable();
            $table->timestamp('expiry_at')->nullable();
            $table->enum('status', ['raw', 'failed', 'stored', 'rejected', 'transfused'])->default('raw');
            $table->string('notes')->nullable();
            $table->json('logger')->default($json);
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
