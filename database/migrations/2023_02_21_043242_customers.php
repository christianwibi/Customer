<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Customers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('customers')) {
            Schema::create('customers', function (Blueprint $table) {
                $table->integer("id")->autoIncrement();
                $table->string('name',100);
                $table->string('email',100);
                $table->string('password',100);
                $table->enum('gender', ['MALE', 'FEMALE'])->index();
                $table->enum('is_married', ['MARRIED', 'SINGLE'])->index();
                $table->string('address',100);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
