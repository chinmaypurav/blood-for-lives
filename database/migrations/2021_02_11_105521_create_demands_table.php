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
            $table->string('guardian_email');
            $table->string('recipient_name');
            $table->string('blood_group')->nullable();//wip hack
            $table->string('blood_component')->nullable();//wip hack
            $table->unsignedTinyInteger('no_substitute')->default(false);
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