<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     * appointments which are the same as tasks
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->unsignedBigInteger('user_id')->constrained();
=======
            $table->unsignedBigInteger('user_id')->constrained('user');
>>>>>>> d662aceae7c54991e342500bd99916984ab2c2fa
            //$table->string('username');
            $table->string('appointment');
            $table->string('type');         //->clinic or personal appointments
            $table->string('status');      //->incoming or past
            $table->dateTime('reminder');   //-> date and time
            $table->text('body')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
