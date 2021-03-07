<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('demands', function (Blueprint $table) {
            
            $json = json_encode([
                'open' => [
                    'id' => null,
                    'updated_at' => null
                ],
                'allocated' => [
                    'id' => null,
                    'updated_at' => null
                ],
                'success' => [
                    'id' => null,
                    'updated_at' => null
                ],
                'failed' => [
                    'id' => null,
                    'updated_at' => null
                ],
            ]);
            
            $table->id();
            $table->foreignId('bank_id')
                    ->constrained();
            $table->string('guardian_name');
            $table->string('guardian_contact');
            $table->string('recipient_name');
            $table->enum('recipient_group', ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-', 'HH']);
            $table->enum('recipient_component',  ['whole', 'wbc', 'rbc', 'platelets', 'plasma']);
            $table->json('compatible_group');
            $table->timestamp('required_at');
            $table->unsignedTinyInteger('required_units');
            $table->unsignedTinyInteger('buffer_time');
            $table->boolean('is_donor')->default(false);
            $table->enum('status', ['open', 'allocated', 'success', 'failed'])->default('open');
            $table->json('logger')->default($json);
            $table->unsignedTinyInteger('ada_range')->default(0);
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
        Schema::dropIfExists('demands');
    }
}
