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
            $table->id();
            $table->foreignId('bank_id')
                ->constrained();
            $table->string('guardian_name');
            $table->string('guardian_contact');
            $table->string('recipient_name');
            $table->foreignId('blood_group_id');
            $table->foreignId('blood_component_id');
            $table->json('compatible_group');
            $table->timestamp('required_at');
            $table->unsignedTinyInteger('required_units');
            $table->unsignedTinyInteger('buffer_time');
            $table->boolean('is_donor')->default(false);
            $table->enum('status', ['open', 'allocated', 'success', 'failed'])->default('open');
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