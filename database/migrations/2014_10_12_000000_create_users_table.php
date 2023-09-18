<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('reg_no')->unique();
            $table->string('id_no')->unique();
            $table->string('gender');
            $table->string('address');
            $table->date('dob');
            $table->string('campus');
            $table->string('current_programme')->nullable();
            $table->integer('attempted_units')->nullable();
            $table->integer('registered_units')->nullable();
            $table->decimal('total_billed', 8, 2)->nullable();
            $table->decimal('total_paid', 8, 2)->nullable();
            $table->decimal('fee_balance', 8, 2)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
