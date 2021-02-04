<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                    ->constrained();
            $table->enum('blood_group', ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-', 'HH']);
            $table->string('contact');
            $table->date('dob');
            $table->string('postal');
            $table->decimal('lat', 8, 5);
            $table->decimal('lon', 8, 5);
            $table->unsignedTinyInteger('status_code')->default(0);
            $table->boolean('entry_self')->default(false);
            $table->string('donor_card_no')->default(0); //Set Default to 0 for now
            $table->softDeletes('deleted_at', 0);
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
        Schema::dropIfExists('donors');
    }
}
